<?php

require("../config/config.php");

if(!isset($_SERVER['HTTP_REFERER'])){
    http_response_code(403);
    exit();
}


if($_GET['id']){

    $delete = $pdo->prepare("DELETE FROM products WHERE product_id=:id");
    if($delete->execute(['id'=>$_GET['id']])){
        header('Location: show-products.php');
        exit();
    }else{
        echo "<script>alert('Product delete failed');</script>";
    }



}else{
    header("location: show-products.php");
}


?>