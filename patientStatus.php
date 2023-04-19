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
    $ssql = "SELECT status FROM procs WHERE pID = '$pID'";
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
    <link rel="stylesheet" href="surgical.css">
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
            <button type='button' id='recovery' class='btn btn-lg w-66 btn-primary opacity-25'>Recovering</button>
            <button type='button' id='checkout' class='btn btn-lg w-66 btn-success'>Ready to checkout</button>
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