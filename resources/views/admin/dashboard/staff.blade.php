@extends('admin.layouts.master')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="header layout-top-spacing">
                <h3 class=""><b>STAFF MANAGEMENT</b></h3>
                <hr>
            </div>
            
            <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="alert">
                <strong></strong>
            </div>
            
            <div class="widget-content widget-content-area">
                    <div class="col-lg-12 col-12 ">
                        <form>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Search with Staff NIC No." id="searchBar">
                                </div>

                                <div class="col-3">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-primary btn-lg form-control" id="addModalOpen">Add Staff Member</a>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 mb-4">
                                    <select id="filter" class="form-select form-select" aria-label="Default select example">
                                        <option selected="" disabled>Filter</option>
                                        <option value="setnofilter" id="setnofilter">No filter</option>
                                        <option value="setactive" id="setactive">Active</option>
                                        <option value="setinactive" id="setinactive">Inactive</option>
                                    </select>
                                </div>
                                
                            </div>
                        </form>
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
                                            <th scope="col"><b>Staff No.</b></th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Telephone</th>
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

            <!-- Modal -->
            <div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contentLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                      </button>
                  </div>

                  <div class="modal-body d-none" id="errorModalBody">
                    <ul class="bg-warning form-control px-5 d-none" id="errorList">
                        
                    </ul>
                </div>

                <!-- Asssign staff to hospital -->
                <div class="modal-body d-none" id="assignModalBody">
                    <form id="" class="row g-3" method="POST">
                        
                    <input type="hidden" class="form-control" id="assignId" name="assignId" value="">

                        <div class="col-md-12">
                          <label class="form-label"><b>Choose Hospital</b></label>
                          <select class="form-control" id="chooseHospital">
                          </select>
                        </div>

                        <div class="col-md-12">
                      <button class="btn btn-primary form-control" id="btnAssign">Assign</button>
                  </div>
                  </form>
              </div>

                <!-- view data -->
                <div class="modal-body d-none" id="viewModalBody">

                    <form class="row g-3" method="POST" enctype="multipart/form-data">

                        <input type="hidden" id="viewHospitalId">

                        <div class="col-md-12">
                            <img id="viewPhoto" class="form-control" src="" style="height:300px; object-fit: contain;">
                        </div>

                        <div class="col-md-12">
                          <label class="form-label" id="view_nic"></label>
                        </div>

                        <div class="col-md-12">
                          <label class="form-label" id="view_telephone"></label>
                        </div>

                        <div class="col-md-12">
                          <label class="form-label" id="view_gender"></label>
                        </div>

                        <div class="col-md-12">
                          <label class="form-label" id="view_dateOfBirth"></label>
                        </div>

                        <div class="col-md-12">
                          <label class="form-label" id="view_fullName"></label>
                        </div>

                        <div class="col-md-12">
                          <label class="form-label" id="view_address"></label>
                        </div>
                        
                        <div class="col-md-12">
                          <label class="form-label" id="view_email"></label>
                        </div>
                        
                        <div class="col-md-12">
                          <label class="form-label" id="view_hospital"></label>
                        </div>
                  </form>
              </div>

              <!-- delete data -->
              <div class="modal-body d-none" id="deleteModalBody">

                <div class="row g-3">
                  
                    <input type="hidden" class="form-control" id="deleteId" name="deleteId">

                    <div class="col-md-12">
                        Are you sure you want to delete this staff member?
                    </div>

                    

                  <div class="col-md-6">
                      <a class="btn btn-danger form-control" id="btnDelete">Yes</a>
                  </div>

                  <div class="col-md-6">
                    <a class="btn btn-primary form-control" data-bs-dismiss="modal">No</a>
                </div>
                  
                </div>
          </div>
          
          <!-- update data -->
          <div class="modal-body d-none" id="updateModalBody">

            <form id="updateForm" class="row g-3" method="POST" enctype="multipart/form-data">
              
                <input type="hidden" class="form-control" id="updateId" name="updateId" value="">

                <div class="col-md-12">
                    <img id="update_viewPhoto" class="form-control" src="" style="height:300px; object-fit: contain;">
                </div>

                <div class="col-md-6">
                  <label class="form-label">NIC No.</label>
                  <input type="text" class="form-control" id="update_nic" name="update_nic" value="">
              </div>

              <div class="col-md-6">
                  <label class="form-label">Telephone</label>
                  <input type="text" class="form-control" id="update_telephone" name="update_telephone" value="">
              </div>

              <div class="col-md-12">
                  <label class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="update_fullName" name="update_fullName" value="">
              </div>

              <div class="col-md-12">
                  <label class="form-label">Address</label>
                  <input  type="text" class="form-control" id="update_address" name="update_address" value="">
              </div>

              <div class="col-md-6">
                  <label class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" id="update_dateOfBirth" name="update_dateOfBirth" value="">
              </div>

              <div class="col-md-6">
                  <label class="form-label">Photo</label>
                  <input type="file" class="form-control" id="update_photo" name="update_photo" value="">
              </div>

              <div class="col-md-12">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" id="update_email" name="update_email" value="">
              </div>

              <div class="col-md-12">
                  <button class="btn btn-primary form-control" type="submit" id="btnUpdate">Save</button>
              </div>
          </form>
      </div>

      <!-- //add data -->
      <div class="modal-body d-none" id="addModalBody">

        <form id="addForm" class="row g-3" method="POST" enctype="multipart/form-data">
           
            <div class="col-md-4">
              <label class="form-label">Staff No.</label>
              <input type="text" class="form-control" id="no" name="no" readonly value="">
          </div>

          <div class="col-md-4">
              <label class="form-label">NIC No.</label>
              <input type="text" class="form-control" id="nic" name="nic" value="">
          </div>

          <div class="col-md-4">
              <label class="form-label">Telephone</label>
              <input type="text" class="form-control" id="telephone" name="telephone" value="">
          </div>

          <div class="col-md-12">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" id="fullName" name="fullName" value="">
          </div>

          <div class="col-md-12">
              <label class="form-label">Address</label>
              <input  type="text" class="form-control" id="address" name="address" value="">
          </div>


          <div class="col-md-6">
              <label class="form-label">Date of Birth</label>
              <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" value="">
          </div>

          <div class="col-md-6">
              <label class="form-label">Gender</label>
              <select class="form-control" id="gender" name="gender">
                <option value="male">male</option>
                <option value="female">female</option>
            </select>
        </div>

        <div class="col-md-12">
            <label class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="col-md-6">
          <label class="form-label">Status</label>
          <select name="status" id="status" class="form-control">
            <option value="active">active</option>
            <option value="inactive">inactive</option>
        </select>
    </div>

    <div class="col-md-12">
      <button class="btn btn-primary form-control" type="submit" id="btnAdd">Save</button>
  </div>
