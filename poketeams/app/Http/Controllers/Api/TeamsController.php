<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teams;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Lista todos los equipos activos.
     */
    public function index()
    {
        $teams = Teams::where('status','=', 1)->get();

        if($teams){
            $list = [];

            foreach($teams as $team){
                $object = [
                    'id'=> $team->id,
                    'name'=>$team->name,
                    'pokemon'=>$team->pokemons?->name,
                    'entreandor'=>$team->trainers?->name,
                    'message'=>[
                        "code"=>'202',
                        "message"=>'Equipos'
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
     * Muestra un equipo por su ID.
     */
    public function show($id)
    {
        $team = Teams::where('status','=',1)->where('id','=',$id)->first();

        if ($team) {
            $object = [
            "id" => $team->id,
            "name" => $team->name,
            "pokemon" => $team->pokemons?->name,
            "trainer" => $team->trainers?->name
        ];
            return response()->json($object);
        }
        else{
            $object = [
                "code"=> "404",
                "message"=>"equipo no encontrado"
            ];
            return response()->json($object);

        }
    }

    /**
     * Crea un nuevo equipo.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'pokemon_id' => 'required|integer|exists:pokemons,id',
            'trainer_id' => 'required|integer|exists:trainers,id',
            'status' => 'boolean|default:1',
        ]);
        $team = Teams::create([
            "name"=>$data["name"],
            "pokemon_id"=>$data["pokemon_id"],
            "trainer_id"=>$data["trainer_id"],
            "status"=>1
        ]);

        if($team){
            $object =[
                "code"=> "201",
                "mensaje"=>"Team created successfully"
            ];
            return response()->json([$team, $object]);

        }

    }

    /**
     * Actualiza un equipo existente.
     */
    public function edit(Request $request, $id)
    {
        $team = Teams::find($id);

        if (!$team) {
            return response()->json(["message" => "Team not found", "code" => 404], 404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'pokemon_id' => 'required|integer|exists:pokemons,id',
            'trainer_id' => 'required|integer|exists:trainers,id',
            'status'=>'boolean|default:1'
        ]);

        $team->update($data);

        return response()->json(["message" => "Team updated successfully", "team" => $team], 200);
    }

    /**
     * Elimina (desactiva) un equipo.
     */
    public function destroy($id)
    {
        $team = Teams::where('id','=',$id)->where("status","=",1);

        if ($team) {
            $object = [
                "code"=>"200",
                "message"=>"Equipo eliminado correctamente"
            ];
            
            return response()->json($object);
        }
        else{
            $object = [
                "code"=>"404",
                "message"=>"Equipo no eliminado o eliminado incorrectamente"
            ];

            return response()->json($object);
        }
    }
}
