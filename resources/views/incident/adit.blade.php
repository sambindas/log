@extends('layouts.index')

@section('title', 'All Incidents')
@section('pagecss')
<link rel="stylesheet" href="{{asset('assets/css/incident.css')}}">
@endsection
@section('body')
    <form action="">
        <p class="log">Log Incident</p>

        <div class="groupFlex">
            <div class="group">
                <label for="">Select incident category</label>
                <select name="" id="">
                    <option value="">Select Category</option>
                </select>
                <img src="{{asset('assets/images/selectdown.svg')}}" alt="icon">
            </div>

            <div class="group">
                <label for="">Select facility</label>
                <select name="" id="">
                    <option value="">Select facility</option>
                </select>
                <img src="{{asset('assets/images/selectdown.svg')}}" alt="icon">
            </div>
        </div>

        <div class="groupFlex">
            <div class="group">
                <label for="">Select module</label>
                <select name="" id="">
                    <option value="">Select module</option>
                </select>
                <img src="{{asset('assets/images/selectdown.svg')}}" alt="icon">
            </div>

            <div class="group">
                <label for="">Select item</label>
                <select name="" id="">
                    <option value="">Select item</option>
                </select>
                <img src="{{asset('assets/images/selectdown.svg')}}" alt="icon">
            </div>
        </div>

        <div class="area">
            <label for="">Incident description</label>
            <textarea name="" id=""  rows="5" placeholder="Write a description of the incident encountered here.." ></textarea>
        </div>

        <div class="groupFlex">
            <div class="group">
                <label for="">Reporting client</label>
                <input type="text" placeholder="Enter client name"/>
            </div>

            <div class="group">
                <label for="">Affected departments</label>
                <input type="text" placeholder="Enter department name"/>
            </div>
        </div>

        <div class="groupFlex">
            <div class="group">
                <label for="">Incident report date</label>
                <input type="date" name="" id="">
            </div>

            <div class="group">
                <label for="">Assign incident (optional)</label>
                <select name="" id="">
                    <option value="">Select users</option>
                </select>
                <img src="{{asset('assets/images/selectdown.svg')}}" alt="icon">
            </div>
        </div>

        <div class="toggle">
            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
            <p>Update client via email</p>
        </div>

        <div class="submitDiv">
            <button type="submit">Log Incident</button>
        </div>

    </form>
@endsection
@section('pagejs')
<script src="{{asset('assets/scripts/incident.js')}}"></script>
@endsection