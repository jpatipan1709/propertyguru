<style>
    @page {
        margin: 15px;
    }

    body {
        margin: 15px;
    }

    .page-break {
        page-break-after: always;
    }
</style>
<div id='DivIdToPrint'>
    <div id="canvas"    >
        <img width="513px" height="996px" src="{{ url('Storage/ticket/'.$tickets->tck_images)}}" alt="" >
        <div id="box" style="color:{{$tickets->tck_color}};font-size:{{$tickets->tck_size}};position: absolute;left:{{$tickets->tck_name_y}};top:{{$tickets->tck_name_x}};">{{$registerd->rg_name}}</div>
        <div id="box1" style="color:{{$tickets->tck_color}};font-size:{{$tickets->tck_size}};position: absolute;left:{{$tickets->tck_lastname_y}};top:{{$tickets->tck_lastname_x}};">{{$registerd->rg_lastname}}</div>
        <div id="box2" style="color:{{$tickets->tck_color}};font-size:{{$tickets->tck_size}};position: absolute;left:{{$tickets->tck_company_y}};top:{{$tickets->tck_company_x}};">{{$registerd->rg_company}}</div>
        <div id="box3" style="color:{{$tickets->tck_color}};font-size:{{$tickets->tck_size}};position: absolute;left:{{$tickets->tck_qr_y}};top:{{$tickets->tck_qr_x}};">
            {!! QrCode::size($tickets->tck_size_qr)->margin(0)->generate('G-'.$registerd->rg_id); !!} 
        </div>
    </div>
    <div class="page-break"></div>
    

<img src="{{ url('Storage/ticket/'.$tickets->tck_agenda)}}" width="513px" height="996px" alt="">
</div>
<script src="{{ asset('files/bower_components/jquery/js/jquery.min.js')}}"></script>
{{-- <script>
    $(document).ready(function () {
        var divToPrint=document.getElementById('DivIdToPrint');

        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);
    });

</script> --}}
