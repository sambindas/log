<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:title" content="eClat">
    <meta property="og:description" content="">
    <meta property="og:image" content="https://res.cloudinary.com/dpiyqfdpk/image/upload/v1627104618/logo2_k3ibfh.svg">
    <meta property="og:url" content="https://eclinic2.netlify.app">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('assets/images/logo.svg')}}" type="image/x-icon" />
    <title>eClat | @yield('title')</title>
    @yield('pagecss')
</head>
<body>
    <div class="pd-incident">
        <div class="sideBar">
            <img src="{{asset('assets/images/logo2.svg')}}" alt="logo" class="logo2">

            <ul class="navs">
                <li>
                    <a class="active" href="incident.html">
                        <img src="{{asset('assets/images/first.svg')}}" alt="icon">
                       <p>Incident Log</p>
                    </a>
                    
                </li>
                <li>
                    <a href="inventory.html">
                        <img src="{{asset('assets/images/stack 1.svg')}}" alt="icon">
                      <p>Inventory</p>
                    </a>
                    
                </li>
                <li>
                    <a href="manage.html">
                        <img src="{{asset('assets/images/second.svg')}}" alt="icon">
                        <p>Manage</p>

                    </a>
                    
                </li>
                <li>
                    <a href="activityLog.html">
                        <img src="{{asset('assets/images/third.svg')}}" alt="icon">
                        <p>Activity Log</p>
                    </a>
                </li>
            </ul>
        </div>
        @yield('body')
    </div>
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/scripts/pagination.js')}}"></script>
    <script src="{{asset('assets/scripts/header.js')}}"></script>
    <script src="{{asset('assets/scripts/modal.js')}}"></script>
    <script src="{{asset('assets/scripts/detail.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    @yield('pagejs')
</body>
</html>