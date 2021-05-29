<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=="Admin" || $_SESSION['user_type']=="Secretary"){
?>

<!doctype html>
<html lang="en">

  <head>
    <title>Classes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./classes.css">
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
        if(($_SESSION['modal'] == 'error')){
    ?>
        <script>
            $(document).ready(function() {
            $('#errormodal').modal('show');
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
                    <p>Class was added successfully.</p>
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
    <div class="modal fade" id="errormodal" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Class already exists.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div>  
    
    <div class="text-center p-4">
      <h2 class="mt-5">Classes and Sections</h2>
    </div>

    <div class="mr-3 ml-3 mb-3 row justify-content-center" id="adjust">

      <div class="card m-5 p-2 pt-3 shadow" id="form-box">
        <div class="m-1 pt-4 mt-2 ml-5 mr-5" id="addOption">
          <h4 class="text-center font-weight-normal">Add Class</h4>
          <p class="pt-3 font-weight-light">Add a class and fill out a form for the details.</p>
          <a href="javascript:void();" class="btn stretched-link shadow-none" onclick="toAddForm()"></a>
          
        </div>
        <div class="col text-center" id="addForm">
          <form class="" action="./addclass.php" method="POST">
            <input class="w-100 mb-2" type="text" placeholder="Number of Studens" name="noStud" required>
            <select class="w-100 mb-2"name="year" id="form-fill" required>
                <option value="" disabled selected hidden>Year Level</option>
                <option value="1">First Year</option>
                <option value="2">Second Year</option>
                <option value="3">Third Year</option>
                <option value="4">Fourth Year</option>
            </select>


            <select class="w-100 mb-2"name="section" id="form-fill" required>
                <option value="" disabled selected hidden>Section</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
            </select>


            <select class="w-100 mb-2"name="adviser" id="form-fill" required>
                <option value="" disabled selected hidden>Adviser</option>
                <?php
                    $query = "SELECT * FROM instructors ORDER BY full_name ASC";
                    $results = mysqli_query($dbc, $query);
                    while($res = mysqli_fetch_array($results)){
                    
                ?>
                    <option name='adviser' value="<?php echo $res['full_name']?>"><?php echo $res['full_name']?></option>

                <?php
                    }
                ?>
            </select>
            
            <select class="w-100 mb-2"name="course" id="form-fill" required>
                <option value="" disabled selected hidden>Course</option>
                <?php
                    $query = "SELECT * FROM course";
                    $results = mysqli_query($dbc, $query);
                    while($res = mysqli_fetch_array($results)){
                    
                ?>
                    <option name='course' value="<?php echo $res['course_name']?>"><?php echo $res['course_name']?></option>

                <?php
                    }
                ?>
            </select>

            <div class="ml-3 mr-3" id="optbtn">
              <button type="button" class="btn btn-secondary " onclick="toAddOption()">Cancel</button>
              <input class="btn btn-primary " type="submit" value="Save">
            </div>
          </form>
        </div>
      </div>

      <?php
        $query = "SELECT * FROM classes ORDER BY course ASC, year_level ASC, section ASC";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){    
      ?>
          <div class="card m-5 p-5 shadow" id="course">
            <h4 class="text-center font-weight-normal"><?php echo $res['course']?></h4>
            <div class="justify-content-center" id="class-card">
                <p class="pt-3 font-weight-normal"><?php echo $res['year_level']?></p>
                <p class="pt-3 font-weight-normal"><?php echo $res['section']?></p>
            </div>
            <div class="">
                <p class="text-center pt-3 font-weight-light">Adviser: <?php echo $res['adviser']?></p>
            </div>
            
            <a href="./classschedule.php?class_id=<?php echo $res['class_id']; ?>"class="btn stretched-link shadow-none"></a>
          </div>
      <?php
        }
      ?>

    </div>

    <script>
      var theOption = document.getElementById("addOption")
      var theAddForm = document.getElementById("addForm")

      function toAddForm(){
        theOption.style.display = "none"
        theAddForm.style.display = "block"
      }

      function toAddOption(){
        theAddForm.style.display = "none"
        theOption.style.display = "block"
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