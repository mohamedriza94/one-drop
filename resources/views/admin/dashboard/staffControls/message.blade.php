@extends('admin.layouts.master')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="header layout-top-spacing">
                <h3 class=""><b>MESSAGES</b></h3>
                <hr>
            </div>
            
            <div class="widget-content widget-content-area">
                <div class="row">
                    <div class="col-lg-12 col-12 ">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="Search Message" id="searchBar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="widget-content widget-content-area layout-top-spacing">
                <div class="row">
                    <div class="col-3">
                        <a id="btnOpenComposeMessageModal" class="btn btn-lg btn-primary form-control" href="#">Compose</a>
                    </div>
                    <div class="col-3">
                        <a id="viewInboxMessages" class="btn btn-lg btn-light col-4 form-control" href="#">Inbox</a>
                    </div>
                    <div class="col-3">
                        <a id="viewSentMessages" class="btn btn-lg btn-light col-4 form-control" href="#">Sent</a>
                    </div>
                    <div class="col-3">
                        <a id="viewTrashMessages" class="btn btn-lg btn-light form-control" href="#">Trash</a>
                    </div>
                </div>
            </div>

            <div class="row layout-top-spacing">
                <div id="tableSimple" class="col-lg-12 col-12">
                    <div class="">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" value="{{ Auth::guard('admin')->user()->id }}" id="senderId">

            <!-- Open Message Modal -->
            <div class="modal fade" id="openMessageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title add-title" id="openMessageModalTitle">View</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div id="" class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label"><b>Sender:</b></label>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label"><b>Date:</b>&nbsp;&nbsp;&nbsp;<b>Time:</b></label>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label"><b>Subject:</b></label> 
                                </div>

                                <div class="col-md-12">
                                    <p class=""></p> 
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div> 

            <!-- Compose Message Modal -->
            <div class="modal fade" id="composeMessageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title add-title" id="composeMessageModalTitle">Compose</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>

                        <div class="modal-body d-none" id="errorModalBody">
                            <ul class="bg-warning form-control px-5 d-none" id="errorList">

                            </ul>
                        </div>

                        <div class="modal-body d-none" id="chooseRecipientBody">
                            <div id="" class="row g-3">
                                <div class="col-md-12">
                                      <label class="form-label">To whom are you composing (choose)</label>
                                      <select class="form-control" id="chooseRecipient">
                                        <option value="0">Choose</option>
                                        <option value="staffToAdmin">Admin</option>
                                        <option value="staffToHospital">Hospital</option>
                                        <option value="staffToDonor">Donor</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body d-none" id="chosenStaffToAdmin">
                            <div id="" class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Subject</label>
                                    <input class="form-control" type="text" id="staffToAdmin_subject" name="staffToAdmin_subject">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" id="staffToAdmin_message" name="staffToAdmin_message" rows="8"></textarea> 
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-danger form-control" type="submit" data-bs-dismiss="modal" id="staffToAdmin_btnClose" name="staffToAdmin_btnClose">Discard</button>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-primary form-control" type="submit" id="staffToAdmin_btnCompose" name="staffToAdmin_btnCompose">Compose</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body d-none" id="chosenStaffToHospital">
                            <div id="" class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Subject</label>
                                    <input class="form-control" type="text" id="staffToHospital_subject" name="staffToHospital_subject">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" id="staffToHospital_message" name="staffToHospital_message" rows="8"></textarea> 
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-danger form-control" type="submit" data-bs-dismiss="modal" id="staffToHospital_btnClose" name="staffToHospital_btnClose">Discard</button>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-primary form-control" type="submit" id="staffToHospital_btnCompose" name="staffToHospital_btnCompose">Compose</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body d-none" id="chosenStaffToDonor">
                            <div id="" class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Choose Donor</label>
                                    <select class="form-control" id="chooseDonor">
                                        <option value="">Donor One</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Subject</label>
                                    <input class="form-control" type="text" id="staffToDonor_subject" name="staffToDonor_subject">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" id="staffToDonor_message" name="staffToDonor_message" rows="8"></textarea> 
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-danger form-control" type="submit" data-bs-dismiss="modal" id="staffToDonor_btnClose" name="staffToDonor_btnClose">Discard</button>
                                </div>

                                <div class="col-md-6">
                                    <button class="btn btn-primary form-control" type="submit" id="staffToDonor_btnCompose" name="staffToDonor_btnCompose">Compose</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body d-none" id="chosenOther">
                          <div id="" class="row g-3">

                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" id="other_email" name="other_subject">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Subject</label>
                                <input class="form-control" type="text" id="other_subject" name="other_subject">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" id="other_message" name="other_message" rows="8"></textarea> 
                            </div>

                            <div class="col-md-6">
                                <button class="btn btn-danger form-control" type="submit" data-bs-dismiss="modal" id="other_btnClose" name="other_btnClose">Discard</button>
                            </div>

                            <div class="col-md-6">
                                <button class="btn btn-primary form-control" type="submit" id="other_btnCompose" name="   other_btnCompose">Compose</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

      </div>

  </div>
