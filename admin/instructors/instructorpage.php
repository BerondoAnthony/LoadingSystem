<!doctype html>
<html lang="en">

  <head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./inspage.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    </head>

  <body>
    <?php
      include_once("../../connection/connection.php");
      include_once("../../reusables/navbar.php");
      include_once("../../reusables/margin.php");
      $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      
    ?>  

    <div class="pl-2 pt-2" id="container">

        <div class="row" id="profile">
            <div id="profile-picture">
                <img class="mt-3 ml-5 mb-5 mr-3" src="../../assets/images/pppholder.png" alt="">
            </div>
            
            <div class="ml-3 mb-3" id="profile-info">

                <?php
                    $query = "SELECT * FROM users";
                    $results = mysqli_query($dbc, $query);
                    while($res = mysqli_fetch_array($results)){
                        if(strpos($fullurl,$res['user_id']) == true){
                            $currentID = $res['user_id'];
                            break;
                        }
                    }
                    
                    $query2 = "SELECT * FROM instructor_info";
                    $results2 = mysqli_query($dbc, $query2);
                    while($res2 = mysqli_fetch_array($results2)){
                        if($res2['user_id'] == "$currentID"){
                ?>

                <form class="mt-3" action="./insinfo.php?user_id=<?php echo "$currentID"?>" method=POST>
                    <div>
                        <label class="" id="labels">Name:</label>
                        <input type="text" class="" value="<?php echo $res2['ins_name']?>" name="nameform" id="form-fill">
                    </div>
                    <div>
                        <label class="" id="labels">Address:</label>
                        <input type="text" class="" value="<?php echo $res2['ins_address']?>" name="addressform" id="form-fill">
                    </div>
                    <div>
                        <label class="" id="labels">Age:</label>
                        <input type="text" class="" value="<?php echo $res2['ins_age']?>" name="ageform" id="form-fill">
                    </div>
                    <div>
                        <label class="" id="labels">Major:</label>
                        <input type="text" class="" value="<?php echo $res2['ins_major']?>" name="majorform" id="form-fill">
                    </div>
                    <div>
                        <label class="" id="labels">Email:</label>
                        <input type="text" class="" value="<?php echo $res2['ins_email']?>" name="mailform" id="form-fill">
                    </div>
                    <div>
                        <label class="" id="labels">Number:</label>
                        <input type="text" class="" value="<?php echo $res2['ins_no']?>" name="noform" id="form-fill">
                    </div>
                    <input class="btn btn-primary" id="optbtn" type="submit" value="Save">
                </form>

                <?php
                        }
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