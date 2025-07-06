<?php
require 'layouts/header.php';
require '../config/config.php';

$select = $pdo->prepare("SELECT * FROM bookings");
$select->execute();
$bookings = $select->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container-fluid">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Bookings</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $counter = 1; ?>
                <?php foreach ($bookings as $booking): ?>
                  <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $booking['first_name']; ?></td>
                    <td><?php echo $booking['last_name']; ?></td>
                    <td><?php echo $booking['date']; ?></td>
                    <td><?php echo $booking['time']; ?></td>
                    <td><?php echo $booking['phone']; ?></td>
                    <td><?php echo $booking['message']; ?></td>
                    <td><?php echo $booking['status']; ?></td>
                    <td><?php echo $booking['created_at']; ?></td>
                     <td>
                         <a href="edit-bookings.php?id=<?php echo $booking['book_id']; ?>" class="btn btn-warning  text-center ">Change Status</a>
                         <a href="delete-bookings.php?id=<?php echo $booking['book_id']; ?>" class="btn btn-danger  text-center ">Delete</a>
                     </td>
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