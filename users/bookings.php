<?php

    require '../includes/header.php';
    require '../config/config.php';

    $bookings = $pdo -> prepare("SELECT * FROM bookings WHERE user_id = :user_id");
    $bookings -> bindParam(':user_id', $_SESSION['user_id']);

    $bookings -> execute();
    $all_bookings = $bookings -> fetchAll(PDO::FETCH_OBJ);

?>
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(../images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Your Bookings</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Your Bookings</span></p>
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
                            <th>Date</th>
                            <th>Time</th>
                            <th>Phone</th>
                            <th>Message</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($all_bookings)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Your cart is empty</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($all_bookings as $booking): ?>
                                <tr class="text-center">
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($booking->first_name); ?></span>
                                    </td>
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($booking->last_name); ?></span>
                                    </td>
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($booking->date); ?></span>
                                    </td>
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($booking->time); ?></span>
                                    </td>
                                    <td class="product-name">
                                        <span><?php echo htmlspecialchars($booking->phone); ?></span>
                                    </td>
                                    <td class="product-details">
                                        <span><?php if($booking->message) echo htmlspecialchars($booking->message); else echo "N/A"; ?></span>
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
