@extends('layouts.app')
@section('title', 'Customer Index')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý khách hàng</span>
        /
        <span class="fw-light">Danh sách</span>
    </div>

    {{-- Search Form --}}
    <form class="mt-3">
        <div class="p-3 bg-white rounded-4 border border-2">
            <div class="form-group col-md-4 mb-3">
                <label for="customer_id" class="form-label">ID thành viên</label>
                <input type="text" class="form-control" name="customer_id" id="customer_id">
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Giới tính</p>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="male" value="male">
                        <label class="form-check-label" for="male">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="female" value="female">
                        <label class="form-check-label" for="female">Nữ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="other" value="other">
                        <label class="form-check-label" for="other">Chưa phản hồi</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Độ tuổi</p>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="age10" value="10">
                        <label class="form-check-label" for="age10">10</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="age20" value="20">
                        <label class="form-check-label" for="age20">20</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="age30" value="30">
                        <label class="form-check-label" for="age30">30</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="age40" value="40">
                        <label class="form-check-label" for="age40">40</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="age50" value="50">
                        <label class="form-check-label" for="age50">50</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="age60" value="60">
                        <label class="form-check-label" for="age60">60</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="age70" value="70">
                        <label class="form-check-label" for="age70">70</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="age80" value="80">
                        <label class="form-check-label" for="age80">80+</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Loại hình sử dụng</p>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="isCut" value="isCut">
                        <label class="form-check-label" for="isCut">Cắt</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="isColor" value="isColor">
                        <label class="form-check-label" for="isColor">Nhuộm</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="isPerm" value="isPerm">
                        <label class="form-check-label" for="isPerm">Uốn</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Số lần đã đến</p>
                <div class="d-flex align-items-center gap-2">
                    <div class="col-md-1 ">
                        <input type="number" class="form-control" id="min" min="0" />
                    </div>
                    <span>&#x2053;</span>
                    <div class="col-md-1">
                        <input type="number" class="form-control" id="max" min="0" />
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="form-row d-flex align-items-center gap-3">
                    <p class="form-label m-0">Cửa hàng đã đến thăm</p>
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

            <div class="form-group mb-3">
                <p class="form-label">Thời gian đã đến</p>
                <div class="d-flex align-items-center gap-2">
                    <div class="px-0 col-md-3 position-relative" id="datepicker-start-container">
                        <input type="text" class="form-control" id="datepicker-start" style="padding-left: 30px"
                            placeholder="DD/MM/YYYY" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted z-3"
                            style="pointer-events: none"></i>
                    </div>
                    <span>&#x2053;</span>
                    <div class="px-0 col-md-3 position-relative" id="datepicker-end-container">
                        <input type="text" class="form-control" id="datepicker-end" style="padding-left: 30px"
                            placeholder="DD/MM/YYYY" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted z-3"
                            style="pointer-events: none"></i>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="form-row mb-2 d-flex justify-content-end gap-3">
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm
                    kiếm</button>
                <button type="submit" class="btn text-white btn-custom-11c48a">Tải
                    CSV</button>
                <button type="submit" class="btn text-white btn-custom-06c268">Tải lịch
                    sử điểm</button>
                <button type="submit" class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa
                    điều kiện</button>
                <button type="submit" class="btn text-white btn-custom-06c268" style="margin-left: 10rem">Xuất
                    phân đoạn</button>
            </div>
        </div>
    </form>

    {{-- Results Table --}}
    <div class="mt-4">
        <table class="table bg-white">
            <thead>
                <tr>
                    <th scope="col" class="col-2">ID thành viên</th>
                    <th scope="col" class="col-3">Cửa hàng đã thăm gần nhất</th>
                    <th scope="col" class="col-3">Ngày tới gần nhất</th>
                    <th scope="col" class="col-4"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $perPage = 10;
                    $total = count($customers);
                    $page = request()->get('page', 1);
                    $start = ($page - 1) * $perPage;
                    $end = min($start + $perPage, $total);
                @endphp
                @for ($i = $start; $i < $end; $i++)
                    @php $customer = $customers[$i]; @endphp
                    <tr>
                        <td scope="row" class="align-middle">
                            {{ $customer->id }}
                        </td>
                        <td class="align-middle">
                            {{ $customer->last_salon }}
                        </td>
                        <td class="align-middle">
                            {{ $customer->last_visit_date ? $customer->last_visit_date->format('d/m/Y') : '' }}
                        </td>
                        <td class="d-flex justify-content-end gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('customers.edit', $customer->id) }}"
                                class="col-3 btn btn-sm fw-bold border btn-custom-white">Duyệt</a>

                            {{-- Delete --}}
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="col-3"
                                name="deleteForm">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                    class="btn btn-sm fw-bold text-danger w-100 btn-delete btn-custom-f2aa84"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                            </form>

                            {{-- Points --}}
                            <a href="{{ route('customers.points', $customer->id) }}"
                                class="col-4 btn btn-sm fw-bold text-white btn-custom-06c268">Điểm</a>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

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
    </div>
@endsection

{{-- @section('styles')
    <style>
        /* Ẩn icon dropdown arrow */
        /* .dropdown-toggle-no-icon::after {
                                                                                                                        display: none !important;
                                                                                                                    } */

        /* Style cho các tag được chọn */
        .selected-tag {
            display: inline-block;
            background-color: #06c268;
            color: white;
            padding: 3px 8px;
            margin: 2px;
            border-radius: 10px;
            font-size: 12px;
            position: relative;
            align-items: middle;
        }

        .selected-tag .remove-tag {
            margin-left: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .selected-tag .remove-tag:hover {
            color: #ff6b6b;
        }

        /* Style cho dropdown item được chọn */
        .dropdown-item.selected {
            background-color: #e6f9f3 !important;
            color: #06c268 !important;
        }
    </style>
@endsection --}}

@section('scripts')
    <script type="module">
        const pickerStart = new TempusDominus(document.getElementById('datepicker-start'), {
            display: {
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
                    clock: false,
                },
            },
            localization: {
                locale: 'vi',
                format: 'dd/MM/yyyy'
            },
            restrictions: {
                minDate: new Date(1900, 0, 1),
                maxDate: new Date()
            },
            useCurrent: false,
            container: document.getElementById('datepicker-start-container')
        });

        const pickerEnd = new TempusDominus(document.getElementById('datepicker-end'), {
            display: {
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
                    clock: false,
                },
            },
            localization: {
                locale: 'vi',
                format: 'dd/MM/yyyy'
            },
            restrictions: {
                minDate: new Date(1900, 0, 1),
                maxDate: new Date()
            },
            useCurrent: false,
            container: document.getElementById('datepicker-end-container')
        });

        // Xử lý sự kiện click cho các item trong dropdown
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
                                        <span class="remove-tag" data-value="${value}"><i class="bi bi-x"></i></span>
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
@endsection
