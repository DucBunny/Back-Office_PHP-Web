<?php

namespace App\Http\Controllers;

use App\Models\Consent;

use Illuminate\Http\Request;

class ConsentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('consents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic to store consent
        return redirect()->route('consents.index')->with('success', 'Consent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consent = Consent::findOrFail($id);
        return view('consents.show', compact('consent'));
    }

    public function history()
    {
        // Logic to display consent history
        return view('consents.history');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consent = Consent::findOrFail($id);
        return view('consents.edit', compact('consent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $consent = Consent::findOrFail($id);
        $consent->update($request->all());
        return redirect()->route('consents.index')->with('success', 'Consent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consent = Consent::findOrFail($id);
        $consent->delete();
        return redirect()->route('consents.index')->with('success', 'Consent deleted successfully.');
    }
}
