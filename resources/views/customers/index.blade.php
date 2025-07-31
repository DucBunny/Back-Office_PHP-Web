@extends('layouts.app')
@section('title', 'Customer Index')
@include('modals.select_salon', ['salons' => $salons])
@vite(['resources/js/delete_item_selected.js'])

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý khách hàng</span>
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

    {{-- Search Form --}}
    <form class="mt-3" method="GET" action="{{ route('customers.index') }}">
        <div class="p-3 bg-white rounded-4 border border-2">
            <div class="form-group col-md-4 mb-3">
                <label for="customer_id" class="form-label">ID thành viên</label>
                <div class="ps-3">
                    <input type="text" class="form-control" name="customer_id" id="customer_id"
                        value="{{ request('customer_id') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Giới tính</p>
                <div class="ps-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gender[]" id="male" value="1"
                            {{ in_array(1, request('gender', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="male">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gender[]" id="female" value="2"
                            {{ in_array(2, request('gender', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="female">Nữ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gender[]" id="other" value="3"
                            {{ in_array(3, request('gender', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="other">Chưa phản hồi</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Độ tuổi</p>
                <div class="ps-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="age[]" id="age10" value="10"
                            {{ in_array(10, request('age', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="age10">10</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="age[]" id="age20" value="20"
                            {{ in_array(20, request('age', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="age20">20</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="age[]" id="age30" value="30"
                            {{ in_array(30, request('age', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="age30">30</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="age[]" id="age40" value="40"
                            {{ in_array(40, request('age', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="age40">40</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="age[]" id="age50" value="50"
                            {{ in_array(50, request('age', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="age50">50</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="age[]" id="age60" value="60"
                            {{ in_array(60, request('age', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="age60">60</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="age[]" id="age70" value="70"
                            {{ in_array(70, request('age', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="age70">70</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="age[]" id="age80" value="80"
                            {{ in_array(80, request('age', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="age80">80+</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Loại hình sử dụng</p>
                <div class="ps-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="category[]" id="isCut" value="is_cut"
                            {{ in_array('is_cut', request('category', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isCut">Cắt</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="category[]" id="isColor"
                            value="is_color" {{ in_array('is_color', request('category', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isColor">Nhuộm</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="category[]" id="isPerm"
                            value="is_perm" {{ in_array('is_perm', request('category', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isPerm">Uốn</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Số lần đã đến</p>
                <div class="ps-3 d-flex align-items-center gap-2">
                    <div class="col-md-1 ">
                        <input type="number" class="form-control" name="min" id="min" min="0"
                            value="{{ request('min') }}" />
                    </div>
                    <span>&#x2053;</span>
                    <div class="col-md-1">
                        <input type="number" class="form-control" name="max" id="max" min="0"
                            value="{{ request('max') }}" />
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="form-row d-flex align-items-center gap-3">
                    <p class="form-label m-0">Cửa hàng đã đến thăm</p>
                    <div class="col-md-9">
                        <button class="btn text-white col-md-3 btn-custom-06c268" type="button" id="salonModal"
                            data-bs-toggle="modal" data-bs-target="#salonModal">
                            Chọn
                        </button>
                    </div>
                </div>

                <div id="selectedSalons" class="mt-2"></div>
                <input type="hidden" name="salon_ids" id="selectedSalonIds" value="{{ request('salon_ids') }}">
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Thời gian đã đến</p>
                <div class="ps-3 d-flex align-items-center gap-2">
                    <div class="col-md-3 position-relative" id="datepicker-start-container">
                        <input type="text" class="form-control" name="visit_start" id="datepicker-start"
                            style="padding-left: 30px" placeholder="DD/MM/YYYY" value="{{ request('visit_start') }}" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted"
                            style="pointer-events: none"></i>
                    </div>
                    <span>&#x2053;</span>
                    <div class="col-md-3 position-relative" id="datepicker-end-container">
                        <input type="text" class="form-control" name="visit_end" id="datepicker-end"
                            style="padding-left: 30px" placeholder="DD/MM/YYYY" value="{{ request('visit_end') }}" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted"
                            style="pointer-events: none"></i>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div
                class="form-row mb-2 d-flex  gap-3 {{ Auth::user()->id == 1 ? 'justify-content-end' : 'justify-content-center' }}">
                {{-- Search --}}
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm
                    kiếm</button>

                @if (Auth::user()->id == 1)
                    <a href="{{ route('customers.exportCustomerCsv', request()->query()) }}"
                        class="btn text-white btn-custom-11c48a">Tải
                        CSV</a>

                    <a href="{{ route('customers.exportPointHistoryCsv', request()->query()) }}"
                        class="btn text-white btn-custom-06c268">Tải lịch sử điểm</a>
                @endif

                {{-- Reset --}}
                <a href="{{ route('customers.index') }}"
                    class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa
                    điều kiện</a>

                @if (Auth::user()->id == 1)
                    <button type="button" class="btn text-white btn-custom-06c268" style="margin-left: 10rem">Xuất
                        phân đoạn</button>
                @endif
            </div>
        </div>
    </form>

    @if ($customers->isEmpty())
        <div class="mt-4">
            <p class="text-center text-muted">Không có khách hàng nào phù hợp với điều kiện tìm kiếm.</p>
        </div>
    @else
        <div class="mt-4">
            {{-- Results Table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="fw-medium col-2">ID thành viên</th>
                        <th scope="col" class="fw-medium col-3">Cửa hàng đã thăm gần nhất</th>
                        <th scope="col" class="fw-medium col-3">Ngày tới gần nhất</th>
                        <th scope="col" class="fw-medium col-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td scope="row" class="align-middle">
                                {{ $customer->id }}
                            </td>
                            <td class="align-middle">
                                {{ $customer->last_salon_name ? $customer->last_salon_name : '' }}
                            </td>
                            <td class="align-middle">
                                {{ $customer->last_visit_date ? $customer->last_visit_date->format('d/m/Y') : '' }}
                            </td>
                            <td class="d-flex justify-content-end gap-2">
                                {{-- Edit --}}
                                <a href="{{ route('customers.edit', $customer->id) }}"
                                    class="col-3 btn btn-sm fw-bold border btn-custom-white">Duyệt</a>

                                {{-- Delete --}}
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                    class="col-3" name="deleteForm">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        class="btn btn-sm fw-bold text-danger w-100 btn-delete-confirm btn-custom-f2aa84"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                                </form>

                                {{-- Points --}}
                                <a href="{{ route('customers.points', $customer->id) }}"
                                    class="col-4 btn btn-sm fw-bold text-white btn-custom-06c268">Điểm</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center my-3 gap-2">
                <ul class="pagination">
                    <li class="page-item @if ($customers->onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $customers->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="text-muted">&lsaquo;</span>
                        </a>
                    </li>
                    @for ($p = 1; $p <= $customers->lastPage(); $p++)
                        <li class="page-item @if ($p == $customers->currentPage()) active @endif">
                            <a class="page-link text-muted" href="{{ $customers->url($p) }}">{{ $p }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if (!$customers->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{ $customers->nextPageUrl() }}" aria-label="Next">
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
    </script>
@endsection
