@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-location-arrow"></i> Bewerk rit #{{ $ride->id }}</h2>
                    <form action="/rides/{{ $ride->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <select class="form-control" id="car_id" name="car_id" required autofocus>
                            <option value="" disabled selected>Selecteer een auto</option>
                            @foreach($cars as $car)
                                <option value="{{$car->id}}"<?php if($ride->car_id && $ride->car_id == $car->id) { echo "selected"; } ?>>{{ $car->brand }}: {{ $car->type }}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="start_country">start_country *</label>
                            <input type="text" class="form-control" id="start_country" name="start_country" value="@if(old('start_country')){{ old('start_country') }}@else{{ $ride->start_country }}@endif" placeholder="Nederland" required>
                        </div>
                        <div class="form-group">
                            <label for="start_city">start_city *</label>
                            <input type="text" class="form-control" id="start_city" name="start_city" value="@if(old('start_city')){{ old('start_city') }}@else{{ $ride->start_city }}@endif" placeholder="Zevenbergen" required>
                        </div>
                        <div class="form-group">
                            <label for="start_street">start_street *</label>
                            <input type="text" class="form-control" id="start_street" name="start_street" value="@if(old('start_street')){{ old('start_street') }}@else{{ $ride->start_street }}@endif" placeholder="Kamillestraat" required>
                        </div>
                        <div class="form-group">
                            <label for="dest_country">dest_country *</label>
                            <input type="text" class="form-control" id="dest_country" name="dest_country" value="@if(old('dest_country')){{ old('dest_country') }}@else{{ $ride->dest_country }}@endif" placeholder="Nederland" required>
                        </div>
                        <div class="form-group">
                            <label for="dest_city">dest_city *</label>
                            <input type="text" class="form-control" id="dest_city" name="dest_city" value="@if(old('dest_city')){{ old('dest_city') }}@else{{ $ride->dest_city }}@endif" placeholder="Breda" required>
                        </div>
                        <div class="form-group">
                            <label for="dest_street">dest_street *</label>
                            <input type="text" class="form-control" id="dest_street" name="dest_street" value="@if(old('dest_street')){{ old('dest_street') }}@else{{ $ride->dest_street }}@endif" placeholder="Lovensdijkstraat" required>
                        </div>
                        <div class="form-group">
                            <label for="arrive_date">arrive_date *</label>
                            <input type="date" class="form-control" id="arrive_date" name="arrive_date" value="@if(old('arrive_date')){{ old('arrive_date') }}@else{{ date("YYYY-mm-dd", strtotime($ride->arrive_date)) }}@endif" placeholder="05-01-2021" required>
                        </div>
                        <div class="form-group">
                            <label for="arrive_time">arrive_time *</label>
                            <input type="time" class="form-control" id="arrive_time" name="arrive_time" value="@if(old('arrive_time')){{ old('arrive_time') }}@else{{ $ride->arrive_time }}@endif" placeholder="10:00" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Bewerk rit</button>
                        <button type="button" onclick="location.href='../'" class="btn btn-secondary"><i class="fas fa-ban"></i> Annuleren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
