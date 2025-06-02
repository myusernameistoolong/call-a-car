@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="my-4"><i class="fas fa-user-tie"></i> Creëer een nieuwe medewerker</h2>
                    <form action="/employees" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Naam *</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Frederick">
                        </div>
                        <div class="form-group">
                            <label for="insertion">Tussenvoegsel *</label>
                            <input type="text" class="form-control" id="insertion" name="insertion" value="{{ old('insertion') }}" placeholder="The">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Achternaam *</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Great">
                        </div>
                        <div class="form-group">
                            <label for="initials">Voorletters *</label>
                            <input type="text" class="form-control" id="initials" name="initials" value="{{ old('initials') }}" placeholder="FTG">
                        </div>
                        <div class="form-group">
                            <label for="residence">Woonplaats *</label>
                            <input type="text" class="form-control" id="residence" name="residence" value="{{ old('residence') }}" placeholder="Pruisen">
                        </div>
                        <div class="form-group">
                            <label for="username">Gebruikersnaam *</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Frederick">
                        </div>
                        <div class="form-group">
                            <label for="email">Gebruikersnaam/e-mail *</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="discipline@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="password">Wachtwoord *</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="W8woord">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Voeg credential toe</button>
                        <button type="button" onclick="location.href='/employees'" class="btn btn-secondary"><i class="fas fa-ban"></i> Annuleren</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
