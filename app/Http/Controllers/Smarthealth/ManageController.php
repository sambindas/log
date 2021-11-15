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
        $segments = ['General', 'Accounts & Profile', 'Medical Services', 'Payments & Billing', 'Medical Records', 'Appointments'];
        $devusers = User::where('user_role', 'Developer')->orderBy('user_name', 'asc')->get();
        $supportusers = User::where('user_role', 'Support Officer')->orderBy('user_name', 'asc')->get();
        return view ('smarthealth.manage', compact('segments', 'devusers', 'supportusers'));
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

        $data['issue_level'] = 1;
        $issue_date = date('Y-m-d H:i:s');
        $data['issue_date'] = $issue_date;
        $create = DB::table('issue')->insertGetId($data);
        $msg='testt';
        if ($create) {
            $status_code=200;
            $movement = array(
                'movement'=>'Incident Submitted',
                'done_by'=>$user->user_id,
                'incident_token'=>$token,
                'done_at'=>$issue_date,
                'stage'=>0,
            );
            $this->logMovement($movement);
            $sendEmailToDev = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>$data['issue']]);
            $sendEmailToClient=false;
            if($notify_client == 'on') {
                $sendEmailToClient = sendEmail(['email'=>$data['client_email'], 'message'=>'An Issue has been logged on your behalf. <br>
                '.$data['issue']]);
            }
            if($sendEmailToClient) {
                Incident::where('issue_id', $create)->update(['email_to_client'=>1]);
            }
            
            $msg = 'Saved Successfully, you will be redirected...';
        } else {
            $status_code = 401;
            $msg = "Incident not save, an error occured.";
        }
        return response()->json(['status'=>$status_code, 'message'=>$msg], $status_code);
    }

    public function getIncidents(Request $request)
    {
        if ($request->ajax()) {
            //dd($request);
            //DB::connection()->enableQueryLog();
            $data = Incident::whereBetween('issue_date', [$this->month_first_date,$this->month_last_date])->orderBy('issue_id', 'desc')->get();
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
                    return $actionBtn;
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
}
