<?php

require '../includes/header.php';
require '../config/config.php';


if(!isset($_SESSION['user_id'])){
    header('Location: ../auth/login.php');
}

$orders = $pdo -> prepare("SELECT * FROM orders WHERE user_id = :user_id");
$orders -> bindParam(':user_id', $_SESSION['user_id']);

$orders -> execute();
$all_orders = $orders -> fetchAll(PDO::FETCH_OBJ);

?>
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(../images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Your Orders</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Your Orders</span></p>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr class="text-center">
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Town</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($all_orders)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Your cart is empty</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($all_orders as $order): ?>
                                <tr class="text-center">
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($order->first_name); ?></span>
                                    </td>
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($order->last_name); ?></span>
                                    </td>
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($order->state); ?></span>
                                    </td>
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($order->street_address); ?></span>
                                    </td>
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($order->phone); ?></span>
                                    </td>
                                    <td class="product-details">
                                        <span>$<?php if($order->total_price) echo htmlspecialchars($order->total_price); else echo "N/A"; ?></span>
                                    </td>
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($order->status); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>



<?php

require '../includes/footer.php';

?>
