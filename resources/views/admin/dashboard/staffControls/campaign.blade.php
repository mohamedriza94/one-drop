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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#campaignModal" class="btn btn-primary btn-lg form-control" id="btnNewCampaign">New Campaign</a>
                    </div>
                    <div class="col-3">
                        <select id="filter" class="form-select" aria-label="Default select example">
                            <option selected="" disabled>Filter</option>
                            <option value="setnofilter" id="setnofilter">No filter</option>
                            <option value="setactive" id="setactive">Active</option>
                            <option value="setinactive" id="setinactive">Inactive</option>
                            <option value="setinactive" id="setinactive">Ended</option>
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

<div class="modal fade bd-example-modal-xl" id="campaignModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentLabel"></h5>
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
                            <button class="btn btn-primary form-control" type="submit">Save</button>
                        </div>
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
        
        $("#thumbnail").change(function(){
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('selectedThumbnail');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });
        
    });
    
</script>
@endsection
