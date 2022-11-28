<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title') | PropertyStay</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Digital Hub Dubai Work" name="description" />
        <meta content="Syed Danish Work" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ URL::asset('resources/assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ URL::asset('resources/assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ URL::asset('resources/assets/pages/css/login-4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ URL::asset('favico.png') }}" /> 
    <script type="text/javascript"> var base_url = "{{ URL::to('/') }}"; </script>
</head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo" style="margin-bottom:0;">
            <a href="index.html">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 573.3 118.8" width="400" xml:space="preserve">
<style type="text/css">
    .st0{fill:#ffffff;stroke:#ffffff;stroke-miterlimit:10;}
    .st1{fill:#00AFB1;}
    .st2{fill-rule:evenodd;clip-rule:evenodd;fill:#00AFB1;}
    .st3{fill-rule:evenodd;clip-rule:evenodd;fill:#F5F9F9;}
    .st4{fill-rule:evenodd;clip-rule:evenodd;fill:#ffffff;}
</style>
<g>
    <path class="st0" d="M130.6,61.1V72h-2.4V40.4c4.6,0,9.2,0,13.8,0c13.7,0,13.7,20.6,0,20.6H130.6z M130.6,42.7v16.2H142
        c10.5,0,10.5-16.2,0-16.2H130.6z"></path>
    <path class="st0" d="M158.4,49.7l0.1,4c1.4-3,4.6-4.2,7.4-4.2c1.7,0,3.3,0.4,4.8,1.3l-1,1.8c-1.2-0.7-2.5-1-3.8-1
        c-4.1,0-7.3,3.4-7.3,7.4v13h-2.2V49.7H158.4z"></path>
    <path class="st0" d="M172.9,60.9c0-7.1,5-11.6,11.3-11.6c6.3,0,11.3,4.5,11.3,11.6c0,7.1-5,11.4-11.3,11.4
        C178,72.3,172.9,68,172.9,60.9z M193.4,60.9c0-5.8-4.1-9.5-9.1-9.5c-5,0-9.1,3.7-9.1,9.5c0,5.8,4.1,9.2,9.1,9.2
        C189.3,70.1,193.4,66.7,193.4,60.9z"></path>
    <path class="st0" d="M200.7,81.3V49.7h2.2V55c1.8-3.4,5.3-5.6,9.6-5.6c6,0.2,10.8,4.3,10.8,11.4c0,7.5-5,11.5-11.3,11.5
        c-3.8,0-7.3-1.8-9.2-5.5v14.4H200.7z M221.1,60.8c0-6.3-4.1-9.3-9.1-9.3c-5.2,0-9,3.9-9,9.4c0,5.5,3.9,9.4,9,9.4
        C217,70.3,221.1,67.1,221.1,60.8z"></path>
    <path class="st0" d="M227.4,60.8c0-6.7,5-11.5,11.3-11.5s11.9,3.8,11,12.5h-20.1c0.5,5.2,4.5,8.2,9.1,8.2c2.9,0,6.4-1.2,8-3.4
        l1.6,1.3c-2.2,2.8-6,4.3-9.6,4.3C232.5,72.3,227.4,67.9,227.4,60.8z M247.8,59.9c0-5.5-3.6-8.6-9-8.6c-4.6,0-8.6,3.1-9.1,8.6H247.8
        z"></path>
    <path class="st0" d="M257.5,49.7l0.1,4c1.4-3,4.6-4.2,7.4-4.2c1.7,0,3.3,0.4,4.8,1.3l-1,1.8c-1.2-0.7-2.5-1-3.8-1
        c-4.1,0-7.3,3.4-7.3,7.4v13h-2.2V49.7H257.5z"></path>
    <path class="st0" d="M279.6,43v6.7h7.6v1.8h-7.6v13.6c0,3,0.6,5.1,4.1,5.1c1.1,0,2.3-0.4,3.4-0.9l0.8,1.8c-1.4,0.7-2.8,1.1-4.2,1.1
        c-4.7,0-6.3-2.8-6.3-7.2V51.6h-4.7v-1.8h4.7v-6.5L279.6,43z"></path>
    <path class="st0" d="M311.8,49.7l-13.6,31.5h-2.3l4.1-9.6l-8.9-22h2.4l5.2,13.2l2.6,6.4l2.6-6.5l5.6-13.1H311.8z"></path>
    <path class="st1" d="M317.5,72.8c-1.2,1.6-0.5,3.1,2.4,2.4c3.9-1.2,9.8-5.7,9.8-10.2c0-2.2-4.4-3.9-5.9-4.9
        c-1.2-0.8-2.2-1.7-2.7-2.8c-0.9,1.5-2.1,3.4-3.5,5.4c-0.7,0.9-1.7,0.2-1.1-0.7c2.3-3.1,3.7-5.8,4.2-7.4
        c0.8-6.1,11.1-11.2,16.8-11.2c3.5,0,6.7,1.7,4.9,5.3c-0.5,1.1-1.3,2-2.4,2.7c-0.4,0.3-1.4-0.2-0.4-1.2c1.3-1.3,2.3-4,0.1-4.2
        c-2.4-0.2-6.7,1.6-8.6,2.5c-2.6,1.3-4.8,2.9-6.8,5.7c-1.7,2.3-1.3,3.9,0.9,5.2c5.3,3.1,12,5,6.2,11.6c-2.7,3-7.2,4.9-11,5.7
        c-1.5,0.3-4.8,0.8-5.7-0.9c-0.5-0.8,0.2-2.1,1-3.1c0.8-0.8,2.3-1.7,3.8-2.3c0.6-0.2,0.7,0.6,0.2,0.8
        C318.8,71.4,318,72.1,317.5,72.8z"></path>
    <path class="st1" d="M359.3,50.7c-1.2,0.4-5.2,0.9-8.9,1.3c-1,1.9-2,3.2-2.2,3.9c-2.4,4.7-4.5,8.9-4.7,11.4c-0.6,3.4,1,5.2,3.6,3.9
        c2.5-1.4,8.4-6.4,11.7-10.9c0.4-0.6,1.3-0.1,0.9,0.6c-1.5,2.8-6.3,7.9-10.2,10.8c-2.5,1.9-8.3,3.8-9.9-0.9
        c-0.6-1.8,0.7-6.1,2.4-9.7c-0.7,0.9-1.4,2-3.1,3.9c-0.8,0.9-1.6-0.2-0.9-1.1c2.8-3.4,4.9-6.3,6.1-8.1c0-0.2,0.7-1.4,1.7-3.3
        c-0.8,0.2-1.4,0.2-1.8,0.2c-0.8,0-1.6-0.7-1.1-1.7c0.6-1.3,2.7-1.3,4.2-1.4c0.1-0.2,0.2-0.2,0.3-0.2l3.9-7.3c2-3.4,2.1-4.2,3.2-4.3
        c1.2-0.2,2.7,0.1,3.1,0.8c0.7,0.9-0.2,2.5-0.7,3.2c-0.4,0.8-1.2,0.7-1.7,1.7l-3.8,6.6l1-0.1c2.4-0.2,4.4-0.6,7.4-0.6
        C360.9,49.4,362.6,50,359.3,50.7z"></path>
    <path class="st1" d="M356.7,70.2c-5.8-7.4,12.1-19.2,18-20.6c2.4-0.6,5.8-0.8,7.9,0.6c0.8,0.6,1.3,1.3,1.3,2.1
        c0,0.6-0.1,0.6-0.5,0.4c-0.9-1.3-2.4-1.5-3.9-1.5c-4.1,0-9.6,3.1-13.7,6.8c-2.2,2-8.7,9.5-6.3,13c1.1,1.6,5-1.3,6.1-2.1
        c2-1.7,5.6-4.7,7.6-6.9c1.1-1.2,7.1-7.8,7.8-7.8c0.8,0,3.9,0.6,3.1,1.9c-2.8,4-4.4,8.9-4.7,11.4c-0.5,3.4,1.1,5.2,3.6,3.9
        c2.6-1.4,8.5-6.4,11.7-10.9c0.4-0.6,1.3-0.1,0.9,0.6c-1.4,2.8-6.3,7.9-10.2,10.8c-2.5,1.9-8.3,3.8-9.9-0.9
        c-0.7-2.1,0.2-6.8,1.3-9.6c-1.3,0.6-8.8,11.6-15.1,11.6C360.1,72.8,357.9,71.7,356.7,70.2z"></path>
    <path class="st1" d="M403.2,93.2c-2.9,4.3-7.5,9.6-12.9,8.7c-0.5-0.2-1.2-0.3-1.6-0.6c-5-2.4-2.6-7.2,1.6-12
        c3.9-4.6,12.1-10,17.2-13.4c3.6-7.4,8.2-17.5,9.4-21.2c-4.2,4.9-12,18.1-19.2,18.1c-7,0-6.3-7.1-4-11.5c1.7-3.5,3.9-6.1,6.4-8.3
        c3.5-3.3,6.4,0.4,5.3,1.2c-1.8,1-4.5,3.6-6.8,6.7c-1.3,1.7-4.3,8-2.2,9.5c1.4,1.1,4.2,0,6.4-2.2c5.9-5.6,10.1-11.9,15.3-18.1
        c0.7-1.8,5.6,0.3,5.2,1.2c-2,4.3-6.6,14.9-9.5,21.1c2-1,9.4-6.8,14.1-12.6c0.9-1.2,1.6,0.1,0.6,1.3c-3.1,4.2-12,12.3-16.3,14.7
        C408.8,82.8,405.7,89.4,403.2,93.2z M392.1,90.5c-6,6-3.9,12.7,2,7.9c6-4.8,8.7-12.9,12-19.6C402,82,396.2,86.4,392.1,90.5z"></path>
    <path class="st1" d="M427.2,72.8c-1.2,1.6-0.5,3.1,2.4,2.4c3.9-1.2,9.8-5.7,9.8-10.2c0-2.2-4.4-3.9-5.9-4.9
        c-1.2-0.8-2.2-1.7-2.7-2.8c-0.9,1.5-2.1,3.4-3.5,5.4c-0.7,0.9-1.7,0.2-1.1-0.7c2.3-3.1,3.7-5.8,4.2-7.4
        c0.8-6.1,11.1-11.2,16.8-11.2c3.5,0,6.7,1.7,4.9,5.3c-0.5,1.1-1.3,2-2.4,2.7c-0.4,0.3-1.4-0.2-0.4-1.2c1.3-1.3,2.3-4,0.1-4.2
        c-2.4-0.2-6.7,1.6-8.6,2.5c-2.6,1.3-4.8,2.9-6.8,5.7c-1.7,2.3-1.3,3.9,0.9,5.2c5.3,3.1,12,5,6.2,11.6c-2.7,3-7.2,4.9-11,5.7
        c-1.5,0.3-4.8,0.8-5.7-0.9c-0.5-0.8,0.2-2.1,1-3.1c0.8-0.8,2.3-1.7,3.8-2.3c0.6-0.2,0.7,0.6,0.2,0.8
        C428.5,71.4,427.7,72.1,427.2,72.8z"></path>
    <path class="st1" d="M456.6,72.9c-1,0-2.6,0-2.6-1.3c0-0.4,2.1-2.4,2.5-2.7c2.7-2,2.3-0.4,2.3,0.9
        C458.8,70.6,457.3,72.9,456.6,72.9z"></path>
    <path class="st1" d="M473.1,73.8c-7.5,1.3-13.2-2.6-9.7-10.8c2.4-5.3,14.5-15.7,20.4-13.7c1.4,0.5,2.6,1.5,2,3.5
        c-0.1,0.5-1.4,3.4-2,2.7c-0.3-0.2-0.4-0.6-0.3-0.9c0.1-0.6,0.4-1.1,0.4-1.6c0-0.7-0.4-1.6-1.2-1.6c-4,0-13.8,8-15.9,15.2
        c-1.8,5.8,2.8,6.3,7.2,5c7.1-2,10.9-5.7,15.4-11.4c0.4-0.5,0.8-0.2,0.9-0.2c0.4,0.2,0.2,0.9,0,1.2
        C486.1,67.4,480.9,72.4,473.1,73.8z"></path>
    <path class="st1" d="M503,65.8c-0.5-1.7,0.6-2.9,2-2.5c2.1-4.2,1.5-5.9,1.1-6.8c-0.9-2.2,2.6-3,3.2-0.9c1.1,3.2-1.7,8.1-3.4,10.5
        c0.1,1.5,0.9,2.1,2,2.1c2.5,0,5.1-2.9,6.7-4.6c0.9-1.1,2-2.3,2.8-3.4c0.4-0.6,1.3-0.1,0.9,0.6c-0.5,0.9-1.5,2.2-2.7,3.6
        c-1.7,2.1-4.9,5.5-7.9,5.5c-1.3,0-2.7-0.8-3.2-2c-1,1.1-2,2.1-3.1,3.1c-3.5,3-7.8,3.2-10.4,1.6c-2.6-1.6-3.5-5.3-2.1-10.1
        c0.8-3,3.4-7.2,6.9-10.3c2.9-2.6,6.4-3.9,8.8-3c1.4,0.5,2.6,1.8,2.3,3.8c-0.2,1.3-1.3,1.2-1.3,0.6c0.2-0.9,0-2.1-1.5-2.1
        c-3.5,0-11,8-12.3,15.2c-0.6,3.1,0.4,5.7,3.3,5.7c2.4,0,5.8-2.6,8.2-6.1C503.2,66.2,503,66.1,503,65.8z"></path>
    <path class="st1" d="M516.5,63.5c-0.8,0.9-0.8-0.9-0.1-2c3.2-4.2,3.9-5.3,5.2-7.9c0.2-1.3,0.6-4.1,4.1-3.1c1.3,0.3,1.2,1,0.6,2.3
        c-2,4.3-4.5,11.3-5.4,13.8c3.3-4.1,10.1-11.5,14.5-14.9c5.1-3.9,8.7-2.6,5.4,3.9c-0.8,1.5-2.3,5-3,6.2c2.8-2.5,7.3-6.3,10.9-7.6
        c0.9-0.3,6.4-2.2,4.2,1c-2.8,4.2-4.6,9.6-5,12.1c-0.5,3.4,1.1,5.2,3.6,3.9c2.6-1.4,8.5-6.4,11.7-10.9c0.4-0.6,1.4-0.1,1,0.6
        c-1.5,2.8-6.3,7.9-10.2,10.8c-2.6,1.9-8.4,3.8-10-0.9c-0.6-2.1,0.2-6.8,1.3-9.6c0.6-1.4,1.4-3.5,2.2-4.7c-4.8,1.9-9.5,7.4-11.9,9.8
        c-0.9,2.3-5.1,3-3.9,0c1.6-3.8,4-8.5,4.7-9.8c1.4-2.5,0.7-4.2-5,0.8c-4.5,4.1-11.1,14.5-12.6,15.3c-0.8,0.4-5,2.3-4.2,0.8
        c0.5-1,3-8.3,5-14C518.6,61,517.4,62.5,516.5,63.5z"></path>
</g>
<g>
    <g>
        <path class="st2" d="M66.4,73.4c4.3,0,8.5,0,12.8,0c1.1,0.2,1.6-0.1,1.6-1v-5c0-6.1,0-12.2,0-18.5l0,0l0,0v-0.1v-1.9h5.4
            c-2.9-2.7-5.7-5.3-8.6-7.7V24.9c0-1-0.7-1.7-1.6-1.7h-6.5c-0.9,0-1.6,0.7-1.6,1.7v5.4c-2.6-2.4-5.1-4.7-7.6-7
            c-1-0.9-1.4-0.9-2.4,0c-8.3,7.3-16.5,14.5-24.8,21.9c-0.6,0.4-1.1,1-1.7,1.6h4.1v1.7c0,0.3,0,0.6,0,1c0,7.6,0.1,15,0,22.5
            c0,1.1,0.3,1.4,1.4,1.4c4.4-0.2,8.7-0.2,13.1,0"></path>
    </g>
    <g>
        <path class="st3" d="M54.7,48.2c0,3.2,0,6.4,0,9.6c0,0.6,0,1.1,0.1,1.6c0.1,0.8,0.4,1.6,0.8,2.3c0.2,0.3,0.2,0.4-0.2,0.4
            c-2.6,0-5.1,0-7.7,0c-0.1,0-0.3,0.1-0.4-0.1c-0.1-0.2-0.1-0.4,0-0.5c0-0.1,0.2-0.1,0.3-0.1c0.4,0,0.7,0,1.1,0c1.2-0.2,1.8-0.8,2-2
            c0.1-0.7,0.1-1.4,0.1-2.2c0-3.6,0-7.2,0-10.8c0-2.1,0-4.2,0-6.3c0-0.7-0.1-1.4-0.3-2c-0.2-0.6-0.6-0.9-1.1-1.1
            c-0.5-0.2-1.1-0.2-1.7-0.2c-0.4,0-0.5-0.2-0.4-0.6c0-0.1,0.1-0.1,0.2-0.1c0.1,0,0.3,0,0.4,0c3.8,0,7.5,0,11.3,0
            c0.7,0,1.4,0,2.2,0.1c0.5,0.1,1.1,0.2,1.6,0.3c1.1,0.3,2.2,0.7,3.1,1.5c1.7,1.4,2.4,3.2,2.2,5.3c-0.1,0.9-0.3,1.7-1,2.4
            c-0.6,0.5-1.2,0.7-2,0.5c-0.6-0.1-1.2-0.4-1.7-0.8c-0.2-0.1-0.2-0.2-0.1-0.4c1.2-1.4,1.3-2.9,0.6-4.5c-0.4-1.1-1.2-1.9-2.2-2.4
            c-0.6-0.3-1.2-0.5-1.9-0.7c-1-0.2-2-0.3-3-0.3c-0.7,0-1.4,0.1-2.1,0.3c-0.2,0.1-0.3,0.2-0.3,0.4c0,1.5,0,3,0,4.6
            C54.7,44.4,54.7,46.3,54.7,48.2z"></path>
        <path class="st3" d="M71.9,51.2c0,1.3,0,2.6,0,4c0,0.4,0,0.4-0.4,0.4c-0.5,0-0.5,0-0.6-0.5c-0.2-0.7-0.3-1.5-0.6-2.2
            c-0.5-1.4-1.4-2.5-2.7-3.3c-1.6-0.9-3.4-1.2-5.2-0.8c-1.3,0.3-2.4,0.9-3,2.2c-0.4,0.7-0.5,1.5-0.2,2.3c0.1,0.4,0.5,1.3,0.6,1.4
            c0.2,0.2,0.1,0.1,0.3,0.4c0.3,0.4,1.1,1,1.8,1.4c1.5,0.9,3,1.8,4.6,2.7c1,0.6,1.9,1.1,2.8,1.8c1,0.7,1.8,1.6,2.2,2.8
            c0.5,1.4,0.5,2.8-0.2,4.1C70.9,69,70,69.5,69,69.8c-0.6,0.2-1.2,0.2-1.9,0.2c-0.1,0-0.2,0-0.2-0.1c0-0.1,0.1-0.1,0.1-0.2
            c0.8-0.6,1.3-1.3,1.5-2.3c0.2-1-0.1-1.8-0.8-2.6c-0.8-0.8-1.7-1.5-2.7-2.1c-1.4-0.9-2.9-1.6-4.3-2.4c-1.1-0.6-2.2-1.3-3.1-2.2
            c-0.8-0.9-1.3-1.9-1.6-3.1c-0.2-1.2-0.2-2.4,0.2-3.6c0.4-1.3,1.3-2.4,2.4-3.2c1-0.7,2.1-1.2,3.3-1.4c1.1-0.2,2.3-0.1,3.4,0.1
            c1.3,0.3,2.6,0.7,3.8,1c0.3,0.1,0.5,0.1,0.8,0.1c0.4,0,0.7-0.2,0.8-0.6c0-0.1,0.1-0.2,0.1-0.3c0.1-0.1,0-0.3,0.2-0.4
            c0.2-0.1,0.4-0.1,0.7,0c0.2,0,0.1,0.2,0.1,0.3c0,1,0,2,0,2.9C71.9,50.5,71.9,50.9,71.9,51.2z"></path>
    </g>
</g>
<path class="st4" d="M24.8,12.5C5.4,25.7-4.5,50.2,2,74.2c8.1,30.3,39.3,48.3,69.6,40.2c24.8-6.6,41.3-28.7,42.1-53
    c-3.4,20-18.1,37.2-39,42.8c-28.6,7.7-58-9.3-65.7-37.9C3.6,46.1,10.4,25.6,24.8,12.5L24.8,12.5z"></path>
<path class="st2" d="M88.3,90.9c16.4-11.2,24.7-31.8,19.3-52C100.7,13.3,74.4-1.9,48.9,5C27.9,10.6,14,29.2,13.3,49.7
    c2.9-16.9,15.3-31.4,32.9-36.1c24.1-6.5,49,7.9,55.4,32C106.2,62.6,100.5,79.9,88.3,90.9L88.3,90.9z"></path>
<g>
    <path class="st4" d="M92.8,76.6c-0.5-1.4-2.7-2.2-5.3-1.9c-0.6,0-1.4,0.2-2,0.4c-3.1,0.9-18.8,6.3-18.9,6.4l-0.3,0.1l0.2,0.2
        c1.8,1.5,2.6,3.1,2.2,4.4c-0.5,1.9-3.1,3.1-7.4,3.4c-3.7,0.3-8.4,0-13.9-1.1c0.5,0,1.3,0,1.9,0.1c4-0.1,7.8-0.1,10.6-0.2
        c4.5-0.4,6.7-1.4,7.1-3.2c0.1-1.1-0.5-2-2.1-2.7c-1.7-1-5.3-1.4-8.7-2c-2.3-0.3-4.5-0.6-6.1-1.1c-5.5-1.4-11-2.8-17.5-2.3
        c-1.1,0.1-2.1,0.2-3.1,0.4c-5,0.8-9.9,2-15,3.5l-0.6,0.1l7.6,10.9c1.4-0.3,2.7-0.6,4.1-0.7c1.8-0.1,3.5-0.1,5.1,0.1
        c2.1,0.4,7.3,1.5,12.3,2.4c5.2,1.2,10.1,2.1,12,2.3c1.2,0.2,2.1,0.2,3.2,0.1c2.5-0.2,5.2-1.6,7.7-2.8c0.7-0.5,1.6-0.8,2.2-1.3
        l22.5-12.2C93.2,78.6,93.2,77.3,92.8,76.6L92.8,76.6z"></path>
</g>
</svg>
            </a>
        </div>
        <!-- END LOGO -->

        <div class="content">

            @yield('content')

        </div>

        <!-- BEGIN COPYRIGHT -->
        <div class="copyright"> 2021 &copy; PropertyStay. </div>
        <!-- END COPYRIGHT -->
        <!--[if lt IE 9]>
<script src="{{ URL::asset('resources/assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ URL::asset('resources/assets/global/plugins/excanvas.min.js') }}"></script> 
<script src="{{ URL::asset('resources/assets/global/plugins/ie8.fix.min.js') }}"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ URL::asset('resources/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ URL::asset('resources/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ URL::asset('resources/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ URL::asset('resources/assets/pages/scripts/login-4.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>