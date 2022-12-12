@extends('admin.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>CAMPAIGNS</b></h3>
                <hr>
            </div>
            
            
            <div class="widget-content widget-content-area layout-top-spacing">
                <div class="row">
                    <div class="col-6">
                        <form><input type="text" placeholder="Search here..." id="searchBar" class="form-control"></form>
                    </div>
                    <div class="col-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addCampaignModal" class="btn btn-primary btn-lg form-control" id="btnNewCampaign">New Campaign</a>
                    </div>
                    <div class="col-3">
                        <select id="filter" class="form-select" aria-label="Default select example">
                            <option selected="" disabled>Filter</option>
                            <option>No filter</option>
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>Ended</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="blog-list" class="table dt-table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col"><b>No.</b></th>
                                    <th scope="col">Poster</th>
                                    <th scope="col">Last Updated</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="campaignDataTable">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
{{-- add new campaign --}}
<div class="modal fade bd-example-modal-xl" id="addCampaignModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Add a New Campaign</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            
            <div id="newCampainBody" class="modal-body">
                
                <div class="row g-3">
                    <ul id="errorList" class="list-unstyled bg-danger form-control d-none">
                    </ul>
                </div>
                
                <form method="POST" id="formNewCampaign" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="bg-dark">
                            <img src="https://www.mindwebtree.com/wp-content/uploads/2022/06/29592647-40da86ca-875a-11e7-8bc3-941700b0a323.png" id="selectedThumbnail" alt="" class="col-md-12" style="height:300px; object-fit: contain;">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="startDate">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate" name="endDate">
                        </div>
                        
                        <div class="col-md-12">
                            <button class="btn btn-primary form-control" type="submit" id="btnSaveNewCampaign">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- edit campaign --}}
<div class="modal fade bd-example-modal-xl" id="editCampaignModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            
            <div class="modal-body">
                
                <div class="row g-3">
                    <ul id="editErrorList" class="list-unstyled bg-danger form-control d-none">
                    </ul>
                </div>
                
                <form method="POST" id="formEditCampaign" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="bg-dark">
                            <img src="" id="previousThumbnail" alt="" class="col-md-12" style="height:300px; object-fit: contain;">
                        </div>
                        
                        <input type="hidden" id="edit_no" name="no" value="">
                        
                        <div class="col-md-12">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title" value="">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description"></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="edit_thumbnail" name="thumbnail">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="edit_startDate" name="startDate">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" id="edit_endDate" name="endDate">
                        </div>
                        
                        <div class="col-md-12">
                            <button class="btn btn-primary form-control" type="submit" id="btnEditCampaign">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-body">
                <h6><b>ADDITIONAL</b></h6>
                <hr class="border-dark">
                
                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <table class="table dt-table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="campaignPhotosTable">
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <table class="table dt-table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Tags</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="campaignTagsTable">
                                
                            </tbody>
                        </table>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

