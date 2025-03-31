@extends('layout.main')
@section('top-title')
    Trainers
    
@endsection
@section('title')
    <h1>Trainers</h1>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Trainers</li>

    <a href="" class="btn btn-primary m-auto">
        <i class="fa fa-plus"></i>
    </a>
@endsection

@section('content')
    {{ $trainers }}
@endsection
