<?php
    include("config.php");
    session_start();
    $pID = $_SESSION['pID'];
    $procID = $_SESSION['procID'];
    $procname = $_SESSION['procname'];
    $time = $_SESSION['time'];
    $date = $_SESSION['date'];
    $csql = "SELECT checkin FROM procs WHERE procID = '$procID'";
    $cresult = mysqli_query($conn,$csql);
    $crow = mysqli_fetch_array($cresult,MYSQLI_ASSOC);
    $checkin = $crow["checkin"];

    $psql = "SELECT * FROM patient WHERE pID = '$pID'";
    $presult = mysqli_query($conn,$psql);
    $prow = mysqli_fetch_array($presult,MYSQLI_ASSOC);
    $height = $prow["height"];
    $weight = $prow["weight"];
    $fname = $prow["fname"];
    $lname = $prow["lname"];
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
    <h4>Hello <?php echo $_SESSION['fname']; ?>,</h4>

    <?php if($checkin == 0){
      echo "<p>Please confirm following information:</p>";
      echo "<form action='' method ='post'>";
      echo "<label for='fname'>First Name:</label>";
      echo "<div class='col-md-3'>";
      echo "<input type='text' class='form-control' id='fname' placeholder=$fname></div></div>";

      echo "<div class='form-group'>";
      echo "<label for='lname'>Last Name:</label>";
      echo "<div class='col-md-3'>";
      echo "<input type='text' class='form-control' id='lname' placeholder=$lname></div></div>";

      echo "<label for='surgery'>You are scheduled for an $procname at $time on $date</label>";
      echo "<div class='form-check'>";
      echo "<input class='form-check-input' type='radio' name='surgery' id='yes'>";
      echo "<label class='form-check-label' for='yes'>Yes</label></div>";

      echo "<div class='form-check'>";
      echo "<input class='form-check-input' type='radio' name='surgery' id='no'>";
      echo "<label class='form-check-label' for='no'>No</label></div>";

      echo "<div class='form-group'>
      <label for='height'>Enter your height in inches:</label>
      <div class='col-md-2'>
      <input type='text' class='form-control' id='height' placeholder=$height></div></div>";

      echo "<div class='form-group'>
      <label for='weight'>Enter your weight in pounds:</label>
      <div class='col-md-2'>
      <input type='text' class='form-control' id='weight' placeholder=$weight>
      </div></div><br>";

      echo "<button type='submit' class='btn btn-secondary' name ='checkin'>Submit</button></form><br>";
    }

    else {
      echo "Thank you for completing the checkin.<br>";
    }
    ?>
    
    <?php
      if(isset($_POST['checkin'])) {
        $sql = "UPDATE procs SET checkin='1' WHERE procID=$procID";
        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
          header("location: index.php");
        } else {
          echo "Error updating record: " . $conn->error;
        }
        
        $conn->close();
      }
    ?>

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