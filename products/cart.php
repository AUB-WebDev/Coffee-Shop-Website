<?php
require('../config/config.php');
require('../includes/header.php');

if(!isset($_SESSION['username'])){
    header('Location: ../auth/login.php');
    exit();
}

try {
    $select = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id");
    $select->bindParam(":user_id", $_SESSION['user_id']);
    $select->execute();
    $cart = $select->fetchAll(PDO::FETCH_OBJ);

    // Calculate cart totals
    $subtotal = 0;
    foreach($cart as $item) {
        $subtotal += $item->price * $item->qty;
    }
    $delivery = 0.00;
    $discount = 3.00;
    $total = $subtotal + $delivery - $discount;

} catch(PDOException $e) {
    error_log($e->getMessage());
    header('Location: ../error.php');
    exit();
}
?>

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(../images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Cart</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Cart</span></p>
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
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($cart)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Your cart is empty</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($cart as $cart_item) : ?>
                                <tr class="text-center">
                                    <td class="product-remove">
                                        <a href="delete_from_cart.php?id=<?php echo $cart_item->cart_id; ?>" onclick="return confirm('Do you want to remove this product?')">
                                            <span class="icon-close"></span>
                                        </a>
                                    </td>
                                    <td class="image-prod">
                                        <a href="product-single.php?id=<?php echo $cart_item->product_id; ?>">
                                            <div class="img" style="background-image:url('../images/<?php echo htmlspecialchars($cart_item->product_image); ?>');"></div>
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <h3><?php echo htmlspecialchars($cart_item->product_name); ?></h3>
                                        <p><?php echo htmlspecialchars($cart_item->description); ?></p>
                                    </td>
                                    <td class="price">$<?php echo number_format($cart_item->price, 2); ?></td>
                                    <td class="quantity">
                                        <div class="input-group mb-3">
                                            <input type="number" name="quantity" class="quantity form-control input-number" value="<?php echo $cart_item->qty; ?>" min="1" data-price="<?php echo $cart_item->price; ?>" data-cart-id="<?php echo $cart_item->cart_id; ?>">
                                        </div>
                                    </td>
                                    <td class="total product-total">$<?php echo number_format($cart_item->price * $cart_item->qty, 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php if(!empty($cart)): ?>
            <div class="row justify-content-end">
                <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>$<?php echo number_format($subtotal, 2); ?></span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>$<?php echo number_format($delivery, 2); ?></span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span>$<?php echo number_format($discount, 2); ?></span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>$<?php echo number_format($total, 2); ?></span>
                        </p>
                    </div>
                    <p class="text-center"><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Related Products Section (same as before) -->

<?php require('../includes/footer.php'); ?>

<script>
    $(document).ready(function(){
        $('input.quantity').off('change').on('change', function(){
            let quantity = parseInt($(this).val());
            let price = parseFloat($(this).attr('data-price'));
            let cartId = parseInt($(this).attr('data-cart-id'));

            if (quantity < 1) {
                $(this).val(1);
                quantity = 1;
            }

            // Update the displayed total immediately for better UX
            let total = (price * quantity).toFixed(2);
            $(this).closest('tr').find('.product-total').text('$' + total);

            // AJAX call to update quantity in database
            $.ajax({
                url: 'update-cart.php',
                method: 'GET',
                data: {
                    cart_id: cartId,
                    quantity: quantity
                },
                dataType: 'json',
                success: function(response){
                    if(response.status === 'success') {
                        // Update the cart totals on the page
                        updateCartTotals();
                    } else {
                        console.error('Update failed:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        });

        function updateCartTotals(){
            var subtotal = 0;

            $('.product-total').each(function(){
                var total = parseFloat($(this).text().replace('$', ''));
                subtotal += total;
            });

            var discount = <?php echo $discount; ?>;
            var delivery = <?php echo $delivery; ?>;
            var total = subtotal + delivery - discount;

            // Update the displayed subtotal
            $('.cart-total span:contains("Subtotal")').next().text('$' + subtotal.toFixed(2));
            // Update the displayed total
            $('.cart-total span:contains("Total")').next().text('$' + total.toFixed(2));
        }
    });
</script>