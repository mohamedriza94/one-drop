@extends('hospital.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>BLOOD BAGS</b></h3>
                <hr>
            </div>
            
            <div class="widget-content widget-content-area layout-top-spacing">
                <div class="row">
                    {{-- choose blood start --}}
                    <div class="col-1">
                        <button class="btn btn-lg btn-light" id="aPos">A+</button>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-lg btn-light" id="aNeg">A-</button>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-lg btn-light" id="bPos">B+</button>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-lg btn-light" id="bNeg">B-</button>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-lg btn-light" id="abPos">AB+</button>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-lg btn-light" id="abNeg">AB-</button>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-lg btn-light" id="oPos">O+</button>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-lg btn-light" id="oNeg">O-</button>
                    </div>
                    
                    {{-- choose blood end --}}
                    <div class="col-3">
                        <select id="filter" class="form-select" aria-label="Default select example">
                            <option selected="" disabled>Filter</option>
                            <option>All</option>
                            <option>Available</option>
                            <option>Expired</option>
                            <option>Used</option>
                            <option class="d-none">Custom</option>
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
                                            <th scope="col"><b>Bag No.</b></th>
                                            <th scope="col">Blood Group</th>
                                            <th scope="col">Rec. Date</th>
                                            <th scope="col">Rec. Time</th>
                                            <th scope="col">Expiry Date</th>
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

{{-- view blood details modal --}}
<div class="modal fade bd-example-modal-lg" id="viewBloodDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Blood Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
              </button>
          </div>

          <div class="modal-body">

            <div class="row g-3">

                <div class="col-md-4">
                    <img id="viewDonorPhoto" class="form-control" src="" style="height:150px; object-fit: contain;">
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="">Donor No.</label>
                    <input type="text" class="form-control text-dark" readonly id="viewDonorNo">
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="">Telephone</label>
                    <input type="text" class="form-control text-dark" readonly id="viewDonorTelephone">
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="">Full Name</label>
                    <input type="text" class="form-control text-dark" readonly id="viewDonorFullname">
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="">Donation No.</label>
                    <input type="text" class="form-control text-dark" readonly id="viewDonationNo">
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="">Blood Bag No.</label>
                    <input type="text" class="form-control text-dark" readonly id="viewBloodBagNo">
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="">Blood Group</label>
                    <input type="text" class="form-control bg-danger text-light text-center" readonly id="viewBloodGroup">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="">Donation Date</label>
                    <input type="text" class="form-control text-dark" readonly id="viewDonationDate">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="">Donation Time</label>
                    <input type="text" class="form-control text-dark" readonly id="viewDonationTime">
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
        
        var publicURL = '';
        var customURL = ''; //for custom blood group selection

        //csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //change button colors start
            $('#aPos').click(function(){
            $(this).removeClass('btn-light');
            $(this).addClass('btn-danger');
            
            $('#bPos').removeClass('btn-danger');
            $('#abPos').removeClass('btn-danger');
            $('#oPos').removeClass('btn-danger');
            
            $('#aNeg').removeClass('btn-danger');
            $('#bNeg').removeClass('btn-danger');
            $('#abNeg').removeClass('btn-danger');
            $('#oNeg').removeClass('btn-danger');

            $('#filter').val('Custom');

            var bloodGroup = 'A+';
            customURL = '{{ url("hospital/dashboard/fetchCustomBloodBags/:bloodGroup") }}';
            customURL = customURL.replace(':bloodGroup', bloodGroup);
            });
        
            $('#aNeg').click(function(){
            $(this).removeClass('btn-light');
            $(this).addClass('btn-danger');
            
            $('#aPos').removeClass('btn-danger');
            $('#bPos').removeClass('btn-danger');
            $('#abPos').removeClass('btn-danger');
            $('#oPos').removeClass('btn-danger');
            
            $('#bNeg').removeClass('btn-danger');
            $('#abNeg').removeClass('btn-danger');
            $('#oNeg').removeClass('btn-danger');

            $('#filter').val('Custom');

            var bloodGroup = 'A-';
            customURL = '{{ url("hospital/dashboard/fetchCustomBloodBags/:bloodGroup") }}';
            customURL = customURL.replace(':bloodGroup', bloodGroup);
            });
        
            $('#bPos').click(function(){
            $(this).removeClass('btn-light');
            $(this).addClass('btn-danger');
            
            $('#aPos').removeClass('btn-danger');
            $('#abPos').removeClass('btn-danger');
            $('#oPos').removeClass('btn-danger');
            
            $('#aNeg').removeClass('btn-danger');
            $('#bNeg').removeClass('btn-danger');
            $('#abNeg').removeClass('btn-danger');
            $('#oNeg').removeClass('btn-danger');

            $('#filter').val('Custom');

            var bloodGroup = 'B+';
            customURL = '{{ url("hospital/dashboard/fetchCustomBloodBags/:bloodGroup") }}';
            customURL = customURL.replace(':bloodGroup', bloodGroup);
            });
        
            $('#bNeg').click(function(){
            $(this).removeClass('btn-light');
            $(this).addClass('btn-danger');
            
            $('#aPos').removeClass('btn-danger');
            $('#bPos').removeClass('btn-danger');
            $('#abPos').removeClass('btn-danger');
            $('#oPos').removeClass('btn-danger');
            
            $('#aNeg').removeClass('btn-danger');
            $('#abNeg').removeClass('btn-danger');
            $('#oNeg').removeClass('btn-danger');

            $('#filter').val('Custom');

            var bloodGroup = 'B-';
            customURL = '{{ url("hospital/dashboard/fetchCustomBloodBags/:bloodGroup") }}';
            customURL = customURL.replace(':bloodGroup', bloodGroup);
            });
        
            $('#abPos').click(function(){
            $(this).removeClass('btn-light');
            $(this).addClass('btn-danger');
            
            $('#aPos').removeClass('btn-danger');
            $('#bPos').removeClass('btn-danger');
            $('#oPos').removeClass('btn-danger');
            
            $('#aNeg').removeClass('btn-danger');
            $('#bNeg').removeClass('btn-danger');
            $('#abNeg').removeClass('btn-danger');
            $('#oNeg').removeClass('btn-danger');

            $('#filter').val('Custom');

            var bloodGroup = 'AB+';
            customURL = '{{ url("hospital/dashboard/fetchCustomBloodBags/:bloodGroup") }}';
            customURL = customURL.replace(':bloodGroup', bloodGroup);
            });
        
            $('#abNeg').click(function(){
            $(this).removeClass('btn-light');
            $(this).addClass('btn-danger');
            
            $('#aPos').removeClass('btn-danger');
            $('#abPos').removeClass('btn-danger');
            $('#bPos').removeClass('btn-danger');
            $('#oPos').removeClass('btn-danger');
            
            $('#aNeg').removeClass('btn-danger');
            $('#bNeg').removeClass('btn-danger');
            $('#oNeg').removeClass('btn-danger');

            $('#filter').val('Custom');

            var bloodGroup = 'AB-';
            customURL = '{{ url("hospital/dashboard/fetchCustomBloodBags/:bloodGroup") }}';
            customURL = customURL.replace(':bloodGroup', bloodGroup);
            });
        
            $('#oPos').click(function(){
            $(this).removeClass('btn-light');
            $(this).addClass('btn-danger');
            
            $('#aPos').removeClass('btn-danger');
            $('#abPos').removeClass('btn-danger');
            $('#bPos').removeClass('btn-danger');
            
            $('#aNeg').removeClass('btn-danger');
            $('#abNeg').removeClass('btn-danger');
            $('#bNeg').removeClass('btn-danger');
            $('#oNeg').removeClass('btn-danger');

            $('#filter').val('Custom');

            var bloodGroup = 'O+';
            customURL = '{{ url("hospital/dashboard/fetchCustomBloodBags/:bloodGroup") }}';
            customURL = customURL.replace(':bloodGroup', bloodGroup);
            });
        
            $('#oNeg').click(function(){
            $(this).removeClass('btn-light');
            $(this).addClass('btn-danger');
            
            $('#aPos').removeClass('btn-danger');
            $('#abPos').removeClass('btn-danger');
            $('#bPos').removeClass('btn-danger');
            $('#oPos').removeClass('btn-danger');
            
            $('#aNeg').removeClass('btn-danger');
            $('#abNeg').removeClass('btn-danger');
            $('#bNeg').removeClass('btn-danger');

            $('#filter').val('Custom');

            var bloodGroup = 'O-';
            customURL = '{{ url("hospital/dashboard/fetchCustomBloodBags/:bloodGroup") }}';
            customURL = customURL.replace(':bloodGroup', bloodGroup);
            });
        //change button colors end

        function unClickCustomButtons()
        {
            $('#aPos').removeClass('btn-danger');
            $('#bPos').removeClass('btn-danger');
            $('#abPos').removeClass('btn-danger');
            $('#bPos').removeClass('btn-danger');
            
            $('#aNeg').removeClass('btn-danger');
            $('#abNeg').removeClass('btn-danger');
            $('#bNeg').removeClass('btn-danger');
            $('#oNeg').removeClass('btn-danger');
        }

        function chooseFilter()
        {
            var combo = document.getElementById("filter");
            
            if(combo.selectedIndex == 4)
            {
                unClickCustomButtons();
                publicURL = '{{ url("hospital/dashboard/fetchUsedBloodBags") }}';
            }
            else if(combo.selectedIndex == 3)
            { 
                unClickCustomButtons();
                publicURL = '{{ url("hospital/dashboard/fetchExpiredBloodBags") }}';
            }
            else if(combo.selectedIndex == 2)
            { 
                unClickCustomButtons();
                publicURL = '{{ url("hospital/dashboard/fetchAvailableBloodBags") }}';
            }
            else if(combo.selectedIndex == 1)
            {
                unClickCustomButtons();
                publicURL = '{{ url("hospital/dashboard/fetchBloodBags") }}';
            }
            else if(combo.selectedIndex == 0)
            {
                unClickCustomButtons();
                publicURL = '{{ url("hospital/dashboard/fetchBloodBags") }}';
            }
            else
            {
                publicURL = customURL;
            }
        }
        
        function fetchBloodBags()
        {
            $.ajax({
                type:"GET",
                url:publicURL,
                dataType:"json",
                success:function(response){
                    $('tbody').html('');
                    $.each(response.blood_bags,function(key,item){
                        
                        if(item.status=="available"){
                            
                            $statusBadge = '<span class="badge badge-light-success">Available</span>';
                            
                        }
                        else if(item.status=="expired"){
                            
                            $statusBadge = '<span class="badge badge-light-danger">Expired</span>';
                            
                        }
                        else if(item.status=="used"){
                            
                            $statusBadge = '<span class="badge badge-light-dark">Used</span>';
                            
                        }
                        
                        var date_str = item.received_date;
                        var date_str = date_str.slice(0, 10); 
                        
                        var time_str = item.received_time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $actionButton = '<button value="'+item.bag_no+'" data-bs-toggle="modal" data-bs-target="#viewBloodDetailsModal" class="btn btn-primary btn-sm" id="btnViewBloodDetails">View</button>';
                        
                        $('tbody').append('<tr>\
                            <td><b>'+item.bag_no+'</b></td>\
                            <td>'+item.bloodGroup+'</td>\
                            <td>'+date_str+'</td>\
                            <td>'+time_str+'</td>\
                            <td>'+item.expiry_date+'</td>\
                            <td>'+$statusBadge+'</td>\
                            <td>'+$actionButton+'</td>\
                        </tr>\
                        ');
                    });
                }
            });
        }

        setInterval(function(){
            chooseFilter();
            fetchBloodBags();
        }, 2000);

        $(document).on('click', '#btnViewBloodDetails',function(e){

            var bloodBagNo = $(this).val();
            url = '{{ url("hospital/dashboard/fetchSingleBloodBag/:bloodBagNo") }}';
            url = url.replace(':bloodBagNo', bloodBagNo);

            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    $.each(response.blood_bags,function(key,item){
                        
                        var date_str = item.received_date;
                        var date_str = date_str.slice(0, 10); 
                        
                        var time_str = item.received_time;
                        var time_str = time_str.slice(11, 19); 

                        $('#viewDonorPhoto').attr("src",item.photo);
                        $('#viewDonorNo').val(item.donorNo);
                        $('#viewDonorTelephone').val(item.telephone);
                        $('#viewDonorFullname').val(item.fullname);
                        $('#viewDonationNo').val(item.donationNo);
                        $('#viewBloodBagNo').val(item.bloodBagNo);
                        $('#viewBloodGroup').val(item.bloodGroup);
                        $('#viewDonationDate').val(date_str);
                        $('#viewDonationTime').val(time_str);
                    });
                }
            });

        });
        
    })
</script>
@endsection
