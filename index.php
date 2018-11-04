
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LoginScreen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">

</head>

<body>
    <div class="jumbotron" style="width: auto;height: 100vh;background-color: rgb(41,64,109);margin-bottom: 0px;">
        <h1 class="text-center" style="color: rgb(255,255,255);font-size: 27px;">Welcome to Simpoclass</h1>
        <form method="post" style="margin-top: 64px;">
          <?php
            if(isset($_POST['email']))
            {
              if(isset($_POST['password']))
              {

                $conn = mysqli_connect('db720126575.db.1and1.com', 'dbo720126575', '1ppf2!t7YP84', 'db720126575');
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $result=mysqli_query($conn,"SELECT * FROM students WHERE username=\"" .mysqli_real_escape_string($conn,$_POST['email']). "\"");

                $out=mysqli_fetch_array($result);
                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                if(!password_verify($_POST['password'], $out['password']))
                {
                  echo '<div class="row"><div class="col d-flex justify-content-center"><h1 style="color:red;font-size: 16px">Wrong Username or Password</h1></div></div>';
                }
                else {
                  if($out['teacher']==1)
                  {

                    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    setcookie("secret",$_POST['password'],time() + (86400 * 30),"/");
                    setcookie("username",$_POST['email'],time() + (86400 * 30),"/");
                    header("Location: teacherview.php");
                  }
                  else {
                    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    setcookie("secret",$_POST['password'],time() + (86400 * 30),"/");
                    setcookie("username",$_POST['email'],time() + (86400 * 30),"/");
                    header("Location: view.php");
                  }
                }
              }

            }
           ?>
            <div class="form-row">
                <div class="col d-flex justify-content-center"><input class="form-control" type="text" required="" name="email" placeholder="Email" style="color: rgb(204,240,255);border-style: none;border-bottom: 1px solid rgb(0,255,209);background-color: rgb(29,47,64);width: 32%;"></div>
            </div>
            <div class="form-row">
                <div class="col d-flex justify-content-center" style="margin-top: 10px;"><input class="form-control" type="password" name="password" placeholder="Password" minlength="7" autofocus="" style="background-color: rgb(29,47,64);border-style: none;border-bottom: 1px solid rgb(0,255,209);color: rgb(204,240,255);width: 32%;"></div>
            </div>
            <div class="form-row">
                <div class="col d-flex justify-content-center" style="margin-top: 33px;"><button class="btn btn-primary" type="submit" style="border-style: none;background-color: rgb(47,126,89);">Login</button></div>
            </div>
        </form>

        <div class="row">
            <div class="col d-flex justify-content-center"><a href="register.php" style="color: rgb(140,140,140);height: 22px;">Register</a></div>
        </div>
    </div>
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 item text">
                        <h3>Bluskript</h3>
                        <p>Sometimes we make good services.</p>
                    </div>
                </div>
                <p class="copyright">Bluskript © 2017</p>
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
