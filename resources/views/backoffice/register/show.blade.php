@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}">
@endsection
@section('content')

@php
$active = 'registered';
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
                                    <h5>Registered List</h5>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-12">
                                            @if(\Session::has('success'))
                                            <div class="alert alert-success border-success" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont-close-line-circled"></i>
                                                </button>
                                                {{ \Session::get('success') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($errors->all())
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-danger border-danger" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont icofont-close-line-circled"></i>
                                                </button>
                                                @foreach ($errors->all() as $error)
                                                {{ $error }} <br />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Project Name :</b> {{ Session::get('project_name') }}
                                        </div>
                                        <div class="col-6 text-right">
                                            {{-- <form action="{{url('CreateForm')}}" method="POST">
                                                @csrf --}}
                                                {{-- <input type="hidden" name="id" id="id" value="{{ $id}}"> --}}
                                                    <a href="{{ url('CreateForm').'/'.$id }}" class="btn btn-primary btn-outline-primary">Add
                                                        Register</a>
                                            {{-- </form> --}}
                                            {{-- <button type="button" class="btn btn-primary btn-outline-primary" data-toggle="modal" data-target="#exampleModal">Add
                                                    Register</button> --}}
                                            <a href="{{ url('registered') }}" class="btn btn-inverse btn-outline-inverse">Back</a>

                                        </div>
                                    </div>
                                    
                                    <hr>
                                
                                    <div class="table-responsive">
                                        <table id="table2" class="table table-bordered table-strip table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">#</th>
                                                    <th class="text-center">Guest Name</th>
                                                    <th class="text-center">E-mail</th>
                                                    <th class="text-center">Phone</th>
                                                    <th class="text-center">Company</th>
                                                    <th class="text-center">Addresss</th>
                                                    <th class="text-center">Country</th>
                                                    <th class="text-center" width="20%">Mange</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registerds as $key => $registerd)
                                                <tr class="text-center">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $registerd->rg_name.' '.$registerd->rg_lastname }}</td>
                                                    <td>{{ $registerd->rg_email }}</td>
                                                    <td>{{ $registerd->rg_phone }}</td>
                                                    <td>{{ $registerd->rg_company }}</td>
                                                    <td>{{ $registerd->rg_address }}</td>
                                                    <td>{{ $registerd->ct_name }}</td>
                                                    <td>
                                                        <a href="{{ url('registered',$registerd->rg_id).'/edit'}}"
                                                            class="btn btn-outline-warning btn-warning" data-toggle="tooltip"
                                                            data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>
                                                        <button class="btn btn-outline-danger btn-danger" id="delete_event"
                                                            atr="{{ $registerd->rg_id }}" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                                        {{-- <form id="delete-form" action="{{ route('event.destroy',$event->ev_id)}}"
                                                            method="POST">
                                                            {{ method_field('DELETE') }}
                                                            @csrf

                                                        </form> --}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Register Group</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <form action="{{url('CreateForm')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                            <label for="number_personal">Choose: </label>
                            <select type="text" class="form-control" id="number_personal" name="number_personal">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                            </select>
                    </div>
                    <input type="hidden" name="id" id="id" value="{{ $id}}">                        
               
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Confirm</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
          </div>
        </div>
      </div>
@endsection
@section('js')

<!-- data-table js -->
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/advance-elements/swithces.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $("#name_input").keyup(function () {
        var name_input = $("#name_input").val();
        $("#id_input").val(name_input);
    });

    $('#table2').DataTable();
    $('#table3').DataTable();

</script>
<script>
    $(function () {

        $(document).on('click', '#delete_event', function () {
            var id = $(this).attr('atr');
            var token = $('input[name=_token]').val();
            swal({
                title: "Warning",
                text: "Do you want to delete Register  Data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{url('event')}}/" + id,
                        type: "post",
                        data: {
                            _method: 'delete',
                            _token: token,
                            id: id
                        },
                    }).done(function (data) {
                        location.reload();
                    });
                }
            });

        });
    });

</script>
@endsection
