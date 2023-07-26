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
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->

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
    
</body>

</html>
