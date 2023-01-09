@extends('admin.layouts.master')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="header layout-top-spacing">
                <h3 class=""><b>HOSPITAL MANAGEMENT</b></h3>
                <hr>
            </div>
            
            <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="alert">
                <strong></strong>
            </div>
            
            <div class="widget-content widget-content-area">
                <div class="row">
                    <div class="col-lg-12 col-12 ">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-primary btn-lg form-control" id="addModalOpen">Register Hospital</a>
                                </div>
                            </div>
                        </form>
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
                                            <th scope="col"><b>Hospital No.</b></th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Landline</th>
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

                <!-- update data -->
                <div class="modal-body d-none" id="viewModalBody">

                    <form id="" class="row g-3" method="POST" enctype="multipart/form-data">

                        <div class="col-md-12">
                          <label class="form-label" id="view_hospitalNo"><b>Hospital No. : </b></label>
                      </div>

                      <div class="col-md-12">
                          <label class="form-label" id="view_name"><b>Name : </b></label>
                      </div>

                      <div class="col-md-12">
                          <label class="form-label" id="view_email"><b>Email : </b></label>
                      </div>

                      <div class="col-md-12">
                          <label class="form-label" id="view_address"><b>Address : </b></label>
                      </div>

                      <div class="col-md-12">
                          <label class="form-label" id="view_landline"><b>Landline : </b></label>
                      </div>

                      <div class="col-md-12">
                          <label class="form-label"><b><u>Description</u></b></label><br>
                          <p class="form-label" id="view_description"></p>
                      </div>
                  </form>
              </div>

              <!-- delete data -->
              <div class="modal-body d-none" id="deleteModalBody">

                <div class="row g-3">
                  
                    <input type="hidden" class="form-control" id="deleteId" name="deleteId">

                    <div class="col-md-12">
                        Are you sure you want to remove this Hospital?
                    </div>

                    <div class="col-md-6">
                      <button class="btn btn-danger form-control" id="btnDelete">Yes</button>
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

                <div class="col-md-6">
                  <label class="form-label">Landline</label>
                  <input  type="text" class="form-control" id="update_landline" name="landline" value="">
              </div>

              <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input  type="text" class="form-control" id="update_email" name="email">
              </div>

              <div class="col-md-12">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" id="update_name" name="update_name" value="">
              </div>

              <div class="col-md-12">
                  <label class="form-label">Address</label>
                  <input type="text" class="form-control" id="update_address" name="address" value="">
              </div>

              <div class="col-md-12">
                  <label class="form-label">Description</label>
                  <textarea class="form-control" id="update_description" name="update_description"></textarea>
              </div>

              <div class="col-md-12">
                  <button class="btn btn-primary form-control" type="submit" id="btnUpdate">Save</button>
              </div>
          </form>
      </div>

      <!-- //add data -->
      <div class="modal-body d-none" id="addModalBody">

        <form id="addForm" class="row g-3" method="POST" enctype="multipart/form-data">
         
            <div class="col-md-3">
              <label class="form-label">Hospital No.</label>
              <input type="text" class="form-control" id="no" name="no" readonly>
          </div>

          <div class="col-md-3">
              <label class="form-label">Landline</label>
              <input  type="text" class="form-control" id="landline" name="landline">
          </div>

          <div class="col-md-6">
              <label class="form-label">Email</label>
              <input  type="text" class="form-control" id="email" name="email">
          </div>

          <div class="col-md-12">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" id="hospitalName" name="hospitalName">
          </div>

          <div class="col-md-12">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address">
          </div>

          <div class="col-md-12">
              <label class="form-label">Description</label>
              <input type="text" class="form-control" id="description" name="description">
          </div>

          <div class="col-md-6 d-none">
              <label class="form-label">Password</label>
              <input  type="password" class="form-control" id="password" name="password" value="123456">
          </div>

          <div class="col-md-6 d-none">
              <label class="form-label">Confirm Password</label>
              <input  type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="123456">
          </div>

          <div class="col-md-12">
              <button class="btn btn-primary form-control" type="submit" id="btnAdd">Register</button>
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

//calling function
fetchHospital();

//open add data bootstrap modal
$(document).on('click', '#addModalOpen',function(e){
 e.preventDefault();

 $('#addModalBody').removeClass('d-none');
 $('#updateModalBody').addClass('d-none');
 $('#deleteModalBody').addClass('d-none');
 $('#viewModalBody').addClass('d-none');
 $('#contentLabel').text('Hospital Registration');

 //generate random number
 $('#no').val(Math.floor(Math.random() * (11500000 - 995000000 + 1) + 995000000));
});

