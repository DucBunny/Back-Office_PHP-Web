@extends('layouts.app')
@section('title', 'Consents Index')


@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý thỏa thuận</span>
        /
        <span class="fw-light">Danh sách</span>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('consents.history') }}" class="btn text-white btn-custom-06c268">Lịch sử đồng ý</a>
        <a href="{{ route('consents.create') }}" class="btn text-white btn-custom-06c268">Đăng ký mới</a>
    </div>

    <form class="mt-2" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3">
                <label class="form-label" for="title">Tiêu đề</label>
                <div class="col-md-4 position-relative">
                    <input type="text" class="form-control" id="title" />
                </div>
            </div>

            <div class="form-row d-flex justify-content-center gap-2">
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm kiếm</button>
                <button type="submit" class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa điều kiện</button>
            </div>
        </div>
    </form>

    <div class="mt-4 bg-white">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="col-4">Tiêu đề</th>
                    <th scope="col" class="col-3">Trạng thái công khai</th>
                    <th scope="col" class="col-3">Ngày đăng ký</th>
                    <th scope="col" class="col-2"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $perPage = 10;
                    // $total = count($customers);
                    $total = 1;
                    $page = request()->get('page', 1);
                    $start = ($page - 1) * $perPage;
                    $end = min($start + $perPage, $total);
                @endphp
                @for ($i = $start; $i < $end; $i++)
                    {{-- @php $customer = $customers[$i]; @endphp --}}
                    <tr>
                        <td scope="row" class="align-middle">
                            Test tiêu đề abc
                        </td>
                        <td class="align-middle">
                            <a href="#" class="w-50 btn btn-sm fw-bold text-white" data-bs-toggle="modal"
                                data-bs-target="#changeStatusModal" style="background-color: #06c268">Riêng tư</a>
                        </td>
                        <td class="align-middle">
                            20/11/2024
                        </td>
                        <td class="text-end align-middle">
                            {{-- Show --}}
                            <a href="{{ route('consents.show', 1) }}"
                                class="col-4 btn btn-sm fw-bold border btn-custom-white">Xem</a>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center my-3 gap-2">
        @php $totalPages = ceil($total / $perPage); @endphp
        <nav>
            <ul class="pagination">
                <li class="page-item @if ($page == 1) disabled @endif">
                    <a class="page-link" href="?page={{ max(1, $page - 1) }}" aria-label="Previous">
                        <span aria-hidden="true" class="text-muted">&lsaquo;</span>
                    </a>
                </li>
                @for ($p = 1; $p <= $totalPages; $p++)
                    <li class="page-item  @if ($p == $page) active @endif">
                        <a class="page-link text-muted" href="?page={{ $p }}">{{ $p }}</a>
                    </li>
                @endfor
                <li class="page-item @if ($page == $totalPages) disabled @endif">
                    <a class="page-link" href="?page={{ min($totalPages, $page + 1) }}" aria-label="Next">
                        <span aria-hidden="true" class="text-muted">&rsaquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
