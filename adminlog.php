<!DOCTYPE html>

<html>
<head>
    <title>Surgery Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container login-container">
<h3>Surgery Tracker Control Panel</h3><br>
    <div class="row">
        <div class="col-md-6">
            <h4>Admin Login</h4>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name = "username" placeholder="Username" value="" />
                </div>
                <div class="form-group">
                    <label for="pw">Password:</label><br>
                    <input type="password" id="password" name="password" placeholder="****" value="">
                </div><br>
                
                <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Login" />
                </div>
            </form>
        </div>
    </div>

    <?php
    include("config.php");
    session_start();
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
        
        $user = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        $sql = "SELECT * FROM admin WHERE username = '$user' and password = '$password'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);
        // If result matched $email and $password, table row must be 1 row

        if($count == 1) {
            //session_register("myusername");
               $_SESSION['adminID'] = $adminID;
               $_SESSION['username'] = $username;
               $error = "";
            
               header("location: control.php");
           }else {
               echo "Your Login Email or Password is invalid";
         }
      }
    ?>    
</div>
</body>
</html>