<?php
// Kết nối tới cơ sở dữ liệu
// Sửa các thông tin dưới đây cho phù hợp với cấu hình của bạn
// $servername = "localhost"; // Địa chỉ máy chủ MySQL, thông thường là 'localhost'
// $username = "root"; // Tên đăng nhập MySQL, mặc định của XAMPP là 'root'
// $password = ""; // Mật khẩu MySQL, mặc định của XAMPP là rỗng
// $database = "mydatabase"; // Tên cơ sở dữ liệu bạn đã tạo
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "website_bh");

// Tạo kết nối
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Thông báo lỗi nếu kết nối thất bại
}

// Truy vấn dữ liệu từ bảng
// Sửa câu truy vấn dưới đây để phù hợp với bảng và cột trong cơ sở dữ liệu của bạn
$sql = "SELECT * FROM tbl_cartegory";
$result = $conn->query($sql);

$sqlb = "SELECT * FROM tbl_brand";
$resultb = $conn->query($sqlb);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Bán Hàng</title>
    <link rel="stylesheet" href="style-cartegory.css">
    <link rel="stylesheet" href="assets/fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <a href="" class="logo">
                <img src="assets/logo.png" alt="">
            </a>
            <div id="menu">
                <div class="item">
                    <a href="index.html">Trang chủ</a>
                </div>
                <div class="item">
                    <a href="cartegory.php">Sản phẩm</a>
                </div>
                <div class="item">
                    <a href="cart.php">Giỏ hàng</a>
                </div>
                <div class="item">
                    <a href="delivery.html">Liên hệ</a>
                </div>
                <div class="item">
                    <a href="payment.html">Thanh toán</a>
                </div>
            </div>
            <div id="actions">
                <div class="item">
                    <input type="text" placeholder="Tìm kiếm">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="item">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="item">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
        </div>
    </div>
    <!---------------------- Cartegory ----------->
    <section class="cartegory">
        <div class="container">
            <div class="cartegory-top row">
                <p>TRANG CHỦ</p> <span>&#10230;</span>
                <p>SẢN PHẨM</p>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="cartegory-left">
                    <ul>
                        <?php
                        // Danh mục
                        $sql = "SELECT cartegory_id, cartegory_name FROM tbl_cartegory";
                        $resultA = $conn->query($sql);

                        if ($resultA->num_rows > 0) {
                            while ($rowA = $resultA->fetch_assoc()) {
                                echo '<li class="cartegory-left-li"><a href="#">' . $rowA["cartegory_name"] . '</a>';

                                // Lấy dữ liệu cho brand
                                $cartegory_id = $rowA["cartegory_id"];
                                $sqlb = "SELECT brand_id, brand_name FROM tbl_brand WHERE cartegory_id = $cartegory_id";
                                $resultB = $conn->query($sqlb);

                                if ($resultB->num_rows > 0) {
                                    echo '<ul class="brand">';
                                    while ($rowB = $resultB->fetch_assoc()) {
                                        echo '<li class="brand-item" data-brand-id="' . $rowB["brand_id"] . '"><a href="#">' . $rowB["brand_name"] . '</a></li>';
                                    }
                                    echo '</ul>';
                                } else {
                                    echo '<ul class="brand"><li>No brands found</li></ul>';
                                }
                                echo '</li>';
                            }
                        } else {
                            echo "<li class='cartegory-left-li'>No categories found</li>";
                        }
                        ?>
                    </ul>
                </div>

                <div class="cartegory-right row">
                    <div class="cartegory-right-top-item">
                        <p>SẢN PHẨM</p>
                    </div>
                    <div class="cartegory-right-top-item">
                        <button><span>Bộ lọc</span><i class="fa-solid fa-sort-down"></i></button>
                    </div>
                    <div class="cartegory-right-top-item">
                        <select name="" id="sortSelect">
                            <option value="">Sắp xếp</option>
                            <option value="desc">Giá cao đến thấp</option>
                            <option value="asc">Giá thấp đến cao</option>
                        </select>
                    </div>
                    <div class="cartegory-right-content row" id="productContainer">
                        <?php
                        //Lấy dữ liệu từ bảng tbl_product
                        $sql = "SELECT product_img, product_name, product_sale, brand_id FROM tbl_product";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // while ($row = $result->fetch_assoc()) {
                            //     echo '<div class="cartegory-right-content-item" data-brand-id="' . $row["brand_id"] . '">';
                            //     // Hiển thị hình ảnh sản phẩm
                            //     // echo '<div class="product-img" style="background-image: url(\'admin/uploads/' . htmlspecialchars($row["product_img"], ENT_QUOTES, 'UTF-8') . '\');"></div>';
                            //     echo '<img class="product-img" style="background-image: url(admin/uploads/' . $row["product_img"] . ');">';
                            //     // Hiển thị tên sản phẩm
                            //     echo '<h1 onclick="redirectToProduct()">' . $row["product_name"] . '</h1>';
                            //     // Hiển thị giá sản phẩm
                            //     echo '<p>' . number_format($row["product_sale"], 0, ',', '.') . '<sup>đ</sup></p>';
                            //     echo' <ion-icon name="remove-circle-outline"></ion-icon>';
                            //     echo' <ion-icon name="add-circle-outline"></ion-icon> ';
                            //     echo '</div>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="cartegory-right-content-item" data-brand-id="' . $row["brand_id"] . '">';
                                echo '<img class="product-img" src="admin/uploads/' . htmlspecialchars($row["product_img"], ENT_QUOTES, 'UTF-8') . '">';
                                echo '<h1>' . htmlspecialchars($row["product_name"], ENT_QUOTES, 'UTF-8') . '</h1>';
                                echo '<p>' . number_format($row["product_sale"], 0, ',', '.') . '<sup>đ</sup></p>';
                                echo '<button class="button-add" onclick="addToCart(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ')">Thêm vào giỏ hàng</button>';
                                echo '</div>';
                            }
                        } else {
                            echo "<p>No products found</p>";
                        }

                        // Đóng kết nối
                        $conn->close();
                        ?>
                        <div class="cartegory-right-content-item">

                            <img src="assets/img_1.png" alt="ĐỒ ĂN">
                            <h1 onclick="redirectToProduct()">Cơm trộn chay</h1>
                            <p>100.000<sup>đ</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <img src="assets/img_1.png" alt="ĐỒ ĂN">
                            <h1>Cơm trộn chay</h1>
                            <p>100.000<sup>đ</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <img src="assets/img_1.png" alt="ĐỒ ĂN">
                            <h1>Cơm trộn chay</h1>
                            <p>100.000<sup>đ</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <img src="assets/img_1.png" alt="ĐỒ ĂN">
                            <h1>Cơm trộn chay</h1>
                            <p>100.000<sup>đ</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <img src="assets/banner.png" alt="ĐỒ ĂN">
                            <h1>Combo 3 món Âu</h1>
                            <p>400.000<sup>đ</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <img src="assets/banner.png" alt="ĐỒ ĂN">
                            <h1>Combo 3 món Âu</h1>
                            <p>400.000<sup>đ</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <img src="assets/banner.png" alt="ĐỒ ĂN">
                            <h1>Combo 3 món Âu</h1>
                            <p>400.000<sup>đ</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <img src="assets/banner.png" alt="ĐỒ ĂN">
                            <h1>Combo 3 món Âu</h1>
                            <p>400.000<sup>đ</sup></p>
                        </div>
                    </div>

                    <div class="cartegory-right-bottom row">
                        <div class="cartegory-right-bottom-item">
                            <p>Hiển thị 2 <span>|4 sản phẩm</span></p>
                        </div>
                        <div class="cartegory-right-bottom-item">
                            <p><span>&#171;</span>1 2 3 4 5<span>&#187;</span>Trang cuối</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function redirectToProduct() {
            window.location.href = 'product.html';
        }
    </script>

    <!---------------------- Footer -------------->
    <div id="footer">
        <div class="box">
            <div class="logo">
                <img src="assets/logo.png" alt="">
            </div>
            <p>Cung cấp sản phẩm với chất lượng an toàn cho quý khách</p>
        </div>
        <div class="box">
            <h3>NỘI DUNG</h3>
            <ul class="quick-menu">
                <div class="item">
                    <a href="">Trang chủ</a>
                </div>
                <div class="item">
                    <a href="">Sản phẩm</a>
                </div>
                <div class="item">
                    <a href="">Blog</a>
                </div>
                <div class="item">
                    <a href="">Liên hệ</a>
                </div>
            </ul>
        </div>
        <div class="box">
            <h3>LIÊN HỆ</h3>
            <form action="">
                <input type="text" placeholder="Địa chỉ email">
                <button>Nhận tin</button>
            </form>
        </div>
    </div>
    </div>
    <script src="script-cart.js"></script>

