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
            $data = Incident::whereBetween('issue_date', [$this->month_first_date,$this->month_last_date])->get();
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "
                    <div class='dropdown'>
                        <button class='btn btn-xs btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Action
                        </button>
                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                            <a class='dropdown-item' href='#'>Done</a>
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
}
