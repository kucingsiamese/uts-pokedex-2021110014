<?php

namespace App\Http\Controllers;
use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware(middleware: 'auth')->only(methods: 'login');
    }

     public function index()
    {
        $pokemons = Pokemon::paginate(20);
        return view('pokemon.index', compact('pokemons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pokemon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'weight' => 'numeric|max:99999999|min:0',
            'height' => 'numeric|max:99999999|min:0',
            'hp' => 'integer|min:0|max:9999',
            'attack' => 'integer|min:0|max:9999',
            'defense' => 'integer|min:0|max:9999',
            'is_legendary' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $validated['photo'] = basename($path);
        }
        Pokemon::create($validated);

        return redirect()->route('pokemon.index')->with('success', 'Pokemon created successfully');
        }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pokemon = Pokemon::findOrFail($id);
        return view('pokemon.show', compact('pokemon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pokemon = Pokemon::findOrFail($id);
        return view('pokemon.edit', compact('pokemon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'weight' => 'numeric|max:99999999|min:0',
            'height' => 'numeric|max:99999999|min:0',
            'hp' => 'integer|min:0|max:9999',
            'attack' => 'integer|min:0|max:9999',
            'defense' => 'integer|min:0|max:9999',
            'is_legendary' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        $pokemon = Pokemon::findOrFail($id);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $validated['photo'] = basename($path);
        }

        $pokemon->update($validated);
        return redirect()->route('pokemon.index')->with('success', 'Pokemon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $pokemon->delete();
        return redirect()->route('pokemon.index')->with('success', 'Pokemon deleted successfully');
    }
}
