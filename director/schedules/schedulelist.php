<?php
error_reporting(0);
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=="Admin" || $_SESSION['user_type']=="Director"){
?>

<!doctype html>
<html lang="en">

  <head>
    <title>Schedule Subjects</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./schedulelist.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  </head>

  <body>

    <?php
        include_once("../../reusables/dirnavbar.php");
        include_once("../../connection/connection.php");
        include_once("../../reusables/margin.php");
        
        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $query = "SELECT * FROM schedules";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['sched_id']) == true){
            $currentID = $res['sched_id'];
            $curr = $res['curriculum'];
            $goclass = $res['class_id'];
        
            }
        }
        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $query = "SELECT * FROM classes";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if($goclass == $res['class_id']){
                $currcourse = $res['course'];
                $yrlvl = $res['year_level'];
                $currsect = $res['section'];
            }
        }

        if(strpos($fullurl,$currentID) == false){
            goto here;
        }

        $query = "SELECT curriculum_name FROM curriculum where curriculum_id = $curr";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            $currname = $res['curriculum_name'];

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
                    <p>Are you sure you want to deny this schedule?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                    <a href="./disapprove.php?sched_id=<?php echo $currentID?>" class="btn btn-danger btn-sm" id="dobtn" >Yes</a>
                  </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="appmodal" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to approve this schedule?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                    <a href="./approve.php?sched_id=<?php echo $currentID?>" class="btn btn-primary btn-sm" id="dobtn" >Yes</a>
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
                    <p>There was a conflict!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="card" id="head-detail">
        <div id="head-head">
            <h3 class="text-center font-weight-bold p-3"><?php echo $currcourse?></h3>
            <h3 class="text-center font-weight-bold pt-3 pb-3"><?php echo $yrlvl?></h3>
            <h3 class="text-center font-weight-bold pt-3 pb-3"><?php echo $currsect?></h3>
        </div>
        <p class="font-weight-light pl-3"> Curriculum: <?php echo $currname?></p>
        <div class="ml-3 mr-3 pt-2" id="optbtn2">
            <button type="button" class="btn btn-primary btn-sm text-white p-1 mr-1" id="action-btn" data-toggle="modal" data-target="#appmodal" >
                Approve
            </button>
            <button type="button" class="btn btn-danger btn-sm text-white p-1 ml-1" id="action-btn" data-toggle="modal" data-target="#currmodal" >
                Deny
            </button>
        </div>
    </div>

    <div class="pt-4 pl-1 pr-1 pb-5 flexbox card" id="container">
        <h3 class="text-center font-weight-light">Subjects</h3>
        <div class="row justify-content-center">
            <div class=" col-xs-4 p-2">

                <table class="table table-bordered" id="list">
                        
                    <tr class="bg-dark text-white" id="label-header">
                        <th class="font-weight-bold text-center" id="code">Code</th>
                        <th class="font-weight-bold" id="title">Subject Title</th>
                        <th class="font-weight-bold text-center" id="lec">Start Time</th>
                        <th class="font-weight-bold text-center" id="lab">End Time</th>
                        <th class="font-weight-bold text-center" id="req">Days</th>
                        <th class="font-weight-bold text-center" id="req">Instructor</th>
                        <th class="font-weight-bold text-center" id="req">Room</th>
                    </tr>
                    <!--
                    <tr>
                        <form action="./editsched.php?sched_id=<?php echo $currentID?>" method="POST">
                            <td class="font-weight-bold text-center" cellpadding="0">
                                <input class="font-weight-bold text-center" placeholder="AUTO" type="text" value="" id="form-fill2" name="code" readonly>
                            </td>
                            <td class="font-weight-bold">
                                <select class="" name="subjects" id="form-fill" required>
                                    <option value="" disabled selected hidden>Choose Subject</option>
                                    <?php
                                        $query = "SELECT * FROM subjects where curriculum_id = $curr";
                                        $results = mysqli_query($dbc, $query);
                                        while($res = mysqli_fetch_array($results)){
                                    ?>
                                            <option name="" value="<?php echo $res['subject_name']?>"><?php echo $res['subject_name']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>

                            <td class="font-weight-bold text-center">
                                <select class="" name="start_time" id="time-form" required>
                                    <option value="" disabled selected hidden>Choose Time</option>
                                    <?php
                                            $query7 = "SELECT * FROM time_stamps";
                                            $results7 = mysqli_query($dbc, $query7);
                                            while($res7 = mysqli_fetch_array($results7)){
                                        ?>
                                                <option name="" value="<?php echo $res7['time_name']?>"><?php echo $res7['time_name']?></option>
                                                
                                        <?php
                                        
                                            }
                                        ?>
                                    <option value="empty">REMOVE</option>
                                </select>
                            </td>
                            <td class="font-weight-bold text-center">
                                <select class="" name="end_time" id="time-form">
                                    <option value="" disabled selected hidden>Choose Time</option>
                                    <?php
                                        $query7 = "SELECT * FROM time_stamps";
                                        $results7 = mysqli_query($dbc, $query7);
                                        while($res7 = mysqli_fetch_array($results7)){
                                    ?>
                                        <option name="" value="<?php echo $res7['time_name']?>"><?php echo $res7['time_name']?></option>
                                                
                                    <?php
                                        
                                        }
                                    ?>
                                    <option value="empty">REMOVE</option>
                                </select>
                            </td>

                            <td class="font-weight-bold text-center">
                                <label for="mon" id="check2">M</label>
                                <input type="checkbox" value="mon" name="mon" id="check">
                                <label for="tue" id="check2">T</label>
                                <input type="checkbox" value="tue" name="tue" id="check">
                                <label for="wed" id="check2">W</label>
                                <input type="checkbox" value="wed" name="wed" id="check">
                                <label for="thu" id="check2">TH</label>
                                <input type="checkbox" value="thu" name="thu" id="check">
                                <label for="fri" id="check2">F</label>
                                <input type="checkbox" value="fri" name="fri" id="check">
                                <label for="sat" id="check2">S</label>
                                <input type="checkbox" value="sat" name="sat" id="check">
                                <label for="sun" id="check2">SU</label>
                                <input type="checkbox" value="sun" name="sun" id="check">
                                
                            </td>

                            <td class="font-weight-bold text-center">
                                <select class="" name="instructor" id="ins-form">
                                    <option value="" disabled selected hidden>Choose Instructor</option>
                                    <?php
                                        $query = "SELECT * FROM Instructors";
                                        $results = mysqli_query($dbc, $query);
                                        while($res = mysqli_fetch_array($results)){
                                    ?>
                                            <option name="" value="<?php echo $res['full_name']?>"><?php echo $res['full_name']?></option>
                                    <?php
                                        }
                                    ?>
                                    <option value="empty">REMOVE</option>
                                </select>
                            </td>
                            <td class="font-weight-bold text-center">
                                <select class="" name="room" id="room-form">
                                <option value="" disabled selected hidden>Choose Room</option>
                                    <?php
                                        $query = "SELECT * FROM rooms ORDER BY room_building ASC";
                                        $results = mysqli_query($dbc, $query);
                                        while($res = mysqli_fetch_array($results)){
                                    ?>
                                            <option name="" value="<?php echo $res['room_full']?>"><?php echo $res['room_full']?></option>
                                    <?php
                                        }
                                    ?>
                                    <option value="empty">REMOVE</option>
                                </select>
                            </td>
                            <td class="font-weight-bold text-center">
                                <button type="submit" class="btn text-success btn-xs pl-1 pr-1" id="action-btn">
                                <i class="fa fa-plus"></i>
                                </button>
                            </td>
                        </form>
                    </tr>

                    -->

                    <?php
                        $query5 = "SELECT * FROM scheds order by subject_title ASC";
                        $results5 = mysqli_query($dbc, $query5);
                        while($res5 = mysqli_fetch_array($results5)){
                            $subtitle = $res5['subject_title'];
                            if($currentID == $res5['schedid']){   
                                $id = $res5['sched_id'];
                    ?>
                        <tr>
                            <form action="./editsched.php?sched_id=<?php echo $id?>" method="POST">
                                <td class="font-weight-bold text-center" cellpadding="0">
                                    <input class="font-weight-bold text-center"  type="text" value="<?php echo $res5['subject_code']?>" id="form-fill2" name="code" required readonly>
                                </td>
                                <td class="font-weight-bold">
                                    <input class="font-weight-bold" type="text" value="<?php echo $subtitle?>" id="form-fill" name="subjects"required readonly>
                                </td>

                                <td class="font-weight-bold text-center">
                                    <input class="font-weight-bold text-center" type="text" value="<?php echo $res5['start_time']?>" id="time-form" name="subjects"required readonly>
                                </td>
                                <td class="font-weight-bold text-center">
                                    <input class="font-weight-bold text-center" type="text" value="<?php echo $res5['end_time']?>" id="time-form" name="subjects"required readonly>
                                </td>
                                <td>
                                    <?php
                                        $m="";
                                        $t="";
                                        $w="";
                                        $th="";
                                        $f="";
                                        $s="";
                                        $su="";
                                        $stringdays = "";
                                        if($res5['mon']=='mon'){
                                            $m="M";
                                            $stringdays = $stringdays.$m;
                                        }
                                        if($res5['tue']=='tue'){
                                            $t="T";
                                            $stringdays = $stringdays.$t;
                                        }
                                        if($res5['wed']=='wed'){
                                            $w="W";
                                            $stringdays = $stringdays.$w;
                                        }
                                        if($res5['thu']=='thu'){
                                            $th="TH";
                                            $stringdays = $stringdays.$th;
                                        }
                                        if($res5['fri']=='fri'){
                                            $f="F";
                                            $stringdays = $stringdays.$f;
                                        }
                                        if($res5['sat']=='sat'){
                                            $s="S";
                                            $stringdays = $stringdays.$s;
                                        }
                                        if($res5['sun']=='sun'){
                                            $su="SU";
                                            $stringdays = $stringdays.$su;
                                        }
                                    ?>
                                    <p id="ins-form2"><?php echo $stringdays ?></p>
                                </td>
                                <td class="font-weight-bold text-center">
                                    <input class="font-weight-bold text-center" type="text" value="<?php echo $res5['ins_ass']?>" id="time-form" name="subjects"required readonly>
                                </td>
                                <td class="font-weight-bold text-center">
                                    <input class="font-weight-bold text-center" type="text" value="<?php echo $res5['room_ass']?>" id="time-form" name="subjects"required readonly>
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
        include_once("../../reusables/dirnavbar.php");
        include_once("../../connection/connection.php");
        include_once("../../reusables/margin.php");
        include_once("../../reusables/404.shtml");

    }

}
else{
    include_once("../../reusables/404.shtml");

}
?>