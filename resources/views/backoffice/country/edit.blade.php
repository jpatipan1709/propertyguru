@extends('backoffice.layouts.master')
@section('css')

@endsection
@section('content')
@php
$active = "other";
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
                                    <h5>Country Edit Form</h5>
                                    <div class="card-header-right">
                                        <a href="{{ url('country') }}" class="btn btn-inverse btn-outline-inverse">Back</a>
                                    </div>
                                </div>
                                <div class="card-block">
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
                                    @if(\Session::has('success'))
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="alert alert-success border-success" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont-close-line-circled"></i>
                                                </button>
                                                {{ \Session::get('success') }}
                                            </div>

                                        </div>
                                    </div>
                                    @endif
                                    <br>
                                    <form action="{{ url('country',$country->ct_id) }}" method="post">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="country_name">Country Name</label>
                                                <input type="text" class="form-control" id="country_name" name="country_name"
                                                    placeholder="Country Name" value="{{ $country->ct_name }}"
                                                    autocomplete="nope">
                                                <input type="hidden" class="form-control" id="event_id" name="event_id"
                                                    placeholder="Event Name" value="{{ $country->ct_id }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 text-right">
                                                <button type="submit" class="btn btn-primary btn-outline-primary">Save</button>
                                            </div>
                                        </div>
                                        <hr>
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

@endsection
@section('js')

@endsection
