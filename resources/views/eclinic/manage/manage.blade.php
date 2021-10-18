@extends('layouts.index')

@section('title', 'All Incidents')
@section('active', 'active')
@section('pagecss')
<link rel="stylesheet" href="{{asset('assets/css/incident.css')}}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/deji/datatableStyle.css')}}">
<style type="text/css">

button  a:hover {
    color: white;
}
</style>
@endsection
@section('body')
    <main>
        @include('layouts.nav')

        <div class="container">
            <p class="title">Manage</p>
            <div class="cover">

                <div class="top">
                    <div class="smallNav">
                        <div class="active eachSmall">
                            <p>Users</p>
                            <div class="line"></div>
                        </div>
                        <div class="eachSmall">
                            <p><a href="{{route('facilities')}}">Facilities</a></p>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="hrline"></div>
                <div class="contain openingDiv">
                    <div class="bottom">
                        <div class="first">
    
                        </div>
                        <button data-toggle="modal" data-dismiss="modal" data-backdrop="false" data-target="#add" class="noHover">+ Add
                        </button>
                    </div>

                    <div class="tableSide">
                        <div class="overFlow">
                            <table style="font-family: 'Averta' !important;" class="stripe table table-checkable datatable-table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->user_id}}</td>
                                        <td>{{$user->user_name}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->user_role}}</td>
                                        <td>
                                            <div class='dropdown'>
                                                <button class='btn' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <img src="{{('assets/images/dot.svg')}}" alt="dot">
                                                </button>
                                                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                                    <a data-toggle="modal" data-dismiss="modal" data-backdrop="false" data-target="#edit" class="dropdown-item" id="action_modal" href="#">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="add" class="modal">
        <div class="modal-content">
          <div class="top">
            <span onclick="document.getElementById('add').style.display='none'" class="close">&times;</span>
          </div>
          <form action="javascript:;" id="one_form">
            <p class="log">Add User</p>
            <div class="groupFlex">
                <div class="group">
                    <label for="">Info Relayed To</label>
                    <input type="text" name="info_relayed_to" id="info_relayed_to" placeholder="Info Relayed To"/>
                </div>

                <div class="group">
                    <label for="">Info Medium</label>
                    <input type="text" name="info_medium" id="info_medium" placeholder="Info Medium"/>
                </div>
            </div>
            <div class="groupFlex">
                <div class="group">
                    <label for="">Info Relayed To</label>
                    <input type="text" name="info_relayed_to" id="info_relayed_to" placeholder="Info Relayed To"/>
                </div>

                <div class="group">
                    <label for="">Info Medium</label>
                    <input type="text" name="info_medium" id="info_medium" placeholder="Info Medium"/>
                </div>
            </div>

            {{csrf_field()}}
            <input type="hidden" name="token" class="tokenn">

            <div class="submitDiv">
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'one_form')" name="incomplete" type="submit" id="incomplete">Incomplete</button>&nbsp;
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'one_form')" name="confirmed" type="submit" id="confirmed">Confirmed</button>
            </div>
            <p style="float: right;" id="one_form_msg"></p>

          </form>
     
        </div>
    </div>
@endsection
@section('pagejs')
<script src="{{asset('assets/scripts/incident.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js" integrity="sha512-E9vR5BfN3bwSc45BWl95328hvOcBYjMzKAKgdNM59yQXpTC4glztZyVoFJRp5qPc5A95zUZ8D5N7kEwUtJ9f6w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">

    $(document).on("change", "#role", function () {
        var role = $(this).val();

        if (role == 'Developer') {
            $('#dev').show();
            $('#sup').hide();
        } else if (role == 'Support Officer') {
            $('#dev').hide();
            $('#sup').show();
        } else {
            $('#dev').hide();
            $('#sup').hide();
        }
    });

    $(document).on("click", "#action_modal", function () {
        var tokenn = $(this).data('id');
        $(".tokenn").val( tokenn );
    });

    function submitAction(btn, nu) {
        $('.btns').prop('disabled', true);
        $('#'+nu+'_msg').html("Submitting...");
        var data = new FormData($('#'+nu)[0]);
        data.append('submit', btn);
        var URL = "{{url('/incident/incidents')}}";

        $.ajax({
            type: 'POST',
            url: "{{url('/incident/action')}}",
            data: data, 
            processData: false,
            contentType: false,
            success: function (response) {
                $('#'+nu+'_msg').html(response);
                var delay = 3000; 
                setTimeout(function(){ window.location = URL; }, delay);
            },
        });
    }
</script>
@endsection