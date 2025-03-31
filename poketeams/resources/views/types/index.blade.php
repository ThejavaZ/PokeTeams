@extends('layout.main')

@section('top-title')
    Tipos
@endsection

@section('title')
    <h1>Tipos</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Tipos</li>

    <li class=" m-auto"><a href="{{ route('types.create') }}" class="btn btn-primary ">
    <i class="fa fa-plus"></i>    
    </a></li>
@endsection

@section('content')
    {{ $types }}
@endsection