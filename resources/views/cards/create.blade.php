@extends('layouts.app')
@section('title', 'Customer Card Create')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý khách hàng</span>
        /
        <span class="fw-light">Đăng ký hồ sơ</span>
    </div>

    <form class="mt-3" method="POST" action="{{ route('customers.storeCard', $customer->id) }}">
        @csrf

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Ngày đến cửa hàng</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-md-3 position-relative" id="datepicker-container">
                    <input type="text" class="form-control" name="visit_date" id="datepicker" style="padding-left: 30px"
                        placeholder="DD/MM/YYYY" value="{{ old('visit_date') }}" />
                    <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted"
                        style="pointer-events: none"></i>
                </div>

                @error('visit_date')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Cửa hàng</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-md-2">
                    <select class="form-select form-control" name="salon_id" id="salonSelect">
                        <option value="" selected class="d-none"></option>
                        @foreach ($salons as $salon)
                            <option value="{{ $salon->id }}" {{ old('salon_id') == $salon->id ? 'selected' : '' }}>
                                {{ $salon->name }}</option>
                        @endforeach
                    </select>
                </div>

                @error('salon_id')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Cắt tóc</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_cut" id="radioIsCut[1]" value="1"
                            {{ old('is_cut', '') == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsCut[1]">Có</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_cut" id="radioIsCut[0]" value="0"
                            {{ old('is_cut', '') == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsCut[0]">Không</label>
                    </div>
                </div>

                @error('is_cut')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Uốn tóc</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_perm" id="radioIsPerm[1]" value="1"
                            {{ old('is_perm', '') == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsPerm[1]">Có</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_perm" id="radioIsPerm[0]" value="0"
                            {{ old('is_perm', '') == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsPerm[0]">Không</label>
                    </div>
                    @error('is_perm')
                        <div class="mb-3 text-danger small">{{ $message }}</div>
                    @enderror

                    <textarea class="form-control mt-1" style="height: 90px" name="perm_note" id="permNote">{{ old('perm_note') }}</textarea>
                    @error('perm_note')
                        <div class="mb-3 text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Nhuộm tóc</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_color" id="radioIsColor[1]" value="1"
                            {{ old('is_color', '') == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsColor[1]">Có</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_color" id="radioIsColor[0]"
                            value="0" {{ old('is_color', '') == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsColor[0]">Không</label>
                    </div>
                    @error('is_color')
                        <div class="mb-3 text-danger small">{{ $message }}</div>
                    @enderror

                    <textarea class="form-control mt-1" style="height: 90px" name="color_note" id="colorNote">{{ old('color_note') }}</textarea>
                    @error('color_note')
                        <div class="mb-3 text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Người thực hiện</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3 col-md-2">
                    <input type="text" class="form-control" name="practitioner" id="practitioner"
                        value="{{ old('practitioner') }}">
                </div>

                @error('practitioner')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <p class="form-label">Ghi chú</p>
                <div class="ps-3">
                    <textarea class="form-control" style="height: 80px" name="memo" id="memo">{{ old('memo') }}</textarea>
                </div>

                @error('memo')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex justify-content-center gap-3 p-4">
            {{-- Back --}}
            <a href="{{ route('customers.edit', $customer->id) }}"
                class="btn py-2 text-success btn-outline-success btn-custom-e6f9f3" style="min-width: 100px">Quay
                lại</a>

            {{-- Update --}}
            <button type="submit" class="btn py-2 text-white btn-custom-11c48a" style="min-width: 100px">Lưu</button>
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

        document.querySelectorAll('input[name="is_perm"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const textarea = document.getElementById('permNote');
                if (this.value == '1') {
                    textarea.value = '薬剤1: \n薬剤2: \n薬剤3: ';
                } else {
                    textarea.value = '';
                }
            });
        });

        document.querySelectorAll('input[name="is_color"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const textarea = document.getElementById('colorNote');
                if (this.value == '1') {
                    textarea.value = '薬剤1: \n薬剤2: \n薬剤3: ';
                } else {
                    textarea.value = '';
                }
            });
        });
    </script>
@endsection