</form>
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

//csrf token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

fetchHospitalToAssign();

//open add data bootstrap modal
$(document).on('click', '#addModalOpen',function(e){
   e.preventDefault();

   $('#addModalBody').removeClass('d-none');
   $('#assignModalBody').addClass('d-none');
   $('#updateModalBody').addClass('d-none');
   $('#deleteModalBody').addClass('d-none');
   $('#viewModalBody').addClass('d-none');
   $('#contentLabel').text('Staff Registration');

 //generate random number
 $('#no').val(Math.floor(Math.random() * (11500000000 - 9950000000000 + 1) + 9950000000000));
});

//insert data
$(document).on('submit','#addForm',function(e){
    e.preventDefault();

    let addFormData = new FormData($('#addForm')[0]);
    
    $('#btnAdd').text('Saving Data and Mailing Password....');

    $.ajax({
        type: "POST",
        url: "{{ url('admin/dashboard/insertStaff') }}",
        data: addFormData,
        contentType:false,
        processData:false,
        success: function(response) {
            if(response.status==400)
            {
                $('#errorList').html('');
                $('#errorModalBody').removeClass('d-none');
                $('#errorList').removeClass('d-none');

                $.each(response.errors,function(key,err_value){
                    $('#errorList').append('<li>'+err_value+'</li>');
                });

                $('#btnAdd').removeClass('btn-success');
                $('#btnAdd').addClass('btn-primary');
                $('#btnAdd').text('Save');
            }
            else if(response.status==200)
            {
                $('#errorList').html('');
                $('#errorModalBody').addClass('d-none');
                $('#errorList').addClass('d-none');

                $('#btnAdd').removeClass('btn-primary');
                $('#btnAdd').addClass('btn-success');
                $('#btnAdd').text('Saved');

                $('#nicno').val('');
                $('#telephone').val('');
                $('#fullname').val('');
                $('#address').val('');
                $('#photo').val('');
                
                $('#no').val(Math.floor(Math.random() * (11500000000 - 9950000000000 + 1) + 9950000000000));
                
                setTimeout(function(){
                    $('#btnAdd').removeClass('btn-success');
                    $('#btnAdd').addClass('btn-primary');
                    $('#btnAdd').text('Save');
                }, 3000);
            }
        }
    });
});

