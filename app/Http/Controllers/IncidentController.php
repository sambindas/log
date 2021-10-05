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
use App\Models\Incident;
use App\Models\Facility;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\SmarthealthHttpException;
use Yajra\DataTables\DataTables;


class IncidentController extends Controller
{
    public function __construct()
    {
        $this->today = date('Y-m-d');
        $this->month_first_date = date('Y-m-d',strtotime('first day of this month'));
        $this->month_last_date = date('Y-m-d',strtotime('last day of this month'));
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
                    $not_an_issue_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $confirmed_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $approval_required_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $incomplete_information_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $not_clear_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $not_approved_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $reopen_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $view_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $done_btn = '<a class="dropdown-item" href="#">Done</a>';
                    $done_btn = '<a class="dropdown-item" href="#">Done</a>';

                    $done_btn = '<a class="dropdown-item" href="#">Done</a>';

                    $actionBtn = "
                    <div class='dropdown'>
                        <button class='btn dropdown-toggle' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Action
                        </button>
                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                            ".$done_btn."
                        </div>
                    </div>";
                    //$actionBtn = '<span class="fas fa-ellipsis-h"></span>';
                    return $actionBtn;
                })
                ->addColumn('issue', function($row){
                    $issue = '<p title="Assigned To: '.$row->user.'">'.$row->issue.'</p>';
                    return $issue;
                })
                ->addColumn('issue_date', function($row){
                    $issue_date = date('d-M-Y', strtotime($row->issue_date));
                    return $issue_date;
                })
                ->rawColumns(['action', 'issue'])
                ->make(true);
        }
    }

    public function new()
    {
        $facilities = Facility::all();
        $users = User::all();
        return view('incident.adit', compact('facilities', 'users'));
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
        if ($data['assign']) {
            $data['status'] = 8;
        } else {
            $data['status'] = 0;
        }
        if($user->state_id) {
            $data['state_id'] = $user->state_id;
        }

        $data['type'] = $user->user_type;
        $data['month'] = date('M Y');

        $details = DB::table('product_details')->where('item', $data['item'])->where('category', $data['category'])->pluck('priority', 'level');
        if (!empty($details)) {
            foreach($details as $k => $detail) {
                $data['priority'] = $detail;
                $data['issue_level'] = $k;
            }
        } else {
            $data['priority'] = 'Medium';
            $data['issue_level'] = 1;
        }
        $data['issue_date'] = date('Y-m-d');
        $create = Incident::create($data);
        if ($create) {
            $msg = 'Saved Successfully, you will be redirected...';
        }

        return $msg;
    }
}
