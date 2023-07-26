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
    <link href="{{asset('assets/admin/src/assets/css/light/apps/invoice-preview.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/src/assets/css/dark/apps/invoice-preview.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    
</head>
<body class="layout-boxed alt-menu">
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    @if (Auth::user()->role=='admin')
    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">
            
            <ul class="navbar-item flex-row ms-lg-auto ms-0">
                
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
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar-container">
                        <div class="avatar avatar-sm avatar-indicators avatar-online">
                            <img alt="avatar" src="" class="rounded-circle" id="profilePhotoHeader">
                        </div>
                    </div>
                </a>
                
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <div class="emoji me-2">
                                <img alt="avatar" src="" 
                                class="rounded-circle" id="profilePhotoDropDown">
                            </div>
                            <div class="media-body">
                                <h5>{{ Auth::guard('admin')->user()->fullname }}</h5>
                                <p>{{ Auth::guard('admin')->user()->role }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="#"  data-bs-toggle="modal" data-bs-target="#editAccount">
                            <i class="fa-solid fa-user" style="width:30px;"></i>
                            <span>Profile</span>
                        </a>
                    </div>
                    
                    <div class="dropdown-item">
                        <a href="#"  data-bs-toggle="modal" data-bs-target="#changePassword">
                            <i class="fa-solid fa-key" style="width:30px;"></i>
                            <span>Change Password</span>
                        </a>
                    </div>
                    
                    <div class="dropdown-item">
                        <a id="logoutButton" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket" style="width:30px;"></i>
                        <span>Log Out</span>
                    </a>
                    
                    <form id="logout-form" 
                    action="{{ route('admin.logout') }}" 
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
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{asset('assets/admin/src/assets/img/logo.png')}}" class="navbar-logo" alt="logo">
                        </a>
                    </div>
                    <div class="nav-item theme-text">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link"> LIFE SAVER </a>
                    </div>
                </div>
            </div>
            <div class="shadow-bottom"></div>
            <ul class="list-unstyled menu-categories" id="accordionExample">
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-home" style="width:50px; height:100%;"></i>Home</span>
                        </div>
                    </a>
                </li>
                
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.staffMessage') ? 'active' : '' }}">
                    <a href="{{ route('admin.staffMessage') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-envelope" style="width:50px; height:100%;"></i>Staff Messages</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.staff') ? 'active' : '' }}">
                    <a href="{{ route('admin.staff') }}" aria-expanded="false" class="dropdown-toggle d-flex align-items-baseline">
                        <div class="">    
                            <span><i class="fa-solid fa-users" style="width:50px; height:100%;"></i>Staff</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.hospital') ? 'active' : '' }}">
                    <a href="{{ route('admin.hospital') }}" aria-expanded="false" class="dropdown-toggle d-flex align-items-baseline">
                        <div class="">    
                            <span><i class="fa-solid fa-hospital" style="width:50px; height:100%;"></i>Hospitals</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.activity') ? 'active' : '' }}">
                    <a href="{{ route('admin.activity') }}" aria-expanded="false" class="dropdown-toggle d-flex align-items-baseline">
                        <div class="">  
                            <span><i class="fa-solid fa-list-check" style="width:50px; height:100%;"></i>Activities</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.news') ? 'active' : '' }}">
                    <a href="{{ route('admin.news') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-newspaper" style="width:50px; height:100%;"></i>News</span>
                        </div>
                    </a>
                </li>
            </ul>
            
        </nav>
        
    </div>
    <!--  END SIDEBAR  -->
    
    @yield('content')
    @yield('scripts')
    
    <!-- Edit profile Modal -->
    <div class="modal fade bd-example-modal-xl" id="editAccount" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Account Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <ul class="bg-warning form-control d-none" id="profileValidationUL"></ul>
                    
                    <form id="changeProfilePhotoForm" class="row g-3 mb-4" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" class="form-control" id="changeProfilePhoto_id" name="changeProfilePhoto_id" value="{{ Auth::guard('admin')->user()->id }}">
                        
                        <div class="col-md-3">
                            <img class="form-control" src="{{ Auth::guard('admin')->user()->photo }}" style="height:150px; width:150px; object-fit: contain;" id="view_photo">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Change Profile Photo</label>
                            <input type="file" readonly class="form-control" id="photo" name="photo">
                            <label class="form-label d-none" style="color:red" id="errorLabel">*Photo is missing</label>
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label" style="color:transparent">.</label>
                            <button class="btn btn-dark form-control btn-lg" type="submit" id="btn_change">Change</button>
                        </div>
                        
                    </form>
                    
                    <hr>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">NIC No.</label>
                            <input type="text" style="color:black" class="form-control" id="profileNicNo" value="{{ Auth::guard('admin')->user()->nic }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Role</label>
                            <input type="text" style="color:black" readonly class="form-control" id="profileRole" value="{{ Auth::guard('admin')->user()->role }}">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Full Name</label>
                            <input type="text" style="color:black" class="form-control" id="profileFullname" value="{{ Auth::guard('admin')->user()->fullname }}">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <textarea type="text" style="color:black" class="form-control" id="profileAddress" >{{ Auth::guard('admin')->user()->address }}</textarea>
                        </div>
                        
                        
                        <div class="col-md-4">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" style="color:black" class="form-control" id="profileDateOfBirth" value="{{ Auth::guard('admin')->user()->dateofbirth }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select class="form-control" id="profileGender">
                                <option value="{{ Auth::guard('admin')->user()->gender }}">{{ Auth::guard('admin')->user()->gender }}</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Telephone</label>
                            <input type="text" style="color:black" class="form-control" id="profileTelephone" value="{{ Auth::guard('admin')->user()->telephone }}">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Email</label>
                            <input type="email" style="color:black" class="form-control" id="profileEmail" name="" value="{{ Auth::guard('admin')->user()->email }}">
                        </div>
                        
                        <div class="col-md-12">
                            <button class="btn btn-primary form-control" id="btnSaveProfile" value="{{ Auth::guard('admin')->user()->id }}">Save</button>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Change password Modal -->
    <div class="modal fade bd-example-modal-xl" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <ul id="passwordValidation" class="list-unstyled bg-danger form-control d-none">
                    </ul>
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="" value="">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmNewPassword" name="" value="">
                        </div>
                        
                        <div class="col-md-12">
                            <button class="btn btn-primary form-control" id="btn_changePassword" value="{{ Auth::guard('admin')->user()->id }}">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    
    
    
    
    
    @if (Auth::user()->role=='staff')
    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">
            
            <ul class="navbar-item flex-row ms-lg-auto ms-0">

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
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="" class="rounded-circle" id="profilePhotoHeader">
                            </div>
                        </div>
                    </a>

                    
                    
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="emoji me-2">
                                    <img alt="avatar" src="" 
                                    class="rounded-circle" id="profilePhotoDropDown">
                                </div>
                                <div class="media-body">
                                    <h5>{{ Auth::guard('admin')->user()->fullname }}</h5>
                                    <p>{{ Auth::guard('admin')->user()->role }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#account">
                                <i class="fa-solid fa-user" style="width:30px;"></i>
                                <span>Profile</span>
                            </a>
                        </div>
                        
                        <div class="dropdown-item">
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#changePassword">
                                <i class="fa-solid fa-key" style="width:30px;"></i>
                                <span>Change Password</span>
                            </a>
                        </div>
                        
                        <div class="dropdown-item">
                            <a id="logoutButton" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket" style="width:30px;"></i>
                            <span>Log Out</span>
                        </a>
                        
                        <form id="logout-form" 
                        action="{{ route('admin.logout') }}" 
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
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{asset('assets/admin/src/assets/img/logo.png')}}" class="navbar-logo" alt="logo">
                        </a>
                    </div>
                    <div class="nav-item theme-text">
                        <a href="" class="nav-link"> LIFE SAVER </a>
                    </div>
                </div>
            </div>
            <div class="shadow-bottom"></div>
            <ul class="list-unstyled menu-categories" id="accordionExample">
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-home" style="width:50px; height:100%;"></i>Home</span>
                        </div>
                    </a>
                </li>
                
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.staffControls.message') ? 'active' : '' }}">
                    <a href="{{ route('admin.staffControls.message') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                             
                            <span><i class="fa-solid fa-envelope" style="width:50px; height:100%;"></i>Messages</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.staffControls.bloodBag') ? 'active' : '' }}">
                    <a href="{{ route('admin.staffControls.bloodBag') }}" aria-expanded="false" class="dropdown-toggle d-flex align-items-baseline">
                        <div class="">
                                
                            <span><i class="fa-solid fa-droplet" style="width:50px; height:100%;"></i>Blood Bags</span>
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
                        <li class="{{ (\Request::route()->getName() == 'admin.staffControls.appointments') ? 'active' : '' }}">
                            <a href="{{ route('admin.staffControls.appointments') }}"> Appointments </a>
                        </li>
                        <li class="{{ (\Request::route()->getName() == 'admin.staffControls.donorRequest') ? 'active' : '' }}">
                            <a href="{{ route('admin.staffControls.donorRequest') }}"> Donor Requests </a>
                        </li>
                        <li class="{{ (\Request::route()->getName() == 'admin.staffControls.donor') ? 'active' : '' }}">
                            <a href="{{ route('admin.staffControls.donor') }}"> Donors </a>
                        </li>
                        <li class="{{ (\Request::route()->getName() == 'admin.staffControls.bloodRequest') ? 'active' : '' }}">
                            <a href="{{ route('admin.staffControls.bloodRequest') }}"> Blood Requests </a>
                        </li>                          
                        <li class="{{ (\Request::route()->getName() == 'admin.staffControls.donation') ? 'active' : '' }}">
                            <a href="{{ route('admin.staffControls.donation') }}"> Donations </a>
                        </li>                          
                        <li class="{{ (\Request::route()->getName() == 'admin.staffControls.donate') ? 'active' : '' }}">
                            <a href="{{ route('admin.staffControls.donate') }}"> Donate </a>
                        </li>                         
                    </ul>
                </li>
                
                <hr>

                <li class="menu {{ (\Request::route()->getName() == 'admin.staffControls.campaign') ? 'active' : '' }}">
                    <a href="{{ route('admin.staffControls.campaign') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-book" style="width:50px; height:100%;"></i>Campaign</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.staffControls.news') ? 'active' : '' }}">
                    <a href="{{ route('admin.staffControls.news') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-newspaper" style="width:50px; height:100%;"></i>News</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.invoice') ? 'active' : '' }}">
                    <a href="{{ route('admin.invoice') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <span><i class="fa-solid fa-receipt" style="width:50px; height:100%;"></i>Invoice</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu {{ (\Request::route()->getName() == 'admin.staffControls.tracking') ? 'active' : '' }}">
                    <a href="{{ route('admin.staffControls.tracking') }}" aria-expanded="false" class="dropdown-toggle">
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
    
    <!-- Edit profile Modal -->
    <div class="modal fade bd-example-modal-xl" id="account" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <ul class="bg-warning form-control d-none" id="profileValidationUL"></ul>
                    
                    <form id="changeProfilePhotoForm" class="row g-3 mb-4" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" class="form-control" id="changeProfilePhoto_id" name="changeProfilePhoto_id" value="{{ Auth::guard('admin')->user()->id }}">
                        
                        <div class="col-md-12">
                            <img class="form-control" src="{{ Auth::guard('admin')->user()->photo }}" style="height:180px; width:150px; object-fit: contain;" id="view_photo">
                        </div>
                        
                    </form>
                    
                    <hr>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">NIC No.</label>
                            <input type="text" style="color:black" readonly class="form-control" id="profileNicNo" value="{{ Auth::guard('admin')->user()->nic }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Role</label>
                            <input type="text" style="color:black" readonly class="form-control" id="profileRole" value="{{ Auth::guard('admin')->user()->role }}">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Full Name</label>
                            <input type="text" style="color:black" readonly class="form-control" id="profileFullname" value="{{ Auth::guard('admin')->user()->fullname }}">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <textarea type="text" style="color:black" readonly class="form-control" id="profileAddress" >{{ Auth::guard('admin')->user()->address }}</textarea>
                        </div>
                        
                        
                        <div class="col-md-4">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" style="color:black" readonly class="form-control" id="profileDateOfBirth" value="{{ Auth::guard('admin')->user()->dateofbirth }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <input type="text" style="color:black" readonly class="form-control" id="profileGender" value="{{ Auth::guard('admin')->user()->gender }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Telephone</label>
                            <input type="text" style="color:black" readonly class="form-control" id="profileTelephone" value="{{ Auth::guard('admin')->user()->telephone }}">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Email</label>
                            <input type="email" style="color:black" readonly class="form-control" id="profileEmail" name="" value="{{ Auth::guard('admin')->user()->email }}">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Assigned Hospital</label>
                            <input type="email" style="color:white" readonly class="form-control bg-primary" id="profileAssignedHospital" name="" >
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Change password Modal -->
    <div class="modal fade bd-example-modal-xl" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <ul id="passwordValidation" class="list-unstyled bg-danger form-control d-none">
                    </ul>
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="" value="">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmNewPassword" name="" value="">
                        </div>
                        
                        <div class="col-md-12">
                            <button class="btn btn-primary form-control" id="btn_changePassword" value="{{ Auth::guard('admin')->user()->id }}">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
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
<script src="{{asset('assets/admin/src/assets/js/apps/invoice-preview.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('assets/print/printThis.js')}}"></script>

<script>
    $(document).ready(function(){
        
        //load profile details function
        fetchProfile();
        
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
                url: '{{ url("admin/dashboard/fetchNotifications") }}',
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
            
            var url = '{{ url("admin/dashboard/notifUpdate") }}';
            
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
        
        //update profile photo
        $(document).on('submit','#changeProfilePhotoForm',function(e){
            e.preventDefault();
            
            $('#btn_change').text('wait...');
            
            var id = $('#changeProfilePhoto_id').val();
            let changeProfilePhotoFormData = new FormData($('#changeProfilePhotoForm')[0]);
            
            var url = '{{ url("admin/dashboard/changeProfilePhoto/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type: "POST",
                url: url,
                data: changeProfilePhotoFormData,
                contentType:false,
                processData:false,
                success: function(response){
                    if(response.status==400)
                    {
                        $('#errorLabel').removeClass('d-none');
                        $('#btn_change').text('Change');
                    }
                    else if(response.status==200)
                    {
                        $('#errorLabel').addClass('d-none');
                        $('#btn_change').removeClass('btn-dark');
                        $('#btn_change').addClass('btn-success');
                        $('#btn_change').text('Done');
                        $('#photo').val('');
                        
                        fetchProfile();
                        
                        setTimeout(function(){
                            $('#btn_change').removeClass('btn-success');
                            $('#btn_change').addClass('btn-dark');
                            $('#btn_change').text('Change');
                        }, 3000);
                    }
                    else if(response.status==404)
                    {
                        alert('ID Not Found');
                        $('#btn_change').text('Change');
                    }
                }
            });
        });
        
        //fetch profile data
        function fetchProfile(){
            var id = $('#changeProfilePhoto_id').val();
            
            var url = '{{ url("admin/dashboard/fetchProfile/:id") }}';
            url = url.replace(':id', id);
            
            $.ajax({
                type:"GET", 
                url:url,
                success: function (response){
                    if(response.status==404){
                        alert('ID Not Found');
                    }else{
                        $('#profileNicNo').val(response.admins.nic);
                        $('#profileFullname').val(response.admins.fullname);
                        $('#profileAddress').val(response.admins.address);
                        $('#profileDateOfBirth').val(response.admins.dateofbirth);
                        $('#profileGender').val(response.admins.gender);
                        $('#profileTelephone').val(response.admins.telephone);
                        $('#profileEmail').val(response.admins.email);
                        $('#view_photo').attr("src",response.admins.photo);
                        $('#profilePhotoHeader').attr("src",response.admins.photo);
                        $('#profilePhotoDropDown').attr("src",response.admins.photo);
                        $('#profileAssignedHospital').val(response.assignedHospital.name);
                    }
                }
            });
        };
        
        //update profile details
        $(document).on('click', '#btnSaveProfile',function(e){
            e.preventDefault();
            
            var id = $(this).val();
            var no = $('#profileNo').val();
            var nicNo = $('#profileNicNo').val();
            var fullname = $('#profileFullname').val();
            var address = $('#profileAddress').val();
            var dateOfBirth = $('#profileDateOfBirth').val();
            var email = $('#profileEmail').val();
            var telephone = $('#profileTelephone').val();
            var gender = $('#profileGender').val();
            
            var data = {
                'nicNo' : nicNo,
                'fullname' : fullname,
                'address' : address,
                'dateOfBirth' : dateOfBirth,
                'email' : email,
                'telephone' : telephone,
                'gender' : gender
            }
            
            var url = '{{ url("admin/dashboard/updateProfile/:id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type:"PUT",
                url: url,
                data:data,
                dataType:"json",
                success: function(response){
                    if(response.status==400)
                    {
                        $('#btnSaveProfile').text('Save');
                        $('#btnSaveProfile').removeClass('btn-success');
                        $('#btnSaveProfile').addClass('btn-primary');
                        
                        $('#profileValidationUL').html('');
                        $('#profileValidationUL').removeClass('d-none');
                        $.each(response.errors,function(key,err_value){
                            $('#profileValidationUL').append('<li>'+err_value+'</li>');
                        });
                    }
                    else if(response.status==200)
                    {
                        $('#profileValidationUL').html('');
                        $('#btnSaveProfile').text('Saved');
                        $('#btnSaveProfile').removeClass('btn-primary');
                        $('#btnSaveProfile').addClass('btn-success');
                        
                        fetchProfile();
                        
                        setTimeout(function(){
                            $('#btnSaveProfile').text('Save');
                            $('#btnSaveProfile').removeClass('btn-success');
                            $('#btnSaveProfile').addClass('btn-primary');
                        }, 3000);
                    }
                    else if(response.status==404)
                    {
                        alert('Profile Not Found');
                    }
                }
            });
        });
        
        //change password
        $(document).on('click', '#btn_changePassword',function(e){
            e.preventDefault();
            var id = $(this).val();
            var newPassword = $('#newPassword').val();
            var confirmNewPassword = $('#confirmNewPassword').val();
            var data = {
                'password' : newPassword
            }
            
            if(confirmNewPassword==newPassword)
            {
                var url = '{{ url("admin/dashboard/changePassword/:id") }}';
                url = url.replace(':id', id);
                
                $.ajax({
                    type:"PUT",
                    url: url,
                    data:data,
                    dataType:"json",
                    success: function(response){
                        if(response.status==400)
                        {
                            
                            $('#btn_changePassword').text('Save');
                            $('#c').removeClass('btn-success');
                            $('#btn_changePassword').addClass('btn-primary');
                            
                            $('#passwordValidation').html('');
                            $('#passwordValidation').removeClass('d-none');
                            $.each(response.errors,function(key,err_value){
                                $('#passwordValidation').append('<li>'+err_value+'</li>');
                            });
                        }
                        else if(response.status==200)
                        {
                            $('#passwordValidation').html('');
                            $('#btn_changePassword').text('Changed');
                            $('#btn_changePassword').removeClass('btn-primary');
                            $('#btn_changePassword').addClass('btn-success');
                            $('#passwordValidation').addClass('d-none');
                            
                            setTimeout(function(){
                                $('#btn_changePassword').text('Save');
                                $('#btn_changePassword').removeClass('btn-success');
                                $('#btn_changePassword').addClass('btn-primary');
                            }, 3000);
                        }
                        else if(response.status==404)
                        {
                            alert('Profile Not Found');
                        }
                    }
                });
            }
            else
            {
                $('#passwordValidation').removeClass('d-none');
                $('#passwordValidation').append('<li>Passwords do not match</li>');
            }
            
        });
        
    });
</script>




