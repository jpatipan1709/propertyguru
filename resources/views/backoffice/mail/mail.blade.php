<!DOCTYPE html>
<html lang="en">

<head>
    <title>PropertyGURU</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    {{--
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    --}}
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('images/favicon.png')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">
    <!-- radial chart.css -->
    <link rel="stylesheet" href="{{ asset('files/assets/pages/chart/radial/css/radial.css') }}" type="text/css" media="all">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">
    @yield('css')
</head>
<body>

        <p style="text-align: center;font-size:20px;font-weight:200;">
               @php
                    $date1 = date_create($events->ev_date_start );
                    $time1 = date_create($events->ev_time_start );
                    $time2 = date_create($events->ev_time_end );
                    
               @endphp  
                {{ $events->ev_name}} : {{ date_format($date1,"d/m/Y") }} ({{ date_format($time1,"H:i") .'-'. date_format($time2,"H:i")}})<br />
            </p>
            <p style="text-align: center;font-size:20px;font-weight:200;">
                <img src="{{ url('storage/email').'/'.$mails->tbm_logo }}" alt="" style="height:250px; display:inline-block">
            </p>
            <p style="text-align: center;">
                {!!$mails->tbm_content!!}
            </p>
            <p style="text-align: center;font-size:20px;font-weight:200;">
                <img src="{{ url('checkread').'/'.$registerd->rg_id }}" alt="" width="1" height="1">
                <a href="{{url('ViewPDF').'/'.$registerd->rg_id}}" style=" background-color: {{$mails->tbm_color}};
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;"> CONFIRM YOUR ATTENDANCE</a>
            </p>
            <script src="{{ asset('files/bower_components/jquery/js/jquery.min.js')}}"></script>
            <script src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min.js')}} "></script>
            <script src="{{ asset('files/bower_components/popper.js/js/popper.min.js')}}"></script>
            <script src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js')}} "></script>
            <script src="{{ asset('files/assets/pages/widget/excanvas.js')}} "></script>
            <!-- jquery slimscroll js -->
            <script src="{{ asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}} "></script>
            <!-- modernizr js -->
            <script src="{{ asset('files/bower_components/modernizr/js/modernizr.js ')}}"></script>
            <!-- slimscroll js -->
            <script src="{{ asset('files/assets/js/SmoothScroll.js')}}"></script>
            <script src="{{ asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js ')}}"></script>
            <!-- Chart js -->
            <script src="{{ asset('files/bower_components/chart.js/js/Chart.js')}}"></script>
            <script src="{{ asset('files/assets/pages/widget/amchart/amcharts.js')}}"></script>
            <script src="{{ asset('files/assets/pages/widget/amchart/serial.js')}}"></script>
            <script src="{{ asset('files/assets/pages/widget/amchart/light.js')}}"></script>
            <!-- menu js -->
            <script src="{{ asset('files/assets/js/pcoded.min.js')}}"></script>
            <script src="{{ asset('files/assets/js/vertical/vertical-layout.min.js')}} "></script>
            <!-- custom js -->
        
            <script src="{{ asset('files/assets/js/script.js ')}}"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>              
</body>
</html>
