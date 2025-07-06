<?php
require('layouts/header.php');
require('../config/config.php');


if ($_SESSION['admin_role'] != 'admin') {
    header('location: index.php');
    exit();
}

// Make sure an ID is provided
if (!isset($_GET['id'])) {
    header('location: show-products.php');
    exit();
}

$id = $_GET['id'];

// Fetch product
$select = $pdo->prepare("SELECT * FROM products WHERE product_id = :id");
$select->bindParam(':id', $id);
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);

if (!$row) {
    exit("Product not found.");
}

// When form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Check if new image uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $row->product_image; // keep old image
    }

    $update = $pdo->prepare("UPDATE products SET product_name = :name, product_image = :image, description = :description, price = :price, type = :type WHERE product_id = :id");
    $update->bindParam(':name', $name);
    $update->bindParam(':image', $image);
    $update->bindParam(':description', $description);
    $update->bindParam(':price', $price);
    $update->bindParam(':type', $category);
    $update->bindParam(':id', $id);

    if ($update->execute()) {
        header('location: show-products.php');
        exit();
    } else {
        echo "<script>alert('Product not updated');</script>";
    }
}
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5 d-inline">Edit Product</h5>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <!-- Email input -->
                            <div class="form-outline mb-4 mt-4">
                                <input type="text" name="name" id="form2Example1" class="form-control" placeholder="Name" value="<?php echo $row -> product_name; ?>" required/>
                            </div>
                            <div class="form-outline mb-4 mt-4">
                                <input type="text" name="price" id="form2Example1" class="form-control" placeholder="Price" value="<?php echo $row -> price; ?>" required />

                            </div>
                            <div class="form-outline mb-4 mt-4">
                                <input type="file" name="image" id="form2Example1" class="form-control" />

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= htmlspecialchars($row->description) ?></textarea>
                            </div>

                            <div class="form-outline mb-4 mt-4">

                                <select name="category" class="form-select form-control" required>
                                    <option value="" disabled>Choose Type</option>
                                    <option value="drink" <?php if ($row->type == 'drink') echo 'selected'; ?>>Drink</option>
                                    <option value="dessert" <?php if ($row->type == 'dessert') echo 'selected'; ?>>Dessert</option>
                                </select>

                            </div>

                            <br
                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require('layouts/footer.php');
?>