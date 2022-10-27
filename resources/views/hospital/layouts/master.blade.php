<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ONE DROP</title>
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
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{asset('assets/admin/src/assets/img/logo.png')}}" class="navbar-logo" alt="logo">
                        </a>
                    </div>
                    <div class="nav-item theme-text">
                        <a href="" class="nav-link"> ONE DROP </a>
                    </div>
                </div>
            </div>
            <div class="shadow-bottom"></div>
            <ul class="list-unstyled menu-categories" id="accordionExample">

                <li class="menu">
                    <a href="{{ route('admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <i class="fa-solid fa-home" style="width:50px; height:100%;"></i> 
                            <span>Home</span>
                        </div>
                    </a>
                </li>


                <li class="menu">
                    <a href="{{ route('admin.staffControls.message') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <i class="fa-solid fa-envelope" style="width:50px; height:100%;"></i> 
                            <span>Messages</span>
                        </div>
                    </a>
                </li>

                <li class="menu">
                    <a href="" aria-expanded="false" class="dropdown-toggle d-flex align-items-baseline">
                        <div class="">
                            <i class="fa-solid fa-droplet" style="width:50px; height:100%;"></i>    
                            <span>Blood Bank</span>
                        </div>
                    </a>
                </li>

                <li class="menu">
                    <a href="#donations" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <i class="fa-solid fa-user" style="width:50px; height:100%;"></i>
                            <span>Donations</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="donations" data-bs-parent="#accordionExample">
                        <li>
                            <a href="{{ route('admin.staffControls.appointments') }}"> Appointments </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.staffControls.donorRequest') }}"> Donor Registration </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.staffControls.donor') }}"> Donors </a>
                        </li>
                        <li>
                            <a href=""> Requests </a>
                        </li>                          
                        <li>
                            <a href=""> Donations </a>
                        </li>                          
                        <li>
                            <a href=""> Donate </a>
                        </li>                         
                    </ul>
                </li>

                <hr>

                <li class="menu">
                    <a href="" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <i class="fa-solid fa-chalkboard" style="width:50px; height:100%;"></i>
                            <span>Tracking</span>
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

            <ul id="passwordValidation" class="list-unstyled bg-danger form-control d-none">
            </ul>

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















<!--  BEGIN FOOTER  -->
<div class="footer-wrapper">
    <div class="footer-section f-section-1">
        <p class="">Copyright © <span class="dynamic-year">2022</span> <a href="">One Drop</a>, All rights reserved.</p>
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





