@extends('hospital.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>DONORS</b></h3>
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
                            <option value="setActive" id="setActive">Active</option>
                            <option value="setInactive" id="setInactive">Inactive</option>
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
                                            <th scope="col"><b>Donor No.</b></th>
                                            <th scope="col">NIC</th>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Reg. Date</th>
                                            <th scope="col">Reg. Time</th>
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
<div class="modal fade bd-example-modal-lg" id="viewDonorModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Donor Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
              </button>
          </div>

          <div class="modal-body">

            <ul id="scheduleAppointmentErrorList" class="list-unstyled bg-danger form-control d-none">
            </ul>

            <div class="row g-3">

                <div class="col-md-3">
                    <img id="viewPhoto" class="form-control" src="" style="height:100px; object-fit: contain;">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="">Donor No.</label>
                    <input type="text" class="form-control text-dark" readonly id="viewDonorNo">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="">NIC No.</label>
                    <input type="text" class="form-control text-dark" readonly id="viewNic">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="">Telephone</label>
                    <input type="text" class="form-control text-dark" readonly id="viewTelephone">
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="">Full Name</label>
                    <input type="text" class="form-control text-dark" readonly id="viewFullname">
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="">Address</label>
                    <input type="text" class="form-control text-dark" readonly id="viewAddress">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="">Gender</label>
                    <input type="text" class="form-control text-dark" readonly id="viewGender">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="">Date of Birth</label>
                    <input type="text" class="form-control text-dark" readonly id="viewDateofbirth">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="">Age</label>
                    <input type="text" class="form-control text-dark" readonly id="viewAge">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="">Blood Group</label>
                    <input type="text" class="form-control text-dark" readonly id="viewBloodGroup">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="">Registered Date</label>
                    <input type="text" class="form-control text-dark" readonly id="viewRegisteredDate">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="">Registered Time</label>
                    <input type="text" class="form-control text-dark" readonly id="viewRegisteredTime">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="">Email</label>
                    <input type="text" class="form-control text-dark" readonly id="viewEmail">
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
            searchDonor();
        }
        else if(combo.selectedIndex == 2)
        {
            fetchActiveDonor();
            $('#searchBar').val('');
        }
        else if(combo.selectedIndex == 3)
        {
            fetchInactiveDonor();
            $('#searchBar').val('');
        }
        else
        {
            fetchDonor();
            $('#searchBar').val('');
        }

    }, 2000);
    
    //search data
    $('#searchBar').keyup(function(){   
        searchDonor();
    });

    //view donor form
    $(document).on('click', '#btnView',function(e){
        e.preventDefault();

        var donorNo = $(this).val();

        var url = '{{ url("hospital/dashboard/fetchSingleDonor/:id") }}';
        url = url.replace(':id', donorNo);

        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                $.each(response.donors,function(key,item){

                    var date_str = item.registered_date;
                    var date_str = date_str.slice(0, 10); 
                    
                    var time_str = item.registered_time;
                    var time_str = time_str.slice(11, 19); 

                    $('#viewPhoto').attr("src",item.photo);
                    $('#viewDonorNo').val(item.no);
                    $('#viewNic').val(item.nic);
                    $('#viewTelephone').val(item.telephone);
                    $('#viewFullname').val(item.fullname);
                    $('#viewAddress').val(item.address);
                    $('#viewGender').val(item.gender);
                    $('#viewBloodGroup').val(item.bloodGroup);
                    $('#viewDateofbirth').val(item.dateofbirth);
                    $('#viewAge').val(item.age);
                    $('#viewRegisteredDate').val(date_str);
                    $('#viewRegisteredTime').val(time_str);
                    $('#viewEmail').val(item.email);
                });
            }
        });
    });

    function fetchDonor()
    {
        var url = '{{ url("hospital/dashboard/fetchDonor") }}';

        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                $('tbody').html('');
                $.each(response.donors,function(key,item){

                    if(item.status=="active"){

                        $statusBadge = '<span class="badge badge-light-success">Active</span>';

                        $actionButton = '<button value="'+item.no+'" data-bs-toggle="modal" data-bs-target="#viewDonorModal" class="btn btn-primary btn-sm" id="btnView">View</button>\
                        <button value="'+item.no+'" class="btn btn-danger btn-sm" id="btnChangeStatusInactive">Deactivate</button>';

                    }else if(item.status=="inactive"){

                        $statusBadge = '<span class="badge badge-light-danger">Inactive</span>';
                        
                        $actionButton = '<button value="'+item.no+'" data-bs-toggle="modal" data-bs-target="#viewDonorModal" class="btn btn-primary btn-sm" id="btnView">View</button>\
                        <button value="'+item.no+'" class="btn btn-success btn-sm" id="btnChangeStatusActive">Activate</button>';

                    };

                    var date_str = item.registered_date;
                    var date_str = date_str.slice(0, 10); 
                    
                    var time_str = item.registered_time;
                    var time_str = time_str.slice(11, 19); 

                    $('tbody').append('<tr>\
                        <td><b>'+item.no+'</b></td>\
                        <td>'+item.nic+'</td>\
                        <td><img style="width:100px;" src="'+item.photo+'" alt=""></td>\
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

    function fetchActiveDonor()
    {
        var url = '{{ url("hospital/dashboard/fetchActiveDonor") }}';

        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                $('tbody').html('');
                $.each(response.donors,function(key,item){

                    $statusBadge = '<span class="badge badge-light-success">Active</span>';

                    $actionButton = '<button value="'+item.no+'" data-bs-toggle="modal" data-bs-target="#viewDonorModal" class="btn btn-primary btn-sm" id="btnView">View</button>\
                        <button value="'+item.no+'" class="btn btn-danger btn-sm" id="btnChangeStatusInactive">Deactivate</button>';

                    var date_str = item.registered_date;
                    var date_str = date_str.slice(0, 10); 
                    
                    var time_str = item.registered_time;
                    var time_str = time_str.slice(11, 19); 

                    $('tbody').append('<tr>\
                        <td><b>'+item.no+'</b></td>\
                        <td>'+item.nic+'</td>\
                        <td><img style="width:100px;" src="'+item.photo+'" alt=""></td>\
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

    function fetchInactiveDonor()
    {
        var url = '{{ url("hospital/dashboard/fetchInactiveDonor") }}';

        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                $('tbody').html('');
                $.each(response.donors,function(key,item){

                    $statusBadge = '<span class="badge badge-light-danger">Inactive</span>';
                        
                    $actionButton = '<button value="'+item.no+'" data-bs-toggle="modal" data-bs-target="#viewDonorModal" class="btn btn-primary btn-sm" id="btnView">View</button>\
                        <button value="'+item.no+'" class="btn btn-success btn-sm" id="btnChangeStatusActive">Activate</button>';

                    var date_str = item.registered_date;
                    var date_str = date_str.slice(0, 10); 
                    
                    var time_str = item.registered_time;
                    var time_str = time_str.slice(11, 19); 

                    $('tbody').append('<tr>\
                        <td><b>'+item.no+'</b></td>\
                        <td>'+item.nic+'</td>\
                        <td><img style="width:100px;" src="'+item.photo+'" alt=""></td>\
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

    function searchDonor()
    {
        var searchInput = $('#searchBar').val();

        var url = '{{ url("hospital/dashboard/searchDonor/:input") }}';
        url = url.replace(':input', searchInput);

        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                $('tbody').html('');
                $.each(response.donors,function(key,item){

                    if(item.status=="active"){

                        $statusBadge = '<span class="badge badge-light-success">Active</span>';

                        $actionButton = '<button value="'+item.no+'" data-bs-toggle="modal" data-bs-target="#viewDonorModal" class="btn btn-primary btn-sm" id="btnView">View</button>\
                        <button value="'+item.no+'" class="btn btn-danger btn-sm" id="btnChangeStatusInactive">Deactivate</button>';

                    }else if(item.status=="inactive"){

                        $statusBadge = '<span class="badge badge-light-danger">Inactive</span>';
                        
                        $actionButton = '<button value="'+item.no+'" data-bs-toggle="modal" data-bs-target="#viewDonorModal" class="btn btn-primary btn-sm" id="btnView">View</button>\
                        <button value="'+item.no+'" class="btn btn-success btn-sm" id="btnChangeStatusActive">Activate</button>';

                    };

                    var date_str = item.registered_date;
                    var date_str = date_str.slice(0, 10); 
                    
                    var time_str = item.registered_time;
                    var time_str = time_str.slice(11, 19); 

                    $('tbody').append('<tr>\
                        <td><b>'+item.no+'</b></td>\
                        <td>'+item.nic+'</td>\
                        <td><img style="width:100px;" src="'+item.photo+'" alt=""></td>\
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

    //change record status
    $(document).on('click', '#btnChangeStatusActive',function(e){
        e.preventDefault();
        var changeStatusId = $(this).val();
        var status = 'active';
        var data = {
            'status' : status
        }

        var url = '{{ url("hospital/dashboard/changeDonorStatus/:id") }}';
        url = url.replace(':id', changeStatusId);

        $.ajax({
            type:"PUT",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                fetchDonor();
            }
        });
    });

    //change record status
    $(document).on('click', '#btnChangeStatusInactive',function(e){
        e.preventDefault();
        var changeStatusId = $(this).val();
        var status = 'inactive';
        var data = {
            'status' : status
        }

        var url = '{{ url("hospital/dashboard/changeDonorStatus/:id") }}';
        url = url.replace(':id', changeStatusId);

        $.ajax({
            type:"PUT",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                fetchDonor();
            }
        });
    });
    
});
</script>
@endsection
