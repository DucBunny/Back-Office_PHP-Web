@extends('layouts.app')
@section('title', 'Customer Card Create')
{{--  --}}

@section('content')
    <div class="fs-5">
        <span class="fw-semibold">Quản lý khách hàng</span>
        /
        <span class="fw-light">Đăng ký hồ sơ</span>
    </div>
    {{-- @livewire('cards.create', ['customer' => $customer]) --}}
    <livewire:test-dropdown />
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
