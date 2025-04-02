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
        $teams = Teams::where('status', 1)->get();

        if ($teams->isEmpty()) {
            return response()->json(["message" => "No teams found", "code" => 404], 404);
        }

        $list = $teams->map(function ($team) {
            return [
                "id" => $team->id,
                "name" => $team->name,
                "pokemon_id" => $team->pokemons?->name,
                "trainer" => $team->trainers?->name
            ];
        });

        return response()->json($list, 200);
    }

    /**
     * Muestra un equipo por su ID.
     */
    public function show($id)
    {
        $team = Teams::find($id);

        if (!$team) {
            return response()->json(["message" => "Team not found", "code" => 404], 404);
        }

        $object = [
            "id" => $team->id,
            "name" => $team->name,
            "pokemon" => $team->pokemons?->name,
            "trainer" => $team->trainers?->name
        ];

        return response()->json($object, 200);
    }

    /**
     * Crea un nuevo equipo.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'pokemon_id' => 'required|integer|exists:pokemons,id',
            'trainer_id' => 'required|integer|exists:trainers,id',
            'status' => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? 1; // Estado por defecto activo

        $team = Teams::create($data);

        return response()->json(["message" => "Team created successfully", "team" => $team], 201);
    }

    /**
     * Actualiza un equipo existente.
     */
    public function update(Request $request, $id)
    {
        $team = Teams::find($id);

        if (!$team) {
            return response()->json(["message" => "Team not found", "code" => 404], 404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'pokemon_id' => 'required|integer|exists:pokemons,id',
            'trainer_id' => 'required|integer|exists:trainers,id',
        ]);

        $team->update($data);

        return response()->json(["message" => "Team updated successfully", "team" => $team], 200);
    }

    /**
     * Elimina (desactiva) un equipo.
     */
    public function destroy($id)
    {
        $team = Teams::find($id);

        if (!$team) {
            return response()->json(["message" => "Team not found", "code" => 404], 404);
        }

        $team->update(['status' => 0]);

        return response()->json(["message" => "Team deleted successfully"], 200);
    }
}
