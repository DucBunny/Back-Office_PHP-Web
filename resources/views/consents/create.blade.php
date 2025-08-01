@extends('layouts.app')
@section('title', 'Consents Create')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý thỏa thuận</span>
        /
        <span class="fw-light">Thêm mới</span>
    </div>

    <form class="mt-3" method="POST" action="{{ route('consents.store') }}">
        @csrf

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="title">Tiêu đề</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-md-4">
                    <input type="text" class="form-control" name="title" id="title" />
                </div>

                @error('title')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label for="description" class="form-label m-0">Nội dung</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3">
                    <textarea class="form-control" name="description" id="description" style="height: 300px"></textarea>
                </div>

                @error('description')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex justify-content-center gap-3 p-4">
            {{-- Back --}}
            <a href="{{ route('consents.index') }}" class="btn py-2 text-success btn-outline-success btn-custom-e6f9f3"
                style="min-width: 100px">Quay
                lại</a>

            {{-- Update --}}
            <button type="submit" class="btn py-2 text-white btn-custom-11c48a" style="min-width: 100px">Lưu</button>
        </div>
    </form>
@endsection
