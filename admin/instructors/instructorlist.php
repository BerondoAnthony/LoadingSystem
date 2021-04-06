<!doctype html>
<html lang="en">

  <head>
    <title>Instructor List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./inslist.css">
    <link rel="icon" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  </head>

  <body>

    <?php
      include_once("../../connection/connection.php");
      include_once("../../reusables/navbar.php");
      include_once("../../reusables/margin.php");
      
    ?>  
    <div  class="pt-2 pl-1 pr-1 pb-5" id="container">
        
        <div class="text-center p-4">
            <h2 class="mt-5">Instructors</h2>
        </div>

        <div class="pt-2 pl-1 pr-1 pb-5 row justify-content-center">
        
            <table class="table table-bordered w-75 " id="list">
                            
                <tr class="bg-dark text-white" id="label-header">
                    <th class="font-weight-bold text-center font-weight-light" id="">Username</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Password</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Role</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Status</th>
                    <th class="font-weight-bold text-center font-weight-light" id="">Actions</th>
                </tr>

                <?php
                    $query = "SELECT * FROM users";
                    $results = mysqli_query($dbc, $query);
                    while($res = mysqli_fetch_array($results)){
                        if($res['user_type'] == "Instructor"){
                ?>
                <tr class="" id="">
                    <td class="font-weight-bold" id="">
                        <input class="font-weight-bold text-center" type="text" value="<?php echo $res['username']?>" id="form-fill" disabled>
                    </td>
                    <td class="font-weight-bold text-center" id="">
                        <input class="font-weight-bold text-center" type="text" value="<?php echo $res['password']?>" id="form-fill" disabled>
                    </td>
                    <td class="font-weight-bold text-center" id="">
                        <input class="font-weight-bold text-center" type="text" value="<?php echo $res['user_type']?>" id="form-fill" disabled>
                    </td>
                    <td class="font-weight-bold text-center" id="">
                        <input class="font-weight-bold text-center" type="text" value="<?php echo $res['user_status']?>" id="form-fill" disabled>
                    </td>
                    <td class="font-weight-bold text-center">
                        <a href="./instructorpage.php?user_id=<?php echo $res['user_id']?>" class="btn text-success btn-sm" id="action-btn">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="../users/deleteuser.php?user_id=<?php echo $res['user_id']?>?insList" class="btn text-danger btn-sm" id="action-btn">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
                        }
                    }
            
                ?>
            </table>
        
        </div>
      
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

</html>