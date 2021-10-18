<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:title" content="eClat">
        <meta property="og:description" content="">
        <meta property="og:image" content="https://res.cloudinary.com/dpiyqfdpk/image/upload/v1627104618/logo2_k3ibfh.svg">
        <meta property="og:url" content="https://eclinic2.netlify.app">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="{{asset('assets/images/logo.svg')}}" type="image/x-icon" />
        <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('assets/deji/assets/fonts/custom/stylesheet.css')}}">
        <title>eClat | Login</title>
        <style>
            body {
                font-family: 'Averta' !important;
                font-weight: normal;
                font-style: normal;
                background-color: #E5E5E5!important;
            }
        </style>
    </head>
<body>

    <div class="pd-login">
        <form onsubmit="return false" action="{{route('/login')}}" method="post" id="login_form">
            <img src="assets/images/logo2.svg" class="logo" alt="logo">
            {{csrf_field()}}
            <div class="topic">
                <p class="sign">Sign in</p>
                <p class="cred">Sign in with the credentials provided to you via email.</p>
            </div>

            <div class="group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="group">
                <label for="password">Password</label>
                <input type="password" id="password" name="secret" required>
            </div>
            <div id="response"></div>
            <button type="submit" id="login_btn">Sign in</button> 

            <p class="forget">Forgot password</p>
            <p class="issue">If you encounter any issues, contact the eClat team at: </p>
              <p class="mail">  eclatsupport@interswitchgroup.com</p>
        </form>
        <div class="logoSide">
            <img src="{{asset('assets/images/logo.svg')}}" alt="logo" class="logo">
        </div>
    </div>

    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript">
    $('#login_form').submit(function (e) {
        e.preventDefault();
        $('#response').html('');
        $('#login_btn').prop('disabled', true).html("Authenticating...");

        var formData = $(this).serialize();
        var url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'JSON',
            complete: function (response) {
                $('#login_btn').prop('disabled', false).html('Sign In');
                if(response.status===200)
                {
                    var res = JSON.parse(response.responseText);
                    $('#login_btn').prop('disabled', true).html(res.success);
                    window.location.replace(res.callback);
                } else {
                    $('#response').html('<p style="color: #ff0000;">'+response.responseJSON.message+'</p>');
                }
            },
            error: function (xhr, status, error) {
                if (xhr.status===401) {
                    var err = xhr.responseJSON;
                    $('#response').html('<p class="alert alert-danger">'+err.status+'</p>');
                }
                $('#login_btn').prop('disabled', false).html('Sign In');
            }
        });
    });
    </script>
</body>
</html>