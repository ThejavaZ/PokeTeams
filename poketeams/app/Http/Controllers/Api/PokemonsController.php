<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pokemons;
use Illuminate\Http\Request;

class PokemonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemons = Pokemons::where('status','=', 1)->get();

        if($pokemons){
            $list = [];

            foreach($pokemons as $pokemon){
                $object = [
                    'id'=> $pokemon->id,
                    'name'=>$pokemon->name,
                    'mote'=>$pokemon->mote,
                    'type_id'=>$pokemon->types?->name,
                    'level'=>$pokemon->level,
                    'message'=>[
                        "code"=>'202',
                        "message"=>'Pokemons'
                    ]
                ];

                array_push($list, $object);
            }

            return response()->json($list);
        }
        else{
            $object = [
                "code"=>"404",
                "message"=> "No info."
            ];
            return response()->json($object);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'mote' => 'nullable|string|max:255',
            'type_id' => 'required|integer',
            'level' => 'required|integer',
            'status' => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? 1; // Default status to 1

        $pokemon = Pokemons::create($data);
        

        return response()->json(["message" => "Pokemon created successfully.", "pokemon" => $pokemon], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pokemon = Pokemons::find($id);

        if($pokemon){
            $object =[
                ''
            ];
        }
        
        if (!$pokemon) {
            return response()->json(["message" => "Pokemon not found."], 404);
        }
        
        return response()->json($pokemon, 200);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pokemon = Pokemons::find($id);
        
        if (!$pokemon) {
            return response()->json(["message" => "Pokemon not found."], 404);
        }
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'mote' => 'nullable|string|max:255',
            'type_id' => 'required|integer',
            'level' => 'required|integer',
        ]);
        
        $pokemon->update($data);
        
        return response()->json(["message" => "Pokemon updated successfully.", "pokemon" => $pokemon], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pokemon = Pokemons::find($id);
        
        if (!$pokemon) {
            return response()->json(["message" => "Pokemon not found."], 404);
        }
        
        $pokemon->update(['status' => 0]);
        
        return response()->json(["message" => "Pokemon deleted successfully."], 200);
    }
}
