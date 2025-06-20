<?php

    require "../includes/header.php";
    require "../config/config.php";

    if(isset($_SESSION["username"])){
        header("Location: ../index.php");
    }

    if (isset($_POST['btn_submit'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $insert =$pdo ->prepare("INSERT INTO tbl_user (username, email, password, created_at) VALUES (:username, :email, :password, NOW())");
        $insert->bindParam(':username', $username);
        $insert->bindParam(':email', $email);
        $insert->bindParam(':password', $password);

        if ($insert->execute()) {
            header("location: login.php");
        }

    }


?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(../images/bg_2.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Register</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Register</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
			<form action="#" class="billing-form ftco-bg-dark p-3 p-md-5" method="POST">
				<h3 class="mb-4 billing-heading">Register</h3>
	          	<div class="row align-items-end">
                 <div class="col-md-12">
                        <div class="form-group">
                            <label for="Username">Username</label>
                          <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                 </div>
	          	  <div class="col-md-12">
	                <div class="form-group">
	                	<label for="Email">Email</label>
	                  <input type="text" class="form-control" name="email" placeholder="Email" required>
	                </div>
	              </div>
                 
	              <div class="col-md-12">
	                <div class="form-group">
	                	<label for="Password">Password</label>
	                    <input type="password" class="form-control" name="password" placeholder="Password" required>
	                </div>

                </div>
                <div class="col-md-12">
                	<div class="form-group mt-4">
							<div class="radio">
                                <button class="btn btn-primary py-3 px-4" type="submit" name="btn_submit" >Register</button>
						    </div>
					</div>
                </div>

               
	          </form><!-- END -->
          </div> <!-- .col-md-8 -->
          </div>
        </div>
      </div>
    </section> <!-- .section -->

<?php require '../includes/footer.php'; ?>