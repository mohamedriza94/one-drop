@extends('admin.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>BLOOD REQUESTS</b></h3>
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
                            <option value="setWaiting" id="setWaiting">Waiting</option>
                            <option value="setFulfilled" id="setFulfilled">Fulfilled</option>
                            <option value="setDeclined" id="setDeclined">Declined</option>
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
                                            <th scope="col"><b>Req. No.</b></th>
                                            <th scope="col">Blood Group</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="bloodRequestTableBody">
                                        
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

{{-- modal --}}
<div class="modal fade bd-example-modal-xl" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Check Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            
            <div class="modal-body d-none" id="errorModalBody">
                <ul class="bg-warning form-control px-5 d-none" id="errorList">
                </ul>
            </div>
            
            <div id="checkRequest" class="modal-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label" for="">Request No.</label>
                        <input type="text" class="form-control text-dark" readonly id="requestNo">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label" for="">NIC No.</label>
                        <input type="text" class="form-control text-dark" readonly id="nicNo">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label" for="">Telephone</label>
                        <input type="text" class="form-control text-dark" readonly id="telephone">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label" for="">Blood Group</label>
                        <input type="text" class="form-control text-dark" readonly id="bloodGroup">
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label" for="">Full Name</label>
                        <input type="text" class="form-control text-dark" readonly id="fullName">
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label" for="">Email</label>
                        <input type="text" class="form-control text-dark" readonly id="email">
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label" for="">Date & Time</label>
                        <input type="text" class="form-control text-dark" readonly id="dateAndTime">
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label" for="">Status</label>
                        <input type="text" class="form-control text-dark" readonly id="requestStatus">
                    </div>
                </div>
                
                <hr class="border-dark">
                
                <div class="row g-3 d-none" id="haveBlood">
                    <div class="col-md-12">
                        <label class="form-label" id="availableBloodTypeLabel" for=""></label>
                        <select id="availableBlood" class="form-control">
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button class="form-control btn btn-primary" id="btnProvide">Provide</button>
                    </div>
                </div>
                
                <div class="row g-3 d-none" id="confirmationSection">
                    <div class="col-md-6">
                        <button class="form-control btn btn-outline-success" id="btnYes">Confirm</button>
                    </div>
                    
                    <div class="col-md-6">
                        <button class="form-control btn btn-outline-danger" id="btnNo">No</button>
                    </div>
                </div>
                
                <div class="row g-3 d-none" id="noBlood">
                    <div class="col-md-12">
                        <label class="form-label text-danger" for=""><strong>BLOOD UNAVAILABLE</strong></label>
                    </div>
                    
                    <div class="col-md-4">
                        <button class="btn btn-warning form-control" id="btnWaiting">Put in Waiting List</button>
                    </div>
                    
                    <div class="col-md-4">
                        <button class="btn btn-light form-control" id="btnRequestFromHospital">Request From Hospital</button>
                    </div>
                    
                    <div class="col-md-4">
                        <button class="btn btn-danger form-control" id="btnDecline">Decline</button>
                    </div>
                </div>
                
                <div class="row g-3 d-none" id="hospitalNoBlood">
                    <div class="col-md-12">
                        <label class="form-label text-danger" for=""><strong>NO BLOOD AT HOSPITAL</strong></label>
                    </div>
                    
                    <div class="col-md-12">
                        <button class="btn btn-danger form-control" id="btnDeclineHospitalNoBlood">Decline</button>
                    </div>
                </div>
                
                <div class="row invoice layout-top-spacing layout-spacing d-none" id="invoiceBody">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        
                        <div class="doc-container">
                            
                            <div class="row">
                                
                                <div class="col-xl-9">
                                    
                                    <div class="invoice-container">
                                        <div class="invoice-inbox">
                                            
                                            <div id="ct" class="">
                                                
                                                <div class="invoice-00001">
                                                    <div class="content-section">
                                                        
                                                        <div class="inv--head-section inv--detail-section">
                                                            
                                                            <div class="row">
                                                                
                                                                <div class="col-sm-6 col-12 mr-auto">
                                                                    <div class="d-flex">
                                                                        <img src="{{asset('assets/admin/src/assets/img/authLogo.png')}}" style="width: 100px;">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-sm-6 text-sm-end">
                                                                    <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4" id="invRequestNo"></p>
                                                                    <p class="inv-created-date mt-sm-5 mt-3" id="invDate"></p>
                                                                    <p class="inv-due-date" id="invTime"></p>
                                                                </div>                                                                
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="inv--detail-section inv--customer-detail-section">
                                                            
                                                            <div class="row">
                                                                
                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                                    <p class="inv-to">Blood To:</p>
                                                                </div>
                                                                
                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                                    <p class="inv-customer-name" id="invFullname">full name</p>
                                                                    <p class="inv-street-addr" id="invNic">NIC</p>
                                                                    <p class="inv-email-address" id="invEmail">email</p>
                                                                    <p class="inv-email-address" id="invTelephone">telephone</p>
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="inv--product-table-section">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead class="">
                                                                        <tr>
                                                                            <th scope="col">Request No.</th>
                                                                            <th scope="col">Bag No.</th>
                                                                            <th class="text-end" scope="col">Blood Group</th>
                                                                            <th class="text-end" scope="col">Expiry Date</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td id="invTableRequestNo"></td>
                                                                            <td id="invTableBagNo"></td>
                                                                            <td class="text-end" id="invTableBloodGroup"></td>
                                                                            <td class="text-end" id="invTableExpiryDate"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="inv--note">
                                                            
                                                            <div class="row mt-4">
                                                                <hr class="border border-darl">
                                                                <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                                    <p><b>STAFF MEMBER:</b> Name: {{ auth()->guard('admin')->user()->fullname }} &nbsp;&nbsp;
                                                                        Telephone: {{ auth()->guard('admin')->user()->telephone }}</p>
                                                                        <p>Thank you for using Life Saver Drop Services.</p>
                                                                        
                                                                        <input type="hidden" id="staffName" value="{{ auth()->guard('admin')->user()->fullname }}">
                                                                        <input type="hidden" id="staffTelephone" value="{{ auth()->guard('admin')->user()->telephone }}">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            
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
        
        var publicURL = '';
        var customURL = '';
        
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
                var searchInput = $('#searchBar').val();
                
                var customURL = '{{ url("admin/dashboard/searchRequest/:input") }}';
                customURL = customURL.replace(':input', searchInput);
                
                publicURL = customURL;
            }
            else if(combo.selectedIndex == 5)
            {
                publicURL = '{{ url("admin/dashboard/fetchDeclinedRequest") }}';
            }
            else if(combo.selectedIndex == 4)
            {
                publicURL = '{{ url("admin/dashboard/fetchFulfilledRequest") }}';
            }
            else if(combo.selectedIndex == 3)
            {
                publicURL = '{{ url("admin/dashboard/fetchWaitingRequest") }}';
            }
            else if(combo.selectedIndex == 2)
            {
                publicURL = '{{ url("admin/dashboard/fetchPendingRequest") }}';
            }
            else
            {
                publicURL = '{{ url("admin/dashboard/fetchRequest") }}';
            }
            
            fetchRequest();
            
        }, 2000);
        
        function fetchRequest()
        {
            $.ajax({
                type:"GET",
                url:publicURL,
                dataType:"json",
                success:function(response){
                    $('#bloodRequestTableBody').html('');
                    $.each(response.requests,function(key,item){
                        
                        if(item.status=="pending"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                            
                            $actionButton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#checkModal" class="btn btn-light btn-sm" id="btnOpenCheck">Check</button>';
                            
                        }else if(item.status=="waiting"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Waiting</span>';
                            $actionButton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#checkModal" class="btn btn-primary btn-sm" id="btnOpenCheck">Check</button>';
                            
                        }else if(item.status=="fulfilled"){
                            
                            $statusBadge = '<span class="badge badge-light-success">Fulfilled</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="declined"){
                            
                            $statusBadge = '<span class="badge badge-light-danger">Declined</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="requestedHospital"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Requested</span>';
                            $actionButton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#checkModal" class="btn btn-light btn-sm" id="btnOpenCheck">Check</button>';
                            
                        }
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('#bloodRequestTableBody').append('<tr>\
                            <td><b>'+item.requestNo+'</b></td>\
                            <td><strong>'+item.bloodGroup+'</strong></td>\
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
        
        $(document).on('click', '#btnOpenCheck',function(e){
            e.preventDefault();
            var requestId = $(this).val();
            
            $('#invoiceBody').addClass('d-none');
            $('#confirmationSection').addClass('d-none');
            $('#btnProvide').removeClass('d-none');
            
            var url = '{{ url("admin/dashboard/fetchSingleRequest/:id") }}';
            url = url.replace(':id', requestId);
            
            $.ajax({
                type:"GET", url:url,
                success: function (response){
                    if(response.status==404){
                        
                        alert('Request Not Found!');
                        
                    }else{
                        
                        $('#requestNo').val(response.requests.requestNo);
                        $('#nicNo').val(response.requests.nic);
                        $('#telephone').val(response.requests.telephone);
                        $('#bloodGroup').val(response.requests.bloodGroup);
                        $('#fullName').val(response.requests.fullName);
                        $('#email').val(response.requests.email);
                        $('#dateAndTime').val(response.requests.date);
                        
                        
                        var date_str = new Date().toLocaleDateString(); 
                        
                        var time_str = new Date().toLocaleTimeString(); 
                        
                        //invoice details start
                        $('#invRequestNo').html('<span class="inv-title">Request No : </span> <span class="inv-number">'+response.requests.requestNo+'</span>');
                        $('#invDate').html('<span class="inv-title">Date : </span> <span class="inv-date">'+date_str+'</span>');
                        $('#invTime').html('<span class="inv-title">Time : </span> <span class="inv-date">'+time_str+'</span>');
                        $('#invFullname').text(response.requests.fullName);
                        $('#invNic').text(response.requests.nic);
                        $('#invEmail').text(response.requests.email);
                        $('#invTelephone').text(response.requests.telephone);
                        
                        $('#invTableRequestNo').text(response.requests.requestNo);
                        //end
                        
                        $('#btnWaiting').val(response.requests.requestNo);
                        $('#btnYes').val(response.requests.requestNo);
                        $('#btnDecline').val(response.requests.requestNo);
                        $('#btnDeclineHospitalNoBlood').val(response.requests.requestNo);
                        $('#btnRequestFromHospital').val(response.requests.requestNo);
                        
                        if(response.requests.status == 'requestedHospital')
                        {
                            $('#requestStatus').val('Forwarded to Hospital');
                        }
                        else
                        {
                            $('#requestStatus').val(response.requests.status);
                        }
                        
                        if(response.requests.hospitalResponse == 'responded')
                        {
                            if(response.requests.remark=='Blood Provided')
                            {
                                $('#haveBlood').removeClass('d-none');
                                $('#noBlood').addClass('d-none');
                                $('#hospitalNoBlood').addClass('d-none');
                            }
                            else
                            {
                                $('#noBlood').addClass('d-none');
                                $('#haveBlood').addClass('d-none');
                                $('#hospitalNoBlood').removeClass('d-none');
                            }

                            $('#availableBloodTypeLabel').text('Available '+response.requests.bloodGroup+' Blood');
                            
                            var bloodBagId = response.requests.bloodBagNo;
                            var urlFetchBlood = '{{ url("admin/dashboard/fetchHospitalProvidedBlood/:bloodBagId") }}';
                            urlFetchBlood = urlFetchBlood.replace(':bloodBagId', bloodBagId);
                            
                            $.ajax({
                                type:"GET", url:urlFetchBlood,
                                success: function (response){

                                    $('#availableBlood').html('');
                                    $.each(response.blood_bags,function(key,item){
                                        
                                        $('#availableBlood').append('<option value="'+item.bag_no+'">'+item.bag_no+' &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; Expires on ' +item.expiry_date+'</option>\
                                        ');
                                    });
                                }
                            });
                        }
                        else
                        {
                            $('#availableBloodTypeLabel').text('Available '+response.requests.bloodGroup+' Blood');
                            
                            var bloodGroup = response.requests.bloodGroup;
                            var urlFetchBlood = '{{ url("admin/dashboard/fetchAvailableBlood/:bloodGroup") }}';
                            urlFetchBlood = urlFetchBlood.replace(':bloodGroup', bloodGroup);
                            
                            $.ajax({
                                type:"GET", url:urlFetchBlood,
                                success: function (response){
                                    if(response.status==404){
                                        $('#haveBlood').addClass('d-none');
                                        $('#noBlood').removeClass('d-none');
                                    }
                                    else{
                                        $('#haveBlood').removeClass('d-none');
                                        $('#noBlood').addClass('d-none');
                                        
                                        $('#availableBlood').html('');
                                        $.each(response.blood_bags,function(key,item){
                                            
                                            $('#availableBlood').append('<option value="'+item.bag_no+'">'+item.bag_no+' &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; Expires on ' +item.expiry_date+'</option>\
                                            ');
                                        });
                                    }
                                }
                            });
                        }
                        
                        
                        
                    }
                }
            });
        });
        
        $(document).on('click', '#btnWaiting',function(e){
            e.preventDefault();
            var requestId = $(this).val();
            var status = 'waiting';
            var email = $('#email').val();
            var data = {
                'status' : status, 
                'email' : email
            }
            $('#btnWaiting').text('...');
            
            var url = '{{ url("admin/dashboard/requestChangeStatus/:id") }}';
            url = url.replace(':id', requestId);
            
            $.ajax({
                type:"PUT",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    if(response.status==200)
                    {
                        $('#btnWaiting').text('Done');
                        $('#btnWaiting').removeClass('btn-warning');
                        $('#btnWaiting').addClass('btn-success');
                        
                        setTimeout(function(){
                            $('#btnWaiting').text('Put in Waiting List');
                            $('#btnWaiting').removeClass('btn-success');
                            $('#btnWaiting').addClass('btn-warning');
                            $('#checkModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#btnDecline',function(e){
            e.preventDefault();
            var requestId = $(this).val();
            var status = 'declined';
            var email = $('#email').val();
            var data = {
                'status' : status, 
                'email' : email
            }
            
            $('#btnDecline').text('...');
            
            var url = '{{ url("admin/dashboard/requestChangeStatus/:id") }}';
            url = url.replace(':id', requestId);
            
            $.ajax({
                type:"PUT",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    if(response.status==200)
                    {
                        $('#btnDecline').text('Done');
                        $('#btnDecline').removeClass('btn-danger');
                        $('#btnDecline').addClass('btn-success');
                        
                        setTimeout(function(){
                            $('#btnDecline').text('Decline');
                            $('#btnDecline').removeClass('btn-success');
                            $('#btnDecline').addClass('btn-danger');
                            $('#checkModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#btnDeclineHospitalNoBlood',function(e){
            e.preventDefault();
            var requestId = $(this).val();
            var status = 'declined';
            var email = $('#email').val();
            var data = {
                'status' : status, 
                'email' : email
            }
            
            $('#btnDecline').text('...');
            
            var url = '{{ url("admin/dashboard/requestChangeStatus/:id") }}';
            url = url.replace(':id', requestId);
            
            $.ajax({
                type:"PUT",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    if(response.status==200)
                    {
                        $('#btnDeclineHospitalNoBlood').text('Done');
                        $('#btnDeclineHospitalNoBlood').removeClass('btn-danger');
                        $('#btnDeclineHospitalNoBlood').addClass('btn-success');
                        
                        setTimeout(function(){
                            $('#btnDeclineHospitalNoBlood').text('Decline');
                            $('#btnDeclineHospitalNoBlood').removeClass('btn-success');
                            $('#btnDeclineHospitalNoBlood').addClass('btn-danger');
                            $('#checkModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#btnRequestFromHospital',function(e){
            e.preventDefault();
            var bloodGroup = $('#bloodGroup').val();
            var requestId = $(this).val();
            var status = 'requestedHospital';
            var email = $('#email').val();
            var data = {
                'status' : status, 
                'bloodGroup' : bloodGroup, 
                'email' : email
            }
            
            $('#btnRequestFromHospital').text('Sending...');
            
            var url = '{{ url("admin/dashboard/requestChangeStatus/:id") }}';
            url = url.replace(':id', requestId);
            
            $.ajax({
                type:"PUT",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    if(response.status==200)
                    {
                        $('#btnRequestFromHospital').text('Done');
                        $('#btnRequestFromHospital').removeClass('btn-light');
                        $('#btnRequestFromHospital').addClass('btn-success');
                        
                        setTimeout(function(){
                            $('#btnRequestFromHospital').text('Request From Hospital');
                            $('#btnRequestFromHospital').removeClass('btn-success');
                            $('#btnRequestFromHospital').addClass('btn-light');
                            $('#checkModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#btnProvide',function(e){
            
            var bloodBagId = $('#availableBlood').val();
            var url = '{{ url("admin/dashboard/fetchChosenBlood/:bloodBagId") }}';
            url = url.replace(':bloodBagId', bloodBagId);
            
            $.ajax({
                type:"GET", 
                url:url,
                success: function (response){
                    $('#invTableBagNo').html(response.blood_bags.bag_no);
                    $('#invTableBloodGroup').text(response.blood_bags.bloodGroup);
                    $('#invTableExpiryDate').text(response.blood_bags.expiry_date);
                    $('#confirmationSection').removeClass('d-none');
                    $('#btnProvide').addClass('d-none');
                }
            });
        });
        
        $(document).on('click', '#btnYes',function(e){
            e.preventDefault();
            var requestId = $(this).val();
            var bloodBagNo = $('#availableBlood').val();
            
            //invoice
            var requestNo = $(this).val();
            var date = new Date().toLocaleDateString(); 
            var time = new Date().toLocaleTimeString(); 
            var fullname = $('#invFullname').text();
            var nic = $('#invNic').text();
            var email = $('#invEmail').text();
            var telephone = $('#invTelephone').text();
            var bagNo = $('#invTableBagNo').text();
            var bloodGroup = $('#invTableBloodGroup').text();
            var expiryDate = $('#invTableExpiryDate').text();
            var staffName = $('#staffName').val();
            var staffTelephone = $('#staffTelephone').val();
            
            var data = {
                'requestId' : requestId, 
                'bloodBagNo' : bloodBagNo, 
                
                //invoice
                'requestNo' : requestNo,
                'date' : date,
                'time' : time,
                'fullname' : fullname,
                'nic' : nic,
                'email' : email,
                'telephone' : telephone,
                'bagNo' : bagNo,
                'bloodGroup' : bloodGroup,
                'expiryDate' : expiryDate,
                'staffName' : staffName,
                'staffTelephone' : staffTelephone
            }
            
            $('#btnYes').text('Loading...');
            
            var url = '{{ url("admin/dashboard/acceptBloodRequest") }}';
            
            $.ajax({
                type:"PUT",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    if(response.status==200)
                    {
                        $('#btnYes').text('Done');
                        $('#btnYes').removeClass('btn-outline-success');
                        $('#btnYes').addClass('btn-success');
                        
                        setTimeout(function(){
                            $('#btnYes').text('Confirm');
                            $('#btnYes').removeClass('btn-success');
                            $('#btnYes').addClass('btn-outline-success');
                            $('#checkModal').modal('hide');
                            $('#confirmationSection').addClass('d-none');
                            $('#btnProvide').removeClass('d-none');
                        }, 2000);
                    }
                    else
                    {
                        alert('Some Error! Please Try Again');
                    }
                }
            });
        });
        
        $(document).on('click', '#btnNo',function(e){
            $('#invoiceBody').addClass('d-none');
            $('#confirmationSection').addClass('d-none');
            $('#btnProvide').removeClass('d-none');
        });
    });
    
</script>
@endsection
