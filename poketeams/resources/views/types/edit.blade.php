@extends('layout.main')
@section('top-title')
    Editar tipo
@endsection
@section('title')
    <h1 class="mt-4">Editar tipo</h1>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('types.index') }}">tipos</a></li>
    <li class="breadcrumb-item">Editar</li>
    
    
@endsection

@section('content')
    <form
    class="form border-1"
    action="{{ route('types.update', $type->id) }}" method="POST">
    @csrf
    @method('PUT')
        <label for="">Nombre: {{ $type->name}}</label>
        <input type="text" name="name" class="form-control" value="{{ $type->name }}" required>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        <a href="{{ route('types.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@endsection