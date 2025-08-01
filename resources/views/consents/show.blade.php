@extends('layouts.app')
@section('title', 'Consents Show')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý thỏa thuận</span>
        /
        <span class="fw-light">Chi tiết</span>
    </div>

    <form class="mt-3" method="GET" action="">
        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <p class="form-label">Tiêu đề</p>
                <p class="ps-3"> {{ $consent->title }}</p>
            </div>

            <div class="form-group">
                <p class="form-label">Nội dung</p>
                <p class="ps-3 text-break w-100"> {!! nl2br(e($consent->description)) !!}
                </p>
            </div>
        </div>

        <div class="text-center p-4">
            {{-- Back --}}
            <a href="{{ route('consents.index') }}" class="btn py-2 text-success btn-outline-success btn-custom-e6f9f3"
                style="min-width: 100px">Quay lại</a>
        </div>
    </form>
@endsection
