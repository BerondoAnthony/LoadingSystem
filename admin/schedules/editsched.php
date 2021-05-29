<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['user_type'])){
    include_once("../../connection/connection.php");

    if(isset($_POST['subjects'])){

        $check=0;

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
        $query = "SELECT * FROM scheds";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if(strpos($fullurl,$res['sched_id']) == true){
                $schedsID = $res['sched_id'];
                $schedsget = $res['schedid'];
            }
        }

        $query = "SELECT * FROM schedules";
        $results = mysqli_query($dbc, $query);
        while($res = mysqli_fetch_array($results)){
            if($schedsget == $res['sched_id']){
                $curID = $res['sched_id'];
                $sy = $res['school_year'];
                $classID = $res['class_id'];
                $sem = $res['semester'];
            }
        }

        $dmon = '';
        $dtue = '';
        $dwed = '';
        $dthu = '';
        $dfri = '';
        $dsat = '';
        $dsun = '';

        $indexchecki = 0;
        $indexcheckr = 0;

        $imon = '';
        $itue = '';
        $iwed = '';
        $ithu = '';
        $ifri = '';
        $isat = '';
        $isun = '';

        $rmon = '';
        $rtue = '';
        $rwed = '';
        $rthu = '';
        $rfri = '';
        $rsat = '';
        $rsun = '';

        $inscheck = 0;
        $roomcheck = 0;
        $schedcheck = 0;
        $startoverwrite = 0;
        $endoverwrite = 0;
        $insoverwrite = 0;
        $roomoverwrite = 0;
        $monoverwrite = 0;
        $tueoverwrite = 0;
        $wedoverwrite = 0;
        $thuoverwrite = 0;
        $frioverwrite = 0;
        $satoverwrite = 0;
        $sunoverwrite = 0;

        $dcrmon = 0;
        $dcrtue = 0;
        $dcrwed = 0;
        $dcrthu = 0;
        $dcrfri = 0;
        $dcrsat = 0;
        $dcrsun = 0;

        $dcimon = 0;
        $dcitue = 0;
        $dciwed = 0;
        $dcithu = 0;
        $dcifri = 0;
        $dcisat = 0;
        $dcisun = 0;
        
        $ins_id ="";
        $room_id ="";

        $code = $_POST['code'];
        $subject = $_POST['subjects'];
        $start = $_POST['start_time'];
        $end = $_POST['end_time'];
        $dmon = $_POST['mon'];
        $dtue = $_POST['tue'];
        $dwed = $_POST['wed'];
        $dthu = $_POST['thu'];
        $dfri = $_POST['fri'];
        $dsat = $_POST['sat'];
        $dsun = $_POST['sun'];
        $ins = $_POST['instructor'];
        $room = $_POST['room'];

         

        if($start == "empty"){
            $start="";
        }
        if($end == "empty"){
            $end="";
        }
        if($ins == "empty"){
            $ins="";
        }
        if($room == "empty"){
            $room="";
        }

        if($start == ""){
            $query1 = "UPDATE scheds SET start_time='$start' where sched_id='$schedsID'";
            $results1 = mysqli_query($dbc,$query1);
            $query2 = "UPDATE ins_scheds SET start_time='$start' where sched_ref='$schedsID'";
            $results2 = mysqli_query($dbc,$query2);
            $query3 = "UPDATE room_scheds SET start_time='$start' where sched_ref='$schedsID'";
            $results3 = mysqli_query($dbc,$query3);
            $startoverwrite = 1;
        }
        if($end == ""){
            $query1 = "UPDATE scheds SET end_time='$end' where sched_id='$schedsID'";
            $results1 = mysqli_query($dbc,$query1);
            $query2 = "UPDATE ins_scheds SET end_time='$end' where sched_ref='$schedsID'";
            $results2 = mysqli_query($dbc,$query2);
            $query3 = "UPDATE room_scheds SET end_time='$end' where sched_ref='$schedsID'";
            $results3 = mysqli_query($dbc,$query3);
            $endoverwrite = 1;
        }
        if($ins == ""){
            $query1 = "UPDATE scheds SET ins_ass='$ins', insid='$ins' where sched_id='$schedsID'";
            $results1 = mysqli_query($dbc,$query1);
            $query2 = "UPDATE ins_scheds SET insid='$ins' where sched_ref='$schedsID'";
            $results2 = mysqli_query($dbc,$query2);
            $insoverwrite = 1;
        }
        if($room == ""){
            $query1 = "UPDATE scheds SET room_ass='$room', roomid='$room' where sched_id='$schedsID'";
            $results1 = mysqli_query($dbc,$query1);
            $query2 = "UPDATE room_scheds SET roomid='$room' where sched_ref='$schedsID'";
            $results2 = mysqli_query($dbc,$query2);
            $roomoverwrite = 1;
        }

        $dothisI ="ADD";
        $dothisR ="ADD";

        $query2 = "SELECT * FROM instructors";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($ins == $res2['full_name']){
                $ins_id = $res2['ins_id'];
                break;
            }
        }

        $query2 = "SELECT * FROM rooms";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($room == $res2['room_full']){
                $room_id = $res2['room_id'];
                break;
            }
        }


        $query2 = "SELECT * FROM instructors";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($ins == $res2['full_name']){
                $specificins = $res2['ins_id'];
                break;
            }
        }

        $query2 = "SELECT * FROM rooms";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($room == $res2['room_full']){
                $specificroom = $res2['room_id'];
                break;
            }
        }

        $assigni = $ins_id;
        $assignr = $room_id;


        $query2 = "SELECT * FROM time_stamps";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($start == $res2['time_name']){
                $indexstart = $res2['time_id'];
            }
            if($end == $res2['time_name']){
                $indexend = $res2['time_id'];
            }
        }

        // CHECKING START

        $query2 = "SELECT * FROM room_scheds";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($start == $res2['start_time'] && $sy == $res2['school_year'] && $sem == $res2['room_semester'] && $schedsID != $res2['sched_ref'] && $assigni == $res2['insass']){
                if($startoverwrite == 0){
                    if($dmon != ""){
                        if($dmon == $res2['mon']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrmon = 1;
                                    break;
                                
                            }
                        }
                    }
                    if($dtue != ""){
                        if($dtue == $res2['tue']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrtue = 1;
                                    break;
                                
                            }
                        }
                    }
                    if($dwed != ""){
                        if($dwed == $res2['wed']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrwed = 1;
                                    break;
                                
                            }
                            
                        }
                    }
                    if($dthu != ""){
                        if($dthu == $res2['thu']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrthu = 1;
                                    break;
                                
                            }
                        }
                    }
                    if($dfri != ""){
                        if($dfri == $res2['fri']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrfri = 1;
                                    break;
                                
                            }  
                        }
                    }
                    if($dsat != ""){
                        if($dsat == $res2['sat']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrsat = 1;
                                    break;
                            }
                        }
                    }
                    if($dsun != ""){
                        if($dsun == $res2['sun']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrsun = 1;
                                    break;
                            }
                        }
                    }
                } 
            }

            if($end == $res2['end_time'] && $sy == $res2['school_year'] && $sem == $res2['room_semester'] && $schedsID != $res2['sched_ref'] && $assigni == $res2['insass']){
                if($endoverwrite == 0){
                    if($dmon != ""){
                        if($dmon == $res2['mon']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrmon = 1;
                                    break;
                                
                            }
                        }
                    }
                    if($dtue != ""){
                        if($dtue == $res2['tue']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrtue = 1;
                                    break;
                                
                            }
                        }
                    }
                    if($dwed != ""){
                        if($dwed == $res2['wed']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrwed = 1;
                                    break;
                                
                            }
                            
                        }
                    }
                    if($dthu != ""){
                        if($dthu == $res2['thu']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrthu = 1;
                                    break;
                                
                            }
                        }
                    }
                    if($dfri != ""){
                        if($dfri == $res2['fri']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrfri = 1;
                                    break;
                                
                            }  
                        }
                    }
                    if($dsat != ""){
                        if($dsat == $res2['sat']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrsat = 1;
                                    break;
                            }
                        }
                    }
                    if($dsun != ""){
                        if($dsun == $res2['sun']){
                            if($schedsID != $res2['sched_ref']){
                                    $dcrsun = 1;
                                    break;
                            }
                        }
                    }
                }
            }
        }
        


        $query2 = "SELECT * FROM ins_scheds";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($start == $res2['start_time'] && $sy == $res2['school_year'] && $sem == $res2['ins_semester'] && $schedsID != $res2['sched_ref'] && $assignr == $res2['roomass']){
                if($startoverwrite == 0){
                    if($dmon != ""){
                        if($dmon == $res2['mon']){
                            if($schedsID != $res2['sched_ref']){
                                $dcimon = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dtue != ""){
                        if($dtue == $res2['tue']){
                            if($schedsID != $res2['sched_ref']){
                                $dcitue = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dwed != ""){
                        if($dwed == $res2['wed']){
                            if($schedsID != $res2['sched_ref']){
                                $dciwed = 1;
                                break;
                                
                            }
                            
                        }
                    }
                    if($dthu != ""){
                        if($dthu == $res2['thu']){
                            if($schedsID != $res2['sched_ref']){
                                $dcithu = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dfri != ""){
                        if($dfri == $res2['fri']){
                            if($schedsID != $res2['sched_ref']){
                                $dcifri = 1;
                                break;
                                
                            }  
                        }
                    }
                    if($dsat != ""){
                        if($dsat == $res2['sat']){
                            if($schedsID != $res2['sched_ref']){
                                $dcisat = 1;
                                break;
                            }
                        }
                    }
                    if($dsun != ""){
                        if($dsun == $res2['sun']){
                            if($schedsID != $res2['sched_ref']){
                                $dcisun = 1;
                                break;
                            }
                        }
                    }
                }
            }
            if($end == $res2['end_time'] && $sy == $res2['school_year'] && $sem == $res2['ins_semester'] && $schedsID != $res2['sched_ref'] && $assignr == $res2['roomass']){
                if($endoverwrite == 0){
                    if($dmon != ""){
                        if($dmon == $res2['mon']){
                            if($schedsID != $res2['sched_ref']){
                                $dcimon = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dtue != ""){
                        if($dtue == $res2['tue']){
                            if($schedsID != $res2['sched_ref']){
                                $dcitue = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dwed != ""){
                        if($dwed == $res2['wed']){
                            if($schedsID != $res2['sched_ref']){
                                $dciwed = 1;
                                break;
                                
                            }
                            
                        }
                    }
                    if($dthu != ""){
                        if($dthu == $res2['thu']){
                            if($schedsID != $res2['sched_ref']){
                                $dcithu = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dfri != ""){
                        if($dfri == $res2['fri']){
                            if($schedsID != $res2['sched_ref']){
                                $dcifri = 1;
                                break;
                                
                            }  
                        }
                    }
                    if($dsat != ""){
                        if($dsat == $res2['sat']){
                            if($schedsID != $res2['sched_ref']){
                                $dcisat = 1;
                                break;
                            }
                        }
                    }
                    if($dsun != ""){
                        if($dsun == $res2['sun']){
                            if($schedsID != $res2['sched_ref']){
                                $dcisun = 1;
                                break;
                            }
                        }
                    }
                }
            }
            
        }


        $query2 = "SELECT * FROM ins_scheds";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($res2['sched_ref'] == $schedsID){
                $dothisI = "EDIT";
                break;
            }
            else{
                $dothisI = "ADD";
            }
        }

        $query2 = "SELECT * FROM room_scheds";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($res2['sched_ref'] == $schedsID ){
                $dothisR = "EDIT";
                break;
            }
            else{
                $dothisR = "ADD";
            }
        }

        //CHECK VALUE END

        //TIME INDEX

        $query2 = "SELECT * FROM ins_scheds";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($indexstart > $res2['indexstart'] && $indexstart < $res2['indexend']  && $sy == $res2['school_year'] && $sem == $res2['ins_semester'] && $assignr == $res2['roomass']){
                
                    if($dmon != ""){
                        if($dmon == $res2['mon']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dtue != ""){
                        if($dtue == $res2['tue']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dwed != ""){
                        if($dwed == $res2['wed']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }
                            
                        }
                    }
                    if($dthu != ""){
                        if($dthu == $res2['thu']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dfri != ""){
                        if($dfri == $res2['fri']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }  
                        }
                    }
                    if($dsat != ""){
                        if($dsat == $res2['sat']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                            }
                        }
                    }
                    if($dsun != ""){
                        if($dsun == $res2['sun']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                            }
                        }
                    }
                
            }
            if($indexend > $res2['indexstart'] && $indexend < $res2['indexend']  && $sy == $res2['school_year'] && $sem == $res2['ins_semester'] && $assignr == $res2['roomass']){
                
                    if($dmon != ""){
                        if($dmon == $res2['mon']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dtue != ""){
                        if($dtue == $res2['tue']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dwed != ""){
                        if($dwed == $res2['wed']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }
                            
                        }
                    }
                    if($dthu != ""){
                        if($dthu == $res2['thu']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }
                        }
                    }
                    if($dfri != ""){
                        if($dfri == $res2['fri']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                                
                            }  
                        }
                    }
                    if($dsat != ""){
                        if($dsat == $res2['sat']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                            }
                        }
                    }
                    if($dsun != ""){
                        if($dsun == $res2['sun']){
                            if($schedsID != $res2['sched_ref']){
                                $indexcheckr = 1;
                                break;
                            }
                        }
                    }
                
            }
        }

        
        $query2 = "SELECT * FROM room_scheds";
        $results2 = mysqli_query($dbc, $query2);
        while($res2 = mysqli_fetch_array($results2)){
            if($indexstart > $res2['indexstart'] && $indexstart < $res2['indexend']  && $sy == $res2['school_year'] && $sem == $res2['room_semester'] && $assigni == $res2['insass']){

                    if($dmon != ""){
                        if($dmon == $res2['mon']){
                            if($schedsID != $res2['sched_ref']){
                                $indexchecki = 1;
                                    break;
                                
                            }
                        }
                    }
                    if($dtue != ""){
                        if($dtue == $res2['tue']){
                            if($schedsID != $res2['sched_ref']){
                                $indexchecki = 1;
                                    break;
                                
                            }
                        }
                    }
                    if($dwed != ""){
                        if($dwed == $res2['wed']){
                            if($schedsID != $res2['sched_ref']){
                                $indexchecki = 1;
                                    break;
                                
                            }
                            
                        }
                    }
                    if($dthu != ""){
                        if($dthu == $res2['thu']){
                            if($schedsID != $res2['sched_ref']){
                                $indexchecki = 1;
                                    break;
                                
                            }
                        }
                    }
                    if($dfri != ""){
                        if($dfri == $res2['fri']){
                            if($schedsID != $res2['sched_ref']){
                                $indexchecki = 1;
                                    break;
                                
                            }  
                        }
                    }
                    if($dsat != ""){
                        if($dsat == $res2['sat']){
                            if($schedsID != $res2['sched_ref']){
                                $indexchecki = 1;
                                    break;
                            }
                        }
                    }
                    if($dsun != ""){
                        if($dsun == $res2['sun']){
                            if($schedsID != $res2['sched_ref']){
                                $indexchecki = 1;
                                    break;
                            }
                        }
                    }
                
            }
            if($indexend > $res2['indexstart'] && $indexend < $res2['indexend']  && $sy == $res2['school_year'] && $sem == $res2['room_semester'] && $assigni == $res2['insass']){

                if($dmon != ""){
                    if($dmon == $res2['mon']){
                        if($schedsID != $res2['sched_ref']){
                            $indexchecki = 1;
                                break;
                            
                        }
                    }
                }
                if($dtue != ""){
                    if($dtue == $res2['tue']){
                        if($schedsID != $res2['sched_ref']){
                            $indexchecki = 1;
                                break;
                            
                        }
                    }
                }
                if($dwed != ""){
                    if($dwed == $res2['wed']){
                        if($schedsID != $res2['sched_ref']){
                            $indexchecki = 1;
                                break;
                            
                        }
                        
                    }
                }
                if($dthu != ""){
                    if($dthu == $res2['thu']){
                        if($schedsID != $res2['sched_ref']){
                            $indexchecki = 1;
                                break;
                            
                        }
                    }
                }
                if($dfri != ""){
                    if($dfri == $res2['fri']){
                        if($schedsID != $res2['sched_ref']){
                            $indexchecki = 1;
                                break;
                            
                        }  
                    }
                }
                if($dsat != ""){
                    if($dsat == $res2['sat']){
                        if($schedsID != $res2['sched_ref']){
                            $indexchecki = 1;
                                break;
                        }
                    }
                }
                if($dsun != ""){
                    if($dsun == $res2['sun']){
                        if($schedsID != $res2['sched_ref']){
                            $indexchecki = 1;
                                break;
                        }
                    }
                }
            
        }
                
        }
        

        //TIME INDEX
        
        if($dothisI == "EDIT" && $dothisR == "EDIT"){

            if($inscheck == 0 && $dcimon == 0 && $dcitue == 0 && $dciwed == 0 && $dcithu == 0 && $dcifri == 0 && $dcisat == 0 && $dcisun == 0 && $dcrmon == 0 && $dcrtue == 0 && $dcrwed == 0 && $dcrthu == 0 && $dcrfri == 0 && $dcrsat == 0 && $dcrsun == 0){
                $query3 = "UPDATE ins_scheds SET start_time='$start', end_time='$end', insid='$ins_id', mon='$dmon', tue='$dtue', wed='$dwed', thu='$dthu', fri='$dfri', sat='$dsat', sun='$dsun', roomass='$assignr', indexstart='$indexstart', indexend='$indexend' where sched_ref='$schedsID'";
                $results = mysqli_query($dbc,$query3);
            }
            if($roomcheck == 0 && $dcimon == 0 && $dcitue == 0 && $dciwed == 0 && $dcithu == 0 && $dcifri == 0 && $dcisat == 0 && $dcisun == 0 && $dcrmon == 0 && $dcrtue == 0 && $dcrwed == 0 && $dcrthu == 0 && $dcrfri == 0 && $dcrsat == 0 && $dcrsun == 0){
                $query4 = "UPDATE room_scheds SET start_time='$start', end_time='$end', roomid='$room_id', mon='$dmon', tue='$dtue', wed='$dwed', thu='$dthu', fri='$dfri', sat='$dsat', sun='$dsun', insass='$assigni', indexstart='$indexstart', indexend='$indexend' where sched_ref='$schedsID'";
                $results2 = mysqli_query($dbc,$query4);
            }

        }
        
        if($dothisI == "ADD" && $dothisR == "ADD"){
            if($inscheck == 0 && $roomcheck == 0 && $dcimon == 0 && $dcitue == 0 && $dciwed == 0 && $dcithu == 0 && $dcifri == 0 && $dcisat == 0 && $dcisun == 0 && $dcrmon == 0 && $dcrtue == 0 && $dcrwed == 0 && $dcrthu == 0 && $dcrfri == 0 && $dcrsat == 0 && $dcrsun == 0){
                $results3 = mysqli_query($dbc, "INSERT INTO ins_scheds(start_time, end_time, class_assigned_id, school_year, ins_semester, insid, sched_ref, main_sched, mon, tue, wed, thu, fri, sat, sun, roomass, indexstart, indexend) VALUES('$start', '$end', '$classID', '$sy', '$sem', '$ins_id', '$schedsID', '$schedsget', '$dmon', '$dtue', '$dwed', '$dthu', '$dfri', '$dsat', '$dsun', '$assignr', '$indexstart', '$indexend')");
                $results4 = mysqli_query($dbc, "INSERT INTO room_scheds(start_time, end_time, class_assigned_id, school_year, room_semester, roomid, sched_ref, main_sched, mon, tue, wed, thu, fri, sat, sun, insass, indexstart, indexend) VALUES('$start', '$end', '$classID', '$sy', '$sem', '$room_id', '$schedsID', '$schedsget', '$dmon', '$dtue', '$dwed', '$dthu', '$dfri', '$dsat', '$dsun', '$assigni', '$indexstart', '$indexend')");
            }
        }

        if($inscheck == 0 && $roomcheck == 0 && $dcimon == 0 && $dcitue == 0 && $dciwed == 0 && $dcithu == 0 && $dcifri == 0 && $dcisat == 0 && $dcisun == 0 && $dcrmon == 0 && $dcrtue == 0 && $dcrwed == 0 && $dcrthu == 0 && $dcrfri == 0 && $dcrsat == 0 && $dcrsun == 0 && $indexchecki == 0 && $indexcheckr == 0){

            $query3 = "UPDATE scheds SET start_time='$start', end_time='$end', ins_ass='$ins', insid='$specificins', room_ass='$room', roomid='$specificroom', mon='$dmon', tue='$dtue', wed='$dwed', thu='$dthu', fri='$dfri', sat='$dsat', sun='$dsun' where sched_id='$schedsID'";
            $results = mysqli_query($dbc,$query3);
            $_SESSION['modal'] = "successedit";
            header("Location:./schedulelist.php?sched_id=$schedsget");
        }
        if($roomcheck != 0 || $inscheck != 0 || $dcimon != 0 || $dcitue != 0 || $dciwed != 0 || $dcithu != 0 || $dcifri != 0 || $dcisat != 0 || $dcisun != 0 || $dcrmon != 0 || $dcrtue != 0 || $dcrwed != 0 || $dcrthu != 0 || $dcrfri != 0 || $dcrsat != 0 || $dcrsun != 0 || $indexchecki != 0 || $indexcheckr != 0){
            $_SESSION['modal'] = "error";
            header("Location:./schedulelist.php?sched_id=$schedsget");
        
        }
        
        echo $dcimon."----";
        echo $dcitue."----";
        echo $dciwed."----";
        echo $dcithu."----";
        echo $dcifri."----";
        echo $dcisat."----";
        echo $dcisun."----";
        echo $dcrmon."----";
        echo $dcrtue."----";
        echo $dcrwed."----";
        echo $dcrthu."----";
        echo $dcrfri."----";
        echo $dcrsat."----";
        echo $dcrsun."----";
        echo $indexchecki."----";
        echo $indexcheckr."----";

    }
}
?>