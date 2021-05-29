<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=="Admin" || $_SESSION['user_type']=="Secretary"){
?>

<!doctype html>
<html lang="en">

  <head>
    <title>User List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="./userpage.css">

  </head>

  <body>

    <?php
        include_once("../../connection/connection.php");
        include_once("../../reusables/navbar.php");
        include_once("../../reusables/margin.php"); 
    ?> 

    <?php
        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if(($_SESSION['modal'] == 'errordelete')){
    ?>
        <script>
            $(document).ready(function() {
            $('#errormodaldelete').modal('show');
            });
        </script>

    <?php
        $_SESSION['modal'] = "None";
        }
    ?>

    <?php
        if(($_SESSION['modal'] == 'erroredit')){
    ?>
        <script>
            $(document).ready(function() {
            $('#errormodaledit').modal('show');
            });
        </script>

    <?php
        $_SESSION['modal'] = "None";
        }
    ?>

    <?php
        if(($_SESSION['modal'] == 'erroronly')){
    ?>
        <script>
            $(document).ready(function() {
            $('#errormodalonly').modal('show');
            });
        </script>

    <?php
        $_SESSION['modal'] = "None";
        }
    ?>

    <?php
        if(($_SESSION['modal'] == 'successedit')){
    ?>
        <script>
            $(document).ready(function() {
            $('#successedit').modal('show');
            });
        </script>

    <?php
        $_SESSION['modal'] = "None";
        }
    ?>
    <?php
        if(($_SESSION['modal'] == 'successadd')){
    ?>
        <script>
            $(document).ready(function() {
            $('#successadd').modal('show');
            });
        </script>

    <?php
        $_SESSION['modal'] = "None";
        }
    ?>
    <?php
        if(($_SESSION['modal'] == 'successdelete')){
    ?>
        <script>
            $(document).ready(function() {
            $('#successdelete').modal('show');
            });
        </script>

    <?php
        $_SESSION['modal'] = "None";
        }
    ?>
    <!-- success modal -->
    <div class="modal fade" id="successedit" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Change successful.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div> 
    <!-- success modal -->
    <div class="modal fade" id="successadd" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>User was added successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div> 
    <!-- success modal -->
    <div class="modal fade" id="successdelete" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Delete successful.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div> 

    <!-- error modal -->
    <div class="modal fade" id="errormodaldelete" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Can't remove Admin.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div>  

    <!-- error modal -->
    <div class="modal fade" id="errormodaledit" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Can't edit admin.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div> 

    <!-- error modal -->
    <div class="modal fade" id="errormodalonly" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>User already exists.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div> 

    <div  class="pl-1 pr-1" id="container">
        
        <div class="text-center p-4">
            <h2 class="mt-5">Users</h2>
        </div>

        <div class="pt-2 pl-1 pr-1 pb-5 row justify-content-center">
        
            <table class="table table-bordered w-75 " id="list">
                            
                <tr class="bg-dark text-white" id="label-header">
                    <th class="font-weight-bold text-center font-weight-light" id="">Username</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Password</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Role</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Email</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Status</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Actions</th>
                </tr>
                <tr class="" id="">
                    <form action="./adduser.php" method="POST">
                        <td class="font-weight-bold" id="">
                            <input class="font-weight-bold text-center" placeholder="AUTO GENERATE" type="text" value="" id="form-fill" name="username" disabled>
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <input class="font-weight-bold text-center" placeholder="AUTO GENERATE" type="password" value="" id="form-fill" name="password" disabled>
                            
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <select name="role" id="form-fill" required>
                                <option value="">Role</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Director">Dean</option>
                            </select>
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <input class="font-weight-bold text-center" placeholder="Enter Email" type="email" value="" id="form-fill" name="email" required>
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <select name="status" id="form-fill" required>
                                <option value="Active">Active</option>
                                <option value="Disable">Disabled</option>
                            </select>
                        </td>
                        <td class="font-weight-bold text-center">
                            <button type="submit" class="btn text-success btn-xs pl-1 pr-1" id="action-btn">
                                <i class="fa fa-plus"></i>
                            </button>
                        </td>
                    </form>
                </tr>

                <?php
                    $query = "SELECT * FROM users ";
                    $results = mysqli_query($dbc, $query);
                    while($res = mysqli_fetch_array($results)){
                        $currentID = $res['user_id'];

                ?>

                <tr class="" id="">
                    <form action="./edituser.php?user_id=<?php echo $res['user_id']?>" method="POST">
                        <td class="font-weight-bold" id="">
                            <input class="font-weight-bold text-center" type="text" value="<?php echo $res['username']?>" id="form-fill" name="username" required>
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <input class="font-weight-bold text-center" type="password" value="<?php echo $res['password']?>" id="form-fill-special" name="password" required>
                            <!--<input class="" type="checkbox" onclick="myFunction()" id="thebox">-->
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <select name="role" id="form-fill" required>
                                <?php
                                    if($res['user_type'] == 'Admin'){
                                ?>
                                    <option value="Admin">Admin</option>
                                    <option value="Secretary">Secretary</option>
                                    <option value="Director">Dean</option>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($res['user_type'] == 'Secretary'){
                                ?>
                                    <option value="Secretary">Secretary</option>
                                    <option value="Director">Dean</option>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($res['user_type'] == 'Director'){
                                ?>
                                    <option value="Director">Dean</option>
                                    <option value="Secretary">Secretary</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <input class="font-weight-bold text-center" type="email" value="<?php echo $res['email']?>" id="form-fill" name="email" required>
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <select name="status" id="form-fill" required>
                                <?php
                                    if($res['user_status'] == 'Active'){
                                ?>
                                    <option value="Active">Active</option>
                                    <option value="Disable">Disabled</option>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($res['user_status'] == 'Disable'){
                                ?>
                                    <option value="Disable">Disabled</option>
                                    <option value="Active">Active</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </td>
                        <td class="font-weight-bold text-center">
                            <button type="submit" class="btn text-success btn-xs" id="action-btn">
                                <i class="far fa-save"></i>
                            </button>
                            <a href="./deleteuser.php?user_id=<?php echo $currentID?>" class="btn text-danger btn-sm" id="action-btn">
                                <i class="fa fa-trash"></i>
                            </a>
                       
                        </td>
                    </form>
                </tr>
 
                <?php

                    }
            
                ?>
            
            </table>
        
        </div>
      
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("form-fill-special");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

</html>
<?php
    
    }else{
        here:
        include_once("../../reusables/navbar.php");
        include_once("../../connection/connection.php");
        include_once("../../reusables/margin.php");
        include_once("../../reusables/404.shtml");

    }

}
else{
    include_once("../../reusables/404.shtml");

}
?>