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
    public function create(Request $request)
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
            $object = [
                "code"=> "202",
                "message"=>"Pokemon creado correctamente"
            ];
            return response()->json([$object,$pokemon]);
        } else {
            $object = [
                "code"=> "404",
                "message"=>"Pokemon NO creado"
            ];
              return response()->json($object);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pokemon = Pokemons::where('status', '=', 1)->where('id', '=', $id)->first();

        if($pokemon){
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
            return response()->json($object);
        }
        else{
            $object = [
                "error"=> 404,
                "menssage"=>"Pokemon no encontrado"
            ];
            return response()->json($object);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request, $id)
    {
        $pokemon = Pokemons::where('status', '=', 1)->where('id', '=', $id)->first();
        
        if (!$pokemon) {
            return response()->json(["message" => "Pokemon not found."], 404);
        }
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'mote' => 'nullable|string|max:255',
            'type_id' => 'required|integer',
            'level' => 'required|integer',
            'status'=> 'boolean|default:1'
        ]);
        
        $pokemon->update($data);

        if($pokemon){
            $object = [
                "code"=>"200",
                "mensaje"=>"Pokemon updated successfully."
            ];
            return response()->json([$object, $pokemon]);
        }
        else{
            $object = [
                "code"=>"404",
                "mensaje"=>"Pokemon not updated successfully.."  
            ];
            return response()->json([$object]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pokemon = Pokemons::where('status', '=', 1)->where('id', '=', $id)->first();        
        if (!$pokemon) {
            $object =[
                "code"=>"404",
                "mensaje"=>"Pokemon not found."
            ];
            return response()->json($object);
        }
        else{
            $pokemon->update(['status' => 0]);
            $object = [
                    "code"=>"200",
                    "mensaje"=>"Pokemon deleted successfully."
            ];

            return response()->json([$object, $pokemon]);
        }
    }
}