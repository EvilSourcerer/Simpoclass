<?php
    if(!isset($_COOKIE['secret']) || !isset($_COOKIE['username']))
    {
      die("Thee shalt not hack thine system!");
    }
    else
    {
      $pass=$_COOKIE['secret'];
      $username=$_COOKIE['username'];
      $conn = mysqli_connect("localhost", "root", "", "main");
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }
      $result=mysqli_query($conn,"SELECT * FROM students WHERE username=\"" .mysqli_real_escape_string($conn,$username). "\"") or die("a");
      $out=mysqli_fetch_array($result);
      if(!password_verify($pass, $out['password']))
      {
        die("You have been caught hacking our systems.\nThis incident has been reported.");
      }
      else {
        if($out['teacher']==1)
        {
          $result=mysqli_query($conn,"SELECT teachers FROM students WHERE username=\"" .mysqli_real_escape_string($conn,$username). "\"") or die("a");
          $out=mysqli_fetch_array($result);
          $newout=explode(',',$out[0]);
          array_push($newout,$_GET['user']);
          $result=mysqli_query($conn,"UPDATE students SET teachers=\"" .implode($newout,","). "\" WHERE username=\"");
          header("Location: teacherview.php");
        }
      }
    }
 ?>
