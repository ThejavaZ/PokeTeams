@extends('layout.main')
@section('top-title')
    Equipos
@endsection
@section('title')
    <h1>Equipos</h1>
@endsection
@section('breadcrumb')
    <a href="{{ route('index') }}" class="breadcrumb-item">Dashboard</a>
    <li class="breadcrumb-item active">Equipos</li>

    <li class=" m-auto"><a href="{{ route('teams.create') }}" class="btn btn-primary ">
    <i class="fa fa-plus"></i>
    </a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Pokemon</th>
                                <th>Entrenador</th>
                                <th>Creado hace</th>
                                <th>Creado</th>
                                <th>Actualizado hace</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)
                                <tr>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $team->pokemons?->name  }}</td>
                                    <td>{{ $team->trainers?->name}}</td>
                                    <td>{{ $team->created_at->diffForHumans() }}</td>
                                    <td>{{ $team->created_at->format('d/M/Y h:i:s') }}</td>
                                    <td>{{ $team->updated_at->format('d/M/Y h:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('teams.show', $team->id) }}" class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-success">
                                            <i class="fa fa-book"></i>
                                        </a>
                                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection