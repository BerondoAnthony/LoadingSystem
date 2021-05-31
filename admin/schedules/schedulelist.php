<?php
error_reporting(0);
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=="Admin" || $_SESSION['user_type']=="Secretary"){
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
        include_once("../../reusables/navbar.php");
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
    <?php
        if(($_SESSION['modal'] == 'successsubmit')){
    ?>
        <script>
            $(document).ready(function() {
            $('#submitsuccess').modal('show');
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
                    <p>Are you sure you want to delete this schedule?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                    <a href="./deletesched.php?sched_id=<?php echo $currentID?>" class="btn btn-danger btn-sm" id="dobtn" >Yes</a>
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
    <div class="modal fade" id="draftmodal" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
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

    <div class="modal fade" id="submitmodal" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to submit this schedule?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-primary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                    <a href="./submit.php?sched_id=<?php echo $currentID?>" class="btn btn-primary btn-sm" id="dobtn" >Yes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lolmodal" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Draft</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to save this as draft?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                    <a href="./draft.php?sched_id=<?php echo $currentID?>" class="btn btn-primary btn-sm" id="dobtn" >Yes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="submitsuccess" tabindex="-1" aria-labelledby="addClass#addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Schedule was submitted.</p>
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
        <div class="ml-3 mr-3" id="optbtn2">
            <!--
            <a href="" class="btn text-primary btn-sm" id="action-btn">
                <i class="fas fa-pencil-alt"></i>
            </a>
            -->
            <button type="button" class="btn text-primary btn-sm p-1" id="action-btn" data-toggle="modal" data-target="#submitmodal" >
                <i class="fa fa-paper-plane"></i>
            </button>
            <button type="button" class="btn text-secondary btn-sm p-1" id="action-btn" data-toggle="modal" data-target="#lolmodal" >
                <i class="fa fa-save"></i>
            </button>
            <button type="button" class="btn text-danger btn-sm p-1" id="action-btn" data-toggle="modal" data-target="#currmodal" >
                <i class="fa fa-trash"></i>
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
                        <th class="font-weight-bold text-center" id="act">Actions</th>
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
                                    <select class="" name="start_time" id="time-form" >
                                        <?php
                                            $query7 = "SELECT * FROM scheds where sched_id = $id";
                                            $results7 = mysqli_query($dbc, $query7);
                                            while($res7 = mysqli_fetch_array($results7)){
                                                if($res7['start_time'] == ""){
                                        ?>
                                                <option value="" disabled selected hidden>Choose Time</option>
                                               
                                            <?php
                                        
                                                }
                                                else{
                                            ?>
                                                
                                                <option name="" selected value="<?php echo $res7['start_time']?>"><?php echo $res7['start_time']?></option>
                                        <?php
                                                }
                                                $currstart = $res7['start_time'];
                                        
                                            }
                                        ?>
                                        <?php
                                            $query7 = "SELECT * FROM time_stamps";
                                            $results7 = mysqli_query($dbc, $query7);
                                            while($res7 = mysqli_fetch_array($results7)){
                                                if($res7['time_name'] != $currstart){
                                        ?>
                                                <option name="" value="<?php echo $res7['time_name']?>"><?php echo $res7['time_name']?></option>
                                                
                                        <?php
                                                }
                                            }
                                        ?>
                                        <option value="empty">REMOVE</option>
                                    </select>
                                </td>
                                <td class="font-weight-bold text-center">
                                    <select class="" name="end_time" id="time-form">
                                        <?php
                                            $query7 = "SELECT * FROM scheds where sched_id = $id";
                                            $results7 = mysqli_query($dbc, $query7);
                                            while($res7 = mysqli_fetch_array($results7)){
                                                if($res7['end_time'] == ""){
                                        ?>
                                                <option value="" disabled selected hidden>Choose Time</option>
                                               
                                            <?php
                                        
                                                }
                                                else{
                                            ?>
                                                
                                                <option name="" selected value="<?php echo $res7['end_time']?>"><?php echo $res7['end_time']?></option>
                                        <?php
                                                }
                                                $currend = $res7['end_time'];
                                        
                                            }
                                        ?>

                                        <?php
                                            $query7 = "SELECT * FROM time_stamps";
                                            $results7 = mysqli_query($dbc, $query7);
                                            while($res7 = mysqli_fetch_array($results7)){
                                                if($res7['time_name'] != $currend){
                                        ?>
                                                <option name="" value="<?php echo $res7['time_name']?>"><?php echo $res7['time_name']?></option>
                                                
                                        <?php
                                                }
                                            }
                                        ?>
                                        <option value="empty">REMOVE</option>
                                        
                                    </select>
                                </td>

                                <td class="font-weight-bold text-center">
                                    <?php
                                            $query7 = "SELECT * FROM scheds where sched_id = $id";
                                            $results7 = mysqli_query($dbc, $query7);
                                            while($res7 = mysqli_fetch_array($results7)){
                                                if(strpos($res7['mon'],'mon') !== false){
                                    ?>
                                                    <label for="mon" id="check2">M</label>
                                                    <input type="checkbox" value="mon" name="mon" id="check" checked>
                                    <?php
                                                }
                                                else{
                                    ?>
                                                    <label for="mon" id="check2">M</label>
                                                    <input type="checkbox" value="mon" name="mon" id="check">
                                    <?php
                                                }
                                            
                                                if(strpos($res7['tue'],'tue') !== false){
                                    ?>
                                                    <label for="tue" id="check2">T</label>
                                                    <input type="checkbox" value="tue" name="tue" id="check" checked>
                                    <?php
                                                }
                                                else{
                                    ?>
                                                    <label for="tue" id="check2">T</label>
                                                    <input type="checkbox" value="tue" name="tue" id="check">   
                                    <?php
                                                }
                                                if(strpos($res7['wed'],'wed') !== false){
                    
                                    ?>
                                                    <label for="wed" id="check2">W</label>
                                                    <input type="checkbox" value="wed" name="wed" id="check" checked>
                                    <?php
                                                }
                                                else{
                                    ?>
                                                    <label for="wed" id="check2">W</label>
                                                    <input type="checkbox" value="wed" name="wed" id="check">   
                                    <?php
                                                }
                                                if(strpos($res7['thu'],'thu') !== false){
                                    ?>
                                                    <label for="thu" id="check2">TH</label>
                                                    <input type="checkbox" value="thu" name="thu" id="check" checked>
                                    <?php
                                                }
                                               else{
                                    ?>
                                                    <label for="thu" id="check2">TH</label>
                                                    <input type="checkbox" value="thu" name="thu" id="check">   
                                    <?php
                                                }
                                                if(strpos($res7['fri'],'fri') !== false){
                                    ?>
                                                    <label for="fri" id="check2">F</label>
                                                    <input type="checkbox" value="fri" name="fri" id="check" checked>
                                    <?php
                                                }
                                                else{
                                    ?>
                                                    <label for="fri" id="check2">F</label>
                                                    <input type="checkbox" value="fri" name="fri" id="check">   
                                    <?php
                                                }
                                                if(strpos($res7['sat'],'sat') !== false){
                                            
                                    ?>
                                                    <label for="sat" id="check2">S</label>
                                                    <input type="checkbox" value="sat" name="sat" id="check" checked>
                                    <?php
                                                }
                                                else{
                                    ?>
                                                    <label for="sat" id="check2">S</label>
                                                    <input type="checkbox" value="sat" name="sat" id="check">   
                                    <?php
                                                }
                                                if(strpos($res7['sun'],'sun') !== false){
                                    ?>
                                                    <label for="sun" id="check2">SU</label>
                                                    <input type="checkbox" value="sun" name="sun" id="check" checked>
                                    <?php
                                                }
                                                else{
                                    ?>
                                                    <label for="sun" id="check2">SU</label>
                                                    <input type="checkbox" value="sun" name="sun" id="check">   
                                    <?php
                                                }
                                            }
                                    ?>
                                </td>
                                <td class="font-weight-bold text-center">
                                    <select class="" name="instructor" id="ins-form">
                                        <?php
                                            $query7 = "SELECT * FROM scheds where sched_id = $id";
                                            $results7 = mysqli_query($dbc, $query7);
                                            while($res7 = mysqli_fetch_array($results7)){
                                                if($res7['ins_ass'] == ""){
                                        ?>
                                                <option value="" disabled selected hidden>Choose Instructor</option>
                                               
                                            <?php
                                        
                                                }
                                                else{
                                            ?>
                                                
                                                <option name="" selected value="<?php echo $res7['ins_ass']?>"><?php echo $res7['ins_ass']?></option>
                                        <?php
                                                }
                                                
                                                $currins = $res7['ins_ass'];
                                            }
                                        ?>
                                        <?php
                                            $query7 = "SELECT * FROM ins_sub";
                                            $results7 = mysqli_query($dbc, $query7);
                                            while($res7 = mysqli_fetch_array($results7)){
                                            $checking = strpos($subtitle,$res7['subject_assigned']);
                                                if($checking !== false && $res7['full_name'] != $currins){
                                        ?>
                                                    <option name="" value="<?php echo $res7['full_name']?>"><?php echo $res7['full_name']?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                        <option value="empty">REMOVE</option>
                                    </select>
                                </td>
                                <td class="font-weight-bold text-center">
                                    <select class="" name="room" id="room-form">
                                        <?php
                                            $query7 = "SELECT * FROM scheds where sched_id = $id";
                                            $results7 = mysqli_query($dbc, $query7);
                                            while($res7 = mysqli_fetch_array($results7)){
                                                if($res7['room_ass'] == ""){
                                        ?>
                                                <option value="" disabled selected hidden>Choose Room</option>
                                               
                                            <?php
                                        
                                                }
                                                else{
                                            ?>
                                                
                                                <option name="" selected value="<?php echo $res7['room_ass']?>"><?php echo $res7['room_ass']?></option>
                                        <?php
                                                }
                                                $currroom = $res7['room_ass'];
                                        
                                            }
                                        ?>
                                        <?php
                                            $query = "SELECT * FROM rooms ORDER BY room_name, room_building DESC";
                                            $results = mysqli_query($dbc, $query);
                                            while($res = mysqli_fetch_array($results)){
                                                if($res['room_full'] != $currroom){
                                        ?>
                                                    <option name="" value="<?php echo $res['room_full']?>"><?php echo $res['room_full']?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                        <option value="empty">REMOVE</option>
                                    </select>
                                </td>
                                <td class="font-weight-bold text-center">
                                    <button type="submit" class="btn text-success btn-xs" onclick="" id="action-btn">
                                        <i class="far fa-save"></i>
                                    </button>
                                    <!--
                                    <a href="./deleteroom.php?sched_id=<?php echo $currentID?>" class="btn text-danger btn-sm" id="action-btn">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    -->
                                </td>
                            </form>
                        </tr>

                    <?php
                            }
                        } 
                    ?>
                
                </table>
                <?php
                    if($_SESSION['errorrms'] == 1 && $_SESSION['errorins'] == 1){
                        $_SESSION['errorins'] = 0;
                        $_SESSION['errorrms'] = 0;
                        $_SESSION['timeerror'] = 0;
                ?>
                    <p class="text-center text-danger font-weight-bold">There was a conflict with the room and instructor.</p>
                <?php
                    }
                    if($_SESSION['errorins'] == 1){
                        $_SESSION['errorins'] = 0;
                        $_SESSION['errorrms'] = 0;
                        $_SESSION['timeerror'] = 0;
                ?>
                    <p class="text-center text-danger font-weight-bold">There was a conflict with the room. Try a different time and day or change the Room.</p>
                <?php

                    }
                    if($_SESSION['errorrms'] == 1){
                        $_SESSION['errorins'] = 0;
                        $_SESSION['errorrms'] = 0;
                        $_SESSION['timeerror'] = 0;
                ?>
                    <p class="text-center text-danger font-weight-bold">There was a conflict with the instructor. Try a different time and day or change the Instructor.</p>
                <?php
                    }
                    if($_SESSION['timeerror'] == 1){
                        $_SESSION['errorins'] = 0;
                        $_SESSION['errorrms'] = 0;
                        $_SESSION['timeerror'] = 0;
                ?>
                    <p class="text-center text-danger font-weight-bold">The schedule can't end before it starts. Try another time slot.</p>
                <?php
                    }
                ?>
                        
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