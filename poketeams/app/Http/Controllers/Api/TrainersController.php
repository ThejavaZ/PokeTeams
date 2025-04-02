<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trainers;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Lista todos los entrenadores activos.
     */
    public function index()
    {
        $trainers = Trainers::where('status', 1)->get();

        if ($trainers->isEmpty()) {
            return response()->json(["message" => "No trainers found", "code" => 404], 404);
        }

        return response()->json($trainers, 200);
    }

    /**
     * Muestra un entrenador por su ID.
     */
    public function show($id)
    {
        $trainer = Trainers::find($id);

        if (!$trainer) {
            return response()->json(["message" => "Trainers not found", "code" => 404], 404);
        }

        return response()->json($trainer, 200);
    }

    /**
     * Crea un nuevo entrenador.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:10',
            'region' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? 1; // Estado activo por defecto

        $trainer = Trainers::create($data);

        return response()->json(["message" => "Trainers created successfully", "trainer" => $trainer], 201);
    }

    /**
     * Actualiza un entrenador existente.
     */
    public function update(Request $request, $id)
    {
        $trainer = Trainers::find($id);

        if (!$trainer) {
            return response()->json(["message" => "Trainers not found", "code" => 404], 404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:10',
            'region' => 'required|string|max:255',
        ]);

        $trainer->update($data);

        return response()->json(["message" => "Trainers updated successfully", "trainer" => $trainer], 200);
    }

    /**
     * Elimina (desactiva) un entrenador.
     */
    public function destroy($id)
    {
        $trainer = Trainers::find($id);

        if (!$trainer) {
            return response()->json(["message" => "Trainers not found", "code" => 404], 404);
        }

        $trainer->update(['status' => 0]);

        return response()->json(["message" => "Trainers deleted successfully"], 200);
    }
}
