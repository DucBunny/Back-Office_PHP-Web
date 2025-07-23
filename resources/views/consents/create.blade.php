@extends('layouts.app')
@section('title', 'Consents Create')


@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý thỏa thuận</span>
        /
        <span class="fw-light">Thêm mới</span>
    </div>

    <form class="mt-3" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="title">Tiêu đề</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-4 position-relative">
                    <input type="text" class="form-control" id="title" />
                </div>
            </div>

            <div class="form-group">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label for="content" class="form-label m-0">Nội dung</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <textarea class="form-control" id="content" style="height: 300px; resize: none"></textarea>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 p-4">
            {{-- Back --}}
            <a href="{{ route('consents.index') }}"
                class="btn col-1 py-2 text-success btn-outline-success btn-custom-e6f9f3">Quay lại</a>

            {{-- Update --}}
            <button class="btn col-1 py-2 text-white btn-custom-11c48a" type="submit">Lưu</button>
        </div>
    </form>
@endsection
