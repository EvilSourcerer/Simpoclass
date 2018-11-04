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
      $conn = mysqli_connect("localhost", "root", "", "main");
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
        <h1 class="text-center" style="color: rgb(255,255,255);font-size: 32px;">Due Soon</h1>
        <?php

              verifynothack();
              $conn = mysqli_connect("localhost", "root", "", "main");
                $result=mysqli_query($conn,"SELECT teachers FROM students WHERE username=\"" .mysqli_real_escape_string($conn,$_COOKIE['username']). "\"");
                $out=mysqli_fetch_array($result);
                $arr=explode(",",$out['teachers']);
                $arr=array_filter($arr, function($value) { return $value !== ''; });
                foreach($arr as &$teacher)
                {
                  $conn=mysqli_connect("localhost", "root", "", "teachers");
                  $result=mysqli_query($conn,"SELECT * FROM teacherprofile WHERE email=\"" .mysqli_real_escape_string($conn,$teacher). "\"");
                  $out=mysqli_fetch_array($result);
                  $assignments=mysqli_query($conn,'SELECT * FROM assignments WHERE owner="' .mysqli_real_escape_string($conn,$teacher). '" AND duedate>NOW()');
                  while ($temp = mysqli_fetch_assoc($assignments)) {
                    echo '<div class="d-flex" style="border-top: 1px solid grey;border-bottom: 1px solid grey;height: 50px;margin-top: 10px;"> <div style="height: 50px;width: 50px;"><img src="' .$out['pfp']. '" width="50px" height="50px" style="width: 50px;height: 50px;" /></div> <div class="d-flex" style="align-items: center;height: 50px;width: auto;margin-left: 11px;"> <h1 style="justify-content: center;font-size: 22px;width: auto;color: rgb(255,255,255);">' .$out['name']. '</h1> </div> <div class="d-flex justify-content-center align-items-center align-self-center" style="align-self: center;align-items: center;height: 50px;width: auto;margin-left: 10px;"> <h1 style="justify-content: center;font-size: 15px;width: auto;margin-top: 4px;color: rgb(255,255,255);">' .$temp['title']. '</h1> </div> <div class="d-flex justify-content-center align-items-center align-self-center" style="align-self: center;align-items: center;height: 50px;width: auto;margin-left: 10px;"> <h1 style="justify-content: center;font-size: 15px;width: auto;margin-top: 4px;color: rgb(160,160,160);">' .$temp['description']. '</h1> </div> <div class="d-flex justify-content-center align-items-center align-self-center" style="margin-left: auto;order: 3;height: 50px;width: auto;"><button class="btn btn-primary" type="button" style="height: auto;">View Assignment</button> <div class="d-flex justify-content-center align-items-center align-self-center" style="margin-left: auto;order: 2;height: 50px;width: auto;"> <h1 style="justify-content: center;font-size: 13px;width: auto;margin-top: 4px;color: rgb(167,167,167);margin-left: 10px;">Due on ' .$temp['duedate']. '</h1> </div> </div> </div>';
                  }

                }
                if(count($arr)==0)
                {
                  echo '<h1 class="text-center" style="color:white">No assignments due soon!</h1>';
                }

         ?>
    </div>
    <div style="background-color: #38486f;height: auto;margin-top: 50px;width: 90%;margin-left: 5%;">
        <h1 class="text-center" style="color: rgb(255,255,255);font-size: 32px;">Your Classes</h1>
        <section>

            <div class="container">
              <div class="row">
              <?php
              verifynothack();
              $conn=mysqli_connect("localhost", "root", "", "main");
              $result=mysqli_query($conn,"SELECT teachers FROM students WHERE username=\"" .mysqli_real_escape_string($conn,$_COOKIE['username']). "\"") or die(mysqli_error($conn));
              $out=mysqli_fetch_array($result);
              $arr=explode(",",$out['teachers']);
              $arr=array_filter($arr, function($value) { return $value !== ''; });
              foreach($arr as &$teacher)
              {
                $conn=mysqli_connect("localhost", "root", "", "teachers");
                $result=mysqli_query($conn,"SELECT name FROM teacherprofile WHERE email=\"" .mysqli_real_escape_string($conn,$teacher). "\"");
                $out=mysqli_fetch_array($result);
                $result2=mysqli_query($conn,'SELECT title FROM assignments WHERE owner="' .mysqli_real_escape_string($conn,$teacher). '"');
                $out2=mysqli_fetch_array($result2);
                echo '<div class="col-lg-4"> <div class="card mb-4 box-shadow rounded-0" style="background-color: rgb(44,59,88);"> <div class="card-body"> <h4 class="card-title" style="color: rgb(255,255,255);">' .$out[0]. '</h4> <h6 class="text-muted card-subtitle mb-2"></h6> <p class="card-text" style="color: rgb(255,255,255);">Latest Assignment : ' .$out2[0]. '</p><button class="btn btn-success" type="button">View Assignments<i class="fa fa-chevron-right" style="font-size: 16px;margin-left: 13px;"></i></button></div> </div> </div>';
              }
               ?>
               </div>
            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