//retrieve data to html table
setInterval(function(){

    var combo = document.getElementById("filter");

    if($('#searchBar').val().length > 0)
    {
        searchStaff();
    }
    else if(combo.selectedIndex ==2)
    {
        fetchActiveStaff();
    }
    else if(combo.selectedIndex ==3)
    {
        fetchInactiveStaff();
    }
    else if(combo.selectedIndex ==1)
    {
        fetchStaff();
    }else{
        fetchStaff();
    }

}, 2000);

//search data
$('#searchBar').keyup(function(){   
    searchStaff();
});

function fetchStaff()
{
    $.ajax({
        type:"GET",
        url:"{{ url('admin/dashboard/fetchStaff') }}",
        success:function(response){
            $('tbody').html('');
            $.each(response.admins,function(key,item){

                if(item.hospital_id==""){
                    $assign_button = '<button class="btn btn-warning btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="assignModalOpen">Assign</button>';
                }else{
                    $assign_button = '<button class="btn btn-outline-warning btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="assignModalOpen">Re-assign</button>';
                };

                if(item.status=="active"){
                    $status_view = '<span class="badge badge-light-success">Active</span>';
                }else{
                    $status_view = '<span class="badge badge-light-danger">Inactive</span>';
                };

                if(item.status=="active"){
                    $status_button = '<button value="'+item.id+'" class="btn btn-outline-danger btn-sm" id="changeStatusDeactive">Deactivate</button>';
                }else{
                    $status_button = '<button value="'+item.id+'" class="btn btn-outline-success btn-sm" id="changeStatusActive">Activate</button>';
                };

                var staff_no_str = item.no;
                var staff_no_str = staff_no_str.slice(0, 4)+'...'; 

                var fullName_str = item.fullname;
                var fullName_str = fullName_str.slice(0, 15)+'...'; 

                $('tbody').append('<tr>\
                    <td><b>'+staff_no_str+'</b></td>\
                    <td>'+fullName_str+'</td>\
                    <td><img style="width:100px;" src="'+item.photo+'" alt=""></td>\
                    <td>'+item.telephone+'</td>\
                    <td>'+$status_view+'</td>\
                    <td>\
                    '+$status_button+'\
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" id="editModalOpen" value="'+item.id+'"><i class="fa-solid fa-pen-to-square"></i></button>\
                    <button class="btn btn-danger btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="deleteModalOpen"><i class="fa fa-trash"></i></button>\
                    <button class="btn btn-dark btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="viewModalOpen"><i class="fa fa-eye"></i></button>\
                    '+$assign_button+'\
                    </td>\
                    </tr>\
                    ');
            });
        }
    });
}

