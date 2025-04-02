<?php

namespace App\Http\Controllers;

use App\Models\Types;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Types::where('status', 1)->get();
        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean|default:1',
        ]);

        $type = Types::create([
            'name' => $data['name'],
            'status'=> 1
        ])->save();
        if($type){
            return redirect()->route('types.index')->with('success', 'Tipo creado correctamente.');
        }
        else {
            return redirect()->back()->with('error', 'Failed to create Type.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $type = Types::findOrFail($id);
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $type = Types::findOrFail($id);
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $type = Types::findOrFail($id);
        $type->update($data);

        return redirect()->route('types.index')->with('success', 'Tipo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = Types::findOrFail($id);
        $type->update(['status' => 0]);

        return redirect()->route('types.index')->with('success', 'Tipo eliminado correctamente.');
    }
}
