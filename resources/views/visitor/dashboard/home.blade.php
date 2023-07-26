@extends('visitor.layouts.master')

@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">LIFE SAVER - BLOOD DONATION AND BLOOD BANK MANAGEMENT</h3>
                            <div class="nk-block-des text-soft">
                                <p>We make blood donation and transfusion easier</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="row g-gs">
                    
                    <div class="col-md-6">
                        <div class="card card-bordered border-success">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-0">
                                    <div class="card-title">
                                        <h6 class="subtitle"><b>Our Active Donors</b></h6>
                                    </div>
                                </div>
                                <div class="card-amount">
                                    <span class="amount" id="countDonors">0</span>
                                </span>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                
                <div class="col-md-6">
                    <div class="card card-bordered border-success">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-0">
                                <div class="card-title">
                                    <h6 class="subtitle"><b>Donations Till Date</b></h6>
                                </div>
                            </div>
                            <div class="card-amount">
                                <span class="amount" id="countDonations">0</span>
                            </span>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            
            <div class="col-xl-12 col-xxl-8">
                <div class="card card-bordered border-danger card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Blood Bank</h6>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-inner">
                        <div class="table-responsive">
                            <table class="table" style="text-align: center;">
                                <thead class="table-light">
                                    <tr class="">
                                        <th scope="col">A+</th>
                                        <th scope="col">A-</th>
                                        <th scope="col">AB+</th>
                                        <th scope="col">AB-</th>
                                        <th scope="col">B+</th>
                                        <th scope="col">B-</th>
                                        <th scope="col">O+</th>
                                        <th scope="col">O-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-danger text-white">
                                        <td id="countBloodBags_Apos"></td>
                                        <td id="countBloodBags_Aneg"></td>
                                        <td id="countBloodBags_ABpos"></td>
                                        <td id="countBloodBags_ABneg"></td>
                                        <td id="countBloodBags_Bpos"></td>
                                        <td id="countBloodBags_Bneg"></td>
                                        <td id="countBloodBags_Opos"></td>
                                        <td id="countBloodBags_Oneg"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div><!-- .card -->
            </div><!-- .col -->
            
            <div class="nk-block nk-block-lg">
                <div class="card card-bordered card-preview border-dark">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Ongoing Campaigns</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <div class="row" id="campaignCards">
                            
                            
                            
                        </div>
                    </div>
                </div><!-- .card-preview -->
            
                <div class="card card-bordered card-preview border-primary">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Latest</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <div class="row" id="newsCards">
                            
                        </div>
                    </div>
                    
                    <a class="bg-primary text-bold text-center text-white" href="{{ Route('visitor.news') }}"><b>See More Posts</b></a>
                </div><!-- .card-preview -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- content @e -->

