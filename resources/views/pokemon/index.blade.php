@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('pokemon.create') }}" class="btn btn-primary">Add New Pokemon</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Species</th>
                <th>Primary Type</th>
                <th>Power</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pokemons as $pokemon)
            <tr>
                <td>{{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $pokemon->name }}</td>
                <td>{{ $pokemon->species }}</td>
                <td>{{ $pokemon->primary_type }}</td>
                <td>{{ $pokemon->hp + $pokemon->attack + $pokemon->defense }}</td>
                <td>
                    <a href="{{ route('pokemon.edit', $pokemon->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('pokemon.destroy', $pokemon->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pokemons->links() }}
</div>
@endsection
