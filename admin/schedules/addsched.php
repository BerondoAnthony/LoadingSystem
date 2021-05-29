<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['curriculumname'])){

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $query = "SELECT * FROM classes";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['class_id']) == true){
            $currentID = $res['class_id'];
            $yearlvl = $res['year_level'];
            break;
            }
        }

        $status = "Not Approved";
        $curname = $_POST['curriculumname'];
        $semester = $_POST['semester'];
        $sy = $_POST['sy'];
        $draft = "Draft";

        $check = 0;

        $query = "SELECT * FROM schedules";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if($res['semester'] == $semester && $res['curriculum'] == $curname && $res['class_id'] == $currentID && $res['school_year'] == $sy){
                $check=1;
                $_SESSION['modal'] = "error";
                header("Location:../classes/classschedule.php?class_id=$currentID");
            }
        }
        if($check==0){
            $result2 = mysqli_query($dbc, "INSERT INTO schedules(curriculum, semester, status, class_id, school_year, stats) VALUES('$curname','$semester', '$status', '$currentID', '$sy', '$draft')"); 
            
            $last_id = mysqli_insert_id($dbc);
            $query2 = "SELECT * FROM schedules";
            $results2 = mysqli_query($dbc, $query2);
            while($res2 = mysqli_fetch_array($results2)){
                if($res2['sched_id'] == $last_id && $res2['semester'] == $semester && $res2['curriculum'] == $curname && $res2['class_id'] == $currentID){
                    $currentsched = $res2['sched_id'];
                    $currentsem = $res2['semester'];
                    $currentcurr = $res2['curriculum'];
                    break;
                }
            }

            
            $query3 = "SELECT * FROM subjects where year_level = $yearlvl";
            $results3 = mysqli_query($dbc, $query3);
            while($res3 = mysqli_fetch_array($results3)){
                if($res3['semester'] == $semester && $res3['curriculum_id'] == $curname){
                    
                    $subcode= $res3['subject_code'];
                    $subtitle= $res3['subject_name'];
                    $lab = 'LAB';
                    $lec = 'LEC';

                    $result3 = mysqli_query($dbc, "INSERT INTO scheds(subject_code, subject_title, start_time, end_time, ins_ass, insid, room_ass, roomid, schedid, sched_sem, sched_curr, school_year, mon, tue, wed, thu, fri, sat, sun) VALUES('$subcode', '$subtitle $lec', '', '', '', '', '', '', '$currentsched', '$currentsem', '$currentcurr', '$sy', '', '', '', '', '', '', '')");
                    if($res3['hpw_lab'] != 0){
                        $result3 = mysqli_query($dbc, "INSERT INTO scheds( subject_code, subject_title, start_time, end_time, ins_ass, insid, room_ass, roomid, schedid, sched_sem, sched_curr, school_year, mon, tue, wed, thu, fri, sat, sun) VALUES('$subcode', '$subtitle $lab', '', '', '', '', '', '', '$currentsched', '$currentsem', '$currentcurr', '$sy', '', '', '', '', '', '', '')");
                    }
                }
            }
            $_SESSION['modal'] = "successadd";
            header("Location:../classes/classschedule.php?class_id=$currentID");

        }
    };
}
?>