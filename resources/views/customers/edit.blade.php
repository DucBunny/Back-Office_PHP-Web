@extends('layouts.app')
@section('title', 'Customer Edit')

@section('content')
    <div>Tiêu đề</div>
    <form class="mt-3 ">
        <div class="p-3 bg-white rounded-4 border border-2">
            <div class="form-group col-md-4 mb-3">
                <label for="customer_id">ID thành viên</label>
                <p class="ps-3">XXXXXX</p>
            </div>

            <div class="form-group mb-3">
                <label for="gender">Giới tính</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Nữ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Chưa phản hồi</label>
                    </div>
                </div>
            </div>

            <div class="form-row mb-3">
                <label class="form-label">Năm sinh</label>
                <div class="col-md-2 position-relative">
                    <input type="text" class="form-control form-control-sm text-center" id="yearPicker"
                        style="cursor: pointer" placeholder="Chọn năm sinh" readonly />
                    <i class="bi bi-chevron-down position-absolute top-50 translate-middle-y end-0 me-2 text-muted"
                        style="pointer-events: none"></i>
                </div>

                <div class="year-dropdown" id="yearDropdown" style="display: none;">
                    <div class="year-dropdown-header">
                        <button type="button" class="year-nav-btn" id="yearPrev">&lt;</button>
                        <span class="year-range" id="yearRange"></span>
                        <button type="button" class="year-nav-btn" id="yearNext">&gt;</button>
                    </div>
                    <div class="year-grid" id="yearGrid"></div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="category">Loại hình sử dụng</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Cắt</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Nhuộm</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Uốn</label>
                    </div>
                </div>
            </div>

            <div class="form-row mb-3">
                <label for="times_number">Số lần đã đến</label>
                <div class="d-flex align-items-center gap-2">
                    <div class="col-md-1 ">
                        <input type="number" class="form-control form-control-sm" />
                    </div>
                    <span>~</span>
                    <div class="col-md-1">
                        <input type="number" class="form-control form-control-sm" />
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="form-row d-flex align-items-center gap-3">
                    <label class="m-0">Cửa hàng đã đến thăm</label>
                    <div class="dropdown col-md-9">
                        <button class="btn btn-sm text-white dropdown-toggle-no-icon col-md-3" type="button"
                            id="storeDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                            style="background-color: #06c268; ">
                            Chọn
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="storeDropdown">
                            <li><a class="dropdown-item store-option" href="#" data-value="store1">Cửa hàng A</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store2">Cửa hàng B</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store3">Cửa hàng C</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store4">Cửa hàng D</a>
                            </li>
                            <li><a class="dropdown-item store-option" href="#" data-value="store5">Cửa hàng E</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <p id="selectedStores" class="mt-2 ms-3">
                    <span class="text-muted">Chưa chọn cửa hàng nào</span>
                </p>
            </div>

            <div class="form-row mb-3">
                <label class="form-label">Thời gian đã đến</label>
                <div class="d-flex align-items-center gap-2">
                    <div class="cs-form col-md-4 position-relative">
                        <input type="time" class="form-control form-control-sm text-center" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted"
                            style="pointer-events: none"></i>
                    </div>
                    <span>~</span>
                    <div class="cs-form col-md-4 position-relative">
                        <input type="time" class="form-control form-control-sm text-center" />
                        <i class="bi bi-clock position-absolute top-50 translate-middle-y ms-2 text-muted"
                            style="pointer-events: none"></i>
                    </div>
                </div>
            </div>

            <div class="form-row mb-2 d-flex justify-content-end gap-3">
                <button type="submit" style="background-color: #11c48a" class="btn text-white border border-0">Tìm
                    kiếm</button>
                <button type="submit" style="background-color: #11c48a" class="btn text-white border border-0">Tải
                    CSV</button>
                <button type="submit" style="background-color: #06c268" class="btn text-white border border-0">Tải lịch
                    sử điểm</button>
                <button type="submit" style="background-color: #e6f9f3"
                    class="btn border text-success border-success-subtle">Xóa
                    điều kiện</button>
                <button type="submit" style="background-color: #06c268; margin-left: 10rem"
                    class="btn text-white border border-0">Xuất phân đoạn</button>
            </div>
        </div>
    </form>

    <div class="mt-4 bg-white">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="col-2">ID thành viên</th>
                    <th scope="col" class="col-3">Cửa hàng đã thăm gần nhất</th>
                    <th scope="col" class="col-3">Ngày tới gần nhất</th>
                    <th scope="col" class="col-4"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" class="align-middle">
                        XXXXXX
                    </td>
                    <td class="align-middle">
                        AAA
                    </td>
                    <td class="align-middle">
                        24/05/2025
                    </td>
                    <td class="d-flex justify-content-center gap-2">
                        <button class="col-3 btn btn-sm fw-bold ">Duyệt</button>
                        <button class="col-3 btn btn-sm fw-bold text-danger"
                            style="background-color: #f2aa84">Xóa</button>
                        <button class="col-4 btn btn-sm fw-bold text-white"
                            style="background-color: #06c268">Điểm</button>
                    </td>
                </tr>
                <tr>
                    <td scope="row" class="align-middle">
                        XXXXXX
                    </td>
                    <td class="align-middle">
                        AAA
                    </td>
                    <td class="align-middle">
                        24/05/2025
                    </td>
                    <td class="d-flex justify-content-center gap-2">
                        <button class="col-3 btn btn-sm fw-bold ">Duyệt</button>
                        <button class="col-3 btn btn-sm fw-bold text-danger"
                            style="background-color: #f2aa84">Xóa</button>
                        <button class="col-4 btn btn-sm fw-bold text-white"
                            style="background-color: #06c268">Điểm</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('styles')
    <style>
        /* Ẩn icon dropdown arrow */
        .dropdown-toggle-no-icon::after {
            display: none !important;
        }

        /* Style cho các tag được chọn */
        .selected-tag {
            display: inline-block;
            background-color: #06c268;
            color: white;
            padding: 3px 8px;
            margin: 2px;
            border-radius: 15px;
            font-size: 12px;
            position: relative;
        }

        .selected-tag .remove-tag {
            margin-left: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .selected-tag .remove-tag:hover {
            color: #ff6b6b;
        }

        /* Style cho dropdown item được chọn */
        .dropdown-item.selected {
            background-color: #e6f9f3 !important;
            color: #06c268 !important;
        }

        /* Year Picker */
        .year-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 280px;
            margin-top: 4px;
        }

        .year-dropdown-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
            background-color: #f8f9fa;
            border-radius: 8px 8px 0 0;
        }

        .year-nav-btn {
            background: none;
            border: none;
            font-size: 18px;
            font-weight: bold;
            color: #06c268;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .year-nav-btn:hover {
            background-color: #e6f9f3;
        }

        .year-range {
            font-weight: 600;
            color: #333;
        }

        .year-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 4px;
            padding: 12px;
        }

        .year-item {
            padding: 8px 12px;
            text-align: center;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.2s;
            font-size: 14px;
            border: 1px solid transparent;
        }

        .year-item:hover {
            background-color: #e6f9f3;
            border-color: #06c268;
        }

        .year-item.selected {
            background-color: #06c268;
            color: white;
        }

        .year-item.current-year {
            border-color: #06c268;
            font-weight: 600;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectedStores = new Set();
            const selectedStoresElement = document.getElementById('selectedStores');
            const storeOptions = document.querySelectorAll('.store-option');

            // Xử lý click vào dropdown item
            storeOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();

                    const value = this.dataset.value;
                    const text = this.textContent;

                    if (selectedStores.has(value)) {
                        // Nếu đã chọn thì bỏ chọn
                        selectedStores.delete(value);
                        this.classList.remove('selected');
                    } else {
                        // Nếu chưa chọn thì thêm vào
                        selectedStores.add(value);
                        this.classList.add('selected');
                    }

                    updateSelectedDisplay();
                });
            });

            // Cập nhật hiển thị các item đã chọn
            function updateSelectedDisplay() {
                if (selectedStores.size === 0) {
                    selectedStoresElement.innerHTML = '<span class="text-muted">Chưa chọn cửa hàng nào</span>';
                } else {
                    let html = '';
                    storeOptions.forEach(option => {
                        const value = option.dataset.value;
                        if (selectedStores.has(value)) {
                            const text = option.textContent;
                            html += `<span class="selected-tag">
                                        ${text}
                                        <span class="remove-tag" data-value="${value}">x</span>
                                    </span>`;
                        }
                    });
                    selectedStoresElement.innerHTML = html;

                    // Thêm event listener cho nút xóa
                    const removeTags = selectedStoresElement.querySelectorAll('.remove-tag');
                    removeTags.forEach(tag => {
                        tag.addEventListener('click', function() {
                            const value = this.dataset.value;
                            selectedStores.delete(value);

                            // Bỏ selected class từ dropdown item
                            const option = document.querySelector(`[data-value="${value}"]`);
                            if (option) {
                                option.classList.remove('selected');
                            }

                            updateSelectedDisplay();
                        });
                    });
                }
            }
        });

        // Year Picker Functionality
        class YearPicker {
            constructor() {
                this.currentYear = new Date().getFullYear();
                this.minYear = 1900;
                this.maxYear = this.currentYear;
                this.currentRange = Math.floor(this.currentYear / 20) * 20; // Hiển thị 20 năm mỗi trang

                this.initElements();
                this.bindEvents();
            }

            initElements() {
                this.yearPicker = document.getElementById('yearPicker');
                this.yearDropdown = document.getElementById('yearDropdown');
                this.yearRange = document.getElementById('yearRange');
                this.yearGrid = document.getElementById('yearGrid');
                this.yearPrev = document.getElementById('yearPrev');
                this.yearNext = document.getElementById('yearNext');
            }

            bindEvents() {
                // Click vào input để mở dropdown
                this.yearPicker.addEventListener('click', (e) => {
                    this.showDropdown();
                });

                // Navigation buttons
                this.yearPrev.addEventListener('click', () => {
                    this.currentRange = Math.max(this.minYear, this.currentRange - 20);
                    this.renderYears();
                });

                this.yearNext.addEventListener('click', () => {
                    this.currentRange = Math.min(this.maxYear - 19, this.currentRange + 20);
                    this.renderYears();
                });

                // Click outside để đóng dropdown
                document.addEventListener('click', (e) => {
                    if (!this.yearDropdown.contains(e.target) &&
                        !this.yearPicker.contains(e.target)) {
                        this.hideDropdown();
                    }
                });
            }

            showDropdown() {
                const container = this.yearPicker.closest('.form-row');

                this.yearDropdown.style.display = 'block';

                // Đặt range hiện tại dựa trên giá trị input hoặc năm hiện tại
                const currentValue = this.yearPicker.value;
                if (currentValue) {
                    const year = parseInt(currentValue);
                    this.currentRange = Math.floor(year / 20) * 20;
                } else {
                    this.currentRange = Math.floor(this.currentYear / 20) * 20;
                }

                this.renderYears();

                // Đặt vị trí dropdown
                container.style.position = 'relative';
            }

            hideDropdown() {
                this.yearDropdown.style.display = 'none';
            }

            renderYears() {
                const startYear = this.currentRange;
                const endYear = Math.min(this.currentRange + 19, this.maxYear);

                this.yearRange.textContent = `${startYear} - ${endYear}`;
                this.yearGrid.innerHTML = '';

                for (let year = startYear; year <= endYear; year++) {
                    const yearElement = document.createElement('div');
                    yearElement.className = 'year-item';
                    yearElement.textContent = year;

                    // Highlight năm hiện tại
                    if (year === this.currentYear) {
                        yearElement.classList.add('current-year');
                    }

                    // Highlight năm đã chọn
                    if (this.yearPicker.value == year) {
                        yearElement.classList.add('selected');
                    }

                    yearElement.addEventListener('click', () => {
                        this.selectYear(year);
                    });

                    this.yearGrid.appendChild(yearElement);
                }

                // Update navigation buttons
                this.yearPrev.disabled = this.currentRange <= this.minYear;
                this.yearNext.disabled = this.currentRange + 20 > this.maxYear;
            }

            selectYear(year) {
                this.yearPicker.value = year;
                this.hideDropdown();
            }
        }

        // Khởi tạo Year Picker
        new YearPicker();
    </script>
@endsection
