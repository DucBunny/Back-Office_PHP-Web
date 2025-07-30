// JS Libraries
import * as bootstrap from "bootstrap";
// import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "@popperjs/core/dist/umd/popper.min.js";
import "@eonasdan/tempus-dominus/dist/js/tempus-dominus.min.js";
import { TempusDominus } from "@eonasdan/tempus-dominus";

// Custom JS
import "./bootstrap";
import "./alert";
import "./delete_confirm_modal";

window.TempusDominus = TempusDominus;
window.bootstrap = bootstrap;
