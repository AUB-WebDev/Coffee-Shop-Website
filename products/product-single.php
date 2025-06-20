<?php

    require '../includes/header.php';
    require '../config/config.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $select = $pdo->prepare("SELECT * FROM products WHERE product_id = :id");
        $select->bindParam(":id", $id);
        $select->execute();

        $product = $select->fetch(PDO::FETCH_OBJ);

        $select = $pdo->prepare("SELECT * from products where type = 'drink' && product_id != $id");
        $select->execute();
        $allproducts = $select->fetchAll(PDO::FETCH_OBJ);
    }else{
        header('Location: ../index.php');
    }


?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(../images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Product Detail</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="../index.php">Home</a></span> <span>Product Detail</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="../images/<?php echo $product->product_image; ?>>" class="image-popup"><img src="../images/menu-2.jpg" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?php echo $product->product_name; ?></h3>
    				<p class="price"><span>$<?php echo $product->price; ?></span></p>
    				<p><?php echo $product->description; ?></p>
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
		              <div class="select-wrap">
	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <select name="" id="" class="form-control">
	                  	<option value="">Small</option>
	                    <option value="">Medium</option>
	                    <option value="">Large</option>
	                    <option value="">Extra Large</option>
	                  </select>
	                </div>
		            </div>
							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="icon-minus"></i>
	                	</button>
	            		</span>
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="icon-plus"></i>
	                 </button>
	             	</span>
	          	</div>
          	</div>
          	<p><a href="../cart.html" class="btn btn-primary py-3 px-5">Add to Cart</a></p>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Related products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
        <div class="row">
            <?php foreach ($allproducts as $related_product): ?>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a target="_blank" href="product-single.php?id=<?php echo $related_product->product_id; ?>" class="img" style="background-image: url('../images/<?php echo $related_product->product_image; ?>');"></a>
                        <div class="text text-center pt-4">
                            <h3><a target="_blank" href="product-single.php?id=<?php echo $related_product->product_id; ?>"><?php echo $related_product->product_name ; ?></a></h3>
                            <p><?php echo $related_product->description; ?></p>
                            <p class="price"><span>$<?php echo $related_product->price; ?></span></p>
                            <p><a target="_blank" href="product-single.php?id=<?php echo $related_product->product_id; ?>" class="btn btn-primary btn-outline-primary">Show</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    	</div>
    </section>

<?php require '../includes/footer.php'; ?>
