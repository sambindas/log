@extends('layouts.index')

@section('title', 'All Incidents')
@section('pagecss')
<link rel="stylesheet" href="{{asset('assets/css/incident.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" integrity="sha512-17AHGe9uFHHt+QaRYieK7bTdMMHBMi8PeWG99Mf/xEcfBLDCn0Gze8Xcx1KoSZxDnv+KnCC+os/vuQ7jrF/nkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                            <a href="{{route('/index')}}">Overview</a>
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
    
                            <div class="inputSearch">
                                <img src="{{asset('assets/images/Vector.svg')}}" alt="search">
                                <input type="text" placeholder="Search incidents">
                            </div>
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
                        <button id="mybtn">
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
                                <label for="initiator">Item</label>
                                <img src="{{asset('assets/images/selectdown.svg')}}" alt="icon">
                                <select name="Item" id="Initiator">
                                    <option value="">All</option>
                                </select>
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

                        </div>
                       
                    </form>

                    <div class="tableSide">
                        <div class="overFlow">
                            <table id="incidents" class="cell-border compact stripe">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Facility</th>
                                        <th>Type</th>
                                        <th>Incident</th>
                                        <th>Priority</th>
                                        <th>Date</th>
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

    <div id="myModal2" class="modal">
        <div class="modal-content" style="width: 90%; float: right; border-radius:0;" >
          <div class="top">
            <span class="close2">&times;</span>
          </div>
          <div class="det">
              <p class="title">Incident Details</p>
              <div class="line"></div>
              <div class="down">

                <div class="access">
                    <div class="number">
                        <p>101</p>
                    </div>
                    <div class="text">
                        <p class="basic">Access to Basic Care</p>
                        <p class="office">Ikoyi Office, Lagos</p>
                    </div>
                </div>
                <div class="flexLog">
                    <div class="first">
                      <div class="eachLog line2">
                          <p class="left">Date logged</p>
                          <p class="right">3/11/2020</p>
                      </div>

                      <div class="eachLog line2">
                          <p class="left">Logged by</p>
                          <p class="right">Gracefilled Okeke</p>
                      </div>

                      <div class="eachLog">
                          <p class="left">Assigned to</p>
                          <div class="right spanDiv">
                              <div class="dd alike">D</div>
                              <div class="oo alike">O</div>
                              <div class="plus alike">
                                  <p class="exempt">+</p>
                                  <div class="showna">
                                      <div class="eachP">
                                          <span class="blue" >A</span>
                                          <p>Aliu Sanni</p>
                                      </div>
                                      <div class="eachP">
                                          <span class="yel">B</span>
                                          <p>Blindas Samuel</p>
                                      </div>

                                      <div class="eachP">
                                        <span class="green">c</span>
                                        <p>Blindas Samuel</p>
                                    </div>
                                    <div class="eachP">
                                        <span class="pink">D</span>
                                        <p>Blindas Samuel</p>
                                    </div>

                                  </div>
                                  
                                </div>
                            </div>
                      </div>

                    </div>
                    <div class="second">
                      <div class="eachLog line2">
                          <p class="left">Type</p>
                          <p class="right">Request</p>
                      </div>

                      <div class="eachLog line2">
                          <p class="left">Status</p>
                          <div class="right covCircle">
                              <div class="circle"></div>
                              <div class="sed">
                                  <p class="exempt">Approval Required</p>

                                  <div class="showna">
                                    <div class="eachP">
                                        <span class="done" ></span>
                                        <p>Done</p>
                                    </div>
                                    <div class="eachP">
                                        <span class="con"></span>
                                        <p>Confirmed</p>
                                    </div>

                                    <div class="eachP">
                                      <span class="ntclear"></span>
                                      <p>Not clear</p>
                                  </div>
                                  <div class="eachP">
                                      <span class="inc"></span>
                                      <p>Incomplete information</p>
                                  </div>
                                  <div class="eachP">
                                      <span class="iss"></span>
                                      <p>Not an issue</p>
                                  </div>
                                  <div class="eachP">
                                      <span class="approved"></span>
                                      <p>Not approved</p>
                                  </div>
                                  <div class="eachP">
                                      <span class="req"></span>
                                      <p>Approval required</p>
                                  </div>
                                  <div class="eachP">
                                      <span class="incomplete"></span>
                                      <p>Incomplete</p>
                                  </div>
                                  <div class="eachP">
                                      <span class="assigned"></span>
                                      <p>Assigned</p>
                                  </div>
                                  <div class="eachP">
                                      <span class="un"></span>
                                      <p>Unassigned</p>
                                  </div>

                                </div>
                                  
                            </div>
                          </div>
                      </div>

                      <div class="eachLog">
                          <p class="left">Priority</p>
                          <div class="right covPriority">
                              <div class="circle"></div>
                              <p>High</p>
                          </div>
                      </div>
                    </div>
                  

                </div>

                <div class="description">
                    <p class="topic">Incident description</p>
                    <p class="exp">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et tristique aliquet egestas pellentesque. Et, interdum purus nullam aliquam dui, lectus viverra at orci. A mauris morbi vitae, dictum ante. Dolor morbi congue sed nibh vitae egestas. Id aenean leo hendrerit vehicula phasellus quis est. Amet aliquet sed gravida vulputate feugiat est faucibus. Mi metus lacus feugiat posuere eget. Facilisi lobortis est morbi posuere id orci vitae.
                        Adipiscing tempor, donec pellentesque sagittis a nisl vel dolor. Aliquam ultrices ut in aliquet nibh. Feugiat est purus convallis cursus arcu duis sed. Non imperdiet sem lacus dui, porttitor faucibus. In elit ut eu sit.
                        Ut curabitur lorem leo egestas turpis bibendum consectetur sed aliquet. Diam diam ut fames pellentesque a, morbi. Molestie nisl blandit integer nam platea posuere accumsan fringilla feugiat. Aliquam venenatis vestibulum morbi enim tempus id vitae pellentesque. 
                        
                    </p>
                </div>

                <div class="comment">
                    <p class="topic">Comments</p>

                    <div class="allComment">
                        <div class="eachComment">
                            <p class="text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et tristique aliquet egestas pellentesque. 
                            </p>
                            <div class="about">
                                <span class="abb">
                                    D
                                </span>
                                <p class="by">
                                    By Design Guy
                                </p>
                                <p class="date">
                                    11/12/20   
                                </p>
                                <p class="time">
                                    12:42pm
                                </p>
                            </div>
                        </div>
                    </div>

                    <input type="text" class="addComment" placeholder="Add a comment">
                </div>

                <div class="media">
                    <p class="topic">Media</p>

                    <div class="stack">
                        <div class="group">
                            <label for="upload">
                                <img src="{{asset('assets/images/cloud.svg')}}" alt="cloud">
                                <p class="inst">
                                    <span>Choose a file </span>
                                    or drag and drop it here
                            
                                </p>
                                <p class="warn">
                                    Upload in .jpg .png or .gif only
                                </p>
                            </label>
                            <input type="file" name="upload" id="upload" hidden>
                        </div>
                        <div class="same">
                            <p>x</p>
                        </div>

                        <div class="same">
                            <p>x</p>
                        </div>

                        <div class="same">
                            <p>x</p>
                        </div>
                        <div class="same">
                            <p>x</p>
                        </div>
                    </div>
                </div>

                <div class="movement">
                    <p class="topic">Incident movement</p>

                    <div class="coverIncident">
                        <div class="eachComment">
                            <p class="text">
                                Incident created
                            </p>
                            <div class="about">
                                <span class="abb">
                                    D
                                </span>
                                <p class="by">
                                    By Design Guy
                                </p>
                                <p class="date">
                                    11/12/20   
                                </p>
                                <p class="time">
                                    12:42pm
                                </p>
                            </div>
                        </div>

                        <div class="eachComment">
                            <p class="text">
                                Incident reassigned
                            </p>
                            <div class="about">
                                <span class="abb">
                                    D
                                </span>
                                <p class="by">
                                    By Design Guy
                                </p>
                                <p class="date">
                                    11/12/20   
                                </p>
                                <p class="time">
                                    12:42pm
                                </p>
                            </div>
                        </div>
                    </div>


                </div>

              </div>
              
          </div>
     
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
  $(function () {
    run_table();
    function run_table(){
       var table = $('#incidents').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "{{ route('incident.list') }}",
        columns: [
            {data: 'issue_id', name: 'issue_id'},
            {data: 'facility', name: 'facility'},
            {data: 'issue_type', name: 'issue_type'},
            {data: 'issue', name: 'incident'},
            {data: 'priority', name: 'priority'},
            {data: 'issue_date', name: 'issue_date'},
            
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
</script>
@endsection