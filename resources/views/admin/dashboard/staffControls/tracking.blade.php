@extends('admin.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>TRACK A DONATION</b></h3>
                <hr>
            </div>
            
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12">
                    <div class="widget-content widget-content-area">

                        <form>
                            <div class="row g-3" id="selectDonorRow">
                                <div class="col-md-9">
                                        <input type="text" class="form-control" id="donationNo" placeholder="Enter Donation No.">
                                </div>
                                <div class="col-md-3">
                                    <button class="form-control btn btn-lg btn-warning" id="btntrackDonation" value="">Track</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="row g-3 layout-top-spacing" id="viewDonorSection">
                            
                            <hr>

                            <div class="col-md-12">
                                <img id="trackDonorPhoto" class="form-control" src="" style="height:150px; object-fit: contain;">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donor No.</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonorNo">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donation No.</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonationNo">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donation Date</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonationDate">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donation Time</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonationTime">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label" for="">Blood Bag No.</label>
                                <input type="text" class="form-control text-dark" readonly id="trackBloodBagNo">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label" for="">Blood Group</label>
                                <input type="text" class="form-control text-dark" readonly id="trackBloodGroup">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label" for="">Blood Bag Status</label>
                                <input type="text" class="form-control text-center text-dark" readonly id="trackBloodBagStatus">
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <label class="form-label" for="">Donor Full Name</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonorFullname">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label" for="">Donor Address</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonorAddress">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="">Donor Telephone No.</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonorTelephone">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="">Donor Email</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonorEmail">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donor Gender</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonorGender">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donor Date of Birth</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonorDateofBirth">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donor Age</label>
                                <input type="text" class="form-control text-dark" readonly id="trackDonorAge">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donor Status</label>
                                <input type="text" class="form-control text-dark text-center" readonly id="trackDonorStatus">
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <label class="form-label" for="">Blood Receiver Full Name</label>
                                <input type="text" class="form-control text-dark" readonly id="trackBloodReceiverFullName">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="">Blood Receiver Request No.</label>
                                <input type="text" class="form-control text-dark" readonly id="trackBloodReceiverRequestNo">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="">Blood Receiver Email</label>
                                <input type="text" class="form-control text-dark" readonly id="trackBloodReceiverEmail">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="">Blood Receiver Telephone</label>
                                <input type="text" class="form-control text-dark" readonly id="trackBloodReceiverTelephone">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="">Blood Received Date</label>
                                <input type="text" class="form-control text-dark" readonly id="trackBloodReceivedDate">
                            </div>
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
        
        //csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //get donor 
        $(document).on('click', '#btntrackDonation',function(e){
            e.preventDefault();
            
            $('#trackBloodReceiverFullName').val('');
            $('#trackBloodReceiverRequestNo').val('');
            $('#trackBloodReceiverEmail').val('');
            $('#trackBloodReceiverTelephone').val('');
            $('#trackBloodReceivedDate').val('');
            
            var donationNo = $('#donationNo').val();
            var url = '{{ url("admin/dashboard/trackDonation/:donationNo") }}';
            url = url.replace(':donationNo', donationNo);
            
            $.ajax({
                type:"GET",
                url:url,
                dataType:"json",
                success:function(response){
                    
                    $.each(response.donations,function(key,item){
                        
                        var date_str = item.received_date;
                        var date_str = date_str.slice(0, 10); 
                        
                        var time_str = item.received_time;
                        var time_str = time_str.slice(11, 19); 
                        
                        $('#trackDonorPhoto').attr("src",item.photo);
                        $('#trackDonationNo').val(item.donationNo);
                        $('#trackDonationDate').val(date_str);
                        $('#trackDonationTime').val(time_str);
                        
                        $('#trackBloodBagNo').val(item.bag_no);
                        $('#trackBloodGroup').val(item.bloodGroup);
                        $('#trackBloodBagStatus').val(item.blood_status);
                        
                        $('#trackDonorNo').val(item.donorNo);
                        $('#trackDonorFullname').val(item.fullname);
                        $('#trackDonorAddress').val(item.address);
                        $('#trackDonorTelephone').val(item.telephone);
                        $('#trackDonorEmail').val(item.email);
                        $('#trackDonorGender').val(item.gender);
                        $('#trackDonorDateofBirth').val(item.dateofbirth);
                        $('#trackDonorAge').val(item.age);
                        $('#trackDonorStatus').val(item.donorStatus);
                        
                        
                        var receivedBloodBagNo = item.bag_no;
                        var receiver_url = '{{ url("admin/dashboard/trackDonationReceiver/:receivedBloodBagNo") }}';
                        receiver_url = receiver_url.replace(':receivedBloodBagNo', receivedBloodBagNo);
                        
                        $.ajax({
                            type:"GET",
                            url:receiver_url,
                            dataType:"json",
                            success:function(response){
                                $.each(response.requests,function(key,recItem){
                                    
                                    $('#trackBloodReceiverFullName').val(recItem.fullName);
                                    $('#trackBloodReceiverRequestNo').val(recItem.requestNo);
                                    $('#trackBloodReceiverEmail').val(recItem.email);
                                    $('#trackBloodReceiverTelephone').val(recItem.telephone);
                                    
                                    $('#trackBloodReceivedDate').val(recItem.fulfilDate);
                                });
                            }
                        });
                        //end receiver fetching
                    });
                }
            });
        });
        
        
    });
</script>
@endsection
