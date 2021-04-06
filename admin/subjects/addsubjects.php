<?php

    include_once("../../connection/connection.php");

    if(isset($_POST['code'])){

        $check=0;

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $query = "SELECT curriculum_id FROM curriculum";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['curriculum_id']) == true){
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
        $semester = $_POST['semester'];
        $year = $_POST['yrlvl'];

        $query2 = "SELECT * FROM subjects";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($code == $res2['subject_code'] && $title == $res2['subject_name'] && $currentID == $res2['curriculum_id']){
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
        
        if($check==0){
            $results3 = mysqli_query($dbc, "INSERT INTO subjects(subject_code, subject_name, subject_units, year_level, hpw_lec, hpw_lab, semester, pre_req, curriculum_id) VALUES('$code','$title', '$units', '$year', '$lec', '$lab', '$semester', '$req', '$currentID')");
           
            if(strpos($fullurl,'year1')){
                header("Location:../curriculum/firstyear.php?curriculum_id=$currentID?year1?successadd");
            }

            if(strpos($fullurl,'year2')){
                header("Location:../curriculum/secondyear.php?curriculum_id=$currentID?year2?successadd");
            }

            if(strpos($fullurl,'year3')){
                header("Location:../curriculum/thirdyear.php?curriculum_id=$currentID?year3?successadd");

            }

            if(strpos($fullurl,'year4')){
                header("Location:../curriculum/fourthyear.php?curriculum_id=$currentID?year4?successadd");

            }
        }

    }

?>