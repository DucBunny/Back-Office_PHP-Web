@extends('layouts.app')
@section('title', 'Customer Edit')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý khách hàng</span>
        /
        <span class="fw-light">Chỉnh sửa</span>
    </div>

    @if (session('success'))
        <div id="alert-success"
            class="alert alert-success text-success text-center position-fixed top-0 start-50 translate-middle-x mt-3"
            style="z-index: 9999; min-width: 300px">
            {{ session('success') }}
        </div>
    @endif

    <form class="mt-3" method="POST" action="{{ route('customers.update', $customer->id) }}">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <p class="form-label">ID thành viên</p>
                <p class="ps-3">{{ $customer->id }}</p>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <label class="form-label m-0" for="yearPicker">Năm sinh</label>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-md-3" id="yearpicker-container">
                    <input type="text" class="form-control" name="birth_year" id="yearpicker" placeholder="YYYY"
                        value="{{ now()->year - $customer->age }}" readonly>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Giới tính</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="1"
                            @checked($customer->gender == 1)>
                        <label class="form-check-label" for="male">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="2"
                            @checked($customer->gender == 2)>
                        <label class="form-check-label" for="female">Nữ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="other" value="3"
                            @checked($customer->gender == 3)>
                        <label class="form-check-label" for="other">Chưa phản hồi</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="notes" class="form-label">Yêu cầu & lưu ý</label>
                <div class="ps-3">
                    <textarea class="form-control" name="notes" id="notes" style="height: 80px">{{ old('notes', $customer->notes) }}</textarea>
                </div>

                @error('notes')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="form-row d-flex justify-content-center gap-3">
                {{-- Back --}}
                <a href="{{ route('customers.index') }}" class="btn py-2 text-success btn-outline-success btn-custom-e6f9f3"
                    style="min-width: 100px">Quay
                    lại</a>

                {{-- Update --}}
                <button type="submit" class="btn py-2 text-white btn-custom-11c48a" style="min-width: 100px">Lưu</button>
            </div>
        </div>

        {{-- Create Card --}}
        <div class="form-row mt-4 me-3 text-end">
            <a href="{{ route('customers.createCard', $customer->id) }}" style="margin-left: 10rem"
                class="btn text-white btn-custom-06c268">Đăng ký mới</a>
        </div>
    </form>

    @if (!$cards->isEmpty())
        <div class="mt-3">
            {{-- Card Table --}}
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="fw-medium col-2" style="min-width: 100px">Thời gian</th>
                            <th scope="col" class="fw-medium col-5" style="min-width: 100px">Cửa hàng</th>
                            <th scope="col" class="fw-medium col-4" style="min-width: 100px">Nội dung</th>
                            <th scope="col" class="fw-medium col-1" style="min-width: 100px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cards as $card)
                            <tr>
                                <td scope="row" class="align-middle">
                                    {{ $card->visit_date->format('d/m/Y H:i') }}
                                </td>
                                <td class="align-middle">
                                    {{ $card->salon->name }}
                                </td>
                                <td class="align-middle" style="max-width: 200px">
                                    @if ($card->is_cut)
                                        Cắt
                                    @endif
                                    @if ($card->is_color)
                                        Nhuộm
                                    @endif
                                    @if ($card->is_perm)
                                        Uốn
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if (in_array($card->salon_id, Auth::user()->salon_ids))
                                        {{-- Edit --}}
                                        <a href="{{ route('customers.editCard', $card->id) }}"
                                            class="w-100 btn btn-sm fw-bold border btn-custom-white">Duyệt</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center my-3 gap-2">
                <ul class="pagination flex-wrap justify-content-center">
                    <li class="page-item @if ($cards->onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $cards->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="text-muted">&lsaquo;</span>
                        </a>
                    </li>
                    @for ($p = 1; $p <= $cards->lastPage(); $p++)
                        <li class="page-item @if ($p == $cards->currentPage()) active @endif">
                            <a class="page-link text-muted" href="{{ $cards->url($p) }}">{{ $p }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if (!$cards->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{ $cards->nextPageUrl() }}" aria-label="Next">
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
