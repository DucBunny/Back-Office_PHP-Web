<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select Salon</title>
</head>

<body>
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
                                <div class="cursor-pointer">
                                    <select class="form-select form-control" id="salonType">
                                        <option selected class="d-none"></option>
                                        <option value="1">Cắt</option>
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
                                <tr>
                                    <td scope="row" class="align-middle">
                                        <input type="checkbox" class="form-check-input" value="1"
                                            id="salonCheckbox_1">
                                    </td>
                                    <td scope="row" class="align-middle">
                                        100
                                    </td>
                                    <td class="align-middle">
                                        1000001
                                    </td>
                                    <td class="align-middle">
                                        Cắt tóc
                                    </td>
                                    <td class="align-middle">
                                        AAA
                                    </td>
                                    <td class="align-middle">
                                        e ten
                                    </td>
                                    <td class="align-middle text-truncate">
                                        Lorem ipsum dolor sit amet.
                                    </td>
                                    <td class="align-middle fw-semibold text-success">
                                        Công khai
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn text-success btn-outline-success btn-custom-e6f9f3"
                        data-bs-dismiss="modal">Quay lại</button>
                    <button type="submit" class="btn text-white btn-custom-11c48a">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
