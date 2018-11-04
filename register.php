
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

<body style="background-color: #222d43;">
    <h1 class="text-center" style="color: rgb(255,255,255);font-size: 27px;">Register for Simpoclass</h1>
    <form method="post" style="margin-top: 64px;">
      <?php
      if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpass']) && isset($_POST['name']))
      {
        if($_POST['password']==$_POST['confirmpass'])
        {
          $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
          $conn = mysqli_connect('db720126575.db.1and1.com', 'dbo720126575', '1ppf2!t7YP84', 'db720126575');
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }
          if(isset($_POST['teacher']))
          {
            $conn = mysqli_connect('db720126575.db.1and1.com', 'dbo720126575', '1ppf2!t7YP84', 'db720126575');
            $result=mysqli_query($conn,"INSERT INTO teacherprofile(name,pfp,email) VALUES(\"" .mysqli_real_escape_string($conn,$_POST['name']). "\",\"https://t3.ftcdn.net/jpg/00/64/67/80/160_F_64678017_zUpiZFjj04cnLri7oADnyMH0XBYyQghG.jpg\",\"" .mysqli_real_escape_string($conn,$_POST['email']). "\")");
            $conn2=mysqli_connect('db720126575.db.1and1.com', 'dbo720126575', '1ppf2!t7YP84', 'db720126575');
            $result=mysqli_query($conn2,"INSERT INTO students(studentname,teachers,username,password,teacher) VALUES(\"" .mysqli_real_escape_string($conn,$_POST['name']). "\", \"\",\"" .mysqli_real_escape_string($conn,$_POST['email']). "\",\"" .$hash. "\",true)") or die(mysqli_error($conn));
            header("Location: index.php");
            echo "Success! Account created!";
          }
          else
          {
            $conn = mysqli_connect('db720126575.db.1and1.com', 'dbo720126575', '1ppf2!t7YP84', 'db720126575');
            $checkemail=mysqli_query($conn,"SELECT * FROM students WHERE email=\"" .mysqli_real_escape_string($conn,$_POST['email']). "\"");
            if(mysqli_num_rows($checkemail)>0)
            {
              echo "<h1>username already exists</h1>";
            }
            $result=mysqli_query($conn,"INSERT INTO students(studentname,teachers,username,password,teacher) VALUES(\"" .mysqli_real_escape_string($conn,$_POST['name']). "\", \"\",\"" .mysqli_real_escape_string($conn,$_POST['email']). "\",\"" .$hash. "\",false)") or die("Unfortunately, the dev team is very sloppy. Please email the following to bluskript@gmail.com : \n1091azkI0\nPOj29ak2k");
            header("Location: index.php");
            echo "Success! Account created!";
          }
        }
        else {
          echo '<div class="row"><div class="col d-flex justify-content-center"><h1 style="color:red;font-size: 16px">Passwords do not match!</h1></div></div>';
        }
      }
       ?>
        <div class="form-row">
            <div class="col d-flex justify-content-center"><input class="form-control" type="text" required="" name="email" placeholder="Email" style="color: rgb(204,240,255);border-style: none;border-bottom: 1px solid rgb(0,255,209);background-color: rgb(29,47,64);width: 32%;"></div>
        </div>
        <div class="form-row">
            <div class="col d-flex justify-content-center" style="margin-top: 10px;"><input class="form-control" name="password" type="password" placeholder="Password" minlength="7" autofocus="" style="background-color: rgb(29,47,64);border-style: none;border-bottom: 1px solid rgb(0,255,209);color: rgb(204,240,255);width: 32%;"></div>
        </div>
        <div class="form-row">
            <div class="col d-flex justify-content-center" style="margin-top: 10px;"><input class="form-control" name="confirmpass" type="password" placeholder="Confirm Password" minlength="7" autofocus="" style="background-color: rgb(29,47,64);border-style: none;border-bottom: 1px solid rgb(0,255,209);color: rgb(204,240,255);width: 32%;"></div>
        </div>
        <div class="form-row">
            <div class="col d-flex justify-content-center" style="margin-top: 10px;"><input class="form-control" name="name" placeholder="First and Last Name" minlength="7" autofocus="" style="background-color: rgb(29,47,64);border-style: none;border-bottom: 1px solid rgb(0,255,209);color: rgb(204,240,255);width: 32%;"></div>
        </div>
        <div class="form-row">
            <div class="col d-flex justify-content-center" style="margin-top: 10px;"><div class="form-check"><input type="checkbox" name="teacher" value="false" class="form-check-input" id="formCheck-1" style="color: rgb(34,45,67);background-color: #2c3a56;" /><label class="form-check-label" for="formCheck-1" style="color: rgb(205,205,205);">Teacher</label></div></div>
        </div>
        <div class="form-row">
            <div class="col d-flex justify-content-center" style="margin-top: 33px;"><button class="btn btn-primary" type="submit" style="border-style: none;background-color: rgb(47,126,89);">Register</button></div>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
