{{-- <div class="row">
    <div class="col-12">
        <b>Name</b> : {{ $registered->rg_name }} {{ $registered->rg_lastname }}
</div>
</div>
<div class="row">
    <div class="col-6">
        <b>E-mail</b> : {{ $registered->rg_email }}
    </div>
    <div class="col-6">
        <b>Phone</b> : {{ $registered->rg_phone }}
    </div>
</div>
<div class="row">
    <div class="col-12">
        <b>Company</b> : {{ $registered->rg_company }}
    </div>
</div>
<div class="row">
    <div class="col-12">
        <b>Address</b> : {{ $registered->rg_address }}
    </div>
</div> --}}
<form action="{{url('resendmail')}}" method="POST">
    @csrf
    <div class="table-responsive">
        <table cellpadding="10">
            <tbody>
                <tr>
                    <th class="text-right">Name :</th>
                    <td>{{ $registered->rg_name }} {{ $registered->rg_lastname }}</td>
                </tr>
                <tr>
                    <th class="text-right">E-mail :</th>
                    <td>
                        {{ $registered->rg_email }}
                    </td>
                    <th class="text-right">CC E-mail :</th>
                    <td>
                        {{ $registered->rg_cc_email }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Phone :</th>
                    <td>
                        {{ $registered->rg_phone }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Company :</th>
                    <td>
                        {{ $registered->rg_company }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Address :</th>
                    <td>
                        {{ $registered->rg_address }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Country :</th>
                    <td>
                        {{ $registered->rg_country  }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Job Title :</th>
                    <td>
                        {{ $registered->rg_job_title }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Dietary requirement :</th>
                    <td>
                        {{ $registered->rg_dietary }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Type of person :</th>
                    <td>
                        {{ $registered->tps_name }}
                    </td>
                </tr>
                <tr>
                    <th class="text-right">table :</th>
                    <td>

                    </td>
                    <th class="text-right">seat no :</th>
                    <td>

                    </td>
                </tr>
                <tr>
                    <th class="text-right">Re-send :</th>
                    <td class="text-left">
                        <select name="cc_status" id="cc_status" class="form-control" required>
                            <option value="">------ Please Choose CC E-mail -------</option>
                            <option value="1" {{ old('cc_status') ==1 ? 'selected' : ''}}>Send to primary e-mail
                            </option>
                            <option value="2" {{ old('cc_status') ==2 ? 'selected' : ''}}>Send to cc e-mail</option>
                            <option value="3" {{ old('cc_status') ==3 ? 'selected' : ''}}>Send to both e-mails</option>
                        </select>
                        <input type="hidden" name="rg_id" id="rg_id" value="{{$registered->rg_id}}">
                    </td>
                    <td colspan='2'>

                    </td>
                </tr>
                <tr>
                    <th class="text-right"></th>
                    <td colspan='2'>
                        <button type="submit" class="btn btn-success">Send E-mail Again</button>
                    </td>
                </tr>
                {{-- <tr>
            <th class="text-right"> </th>
            <td>
                <a href="{{ url('PrintBadge',$registered->rg_id)}}" class="btn btn-outline-danger btn-danger"
                data-toggle="tooltip" data-placement="bottom" title="Badge" target="_blank"><i
                    class="fa fa-print"></i></a>
                <a href="{{ url('PrintGala',$registered->rg_id)}}" class="btn btn-outline-success btn-success"
                    data-toggle="tooltip" data-placement="bottom" title="Gala Dinner" target="_blank"><i
                        class="fa fa-print"></i></a>
                </td>
                </tr> --}}

            </tbody>
        </table>
    </div>

</form>
