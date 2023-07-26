<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LIFE SAVER</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/admin/src/assets/img/.ico')}}"/>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="{{asset('assets/admin/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/layouts/collapsible-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/layouts/collapsible-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('assets/admin/src/plugins/src/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/admin/src/assets/css/light/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/dark/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/light/components/modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/dark/components/modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/src/assets/css/light/elements/alert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/src/assets/css/dark/elements/alert.css')}}">
    <link href="{{asset('assets/admin/src/assets/css/dark/components/timeline.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/light/components/timeline.css')}}" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    
</head>
<body class="layout-boxed alt-menu">
    
    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">
            
            <ul class="navbar-item flex-row ms-lg-auto">
                
                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" 
                    id="notificationDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                </a>
                
                <div class="dropdown-menu position-absolute">
                    <div class="notification-scroll" id="notificationList">
                        
                        
                    </div>
                </div>
                
            </li>
            
            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <strong>
                        <p>Check Details</p>
                    </strong>
                </a>
                
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <div class="media-body">
                                <h5>{{ Auth::guard('hospital')->user()->no }}</h5>
                                <p>{{ Auth::guard('hospital')->user()->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="#"  data-bs-toggle="modal" data-bs-target="#hospitalDetails">
                            <i class="fa-solid fa-user" style="width:30px;"></i>
                            <span>View Details</span>
                        </a>
                    </div>
                    
                    <div class="dropdown-item">
                        <a id="logoutButton" href="{{ route('hospital.logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket" style="width:30px;"></i>
                        <span>Log Out</span>
                    </a>
                    
                    <form id="logout-form" 
                    action="{{ route('hospital.logout') }}" 
                    method="POST" class="d-none">
                    @csrf
                </form>
                
            </div>
        </div>
    </li>
</ul>
</header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container sidebar-closed sidebar-closed" id="container">
    
    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">
        
        <nav id="sidebar">
            
            <div class="navbar-nav theme-brand flex-row  text-center">
                <div class="nav-logo">
                    <div class="nav-item theme-logo">
                        <a href="{{ route('hospital.dashboard') }}">
                            <img src="{{asset('assets/admin/src/assets/img/logo.png')}}" class="navbar-logo" alt="logo">
                        </a>
                    </div>
                    <div class="nav-item theme-text">
                        <a href="{{ route('hospital.dashboard') }}" class="nav-link"> LIFE SAVER </a>
                    </div>
                </div>
            </div>
            <div class="shadow-bottom"></div>
            <ul class="list-unstyled menu-categories" id="accordionExample">
                
                <li class="menu {{ (\Request::route()->getName() == 'hospital.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('hospital.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-home" style="width:50px; height:100%;"></i>Home</span>
                        </div>
                    </a>
                </li>
                
                
                <li class="menu {{ (\Request::route()->getName() == 'hospital.message') ? 'active' : '' }}">
                    <a href="{{ route('hospital.message') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-envelope" style="width:50px; height:100%;"></i>Messages</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'hospital.bloodBag') ? 'active' : '' }}">
                    <a href="{{ route('hospital.bloodBag') }}" aria-expanded="false" class="dropdown-toggle d-flex align-items-baseline">
                        <div class="">
                            <span><i class="fa-solid fa-droplet" style="width:50px; height:100%;"></i>Blood Bank</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu">
                    <a href="#donations" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-user" style="width:50px; height:100%;"></i>Donations</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="donations" data-bs-parent="#accordionExample">
                        <li>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#donorRegistrationModal"> Donor Registration </a>
                        </li>
                        <li class="{{ (\Request::route()->getName() == 'hospital.donor') ? 'active' : '' }}">
                            
                            <a href="{{ route('hospital.donor') }}"> Donors </a>
                        </li>
                        
                        <li class="{{ (\Request::route()->getName() == 'hospital.bloodRequest') ? 'active' : '' }}">
                            
                            <a href="{{ route('hospital.bloodRequest') }}"> Blood Requests </a>
                        </li>                          
                        
                        <li class="{{ (\Request::route()->getName() == 'hospital.donation') ? 'active' : '' }}">
                            
                            <a href="{{ route('hospital.donation') }}"> Donations </a>
                        </li>                          
                        
                        <li class="{{ (\Request::route()->getName() == 'hospital.donate') ? 'active' : '' }}">
                            
                            <a href="{{ route('hospital.donate') }}"> Donate </a>
                        </li>                         
                    </ul>
                </li>
                
                <hr>
                
                <li class="menu {{ (\Request::route()->getName() == 'hospital.tracking') ? 'active' : '' }}">
                    <a href="{{ route('hospital.tracking') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-chalkboard" style="width:50px; height:100%;"></i>Tracking</span>
                        </div>
                    </a>
                </li>
            </ul>
            
        </nav>
        
    </div>
    <!--  END SIDEBAR  -->
    
    @yield('content')
    @yield('scripts')
    
    <!-- View Details Modal -->
    <div class="modal fade bd-example-modal-xl" id="hospitalDetails" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hospital Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label"><strong>Hospital No.:</strong>&nbsp; {{ Auth::guard('hospital')->user()->no }}</label>
                        </div>
                        <hr class="p4">
                        <div class="col-md-12">
                            <label class="form-label"><strong>Name:</strong>&nbsp; {{ Auth::guard('hospital')->user()->name }}</label>
                        </div>
                        <hr class="p4">
                        <div class="col-md-12">
                            <label class="form-label"><strong>Landline:</strong>&nbsp; {{ Auth::guard('hospital')->user()->landline }}</label>
                        </div>
                        <hr class="p4">
                        <div class="col-md-12">
                            <label class="form-label"><strong>Address:</strong>&nbsp; {{ Auth::guard('hospital')->user()->address }}</label>
                        </div>
                        <hr class="p4">
                        <div class="col-md-12">
                            <label class="form-label"><strong>Description:</strong>&nbsp; {{ Auth::guard('hospital')->user()->description }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Donor Registration Modal -->
    <div class="modal fade bd-example-modal-xl" id="donorRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Donor Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <ul id="errorList" class="list-unstyled bg-danger form-control d-none">
                    </ul>
                    
                    <form method="POST" id="donorRegistrationForm" enctype="multipart/form-data">
                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <label class="form-label" for="">Hospital</label>
                                <input type="text" class="form-control" readonly value="{{ Auth::guard('hospital')->user()->name }}">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Donor No.</label>
                                <input type="text" class="form-control" readonly id="regDonorNo" name="no">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">NIC</label>
                                <input type="text" class="form-control" id="regDonornic" name="nic">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Date of Birth</label>
                                <input type="date" class="form-control" id="regDonordateofbirth" name="dateofbirth">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Age</label>
                                <input type="text" class="form-control" id="regDonorage" name="age">
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Gender</label>
                                <select class="form-control" id="regDonorgender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label" for="">Blood Group</label>
                                <select name="bloodGroup" id="bloodGroup" class="form-control">
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
                            
                            <div class="col-md-12">
                                <label class="form-label" for="">Full Name</label>
                                <input type="text" class="form-control" id="regDonorfullName" name="fullname">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label" for="">Address</label>
                                <textarea class="form-control" rows="3" id="regDonoraddress" name="address"></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label" for="">Photo</label>
                                <input type="file" class="form-control" id="regDonorphoto" name="photo">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="">Telephone</label>
                                <input type="text" class="form-control" id="regDonortelephone" name="telephone">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="">Email</label>
                                <input type="email" class="form-control" id="regDonoremail" name="email">
                            </div>
                            
                            <div class="col-md-12" id="rescheduleButtonContainer">
                                <button class="btn btn-primary form-control center" type="submit"
                                id="btnRegister">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    <script>
        
        $(document).ready(function(){
            
            $('#regDonorNo').val(Math.floor(Math.random() * (11500000 - 99500000 + 1) + 99500000));
            
            //csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            //notification start
            setInterval(function(){
                fetchNotifications();
            }, 1000);
            
            function fetchNotifications()
            {
                $.ajax({
                    type: "GET",
                    url: '{{ url("hospital/dashboard/fetchNotifications") }}',
                    dataType:"json",
                    success:function(response){
                        
                        $('#notificationList').html('');
                        
                        $.each(response.notifications,function(key,item){
                            
                            var notifTime = item.time;
                            var notifTime = notifTime.slice(10,19);
                            
                            var notifDate = item.date;
                            var notifDate = notifDate.slice(0,10);
                            
                            $link = item.link;
                            
                            if(item.status == "0")
                            {
                                $('#notificationDropdown').html('<svg xmlns="http://www.w3.org/2000/svg"\
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"\
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"\
                                class="feather feather-bell">\
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>\
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>\
                                <span class="badge badge-success"></span>');
                                
                                $('#notificationList').append('<div class="dropdown-item">\
                                    <a href="'+$link+'"><button class="btn btn-outline-none" id="notifButton" value="'+item.id+'">\
                                        <div class="media server-log">\
                                            <div class="media-body">\
                                                <div class="data-info">\
                                                    <h6 style="text-align: left;">'+item.text+'</h6>\
                                                    <p style="text-align: left;">'+notifDate+' &nbsp;&nbsp;'+notifTime+'</p>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </button></a>\
                                </div>\
                                ');
                            }
                            else
                            {
                                $('#notificationDropdown').html('');
                            }
                        });
                    }
                });
            }
            
            $(document).on('click', '#notifButton', function(e) {
                
                var notificationId = $(this).val();
                
                var url = '{{ url("hospital/dashboard/notifUpdate") }}';
                
                var data = {
                    'id' : notificationId
                }
                
                $.ajax({
                    type:"PUT",
                    url:url,
                    data:data,
                    dataType:"json",
                    success:function(response){
                    }
                });
                
            });
            //notification end
            
            //insert data
            $(document).on('submit','#donorRegistrationForm',function(e){
                e.preventDefault();
                
                let registerFormData = new FormData($('#donorRegistrationForm')[0]);
                
                $('#btnRegister').text('Registering....');
                
                $.ajax({
                    type: "POST",
                    url: "{{ url('hospital/dashboard/registerDonor') }}",
                    data: registerFormData,
                    contentType:false,
                    processData:false,
                    success: function(response) {
                        if(response.status==400)
                        {
                            $('#errorList').html('');
                            $('#errorList').removeClass('d-none');
                            
                            $.each(response.errors,function(key,err_value){
                                $('#errorList').append('<li><strong>'+err_value+'</strong></li>');
                            });
                            
                            $('#btnRegister').removeClass('btn-success');
                            $('#btnRegister').addClass('btn-primary');
                            $('#btnRegister').text('Register');
                        }
                        else if(response.status==200)
                        {
                            $('#errorList').html('');
                            $('#errorList').addClass('d-none');
                            
                            $('#btnRegister').removeClass('btn-primary');
                            $('#btnRegister').addClass('btn-success');
                            $('#btnRegister').text('Registered and Mailed credentials to donor!');
                            
                            $('#regDonorNo').val(Math.floor(Math.random() * (11500000 - 99500000 + 1) + 99500000));
                            
                            setTimeout(function(){
                                $('#btnRegister').removeClass('btn-success');
                                $('#btnRegister').addClass('btn-primary');
                                $('#btnRegister').text('Register');
                            }, 3000);
                        }
                    }
                });
            });
            
        });
        
    </script>
    
    
    
    
    
    
    
    
    
    
    <!--  BEGIN FOOTER  -->
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © <span class="dynamic-year">2022</span> <a href="">LIFE SAVER</a>, All rights reserved.</p>
        </div>
    </div>
    <!--  END FOOTER  -->
</div>
<!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/admin/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/admin/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/admin/src/plugins/src/mousetrap/mousetrap.min.js')}}"></script>
<script src="{{asset('assets/admin/layouts/collapsible-menu/app.js')}}"></script>
<script src="{{asset('assets/admin/src/plugins/src/global/vendors.min.js')}}"></script>
<script src="{{asset('assets/admin/src/plugins/src/highlight/highlight.pack.js')}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->

<script src="{{asset('assets/admin/src/assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('assets/admin/src/plugins/src/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/admin/src/assets/js/dashboard/dash_1.js')}}"></script>

<script src="{{asset('assets/admin/src/assets/js/apps/blog-create.js')}}"></script>
<script src="{{asset('assets/admin/src/assets/js/scrollspyNav.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->





