<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Teams::where('status', 1)->get();
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'pokemon_id'=>'required|int',
            'trainer_id'=>'required|int',
            'status' => 'boolean|default:1',
        ]);

        $team = Teams::create([
            'name' => $data['name'],
            'pokemon_id'=>$data['pokemon_id'],
            'trainer_id'=>$data['trainer_id'],
            'status' => 1,
        ])->save();

        if ($team) {
            return redirect()->route('teams.index')->with('success', 'Team created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create Team.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $team = Teams::find($id);
        if (!$team) {
            return back()->with('error', 'Team not found.');
        }
        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $team = Teams::find($id);
        if (!$team) {
            return back()->with('error', 'Team not found.');
        }
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $team = Teams::find($id);
        if (!$team) {
            return back()->with('error', 'Team not found.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'pokemon_id'=>'required|int',
            'trainer_id'=>'required|int'
        ]);

        $team->update($data);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $team = Teams::find($id);
        if (!$team) {
            return back()->with('error', 'Team not found.');
        }

        $team->update(['status' => 0]);

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}
