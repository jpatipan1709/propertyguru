@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}">

<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css')}}" />
<!-- Multi Select css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/multiselect/css/multi-select.css')}}" />



@endsection
@section('content')
@php
$active = 'template';
@endphp
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Template Form Registration</h5>
                                </div>

                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-12">
                                            @if($errors->all())
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="alert alert-danger border-danger" style="margin-bottom:0px;">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <i class="icofont icofont-close-line-circled"></i>
                                                        </button>
                                                        @foreach ($errors->all() as $error)
                                                        {{ $error }} <br />
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(\Session::has('success'))
                                            <div class="alert alert-success border-success" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont-close-line-circled"></i>
                                                </button>
                                                {{ \Session::get('success') }}
                                            </div>
                                            @endif
                                            @if(\Session::has('danger'))
                                            <div class="alert alert-danger border-danger" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont-close-line-circled"></i>
                                                </button>
                                                {{ \Session::get('danger') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Project Name :</b> {{ Session::get('project_name') }}
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="{{ url('tempalte') }}" class="btn btn-inverse btn-outline-inverse">Back</a>
                                        </div>
                                    </div>

                                    <hr>
                                    
                                    @php
                                  
                                    if ($events->pj_status == 1){
                                        $regisform = App\Regisform::where('rgf_pj_id',$events->ev_pj_id)->first();     
                                        $ev_id = $events->ev_pj_id;
                                    }else{
                                        $regisform = App\Regisform::where('rgf_ev_id',$events->ev_id)->first();
                                        $ev_id = $events->ev_id;
                                    }
                                   
                                    if($regisform != null){
                                    $ex_rgf_rgt_ids = explode(',',$regisform->rgf_rgt_id);
                                    }else{
                                    $ex_rgf_rgt_ids = array();
                                    }

                                    @endphp
                                    <form action="{{ url('tempalte',$ev_id) }}" method="post" autocomplete="off">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div>
                                                    <label for="project_name"><b>Input List</b> </label>
                                                    <select multiple="multiple" id="my-select" name="myselect[]">
                                                        @foreach ($templates as $template)
                                                        <option value='{{ $template->rgt_id }}'
                                                            {{ (collect(old('myselect'))->contains($template->rgt_label)) ? 'selected':'' }}
                                                            @foreach ($ex_rgf_rgt_ids as $ex_rgf_rgt_id)
                                                            {{ ($ex_rgf_rgt_id==$template->rgt_id) ? 'selected'  : '' }}
                                                            @endforeach>{{ $template->rgt_label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">

                                                <button type="submit" class="btn btn-primary btn-outline-primary">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@csrf
@endsection
@section('js')

<!-- data-table js -->
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{ asset('iles/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Select 2 js -->
<script src="{{ asset('files/bower_components/select2/js/select2.full.min.js')}}"></script>

<!-- Multiselect js -->
<script src="{{ asset('files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
<script src="{{ asset('files/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{ asset('files/assets/js/jquery.quicksearch.js')}}"></script>

<!-- Custom js -->
<script src="{{ asset('files/assets/pages/advance-elements/select2-custom.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('#table2').DataTable();
  
    $(function () {
      
        $(document).on('click', '#delete_agenda', function () {
           var id = $(this).attr('atr');
           var token = $('input[name=_token]').val();
           swal({
                title: "Warning",
                text: "Do you want to delete Agenda ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url:"{{url('delagenda')}}/"+id,
                        type:"post",
                        data:{_method:'delete',_token:token,id:id},
                    }).done(function(data){
                        location.reload();
                    });
                } 
            });
         
        });
    });

</script>
@endsection
