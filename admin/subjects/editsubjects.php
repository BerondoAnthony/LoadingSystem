<?php

    include_once("../../connection/connection.php");

    if(isset($_POST['code'])){

        $check=0;

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $query = "SELECT * FROM subjects";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['subject_id']) == true){
                $subjectID = $res['subject_id'];
                $currentID = $res['curriculum_id'];
                break;
            }
        }

        $code = $_POST['code'];
        $title = $_POST['title'];
        $units = $_POST['units'];
        $lec = $_POST['lec'];
        $lab = $_POST['lab'];
        $req = $_POST['req'];


        $query2 = "SELECT * FROM subjects";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($subjectID != $res2['subject_id']){
                if($code == $res2['subject_code'] && $currentID == $res2['curriculum_id']){
                    if(strpos($fullurl,'year1')){
                        header("Location:../curriculum/firstyear.php?curriculum_id=$currentID?year1?error");
                    }
        
                    if(strpos($fullurl,'year2')){
                        header("Location:../curriculum/secondyear.php?curriculum_id=$currentID?year2?error");
                    }
        
                    if(strpos($fullurl,'year3')){
                        header("Location:../curriculum/thirdyear.php?curriculum_id=$currentID?year3?error");
        
                    }
        
                    if(strpos($fullurl,'year4')){
                        header("Location:../curriculum/fourthyear.php?curriculum_id=$currentID?year4?error");
        
                    }
                    $check = 1;
                    break;
                }
            }
            
        }
        
        if($check==0){
            $result = mysqli_query($dbc, "UPDATE subjects SET subject_code='$code', subject_name='$title', subject_units='$units', hpw_lec='$lec', hpw_lab='$lab', pre_req='$req' WHERE subject_id = '$subjectID'");
            
            if(strpos($fullurl,'year1')){
                header("Location:../curriculum/firstyear.php?curriculum_id=$currentID?year1?successedit");
            }

            if(strpos($fullurl,'year2')){
                header("Location:../curriculum/secondyear.php?curriculum_id=$currentID?year2?successedit");
            }

            if(strpos($fullurl,'year3')){
                header("Location:../curriculum/thirdyear.php?curriculum_id=$currentID?year3?successedit");

            }

            if(strpos($fullurl,'year4')){
                header("Location:../curriculum/fourthyear.php?curriculum_id=$currentID?year4?successedit");

            }
            
        }
    }

?>