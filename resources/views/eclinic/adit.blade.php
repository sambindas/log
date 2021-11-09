<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:title" content="eClat">
        <meta property="og:description" content="">
        <meta property="og:image" content="https://res.cloudinary.com/dpiyqfdpk/image/upload/v1627104618/logo2_k3ibfh.svg">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" integrity="sha512-17AHGe9uFHHt+QaRYieK7bTdMMHBMi8PeWG99Mf/xEcfBLDCn0Gze8Xcx1KoSZxDnv+KnCC+os/vuQ7jrF/nkw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../assets/images/logo.svg" type="image/x-icon" />
        <link rel="stylesheet" href="../assets/css/incident.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
        </style>
        <title>eClat | Incident</title>
    </head>
<body>
    <div class="pd-incident">
        <div class="modal">
            <div class="modal-content">
                <form action="javascript:;" id="issue" enctype="multipart/form-data">
                    <p class="log">Log Incident</p>

                    <div class="groupFlex">
                        <div class="group">
                            <label for="">Select facility</label>
                            <select name="facility" class="sl2" id="facility">
                                <option value="">Select facility</option>
                                @foreach($facilities as $facility)
                                    <option value="{{$facility->code}}">{{$facility->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="group">
                            <label for="">Select incident category</label>
                            <select class="sl2" name="category" id="category">
                                <option value="">Select Category</option>
                                <option value="Software Issue">Software Issue</option>
                                <option value="Software Request">Software Request</option>
                                <option value="Hardware Issue">Hardware Issue</option>
                                <option value="Hardware Request">Hardware Request</option>
                            </select>
                        </div>

                    </div>

                    <div class="groupFlex">
                        <div class="group">
                            <label for="">Select module</label>
                            <select class="sl2" name="module" id="module">
                                <option value="">Select Category First</option>
                            </select>
                        </div>

                        <div class="group">
                            <label for="">Select item</label>
                            <select class="sl2" name="item" id="item">
                                <option value="">Select Module First</option>
                            </select>
                        </div>
                    </div>
                    {{csrf_field()}}

                    <div class="area">
                        <label for="">Incident description</label>
                        <textarea name="issue" id="summernotes"  rows="5" placeholder="Write a description of the incident encountered here.." ></textarea>
                    </div>

                    <div class="groupFlex">
                        <div class="group">
                            <label for="">Reporting client</label>
                            <input type="text" name="issue_client_reporter" id="issue_client_reporter" placeholder="Enter client name"/>
                        </div>

                        <div class="group">
                            <label for="">Affected departments</label>
                            <input type="text" name="affected_dept" id="affected_dept" placeholder="Enter department name"/>
                        </div>
                    </div>

                    <div class="groupFlex">
                        <div class="group">
                            <label for="">Incident report date</label>
                            <input type="date" name="issue_reported_on" id="issue_reported_on">
                        </div>

                        <div class="group">
                            <label for="">Upload Media (optional)</label>
                            <input type="file" name="media" id="media" required>
                        </div>
                    </div>

                    <div class="toggle">
                        <label class="switch">
                            <input type="checkbox" name="client_email" id="client_email">
                            <span class="slider round"></span>
                        </label>
                        <p>Update client via email</p>
                    </div>

                    <div class="submitDiv">
                        <button id="submit_btn" type="submit">Log Incident</button>
                    </div><br>
                    <p id="msg" style="float: right;" class="alert alert-success"></p>

                </form>
         
            </div>
        </div>

    </div>
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernotes').summernote();
        });
        $(document).ready(function() {
            $('.sl2').select2({
                theme: "classic",
            });

            $('#category').on('change', function (e) {
                e.preventDefault();
                var category = $(this).val();
                var action = 'category';

                $.ajax({
                    type: 'GET',
                    url: "{{url('/incident/filters')}}",
                    data: {action:action, category:category},
                    success: function (response) {
                        $('#module').html(response);
                    },
                });
            });

            $('#module').on('change', function (e) {
                e.preventDefault();
                var modules = $(this).val();
                var category = $('#category').val();
                var action = 'module';

                $.ajax({
                    type: 'GET',
                    url: "{{url('/incident/filters')}}",
                    data: {action:action, module:modules, category:category},
                    success: function (response) {
                        $('#item').html(response);
                    },
                });
            });

            $('#issue').on('submit', function (e) {
                e.preventDefault();
                var media = $('#media').val();
                $('#submit_btn').prop('disabled', true).html("Submitting...");
                var URL = "{{url('/incident/incidents')}}";
                var data = new FormData(this);//$(this).serializeArray();

                $.ajax({
                    type: 'POST',
                    url: "{{url('/incident/submit')}}",
                    data: data, 
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#msg').html(response);
                        var delay = 3000; 
                        setTimeout(function(){ window.location = URL; }, delay);
                    },
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js" integrity="sha512-E9vR5BfN3bwSc45BWl95328hvOcBYjMzKAKgdNM59yQXpTC4glztZyVoFJRp5qPc5A95zUZ8D5N7kEwUtJ9f6w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>