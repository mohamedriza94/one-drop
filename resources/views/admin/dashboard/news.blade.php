@extends('admin.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>NEWS AND UPDATES</b></h3>
                <hr>
            </div>
            
            <div class="widget-content widget-content-area layout-top-spacing">
                <div class="row">
                    <div class="col-12">
                        <form><input type="text" placeholder="Search Title..." id="searchBar" class="form-control"></form>
                    </div>
                </div>
            </div>
            
            <div class="row layout-top-spacing">
                
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="blog-list" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Post</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="no-content text-center">Action</th>
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

<style>
    .upper{
        text-transform: uppercase;
    }
</style>

<div class="modal fade bd-example-modal-xl" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="row g-3">
                    <div class="bg-dark">
                        <img id="thumbnail" class="col-md-12" src="" style="height:300px; object-fit: contain;">
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label upper"><b>Title :</b></label>
                        <p class="text-dark form-control" id="title"></p>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label upper"><b>Description :</b></label>
                        <p class="text-dark form-control" id="description"></p>
                    </div>

                    <hr class="border-dark">
                    
                    <label class="form-label upper"><b><u>RESPONSIBLE STAFF MEMBER</u></b></label>
                    
                    <img id="profilePhoto" class="col-md-2" src="">
                    
                    <div class="col-md-4">
                        <label class="form-label upper"><b>Telephone :</b></label>
                        <p class="text-dark form-control" id="telephone"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label upper"><b>Status :</b></label>
                        <p class="text-dark form-control" id="status"></p>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label upper"><b>Name :</b></label>
                        <p class="text-dark form-control" id="fullname"></p>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label upper"><b>Email :</b></label>
                        <p class="text-dark form-control" id="email"></p>
                    </div>
                </form>
            </div>
            
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    
    $(document).ready(function(){
        
        var publicURL = "";
        
        //csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //retrieve data to html table
        setInterval(function(){
            if($('#searchBar').val().length > 0)
            {
                var input = $('#searchBar').val();
                
                publicURL = '{{ url("admin/dashboard/adminSearchNews/:input") }}';
                publicURL = publicURL.replace(':input', input);
            }
            else
            {
                publicURL = '{{ url("admin/dashboard/adminFetchNews") }}';
            }
            
            adminFetchNews();
            
        }, 2000);
        
        //search data
        $('#searchBar').keyup(function(){   
            adminFetchNews();
        });
        
        //fetch news
        function adminFetchNews()
        {
            $.ajax({
                type:"GET",
                url:publicURL,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.newsandupdates,function(key,item){
                        
                        var title_str = item.title;
                        var title_str = title_str.slice(0, 40); 
                        
                        var updated_at_str = item.updated_at;
                        var updated_at_str = updated_at_str.slice(0, 10); 
                        
                        $status_button = '';
                        
                        if(item.status == 'active')
                        {
                            $status_button = '<span class="badge badge-success">Active</span>';
                        }
                        else
                        {
                            $status_button = '<span class="badge badge-success">Inactive</span>';
                        }
                        
                        $('tbody').append('<tr>\
                            <td>\
                                <div class="d-flex justify-content-left align-items-center">\
                                    <div class="avatar  me-3">\
                                        <img src="'+item.thumbnail+'" alt="Avatar" width="64" height="64">\
                                    </div>\
                                    <div class="d-flex flex-column">\
                                        <span class="text-truncate fw-bold">'+title_str+'</span>\
                                    </div>\
                                </div>\
                            </td>\
                            <td>'+updated_at_str+'</td>\
                            <td>'+$status_button+'</td>\
                            <td class="text-center">\
                                <div class="dropdown">\
                                    <button class="btn btn-primary" id="btnView" data-bs-toggle="modal" data-bs-target="#viewModal" value="'+item.id+'"><i class="fa fa-eye"></i></button>\
                                </div>\
                            </td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        //fetch single data record and open update data bootstrap modal
        $(document).on('click', '#btnView',function(e){
            e.preventDefault();
            
            var id = $(this).val();
            var url = '{{ url("admin/dashboard/adminfetchSingleNews/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET", 
                url:url,
                success: function (response){
                    $('#contentLabel').text('Post No. '+response.newsandupdates.news_no);
                    $('#title').html(response.newsandupdates.title);
                    $('#description').html(response.newsandupdates.description);
                    $('#thumbnail').attr("src",response.newsandupdates.thumbnail);

                    //staff details
                    $('#profilePhoto').attr("src",response.staffMember.photo);
                    $('#telephone').html(response.staffMember.telephone);
                    $('#status').html(response.staffMember.status);
                    $('#fullname').html(response.staffMember.fullname);
                    $('#email').html(response.staffMember.email);
                }
            });
        });
    });
    
</script>
@endsection
