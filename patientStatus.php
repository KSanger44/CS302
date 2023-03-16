<!DOCTYPE html>
<?php
    include("config.php");
    session_start();
    $procID = $_SESSION['procID'];
    $csql = "SELECT checkin FROM procs WHERE procID = '$procID'";
    $cresult = mysqli_query($conn,$csql);
    $crow = mysqli_fetch_array($cresult,MYSQLI_ASSOC);
    $checkin = $crow["checkin"];

    $pID = $_SESSION['pID'];
    $ssql = "SELECT status FROM patient WHERE pID = '$pID'";
    $sresult = mysqli_query($conn,$ssql);
    $srow = mysqli_fetch_array($sresult,MYSQLI_ASSOC);
    $status = $srow["status"];

    $name = $_SESSION['fname']; 
?>    
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    switch ($status) {
        case 'p':
            echo 
            "<div class='container text-center w-60'>
            <div class='btn-group-vertical d-flex' role='group'>
            <button type='button' id='prep' class='btn btn-lg btn-danger'>Preparing for Surgery</button>
            <button type='button' id='surgery' class='btn btn-lg btn-warning opacity-25'>In Surgery</button>
            <button type='button' id='recovery' class='btn btn-lg btn-primary opacity-25'>Recovering</button>
            <button type='button' id='checkout' class='btn btn-lg btn-success opacity-25'>Ready to checkout</button>
            </div>
            </div>
            <div class='container text-center w-60'><br> 
            <h3>$name is preparing for surgery.</h3> <br> </div>";
            break;
        case 's':
            echo
            "<div class='container text-center w-60'>
            <div class='btn-group-vertical d-flex w-100' role='group' aria-label='Basic example'>
            <button type='button' id='prep' class='btn btn-lg w-66 btn-danger opacity-25'>Preparing for Surgery</button>
            <button type='button' id='surgery' class='btn btn-lg w-66 btn-warning '>In Surgery</button>
            <button type='button' id='recovery' class='btn btn-lg w-66 btn-primary opacity-25'>Recovering</button>
            <button type='button' id='checkout' class='btn btn-lg w-66 btn-success opacity-25'>Ready to checkout</button>
            </div>
            </div>
            <div class='container text-center w-60'><br>
            <h3>$name is in surgery.</h3> <br> </div>";
            break;
        case 'r':
            echo
            "<div class='container text-center w-60'>
            <div class='btn-group-vertical d-flex w-100' role='group' aria-label='Basic example'>
            <button type='button' id='prep' class='btn btn-lg w-66 btn-danger opacity-25'>Preparing for Surgery</button>
            <button type='button' id='surgery' class='btn btn-lg w-66 btn-warning opacity-25'>In Surgery</button>
            <button type='button' id='recovery' class='btn btn-lg w-66 btn-primary'>Recovering</button>
            <button type='button' id='checkout' class='btn btn-lg w-66 btn-success opacity-25'>Ready to checkout</button>
            </div>
            </div>
            <div class='container text-center w-60'><br>
            <h3>$name is recovering.</h3> <br> </div>";
            break;
        case 'c':
            echo
            "<div class='container text-center w-60'>
            <div class='btn-group-vertical d-flex w-100' role='group' aria-label='Basic example'>
            <button type='button' id='prep' class='btn btn-lg w-66 btn-danger opacity-25'>Preparing for Surgery</button>
            <button type='button' id='surgery' class='btn btn-lg w-66 btn-warning opacity-25'>In Surgery</button>
            <button type='button' id='recovery' class='btn btn-lg w-66 btn-primary'>Recovering</button>
            <button type='button' id='checkout' class='btn btn-lg w-66 btn-success opacity-25'>Ready to checkout</button>
            </div>
            </div>
            <div class='container text-center w-60'><br>
            <h3>$name is ready to checkout of surgery.</h3> <br> </div>";
            break;
    }?>
        
        <div class="btn-group d-flex w-100 text-center" role="group">
            <?php if($checkin == 0){
            echo "<a href='checkin.php' role='button' class='btn btn-lg btn-danger w-100'>Check-in</a>";
            } else {
                echo "<a href='#' role='button' class='btn btn-lg btn-success w-100'>Checked In</a>";    
            }
            ?>
            <a href="patientStatus.php" role="button" class="btn btn-lg btn-primary w-100">Patient Status</a>
            <a href="index.php" role="button" class="btn btn-lg btn-primary w-100">Procedure Info</a>
            <a href="contacts.php" role="button" class="btn btn-lg btn-primary w-100">Contacts</a>
            <a href="logout.php" role="button" class="btn btn-lg btn-light w-100">Logout</a>
    </div>
</body>

</html>