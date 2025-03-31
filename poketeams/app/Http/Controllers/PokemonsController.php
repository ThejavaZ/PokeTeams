<?php

namespace App\Http\Controllers;

use \App\Models\Pokemons;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Types;

class PokemonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemons = Pokemons::all();
        return view('pokemons.index', compact('pokemons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Types::all();
        $pokemons = Pokemons::all();
        return view('pokemons.create', compact('pokemons', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'mote' => 'string|max:255',
            'type_id' => 'required|integer',
            'level' => 'required|integer',
            'status' => 'boolean|default:1',
        ]);

        $pokemon = Pokemons::create([
            'name' => $data['name'],
            'mote' => $data['mote'],
            'type_id' => $data['type_id'],
            'level' => $data['level'],
            'status' => 1,
        ])->save();

        if ($pokemon) {
            return redirect()->route('pokemons')->with('success', 'Pokemon created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create Pokemon.');
        }
    }

    /**
     * Display the specified resource.
     */

     public function show($id)
    {
        $pokemon = Pokemons::find($id);

        if (!$pokemon) {
            return back()->with('error', 'Pokémon no encontrado.');
        }

        $pokemonName = strtolower($pokemon->name);
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$pokemonName}/");

        // Si la API no responde o da error, devolver la vista con un sprite de MissingNo
        if (!$response->successful()) {
            return view('pokemons.show', [
                'pokemon' => $pokemon,
                'pokemonData' => [
                    'sprites' => [
                        'front_default' => "https://wiki.p-insurgence.com/images/0/09/722.png",
                        'back_default' => null
                    ]
                ]
            ]);
        }

        $pokemonData = $response->json();

        // Si la API no tiene sprites, usa una imagen por defecto
        if (!isset($pokemonData['sprites']) || empty($pokemonData['sprites'])) {
            $pokemonData['sprites'] = [
                'front_default' => "https://wiki.p-insurgence.com/images/0/09/722.png",
                'back_default' => null
            ];
        }

        return view('pokemons.show', compact('pokemon', 'pokemonData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemons $pokemon)
    {
        $types = Types::all();
        $pokemon = Pokemons::find($pokemon->id);
        return view('pokemons.edit', compact('pokemon', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemons $pokemon)
    {
        $pokemon = Pokemons::find($pokemon->id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'mote' => 'string|max:255',
            'type_id' => 'required|integer',
            'level' => 'required|integer',

        ]);
        $pokemon->name = $data['name'];
        $pokemon->mote = $data['mote'];
        $pokemon->type_id = $data['type_id'];
        $pokemon->level = $data['level'];

        $pokemon->save();
        if ($pokemon) {
            return redirect()->route('pokemons')->with('success', 'Pokemon updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Pokemon.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemons $pokemon)
    {
        
    }
}
