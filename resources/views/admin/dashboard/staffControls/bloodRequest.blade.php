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

});

</script>
@endsection
