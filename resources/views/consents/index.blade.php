@extends('layouts.app')
@section('title', 'Consents Index')

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý thỏa thuận</span>
        /
        <span class="fw-light">Danh sách</span>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('consents.history') }}" class="btn text-white btn-custom-06c268">Lịch sử đồng ý</a>
        <a href="{{ route('consents.create') }}" class="btn text-white btn-custom-06c268">Đăng ký mới</a>
    </div>

    @if (session('success'))
        <div id="alert-success"
            class="alert alert-success text-success text-center position-fixed top-0 start-50 translate-middle-x mt-3"
            style="z-index: 9999; min-width: 300px">
            {{ session('success') }}
        </div>
    @endif

    <form class="mt-2" method="GET" action="{{ route('consents.index') }}">
        <div class="p-4 bg-white rounded-3 border border-2">
            <div class="form-group mb-3">
                <label class="form-label" for="title">Tiêu đề</label>
                <div class="ps-3 col-md-4">
                    <input type="text" class="form-control" name="title" id="title"
                        value="{{ request('title') }}" />
                </div>
            </div>

            <div class="form-row d-flex justify-content-center gap-2">
                <button type="submit" class="btn text-white btn-custom-11c48a">Tìm kiếm</button>
                <a href="{{ route('consents.index') }}" class="btn text-success btn-outline-success btn-custom-e6f9f3">Xóa
                    điều kiện</a>
            </div>
        </div>
    </form>

    @if ($consents->isEmpty())
        <div class="mt-4">
            <p class="text-center text-muted">Không có thỏa thuận nào phù hợp với điều kiện tìm kiếm.</p>
        </div>
    @else
        <div class="mt-4">
            {{-- Results Table --}}
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="fw-medium col-4" style="min-width: 150px">Tiêu đề</th>
                            <th scope="col" class="fw-medium col-3" style="min-width: 105px">Trạng thái</th>
                            <th scope="col" class="fw-medium col-3" style="min-width: 120px">Ngày đăng ký</th>
                            <th scope="col" class="fw-medium col-2" style="min-width: 100px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consents as $consent)
                            <tr>
                                <td scope="row" class="align-middle">
                                    {{ $consent->title }}
                                </td>
                                <td class="align-middle">
                                    <button type="button"
                                        class="w-50 btn btn-sm fw-bold text-white {{ $consent->status ? 'btn-custom-06c268' : 'btn-custom-6c757d' }}"
                                        style="min-width: 90px" data-bs-toggle="modal" data-bs-target="#changeStatusModal"
                                        data-consent-id="{{ $consent->id }}" data-status="{{ $consent->status }}">
                                        {{ $consent->status ? 'Công khai' : 'Riêng tư' }}
                                    </button>
                                </td>
                                <td class="align-middle">
                                    {{ $consent->date->format('d/m/Y') }}
                                </td>
                                <td class="text-end align-middle">
                                    {{-- Show --}}
                                    <a href="{{ route('consents.show', $consent->id) }}"
                                        class="col-4 btn btn-sm fw-bold border btn-custom-white"
                                        style="min-width: 80px">Xem</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center my-3 gap-2">
                <ul class="pagination flex-wrap justify-content-center">
                    <li class="page-item @if ($consents->onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $consents->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true" class="text-muted">&lsaquo;</span>
                        </a>
                    </li>
                    @for ($p = 1; $p <= $consents->lastPage(); $p++)
                        <li class="page-item @if ($p == $consents->currentPage()) active @endif">
                            <a class="page-link text-muted" href="{{ $consents->url($p) }}">{{ $p }}</a>
                        </li>
                    @endfor
                    <li class="page-item @if (!$consents->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{ $consents->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true" class="text-muted">&rsaquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        let selectedConsentId = null;
        let selectedButton = null;
        const modal = document.getElementById('changeStatusModal');

        modal.addEventListener('show.bs.modal', function(event) {
            const newStatus = event.relatedTarget.getAttribute('data-status') == '1' ? 'riêng tư' : 'công khai';
            selectedButton = event.relatedTarget;
            selectedConsentId = selectedButton.getAttribute('data-consent-id');
            modal.querySelector('#newStatus').textContent = newStatus;
        });

        document.getElementById('confirmChangeStatus').addEventListener('click', function() {
            if (selectedConsentId) {
                fetch("{{ url('consents') }}/" + selectedConsentId + "/toggle-status", {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Cập nhật nút trạng thái
                        selectedButton.textContent = data.label;
                        selectedButton.classList.remove('btn-custom-06c268', 'btn-custom-6c757d');
                        selectedButton.classList.add(data.class);
                        selectedButton.setAttribute('data-status', data.status ? 1 : 0);
                        // Đóng modal
                        bootstrap.Modal.getInstance(modal).hide();
                    });
            }
        });
    </script>
@endsection
