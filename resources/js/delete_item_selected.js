// Xử lý nút Xóa salon đã chọn
document
    .getElementById("selectedSalons")
    .addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-delete-item")) {
            e.target.closest(".salon-item").remove();

            // Cập nhật lại giá trị hidden input sau khi xóa
            const items = document.querySelectorAll(
                "#selectedSalons .salon-item"
            );
            const ids = Array.from(items).map((item) =>
                item.getAttribute("data-id")
            );
            document.getElementById("selectedSalonIds").value = ids.join(",");
        }
    });
