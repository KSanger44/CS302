<!DOCTYPE html>
<?php
    include("config.php");
    session_start();
    $dID = $_SESSION['dID'];
    $dsql = "SELECT * FROM doctor WHERE dID = '$dID'";
    $dresult = mysqli_query($conn,$dsql);
    $drow = mysqli_fetch_array($dresult,MYSQLI_ASSOC);
    $docname = $drow["dname"];
    $demail = $drow["email"];
    $area = $drow["areacode"];
    $prefix = $drow["prefix"];
    $phone = $drow["phone"];
    $procID = $_SESSION['procID'];

    $csql = "SELECT checkin FROM procs WHERE procID = '$procID'";
    $cresult = mysqli_query($conn,$csql);
    $crow = mysqli_fetch_array($cresult,MYSQLI_ASSOC);
    $checkin = $crow["checkin"];
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        table {
            align-self:center;
            font-size: 18px;
            width: 100%;
        }

        table td {
            border: 1px solid black;
        }
    </style>

</head>

<body>
        <h4><?php echo $_SESSION['fname'] . "'s Contacts"; ?></h4>
            <div class='container text-center w-60'>
                <p style="font-size: 20px;">Here are your hospital contacts, <strong><?php echo "$docname"; ?></strong> is your assigned surgeon.<p>
                    <div style="display: flex; justify-content: center;">
                    <table>
                        <tr>
                            <th>Contact</th><th>Phone</th>
                        </tr>
                        <tr>
                            <td>General Questions</td><td>608 778-4444</td>
                        </tr>
                        <tr> 
                            <td><?php echo "$docname"; ?></td><td><?php echo "$area $prefix-$phone"; ?></td>
                        </tr>
                        <tr>
                            <td>Pharmacy</td><td>608 888-3312</td>
                        </tr>
                        <tr>
                            <td>Billing</td><td>608 666-9999</td>
                        </tr>
                    </table><br>
            </div></div></br>

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