function fetchActiveStaff()
{
    $.ajax({
        type:"GET",
        url:"{{ url('admin/dashboard/fetchActiveStaff') }}",
        success:function(response){
            $('tbody').html('');
            $.each(response.admins,function(key,item){
                if(item.hospital_id==""){
                    $assign_button = '<button class="btn btn-warning btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="assignModalOpen">Assign</button>';
                }else{
                    $assign_button = '<button class="btn btn-outline-warning btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="assignModalOpen">Re-assign</button>';
                };

                if(item.status=="active"){
                    $status_view = '<span class="badge badge-light-success">Active</span>';
                }else{
                    $status_view = '<span class="badge badge-light-danger">Inactive</span>';
                };

                if(item.status=="active"){
                    $status_button = '<button value="'+item.id+'" class="btn btn-outline-danger btn-sm" id="changeStatusDeactive">Deactivate</button>';
                }else{
                    $status_button = '<button value="'+item.id+'" class="btn btn-outline-success btn-sm" id="changeStatusActive">Activate</button>';
                };

                var staff_no_str = item.no;
                var staff_no_str = staff_no_str.slice(0, 4)+'...'; 

                var fullName_str = item.fullname;
                var fullName_str = fullName_str.slice(0, 15)+'...'; 

                $('tbody').append('<tr>\
                    <td><b>'+staff_no_str+'</b></td>\
                    <td>'+fullName_str+'</td>\
                    <td><img style="width:100px;" src="'+item.photo+'" alt=""></td>\
                    <td>'+item.telephone+'</td>\
                    <td>'+$status_view+'</td>\
                    <td>\
                    '+$status_button+'\
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" id="editModalOpen" value="'+item.id+'"><i class="fa-solid fa-pen-to-square"></i></button>\
                    <button class="btn btn-danger btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="deleteModalOpen"><i class="fa fa-trash"></i></button>\
                    <button class="btn btn-dark btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="viewModalOpen"><i class="fa fa-eye"></i></button>\
                    '+$assign_button+'\
                    </td>\
                    </tr>\
                    ');
            });
        }
    });
}

function fetchInactiveStaff()
{
    $.ajax({
        type:"GET",
        url:"{{ url('admin/dashboard/fetchInactiveStaff') }}",
        success:function(response){
            $('tbody').html('');
            $.each(response.admins,function(key,item){
                if(item.hospital_id==""){
                    $assign_button = '<button class="btn btn-warning btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="assignModalOpen">Assign</button>';
                }else{
                    $assign_button = '<button class="btn btn-outline-warning btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="assignModalOpen">Re-assign</button>';
                };

                if(item.status=="active"){
                    $status_view = '<span class="badge badge-light-success">Active</span>';
                }else{
                    $status_view = '<span class="badge badge-light-danger">Inactive</span>';
                };

                if(item.status=="active"){
                    $status_button = '<button value="'+item.id+'" class="btn btn-outline-danger btn-sm" id="changeStatusDeactive">Deactivate</button>';
                }else{
                    $status_button = '<button value="'+item.id+'" class="btn btn-outline-success btn-sm" id="changeStatusActive">Activate</button>';
                };

                var staff_no_str = item.no;
                var staff_no_str = staff_no_str.slice(0, 4)+'...'; 

                var fullName_str = item.fullname;
                var fullName_str = fullName_str.slice(0, 15)+'...'; 

                $('tbody').append('<tr>\
                    <td><b>'+staff_no_str+'</b></td>\
                    <td>'+fullName_str+'</td>\
                    <td><img style="width:100px;" src="'+item.photo+'" alt=""></td>\
                    <td>'+item.telephone+'</td>\
                    <td>'+$status_view+'</td>\
                    <td>\
                    '+$status_button+'\
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" id="editModalOpen" value="'+item.id+'"><i class="fa-solid fa-pen-to-square"></i></button>\
                    <button class="btn btn-danger btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="deleteModalOpen"><i class="fa fa-trash"></i></button>\
                    <button class="btn btn-dark btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="viewModalOpen"><i class="fa fa-eye"></i></button>\
                    '+$assign_button+'\
                    </td>\
                    </tr>\
                    ');
            });
        }
    });
}

