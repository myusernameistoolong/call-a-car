@extends('layouts.module_index', ['object' => $cars, 'object_name' => "cars", 'object_name_nl' => "auto", 'result_amounts' => $result_amounts])

@section('title_register')<i class="fas fa-car"></i> Auto's overzicht({{ Count($cars) }})@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-cars table-striped table-hover">
                            <thead>
                            <th><a href="/cars?sort_by=id&sort_order=@if($sorting[0]['sort_by'] == "id" && $sorting[0]['sort_order'] == "ASC")DESC"># <i class="fas fa-sort-down"> @else()ASC"># <i class="fas fa-sort-up"> @endif</i></a></th>
                            <th><a href="/cars?sort_by=brand&sort_order=@if($sorting[0]['sort_by'] == "brand" && $sorting[0]['sort_order'] == "ASC")DESC">Merk <i class="fas fa-sort-down"> @else()ASC">Merk <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><a href="/cars?sort_by=type&sort_order=@if($sorting[0]['sort_by'] == "type" && $sorting[0]['sort_order'] == "ASC")DESC">Type <i class="fas fa-sort-down"> @else()ASC">Type <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><a href="/cars?sort_by=capacity&sort_order=@if($sorting[0]['sort_by'] == "capacity" && $sorting[0]['sort_order'] == "ASC")DESC">Capaciteit <i class="fas fa-sort-down"> @else()ASC">Capaciteit <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><i class="fas fa-tools"></i> Acties</th>
                            </thead>
                            <tbody class="cars">
                            <?php $i = 0; ?>
                            @foreach($cars as $car)
                                <tr>
                                    <th class="col" scope="row" id="{{ $car->id }}">{{ $car->id }}</th>
                                    <td class="col"><a href="/cars/{{ $car->id }}">{{ $car->brand }}</a></td>
                                    <td class="col">{{ $car->type }}</td>
                                    <td class="col">{{ $car->capacity }}</td>
                                    <td class="col">
                                        <div class="btn-group">
                                            @if(Auth::guard('employee')->check())
                                                <button type="submit" class="btn btn-primary" onclick="window.location.href='/cars/{{ $car->id }}/edit'" title="Bewerk {{ $car->brand }}"><i class="fas fa-edit"></i></button>
                                            <button type="submit" class="btn btn-danger button-delete"
                                                    data-target="#delete-modal"
                                                    data-toggle="modal"
                                                    data-url="/cars/{{ $car->id }}"
                                                    data-name="{{ $car->brand }}"
                                                    data-last_name=""
                                                    data-object="car"
                                                    title="Verwijder {{ $car->brand }}"><i class="fas fa-trash-alt"></i>
                                            </button>
                                            @endif
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
