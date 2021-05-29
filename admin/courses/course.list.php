<?php
error_reporting(0);
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
  if($_SESSION['user_type']=="Admin" || $_SESSION['user_type']=="Secretary"){
?>

<!doctype html>
<html lang="en">

  <head>
    <title>Curriculum List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./course.list.style.css">
  </head>

  <body>

    <?php
      include_once("../../connection/connection.php");
      include_once("../../reusables/navbar.php");
      include_once("../../reusables/margin.php");
      $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

      $query = "SELECT * FROM course";
      $results = mysqli_query($dbc, $query);
      while($res = mysqli_fetch_array($results)){
        if(strpos($fullurl,$res['course_id']) == true){
          $courseName = $res['course_name'];
          $courseDesc = $res['description'];
          $courseId = $res['course_id'];
        }
      }
      if(strpos($fullurl,$courseId) == false){
        goto here;
      }
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

    <!-- delete modal -->
    <div class="modal fade" id="confirmmodal" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                    <a href="deletecourse.php?course_id=<?php echo $courseId?>" class="btn btn-danger btn-sm" id="dobtn" >Yes</a>
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
                    <p>Curriculum was added successfully.</p>
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
                    <p>Curriculum already exists.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div>  

    <div class="card" id="main">
      <div class="mt-3 mr-3 ml-3"> 
        <h2 class="mt-3 mb-3 ml-3"><?php echo $courseName?></h2>
        <p class="ml-3"><?php echo $courseDesc?></p>
      </div>
      <div class="ml-3 mr-3" id="optbtn">
        <button type="button" class="btn btn-secondary btn-sm" id="dobtn" onclick="toEditOption()" >Edit</button>
        <button type="button" class="btn btn-danger btn-sm" id="dobtn" data-toggle="modal" data-target="#confirmmodal" >Delete</button>
      </div>
    </div>

    <div class="card" id="toEdit">
      <form action="./editcourse.php?course_id=<?php echo $courseId?>" method="POST">
        <div class="mt-1 mr-3 ml-3">
          <input class="w-75 ml-3 mr-3 mt-3 mb-3 p-1" type="text" value="<?php echo $courseName?>" id="course-desc" name="courseName" required>
          <textarea class="w-75 ml-3 mr-3 p-1" name="courseDesc" id="course-desc" rows="2" required><?php echo $courseDesc?></textarea>
        </div>

        <div class="ml-3 mr-3" id="optbtn">
          <button type="button" class="btn btn-secondary btn-sm" id="dobtn" onclick="toReturn()" id="">Cancel</button>
          <input class="btn btn-primary btn-sm" id="dobtn" type="submit" value="Save">
        </div>
      </form>
    </div>

    <div class="mr-3 ml-3 mb-3 row justify-content-center">

      <div class="card m-5 p-2 pt-3 shadow" id="form-box">
        <div class="m-1 pt-4 mt-2 ml-5 mr-5" id="addOption">
          <h4 class="text-center font-weight-normal">Add Curriculum</h4>
          <p class="pt-3 font-weight-light">Fill out a form consisting of the name of the curriculum you want to add.</p>
          <a href="javascript:void();" class="btn stretched-link shadow-none" onclick="toAddForm()" id="dobtn"></a>
        </div>

        <div class="col text-center" id="addForm">
          <form class="" action="../curriculum/addcurriculum.php?course_id=<?php echo $courseId?>" method="POST">
            <input class="w-100 mb-2" type="text" placeholder="Curriculum Effective Year" name="curriculumName" required>
            <div class="ml-3 mr-3" id="optbtn">
              <button type="button" class="btn btn-secondary " onclick="toAddOption()">Cancel</button>
              <input class="btn btn-primary " type="submit" value="Save">
            </div>
          </form>
        </div>
      </div>

      <?php
        $query = "SELECT * FROM curriculum WHERE course_id = $courseId ORDER BY curriculum_name ASC";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
          $curriculumId = $res['curriculum_id']
      ?>
          <div class="card m-5 p-5 shadow" id="curriculum">
            <h3 class="text-center font-weight-normal">Curriculum</h3>
            <h3 class="text-center font-weight-normal"><?php echo $res['curriculum_name']?></h3>
            <a href="../curriculum/firstyear.php?curriculum_id=<?php echo $curriculumId?>?year1"class="btn stretched-link shadow-none"></a>
          </div>

      <?php
        }
      ?>

    </div>

    <script>
      var theOption = document.getElementById("addOption")
      var theAddForm = document.getElementById("addForm")

      var theMain = document.getElementById("main")
      var theEdit = document.getElementById("toEdit")
      var theDelete = document.getElementById("toDelete")

      function toAddForm(){
        theOption.style.display = "none"
        theAddForm.style.display = "block"
      }

      function toAddOption(){
        theAddForm.style.display = "none"
        theOption.style.display = "block"
      }

      function toReturn(){
        theMain.style.display = "block"
        theEdit.style.display = "none"
        theDelete.style.display = "none"
      }

      function toEditOption(){
          theMain.style.display = "none"
          theEdit.style.display = "block"
          theDelete.style.display = "none"
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