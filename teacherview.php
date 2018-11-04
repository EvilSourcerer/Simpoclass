<?php
  $conn = mysqli_connect("localhost", "root", "", "main");
  if(isset($_POST['target']))
  {
    $result=mysqli_query($conn,"SELECT teachers FROM students WHERE username=\"" .mysqli_real_escape_string($conn,$_POST['target']). "\"") or die("a");
    echo $_POST['target'];
    $out=mysqli_fetch_array($result);
    $newout=explode(',',$out[0]);
    array_push($newout,$_COOKIE['username']);
    echo "UPDATE students SET teachers=\"" .implode($newout,","). "\" WHERE username=\"";
    $result=mysqli_query($conn,"UPDATE students SET teachers=\"" .implode($newout,","). "\" WHERE username=\"" .$_POST['target']. "\"");
  }
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LoginScreen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body style="background-color: #26324a;">
    <div style="height: 475px;background-color: #26324a;">
        <div class="row no-gutters">
            <div class="col d-flex justify-content-center" style="margin-top: 22px;width: auto;">
                <h1 style="color: rgb(255,255,255);font-size: 27px;font-family: ABeeZee, sans-serif;">Assignments</h1>
            </div>
        </div>
        <div style="height: 80%;color: rgb(255,255,255);background-color: #222d43;width: 90%;margin-left: 5%;margin-top: 1%;"><input type="text" placeholder="Title" style="background-color: rgb(40,53,79);border-style: none;margin-left: 2.5%;width: 95%;margin-top: 2.5%;color: rgb(255,255,255);"><textarea placeholder="Description" style="border-style: none;background-color: rgb(40,53,79);width: 95%;margin-left: 2.5%;height: 50%;margin-top: 1%;color: rgb(255,255,255);"></textarea>
            <input
                type="datetime-local" style="border-style: none;margin-left: 2.5%;width: 95%;background-color: rgb(40,53,79);color: rgb(255,255,255);"><button class="btn btn-primary" type="button" style="margin-top: 15px;margin-left: 2.5%;">Post Announcement</button></div>
    </div>
    <?php
      $conn = mysqli_connect("localhost", "root", "", "main");
      $result=mysqli_query($conn,'SELECT * FROM students WHERE teachers LIKE "%' .$_COOKIE['username']. '%"') or die(mysqli_error($conn));
      while ($student = mysqli_fetch_assoc($result)) {
        echo '<div class="d-flex" style="height: 50px;margin-top: 10px;background-color: #1f2a3e;width: 99%;margin-left: 0.5%;"><div class="d-flex" style="align-items: center;height: 50px;width: auto;margin-left: 11px;"> <h1 style="justify-content: center;font-size: 22px;width: auto;color:white">' .$student['studentname']. '</h1> </div> <div class="d-flex justify-content-center align-items-center align-self-center" style="margin-left: auto;order: 3;height: 50px;width: auto;"><a role="button" class="btn btn-danger" href="deletestudent.php?email=' .$student['username']. '" style="height: auto;margin-right: 10px;width: 39px;"><strong>-</strong></a> <div class="d-flex justify-content-center align-items-center align-self-center" style="margin-left: auto;order: 2;height: 50px;width: auto;"></div> </div>';
      }
   ?>


    <form method="POST"></div><input type="text" name="target" placeholder="Student Email" style="background-color: rgb(40,53,79);border-style: none;margin-left: 0.5%;width: 95%;color: rgb(255,255,255);height: 40px;" /><button class="btn btn-primary" type="submit" style="border-style: none;background-color: rgb(47,126,89);">Add student</button></div></form>
    <div class="card-group" style="height: 300px;margin-top:5px">
    <div class="card">
        <div class="card-body" style="background-color: #2e3d59;">
            <h4 class="card-title" style="color: rgb(255,255,255);">Assignment name</h4>
            <p class="card-text" style="color: rgb(255,255,255);">Assignment Description</p><button class="btn btn-info" type="button" style="margin-right: 12px;">Edit</button><button class="btn btn-danger" type="button">Delete</button></div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
