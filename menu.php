<?php
    require('includes/header.php');
    require('config/config.php');

    $drinks = $pdo ->prepare("SELECT * FROM products where type = 'drink'");
    $drinks->execute();
    $all_drinks = $drinks -> fetchAll(PDO::FETCH_OBJ);

    $dessert = $pdo ->prepare("SELECT * FROM products where type = 'dessert'");
    $dessert->execute();
    $all_desserts = $dessert -> fetchAll(PDO::FETCH_OBJ);

?>

    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Our Menu</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Menu</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-intro">
    	<div class="container-wrap">
    		<div class="wrap d-md-flex align-items-xl-end">
	    		<div class="info">
	    			<div class="row no-gutters">
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-phone"></span></div>
	    					<div class="text">
	    						<h3>000 (123) 456 7890</h3>
	    						<p>A small river named Duden flows by their place and supplies.</p>
	    					</div>
	    				</div>
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-my_location"></span></div>
	    					<div class="text">
	    						<h3>198 West 21th Street</h3>
	    						<p>	203 Fake St. Mountain View, San Francisco, California, USA</p>
	    					</div>
	    				</div>
	    				<div class="col-md-4 d-flex ftco-animate">
	    					<div class="icon"><span class="icon-clock-o"></span></div>
	    					<div class="text">
	    						<h3>Open Monday-Friday</h3>
	    						<p>8:00am - 9:00pm</p>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
                <div class="book p-4">
                    <h3>Book a Table</h3>
                    <form action="booking/book.php" method="POST" class="appointment-form">
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="form-group ml-md-4">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <div class="input-wrap">
                                    <div class="icon"><span class="ion-md-calendar"></span></div>
                                    <input type="text" name="date" class="form-control appointment_date" placeholder="Date" required>
                                </div>
                            </div>
                            <div class="form-group ml-md-4">
                                <div class="input-wrap">
                                    <div class="icon"><span class="ion-ios-clock"></span></div>
                                    <input type="text" name="time" class="form-control appointment_time" placeholder="Time" required>
                                </div>
                            </div>
                            <div class="form-group ml-md-4">
                                <input name="phone" type="text" class="form-control" placeholder="Phone" required >
                            </div>
                        </div>
                        <div class="d-md-flex">
                            <div class="form-group">
                                <textarea name="message" id="" cols="30" rows="2" class="form-control" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group ml-md-4">
                                <button type="submit" name="btn_book_table" class="btn btn-white py-3 px-4">Book a Table</button>
                            </div>
                        </div>
                    </form>
                </div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
        <div class="row">
        
        	
        	<div class="col-md-6">
        		<h3 class="mb-5 heading-pricing ftco-animate">Desserts</h3>

                <?php foreach($all_desserts as $dessert): ?>
                    <div class="pricing-entry d-flex ftco-animate">
                        <div class="img" style="background-image: url('images/<?php echo $dessert -> product_image; ?>');"></div>
                        <div class="desc pl-3">
                            <div class="d-flex text align-items-center">
                                <h3><span><?php echo $dessert -> product_name ?></span></h3>
                                <span class="price">$<?php echo number_format( $dessert -> price,2); ?></span>
                            </div>
                            <div class="d-block">
                                <p><?php echo $dessert -> description; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        	</div>

        	<div class="col-md-6">
        		<h3 class="mb-5 heading-pricing ftco-animate">Drinks</h3>
                <?php foreach($all_drinks as $drink): ?>
                    <div class="pricing-entry d-flex ftco-animate">
                        <div class="img" style="background-image: url('images/<?php echo $drink -> product_image; ?>');"></div>
                        <div class="desc pl-3">
                            <div class="d-flex text align-items-center">
                                <h3><span><?php echo $drink -> product_name ?></span></h3>
                                <span class="price">$<?php echo number_format( $drink -> price,2); ?></span>
                            </div>
                            <div class="d-block">
                                <p><?php echo $drink -> description; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        	</div>
        </div>
    	</div>
    </section>

    <section class="ftco-menu mb-5 pb-5">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Our Products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
    		<div class="row d-md-flex">
	    		<div class="col-lg-12 ftco-animate p-md-5">
		    		<div class="row">
		          <div class="col-md-12 nav-link-wrap mb-5">
		            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">

		              <a class="nav-link active" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Drinks</a>

		              <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Desserts</a>
		            </div>
		          </div>
		          <div class="col-md-12 d-flex align-items-center">
		            
		            <div class="tab-content ftco-animate" id="v-pills-tabContent">

		              

		              <div class="tab-pane fade show active" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
		                <div class="row">
                            <?php foreach($all_drinks as $drink): ?>
                                <div class="col-md-4 text-center">
                                    <div class="menu-wrap">
                                        <a href="#" class="menu-img img mb-4" style="background-image: url('images/<?php echo $drink -> product_image; ?>');"></a>
                                        <div class="text">
                                            <h3><a href="#"><?php echo $drink -> product_name ?></a></h3>
                                            <p><?php echo $drink -> description ?></p>
                                            <p class="price"><span>$<?php echo number_format( $drink -> price,2); ?></span></p>
                                            <p><a href="products/product-single.php?id=<?php echo $drink -> product_id; ?>" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
		              	</div>
		              </div>

		              <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
		                <div class="row">
                            <?php foreach($all_desserts as $dessert): ?>
                                <div class="col-md-4 text-center">
                                    <div class="menu-wrap">
                                        <a href="#" class="menu-img img mb-4" style="background-image: url('images/<?php echo $dessert -> product_image; ?>');"></a>
                                        <div class="text">
                                            <h3><a href="#"><?php echo $dessert -> product_name ?></a></h3>
                                            <p><?php echo $dessert -> description ?></p>
                                            <p class="price"><span>$<?php echo number_format( $dessert -> price,2); ?></span></p>
                                            <p><a href="products/product-single.php?id=<?php echo $dessert -> product_id; ?>" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

		              	</div>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
    	</div>
    </section>

<?php require('includes/footer.php');?>