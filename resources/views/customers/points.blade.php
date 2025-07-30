@extends('layouts.app')
@section('title', 'Customer Points')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <span>Tiêu đề</span>
        <a href="{{ route('customers.index') }}" class="btn col-1 text-success btn-outline-success btn-custom-e6f9f3">Quay
            lại</a>
    </div>

    @if (session('success'))
        <div id="alert-success"
            class="alert alert-success text-success text-center position-fixed top-0 start-50 translate-middle-x mt-3"
            style="z-index: 9999; min-width: 300px;">
            {{ session('success') }}
        </div>
    @endif

    <form class="mt-3" method="POST" action="{{ route('customers.addPoints', $customer->id) }}">
        @csrf

        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3">
                <p class="form-label">ID thành viên</p>
                <p class="ps-3">{{ $customer->id }}</p>
            </div>

            <div class="form-group">
                <p class="form-label">Điểm thưởng</p>
                <p class="ps-3 m-0">{{ $customer->point }} pt</p>
            </div>
        </div>

        <div class="px-4 pb-2 pt-4 mt-2 bg-white rounded-3 border border-2">
            <div class="form-group">
                <label for="point" class="form-label">Cấp điểm</label>
                <div class="ps-3 col-md-1 d-flex align-items-center">
                    <input type="number" class="form-control form-control-sm" name="point" id="point" />
                    <span class="ps-2">pt</span>
                </div>
            </div>

            {{-- Update --}}
            <div class="text-center mt-3">
                <button class="btn col-2 py-2 text-white btn-custom-06c268" type="submit">Cộng điểm</button>
            </div>
        </div>
    </form>

    @if ($point_history->isEmpty())
        <div class="mt-4">
            <p class="text-center text-muted">Không có dữ liệu để hiển thị.</p>
        </div>
    @else
        <div class="mt-5">
            {{-- Points History Table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="fw-medium col-2">Ngày giờ cộng điểm</th>
                        <th scope="col" class="fw-medium col-3">Số điểm thay đổi</th>
                        <th scope="col" class="fw-medium col-7">Phân loại</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($point_history as $history)
                        <tr>
                            <td scope="row" class="align-middle">
                                {{ $history->created_at->format('d/m/Y') }}
                            </td>
                            <td class="align-middle">
                                {{ $history->change }} pt
                            </td>
                            <td class="align-middle">
                                @switch($history->type)
                                    @case(1)
                                        Đến cửa hàng
                                    @break

                                    @case(2)
                                        Cộng điểm thủ công
                                    @break

                                    @default
                                        Đổi sản phẩm
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center my-3 gap-2">
                <ul class="pagination">
                    <li class="page-item @if ($point_history->onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $point_history->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="text-muted">&lsaquo;</span>
                        </a>
                    </li>
                    @for ($p = 1; $p <= $point_history->lastPage(); $p++)
                        <li class="page-item @if ($p == $point_history->currentPage()) active @endif">
                            <a class="page-link text-muted" href="{{ $point_history->url($p) }}">{{ $p }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if (!$point_history->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{ $point_history->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true" class="text-muted">&rsaquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif
@endsection
