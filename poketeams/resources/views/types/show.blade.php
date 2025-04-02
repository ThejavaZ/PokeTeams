@extends('layout.main')
@section('top-title')
    Tipo: {{ $type->name }}
@endsection
@section('title')
    <h1 class="mt-4">type - {{ $type->name }}</h1>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('types.index')}}"> types</a>
    </li>
    <li class="breadcrumb-item">{{ $type->name}}</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">{{ $type->name }}</div>
        <div class="card-body">
            <p class="card-text">ID: <strong>{{ $type->id }}</strong></p>
            <p class="card-text">Nombre: {{ $type->name }}</p>
            <p class="card-text">Creado: {{ $type->created_at->diffForHumans() }}</p>
            <p class="card-text">Actualizado: {{ $type->updated_at->diffForHumans() }}</p>
        </div>
    </div>


@endsection
