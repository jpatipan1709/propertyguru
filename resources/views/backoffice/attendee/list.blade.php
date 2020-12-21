@foreach ($events as $event)
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="dateofeventstart"> <b>Date of event</b></label>
        <input type="date" class="form-control {{ $errors->has('dateofevent') ? ' is-invalid' : '' }}" id="dateofevent"
            name="dateofeventstart[]" placeholder="Date of event Start" value="{{$event->ev_date_start}}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="time_agenda1"> <b>Time Start</b></label>
        <input type="time" class="form-control {{ $errors->has('time_agenda1') ? ' is-invalid' : '' }}" id="time_agenda1"
            name="time_agenda1[]" placeholder="Time" value="{{$event->ev_time_start}}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="time_agenda2"> <b>Time End</b></label>
        <input type="time" class="form-control {{ $errors->has('time_agenda2') ? ' is-invalid' : '' }}" id="time_agenda2"
            name="time_agenda2[]" placeholder="Time" value="{{$event->ev_time_end}}" readonly>
    </div>
</div>
@endforeach