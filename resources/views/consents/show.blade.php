@extends('layouts.app')
@section('title', 'Consents Show')


@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý thỏa thuận</span>
        /
        <span class="fw-light">Chi tiết</span>
    </div>

    <form class="mt-3" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <p class="form-label">Tiêu đề</p>
                <p class="ps-3"> Test tiêu đề</p>
            </div>

            <div class="form-group">
                <p class="form-label">Nội dung</p>
                <p class="ps-3"> Test nội dung</p>
            </div>
        </div>

        <div class="text-center p-4">
            {{-- Back --}}
            <a href="{{ route('consents.index') }}"
                class="btn col-1 py-2 text-success btn-outline-success btn-custom-e6f9f3">Quay lại</a>
        </div>
    </form>
@endsection
