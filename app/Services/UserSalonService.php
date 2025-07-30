<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserSalonService
{
    public function storeUserSalons($request)
    {
        $user = $this->insertUser($request);

        if (!empty($request->salon_ids)) {
            $insertIds = array_filter(explode(',', $request->salon_ids));
            $this->insertUserSalonTable($user, $insertIds);
        }

        return $user;
    }

    public function updateUserSalons($user, $request)
    {
        $this->updateUser($user, $request);

        if (!empty($request->salon_ids)) {
            $newIds = array_filter(explode(',', $request->salon_ids));
            $this->updateUserSalonTable($user, $newIds);
        }

        return $user;
    }

    public function deleteUserSalons($user)
    {
        $deletedIds = $user->salons()->wherePivot('deleted_at', null)->pluck('id')->toArray();
        $this->softDeleteUserSalonTable($user, $deletedIds);

        $user->updated_by = Auth::id();
        $user->save();
        $user->delete();
    }

    protected function insertUser($request)
    {
        return User::create([
            'login_id' => $request->login_id,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'device_code' => $request->device_code,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);
    }

    protected function updateUser($user, $request)
    {
        $user->update([
            'login_id' => $request->login_id,
            'name' => $request->name,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
            'device_code' => $request->device_code,
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);
    }

    protected function insertUserSalonTable($user, $insertIds)
    {
        $syncData = [];
        foreach ($insertIds as $id) {
            $syncData[$id] = ['updated_by' => Auth::id(), 'deleted_at' => null];
        }
        $user->salons()->sync($syncData);
    }

    protected function updateUserSalonTable($user, $newIds)
    {
        $oldIds = $user->salons()->wherePivot('deleted_at', null)->pluck('salons.id')->toArray();

        $deletedIds = array_diff($oldIds, $newIds);
        if ($deletedIds) {
            $this->softDeleteUserSalonTable($user, $deletedIds);
        }

        $insertIds = array_diff($newIds, $oldIds);
        if ($insertIds) {
            foreach ($insertIds as $id) {
                $pivot = DB::table('user_salon')
                    ->where('user_id', $user->id)
                    ->where('salon_id', $id)
                    ->first();

                if ($pivot) {
                    // Nếu đã có bản ghi, chỉ cần khôi phục
                    DB::table('user_salon')
                        ->where('user_id', $user->id)
                        ->where('salon_id', $id)
                        ->update([
                            'deleted_at' => null,
                            'updated_by' => Auth::id(),
                            'updated_at' => now(),
                        ]);
                } else {
                    // Nếu chưa có, insert mới
                    DB::table('user_salon')->insert([
                        'user_id' => $user->id,
                        'salon_id' => $id,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'updated_by' => Auth::id(),
                        'deleted_at' => null,
                    ]);
                }
            }
        }
    }

    protected function softDeleteUserSalonTable($user, $deletedIds)
    {
        DB::table('user_salon')
            ->where('user_id', $user->id)
            ->whereIn('salon_id', $deletedIds)
            ->whereNull('deleted_at')
            ->update([
                'updated_by' => Auth::id(),
                'deleted_at' => now(),
            ]);
    }
}
