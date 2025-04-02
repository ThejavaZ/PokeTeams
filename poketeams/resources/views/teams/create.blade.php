@extends('layout.main')
@section('top-title')
    crear equipo
@endsection
@section('title')
    <h1 class="mt-4">Crear equipo</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('teams.index')}}"> Equipos</a>
    </li>
    <li class="breadcrumb-item">Crear</li>
@endsection

@section('content')
    <form action="{{ route('teams.store')}}" method="POST">
        @csrf
        @method('POST')
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del equipo">

        <label for="name">id pokemon:</label>
        <input type="number" name="pokemon_id" id="pokemon_id" class="form-control" placeholder="ID del pokemon">

        <label for="name">id entrenador:</label>
        <input type="number" name="trainer_id" id="trainer_id" class="form-control" placeholder="ID del entrenador">
        
        <button type="submit" class="btn btn-primary mt-3">Crear</button>
        
    </form>
@endsection