@extends('donor.layouts.master')

@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Dashboard</h3>
                            <div class="nk-block-des text-soft">
                                <p>Welcome to LIFE SAVER</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="row g-gs">
                    
                    <div class="col-md-12">
                        <div class="card card-bordered border-dark">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-0">
                                        <H3 style="font-weight:600;" id="getNextDonationDate">YOU CAN DONATE AGAIN ON</H3>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    
                    <div class="col-md-4">
                        <div class="card card-bordered border-primary">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-0">
                                    <div class="card-title">
                                        <h6 class="subtitle"><b>My Donations</b></h6>
                                    </div>
                                </div>
                                <div class="card-amount">
                                    <span class="amount" id="countDonationsMade">0</span>
                                </span>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                
                <div class="col-md-4">
                    <div class="card card-bordered border-primary">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-0">
                                <div class="card-title">
                                    <h6 class="subtitle"><b>My Pending Requests</b></h6>
                                </div>
                            </div>
                            <div class="card-amount">
                                <span class="amount" id="countBloodRequestsMade">0</span>
                            </span>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            
            <div class="col-md-4">
                <div class="card card-bordered border-danger">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle"><b>Blood Bank Total Available</b></h6>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount" id="countBloodBags">0</span>
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
                            <h6 class="subtitle"><b>Total Donors</b></h6>
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
                        <h6 class="subtitle"><b>Total Donations</b></h6>
                    </div>
                </div>
                <div class="card-amount">
                    <span class="amount" id="countDonations">0</span>
                </span>
            </div>
        </div>
    </div><!-- .card -->
</div><!-- .col -->

<div class="col-md-12 col-xxl-12">
    <div class="card card-bordered h-100">
        <div class="card-inner border-bottom">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Notifications</h6>
                </div>
            </div>
        </div>
        <div class="card-inner">
            <div class="timeline">
                <ul class="timeline-list" id="notificationPanel">
                    
                </ul>
            </div>
        </div>
    </div><!-- .card -->
</div><!-- .col -->
<div class="col-xl-12 col-xxl-8">
    <div class="card card-bordered card-full">
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
                    <thead>
                        <tr style="background: maroon; color:white;">
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
                        <tr style="background: red; color:white;">
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
</div>
</div>
</div>
</div>
</div>
</div>
<!-- content @e -->

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
        
        function homePageStatistics()
        {
            $.ajax({
                type:"GET",
                url:'{{ url("donor/dashboard/homePageStatistics") }}',
                dataType:"json",
                success:function(response){
                    $('#countDonationsMade').text(response.donationsMade);
                    $('#countBloodRequestsMade').text(response.bloodRequestsMade);
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

                    $('#getNextDonationDate').text('YOU CAN DONATE AGAIN ON '+response.nextDate);
                }
            });
        }
        
        setInterval(function(){
            homePageStatistics();
        }, 1000);
        
    });
</script>
@endsection