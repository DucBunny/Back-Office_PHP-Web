@extends('layouts.app')
@section('title', 'Customer Card Create')
{{--  --}}

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý khách hàng</span>
        /
        <span class="fw-light">Đăng ký hồ sơ</span>
    </div>

    <form class="mt-3" method="POST" action="">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Ngày đến cửa hàng</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="px-0 col-md-3 position-relative" id="datepicker-container">
                    <input type="text" class="form-control" id="datepicker" style="padding-left: 30px"
                        placeholder="DD/MM/YYYY" />
                    <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted z-3"
                        style="pointer-events: none"></i>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Cửa hàng</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-2 cursor-pointer">
                    <select class="form-select form-control" id="salonSelect">
                        <option value="" selected class="d-none"></option>
                        @foreach ($salons as $salon)
                            <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Cắt tóc</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isCut" id="radioIsCut1" value="true">
                        <label class="form-check-label" for="radioIsCut1">Có</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isCut" id="radioIsCut2" value="false">
                        <label class="form-check-label" for="radioIsCut2">Không</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Uốn tóc</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isPerm" id="radioIsPerm1" value="true">
                        <label class="form-check-label" for="radioIsPerm1">Có</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isPerm" id="radioIsPerm2" value="false">
                        <label class="form-check-label" for="radioIsPerm2">Không</label>
                    </div>
                </div>
                <textarea class="form-control mt-1" style="height: 80px; resize: none" id="permNote"></textarea>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Nhuộm tóc</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isColor" id="radioIsColor1" value="true">
                        <label class="form-check-label" for="radioIsColor1">Có</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isColor" id="radioIsColor2" value="false">
                        <label class="form-check-label" for="radioIsColor2">Không</label>
                    </div>
                </div>
                <textarea class="form-control mt-1" style="height: 80px; resize: none" id="colorNote"></textarea>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Người thực hiện</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="col-md-2 cursor-pointer">
                    <input type="text" class="form-control" id="practitioner">
                </div>
            </div>

            <div class="form-group">
                <p class="form-label">Ghi chú</p>
                <textarea class="form-control" style="height: 80px; resize: none" id="memo"></textarea>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 p-4">
            {{-- Back --}}
            <a href="{{ route('customers.edit', $customer->id) }}"
                class="btn col-1 py-2 text-success btn-outline-success btn-custom-e6f9f3">Quay
                lại</a>

            {{-- Update --}}
            <button class="btn col-1 py-2 text-white btn-custom-11c48a" type="submit">Lưu</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script type="module">
        const picker = new TempusDominus(document.getElementById('datepicker'), {
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
            container: document.getElementById('datepicker-container')
        });
    </script>
@endsection
