<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Card;
use App\Models\PointHistory;
use App\Models\Salon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CardAndPointService
{
    public function storeCard($request, $customerId)
    {
        // Định dạng ngày tháng từ d/m/Y sang Y-m-d (chuẩn của DB)
        $visit_date = Carbon::createFromFormat('d/m/Y', $request->visit_date)->format('Y-m-d');
        $salon = Salon::select(['id', 'color_plus_point', 'perm_plus_point'])->findOrFail($request->salon_id);

        $point = $this->calculatePoint($request, $salon);

        $card = $this->insertCard($request, $customerId, $visit_date, $point);

        // Nếu có điểm cộng
        if ($point > 0) {
            // Tạo point_history
            $this->insertPointHistory($customerId, $point, 1);

            // Cập nhật điểm của khách hàng
            $customer = Customer::select(['id', 'point'])->findOrFail($customerId);
            $customer->increment('point', $point);
        }

        return $card;
    }

    protected function calculatePoint($request, $salon)
    {
        $point = 0;
        if ($request->is_color) {
            $point += $salon->color_plus_point;
        }
        if ($request->is_perm) {
            $point += $salon->perm_plus_point;
        }
        return $point;
    }

    protected function insertCard($request, $customerId, $visit_date, $point)
    {
        return Card::create([
            'salon_id' => $request->salon_id,
            'customer_id' => $customerId,
            'is_cut' => (bool) $request->is_cut,
            'is_color' => (bool) $request->is_color,
            'color_note' => $request->color_note,
            'is_perm' => (bool) $request->is_perm,
            'perm_note' => $request->perm_note,
            'practitioner' => $request->practitioner,
            'memo' => $request->memo,
            'point' => $point,
            'visit_date' => $visit_date,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);
    }

    protected function insertPointHistory($customerId, $point, $type)
    {
        return PointHistory::create([
            'customer_id' => $customerId,
            'change' => $point,
            'type' => $type,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);
    }
}
