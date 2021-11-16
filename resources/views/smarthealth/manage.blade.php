<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smarthealth | Incidents</title>

    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" href="{{asset('assets/images/logo.svg')}}" type="image/x-icon" />
    <link href="{{asset('smarthealth/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('smarthealth/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('smarthealth/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('smarthealth/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.bootstrap4.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar 1 -->
        <ul class="navbar-nav bg-gradient-white sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center mb-5" href="index.html">
                
                <div class="sidebar-brand-text mx-3">
                    <img class="navbar-brand-img brand_img" style="width: 113px;" src="{{asset('smarthealth/img/eclat_logo.png')}}" alt="..." />
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Overview -->
            <li class="nav-item px-lg-4">
                <a class="nav-link neutral-color" href="{{route('smarthealth/index')}}">
                    <i class="bi bi-list brand-color f16"></i>
                    <span class="f14">Overview</span>
                </a>
            </li>

             <!-- Nav Item - Manage -->
            <li class="nav-item active px-lg-4">
                <a class="nav-link brand-color" href="#!">
                    <i class="bi bi-folder neutral-color f16"></i>
                    <span class="f14">Manage</span>
                </a>
            </li>

             <!-- Nav Item - Dashboard -->
            <li class="nav-item px-lg-4">
                <a class="nav-link neutral-color" href="index.html">
                    <i class="bi bi-book neutral-color f16"></i>
                    <span class="f14">Activity Log</span>
                </a>
            </li>

            <li class="nav-item px-lg-4">
                <a class="nav-link neutral-color" href="{{route('smarthealth/audit')}}">
                    <i class="bi bi-card-text neutral-color f16"></i>
                    <span class="f14">Audit</span>
                </a>
            </li>

        </ul>
        
        <!-- End of Sidebar1 -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <section class="row">
                <div class="col-lg-3">

                    <!-- Sidebar 2 -->
                    <div class="navbar-nav bg-white sidebar sidebar-dark accordion ml-2 w-100" id="accordionSidebar2">
                        <div class="sub-title py-5 px-4 mt-4">
                            <h3 class="f24 brand-color font-weight-bold">Manage</h3>
                        </div>

                        <ul class="nav nav-tabs flex-column" role="tablist">

                             <!-- Nav Item - Overview -->
                            <li class="nav-item text-dark pl-1 pr-lg-0">
                                <a class="nav-link text-dark active d-flex w-100" onclick="doRunTable('general')" data-toggle="tab" href="#general" role="tab">
                                    <span class="col-lg-7 pl-0 f14 brand-color">General</span>

                                    <span class="col-lg-4 px-0">
                                        <span class="mt-n1 ms-2 badge f12 pill-warning p-1 rounded-pill pill-bg-warning px-2">
                                            6 issues
                                        </span>
                                    </span>

                                    <span class="col-lg-1">
                                        <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.49994 10.9999C1.36833 11.0007 1.23787 10.9755 1.11603 10.9257C0.994195 10.8759 0.883379 10.8026 0.789939 10.7099C0.696211 10.617 0.621816 10.5064 0.571048 10.3845C0.520279 10.2626 0.494141 10.1319 0.494141 9.99993C0.494141 9.86792 0.520279 9.73721 0.571048 9.61535C0.621816 9.49349 0.696211 9.38289 0.789939 9.28993L4.09994 5.99993L0.919939 2.68993C0.733688 2.50257 0.629147 2.24911 0.629147 1.98493C0.629147 1.72074 0.733688 1.46729 0.919939 1.27993C1.0129 1.1862 1.1235 1.11181 1.24536 1.06104C1.36722 1.01027 1.49793 0.984131 1.62994 0.984131C1.76195 0.984131 1.89266 1.01027 2.01452 1.06104C2.13638 1.11181 2.24698 1.1862 2.33994 1.27993L6.19994 5.27993C6.38317 5.46686 6.4858 5.71818 6.4858 5.97993C6.4858 6.24168 6.38317 6.493 6.19994 6.67993L2.19994 10.6799C2.11018 10.7769 2.00211 10.855 1.88196 10.91C1.76181 10.9649 1.63197 10.9955 1.49994 10.9999Z" fill="#AAB7C6"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>

                            <hr class="w-100 my-0">

                            <li class="nav-item text-dark pl-1 pr-lg-0">
                                <a class="nav-link text-dark d-flex w-100" onclick="doRunTable('accounts')" data-toggle="tab" href="#accounts" role="tab">
                                    <span class="col-lg-7 pl-0 f12 brand-color">Accounts & profile</span>

                                    <span class="col-lg-4 px-0">
                                        <span class="mt-n1 ms-2 badge f12 pill-warning p-1 rounded-pill pill-bg-warning px-2">
                                            6 issues
                                        </span>
                                    </span>

                                    <span class="col-lg-1">
                                        <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.49994 10.9999C1.36833 11.0007 1.23787 10.9755 1.11603 10.9257C0.994195 10.8759 0.883379 10.8026 0.789939 10.7099C0.696211 10.617 0.621816 10.5064 0.571048 10.3845C0.520279 10.2626 0.494141 10.1319 0.494141 9.99993C0.494141 9.86792 0.520279 9.73721 0.571048 9.61535C0.621816 9.49349 0.696211 9.38289 0.789939 9.28993L4.09994 5.99993L0.919939 2.68993C0.733688 2.50257 0.629147 2.24911 0.629147 1.98493C0.629147 1.72074 0.733688 1.46729 0.919939 1.27993C1.0129 1.1862 1.1235 1.11181 1.24536 1.06104C1.36722 1.01027 1.49793 0.984131 1.62994 0.984131C1.76195 0.984131 1.89266 1.01027 2.01452 1.06104C2.13638 1.11181 2.24698 1.1862 2.33994 1.27993L6.19994 5.27993C6.38317 5.46686 6.4858 5.71818 6.4858 5.97993C6.4858 6.24168 6.38317 6.493 6.19994 6.67993L2.19994 10.6799C2.11018 10.7769 2.00211 10.855 1.88196 10.91C1.76181 10.9649 1.63197 10.9955 1.49994 10.9999Z" fill="#AAB7C6"/>
                                        </svg>
                                    </span>
                                </a>
                            </li>

                            <hr class="w-100 my-0">
                
                            <!-- Nav Item - Dashboard -->
                            <li class="nav-item text-dark pl-1 pr-lg-0">

                                <a class="nav-link text-dark d-flex w-100" onclick="doRunTable('med_s')" data-toggle="tab" href="#medical_services" role="tab">
                                    <span class="col-lg-7 pl-0 f12 brand-sub-color">Medical services</span>

                                    <span class="col-lg-4 px-0">
                                        <span class="mt-n1 ms-2 badge f12 pill-warning p-1 rounded-pill pill-bg-warning px-2">
                                            6 issues
                                        </span>
                                    </span>

                                    <span class="col-lg-1">
                                        <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.49994 10.9999C1.36833 11.0007 1.23787 10.9755 1.11603 10.9257C0.994195 10.8759 0.883379 10.8026 0.789939 10.7099C0.696211 10.617 0.621816 10.5064 0.571048 10.3845C0.520279 10.2626 0.494141 10.1319 0.494141 9.99993C0.494141 9.86792 0.520279 9.73721 0.571048 9.61535C0.621816 9.49349 0.696211 9.38289 0.789939 9.28993L4.09994 5.99993L0.919939 2.68993C0.733688 2.50257 0.629147 2.24911 0.629147 1.98493C0.629147 1.72074 0.733688 1.46729 0.919939 1.27993C1.0129 1.1862 1.1235 1.11181 1.24536 1.06104C1.36722 1.01027 1.49793 0.984131 1.62994 0.984131C1.76195 0.984131 1.89266 1.01027 2.01452 1.06104C2.13638 1.11181 2.24698 1.1862 2.33994 1.27993L6.19994 5.27993C6.38317 5.46686 6.4858 5.71818 6.4858 5.97993C6.4858 6.24168 6.38317 6.493 6.19994 6.67993L2.19994 10.6799C2.11018 10.7769 2.00211 10.855 1.88196 10.91C1.76181 10.9649 1.63197 10.9955 1.49994 10.9999Z" fill="#AAB7C6"/>
                                        </svg>
                                    </span>
                                </a>

                            </li>

                            <hr class="w-100 my-0">
                
                            <li class="nav-item text-dark pl-1 pr-lg-0">
                            
                                <a class="nav-link text-dark d-flex w-100" onclick="doRunTable('payments')" data-toggle="tab" href="#payments_billing" role="tab">
                                    <span class="col-lg-7 pl-0 f12 brand-sub-color">Payments & billing</span>

                                    <span class="col-lg-4 px-0">
                                        <span class="mt-n1 ms-2 badge f12 pill-warning p-1 rounded-pill pill-bg-warning px-2">
                                            6 issues
                                        </span>
                                    </span>

                                    <span class="col-lg-1">
                                        <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.49994 10.9999C1.36833 11.0007 1.23787 10.9755 1.11603 10.9257C0.994195 10.8759 0.883379 10.8026 0.789939 10.7099C0.696211 10.617 0.621816 10.5064 0.571048 10.3845C0.520279 10.2626 0.494141 10.1319 0.494141 9.99993C0.494141 9.86792 0.520279 9.73721 0.571048 9.61535C0.621816 9.49349 0.696211 9.38289 0.789939 9.28993L4.09994 5.99993L0.919939 2.68993C0.733688 2.50257 0.629147 2.24911 0.629147 1.98493C0.629147 1.72074 0.733688 1.46729 0.919939 1.27993C1.0129 1.1862 1.1235 1.11181 1.24536 1.06104C1.36722 1.01027 1.49793 0.984131 1.62994 0.984131C1.76195 0.984131 1.89266 1.01027 2.01452 1.06104C2.13638 1.11181 2.24698 1.1862 2.33994 1.27993L6.19994 5.27993C6.38317 5.46686 6.4858 5.71818 6.4858 5.97993C6.4858 6.24168 6.38317 6.493 6.19994 6.67993L2.19994 10.6799C2.11018 10.7769 2.00211 10.855 1.88196 10.91C1.76181 10.9649 1.63197 10.9955 1.49994 10.9999Z" fill="#AAB7C6"/>
                                        </svg>
                                    </span>
                                </a>

                            </li>

                            <hr class="w-100 my-0">

                            <li class="nav-item text-dark pl-1 pr-lg-0">

                                <a class="nav-link text-dark d-flex w-100" onclick="doRunTable('med_r')" data-toggle="tab" href="#medical_records" role="tab">
                                    <span class="col-lg-7 pl-0 f12 brand-sub-color">Medical records</span>

                                    <span class="col-lg-4 px-0">
                                        <span class="mt-n1 ms-2 badge f12 pill-warning p-1 rounded-pill pill-bg-warning px-2">
                                            6 issues
                                        </span>
                                    </span>

                                    <span class="col-lg-1">
                                        <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.49994 10.9999C1.36833 11.0007 1.23787 10.9755 1.11603 10.9257C0.994195 10.8759 0.883379 10.8026 0.789939 10.7099C0.696211 10.617 0.621816 10.5064 0.571048 10.3845C0.520279 10.2626 0.494141 10.1319 0.494141 9.99993C0.494141 9.86792 0.520279 9.73721 0.571048 9.61535C0.621816 9.49349 0.696211 9.38289 0.789939 9.28993L4.09994 5.99993L0.919939 2.68993C0.733688 2.50257 0.629147 2.24911 0.629147 1.98493C0.629147 1.72074 0.733688 1.46729 0.919939 1.27993C1.0129 1.1862 1.1235 1.11181 1.24536 1.06104C1.36722 1.01027 1.49793 0.984131 1.62994 0.984131C1.76195 0.984131 1.89266 1.01027 2.01452 1.06104C2.13638 1.11181 2.24698 1.1862 2.33994 1.27993L6.19994 5.27993C6.38317 5.46686 6.4858 5.71818 6.4858 5.97993C6.4858 6.24168 6.38317 6.493 6.19994 6.67993L2.19994 10.6799C2.11018 10.7769 2.00211 10.855 1.88196 10.91C1.76181 10.9649 1.63197 10.9955 1.49994 10.9999Z" fill="#AAB7C6"/>
                                        </svg>
                                    </span>
                                </a>

                            </li>

                            <hr class="w-100 my-0">

                            <li class="nav-item text-dark pl-1 pr-lg-0">

                                <a class="nav-link text-dark d-flex w-100" onclick="doRunTable('appointments')" data-toggle="tab" href="#appointments" role="tab">
                                    <span class="col-lg-7 pl-0 f12 brand-sub-color">Appointments</span>

                                    <span class="col-lg-4 px-0">
                                        <span class="mt-n1 ms-2 badge f12 pill-warning p-1 rounded-pill pill-bg-warning px-2">
                                            6 issues
                                        </span>
                                    </span>

                                    <span class="col-lg-1">
                                        <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.49994 10.9999C1.36833 11.0007 1.23787 10.9755 1.11603 10.9257C0.994195 10.8759 0.883379 10.8026 0.789939 10.7099C0.696211 10.617 0.621816 10.5064 0.571048 10.3845C0.520279 10.2626 0.494141 10.1319 0.494141 9.99993C0.494141 9.86792 0.520279 9.73721 0.571048 9.61535C0.621816 9.49349 0.696211 9.38289 0.789939 9.28993L4.09994 5.99993L0.919939 2.68993C0.733688 2.50257 0.629147 2.24911 0.629147 1.98493C0.629147 1.72074 0.733688 1.46729 0.919939 1.27993C1.0129 1.1862 1.1235 1.11181 1.24536 1.06104C1.36722 1.01027 1.49793 0.984131 1.62994 0.984131C1.76195 0.984131 1.89266 1.01027 2.01452 1.06104C2.13638 1.11181 2.24698 1.1862 2.33994 1.27993L6.19994 5.27993C6.38317 5.46686 6.4858 5.71818 6.4858 5.97993C6.4858 6.24168 6.38317 6.493 6.19994 6.67993L2.19994 10.6799C2.11018 10.7769 2.00211 10.855 1.88196 10.91C1.76181 10.9649 1.63197 10.9955 1.49994 10.9999Z" fill="#AAB7C6"/>
                                        </svg>
                                    </span>
                                </a>

                            </li>
    
                            <hr class="w-100 my-0">
                        </ul>

                    </div>

                </div>

                <div id="content" class="col-lg-9">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-inherit topbar mb-4 static-top">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
    
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
    
                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
    
                                </div>
                            </li>
    
                            <li class="nav-item">
                                <div class="nav-link text-dark">
                                    <span class="brand-color f16 mb-1">State</span>
    
                                    <label for="id_label_single">
                                        
                                        <select class="js-example-basic-single assign_to_select js-states form-control border-0" id="id_label_single" style="background-color: inherit; color: #0275D8;">
                                            <option value="AL">Lagos</option>
                                            <option value="WY">Sokoto</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
    
                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link text-dark dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-question-circle"></i>
                                </a>
                               
                            </li>
    
                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link text-dark dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-bell"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">3</span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="bi bi-person-circle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                        </div>
                                    </a>                               
                                </div>
                            </li>
    
                            <div class="topbar-divider d-none d-sm-block"></div>
    
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                    <img class="img-profile rounded-circle"
                                        src="{{asset('smarthealth/img/undraw_profile.svg')}}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person mr-2"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-gear mr-2"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-list mr-2"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="bi bi-box-arrow-left mr-2"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
    
                        </ul>
    
                    </nav>
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid pl-1 tab-content">

                        <section class="tab-pane active" id="general" role="tabpanel">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">General</h1>
                                <h1 class="h3 mb-0 text-gray-800">
                                    <button type="button" class="btn btn-primary px-4 f14" data-toggle="modal" data-target="#modal-fullscreen-xl">Log New Incident</button>
                                </h1>
                            </div>

                            <section class="p-5 bg-white rounded">
                                @include('smarthealth.filters')
                            
                            <!-- Content Row -->
                                <div class="row">
                                    <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer w-100">
                                        <table class="table" id="general_table">
                                            @include('smarthealth.table-include')
                                        </table>
                                    </div>
                                </div>
        
                            </section>
                        </section>

                        <section class="tab-pane" id="accounts" role="tabpanel">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Accounts & Profile</h1>
                                <h1 class="h3 mb-0 text-gray-800">
                                    <button type="button" class="btn btn-primary px-4 f14" data-toggle="modal" data-target="#modal-fullscreen-xl">Log New Incident</button>
                                </h1>
                            </div>

                            <section class="p-5 bg-white rounded">
                                @include('smarthealth.filters')
                            
                            <!-- Content Row -->
                                <div class="row">
                                    <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer w-100">
                                        <table class="table" id="accounts_table">
                                            @include('smarthealth.table-include')
                                        </table>
                                    </div>
                                </div>
        
                            </section>
                        </section>

                        <section class="tab-pane" id="medical_services" role="tabpanel">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Medical Services</h1>
                                <h1 class="h3 mb-0 text-gray-800">
                                    <button type="button" class="btn btn-primary px-4 f14" data-toggle="modal" data-target="#modal-fullscreen-xl">Log New Incident</button>
                                </h1>
                            </div>

                            <section class="p-5 bg-white rounded">
                                @include('smarthealth.filters')
                            
                            <!-- Content Row -->
                                <div class="row">
                                    <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer w-100">
                                        <table class="table" id="med_s_table">
                                            @include('smarthealth.table-include')
                                        </table>
                                    </div>
                                </div>
        
                            </section>
                        </section>

                        <section class="tab-pane" id="payments_billing" role="tabpanel">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Payments & Billing</h1>
                                <h1 class="h3 mb-0 text-gray-800">
                                    <button type="button" class="btn btn-primary px-4 f14" data-toggle="modal" data-target="#modal-fullscreen-xl">Log New Incident</button>
                                </h1>
                            </div>

                            <section class="p-5 bg-white rounded">
                                @include('smarthealth.filters')
                            
                            <!-- Content Row -->
                                <div class="row">
                                    <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer w-100">
                                        <table class="table" id="payments_table">
                                            @include('smarthealth.table-include')
                                        </table>
                                    </div>
                                </div>
        
                            </section>
                        </section>

                        <section class="tab-pane" id="medical_records" role="tabpanel">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Medical Records</h1>
                                <h1 class="h3 mb-0 text-gray-800">
                                    <button type="button" class="btn btn-primary px-4 f14" data-toggle="modal" data-target="#modal-fullscreen-xl">Log New Incident</button>
                                </h1>
                            </div>

                            <section class="p-5 bg-white rounded">
                                @include('smarthealth.filters')
                            
                            <!-- Content Row -->
                                <div class="row">
                                    <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer w-100">
                                        <table class="table" id="med_r_table">
                                            @include('smarthealth.table-include')
                                        </table>
                                    </div>
                                </div>
        
                            </section>
                        </section>

                        <section class="tab-pane" id="appointments" role="tabpanel">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Appointments</h1>
                                <h1 class="h3 mb-0 text-gray-800">
                                    <button type="button" class="btn btn-primary px-4 f14" data-toggle="modal" data-target="#modal-fullscreen-xl">Log New Incident</button>
                                </h1>
                            </div>

                            <section class="p-5 bg-white rounded">
                                @include('smarthealth.filters')
                            
                            <!-- Content Row -->
                                <div class="row">
                                    <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer w-100">
                                        <table class="table" id="appointments_table">
                                            @include('smarthealth.table-include')
                                        </table>
                                    </div>
                                </div>
        
                            </section>
                        </section>
    
                    </div>
                    <!-- /.container-fluid -->
    
                </div>

                <!-- Modal -->
                <div class="modal_area">
                    <div class="modal fade" id="modal-fullscreen-xl"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                        <div class="modal-dialog modal-xl w-100" role="document">
                          <div class="modal-content px-5">

                            <div class="modal-header border-bottom-0 px-5 pt-5">
                                <h5 class="modal-title f24 brand-color1" id="staticBackdropLabel">Log New Incident</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                            <div class="modal-body px-5">
                                <form action="javascript:;" id="incident_form" enctype="multipart/form-data">

                                    <div class="form-row">
                                      <div class="form-group col-md-6">
                                        <label for="inputEmail4" class="mb-0 f12 brand-sub-color">Select incident category</label>

                                        <select name="category" class="custom-select neutral-bg h48">
                                            <option selected>Select category</option>
                                            @foreach($segments as $segment)
                                            <option value='{{$segment}}'>{{$segment}}</option>
                                            @endforeach
                                        </select>

                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="inputPassword4" class="mb-0 f12">User's email</label>
                                        <input name="client_email" type="email" class="form-control neutral-bg f14 h48" id="inputPassword4">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="mb-0 f12">Incident description</label>
                                        <textarea name="issue" class="form-control neutral-bg f14" id="exampleFormControlTextarea1" rows="5" placeholder="Write a description of the incident encountered here..."></textarea>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-lg">
                                            <label for="inputCity" class="mb-0 f12">Reporting client</label>
                                            <input name="issue_client_reporter" type="text" class="form-control neutral-bg f14 h48" id="inputCity" placeholder="Enter client's name">
                                        </div>

                                        <div class="form-group col-lg">
                                            <label for="inputZip" class="mb-0 f12">Incident report date</label>
                                            <input name="issue_reported_on" class="form-control neutral-bg f14 h48" type="date" id="date-from" placeholder="from" />
                                        </div>

                                        <div class="form-group col-lg">
                                            <label for="id_label_single" class="w-100">
                                                <span class="f12">Assign Incident</span> <span class="text-muted small">(Optional)</span>
                                                <select name="user" class="js-example-basic-single assign_to_select js-states form-control neutral-bg f14 h48" id="id_label_single">
                                                    @foreach($devusers as $devs)
                                                    <option value='{{$devs->user_id}}'>{{$devs->user_name}}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </div>

                                    </div>

                                    <div class="custom-control custom-switch">
                                        <input name="send_email" type="checkbox" class="custom-control-input f16" id="custom_switch2">
                                        <label class="custom-control-label neutral-color f14" for="custom_switch2">Update Client via email</label>
                                    </div>
                                    {{csrf_field()}}
                                    <div class="modal-footer border-top-0 px-5">
                                        <button type="submit" id="submit_button" class="btn brand-bg btn-block w-50 text-white f14">Log Incident</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>

                <!-- Alert -->
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-animation="true" data-autohide="false" style="position: absolute; top: 0; right: 0; z-index: 4555;">
                   
                    <div class="toast-body text-white rounded-left" style="background-color: #00425F;">
                        <span class="mr-4">Incident logged successfully.</span>
                        <span>
                            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </span>
                    </div>
                  </div>

            </section>

            <!-- Main Content -->
            
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="bi bi-arrow-90deg-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

