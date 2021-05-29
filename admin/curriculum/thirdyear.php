<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=="Admin" || $_SESSION['user_type']=="Secretary"){
?>

<!doctype html>
<html lang="en">

  <head>
    <title>Curriculum Subjects</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./curriculumsubjects.css">
    <link rel="icon" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  </head>

  <body>

    <?php
      include_once("../../connection/connection.php");
      include_once("../../reusables/navbar.php");
      include_once("../../reusables/margin.php");
      
      $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $query = "SELECT * FROM curriculum";
      $results = mysqli_query($dbc, $query);
      while($res = mysqli_fetch_array($results)){
        if(strpos($fullurl,$res['curriculum_id']) == true){
           $currentID = $res['curriculum_id'];
           $curriculumName = $res['curriculum_name']; 
           $courseID = $res['course_id'];
           break;
        }
      }
      if(strpos($fullurl,$currentID) == false){
        goto here;
      }
      
      if(strpos($fullurl,'year3') == false){
        goto here;
      }

      $query2 = "SELECT * FROM course";
      $results2 = mysqli_query($dbc, $query2);
      while($res2 = mysqli_fetch_array($results2)){
        if($res2['course_id'] == $courseID){
           $courseName = $res2['course_name'];
           break;
        }
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

    <!-- delete modal -->
    <div class="modal fade" id="currmodal" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this curriculum?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                    <a href="./deletecurriculum.php?curriculum_id=<?php echo $currentID?>" class="btn btn-danger btn-sm" id="dobtn" >Yes</a>
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
                    <p>Subject was added successfully.</p>
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
                    <p>Subject already exists.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="card" id="head-detail">
        <h3 class="text-center font-weight-light p-3"><?php echo "$courseName $curriculumName" ?> Curriculum</h3>
        <div class="ml-3 mr-3" id="optbtn2">
            <!--
            <a href="" class="btn text-primary btn-sm" id="action-btn">
                <i class="fas fa-pencil-alt"></i>
            </a>
            -->
            <button type="button" class="btn text-danger btn-sm" id="action-btn" data-toggle="modal" data-target="#currmodal" >
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>
    <h5 class="font-weight-light text-center mt-2">Year Levels</h5>
    <div class="text-center flex-row justify-content-center mb-2" id="head-detail">
        <a href="./firstyear.php?curriculum_id=<?php echo $currentID?>?year1" class="btn text-primary btn mr-2 ml-2 p-1" id="action-btn">1</a>
        <a href="./secondyear.php?curriculum_id=<?php echo $currentID?>?year2" class="btn text-primary btn mr-2 ml-2 p-1" id="action-btn">2</a>
        <a href="./thirdyear.php?curriculum_id=<?php echo $currentID?>?year3" class="btn text-primary btn mr-2 ml-2 p-1" id="action-btn">3</a>
        <a href="./fourthyear.php?curriculum_id=<?php echo $currentID?>?year4" class="btn text-primary btn mr-2 ml-2 p-1" id="action-btn">4</a>
    </div>

    <div class="pt-4 pl-1 pr-1 pb-5 flexbox card" id="container">
        <h3 class="text-center font-weight-light"><?php echo "Third Year" ?></h3>
        <div class="row justify-content-center">
            <div class=" col-xs-4 p-2">
                    
                <h5 class="font-weight-light text-center">First Semester</h5>

                <table class="table" id="list">
                        
                    <tr class="bg-dark text-white" id="label-header">
                        <th class="font-weight-bold text-center" id="code">Code</th>
                        <th class="font-weight-bold" id="title">Subject Title</th>
                        <th class="font-weight-bold" id="units">Units</th>
                        <th class="font-weight-bold" id="lec">HrsLEC</th>
                        <th class="font-weight-bold" id="lab">HrsLAB</th>
                        <th class="font-weight-bold text-center" id="req">PreReq</th>
                        <th class="font-weight-bold text-center" id="act">Actions</th>
                    </tr>

                    <tr>
                        <form action="../subjects/addsubjects.php?curriculum_id=<?php echo "$currentID" ?>?year3" method="POST">
                            <input type="hidden" value="1" name="semester" required>
                            <input type="hidden" value="3" name="yrlvl" required>

                            <td class="font-weight-bold text-center" cellpadding="0">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" value="" id="form-fill2" name="code" required>
                            </td>
                            <td class="font-weight-bold">
                                <input class="font-weight-bold" placeholder="Input" type="text" value="" id="form-fill" name="title"required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" value="" id="form-fill3" name="units"required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" value="" id="form-fill3" name="lec" required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" value="" id="form-fill3" name="lab" required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" value="" id="form-fill4" name="req" required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <button type="submit" class="btn text-success btn-xs pl-1 pr-1" id="action-btn">
                                <i class="fa fa-plus"></i>
                                </button>
                            </td>
                        </form>
                    </tr>

                    <?php
                        $fsem = "1";
                        $query = "SELECT * FROM subjects";
                        $results = mysqli_query($dbc, $query);
                        while($res = mysqli_fetch_array($results)){
                            if($res['curriculum_id'] == $currentID && $res['semester'] == $fsem && $res['year_level'] == "3"){   
                    ?>
                        <tr>
                            <form action="../subjects/editsubjects.php?subject_id=<?php echo $res['subject_id']?>?year3" method="POST">
                                <fieldset disabled>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['subject_code']?>" type="text" id="form-fill2" name="code" required>
                                    </td>
                                    <td class="font-weight-bold">
                                        <input class="font-weight-bold" value="<?php echo $res['subject_name']?>" type="text" id="form-fill" name="title"required>
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['subject_units']?>" type="text" id="form-fill3" name="units"required>
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['hpw_lec']?>" type="text" id="form-fill3" name="lec" required>
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['hpw_lab']?>" type="text" id="form-fill3" name="lab" required>
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['pre_req']?>" type="text" id="form-fill4" name="req" required>
                                    </td>
                                </fieldset>
                                <td class="font-weight-bold text-center">
                                    <button type="submit" class="btn text-success btn-xs" onclick="" id="action-btn">
                                        <i class="far fa-save"></i>
                                    </button>
                                    <a href="../subjects/deletesubjects.php?subject_id=<?php echo $res['subject_id']?>year3" class="btn text-danger btn-sm" id="action-btn">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </form>
                        </tr>

                    <?php
                            }
                        } 
                    ?>
                </table>
            </div>

            <div class="col-xs-6 p-2">

                <h5 class="font-weight-light text-center">Second Semester</h5>

                <table class="table" id="list">

                    <tr class="bg-dark text-white" id="label-header">
                        <th class="font-weight-bold text-center" id="code">Code</th>
                        <th class="font-weight-bold" id="title">Subject Title</th>
                        <th class="font-weight-bold" id="units">Units</th>
                        <th class="font-weight-bold" id="lec">HrsLEC</th>
                        <th class="font-weight-bold" id="lab">HrsLAB</th>
                        <th class="font-weight-bold text-center" id="req">PreReq</th>
                        <th class="font-weight-bold text-center" id="act">Actions</th>
                    </tr>
                    <tr>
                        <form action="../subjects/addsubjects.php?curriculum_id=<?php echo "$currentID?" ?>year3" method="POST">
                            <input type="hidden" value="2" name="semester" required>
                            <input type="hidden" value="3" name="yrlvl" required>

                            <td class="font-weight-bold text-center">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" id="form-fill2" name="code" required>
                            </td>
                            <td class="font-weight-bold">
                                <input class="font-weight-bold" placeholder="Input" type="text" value="" id="form-fill" name="title"required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" id="form-fill3" name="units"required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" id="form-fill3" name="lec" required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" id="form-fill3" name="lab" required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <input class="font-weight-bold text-center" placeholder="Input" type="text" id="form-fill4" name="req" required>
                            </td>
                            <td class="font-weight-bold text-center">
                                <button type="submit" class="btn text-success btn-xs pl-1 pr-1" id="action-btn">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </td>
                        </form>
                    </tr>

                    <?php
                        $Ssem = "2";
                        $query = "SELECT * FROM subjects";
                        $results = mysqli_query($dbc, $query);
                        while($res = mysqli_fetch_array($results)){
                            if($res['curriculum_id'] == $currentID && $res['semester'] == $Ssem && $res['year_level'] == "3"){
                            
                    ?>

                        <tr>
                            <form action="../subjects/editsubjects.php?subject_id=<?php echo $res['subject_id']?>?year3" method="POST">
                                <input type="hidden" value="2" name="semester" required>
                                <input type="hidden" value="3" name="yrlvl" required>
                                <fieldset disabled>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['subject_code']?>" type="text" id="form-fill2" name="code" required>
                                    </td>
                                    <td class="font-weight-bold">
                                        <input class="font-weight-bold" value="<?php echo $res['subject_name']?>" type="text" id="form-fill" name="title"required>
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['subject_units']?>" type="text" id="form-fill3" name="units"required>
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['hpw_lec']?>" type="text" id="form-fill3" name="lec" required>
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['hpw_lab']?>" type="text" id="form-fill3" name="lab" required>
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <input class="font-weight-bold text-center" value="<?php echo $res['pre_req']?>" type="text" id="form-fill4" name="req" required>
                                    </td>
                                </fieldset>
                                <td class="font-weight-bold text-center">
                                    <button type="submit" class="btn text-success btn-xs" onclick="" id="action-btn">
                                        <i class="far fa-save"></i>
                                    </button>
                                    <a href="../subjects/deletesubjects.php?subject_id=<?php echo $res['subject_id']?>?year3" class="btn text-danger btn-sm" id="action-btn">
                                        <i class="fa fa-trash"></i>
                                    </a>
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