<?php
    session_start();
    require "../config/config.php";

    if(isset($_POST["btn_login"])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $pdo ->prepare("SELECT * FROM tbl_admin WHERE email= :email");
        $login->bindParam(':email', $email);

        $login->execute();
        $fetch = $login -> fetch(PDO::FETCH_ASSOC);

        if($login->rowCount() > 0){

            if(password_verify($password, $fetch['password'])){
                $_SESSION['admin_email'] = $fetch['email'];
                $_SESSION['admin_username'] = $fetch['username'];
                $_SESSION['admin_id'] = $fetch['admin_id'];

                var_dump($_SESSION);

                header("Location: index.php");
                exit();

            }else{
                echo "<script> alert('Your Email or Password is incorrect!');</script>";
            }

        }else{
            echo "<script> alert('Your Email or Password is incorrect!');</script>";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login to your account</h2>
    <form class="space-y-5" method="POST" action="">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="you@example.com"
                required
            />
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="••••••••"
                required
            />
        </div>
        <div class="flex items-center justify-between text-sm">
            <a href="#" class="text-blue-500 hover:underline">Forgot password?</a>
        </div>
        <button
            type="submit"
            name="btn_login"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
        >
            Login
        </button>
    </form>
</div>
</body>
</html>

