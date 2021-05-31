<?php
error_reporting(0);
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=="Instructor"){
?>

<!doctype html>
<html lang="en">

  <head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./inspage.css">
    <link rel="icon" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    </head>

  <body>
    <?php
      include_once("../../connection/connection.php");
      include_once("../../reusables/insnavbar.php");
      include_once("../../reusables/margin.php");
      $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

      $query = "SELECT * FROM instructors";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['ins_id']) == true){
                $currentID = $res['ins_id'];
                break;
            }
        }
        if(strpos($fullurl,$currentID) == false){
            goto here;
        }
        if($_SESSION['ins_id'] != $currentID){
            goto here;
        }
      
    ?> 
    
    <?php
        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
                    <p>Subject already in the list.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="p-2" id="container">

        <div class="p-2 m-1 card" id="profile">
            
            <div id="prof-info">
                <h4 class="">Profile Information</h4>
                <?php
                    $query = "SELECT * FROM instructors";
                    $results = mysqli_query($dbc, $query);
                    while($res = mysqli_fetch_array($results)){
                        if(strpos($fullurl,$res['ins_id']) == true){
                            $currentID = $res['ins_id'];
                            break;
                        }
                    }
                        
                    $query2 = "SELECT * FROM instructors";
                    $results2 = mysqli_query($dbc, $query2);
                    while($res2 = mysqli_fetch_array($results2)){
                        if($res2['ins_id'] == "$currentID"){
                ?>

                <form class="mt-3" action="./insinfo.php?user_id=<?php echo "$currentID"?>" method=POST>
                    <div>
                        <label class="" id="labels">Last Name:</label>
                        <input type="text" class="font-weight-bold" value="<?php echo $res2['last_name']?>" name="lnform" id="form-fill">
                    </div>
                    <div>
                        <label class="" id="labels">First Name:</label>
                        <input type="text" class="font-weight-bold" value="<?php echo $res2['first_name']?>" name="fnform" id="form-fill">
                    </div>
                    <div>
                        <label class="" id="labels">Username:</label>
                        <input type="text" class="font-weight-bold" value="<?php echo $res2['username']?>" name="unform" id="form-fill">
                    </div>
                    <div id="password-flex">
                        <div>
                            <label class="" id="labels">Password:</label>
                            <input type="password" class="font-weight-bold" value="<?php echo $res2['password']?>" name="passform" id="form-fill-special">
                        </div>
                        <div>
                            <label class="" id="labels2">Show Password:</label>
                            <input class="" type="checkbox" onclick="myFunction()" id="thebox">
                        </div>
                    </div>
                    <div>
                        <label class="" id="labels">Major:</label>
                        <input type="text" class="font-weight-bold" value="<?php echo $res2['major']?>" name="majorform" id="form-fill">
                    </div>
                    <div>
                        <label class="" id="labels">Email:</label>
                        <input type="text" class="font-weight-bold" value="<?php echo $res2['email']?>" name="emailform" id="form-fill">
                    </div>

                    <input class="btn btn-sm btn-primary m-2" id="optbtn" type="submit" value="Save">
                </form>

                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="p-2 m-1 card" id="pref-sched">
            <div id="psched-info">
                <h4 class="">Qualifications</h4>
            </div>
            <form class="" action="./qualifications.php" method="POST">
                <?php
                    $query = "SELECT * FROM qualifications";
                    $results = mysqli_query($dbc, $query);
                    while($res = mysqli_fetch_array($results)){
                        if($res['insid'] == $currentID){
                            $info = $res['qualinfo'];
                            $check = 1;
                            break;
                        }
                    }
                    if($check == 0 || $info == ""){
                ?>
                        <textarea class="w-100 mt-2 p-2" name="qualifications" id="qual" placeholder="Type in qualifications here."></textarea>
                <?php
                    }
                    else{
                ?>
                    <textarea class="w-100 mt-2 p-2" name="qualifications" id="qual"><?php echo $res['qualinfo'] ?></textarea>
                <?php
                    }
                    
                ?>
                <div class="ml-3 mr-3" id="">
                    <input class="btn btn-sm btn-primary m-2" id="optbtn" type="submit" value="Save">
                </div>
            </form>
        </div>

    </div>

    <div class="p-2" id="container">

        <div class="p-2 m-1 card" id="subj-ass">
            <div id="subj-info">
                <h4 class="">List of Subjects</h4>
            </div>
            <div  class="pl-1 pr-1" id="container">
                
                <div class="pt-2 pl-1 pr-1 pb-5" id="table-pos">

                    <table class="mt-4 table table-bordered w-75" id="list">
                                        
                        <tr class="" id="label-header">
                            <th class="font-weight-bold text-center font-weight-light" id="">Preffered</th>
                            <th class="font-weight-bold text-center font-weight-light" id="">Action</th>
                        </tr>
                        <tr class="" id="">
                            <form action="./inssub.php?ins_id=<?php echo $currentID?>" method="POST">
                                <td class="font-weight-bold" id="">
                                    <select class="" name="inssubject" id="ins-form" required>
                                        <option value="" disabled selected hidden>Choose a Subject</option>
                                        <?php
                                            $query = "SELECT DISTINCT subject_name FROM subjects order by subject_name ASC";
                                            $results = mysqli_query($dbc, $query);
                                            while($res = mysqli_fetch_array($results)){
                                        ?>
                                                <option class="" name="" value="<?php echo $res['subject_name']?>"><?php echo $res['subject_name']?></option>
                                        <?php
                                            }
                                        ?>
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
                            $query = "SELECT * FROM ins_pref order by subject_preffered ASC";
                            $results = mysqli_query($dbc, $query);
                            while($res = mysqli_fetch_array($results)){
                                if($res['ins_id'] == $currentID){
                        ?>
                            <tr class="" id="">
                                <form action="inssubedit.php?ins_pref_id=<?php echo $res['ins_pref_id']?>" method="POST">
                                    <td class="font-weight-bold" id="">
                                        <select class="" name="inssubject" id="ins-form" required>
                                            <option value="<?php echo $res['subject_preffered']?>"><?php echo $res['subject_preffered']?></option>
                                                <?php
                                                    $query2 = "SELECT DISTINCT subject_name FROM subjects order by subject_name ASC";
                                                    $results2 = mysqli_query($dbc, $query2);
                                                    while($res2 = mysqli_fetch_array($results2)){
                                                        if($res2['subject_name'] != $res['subject_preffered']){
                                                ?>
                                            <option class="" name="" value="<?php echo $res2['subject_name']?>"><?php echo $res2['subject_name']?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                        </select>
                                    </td>
                                    <td class="font-weight-bold text-center" id="">
                                        <button type="submit" class="btn text-success btn-xs" onclick="" id="action-btn">
                                            <i class="far fa-save"></i>
                                        </button>
                                        <a href="./inssubdelete.php?ins_pref_id=<?php echo $res['ins_pref_id']?>" class="btn text-danger btn-sm" id="action-btn">
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
                    
                    <table class="mt-4 table table-bordered w-100" id="list">
                                        
                        <tr class="" id="label-header">
                            <th class="font-weight-bold text-center font-weight-light" id="">Assigned</th>
                        </tr>
                        <?php
                            $query = "SELECT * FROM ins_sub order by subject_assigned ASC";
                            $results = mysqli_query($dbc, $query);
                            while($res = mysqli_fetch_array($results)){
                                if($res['ins_id'] == $currentID){
                        ?>

                                    <tr class="" id="">
                                        <td class="font-weight-normal" id="">
                                            <p id="ins-form2"><?php echo $res['subject_assigned'] ?></p>
                                        </td>
                                    </tr>
                                                   
                        <?php
                                        }
                                    }
                        ?>

                    </table>
                </div>
            </div>
        </div>

        <div class="p-2 m-1 card" id="schedule">
            <div id="filter">
                <div id="sched-info">
                    <h4 class="">Schedules</h4>
                </div>
                <div>
                    <form action="./sort.php?user_id=<?php echo "$currentID"?>" method="POST">
                        <select class="" id="filt" name="schoolyear" required>
                        <?php
                                if($_SESSION['sortyear'] == ""){
                            ?>
                                <option value="" disabled selected hidden>School Year</option>
                            <?php
                                }
                                if($_SESSION['sortyear'] != ""){
                            ?>
                                <option value="<?php echo $_SESSION['sortyear']?>" selected><?php echo $_SESSION['sortyear']?></option>
                            <?php
                                }
                            ?>
                            <?php
                                $query2 = "SELECT DISTINCT school_year FROM schedules order by school_year ASC";
                                $results2 = mysqli_query($dbc, $query2);
                                while($res2 = mysqli_fetch_array($results2)){
                            ?>
                                    <option class="" name="" value="<?php echo $res2['school_year']?>"><?php echo $res2['school_year']?></option>
                            <?php
                                
                                }
                            ?>
                            <option class="" name="" value="">Clear</option>
                        </select>
                        <select class="" id="filt"name="sems" required>
                            <?php
                            
                                if($_SESSION['sortsem'] == ""){
                            ?>
                                <option value="" disabled selected hidden>Semester</option>
                                <option value="1">First</option>
                                <option class="" name="" value="2">Second</option>
                                <option class="" name="" value="">Clear</option>
                                <!--
                                <option class="" name="" value="3">Summer</option>
                                -->

                            <?php
                                }
                                if($_SESSION['sortsem']==1){
                            ?>
                                <option value="1" selected>First</option>
                                <option class="" name="" value="2">Second</option>
                                <option class="" name="" value="">Clear</option>
                                <!--
                                <option class="" name="" value="3">Summer</option>
                                -->
                            <?php
                                }
                                if($_SESSION['sortsem']==2){
                            ?>
                                <option value="2" selected >Second</option>
                                <option class="" name="" value="1">First</option>
                                <option class="" name="" value="">Clear</option>
                                <!--
                                <option class="" name="" value="3">Summer</option>
                                -->
                            <?php
                                }
                                if($_SESSION['sortsem']==3){
                            ?>
                                
                                <option class="" name="" value="1">First</option>
                                <option class="" name="" value="2">Second</option>
                            <?php
                                }
                            ?>
                        </select>
                        <input class="btn btn-sm btn-primary m-2" type="submit" value="Apply">
                    </form>
                </div>
            </div>
            
            <div  class="pl-1 pr-1" id="container">
                
                <div class="pt-2 pl-1 pr-1 pb-5" id="table-pos2">
                    
                    <table class="mt-4 table table-bordered w-100" id="list">
                                        
                        <tr class="" id="label-header">
                            <th class="font-weight-bold text-center" id="title">Subject</th>
                            <th class="font-weight-bold text-center" id="lec">Start Time</th>
                            <th class="font-weight-bold text-center" id="lab">End Time</th>
                            <th class="font-weight-bold text-center" id="req">Days</th>
                            <th class="font-weight-bold text-center" id="req">Room</th>
                        </tr>
                        <?php
                            $query = "SELECT * FROM scheds";
                            $results = mysqli_query($dbc, $query);
                            while($res = mysqli_fetch_array($results)){
                                if($res['insid'] == $currentID ){
                                    if($res['school_year'] == $_SESSION['sortyear'] && $res['sched_sem'] == $_SESSION['sortsem']){
                
                        ?>
                        <tr>
                                <td>
                                    <p id="ins-form2"><?php echo $res['subject_title'] ?></p>
                                </td>
                                <td>
                                    <p id="ins-form2"><?php echo $res['start_time'] ?></p>
                                </td>
                                <td>
                                    <p id="ins-form2"><?php echo $res['end_time'] ?></p>
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
                                        if($res['mon']=='mon'){
                                            $m="M";
                                            $stringdays = $stringdays.$m;
                                        }
                                        if($res['tue']=='tue'){
                                            $t="T";
                                            $stringdays = $stringdays.$t;
                                        }
                                        if($res['wed']=='wed'){
                                            $w="W";
                                            $stringdays = $stringdays.$w;
                                        }
                                        if($res['thu']=='thu'){
                                            $th="TH";
                                            $stringdays = $stringdays.$th;
                                        }
                                        if($res['fri']=='fri'){
                                            $f="F";
                                            $stringdays = $stringdays.$f;
                                        }
                                        if($res['sat']=='sat'){
                                            $s="S";
                                            $stringdays = $stringdays.$s;
                                        }
                                        if($res['sun']=='sun'){
                                            $su="SU";
                                            $stringdays = $stringdays.$su;
                                        }
                                    ?>
                                       
                                    <p class="text-center" id="ins-form2"><?php echo $stringdays ?></p>
                                </td>
                                <td>
                                    <p class="text-center" id="ins-form2"><?php echo $res['room_ass'] ?></p>
                                </td>
                                
                        </tr>
                        <?php
                                    }

                                    if($_SESSION['sortyear'] == "" && $_SESSION['sortsem'] == ""){

                        ?>
                        <tr>
                                <td>
                                    <p id="ins-form2"><?php echo $res['subject_title'] ?></p>
                                </td>
                                <td>
                                    <p id="ins-form2"><?php echo $res['start_time'] ?></p>
                                </td>
                                <td>
                                    <p id="ins-form2"><?php echo $res['end_time'] ?></p>
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
                                        if($res['mon']=='mon'){
                                            $m="M";
                                            $stringdays = $stringdays.$m;
                                        }
                                        if($res['tue']=='tue'){
                                            $t="T";
                                            $stringdays = $stringdays.$t;
                                        }
                                        if($res['wed']=='wed'){
                                            $w="W";
                                            $stringdays = $stringdays.$w;
                                        }
                                        if($res['thu']=='thu'){
                                            $th="TH";
                                            $stringdays = $stringdays.$th;
                                        }
                                        if($res['fri']=='fri'){
                                            $f="F";
                                            $stringdays = $stringdays.$f;
                                        }
                                        if($res['sat']=='sat'){
                                            $s="S";
                                            $stringdays = $stringdays.$s;
                                        }
                                        if($res['sun']=='sun'){
                                            $su="SU";
                                            $stringdays = $stringdays.$su;
                                        }
                                    ?>
                                       
                                    <p class="text-center" id="ins-form2"><?php echo $stringdays ?></p>
                                </td>
                                <td>
                                    <p class="text-center" id="ins-form2"><?php echo $res['room_ass'] ?></p>
                                </td>
                                
                        </tr>

                        <?php
                                    }
                                }
                            }
                        ?>
                        
                    </table>
                </div>
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