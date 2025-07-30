<?php

namespace App\Http\Controllers;

use App\Models\Salon;

use App\Http\Requests\SalonRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalonController extends Controller
{
    public function index(Request $request)
    {
        $salons = Salon::filter($request)
            ->paginate(10)
            ->withQueryString();

        return view('salons.index', ['salons' => $salons]);
    }

    public function toggleStatus($id)
    {
        $salon = Salon::findOrFail($id);
        $salon->status = !$salon->status;
        $salon->updated_by = Auth::id();
        $salon->save();

        return response()->json([
            'status' => $salon->status,
            'label' => $salon->status ? 'Công khai' : 'Riêng tư',
            'class' => $salon->status ? 'btn-custom-06c268' : 'btn-custom-6c757d',
        ]);
    }

    public function modalSelect(Request $request)
    {
        $salons = Salon::whereIn('id', Auth::user()->salon_ids)
            ->filter($request)
            ->get();

        return view('modals.select_salon', ['salons' => $salons]);
    }

    public function pointSetting()
    {
        // Logic to display the point setting page
        return view('salons.point');
    }

    public function create()
    {
        return view('salons.create');
    }

    public function store(SalonRequest $request)
    {
        Salon::create([
            'salon_code' => strtoupper($request->input('salon_code')),
            'type' => $request->input('type'),
            'name' => $request->input('name'),
            'furigana' => $request->input('furigana'),
            'color_plus_point' => $request->input('color_plus_point'),
            'perm_plus_point' => $request->input('perm_plus_point'),
            'address' => $request->input('address'),
            'status' => (bool) $request->input('status'),
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('salons.index')->with('success', 'Thêm dữ liệu thành công!');
    }

    public function edit($id)
    {
        $salon = Salon::findOrFail($id);

        return view('salons.edit', ['salon' => $salon]);
    }

    public function update(SalonRequest $request, $id)
    {
        $salon = Salon::findOrFail($id);

        $salon->update([
            'salon_code' => strtoupper($request->input('salon_code')),
            'type' => $request->input('type'),
            'name' => $request->input('name'),
            'furigana' => $request->input('furigana'),
            'color_plus_point' => $request->input('color_plus_point'),
            'perm_plus_point' => $request->input('perm_plus_point'),
            'address' => $request->input('address'),
            'status' => (bool) $request->input('status'),
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('salons.index')->with('success', 'Cập nhật dữ liệu thành công!');
    }

    public function destroy($id)
    {
        $salon = Salon::select(['id'])->findOrFail($id);
        $salon->updated_by = Auth::id(); // Lưu ID người xóa
        $salon->save();
        $salon->delete();

        return redirect()->route('salons.index')->with('success', 'Xóa dữ liệu thành công!');
    }
}
