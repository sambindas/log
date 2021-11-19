<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="{{asset('assets/images/logo.svg')}}" type="image/x-icon" />

<title>Smarthealth | @yield('title')</title>

<!-- Custom fonts for this template-->
<link href="{{asset('smarthealth/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
@yield('pagecss')
<link href="{{asset('smarthealth/css/sb-admin-2.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

<!-- Bootstrap core JavaScript-->

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
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
            <li class="nav-item active px-lg-4">
                <a class="nav-link brand-color" href="{{route('smarthealth/index')}}">
                    <i class="bi bi-list brand-color f16"></i>
                    <span class="f14">Overview</span>
                </a>
            </li>

             <!-- Nav Item - Manage -->
            <li class="nav-item px-lg-4">
                <a class="nav-link neutral-color" href="{{route('smarthealth/manage')}}">
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
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

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
                                <span class="badge badge-danger badge-counter">.</span>
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
                @yield('body')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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
                    <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Page level custom scripts -->

    
    <!-- Core plugin JavaScript-->

    <script src="{{asset('smarthealth/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('smarthealth/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('smarthealth/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('smarthealth/js/sb-admin-2.js')}}"></script>
    
    <!-- Page level plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js"></script>
    <script src="{{asset('smarthealth/js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{asset('smarthealth/js/demo/chart-bar-demo.js')}}"></script>
    <script>
        $('.assign_to_select').select2({
            theme: "classic",
        });
    </script>
    @yield('pagejs')

</body>

</html>