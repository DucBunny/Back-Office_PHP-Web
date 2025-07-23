// Reset CSS
import "../css/reset.css";

// CSS Libraries
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-icons/font/bootstrap-icons.css";
import "@eonasdan/tempus-dominus/dist/css/tempus-dominus.min.css";
import "@fortawesome/fontawesome-free/css/all.min.css";

// Custom CSS
import "../css/datepicker.css";
import "../css/main.css";

// JS Libraries
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "@popperjs/core/dist/umd/popper.min.js";
import "@eonasdan/tempus-dominus/dist/js/tempus-dominus.min.js";
import { TempusDominus } from "@eonasdan/tempus-dominus";

// Custom JS
import "./bootstrap";
import { DatePicker } from "./datepicker";
import "./delete_confirm_modal";

window.TempusDominus = TempusDominus;

// document.addEventListener("DOMContentLoaded", () => {
//     new DatePicker();
// });
