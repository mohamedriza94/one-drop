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
    <title>ONE DROP</title>
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
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand">
                            <a href="html/index.html" class="logo-link d-flex align-items-center">
                                <img class="logo-light logo-img" src="{{ asset('assets/client/images/logo.png') }}"
                                    alt="logo">
                                <img class="logo-dark logo-img"
                                    src="{{ asset('assets/client/images/logo.png') }}"alt="logo-dark">
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-menu ms-auto" data-content="headerNav">
                            <div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a href="html/index.html" class="logo-link">
                                        <img class="logo-light logo-img" src="{{ asset('assets/client/images/logo.png') }}" alt="logo">
                                        <img class="logo-dark logo-img" src="{{ asset('assets/client/images/logo.png') }}" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-menu-trigger me-n2">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                </div>
                            </div>
                            <ul class="nk-menu nk-menu-main ui-s2">
                                <li class="nk-menu-item">
                                    <a href="{{ Route('donor.dashboard') }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item">
                                    <a href="{{ Route('donor.news') }}" class="nk-menu-link">
                                        <span class="nk-menu-text">News and Updates</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Request</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link"  data-bs-toggle="modal" data-bs-target="#makeRequestModal">
                                                <span class="nk-menu-text">Make a Request</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link"  data-bs-toggle="modal" data-bs-target="#trackRequestModal">
                                                <span class="nk-menu-text">Track Request</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link" id="btnRequestHistory" data-bs-toggle="modal" data-bs-target="#requestHistoryModal">
                                                <span class="nk-menu-text">Request History</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->

                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Donation</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link text-primary"  data-bs-toggle="modal" data-bs-target="#makeRequestModal">
                                                <span class="nk-menu-text">Make an Appointment</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link"  data-bs-toggle="modal" data-bs-target="#trackRequestModal">
                                                <span class="nk-menu-text">Tracking</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link"  data-bs-toggle="modal" data-bs-target="#trackRequestModal">
                                                <span class="nk-menu-text">Donation History</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->

                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-header-menu -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown chats-dropdown">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                        <div class="icon-status icon-status-na"><em class="icon ni ni-bell"></em></div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                        <div class="dropdown-head">
                                            <span class="sub-title nk-dropdown-title">Notifications</span>
                                        </div>
                                        <div class="dropdown-body">
                                            <ul class="">
                                                <li class="">
                                                    <a class="chat-link" href="#">
                                                        <div class="">
                                                            <div class="chat-from">
                                                                <div class="name">Iliash Hossain</div>
                                                                <span class="time">12.12.12</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">You: Please confrim if you got my last messages.</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="">
                                                    <a class="chat-link" href="#">
                                                        <div class="">
                                                            <div class="chat-from">
                                                                <div class="name">Iliash Hossain</div>
                                                                <span class="time">12.12.12</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">You: Please confrim if you got my last messages.</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                            </ul><!-- .chat-list -->
                                        </div><!-- .nk-dropdown-body -->
                                    </div>
                                </li>
                                
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                @if (Auth::guard('donor')->user()->photo != "")
                                                    <img src="{{ Auth::guard('donor')->user()->photo }}" alt="">    
                                                @endif
                                                
                                                @if (Auth::guard('donor')->user()->photo == "")
                                                <em class="icon ni ni-user-alt"></em>  
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                @if (Auth::guard('donor')->user()->photo != "")
                                                    <img src="{{ Auth::guard('donor')->user()->photo }}" alt="">    
                                                @endif
                                                
                                                @if (Auth::guard('donor')->user()->photo == "")
                                                <em class="icon ni ni-user-alt"></em>  
                                                @endif
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ Auth::guard('donor')->user()->fullname }}</span>
                                                    <span class="sub-text">{{ Auth::guard('donor')->user()->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Change Password</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="{{ route('donor.logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <em class="icon ni ni-signout"></em><span>Logout</span>
                                                </a></li>
                                                <form id="logout-form" action="{{ route('donor.logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .dropdown -->
                            </ul><!-- .nk-quick-nav -->
                        </div><!-- .nk-header-tools -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->
            <!-- content @s -->

            @yield('content')
            @yield('scripts')
            
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
                                                name="requestNic" readonly value="{{ Auth::guard('donor')->user()->nic }}">
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
                                            <input type="text" class="form-control" readonly id="requestFullName"
                                                name="requestFullName" value="{{ Auth::guard('donor')->user()->fullname }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Telephone</label>
                                            <input type="text" class="form-control" readonly id="requestTelephone"
                                                name="requestTelephone" value="{{ Auth::guard('donor')->user()->telephone }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Email</label>
                                            <input type="email" class="form-control" readonly id="requestEmail"
                                                name="requestEmail" value="{{ Auth::guard('donor')->user()->email }}">
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

            <div class="modal fade" tabindex="-1" role="dialog" id="requestHistoryModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <a href="#" class="close" data-bs-dismiss="modal"><em
                                class="icon ni ni-cross-sm"></em></a>
                        <div class="modal-body modal-body-md">
                            <div class="mt-2">

                                <h5 class="modal-title">Request History</h5>
                                <hr style="padding: 0.5px; background:black">

                                <div class="row g-gs">
                                    <input type="hidden" id="authId" value="{{ Auth::guard('donor')->user()->nic }}">
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <thead class="table-light">
                                              <tr>
                                                <th scope="col">Request No.</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Status</th>
                                              </tr>
                                            </thead>
                                            <tbody id="requestHistoryTbody">

                                            </tbody>
                                          </table>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                </div>
                            </div>
                        </div><!-- .modal-body -->
                    </div><!-- .modal-content -->
                </div><!-- .modal-dialog -->
            </div><!-- requestHistoryModal modal -->

            <script>
                $(document).ready(function() {
                    
                    fetchRequestHistory();
                    $('#requestNo').val(Math.floor(Math.random() * (11500000000 - 9950000000000 + 1) + 9950000000000));
                  
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

                    //request history
                    $(document).on('click', '#btnRequestHistory', function(e) {
                        e.preventDefault();
                        
                        fetchRequestHistory();
                    });

                    function fetchRequestHistory()
                    {
                        var nic = $('#authId').val();

                        var url = '{{ url("donor/dashboard/fetchRequestHistory/:nic") }}';
                        url = url.replace(':nic', nic);

                        $.ajax({
                            type: "GET",
                            url: url,
                            dataType:"json",
                            success:function(response){
                                $('#requestHistoryTbody').html('');
                                $.each(response.bloodrequests,function(key,item){

                                    var requestHistoryStatus = item.status;

                                    if(requestHistoryStatus == "pending")
                                    {
                                        $requestHistoryStatusBadge = '<span class="badge bg-warning">Pending</span>';
                                    }
                                    else if(requestHistoryStatus == "fulfilled")
                                    {
                                        $requestHistoryStatusBadge = '<span class="badge bg-success">Fulfilled</span>';
                                    }
                                    else if(requestHistoryStatus == "waiting")
                                    {
                                        $requestHistoryStatusBadge = '<span class="badge bg-warning">Waiting</span>';
                                    }
                                    else if(requestHistoryStatus == "declined")
                                    {
                                        $requestHistoryStatusBadge = '<span class="badge bg-danger">Declined</span>';
                                    }

                                    $('#requestHistoryTbody').append('<tr>\
                                        <td><b>'+item.requestNo+'</b></td>\
                                        <td>'+item.date+'</td>\
                                        <td>'+item.time+'</td>\
                                        <td>'+$requestHistoryStatusBadge+'</td>\
                                    </tr>\
                                    ');
                                });
                            }
                        });
                    };
                });
            </script>

            <!-- content @e -->
            <!-- footer @s -->
            <div class="nk-footer bg-white">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright">Copyright © 2022 <b>One Drop</b>. All rights reserved.
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
    
</body>

</html>