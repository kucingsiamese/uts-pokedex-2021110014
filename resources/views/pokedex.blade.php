@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($pokemons as $pokemon)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/photos/' . $pokemon->photo) }}" class="card-img-top" alt="{{ $pokemon->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }} - {{ $pokemon->name }}</h5>
                        <p class="card-text">{{ $pokemon->primary_type }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $pokemons->links() }}
</div>
@endsection
