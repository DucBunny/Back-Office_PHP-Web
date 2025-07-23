@extends('layouts.app')
@section('title', 'Salon Edit')


@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý cửa hàng</span>
        /
        <span class="fw-light">Chỉnh sửa</span>
    </div>

    <form class="mt-3" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="storeCode">Mã cửa hàng</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-2 position-relative">
                    <input type="text" class="form-control" id="storeCode" />
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="storeSelect">Cắt tóc/ Tạo kiểu</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-3 cursor-pointer">
                    <select class="form-select form-control" id="storeSelect">
                        <option selected class="d-none"></option>
                        <option value="1">Cắt</option>
                        <option value="2">Tạo kiểu</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3 col-md-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="storeName">Tên cửa hàng</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <input type="text" class="form-control" id="storeName">
            </div>

            <div class="form-group mb-3 col-md-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="furigana">Furigana</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <input type="text" class="form-control" id="furigana">
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label for="colorPoint" class="form-label m-0">Điểm thưởng (Nhuộm tóc)</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <input type="number" class="form-control form-control-sm" id="colorPoint" min="0" />
                    <span class="ps-2">pt</span>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label for="permPoint" class="form-label m-0">Điểm thưởng (Uốn tóc)</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <input type="number" class="form-control form-control-sm" id="permPoint" min="0" />
                    <span class="ps-2">pt</span>
                </div>
            </div>

            <div class="form-group mb-3 w-100">
                <label class="form-label" for="storeAddress">Địa chỉ</label>
                <input type="text" class="form-control" id="storeAddress">
            </div>

            <div class="form-group mb-3 w-100">
                <p class="form-label">Trạng thái</p>
                <a href="#" class="btn text-white" style="background-color: #06c268">Công khai</a>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 p-4">
            {{-- Back --}}
            <a href="{{ route('salons.index') }}" class="btn col-1 py-2 text-success btn-outline-success btn-custom-e6f9f3">
                Quay lại</a>

            {{-- Update --}}
            <button class="btn col-1 py-2 text-white btn-custom-11c48a" type="submit">Lưu</button>
        </div>
    </form>
@endsection
