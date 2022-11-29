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
                                            <i class="fa fa-home" aria-hidden="true"></i>
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
                                            <i class="fa fa-home" aria-hidden="true"></i>
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
                                            <i class="fa fa-home" aria-hidden="true"></i>
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
                                            <i class="fa fa-home" aria-hidden="true"></i>
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
                                            <i class="fa fa-home" aria-hidden="true"></i>
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
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                        </div>
                                        <div class="">
                                            <p class="w-value" id="countBloodBags"></p>
                                            <p class=""><b>Total Available Blood Bags</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            
            
            function countBloodBags()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodBags').text(response);
                    }
                });
            }
            
            function countBloodRequests()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodRequests") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodRequests').text(response);
                    }
                });
            }
            
            function countAppointments()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countAppointments") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countAppointments').text(response);
                    }
                });
            }
            
            function countDonorRequests()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countDonorRequests") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countDonorRequests').text(response);
                    }
                });
            }
            
            function countDonations()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countDonations") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countDonations').text(response);
                    }
                });
            }
            
            function countUnreadMessages()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countUnreadMessages") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countUnreadMessages').text(response);
                    }
                });
            }
            
            //BLOOD COUNT================================================================================
            function countBloodBags_Apos()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags_Apos") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodBags_Apos').text(response);
                    }
                });
            }
            
            function countBloodBags_Aneg()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags_Aneg") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodBags_Aneg').text(response);
                    }
                });
            }
            
            function countBloodBags_Bpos()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags_Bpos") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodBags_Bpos').text(response);
                    }
                });
            }
            
            function countBloodBags_Bneg()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags_Bneg") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodBags_Bneg').text(response);
                    }
                });
            }
            
            function countBloodBags_ABpos()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags_ABpos") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodBags_ABpos').text(response);
                    }
                });
            }
            
            function countBloodBags_ABneg()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags_ABneg") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodBags_ABneg').text(response);
                    }
                });
            }
            
            function countBloodBags_Opos()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags_Opos") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodBags_Opos').text(response);
                    }
                });
            }
            
            function countBloodBags_Oneg()
            {
                $.ajax({
                    type:"GET",
                    url:'{{ url("admin/dashboard/countBloodBags_Oneg") }}',
                    dataType:"json",
                    success:function(response){
                        var response = JSON.parse(response);
                        $('#countBloodBags_Oneg').text(response);
                    }
                });
            }
            
            setInterval(function(){
                countBloodBags();
                countBloodRequests();
                countAppointments();
                countDonorRequests();
                countDonations();
                countUnreadMessages();
                
                countBloodBags_Apos();
                countBloodBags_Aneg();
                countBloodBags_Bpos();
                countBloodBags_Bneg();
                countBloodBags_ABpos();
                countBloodBags_ABneg();
                countBloodBags_Opos();
                countBloodBags_Oneg();
            }, 1000);
        })
    </script>
    @endsection
