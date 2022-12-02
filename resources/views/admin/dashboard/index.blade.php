@extends('admin.layouts.master')

@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="row layout-top-spacing">
                
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row widget-statistic">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                            <i class="fa-solid fa-hand-holding-hand"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countDonorRequests"></p>
                                            <p class=""><b>Pending Donor Requests</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                            <i class="fa-solid fa-hand-holding-medical"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countAppointments"></p>
                                            <p class=""><b>Pending Appointments</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                            <i class="fa-solid fa-truck-droplet"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countBloodRequests"></p>
                                            <p class=""><b>Pending Blood Requests</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countDonations"></p>
                                            <p class=""><b>Donations</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                            <i class="fa-solid fa-hands-holding-child"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countDonors"></p>
                                            <p class=""><b>Donors</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countUnreadMessages"></p>
                                            <p class=""><b>Unread Messages</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                            <i class="fa fa-droplet" aria-hidden="true"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countBloodBags"></p>
                                            <p class=""><b>Total Available Blood Bags</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if (Auth::user()->role=='admin')
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countStaff"></p>
                                            <p class=""><b>Active Staff</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                            <div class="widget widget-one_hybrid widget-followers">
                                <div class="widget-heading">
                                    <div class="w-title">
                                        <div class="w-icon">
                                            <i class="fa fa-hospital" aria-hidden="true"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countHospital"></p>
                                            <p class=""><b>Active Hospitals</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                    </div>
                </div>
                
                <div id="tableMixed" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4><strong>Blood Bags - Live count of available blood bags</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-danger">
                                            <th class="text-center" scope="col">A+</th>
                                            <th class="text-center" scope="col">A-</th>
                                            <th class="text-center" scope="col">B+</th>
                                            <th class="text-center" scope="col">B-</th>
                                            <th class="text-center" scope="col">AB+</th>
                                            <th class="text-center" scope="col">AB-</th>
                                            <th class="text-center" scope="col">O+</th>
                                            <th class="text-center" scope="col">O-</th>
                                        </tr>
                                        <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-danger">
                                            <td id="countBloodBags_Apos" class="text-center" scope="col"></td>
                                            <td id="countBloodBags_Aneg" class="text-center" scope="col"></td>
                                            <td id="countBloodBags_Bpos" class="text-center" scope="col"></td>
                                            <td id="countBloodBags_Bneg" class="text-center" scope="col"></td>
                                            <td id="countBloodBags_ABpos" class="text-center" scope="col"></td>
                                            <td id="countBloodBags_ABneg" class="text-center" scope="col"></td>
                                            <td id="countBloodBags_Opos" class="text-center" scope="col"></td>
                                            <td id="countBloodBags_Oneg" class="text-center" scope="col"></td>
                                        </tr>
                                    </tbody>
                                </table>
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
            
            function otherCounts()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/otherCounts") }}',
                    dataType:"json",
                    success:function(response){
                        $('#countDonorRequests').text(response.donorRequests);
                        $('#countAppointments').text(response.appointments);
                        $('#countBloodRequests').text(response.bloodRequests);
                        $('#countDonations').text(response.donations);
                        $('#countDonors').text(response.donors);
                        $('#countUnreadMessages').text(response.messages);
                        $('#countBloodBags').text(response.bloodBags);
                        $('#countStaff').text(response.admins);
                        $('#countHospital').text(response.hospitals);
                    }
                });
            }
            
            //BLOOD COUNT================================================================================
            function countBloodBags_cat()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags_cat") }}',
                    dataType:"json",
                    success:function(response){
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
                otherCounts();
                countBloodBags_cat();
            }, 1000);
        })
    </script>
    @endsection
