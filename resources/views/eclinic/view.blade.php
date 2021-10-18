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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="{{asset('assets/images/logo.svg')}}" type="image/x-icon" />
        <link rel="stylesheet" href="{{asset('assets/css/incident.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('assets/deji/assets/fonts/custom/stylesheet.css')}}">
        <title>eClat | View Incident</title>
        <style>
            body {
                font-family: 'Averta' !important;
                font-weight: normal;
                font-style: normal;
                background-color: #E5E5E5!important;
            }
            img {
                transition:transform 0.25s ease;
            }

            img:hover {
                -webkit-transform:scale(100.5); /* or some other value */
                transform:scale(3.5);
            }
        </style>
    </head>
<body>
    <div class="pd-incident">
        <div class="modal">
            <div class="modal-content" style="width: 100%; float: right; border-radius:0;" >
              
              <div class="det">
                  <p class="title">Incident Details <a style="float: right;" href="{{url('incident/incidents')}}">Back Home</a></p>
                  <div class="line"></div>
                  <div class="down">

                    <div class="access">
                        <div class="number">
                            <p>{{$incident->facility}}</p>
                        </div>
                        <div class="text">
                            <p class="basic">{{$incident->fac}}</p>
                            <!-- <p class="office">Ikoyi Office, Lagos</p> -->
                        </div>
                    </div>
                    <div class="flexLog">
                        <div class="first">
                          <div class="eachLog line2">
                              <p class="left">Date logged</p>
                              <p class="right">{{$incident->issue_reported_on}}</p>
                          </div>
    
                          <div class="eachLog line2">
                              <p class="left">Logged by</p>
                              <p class="right">{{$incident->logged_by}}</p>
                          </div>
    
                          <div class="eachLog">
                              <p class="left">Assigned to</p>
                              <p class="right">{{$incident->assigned_to}}</p>
                          </div>
  
                        </div>
                        <div class="second">
                          <div class="eachLog line2">
                              <p class="left">Type</p>
                              <p class="right">{{$incident->issue_type}}</p>
                          </div>
    
                          <div class="eachLog line2">
                              <p class="left">Status</p>
                              <div class="right covCircle" style="background: {{$incident->stages[0]}}">
                                  <div class="circle"></div>
                                  <div class="sed">
                                      <p class="exempt">{{$incident->stages[1]}}</p>

                                      <div class="showna">
                                        <div class="eachP">
                                        </div>

                                    </div>
                                      
                                </div>
                              </div>
                          </div>
    
                          <div class="eachLog">
                              <p class="left">Priority</p>
                              <div class="right covPriority">
                                  <div class="circle"></div>
                                  <p>{{$incident->priority}}</p>
                              </div>
                          </div>
                        </div>
                      
  
                    </div>

                    <div class="description">
                        <p class="topic">Incident description</p>
                        <p class="exp">{{$incident->issue}}</p>
                    </div>
                    <hr><br>

                    <div class="comment">
                        <p class="topic">Comments</p>

                        <div class="allComment">
                            @foreach($comments as $comment)
                            <div class="eachComment">
                                <p class="text">
                                    {{$comment->comment}}
                                </p>
                                <div class="about">
                                    <span class="abb">
                                        D
                                    </span>
                                    <p class="by">
                                        {{$comment->user_name}}
                                    </p>
                                    <p class="date">
                                        {{$comment->done_at}}  
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <form action="javascript:;">
                        <input type="hidden" name="incident_token" id="incident_token" value="{{$incident->token}}">
                        <input type="text" required class="addComment" id="addComment" placeholder="Add a comment">&nbsp;<button id="submit_btn" onclick="saveComment()" class="btn ">save</button>
                        </form>
                    </div>
                    <br><hr>

                    <div class="media">
                        <p class="topic">Media</p>

                        <div class="stack">
                            <!-- <div class="group">
                                <label for="upload">
                                    <img src="../assets/images/cloud.svg" alt="cloud">
                                    <p class="inst">
                                        <span>Choose a file </span>
                                        or drag and drop it here
                                
                                    </p>
                                    <p class="warn">
                                        Upload in .jpg .png or .gif only
                                    </p>
                                </label>
                                <input type="file" name="upload" id="upload" hidden>
                            </div> -->
                            @foreach($medias as $media)
                            <div>
                                <img src="{{asset('images/media/'.$media->media_name)}}" alt="{{$media->caption}}" height="100" width="100">
                            </div>
                            @endforeach
                        </div>
                    </div><hr>

                    <div class="movement">
                        <p class="topic">Incident movement</p>

                        <div class="coverIncident">
                            @foreach($movements as $movement)
                            <div class="eachComment">
                                <p class="text">
                                    {{$movement->movement}}
                                </p>
                                <div class="about">
                                    <span class="abb">
                                        -
                                    </span>
                                    <p class="by">
                                        {{$movement->user_name}}
                                    </p>
                                    <p class="date">
                                        {{$movement->done_at}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>


                    </div>

                  </div>
                  
              </div>
         
            </div>
        </div>




    </div>
    
    <script src="{{asset('assets/scripts/incident.js')}}"></script>
    <script src="{{asset('assets/scripts/pagination.js')}}"></script>
    <script src="{{asset('assets/scripts/header.js')}}"></script>
    <script src="{{asset('assets/scripts/modal.js')}}"></script>
    <script src="{{asset('assets/scripts/detail.js')}}"></script>
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript">
        function saveComment() {
            $('#submit_btn').html("Submitting...").prop('disabled', true);
            var comment = $('#addComment').val();
            var incident_token = $('#incident_token').val();
            var URL = "{{url('/incident/incidents')}}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{url('incident/add-comment')}}",
                data: {comment: comment, incident_token:incident_token},
                success: function (response) {
                    console.log(response);
                    $('#submit_btn').html("saved");
                    $('.allComment').html(response);
                    $('#addComment').val('');
                    $('#submit_btn').html("Save").prop('disabled', false);
                    // var delay = 3000; 
                    // setTimeout(function(){ window.location = URL; }, delay);
                },
            });
        }
    </script>
   
</body>
</html>