<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
        <style>
                #canvas {
                width: 400px;
                height: 200px;
                position: relative;
                margin: 2em auto;
                background-color:blanchedalmond;
            }
            
            #box {
                position: absolute;
                height: 18px;
                /* background: red; */
                cursor: move;
                color:black;
                font-size:14px;
            }
            #box1 {
                position: absolute;
                height: 18px;
                /* background: orange; */
                cursor: move;
                color:black;
                font-size:14px;
            }
            #box2 {
                position: absolute;
                height: 18px;
                /* background: green; */
                cursor: move;
                color:black;
                font-size:14px;
            }
            #box3 {
                position: absolute;
                height: 18px;
                /* background: green; */
                cursor: move;
                color:black;
                font-size:14px;
            }</style>
    @php
        $tickets = DB::table('tb_badge')->where('b_pj_id',Session::get('id_project'))->first();
    @endphp
    <div id="canvas" style=" width:{{$tickets->b_width}}px;height:{{$tickets->b_height}}px;position: relative;margin: 2em auto;background-color:blanchedalmond;">
                                            
            <div id="box" style="{{  'left:'.$tickets->b_name_y.'px;'.'top:'.$tickets->b_name_x.'px;font-size:'.$tickets->b_size.'px;color:'.$tickets->b_color }}">
                [PersonFirstName]</div>
            <div id="box1" style="{{  'left:'.$tickets->b_lastname_y.'px;'.'top:'.$tickets->b_lastname_x.'px;'.'px;font-size:'.$tickets->b_size.'px;color:'.$tickets->b_color }}">
                [PersonLastName]</div>
            <div id="box2" style="{{'left:'.$tickets->b_company_y.'px;'.'top:'.$tickets->b_company_x.'px;'.'px;font-size:'.$tickets->b_size.'px;color:'.$tickets->b_color  }}">
                [CompanyName]</div>
            <div id="box3" style="{{  'left:'.$tickets->b_department_y.'px;'.'top:'.$tickets->b_department_x.'px;'.'px;font-size:'.$tickets->b_size.'px;color:'.$tickets->b_color }}">
                [DeperimentPersonal] </div>
                <div id="box3" style="{{  'left:'.$tickets->b_department_y.'px;'.'top:'.$tickets->b_department_x.'px;'.'px;font-size:'.$tickets->b_size.'px;color:'.$tickets->b_color }}">
                        [DeperimentPersonal] </div>
        </div>
    
</body>
</html>