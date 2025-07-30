<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Salon;
use App\Models\User;

use App\Services\UserSalonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $salons = Salon::all();
        $users = User::filter($request)
            ->paginate(10)
            ->withQueryString();

        return view('users.index', [
            'salons' => $salons,
            'users' => $users
        ]);
    }

    public function create()
    {
        $salons = Salon::all();

        return view('users.create', [
            'salons' => $salons
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            app(UserSalonService::class)->storeUserSalons($request);
        });

        return redirect()->route('users.index')->with('success', 'Thêm người dùng thành công!');
    }

    public function edit($id)
    {
        $salons = Salon::all();
        $user = User::findOrFail($id);
        $salonIds = $user->salons()->wherePivot('deleted_at', null)->pluck('id')->implode(',');

        return view('users.edit', [
            'salons' => $salons,
            'user' => $user,
            'salonIds' => $salonIds
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        DB::transaction(function () use ($user, $request) {
            app(UserSalonService::class)->updateUserSalons($user, $request);
        });

        return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    public function destroy($id)
    {
        $user = User::select('id')->findOrFail($id);
        DB::transaction(function () use ($user) {
            app(UserSalonService::class)->deleteUserSalons($user);
        });

        return redirect()->route('users.index')->with('success', 'Xóa người dùng thành công!');
    }
}
