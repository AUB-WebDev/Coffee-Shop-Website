<?php
    require('../config/config.php');

    //TODO: fix this feature, it's not deleting from database
    if(isset($_SESSION['username'])){
        if ($_GET['id']){
            $product_id = $_GET['id'];
            $user_id = $_SESSION['user_id'];
            $delete = $pdo ->prepare( "DELETE FROM cart WHERE product_id = :product_id AND user_id = :user_id");
            $delete -> bindParam(':product_id', $product_id);
            $delete -> bindParam(':user_id', $user_id);

            if ($delete->execute()) {
                header('Location: cart.php');
            }else{
                echo "Error deleting record";
            }
        }
    }else{
        header('Location: ../auth/login.php');
    }