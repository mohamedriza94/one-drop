@extends('hospital.layouts.master')

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
            
            <input type="hidden" value="{{ Auth::guard('hospital')->user()->no  }}" id="senderId">
            
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
                                
                                {{-- to get reply --}}
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
                        
                        <div class="modal-body" id="chooseRecipientBody">
                            <div id="" class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Composing To (choose)</label>
                                    <select class="form-control" id="chooseRecipient">
                                        <option value="0">Choose</option>
                                        <option value="hospitalToAdmin">Admin</option>
                                        <option value="hospitalToStaff">Staff</option>
                                        <option value="hospitalToDonor">Donor</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-body d-none" id="chosenHospitalToAdmin">
                            <div id="" class="row g-3">
                                
                                <div class="col-md-12">
                                    <label class="form-label">Subject</label>
                                    <input class="form-control" type="text" id="hospitalToAdmin_subject" name="hospitalToAdmin_subject">
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" id="hospitalToAdmin_message" name="hospitalToAdmin_message" rows="8"></textarea> 
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-danger form-control" type="submit" data-bs-dismiss="modal" id="hospitalToAdmin_btnClose" name="hospitalToAdmin_btnClose">Discard</button>
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-primary form-control" type="submit" id="hospitalToAdmin_btnCompose" name="hospitalToAdmin_btnCompose">Compose</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-body d-none" id="chosenHospitalToStaff">
                            <div id="" class="row g-3">
                                
                                <div class="col-md-12">
                                    <label class="form-label">Choose Staff</label>
                                    <select class="form-control" id="chooseStaff">
                                    </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label">Subject</label>
                                    <input class="form-control" type="text" id="hospitalToStaff_subject" name="hospitalToStaff_subject">
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" id="hospitalToStaff_message" name="hospitalToStaff_message" rows="8"></textarea> 
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-danger form-control" type="submit" data-bs-dismiss="modal" id="hospitalToStaff_btnClose" name="hospitalToStaff_btnClose">Discard</button>
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-primary form-control" type="submit" id="hospitalToStaff_btnCompose" name="hospitalToStaff_btnCompose">Compose</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-body d-none" id="chosenHospitalToDonor">
                            <div id="" class="row g-3">
                                
                                <div class="col-md-12">
                                    <label class="form-label">Choose Donor</label>
                                    <select class="form-control" id="chooseDonor">
                                    </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label">Subject</label>
                                    <input class="form-control" type="text" id="hospitalToDonor_subject" name="hospitalToDonor_subject">
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" id="hospitalToDonor_message" name="hospitalToDonor_message" rows="8"></textarea> 
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-danger form-control" type="submit" data-bs-dismiss="modal" id="hospitalToDonor_btnClose" name="hospitalToDonor_btnClose">Discard</button>
                                </div>
                                
                                <div class="col-md-6">
                                    <button class="btn btn-primary form-control" type="submit" id="hospitalToDonor_btnCompose" name="hospitalToDonor_btnCompose">Compose</button>
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
        
        publicUrl ='{{ url("hospital/dashboard/fetchInbox") }}';
        
        //load inbox
        fetchMessages();
        $('#viewInboxMessages').removeClass('btn-light');
        $('#viewInboxMessages').addClass('btn-dark');
        
        $('#btnOpenComposeMessageModal').click(function(){
            $('#composeMessageModal').modal('show');
            $('#chosenHospitalToAdmin').addClass('d-none');
            $('#chosenHospitalToStaff').addClass('d-none');
            $('#chosenHospitalToDonor').addClass('d-none');
            
            $('#errorList').html('');
            $('#errorModalBody').addClass('d-none');
            $('#errorList').addClass('d-none');
        });
        
        $('#chooseRecipient').change(function() {
            
            if ($(this).val() == 'hospitalToAdmin') {
                $('#chosenHospitalToAdmin').removeClass('d-none');
                $('#chosenHospitalToStaff').addClass('d-none');
                $('#chosenHospitalToDonor').addClass('d-none');
            }
            else if ($(this).val() == 'hospitalToStaff') {
                $('#chosenHospitalToAdmin').addClass('d-none');
                $('#chosenHospitalToStaff').removeClass('d-none');
                $('#chosenHospitalToDonor').addClass('d-none');
                fetchStaffList();
            }
            else if ($(this).val() == 'hospitalToDonor') {
                $('#chosenHospitalToAdmin').addClass('d-none');
                $('#chosenHospitalToStaff').addClass('d-none');
                $('#chosenHospitalToDonor').removeClass('d-none');
                fetchDonorList();
            }
        });
        
        $('#viewSentMessages').click(function(){
            $('#viewSentMessages').removeClass('btn-light');
            $('#viewSentMessages').addClass('btn-dark');
            $('#viewInboxMessages').removeClass('btn-dark');
            $('#viewInboxMessages').addClass('btn-light');
            $('#viewTrashMessages').removeClass('btn-dark');
            $('#viewTrashMessages').addClass('btn-light');
            
            publicUrl ='{{ url("hospital/dashboard/fetchSent") }}';
            fetchMessages();
        });
        
        $('#viewTrashMessages').click(function(){
            $('#viewSentMessages').removeClass('btn-dark');
            $('#viewSentMessages').addClass('btn-light');
            $('#viewInboxMessages').removeClass('btn-dark');
            $('#viewInboxMessages').addClass('btn-light');
            $('#viewTrashMessages').removeClass('btn-light');
            $('#viewTrashMessages').addClass('btn-dark');
            
            publicUrl ='{{ url("hospital/dashboard/fetchTrash") }}';
            fetchMessages();
        });
        
        $('#viewInboxMessages').click(function(){
            $('#viewSentMessages').removeClass('btn-dark');
            $('#viewSentMessages').addClass('btn-light');
            $('#viewInboxMessages').removeClass('btn-light');
            $('#viewInboxMessages').addClass('btn-dark');
            $('#viewTrashMessages').removeClass('btn-dark');
            $('#viewTrashMessages').addClass('btn-light');
            
            publicUrl ='{{ url("hospital/dashboard/fetchInbox") }}';
            fetchMessages();
        });
        
        $(document).on('click', '#hospitalToAdmin_btnCompose',function(e){
            e.preventDefault();
            
            $('#hospitalToAdmin_btnCompose').text('Sending...');
            
            var sender = $('#chooseRecipient').val();
            var subject = $('#hospitalToAdmin_subject').val();
            var recipientId = '-'
            var message = $('#hospitalToAdmin_message').val();
            
            var data = {
                'sender' : sender,
                'recipientId' : recipientId,
                'subject' : subject,
                'message' : message,
            }
            
            var url = '{{ url("hospital/dashboard/sendMessage") }}';
            
            $.ajax({
                type:"POST",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    
                    if(response.status==400)
                    {
                        $('#hospitalToAdmin_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else if(response.status==200)
                    {
                        $('#hospitalToAdmin_btnCompose').text('Sent!');
                        $('#hospitalToAdmin_btnCompose').removeClass('btn-primary');
                        $('#hospitalToAdmin_btnCompose').addClass('btn-success');
                        
                        
                        $('#errorList').html('');
                        $('#errorModalBody').addClass('d-none');
                        $('#errorList').addClass('d-none');
                        
                        setTimeout(function(){
                            $('#hospitalToAdmin_btnCompose').removeClass('btn-success');
                            $('#hospitalToAdmin_btnCompose').addClass('btn-primary');
                            $('#hospitalToAdmin_btnCompose').text('Compose');
                            $('#composeMessageModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#hospitalToStaff_btnCompose',function(e){
            e.preventDefault();
            
            $('#hospitalToStaff_btnCompose').text('Sending...');
            
            var sender = $('#chooseRecipient').val();
            var recipientId = $('#chooseStaff').val();
            var subject = $('#hospitalToStaff_subject').val();
            var message = $('#hospitalToStaff_message').val();
            
            var data = {
                'sender' : sender,
                'recipientId' : recipientId,
                'subject' : subject,
                'message' : message,
            }
            
            var url = '{{ url("hospital/dashboard/sendMessage") }}';
            
            $.ajax({
                type:"POST",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    
                    if(response.status==400)
                    {
                        $('#hospitalToStaff_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else if(response.status==200)
                    {
                        $('#hospitalToStaff_btnCompose').text('Sent!');
                        $('#hospitalToStaff_btnCompose').removeClass('btn-primary');
                        $('#hospitalToStaff_btnCompose').addClass('btn-success');
                        
                        
                        $('#errorList').html('');
                        $('#errorModalBody').addClass('d-none');
                        $('#errorList').addClass('d-none');
                        
                        setTimeout(function(){
                            $('#hospitalToStaff_btnCompose').removeClass('btn-success');
                            $('#hospitalToStaff_btnCompose').addClass('btn-primary');
                            $('#hospitalToStaff_btnCompose').text('Compose');
                            $('#composeMessageModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        $(document).on('click', '#hospitalToDonor_btnCompose',function(e){
            e.preventDefault();
            e.preventDefault();
            
            $('#hospitalToDonor_btnCompose').text('Sending...');
            
            var sender = $('#chooseRecipient').val();
            var recipientId = $('#chooseDonor').val();
            var subject = $('#hospitalToDonor_subject').val();
            var message = $('#hospitalToDonor_message').val();
            
            var data = {
                'sender' : sender,
                'recipientId' : recipientId,
                'subject' : subject,
                'message' : message,
            }
            
            var url = '{{ url("hospital/dashboard/sendMessage") }}';
            
            $.ajax({
                type:"POST",
                url:url,
                data:data,
                dataType:"json",
                success:function(response){
                    
                    if(response.status==400)
                    {
                        $('#hospitalToDonor_btnCompose').text('Compose');
                        
                        $('#errorList').html('');
                        $('#errorModalBody').removeClass('d-none');
                        $('#errorList').removeClass('d-none');
                        
                        $.each(response.errors,function(key,err_value){
                            $('#errorList').append('<li>'+err_value+'</li>');
                        });
                    }
                    else if(response.status==200)
                    {
                        $('#hospitalToDonor_btnCompose').text('Sent!');
                        $('#hospitalToDonor_btnCompose').removeClass('btn-primary');
                        $('#hospitalToDonor_btnCompose').addClass('btn-success');
                        
                        
                        $('#errorList').html('');
                        $('#errorModalBody').addClass('d-none');
                        $('#errorList').addClass('d-none');
                        
                        setTimeout(function(){
                            $('#hospitalToDonor_btnCompose').removeClass('btn-success');
                            $('#hospitalToDonor_btnCompose').addClass('btn-primary');
                            $('#hospitalToDonor_btnCompose').text('Compose');
                            $('#composeMessageModal').modal('hide');
                        }, 2000);
                    }
                }
            });
        });
        
        function fetchStaffList()
        {
            var url = '{{ url("hospital/dashboard/fetchStaffList") }}';
            
            $.ajax({
                type:"GET",
                url:url,
                success:function(response){
                    $('#chooseStaff').html('');
                    $.each(response.staff,function(key,item){
                        $('#chooseStaff').append('<option value="'+item.id+'">'+item.fullname+'</option>');
                    });
                }
            });
        }
        
        function fetchDonorList()
        {
            var url = '{{ url("hospital/dashboard/fetchDonorList") }}';
            
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
        
        $(document).on('click', '#btnMoveToTrash',function(e){
            e.preventDefault();
            var id = $(this).val();
            
            var url = '{{ url("hospital/dashboard/moveToTrash/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"PUT",
                url:url,
                dataType:"json",
                success:function(response){
                    fetchMessages();
                }
            });
        });
        
        function fetchMessages()
        {
            $.ajax({
                type:"GET",
                url:publicUrl,
                success:function(response){
                    $('tbody').html('');
                    $.each(response.messages,function(key,item){
                        
                        //inbox
                        if(item.sender=="staffToHospital" || item.sender=="hospitalToStaff"){
                            $party = 'Staff';
                        }
                        else if(item.sender=="adminToHospital" || item.sender=="hospitalToAdmin"){
                            $party = 'Administrator';
                        }
                        else if(item.sender=="donorToHospital" || item.sender=="hospitalToDonor"){
                            $party = 'Donor';
                        }
                        
                        $deleteButton = '<button class="btn btn-danger btn-sm" value="'+item.id+'" id="btnMoveToTrash">Move to Trash</button>';
                        
                        var messageSubject_str = item.subject;
                        var messageSubject_str = messageSubject_str.slice(0, 35)+'...'; 
                        
                        var messageDescription_str = item.message;
                        var messageDescription_str = messageDescription_str.slice(0, 20)+'...'; 
                        
                        var messageDate_str = item.date;
                        var messageDate_str = messageDate_str.slice(0, 10); 
                        
                        //inbox messages
                        if(item.hospital_side_status == 'unread' && item.sender.includes('ToHospital'))
                        {
                            if(item.reply_status=="1" || item.reply_status=="2")
                            {
                                $toggleElement = '<label class="badge badge-success">Replied</label>';
                            }
                            else if(item.reply_status=="0")
                            {
                                $toggleElement = '<button class="btn btn-dark btn-sm" value="'+item.id+'" id="btnOpenMessage">Reply</button>';
                            }
                            
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
                        }
                        
                        //sent messages
                        if(item.hospital_side_status == 'sent' && item.sender.includes('hospitalTo'))
                        {
                            if(item.reply_status=="1" || item.reply_status=="2")
                            {
                                $toggleElement = '<button class="btn btn-success btn-sm" value="'+item.id+'" id="btnOpenMessage">See Reply</button>';
                            }
                            else if(item.reply_status=="0")
                            {
                                $toggleElement = '<button class="btn btn-dark btn-sm" value="'+item.id+'" id="btnOpenMessage">Open</button>';
                            }
                            
                            $('tbody').append('<tr>\
                                <td>To <b>'+$party+'</b></td>\
                                <td>'+messageSubject_str+'</td>\
                                <td>'+messageDescription_str+'</td>\
                                <td>'+messageDate_str+'</td>\
                                <td>\
                                    '+$toggleElement+'\
                                    '+$deleteButton+'\
                                </td>\
                            </tr>\
                            ');
                        }
                        
                        //trash messages
                        if(item.hospital_side_status == 'trash')
                        {
                            if(item.sender.includes('hospitalTo'))
                            {
                                $toOrFrom = 'To';
                                
                                $toggleElement = '<label class="badge badge-primary">Sent</label>\
                                <button class="btn btn-dark btn-sm" value="'+item.id+'" id="btnOpenMessage">Open</button>';
                            }
                            else if(item.sender.includes('ToHospital'))
                            {
                                $toOrFrom = 'From';
                                
                                $toggleElement = '<label class="badge badge-success">Received</label>\
                                <button class="btn btn-dark btn-sm" value="'+item.id+'" id="btnOpenMessage">Open</button>';
                            }
                            
                            $('tbody').append('<tr>\
                                <td>'+$toOrFrom+' <b>'+$party+'</b></td>\
                                <td>'+messageSubject_str+'</td>\
                                <td>'+messageDescription_str+'</td>\
                                <td>'+messageDate_str+'</td>\
                                <td>\
                                    '+$toggleElement+'\
                                </td>\
                            </tr>\
                            ');
                        }
                        
                        
                    });
                }
            });
        }
        
        $(document).on('click', '#btnOpenMessage',function(e){
            e.preventDefault();
            
            var id = $(this).val();
            $('#messageIdForReply').val(id);
            
            var url = '{{ url("hospital/dashboard/fetchSingle/:id") }}';
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
                        
                        var senderType = response.messages.sender;
                        if(senderType.includes('hospitalTo'))
                        {
                            $toOrFrom = 'Sent To';
                            
                            if(response.messages.reply_status=="1" || response.messages.reply_status=="2")
                            {
                                $('#openReplySection').removeClass('d-none');
                                $('#openReply').text(response.messages.reply);
                                $('#messageIdForReply').val(response.messages.id);
                            }
                            else if(response.messages.reply_status=="0")
                            {
                                $('#openReplySection').addClass('d-none');
                            }
                        }
                        else if(senderType.includes('ToHospital'))
                        {
                            $toOrFrom = 'Received From:';
                        }
                        
                        //decide visibility of reply body
                        if(response.messages.hospital_side_status=="unread" && response.messages.reply_status=="0")
                            {
                                $('#replyBody').removeClass('d-none');
                                $('#openReplySection').addClass('d-none');
                            }
                            else if(response.messages.hospital_side_status=="sent" && response.messages.reply_status=="0")
                            {
                                $('#replyBody').addClass('d-none');
                                $('#openReplySection').addClass('d-none');
                            }
                            else if(response.messages.hospital_side_status=="sent" && response.messages.reply_status!="0")
                            {
                                $('#replyBody').addClass('d-none');
                                $('#openReplySection').removeClass('d-none');
                            }
                            else if(response.messages.hospital_side_status=="trash" && response.messages.reply_status!="0")
                            {
                                $('#replyBody').addClass('d-none');
                                $('#openReplySection').removeClass('d-none');
                            }
                            else if(response.messages.hospital_side_status=="trash" && response.messages.reply_status=="0")
                            {
                                $('#replyBody').addClass('d-none');
                                $('#openReplySection').addClass('d-none');
                            }
                            
                        
                        //get sender or receiver
                        if(senderType.includes('ToStaff'))
                        {
                            var urlFetchSenderOrReceiver = '{{ url("hospital/dashboard/fetchSenderOrReceiver/:senderOrReceiverId/:sender") }}';
                            urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':senderOrReceiverId', response.messages.recipient_id);
                            urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':sender', senderType);
                            $.ajax({
                                type:"GET",
                                url:urlFetchSenderOrReceiver,
                                success:function(response){
                                    $('#sender').html('<b>'+$toOrFrom+'</b>  '+response.admins.fullname+' (Staff)');
                                }
                            });
                        }
                        else if(senderType.includes('ToDonor'))
                        {
                            var urlFetchSenderOrReceiver = '{{ url("hospital/dashboard/fetchSenderOrReceiver/:senderOrReceiverId/:sender") }}';
                            urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':senderOrReceiverId', response.messages.recipient_id);
                            urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':sender', senderType);
                            $.ajax({
                                type:"GET",
                                url:urlFetchSenderOrReceiver,
                                success:function(response){
                                    $('#sender').html('<b>'+$toOrFrom+'</b>  '+response.donors.fullname+' (Donor)');
                                }
                            });
                        }
                        else if(senderType.includes('staffTo'))
                        {
                            var urlFetchSenderOrReceiver = '{{ url("hospital/dashboard/fetchSenderOrReceiver/:senderOrReceiverId/:sender") }}';
                            urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':senderOrReceiverId', response.messages.sender_id);
                            urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':sender', senderType);
                            $.ajax({
                                type:"GET",
                                url:urlFetchSenderOrReceiver,
                                success:function(response){
                                    $('#sender').html('<b>'+$toOrFrom+'</b>  '+response.admins.fullname+' (Staff)');
                                }
                            });
                        }
                        else if(senderType.includes('donorTo'))
                        {
                            var urlFetchSenderOrReceiver = '{{ url("hospital/dashboard/fetchSenderOrReceiver/:senderOrReceiverId/:sender") }}';
                            urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':senderOrReceiverId', response.messages.sender_id);
                            urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':sender', senderType);
                            $.ajax({
                                type:"GET",
                                url:urlFetchSenderOrReceiver,
                                success:function(response){
                                    $('#sender').html('<b>'+$toOrFrom+'</b>  '+response.donors.fullname+' (Donor)');
                                }
                            });
                        }
                        else
                        {
                            $('#sender').html('<b>'+$toOrFrom+'</b> Administrator');
                        }
                        //end
                        var openDate_str = response.messages.date;
                        var openDate_str = openDate_str.slice(0, 11); 
                        
                        var openTime_str = response.messages.time;
                        var openTime_str = openTime_str.slice(11, 20);
                        
                        $('#openMessageModalTitle').text('Message No. '+response.messages.message_no);
                        $('#openDate').html('<b>Date:</b> '+openDate_str+'&nbsp;&nbsp;&nbsp;<b>Time:</b> '+openTime_str);
                        $('#openSubject').html('<b>Subject:</b> '+response.messages.subject);
                        $('#openMessage').text(response.messages.message);
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
            
            var url = '{{ url("hospital/dashboard/replyToMessage") }}';
            
            $.ajax({
                type:"PUT",
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
                            fetchMessages();
                        }, 2000);
                    }
                }
            });
        });
        
    });
</script>
@endsection
