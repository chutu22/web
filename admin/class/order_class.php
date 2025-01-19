<?php
include "database.php";
?>

<?php
class product {
    private $db;
    public function __construct()
    {
        $this -> db = new Database();
    }
    public function insert_order($cartegory_name){
        $query = "INSERT INTO tbl_order (cartegory_name) VALUES ('$cartegory_name')";
        $result= $this ->db->insert($query);
        header('Location:order.php');
        // return $result;
    }
    public function show_order(){
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
        $result= $this ->db->select($query);
        return $result;
    }
}