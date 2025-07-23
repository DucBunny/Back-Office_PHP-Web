@extends('layouts.app')
@section('title', 'Users Create')


@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý tài khoản</span>
        /
        <span class="fw-light">Đăng ký</span>
    </div>

    <form class="mt-3" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="roleSelect">Quyền</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-2 cursor-pointer">
                    <select class="form-select form-control" id="roleSelect">
                        <option selected class="d-none"></option>
                        <option value="1">Admin</option>
                        <option value="2">Manager</option>
                        <option value="3">Staff</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="form-row d-flex align-items-center gap-3">
                    <p class="form-label m-0">Cửa hàng</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>

                    <div class="dropdown col-md-9">
                        {{-- <button class="btn text-white dropdown-toggle-no-icon col-md-3" type="button" id="storeDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #06c268; ">
                            Chọn
                        </button> --}}
                        <button class="btn text-white col-md-3 btn-custom-06c268" type="button" id="salonModal"
                            data-bs-toggle="modal" data-bs-target="#salonModal">
                            Chọn
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="storeDropdown">
                            <li><a class="dropdown-item store-option" href="#" data-value="store1">Cửa hàng A</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store2">Cửa hàng B</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store3">Cửa hàng C</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store4">Cửa hàng D</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store5">Cửa hàng E</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <p id="selectedStores" class="mt-2 ms-3">
                    <span class="text-muted">Chưa chọn cửa hàng nào</span>
                </p>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="deviceCodeSelect">Mã nhận diện thiết bị</label>
                <div class="col-md-2 cursor-pointer">
                    <select class="form-select form-control" id="deviceCodeSelect">
                        <option selected class="d-none"></option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="userName">Tên tài khoản</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-4 position-relative">
                    <input type="text" class="form-control" id="userName" />
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="userID">ID đăng nhập</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-4 position-relative">
                    <input type="text" class="form-control" id="userID" />
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="userPassword">Mật khẩu</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-4 position-relative">
                    <input type="text" class="form-control" id="userPassword" />
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="userPasswordConfirmation">Xác nhận mật khẩu</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-4 position-relative">
                    <input type="text" class="form-control" id="userPasswordConfirmation" />
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 p-4">
            {{-- Back --}}
            <a href="{{ route('users.index') }}"
                class="btn col-1 py-2 text-success btn-outline-success btn-custom-e6f9f3">Quay lại</a>

            {{-- Update --}}
            <button class="btn col-1 py-2 text-white btn-custom-11c48a" type="submit">Lưu</button>
        </div>
    </form>
@endsection
