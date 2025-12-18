// resources/js/transaction.js

let orderItems = [];
let totalAmount = 0;

function toggleCustomerInput() {
    const select = document.getElementById("customer_id");
    const newCustomerFields = document.getElementById("newCustomerFields");
    const nameInput = document.getElementById("customer_name");
    const phoneInput = document.getElementById("customer_phone");

    if (select.value) {
        // pelanggan lama
        newCustomerFields.classList.add("hidden");
        nameInput.value = "";
        phoneInput.value = "";
        nameInput.disabled = true;
        phoneInput.disabled = true;
    } else {
        // pelanggan baru
        newCustomerFields.classList.remove("hidden");
        nameInput.disabled = false;
        phoneInput.disabled = false;
    }
}
document.addEventListener("DOMContentLoaded", toggleCustomerInput);

function addItem(menuId, menuName, menuPrice) {
    const existingItem = orderItems.find((item) => item.menuId === menuId);

    if (existingItem) {
        existingItem.quantity++;
    } else {
        orderItems.push({
            menuId: menuId,
            menuName: menuName,
            menuPrice: menuPrice,
            quantity: 1,
        });
    }

    updateOrderDisplay();
}

function removeItem(menuId) {
    orderItems = orderItems.filter((item) => item.menuId !== menuId);
    updateOrderDisplay();
}

function updateQuantity(menuId, delta) {
    const item = orderItems.find((item) => item.menuId === menuId);
    if (item) {
        item.quantity += delta;
        if (item.quantity <= 0) {
            removeItem(menuId);
        } else {
            updateOrderDisplay();
        }
    }
}

function updateOrderDisplay() {
    const container = document.getElementById("orderItems");
    const submitBtn = document.getElementById("submitBtn");

    if (!container) return;

    if (orderItems.length === 0) {
        container.innerHTML =
            '<p class="text-gray-500 text-center py-4">Belum ada item</p>';
        totalAmount = 0;
        if (submitBtn) submitBtn.disabled = true;
    } else {
        let html = "";
        totalAmount = 0;

        orderItems.forEach((item) => {
            const subtotal = item.menuPrice * item.quantity;
            totalAmount += Number(subtotal);

            html += `
<div class="bg-white border border-gray-200 rounded-lg p-3 shadow-sm
            hover:shadow-md transition">

    <!-- Nama & tombol hapus -->
    <div class="flex justify-between items-start mb-2">
        <div>
            <p class="font-semibold text-gray-800 text-sm">
                ${item.menuName}
            </p>
            <p class="text-xs text-gray-500">
                Rp ${formatNumber(item.menuPrice)} / item
            </p>
        </div>

        <button type="button"
            onclick="removeItem(${item.menuId})"
            class="w-7 h-7 flex items-center justify-center
                   rounded bg-gray-100 text-gray-500
                   hover:bg-red-500 hover:text-white transition">
            ×
        </button>
    </div>

    <!-- Quantity & subtotal -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <button type="button"
                onclick="updateQuantity(${item.menuId}, -1)"
                class="w-7 h-7 rounded
                       bg-red-100 text-red-600
                       hover:bg-red-500 hover:text-white transition">
                −
            </button>

            <span class="min-w-[24px] text-center font-semibold">
                ${item.quantity}
            </span>

            <button type="button"
                onclick="updateQuantity(${item.menuId}, 1)"
                class="w-7 h-7 rounded
                       bg-green-100 text-green-600
                       hover:bg-green-500 hover:text-white transition">
                +
            </button>
        </div>

        <div class="font-bold text-green-600 text-sm">
            Rp ${formatNumber(item.menuPrice * item.quantity)}
        </div>
    </div>

    <!-- hidden inputs -->
    <input type="hidden" name="items[${item.menuId}][menu_id]" value="${
                item.menuId
            }">
    <input type="hidden" name="items[${item.menuId}][quantity]" value="${
                item.quantity
            }">
</div>
`;
        });

        container.innerHTML = html;
        if (submitBtn) submitBtn.disabled = false;
    }

    const totalElement = document.getElementById("totalAmount");
    if (totalElement) {
        totalElement.textContent = "Rp " + formatNumber(totalAmount);
    }

    calculateChange();
}

function calculateChange() {
    const paidInput = document.getElementById("paidAmount");
    const changeElement = document.getElementById("changeAmount");

    if (!paidInput || !changeElement) return;

    const paidAmount = Number(paidInput.value) || 0;
    const change = paidAmount - totalAmount;
    changeElement.textContent = "Rp " + formatNumber(Math.max(0, change));
}

function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    toggleCustomerInput();

    const paidInput = document.getElementById("paidAmount");
    if (paidInput) {
        paidInput.addEventListener("input", calculateChange);
    }
});

// Make functions globally available
window.addItem = addItem;
window.removeItem = removeItem;
window.updateQuantity = updateQuantity;
window.toggleCustomerInput = toggleCustomerInput;
window.calculateChange = calculateChange;