//insert data
$(document).on('submit','#addForm',function(e){
    e.preventDefault();

    let addFormData = new FormData($('#addForm')[0]);

    var password = $('#password').val();
    var confirmPassword = $('#confirmPassword').val();

    if(confirmPassword == password)
    {
        $('#passwordError').text('');
        $('#btnAdd').text('Registering...');

        $.ajax({
            type: "POST",
            url: "{{ url('admin/dashboard/insertHospital') }}",
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
                    $('#btnAdd').text('Register');
                }
                else if(response.status==200)
                {
                    $('#errorList').html('');
                    $('#errorModalBody').addClass('d-none');
                    $('#errorList').addClass('d-none');

                    $('#btnAdd').removeClass('btn-primary');
                    $('#btnAdd').addClass('btn-success');
                    $('#btnAdd').text('Registered and Mailed Credentials');

                    $('#name').val('');
                    $('#address').val('');
                    $('#email').val('');
                    $('#landline').val('');
                    $('#password').val('');
                    $('#confirmPassword').val('');
                    
                    $('#no').val(Math.floor(Math.random() * (11500000 - 995000000 + 1) + 995000000));
                    
                    fetchHospital();

                    setTimeout(function(){
                        $('#btnAdd').removeClass('btn-success');
                        $('#btnAdd').addClass('btn-primary');
                        $('#btnAdd').text('Register');
                    }, 2000);
                }
            }
        });
    }
    else
    {
        $('#passwordError').text('Passwords do not Match');
    }
});

function fetchHospital()
{
    $.ajax({
        type:"GET",
        url:"{{ url('admin/dashboard/fetchHospital') }}",
        success:function(response){
            $('tbody').html('');
            $.each(response.hospitals,function(key,item){

                var hospital_no_str = item.no;
                var hospital_no_str = hospital_no_str.slice(0, 8)+'...'; 

                $('tbody').append('<tr>\
                    <td><b>'+hospital_no_str+'</b></td>\
                    <td>'+item.name+'</td>\
                    <td>'+item.landline+'</td>\
                    <td>\
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" id="editModalOpen" value="'+item.id+'"><i class="fa-solid fa-pen-to-square"></i></button>\
                    <button class="btn btn-danger btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="deleteModalOpen"><i class="fa fa-trash"></i></button>\
                    <button class="btn btn-dark btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="viewModalOpen"><i class="fa fa-eye"></i></button>\
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
 
 var url = '{{ url("admin/dashboard/fetchSingleHospital/:id") }}';
 url = url.replace(':id', id);

 $.ajax({
    type:"GET",
    url:url,
    success: function (response){
        if(response.status==404){
            alert('Hospital Not Found');
        }
        else
        {
            $('#updateModalBody').removeClass('d-none');
            $('#addModalBody').addClass('d-none');
            $('#deleteModalBody').addClass('d-none');
            $('#viewModalBody').addClass('d-none');
            $('#contentLabel').text('Update Details of Hospital No. '+response.hospitals.no);

            $('#updateId').val(id);
            $('#update_name').val(response.hospitals.name);
            $('#update_landline').val(response.hospitals.landline);
            $('#update_email').val(response.hospitals.email);
            $('#update_address').val(response.hospitals.address);
            $('#update_description').val(response.hospitals.description);
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
 
 var url = '{{ url("admin/dashboard/fetchSingleHospital/:id") }}';
 url = url.replace(':id', id);

 $.ajax({
    type:"GET",
    url:url,
    success: function (response){
        if(response.status==404){
            alert('Hospital Not Found');
        }
        else
        {
            $('#deleteModalBody').removeClass('d-none');
            $('#addModalBody').addClass('d-none');
            $('#updateModalBody').addClass('d-none');
            $('#viewModalBody').addClass('d-none');
            $('#contentLabel').text('Remove Hospital No. '+response.hospitals.no);

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
 
 var url = '{{ url("admin/dashboard/fetchSingleHospital/:id") }}';
 url = url.replace(':id', id);

 $.ajax({
    type:"GET",
    url:url,
    success: function (response){
        if(response.status==404){
            alert('Hospital Not Found');
        }
        else
        {
            $('#viewModalBody').removeClass('d-none');
            $('#addModalBody').addClass('d-none');
            $('#updateModalBody').addClass('d-none');
            $('#deleteModalBody').addClass('d-none');
            $('#contentLabel').text('View Details of Hospital No. '+response.hospitals.no);

            $('#view_hospitalNo').html('<b>Hospital No. : </b>'+response.hospitals.no);
            $('#view_name').html('<b>Name : </b>'+response.hospitals.name);
            $('#view_email').html('<b>Email : </b>'+response.hospitals.email);
            $('#view_landline').html('<b>Landline : </b>'+response.hospitals.landline);
            $('#view_address').html('<b>Address : </b>'+response.hospitals.address);
            $('#view_description').html(response.hospitals.description);
        }
    }
});
});

//update data
$(document).on('submit','#updateForm',function(e){
    e.preventDefault();

    var id = $('#updateId').val();
    let updateFormData = new FormData($('#updateForm')[0]);

    var url = '{{ url("admin/dashboard/updateHospital/:id") }}';
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

                fetchHospital();

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

    var url = '{{ url("admin/dashboard/deleteHospital/:id") }}';
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

                fetchHospital();

                setTimeout(function(){
                    $('#btnDelete').removeClass('btn-success');
                    $('#btnDelete').addClass('btn-danger');
                    $('#btnDelete').text('Yes');
                    $('#modal').modal('hide');
                }, 1000);
            }
            else if(response.status==404)
            {
                $('#modal').modal('hide');
                alert('Hospital Not Found');
            }
        }
    });
});

});

</script>
@endsection
