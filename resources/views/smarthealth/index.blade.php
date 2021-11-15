@extends('layouts.smarthealth-index')

@section('title', 'Home')
@section('active', 'active')
@section('pagecss')

@endsection
@section('body')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 font-weight-bold brand-color f24">Overview</h1>
    </div>

    <section class="p-5 bg-white mb-4">

        <div class="form-group">
            <span class="brand-color f16 mr-3 mb-5">Period</span>
            <label for="id_label_single">
                    
                <select class="js-example-basic-single assign_to_select js-states form-control" id="id_label_single">
                    <option value="AL">Last Month</option>
                </select>
            </label>
        </div>

        <hr class="w-100 brand-color mb-5" />

            <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-top-primary shadow-sm h-100 py-0">
                    <div class="card-body p-3">

                        <div class="row no-gutters align-items-center">

                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold neutral-color text-uppercase mb-1">
                                    TOTAL INCIDENTS LOGGED
                                </div>
                            </div>

                        </div>

                        <div class="row mt-2">
                                
                            <div class="h5 mb-0 font-weight-bold brand-color col-lg f24">59</div>

                            <div class="col-lg text-right active-green f14 mt-2">
                                +12%
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-top-warning shadow-sm h-100 py-0">
                    <div class="card-body">

                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold neutral-color text-uppercase mb-1">
                                    TOTAL INCIDENTS OPEN
                                </div>
                            </div>

                        </div>

                        <div class="row mt-2">
                                
                            <div class="h5 mb-0 font-weight-bold brand-color col-lg f24">89</div>

                            <div class="col-lg text-right active-red f14 mt-2">
                                -2%
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-top-success shadow-sm h-100 py-0">
                    <div class="card-body">

                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold neutral-color text-uppercase mb-1">
                                    TOTAL INCIDENTS RESOLVED</div>
                            </div>
                            
                        </div>

                        <div class="row mt-2">
                                
                            <div class="h5 mb-0 font-weight-bold brand-color col-lg f24">11</div>

                            <div class="col-lg text-right active-red f14 mt-2">
                                -2%
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-2 col-lg-5 pt-5 pl-3">
                <div class="card mb-4">
                    <!-- Card Header - Dropdown -->

                    <div class="mb-3">
                        <h6 class="font-weight-bold lh26">
                            INCIDENTS LOGGED PER CATEGORY
                        </h6>
                    </div>

                    <div class="mb-3">
                        <h4 class="font-weight-bold f24">14</h4>
                    </div>

                    <div class="mb-3">
                        <h4 class="font-weight-bold text-success f16">+12%</h4>
                    </div>

                </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-10 col-lg-7">
                <!-- Bar Chart -->
                <div class="card mb-4">
                    
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="myBarChart"></canvas>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>

        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="card mb-4">
                    <div class="card shadow-sm mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold neutral-color f16">INCIDENT REPORTER STATS</h6>
                            <div class="dropdown">
                                <a class="dropdown-toggle neutral-color f14" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Direct
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Social
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> Referral
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="card mb-4">
                    <div class="card shadow-sm mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold neutral-color f16">INCIDENT REPORTER STATS</h6>
                            <div class="dropdown">
                                <a class="dropdown-toggle neutral-color f14" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart2"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Direct
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Social
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> Referral
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection
@section('pagejs')

@endsection