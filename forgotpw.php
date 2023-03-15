<DOCTYPE html>
<?php
    include("config.php");
    session_start();

       // the forgot password message
       $msg = "Your password is " . $password;

       // send email
       if(isset($_POST['sendpw'])) {
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $sql = "SELECT * FROM patient WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $password = $row["pw"];
            mail($email,"Forgot Password",$msg);
       }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <div class="container login-container">
    <div class="row">
        <div class="col-md-6">
            <h3>Enter your email</h3>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name = "email" placeholder="Email" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" name = "sendpw" class="btnSubmit" value="Send Email" />
                </div>
            </form>
            <?php if(isset($_POST['sendpw'])) {
                echo "Password email sent";
            }
            ?>
            <a href="login.php" role="button" class="btn btn-info">Return to Login</a>    
        </div>
    </div>
    </div>
    </body>
</html>    