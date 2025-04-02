@extends('layout.main')
@section('top-title')
    crear tipo
@endsection
@section('title')
    <h1 class="mt-4">Crear tipo</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('types.index')}}"> Tipo</a>
    </li>
    <li class="breadcrumb-item">Crear Tipo</li>
@endsection

@section('content')
    <form action="{{ route('types.store')}}" method="POST">
        @csrf
        @method('POST')
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del equipo">
        <button type="submit" class="btn btn-primary mt-3">Crear equipo</button>
        
    </form>
@endsection