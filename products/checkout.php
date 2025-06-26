<?php

require '../includes/header.php';
require '../config/config.php';

    if(!isset($_SESSION['username'])) {
        header('Location: ../auth/login.php');
    }

    if(!isset($_SESSION['total_price'])) {
        header('Location: cart.php');
        exit();
    }

    if(isset($_POST['btn_order'])) {
        $total          = $_SESSION['total_price'];
        $user_id        = $_SESSION['user_id'];
        $first_name     = $_POST['firstname'];
        $last_name      = $_POST['lastname'];
        $state          = $_POST['state'];
        $street_address = $_POST['streetaddress'];
        $apartment      = $_POST['apartment_unit'];
        $town           = $_POST['town'];
        $zipcode        = $_POST['zipcode'];
        $phone          = $_POST['phone'];
        $email          = $_POST['email'];
        $status          = 'pending';

        $insert = $pdo -> prepare('insert into orders(first_name, last_name, state, street_address,
                   apartment_unit, town, zip_code, phone, email, user_id, status, total_price) values(:first_name, 
                   :last_name, :state, :street_address, :apartment_unit, :town, :zip_code, :phone, :email, 
                   :user_id, :status, :total_price)');

        $insert->bindValue(':first_name', $first_name);
        $insert->bindValue(':last_name', $last_name);
        $insert->bindValue(':state', $state);
        $insert->bindValue(':street_address', $street_address);
        $insert->bindValue(':apartment_unit', $apartment);
        $insert->bindValue(':town', $town);
        $insert->bindValue(':zip_code', $zipcode);
        $insert->bindValue(':phone', $phone);
        $insert->bindValue(':email', $email);
        $insert->bindValue(':user_id', $user_id);
        $insert->bindValue(':status', $status   );
        $insert->bindValue(':total_price', $total);

//        if($insert->execute()) {
//            header('Location: checkout.php');
//            exit();
//        }else{
//
//        }
        $insert->execute();

    }

?>

<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(../images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Checkout</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Checout</span></p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <form action="checkout.php" class="billing-form ftco-bg-dark p-3 p-md-5" method="POST">
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Firt Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">State / Country</label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="state" id="" class="form-control" required>
                                        <option value="France">France</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="South Korea">South Korea</option>
                                        <option value="Hongkong">Hongkong</option>
                                        <option value="Japan">Japan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="streetaddress">Street Address</label>
                                <input type="text" name="streetaddress" class="form-control" placeholder="House number and street name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="apartment_unit" class="form-control" placeholder="Appartment, suite, unit etc: (Optional)" >
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="town">Town / City</label>
                                <input type="text" name="town" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zipcode">Postcode / ZIP *</label>
                                <input type="text" name="zipcode" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <input type="submit" name="btn_order" class="btn btn-primary py-3 px-4" value="Place an order" >
                                </div>
                            </div>
                        </div>
                    </div>
                </form><!-- END -->


                <!--
                              <div class="row mt-5 pt-3 d-flex">
                                  <div class="col-md-6 d-flex">
                                      <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                                          <h3 class="billing-heading mb-4">Cart Total</h3>
                                          <p class="d-flex">
                                                    <span>Subtotal</span>
                                                    <span>$20.60</span>
                                                </p>
                                                <p class="d-flex">
                                                    <span>Delivery</span>
                                                    <span>$0.00</span>
                                                </p>
                                                <p class="d-flex">
                                                    <span>Discount</span>
                                                    <span>$3.00</span>
                                                </p>
                                                <hr>
                                                <p class="d-flex total-price">
                                                    <span>Total</span>
                                                    <span>$17.60</span>
                                                </p>
                                                </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                                          <h3 class="billing-heading mb-4">Payment Method</h3>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="radio">
                                                               <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="radio">
                                                               <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="radio">
                                                               <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="checkbox">
                                                               <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p>
                                                </div>
                                  </div>
                              </div> -->
            </div> <!-- .col-md-8 -->


        </div>

    </div>
    </div>
</section> <!-- .section -->

<?php
require '../includes/footer.php';

?>