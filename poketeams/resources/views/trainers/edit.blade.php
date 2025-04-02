@extends('layout.main')
@section('top-title')
    Editar entrenador
@endsection
@section('title')
    <h1 class="mt-4">Editar entrenador</h1>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('trainers.index') }}">tipos</a></li>
    <li class="breadcrumb-item">Editar</li>
    
    
@endsection

@section('content')
    <form
    class="form border-1"
    action="{{ route('trainers.update', $trainer->id) }}" method="POST">
    @csrf
    @method('PUT')
        <label for="">Nombre: {{ $trainer->name}}</label>
        <input type="text" name="name" class="form-control" placeholder="{{ $trainer->name }}" required>

        <label for="">Region: {{ $trainer->region}}</label>
        <input type="text" name="region" class="form-control" placeholder="{{ $trainer->region }}" required>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        <a href="{{ route('types.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@endsection