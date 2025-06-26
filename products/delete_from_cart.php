<?php
    require('../config/config.php');
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['username'])){
        if ($_GET['id']){
            $product_id = $_GET['id'];
            $user_id = $_SESSION['user_id'];
            $delete = $pdo ->prepare( "DELETE FROM cart WHERE product_id = :product_id AND user_id = :user_id");
            $delete -> bindParam(':product_id', $product_id);
            $delete -> bindParam(':user_id', $user_id);

            if ($delete->execute()) {
                header('Location: cart.php');
                exit();
            }else{
                echo "Error deleting record";
            }
        }else{ //if the id is invalid
            header('Location: cart.php');
            exit();
        }
    }else{
        header('Location: ../auth/login.php');
        exit();
    }