</div> </div> </div> 
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

$('#btnOpenComposeMessageModal').click(function(){
    $('#composeMessageModal').modal('show');
    $('#chooseRecipientBody').removeClass('d-none');
    $('#chosenStaffToAdmin').addClass('d-none');
    $('#chosenStaffToHospital').addClass('d-none');
    $('#chosenStaffToDonor').addClass('d-none');
    $('#chosenOther').addClass('d-none');

    $('#errorList').html('');
    $('#errorModalBody').addClass('d-none');
    $('#errorList').addClass('d-none');
});

$('#chooseRecipient').change(function() {

    if ($(this).val() == 'staffToAdmin') {
        $('#chosenStaffToAdmin').removeClass('d-none');
        $('#chosenStaffToHospital').addClass('d-none');
        $('#chosenStaffToDonor').addClass('d-none');
        $('#chosenOther').addClass('d-none');
    }
    else if ($(this).val() == 'staffToHospital') {
        $('#chosenStaffToAdmin').addClass('d-none');
        $('#chosenStaffToHospital').removeClass('d-none');
        $('#chosenStaffToDonor').addClass('d-none');
        $('#chosenOther').addClass('d-none');
    }
    else if ($(this).val() == 'staffToDonor') {
        $('#chosenStaffToAdmin').addClass('d-none');
        $('#chosenStaffToHospital').addClass('d-none');
        $('#chosenStaffToDonor').removeClass('d-none');
        $('#chosenOther').addClass('d-none');
    }
    else if ($(this).val() == 'other') {
        $('#chosenStaffToAdmin').addClass('d-none');
        $('#chosenStaffToHospital').addClass('d-none');
        $('#chosenStaffToDonor').addClass('d-none');
        $('#chosenOther').removeClass('d-none');
    }
});

$('#viewSentMessages').click(function(){
    $('#viewSentMessages').removeClass('btn-light');
    $('#viewSentMessages').addClass('btn-dark');
    $('#viewInboxMessages').removeClass('btn-dark');
    $('#viewInboxMessages').addClass('btn-light');
    $('#viewTrashMessages').removeClass('btn-dark');
    $('#viewTrashMessages').addClass('btn-light');

    fetchSentMessages();
});

$('#viewTrashMessages').click(function(){
    $('#viewSentMessages').removeClass('btn-dark');
    $('#viewSentMessages').addClass('btn-light');
    $('#viewInboxMessages').removeClass('btn-dark');
    $('#viewInboxMessages').addClass('btn-light');
    $('#viewTrashMessages').removeClass('btn-light');
    $('#viewTrashMessages').addClass('btn-dark');
});

