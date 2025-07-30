<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerConsentService
{
    public function deleteCustomerConsent($customer)
    {
        $this->softDeleteCustomerConsent($customer);

        $customer->updated_by = Auth::id();
        $customer->save();
        $customer->delete();
    }

    protected function softDeleteCustomerConsent($customer)
    {
        DB::table('customer_consent')
            ->where('customer_id', $customer->id)
            ->whereNull('deleted_at')
            ->update([
                'updated_by' => Auth::id(),
                'deleted_at' => now(),
            ]);
    }
}
