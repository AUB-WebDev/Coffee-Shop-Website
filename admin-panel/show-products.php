<?php
require 'layouts/header.php';
require '../config/config.php';

$select = $pdo->prepare("SELECT * FROM products");
$select->execute();
$products = $select->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4 d-inline">View Products</h5>
                        <?php if($_SESSION['admin_role'] == 'admin'): ?>
                            <a href="create-products.php" class="btn btn-primary mb-4 text-center float-right">Create
                                Product</a>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $counter = 1; ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td ><?php echo $counter++; ?></td>
                                        <td><?php echo $product -> product_name; ?></td>
                                        <td><img src="../uploads/<?php echo $product -> product_image; ?>" style="height: 60px; width: 60px;"></td>
                                        <td>$<?php echo $product -> price; ?></td>
                                        <td><?php echo $product -> type; ?></td>
                                        <?php if($_SESSION['admin_role'] == 'admin'): ?>
                                            <td>
                                                <a href="edit-product.php?id=<?php echo $product -> product_id; ?>" class="btn btn-warning">Edit</a>
                                                <a href="delete-product.php?id=<?php echo $product -> product_id; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
<?php
require 'layouts/footer.php';
?>