<?php

namespace App\Http\Controllers;

use App\Models\Trainers;
use Illuminate\Http\Request;

class TrainersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = Trainers::where('status', 1)->get();
        return view('trainers.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trainers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:100',
            'status' => 'boolean|default:1',
        ]);

        $trainer = Trainers::create([
            'name' => $data['name'],
            'region' => $data['region'],
            'status' => 1,
        ]);

        if ($trainer) {
            return redirect()->route('trainers.index')->with('success', 'Trainer created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create Trainer.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $trainer = Trainers::find($id);
        if (!$trainer) {
            return back()->with('error', 'Trainer not found.');
        }
        return view('trainers.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $trainer = Trainers::find($id);
        if (!$trainer) {
            return back()->with('error', 'Trainer not found.');
        }
        return view('trainers.edit', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $trainer = Trainers::find($id);
        if (!$trainer) {
            return back()->with('error', 'Trainer not found.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:100',
        ]);

        $trainer->update($data);

        return redirect()->route('trainers.index')->with('success', 'Trainer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $trainer = Trainers::find($id);
        if (!$trainer) {
            return back()->with('error', 'Trainer not found.');
        }

        $trainer->update(['status' => 0]);

        return redirect()->route('trainers.index')->with('success', 'Trainer deleted successfully.');
    }
}