{{-- More Data for Campaign --}}
<div class="modal fade bd-example-modal-xl" id="moreModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Campain Additions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            
            <div class="modal-body bg-light">
                
                <div class="row g-3">
                    <ul id="moreErrorList" class="list-unstyled bg-danger form-control d-none">
                    </ul>
                </div>
                
                <h6>TAGS</h6>
                <hr class="border-dark">
                <form>
                    <div class="row g-3">
                        <div class="col-md-9">
                            <label class="form-label">Enter Tag</label>
                            <input class="form-control" id="idOne" type="hidden">
                            <input class="form-control" id="tag" name="">
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label" style="opacity:0;">.</label>
                            <button class="btn btn-primary form-control btn-lg" type="submit" id="btnAddTag">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <div class="modal-body bg-light">
                <h6>PHOTOS</h6>
                <hr class="border-dark">
                <form method="POST" id="addPhotosCampaign" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Upload Here</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        
                        <input class="form-control" id="idTwo" name="id" type="hidden">
                        
                        <div class="col-md-9">
                            <label class="form-label">Caption</label>
                            <input type="text" class="form-control" id="caption" name="caption">
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label" style="opacity:0;">.</label>
                            <button class="btn btn-danger form-control btn-lg" type="submit" id="btnUploadPhoto">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr class="border-dark">
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        
        var publicURL = '';
        var customURL = '';
        var campaignAdditionalFetchingId = '';
        
        tinymce.init({
            selector: '#description',
        });
        
        tinymce.init({
            selector: '#edit_description'
        });
        
        //csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //disable spaces in tag text field
        $("#tag").on({keydown: function(e) {
            if (e.which === 32)
            return false;
        },
        change: function() {
            this.value = this.value.replace(/\s/g, "");
        }
    });
    
    $("#thumbnail").change(function(){
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('selectedThumbnail');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
    
    //retrieve data to html table
    setInterval(function(){
        
        var combo = document.getElementById("filter");
        
        if($('#searchBar').val().length > 0)
        {
            var searchInput = $('#searchBar').val();
            
            var customURL = '{{ url("admin/dashboard/searchCampaign/:input") }}';
            customURL = customURL.replace(':input', searchInput);
            
            publicURL = customURL;
        }
        else if(combo.selectedIndex == 0 || combo.selectedIndex == 1)
        {
            publicURL = '{{ url("admin/dashboard/fetchCampaign") }}';
        }
        else if(combo.selectedIndex == 2)
        {
            publicURL = '{{ url("admin/dashboard/fetchActiveCampaign") }}';
        }
        else if(combo.selectedIndex == 3)
        {
            publicURL = '{{ url("admin/dashboard/fetchInactiveCampaign") }}';
        }
        else if(combo.selectedIndex == 4)
        {
            publicURL = '{{ url("admin/dashboard/fetchEndedCampaign") }}';
        }
        
        fetchCampaign();
        
    }, 2000);
    
    function fetchCampaign()
    {
        $.ajax({
            type:"GET",
            url:publicURL,
            dataType:"json",
            success:function(response){
                $('#campaignDataTable').html('');
                $.each(response.campaigns,function(key,item){
                    
                    //buttons
                    $buttons = '<button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#moreModal" class="btn btn-dark btn-sm" id="btnMoreModal"><i class="fa-solid fa-square-plus"></i></button>\
                    <button value="'+item.id+'" data-bs-toggle="modal" data-bs-target="#editCampaignModal" class="btn btn-primary btn-sm" id="btnEditCampaignModal"><i class="fa fa-pen"></i></button>\
                    <button value="'+item.id+'" class="btn btn-danger btn-sm" id="btnDeleteCampaign"><i class="fa fa-trash"></i></button>';
                    
                    if(item.status=="active"){
                        
                        $status_badge = '<span class="badge badge-success">Active</span>';
                        
                        $actionButton = $buttons;
                        
                        $statusControl = '<button value="'+item.id+'" class="btn btn-outline-danger btn-sm" id="btnDeactivate"><i class="fa-solid fa-eye-slash"></i></button>';
                        
                    }else if(item.status=="inactive"){
                        
                        $status_badge = '<span class="badge badge-danger">Inactive</span>';
                        
                        $actionButton = $buttons;
                        
                        $statusControl = '<button value="'+item.id+'" class="btn btn-outline-success btn-sm" id="btnActivate"><i class="fa fa-eye"></i></button>';
                        
                    }else if(item.status=="ended"){
                        
                        $status_badge = '<span class="badge badge-dark">Ended</span>';
                        
                        $actionButton = '';
                        
                        $statusControl = '';
                    }
                    
                    var updated_at_str = item.dateTime;
                    var updated_at_str = updated_at_str.slice(0, 10); 
                    
                    var campaignNo = item.no;
                    var campaignNo = campaignNo.slice(0, 6); 
                    
                    var title = item.title;
                    var title = title.slice(0, 18)+'...'; 
                    
                    $('#campaignDataTable').append('<tr>\
                        <td>'+campaignNo+'</td>\
                        <td>\
                            <div class="d-flex justify-content-left align-items-center">\
                                <div class="avatar  me-3">\
                                    <img src="'+item.thumbnail+'" alt="Avatar" width="64" height="64">\
                                </div>\
                                <div class="d-flex flex-column">\
                                    <span class="text-truncate fw-bold">'+title+'</span>\
                                </div>\
                            </div>\
                        </td>\
                        <td>'+updated_at_str+'</td>\
                        <td>'+$status_badge+'</td>\
                        <td class="text-center">\
                            <div class="dropdown">\
                                '+$statusControl+'\
                                '+$actionButton+'\
                            </div>\
                        </td>\
                    </tr>\
                    ');
                });
            }
        });
    }
    
    //insert data
    $(document).on('submit','#formNewCampaign',function(e){
        e.preventDefault();
        
        let formData = new FormData($('#formNewCampaign')[0]);
        
        var url = '{{ url("admin/dashboard/newCampaign") }}';
        
        $('#btnSaveNewCampaign').text('Saving...');
        
        $.ajax({
            type:"POST",
            url:url,
            data:formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.status==400)
                {
                    $('#errorList').html('');
                    $('#errorList').removeClass('d-none');
                    $.each(response.errors,function(key,err_value){
                        $('#errorList').append('<li>'+err_value+'</li>');
                    });
                    
                    $('#btnSaveNewCampaign').removeClass('btn-success');
                    $('#btnSaveNewCampaign').addClass('btn-primary');
                    $('#btnSaveNewCampaign').text('Save');
                }
                else if(response.status==200)
                {
                    $('#errorList').addClass('d-none');
                    $('#title').val('');
                    tinymce.get("description").setContent("");
                    $('#thumbnail').val('');
                    $('#status').selectedIndex=0;
                    
                    $('#btnSaveNewCampaign').removeClass('btn-primary');
                    $('#btnSaveNewCampaign').addClass('btn-success');
                    $('#btnSaveNewCampaign').text('Added!');
                    
                    setInterval(function(){
                        $('#btnSaveNewCampaign').removeClass('btn-success');
                        $('#btnSaveNewCampaign').addClass('btn-primary');
                        $('#btnSaveNewCampaign').text('Save');
                        $('#selectedThumbnail').attr("src","https://www.mindwebtree.com/wp-content/uploads/2022/06/29592647-40da86ca-875a-11e7-8bc3-941700b0a323.png");
                    }, 3000);
                }
            }
        });
    });
    
    //update data
    $(document).on('submit','#formEditCampaign',function(e){
        e.preventDefault();
        
        let formData = new FormData($('#formEditCampaign')[0]);
        
        var url = '{{ url("admin/dashboard/editCampaign") }}';
        
        $('#btnEditCampaign').text('Saving...');
        
        $.ajax({
            type:"POST",
            url:url,
            data:formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.status==400)
                {
                    $('#editErrorList').html('');
                    $('#editErrorList').removeClass('d-none');
                    $.each(response.errors,function(key,err_value){
                        $('#editErrorList').append('<li>'+err_value+'</li>');
                    });
                    
                    $('#btnEditCampaign').removeClass('btn-success');
                    $('#btnEditCampaign').addClass('btn-primary');
                    $('#btnEditCampaign').text('Save');
                }
                else if(response.status==200)
                {
                    $('#editErrorList').addClass('d-none');
                    $('#btnEditCampaign').removeClass('btn-primary');
                    $('#btnEditCampaign').addClass('btn-success');
                    $('#btnEditCampaign').text('Updated!');
                    
                    setInterval(function(){
                        $('#btnEditCampaign').removeClass('btn-success');
                        $('#btnEditCampaign').addClass('btn-primary');
                        $('#btnEditCampaign').text('Save');
                    }, 3000);
                }
            }
        });
    });
    
    //fetch single data record and open update data bootstrap modal
    $(document).on('click', '#btnEditCampaignModal',function(e){
        e.preventDefault();
        var id = $(this).val();
        
        var url = '{{ url("admin/dashboard/fetchSingleCampaign/:id") }}';
        url = url.replace(':id', id);
        
        $.ajax({
            type:"GET", url:url,
            success: function (response){
                if(response.status==404){
                    alert('Not Found!');
                }else{
                    $('#contentLabel').text('Edit Campaign No. '+response.campaigns.no);
                    $('#edit_title').val(response.campaigns.title);
                    $('#edit_no').val(response.campaigns.id);
                    tinymce.get("edit_description").setContent(response.campaigns.description);
                    $('#previousThumbnail').attr("src",response.campaigns.thumbnail);
                    $('#edit_startDate').val(response.campaigns.startDate);
                    $('#edit_endDate').val(response.campaigns.endDate);
                    campaignAdditionalFetchingId = response.campaigns.id;
                    
                    fetchCampaignAdditional();
                }
            }
        });
    });
    
    //get additional data
    function fetchCampaignAdditional()
    {
        var url = '{{ url("admin/dashboard/fetchSingleCampaign/:id") }}';
        url = url.replace(':id', campaignAdditionalFetchingId);
        
        $.ajax({
            type:"GET", url:url,
            success: function (response){
                //get campaign photos
                $('#campaignPhotosTable').html('');
                $.each(response.photos,function(key,itemPhoto){
                    $('#campaignPhotosTable').append('<tr>\
                        <td>\
                            <div class="avatar  me-3">\
                                <img src="'+itemPhoto.photo+'" alt="Avatar" width="64" height="64">\
                            </div>\
                        </td>\
                        <td class="text-center">\
                            <div class="dropdown">\
                                <button value="'+itemPhoto.id+'" class="btn btn-light-danger btn-sm" id="btnDeletePhoto"><i class="fa fa-trash"></i></button>\
                            </div>\
                        </td>\
                    </tr>\
                    ');
                });
                
                //get campaign tags
                $('#campaignTagsTable').html('');
                $.each(response.campaignTags,function(key,itemTag){
                    $('#campaignTagsTable').append('<tr>\
                        <td>'+itemTag.tag+'</td>\
                        <td class="text-center">\
                            <div class="dropdown">\
                                <button value="'+itemTag.id+'" class="btn btn-light-danger btn-sm" id="btnDeleteTag"><i class="fa fa-trash"></i></button>\
                            </div>\
                        </td>\
                    </tr>\
                    ');
                });
            }
        });
    }
    
    //delete photos
    $(document).on('click', '#btnDeletePhoto',function(e){
        e.preventDefault();
        
        var id = $(this).val();
        
        var url = '{{ url("admin/dashboard/deleteCampaignPhoto/:id") }}';
        url = url.replace(':id', id);
        
        $.ajax({
            type:"DELETE",
            url:url,
            dataType:"json",
            success:function(response){
                fetchCampaignAdditional();
            }
        });
    });
    
    //delete tags
    $(document).on('click', '#btnDeleteTag',function(e){
        e.preventDefault();
        
        var id = $(this).val();
        
        var url = '{{ url("admin/dashboard/deleteCampaignTag/:id") }}';
        url = url.replace(':id', id);
        
        $.ajax({
            type:"DELETE",
            url:url,
            dataType:"json",
            success:function(response){
                fetchCampaignAdditional();
            }
        });
    });
    
    //delete data
    $(document).on('click', '#btnDeleteCampaign',function(e){
        e.preventDefault();
        
        var campaignNo = $(this).val();
        
        var url = '{{ url("admin/dashboard/deleteCampaign/:campaignNo") }}';
        url = url.replace(':campaignNo', campaignNo);
        
        $.ajax({
            type:"DELETE",
            url:url,
            dataType:"json",
            success:function(response){
                fetchCampaign();
            }
        });
    });
    
    //activate
    $(document).on('click', '#btnActivate',function(e){
        e.preventDefault();
        var id = $(this).val();
        var status = 'active';
        var data = {
            'status' : status
        }
        
        var url = '{{ url("admin/dashboard/changeStatus/:id") }}';
        url = url.replace(':id', id);
        
        $.ajax({
            type:"PUT",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                fetchCampaign();
            }
        });
    });
    
    //Deactivate
    $(document).on('click', '#btnDeactivate',function(e){
        e.preventDefault();
        var id = $(this).val();
        var status = 'inactive';
        var data = {
            'status' : status
        }
        
        var url = '{{ url("admin/dashboard/changeStatus/:id") }}';
        url = url.replace(':id', id);
        
        $.ajax({
            type:"PUT",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                fetchCampaign();
            }
        });
    });
    
    //Deactivate
    $(document).on('click', '#btnMoreModal',function(e){
        e.preventDefault();
        var id = $(this).val();
        
        $('#idOne').val(id);
        $('#idTwo').val(id);
    });
    
    //add tags to campaign
    $(document).on('click', '#btnAddTag',function(e){
        e.preventDefault();
        
        var id = $('#idOne').val();
        var tag = $('#tag').val();
        
        var data = {
            'id' : id,
            'tag' : tag
        }
        
        var url = '{{ url("admin/dashboard/addTag") }}';
        
        $.ajax({
            type:"POST",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                if(response.status==400)
                {
                    $('#moreErrorList').html('');
                    $('#moreErrorList').removeClass('d-none');
                    $.each(response.errors,function(key,err_value){
                        $('#moreErrorList').append('<li>'+err_value+'</li>');
                    });
                    
                    $('#btnAddTag').addClass('btn-primary');
                    $('#btnAddTag').removeClass('btn-success');
                    $('#btnAddTag').text('Save');
                }
                else if(response.status==200)
                {
                    $('#moreErrorList').addClass('d-none');
                    $('#tag').val('');
                    $('#btnAddTag').removeClass('btn-primary');
                    $('#btnAddTag').addClass('btn-success');
                    $('#btnAddTag').text('Done!');
                    
                    setInterval(function(){
                        $('#btnAddTag').addClass('btn-primary');
                        $('#btnAddTag').removeClass('btn-success');
                        $('#btnAddTag').text('Save');
                    }, 1500);
                }
            }
        });
    });
    
    //add photos to campaign
    $(document).on('submit','#addPhotosCampaign',function(e){
        e.preventDefault();
        
        let formData = new FormData($('#addPhotosCampaign')[0]);
        
        var url = '{{ url("admin/dashboard/uploadPhoto") }}';
        
        $('#btnUploadPhoto').text('Saving...');
        
        $.ajax({
            type:"POST",
            url:url,
            data:formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.status==400)
                {
                    $('#moreErrorList').html('');
                    $('#moreErrorList').removeClass('d-none');
                    $.each(response.errors,function(key,err_value){
                        $('#moreErrorList').append('<li>'+err_value+'</li>');
                    });
                    
                    $('#btnUploadPhoto').removeClass('btn-success');
                    $('#btnUploadPhoto').addClass('btn-primary');
                    $('#btnUploadPhoto').text('Save');
                }
                else if(response.status==200)
                {
                    $('#moreErrorList').addClass('d-none');
                    $('#btnUploadPhoto').removeClass('btn-danger');
                    $('#btnUploadPhoto').addClass('btn-success');
                    $('#btnUploadPhoto').text('Done!');
                    $('#photo').val('');
                    $('#caption').val('');
                    
                    setInterval(function(){
                        $('#btnUploadPhoto').removeClass('btn-success');
                        $('#btnUploadPhoto').addClass('btn-danger');
                        $('#btnUploadPhoto').text('Upload');
                    }, 1500);
                }
            }
        });
    });
});

</script>
@endsection
