<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    {{-- <link rel="shortcut icon" href="./images/favicon.png"> --}}
    <!-- Page Title  -->
    <title>LIFE SAVER</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/client/assets/css/dashlite.css?ver=3.0.3') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/client/assets/css/theme.css?ver=3.0.3') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body class="nk-body bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger me-sm-2 d-lg-none">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                                    class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand">
                            <a href="{{ Route('visitor.home') }}" class="logo-link d-flex align-items-center">
                                <img class="logo-light logo-img" src="{{ asset('assets/client/images/logo.png') }}"
                                    alt="logo">
                                <img class="logo-dark logo-img"
                                    src="{{ asset('assets/client/images/logo.png') }}"alt="logo-dark">
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-menu ms-auto" data-content="headerNav">
                            <div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a href="{{ Route('visitor.home') }}" class="logo-link">
                                        <img class="logo-light logo-img"
                                            src="{{ asset('assets/client/images/logo.png') }}" srcset=""
                                            alt="logo">
                                        <img class="logo-dark logo-img"
                                            src="{{ asset('assets/client/images/logo.png') }}" srcset=""
                                            alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-menu-trigger me-n2">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon"
                                        data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                </div>
                            </div>
                            <ul class="nk-menu nk-menu-main ui-s2">
                                <li class="nk-menu {{ (\Request::route()->getName() == 'visitor.home') ? 'bg-primary' : '' }}">
                                    <a href="{{ Route('visitor.home') }}" class="nk-menu-link">
                                        <span class="nk-menu-text {{ (\Request::route()->getName() == 'visitor.home') ? 'text-white' : 'text-primary' }}">Home</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu {{ (\Request::route()->getName() == 'visitor.news') ? 'bg-primary' : '' }}">
                                    <a href="{{ Route('visitor.news') }}" class="nk-menu-link">
                                        <span class="nk-menu-text {{ (\Request::route()->getName() == 'visitor.news') ? 'text-white' : 'text-primary' }}">News and Updates</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link" data-bs-toggle="modal"
                                        data-bs-target="#makeRequestModal">
                                        <span class="nk-menu-text text-primary">Make a Request</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link" data-bs-toggle="modal"
                                        data-bs-target="#trackRequestModal">
                                        <span class="nk-menu-text text-primary">Track Request</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link" data-bs-toggle="modal"
                                        data-bs-target="#makeAnInquiryModal">
                                        <span class="nk-menu-text text-primary">Make an Inquiry</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item">
                                    <a href="{{ Route('visitor.donorLogin') }}" class="nk-menu-link text-primary">
                                        <span class="nk-menu-text text-primary">I am a Donor</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item bg-dark" data-bs-toggle="modal"
                                    data-bs-target="#becomeADonorModal">
                                    <a href="#" class="nk-menu-link" style="color:white">
                                        <span class="nk-menu-text">Become a Donor</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-header-menu -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->
            <!-- content @s -->

            <div class="modal fade" tabindex="-1" role="dialog" id="makeRequestModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <a href="#" class="close" data-bs-dismiss="modal"><em
                                class="icon ni ni-cross-sm"></em></a>
                        <div class="modal-body modal-body-md">
                            <div class="mt-2">

                                <h5 class="modal-title">Make a Request</h5>
                                <hr style="padding: 0.5px; background:black">

                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <ul class="alert alert-warning d-none" id="makeARequestErrorList">
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" for="">Request No.</label>
                                            <input type="text" class="form-control" readonly id="requestNo"
                                                name="requestNo">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">NIC No.</label>
                                            <input type="text" class="form-control" id="requestNic"
                                                name="requestNic">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" for="">Blood Group</label>
                                            <select name="requestBloodGroup" id="requestBloodGroup"
                                                class="form-control">
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="">Full Name</label>
                                            <input type="text" class="form-control" id="requestFullName"
                                                name="requestFullName">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Telephone</label>
                                            <input type="text" class="form-control" id="requestTelephone"
                                                name="requestTelephone">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Email</label>
                                            <input type="email" class="form-control" id="requestEmail"
                                                name="requestEmail">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary form-control center" type="submit"
                                                id="btnMakeRequest" name="btnMakeRequest">Submit Request</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div><!-- makeRequestModal modal -->

            <div class="modal fade" tabindex="-1" role="dialog" id="trackRequestModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <a href="#" class="close" data-bs-dismiss="modal"><em
                                class="icon ni ni-cross-sm"></em></a>
                        <div class="modal-body modal-body-md">
                            <div class="mt-2">

                                <h5 class="modal-title">Track a Request</h5>
                                <hr style="padding: 0.5px; background:black">

                                <div class="row g-gs">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="trackRequestNo"
                                                name="trackRequestNo" placeholder="Enter your request No.">
                                            <label class="text-danger" id="trackRequestErrorAlert"></label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button class="btn btn-dark form-control center" type="submit"
                                                id="btnTrackRequest" name="btnTrackRequest">Track</button>
                                        </div>
                                    </div>
                                </div>
                                <hr style="padding: 0.5px; background:black">

                                <div class="row g-gs d-none" id="trackRequestDetails">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" id="trackNic"></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" id="trackFullName"></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" id="trackBloodGroup"></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" id="trackStatus"></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" id="trackFulfilledDate"></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" id=""><b>Remarks : </b></label>
                                            <p id="trackRemarks"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div><!-- trackRequestModal modal -->

            <div class="modal fade" tabindex="-1" role="dialog" id="becomeADonorModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <a href="#" class="close" data-bs-dismiss="modal"><em
                                class="icon ni ni-cross-sm"></em></a>
                        <div class="modal-body modal-body-md">
                            <div class="mt-2">

                                <h5 class="modal-title">Become a Donor</h5>
                                <hr style="padding: 0.5px; background:black">

                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <ul class="alert alert-warning d-none" id="becomeADonorErrorList">
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Request No.</label>
                                            <input type="text" class="form-control" readonly id="donorRequestNo"
                                                name="donorRequestNo">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">NIC No.</label>
                                            <input type="text" class="form-control" id="donorRequestNic"
                                                name="donorRequestNic">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Date of Birth</label>
                                            <input type="date" class="form-control" id="donorRequestDateOfBirth"
                                                name="donorRequestDateOfBirth">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Age</label>
                                            <input type="text" class="form-control" id="donorRequestAge"
                                                name="donorRequestAge">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="">Full Name</label>
                                            <input type="text" class="form-control" id="donorRequestFullName"
                                                name="donorRequestFullName">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Telephone</label>
                                            <input type="text" class="form-control" id="donorRequestTelephone"
                                                name="donorRequestTelephone">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Email</label>
                                            <input type="email" class="form-control" id="donorRequestEmail"
                                                name="donorRequestEmail">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary form-control center" type="submit"
                                                id="btnMakeDonorRequest" name="btnMakeDonorRequest">Submit
                                                Request</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div><!-- becomeADonorModal modal -->

            <div class="modal fade" tabindex="-1" role="dialog" id="makeAnInquiryModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <a href="#" class="close" data-bs-dismiss="modal"><em
                                class="icon ni ni-cross-sm"></em></a>
                        <div class="modal-body modal-body-md">
                            <div class="mt-2">

                                <h5 class="modal-title">Make An Inquiry</h5>
                                <hr style="padding: 0.5px; background:black">

                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <ul class="alert alert-warning d-none" id="inquiryErrorList">
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="">Email</label>
                                            <input type="email" class="form-control" id="inquiryEmail"
                                                name="inquiryEmail">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="">Subject</label>
                                            <input type="text" class="form-control" id="inquirySubject"
                                                name="inquirySubject">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="">Message</label>
                                            <textarea name="inquiryMessage" id="inquiryMessage" rows="8" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary form-control center" type="submit"
                                                id="btnMakeInquiry" name="btnMakeInquiry">Make Inquiry</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div><!-- becomeADonorModal modal -->

            <script>
                $(document).ready(function() {
                    $('#requestNo').val(Math.floor(Math.random() * (11500000000 - 9950000000000 + 1) + 9950000000000));
                    $('#donorRequestNo').val(Math.floor(Math.random() * (11500000000 - 9950000000000 + 1) + 9950000000000));

                    //csrf token
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    //make blood request
                    $(document).on('click', '#btnMakeRequest', function(e) {
                        e.preventDefault();

                        $('#btnMakeRequest').text('Submitting...');

                        var requestNo = $('#requestNo').val();
                        var nic = $('#requestNic').val();
                        var bloodGroup = $('#requestBloodGroup').val();
                        var fullName = $('#requestFullName').val();
                        var telephone = $('#requestTelephone').val();
                        var email = $('#requestEmail').val();

                        var data = {
                            'requestNo': requestNo,
                            'nic': nic,
                            'bloodGroup': bloodGroup,
                            'fullName': fullName,
                            'telephone': telephone,
                            'email': email
                        }

                        var url = '{{ url("visitor/dashboard/makeARequest") }}';

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                if (response.status == 400) {
                                    
                                    $('#btnMakeRequest').text('Submit Request');

                                    $('#requestNo').val(Math.floor(Math.random() * (11500000000 -
                                        9950000000000 + 1) + 9950000000000));
                                        
                                    $('#makeARequestErrorList').html('');
                                    $('#makeARequestErrorList').removeClass('d-none');
                                    $.each(response.errors, function(key, err_value) {
                                        $('#makeARequestErrorList').append('<li><strong>' +
                                            err_value + '</strong></li>');
                                    });
                                } else if (response.status == 200) {

                                    $('#requestNo').val(Math.floor(Math.random() * (11500000000 -
                                        9950000000000 + 1) + 9950000000000));
                                    $('#requestNic').val('');
                                    $('#requestBloodGroup').val('');
                                    $('#requestFullName').val('');
                                    $('#requestTelephone').val('');
                                    $('#requestEmail').val('');

                                    $('#makeARequestErrorList').html('');
                                    $('#makeARequestErrorList').addClass('d-none');

                                    $('#btnMakeRequest').text('Request Submitted! Your request tracking details have been mailed to you');
                                    $('#btnMakeRequest').removeClass('btn-primary');
                                    $('#btnMakeRequest').addClass('btn-success');

                                    setTimeout(function() {
                                        $('#btnMakeRequest').text('Submit Request');
                                        $('#btnMakeRequest').removeClass('btn-success');
                                        $('#btnMakeRequest').addClass('btn-primary');
                                    }, 5000);
                                }
                            }
                        });
                    });

                    //make donor request
                    $(document).on('click', '#btnMakeDonorRequest', function(e) {
                        e.preventDefault();

                        var donorRequestNo = $('#donorRequestNo').val();
                        var nic = $('#donorRequestNic').val();
                        var dateOfBirth = $('#donorRequestDateOfBirth').val();
                        var age = $('#donorRequestAge').val();
                        var fullName = $('#donorRequestFullName').val();
                        var telephone = $('#donorRequestTelephone').val();
                        var email = $('#donorRequestEmail').val();

                        var data = {
                            'donorRequestNo': donorRequestNo,
                            'nic': nic,
                            'dateOfBirth': dateOfBirth,
                            'age': age,
                            'fullName': fullName,
                            'telephone': telephone,
                            'email': email
                        }

                        var url = '{{ url("visitor/dashboard/makeDonorRequest") }}';

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                if (response.status == 400) {
                                    $('#donorRequestNo').val(Math.floor(Math.random() * (11500000000 -
                                        9950000000000 + 1) + 9950000000000));

                                    $('#becomeADonorErrorList').html('');
                                    $('#becomeADonorErrorList').removeClass('d-none');
                                    $.each(response.errors, function(key, err_value) {
                                        $('#becomeADonorErrorList').append('<li><strong>' +
                                            err_value + '</strong></li>');
                                    });
                                } else if (response.status == 200) {
                                    $('#becomeADonorErrorList').html('');
                                    $('#becomeADonorErrorList').addClass('d-none');

                                    $('#btnMakeDonorRequest').text('Donor Request Submitted!');
                                    $('#btnMakeDonorRequest').removeClass('btn-primary');
                                    $('#btnMakeDonorRequest').addClass('btn-success');

                                    $('#donorRequestNo').val(Math.floor(Math.random() * (11500000000 -
                                        9950000000000 + 1) + 9950000000000));
                                    $('#donorRequestNic').val('');
                                    $('#donorRequestDateOfBirth').val('');
                                    $('#donorRequestAge').val('');
                                    $('#donorRequestFullName').val('');
                                    $('#donorRequestTelephone').val('');
                                    $('#donorRequestEmail').val('');

                                    setTimeout(function() {
                                        $('#btnMakeDonorRequest').text('Submit Request');
                                        $('#btnMakeDonorRequest').removeClass('btn-success');
                                        $('#btnMakeDonorRequest').addClass('btn-primary');
                                    }, 3000);
                                }
                            }
                        });
                    });

                    //make inquiry
                    $(document).on('click', '#btnMakeInquiry', function(e) {
                        e.preventDefault();

                        var inquiryEmail = $('#inquiryEmail').val();
                        var inquirySubject = $('#inquirySubject').val();
                        var inquiryMessage = $('#inquiryMessage').val();

                        var data = {
                            'email': inquiryEmail,
                            'subject': inquirySubject,
                            'message': inquiryMessage
                        }

                        var url = '{{ url("visitor/dashboard/makeInquiry") }}';

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                if (response.status == 400) {
                                    $('#inquiryErrorList').html('');
                                    $('#inquiryErrorList').removeClass('d-none');
                                    $.each(response.errors, function(key, err_value) {
                                        $('#inquiryErrorList').append('<li><strong>' +
                                            err_value + '</strong></li>');
                                    });
                                } else if (response.status == 200) {
                                    $('#inquiryErrorList').html('');
                                    $('#inquiryErrorList').addClass('d-none');

                                    $('#btnMakeInquiry').text(
                                        'Inquiry Made. Your reply will come to your Email!');
                                    $('#btnMakeInquiry').removeClass('btn-primary');
                                    $('#btnMakeInquiry').addClass('btn-success');

                                    $('#inquiryEmail').val('');
                                    $('#inquirySubject').val('');
                                    $('#inquiryMessage').val('');

                                    setTimeout(function() {
                                        $('#btnMakeInquiry').text('Make Inquiry');
                                        $('#btnMakeInquiry').removeClass('btn-success');
                                        $('#btnMakeInquiry').addClass('btn-primary');
                                    }, 4000);
                                }
                            }
                        });
                    });

                    //track request
                    $(document).on('click', '#btnTrackRequest', function(e) {
                        e.preventDefault();

                        var id = $('#trackRequestNo').val();

                        var url = '{{ url("visitor/dashboard/trackBloodRequest/:id") }}';
                        url = url.replace(':id', id);

                        if(id == '')
                        {
                            $('#trackRequestErrorAlert').text('Please enter a valid request ID');
                        }
                        else
                        {
                            $.ajax({
                                type: "GET",
                                url: url,
                                dataType:"json",
                                success:function(response){

                                if (response.status == 400) 
                                {
                                    $('#trackRequestErrorAlert').text('Please enter a valid request ID');
                                } 
                                else 
                                {
                                        
                                    $.each(response.bloodrequests,function(key,item){
                                        $('#trackRequestErrorAlert').text('');
                                        $('#trackRequestDetails').removeClass('d-none');

                                        $('#trackNic').html('<b>NIC No. : </b>' + item.nic);
                                        $('#trackFullName').html('<b>Full Name : </b>' + item.fullName);
                                        $('#trackBloodGroup').html('<b>Requested Blood Group :</b> ' + item.bloodGroup);

                                        var getStatus = item.status;

                                        if (getStatus == 'pending')
                                        {
                                            $statusBadge = '<span class="badge bg-warning">Pending</span>';
                                        } 
                                        else if (getStatus == 'waiting') 
                                        {
                                            $statusBadge = '<span class="badge bg-warning">Waiting</span>';
                                        } 
                                        else if (getStatus == 'fulfilled')
                                        {
                                            $statusBadge = '<span class="badge bg-success">Fulfilled</span>';
                                        } 
                                        else if (getStatus == 'declined') 
                                        {
                                            $statusBadge = '<span class="badge bg-danger">Declined</span>';
                                        }

                                        $('#trackStatus').html('<b>Request Status : </b>' + $statusBadge);
                                        $('#trackFulfilledDate').html('<b>Fulfilled Date : </b>' + item.fulfilDate);
                                        $('#trackRemarks').text(item.remark);
                                    });
                                }
                                }
                            });
                        }
                    });

                });
            </script>

            @yield('content')
            @yield('scripts')

            <!-- content @e -->
            <!-- footer @s -->
            <div class="nk-footer bg-white">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright">Copyright © 2022 <b>LIFE SAVER</b>. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('assets/client/assets/js/bundle.js?ver=3.0.3') }}"></script>
    <script src="{{ asset('assets/client/assets/js/scripts.js?ver=3.0.3') }}"></script>
    <script src="{{ asset('assets/client/assets/js/charts/gd-invest.js?ver=3.0.3') }}"></script>
    <script src="{{asset('assets/print/printThis.js')}}"></script>
    
</body>

</html>
