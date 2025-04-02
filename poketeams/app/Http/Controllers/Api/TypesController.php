<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Types;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    /**
     * Lista todos los tipos activos.
     */
    public function index()
    {
        $types = Types::where('status', 1)->get();

        if ($types->isEmpty()) {
            return response()->json(["message" => "No types found", "code" => 404], 404);
        }

        return response()->json($types, 200);
    }

    /**
     * Muestra un tipo por su ID.
     */
    public function show($id)
    {
        $type = Types::find($id);

        if (!$type) {
            return response()->json(["message" => "Type not found", "code" => 404], 404);
        }

        return response()->json($type, 200);
    }

    /**
     * Crea un nuevo tipo.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        $data['status'] = $data['status'] ?? 1; // Estado activo por defecto

        $type = Types::create($data);

        return response()->json(["message" => "Type created successfully", "type" => $type], 201);
    }

    /**
     * Actualiza un tipo existente.
     */
    public function update(Request $request, $id)
    {
        $type = Types::find($id);

        if (!$type) {
            return response()->json(["message" => "Type not found", "code" => 404], 404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $type->update($data);

        return response()->json(["message" => "Type updated successfully", "type" => $type], 200);
    }

    /**
     * Elimina (desactiva) un tipo.
     */
    public function destroy($id)
    {
        $type = Types::find($id);

        if (!$type) {
            return response()->json(["message" => "Type not found", "code" => 404], 404);
        }

        $type->update(['status' => 0]);

        return response()->json(["message" => "Type deleted successfully"], 200);
    }
}
