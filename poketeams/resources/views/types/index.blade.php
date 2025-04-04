@extends('layout.main')

@section('top-title')
    Tipos
@endsection

@section('title')
    <h1 class="mt-4">tipos</h1>
@endsection

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">Tipos</li>

    <a class="btn btn-primary m-auto 5rem" href=" {{ route('types.create') }}" role="button">
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
            <th>Creado hace</th>
 			<th>Registrado</th>
            <th>Actualizado hace</th>
 			<th>Acciones</th>
 		</tr>
 	</thead>
 	<tbody>
		@foreach($types as $type)

			<tr>
				<td>{{ $type->id }}</td>
				<td>{{ $type->name }}</td>
				<td>{{ $type->created_at-> diffForHumans() }}</td>
				<td>{{ $type->created_at->format('d/m/Y h:i:s') }}</td>
				<td>{{ $type->updated_at->format('d/m/Y h:i:s') }}</td>
				<td>
					<a class="btn btn-sm btn-primary" href="{{ route('types.show', $type->id) }}">
						<i class="fa fa-eye"></i>
					</a>

					<form action="{{ route('types.destroy', $type->id) }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-sm btn-danger">
							<i class="fa fa-trash"></i>
						</button>
					</form>


					<a href="{{ route('types.edit', $type->id) }}" class="btn btn-sm btn-success">
						<i class="fa fa-book"></i>
					</a>
				</td>
			</tr>

		@endforeach 		
 	</tbody>
 	
</table>

@endsection