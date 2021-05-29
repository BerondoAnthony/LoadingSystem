<!doctype html>
<html lang="en">

  <head>
    <title>Oops</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>

  <?php
      include_once("../../connection/connection.php");
      
      $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $query = "SELECT * FROM users";
      $results = mysqli_query($dbc, $query);
      while($res = mysqli_fetch_array($results)){
        if(strpos($fullurl,$res['user_id']) == true){
           $currentID = $res['user_id'];
           break;
        }
      }
    ?>


    <div class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
        <a href="" class="navbar-brand ml-3 mr-4">Faculty Loading System</a>
        <button class="navbar-toggler shadow-none" type="button" data-toggle="collapse" data-target="#myNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="myNavbar">
            <ul class="navbar-nav">
                <li class="nav-item ml-3">
                    <a href="../courses/courses.php" class="text-light font-weight-light nav-link">Curriculum</a>
                </li>
                <li class="nav-item ml-3">
                    <a href="../classes/classes.php" class="text-light font-weight-light nav-link">Classes</a>
                </li>
                <li class="nav-item ml-3">
                    <a href="../../admin/instructors/instructorlist.php" class="text-light font-weight-light nav-link">Instructors</a>
                </li>
                <li class="nav-item ml-3">
                    <a href="../../admin/rooms/rooms.php" class="text-light font-weight-light nav-link">Rooms</a>
                </li>
                <li class="nav-item ml-3">
                    <a href="../../admin/users/userpage.php" class="text-light font-weight-light nav-link">Users</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ml-3">
                    <a href="../../connection/logout.php" class="text-light font-weight-light nav-link">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

</html>