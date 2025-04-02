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

    <a href="{{ route("trainers.create") }}" class="btn btn-primary m-auto">
        <i class="fa fa-plus"></i>
    </a>
@endsection

@section('content')


<h1>Todos los tipos</h1>

<table class="table table-bordered table-hover">
 	<thead class="table-primary">
 		<tr>
 			<th>ID</th>
 			<th>Nombre</th>
            <th>Region</th>
            <th>Creado hace</th>
 			<th>Registrado</th>
            <th>Actualizado hace</th>
 			<th>Acciones</th>
 		</tr>
 	</thead>
 	<tbody>
		@foreach($trainers as $trainer)

			<tr>
				<td>{{ $trainer->id }}</td>
				<td>{{ $trainer->name }}</td>
                <td>{{ $trainer->region }}</td>
				<td>{{ $trainer->created_at-> diffForHumans() }}</td>
				<td>{{ $trainer->created_at->format('d/m/Y h:i:s') }}</td>
				<td>{{ $trainer->updated_at->format('d/m/Y h:i:s') }}</td>
				<td>
					<a class="btn btn-sm btn-primary" href="{{ route('trainers.show', $trainer->id) }}">
						<i class="fa fa-eye"></i>
					</a>

					<form action="{{ route('trainers.destroy', $trainer->id) }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-sm btn-danger">
							<i class="fa fa-trash"></i>
						</button>
					</form>


					<a href="{{ route('trainers.edit', $trainer->id) }}" class="btn btn-sm btn-success">
						<i class="fa fa-book"></i>
					</a>
				</td>
			</tr>

		@endforeach 		
 	</tbody>
 	
</table>

@endsection
