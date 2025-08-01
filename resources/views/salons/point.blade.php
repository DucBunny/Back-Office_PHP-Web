@extends('layouts.app')
@section('title', 'Salons Setting Point')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý cửa hàng</span>
        /
        <span class="fw-light">Cài đặt điểm thưởng</span>
    </div>

    @if (session('success'))
        <div id="alert-success"
            class="alert alert-success text-success text-center position-fixed top-0 start-50 translate-middle-x mt-3"
            style="z-index: 9999; min-width: 300px">
            {{ session('success') }}
        </div>
    @endif

    <form class="mt-3" method="POST" action="{{ route('salons.importPoint') }}" enctype="multipart/form-data">
        @csrf

        <div class="px-4 py-3 mt-2 bg-white rounded-3 border border-2">
            <div class="form-group">
                <div class="d-flex align-items-center gap-3">
                    <p class="m-0">取込ファイル</p>
                    <span class="badge rounded-pill fw-medium" style="background-color: #11c48a">必須</span>
                </div>
                <div class="mt-3 ms-4">
                    <label for="point" class="btn btn-sm text-white btn-custom-11c48a" style="min-width: 120px">Chọn
                        file</label>
                    <input type="file" accept=".csv" class="form-control form-control-sm d-none" name="csv_file"
                        id="point" />
                    <div class="small text-body-tertiary mt-2 d-flex align-items-center gap-2" id="file-name">
                        @if (session('csv_file_name'))
                            <i class="fa-solid fa-file"></i> {{ session('csv_file_name') }}
                        @endif
                    </div>

                    @error('csv_file')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-end mt-3">
                {{-- Update --}}
                <button type="submit" class="btn py-2 text-white mb-2 btn-custom-06c268"
                    style="min-width: 100px">Nhập</button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        document.getElementById('point').addEventListener('change', function(e) {
            const errorElement = document.querySelector('.text-danger');
            if (errorElement) {
                errorElement.remove();
            }

            const fileName = e.target.files[0] ? e.target.files[0].name : '';
            document.getElementById('file-name').innerHTML = fileName ?
                `<i class="fa-solid fa-file"></i>${fileName}` :
                '';
        });
    </script>
@endsection
