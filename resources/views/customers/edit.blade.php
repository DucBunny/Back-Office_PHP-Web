@extends('layouts.app')
@section('title', 'Customer Edit')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý khách hàng</span>
        /
        <span class="fw-light">Chỉnh sửa</span>
    </div>

    <form class="mt-3" method="POST" action="{{ route('customers.update', $customer->id) }}">
        {{-- CSRF Token and Method --}}
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <p class="form-label">ID thành viên</p>
                <p class="ps-3">{{ $customer->id }}</p>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="yearPicker">Năm sinh</label>
                <div class="px-0 col-md-3" id="yearpicker-container">
                    <input type="text" class="form-control" id="yearpicker" placeholder="YYYY"
                        value="{{ now()->year - $customer->age }}" />
                </div>
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Giới tính</p>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault1" value="male"
                            {{ $customer->gender === 'male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioDefault1">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault2" value="female"
                            {{ $customer->gender === 'female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioDefault2">Nữ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault3" value="other"
                            {{ $customer->gender === 'other' ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioDefault3">Chưa phản hồi</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="notes" class="form-label">Yêu cầu & lưu ý</label>
                <textarea class="form-control" id="notes" style="height: 80px; resize: none">{{ $customer->notes }}</textarea>
            </div>
        </div>

        {{-- Create Card --}}
        <div class="form-row mt-4 me-3 text-end">
            <a href="{{ route('customers.createCard', $customer->id) }}" style="margin-left: 10rem"
                class="btn text-white btn-custom-06c268">Đăng ký
                mới</a>
        </div>

        <div class="form-row fixed-bottom d-flex justify-content-center gap-3 p-4" style="margin-left: 250px">
            {{-- Back --}}
            <a href="{{ route('customers.index') }}"
                class="btn col-1 py-2 text-success btn-outline-success btn-custom-e6f9f3">Quay lại</a>

            {{-- Update --}}
            <button class="btn col-1 py-2 text-white btn-custom-11c48a" type="submit">Lưu</button>
        </div>
    </form>

    <div class="mt-3 bg-white">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="col-2">Thời gian</th>
                    <th scope="col" class="col-2">Cửa hàng</th>
                    <th scope="col" class="col-7">Nội dung</th>
                    <th scope="col" class="col-1"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $perPage = 10;
                    $total = count($cards);
                    $page = request()->get('page', 1);
                    $start = ($page - 1) * $perPage;
                    $end = min($start + $perPage, $total);
                @endphp
                @for ($i = $start; $i < $end; $i++)
                    @php $card = $cards[$i]; @endphp
                    <tr>
                        <td scope="row" class="align-middle">
                            {{ $card->visit_date->format('d/m/Y H:i') }}
                        </td>
                        <td class="align-middle">
                            {{ $card->salon->name }}
                        </td>
                        <td class="align-middle text-truncate" style="max-width: 200px;">
                            {{ $card->memo }}
                        </td>
                        <td class="text-center">
                            {{-- Edit --}}
                            <a href="{{ route('customers.editCard', $card->id) }}"
                                class="w-100 btn btn-sm fw-bold border btn-custom-white">Duyệt</a>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center my-3 gap-2 mb-5">
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

{{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectedStores = new Set();
            const selectedStoresElement = document.getElementById('selectedStores');
            const storeOptions = document.querySelectorAll('.store-option');

            // Xử lý click vào dropdown item
            storeOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();

                    const value = this.dataset.value;
                    const text = this.textContent;

                    if (selectedStores.has(value)) {
                        // Nếu đã chọn thì bỏ chọn
                        selectedStores.delete(value);
                        this.classList.remove('selected');
                    } else {
                        // Nếu chưa chọn thì thêm vào
                        selectedStores.add(value);
                        this.classList.add('selected');
                    }

                    updateSelectedDisplay();
                });
            });

            // Cập nhật hiển thị các item đã chọn
            function updateSelectedDisplay() {
                if (selectedStores.size === 0) {
                    selectedStoresElement.innerHTML = '<span class="text-muted">Chưa chọn cửa hàng nào</span>';
                } else {
                    let html = '';
                    storeOptions.forEach(option => {
                        const value = option.dataset.value;
                        if (selectedStores.has(value)) {
                            const text = option.textContent;
                            html += `<span class="selected-tag">
                                        ${text}
                                        <span class="remove-tag" data-value="${value}">x</span>
                                    </span>`;
                        }
                    });
                    selectedStoresElement.innerHTML = html;

                    // Thêm event listener cho nút xóa
                    const removeTags = selectedStoresElement.querySelectorAll('.remove-tag');
                    removeTags.forEach(tag => {
                        tag.addEventListener('click', function() {
                            const value = this.dataset.value;
                            selectedStores.delete(value);

                            // Bỏ selected class từ dropdown item
                            const option = document.querySelector(`[data-value="${value}"]`);
                            if (option) {
                                option.classList.remove('selected');
                            }

                            updateSelectedDisplay();
                        });
                    });
                }
            }
        });
    </script>
@endsection --}}

@section('scripts')
    <script type="module">
        const picker = new TempusDominus(document.getElementById('yearpicker'), {
            display: {
                viewMode: 'years',
                theme: 'light',
                toolbarPlacement: 'top',
                icons: {
                    type: 'icons',
                    time: 'bi bi-clock',
                    date: 'fa-regular fa-calendar',
                    up: 'fa-solid fa-chevron-up',
                    down: 'fa-solid fa-chevron-down',
                },
                components: {
                    date: false,
                    month: false,
                    clock: false,
                },
            },
            localization: {
                locale: 'vi',
                format: 'yyyy'
            },
            restrictions: {
                minDate: new Date(1900, 0, 1),
                maxDate: new Date()
            },
            useCurrent: false,
            container: document.getElementById('yearpicker-container')
        });
    </script>
@endsection
