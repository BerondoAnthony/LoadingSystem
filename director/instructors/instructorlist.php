<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=="Director"){
?>

<!doctype html>
<html lang="en">

  <head>
    <title>Instructor List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./inslist.css">
    <link rel="icon" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  </head>

  <body>

    <?php
      include_once("../../connection/connection.php");
      include_once("../../reusables/dirnavbar.php");
      include_once("../../reusables/margin.php");
      
    ?>  

    <?php
        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if(strpos($fullurl,'successdelete') == true){
    ?>
        <script>
            $(document).ready(function() {
            $('#successdelete').modal('show');
            });
        </script>

    <?php
        }
    ?>

    <?php
        if(strpos($fullurl,'successedit') == true){
    ?>
        <script>
            $(document).ready(function() {
            $('#successedit').modal('show');
            });
        </script>

    <?php
        }
    ?>

    <?php
        if(strpos($fullurl,'successadd') == true){
    ?>
        <script>
            $(document).ready(function() {
            $('#successadd').modal('show');
            });
        </script>

    <?php
        }
    ?>

    <?php
        if(strpos($fullurl,'successdelete') == true){
    ?>
        <script>
            $(document).ready(function() {
            $('#successdelete').modal('show');
            });
        </script>

    <?php
        }
    ?>

    <?php
        if(strpos($fullurl,'erroronly') == true){
    ?>
        <script>
            $(document).ready(function() {
            $('#errormodalonly').modal('show');
            });
        </script>

    <?php
        }
    ?>

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
                    <p>Instructor already exists.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div> 

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
                    <p>Instructor was added successfully.</p>
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

    <div  class="pl-1 pr-1" id="container">
        
        <div class="text-center p-4">
            <h2 class="mt-5">Instructors</h2>
        </div>

        <div class="pt-2 pl-1 pr-1 pb-5 row justify-content-center">
        
            <table class="table table-bordered w-75 " id="list">
                            
                <tr class="bg-dark text-white" id="label-header">
                    <th class="font-weight-bold text-center font-weight-light" id="">Last Name</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">First Name</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Email</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Status</th>
                </tr>

                <?php
                    $query = "SELECT * FROM instructors ORDER BY last_name ASC";
                    $results = mysqli_query($dbc, $query);
                    while($res = mysqli_fetch_array($results)){
                        if($res['ins_status'] == "Active" || " Disabled"){
                ?>
                <tr class="" id="">
                    <form action="./editinstructors.php?ins_id=<?php echo $res['ins_id']?>" method="POST">
                        <td class="font-weight-bold text-center" id="">
                            <input class="font-weight-bold text-center" type="text" value="<?php echo $res['last_name']?>" id="form-fill" name="lname" required readonly>
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <input class="font-weight-bold text-center" type="text" value="<?php echo $res['first_name']?>" id="form-fill" name="fname" required readonly>
                        </td>
                        <td class="font-weight-bold text-center" id="">
                            <input class="font-weight-bold text-center" type="text" value="<?php echo $res['email']?>" id="form-fill" name="email" required readonly>
                        </td>
                        <td class="font-weight-bold text-center" id="">
                        <input class="font-weight-bold text-center" type="text" value="<?php echo $res['ins_status']?>" id="form-fill" name="email" required readonly>
                        </td>
                    </form> 
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
                 
        </div>
      
    </div>


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