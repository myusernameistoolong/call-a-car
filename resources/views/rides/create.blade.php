@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-location-arrow"></i> Creëer een nieuwe rit</h2>
                    <form action="/rides" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="car_id">Auto *</label>
                            <select class="form-control" id="car_id" name="car_id" required autofocus>
                                <option value="" disabled selected>Selecteer een auto</option>
                                @foreach($cars as $car)
                                    <option value="{{$car->id}}" <?php if(old('car_id') == $car->id) { echo "selected"; } ?>>{{ $car->brand }}: {{ $car->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_country">Startland *</label>
                            <input type="text" class="form-control" id="start_country" name="start_country" value="{{ old('start_country') }}" placeholder="Nederland" required>
                        </div>
                        <div class="form-group">
                            <label for="start_city">Startstad *</label>
                            <input type="text" class="form-control" id="start_city" name="start_city" value="{{ old('start_city') }}" placeholder="Zevenbergen" required>
                        </div>
                        <div class="form-group">
                            <label for="start_street">Startstraat *</label>
                            <input type="text" class="form-control" id="start_street" name="start_street" value="{{ old('start_street') }}" placeholder="Kamillestraat" required>
                        </div>
                        <div class="form-group">
                            <label for="dest_country">Bestemmingsland *</label>
                            <input type="text" class="form-control" id="dest_country" name="dest_country" value="{{ old('dest_country') }}" placeholder="Nederland" required>
                        </div>
                        <div class="form-group">
                            <label for="dest_city">Bestemmingsstad *</label>
                            <input type="text" class="form-control" id="dest_city" name="dest_city" value="{{ old('dest_city') }}" placeholder="Breda" required>
                        </div>
                        <div class="form-group">
                            <label for="dest_street">Bestemmingsstreet *</label>
                            <input type="text" class="form-control" id="dest_street" name="dest_street" value="{{ old('dest_street') }}" placeholder="Lovensdijkstraat" required>
                        </div>
                        <div class="form-group">
                            <label for="arrive_date">Datum *</label>
                            <input type="date" class="form-control" id="arrive_date" name="arrive_date" value="{{ old('arrive_date') }}" placeholder="05-01-2021" required>
                        </div>
                        <div class="form-group">
                            <label for="arrive_time">Arriveertijd *</label>
                            <input type="time" class="form-control" id="arrive_time" name="arrive_time" value="{{ old('arrive_time') }}" placeholder="10:00" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Voeg rit toe</button>
                        <button type="button" onclick="location.href='/rides'" class="btn btn-secondary"><i class="fas fa-ban"></i> Annuleren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
