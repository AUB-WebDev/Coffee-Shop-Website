<?php
    require "../includes/header.php";
    require "../config/config.php";

    if(isset($_SESSION['username'])){
        header('Location: ../index.php');
    }

    if (isset($_POST['btn_submit'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $pdo ->prepare("SELECT * FROM tbl_user WHERE email= :email");
        $login->bindParam(':email', $email);

        $login->execute();
        $fetch = $login -> fetch(PDO::FETCH_ASSOC);

        if($login->rowCount() > 0){

            if(password_verify($password, $fetch['password'])){
                $_SESSION['email'] = $fetch['email'];
                $_SESSION['username'] = $fetch['username'];
                $_SESSION['user_id'] = $fetch['user_id'];
                header("location: ../index.php");

            }else{
                echo "<script> alert('Your Email or Password is incorrect!');</script>";
            }

        }else{
            echo "<script> alert('Your Email or Password is incorrect!');</script>";
        }

    }


?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(../images/bg_1.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Login</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Login</span></p>
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
				<h3 class="mb-4 billing-heading">Login</h3>
	          	<div class="row align-items-end">
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
                                <button class="btn btn-primary py-3 px-4" type="submit" name="btn_submit">Login</button>
						    </div>
					</div>
                </div>

               
	          </form><!-- END -->
          </div> <!-- .col-md-8 -->
          </div>
        </div>
      </div>
    </section> <!-- .section -->

<?php require "../includes/footer.php" ?>