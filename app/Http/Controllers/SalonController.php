<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalonController extends Controller
{
    public function index()
    {
        // Logic to display the list of salons
        return view('salons.index');
    }

    public function pointSetting()
    {
        // Logic to display the point setting page
        return view('salons.point');
    }

    public function create()
    {
        // Logic to show the form for creating a new salon
        return view('salons.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new salon
        return redirect()->route('salons.index')->with('success', 'Salon created successfully.');
    }

    public function show($id)
    {
        // Logic to display a specific salon
        return view('salons.show', ['id' => $id]);
    }

    public function edit($id)
    {
        // Logic to show the form for editing a salon
        return view('salons.edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        // Logic to update a salon
        return redirect()->route('salons.index')->with('success', 'Salon updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete a salon
        return redirect()->route('salons.index')->with('success', 'Salon deleted successfully.');
    }
}
