  // Hàm định dạng tiền tệ (VD: 200000 -> 200,000đ)
    function formatCurrency(number) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(number);
    }

    function updateTotal() {
        let totalMerchandise = 0; // Tổng tiền hàng

        // 1. Duyệt qua tất cả các sản phẩm để tính lại tổng tiền hàng
        const items = document.querySelectorAll('.cart-item');

        items.forEach(item => {
            // Lấy ô nhập số lượng
            const qtyInput = item.querySelector('.item-qty');
            // Lấy giá từ data-price (đã set trong HTML)
            const price = parseFloat(qtyInput.getAttribute('data-price'));
            // Lấy số lượng hiện tại
            const qty = parseInt(qtyInput.value);

            // Tính thành tiền của món đó
            const lineTotal = price * qty;
            totalMerchandise += lineTotal;

            // Cập nhật text hiển thị thành tiền của từng món (cột bên phải)
            item.querySelector('.item-subtotal-display').innerText = formatCurrency(lineTotal);
        });

        // 2. Lấy phí vận chuyển từ Select box
        const shippingSelect = document.getElementById('transport_method');
        // Lấy option đang được chọn
        const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
        // Lấy data-fee, nếu chưa chọn thì mặc định là 0
        const shippingFee = parseFloat(selectedOption.getAttribute('data-fee')) || 0;

        // Cập nhật text hiển thị phí ship
        document.getElementById('shipping-fee-display').innerText = formatCurrency(shippingFee);

        // 3. Tính tổng cuối cùng
        const grandTotal = totalMerchandise + shippingFee;

        // Cập nhật hiển thị tổng tiền
        document.getElementById('grand-total-display').innerText = formatCurrency(grandTotal);

        // Cập nhật giá trị vào input ẩn (nếu backend cần dùng)
        document.getElementById('hidden_total_amount').value = grandTotal;
    }

    // Gọi sự kiện lắng nghe khi người dùng thay đổi số lượng ở bất kỳ ô nào
    document.querySelectorAll('.item-qty').forEach(input => {
        input.addEventListener('change', function() {
            // Đảm bảo số lượng tối thiểu là 1
            if (this.value < 1) {
                this.value = 1;
                alert('Số lượng phải ít nhất là 1');
            }
            updateTotal();
        });
    });

    // Gọi hàm một lần khi trang vừa load để đảm bảo hiển thị đúng (nếu có giá trị mặc định)
    document.addEventListener('DOMContentLoaded', function() {
        // Mặc định chọn option đầu tiên hoặc tính toán lại nếu cần
        updateTotal();
    });
        // Hàm kiểm tra trước khi gửi form
    function validateForm() {
        // 1. Kiểm tra phương thức vận chuyển
        var transport = document.getElementById('transport_method').value;
        if (transport == "") {
            alert("⚠️ Vui lòng chọn phương thức vận chuyển trước khi đặt hàng!");
            return false; // Chặn không cho gửi form
        }
        
        // 2. Kiểm tra chắc chắn (Confirm)
        return confirm('Bạn có chắc chắn muốn đặt đơn hàng này không?');
    }