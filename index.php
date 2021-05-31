<?php
error_reporting(0);
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Loading System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
  <body>
    <div class="">

      <div class="flex-box card  p-5 shadow"  id=loginform>
        <h4 class="text-center">Welcome User</h4>
        <form class="justify-content-center" action="./connection/authentication.php" method=POST>
          <div class="form-group">
            <label class="ml-1 mt-4"><i class="fas fa-user mr-1"></i>Username</label>
            <input type="text" class="form-control" name="usernameform" id="log-form" required>
          </div>
          <div>
            <label class="ml-1"><i class="fas fa-lock mr-1"></i>Password</label>
            <input type="password" class="form-control" name="passwordform" id="log-form" required>
          </div class="form-group">  
          <div id="optbtn">
            <button type="submit" class="btn btn-primary mr-5">Login</button>
          </div>
          <?php
            if($_SESSION['loginerror'] != 0){
          ?>
            <p class="mt-2 text-danger text-center">Invalid Username or Password.</p>
          <?php
            }
          ?>
        </form>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>