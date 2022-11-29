@extends('admin.layouts.master')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>DONATE BLOOD</b></h3>
                <hr>
            </div>
            
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12">
                    <div class="widget-content widget-content-area">

                        <form>
                            <div class="row g-3" id="selectDonorRow">
                                <div class="col-md-9">
                                        <input type="text" class="form-control" id="getDonorInput" placeholder="Enter Donor NIC No.">
                                </div>
                                <div class="col-md-3">
                                    <button class="form-control btn btn-lg btn-primary" id="btnGetDonor" value="">Get Donor</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="row g-3 layout-top-spacing d-none" id="viewDonorSection">
                            
                            <hr>

                            <div class="col-md-3">
                                <img id="viewPhoto" class="form-control" src="" style="height:100px; object-fit: contain;">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donor No.</label>
                                <input type="text" class="form-control text-dark" readonly id="viewDonorNo">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">NIC No.</label>
                                <input type="text" class="form-control text-dark" readonly id="viewNic">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Telephone</label>
                                <input type="text" class="form-control text-dark" readonly id="viewTelephone">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label" for="">Full Name</label>
                                <input type="text" class="form-control text-dark" readonly id="viewFullname">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Gender</label>
                                <input type="text" class="form-control text-dark" readonly id="viewGender">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Date of Birth</label>
                                <input type="text" class="form-control text-dark" readonly id="viewDateofbirth">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Age</label>
                                <input type="text" class="form-control text-dark" readonly id="viewAge">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Blood Group</label>
                                <input type="text" class="form-control text-dark" readonly id="viewBloodGroup">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Registered Date</label>
                                <input type="text" class="form-control text-dark" readonly id="viewRegisteredDate">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Registered Time</label>
                                <input type="text" class="form-control text-dark" readonly id="viewRegisteredTime">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="">Email</label>
                                <input type="text" class="form-control text-dark" readonly id="viewEmail">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12 col-12 layout-top-spacing d-none" id="medicalCheckupStatusSection">
                    <div class="widget-content widget-content-area">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="">Last Medical Checkup Status.</label>
                                <select id="lastMedicalCheckupStatusSelect" onchange="checkMedicalCheckupStatus()" class="form-control">
                                    <option value="Choose">Choose</option>
                                    <option value="pass">Pass</option>
                                    <option value="fail">Fail</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-12 layout-top-spacing d-none" id="donationForm">
                    <div class="widget-content widget-content-area">
                        <div class="row g-3">

                            <ul class="bg-danger form-control px-5 d-none" id="errorList">
                            </ul>
                            
                            <input type="hidden" id="donorBloodGroupInput" value="">

                            <div class="col-md-12">
                                <label class="form-label text-light" for="">.</label>
                                <button class="form-control btn btn-lg btn-success" id="btnDonate" value="">Donate</button>
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
    $(document).on('click', '#btnGetDonor',function(e){
        e.preventDefault();
        
        var no = $('#getDonorInput').val();
        
        var url = '{{ url("admin/dashboard/getDonor/:id") }}';
        url = url.replace(':id', no);
        
        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            success:function(response){
                
                $.each(response.donors,function(key,item){

                    var date_str = item.registered_date;
                    var date_str = date_str.slice(0, 10); 
                    
                    var time_str = item.registered_time;
                    var time_str = time_str.slice(11, 19); 
                    
                    $('#viewPhoto').attr("src",item.photo);
                    $('#viewDonorNo').val(item.no);
                    $('#viewNic').val(item.nic);
                    $('#viewTelephone').val(item.telephone);
                    $('#viewFullname').val(item.fullname);
                    $('#viewAddress').val(item.address);
                    $('#viewGender').val(item.gender);
                    $('#viewDateofbirth').val(item.dateofbirth);
                    $('#viewAge').val(item.age);
                    $('#viewBloodGroup').val(item.bloodGroup);
                    $('#donorBloodGroupInput').val(item.bloodGroup);
                    $('#viewRegisteredDate').val(date_str);
                    $('#viewRegisteredTime').val(time_str);
                    $('#viewEmail').val(item.email);
                    $('#btnDonate').val(item.no);
                    
                    $('#viewDonorSection').removeClass('d-none');
                    $('#medicalCheckupStatusSection').removeClass('d-none');
                    $('#getDonorError').text('');
                });
            }
        });
    });

    //cancel appointment
    $(document).on('click', '#btnDonate',function(e){
        e.preventDefault();
        var donorNo = $(this).val();
        var bloodGroup = $('#donorBloodGroupInput').val();
        
        var data = {
            'donorNo' : donorNo,
            'bloodGroup' : bloodGroup
        }
        
        var url = '{{ url("admin/dashboard/donate") }}';
        
        $('#btnDonate').text('Donating...');
        
        $.ajax({
            type:"POST",
            url:url,
            data:data,
            dataType:"json",
            success:function(response){
                if(response.status==200)
                {
                    $('#errorList').html('');
                    $('#errorList').addClass('d-none');
                
                    $('#btnDonate').text('Successful');
                    $('#btnDonate').removeClass('btn-danger');
                    $('#btnDonate').addClass('btn-success');
                    
                    setTimeout(function(){
                        $('#btnDonate').text('Donate');
                        $('#medicalCheckupStatusSection').addClass('d-none');
                        $('#donationForm').addClass('d-none');
                        $('#viewDonorSection').addClass('d-none');
                    }, 3000);
                }
                else
                {
                    $('#btnDonate').text('Donate');
                    $('#btnDonate').removeClass('btn-danger');
                    $('#btnDonate').addClass('btn-success');

                    $('#errorList').html('');
                    $('#errorList').removeClass('d-none');
                    
                    $.each(response.errors,function(key,err_value){
                        $('#errorList').append('<li><strong>'+err_value+'</strong></li>'); 
                    });
                }
            }
        });
    });

});

//onchange select
function checkMedicalCheckupStatus()
{
    var medicalCheckupStatus = $('#lastMedicalCheckupStatusSelect').val();

    if(medicalCheckupStatus== 'pass')
    {
        $('#donationForm').removeClass('d-none');
    }
    else
    {
        $('#donationForm').addClass('d-none');
    }
}
</script>
@endsection
