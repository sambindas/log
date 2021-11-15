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


class IndexController extends Controller
{
    public function __construct()
    {
        $this->today = date('Y-m-d');
        $this->month_first_date = date('Y-m-d',strtotime('first day of this month'));
        $this->month_last_date = date('Y-m-d',strtotime('last day of this month'));
    }

    public function index()
    {
        $roles = ['Developer', 'Support Officer'];
        $devusers = User::where('user_role', 'Developer')->orderBy('user_name', 'asc')->get();
        $supportusers = User::where('user_role', 'Support Officer')->orderBy('user_name', 'asc')->get();
        return view ('smarthealth.index', compact('roles', 'devusers', 'supportusers'));
    }

    public function incidents()
    {
        $roles = ['Developer', 'Support Officer'];
        $devusers = User::where('user_role', 'Developer')->orderBy('user_name', 'asc')->get();
        $supportusers = User::where('user_role', 'Support Officer')->orderBy('user_name', 'asc')->get();
        return view ('smarthealth.manage', compact('roles', 'devusers', 'supportusers'));
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

    public function new()
    {
        $facilities = Facility::all();
        $users = User::all();
        return view('eclinic.adit', compact('facilities', 'users'));
    }

    public function filters(Request $request)
    {
        if ($request->action == 'category') {
            $details = DB::table('product_details')->where('category', $request->category)
            ->where('product', 'like', '%eclinic%')->where('product', 'like', '%ebiller%')->groupBy('module')->get();

            $return = '<option value="">Select Module</option>';
            
            foreach($details as $detail) {
                $return .= '<option value="'.$detail->module.'">'.$detail->module.'</option>';
            }
        } else if ($request->action == 'module') {
            if ($request->category=='Hardware Requests' || $request->category=='Hardware Issues') {
                $details = DB::table('items')->pluck('item_name');

                $return = '<option value="">Select Item</option>';
                
                foreach($details as $detail) {
                    $return .= '<option value="'.$detail.'">'.$detail.'</option>';
                }
            } else {
                $details = DB::table('product_details')->where('category', $request->category)->where('module', $request->module)
                ->where('product', 'like', '%eclinic%')->where('product', 'like', '%ebiller%')->get();

                $return = '<option value="">Select Submodule</option>';
                
                foreach($details as $detail) {
                    $return .= '<option value="'.$detail->item.'">'.$detail->item.'</option>';
                }
            }
            
        }
        return $return;
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
        $itype = explode(' ', $data['category']);
        $data['issue_type'] = $itype[1];

        $data['type'] = $user->user_type;
        $data['month'] = date('M Y');
        $token = generateToken('ecl', 5);
        $data['token'] = $token;

        $data['priority'] = 'Medium';
        $data['issue_level'] = 1;

        $details = DB::table('product_details')->where('item', $data['item'])->where('category', $data['category'])->pluck('priority', 'level');
        if (!empty($details)) {
            foreach($details as $k => $detail) {
                $data['priority'] = $detail;
                $data['issue_level'] = $k;
            }
        }

        if ($request->media) {
            $this->validate($request, [
                'media' => 'required|image|mimes:jpeg,png,jpg|max:1000000'
            ]);

            $image = $request->file('media');
            $new_name = $token.'-'.rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/media'), $new_name);

            $media_array = array(
                'incident_token' => $token,
                'user' => $user->user_id,
                'media_name' => $new_name,
                'caption' => 'Initial Media',
                'date_added' => date('d-m-Y H:i:s')
            );

            $insert_media = DB::table('media')->insert($media_array);
        }
        $issue_date = date('Y-m-d H:i:s');
        $data['issue_date'] = $issue_date;
        $create = Incident::create($data);
        if ($create) {
            $movement = array(
                'movement'=>'Incident Submitted',
                'done_by'=>$user->user_id,
                'incident_token'=>$token,
                'done_at'=>$issue_date,
                'stage'=>0,
            );
            $this->logMovement($movement);
            $sendEmail = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>$data['issue']]);
            $msg = 'Saved Successfully, you will be redirected...';
        }
        if ($sendEmail) {
            return $msg;
        }
    }

    public function actionIncident(Request $request) {
        $user = currentUser();
        $data = sanitizeInput($request->except(Consts::CSRF));
        $incident = Incident::where('token', $data['token'])->first();
        if ($data['submit'] == 'done') {
            $update_incident = [
                'resolution_date' => date('d-m-Y H:i:s'),
                'resolved_by' => $user->user_id,
                'status' => 1
            ];

            $update_i = Incident::where('token', $data['token'])->update($update_incident);

            if ($update_i) {
                $this->doCommentMovement($data, 'Incident Done', 0, 1);
                $sendEmail = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>'Incident '.$incident->issue_id.' Marked As Done']);
                $msg = 'Incident Done, you will be redirected...';
            }
            if ($sendEmail) {
                return $msg;
            }
        } else if ($data['submit'] == 'reopen') {
            $update_incident = [
                'status' => 0
            ];

            $update_i = Incident::where('token', $data['token'])->update($update_incident);

            if ($update_i) {
                $this->doCommentMovement($data, 'Incident Reopened', 0, 0);
                $sendEmail = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>'Incident '.$incident->issue_id.' Reopened']);
                $msg = 'Incident Reopened, you will be redirected...';
                if ($sendEmail) {
                    return $msg;
                } else {
                    return $msg; //just for now
                }
            }
            if ($sendEmail) {
                return $msg;
            }
        } else if ($data['submit'] == 'confirmed') {
            $update_incident = [
                'status' => 2,
                'info_relayed_to' => $data['info_relayed_to'],
                'info_medium' => $data['info_medium'],
                'confirmed_date' => date('d-m-Y H:i:s'),
            ];

            $update_i = Incident::where('token', $data['token'])->update($update_incident);

            if ($update_i) {
                $this->doCommentMovement($data, 'Incident Confirmed', 2, 2);
                $msg = 'Incident Confirmed, you will be redirected...';
                return $msg;
            } else {
                return 'Couldnt save, an error occured';
            }
        } else if ($data['submit'] == 'not_an_issue') {
            $update_incident = [
                'status' => 3,
                'resolved_by'=>$user->user_id,
                'resolution_date' => date('d-m-Y H:i:s'),
            ];

            $update_i = Incident::where('token', $data['token'])->update($update_incident);

            if ($update_i) {
                $this->doCommentMovement($data, 'Incident Not An Issue', 3, 3);
                $msg = 'Incident Marked Non-issue, you will be redirected...';
                $sendEmail = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>'Incident '.$incident->issue_id.' Not An Issue']);
                if ($sendEmail) {
                    return $msg;
                } else {
                    return $msg; //just for now
                }
            } else {
                return 'Couldnt save, an error occured';
            }
        } else if ($data['submit'] == 'not_applicable') {
            $update_incident = [
                'status' => 5,
            ];

            $update_i = Incident::where('token', $data['token'])->update($update_incident);

            if ($update_i) {
                $this->doCommentMovement($data, 'Incident Marked Not Applicable', 5, 5);
                $msg = 'Incident Marked Not Applicable, you will be redirected...';
                $sendEmail = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>'Incident '.$incident->issue_id.' Not Applicable']);
                if ($sendEmail) {
                    return $msg;
                } else {
                    return $msg; //just for now
                }
            } else {
                return 'Couldnt save, an error occured';
            }
        } else if ($data['submit'] == 'requires_approval') {
            $update_incident = [
                'status' => 4,
            ];

            $update_i = Incident::where('token', $data['token'])->update($update_incident);

            if ($update_i) {
                $this->doCommentMovement($data, 'Incident Marked for Approval', 4, 4);
                $msg = 'Incident Marked Requires Approval, you will be redirected...';
                $sendEmail = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>'Incident '.$incident->issue_id.' Requires Approval']);
                if ($sendEmail) {
                    return $msg;
                } else {
                    return $msg; //just for now
                }
            } else {
                return 'Couldnt save, an error occured';
            }
        } else if ($data['submit'] == 'close') {
            $update_incident = [
                'status' => 2,
            ];

            $update_i = Incident::where('token', $data['token'])->update($update_incident);

            if ($update_i) {
                $this->doCommentMovement($data, 'Incident Closed', 2, 2);
                $msg = 'Incident Marked and has been closed, you will be redirected...';
                $sendEmail = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>'Incident '.$incident->issue_id.' Closed']);
                if ($sendEmail) {
                    return $msg;
                } else {
                    return $msg; //just for now
                }
            } else {
                return 'Couldnt save, an error occured';
            }
        } else if ($data['submit'] == 'incomplete') {
            $update_incident = [
                'status' => 0
            ];

            $update_i = Incident::where('token', $data['token'])->update($update_incident);

            if ($update_i) {
                $this->doCommentMovement($data, 'Incident Resolution Incomplete', 8, 0);
                $sendEmail = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>'Incident '.$incident->issue_id.' Resolution Incomplete']);
                $msg = 'Incident Marked Incomplete and has been reopened, you will be redirected...';
                if ($sendEmail) {
                    return $msg;
                } else {
                    return $msg; //just for now
                }
            }
            if ($sendEmail) {
                return $msg;
            }
        } else if ($data['submit'] == 'assign') {
            if ($data['role'] == 'Developer') {
                $update_incident = [
                    'user' => $data['dev_assignee']
                ];
            } else {
                $update_incident = [
                    'user' => $data['sup_assignee']
                ];
            }
            $data['comment'] = '303223144730418620862468159149';

            $update_i = Incident::where('token', $data['token'])->update($update_incident);

            if ($update_i) {
                $this->doCommentMovement($data, 'Incident Reassigned', 0, (int)$incident->status);
                $sendEmail = sendEmail(['email'=>'bindas.fs@gmail.com', 'message'=>'Incident '.$incident->issue_id.' Reassigned']);
                $msg = 'Incident Reassigned successfully, you will be redirected...';
                if ($sendEmail) {
                    return $msg;
                } else {
                    return $msg; //just for now
                }
            }
            if ($sendEmail) {
                return $msg;
            }
        } 
    }

    public function addComment(Request $request) {
        $data = sanitizeInput($request->except(Consts::CSRF));
        $user = currentUser();
        $comment = [
            'comment'=>$data['comment'],
            'user'=>$user->user_id,
            'incident_token'=>$data['incident_token'],
            'done_at'=>date('d-m-Y H:i:s'),
            'status'=>100,
        ];
        if ($this->logComments($comment)) {
            $comments = DB::table('comments')->where('incident_token', $data['incident_token'])
                    ->join('user', 'user.user_id', '=', 'comments.user')->get();
            $comm = '';
            foreach ($comments as $comment) {
                $comm .= '<div class="eachComment">
                            <p class="text">
                                '.$comment->comment.'
                            </p>
                            <div class="about">
                                <span class="abb">
                                    D
                                </span>
                                <p class="by">
                                    '.$comment->user_name.'
                                </p>
                                <p class="date">
                                    '.$comment->done_at.'  
                                </p>
                            </div>
                        </div>';
            }
            return $comm;
        }
    }

    public function logMovement($data) {
        $mv = DB::table('movement')->insert($data);
        if ($mv) {
            return true;
        }
    }

    public function logComments($data) {
        $cm = DB::table('comments')->insert($data);
        if ($cm) {
            return true;
        }
    }

    public function doCommentMovement($data, $topic, $status, $stage) 
    {
        $user = currentUser();
        if ($data['comment'] != '') {
            $comment = [
                'comment'=>$data['comment'],
                'user'=>$user->user_id,
                'incident_token'=>$data['token'],
                'done_at'=>date('d-m-Y H:i:s'),
                'status'=>$status,
            ];

            $this->logComments($comment);
        }
        $movement = array(
            'movement'=>$topic,
            'done_by'=>$user->user_id,
            'incident_token'=>$data['token'],
            'done_at'=>date('d-m-Y H:i:s'),
            'stage'=>$stage,
        );

        $this->logMovement($movement);
    }
}
