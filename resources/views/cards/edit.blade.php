@extends('layouts.app')
@section('title', 'Customer Card Edit')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý khách hàng</span>
        /
        <span class="fw-light">Chỉnh sửa hồ sơ</span>
    </div>

    <form class="mt-3" method="POST" action="{{ route('customers.updateCard', $card->id) }}">
        @csrf
        @method('PUT')

        <div class="p-4 bg-white rounded-4 border border-2">
            <div class="form-group mb-3">
                <p class="form-label">Ngày đến cửa hàng</p>
                <p class="ps-3">{{ $card->visit_date->format('d/m/Y') }}</p>
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Cửa hàng</p>
                <div class="ps-3 col-md-2">
                    <select class="form-select form-control" id="salonSelect" disabled>
                        <option selected>{{ $card->salon->name }}</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Cắt tóc</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_cut" id="radioIsCut[1]" value="1"
                            {{ old('is_cut', $card->is_cut) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsCut[1]">Có</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_cut" id="radioIsCut[0]" value="0"
                            {{ old('is_cut', $card->is_cut) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsCut[0]">Không</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <p class="form-label m-0">Uốn tóc</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="ps-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_perm" id="radioIsPerm[1]" value="1"
                            {{ old('is_perm', $card->is_perm) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsPerm[1]">Có</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_perm" id="radioIsPerm[0]" value="0"
                            {{ old('is_perm', $card->is_perm) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsPerm[0]">Không</label>
                    </div>

                    <textarea class="form-control mt-1" style="height: 80px" name="perm_note" id="permNote">{{ old('perm_note', $card->perm_note) }}</textarea>
                    @error('perm_note')
                        <div class="ps-3 text-danger small">{{ $message }}</div>
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
                            {{ old('is_color', $card->is_color) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsColor[1]">Có</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_color" id="radioIsColor[0]" value="0"
                            {{ old('is_color', $card->is_color) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="radioIsColor[0]">Không</label>
                    </div>

                    <textarea class="form-control mt-1" style="height: 80px" name="color_note" id="colorNote">{{ old('color_note', $card->color_note) }}</textarea>
                    @error('color_note')
                        <div class="ps-3 text-danger small">{{ $message }}</div>
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
                        value="{{ old('practitioner', $card->practitioner) }}">
                </div>

                @error('practitioner')
                    <div class="ps-3 text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <p class="form-label">Ghi chú</p>
                <div class="ps-3">
                    <textarea class="form-control" style="height: 80px" name="memo" id="memo">{{ old('memo', $card->memo) }}</textarea>

                    @error('memo')
                        <div class="ps-3 text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <p class="form-label">Điểm thưởng</p>
                <p class="ps-3">{{ $card->point }} pt</p>
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
    <script>
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
