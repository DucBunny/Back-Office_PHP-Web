<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsentRequest;
use App\Models\Consent;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ConsentController extends Controller
{
    public function index(Request $request)
    {
        $consents = Consent::filter($request)
            ->select('id', 'title', 'status', 'date')
            ->orderByDesc('date')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('consents.index', [
            'consents' => $consents
        ]);
    }

    public function show($id)
    {
        $consent = Consent::select('title', 'description')->findOrFail($id);

        return view('consents.show', [
            'consent' => $consent
        ]);
    }

    public function toggleStatus($id)
    {
        $consent = Consent::findOrFail($id);
        $consent->status = !$consent->status;
        $consent->updated_by = Auth::id();
        $consent->save();

        return response()->json([
            'status' => $consent->status,
            'label' => $consent->status ? 'Công khai' : 'Riêng tư',
            'class' => $consent->status ? 'btn-custom-06c268' : 'btn-custom-6c757d',
        ]);
    }

    public function create()
    {
        return view('consents.create');
    }

    public function store(ConsentRequest $request)
    {
        Consent::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 1,
            'date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('consents.index')->with('success', 'Thêm dữ liệu thành công!');
    }

    public function history(Request $request)
    {
        $consents = Consent::select('title')->get();

        $histories = Consent::historyFilter($request)
            ->select('consents.id', 'consents.title', 'customer_consent.agreed_at', 'customer_consent.customer_id')
            ->join('customer_consent', 'consents.id', '=', 'customer_consent.consent_id')
            ->whereNull('customer_consent.deleted_at')
            ->orderByDesc('customer_consent.agreed_at')
            ->paginate(10)
            ->withQueryString();

        return view('consents.history', [
            'consents' => $consents,
            'histories' => $histories
        ]);
    }
}
