<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    public function index()
    {
        return view('customers.index');
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        // Validate and store the customer data
        // ...

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit()
    {
        // Fetch the customer by ID and return the edit view
        // ...

        return view('customers.edit');
    }

    public function update(Request $request, $id)
    {
        // Validate and update the customer data
        // ...

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        // Delete the customer by ID
        // ...

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
