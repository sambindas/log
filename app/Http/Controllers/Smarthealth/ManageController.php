<?php

namespace App\Http\Controllers\Smarthealth;

use App\Http\Controllers\Controller;
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
use App\Models\Incident;
use App\Models\Facility;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\SmarthealthHttpException;
use Yajra\DataTables\DataTables;


class ManageController extends Controller
{
    public function __construct()
    {
        $this->today = date('Y-m-d');
        $this->month_first_date = date('Y-m-d',strtotime('first day of this month'));
        $this->month_last_date = date('Y-m-d',strtotime('last day of this month'));
    }

    public function index()
    {
        $segments = getSmarthealthCats();
        $devusers = User::where('user_role', 'Developer')->orderBy('user_name', 'asc')->get();
        $incident_counts = DB::table('issue')->selectRaw('category, count(*) as cnt')
        ->where('product', 'smarthealth')
        ->groupBy('category')->get();
        $cnts=[];
        foreach($incident_counts as $counts) {
            $cnts[$counts->category] = $counts->cnt;
        }
        foreach($segments as $segment) {
            if(!array_key_exists($segment, $cnts)) {
                $cnts[$segment] = '0';
            }
        }
        return view ('smarthealth.manage', compact('segments', 'devusers', 'cnts'));
    }

    public function submitIncident(Request $request)
    {
        $data = sanitizeInput($request->except(Consts::CSRF));
        $user = currentUser();
        $data['support_officer'] = $user->user_id;
        
        $data['status'] = 0;
        if($user->state_id) {
            $data['state_id'] = $user->state_id;
        }
        $data['issue_type'] = 'Request'; #for now
        $data['product'] = 'smarthealth';

        $data['type'] = $user->user_type;
        $data['month'] = date('M Y');
        $token = generateToken('smh', 5);
        $data['token'] = $token;
        $notify_client = $data['send_email'];
        unset($data['send_email']);
        if($data['user']) {
            $assigned = User::where('user_id', (int)$data['user'])->first();
        }

        $data['issue_level'] = 1;
        $issue_date = date('Y-m-d H:i:s');
        $data['issue_date'] = $issue_date;
        $create = DB::table('issue')->insertGetId($data);
        $msg='';
        if ($create) {
            $msg .= 'Incident saved successfully. ';
            $status_code=200;
            $movement = array(
                'movement'=>'Incident Submitted',
                'done_by'=>$user->user_id,
                'incident_token'=>$token,
                'done_at'=>$issue_date,
                'stage'=>0,
            );
            $this->logMovement($movement);
            $dev_email = '<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi there '.$assigned->user_name.',</p>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">We received a customer request on '.$data['category'].'</p>
                <p>Kindly click below to review and resolve this issue. Please do let us know if you have other questions.</p>
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                <tbody>
                    <tr>
                    <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                        <tbody>
                            <tr>
                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="http://support.smarthealth.eclathealthcare.com" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Incidents Portal</a> </td>
                            </tr>
                        </tbody>
                        </table>
                    </td>
                    </tr>
                </tbody>
                </table>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Sincerely,</p>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Smarthealth Team.</p>
            </td>';
            
            $sendEmailToDev = sendEmail(['subject'=>'Incident Assigned To You', 'email'=>$assigned->email, 'message'=>getEmailTemplate($dev_email)]);
            
            if($sendEmailToDev) {
                $msg .= '<br>Notification email sent to Dev. ';
            } else {
                $msg .= '<br>Failed to notify Dev. ';
            }
            $sendEmailToClient=false;
            if($notify_client == 'on') {
                $patient_email = '<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi there '.$data['issue_client_reporter'].',</p>
                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Thanks for getting in touch. We received your request on '.$data['category'].' and we have passed your request to our support and development team. 
                    We will update you when we hear back from them.</p>
                    <p>In the meantime, we recommend you review the articles on our support page.
                    Please do let us know if you have other questions or feedback.</p>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                    <tbody>
                        <tr>
                        <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                            <tbody>
                                <tr>
                                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="https://tele.smarthealth.eclathealthcare.com/support" 
                                    target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; 
                                    font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Support Page</a> </td>
                                </tr>
                            </tbody>
                            </table>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Sincerely,</p>
                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Smarthealth Team.</p>
                </td>';
                $sendEmailToClient = sendEmail(['subject'=>'Incident Received', 'email'=>$data['client_email'], 'message'=>getEmailTemplate($patient_email)]);
                if(!$sendEmailToClient) {
                    $msg .= '<br>Failed to notify client. ';
                }
            }
            if($sendEmailToClient) {
                $msg .= '<br>Notification email sent to client. ';
                Incident::where('issue_id', $create)->update(['email_to_client'=>1]);
            }
        } else {
            $status_code = 401;
            $msg = "Incident not saved, an error occured.";
        }
        return response()->json(['status'=>$status_code, 'message'=>$msg], $status_code);
    }

