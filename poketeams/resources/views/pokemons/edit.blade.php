@extends('layout.main')
@section('top-title')
    Editar Pokemon
@endsection
@section('title')
    <h1 class="mt-4">Editar Pokemon</h1>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('pokemons') }}">Pokemons</a></li>
    <li class="breadcrumb-item">Editar</li>
    
    
@endsection

@section('content')
    <form
    class="form border-1"
    action="{{ route('pokemons.update', $pokemon->id) }}" method="POST">
        <label for="">Nombre: {{ $pokemon->name}}</label>
        <input type="text" name="name" class="form-control" value="{{ $pokemon->name }}" required>
        <label for="">Mote: {{ $pokemon->mote}}</label>
        <input type="text" name="mote" class="form-control" value="{{ $pokemon->mote }}" required>
        <label for="">Tipo: {{ $pokemon->type_id}}</label> 
        <select name="type_id" class="form-control" required>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ $pokemon->type_id == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
        <label for="">Nivel: {{ $pokemon->level}}</label>
        <input type="number" name="level" class="form-control" value="{{ $pokemon->level }}" required>
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        <a href="{{ route('pokemons') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@endsection