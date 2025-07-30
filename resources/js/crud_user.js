document.addEventListener("DOMContentLoaded", function () {
    const roleSelect = document.getElementById("roleSelect");
    if (roleSelect) {
        // Kích hoạt sự kiện change để set trạng thái đúng khi load trang
        roleSelect.dispatchEvent(new Event("change"));
    }
});

document.getElementById("roleSelect").addEventListener("change", function () {
    const role = this.value;
    window.currentRole = role; // Lưu role để dùng trong modal
    const salonBtn = document.getElementById("salonModalBtn");
    const selectedSalons = document.getElementById("selectedSalons");
    const selectedSalonIds = document.getElementById("selectedSalonIds");
    const salonBadge = document.getElementById("salonBadge");
    const selectAllCheckbox = document.getElementById("selectAll");
    const selectDeviceCode = document.getElementById("deviceCodeSelect");

    // Admin
    if (role == 1) {
        salonBtn.disabled = true;
        salonBadge.classList.add("d-none");
        selectDeviceCode.disabled = true;
        selectedSalons.innerHTML = "";
        selectedSalonIds.value = "";
    } else {
        salonBtn.disabled = false;
        salonBadge.classList.remove("d-none");
        selectDeviceCode.disabled = false;
    }

    if (role == 1 || role == 2) {
        selectDeviceCode.value = "";
        selectDeviceCode.disabled = true;
    } else {
        selectDeviceCode.disabled = false;
    }

    // Ẩn/hiện selectAll theo role
    if (role == 3) {
        selectAllCheckbox.classList.add("d-none");
    } else {
        selectAllCheckbox.classList.remove("d-none");
    }
});

// Xử lý chỉ chọn 1 checkbox khi là Staff (role == 3)
document
    .querySelector("#salonModal tbody")
    .addEventListener("change", function (e) {
        if (
            window.currentRole == 3 &&
            e.target.type === "checkbox" &&
            e.target.checked
        ) {
            // Bỏ checked tất cả checkbox khác
            document
                .querySelectorAll('#salonModal tbody input[type="checkbox"]')
                .forEach((cb) => {
                    if (cb !== e.target) cb.checked = false;
                });
        }
    });
