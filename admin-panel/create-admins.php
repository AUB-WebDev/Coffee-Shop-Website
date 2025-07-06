<?php
require('layouts/header.php');
require('../config/config.php');

if($_SESSION['admin_role'] !='admin'){
    header('location: index.php');
    exit();
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $insert = $pdo ->prepare("INSERT INTO tbl_admin (username, email, role, password) VALUES (:username,:email, :role, :password)");
    $insert->bindParam(':username', $username);
    $insert->bindParam(':email', $email);
    $insert->bindParam(':role', $role);
    $insert->bindParam(':password', $password);

    if($insert->execute()){
        header("location: admins.php");
        exit();
    }else{
        echo "<script> alert('Something went wrong!')</script>";
    }
}

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5 d-inline">Create User</h5>
                        <form method="POST" action="" enctype="multipart/form-data">

                            <div class="form-outline mb-4 mt-4">
                                <input type="text" name="username" id="form2Example1" class="form-control"
                                       placeholder="username" required/>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="form2Example1" class="form-control"
                                       placeholder="email" required/>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="form2Example1" class="form-control"
                                       placeholder="password" required/>
                            </div>
                            <div class="form-outline mb-4 mt-md-4">
                                <select name="role" required>
                                    <option value="" selected disabled>Select a Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="employee">Employee</option>
                                </select>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require('layouts/footer.php');

?>