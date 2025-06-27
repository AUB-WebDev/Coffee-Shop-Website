<?php
require '../includes/header.php';

if (!isset($_GET['order_id']) || !isset($_SERVER['HTTP_REFERER']) ) {
    header('location: ../products/cart.php');
    exit();
}

$order_id = htmlspecialchars($_GET['order_id']);
?>

    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url(../images/bg_3.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">
                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Order Confirmation</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Order Confirmation</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 ftco-animate text-center">
                    <div class="alert alert-success">
                        <h2>Thank You for Your Order!</h2>
                        <p>Your order #<?php echo $order_id; ?> has been successfully processed.</p>
                        <p>We will ship out your order ASAP!!</p>
                    </div>
                    <a href="../index.php" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </section>

<?php require '../includes/footer.php'; ?>