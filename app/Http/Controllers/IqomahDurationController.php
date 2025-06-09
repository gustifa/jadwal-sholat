<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IqomahDurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.iqomah.index', [
        'durations' => \App\Models\IqomahDuration::all()
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(\App\Models\IqomahDuration $iqomahDuration) {
        return view('admin.iqomah.edit', compact('iqomahDuration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\IqomahDuration $iqomahDuration) {
        $request->validate(['duration' => 'required|integer|min:1']);
        $iqomahDuration->update(['duration' => $request->duration]);
        return redirect()->route('iqomah.index')->with('success', 'Durasi diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
