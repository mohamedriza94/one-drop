@extends('admin.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="header layout-top-spacing">
                <h3 class=""><b>NEWS AND UPDATES</b></h3>
                <hr>
            </div>
            
            <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="edit_success">
                <strong>Success</strong>
            </div>
            <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="delete_success">
                <strong>Deleted</strong>
            </div>
            
            <div class="widget-content widget-content-area layout-top-spacing">
                <div class="row">
                    <div class="col-6">
                        <form><input type="text" placeholder="Search here..." id="searchBar" class="form-control"></form>
                    </div>
                    <div class="col-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-primary btn-lg form-control" id="addPostModalOpen">Add a post</a>
                    </div>
                    <div class="col-3">
                        <select id="filter" class="form-select" aria-label="Default select example">
                            <option selected="" disabled>Filter</option>
                            <option value="setnofilter" id="setnofilter">No filter</option>
                            <option value="setactive" id="setactive">Active</option>
                            <option value="setinactive" id="setinactive">Inactive</option>
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
                                            <th scope="col"><b>No.</b></th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Thumbnail</th>
                                            <th scope="col">Last Updated</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                        <input type="hidden" class="form-control" id="change_status_id" name="change_status_id">

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

                  <div class="modal-body" id="deleteNewsBody" style="display:none;">
                  
                    <ul class="bg-warning form-control d-none" id="edit_error_list"></ul>

                    <div class="row g-3">
                      
                        <input type="hidden" class="form-control" id="delete_newsid" name="delete_newsid" value="">
                        <input type="hidden" class="form-control" id="delete_news_no" name="news_no">

                        <div class="col-md-12">
                            Are you sure you want to delete this post?
                      </div>

                    <div class="col-md-6">
                      <button class="btn btn-primary form-control" id="btn_confirm_delete">Yes</button>
                  </div>

                  <div class="col-md-6">
                      <a class="btn btn-danger form-control" data-bs-dismiss="modal">No</a>
                  </div>
          </div>
          </div>
                  
                  <div class="modal-body" id="editNewsBody" style="display:none;">
                  
                    <ul class="bg-warning form-control d-none" id="edit_error_list"></ul>

                    <form id="editNewsForm" class="row g-3" method="POST" enctype="multipart/form-data">
                      
                        <input type="hidden" class="form-control" id="edit_newsid" name="edit_newsid" value="">
                        <input type="hidden" class="form-control" id="edit_news_no" name="news_no">

                        <div class="col-md-12">
                          <label class="form-label">Title</label>
                          <input type="text" class="form-control" id="edit_title" name="title">
                      </div>

                      <div class="col-md-12">
                          <label class="form-label">Description</label>
                          <textarea class="form-control" id="edit_description" name="description"></textarea>
                      </div>

                      <div class="col-md-12">
                          <label class="form-label">Thumbnail</label>
                          <input type="file" class="form-control" id="edit_thumbnail" name="thumbnail">
                      </div>

                      <div class="col-md-12">
                        <img id="view_thumbnail" class="form-control" src="" style="height:300px; object-fit: contain;">
                    </div>



                    <div class="col-md-12">
                      <button class="btn btn-primary form-control" type="submit">Save</button>
                  </div>
              </form>
          </div>

          <div class="modal-body" id="addNewsBody" style="display:none;">
          
          <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="addition_success">
                <strong>Success</strong>
            </div>

              <ul class="bg-warning form-control d-none" id="add_error_list"></ul>

              <form id="addNewsForm" class="row g-3" method="POST" enctype="multipart/form-data">
               
                <div class="col-md-6">
                  <label class="form-label">News No.</label>
                  <input type="text" class="form-control" id="news_no" name="news_no" readonly value="<?php echo rand(11500000000,9950000000000); ?>">
              </div>

              <div class="col-md-6">
                  <label class="form-label">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                </select>
            </div>

            <div class="col-md-12">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="">
          </div>

          <div class="col-md-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description"></textarea>
          </div>

          <div class="col-md-12">
              <label class="form-label">Thumbnail</label>
              <input type="file" class="form-control" id="thumbnail" name="thumbnail">
          </div>


          <div class="col-md-12">
              <button class="btn btn-primary form-control" type="submit">Save</button>
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

    tinymce.init({
    selector: '#edit_description'
    });

    tinymce.init({
    selector: '#description'
    });
    
    //csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //open add data bootstrap modal
    $(document).on('click', '#addPostModalOpen',function(e){
     e.preventDefault();

     $('#addNewsBody').show();
     $('#editNewsBody').hide();
     $('#deleteNewsBody').hide();
     $('#contentLabel').text('Add a News Post');
    });

    //insert data
    $(document).on('submit','#addNewsForm',function(e){
        e.preventDefault();

        let formData = new FormData($('#addNewsForm')[0]);

        var url = '{{ url("admin/dashboard/addNews") }}';

        $.ajax({
            type:"POST",
            url:url,
            data:formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.status==400)
                {
                    $('#add_error_list').html('');
                    $('#add_error_list').removeClass('d-none');
                    $.each(response.errors,function(key,err_value){
                        $('#add_error_list').append('<li>'+err_value+'</li>');
                    });
                }
                else if(response.status==200)
                {
                    $('#add_error_list').addClass('d-none');
                    $('#addition_success').removeClass('d-none');
                    $('#title').val('');
                    tinymce.get("description").setContent("");
                    $('#thumbnail').val('');
                    $('#status').selectedIndex=0;
                    $('#news_no').val(Math.floor(Math.random() * (11500000000 - 9950000000000 + 1) + 9950000000000));
                    
                    setInterval(function(){
                    $('#addition_success').addClass('d-none');
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
            searchNews();
        }
        else if(combo.selectedIndex ==2)
        {
            fetchActiveNewsAndUpdates();
            $('#searchBar').val('');
        }
        else if(combo.selectedIndex ==3)
        {
            fetchInactiveNewsAndUpdates();
            $('#searchBar').val('');
        }
        else if(combo.selectedIndex ==1)
        {
            fetchNewsAndUpdates();
            $('#searchBar').val('');
        }
        else
        {
            fetchNewsAndUpdates();
            $('#searchBar').val('');
        }

    }, 2000);

    //search data
    $('#searchBar').keyup(function(){   
        searchNews();
    });

    //fetch single data record and open update data bootstrap modal
    $(document).on('click', '#editPostModalOpen',function(e){
     e.preventDefault();
     var newsandupdatesid = $(this).val();

     var url = '{{ url("admin/dashboard/fetchSingleNews/:id") }}';
     url = url.replace(':id', newsandupdatesid);

     $.ajax({
        type:"GET", url:url,
        success: function (response){
            if(response.fetch_status==404){
                $('#danger_alert').show();
            }else{
                $('#contentLabel').text('Edit News Post No. '+response.newsandupdates.news_no);
                $('#edit_newsid').val(newsandupdatesid);
                $('#edit_news_no').val(response.newsandupdates.news_no);
                $('#edit_title').val(response.newsandupdates.title);
                tinymce.get("edit_description").setContent(response.newsandupdates.description);
                $('#view_thumbnail').attr("src",response.newsandupdates.thumbnail);

                $('#addNewsBody').hide();
                $('#deleteNewsBody').hide();
                $('#editNewsBody').show();
            }
        }
        });
    });

    //update data
    $(document).on('submit','#editNewsForm',function(e){
        e.preventDefault();

        var id = $('#edit_newsid').val();
        let EditformData = new FormData($('#editNewsForm')[0]);

        var url = '{{ url("admin/dashboard/updateNews/:id") }}';
        url = url.replace(':id', id);

        $.ajax({
            type: "POST",
            url: url,
            data: EditformData,
            contentType:false,
            processData:false,
            success: function(response){
                if(response.status==400)
                {
                    $('#edit_error_list').html('');
                    $('#edit_error_list').removeClass('d-none');
                    $.each(response.errors,function(key,err_value){
                        $('#edit_error_list').append('<li>'+err_value+'</li>');
                    });
                }
                else if(response.status==200)
                {
                    $('#edit_error_list').addClass('d-none');
                    $('#edit_success').removeClass('d-none');
                    $('#edit_title').val('');
                    tinymce.get("edit_description").setContent("");
                    $('#edit_thumbnail').val('');
                    
                    setInterval(function(){
                    $('#edit_success').addClass('d-none');
                    }, 3000);
                    fetchNewsAndUpdates();
                    $('#modal').modal('hide');
                }
                else if(response.status==404)
                {
                    alert('Post Not Found');
                }
            }
        });
    });

    //change record status
    $(document).on('click', '#changeStatusActivate',function(e){
        e.preventDefault();
        var changeStatusId = $(this).val();
        var status_active = 'active';
        var data = {
            'status' : status_active
        }

        var url = '{{ url("admin/dashboard/changeStatus/:id") }}';
        url = url.replace(':id', changeStatusId);

        $.ajax({
            type:"PUT",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                fetchNewsAndUpdates();
            }
        });
    });

    $(document).on('click', '#changeStatusDeactive',function(e){
        e.preventDefault();
        var changeStatusId = $(this).val();
        var status_active = 'inactive';
        var data = {
            'status' : status_active
        }

        var url = '{{ url("admin/dashboard/changeStatus/:id") }}';
        url = url.replace(':id', changeStatusId);

        $.ajax({
            type:"PUT",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                fetchNewsAndUpdates();
            }
        });
    });
    
    //open delete data bootstrap modal
    $(document).on('click', '#deletePostModalOpen',function(e){
        e.preventDefault();
        var delete_newsid = $(this).val();
        $('#delete_newsid').val(delete_newsid);
        
        var url = '{{ url("admin/dashboard/fetchSingleNews/:id") }}';
        url = url.replace(':id', delete_newsid);

        $.ajax({
        type:"GET", url:url,
        success: function (response){
            if(response.fetch_status==404){
                $('#danger_alert').show();
            }else{
                $('#delete_news_no').val(response.newsandupdates.news_no);

                $('#deleteNewsBody').show();
                $('#addNewsBody').hide();
                $('#editNewsBody').hide();
                $('#contentLabel').text('Delete a Post');
            }
        }
        });
    });

    //delete data
    $(document).on('click', '#btn_confirm_delete',function(e){
        e.preventDefault();
        
        var id = $('#delete_newsid').val();
        var news_no = $('#delete_news_no').val();

        var url = '{{ url("admin/dashboard/deleteNews/:id/:news_no") }}';
        url = url.replace(':id', id);
        url = url.replace(':news_no', news_no);

        $.ajax({
            type:"DELETE",
            url:url,
            dataType:"json",
            success:function(response){
                if(response.status==200)
                {
                    fetchNewsAndUpdates();
                    $('#modal').modal('hide');
                    $('#delete_success').removeClass('d-none');
                    setInterval(function(){
                    $('#delete_success').addClass('d-none');
                    }, 3000);
                }
                else if(response.status==404)
                {
                    $('#modal').modal('hide');
                    alert('Post Not Found');
                }
            }
        });
    });

    function fetchNewsAndUpdates()
    {
        var url = '{{ url("admin/dashboard/fetchNewsAndUpdates") }}';

        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                $('tbody').html('');
                $.each(response.newsandupdates,function(key,item){
                    if(item.status=="active"){
                        $status_view = '<span class="badge badge-light-success">Active</span>';
                    }else{
                        $status_view = '<span class="badge badge-light-danger">Inactive</span>';
                    };

                    if(item.status=="active"){
                        $status_button = '<button value="'+item.id+'" class="btn btn-outline-danger btn-sm" id="changeStatusDeactive">Deactivate</button>';
                    }else{
                        $status_button = '<button value="'+item.id+'" class="btn btn-outline-success btn-sm" id="changeStatusActivate">Activate</button>';
                    };

                    var news_no_str = item.news_no;
                    var news_no_str = news_no_str.slice(0, 4)+'...'; 

                    var title_str = item.title;
                    var title_str = title_str.slice(0, 15)+'...'; 

                    var updated_at_str = item.updated_at;
                    var updated_at_str = updated_at_str.slice(0, 10); 

                    $('tbody').append('<tr>\
                        <td><b>'+news_no_str+'</b></td>\
                        <td>'+title_str+'</td>\
                        <td><img style="width:100px;" src="'+item.thumbnail+'" alt=""></td>\
                        <td>'+updated_at_str+'</td>\
                        <td>'+$status_view+'</td>\
                        <td>\
                        '+$status_button+'\
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" id="editPostModalOpen" value="'+item.id+'"><i class="fa-solid fa-pen-to-square"></i></button>\
                        <button class="btn btn-danger btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="deletePostModalOpen"><i class="fa fa-trash"></i></button>\
                        </td>\
                        </tr>\
                        ');
                });
            }
        });
    }

    function fetchActiveNewsAndUpdates()
    {
        var url = '{{ url("admin/dashboard/fetchActiveNewsAndUpdates") }}';

        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                $('tbody').html('');
                $.each(response.newsandupdates,function(key,item){
                    if(item.status=="active"){
                        $status_view = '<span class="badge badge-light-success">Active</span>';
                    }else{
                        $status_view = '<span class="badge badge-light-danger">Inactive</span>';
                    };

                    if(item.status=="active"){
                        $status_button = '<button value="'+item.id+'" class="btn btn-outline-danger btn-sm" id="changeStatusDeactive">Deactivate</button>';
                    }else{
                        $status_button = '<button value="'+item.id+'" class="btn btn-outline-success btn-sm" id="changeStatusActivate">Activate</button>';
                    };

                    var news_no_str = item.news_no;
                    var news_no_str = news_no_str.slice(0, 4)+'...'; 

                    var title_str = item.title;
                    var title_str = title_str.slice(0, 15)+'...'; 

                    var updated_at_str = item.updated_at;
                    var updated_at_str = updated_at_str.slice(0, 10); 

                    $('tbody').append('<tr>\
                        <td><b>'+news_no_str+'</b></td>\
                        <td>'+title_str+'</td>\
                        <td><img style="width:100px;" src="'+item.thumbnail+'" alt=""></td>\
                        <td>'+updated_at_str+'</td>\
                        <td>'+$status_view+'</td>\
                        <td>\
                        '+$status_button+'\
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" id="editPostModalOpen" value="'+item.id+'"><i class="fa-solid fa-pen-to-square"></i></button>\
                        <button class="btn btn-danger btn-sm" value="'+item.id+'" id="deletePostModalOpen"><i class="fa fa-trash"></i></button>\
                        </td>\
                        </tr>\
                        ');
                });
            }
        });
    }

    function fetchInactiveNewsAndUpdates()
    {
        var url = '{{ url("admin/dashboard/fetchInactiveNewsAndUpdates") }}';

        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                $('tbody').html('');
                $.each(response.newsandupdates,function(key,item){
                    if(item.status=="active"){
                        $status_view = '<span class="badge badge-light-success">Active</span>';
                    }else{
                        $status_view = '<span class="badge badge-light-danger">Inactive</span>';
                    };

                    if(item.status=="active"){
                        $status_button = '<button value="'+item.id+'" class="btn btn-outline-danger btn-sm" id="changeStatusDeactive">Deactivate</button>';
                    }else{
                        $status_button = '<button value="'+item.id+'" class="btn btn-outline-success btn-sm" id="changeStatusActivate">Activate</button>';
                    };

                    var news_no_str = item.news_no;
                    var news_no_str = news_no_str.slice(0, 4)+'...'; 

                    var title_str = item.title;
                    var title_str = title_str.slice(0, 15)+'...'; 

                    var updated_at_str = item.updated_at;
                    var updated_at_str = updated_at_str.slice(0, 10); 

                    $('tbody').append('<tr>\
                        <td><b>'+news_no_str+'</b></td>\
                        <td>'+title_str+'</td>\
                        <td><img style="width:100px;" src="'+item.thumbnail+'" alt=""></td>\
                        <td>'+updated_at_str+'</td>\
                        <td>'+$status_view+'</td>\
                        <td>\
                        '+$status_button+'\
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" id="editPostModalOpen" value="'+item.id+'"><i class="fa-solid fa-pen-to-square"></i></button>\
                        <button class="btn btn-danger btn-sm" value="'+item.id+'" id="deletePostModalOpen"><i class="fa fa-trash"></i></button>\
                        </td>\
                        </tr>\
                        ');
                });
            }
        });
    }
    
    function searchNews()
    {
        var searchInput = $('#searchBar').val();

        var url = '{{ url("admin/dashboard/searchNews/:input") }}';
        url = url.replace(':input', searchInput);

     $.ajax({
        type:"GET", 
        url:url,
        dataType:"json",
        success:function(response){
                $('tbody').html('');
                $.each(response.newsandupdates,function(key,item){
                    if(item.status=="active"){
                        $status_view = '<span class="badge badge-light-success">Active</span>';
                    }else{
                        $status_view = '<span class="badge badge-light-danger">Inactive</span>';
                    };

                    if(item.status=="active"){
                        $status_button = '<button value="'+item.id+'" class="btn btn-outline-danger btn-sm" id="changeStatusDeactive">Deactivate</button>';
                    }else{
                        $status_button = '<button value="'+item.id+'" class="btn btn-outline-success btn-sm" id="changeStatusActivate">Activate</button>';
                    };

                    var news_no_str = item.news_no;
                    var news_no_str = news_no_str.slice(0, 4)+'...'; 

                    var title_str = item.title;
                    var title_str = title_str.slice(0, 15)+'...'; 

                    var updated_at_str = item.updated_at;
                    var updated_at_str = updated_at_str.slice(0, 10); 

                    $('tbody').append('<tr>\
                        <td><b>'+news_no_str+'</b></td>\
                        <td>'+title_str+'</td>\
                        <td><img style="width:100px;" src="'+item.thumbnail+'" alt=""></td>\
                        <td>'+updated_at_str+'</td>\
                        <td>'+$status_view+'</td>\
                        <td>\
                        '+$status_button+'\
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" id="editPostModalOpen" value="'+item.id+'"><i class="fa-solid fa-pen-to-square"></i></button>\
                        <button class="btn btn-danger btn-sm" value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modal" id="deletePostModalOpen"><i class="fa fa-trash"></i></button>\
                        </td>\
                        </tr>\
                        ');
                });
            }
        });
    }
});

</script>
@endsection
