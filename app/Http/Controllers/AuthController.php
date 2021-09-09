<?php

namespace App\Http\Controllers;

use App\Helpers\ApiGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Log;
use DB;
use Consts;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\SmarthealthHttpException;
/**
 * Class HmoAuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{

    private $RECORD_ERROR = 'Unable to fetch record because security check failed.';
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws SmarthealthHttpException
     */
    public function loginAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
         'email' => 'required|string|email',
         'secret' => 'required|string',
        ]);

        $errors = [];
        //$validPass = $this->checkPassword($request->secret, $errors);
        $validPass = true;

        if ($validator->fails() || !$validPass) {
            if (!$validPass) {
                $msg = $validator->getMessageBag()->getMessages();
                //$msg = array_merge($msg, $errors);
            } else {
                $msg = $validator->messages();
            }
            throw new SmarthealthHttpException(400, $msg, 'Wrong credentials provided');
        }

        $message = $user = '';
        $data = sanitizeInput($request->except(Consts::CSRF));
        //local instance login
        
        $email = $data['email'];
        $secret = sha1($data['secret']);
        session()->put('accountType', 'provider');
        $accessToken = '';

        $user = User::where('email', $email)->where('password', $secret)->first();

        if ($user) {
            if($user->status == 1) {
                if ($user->user_type == 0) {
                    session()->put('authUser', $user);
                    $redirect = "index";
                    Session::forget('loginRedirect');
                }

                return response()->json([
                    'success'=>'Logging in...',
                    'callback'=>$redirect,
                ], 200);
            } else {
                return response()->json(['message'=>'User Not Activated'], 401);
            }
        } else {
            return response()->json(['message'=>'Invalid Username or Password!'], 401);
        }
    
    }

    private function checkPassword($pwd, &$errors)
    {
        $errors_init = $errors;

        if (strlen($pwd) < 8) {
            $errors[] = "Password too short!";
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $errors[] = "Password must include at least one number!";
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $errors[] = "Password must include at least one letter!";
        }

        return ($errors == $errors_init);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws SmarthealthHttpException
     */
    public function registerAction(Request $request)
    {
        $fields = [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string|email',
            'credential' => 'required|string|min:6',
            'agreeToTerms' => 'required'
        ];

        if (Helper::isOnline()) {
            $fields['facility'] = 'required|string';
        }

        $validator = Validator::make($request->all(), $fields);

        $errors = [];
        $validPass = $this->checkPassword($request->secret, $errors);

        if ($validator->fails() || !$validPass) {
            $msg = $validator->getMessageBag()->getMessages();
            if (!$validPass) {
                $msg = array_merge($msg, $errors);
            }
            return response()->json([
                'status'  => 402,
                'errors' => $msg
            ], 402);
        }

        $redirect = route('/login');
        $data = Helper::sanitizeInput($request->except(CSRF_HTTP_PARAM));

        try {
            //add local user
            if (Helper::hasLocalStorage()) {
                if (!isset($data['facility'])) {
                    $facility = EdhicFacility::where('clinic_token', Helper::environ('SYNC_FACILITY_TOKEN'))->first();
                    $data['facility'] = $facility->uuid;
                }

                $validatedData = [
                    'password'=>bcrypt($data['credential']), 'username'=>$data['email'],
                    'facility_uuid'=>$data['facility'], 'hims_role'=>'provider',
                    'display_name'=>$data['firstName'].' '.$data['lastName'],
                    'email'=>$data['email'], 'active_einsure'=>0,
                ];

                $user = User::where('email', $data['email'])->get()->first();
                $status = 401;
                if (!$user) {
                    $user = User::create($validatedData);
                    $msg = 'Registration was successful. ';
                    $status = 200;
                    session()->flash('success', $msg);
                } else {
                    $msg = 'Registration failed. A user with provided email exists';
                    session()->flash('error', $msg);
                }

                unset($user->password);
                unset($user->remember_token);
                unset($user->email_verified_at);
                unset($user->updated_at);

                $response_data = [
                    'status'=>$status,
                    'data'=>$user,
                    'message'=>$msg,
                    'errors'=>$msg,
                    'callback'=>route('/'),
                ];

            } else {
                $defaultDomain = config('local.default_domain_code');
                $defaultRole = config('local.default_role');
                $response = Http::post(env('AUTH_BASE_URL').'/healthpassport/api/v1/user/register', [
                    'firstName' => $data['firstName'] ?? '',
                    'lastName' => $data['lastName'] ?? '',
                    'email' => $data['email'] ?? '',
                    'password' => $data['credential'] ?? '',
                    'data' => [
                        'hmoId' => '6',
                        'account_type'=> 'RETAIL_ENROLLEE'
                    ],
                    'defaultRole' => [
                        'roleName' => $defaultRole,
                        'domainCode' => $defaultDomain
                    ]
                ]);

                if (!$response->successful()) {
                    $error = json_decode($response);
                    return response()->json([
                        'status'  => 401,
                        'errors' => $error->data
                    ], 401);
                }
                $r = json_decode($response->body(), true);

                $response_data = [
                    'success'=>'Account created...',
                    'callback'=>$redirect,
                    'data' => $r,
                ];
            }

            return response()->json($response_data, 200);

        }  catch (\Exception $e) {
            $error = json_decode($e->getMessage());
            if (isset($error->code)) {
                $code = $error->code;
                $data = $error->data;
                $status = $error->status;
            } else {
                $code = 500;
                $data = $status = $e->getMessage();
            }
            throw new SmarthealthHttpException($code, $data, $status);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::forget('authUser');
        return redirect('/');
    }
}
