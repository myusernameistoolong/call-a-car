@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-car"></i> Medewerker #{{ $employee->id }}</h2>
                    <p>Naam: {{ $employee->name }} {{ $employee->last_name }}</p>
                    <p>Geboortedatum: {{ $employee->bday }}</p>
                    <p>Land: {{ $employee->country }}</p>
                    <p>Woonplaats: {{ $employee->city }}</p>
                    <p>Straat: {{ $employee->street }}</p>
                    <p>Telefoonnummer: {{ $employee->phone }}</p>
                    <p>Aangemaakt op: {{ $employee->created_at }}</p>
                    <p>Laatst bewerkt op: {{ $employee->updated_at }}</p>

                    <button type="button" onclick="location.href='/employees'" class="btn btn-secondary"><i class="fas fa-undo"></i> Ga terug</button>
                </div>
            </div>
        </div>
    </div>
@endsection
