<!DOCTYPE html>

<html>
<head>
    <title>Surgery Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
<style>
    .table td.fit, 
    .table th.fit {
    white-space: nowrap;
    width: 1%;
    }
</style>    
       
</head>
<body>

<div class='container'>
    <h3>Surgery Control Panel<h3><br>

    <h4>Patients in Surgery</h4>
    <div class='container'>

    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Patient</th>
        <th scope="col">Doctor</th>
        <th scope="col">Procedure</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col" class="fit">Status</th>
        <th scope="col">Alert</th>
        <th scope="col">Update</th>
        </tr>
        </thead>

          <?php
            include("config.php");

            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }   
            
            $date = date("h:i:sa");
            echo "<br> date is " . $date . ".<br>";

            //$date2 = getdate();
            //echo "<br> getDate() " . $date2 . ".<br>";

            $adminsql ="SELECT patient.pID, patient.fname, patient.lname,
                        procs.procID, procs.procedure, procs.date, procs.time, procs.status,
                        doctor.dname
                        FROM procs
                        JOIN patient
                        ON procs.pID = patient.pID
                        JOIN doctor
                        ON procs.dID = doctor.dID";

            $adminresult = mysqli_query($conn,$adminsql);
            //$adminrow = mysqli_fetch_array($adminresult,MYSQLI_ASSOC);


            //display the sql result set in an html table
            $table = $conn->query($adminsql);
            echo "There are " . $table->num_rows . " patient(s) currently in surgery.";
            if ($table->num_rows > 0) {
              //output each result row
              while($adminrow = $adminresult->fetch_assoc()){
                $stat = $adminrow['status'];
                $time = $adminrow['time'];

                echo "<form action='' method='post'>
                      <tr>
                      <th scope='row'>" . $adminrow['fname'] . " " . $adminrow['lname'] . "</th>
                      <td>" . $adminrow['dname'] . "</td>
                      <td>" . $adminrow['procedure'] . "</td>
                      <td>" . $adminrow['date'] . "</td>
                      <td>" . date('h:i a', strtotime($time)) . "</td>

                      <td class='fit'><div class='btn-group-vertical' role='group' aria-label='Basic radio toggle button group'>";

                      switch ($stat) {
                        case 'p':
                          echo"
                            <input type='radio' class='btn-check' name='status' value='p' id='prep" . $adminrow['pID'] . "' checked>
                            <label class='btn btn-outline-danger' for='prep" . $adminrow['pID'] . "'>Prep</label>
        
                            <input type='radio' class='btn-check' name='status' value='s' id='surg" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-warning' for='surg" . $adminrow['pID'] . "'>Surg</label>
        
                            <input type='radio' class='btn-check' name='status' value='r' id='recov" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-primary' for='recov" . $adminrow['pID'] . "'>Recov</label>
        
                            <input type='radio' class='btn-check' name='status' value='c' id='clear" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-success' for='clear" . $adminrow['pID'] . "'>Clear</label>
                            </div></td>
                            
                            <td><textarea id='alert' name='alert' rows='6' cols='50'></textarea></td>

                            <input type='hidden' name='pID' value=" . $adminrow['pID'] . ">
                            <input type='hidden' name='stat' value=" . $adminrow['status'] . ">
                            <input type='hidden' name='procID' value=" . $adminrow['procID'] . ">

                            <td><input type='submit' id='confirm' name='confirm' value='Submit'>
                            </tr>
                            </form>";
                            break;
                        case 's':
                          echo"
                            <input type='radio' class='btn-check' name='status' value='p' id='prep" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-danger' for='prep" . $adminrow['pID'] . "'>Prep</label>
        
                            <input type='radio' class='btn-check' name='status' value='s' id='surg" . $adminrow['pID'] . "'checked>
                            <label class='btn btn-outline-warning' for='surg" . $adminrow['pID'] . "'>Surg</label>
        
                            <input type='radio' class='btn-check' name='status' value='r' id='recov" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-primary' for='recov" . $adminrow['pID'] . "'>Recov</label>
        
                            <input type='radio' class='btn-check' name='status' value='c' id='clear" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-success' for='clear" . $adminrow['pID'] . "'>Clear</label>
                            </div></td>
                            
                            <td><textarea id='alert' name='alert' rows='6' cols='50'></textarea></td>

                            <input type='hidden' name='pID' value=" . $adminrow['pID'] . ">
                            <input type='hidden' name='stat' value=" . $adminrow['status'] . ">
                            <input type='hidden' name='procID' value=" . $adminrow['procID'] . ">

                            <td><input type='submit' id='confirm' name='confirm' value='Submit'>
                            </tr>
                            </form>";
                            break;
                        case 'r':
                          echo"
                            <input type='radio' class='btn-check' name='status' value='p' id='prep" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-danger' for='prep" . $adminrow['pID'] . "'>Prep</label>
        
                            <input type='radio' class='btn-check' name='status' value='s' id='surg" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-warning' for='surg" . $adminrow['pID'] . "'>Surg</label>
        
                            <input type='radio' class='btn-check' name='status' value='r' id='recov" . $adminrow['pID'] . "'checked>
                            <label class='btn btn-outline-primary' for='recov" . $adminrow['pID'] . "'>Recov</label>
        
                            <input type='radio' class='btn-check' name='status' value='c' id='clear" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-success' for='clear" . $adminrow['pID'] . "'>Clear</label>
                            </div></td>
                            
                            <td><textarea id='alert' name='alert' rows='6' cols='50'></textarea></td>

                            <input type='hidden' name='pID' value=" . $adminrow['pID'] . ">
                            <input type='hidden' name='stat' value=" . $adminrow['status'] . ">
                            <input type='hidden' name='procID' value=" . $adminrow['procID'] . ">

                            <td><input type='submit' id='confirm' name='confirm' value='Submit'>
                            </tr>
                            </form>";
                            break;
                        case 'c':
                          echo"
                            <input type='radio' class='btn-check' name='status' value='p' id='prep" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-danger' for='prep" . $adminrow['pID'] . "'>Prep</label>
        
                            <input type='radio' class='btn-check' name='status' value='s' id='surg" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-warning' for='surg" . $adminrow['pID'] . "'>Surg</label>
        
                            <input type='radio' class='btn-check' name='status' value='r' id='recov" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-primary' for='recov" . $adminrow['pID'] . "'>Recov</label>
        
                            <input type='radio' class='btn-check' name='status' value='c' id='clear" . $adminrow['pID'] . "'checked>
                            <label class='btn btn-outline-success' for='clear" . $adminrow['pID'] . "'>Clear</label>
                            </div></td>
                            
                            <td><textarea id='alert' name='alert' rows='6' cols='50'></textarea></td>

                            <input type='hidden' name='pID' value=" . $adminrow['pID'] . ">
                            <input type='hidden' name='stat' value=" . $adminrow['status'] . ">
                            <input type='hidden' name='procID' value=" . $adminrow['procID'] . ">

                            <td><input type='submit' id='confirm' name='confirm' value='Submit'>
                            </tr>
                            </form>";
                          break;        
                      }
                                              
              }                
            }
            
            date_default_timezone_set('America/Chicago'); // CDT
            $timestamp = time();
            $date_time = date("d-m-Y (D) H:i:s", $timestamp);
            $current_date = date('d/m/Y == H:i:s');
            
            if(isset($_POST['confirm'] )){

              $pID = $_POST['pID'];
              $status = $_POST['status'];
              $procID = $_POST['procID'];
              $date = date("h:i:sa");
              $alert = $_POST['alert'];

              $updatesql = "UPDATE PROCS
                            SET procs.status = '$status' 
                            WHERE procs.procID = '$pID'";
           

            if (mysqli_query($conn, $updatesql)) {
              echo "Status Updated successfully.";
              $URL="http://localhost/dashboard/302//CS302/control.php";
              echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
              echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                            
            } else {
                echo "Error: " . $updatesql . "<br>" . mysqli_error($conn);
            }
          }

          if(isset($_POST['confirm']) && $alert != ""){

            $pID = $_POST['pID'];
            $status = $_POST['status'];
            $procID = $_POST['procID'];
            $date = date("h:i:sa");
            $alert = $_POST['alert'];


            $alertsql = "INSERT INTO `alert` (`aID`, `type`, `procID`, `seen`, `message`, `dt`)
                                      VALUES (NULL, 'd', '$procID', '0', '$alert', '$date')";      

            if (mysqli_query($conn, $alertsql)) {
              echo "Alert sent successfully.";

                            
            } else {
                echo "Error: " . $alertsql . "<br>" . mysqli_error($conn);
            }
            }

          ?> 
        </table>
    
    </div> 

    <a href="adminlogout.php" role="button" class="btn btn-lg btn-light w-100">Logout</a>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
