@extends('layout.main')

@section('top-title')
    Pokemones
@endsection

@section('title')
    <h1 class="mt-4">Pokemons</h1>
@endsection

@section('breadcrumb')

    <li class="breadcrumb-item">
        <a href="{{ route('index')}}"> Dashboard</a>
    </li>
    <li class="breadcrumb-item">Pokemons</li>

    <a class="btn btn-primary m-auto 5rem" href=" {{ route('pokemons.create') }}" role="button">
        <i class="fa fa-plus"></i>
    </a>
@endsection

@section('content')
    <h1>Todos los Pokemons</h1>

<table class="table table-bordered table-hover">
 	<thead class="table-primary">
 		<tr>
 			<th>ID</th>
 			<th>Nombre</th>
 			<th>Mote</th>
 			<th>Tipo</th>
 			<th>Nivel</th>
            <th>Creado hace</th>
 			<th>Registrado</th>
            <th>Actualizado hace</th>
 			<th>Acciones</th>
 		</tr>
 	</thead>
 	<tbody>
		@foreach($pokemons as $pokemon)

			<tr>
				<td>{{ $pokemon->id }}</td>
				<td>{{ $pokemon->name }}</td>
				<td>{{ $pokemon->mote }}</td>
				<td>{{ $pokemon->types ? $pokemon->types->name : 'N/A' }}</td>
				<td>{{ $pokemon->level }}</td>
				<td>{{ $pokemon->created_at-> diffForHumans() }}</td>
				<td>{{ $pokemon->created_at->format('d/m/Y h:i:s') }}</td>
				<td>{{ $pokemon->updated_at->format('d/m/Y h:i:s') }}</td>
				<td>
					<a class="btn btn-sm btn-primary" href="{{ route('pokemons.show', $pokemon->id) }}">
						<i class="fa fa-eye"></i>
					</a>
                    <form action="{{ 'pokemons.destroy ', $pokemon->id }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
					<a href="{{ route('pokemons.edit', $pokemon->id) }}" class="btn btn-sm btn-success">
						<i class="fa fa-book"></i>
					</a>
				</td>
			</tr>

		@endforeach 		
 	</tbody>
 	
</table>

@endsection