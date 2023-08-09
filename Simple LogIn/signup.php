<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text text-center"></h1>
    <div class="container justify-content-center">
    <?php
      require 'partials/_nav.php';
      require 'partials/databaseconnection.php';
      $msg = false;
      $error = false;

      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $exist_Query = "SELECT * FROM `user_table` WHERE `email` = '$email' ";
        $result = mysqli_query($conn, $exist_Query);
        $num = mysqli_num_rows($result);
        if($num > 0)
        {
          $error = "Email already Exists!!!";
        }
        else
        {
          $sql = "INSERT INTO `user_table` (`name`, `email`, `password`) VALUES ('$name', '$email', '$hash')";
          $result = mysqli_query($conn, $sql);
          $msg = "Your Account is Successfully Added!!!";
        }
        
      }
      else
      {
        $error = "There is some error!!!";
      }
      
    ?>
    <?php
      if($error)
      {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>". $error ."</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      $error = false;
      }
      if($msg)
      {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>". $msg ."</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
    ?>
    <form action="/Krunal/signup.php" method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>