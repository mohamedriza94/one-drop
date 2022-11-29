@extends('admin.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>DONOR REQUESTS</b></h3>
                <hr>
            </div>
            
            <div class="widget-content widget-content-area layout-top-spacing">
                <div class="row">
                    <div class="col-9">
                        <form><input type="text" placeholder="Search here..." id="searchBar" class="form-control"></form>
                    </div>
                    <div class="col-3">
                        <select id="filter" class="form-select" aria-label="Default select example">
                            <option selected="" disabled>Filter</option>
                            <option value="setnofilter" id="setnofilter">No filter</option>
                            <option value="setPending" id="setPending">Pending</option>
                            <option value="setAccepted" id="setAccepted">Accepted</option>
                            <option value="setDeclined" id="setDeclined">Declined</option>
                            <option value="setScheduled" id="setScheduled">Scheduled</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row layout-top-spacing">
                <div id="tableSimple" class="col-lg-12 col-12">
                    <div class="">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><b>Req No.</b></th>
                                            <th scope="col">NIC</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    
</div>

{{-- schedule appointment modal --}}
<div class="modal fade bd-example-modal-lg" id="scheduleAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Schedule an Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            
            <div class="modal-body">
                
                <ul id="scheduleAppointmentErrorList" class="list-unstyled bg-danger form-control d-none">
                </ul>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="">Donor Request No.</label>
                        <input type="text" class="form-control" readonly id="donorRequestNo">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label" for="">Donor Request Email</label>
                        <input type="text" class="form-control" readonly id="donorRequestEmail">
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label" for="">Appointment No.</label>
                        <input type="text" class="form-control" readonly id="appointmentNo">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label" for="">Date</label>
                        <input type="date" class="form-control" id="appointmentDate">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label" for="">Time</label>
                        <input type="time" class="form-control" id="appointmentTime">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label" for="">Venue</label>
                        <select id="appointmentVenue" class="form-control">
                        </select>
                    </div>
                    
                    <div class="col-md-12" id="scheduleButtonContainer">
                        <button class="btn btn-primary form-control center" type="submit"
                        id="btnSubmitSchedule">Schedule</button>
                    </div>
                    
                    <div class="col-md-12" id="rescheduleButtonContainer">
                        <button class="btn btn-primary form-control center" type="submit"
                        id="btnSubmitReschedule">Reschedule</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        
        $('#appointmentNo').val(Math.floor(Math.random() * (11500 - 99500 + 1) + 99500));
        //csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //retrieve data to html table
        setInterval(function(){
            
            var combo = document.getElementById("filter");
            
            if($('#searchBar').val().length > 0)
            {
                searchDonorRequest();
            }
            else if(combo.selectedIndex == 2)
            {
                fetchPendingDonorRequest();
                $('#searchBar').val('');
            }
            else if(combo.selectedIndex == 3)
            {
                fetchAcceptedDonorRequest();
                $('#searchBar').val('');
            }
            else if(combo.selectedIndex == 4)
            {
                fetchDeclinedDonorRequest();
                $('#searchBar').val('');
            }
            else if(combo.selectedIndex == 5)
            {
                fetchScheduledDonorRequest();
                $('#searchBar').val('');
            }
            else
            {
                fetchDonorRequest();
                $('#searchBar').val('');
            }
            
        }, 2000);
        
        //search data
        $('#searchBar').keyup(function(){   
            searchDonorRequest();
        });
        
        function fetchDonorRequest()
        {
            var url = '{{ url("admin/dashboard/fetchDonorRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.donorRequests,function(key,item){
                        
                        if(item.status=="pending"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                            $actionButton = '<button value="'+item.donorRequestNo+'" data-bs-toggle="modal" data-bs-target="#scheduleAppointmentModal" class="btn btn-outline-primary btn-sm" id="btnSchedule">Schedule Appointment</button>';
                            
                        }else if(item.status=="accepted"){
                            
                            $statusBadge = '<span class="badge badge-light-success">Accepted</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="declined"){
                            
                            $statusBadge = '<span class="badge badge-light-danger">Declined</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="scheduled"){
                            
                            $statusBadge = '<span class="badge badge-light-primary">Scheduled</span>';
                            $actionButton = '<button value="'+item.donorRequestNo+'" data-bs-toggle="modal" data-bs-target="#scheduleAppointmentModal" class="btn btn-outline-primary btn-sm" id="btnReschedule">Reschedule Appointment</button>';
                            
                        };
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.donorRequestNo+'</b></td>\
                            <td>'+item.nic+'</td>\
                            <td>'+item.age+'</td>\
                            <td>'+date_str+'</td>\
                            <td>'+time_str+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function fetchScheduledDonorRequest()
        {
            var url = '{{ url("admin/dashboard/fetchScheduledDonorRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.donorRequests,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-primary">Scheduled</span>';
                        $actionButton = '<button value="'+item.donorRequestNo+'" data-bs-toggle="modal" data-bs-target="#scheduleAppointmentModal" class="btn btn-outline-primary btn-sm" id="btnReschedule">Reschedule Appointment</button>';
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.donorRequestNo+'</b></td>\
                            <td>'+item.nic+'</td>\
                            <td>'+item.age+'</td>\
                            <td>'+date_str+'</td>\
                            <td>'+time_str+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function fetchDeclinedDonorRequest()
        {
            var url = '{{ url("admin/dashboard/fetchDeclinedDonorRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.donorRequests,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-danger">Declined</span>';
                        $actionButton = '-';
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.donorRequestNo+'</b></td>\
                            <td>'+item.nic+'</td>\
                            <td>'+item.age+'</td>\
                            <td>'+date_str+'</td>\
                            <td>'+time_str+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function fetchAcceptedDonorRequest()
        {
            var url = '{{ url("admin/dashboard/fetchAcceptedDonorRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.donorRequests,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-success">Accepted</span>';
                        $actionButton = '-';
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.donorRequestNo+'</b></td>\
                            <td>'+item.nic+'</td>\
                            <td>'+item.age+'</td>\
                            <td>'+date_str+'</td>\
                            <td>'+time_str+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function fetchPendingDonorRequest()
        {
            var url = '{{ url("admin/dashboard/fetchPendingDonorRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.donorRequests,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                        $actionButton = '<button value="'+item.donorRequestNo+'" data-bs-toggle="modal" data-bs-target="#scheduleAppointmentModal" class="btn btn-outline-primary btn-sm" id="btnSchedule">Schedule Appointment</button>';
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.donorRequestNo+'</b></td>\
                            <td>'+item.nic+'</td>\
                            <td>'+item.age+'</td>\
                            <td>'+date_str+'</td>\
                            <td>'+time_str+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function searchDonorRequest()
        {
            var searchInput = $('#searchBar').val();
            
            var url = '{{ url("admin/dashboard/searchDonorRequest/:input") }}';
            url = url.replace(':input', searchInput);
            
            $.ajax({
                type:"GET", 
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.donorRequests,function(key,item){
                        
                        if(item.status=="pending"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                            $actionButton = '<button value="'+item.donorRequestNo+'" data-bs-toggle="modal" data-bs-target="#scheduleAppointmentModal" class="btn btn-outline-primary btn-sm" id="btnSchedule">Schedule Appointment</button>';
                            
                        }else if(item.status=="accepted"){
                            
                            $statusBadge = '<span class="badge badge-light-success">Accepted</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="declined"){
                            
                            $statusBadge = '<span class="badge badge-light-danger">Declined</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="scheduled"){
                            
                            $statusBadge = '<span class="badge badge-light-primary">Scheduled</span>';
                            $actionButton = '<button value="'+item.donorRequestNo+'" data-bs-toggle="modal" data-bs-target="#scheduleAppointmentModal" class="btn btn-outline-primary btn-sm" id="btnReschedule">Reschedule Appointment</button>';
                            
                        };
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.donorRequestNo+'</b></td>\
                            <td>'+item.nic+'</td>\
                            <td>'+item.age+'</td>\
                            <td>'+date_str+'</td>\
                            <td>'+time_str+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function loadHospitalOptions()
        {
            var url = '{{ url("admin/dashboard/fetchHospital") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('#appointmentVenue').html('');
                    $.each(response.hospitals,function(key,item){
                        $('#appointmentVenue').append('<option value="'+item.name+'">'+item.name+'</option>');
                    });
                }
            });
        }
        
        //fetch donor request no
        $(document).on('click', '#btnSchedule',function(e){
            e.preventDefault();
            loadHospitalOptions();
            var fetchedDonorRequestNo = $(this).val();
            $('#donorRequestNo').val(fetchedDonorRequestNo);
            
            $('#scheduleButtonContainer').removeClass('d-none');
            $('#rescheduleButtonContainer').addClass('d-none');
            
            //fetch donor request email
            var url = '{{ url("admin/dashboard/fetchSingleDonorRequest/:id") }}';
            url = url.replace(':id', fetchedDonorRequestNo);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $.each(response.donorRequests,function(key,item){
                        $('#donorRequestEmail').val(item.email);
                    });
                }
            });
        });
        
        //fetch donor request no
        $(document).on('click', '#btnReschedule',function(e){
            e.preventDefault();
            loadHospitalOptions();
            var fetchedDonorRequestNo = $(this).val();
            $('#donorRequestNo').val(fetchedDonorRequestNo);
            
            $('#scheduleButtonContainer').addClass('d-none');
            $('#rescheduleButtonContainer').removeClass('d-none');
            
            //fetch donor request email
            var url = '{{ url("admin/dashboard/fetchSingleDonorRequest/:id") }}';
            url = url.replace(':id', fetchedDonorRequestNo);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $.each(response.donorRequests,function(key,item){
                        $('#donorRequestEmail').val(item.email);
                    });
                }
            });
        });
        
        //Schedule appointment
        $(document).on('click', '#btnSubmitSchedule',function(e){
            e.preventDefault();
            
            $('#btnSubmitSchedule').text('Scheduling...');
            
            var donorRequestNo = $('#donorRequestNo').val();
            var appointmentNo = $('#appointmentNo').val();
            var appointmentDate = $('#appointmentDate').val();
            var appointmentTime = $('#appointmentTime').val();
            var appointmentVenue = $('#appointmentVenue').val();
            var donorRequestEmail = $('#donorRequestEmail').val();
            
            var data = {
                'donorRequestNo' : donorRequestNo,
                'appointment_no' : appointmentNo,
                'appointmentDate' : appointmentDate,
                'appointmentTime' : appointmentTime,
                'appointmentVenue' : appointmentVenue,
                'donorRequestEmail' : donorRequestEmail
            }
            
            var url = '{{ url("admin/dashboard/scheduleAppointment") }}';
            
            $.ajax({
                type:"POST",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    if(response.status == 400)
                    {
                        $('#btnSubmitSchedule').text('Schedule');
                        
                        $('#scheduleAppointmentErrorList').html('');
                        $('#scheduleAppointmentErrorList').removeClass('d-none');
                        $.each(response.errors,function(key,err_value){
                            $('#scheduleAppointmentErrorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else
                    {   
                        $('#scheduleAppointmentErrorList').addClass('d-none');
                        $('#scheduleAppointmentErrorList').html('');
                        $('#btnSubmitSchedule').text('Appointment Scheduled and Mail Sent!');
                        $('#btnSubmitSchedule').addClass('btn-success');
                        $('#btnSubmitSchedule').removeClass('btn-primary');
                        $('#appointmentNo').val(Math.floor(Math.random() * (11500 - 99500 + 1) + 99500));
                        
                        setTimeout(function(){
                            $('#btnSubmitSchedule').text('Schedule');
                            $('#btnSubmitSchedule').addClass('btn-primary');
                            $('#btnSubmitSchedule').removeClass('btn-success');
                        }, 3000);
                    }
                }
            });
        });
        
        //Reschedule appointment
        $(document).on('click', '#btnSubmitReschedule',function(e){
            e.preventDefault();
            
            $('#btnSubmitReschedule').text('Rescheduling...');
            
            var donorRequestNo = $('#donorRequestNo').val();
            var appointmentNo = $('#appointmentNo').val();
            var appointmentDate = $('#appointmentDate').val();
            var appointmentTime = $('#appointmentTime').val();
            var appointmentVenue = $('#appointmentVenue').val();
            var donorRequestEmail = $('#donorRequestEmail').val();
            
            var data = {
                'donorRequestNo' : donorRequestNo,
                'appointment_no' : appointmentNo,
                'appointmentDate' : appointmentDate,
                'appointmentTime' : appointmentTime,
                'appointmentVenue' : appointmentVenue,
                'donorRequestEmail' : donorRequestEmail
            }
            
            var url = '{{ url("admin/dashboard/rescheduleAppointment") }}';
            
            $.ajax({
                type:"POST",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    if(response.status == 400)
                    {
                        $('#btnSubmitReschedule').text('Schedule');
                        
                        $('#scheduleAppointmentErrorList').html('');
                        $('#scheduleAppointmentErrorList').removeClass('d-none');
                        $.each(response.errors,function(key,err_value){
                            $('#scheduleAppointmentErrorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else
                    {   
                        $('#scheduleAppointmentErrorList').addClass('d-none');
                        $('#scheduleAppointmentErrorList').html('');
                        $('#btnSubmitReschedule').text('Appointment rescheduled and Mail Sent!');
                        $('#btnSubmitReschedule').addClass('btn-success');
                        $('#btnSubmitReschedule').removeClass('btn-primary');
                        $('#appointmentNo').val(Math.floor(Math.random() * (11500 - 99500 + 1) + 99500));
                        
                        setTimeout(function(){
                            $('#btnSubmitReschedule').text('Schedule');
                            $('#btnSubmitReschedule').addClass('btn-primary');
                            $('#btnSubmitReschedule').removeClass('btn-success');
                        }, 3000);
                    }
                }
            });
        });
        
    });
</script>
@endsection
