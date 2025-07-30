// Xử lý sự kiện click cho nút xóa trong modal
let deleteForm;

document.querySelectorAll(".btn-delete-confirm").forEach((btn) => {
    btn.addEventListener("click", function () {
        deleteForm = this.closest("form");
    });
});

const confirmBtn = document.getElementById("confirmDelete");

if (confirmBtn) {
    confirmBtn.addEventListener("click", function () {
        if (deleteForm) deleteForm.submit();
    });
}
