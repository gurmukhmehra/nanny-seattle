<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{getcong('siteName')}}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/cropped-motherhood.png') }}">
    <link href="{{ asset('public/admin/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('public/admin/vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('public/admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/css/tagmanager.min.css') }}">
    
    <link href="{{ asset('public/admin/datatable_link/css/jquery.dataTables.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('public/admin/datatable_link/css/buttons.dataTables.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('public/admin/datatable_link/css/LineIcons.css') }}" rel="stylesheet">
    

    <style type="text/css">
        .dt-buttons{
        width: 100%;
        }
        .downloadCSVbtn {
            background-color: #fff !important;
            color: #2271b1 !important;
            border: 1px solid #2271b1 !important;
            font-weight: normal;
        }
        #record-table th {
            font-size: 13px;
            font-weight: normal;
        }
        #record-table td {
            font-size: 13px;
            font-weight: normal;
            color: #2271b1;
        }
        #record-table_previous, #record-table_next {
            font-size: 13px;
        }
    </style>
</head>
<body>

<!--*******************Preloader start********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
<!--*******************Preloader end********************-->
<div id="main-wrapper">
    @include('admin.layouts.header')    
    @include('admin.layouts.sidebar')
    <div class="content-body">
        @yield('content')
    </div>
    @include('admin.layouts.footer')
</div>
    <script src="{{ asset('public/admin/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('public/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('public/admin/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/custom.min.js') }}"></script>
	<script src="{{ asset('public/admin/js/deznav-init.js') }}"></script>	
	<!-- Counter Up -->
    <script src="{{ asset('public/admin/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>			
	<!-- Chart piety plugin files -->
	<script src="{{ asset('public/admin/vendor/peity/jquery.peity.min.js') }}"></script>	
	<!-- Dashboard 1 -->
	<script src="{{ asset('public/admin/js/dashboard/dashboard-1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/js/tagmanager.min.js') }}"></script>
    <script>
        $(function() {   
            setTimeout(function() {
                $(".message").text('');
                $(".message").hide();
            }, 5000);
        });
        $(".tm-input").tagsManager();
    </script>
    <script src="{{ asset('public/admin/datatable_link/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin/datatable_link/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/admin/datatable_link/js/buttons.html5.min.js') }}"></script>
    @stack('scripts')
    </body>
</html>