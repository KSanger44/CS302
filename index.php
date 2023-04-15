<?php
    include("config.php");
    session_start();
    date_default_timezone_set("America/Chicago");
    $pID = $_SESSION["pID"];
    $psql = "SELECT * FROM procs WHERE pID = '$pID'";
    $presult = mysqli_query($conn,$psql);
    $prow = mysqli_fetch_array($presult,MYSQLI_ASSOC);
    $procname = $prow["procedure"];
    $procID = $prow["procID"];
    $dID = $prow["dID"];
    $desc = $prow["desc"];
    $zerotime = $prow["time"];
    $atime = rtrim($zerotime, '0');
    $timestamp = strtotime($atime);
    $time = date('g:i A', $timestamp);
    
    
    $rdate = $prow["date"];
    $datestamp = strtotime($rdate);
    $date = date("m-d-Y", $datestamp);

    $datetime = $date . " " . $time;

    //$datestring = date( 'Y-m-d H:i:s', $date );
    //$timestring = strtotime($time);

    $dID = $prow["dID"];
    $_SESSION['dID'] = $dID;
    $_SESSION['procname'] = $procname;
    $_SESSION['procID'] = $procID;
    $_SESSION['time'] = $time;
    $_SESSION['date'] = $date;

    $dsql = "SELECT dname FROM doctor WHERE dID = '$dID'";
    $dresult = mysqli_query($conn,$dsql);
    $drow = mysqli_fetch_array($dresult,MYSQLI_ASSOC);
    $docname = $drow["dname"];

    $csql = "SELECT checkin FROM procs WHERE procID = '$procID'";
    $cresult = mysqli_query($conn,$csql);
    $crow = mysqli_fetch_array($cresult,MYSQLI_ASSOC);
    $checkin = $crow["checkin"];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h4><?php echo $_SESSION['fname'] . "'s " . $procname; ?>,</h4>

    <div class="container">
        <div id="appt">
            <p><?php echo $_SESSION['fname'] . " is scheduled for " .  $procname . " with " . $docname . " at " .  $time . " on " . $date; ?>.</p>
        </div>
        <div id="desc">
        <?php 
            if($checkin == 0){
                echo"<div class='container'>";
                echo "<p>Please make sure to do the <a href='checkin.php'>Patient Check-in</a> at least 24 hours before the start of the procedure</p>";
                echo "</div>";
            }
            echo"<div class='container'>";
            echo $desc; 
            echo "</div>";
            ?>

        </div>
    </div>
    
    
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

    <div class='container' id='alertdiv'>
    <table class="table table-striped">
    <thead>
        <tr>
            <th colspan="4" class="text-center"><h3>Alerts</h3></th>
        </tr>
    </thead>
    <tbody>
        <?php
                $asql = "SELECT * FROM alert WHERE procID = '$procID'";
                $aresult = mysqli_query($conn,$asql);
                $table = $conn->query($asql);
                $arow = mysqli_fetch_array($aresult,MYSQLI_ASSOC);
                $aresult = mysqli_query($conn,$asql);

                echo "There are " . $table->num_rows . " Alert(s).";
                if ($table->num_rows > 0) {

                
                  //output each result row
                  while($arow = $aresult->fetch_assoc()){
                    echo "
                    <tr>
                    <td>" . $arow['dt'] . "</td>
                    <td colspan='3'>" . $arow['message'] . "</td>
                    </tr>";
                  }
                }
        ?>
    </tbody>
    </table>    
    </div>

</body>

</html>