$('#viewInboxMessages').click(function(){
    $('#viewSentMessages').removeClass('btn-dark');
    $('#viewSentMessages').addClass('btn-light');
    $('#viewInboxMessages').removeClass('btn-light');
    $('#viewInboxMessages').addClass('btn-dark');
    $('#viewTrashMessages').removeClass('btn-dark');
    $('#viewTrashMessages').addClass('btn-light');
});

function fetchSentMessages()
{
    var id = $('#senderId').val();

    var url = '{{ url("admin/dashboard/fetchSentMessages/:id") }}';
    url = url.replace(':id', id);

    $.ajax({
        type:"GET",
        url:url,
        success:function(response){
            $('tbody').html('');
            $.each(response.messages,function(key,item){

                if(item.sender=="staffToAdmin"){
                    $sentTo = 'Administrator';
                }else{
                    $sentTo = 'Administrator';
                }

                var messageSubject_str = item.subject;
                var messageSubject_str = messageSubject_str.slice(0, 35)+'...'; 

                var messageDescription_str = item.message;
                var messageDescription_str = messageDescription_str.slice(0, 20)+'...'; 

                var messageDate_str = item.date;
                var messageDate_str = messageDate_str.slice(0, 10); 

                $('tbody').append('<tr>\
                    <td>To <b>'+$sentTo+'</b></td>\
                    <td>'+messageSubject_str+'</td>\
                    <td>'+messageDescription_str+'</td>\
                    <td>'+messageDate_str+'</td>\
                    <td>\
                    <button class="btn btn-dark btn-sm" value="'+item.id+'" id="btnOpenMessageModal">Open</button>\
                    </td>\
                    </tr>\
                    ');
            });
        }
    });
}

//send message - staff to admin / staff to hospital
$(document).on('click', '#staffToAdmin_btnCompose',function(e){
    e.preventDefault();

    $('#staffToAdmin_btnCompose').text('Sending...');

    var sender = $('#chooseRecipient').val();
    var senderId = $('#senderId').val();
    var subject = $('#staffToAdmin_subject').val();
    var message = $('#staffToAdmin_message').val();
    var data = {
        'sender' : sender,
        'senderId' : senderId,
        'subject' : subject,
        'message' : message,
    }

    var url = '{{ url("admin/dashboard/sendMessage") }}';

    $.ajax({
        type:"POST",
        url:url,
        data:data,
        dataType:"json",
        success:function(response){
                if(response.status==404) //sender ID missing
                {
                    $('#staffToAdmin_btnCompose').text('Compose');

                    $('#errorList').html('');
                    $('#errorModalBody').removeClass('d-none');
                    $('#errorList').removeClass('d-none');

                    $.each(response.errors,function(key,err_value){
                        $('#errorList').append('<li>Staff ID is not valid</li>');
                    });
                }
                else if(response.status==400)
                {
                    $('#staffToAdmin_btnCompose').text('Compose');

                    $('#errorList').html('');
                    $('#errorModalBody').removeClass('d-none');
                    $('#errorList').removeClass('d-none');

                    $.each(response.errors,function(key,err_value){
                        $('#errorList').append('<li>'+err_value+'</li>');
                    });
                }
                else if(response.status==200)
                {
                    $('#staffToAdmin_btnCompose').text('Sent!');
                    $('#staffToAdmin_btnCompose').removeClass('btn-primary');
                    $('#staffToAdmin_btnCompose').addClass('btn-success');

                    
                    $('#errorList').html('');
                    $('#errorModalBody').addClass('d-none');
                    $('#errorList').addClass('d-none');

                    setTimeout(function(){
                        $('#staffToAdmin_btnCompose').removeClass('btn-success');
                        $('#staffToAdmin_btnCompose').addClass('btn-primary');
                        $('#staffToAdmin_btnCompose').text('Compose');
                        $('#composeMailModal').modal('hide');
                    }, 2000);
                }
            }
        });
});

$('#btnOpenMessageModal').click(function(){
    alert('dsadsa');
});


});
</script>
@endsection
