@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-car"></i> Creëer een nieuwe auto</h2>
                    <form action="/cars" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="brand">Merk *</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}" placeholder="Ferrari" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="type">Type *</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" placeholder="Sportauto" required>
                        </div>
                        <div class="form-group">
                            <label for="license">Kenteken *</label>
                            <input type="text" class="form-control" id="license" name="license" value="{{ old('license') }}" placeholder="798ds49saf874" required>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capaciteit *</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity') }}" placeholder="5" required>
                        </div>
                        <div class="form-group">
                            <label for="allow_wheel_chair">Rolstoel toegangelijk</label>
                            <input type="checkbox" class="form-control" id="allow_wheel_chair" name="allow_wheel_chair" value="{{ old('allow_wheel_chair') }}">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Categorie *</label>
                            <select class="form-control" id="category_id" name="category_id" required autofocus>
                                <option value="" disabled selected>Selecteer een categorie</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" <?php if(old('category_id') == $category->id) { echo "selected"; } ?>>{{ $category->name }}: {{ $category->price_per_km }} per KM</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Voeg auto toe</button>
                        <button type="button" onclick="location.href='/cars'" class="btn btn-secondary"><i class="fas fa-ban"></i> Annuleren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
