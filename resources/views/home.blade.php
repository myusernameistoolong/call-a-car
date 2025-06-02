@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <h1 class="display-4">Hallo, {{ ucfirst(Auth::user()->name) }}!</h1>
                <p class="lead">Waar wilt u vandaag naar toe?</p>
                <hr class="my-4">
                <p>Navigeer door het nav-menu in de rechterhoek of creëer direct een rit, klik hiervoor op de onderstaande knop.</p>
                <p class="row justify-content-sm-around">
                    <a class="btn btn-primary btn-lg" href="/rides/createHome" role="button" style="font-size: 30px;"><i class="fas fa-home"></i> Naar huis</a>
                    <a class="btn btn-primary btn-lg" href="/rides/createLastRoute" role="button" style="font-size: 30px;"><i class="fas fa-map-marker-alt"></i> Vorige route</a>
                </p>
            </div>
        </div>
    </div>
@endsection
