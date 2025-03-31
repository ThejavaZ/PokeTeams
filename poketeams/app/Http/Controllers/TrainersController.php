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
        $trainers = Trainers::all();
        return view('trainers.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainers = Trainers::all();
        return view('trainers.create', compact('trainers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Trainers $trainers)
    {
        $trainers = Trainers::find($trainers->id);
        return view('trainers.show', compact('trainers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainers $trainers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainers $trainers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainers $trainers)
    {
        //
    }
}
