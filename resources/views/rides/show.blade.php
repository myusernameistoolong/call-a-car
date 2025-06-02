@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-location-arrow"></i> Rit #{{ $ride->id }}</h2>
                    <p>Wie: <a href="/clients/{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}</a></p>
                    <p>Auto: <a href="/cars/{{ $car->id }}">{{ $car->brand }} {{ $car->type }}</a></p>
                    <p>Van: {{ $ride->start_country }} {{ $ride->start_city }} {{ $ride->start_street }}</p>
                    <p>Naar: {{ $ride->dest_country }} {{ $ride->dest_city }} {{ $ride->dest_street }}</p>
                    <p>Datum: {{ $ride->arrive_date }}</p>
                    <p>Tijd: {{ $ride->arrive_time }}</p>
                    <p>Kosten: €{{ number_format($ride->costs, 2) }}</p>
                    <p>Aangemaakt op: {{ $ride->created_at }}</p>
                    <p>Laatst bewerkt op: {{ $ride->updated_at }}</p>
                    <button type="button" onclick="location.href='/rides'" class="btn btn-secondary"><i class="fas fa-undo"></i> Ga terug</button>
                </div>
            </div>
        </div>
    </div>
@endsection
