@extends('layout.main')
@section('top-title')
    Crear Pokemon
@endsection
@section('title')
    <h1 class="mt-4">Crear Pokemon</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pokemons')}}"> Pokemons</a>
    </li>
    <li class="breadcrumb-item">Crear pokemon</li>
@endsection

@section('content')
    <form action="{{ route('pokemons.store')}}" method="POST">
        @csrf
        @method('POST')
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del pokemon">
        <label for="mote">Mote:</label>
        <input type="text" name="mote" id="mote" class="form-control" placeholder="Mote del pokemon">
        <label for="type_id">Tipo:</label>
        <select name="type_id" class="form-control" required>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ $type->id == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
        <label for="">Nivel:</label>
        <input type="number" name="level" id="level" class="form-control" placeholder="Nivel del pokemon">
        
        <button type="submit" class="btn btn-primary mt-3">Crear Pokemon</button>
        
    </form>
@endsection