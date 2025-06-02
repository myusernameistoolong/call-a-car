@extends('layouts.module_index', ['object' => $rides, 'object_name' => "rides", 'object_name_nl' => "rit", 'result_amounts' => $result_amounts])

@section('title_register')<i class="fas fa-location-arrow"></i> Ritten overzicht({{ Count($rides) }})@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-cars table-striped table-hover">
                            <thead>
                            <th><a href="/rides?sort_by=id&sort_order=@if($sorting[0]['sort_by'] == "id" && $sorting[0]['sort_order'] == "ASC")DESC"># <i class="fas fa-sort-down"> @else()ASC"># <i class="fas fa-sort-up"> @endif</i></a></th>
                            <th><a href="/rides?sort_by=created_at&sort_order=@if($sorting[0]['sort_by'] == "created_at" && $sorting[0]['sort_order'] == "ASC")DESC">Route <i class="fas fa-sort-down"> @else()ASC">Route <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><a href="/rides?sort_by=arrive_date&sort_order=@if($sorting[0]['sort_by'] == "arrive_date" && $sorting[0]['sort_order'] == "ASC")DESC">Datum <i class="fas fa-sort-down"> @else()ASC">Datum <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><a href="/rides?sort_by=arrive_time&sort_order=@if($sorting[0]['sort_by'] == "arrive_time" && $sorting[0]['sort_order'] == "ASC")DESC">Tijd <i class="fas fa-sort-down"> @else()ASC">Tijd <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><a href="/rides?sort_by=distance&sort_order=@if($sorting[0]['sort_by'] == "distance" && $sorting[0]['sort_order'] == "ASC")DESC">Afstand <i class="fas fa-sort-down"> @else()ASC">Afstand <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><a href="/rides?sort_by=costs&sort_order=@if($sorting[0]['sort_by'] == "costs" && $sorting[0]['sort_order'] == "ASC")DESC">Prijs <i class="fas fa-sort-down"> @else()ASC">Prijs <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><i class="fas fa-tools"></i> Acties</th>
                            </thead>
                            <tbody class="cars">
                            <?php $i = 0; ?>
                            @foreach($rides as $ride)
                                <tr>
                                    <th class="col" scope="row" id="{{ $ride->id }}">{{ $ride->id }}</th>
                                    <td class="col"><a href="/rides/{{ $ride->id }}">{{ $ride->start_city }} naar {{ $ride->dest_city }}</a></td>
                                    <td class="col">{{ $ride->arrive_date }}</td>
                                    <td class="col">{{ $ride->arrive_time }}</td>
                                    <td class="col">{{ $ride->distance }}</td>
                                    <td class="col">€{{ number_format($ride->costs, 2) }}</td>
                                    <td class="col">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary" onclick="window.location.href='/rides/{{ $ride->id }}/edit'" title="Bewerk {{ $ride->id }}"><i class="fas fa-edit"></i></button>
                                            <button type="submit" class="btn btn-danger button-delete"
                                                    data-target="#delete-modal"
                                                    data-toggle="modal"
                                                    data-url="/rides/{{ $ride->id }}"
                                                    data-name="{{ $ride->id }}"
                                                    data-last_name=""
                                                    data-object="car"
                                                    title="Verwijder {{ $ride->id }}"><i class="fas fa-trash-alt"></i>
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
