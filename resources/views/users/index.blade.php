@extends('layouts.app')
@section('title', 'Users Index')
@include('modals.select_salon', ['salons' => $salons])
@vite(['resources/js/delete_item_selected.js'])

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

    @if (session('success'))
        <div id="alert-success"
            class="alert alert-success text-success text-center position-fixed top-0 start-50 translate-middle-x mt-3"
            style="z-index: 9999; min-width: 300px;">
            {{ session('success') }}
        </div>
    @endif

    <form class="mt-2" method="GET" action="{{ route('users.index') }}">
        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3">
                <div class="form-row d-flex align-items-center gap-3">
                    <p class="form-label m-0">Cửa hàng</p>
                    <div class="dropdown col-md-9">
                        <button class="btn text-white col-md-3 btn-custom-06c268" type="button" id="salonModal"
                            data-bs-toggle="modal" data-bs-target="#salonModal">
                            Chọn
                        </button>
                    </div>
                </div>

                <div id="selectedSalons" class="mt-2"></div>
                <input type="hidden" name="salon_ids" id="selectedSalonIds" value="{{ request('salon_ids') }}">
            </div>

            <div class="form-row d-flex justify-content-center gap-3">
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm
                    kiếm</button>
                <a href="{{ route('users.index') }}" class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa
                    điều kiện</a>
            </div>
        </div>
    </form>

    @if ($users->isEmpty())
        <div class="mt-4">
            <p class="text-center text-muted">Không có dữ liệu nào phù hợp với điều kiện tìm kiếm.</p>
        </div>
    @else
        <div class="mt-4">
            {{-- Results Table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="fw-medium" style="width: 25%">Tên cửa hàng</th>
                        <th scope="col" class="fw-medium" style="width: 12%">Quyền</th>
                        <th scope="col" class="fw-medium" style="width: 15%">Tên tài khoản</th>
                        <th scope="col" class="fw-medium" style="width: 12%">ID đăng nhập</th>
                        <th scope="col" class="fw-medium" style="width: 12%">Mã nhận dạng</th>
                        <th scope="col" class="fw-medium" style="width: 24%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td scope="row" class="align-middle">
                                {{ $user->salons()->wherePivot('deleted_at', null)->pluck('name')->join(', ') ?: '-' }}
                            </td>
                            <td class="align-middle">
                                @switch($user->role)
                                    @case(1)
                                        Admin
                                    @break

                                    @case(2)
                                        Manager
                                    @break

                                    @default
                                        Staff
                                @endswitch
                            </td>
                            <td class="align-middle">
                                {{ $user->name }}
                            </td>
                            <td class="align-middle">
                                {{ $user->login_id }}
                            </td>
                            <td class="align-middle">
                                {{ $user->device_code ?? '-' }}
                            </td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="col-4 btn btn-sm fw-bold border btn-custom-white">Sửa</a>

                                    {{-- Delete --}}
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="col-4"
                                        name="deleteForm">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                            class="w-100 btn btn-sm fw-bold text-danger w-100 btn-delete-confirm btn-custom-f2aa84"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center my-3 gap-2">
                <ul class="pagination">
                    <li class="page-item @if ($users->onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="text-muted">&lsaquo;</span>
                        </a>
                    </li>
                    @for ($p = 1; $p <= $users->lastPage(); $p++)
                        <li class="page-item @if ($p == $users->currentPage()) active @endif">
                            <a class="page-link text-muted" href="{{ $users->url($p) }}">{{ $p }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if (!$users->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true" class="text-muted">&rsaquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif
@endsection


@section('scripts')
    <script type="module">
        // Xử lý nút Xóa salon đã chọn
        document.getElementById('selectedSalons').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-delete-item')) {
                e.target.closest('.salon-item').remove();

                // Cập nhật lại giá trị hidden input sau khi xóa
                const items = document.querySelectorAll('#selectedSalons .salon-item');
                const ids = Array.from(items).map(item => item.getAttribute('data-id'));
                document.getElementById('selectedSalonIds').value = ids.join(',');
            }
        });
    </script>
@endsection
