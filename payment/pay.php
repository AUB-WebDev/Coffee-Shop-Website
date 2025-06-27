<?php
require '../includes/header.php';
require '../config/config.php';
require __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to cart is the try to access checkout via link
    header('location: ../products/cart.php');
    exit;
}

if(!isset($_SESSION['order_data']) || !isset($_SESSION['total_price'])) {
    header('Location: ../checkout.php');
    exit();
}
?>
<div class="container" style="margin-top: 8em">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 style="color: black">Confirm Payment</h3>
                </div>
                <div class="card-body">
                    <p>Total Amount: $<?php echo number_format($_SESSION['total_price'], 2); ?></p>

                    <!-- PayPal Button Container -->
                    <div id="paypal-button-container"></div>

                    <!-- Alternative payment methods or cancel button -->
                    <div class="mt-3">
                        <a href="../products/checkout.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $_ENV['PAYPAL_CLIENT_ID'] ?>&currency=USD"></script>

<script>
    paypal.Buttons({
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo $_SESSION['total_price']; ?>
                    }
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful payment - send data to server
                fetch('process_payment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        orderData: orderData,
                        sessionData: <?php echo json_encode($_SESSION['order_data']); ?>
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            window.location.href = 'order_success.php?order_id=' + data.order_id;
                        } else {
                            alert('Payment processed but order failed. Please contact support.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Payment processed but order failed. Please contact support.');
                    });
            });
        },
        onError: (err) => {
            console.error('PayPal error:', err);
            alert('Payment processing failed. Please try again.');
        }
    }).render('#paypal-button-container');
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<?php
    require '../includes/footer.php';
?>