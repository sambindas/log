<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:title" content="eClat">
        <meta property="og:description" content="">
        <meta property="og:image" content="https://res.cloudinary.com/dpiyqfdpk/image/upload/v1627104618/logo2_k3ibfh.svg">
        <meta property="og:url" content="https://eclinic2.netlify.app">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" integrity="sha512-17AHGe9uFHHt+QaRYieK7bTdMMHBMi8PeWG99Mf/xEcfBLDCn0Gze8Xcx1KoSZxDnv+KnCC+os/vuQ7jrF/nkw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="{{('assets/images/logo.svg')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('assets/deji/assets/fonts/custom/stylesheet.css')}}">
        <!-- <link rel="stylesheet" href="{{('assets/css/incident.css')}}"> -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style type="text/css">
            .modal {
                display: block;
            }
            body {
                font-family: 'Averta' !important;
                font-weight: normal;
                font-style: normal;
                background-color: #E5E5E5!important;
            }

            .modal form .submitDiv button {
                padding: 10px 0px;
                border: transparent;
                cursor: pointer;
                border-radius: 5px;
                width: 152px;
                background: #0275D8;
                border-radius: 6px;
                color: white;
            }
        </style>
        <title>eClat | Choose Portal</title>
    </head>
<body>
    <div class="pd-incident">
        <div class="modal">
            <div class="modal-content">
                <form action="javascript:;" id="signin" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="submitDiv" style="text-align: center;">
                        <br><br><br><br><br><br>
                        <p style="font-size: 30px;">CHOOSE PORTAL</p><br><br><br><br><br><br>
                        <button onclick="choose(this.id)" id="eclinic" class="btn" type="submit">eClinic</button>
                        <button onclick="choose(this.id)" disabled readonly id="smarthealth" class="btn" type="submit">Smarthealth</button>
                        <button onclick="choose(this.id)" disabled readonly id="hims" class="btn" type="submit">HIMS</button>
                        <p id="msg" style="" class="alert alert-success"></p>
                    </div><br>

                </form>
         
            </div>
        </div>

    </div>
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/scripts/incident.js')}}"></script>
    <script src="{{asset('assets/scripts/pagination.js')}}"></script>
    <script src="{{asset('assets/scripts/header.js')}}"></script>
    <script src="{{asset('assets/scripts/modal.js')}}"></script>
    <script src="{{asset('assets/scripts/detail.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
    <script type="text/javascript">
        function choose(btn) {
            if(btn == 'eclinic') {
                var url = '{{url('/incident/index')}}';
            }
            $('.btn').prop('disabled', true);
            $('#msg').html("<i>signing you into "+btn+"...</i>");

            $.ajax({
                type: 'GET',
                url: "{{url('/assign-product')}}",
                data: {data: btn},
                success: function (response) {
                    var delay = 2000; 
                    setTimeout(function(){ window.location = url; }, delay);
                },
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js" integrity="sha512-E9vR5BfN3bwSc45BWl95328hvOcBYjMzKAKgdNM59yQXpTC4glztZyVoFJRp5qPc5A95zUZ8D5N7kEwUtJ9f6w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>