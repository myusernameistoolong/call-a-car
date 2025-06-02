@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-car"></i> Bewerk auto #{{ $car->id }}</h2>
                    <form action="/cars/{{ $car->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="brand">Merk *</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="@if(old('brand')){{ old('brand') }}@else{{ $car->brand }}@endif" placeholder="Ferrari" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="type">Type *</label>
                            <input type="text" class="form-control" id="type" name="type" value="@if(old('type')){{ old('type') }}@else{{ $car->type }}@endif" placeholder="Sportauto" required>
                        </div>
                        <div class="form-group">
                            <label for="license">Kenteken *</label>
                            <input type="text" class="form-control" id="license" name="license" value="@if(old('license')){{ old('license') }}@else{{ $car->license }}@endif" placeholder="798ds49saf874" required>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capaciteit *</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" value="@if(old('capacity')){{ old('capacity') }}@else{{ $car->capacity }}@endif" placeholder="5" required>
                        </div>
                        <div class="form-group">
                            <label for="allow_wheel_chair">Rolstoel toegangelijk</label>
                            <input type="checkbox" class="form-control" id="allow_wheel_chair" name="allow_wheel_chair" value="@if(old('allow_wheel_chair')){{ old('allow_wheel_chair') }}@else{{ $car->allow_wheel_chair }}@endif">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Categorie *</label>
                            <select class="form-control" id="category_id" name="category_id" required autofocus>
                                <option value="" disabled selected>Selecteer een categorie</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"<?php if($car->category_id && $car->category_id == $category->id) { echo "selected"; } ?>>{{ $category->name }}: {{ $category->price_per_km }} per KM</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Bewerk auto</button>
                        <button type="button" onclick="location.href='../'" class="btn btn-secondary"><i class="fas fa-ban"></i> Annuleren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
