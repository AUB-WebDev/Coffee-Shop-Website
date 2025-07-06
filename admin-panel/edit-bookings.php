<?php
require('layouts/header.php');
require('../config/config.php');


// Make sure an ID is provided
if (!isset($_GET['id'])) {
    header('location: show-bookings.php');
    exit();
}

$id = $_GET['id'];

// Fetch product
$select = $pdo->prepare("SELECT status FROM bookings WHERE book_id = :id");
$select->bindParam(':id', $id);
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);

if (!$row) {
    exit("Product not found.");
}

if(isset($_POST['submit'])) {
    $status = $_POST['status'];
    $update = $pdo->prepare("UPDATE bookings SET status = :status WHERE book_id = :id");
    $update->bindParam(':status', $status);
    $update->bindParam(':id', $id);
    if($update->execute()){
        header('location: show-bookings.php');
        exit();
    }else{
        echo "<script>alert('Something went wrong. Please try again later.');</script>";
    }

}

?>

<form method="POST" action="">
    <div class="card p-4 shadow-sm">
        <h5 class="card-title mb-3">Update Status</h5>

        <div class="form-group mb-3">
            <select name="status" id="statusSelect" class="form-select" required>
                <option value="" disabled selected>Choose Status</option>
                <option value="pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Done">Done</option>
            </select>
        </div>

        <button type="submit" name='submit' class="btn btn-primary">Update</button>
    </div>
</form>



<?php require('layouts/footer.php'); ?>
