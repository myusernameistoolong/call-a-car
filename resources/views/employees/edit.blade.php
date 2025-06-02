@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-user-tie"></i> Bewerk medewerker #{{ $employee->id }}</h2>
                    <form action="/employees/{{ $employee->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Naam</label>
                            <input type="text" class="form-control" id="name" name="name" value="@if(old('name')){{ old('name') }}@else{{ $employee->name }}@endif" placeholder="Frederick" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="insertionss">Tussenvoegsel</label>
                            <input type="text" class="form-control" id="insertion" name="insertion" value="@if(old('insertion')){{ old('insertion') }}@else{{ $employee->insertion }}@endif" placeholder="The" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Achternaam</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="@if(old('last_name')){{ old('last_name') }}@else{{ $employee->last_name }}@endif" placeholder="Great" required>
                        </div>
                        <div class="form-group">
                            <label for="initials">Voorletters</label>
                            <input type="text" class="form-control" id="initials" name="initials" value="@if(old('initials')){{ old('initials') }}@else{{ $employee->initials }}@endif" placeholder="FTG" required>
                        </div>
                        <div class="form-group">
                            <label for="residence">Woonplaats</label>
                            <input type="text" class="form-control" id="residence" name="residence" value="@if(old('residence')){{ old('residence') }}@else{{ $employee->residence }}@endif" placeholder="Pruisen" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Gebruikersnaam/e-mail</label>
                            <input type="text" class="form-control" id="username" name="username" value="@if(old('username')){{ old('username') }}@else{{ $employee->username }}@endif" placeholder="Frederick" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email" value="@if(old('email')){{ old('email') }}@else{{ $employee->email }}@endif" placeholder="discipline@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Wachtwoord</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="W8woord">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Bewerk medewerker</button>
                        <button type="button" onclick="location.href='../'" class="btn btn-secondary"><i class="fas fa-ban"></i> Annuleren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
