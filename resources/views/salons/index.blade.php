@extends('layouts.app')
@section('title', 'Salons Index')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý cửa hàng</span>
        /
        <span class="fw-light">Danh sách</span>
    </div>

    @if (session('success'))
        <div id="alert-success"
            class="alert alert-success text-success text-center position-fixed top-0 start-50 translate-middle-x mt-3"
            style="z-index: 9999; min-width: 300px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('salons.pointSetting') }}" class="btn text-white btn-custom-06c268">Cài đặt điểm
            cộng</a>
        <a href="{{ route('salons.create') }}" class="btn text-white btn-custom-06c268">Đăng
            ký mới</a>
    </div>

    <form class="mt-2" method="GET" action="{{ route('salons.index') }}">
        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3 col-md-2">
                <label class="form-label" for="salonCode">Số hiệu cửa hàng</label>
                <div class="ps-3">
                    <input type="text" class="form-control" name="salon_code" id="salonCode"
                        value="{{ request('salon_code') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="salonSelect">Cắt tóc/ Tạo kiểu</label>
                <div class="ps-3 col-md-3">
                    <select class="form-select form-control" name="type" id="salonSelect">
                        <option selected class="d-none"></option>
                        <option value="1" {{ request('type') == 1 ? 'selected' : '' }}>Cắt tóc</option>
                        <option value="2" {{ request('type') == 2 ? 'selected' : '' }}>Tạo kiểu</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3 col-md-4">
                <label class="form-label" for="salonName">Tên cửa hàng - Furigana</label>
                <div class="ps-3">
                    <input type="text" class="form-control" name="name" id="salonName" value="{{ request('name') }}">
                </div>
            </div>

            <div class="form-group mb-3 col-md-8">
                <label class="form-label" for="salonAddress">Địa chỉ</label>
                <div class="ps-3">
                    <input type="text" class="form-control" name="address" id="salonAddress"
                        value="{{ request('address') }}">
                </div>
            </div>

            <div class="form-row mb-2 d-flex justify-content-center gap-3">
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm
                    kiếm</button>

                <a href="{{ route('salons.exportSalonCsv', request()->query()) }}"
                    class="btn text-white btn-custom-11c48a">Tải CSV</a>

                <a href="{{ route('salons.index') }}" class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa
                    điều kiện</a>
            </div>
        </div>
    </form>

    @if ($salons->isEmpty())
        <div class="mt-4">
            <p class="text-center text-muted">Không có cửa hàng nào phù hợp với điều kiện tìm kiếm.</p>
        </div>
    @else
        <div class="mt-2">
            {{-- Results Table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="fw-medium" style="width: 3%">ID</th>
                        <th scope="col" class="fw-medium" style="width: 9%">Số hiệu</th>
                        <th scope="col" class="fw-medium" style="width: 9%">Phân loại</th>
                        <th scope="col" class="fw-medium" style="width: 9.5%">Tên</th>
                        <th scope="col" class="fw-medium" style="width: 9.5%">Furigana</th>
                        <th scope="col" class="fw-medium" style="width: 15%">Địa chỉ</th>
                        <th scope="col" class="fw-medium" style="width: 9.2%">Điểm cộng (Nhuộm tóc)</th>
                        <th scope="col" class="fw-medium" style="width: 8.8%">Điểm cộng (Uốn tóc)</th>
                        <th scope="col" class="fw-medium" style="width: 9%">Trạng thái</th>
                        <th scope="col" class="fw-medium" style="width: 9%"></th>
                        <th scope="col" class="fw-medium" style="width: 9%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salons as $salon)
                        <tr>
                            <td scope="row" class="align-middle">
                                {{ $salon->id }}
                            </td>
                            <td class="align-middle">
                                {{ $salon->salon_code }}
                            </td>
                            <td class="align-middle">
                                {{ $salon->type == 1 ? 'Cắt tóc' : 'Tạo kiểu' }}
                            </td>
                            <td class="align-middle">
                                {{ $salon->name }}
                            </td>
                            <td class="align-middle">
                                {{ $salon->furigana }}
                            </td>
                            <td class="align-middle text-truncate">
                                {{ $salon->address }}
                            </td>
                            <td class="align-middle">
                                {{ $salon->color_plus_point }}pt
                            </td>
                            <td class="align-middle">
                                {{ $salon->perm_plus_point }}pt
                            </td>
                            <td class="text-center align-middle">
                                <button type="button"
                                    class="w-100 btn btn-sm fw-bold text-white {{ $salon->status ? 'btn-custom-06c268' : 'btn-custom-6c757d' }}"
                                    data-bs-toggle="modal" data-bs-target="#changeStatusModal"
                                    data-salon-id="{{ $salon->id }}" data-status="{{ $salon->status }}">
                                    {{ $salon->status ? 'Công khai' : 'Riêng tư' }}
                                </button>
                            </td>
                            <td class="text-center align-middle">
                                {{-- Edit --}}
                                <a href="{{ route('salons.edit', $salon->id) }}"
                                    class="w-100 btn btn-sm fw-bold border btn-custom-white">Sửa</a>
                            </td>
                            <td class="text-center align-middle">
                                {{-- Delete --}}
                                <form action="{{ route('salons.destroy', $salon->id) }}" method="POST"
                                    name="deleteForm">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        class="w-100 btn btn-sm fw-bold text-danger w-100 btn-delete-confirm btn-custom-f2aa84"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center my-3 gap-2">
                <ul class="pagination">
                    <li class="page-item @if ($salons->onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $salons->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="text-muted">&lsaquo;</span>
                        </a>
                    </li>
                    @for ($p = 1; $p <= $salons->lastPage(); $p++)
                        <li class="page-item @if ($p == $salons->currentPage()) active @endif">
                            <a class="page-link text-muted" href="{{ $salons->url($p) }}">{{ $p }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if (!$salons->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{ $salons->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true" class="text-muted">&rsaquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        let selectedSalonId = null;
        let selectedButton = null;
        const modal = document.getElementById('changeStatusModal');

        modal.addEventListener('show.bs.modal', function(event) {
            const newStatus = event.relatedTarget.getAttribute('data-status') == '1' ? 'riêng tư' : 'công khai';
            selectedButton = event.relatedTarget;
            selectedSalonId = selectedButton.getAttribute('data-salon-id');
            modal.querySelector('#newStatus').textContent = newStatus;
        });

        document.getElementById('confirmChangeStatus').addEventListener('click', function() {
            if (selectedSalonId) {
                fetch("{{ url('salons') }}/" + selectedSalonId + "/toggle-status", {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Cập nhật nút trạng thái
                        selectedButton.textContent = data.label;
                        selectedButton.classList.remove('btn-custom-06c268', 'btn-custom-6c757d');
                        selectedButton.classList.add(data.class);
                        selectedButton.setAttribute('data-status', data.status ? 1 : 0);
                        // Đóng modal
                        bootstrap.Modal.getInstance(modal).hide();
                    });
            }
        });
    </script>
@endsection
