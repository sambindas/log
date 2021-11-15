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


class AuditController extends Controller
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
        return view ('smarthealth.audit', compact('roles', 'devusers', 'supportusers'));
    }
}
