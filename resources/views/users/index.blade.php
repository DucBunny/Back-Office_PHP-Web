@extends('layouts.app')
@section('title', 'Users Index')


@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý tài khoản</span>
        /
        <span class="fw-light">Danh sách</span>
    </div>

    <div class="text-end">
        <a href="{{ route('users.create') }}" class="btn text-white btn-custom-06c268">Đăng
            ký mới</a>
    </div>

    <form class="mt-2" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3">
                <div class="form-row d-flex align-items-center gap-3">
                    <p class="form-label m-0">Cửa hàng</p>
                    <div class="dropdown col-md-9">
                        {{-- <button class="btn text-white dropdown-toggle-no-icon col-md-3" type="button" id="storeDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #06c268; ">
                            Chọn
                        </button> --}}
                        <button class="btn text-white col-md-3 btn-custom-06c268" type="button" id="salonModal"
                            data-bs-toggle="modal" data-bs-target="#salonModal">
                            Chọn
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="storeDropdown">
                            <li><a class="dropdown-item store-option" href="#" data-value="store1">Cửa hàng A</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store2">Cửa hàng B</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store3">Cửa hàng C</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store4">Cửa hàng D</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store5">Cửa hàng E</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <p id="selectedStores" class="mt-2 ms-3">
                    <span class="text-muted">Chưa chọn cửa hàng nào</span>
                </p>
            </div>

            <div class="form-row d-flex justify-content-center gap-3">
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm
                    kiếm</button>
                <button type="submit" class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa
                    điều kiện</button>
            </div>
        </div>
    </form>

    <div class="mt-4 bg-white">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width: 15%">Tên cửa hàng</th>
                    <th scope="col" style="width: 15%">Quyền</th>
                    <th scope="col" style="width: 15%">Tên tài khoản</th>
                    <th scope="col" style="width: 15%">ID đăng nhập</th>
                    <th scope="col" style="width: 15%">Mã nhận dạng</th>
                    <th scope="col" style="width: 25%"></th>
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
                            AAAA
                        </td>
                        <td class="align-middle">
                            Admin
                        </td>
                        <td class="align-middle">
                            Kimura
                        </td>
                        <td class="align-middle">
                            A0001
                        </td>
                        <td class="align-middle">
                            A
                        </td>
                        <td class="d-flex justify-content-center gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('users.edit', 1) }}"
                                class="col-4 btn btn-sm fw-bold border btn-custom-white">Sửa</a>

                            {{-- Delete --}}
                            <form action="#" method="POST" class="col-4" name="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-100 btn btn-sm fw-bold text-danger w-100 btn-delete btn-custom-f2aa84"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                            </form>
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
