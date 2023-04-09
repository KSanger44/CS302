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
                    <input type="password" id="pw" name="pw" placeholder="****" value="">
                </div><br>
                
                <div class="form-group">
                    <button><a href='control.php' style="border:none;text-decoration:none; color: black;">Submit</a></button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>