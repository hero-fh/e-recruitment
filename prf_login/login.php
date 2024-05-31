<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <script>
    start_loader()
  </script>
  <img class="wave" src="img/wave.png">
  <div class="container">
    <div class="img">
      <img src="img/prf2.svg">
    </div>
    <div class="login-content ">
      <form id="lgn" action="" method="post">
        <img src="img/avatar.svg">
        <h3 class="title">PERSONNEL REQUISITION FORM</h3>
        <div class="input-div one">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">
            <!-- <h5>Username</h5> -->
            <input type="text" class="form-control" autofocus name="username" placeholder="Username">
          </div>
        </div>
        <div class="input-div pass ">
          <div class="i">
            <i class="fas fa-lock"></i>
          </div>
          <div class="div ">
            <!-- <h5>Password</h5> -->
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
        </div>
        <!-- <a href="#">Forgot Password?</a> -->
        <button type="submit" class="btn btn-success btn-block">Sign In</button>
      </form>
    </div>
  </div>
  <script type="text/javascript" src="js/main.js"></script>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {
      end_loader();
    })
  </script>
</body>

</html>