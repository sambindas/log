@extends('layouts.index')

@section('title', 'Home')
@section('pagecss')
<link rel="stylesheet" href="{{asset('assets/css/incident.css')}}">
@endsection
@section('body')
    <main>
        @include('layouts.nav')

        <div class="container">
            <p class="title">Incident Log</p>
            <div class="cover">

                <div class="top">
                    <div class="smallNav">
                        <div class="active eachSmall">
                            <p>Overview</p>
                            <div class="line"></div>
                        </div>
                        <div class="eachSmall">
                            <p><a href="{{route('incidents')}}">All Incidents</a></p>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="hrline"></div>
                <div class="contain openingDiv">
                    <div class="overview">
                        <div class="selectTop">
                            <select name="" id="">
                                <option value="">Last 30 days</option>
                            </select>
                        </div>
                        <div class="reportDiv">
                            <div class="eachReport blue">
                                <p class="topic">TOTAL Incidents LOGGED</p>
                                <div class="perc">
                                    <p class="num">90</p>
                                    <p class="tage positive">
                                        +12%
                                    </p>
                                </div>
                            </div>
                            <div class="eachReport yellow">
                                <p class="topic">TOTAL Incidents OPEN</p>
                                <div class="perc">
                                    <p class="num">90</p>
                                    <p class="tage negative">
                                        -2%
                                    </p>
                                </div>
                            </div>
                            <div class="eachReport green">
                                <p class="topic">TOTAL Incidents RESOLVED</p>
                                <div class="perc">
                                    <p class="num">90</p>
                                    <p class="tage positive">
                                        +12%
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="piePart">
                            <div class="eachPie">
                                <div class="firstFlex">
                                    <p>INCIDENT REPORTER STATS</p>
                                    <select name="" id="">
                                        <option value="">All</option>
                                    </select>
                                </div>
                                <img src="{{asset('assets/images/pie.svg')}}" alt="icon">
                            </div>

                            <div class="eachPie">
                                <div class="firstFlex">
                                    <p>INCIDENT REPORTER STATS</p>
                                    <select name="" id="">
                                        <option value="">All</option>
                                    </select>
                                </div>
                                <img src="{{asset('assets/images/pie.svg')}}" alt="icon">
                            </div>
                           
                        </div>

                    </div>
                   
                </div>
            </div>
        </div>
    </main>
@endsection
@section('pagejs')
<script src="{{asset('assets/scripts/incident.js')}}"></script>
@endsection