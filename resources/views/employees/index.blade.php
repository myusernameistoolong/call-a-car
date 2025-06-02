@extends('layouts.module_index', ['object' => $employees, 'result_amounts' => $result_amounts])

@section('title_register')<i class="fas fa-user-tie"></i> Mederwerkers overzicht({{ Count($employees) }})@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-employees table-striped table-hover">
                            <thead>
                            <th><a href="/employees?sort_by=id&sort_order=@if($sorting[0]['sort_by'] == "id" && $sorting[0]['sort_order'] == "ASC")DESC"># <i class="fas fa-sort-down"> @else()ASC"># <i class="fas fa-sort-up"> @endif</i></a></th>
                            <th><a href="/employees?sort_by=name&sort_order=@if($sorting[0]['sort_by'] == "name" && $sorting[0]['sort_order'] == "ASC")DESC">Naam <i class="fas fa-sort-down"> @else()ASC">Naam <i class="fas fa-sort-up"> @endif</i></a></th>
                            <th><a href="/employees?sort_by=email&sort_order=@if($sorting[0]['sort_by'] == "email" && $sorting[0]['sort_order'] == "ASC")DESC">E-mail <i class="fas fa-sort-down"> @else()ASC">E-mail <i class="fas fa-sort-up"> @endif</i></a></th>
                            <th><a href="/employees?sort_by=city&sort_order=@if($sorting[0]['sort_by'] == "city" && $sorting[0]['sort_order'] == "ASC")DESC">Woonplaats <i class="fas fa-sort-down"> @else()ASC">Woonplaats <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><a href="/employees?sort_by=phone&sort_order=@if($sorting[0]['sort_by'] == "phone" && $sorting[0]['sort_order'] == "ASC")DESC">Telefoonnummer <i class="fas fa-sort-down"> @else()ASC">Telefoonnummer <i class="fas fa-sort-up"> @endif</i></a></i></th>
                            <th><i class="fas fa-tools"></i> Acties</th>
                            </thead>
                            <tbody class="employees">
                            <?php $i = 0; ?>
                            @foreach($employees as $employee)
                                <tr>
                                    <th class="col" scope="row" id="{{ $employee->id }}">{{ $employee->id }}</th>
                                    <td class="col"><a href="/employees/{{ $employee->id }}">{{ $employee->name }}</a></td>
                                    <td class="col"><a href="emailto:{{ $employee->email }}">{{ $employee->email }}</a></td>
                                    <td class="col">{{ $employee->city }}</td>
                                    <td class="col">{{ $employee->phone }}</td>
                                    <td class="col">
                                        <div class="btn-group">
{{--                                            <button type="submit" class="btn btn-primary" onclick="window.location.href='/employees/{{ $employee->id }}/edit'" title="Bewerk {{ $employee->name }}"><i class="fas fa-edit"></i></button>--}}
                                            <button type="submit" class="btn btn-danger button-delete"
                                                    data-target="#delete-modal"
                                                    data-toggle="modal"
                                                    data-url="/employees/{{ $employee->id }}"
                                                    data-name="{{ $employee->name }}"
                                                    data-last_name=""
                                                    data-object="employee"
                                                    title="Verwijder {{ $employee->name }}"><i class="fas fa-trash-alt"></i>
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
