@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-car"></i> Auto #{{ $car->id }}</h2>
                    <p>Merk: {{ $car->brand }}</p>
                    <p>Type: {{ $car->type }}</p>
                    <p>Kenteken: {{ $car->license }}</p>
                    <p>Rolstoel toegangelijk: @if($car->allow_wheel_chair) Ja @else Nee @endif</p>
                    <p>Categorie: {{ $category->name }}</p>
                    <p>Aangemaakt op: {{ $car->created_at }}</p>
                    <p>Laatst bewerkt op: {{ $car->updated_at }}</p>

                    @guest
                        <p>Login in om dit product te kopen.</p>
                    @else
                        <form action="/invoices" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="client" name="client" value="{{ Auth::user()->id }}">
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="car" name="car" value="{{ $car->id }}">
                            </div>
                        </form>
                    @endguest
                    <button type="button" onclick="location.href='/cars'" class="btn btn-secondary"><i class="fas fa-undo"></i> Ga terug</button>
                </div>
            </div>
        </div>
    </div>
@endsection
