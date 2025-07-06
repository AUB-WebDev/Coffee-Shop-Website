<?php

require("../config/config.php");

if(!isset($_SERVER['HTTP_REFERER'])){
    http_response_code(403);
    exit();
}


if($_GET['id']){

    $delete = $pdo->prepare("DELETE FROM bookings WHERE book_id=:id");
    if($delete->execute(['id'=>$_GET['id']])){
        header('Location: show-bookings.php');
        exit();
    }else{
        echo "<script>alert('Booking delete failed');</script>";
    }



}else{
    header("location: show-bookings.php");
}


?>