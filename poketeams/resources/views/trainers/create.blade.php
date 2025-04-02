@extends('layout.main')
@section('top-title')
    crear entrenador
@endsection
@section('title')
    <h1 class="mt-4">Crear entrenador</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('trainers.index')}}"> Entrenadores</a>
    </li>
    <li class="breadcrumb-item">Crear</li>
@endsection

@section('content')
    <form action="{{ route('trainers.store')}}" method="POST">
        @csrf
        @method('POST')
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del entrenador">

        <label for="name">Region:</label>
        <input type="text" name="region" id="region" class="form-control" placeholder="Region">
        <button type="submit" class="btn btn-primary mt-3">Crear</button>
        
    </form>
@endsection