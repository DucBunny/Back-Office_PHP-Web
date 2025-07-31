<div class="modal fade" id="salonModal" tabindex="-1" aria-labelledby="salonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #11c48a">
                <h5 class="modal-title text-white" id="salonModalLabel">Chọn cửa hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- Search --}}
                <div class="mb-4 border-bottom pb-4">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="salonCode" class="form-label">Số hiệu cửa hàng</label>
                            <input type="text" class="form-control" id="salonCode">
                        </div>
                        <div class="col-md-4">
                            <label for="salonType" class="form-label">Loại cửa hàng</label>
                            <div>
                                <select class="form-select form-control" id="salonType">
                                    <option selected></option>
                                    <option value="1">Cắt tóc</option>
                                    <option value="2">Tạo kiểu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="salonName" class="form-label">Tên cửa hàng - Furigana</label>
                            <input type="text" class="form-control" id="salonName">
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn text-white btn-custom-11c48a" type="button" id="searchSalonButton">
                            Tìm kiếm
                        </button>
                    </div>
                </div>

                {{-- Salon List --}}
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 3%" class="align-middle">
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                </th>
                                <th scope="col" style="width: 5%">ID</th>
                                <th scope="col" style="width: 10%">Số hiệu</th>
                                <th scope="col" style="width: 10%">Phân loại</th>
                                <th scope="col" style="width: 15%">Tên</th>
                                <th scope="col" style="width: 15%">Furigana</th>
                                <th scope="col" style="width: 30%">Địa chỉ</th>
                                <th scope="col" style="width: 12%">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salons as $salon)
                                <tr>
                                    <td scope="row" class="align-middle">
                                        <input type="checkbox" class="form-check-input" value="{{ $salon->id }}"
                                            id="salonCheckbox_{{ $salon->id }}">
                                    </td>
                                    <td scope="row" class="align-middle">
                                        {{ $salon->id }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $salon->salon_code }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $salon->type == 1 ? 'Cắt tóc' : 'Tạo kiểu' }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $salon->name }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $salon->furigana }}
                                    </td>
                                    <td class="align-middle text-truncate">
                                        {{ $salon->address }}
                                    </td>
                                    <td
                                        class="align-middle fw-semibold {{ $salon->status ? 'text-success' : 'text-danger' }}">
                                        {{ $salon->status ? 'Công khai' : 'Riêng tư' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn text-success btn-outline-success btn-custom-e6f9f3"
                    data-bs-dismiss="modal">Quay lại</button>
                <button type="button" class="btn text-white btn-custom-11c48a" id="saveSelectedSalons">Lưu</button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedSalonTempIds = []; // Mảng tạm để lưu các salon đã chọn

    function updateCheckboxes() {
        const allCheckboxes = document.querySelectorAll('#salonModal tbody input[type="checkbox"]');
        let checkedCount = 0;
        allCheckboxes.forEach(cb => {
            cb.checked = selectedSalonTempIds.includes(cb.value);
            if (cb.checked) checkedCount++;
        });
        document.getElementById('selectAll').checked = allCheckboxes.length === checkedCount && allCheckboxes.length >
            0;
    }

    function renderSelectedSalons(ids) {
        const salonRows = Array.from(document.querySelectorAll('#salonModal tbody tr'));
        const selectedNames = ids.map(id => {
            const row = salonRows.find(tr => {
                const cb = tr.querySelector('input[type="checkbox"]');
                return cb && cb.value === id;
            });
            return row ? row.querySelector('td:nth-child(5)').textContent : '';
        });
        document.getElementById('selectedSalons').innerHTML = selectedNames.map((name, i) =>
            `<div class="salon-item mx-2 my-1 d-inline-flex align-items-center gap-1" data-id="${ids[i]}">
                <span>${name}</span>
                <button type="button" class="btn btn-custom-6c757d btn-sm btn-delete-item px-3 py-0 text-white">Xóa</button>
            </div>`
        ).join('');
    }

    // Checkbox Select All
    document.getElementById('selectAll').addEventListener('change', function() {
        const checked = this.checked;
        const allCheckboxes = document.querySelectorAll('#salonModal tbody input[type="checkbox"]');
        if (checked) {
            // Check tất cả và thêm vào mảng tạm
            allCheckboxes.forEach(cb => {
                cb.checked = true;
                if (!selectedSalonTempIds.includes(cb.value)) {
                    selectedSalonTempIds.push(cb.value);
                }
            });
        } else {
            // Uncheck tất cả và xóa hết mảng tạm
            allCheckboxes.forEach(cb => {
                cb.checked = false;
                selectedSalonTempIds = selectedSalonTempIds.filter(item => item !== cb.value);
            });
        }
    });

    // Check/uncheck checkbox trong modal
    document.querySelector('#salonModal tbody').addEventListener('change', function(e) {
        if (e.target.type === 'checkbox') {
            const id = e.target.value;
            if (e.target.checked) {
                if (!selectedSalonTempIds.includes(id)) selectedSalonTempIds.push(id);
            } else {
                selectedSalonTempIds = selectedSalonTempIds.filter(item => item !== id);
            }
            updateCheckboxes();
        }
    });

    // Search
    document.getElementById('searchSalonButton').addEventListener('click', function() {
        const code = document.getElementById('salonCode').value;
        const type = document.getElementById('salonType').value;
        const name = document.getElementById('salonName').value;

        fetch(`/salons/modal-select?salon_code=${code}&type=${type}&name=${name}`)
            .then(res => res.text())
            .then(html => {
                const tbody = document.querySelector('#salonModal tbody');
                tbody.innerHTML = new DOMParser().parseFromString(html, 'text/html').querySelector('tbody')
                    .innerHTML;
                updateCheckboxes();
            });
    });

    // Lưu các salon đã chọn
    document.querySelector('#saveSelectedSalons').addEventListener('click', function(e) {
        e.preventDefault();
        // Lấy tất cả checkbox đã check
        const checked = Array.from(document.querySelectorAll(
            '#salonModal tbody input[type="checkbox"]:checked'));
        const selectedIds = checked.map(cb => cb.value);
        renderSelectedSalons(selectedIds);

        // Lưu vào hidden input
        document.getElementById('selectedSalonIds').value = selectedIds.join(',');

        // Đóng modal
        bootstrap.Modal.getInstance(document.getElementById('salonModal')).hide();
    });

    // Khi mở lại modal, check các salon đã chọn
    document.getElementById('salonModal').addEventListener('show.bs.modal', function() {
        const selectedIds = document.getElementById('selectedSalonIds').value.split(',').filter(id => id);
        // Cập nhật mảng tạm
        selectedSalonTempIds = [...selectedIds];
        updateCheckboxes();
    });

    // Tự động hiển thị salon đã chọn lên trang cha khi load trang
    document.addEventListener('DOMContentLoaded', function() {
        const selectedIds = document.getElementById('selectedSalonIds').value.split(',').filter(id => id);
        if (selectedIds.length > 0) {
            renderSelectedSalons(selectedIds);
        }
    });
</script>
