<?php
  require('layouts/header.php');
  require('../config/config.php');

  if($_SESSION['admin_role'] != 'admin'){
      header("Location: index.php");
      exit();
  }

  $select = $pdo->prepare('SELECT * FROM tbl_admin');
  $select ->execute();
  $users = $select->fetchAll(PDO::FETCH_OBJ);


?>
    <div class="container-fluid">

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">View Users</h5>
             <a href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create User</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                  </tr>
                </thead>
                <tbody>
                <?php $counter = 1; ?>
                <?php foreach($users as $user): ?>
                  <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $user -> username; ?></td>
                    <td><?php echo $user -> email; ?></td>
                    <td><?php echo $user -> role; ?></td>

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
require('layouts/footer.php');

?>