function searchStaff()
{
    var searchInput = $('#searchBar').val();

    var url = '{{ url("admin/dashboard/searchStaff/:searchInput") }}';
    url = url.replace(':searchInput', searchInput);

    $.ajax({
        type:"GET", 
        url: url,
        success:function(response){
            $('tbody').html('');
            $.each(response.admins,function(key,item){
                if(item.hospital_id==""){
                    $assign_button = '<button class="btn btn-warning btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="assignModalOpen">Assign</button>';
                }else{
                    $assign_button = '<button class="btn btn-outline-warning btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="assignModalOpen">Re-assign</button>';
                };

                if(item.status=="active"){
                    $status_view = '<span class="badge badge-light-success">Active</span>';
                }else{
                    $status_view = '<span class="badge badge-light-danger">Inactive</span>';
                };

                if(item.status=="active"){
                    $status_button = '<button value="'+item.id+'" class="btn btn-outline-danger btn-sm" id="changeStatusDeactive">Deactivate</button>';
                }else{
                    $status_button = '<button value="'+item.id+'" class="btn btn-outline-success btn-sm" id="changeStatusActive">Activate</button>';
                };

                var staff_no_str = item.no;
                var staff_no_str = staff_no_str.slice(0, 4)+'...'; 

                var fullName_str = item.fullname;
                var fullName_str = fullName_str.slice(0, 15)+'...'; 

                $('tbody').append('<tr>\
                    <td><b>'+staff_no_str+'</b></td>\
                    <td>'+fullName_str+'</td>\
                    <td><img style="width:100px;" src="'+item.photo+'" alt=""></td>\
                    <td>'+item.telephone+'</td>\
                    <td>'+$status_view+'</td>\
                    <td>\
                    '+$status_button+'\
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" id="editModalOpen" value="'+item.id+'"><i class="fa-solid fa-pen-to-square"></i></button>\
                    <button class="btn btn-danger btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="deleteModalOpen"><i class="fa fa-trash"></i></button>\
                    <button class="btn btn-dark btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="viewModalOpen"><i class="fa fa-eye"></i></button>\
                    '+$assign_button+'\
                    </td>\
                    </tr>\
                    ');
            });
        }
    });
}

//open edit data bootstrap modal
$(document).on('click', '#editModalOpen',function(e){
   e.preventDefault();
   
   $('#errorList').html('');
   $('#errorModalBody').addClass('d-none');
   $('#errorList').addClass('d-none');

   var id = $(this).val();
   
   var url = '{{ url("admin/dashboard/fetchSingleStaff/:id") }}';
   url = url.replace(':id', id);

   $.ajax({
    type:"GET",
    url:url,
    success: function (response){
        if(response.status==404){
            alert('Staff Member Not Found');
        }
        else
        {
            $('#updateModalBody').removeClass('d-none');
            $('#assignModalBody').addClass('d-none');
            $('#addModalBody').addClass('d-none');
            $('#deleteModalBody').addClass('d-none');
            $('#viewModalBody').addClass('d-none');
            $('#contentLabel').text('Update Details of Staff Member No. '+response.admins.no);

            $('#updateId').val(id);
            $('#update_nic').val(response.admins.nic);
            $('#update_telephone').val(response.admins.telephone);
            $('#update_fullName').val(response.admins.fullname);
            $('#update_address').val(response.admins.address);
            $('#update_dateOfBirth').val(response.admins.dateofbirth);
            $('#update_viewPhoto').attr("src",response.admins.photo);
            $('#update_email').val(response.admins.email);
        }
    }
    });
});

$(document).on('click', '#deleteModalOpen',function(e){
   e.preventDefault();
   
   $('#errorList').html('');
   $('#errorModalBody').addClass('d-none');
   $('#errorList').addClass('d-none');

   var id = $(this).val();
   
   var url = '{{ url("admin/dashboard/fetchSingleStaff/:id") }}';
   url = url.replace(':id', id);

   $.ajax({
    type:"GET",
    url:url,
    success: function (response){
        if(response.status==404){
            alert('Staff Member Not Found');
        }
        else
        {
            $('#deleteModalBody').removeClass('d-none');
            $('#assignModalBody').addClass('d-none');
            $('#addModalBody').addClass('d-none');
            $('#updateModalBody').addClass('d-none');
            $('#viewModalBody').addClass('d-none');
            $('#contentLabel').text('Delete Staff Member No. '+response.admins.no);

            $('#deleteId').val(id);
        }
    }
    });
});

