@extends('layout.main')

@section('top-title')
    Editar team
@endsection

@section('title')
    <h1>Editar a: {{ $team->name }}</h1>
@endsection

@section('breadcrumb')
        <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('teams.index')}}"> Teams</a>
    </li>
    <li class="breadcrumb-item">{{ $team->name}}</li>
@endsection

@section('content')
    <form
    class="form border-1"
    action="{{ route('teams.update', $team->id) }}" method="POST">
    @csrf
    @method('PUT')
        <label for="">Nombre: {{ $team->name}}</label>
        <input type="text" name="name" class="form-control" placeholder="{{ $team->name }}" required>

        <label for="">ID pokemon: {{ $team->pokemon_id}}</label>
        <input type="number" name="pokemon_id" class="form-control" placeholder="{{ $team->pokemon_id }}" required>

        <label for="">ID entrenador: {{ $team->trainer_id}}</label>
        <input type="number" name="trainer_id" class="form-control" placeholder="{{ $team->trainer_id }}" required>
        
        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        <a href="{{ route('teams.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@endsection