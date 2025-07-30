@extends('layouts.app')
@section('title', 'Salons Setting Point')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý cửa hàng</span>
        /
        <span class="fw-light">Cài đặt điểm thưởng</span>
    </div>

    <form class="mt-3" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="px-4 py-3 mt-2 bg-white rounded-3 border border-2">
            <div class="form-group">
                <div class="d-flex align-items-center gap-3">
                    <p class="m-0">取込ファイル</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-2 mt-3">
                    <label for="point" class="btn btn-sm w-75 text-white ms-4 btn-custom-11c48a">Chọn
                        file</label>
                    <input type="file" accept=".csv" class="form-control form-control-sm d-none" id="point" />
                </div>
            </div>

            <div class="text-end mt-3">
                {{-- Update --}}
                <button class="btn col-1 py-2 text-white mb-2 btn-custom-06c268" type="submit">Nhập</button>
            </div>
        </div>
    </form>
@endsection
