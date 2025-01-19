<?php
include "header.php";
include "slider.php";

// Kiểm tra dữ liệu POST
if (isset($_POST['cartData'])) {
    $cartData = json_decode($_POST['cartData'], true); // Chuyển JSON sang mảng PHP
} else {
    $cartData = [];
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list">
        <h1>Danh sách sản phẩm đã xác nhận</h1>
        <?php if (!empty($cartData)): ?>
            <table>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá sản phẩm</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                $i = 0;
                $total = 0;
                foreach ($cartData as $item):
                    // Kiểm tra từng khóa trước khi hiển thị(Bỏ qua sản phẩm nếu thiếu gtri)
                if (!isset($item['product_name']) || !isset($item['product_sale']) || !isset($item['quantity'])) {
                    continue; 
                }
                    $i++;
                    $productTotal = $item['product_sale'] * $item['quantity'];

                    $total += $productTotal;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item['product_sale'], 0, ',', '.'); ?><sup>đ</sup></td>
                        <td><?php echo number_format($productTotal, 0, ',', '.'); ?><sup>đ</sup></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" style="text-align: center; font-weight: bold;">TỔNG CỘNG</td>
                    <td style="font-weight: bold"><?php echo number_format($total, 0, ',', '.'); ?><sup>đ</sup></td>
                </tr>
            </table>
            <button>Xuất đơn</button>
        <?php else: ?>
            <p>Không có sản phẩm nào được xác nhận</p>
        <?php endif; ?>
    </div>
</div>