</body>

</html>

<?php
// if ($result->num_rows > 0) {
//     // Hiển thị dữ liệu ra giao diện
//     echo "<table border='1'>"; 
//     echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
//     while($row = $result->fetch_assoc()) {
//         echo "<tr>";
//         echo "<td>" . $row["brand_id"] . "</td>";
//         echo "<td>" . $row["cartegory_id"] . "</td>";
//         echo "<td>" . $row["brand_name"] . "</td>";
//         echo "</tr>";
//     }
//     echo "</table>";
// } else {
//     echo "0 results"; // Thông báo nếu không có kết quả
// }
?>
<!-- <li class="cartegory-left-li"><a href="#">MÓN CHÍNH</a>
                            <ul class="brand">
                                <li><a href="">BEST SELLER</a></li>
                                <li><a href="">MÓN VIỆT</a></li>
                                <li><a href="">MÓN ÂU</a></li>
                                <li><a href="">RAU</a></li>
                            </ul>
                        </li>
                        <li class="cartegory-left-li"><a href="#">SET</a>
                            <ul class="brand">
                                <li><a href="">BEST SELLER</a></li>
                                <li><a href="">MÓN VIỆT</a></li>
                                <li><a href="">MÓN ÂU</a></li>
                            </ul>
                        </li>
                        <li class="cartegory-left-li"><a href="#">TRÁNG MIỆNG</a>
                            <ul class="brand">
                                <li><a href="">BEST SELLER</a></li>
                                <li><a href="">MÓN VIỆT</a></li>
                                <li><a href="">MÓN ÂU</a></li>
                            </ul>
                        </li>
                        <li class="cartegory-left-li"><a href="#">ĐỒ UỐNG</a>
                            <ul class="brand">
                                <li><a href="">BEST SELLER</a></li>
                                <li><a href="">NƯỚC NGỌT</a></li>
                                <li><a href="">BIA</a></li>
                                <li><a href="">NƯỚC ÉP</a></li>
                            </ul>
                        </li> -->