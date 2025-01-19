<?php
include "header.php";
include "slider.php";
include "class/cartegory_class.php";
?>
<?php
//---Add
$cartegory = new cartegory; 
if($_SERVER['REQUEST_METHOD']== 'POST'){
    $cartegory_name = $_POST['cartegory_name'];
    $insert_cartegory = $cartegory ->insert_cartegory($cartegory_name);
}
?>


<div class="admin-content-right">
        <div class="admin-content-right-cartegory_add">
            <h1>Thêm danh mục</h1>
            <form action="" method="post">
                <input required name="cartegory_name" type="text" placeholder="Nhập tên danh mục">
                <button>THÊM</button>
            </form>
        </div>
    </div>
</section>
<body>
    
</body>
</html>