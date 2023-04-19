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

    $feet = $height/12;
    $inches = $height % 12;

?>   
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="surgical.css">
    <script>
      window.addEventListener("load", function() {
        let checkin = document.forms.checkin;
        let errLog = document.getElementById("errLog");
        checkin.addEventListener("submit", function(event) {
          if (checkin.fname.value === "") {
            event.preventDefault();
            errLog.style.display = "initial";   
            errLog.innerHTML = "Please enter your first name";
          } else if (checkin.lname.value === "") {
            event.preventDefault();
            errLogStud.style.display = "initial";
            errLogStud.innerHTML = "Please enter your last name";
          } else if (checkin.surgery.value === "") {
            event.preventDefault();
            errLog.style.display = "initial";   
            errLog.innerHTML = "Please confirm your procedure time";
          } else if (checkin.feet.value === "") {
            event.preventDefault();
            errLog.style.display = "initial";   
            errLog.innerHTML = "Please enter a valid height";
          } else if (checkin.inches.value > 12) {
            event.preventDefault();
            errLog.style.display = "initial";   
            errLog.innerHTML = "Please enter a valid height";  
          }else if (checkin.weight.value ==="") {
            event.preventDefault();
            errLog.style.display = "initial";   
            errLog.innerHTML = "Please enter a valid weight";  
          };;
        });
      });
      </script>
</head>

<body>
    <h4><?php echo $_SESSION['fname'] . "'s Patient Info"; ?></h4>
    
    <?php if($checkin == 0){
      echo "<div class='container w-60'>";
      echo "<h3>Please confirm following information:</h3>";
      echo "<form id='checkin' action='' method ='post'>";
      echo "<label for='fname'>First Name:</label>";
      echo "<div class='col-md-3'>";
      echo "<input type='text' class='form-control' id='fname' placeholder=$fname></div></div></div>";

      echo "<div class='container w-60'>";
      echo "<div class='form-group'>";
      echo "<label for='lname'>Last Name:</label>";
      echo "<div class='col-md-3'>";
      echo "<input type='text' class='form-control' id='lname' placeholder=$lname></div></div></div>";

      echo "<div class='container w-60'>";
      echo "<label for='surgery'>You are scheduled for an $procname at $time on $date</label>";
      echo "<div class='form-check'>";
      echo "<input class='form-check-input' type='radio' name='surgery' id='yes'>";
      echo "<label class='form-check-label' for='yes'>Yes</label></div></div>";

      echo "<div class='container w-60'>";
      echo "<div class='form-check'>";
      echo "<input class='form-check-input' type='radio' name='surgery' id='no'>";
      echo "<label class='form-check-label' for='no'>No</label></div></div>";

      echo "<div class='container w-60'>";
      echo "<div class='form-group'>
      <table>
      <tr>
      <td colspan='2'><label for='height'>Enter your height:</label></td></tr>
      <tr>
      <td><label for='feet'>Feet </label></td>
      <td><input type='text' class='form-control' id='feet' placeholder=$feet></td></tr>
      <tr>
      <td><label for='inches'>Inches </label></td>
      <td><input type='text' class='form-control' id='inches' placeholder=$inches></td></tr>
      </table>
      </div></div></div>";

      echo "<div class='container w-60'>";
      echo "<div class='form-group'>
      <label for='weight'>Enter your weight in pounds:</label>
      <div class='col-md-2'>
      <input type='text' class='form-control' id='weight' placeholder=$weight>
      </div></div></div><br>";

      echo "<div class='container w-60'>";
      echo "<button type='submit' class='btn btn-lg btn-secondary' name ='checkin'>Submit</button></div></form><br>";

      echo "<span id='errLog'></span>";
      
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