<?php session_start(); ?>

<?php require_once 'process.php'; ?>

<?php
  function pre_r($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<title>Homepage</title>
</head>
  <body>
    <div class="container">
      <?php
        $mysqli = new mysqli('localhost', 'root', 'heslo', 'crud') or die (mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die ($mysqli->error);
      ?>

      <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?=$_SESSION['msg-type']?>">
      <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>
        </div>
      <?php endif ?>

      <div class="row justify-content-center">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Location</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <?php while($row = $result->fetch_assoc()) : ?>
            <tr>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['location']; ?></td>
              <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          <?php endwhile ?>
        </table>
      </div>
      <div class="row justify-content-center">
        <form action="process.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $id; ?>">          
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter your location">
          </div>
          <div class="form-group">
            <?php if ($update == true) : ?>
              <button type="submit" name="update" class="btn btn-info">Update</button>
            <?php else : ?>
              <button type="submit" name="save" class="btn btn-primary">Save</button>
              <?php endif ?>
          </div>
        </form>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>