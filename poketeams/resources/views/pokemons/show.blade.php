@extends('layout.main')
@section('top-title')
    Pokemon {{ $pokemon->name }}
@endsection
@section('title')
    <h1 class="mt-4">Pokemon - {{ $pokemon->name }}</h1>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pokemons')}}"> Pokemons</a>
    </li>
    <li class="breadcrumb-item">{{ $pokemon->name}}</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">{{ $pokemon->name }}</div>
        <div class="card-body">
            <div class="card-title">
                <strong>{{ $pokemon->mote }}</strong>
            </div>
            <div class="row">
                <!-- Imagen del pokemon -->
                <div class="d-flex">
                    @if (!isset($pokemonData['sprites']['front_default']) && !isset($pokemonData['sprites']['back_default']))
                        <img src="https://wiki.p-insurgence.com/images/0/09/722.png" alt="No image" class="img-fluid">
                    @else
                        <img src="{{ $pokemonData['sprites']['front_default'] ?? 'https://wiki.p-insurgence.com/images/0/09/722.png' }}" 
                            alt="Pokemon {{ $pokemon->name }}" class="img-fluid">
                        <img src="{{ $pokemonData['sprites']['back_default'] ?? '' }}" alt="">
                    @endif
                </div>
            </div>
            <p class="card-text">{{ $pokemon->type }}</p>
        </div>
        <div class="card-footer text-muted">{{ $pokemon->name }}

        <div class=" text-muted">{{ $pokemon->mote }}</div>
        <div class=" text-muted">{{ $pokemon->types->name }}</div>
        <div class=" text-muted">{{ $pokemon->level }}</div>
        </div>

    </div>


@endsection
