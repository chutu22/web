<?php
include "header.php";
include "slider.php";
include "class/product_class.php";


?>
<?php
//---Add
$product = new product; 
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    // var_dump($_POST,$_FILES);
    // echo '<pre>';
    // print_r($_FILES['product_img_desc']['name']);
    // echo '</pre>';
    $insert_product = $product ->insert_product($_POST, $_FILES);
}
?>


<div class="admin-content-right">
<div class="admin-content-right-product_add">
            <h1>Thêm sản phẩm </h1>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                <input name="product_name" required type="text">
                <label for="">Chọn danh mục <span style="color: red;">*</span></label>
                <select name="cartegory_id" id="cartegory_id">
                <option value="#">--Chọn--</option>
                    <?php
                    $show_cartegory = $product -> show_cartegory();
                    if($show_cartegory) {while($result = $show_cartegory -> fetch_assoc()){
                    ?>
                    <option value="<?php echo $result['cartegory_id'] ?>"><?php echo $result['cartegory_name'] ?></option>
                    <?php
                    }}
                    ?>
                </select>
                <label for="">Chọn loại sản phẩm <span style="color: red;">*</span></label>
                <select name="brand_id" id="brand_id">
                    <option value="#">--Chọn--</option>
                    
                </select>
                <label for="">Giá sản phẩm <span style="color: red;">*</span></label>
                <input name="product_price" required type="text">
                <label for="">Giá khuyến mại <span style="color: red;">*</span></label>
                <input name="product_sale" type="text">
                <textarea required name="product_desc" id="editor1" cols="30" rows="10" placeholder="Mô tả sản phẩm"></textarea>
                <label for="">Ảnh sản phẩm <span style="color: red;">*</span></label>
                <input name="product_img" required type="file">
                <label for="">Ảnh mô tả <span style="color: red;">*</span></label>
                <input name="product_img_desc[]" multiple type="file">
                <button>THÊM</button>
            </form>
        </div>
    </div>
</section>

</body>
<script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                
                CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
    filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserWindowWidth : '1000',
    filebrowserWindowHeight : '700'
});

</script>
<script>
    $(document).ready(function(){
        $("#cartegory_id").change(function(){
            // alert($(this).val())
            var x = $(this).val()
            $.get("productadd_ajax.php",{cartegory_id:x},function(data){
                $("#brand_id").html(data)
            })
        })
    })

    
</script>
</html>