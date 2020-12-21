<html>
<head>
    <title>PropertyGURU</title>
    @include('layouts/header')
    
</head>
@if (count($attendees) > 0)
    @if ($attendees[0] != "")
        <body class="bg-annoucemwnt" style="background-image: linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),url({{asset('storage/event').'/'.$attendees[0]->pj_image }});">
    @elseif($attendees[1] != "")
       <body class="bg-annoucemwnt" style="background-image: linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),url({{asset('storage/event').'/'.$attendees[1]->pj_image }});">
    @endif
@else
    <body class="bg-annoucemwnt" style="background-image: linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),url({{asset('images/celebration-3057027_1920.jpg')}});">
@endif
    @include('layouts/navbar2')
        <div id="section">
            @yield('content')
        </div>    
    @include('layouts/footer')
</body>
<script>
        $(document).ready(function(){
            $('.row').each(function(){  
                var highestBox = 0;
                $(this).find('.card-text').each(function(){
                    if($(this).height() > highestBox){  
                        highestBox = $(this).height() + 40;  
                    }
                })
                $(this).find('.card-text').height(highestBox);
            });    
        });
    </script>  
</html>    