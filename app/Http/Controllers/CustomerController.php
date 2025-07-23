<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Card;
use App\Models\Salon;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::whereHas('cards', function ($query) {
            $query->active();
        })->get();

        // Sort customers by last visit date in descending order
        $customers = $customers->sortByDesc(function ($customer) {
            return $customer->last_visit_date ? $customer->last_visit_date->timestamp : 0;
        })->values();

        return view('customers.index', [
            'customers' => $customers,
        ]);
    }

    public function createCard($id)
    {
        $customer = Customer::findOrFail($id);

        return view('cards.create', [
            'customer' => $customer
        ]);
    }

    public function storeCard(Request $request)
    {
        // Validate and store the customer data
        // ...

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $cards = Card::where('customer_id', $id)->get();

        return view('customers.edit', [
            'customer' => $customer,
            'cards' => $cards,
        ]);
    }

    public function update($id)
    {
        // Validate and update the customer data
        // ...

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function points($id)
    {
        $customer = Customer::findOrFail($id);
        $cards = Card::where('customer_id', $id)->get();

        return view('customers.points', [
            'customer' => $customer,
            'cards' => $cards,
        ]);
    }

    public function addPoints(Request $request)
    {
        // Validate and add points to the customer
        // ...

        return redirect()->route('customers.index')->with('success', 'Points added successfully.');
    }

    public function editCard($id)
    {
        $card = Card::findOrFail($id);
        $customer = Customer::findOrFail($card->customer_id);
        return view('cards.edit', [
            'card' => $card,
            'customer' => $customer,
        ]);
    }

    public function updateCard(Request $request, $id)
    {
        // Validate and update the card data
        // ...

        return redirect()->route('customers.index')->with('success', 'Card updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        Card::where('customer_id', $id)->where('visit_date', $customer->last_visit_date)->delete();

        return redirect()->route('customers.index');
    }
}
