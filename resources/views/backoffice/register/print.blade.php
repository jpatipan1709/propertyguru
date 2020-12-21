<style>
    @page {
        margin: 0px;
    }

    body {
        margin: 0px;
    }

    .main {
        position: relative;
    }

</style>
<div class="main" style="color:{{ $badges->b_color }};">
    <div style="left:{{ $badges->b_department_y }};top:{{ $badges->b_department_x }};position:absolute;font-size:{{ $badges->b_size }};">
        {{ $registered->tps_name}}
    </div>
    <div style="left:{{ $badges->b_name_y }};top:{{ $badges->b_name_x }};position:absolute;font-size:{{ $badges->b_size }};">
        {{ $registered->rg_name }}
    </div>
    <div style="left:{{ $badges->b_lastname_y }};top:{{ $badges->b_lastname_x }};position:absolute;font-size:{{ $badges->b_size }};">
        {{ $registered->rg_lastname}}
    </div>
    <div style="left:{{ $badges->b_company_y }};top:{{ $badges->b_company_x }};position:absolute;font-size:{{ $badges->b_size }};">
        {{ $registered->rg_company}}
    </div>
    <div style="left:{{ $badges->b_images_y }};top:{{ $badges->b_images_x }};position:absolute;font-size:{{ $badges->b_size }};">
    
        <img src="{{ url('storage/ticket').'/'.$badges->b_images }}" alt="" width="{{ $badges->b_images_size }}px" height="{{ $badges->b_images_size }}px">
    </div>
   
</div>
<script src="{{asset('files/bower_components/jquery/js/jquery.min.js')}}"></script>
<script>
    window.print();
</script>
