<?php

require("../config/config.php");

if(!isset($_SERVER['HTTP_REFERER'])){
    http_response_code(403);
    exit();
}


if($_GET['id']){

    $delete = $pdo->prepare("DELETE FROM orders WHERE order_id=:id");
    if($delete->execute(['id'=>$_GET['id']])){
        header('Location: show-orders.php');
        exit();
    }else{
        echo "<script>alert('Order delete failed');</script>";
    }



}else{
    header("location: show-orders.php");
}


?>