<div class="modal fade" tabindex="-1" role="dialog" id="readMoreModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal"><em
                class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <div class="mt-2">
                        <div class="row g-gs">
                            <div class="col 12">
                                <div class="gallery-image">
                                    <img class="w-100 rounded-top" id="thumbnail" src="" alt="">
                                </div>
                                <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                    <div class="user-card">
                                        <div class="">
                                            <p class="text-primary" id="lastUpdatedDate"></p>
                                            <h5 class="text-dark" id="title"></h5>
                                            <div id="description">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
    
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
            
            
            fetchUpdates();
            
            function fetchUpdates()
            {
                var url = '{{ url("visitor/dashboard/fetchUpdates_ForHomePage") }}';
                
                $.ajax({
                    type:"GET",
                    url:url,
                    dataType:"json",
                    success:function(response){
                        $('#newsCards').html('');
                        $('#campaignCards').html('');
                        $.each(response.newsandupdates,function(key,item){
                            
                            var title_str = item.title;
                            var title_str = title_str.slice(0, 25); 
                            
                            var description_str = item.description;
                            var description_str = description_str.slice(0, 100)+'...'; 
                            
                            var updated_at_str = item.updated_at;
                            var updated_at_str = updated_at_str.slice(0, 10); 
                            
                            $('#newsCards').append('<div class="col-lg-4">\
                                <div class="card card-bordered">\
                                    <img src="'+item.thumbnail+'" class="card-img-top" alt="">\
                                    <div class="card-inner">\
                                        <h5 class="card-title">'+title_str+'</h5>\
                                        <p class="card-text">'+description_str+'</p>\
                                        <p class="text-primary">Last updated on '+updated_at_str+'</p>\
                                        <button class="btn btn-primary" id="btnReadMore" data-bs-toggle="modal"\
                                        data-bs-target="#readMoreModal" value="'+item.id+'">Read More</button>\
                                    </div>\
                                </div>\
                            </div>\
                            ');
                        });
                        
                        $.each(response.campaigns,function(key,itemCampaign){
                            
                            var campainTitle_str = itemCampaign.title;
                            var campainTitle_str = campainTitle_str.slice(0, 40); 

                            var tags = "";
                            var urlFetchTags = '{{ url("visitor/dashboard/fetchCampainTags_ForHomePage/:campaignId") }}';
                            urlFetchTags = urlFetchTags.replace(':campaignId', itemCampaign.id);
                            $.ajax({
                                type:"GET",
                                url:urlFetchTags,
                                dataType:"json",
                                success:function(response){
                                    $.each(response.campaignTags,function(key,itemTags){
                                        $('#'+itemTags.campaignNo).append('<span class="badge bg-light p-1 me-1">'+itemTags.tag+'</span>');
                                    });
                                }
                            });
                            
                            $('#campaignCards').append('<div class="col-lg-4">\
                                <div class="card card-bordered">\
                                    <img src="'+itemCampaign.thumbnail+'" class="card-img-top" alt="">\
                                    <div class="card-inner">\
                                        <h5 class="card-title">'+campainTitle_str+'</h5>\
                                        <p class="badge bg-danger" id="endingDate">ENDS ON '+itemCampaign.endDate+'</p><br>\
                                        <div class="d-flex justify-content-start" id="'+itemCampaign.id+'">\
                                        </div><br>\
                                        <a href="seeCampaign/'+itemCampaign.id+'" class="btn btn-sm btn-dark">See Campaign</a>\
                                    </div>\
                                </div>\
                            </div>\
                            ');
                        });
                    }
                });
            }
            
            //read more news
            $(document).on('click', '#btnReadMore',function(e){
                e.preventDefault();
                var id = $(this).val();
                
                var url = '{{ url("visitor/dashboard/fetchSingleNews/:id") }}';
                url = url.replace(':id', id);
                
                $.ajax({
                    type:"GET", url:url,
                    success: function (response){
                        if(response.status==404){
                            alert('Post Does Not Exist')
                        }else{
                            $('#title').text(response.newsandupdates.title);
                            $('#description').html(response.newsandupdates.description);
                            $('#thumbnail').attr("src",response.newsandupdates.thumbnail);
                            
                            var updated_at_str = response.newsandupdates.updated_at;
                            var updated_at_str = updated_at_str.slice(0, 10); 
                            
                            $('#lastUpdatedDate').text('Last updated on '+updated_at_str);
                        }
                    }
                });
            });
            
            function homePageStatistics()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("visitor/dashboard/homePageStatistics") }}',
                    dataType:"json",
                    success:function(response){
                        $('#countDonations').text(response.donations);
                        $('#countDonors').text(response.donors);
                        $('#countBloodBags').text(response.bloodBags);
                        
                        $('#countBloodBags_Apos').text(response.bloodBagsApos);
                        $('#countBloodBags_Aneg').text(response.bloodBagsAneg);
                        $('#countBloodBags_Bpos').text(response.bloodBagsBpos);
                        $('#countBloodBags_Bneg').text(response.bloodBagsBneg);
                        $('#countBloodBags_ABpos').text(response.bloodBagsABpos);
                        $('#countBloodBags_ABneg').text(response.bloodBagsABneg);
                        $('#countBloodBags_Opos').text(response.bloodBagsOpos);
                        $('#countBloodBags_Oneg').text(response.bloodBagsOneg);
                    }
                });
            }
            
            setInterval(function(){
                homePageStatistics();
            }, 1000);
            
        });
    </script>
    @endsection
    
