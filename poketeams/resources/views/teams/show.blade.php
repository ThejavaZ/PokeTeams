@extends('layout.main')

@section('top-title')
    Team
@endsection

@section('title')
    <h1>Teams</h1>
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
    <div class="card">
        <div class="card-header">
            <h3>Descripcion del equipo</h3>
        </div>
        <div class="card-body">    
            <p class="card-text">{{ $team->id }}</p>
            <p class="card-text">{{ $team->name }}</p>
            <p class="card-text">{{ $team->pokemons?->name }}</p>
            <p class="card-text">{{ $team->trainers?->name }}</p>
            
        </div>

    </div>
@endsection