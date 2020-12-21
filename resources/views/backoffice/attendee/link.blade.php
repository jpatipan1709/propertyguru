@php
    $events = App\Events::where('ev_id',$id)->first();
    $id2 = $events->ev_pj_id;
@endphp
<div class="form-row justify-content-md-center">
        <div class="form-group col-md-12">
            <label for="admin_type" id="image-label">Admin</label>
            <input type="text" name="admin_type" class="form-control" id="admin_type" value="{{ url('new_registration/'.$id.'/1/'.$id2) }}" />
        </div>
        <div class="form-group col-md-12">
            <label for="sponser_type" id="image-label">Sponser</label>
            <input type="text" name="sponser_type"  class="form-control"id="sponser_type" value="{{ url('new_registration/'.$id.'/2/'.$id2) }}"/>
        </div>
        <div class="form-group col-md-12">
            <label for="guest_type" id="image-label">Guest</label>
            <input type="text" name="guest_type" class="form-control" id="guest_type" value="{{ url('new_registration/'.$id.'/3/'.$id2) }}"/>
        </div>
    </div>

