// Success alert
document.addEventListener("DOMContentLoaded", function () {
    const alert = document.getElementById("alert-success");
    if (alert) {
        setTimeout(() => {
            alert.classList.add("fade");
            setTimeout(() => {
                alert.style.display = "none";
            }, 150);
        }, 3000);
    }
});
