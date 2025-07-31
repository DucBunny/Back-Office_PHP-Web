<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Salon;
use App\Models\Consent;
use App\Models\PointHistory;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class ImportExportController extends Controller
{
    public function exportCustomerCsv(Request $request)
    {
        $customers = Customer::filter($request)
            ->withMax('cards as last_visit_date', 'visit_date')
            ->orderByDesc('last_visit_date')
            ->get(['id', 'last_visit_date', 'last_salon_name']);

        $filename = 'customers_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = ['ID', 'Cửa hàng đã thăm gần nhất', 'Ngày tới gần nhất'];

        $callback = function () use ($customers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->id,
                    $customer->last_salon_name ?? '',
                    optional($customer->last_visit_date)->format('d/m/Y'),
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function exportPointHistoryCsv(Request $request)
    {
        $customers = Customer::filter($request)
            ->withMax('cards as last_visit_date', 'visit_date')
            ->orderByDesc('last_visit_date')
            ->get(['id']);

        $customerIds = $customers->pluck('id')->toArray();

        $pointHistories = PointHistory::whereIn('customer_id', $customerIds)
            ->select('customer_id', 'change', 'type', 'created_at')
            ->orderBy('customer_id')
            ->orderByDesc('created_at')
            ->get();

        $filename = 'point_history_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = ['ID', 'Điểm', 'Loại', 'Ngày tạo'];

        $callback = function () use ($pointHistories, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pointHistories as $history) {
                switch ($history->type) {
                    case 1:
                        $typeStr = 'Đến cửa hàng';
                        break;
                    case 2:
                        $typeStr = 'Thay đổi thủ công';
                        break;
                    default:
                        $typeStr = 'Đổi sản phẩm';
                        break;
                }

                fputcsv($file, [
                    $history->customer_id,
                    $history->change,
                    $typeStr,
                    optional($history->created_at)->format('d/m/Y'),
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function exportSalonCsv(Request $request)
    {
        $salons = Salon::filter($request)->get();

        $filename = 'salon_list_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = ['ID', 'Số hiệu', 'Phân loại', 'Tên', 'Furigana', 'Địa chỉ', 'Điểm cộng nhuộm', 'Điểm cộng uốn', 'Trạng thái'];

        $callback = function () use ($salons, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($salons as $salon) {
                fputcsv($file, [
                    $salon->id,
                    $salon->salon_code,
                    $salon->type == 1 ? 'Cắt tóc' : 'Tạo kiểu',
                    $salon->name,
                    $salon->furigana,
                    $salon->address,
                    $salon->color_plus_point,
                    $salon->perm_plus_point,
                    $salon->status ? 'Công khai' : 'Riêng tư',
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function exportConsentHistoryCsv(Request $request)
    {
        $histories = Consent::historyFilter($request)
            ->select('consents.id', 'consents.title', 'customer_consent.agreed_at', 'customer_consent.customer_id')
            ->join('customer_consent', 'consents.id', '=', 'customer_consent.consent_id')
            ->whereNull('customer_consent.deleted_at')
            ->orderByDesc('customer_consent.agreed_at')
            ->get();

        $filename = 'consent_history_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = ['Thời gian', 'Thỏa thuận đồng ý', 'ID thành viên'];

        $callback = function () use ($histories, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($histories as $history) {
                fputcsv($file, [
                    Carbon::parse($history->agreed_at)->format('d/m/Y H:i:s'),
                    $history->title,
                    $history->customer_id,
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
