@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-car"></i> Gebruiker #{{ $client->id }}</h2>
                    <p>Naam: {{ $client->name }} {{ $client->last_name }}</p>
                    <p>Geboortedatum: {{ $client->bday }}</p>
                    <p>Land: {{ $client->country }}</p>
                    <p>Woonplaats: {{ $client->city }}</p>
                    <p>Straat: {{ $client->street }}</p>
                    <p>Toestemming privacy: @if($client->privacy_permission) Ja @else Nee @endif</p>
                    <p>Telefoonnummer: {{ $client->phone }}</p>
                    <p>Aangemaakt op: {{ $client->created_at }}</p>
                    <p>Laatst bewerkt op: {{ $client->updated_at }}</p>

                    <h2 class="my-4">Ritten</h2>
                    <?php if(!isset($rides) || count($rides) <= 0) { echo "<p>Geen ritten gevonden!</p>"; } else { $i = 1; $total = 0; ?>
                    @foreach($rides as $ride)
                        <p>{{ $i }}. <a href="/rides/{{ $ride->id }}">Van {{ $ride->start_city }} naar {{ $ride->dest_city }} op {{ $ride->arrive_date }} om {{ $ride->arrive_time }} </a>€{{ number_format($ride->costs, 2) }}</p>
                        <?php $i++; $total += $ride->costs; ?>
                    @endforeach
                    <p>Totaal: €{{ number_format($total, 2) }}</p>
                    <?php } ?>
                    <button type="button" onclick="location.href='/clients'" class="btn btn-secondary"><i class="fas fa-undo"></i> Ga terug</button>
                </div>
            </div>
        </div>
    </div>
@endsection