//open view data bootstrap modal
$(document).on('click', '#viewModalOpen',function(e){
   e.preventDefault();

   $('#errorList').html('');
   $('#errorModalBody').addClass('d-none');
   $('#errorList').addClass('d-none');
   
   var id = $(this).val();
   
   var url = '{{ url("admin/dashboard/fetchSingleStaff/:id") }}';
   url = url.replace(':id', id);

   $.ajax({
    type:"GET",
    url:url,
    success: function (response){
        if(response.status==404){
            alert('Staff Member Not Found');
        }
        else
        {
            $('#viewModalBody').removeClass('d-none');
            $('#assignModalBody').addClass('d-none');
            $('#addModalBody').addClass('d-none');
            $('#updateModalBody').addClass('d-none');
            $('#deleteModalBody').addClass('d-none');
            $('#contentLabel').text('View Details of Staff Member No. '+response.admins.no);

            $('#viewPhoto').attr("src",response.admins.photo);
            $('#view_nic').html('<b>NIC No. : </b>'+response.admins.nic);
            $('#view_telephone').html('<b>Telephone. : </b>'+response.admins.telephone);
            $('#view_gender').html('<b>Gender : </b>'+response.admins.gender);
            $('#view_dateOfBirth').html('<b>Date of Birth : </b>'+response.admins.dateofbirth);
            $('#view_fullName').html('<b>Full Name : </b>'+response.admins.fullname);
            $('#view_address').html('<b>Address : </b>'+response.admins.address);
            $('#view_email').html('<b>Email : </b>'+response.admins.email);
            $('#viewHospitalId').val(response.admins.hospital_id);
            fetchHospitalAssignedTo();
        }
    }
    });

    
});

function fetchHospitalAssignedTo()
{
    var hospitalId = $('#viewHospitalId').val();

    var urlTwo = '{{ url("admin/dashboard/fetchAssignedHospital/:id") }}';
    urlTwo = urlTwo.replace(':id', hospitalId);

    $.ajax({
    type:"GET",
    url:urlTwo,
    success: function (response){
        if(response.status==404){
            alert('Hospital Not Found');
        }
        else
        {
            $('#view_hospital').html('<b>Hospital Assigned To : </b>'+response.hospitals.name);
        }
    }
    });
}

//change record status
$(document).on('click', '#changeStatusActive',function(e){
        e.preventDefault();
        var id = $(this).val();
        var status_active = 'active';
        var data = {
            'status' : status_active
        }

        var url = '{{ url("admin/dashboard/staffChangeStatus/:id") }}';
        url = url.replace(':id', id);

        $.ajax({
            type:"PUT",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                fetchStaff();
            }
        });
});
$(document).on('click', '#changeStatusDeactive',function(e){
        e.preventDefault();
        var id = $(this).val();
        var status_active = 'Inactive';
        var data = {
            'status' : status_active
        }

        var url = '{{ url("admin/dashboard/staffChangeStatus/:id") }}';
        url = url.replace(':id', id);

        $.ajax({
            type:"PUT",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                fetchStaff();
            }
        });
});

//update data
$(document).on('submit','#updateForm',function(e){
    e.preventDefault();

    var id = $('#updateId').val();
    let updateFormData = new FormData($('#updateForm')[0]);

    var url = '{{ url("admin/dashboard/updateStaff/:id") }}';
    url = url.replace(':id', id);

    $.ajax({
        type: "POST",
        url: url,
        data: updateFormData,
        contentType:false,
        processData:false,
        success: function(response) {
            if(response.status==400)
            {
                $('#errorList').html('');
                $('#errorModalBody').removeClass('d-none');
                $('#errorList').removeClass('d-none');

                $.each(response.errors,function(key,err_value){
                    $('#errorList').append('<li>'+err_value+'</li>');
                });
            }
            else if(response.status==200)
            {
                $('#errorList').html('');
                $('#errorModalBody').addClass('d-none');
                $('#errorList').addClass('d-none');

                $('#btnUpdate').removeClass('btn-primary');
                $('#btnUpdate').addClass('btn-success');
                $('#btnUpdate').text('Saved');

                setTimeout(function(){
                    $('#btnUpdate').removeClass('btn-success');
                    $('#btnUpdate').addClass('btn-primary');
                    $('#btnUpdate').text('Save');
                    $('#modal').modal('hide');
                }, 2000);
            }
        }
    });
});

