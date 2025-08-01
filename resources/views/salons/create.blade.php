@extends('layouts.app')
@section('title', 'Salon Create')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý cửa hàng</span>
        /
        <span class="fw-light">Đăng ký</span>
    </div>

    <form class="mt-3" method="POST" action="{{ route('salons.store') }}">
        @csrf

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="salonCode">Mã cửa hàng</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-2">
                    <input type="text" class="form-control" style="min-width: 200px" name="salon_code" id="salonCode"
                        value="{{ old('salon_code') }}" />
                </div>

                @error('salon_code')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="salonSelect">Cắt tóc/ Tạo kiểu</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-md-3">
                    <select class="form-select form-control" name="type" id="salonSelect">
                        <option selected class="d-none"></option>
                        <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Cắt tóc</option>
                        <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Tạo kiểu</option>
                    </select>
                </div>

                @error('type')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3 col-md-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="salonName">Tên cửa hàng</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3">
                    <input type="text" class="form-control" name="name" id="salonName" value="{{ old('name') }}">
                </div>

                @error('name')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3 col-md-4">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="furigana">Furigana</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3">
                    <input type="text" class="form-control" name="furigana" id="furigana" value="{{ old('furigana') }}">
                </div>

                @error('furigana')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label for="colorPoint" class="form-label m-0">Điểm thưởng (Nhuộm tóc)</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 d-flex align-items-center">
                    <input type="number" class="form-control form-control-sm" style="width: 80px" name="color_plus_point"
                        id="colorPoint" min="0" value="{{ old('color_plus_point', 1) }}" />
                    <span class="ps-2">pt</span>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label for="permPoint" class="form-label m-0">Điểm thưởng (Uốn tóc)</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 d-flex align-items-center">
                    <input type="number" class="form-control form-control-sm" style="width: 80px" name="perm_plus_point"
                        id="permPoint" min="0" value="{{ old('perm_plus_point', 1) }}" />
                    <span class="ps-2">pt</span>
                </div>
            </div>

            <div class="form-group mb-3 w-100">
                <label class="form-label" for="salonAddress">Địa chỉ</label>
                <div class="ps-3">
                    <input type="text" class="form-control" name="address" id="salonAddress"
                        value="{{ old('address') }}">
                </div>
            </div>

            <div class="form-group mb-3 w-100">
                <p class="form-label">Trạng thái</p>
                <div class="ps-3">
                    <button id="toggleStatusBtn"
                        class="btn text-white {{ old('status', 1) == 1 ? 'btn-custom-06c268' : 'btn-custom-6c757d' }}">
                        {{ old('status', 1) == 1 ? 'Công khai' : 'Riêng tư' }}</button>
                    <input type="hidden" name="status" id="salonStatus" value="{{ old('status', 1) }}">
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex justify-content-center gap-3 p-4">
            {{-- Back --}}
            <a href="{{ route('salons.index') }}" class="btn py-2 text-success btn-outline-success btn-custom-e6f9f3"
                style="min-width: 100px">Quay lại</a>

            {{-- Update --}}
            <button type="submit" class="btn py-2 text-white btn-custom-11c48a" style="min-width: 100px">Lưu</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        // Thay đổi trạng thái 
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('toggleStatusBtn');
            const input = document.getElementById('salonStatus');

            // Hàm cập nhật giao diện theo giá trị input
            function updateBtn() {
                if (input.value == '1') {
                    btn.textContent = 'Công khai';
                    btn.classList.remove('btn-custom-6c757d');
                    btn.classList.add('btn-custom-06c268');
                } else {
                    btn.textContent = 'Riêng tư';
                    btn.classList.remove('btn-custom-06c268');
                    btn.classList.add('btn-custom-6c757d');
                }
            }

            // Gọi khi load trang để set đúng trạng thái ban đầu
            updateBtn();

            btn.addEventListener('click', function(e) {
                e.preventDefault();
                input.value = (input.value == '1') ? 0 : 1;
                updateBtn();
            });
        });
    </script>
@endsection
