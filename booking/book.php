<?php

    require "../includes/header.php";
    require "../config/config.php";

    if(!isset($_SESSION['username'])){
        header('Location: ../auth/login.php');
    }

    if(isset($_POST['btn_book_table'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $message = $_POST['message'];
        $user_id = $_SESSION['user_id'];

        if($date > date('m-d-Y')){
            $date = date('Y-m-d', strtotime($date));
            $time = date('H:i:s', strtotime($time));

            $insert = $pdo ->prepare("insert into bookings(first_name, last_name, phone, date, time, user_id, message) values(:first_name, :last_name, :phone, :date, :time, :user_id, :message)");
            $insert->bindParam(':first_name', $first_name);
            $insert->bindParam(':last_name', $last_name);
            $insert->bindParam(':phone', $phone);
            $insert->bindParam(':date', $date);
            $insert->bindParam(':time', $time);
            $insert->bindParam(':message', $message);
            $insert->bindParam(':user_id', $user_id);

            $insert->execute();

            header('Location: ../index.php');
        }else{

            header('Location: ../index.php');
        }


    }
?>