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
                                                    <p class="w-value">31.6K</p>
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
                                                    <p class="w-value">31.6K</p>
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
                                                    <p class="w-value">31.6K</p>
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
                                                    <p class="w-value">31.6K</p>
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
                                                    <p class="w-value">31.6K</p>
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
                                                    <td id="countA+" class="text-center" scope="col">A+</td>
                                                    <td id="countA-" class="text-center" scope="col">A-</td>
                                                    <td id="countB+" class="text-center" scope="col">B+</td>
                                                    <td id="countB-" class="text-center" scope="col">B-</td>
                                                    <td id="countAB+" class="text-center" scope="col">AB+</td>
                                                    <td id="countAB-" class="text-center" scope="col">AB-</td>
                                                    <td id="countO+" class="text-center" scope="col">O+</td>
                                                    <td id="countO-" class="text-center" scope="col">O-</td>
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
                url:'{{ url("/countBloodBags") }}',
                dataType:"json",
                success:function(response){
                    $.each(response.blood_bags,function(key,item){
                        $('#countBloodBags').text(Object.keys(item).length);
                    });
                }
            });
        }

        setInterval(function(){
            countBloodBags();
        }, 1000);
    })
</script>
@endsection
