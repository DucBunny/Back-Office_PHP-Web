<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Card;
use App\Models\PointHistory;
use App\Models\Salon;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\CardAndPointService;
use App\Services\CustomerConsentService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $salonIds = Auth::user()->salon_ids;

        if (Auth::user()->id == 2) {
            $customerIds = Card::whereIn('salon_id', $salonIds)
                ->pluck('customer_id')
                ->unique()
                ->toArray();
            $withMax = ['cards as last_visit_date' => function ($q) use ($salonIds) {
                $q->whereIn('salon_id', $salonIds);
            }];
        } else {
            $customerIds = Customer::pluck('id')->toArray();
            $withMax = ['cards as last_visit_date'];
        }

        $customers = Customer::filter($request)
            ->whereIn('id', $customerIds)
            ->withMax($withMax, 'visit_date')
            ->orderByDesc('last_visit_date')
            ->paginate(10)
            ->withQueryString();

        $salons = Salon::whereIn('id', $salonIds)->get();

        return view('customers.index', [
            'customers' => $customers,
            'salons' => $salons
        ]);
    }

    public function createCard($id)
    {
        $customer = Customer::select(['id'])->findOrFail($id);
        $salons = Salon::select(['id', 'name'])
            ->whereIn('id', Auth::user()->salon_ids)
            ->get();

        return view('cards.create', [
            'customer' => $customer,
            'salons' => $salons
        ]);
    }

    public function storeCard(StoreCardRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            app(CardAndPointService::class)->storeCard($request, $id);
        });

        return redirect()->route('customers.edit', $id)->with('success', 'Thêm dữ liệu thành công!');
    }

    public function edit($id)
    {
        $customer = Customer::select(['id', 'gender', 'age', 'notes'])->findOrFail($id);
        $cards = Card::where('customer_id', $id)
            ->orderByDesc('visit_date')
            ->paginate(10);

        return view('customers.edit', [
            'customer' => $customer,
            'cards' => $cards,
        ]);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update([
            'gender' => $request->gender,
            'age' => now()->year - $request->birth_year,
            'notes' => $request->notes,
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('customers.index')->with('success', 'Cập nhật dữ liệu thành công!');
    }

    public function points($id)
    {
        $customer = Customer::select(['id', 'point'])->findOrFail($id);
        $point_history = PointHistory::select(['change', 'type', 'created_at'])->where('customer_id', $id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('customers.points', [
            'customer' => $customer,
            'point_history' => $point_history,
        ]);
    }

    public function addPoints(Request $request, $id)
    {
        $request->validate([
            'point' => 'required|integer',
        ]);

        DB::transaction(function () use ($request, $id) {
            $customer = Customer::select(['id', 'point'])->findOrFail($id);
            $customer->increment('point', $request->point);

            PointHistory::create([
                'customer_id' => $id,
                'change' => $request->point,
                'type' => 2, // Cộng điểm thủ công
                'created_at' => now(),
                'updated_at' => now(),
                'updated_by' => Auth::id(),
            ]);
        });

        return redirect()->route('customers.points', $id)->with('success', 'Cập nhật điểm thành công!');
    }

    public function editCard($id)
    {
        $card = Card::findOrFail($id);
        $customer = Customer::select(['id'])->findOrFail($card->customer_id);

        return view('cards.edit', [
            'card' => $card,
            'customer' => $customer,
        ]);
    }

    public function updateCard(UpdateCardRequest $request, $id)
    {
        $card = Card::findOrFail($id);

        $card->update([
            'is_cut' => (bool) $request->is_cut,
            'is_color' => (bool) $request->is_color,
            'color_note' => $request->color_note,
            'is_perm' => (bool) $request->is_perm,
            'perm_note' => $request->perm_note,
            'practitioner' => $request->practitioner,
            'memo' => $request->memo,
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('customers.edit', $card->customer_id)->with('success', 'Cập nhật dữ liệu thành công!');
    }

    public function destroy($id)
    {
        $customer = Customer::select(['id'])->findOrFail($id);
        DB::transaction(function () use ($customer) {
            app(CustomerConsentService::class)->deleteCustomerConsent($customer);
        });

        return redirect()->route('customers.index')->with('success', 'Xóa dữ liệu thành công!');
    }
}
