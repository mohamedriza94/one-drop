@extends('admin.layouts.master')

@section('content')
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="header layout-top-spacing">
                <h3 class=""><b>MESSAGES</b></h3>
                <hr>
            </div>
            
            <div class="widget-content widget-content-area layout-top-spacing">
                <div class="row">
                    <div class="col-3">
                        <a id="btnOpenComposeMessageModal" class="btn btn-lg btn-primary form-control" href="#">Compose</a>
                    </div>
                    <div class="col-3">
                        <a id="viewInboxMessages" class="btn btn-lg btn-light col-4 form-control" href="#"><i class="fa-solid fa-inbox"></i> Inbox</a>
                    </div>
                    <div class="col-3">
                        <a id="viewSentMessages" class="btn btn-lg btn-light col-4 form-control" href="#"><i class="fa-solid fa-envelope-circle-check"></i> Sent</a>
                    </div>
                    <div class="col-3">
                        <a id="viewTrashMessages" class="btn btn-lg btn-light form-control" href="#"><i class="fa-solid fa-trash"></i> Trash</a>
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
                            <h5 class="modal-title add-title" id="openMessageModalTitle"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <div id="" class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label" id="sender"></label>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label" id="openDate"></label>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label" id="openSubject"></label> 
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label"><b>Message:</b></label> 
                                    <p class="" id="openMessage"></p> 
                                </div>
                                
                                <input type="hidden" id="openMessageId">
                                
                                <div class="col-md-12 d-none" id="openReplySection">
                                    <hr style="padding:1px; background:black;">
                                    <label class="form-label"><b>Reply:</b></label> 
                                    <p class="" id="openReply"></p> 
                                </div>
                                
                                
                                <input type="hidden" id="openSenderId">
                                <input type="hidden" id="openSender">
                            </div>
                        </div>
                        <hr>
                        <div class="modal-body d-none" id="replyBody">
                            <div id="" class="row g-3">
                                
                                <h5><b>Reply</b></h5>
                                <input type="hidden" id="messageIdForReply">
                                <div class="col-md-12">
                                    <label class="form-label">Type your reply here:</label>
                                    <textarea class="form-control" id="reply_message" name="reply_message" rows="8"></textarea> 
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-danger form-control" type="submit" data-bs-dismiss="modal">Discard</button>
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-primary form-control" type="submit" id="btnReply" name="btnReply">Reply</button>
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
                                        <option value="staffToDonor">Donor</option>
                                        <option value="staffToHospital">Hospital</option>
                                        <option value="staffToOther">Other</option>
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
                        
                        <div class="modal-body d-none" id="chosenStaffToDonor">
                            <div id="" class="row g-3">
                                
                                <div class="col-md-12">
                                    <label class="form-label">Choose Donor</label>
                                    <select class="form-control" id="chooseDonor">
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
                        
                        <div class="modal-body d-none" id="chosenStaffToHospital">
                            <div id="" class="row g-3">
                                
                                <input type="hidden" id="staffToHospital_hospital" value="{{ Auth::guard('admin')->user()->hospital_id }}">
                                
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
        
        //load inbox
        fetchInboxMessages();
        $('#viewInboxMessages').removeClass('btn-light');
        $('#viewInboxMessages').addClass('btn-dark');
        
        
        $('#btnOpenComposeMessageModal').click(function(){
            $('#composeMessageModal').modal('show');
            $('#chooseRecipientBody').removeClass('d-none');
            $('#chosenStaffToAdmin').addClass('d-none');
            $('#chosenStaffToDonor').addClass('d-none');
            $('#chosenStaffToHospital').addClass('d-none');
            $('#chosenOther').addClass('d-none');
            
            fetchDonorList();
            
            $('#errorList').html('');
            $('#errorModalBody').addClass('d-none');
            $('#errorList').addClass('d-none');
        });
        
        $('#chooseRecipient').change(function() {
            
            if ($(this).val() == 'staffToAdmin') {
                $('#chosenStaffToAdmin').removeClass('d-none');
                $('#chosenStaffToDonor').addClass('d-none');
                $('#chosenStaffToHospital').addClass('d-none');
                $('#chosenOther').addClass('d-none');
            }
            else if ($(this).val() == 'staffToDonor') {
                $('#chosenStaffToAdmin').addClass('d-none');
                $('#chosenStaffToDonor').removeClass('d-none');
                $('#chosenStaffToHospital').addClass('d-none');
                $('#chosenOther').addClass('d-none');
            }
            else if ($(this).val() == 'staffToHospital') {
                $('#chosenStaffToAdmin').addClass('d-none');
                $('#chosenStaffToDonor').addClass('d-none');
                $('#chosenStaffToHospital').removeClass('d-none');
                $('#chosenOther').addClass('d-none');
            }
            else if ($(this).val() == 'staffToOther') {
                $('#chosenStaffToAdmin').addClass('d-none');
                $('#chosenStaffToDonor').addClass('d-none');
                $('#chosenStaffToHospital').addClass('d-none');
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
            
            fetchTrashMessages();
        });
        
        $('#viewInboxMessages').click(function(){
            $('#viewSentMessages').removeClass('btn-dark');
            $('#viewSentMessages').addClass('btn-light');
            $('#viewInboxMessages').removeClass('btn-light');
            $('#viewInboxMessages').addClass('btn-dark');
            $('#viewTrashMessages').removeClass('btn-dark');
            $('#viewTrashMessages').addClass('btn-light');
            
            fetchInboxMessages();
        });
        
        $(document).on('click', '#staffToAdmin_btnCompose',function(e){
            e.preventDefault();
            
            $('#staffToAdmin_btnCompose').text('Sending...');
            
            var sender = $('#chooseRecipient').val();
            var senderId = $('#senderId').val();
            var recipientId = '-';
            var subject = $('#staffToAdmin_subject').val();
            var message = $('#staffToAdmin_message').val();
            
            var data = {
                'sender' : sender,
                'senderId' : senderId,
                'recipientId' : recipientId,
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
                            $('#composeMessageModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#staffToHospital_btnCompose',function(e){
            e.preventDefault();
            
            $('#staffToHospital_btnCompose').text('Sending...');
            
            var sender = $('#chooseRecipient').val();
            var senderId = $('#senderId').val();
            var recipientId = $('#staffToHospital_hospital').val();
            var subject = $('#staffToHospital_subject').val();
            var message = $('#staffToHospital_message').val();
            
            var data = {
                'sender' : sender,
                'senderId' : senderId,
                'recipientId' : recipientId,
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
                        $('#staffToHospital_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>Sender ID is not valid</li>');
                        });
                    }
                    else if(response.status==301) //Hospital ID missing
                    {
                        $('#staffToHospital_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>Hospital ID is not valid</li>');
                        });
                    }
                    else if(response.status==400)
                    {
                        $('#staffToHospital_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else if(response.status==200)
                    {
                        $('#staffToHospital_btnCompose').text('Sent!');
                        $('#staffToHospital_btnCompose').removeClass('btn-primary');
                        $('#staffToHospital_btnCompose').addClass('btn-success');
                        
                        
                        $('#errorList').html('');
                        $('#errorModalBody').addClass('d-none');
                        $('#errorList').addClass('d-none');
                        
                        setTimeout(function(){
                            $('#staffToHospital_btnCompose').removeClass('btn-success');
                            $('#staffToHospital_btnCompose').addClass('btn-primary');
                            $('#staffToHospital_btnCompose').text('Compose');
                            $('#composeMessageModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#staffToDonor_btnCompose',function(e){
            e.preventDefault();
            
            $('#staffToDonor_btnCompose').text('Sending...');
            
            var sender = $('#chooseRecipient').val();
            var senderId = $('#senderId').val();
            var recipientId = $('#chooseDonor').val();
            var subject = $('#staffToDonor_subject').val();
            var message = $('#staffToDonor_message').val();
            
            var data = {
                'sender' : sender,
                'senderId' : senderId,
                'recipientId' : recipientId,
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
                        $('#staffToDonor_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>Sender ID is not valid</li>');
                        });
                    }
                    else if(response.status==301) //Donor ID missing
                    {
                        $('#staffToDonor_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>Donor ID is not valid</li>');
                        });
                    }
                    else if(response.status==400)
                    {
                        $('#staffToDonor_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else if(response.status==200)
                    {
                        $('#staffToDonor_btnCompose').text('Sent!');
                        $('#staffToDonor_btnCompose').removeClass('btn-primary');
                        $('#staffToDonor_btnCompose').addClass('btn-success');
                        
                        
                        $('#errorList').html('');
                        $('#errorModalBody').addClass('d-none');
                        $('#errorList').addClass('d-none');
                        
                        setTimeout(function(){
                            $('#staffToDonor_btnCompose').removeClass('btn-success');
                            $('#staffToDonor_btnCompose').addClass('btn-primary');
                            $('#staffToDonor_btnCompose').text('Compose');
                            $('#composeMessageModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#other_btnCompose',function(e){
            e.preventDefault();
            
            $('#other_btnCompose').text('Sending...');
            
            var sender = $('#chooseRecipient').val();
            var senderId = $('#senderId').val();
            var recipientId = $('#other_email').val();
            var subject = $('#other_subject').val();
            var message = $('#other_message').val();
            
            var data = {
                'sender' : sender,
                'senderId' : senderId,
                'recipientId' : recipientId,
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
                        $('#other_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>Admin ID is not valid</li>');
                        });
                    }
                    else if(response.status==301) //Email invalid
                    {
                        $('#other_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>Email is not valid</li>');
                        });
                    }
                    else if(response.status==400)
                    {
                        $('#other_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else if(response.status==200)
                    {
                        $('#other_btnCompose').text('Sent!');
                        $('#other_btnCompose').removeClass('btn-primary');
                        $('#other_btnCompose').addClass('btn-success');
                        
                        
                        $('#errorList').html('');
                        $('#errorModalBody').addClass('d-none');
                        $('#errorList').addClass('d-none');
                        
                        setTimeout(function(){
                            $('#other_btnCompose').removeClass('btn-success');
                            $('#other_btnCompose').addClass('btn-primary');
                            $('#other_btnCompose').text('Compose');
                            $('#composeMessageModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        function fetchInboxMessages()
        {
            var authId = $('#senderId').val();
            
            var url = '{{ url("admin/dashboard/fetchInboxMessages/:authId") }}';
            url = url.replace(':authId', authId);
            
            $.ajax({
                type:"GET",
                url:url,
                success:function(response){
                    $('tbody').html('');
                    $.each(response.messages,function(key,item){
                        
                        if(item.sender=="adminToStaff"){
                            $party = 'Administrator';
                        }
                        else if(item.sender=="hospitalToStaff"){
                            $party = 'Hospital';
                        }
                        else if(item.sender=="donorToStaff"){
                            $party = 'Donor';
                        }
                        else if(item.sender=="otherToStaff"){
                            $party = item.sender_id;
                        }
                        
                        var messageSubject_str = item.subject;
                        var messageSubject_str = messageSubject_str.slice(0, 35)+'...'; 
                        
                        var messageDescription_str = item.message;
                        var messageDescription_str = messageDescription_str.slice(0, 20)+'...'; 
                        
                        var messageDate_str = item.date;
                        var messageDate_str = messageDate_str.slice(0, 10); 
                        
                        if(item.reply_status=="1" || item.reply_status=="2")
                        {
                            $toggleElement = '<label class="badge badge-success">Replied</label>';
                        }
                        else if(item.reply_status=="0")
                        {
                            $toggleElement = '<button class="btn btn-dark btn-sm" value="'+item.id+'" id="btnOpenInboxMessage">Open</button>';
                        }
                        
                        $deleteButton = '<button class="btn btn-danger btn-sm" value="'+item.id+'" id="btnInboxMoveToTrash">Move to Trash</button>';
                        
                        $('tbody').append('<tr>\
                            <td>From <b>'+$party+'</b></td>\
                            <td>'+messageSubject_str+'</td>\
                            <td>'+messageDescription_str+'</td>\
                            <td>'+messageDate_str+'</td>\
                            <td>\
                                '+$toggleElement+'\
                                '+$deleteButton+'\
                            </td>\
                        </tr>\
                        ');
                    });
                }
            });
        }

        $(document).on('click', '#btnInboxMoveToTrash',function(e){
            e.preventDefault();
            var id = $(this).val();
            
            var url = '{{ url("admin/dashboard/moveToTrash/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"PUT",
                url:url,
                dataType:"json",
                success:function(response){
                    fetchInboxMessages();
                }
            });
        });
        
        function fetchSentMessages()
        {
            var authId = $('#senderId').val();
            
            var url = '{{ url("admin/dashboard/fetchSentMessages/:authId") }}';
            url = url.replace(':authId', authId);
            
            $.ajax({
                type:"GET",
                url:url,
                success:function(response){
                    $('tbody').html('');
                    $.each(response.messages,function(key,item){
                        
                        if(item.sender=="staffToAdmin"){
                            $party = 'Administrator';
                        }
                        else if(item.sender=="staffToHospital"){
                            $party = 'Hospital';
                        }
                        else if(item.sender=="staffToDonor"){
                            $party = 'Donor';
                        }
                        else if(item.sender=="staffToOther"){
                            $party = 'Guest';
                        }
                        
                        var messageSubject_str = item.subject;
                        var messageSubject_str = messageSubject_str.slice(0, 35)+'...'; 
                        
                        var messageDescription_str = item.message;
                        var messageDescription_str = messageDescription_str.slice(0, 20)+'...'; 
                        
                        var messageDate_str = item.date;
                        var messageDate_str = messageDate_str.slice(0, 10); 
                        
                        if(item.reply_status=="1")
                        {
                            $replyButton = '<button class="btn btn-success btn-sm" value="'+item.id+'" id="btnOpenReply">See Reply</button>';
                            $deleteButton = '<button class="btn btn-danger btn-sm" value="'+item.id+'" id="btnSentMoveToTrash">Move to Trash</button>';
                        }
                        else if(item.reply_status=="2")
                        {
                            $replyButton = '<button class="btn btn-light btn-sm" value="'+item.id+'" id="btnOpenReply">Opened</button>';
                            $deleteButton = '<button class="btn btn-danger btn-sm" value="'+item.id+'" id="btnSentMoveToTrash">Move to Trash</button>';
                        }
                        else if(item.reply_status=="0")
                        {
                            $replyButton = '';
                            $deleteButton = '<button class="btn btn-danger btn-sm" value="'+item.id+'" id="btnSentMoveToTrash">Move to Trash</button>';
                        }
                        
                        $openButton = '<button class="btn btn-dark btn-sm" value="'+item.id+'" id="btnOpenSentOrTrashMessageModal">Open</button>';
                        
                        $('tbody').append('<tr>\
                            <td>To <b>'+$party+'</b></td>\
                            <td>'+messageSubject_str+'</td>\
                            <td>'+messageDescription_str+'</td>\
                            <td>'+messageDate_str+'</td>\
                            <td>\
                                '+$openButton+'\
                                '+$deleteButton+'\
                                '+$replyButton+'\
                            </td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        $(document).on('click', '#btnSentMoveToTrash',function(e){
            e.preventDefault();
            var id = $(this).val();
            
            var url = '{{ url("admin/dashboard/moveToTrash/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"PUT",
                url:url,
                dataType:"json",
                success:function(response){
                    fetchSentMessages();
                }
            });
        });
        
        function fetchTrashMessages()
        {
            var authId = $('#senderId').val();
            
            var url = '{{ url("admin/dashboard/fetchTrashMessages/:authId") }}';
            url = url.replace(':authId', authId);
            
            $.ajax({
                type:"GET",
                url:url,
                success:function(response){
                    $('tbody').html('');
                    $.each(response.messages,function(key,item){
                        
                        //received messages
                        if(item.sender=="adminToStaff"){
                            $party = 'From <b>Administrator</b>';
                            $messageType = '<label class="badge badge-success">Received</label>';
                        }
                        else if(item.sender=="hospitalToStaff"){
                            $party = 'From <b>Hospital</b>';
                            $messageType = '<label class="badge badge-success">Received</label>';
                        }
                        else if(item.sender=="donorToStaff"){
                            $party = 'From <b>Donor</b>';
                            $messageType = '<label class="badge badge-success">Received</label>';
                        }
                        else if(item.sender=="otherToStaff"){
                            $party = 'From <b>Guest</b>';
                            $messageType = '<label class="badge badge-success">Received</label>';
                        }
                        //sent messages
                        else if(item.sender=="staffToAdmin"){
                            $party = 'To <b>Administrator</b>';
                            $messageType = '<label class="badge badge-primary">Sent</label>';
                        }
                        else if(item.sender=="staffToHospital"){
                            $party = 'To <b>Hospital</b>';
                            $messageType = '<label class="badge badge-primary">Sent</label>';
                        }
                        else if(item.sender=="staffToDonor"){
                            $party = 'To <b>Donor</b>';
                            $messageType = '<label class="badge badge-primary">Sent</label>';
                        }
                        else if(item.sender=="staffToOther"){
                            $party = 'To <b>Guest</b>';
                            $messageType = '<label class="badge badge-primary">Sent</label>';
                        }
                        
                        var messageSubject_str = item.subject;
                        var messageSubject_str = messageSubject_str.slice(0, 35)+'...'; 
                        
                        var messageDescription_str = item.message;
                        var messageDescription_str = messageDescription_str.slice(0, 20)+'...'; 
                        
                        var messageDate_str = item.date;
                        var messageDate_str = messageDate_str.slice(0, 10); 
                        
                        $openButton = '<button class="btn btn-danger btn-sm" value="'+item.id+'" id="btnOpenSentOrTrashMessageModal">Open</button>';
                        
                        $('tbody').append('<tr>\
                            <td>'+$party+'</td>\
                            <td>'+messageSubject_str+'</td>\
                            <td>'+messageDescription_str+'</td>\
                            <td>'+messageDate_str+'</td>\
                            <td>'+$messageType+'</td>\
                            <td>\
                                '+$openButton+'\
                            </td>\
                        </tr>\
                        ');
                    });
                }
            });
        }
        
        function fetchDonorList()
        {
            var url = '{{ url("admin/dashboard/fetchDonorList") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                success:function(response){
                    $('#chooseDonor').html('');
                    $.each(response.donor,function(key,item){
                        $('#chooseDonor').append('<option value="'+item.id+'">'+item.fullname+'</option>');
                    });
                }
            });
        }
        
        $(document).on('click', '#btnOpenSentOrTrashMessageModal',function(e){
            e.preventDefault();
            
            var id = $(this).val();
            
            var url = '{{ url("admin/dashboard/fetchSingleMessage/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET",
                url:url,
                success:function(response){
                    if(response.status==404){
                        alert('Message Not Found');
                    }
                    else
                    {
                        $('#openMessageModal').modal('show');
                        $('#openMessageModalTitle').text('Message No. '+response.messages.message_no);
                        $('#openSender').val(response.messages.sender);
                        
                        var openDate_str = response.messages.date;
                        var openDate_str = openDate_str.slice(0, 11); 
                        
                        var openTime_str = response.messages.time;
                        var openTime_str = openTime_str.slice(11, 20);
                        
                        $('#openDate').html('<b>Date:</b> '+openDate_str+'&nbsp;&nbsp;&nbsp;<b>Time:</b> '+openTime_str);
                        $('#openSubject').html('<b>Subject:</b> '+response.messages.subject);
                        $('#openMessage').text(response.messages.message);
                        
                        var getSenderType = $('#openSender').val();
                        
                        if(getSenderType == "staffToOther")
                        {
                            $('#sender').html('<b>Sent To:</b> '+response.messages.recipient_id+' (Guest)');
                        }
                        else if(getSenderType.includes("staffTo"))
                        {
                            $('#openSenderId').val(response.messages.recipient_id);
                        }
                        else if(getSenderType.includes("ToStaff"))
                        {
                            $('#openSenderId').val(response.messages.sender_id);
                        }
                        
                        var openedSenderId = $('#openSenderId').val();
                        var openSender = $('#openSender').val();
                        
                        var urlGetSender = '{{ url("admin/dashboard/fetchSender/:senderId/:sender") }}';
                        urlGetSender = urlGetSender.replace(':senderId', openedSenderId);
                        urlGetSender = urlGetSender.replace(':sender', openSender);
                        
                        $.ajax({
                            type:"GET",
                            url:urlGetSender,
                            success: function (response){
                                if(response.status==404){
                                    alert('Data Not Found');
                                }
                                else
                                {
                                    var getSenderType = $('#openSender').val();
                                    
                                    if(getSenderType == "staffToAdmin")
                                    {
                                        $('#sender').html('<b>Sent To:</b> Administrator');
                                    }
                                    else if(getSenderType == "staffToHospital")
                                    {
                                        $('#sender').html('<b>Sent To:</b> '+response.hospitals.name+' (Hospital)');
                                    }
                                    else if(getSenderType == "staffToDonor")
                                    {
                                        $('#sender').html('<b>Sent To:</b> '+response.donor.fullname+' (Donor)');
                                    }
                                    else if(getSenderType == "adminToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> Administrator');
                                    }
                                    else if(getSenderType == "hospitalToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> '+response.hospitals.name+' (Hospital)');
                                    }
                                    else if(getSenderType == "donorToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> '+response.donor.fullname+' (Donor)');
                                    }
                                    
                                }
                            }
                        });
                        
                        $('#openMessageModal').modal('show');
                        $('#replyBody').addClass('d-none');
                        $('#openReplySection').addClass('d-none');
                    }
                }
                
                
            });
        });
        
        $(document).on('click', '#btnOpenInboxMessage',function(e){
            e.preventDefault();
            
            var id = $(this).val();
            
            $('#messageIdForReply').val(id);
            
            var url = '{{ url("admin/dashboard/fetchSingleMessage/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET",
                url:url,
                success:function(response){
                    if(response.status==404){
                        alert('Message Not Found');
                    }
                    else
                    {
                        $('#openMessageModal').modal('show');
                        $('#openMessageModalTitle').text('Message No. '+response.messages.message_no);
                        $('#openSender').val(response.messages.sender);
                        
                        var openDate_str = response.messages.date;
                        var openDate_str = openDate_str.slice(0, 11); 
                        
                        var openTime_str = response.messages.time;
                        var openTime_str = openTime_str.slice(11, 20);
                        
                        $('#openDate').html('<b>Date:</b> '+openDate_str+'&nbsp;&nbsp;&nbsp;<b>Time:</b> '+openTime_str);
                        $('#openSubject').html('<b>Subject:</b> '+response.messages.subject);
                        $('#openMessage').text(response.messages.message);
                        
                        var getSenderType = $('#openSender').val();
                        
                        if(getSenderType == "adminToStaff" || getSenderType == "adminToHospital")
                        {
                            $('#openSenderId').val(response.messages.recipient_id);
                        }
                        else if(getSenderType == "staffToAdmin" || getSenderType == "hospitalToAdmin")
                        {
                            $('#openSenderId').val(response.messages.sender_id);
                        }
                        else if(getSenderType == "adminToOther")
                        {
                            $('#sender').html('<b>Sent To:</b> '+response.messages.recipient_id+' (Guest)');
                        }
                        else if(getSenderType == "staffToDonor")
                        {
                            $('#openSenderId').val(response.messages.recipient_id);
                        }
                        else if(getSenderType == "donorToStaff")
                        {
                            $('#openSenderId').val(response.messages.sender_id);
                        }
                        
                        var openedSenderId = $('#openSenderId').val();
                        var openSender = $('#openSender').val();
                        
                        var urlGetSender = '{{ url("admin/dashboard/fetchSender/:senderId/:sender") }}';
                        urlGetSender = urlGetSender.replace(':senderId', openedSenderId);
                        urlGetSender = urlGetSender.replace(':sender', openSender);
                        
                        $.ajax({
                            type:"GET",
                            url:urlGetSender,
                            success: function (response){
                                if(response.status==404){
                                    alert('Sender Not Found');
                                }
                                else
                                {
                                    var getSenderType = $('#openSender').val();
                                    
                                    if(getSenderType == "adminToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> Administrator (Staff)');
                                    }
                                    else if(getSenderType == "hospitalToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> '+response.hospitals.name+' (Hospital)');
                                    }
                                    else if(getSenderType == "donorToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> '+response.donor.fullname+' (Donor)');
                                    }
                                    else if(getSenderType == "otherToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> '+response.hospitals.name+' (Guest)');
                                    }
                                    
                                }
                            }
                        });
                        
                        $('#openMessageModal').modal('show');
                        $('#replyBody').removeClass('d-none');
                        $('#openReplySection').addClass('d-none');
                    }
                }
                
                
            });
        });
        
        $(document).on('click', '#btnReply',function(e){
            e.preventDefault();
            
            $('#btnReply').text('Sending...');
            
            var reply = $('#reply_message').val();
            var message_no = $('#messageIdForReply').val();
            
            var data = {
                'reply' : reply,
                'message_no' : message_no
            }
            
            var url = '{{ url("admin/dashboard/replyToMessage") }}';
            
            $.ajax({
                type:"POST",
                url:url,
                data:data,
                dataType:"json",
                success:function(response)
                {
                    if(response.status==400)
                    {
                        $('#btnReply').text('Reply');
                        
                        $('#replyMessageErrorList').html('');
                        $('#replyMessageErrorModalBody').removeClass('d-none');
                        $('#replyMessageErrorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#replyMessageErrorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else if(response.status==300) //Message invalid
                    {
                        $('#btnReply').text('Reply');
                        
                        $('#replyMessageErrorList').html('');
                        $('#replyMessageErrorModalBody').removeClass('d-none');
                        $('#replyMessageErrorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>Message is not valid</li>');
                        });
                    }
                    else if(response.status==200)
                    {
                        $('#btnReply').text('Replied!');
                        $('#btnReply').removeClass('btn-primary');
                        $('#btnReply').addClass('btn-success');
                        
                        $('#replyMessageErrorList').html('');
                        $('#replyMessageErrorModalBody').addClass('d-none');
                        $('#replyMessageErrorList').addClass('d-none');
                        
                        setTimeout(function(){
                            $('#reply_message').val('');
                            $('#messageIdForReply').val('');
                            $('#btnReply').removeClass('btn-success');
                            $('#btnReply').addClass('btn-primary');
                            $('#btnReply').text('Reply');
                            $('#openMessageModal').modal('hide');
                            fetchInboxMessages();
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#btnOpenReply',function(e){
            e.preventDefault();
            
            var id = $(this).val();
            
            var url = '{{ url("admin/dashboard/fetchSingleMessage/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET",
                url:url,
                success:function(response){
                    if(response.status==404){
                        alert('Message Not Found');
                    }
                    else
                    {
                        $('#openMessageModal').modal('show');
                        $('#openMessageModalTitle').text('Message No. '+response.messages.message_no);
                        $('#openSender').val(response.messages.sender);
                        
                        var openDate_str = response.messages.date;
                        var openDate_str = openDate_str.slice(0, 11); 
                        
                        var openTime_str = response.messages.time;
                        var openTime_str = openTime_str.slice(11, 20);
                        
                        $('#openDate').html('<b>Date:</b> '+openDate_str+'&nbsp;&nbsp;&nbsp;<b>Time:</b> '+openTime_str);
                        $('#openSubject').html('<b>Subject:</b> '+response.messages.subject);
                        $('#openMessage').text(response.messages.message);
                        
                        //for reply
                        $('#openMessageId').val(response.messages.id);
                        $('#openReplySection').removeClass('d-none');
                        $('#replyBody').addClass('d-none');
                        
                        var getSenderType = $('#openSender').val();
                        
                        if(getSenderType == "staffToOther")
                        {
                            $('#sender').html('<b>Sent To:</b> '+response.messages.recipient_id+' (Guest)');
                        }
                        else if(getSenderType.includes("staffTo"))
                        {
                            $('#openSenderId').val(response.messages.recipient_id);
                        }
                        else if(getSenderType.includes("ToStaff"))
                        {
                            $('#openSenderId').val(response.messages.sender_id);
                        }
                        
                        var openedSenderId = $('#openSenderId').val();
                        var openSender = $('#openSender').val();
                        
                        var urlGetSender = '{{ url("admin/dashboard/fetchSender/:senderId/:sender") }}';
                        urlGetSender = urlGetSender.replace(':senderId', openedSenderId);
                        urlGetSender = urlGetSender.replace(':sender', openSender);
                        
                        $.ajax({
                            type:"GET",
                            url:urlGetSender,
                            success: function (response){
                                if(response.status==404){
                                    alert('Data Not Found');
                                }
                                else
                                {
                                    var getSenderType = $('#openSender').val();
                                    
                                    if(getSenderType == "staffToAdmin")
                                    {
                                        $('#sender').html('<b>Sent To:</b> Administrator');
                                    }
                                    else if(getSenderType == "staffToHospital")
                                    {
                                        $('#sender').html('<b>Sent To:</b> '+response.hospitals.name+' (Hospital)');
                                    }
                                    else if(getSenderType == "staffToDonor")
                                    {
                                        $('#sender').html('<b>Sent To:</b> '+response.donor.fullname+'(Donor)');
                                    }
                                    else if(getSenderType == "adminToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> Administrator');
                                    }
                                    else if(getSenderType == "hospitalToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> '+response.hospitals.name+' (Hospital)');
                                    }
                                    else if(getSenderType == "donorToStaff")
                                    {
                                        $('#sender').html('<b>Received from:</b> '+response.donor.fullname+' (Donor)');
                                    }
                                    
                                }
                            }
                        });
                        
                        var fetchedMessageId = $('#openMessageId').val();
                        
                        var urlGetReply = '{{ url("admin/dashboard/fetchReply/:messageId") }}';
                        urlGetReply = urlGetReply.replace(':messageId', fetchedMessageId);
                        
                        $.ajax({
                            type:"GET",
                            url:urlGetReply,
                            success: function (response){
                                $.each(response.replies,function(key,item){
                                    
                                    $('#openReply').text(item.reply);
                                    
                                });
                            }   
                        });
                        
                        $('#openMessageModal').modal('show');
                    }
                }
                
                
            });
        });
        
        $(document).on('click', '#btnOpenReply',function(e){
            e.preventDefault();
            var id = $(this).val();
            
            var url = '{{ url("admin/dashboard/viewedReplyUpdateStatus/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"PUT",
                url:url,
                dataType:"json",
                success:function(response){
                    fetchSentMessages();
                }
            });
        });
    });
</script>
@endsection
