@extends('admin.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>APPOINTMENTS</b></h3>
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
                            <option value="setCompleted" id="setCompleted">Completed</option>
                            <option value="setDeclined" id="setDeclined">Cancelled</option>
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
                                            <th scope="col"><b>App No.</b></th>
                                            <th scope="col">Donor Req. No.</th>
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
<div class="modal fade bd-example-modal-xl" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            
            <div class="modal-body d-none" id="errorModalBody">
                <ul class="bg-warning form-control px-5 d-none" id="errorList">
                    
                </ul>
            </div>
            
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label" for="">Last Medical Checkup Status.</label>
                        <select id="lastMedicalCheckupStatusSelect" onchange="checkMedicalCheckupStatus()" class="form-control">
                            <option value="Choose">Choose</option>
                            <option value="pass">Pass</option>
                            <option value="fail">Fail</option>
                        </select>
                    </div>
                </div>
            </div>
            
            
            <div id="declinationForm" class="modal-body d-none">
                <form>
                    <div class="row g-3">
                        <div class="col-md-12" id="rescheduleButtonContainer">
                            <button class="btn btn-danger form-control center" type="submit" value=""
                            id="btnDecline">Decline</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div id="donorRegistrationForm" class="modal-body d-none">
                <form method="POST" id="donorRegistrationFormPost" enctype="multipart/form-data">
                    <div class="row g-3">
                        
                        <div class="col-md-3">
                            <label class="form-label" for="">Donor Request No.</label>
                            <input type="text" class="form-control" readonly id="registrationDonorRequestNo" name="donorRequestNo">
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label" for="">Donor No.</label>
                            <input type="text" class="form-control" readonly id="no" name="no">
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label" for="">Blood Group</label>
                            <select name="bloodGroup" id="bloodGroup" class="form-control">
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label" for="">NIC</label>
                            <input type="text" class="form-control" readonly id="nic" name="nic">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label" for="">Date of Birth</label>
                            <input type="date" class="form-control" id="dateofbirth" name="dateofbirth">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label" for="">Age</label>
                            <input type="text" class="form-control" id="age" name="age">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label" for="">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label" for="">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullname">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label" for="">Address</label>
                            <textarea class="form-control" rows="3" id="address" name="address"></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label" for="">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label" for="">Telephone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label" for="">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        
                        <div class="col-md-12" id="rescheduleButtonContainer">
                            <button class="btn btn-primary form-control center" type="submit"
                            id="btnRegister">Register</button>
                        </div>
                    </div>
                </form>
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
                searchAppointment();
            }
            else if(combo.selectedIndex == 2)
            {
                fetchPendingAppointment();
                $('#searchBar').val('');
            }
            else if(combo.selectedIndex == 3)
            {
                fetchCompletedAppointment();
                $('#searchBar').val('');
            }
            else if(combo.selectedIndex == 4)
            {
                fetchCancelledAppointment();
                $('#searchBar').val('');
            }
            else
            {
                fetchAppointment();
                $('#searchBar').val('');
            }
            
        }, 2000);
        
        function fetchAppointment()
        {
            var url = '{{ url("admin/dashboard/fetchAppointment") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.appointments,function(key,item){
                        
                        if(item.status=="pending"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                            
                            $actionButton = '<button value="'+item.donorRequestNo+'" data-bs-toggle="modal" data-bs-target="#registrationModal" class="btn btn-primary btn-sm" id="btnOpenRegistration">Register</button>\
                            <button value="'+item.appointment_no+'" class="btn btn-danger btn-sm" id="btnCancelAppointment">Cancel</button>';
                            
                        }else if(item.status=="completed"){
                            
                            $statusBadge = '<span class="badge badge-light-success">Completed</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="cancelled"){
                            
                            $statusBadge = '<span class="badge badge-light-danger">Cancelled</span>';
                            $actionButton = '-';
                            
                        }
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.appointment_no+'</b></td>\
                            <td>'+item.donorRequestNo+'</td>\
                            <td>'+item.date+'</td>\
                            <td>'+item.time+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function fetchPendingAppointment()
        {
            var url = '{{ url("admin/dashboard/fetchPendingAppointment") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.appointments,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                        
                        $actionButton = '<button value="'+item.donorRequestNo+'" data-bs-toggle="modal" data-bs-target="#registrationModal" class="btn btn-primary btn-sm" id="btnOpenRegistration">Register</button>\
                        <button value="'+item.appointment_no+'" class="btn btn-danger btn-sm" id="btnCancelAppointment">Cancel</button>';
                        
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.appointment_no+'</b></td>\
                            <td>'+item.donorRequestNo+'</td>\
                            <td>'+item.date+'</td>\
                            <td>'+item.time+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function fetchCompletedAppointment()
        {
            var url = '{{ url("admin/dashboard/fetchCompletedAppointment") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.appointments,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-success">Completed</span>';
                        $actionButton = '-';
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.appointment_no+'</b></td>\
                            <td>'+item.donorRequestNo+'</td>\
                            <td>'+item.date+'</td>\
                            <td>'+item.time+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function fetchCancelledAppointment()
        {
            var url = '{{ url("admin/dashboard/fetchCancelledAppointment") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.appointments,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-danger">Cancelled</span>';
                        $actionButton = '-';
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.appointment_no+'</b></td>\
                            <td>'+item.donorRequestNo+'</td>\
                            <td>'+item.date+'</td>\
                            <td>'+item.time+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function searchAppointment()
        {
            var searchInput = $('#searchBar').val();
            
            var url = '{{ url("admin/dashboard/searchAppointment/:input") }}';
            url = url.replace(':input', searchInput);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.appointments,function(key,item){
                        
                        if(item.status=="pending"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                            
                            $actionButton = '<button value="'+item.donorRequestNo+'" data-bs-toggle="modal" data-bs-target="#registrationModal" class="btn btn-primary btn-sm" id="btnOpenRegistration">Register</button>\
                            <button value="'+item.appointment_no+'" class="btn btn-danger btn-sm" id="btnCancelAppointment">Cancel</button>';
                            
                        }else if(item.status=="completed"){
                            
                            $statusBadge = '<span class="badge badge-light-success">Completed</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="cancelled"){
                            
                            $statusBadge = '<span class="badge badge-light-danger">Cancelled</span>';
                            $actionButton = '-';
                            
                        }
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.appointment_no+'</b></td>\
                            <td>'+item.donorRequestNo+'</td>\
                            <td>'+item.date+'</td>\
                            <td>'+item.time+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        //cancel appointment
        $(document).on('click', '#btnDecline',function(e){
            e.preventDefault();
            var donorRequestNo = $(this).val();
            var email = $('#email').val();
            
            var data = {
                'email' : email
            }
            
            var url = '{{ url("admin/dashboard/declineDonorRequest/:id") }}';
            url = url.replace(':id', donorRequestNo);
            
            $('#btnDecline').text('Declining...');
            
            $.ajax({
                type:"PUT",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    if(response.status==200)
                    {
                        $('#btnDecline').removeClass('btn-danger');
                        $('#btnDecline').addClass('btn-success');
                        $('#btnDecline').text('Done');
                        
                        setTimeout(function(){
                            $('#btnDecline').removeClass('btn-success');
                            $('#btnDecline').addClass('btn-danger');
                            $('#btnDecline').text('Decline');
                        }, 3000);
                        fetchAppointment();
                    }
                }
            });
        });
        
        //cancel appointment
        $(document).on('click', '#btnCancelAppointment',function(e){
            e.preventDefault();
            var appointmentNo = $(this).val();
            var status = 'cancelled';
            var data = {
                'status' : status
            }
            
            var url = '{{ url("admin/dashboard/cancelAppointment/:id") }}';
            url = url.replace(':id', appointmentNo);
            
            $.ajax({
                type:"PUT",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    fetchAppointment();
                }
            });
        });
        
        //open donor registration form
        $(document).on('click', '#btnOpenRegistration',function(e){
            e.preventDefault();
            
            $('#no').val(Math.floor(Math.random() * (11500000 - 99500000 + 1) + 99500000));
            
            var donorRequestNo = $(this).val();
            
            var url = '{{ url("admin/dashboard/fetchSingleDonorRequest/:id") }}';
            url = url.replace(':id', donorRequestNo);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $.each(response.donorRequests,function(key,item){
                        $('#registrationDonorRequestNo').val(item.donorRequestNo);
                        $('#nic').val(item.nic);
                        $('#fullName').val(item.fullName);
                        $('#email').val(item.email);
                        $('#telephone').val(item.telephone);
                        $('#age').val(item.age);
                        $('#dateofbirth').val(item.dateOfBirth);
                        
                        
                        $('#btnDecline').val(item.donorRequestNo);
                    });
                }
            });
        });
        
        //insert data
        $(document).on('submit','#donorRegistrationFormPost',function(e){
            e.preventDefault();
            
            let registerFormData = new FormData($('#donorRegistrationFormPost')[0]);
            
            $('#btnRegister').text('Registering....');
            
            $.ajax({
                type: "POST",
                url: "{{ url('admin/dashboard/registerDonor') }}",
                data: registerFormData,
                contentType:false,
                processData:false,
                success: function(response) {
                    if(response.status==400)
                    {
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li><strong>'+err_value+'</strong></li>');
                        });
                        
                        $('#btnRegister').removeClass('btn-success');
                        $('#btnRegister').addClass('btn-primary');
                        $('#btnRegister').text('Register');
                    }
                    else if(response.status==200)
                    {
                        $('#errorList').html('');
                        $('#errorModalBody').addClass('d-none');
                        $('#errorList').addClass('d-none');
                        
                        $('#btnRegister').removeClass('btn-primary');
                        $('#btnRegister').addClass('btn-success');
                        $('#btnRegister').text('Registered and Mailed credentials to donor!');
                        
                        setTimeout(function(){
                            $('#btnRegister').removeClass('btn-success');
                            $('#btnRegister').addClass('btn-primary');
                            $('#btnRegister').text('Register');
                        }, 3000);
                    }
                }
            });
        });
        
    });
    
    //onchange select
    function checkMedicalCheckupStatus()
    {
        var medicalCheckupStatus = $('#lastMedicalCheckupStatusSelect').val();
        
        if(medicalCheckupStatus== 'pass')
        {
            $('#donorRegistrationForm').removeClass('d-none');
            $('#declinationForm').addClass('d-none');
        }
        else
        {
            $('#donorRegistrationForm').addClass('d-none');
            $('#declinationForm').removeClass('d-none');
        }
    }
</script>
@endsection
