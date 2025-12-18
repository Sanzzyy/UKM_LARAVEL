<script>
    let orderItems = [];
    let totalAmount = 0;

    function toggleCustomerInput() {
        const select = document.getElementById('customer_id');
        const fields = document.getElementById('newCustomerFields');
        fields.style.display = select.value ? 'none' : 'block';
        document.querySelector('[name="customer_name"]').required = !select.value;
    }

    function addItem(menuId, menuName, menuPrice) {
        const existing = orderItems.find(i => i.menuId === menuId);

        if (existing) {
            existing.quantity++;
        } else {
            orderItems.push({
                menuId,
                menuName,
                menuPrice,
                quantity: 1
            });
        }
        updateOrderDisplay();
    }

    function removeItem(menuId) {
        orderItems = orderItems.filter(i => i.menuId !== menuId);
        updateOrderDisplay();
    }

    function updateQuantity(menuId, delta) {
        const item = orderItems.find(i => i.menuId === menuId);
        if (!item) return;

        item.quantity += delta;
        item.quantity <= 0 ? removeItem(menuId) : updateOrderDisplay();
    }

    function updateOrderDisplay() {
        const container = document.getElementById('orderItems');
        totalAmount = 0;

        if (orderItems.length === 0) {
            container.innerHTML = '<p class="text-gray-500 text-center py-4">Belum ada item</p>';
            document.getElementById('submitBtn').disabled = true;
        } else {
            container.innerHTML = orderItems.map(item => {
                totalAmount += item.menuPrice * item.quantity;
                return `
                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                        <div>
                            <p class="font-semibold text-sm">${item.menuName}</p>
                            <p class="text-xs text-gray-600">Rp ${formatNumber(item.menuPrice)} x ${item.quantity}</p>
                            <input type="hidden" name="items[${item.menuId}][menu_id]" value="${item.menuId}">
                            <input type="hidden" name="items[${item.menuId}][quantity]" value="${item.quantity}">
                        </div>
                        <div class="flex items-center space-x-2">
                            <button type="button" onclick="updateQuantity(${item.menuId}, -1)" class="btn-red">-</button>
                            <span>${item.quantity}</span>
                            <button type="button" onclick="updateQuantity(${item.menuId}, 1)" class="btn-green">+</button>
                            <button type="button" onclick="removeItem(${item.menuId})" class="btn-gray">×</button>
                        </div>
                    </div>
                `;
            }).join('');

            document.getElementById('submitBtn').disabled = false;
        }

        document.getElementById('totalAmount').textContent = 'Rp ' + formatNumber(totalAmount);
        calculateChange();
    }

    function calculateChange() {
        const paid = parseFloat(document.getElementById('paidAmount').value) || 0;
        document.getElementById('changeAmount').textContent =
            'Rp ' + formatNumber(Math.max(0, paid - totalAmount));
    }

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    toggleCustomerInput();
</script>
