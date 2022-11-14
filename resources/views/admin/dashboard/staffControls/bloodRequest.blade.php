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
                        <select id="availableBood" class="form-control">
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button class="form-control btn btn-primary" id="btnProvide">Provide</button>
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
                        <button class="btn btn-success form-control" id="btnRequestFromHospital">Request From Hospital</button>
                    </div>
                    
                    <div class="col-md-4">
                        <button class="btn btn-danger form-control" id="btnDecline">Decline</button>
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
                searchRequest();
            }
            else if(combo.selectedIndex == 5)
            {
                fetchDeclinedRequest();
            }
            else if(combo.selectedIndex == 4)
            {
                fetchFulfilledRequest();
            }
            else if(combo.selectedIndex == 3)
            {
                fetchWaitingRequest();
            }
            else if(combo.selectedIndex == 2)
            {
                fetchPendingRequest();
            }
            else
            {
                fetchRequest();
            }
            
        }, 2000);
        
        function fetchRequest()
        {
            var url = '{{ url("admin/dashboard/fetchRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.requests,function(key,item){
                        
                        if(item.status=="pending"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                            
                            $actionButton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#checkModal" class="btn btn-light btn-sm" id="btnOpenCheck">Check</button>';
                            
                        }else if(item.status=="waiting"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Waiting</span>';
                            $actionButton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#checkModal" class="btn btn-light btn-sm" id="btnOpenCheck">Check</button>';
                            
                        }else if(item.status=="fulfilled"){
                            
                            $statusBadge = '<span class="badge badge-light-success">Fulfilled</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="declined"){
                            
                            $statusBadge = '<span class="badge badge-light-danger">Declined</span>';
                            $actionButton = '-';
                            
                        }
                        
                        $('#btnWaiting').val(item.id);
                        $('#btnDecline').val(item.id);
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
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
        
        function fetchWaitingRequest()
        {
            var url = '{{ url("admin/dashboard/fetchWaitingRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.requests,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-warning">Waiting</span>';
                        $actionButton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#checkModal" class="btn btn-light btn-sm" id="btnOpenCheck">Check</button>';
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        $('#btnWaiting').val(item.id);
                        $('#btnDecline').val(item.id);
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
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
        
        function fetchPendingRequest()
        {
            var url = '{{ url("admin/dashboard/fetchPendingRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.requests,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                        $actionButton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#checkModal" class="btn btn-light btn-sm" id="btnOpenCheck">Check</button>';
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        $('#btnWaiting').val(item.id);
                        $('#btnDecline').val(item.id);
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
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
        
        function fetchFulfilledRequest()
        {
            var url = '{{ url("admin/dashboard/fetchFulfilledRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.requests,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-success">Fulfilled</span>';
                        $actionButton = '-';
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        $('#btnWaiting').val(item.id);
                        $('#btnDecline').val(item.id);
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
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
        
        function fetchDeclinedRequest()
        {
            var url = '{{ url("admin/dashboard/fetchDeclinedRequest") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.requests,function(key,item){
                        
                        $statusBadge = '<span class="badge badge-light-danger">Declined</span>';
                        $actionButton = '-';
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        $('#btnWaiting').val(item.id);
                        $('#btnDecline').val(item.id);
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
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
        
        function searchRequest()
        {
            var searchInput = $('#searchBar').val();
            
            var url = '{{ url("admin/dashboard/searchRequest/:input") }}';
            url = url.replace(':input', searchInput);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.requests,function(key,item){
                        
                        if(item.status=="pending"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Pending</span>';
                            
                            $actionButton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#checkModal" class="btn btn-light btn-sm" id="btnOpenCheck">Check</button>';
                            
                        }else if(item.status=="waiting"){
                            
                            $statusBadge = '<span class="badge badge-light-warning">Waiting</span>';
                            $actionButton = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#checkModal" class="btn btn-light btn-sm" id="btnOpenCheck">Check</button>';
                            
                        }else if(item.status=="fulfilled"){
                            
                            $statusBadge = '<span class="badge badge-light-success">Fulfilled</span>';
                            $actionButton = '-';
                            
                        }else if(item.status=="declined"){
                            
                            $statusBadge = '<span class="badge badge-light-danger">Declined</span>';
                            $actionButton = '-';
                            
                        }
                        
                        $('#btnWaiting').val(item.id);
                        $('#btnDecline').val(item.id);
                        
                        var date_str = item.date;
                        var date_str = date_str.slice(0, 10); 
                        
                        
                        var time_str = item.time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('tbody').append('<tr>\
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
            
            var url = '{{ url("admin/dashboard/fetchSingleRequest/:id") }}';
            url = url.replace(':id', requestId);
            
            $.ajax({
                type:"GET", url:url,
                success: function (response){
                    if(response.status==404){
                        
                        alert('Request Not Found!');
                        
                    }else{
                        
                        $('#requestNo').val(response.requests.id);
                        $('#nicNo').val(response.requests.nic);
                        $('#telephone').val(response.requests.telephone);
                        $('#bloodGroup').val(response.requests.bloodGroup);
                        $('#fullName').val(response.requests.fullName);
                        $('#email').val(response.requests.email);
                        $('#dateAndTime').val(response.requests.date);
                        $('#requestStatus').val(response.requests.status);
                        
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
                                    
                                    $('#availableBood').html('');
                                    $.each(response.blood_bags,function(key,item){
                                        
                                        $('#availableBood').append('<option value="'+item.bag_no+'">'+item.bag_no+' &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; Expires on ' +item.expiry_date+'</option>\
                                        ');
                                    });
                                }
                            }
                        });
                        
                    }
                }
            });
        });
        
        $(document).on('click', '#btnWaiting',function(e){
            e.preventDefault();
            var requestId = $(this).val();
            var status = 'waiting';
            var data = {
                'status' : status
            }
            
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
        
    });
    
</script>
@endsection