    public function getIncidents(Request $request)
    {
        if ($request->ajax()) {
            $cat = getSmarthealthCats($request->id);
            
            //DB::connection()->enableQueryLog();
            $data = Incident::whereBetween('issue_date', [$this->month_first_date,$this->month_last_date])
            ->where('product', 'smarthealth')->where('category', $cat)
            ->orderBy('issue_id', 'desc')->get();
            //dd(DB::getQueryLog());
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $done_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $three_btn = '<a data-id="'.$row->token.'" data-toggle="modal" data-dismiss="modal" data-backdrop="false" data-target="#three" class="dropdown-item" id="action_modal" href="#">Action</a>';
                    $confirmed_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $approval_required_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $incomplete_information_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $not_clear_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $not_approved_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $reopen_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $view_btn = '<a class="dropdown-item" href="'.url('/incident/view/'.$row->token.'').'">View</a>';
                    $zero_btn = '<a data-id="'.$row->token.'" data-toggle="modal" data-dismiss="modal" data-backdrop="false" data-target="#zero" class="dropdown-item" id="action_modal" href="#">Action</a>';
                    $one_btn = '<a data-id="'.$row->token.'" data-toggle="modal" data-dismiss="modal" data-backdrop="false" data-target="#one" class="dropdown-item" id="action_modal" href="#">Action</a>';
                    $four_btn = '<a data-id="'.$row->token.'" data-toggle="modal" data-dismiss="modal" data-backdrop="false" data-target="#four" class="dropdown-item" id="action_modal" href="#">Action</a>';
                    $five_btn = '<a data-id="'.$row->token.'" data-toggle="modal" data-dismiss="modal" data-backdrop="false" data-target="#five" class="dropdown-item" id="action_modal" href="#">Action</a>';
                    $assign_btn = '<a data-id="'.$row->token.'" data-toggle="modal" data-dismiss="modal" data-backdrop="false" data-target="#assign" class="dropdown-item" id="action_modal" href="#">Assign</a>';

                    //$actionBtn = '<span class="fas fa-ellipsis-h"></span>';
                    $actionBtn2 = '<td class="dropdown no-arrow">
                                        <a href="#" class="dropdown-toggle neutral-color" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item mb-3" data-toggle="modal" data-target="#incident_detail">View incident details</a>
                                            <a class="dropdown-item mb-3" href="#">Edit incident</a>
                                            <a class="dropdown-item mb-3" href="#">Bumb incident</a>
                                        </div>
                                    </td>';
                    $actionBtn = "<div class='dropdown'>
                            <button class='btn dropdown-toggle' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i data-feather='more-horizontal'></i>
                            </button>
                            <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                ".$view_btn.$assign_btn."";
                    if ($row->status == 0) {
                        $actionBtn .= $zero_btn;
                    } else if ($row->status == 1){
                        $actionBtn .= $one_btn;
                    } else if ($row->status == 2){
                        $actionBtn .= '';
                    } else if ($row->status == 3){
                        $actionBtn .= $three_btn;
                    } else if ($row->status == 4){
                        $actionBtn .= $four_btn;
                    } else if ($row->status == 5){
                        $actionBtn .= $five_btn;
                    }
                    $actionBtn .= "</div>
                        </div>";
                    return $actionBtn2;
                })
                ->addColumn('issue', function($row){
                    $assigned_to = 'Unassigned';
                    if ($row->user) {
                        $assigned_to = User::where('user_id', $row->user)->first();
                        $assigned_to = 'Assigned To: '.$assigned_to->user_name;
                    }
                    $issue = '<p title="'.$assigned_to.'">'.$row->issue.'</p>';
                    return $issue;
                })
                ->addColumn('issue_date', function($row){
                    $issue_date = date('d-M-Y', strtotime($row->issue_date));
                    return $issue_date;
                })
                ->addColumn('status', function($row){
                    if ($row->status==0) {
                        $ass_text = '<span style="background-color: #f6f6ad !important;padding: .5rem .6rem; border-radius: 6px;">Open/Unassigned</span>';
                        if ($row->user) {
                            $ass_text = '<span style="background-color: #f6f6ad !important;padding: .5rem .6rem; border-radius: 6px;">Open/Assigned&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                            $assigned_to = User::where('user_id', $row->user)->first();
                            $assigned_to = $assigned_to->user_name;
                        }
                        $text = $ass_text;
                    } else if ($row->status == 1) {
                        $text = '<span style="background-color: #f49b42 !important;padding: .5rem .6rem; border-radius: 6px;">Done&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                    } else if ($row->status == 2) {
                        $text = '<span style="background-color: #42f45f !important;padding: .5rem .6rem; border-radius: 6px;">Closed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                    } else if ($row->status == 3) {
                        $text = '<span style="background-color: #7d998b !important;padding: .5rem .6rem; border-radius: 6px;">Not An Issue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                    } else if ($row->status == 4) {
                        $text = '<span style="background-color: #42ebf4 !important;padding: .5rem .6rem; border-radius: 6px;">Requires Approval</span>';
                    } else if ($row->status == 5) {
                        $text = '<span style="background-color: #9C4646 !important;padding: .5rem .6rem; border-radius: 6px;">Not Applicable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                    }
                    return $text;
                })
                ->rawColumns(['action', 'issue', 'status'])
                ->make(true);
        }
    }

    public function viewIncident(Request $request)
    {
        $incident = Incident::where('token', $request->token)->first();
        $movements = DB::table('movement')->where('incident_token', $incident->token)
                    ->join('user', 'user.user_id', '=', 'movement.done_by')->get();
        $facility = Facility::where('code', $incident->facility)->first();
        $incident->fac = $facility->name;
        $incident->issue_reported_on = date('d-m-Y', strtotime($incident->issue_reported_on));
        $assigned_to = User::where('user_id', $incident->user)->get();
        $logged_by = User::where('user_id', $incident->support_officer)->get();
        $incident->logged_by = $logged_by[0]->user_name;
        if (count($assigned_to)) {
            $incident->assigned_to = $assigned_to[0]->user_name;
        } else {
            $incident->assigned_to = 'No One';
        }
        $latest_stage = $movements[count($movements)-1]->stage;
        $stage_info = getIncidentStageInfo($latest_stage);
        $stage_info = explode(',', $stage_info);

        $comments = DB::table('comments')->where('incident_token', $incident->token)
                    ->join('user', 'user.user_id', '=', 'comments.user')->get();

        $medias = DB::table('media')->where('incident_token', $incident->token)
                    ->join('user', 'user.user_id', '=', 'media.user')->get();

        $incident->stages = $stage_info;


        return view('eclinic.view')->with('incident', $incident)->with('movements', $movements)->with('medias', $medias)
        ->with('comments', $comments);
    }

    public function logMovement($data) {
        $mv = DB::table('movement')->insert($data);
        if ($mv) {
            return true;
        }
    }
}
