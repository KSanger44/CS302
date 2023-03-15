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
            "<div class='container-fluid'>
            <div class='btn-group-vertical' role='group' aria-label='Basic example'>
            <button type='button' id='prep' class='btn btn-danger'>Preparing for Surgery</button>
            <button type='button' id='surgery' class='btn btn-warning opacity-25'>In Surgery</button>
            <button type='button' id='recovery' class='btn btn-primary opacity-25'>Recovering</button>
            <button type='button' id='checkout' class='btn btn-success opacity-25'>Ready to checkout</button>
            </div>
            </div>
            $name is preparing for surgery <br>";
            break;
        case 's':
            echo
            "<div class='container-fluid'>
            <div class='btn-group-vertical' role='group' aria-label='Basic example'>
            <button type='button' id='prep' class='btn btn-danger opacity-25'>Preparing for Surgery</button>
            <button type='button' id='surgery' class='btn btn-warning '>In Surgery</button>
            <button type='button' id='recovery' class='btn btn-primary opacity-25'>Recovering</button>
            <button type='button' id='checkout' class='btn btn-success opacity-25'>Ready to checkout</button>
            </div>
            </div>
            $name is in surgery <br>";
            break;
        case 'r':
            echo
            "<div class='container-fluid'>
            <div class='btn-group-vertical' role='group' aria-label='Basic example'>
            <button type='button' id='prep' class='btn btn-danger opacity-25'>Preparing for Surgery</button>
            <button type='button' id='surgery' class='btn btn-warning opacity-25'>In Surgery</button>
            <button type='button' id='recovery' class='btn btn-primary'>Recovering</button>
            <button type='button' id='checkout' class='btn btn-success opacity-25'>Ready to checkout</button>
            </div>
            </div>
            $name is recovering <br>";
            break;
        case 'c':
            echo
            "<div class='container-fluid'>
            <div class='btn-group-vertical' role='group' aria-label='Basic example'>
            <button type='button' id='prep' class='btn btn-danger opacity-25'>Preparing for Surgery</button>
            <button type='button' id='surgery' class='btn btn-warning opacity-25'>In Surgery</button>
            <button type='button' id='recovery' class='btn btn-primary'>Recovering</button>
            <button type='button' id='checkout' class='btn btn-success opacity-25'>Ready to checkout</button>
            </div>
            </div>
            $name is ready to checkout of surgery <br>";
            break;
    }?>
    <div class="btn-group">
        <?php if($checkin == 0){
            echo "<a href='checkin.php' role='button' class='btn btn-danger'>Check-in</a>";
            } else {
            echo "<a href='#' role='button' class='btn btn-success'>Checked In</a>";    
            }
        ?>
        <a href="patientStatus.php" role="button" class="btn btn-primary">Patient Status</a>
        <a href="index.php" role="button" class="btn btn-primary">Procedure Info</a>
        <a href="contacts.php" role="button" class="btn btn-primary">Contacts</a>
        <a href="logout.php" role="button" class="btn btn-light">Logout</a>
    </div>
</body>

</html>