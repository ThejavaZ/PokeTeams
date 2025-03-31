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
        $teams = Teams::all();
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Teams::all();
        return view('teams.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Teams $teams)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teams $teams)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teams $teams)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teams $teams)
    {
        //
    }
}
