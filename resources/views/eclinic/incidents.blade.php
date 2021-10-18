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
            <p class="title">Incident Log</p>
            <div class="cover">

                <div class="top">
                    <div class="smallNav">
                        <div class="eachSmall">
                            <p><a href="{{route('/index')}}">Overview</a></p>
                            <div class="line"></div>
                        </div>
                        <div class="active eachSmall">
                            <p>All Incidents</p>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="hrline"></div>
                <div class="contain openingDiv">
                    <div class="bottom">
                        <div class="first">
                            <div class="filterDiv">
                                <img src="{{asset('assets/images/filter.svg')}}" alt="filter">
                                <button>
                                    Filter
                                </button>
                            </div>
                            <dutton class="clearAll">
                                Clear filters
                            </dutton>
    
                        </div>
                        <button id="mybtn" class="noHover">
                            <a href="{{route('add-incident')}}">Log an Incident</a>
                        </button>
                        
                        
                    </div>
                    <form action="" class="filterPart">
                        <p class="title">Filters</p>
                        <div class="flex">

                            <div class="group">
                                <label for="from">From</label>
                                <input type="date" name="from" id="from">
                            </div>
                            <div class="group">
                                <label for="to">To</label>
                                <input type="date" name="to" id="to">
                            </div>
                            <div class="group">
                                <label for="initiator">Initiator</label>
                                <img src="{{asset('assets/images/selectdown.svg')}}" alt="icon">
                                <select name="initiator" id="initiator">
                                    <option value="">All</option>
                                </select>
                            </div>
                            <div class="group">
                                <label for="status">Status</label>
                                <img src="{{asset('assets/images/selectdown.svg')}}" alt="icon">
                                <select name="status" id="status">

                                    <option value="">All</option>
                                </select>
                            </div>

                            <div class="group">
                                <label for="initiator">Item</label>
                                <div class="inputSearch">
                                    <img src="{{asset('assets/images/Vector.svg')}}" alt="search">
                                    <input type="text" placeholder="Search incidents">
                                </div>
                            </div>

                            <div class="group">
                                <button id="mybtn" type="submit" class="noHover">see</button>
                            </div>

                        </div>
                       
                    </form>

                    <div class="tableSide">
                        <div class="overFlow">
                            <table style="font-family: 'Averta' !important;" id="incidents" class="compact stripe table table-checkable datatable-table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Facility</th>
                                        <th>Type</th>
                                        <th>Incident</th>
                                        <th>Date Logged</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="zero" class="modal">
        <div class="modal-content">
          <div class="top">
            <span onclick="document.getElementById('zero').style.display='none'" class="close">&times;</span>
          </div>
          <form action="javascript:;" id="zero_form">
            <p class="log">Incident Action</p>

            <div class="area">
                <label for="">Any Comments</label>
                <textarea name="comment" id="comment"  rows="5" placeholder="Add Comments" required></textarea>
            </div>
            {{csrf_field()}}
            <input type="hidden" name="token" class="tokenn">

            <div class="submitDiv">
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'zero_form')" name="done" type="submit" id="done">Done</button>&nbsp;
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'zero_form')" name="not_an_issue" type="submit" id="not_an_issue">Not An Issue</button>&nbsp;
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'zero_form')" name="requires_approval" type="submit" id="requires_approval">Requires Approval</button>&nbsp;
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'zero_form')" name="not_applicable" type="submit" id="not_applicable">Not Applicable</button>
            </div>
            <p style="float: right;" id="zero_form_msg"></p>

          </form>
     
        </div>
    </div>
    <div id="one" class="modal">
        <div class="modal-content">
          <div class="top">
            <span onclick="document.getElementById('one').style.display='none'" class="close">&times;</span>
          </div>
          <form action="javascript:;" id="one_form">
            <p class="log">Incident Action (<i>if reopening, ignore first section</i>)</p>
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

            <div class="area">
                <label for="">Any Comments</label>
                <textarea name="comment" id="comment"  rows="5" placeholder="Add Comments" required></textarea>
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
    <div id="three" class="modal">
        <div class="modal-content">
          <div class="top">
            <span onclick="document.getElementById('three').style.display='none'" class="close">&times;</span>
          </div>
          <form action="javascript:;" id="three_form">
            <p class="log">Incident Action</p>

            <div class="area">
                <label for="">Any Comments</label>
                <textarea name="comment" id="comment"  rows="5" placeholder="Add Comments" required></textarea>
            </div>
            {{csrf_field()}}
            <input type="hidden" name="token" class="tokenn">

            <div class="submitDiv">
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'three_form')" name="reopen" type="submit" id="reopen">Reopen</button>&nbsp;
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'three_form')" name="close" type="submit" id="close">Confirmed</button>
            </div>
            <p style="float: right;" id="three_form_msg"></p>

          </form>
     
        </div>
    </div>
    <div id="four" class="modal">
        <div class="modal-content">
          <div class="top">
            <span onclick="document.getElementById('four').style.display='none'" class="close">&times;</span>
          </div>
          <form action="javascript:;" id="four_form">
            <p class="log">Incident Action</p>

            <div class="area">
                <label for="">Any Comments</label>
                <textarea name="comment" id="comment"  rows="5" placeholder="Add Comments" required></textarea>
            </div>
            {{csrf_field()}}
            <input type="hidden" name="token" class="tokenn">

            <div class="submitDiv">
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'four_form')" name="reopen" type="submit" id="reopen">Approved</button>&nbsp;
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'four_form')" name="close" type="submit" id="close">Not Approved</button>
            </div>
            <p style="float: right;" id="four_form_msg"></p>

          </form>
     
        </div>
    </div>
    <div id="five" class="modal">
        <div class="modal-content">
          <div class="top">
            <span onclick="document.getElementById('five').style.display='none'" class="close">&times;</span>
          </div>
          <form action="javascript:;" id="four_form">
            <p class="log">Incident Action</p>

            <div class="area">
                <label for="">Any Comments</label>
                <textarea name="comment" id="comment"  rows="5" placeholder="Add Comments" required></textarea>
            </div>
            {{csrf_field()}}
            <input type="hidden" name="token" class="tokenn">

            <div class="submitDiv">
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'four_form')" name="reopen" type="submit" id="reopen">Reopen</button>&nbsp;
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'four_form')" name="close" type="submit" id="close">Close</button>
            </div>
            <p style="float: right;" id="five_form_msg"></p>

          </form>
     
        </div>
    </div>

    <div id="assign" class="modal">
        <div class="modal-content">
          <div class="top">
            <span onclick="document.getElementById('assign').style.display='none'" class="close">&times;</span>
          </div>
          <form action="javascript:;" id="assign_form">
            <div class="groupFlex">
                <div class="group">
                    <label for="">Role</label>
                    <select name="role" class="sl2" id="role">
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            <option value="{{$role}}">{{$role}}</option>
                        @endforeach
                    </select>
                </div> &nbsp;

                <div class="group" id="dev" style="display: none;">
                    <label for="">Select Developer</label>
                    <select name="dev_assignee" class="sl2" id="dev_assignee">
                        <option value="">Select user</option>
                        @foreach($devusers as $devuser)
                            <option value="{{$devuser->user_id}}">{{$devuser->user_name}}</option>
                        @endforeach
                    </select>
                </div> &nbsp;
                <div class="group" id="sup" style="display: none;">
                    <label for="">Select Support</label>
                    <select name="sup_assignee" class="sl2" id="sup_assignee">
                        <option value="">Select user</option>
                        @foreach($supportusers as $supportuser)
                            <option value="{{$supportuser->user_id}}">{{$supportuser->user_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{csrf_field()}}
            <input type="hidden" name="token" class="tokenn">

            <div class="submitDiv">
                <button class="btn btn-sm btns" onclick="return submitAction(this.id, 'assign_form')" name="assign" type="submit" id="assign">Assign</button>
            </div>
            <p style="float: right;" id="assign_form_msg"></p>

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
    $(document).ready(function() {
        $('.sl2').select2({
            theme: "classic",
        });
    });

    $(function () {
        run_table();
        function run_table(){
            var table = $('#incidents').DataTable({
                processing: true,
                serverSide: true,
                searchable: true,
                ordering: false,
                ajax: "{{ route('incident.list') }}",
                columns: [
                    {data: 'issue_id', name: 'issue_id'},
                    {data: 'facility', name: 'facility'},
                    {data: 'issue_type', name: 'issue_type'},
                    {data: 'issue', name: 'incident', searchable: true},
                    {data: 'issue_date', name: 'issue_date'},
                    {data: 'status', name: 'status'},
                    
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: true
                    },
                ]
            }); 
        }
    });

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