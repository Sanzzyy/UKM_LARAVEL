import "./bootstrap";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.start();

// IMPORT FILE LAIN SETELAH ALPINE
import "./transaction";
import "./dashboard";
