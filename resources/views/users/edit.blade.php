@extends('layouts.app')
@section('title', 'Users Edit')
@include('modals.select_salon', ['salons' => $salons])
@vite(['resources/js/show_hide_password.js', 'resources/js/crud_user.js', 'resources/js/delete_item_selected.js'])

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý tài khoản</span>
        /
        <span class="fw-light">Chỉnh sửa</span>
    </div>

    <form class="mt-3" method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="roleSelect">Quyền</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-md-2">
                    <select class="form-select form-control" name="role" id="roleSelect">
                        <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>Manager
                        </option>
                        <option value="3" {{ old('role', $user->role) == 3 ? 'selected' : '' }}>Staff</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="form-row d-flex align-items-center gap-3">
                    <p class="form-label m-0">Cửa hàng</p>
                    <span class="badge rounded-pill fw-medium" id="salonBadge" style="background-color: #11c48a">必須</span>

                    <div class="col-md-9">
                        <button class="btn text-white col-md-3 btn-custom-06c268" type="button" id="salonModalBtn"
                            data-bs-toggle="modal" data-bs-target="#salonModal">
                            Chọn
                        </button>
                    </div>
                </div>

                <div id="selectedSalons" class="mt-2"></div>
                <input type="hidden" name="salon_ids" id="selectedSalonIds" value="{{ old('salon_ids', $salonIds) }}">
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="deviceCodeSelect">Mã nhận diện thiết bị</label>
                <div class="ps-3 col-md-2">
                    <select class="form-select form-control" name="device_code" id="deviceCodeSelect">
                        <option selected class="d-none" value=""></option>
                        @foreach (range('A', 'Z') as $char)
                            <option value="{{ $char }}" {{ old('device_code') == $char ? 'selected' : '' }}>
                                {{ $char }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="userName">Tên tài khoản</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-md-4">
                    <input type="text" class="form-control" name="name" id="userName"
                        value="{{ old('name', $user->name) }}" />
                </div>

                @error('name')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="userID">ID đăng nhập</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-md-4">
                    <input type="text" class="form-control" name="login_id" id="userID"
                        value="{{ old('login_id', $user->login_id) }}" />
                </div>

                @error('login_id')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="p-4 bg-white rounded-3 border border-2 mt-2">
            <div class="form-group mb-3">
                <label class="form-label" for="userPassword">Mật khẩu</label>
                <div class="ps-3 col-md-4 position-relative">
                    <input type="password" class="form-control password" name="password" id="userPassword" />
                    <i class="fa-regular fa-eye-slash position-absolute top-50 translate-middle-y end-0 me-2 text-muted toggle-password"
                        style="cursor:pointer" data-target="userPassword"></i>
                </div>

                @error('password')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="userPasswordConfirmation">Xác nhận mật khẩu</label>
                <div class="ps-3 col-md-4 position-relative">
                    <input type="password" class="form-control password" name="password_confirmation"
                        id="userPasswordConfirmation" />
                    <i class="fa-regular fa-eye-slash position-absolute top-50 translate-middle-y end-0 me-2 text-muted toggle-password"
                        style="cursor:pointer" data-target="userPasswordConfirmation"></i>
                </div>

                @error('password_confirmation')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex justify-content-center gap-3 p-4">
            {{-- Back --}}
            <a href="{{ route('users.index') }}"
                class="btn col-1 py-2 text-success btn-outline-success btn-custom-e6f9f3">Quay lại</a>

            {{-- Update --}}
            <button class="btn col-1 py-2 text-white btn-custom-11c48a" type="submit">Lưu</button>
        </div>
    </form>
@endsection
