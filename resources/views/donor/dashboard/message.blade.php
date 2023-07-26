@extends('donor.layouts.master')

@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-lg mx-auto">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">MESSAGES</h3>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    
                    {{-- to check if its a hospital donor or normal donor --}}
                    <input type="hidden" id="checkDonorTypeHidden" value="{{ Auth::guard('donor')->user()->no }}">
                    
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="btn-group">
                                    <button data-bs-toggle="modal" data-bs-target="#composeMessageModal" type="button" id="btnOpenComposeMessageModal" class="btn btn-primary">Compose</button>
                                    <button type="button" id="viewInboxMessages" class="btn btn-light">Inbox</button>
                                    <button type="button" id="viewSentMessages" class="btn btn-light">Sent</button>
                                    <button type="button" id="viewTrashMessages" class="btn btn-light">Trash</button>
                                </div><hr>
                            </div>
                            
                            <table class="table table-orders">
                                <tbody class="tb-odr-body text-center">
                                    
                                </tbody>
                            </table>
                        </div><!-- .card-preview -->
                    </div><!-- nk-block -->
                    
                    
                    
                    <div class="modal fade" tabindex="-1" role="dialog" id="composeMessageModal">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <a href="#" class="close" data-bs-dismiss="modal"><em
                                    class="icon ni ni-cross-sm"></em></a>
                                    <div class="modal-body modal-body-md">
                                        <div class="mt-2">
                                            
                                            <h5 class="modal-title">Compose Message</h5>
                                            <hr style="padding: 0.5px; background:black"><br>
                                            
                                            <div class="row g-gs d-none" id="errorModalBody">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <ul class="alert alert-warning d-none" id="errorList">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row g-gs d-none" id="ODDonorCompose">
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Subject</label>
                                                        <input type="text" class="form-control" id="donorToStaff_subject">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Message</label>
                                                        <textarea type="text" class="form-control" id="donorToStaff_message"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button class="btn btn-danger form-control center" data-bs-dismiss="modal" 
                                                        id="donorToStaff_btnClose">Close</button>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary form-control center"
                                                        id="donorToStaff_btnCompose">Send</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row g-gs d-none" id="HSDonorCompose">
                                                
                                                <input type="hidden" id="donorToHospital_recipient" value="{{ Auth::guard('donor')->user()->hospital }}">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Subject</label>
                                                        <input type="text" class="form-control" id="donorToHospital_subject">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="">Message</label>
                                                        <textarea type="text" class="form-control" id="donorToHospital_message"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button class="btn btn-danger form-control center" data-bs-dismiss="modal" 
                                                        id="donorToHospital_btnClose">Close</button>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary form-control center"
                                                        id="donorToHospital_btnCompose">Send</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .modal-body -->
                            </div><!-- .modal-content -->
                        </div><!-- .modal-dialog -->
                    </div><!-- compose Message modal -->
                    
                    
                    <div class="modal fade" tabindex="-1" role="dialog" id="openMessageModal">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <a href="#" class="close" data-bs-dismiss="modal"><em
                                    class="icon ni ni-cross-sm"></em></a>
                                    <div class="modal-body modal-body-md">
                                        <div class="mt-2">
                                            
                                            <h5 class="modal-title" id="openMessageModalTitle"></h5>
                                            <hr style="padding: 0.5px; background:black"><br>
                                            
                                            <div class="row g-gs d-none" id="errorModalBody">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <ul class="alert alert-warning d-none" id="errorList">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row g-gs" id="">
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" id="sender"></label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" id="openDate"></label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" id="openSubject"></label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label"><b>Message:</b></label>
                                                        <p class="" id="openMessage"></p> 
                                                    </div>
                                                </div>
                                                
                                                {{-- to get reply --}}
                                                <input type="hidden" id="openMessageId"><hr>
                                                
                                                <div class="col-md-12 d-none" id="openReplySection">
                                                    <div class="form-group">
                                                        <label class="form-label" id="replyLabel"><b></b></label>
                                                        <p class="" id="openReply"></p> 
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row g-gs" id="replyBody">
                                                {{-- to get sender details --}}
                                                <input type="hidden" id="openSenderId">
                                                <input type="hidden" id="openSender">
                                                
                                                {{-- section to reply to a message --}}
                                                <input type="hidden" id="messageIdForReply">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Reply</label>
                                                        <textarea type="text" class="form-control" id="reply_message"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button class="btn btn-danger form-control center" data-bs-dismiss="modal">
                                                            Close</button>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <button class="btn btn-primary form-control center"
                                                            id="btnReply">Send</button>
                                                        </div>
                                                    </div>    
                                                </div>    
                                            </div>
                                        </div>
                                    </div><!-- .modal-body -->
                                </div><!-- .modal-content -->
                            </div><!-- .modal-dialog -->
                        </div><!-- see message modal -->
                        
                        
                    </div><!-- .components-preview wide-lg mx-auto -->
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
            
            publicUrl ='{{ url("donor/dashboard/fetchInbox") }}';
            
            var donorType = $('#checkDonorTypeHidden').val();
            checkDonorType();
            
            //load inbox
            fetchMessages();
            $('#viewInboxMessages').removeClass('btn-light');
            $('#viewInboxMessages').addClass('btn-dark');
            
            function checkDonorType()
            {
                
                if(donorType.includes('OD'))
                {
                    $('#ODDonorCompose').removeClass('d-none');
                    $('#HSDonorCompose').addClass('d-none');
                }
                else if(donorType.includes('HS'))
                {
                    $('#ODDonorCompose').addClass('d-none');
                    $('#HSDonorCompose').removeClass('d-none');
                }
            }
            
            $('#viewSentMessages').click(function(){
                $('#viewSentMessages').removeClass('btn-light');
                $('#viewSentMessages').addClass('btn-dark');
                $('#viewInboxMessages').removeClass('btn-dark');
                $('#viewInboxMessages').addClass('btn-light');
                $('#viewTrashMessages').removeClass('btn-dark');
                $('#viewTrashMessages').addClass('btn-light');
                
                publicUrl ='{{ url("donor/dashboard/fetchSent") }}';
                fetchMessages();
            });
            
            $('#viewTrashMessages').click(function(){
                $('#viewSentMessages').removeClass('btn-dark');
                $('#viewSentMessages').addClass('btn-light');
                $('#viewInboxMessages').removeClass('btn-dark');
                $('#viewInboxMessages').addClass('btn-light');
                $('#viewTrashMessages').removeClass('btn-light');
                $('#viewTrashMessages').addClass('btn-dark');
                
                publicUrl ='{{ url("donor/dashboard/fetchTrash") }}';
                fetchMessages();
            });
            
            $('#viewInboxMessages').click(function(){
                $('#viewSentMessages').removeClass('btn-dark');
                $('#viewSentMessages').addClass('btn-light');
                $('#viewInboxMessages').removeClass('btn-light');
                $('#viewInboxMessages').addClass('btn-dark');
                $('#viewTrashMessages').removeClass('btn-dark');
                $('#viewTrashMessages').addClass('btn-light');
                
                publicUrl ='{{ url("donor/dashboard/fetchInbox") }}';
                fetchMessages();
            });
            
            $(document).on('click', '#donorToStaff_btnCompose',function(e){
                e.preventDefault();
                
                $('#donorToStaff_btnCompose').text('Sending...');
                
                var sender = "donorToStaff";
                var subject = $('#donorToStaff_subject').val();
                var recipientId = "-";
                var message = $('#donorToStaff_message').val();
                
                var data = {
                    'sender' : sender,
                    'recipientId' : recipientId,
                    'subject' : subject,
                    'message' : message
                }
                
                var url = '{{ url("donor/dashboard/sendMessage") }}';
                
                $.ajax({
                    type:"POST",
                    url:url,
                    data:data,
                    dataType:"json",
                    success:function(response){
                        
                        if(response.status==400)
                        {
                            $('#donorToStaff_btnCompose').text('Compose');
                            
                            $('#errorList').html('');
                            $('#errorModalBody').removeClass('d-none');
                            $('#errorList').removeClass('d-none');
                            
                            $.each(response.errors,function(key,err_value){
                                $('#errorList').append('<li>'+err_value+'</li>');
                            });
                        }
                        else if(response.status==200)
                        {
                            $('#donorToStaff_btnCompose').text('Sent!');
                            $('#donorToStaff_btnCompose').removeClass('btn-primary');
                            $('#donorToStaff_btnCompose').addClass('btn-success');
                            
                            
                            $('#errorList').html('');
                            $('#errorModalBody').addClass('d-none');
                            $('#errorList').addClass('d-none');
                            
                            setTimeout(function(){
                                $('#donorToStaff_btnCompose').removeClass('btn-success');
                                $('#donorToStaff_btnCompose').addClass('btn-primary');
                                $('#donorToStaff_btnCompose').text('Compose');
                                $('#composeMessageModal').modal('hide');
                            }, 2000);
                        }
                    }
                });
            });
            
            $(document).on('click', '#donorToHospital_btnCompose',function(e){
                e.preventDefault();
                
                $('#donorToHospital_btnCompose').text('Sending...');
                
                var sender = 'donorToHospital';
                var subject = $('#donorToHospital_subject').val();
                var recipientId = $('#donorToHospital_recipient').val();
                var message = $('#donorToHospital_message').val();
                
                var data = {
                    'sender' : sender,
                    'recipientId' : recipientId,
                    'subject' : subject,
                    'message' : message
                }
                
                var url = '{{ url("donor/dashboard/sendMessage") }}';
                
                $.ajax({
                    type:"POST",
                    url:url,
                    data:data,
                    dataType:"json",
                    success:function(response){
                        
                        if(response.status==400)
                        {
                            $('#donorToHospital_btnCompose').text('Compose');
                            
                            $('#errorList').html('');
                            $('#errorModalBody').removeClass('d-none');
                            $('#errorList').removeClass('d-none');
                            
                            $.each(response.errors,function(key,err_value){
                                $('#errorList').append('<li>'+err_value+'</li>');
                            });
                        }
                        else if(response.status==200)
                        {
                            $('#donorToHospital_btnCompose').text('Sent!');
                            $('#donorToHospital_btnCompose').removeClass('btn-primary');
                            $('#donorToHospital_btnCompose').addClass('btn-success');
                            
                            
                            $('#errorList').html('');
                            $('#errorModalBody').addClass('d-none');
                            $('#errorList').addClass('d-none');
                            
                            setTimeout(function(){
                                $('#donorToHospital_btnCompose').removeClass('btn-success');
                                $('#donorToHospital_btnCompose').addClass('btn-primary');
                                $('#donorToHospital_btnCompose').text('Compose');
                                $('#composeMessageModal').modal('hide');
                            }, 2000);
                        }
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
                            
                            //party type
                            if(donorType.includes('OD'))
                            {
                                $party = 'Staff';
                            }
                            else if(donorType.includes('HS'))
                            {
                                $party = 'Hospital';
                            }
                            
                            //to and from
                            if(item.sender.includes('ToDonor'))
                            {
                                $toOrFrom = 'From';
                                $toOrFrom_badge = '<span class="badge badge bg-success">Received</span>';
                            }
                            else if(item.sender.includes('donorTo'))
                            {
                                $toOrFrom = 'To';
                                $toOrFrom_badge = '<span class="badge badge bg-primary">Sent</span>';
                            }
                            
                            $deleteButton = '<button class="btn btn-danger btn-sm" value="'+item.id+'" id="btnMoveToTrash">Move to Trash</button>';
                            
                            var messageSubject_str = item.subject;
                            var messageSubject_str = messageSubject_str.slice(0, 35)+'...'; 
                            
                            var messageDescription_str = item.message;
                            var messageDescription_str = messageDescription_str.slice(0, 20)+'...'; 
                            
                            var messageDate_str = item.date;
                            var messageDate_str = messageDate_str.slice(0, 10);
                            
                            //inbox messages
                            if(item.donor_side_status == 'unread' && item.sender.includes('ToDonor'))
                            {
                                if(item.reply_status=="1" || item.reply_status=="2")
                                {
                                    $toggleElement = '<span class="badge badge bg-success">Replied</span>';
                                }
                                else if(item.reply_status=="0")
                                {
                                    $toggleElement = '<button data-bs-toggle="modal" data-bs-target="#openMessageModal" class="btn btn-primary btn-sm" value="'+item.id+'" id="btnOpenMessage">Reply</button>';
                                }
                                
                                $('tbody').append('<tr>\
                                    <td>'+$toOrFrom+' <b>'+$party+'</b></td>\
                                    <td>'+messageSubject_str+'</td>\
                                    <td>'+messageDescription_str+'</td>\
                                    <td>'+messageDate_str+'</td>\
                                    <td>'+$toggleElement+'</td>\
                                    <td>'+$deleteButton+'</td>\
                                </tr>\
                                ');
                            }
                            
                            //Sent messages
                            if(item.donor_side_status == 'sent' && item.sender.includes('donorTo'))
                            {
                                if(item.reply_status=="1")
                                {
                                    $toggleElement = '<button data-bs-toggle="modal" data-bs-target="#openMessageModal" class="btn btn-success btn-sm" value="'+item.id+'" id="btnOpenMessage">See Reply</button>';
                                }
                                else if(item.reply_status=="2")
                                {
                                    $toggleElement = '<button data-bs-toggle="modal" data-bs-target="#openMessageModal" class="btn btn-light btn-sm" value="'+item.id+'" id="btnOpenMessage">Opened</button>';
                                }
                                else if(item.reply_status=="0")
                                {
                                    $toggleElement = '<button data-bs-toggle="modal" data-bs-target="#openMessageModal" class="btn btn-primary btn-sm" value="'+item.id+'" id="btnOpenMessage">Open</button>';
                                }
                                
                                $('tbody').append('<tr>\
                                    <td>'+$toOrFrom+' <b>'+$party+'</b></td>\
                                    <td>'+messageSubject_str+'</td>\
                                    <td>'+messageDescription_str+'</td>\
                                    <td>'+messageDate_str+'</td>\
                                    <td>'+$toggleElement+'</td>\
                                    <td>'+$deleteButton+'</td>\
                                </tr>\
                                ');
                            }
                            
                            //Trash messages
                            if(item.donor_side_status == 'trash')
                            {
                                if(item.reply_status=="1")
                                {
                                    $toggleElement = '<button data-bs-toggle="modal" data-bs-target="#openMessageModal" class="btn btn-dark btn-sm" value="'+item.id+'" id="btnOpenMessage">See Reply</button>';
                                }
                                else if(item.reply_status=="2")
                                {
                                    $toggleElement = '<button data-bs-toggle="modal" data-bs-target="#openMessageModal" class="btn btn-light btn-sm" value="'+item.id+'" id="btnOpenMessage">Opened</button>';
                                }
                                else if(item.reply_status=="0")
                                {
                                    $toggleElement = '<button data-bs-toggle="modal" data-bs-target="#openMessageModal" class="btn btn-primary btn-sm" value="'+item.id+'" id="btnOpenMessage">Open</button>';
                                }
                                
                                $('tbody').append('<tr>\
                                    <td>'+$toOrFrom+' <b>'+$party+'</b></td>\
                                    <td>'+messageSubject_str+'</td>\
                                    <td>'+messageDescription_str+'</td>\
                                    <td>'+messageDate_str+'</td>\
                                    <td>'+$toOrFrom_badge+'</td>\
                                    <td>\
                                        '+$toggleElement+'\
                                    </td>\
                                </tr>\
                                ');
                            }
                        })
                    }
                });
            }
            
            $(document).on('click', '#btnMoveToTrash',function(e){
                e.preventDefault();
                var id = $(this).val();
                
                var url = '{{ url("donor/dashboard/moveToTrash/:id") }}';
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
            
            $(document).on('click', '#btnOpenMessage',function(e){
                e.preventDefault();
                
                var id = $(this).val();
                $('#messageIdForReply').val(id);
                
                var url = '{{ url("donor/dashboard/fetchSingle/:id") }}';
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
                            var senderType = response.messages.sender;
                            
                            //check sender and decide to and from
                            if(senderType.includes('donorTo'))
                            {
                                $toOrFrom = 'Sent To:';
                                
                                $('#replyLabel').text('Reply:');
                                
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
                            else if(senderType.includes('ToDonor'))
                            {
                                $toOrFrom = 'Received From:';
                                $('#replyLabel').text('My Reply:');
                                $('#openReply').text(response.messages.reply);
                            }
                            
                            //decide visibility of reply body
                            if(response.messages.donor_side_status=="unread" && response.messages.reply_status=="0")
                            {
                                $('#replyBody').removeClass('d-none');
                                $('#openReplySection').addClass('d-none');
                            }
                            else if(response.messages.donor_side_status=="sent" && response.messages.reply_status=="0")
                            {
                                $('#replyBody').addClass('d-none');
                                $('#openReplySection').addClass('d-none');
                            }
                            else if(response.messages.donor_side_status=="sent" && response.messages.reply_status!="0")
                            {
                                $('#replyBody').addClass('d-none');
                                $('#openReplySection').removeClass('d-none');
                            }
                            else if(response.messages.donor_side_status=="trash" && response.messages.reply_status!="0")
                            {
                                $('#replyBody').addClass('d-none');
                                $('#openReplySection').removeClass('d-none');
                            }
                            else if(response.messages.donor_side_status=="trash" && response.messages.reply_status=="0")
                            {
                                $('#replyBody').addClass('d-none');
                                $('#openReplySection').addClass('d-none');
                            }
                            
                            //get sender or receiver
                            if(senderType.includes('staffToDonor'))
                            {
                                var urlFetchSenderOrReceiver = '{{ url("donor/dashboard/fetchSenderOrReceiver/:senderOrReceiverId/:sender") }}';
                                urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':senderOrReceiverId', response.messages.sender_id);
                                urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':sender', senderType);
                                $.ajax({
                                    type:"GET",
                                    url:urlFetchSenderOrReceiver,
                                    success:function(response){
                                        $('#sender').html('<b>'+$toOrFrom+'</b>  '+response.admin.fullname+' (Staff)');
                                    }
                                });
                            }
                            else if(senderType.includes('donorToStaff'))
                            {
                                $('#sender').html('<b>'+$toOrFrom+'</b> LIFE SAVER');
                            }
                            else if(senderType.includes('hospitalToDonor'))
                            {
                                var urlFetchSenderOrReceiver = '{{ url("donor/dashboard/fetchSenderOrReceiver/:senderOrReceiverId/:sender") }}';
                                urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':senderOrReceiverId', response.messages.sender_id);
                                urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':sender', senderType);
                                $.ajax({
                                    type:"GET",
                                    url:urlFetchSenderOrReceiver,
                                    success:function(response){
                                        $('#sender').html('<b>'+$toOrFrom+'</b>  '+response.hospital.name);
                                    }
                                });
                            }
                            else if(senderType.includes('donorToHospital'))
                            {
                                var urlFetchSenderOrReceiver = '{{ url("donor/dashboard/fetchSenderOrReceiver/:senderOrReceiverId/:sender") }}';
                                urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':senderOrReceiverId', response.messages.recipient_id);
                                urlFetchSenderOrReceiver = urlFetchSenderOrReceiver.replace(':sender', senderType);
                                $.ajax({
                                    type:"GET",
                                    url:urlFetchSenderOrReceiver,
                                    success:function(response){
                                        $('#sender').html('<b>'+$toOrFrom+'</b>  '+response.hospital.name);
                                    }
                                });
                            }
                            
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
                
                var url = '{{ url("donor/dashboard/replyToMessage") }}';
                
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
                            
                            $('#errorList').html('');
                            $('#errorModalBody').removeClass('d-none');
                            $('#errorList').removeClass('d-none');
                            
                            $.each(response.errors,function(key,err_value){
                                $('#errorList').append('<li>'+err_value+'</li>');
                            });
                        }
                        else if(response.status==300) //Message invalid
                        {
                            $('#btnReply').text('Reply');
                            
                            $('#errorList').html('');
                            $('#errorModalBody').removeClass('d-none');
                            $('#errorList').removeClass('d-none');
                            
                            $.each(response.errors,function(key,err_value){
                                $('#errorList').append('<li>Message is not valid</li>');
                            });
                        }
                        else if(response.status==200)
                        {
                            $('#btnReply').text('Replied!');
                            $('#btnReply').removeClass('btn-primary');
                            $('#btnReply').addClass('btn-success');
                            
                            $('#errorList').html('');
                            $('#errorModalBody').addClass('d-none');
                            $('#errorList').addClass('d-none');
                            
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