//delete data
$(document).on('click', '#btnDelete',function(e){
        e.preventDefault();
        
        var id = $('#deleteId').val();

        var url = '{{ url("admin/dashboard/deleteStaff/:id") }}';
        url = url.replace(':id', id);

        $.ajax({
            type:"DELETE",
            url:url,
            dataType:"json",
            success:function(response){
                if(response.status==200)
                {
                    $('#btnDelete').removeClass('btn-primary');
                    $('#btnDelete').addClass('btn-success');
                    $('#btnDelete').text('Deleted');

                    setTimeout(function(){
                        $('#btnDelete').removeClass('btn-success');
                        $('#btnDelete').addClass('btn-danger');
                        $('#btnDelete').text('Yes');
                        $('#modal').modal('hide');
                    }, 2000);
                }
                else if(response.status==404)
                {
                    $('#modal').modal('hide');
                    alert('Staff Member Not Found');
                }
            }
        });
});

//open assign staff bootstrap modal
$(document).on('click', '#assignModalOpen',function(e){
   e.preventDefault();

   $('#errorList').html('');
   $('#errorModalBody').addClass('d-none');
   $('#errorList').addClass('d-none');
   
   var id = $(this).val();
   
   var url = '{{ url("admin/dashboard/fetchSingleStaff/:id") }}';
   url = url.replace(':id', id);

   $.ajax({
    type:"GET",
    url:url,
    success: function (response){
        if(response.status==404){
            alert('Staff Member Not Found');
        }
        else
        {
            $('#assignModalBody').removeClass('d-none');
            $('#viewModalBody').addClass('d-none');
            $('#addModalBody').addClass('d-none');
            $('#updateModalBody').addClass('d-none');
            $('#deleteModalBody').addClass('d-none');
            $('#contentLabel').text('Assign Staff Member No. '+response.admins.no+' to a Hospital');
            $('#assignId').val(response.admins.id);
        }
    }
    });
});

function fetchHospitalToAssign()
{
    $.ajax({
        type:"GET",
        url:"{{ url('admin/dashboard/fetchHospitalToAssign') }}",
        success:function(response){
            $.each(response.hospitals,function(key,item){
                $('#chooseHospital').append('<option value="'+item.no+'">'+item.name+'</option>\
                ');
            });
        }
    });
}

$(document).on('click', '#btnAssign',function(e){
        e.preventDefault();
        var id = $('#assignId').val();
        var hospital = $('#chooseHospital').val();
        var data = {
            'hospital_id' : hospital
        }

        var url = '{{ url("admin/dashboard/appoint/:id") }}';
        url = url.replace(':id', id);

        $.ajax({
            type:"PUT",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                if(response.status==400)
                {
                $('#errorList').html('');
                $('#errorModalBody').removeClass('d-none');
                $('#errorList').removeClass('d-none');

                $('#errorList').append('<li>Hospital does not exist!</li>');
                }
                else if(response.status==200)
                {
                $('#errorList').html('');
                $('#errorModalBody').addClass('d-none');
                $('#errorList').addClass('d-none');

                $('#btnAssign').removeClass('btn-primary');
                $('#btnAssign').addClass('btn-success');
                $('#btnAssign').text('Assigned');

                setTimeout(function(){
                    $('#btnAssign').removeClass('btn-success');
                    $('#btnAssign').addClass('btn-primary');
                    $('#btnAssign').text('Assign');
                    $('#modal').modal('hide');
                }, 2000);
                }
            }
        });
});

});


</script>
@endsection
