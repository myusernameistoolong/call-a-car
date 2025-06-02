@extends('layouts.module_index', ['object' => $clients, 'result_amounts' => $result_amounts])

@section('title_register')<i class="fas fa-users"></i> Klanten overzicht({{ Count($clients) }})@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-clients table-striped table-hover">
                            <thead>
                            <th><a href="/clients?sort_by=id&sort_order=@if($sorting[0]['sort_by'] == "id" && $sorting[0]['sort_order'] == "ASC")DESC"># <i class="fas fa-sort-down"> @else()ASC"># <i class="fas fa-sort-up"> @endif</i></a></th>
                            <th><a href="/clients?sort_by=name&sort_order=@if($sorting[0]['sort_by'] == "name" && $sorting[0]['sort_order'] == "ASC")DESC">Naam <i class="fas fa-sort-down"> @else()ASC">Naam <i class="fas fa-sort-up"> @endif</i></a></th>
                            <th><a href="/clients?sort_by=email&sort_order=@if($sorting[0]['sort_by'] == "email" && $sorting[0]['sort_order'] == "ASC")DESC">E-mail <i class="fas fa-sort-down"> @else()ASC">E-mail <i class="fas fa-sort-up"> @endif</i></a></th>
                            <th><a href="/clients?sort_by=city&sort_order=@if($sorting[0]['sort_by'] == "city" && $sorting[0]['sort_order'] == "ASC")DESC">Woonplaats <i class="fas fa-sort-down"> @else()ASC">Woonplaats <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><a href="/clients?sort_by=phone&sort_order=@if($sorting[0]['sort_by'] == "phone" && $sorting[0]['sort_order'] == "ASC")DESC">Telefoonnummer <i class="fas fa-sort-down"> @else()ASC">Telefoonnummer <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><i class="fas fa-tools"></i> Acties</th>
                            </thead>
                            <tbody class="clients">
                            <?php $i = 0; ?>
                            @foreach($clients as $client)
                                <tr>
                                    <th class="col" scope="row" id="{{ $client->id }}">{{ $client->id }}</th>
                                    <td class="col"><a href="/clients/{{ $client->id }}">{{ $client->name }}</a></td>
                                    <td class="col"><a href="emailto:{{ $client->email }}">{{ $client->email }}</a></td>
                                    <td class="col">{{ $client->city }}</td>
                                    <td class="col">{{ $client->phone }}</td>
                                    <td class="col">
                                        <div class="btn-group">
{{--                                            <button type="submit" class="btn btn-primary" onclick="window.location.href='/clients/{{ $client->id }}/edit'" title="Bewerk {{ $client->name }}"><i class="fas fa-edit"></i></button>--}}
                                            <button type="submit" class="btn btn-danger button-delete"
                                                    data-target="#delete-modal"
                                                    data-toggle="modal"
                                                    data-url="/clients/{{ $client->id }}"
                                                    data-name="{{ $client->name }}"
                                                    data-last_name=""
                                                    data-object="client"
                                                    title="Verwijder {{ $client->name }}"><i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