+    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('smarthealth/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('smarthealth/js/sb-admin-2.js')}}"></script>
    <script>
        function doRunTable(id) {
            var tables = ['general', 'accounts', 'med_s', 'payments', 'med_r', 'appointments'];
            tables.splice( $.inArray(id, tables), 1 );
            // $.each(tables, function(i,v){
            //     console.log(v)
            //     $('#'+v+'_table').DaTaTable().destroy();
            // });
            run_table(id);
        }
        function run_table(id='general'){
            $.fn.dataTable.ext.errMode = 'none';
            $('#'+id+'_table').DataTable().destroy();
            var table = $('#'+id+'_table').DataTable({
                processing: true,
                serverSide: true,
                searchable: true,
                ordering: false,
                ajax: {
                    url: "{{ route('smarthealth.list') }}",
                    type: "get",
                    data: {id:id}
                },
                columns: [
                    {data: 'issue_id', name: 'issue_id'},
                    {data: 'facility', name: 'facility'},
                    {data: 'issue_type', name: 'issue_type'},
                    {data: 'issue', name: 'incident', searchable: true},
                    {data: 'status', name: 'status'},
                    
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: true
                    },
                ]
            }); 
        }
    </script>
    <script>
        $(document).ready(function() {
            run_table();
            $('#incident_form').on('submit', function (e) {
                e.preventDefault();
                $('#submit_button').prop('disabled', true).html("Submitting...");
                var URL = "{{url('/incident/incidents')}}";
                var data = new FormData(this);//$(this).serializeArray();

                $.ajax({
                    type: 'POST',
                    url: "{{url('/smarthealth/submit-incident')}}",
                    data: data, 
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response.status);
                        if(response.status===200){
                            $('#modal-fullscreen-xl').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $('.toast').toast('show');
                        }
                        $('#msg').html(response);
                        var delay = 3000; 
                        // setTimeout(function(){ window.location = URL; }, delay);
                    },
                });
            });
        });
    </script>

</body>

</html>