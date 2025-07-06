<?php
require('layouts/header.php');
require('../config/config.php');

if($_SESSION['admin_role'] !='admin'){
    header('location: index.php');
    exit();
}

if(isset($_POST['submit'])){

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
        $image = null;
    }
    $insert = $pdo ->prepare("INSERT INTO products(product_name, product_image, description, price, type) values(:product_name,:product_image,:description,:price,:type)");
    $insert->bindParam(':product_name', $name);
    $insert->bindParam(':product_image', $image);
    $insert->bindParam(':description', $description);
    $insert->bindParam(':price', $price);
    $insert->bindParam(':type', $category);

    if($insert ->execute()){
        header('location: show-products.php');
        exit();
    }else{
        echo "<script>alert('Product Not Added');</script>";
    }


}

?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Product</h5>
          <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="Name" required/>
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="price" id="form2Example1" class="form-control" placeholder="Price" required />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="file" name="image" id="form2Example1" class="form-control"  />
                 
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
               
                <div class="form-outline mb-4 mt-4">

                  <select name="category" class="form-select  form-control" aria-label="Default select example" required>
                    <option value="" disabled>Choose Type</option>
                    <option value="drink">Drink</option>
                    <option value="dessert">Dessert</option>
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