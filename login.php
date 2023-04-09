<!DOCTYPE html>

<html>
<head>
    <title>Surgery Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container login-container">
<h3>Surgery Tracker</h3><br>
    <div class="row">
        <div class="col-md-6">
            <h4>Login</h4>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name = "email" placeholder="Email" value="" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name = "password" placeholder="Password" value="" />
                </div><br>
                
                <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Login" />
                </div>
                <div class="form-group">
                    <a href="forgotpw.php" name="forgo" class="ForgetPwd">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

<?php
    include("config.php");
    session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
        
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        
        //$procID = mysqli_real_escape_string($conn,$_POST['procID']);
        
        $sql = "SELECT * FROM patient WHERE email = '$email' and pw = '$password'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        //$active = $row['active'];
        
        $count = mysqli_num_rows($result);
        
        
        // If result matched $email and $password, table row must be 1 row
		
        if($count == 1) {
         //session_register("myusername");
            $fname = $row["fname"];
            $pID = $row["pID"];
            $_SESSION['pID'] = $pID;
            $_SESSION['fname'] = $fname;
            $_SESSION['email'] = $email;
            $error = "";
         
            header("location: index.php");
        }else {
            echo "Your Login Email or Password is invalid";
      }
   }

?>
</div>
</body>
</html>