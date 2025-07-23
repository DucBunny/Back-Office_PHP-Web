@extends('layouts.app')
@section('title', 'Salons Index')


@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý cửa hàng</span>
        /
        <span class="fw-light">Danh sách</span>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('salons.pointSetting') }}" class="btn text-white btn-custom-06c268">Cài đặt điểm
            cộng</a>
        <a href="{{ route('salons.create') }}" class="btn text-white btn-custom-06c268">Đăng
            ký mới</a>
    </div>

    <form class="mt-2" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3 col-md-2">
                <label class="form-label" for="storeCode">Số hiệu cửa hàng</label>
                <input type="text" class="form-control" id="storeCode">
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="storeSelect">Cắt tóc/ Tạo kiểu</label>
                <div class="col-md-3 cursor-pointer">
                    <select class="form-select form-control" id="storeSelect">
                        <option selected class="d-none"></option>
                        <option value="1">Cắt</option>
                        <option value="2">Tạo kiểu</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3 col-md-4">
                <label class="form-label" for="storeName">Tên cửa hàng - Furigana</label>
                <input type="text" class="form-control" id="storeName">
            </div>

            <div class="form-group mb-3 col-md-8">
                <label class="form-label" for="storeAddress">Địa chỉ</label>
                <input type="text" class="form-control" id="storeAddress">
            </div>

            <div class="form-row mb-2 d-flex justify-content-center gap-3">
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm
                    kiếm</button>
                <button type="submit" class="btn text-white btn-custom-11c48a">Tải
                    CSV</button>
                <button type="submit" class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa
                    điều kiện</button>
            </div>
        </div>
    </form>

    <div class="mt-2 bg-white">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width: 3%">ID</th>
                    <th scope="col" style="width: 9.5%">Số hiệu</th>
                    <th scope="col" style="width: 9.5%">Phân loại</th>
                    <th scope="col" style="width: 9.5%">Tên</th>
                    <th scope="col" style="width: 9.5%">Furigana</th>
                    <th scope="col" style="width: 15%">Địa chỉ</th>
                    <th scope="col" style="width: 10%">Điểm cộng (Nhuộm tóc)</th>
                    <th scope="col" style="width: 10%">Điểm cộng (Uốn tóc)</th>
                    <th scope="col" style="width: 8%">Trạng thái</th>
                    <th scope="col" style="width: 8%"></th>
                    <th scope="col" style="width: 8%"></th>
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
                            100
                        </td>
                        <td class="align-middle">
                            1000001
                        </td>
                        <td class="align-middle">
                            Cắt tóc
                        </td>
                        <td class="align-middle">
                            AAA
                        </td>
                        <td class="align-middle">
                            e ten
                        </td>
                        <td class="align-middle text-truncate">
                            Lorem ipsum dolor sit amet.
                        </td>
                        <td class="align-middle">
                            10pt
                        </td>
                        <td class="align-middle">
                            20pt
                        </td>
                        <td class="text-center align-middle">
                            <a href="#" class="w-100 btn btn-sm fw-bold text-white" data-bs-toggle="modal"
                                data-bs-target="#changeStatusModal" style="background-color: #06c268">Riêng tư</a>
                        </td>
                        <td class="text-center align-middle">
                            {{-- Edit --}}
                            <a href="{{ route('salons.edit', 1) }}"
                                class="w-100 btn btn-sm fw-bold border btn-custom-white">Sửa</a>
                        </td>
                        <td class="text-center align-middle">
                            {{-- Delete --}}
                            <form action="#" method="POST" name="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="w-100 btn btn-sm fw-bold text-danger w-100 btn-delete btn-custom-f2aa84"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
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
