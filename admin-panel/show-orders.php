<?php
    require 'layouts/header.php';
    require '../config/config.php';

    $select = $pdo->prepare("SELECT * FROM orders");
    $select->execute();
    $orders = $select->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4 d-inline">Orders</h5>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Town</th>
                                <th scope="col">State</th>
                                <th scope="col">Zip Code</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Street Sddress</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td ><?php echo $count++; ?></td>
                                    <td><?php echo $order['first_name'] ?></td>
                                    <td><?php echo $order['last_name'] ?></td>
                                    <td><?php echo $order['town'] ?></td>
                                    <td><?php echo $order['state'] ?></td>
                                    <td>
                                        <?php echo $order['zip_code'] ?>
                                    </td>
                                    <td><?php echo $order['phone'] ?></td>
                                    <td><?php echo $order['street_address'] ?></td>
                                    <td>$<?php echo $order['total_price'] ?></td>

                                    <td><?php echo $order['status'] ?></td>
                                    <td><a href="delete-order.php?id=<?php echo $order['order_id']; ?>" class="btn btn-danger  text-center ">Delete</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
<?php
    require 'layouts/footer.php';
?>