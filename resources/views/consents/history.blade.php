@extends('layouts.app')
@section('title', 'Consents History')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý thỏa thuận</span>
        /
        <span class="fw-light">Lịch sử</span>
    </div>

    <form class="mt-2" method="GET" action="{{ route('consents.history') }}">
        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3">
                <p class="form-label">Thời gian</p>
                <div class="ps-3 d-flex align-items-center gap-2">
                    <div class="col-md-3 position-relative">
                        <input type="text" class="form-control" name="date_start" id="datetimepicker-start"
                            style="padding-left: 30px" placeholder="DD/MM/YYYY HH:mm" value="{{ request('date_start') }}" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted"
                            style="pointer-events: none"></i>
                    </div>
                    <span>&#x2053;</span>
                    <div class="col-md-3 position-relative">
                        <input type="text" class="form-control" name="date_end" id="datetimepicker-end"
                            style="padding-left: 30px" placeholder="DD/MM/YYYY HH:mm" value="{{ request('date_end') }}" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted"
                            style="pointer-events: none"></i>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="title">Thỏa thuận đồng ý</label>
                <div class="ps-3 col-md-2">
                    <select class="form-select form-control" name="title" id="title">
                        <option value="" selected class="d-none"></option>
                        @foreach ($consents as $consent)
                            <option value="{{ $consent->title }}"
                                {{ request('title') == $consent->title ? 'selected' : '' }}>
                                {{ $consent->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-3 col-md-3">
                <label class="form-label" for="customerID">ID thành viên</label>
                <div class="ps-3">
                    <input type="text" class="form-control" name="customer_id" id="customerID"
                        value="{{ request('customer_id') }}">
                </div>
            </div>

            <div class="form-row mb-2 d-flex justify-content-center gap-3">
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm
                    kiếm</button>
                <button type="button" class="btn text-white btn-custom-06c268">Tải
                    CSV</button>
                <a href="{{ route('consents.history') }}" class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa
                    điều kiện</a>
            </div>
        </div>
    </form>

    @if ($histories->isEmpty())
        <div class="mt-4">
            <p class="text-center text-muted">Không có thỏa thuận nào phù hợp với điều kiện tìm kiếm.</p>
        </div>
    @else
        <div class="mt-5">
            {{-- Results Table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="fw-medium col-4">Thời gian</th>
                        <th scope="col" class="fw-medium col-5">Thỏa thuận đồng ý</th>
                        <th scope="col" class="fw-medium col-3">ID thành viên</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <td scope="row" class="align-middle">
                                {{ $history->agreed_at ? \Carbon\Carbon::parse($history->agreed_at)->format('d/m/Y H:i') : '' }}
                            </td>
                            <td class="align-middle">
                                {{ $history->title }}
                            </td>
                            <td class="align-middle">
                                {{ $history->customer_id }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center my-3 gap-2">
                <ul class="pagination">
                    <li class="page-item @if ($histories->onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $histories->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="text-muted">&lsaquo;</span>
                        </a>
                    </li>
                    @for ($p = 1; $p <= $histories->lastPage(); $p++)
                        <li class="page-item @if ($p == $histories->currentPage()) active @endif">
                            <a class="page-link text-muted" href="{{ $histories->url($p) }}">{{ $p }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if (!$histories->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{ $histories->nextPageUrl() }}" aria-label="Next">
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
        const pickerStart = new TempusDominus(document.getElementById('datetimepicker-start'), {
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
            },
            localization: {
                locale: 'vi',
                format: 'dd/MM/yyyy HH:mm'
            },
            restrictions: {
                minDate: new Date(1900, 0, 1),
                maxDate: new Date()
            },
            useCurrent: false
        });

        const pickerEnd = new TempusDominus(document.getElementById('datetimepicker-end'), {
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
            },
            localization: {
                locale: 'vi',
                format: 'dd/MM/yyyy HH:mm'
            },
            restrictions: {
                minDate: new Date(1900, 0, 1),
                maxDate: new Date()
            },
            useCurrent: false
        });
    </script>
@endsection
