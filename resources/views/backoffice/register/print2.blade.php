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
<div class="main" style="color:{{ $galadinners->gl_color }};">
    <div style="left:{{ $galadinners->gl_name_y }};top:{{ $galadinners->gl_name_x }};position:absolute;font-size:{{ $galadinners->gl_size }};">
        {{ $registered->rg_name}}
    </div>

    <div style="left:{{ $galadinners->gl_lastname_y }};top:{{ $galadinners->gl_lastname_x }};position:absolute;font-size:{{ $galadinners->gl_size }};">
        {{ $registered->rg_lastname}}
    </div>
    <div style="left:{{ $galadinners->gl_company_y }};top:{{ $galadinners->gl_company_x }};position:absolute;font-size:{{ $galadinners->gl_size }};">
        {{ $registered->rg_company }}
    </div>
    <div style="left:{{ $galadinners->gl_table_y }};top:{{ $galadinners->gl_table_x }};position:absolute;font-size:{{ $galadinners->gl_size }};">
        Table No. {{ $tabl_no }} / Seat No. {{ '' }}
    </div>

    <div style="left:{{ $galadinners->gl_text_y }};top:{{ $galadinners->gl_text_x }};position:absolute;font-size:{{ $galadinners->gl_size }};">
        {{ $galadinners->gl_text }}
    </div>
    <div style="left:{{ $galadinners->gl_image_y }};top:{{ $galadinners->gl_image_x }};position:absolute;font-size:{{ $galadinners->gl_size }};">
          <img src="{{ url('Storage/gala').'/'.$galadinners->gl_images }}" alt="" width="120px" height="120px">  
        </div>
</div>
