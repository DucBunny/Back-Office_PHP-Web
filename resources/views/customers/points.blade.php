@extends('layouts.app')
@section('title', 'Customer Points')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <span>Tiêu đề</span>
        <a href="{{ route('customers.index') }}" class="btn col-1 text-success btn-outline-success btn-custom-e6f9f3">Quay
            lại</a>
    </div>

    <form class="mt-3" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3">
                <p class="form-label">ID thành viên</p>
                <p class="ps-3">{{ $customer->id }}</p>
            </div>

            <div class="form-group">
                <p class="form-label">Cấp điểm</p>
                <p class="ps-3 m-0">10 pt</p>
            </div>
        </div>

        <div class="px-4 pb-2 pt-4 mt-2 bg-white rounded-3 border border-2">
            <div class="form-group">
                <label for="point" class="form-label">Cấp điểm</label>
                <div class="col-md-1 d-flex align-items-center">
                    <input type="number" class="form-control form-control-sm" id="point" />
                    <span class="ps-2">pt</span>
                </div>
            </div>

            <div class="text-center mt-3">
                {{-- Update --}}
                <button class="btn col-2 py-2 text-white btn-custom-06c268" type="submit">Cộng
                    điểm</button>
            </div>
        </div>
    </form>

    <div class="mt-5 bg-white">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="col-2">Ngày giờ cộng điểm</th>
                    <th scope="col" class="col-3">Số điểm thay đổi</th>
                    <th scope="col" class="col-7">Phân loại</th>
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
                {{-- @for ($i = $start; $i < $end; $i++)
                    @php $customer = $customers[$i]; @endphp --}}
                <tr>
                    <td scope="row" class="align-middle">
                        {{ $customer->last_visit_date ? $customer->last_visit_date->format('d/m/Y') : '' }}
                    </td>
                    <td class="align-middle">
                        -10
                    </td>
                    <td class="align-middle">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, commodi.
                    </td>
                </tr>
                {{-- @endfor --}}
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
