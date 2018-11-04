<?php
function verifynothack()
{
  if(!isset($_COOKIE['secret']) || !isset($_COOKIE['username']))
  {
    die("Thee shalt not hack thine system!");
  }
  else {
    $pass=$_COOKIE['secret'];
    $username=$_COOKIE['username'];
    $conn = mysqli_connect('db720126575.db.1and1.com', 'dbo720126575', '1ppf2!t7YP84', 'db720126575');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $result=mysqli_query($conn,"SELECT * FROM students WHERE username=\"" .mysqli_real_escape_string($conn,$username). "\"");
    $out=mysqli_fetch_array($result);
    if(!password_verify($pass, $out['password']))
    {
      die("You have been caught hacking our systems.\nThis incident has been reported.");
    }
  }
}
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LoginScreen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body style="background-color: #26324a;">
    <div style="background-color: #38486f;height: 90vh;margin-top: 50px;width: 90%;margin-left: 5%;">
        <div class="row">
            <div class="col" style="margin-top: 17px;">
                <h1 class="text-center" style="color: rgb(255,255,255);font-size: 28px;">Students</h1>
            </div>
        </div>
        <?php
            verifynothack();
            $conn = mysqli_connect("localhost", "root", "", "main");
            $query=mysqli_query($conn,'SELECT * FROM students WHERE teachers LIKE "%' .mysqli_real_escape_string($conn,$_COOKIE['username']). '%"') or die(mysqli_error($conn));
            while ($temp = mysqli_fetch_assoc($query)) {
                echo '<div class="d-flex" style="border-top: 1px solid grey;border-bottom: 1px solid grey;height: 50px;margin-top: 10px;"><div class="d-flex" style="align-items: center;height: 50px;width: auto;margin-left: 11px;"> <h1 style="justify-content: center;font-size: 22px;width: auto;color: rgb(255,255,255);">' .$temp['studentname']. '</h1> </div> <div class="d-flex justify-content-center align-items-center align-self-center" style="margin-left: auto;order: 3;height: 50px;width: auto;"><a role="button" href="deletestudent.php?username=' .$temp['username']. '" class="btn btn-danger" style="height: auto;">Remove Student</a> <div class="d-flex justify-content-center align-items-center align-self-center" style="margin-left: auto;order: 2;height: 50px;width: auto;"></div> </div></div>';
            }
         ?>
        <form>
            <div class="form-row">
                <div class="col d-flex" style="width: auto;"><input class="form-control" type="text" style="background-color: rgb(32,40,71);width: 100%;border-style: none;margin-left: 1%;"><button class="btn btn-success" type="button" style="width: auto;">Add Student<i class="fa fa-chevron-right" style="font-size: 16px;margin-left: 13px;"></i></button></div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
