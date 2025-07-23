@extends('layouts.app')
@section('title', 'Consents History')


@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý thỏa thuận</span>
        /
        <span class="fw-light">Lịch sử</span>
    </div>

    <form class="mt-2" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3">
                <p class="form-label">Thời gian</p>
                <div class="d-flex align-items-center gap-2">
                    <div class="px-0 col-md-3 position-relative">
                        <input type="text" class="form-control" id="datetimepicker-start" style="padding-left: 30px"
                            placeholder="DD/MM/YYYY HH:mm" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted z-3"
                            style="pointer-events: none"></i>
                    </div>
                    <span>&#x2053;</span>
                    <div class="px-0 col-md-3 position-relative">
                        <input type="text" class="form-control" id="datetimepicker-end" style="padding-left: 30px"
                            placeholder="DD/MM/YYYY HH:mm" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted z-3"
                            style="pointer-events: none"></i>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="roleSelect">Quyền</label>
                <div class="px-0 col-md-2 cursor-pointer">
                    <select class="form-select form-control" id="roleSelect">
                        <option selected class="d-none"></option>
                        <option value="1">Admin</option>
                        <option value="2">Manager</option>
                        <option value="3">Staff</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3 px-0 col-md-3">
                <label class="form-label" for="userID">ID thành viên</label>
                <input type="text" class="form-control" id="userID">
            </div>

            <div class="form-row mb-2 d-flex justify-content-center gap-3">
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm
                    kiếm</button>
                <button type="submit" class="btn text-white btn-custom-06c268">Tải
                    CSV</button>
                <button type="submit" class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa
                    điều kiện</button>
            </div>
        </div>
    </form>

    <div class="mt-5 bg-white">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="col-4">Thời gian</th>
                    <th scope="col" class="col-4">Thỏa thuận đồng ý</th>
                    <th scope="col" class="col-4">ID thành viên</th>
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
                            2025/07/17 17:25
                        </td>
                        <td class="align-middle">
                            Quản lý sự đồng ý thử nghiệm
                        </td>
                        <td class="align-middle">
                            00000166
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
