@extends('layout.main')
@section('top-title')
    Entrenador: {{ $trainer->name }}
@endsection
@section('title')
    <h1 class="mt-4">Entrenador - {{ $trainer->name }}</h1>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('trainers.index')}}"> Entrenadores</a>
    </li>
    <li class="breadcrumb-item">{{ $trainer->name}}</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">{{ $trainer->name }}</div>
        <div class="card-body">
            <p class="card-text">ID: <strong>{{ $trainer->id }}</strong></p>
            <p class="card-text">Nombre: {{ $trainer->name }}</p>
            <p class="card-text">Region: {{ $trainer->region }}</p>
            <p class="card-text">Creado: {{ $trainer->created_at->diffForHumans() }}</p>
            <p class="card-text">Actualizado: {{ $trainer->updated_at->diffForHumans() }}</p>
        </div>
    </div>


@endsection
