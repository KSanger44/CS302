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

    <script>
      function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable2");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
          // Start by saying: no switching is done:
          switching = false;
          rows = table.rows;
          /* Loop through all table rows (except the
          first, which contains table headers): */
          for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            } else if (dir == "desc") {
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
            }
          }
        }
          if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++;
          } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
              dir = "desc";
              switching = true;
      }
    }
  }
}
</script>
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
        <th scope="col" onclick="sortTable(0)">Patient</th>
        <th scope="col" onclick="sortTable(1)">Doctor</th>
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
            

            $adminsql ="SELECT patient.pID, patient.fname, patient.lname,
                        procs.procedure, procs.date, procs.time, procs.status,
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
                $stat = $_POST['stat'];


                echo "<form action='' method='post'>
                      <tr>
                      <th scope='row'>" . $adminrow['fname'] . " " . $adminrow['lname'] . "</th>
                      <td>" . $adminrow['dname'] . "</td>
                      <td>" . $adminrow['procedure'] . "</td>
                      <td>" . $adminrow['date'] . "</td>
                      <td>" . $adminrow['time'] . "</td>

                      <td class='fit'><div class='btn-group-vertical' role='group' aria-label='Basic radio toggle button group'>"

                      switch ($stat) {
                        case 'p':
                          echo"
                            <input type='radio' class='btn-check' name='status' id='prep" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-danger' value='p' for='prep" . $adminrow['pID'] . "'>Prep</label>
        
                            <input type='radio' class='btn-check' name='status' id='surg" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-warning opacity-25' value='s' for='surg" . $adminrow['pID'] . "'>Surg</label>
        
                            <input type='radio' class='btn-check' name='status' id='recov" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-primary opacity-25' value='r' for='recov" . $adminrow['pID'] . "'>Recov</label>
        
                            <input type='radio' class='btn-check' name='status' id='clear" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-success opacity-25' value='c' for='clear" . $adminrow['pID'] . "'>Clear</label>
                            </div></td>";
                            break;
                        case 's':
                          echo"
                            <input type='radio' class='btn-check' name='status' id='prep" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-danger opacity-25' value='p' for='prep" . $adminrow['pID'] . "'>Prep</label>
        
                            <input type='radio' class='btn-check' name='status' id='surg" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-warning' value='s' for='surg" . $adminrow['pID'] . "'>Surg</label>
        
                            <input type='radio' class='btn-check' name='status' id='recov" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-primary opacity-25' value='r' for='recov" . $adminrow['pID'] . "'>Recov</label>
        
                            <input type='radio' class='btn-check' name='status' id='clear" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-success opacity-25' value='c' for='clear" . $adminrow['pID'] . "'>Clear</label>
                            </div></td>";
                            break;
                        case 'r':
                          echo"
                            <input type='radio' class='btn-check' name='status' id='prep" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-danger opacity-25' value='p' for='prep" . $adminrow['pID'] . "'>Prep</label>
        
                            <input type='radio' class='btn-check' name='status' id='surg" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-warning opacity-25' value='s' for='surg" . $adminrow['pID'] . "'>Surg</label>
        
                            <input type='radio' class='btn-check' name='status' id='recov" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-primary' value='r' for='recov" . $adminrow['pID'] . "'>Recov</label>
        
                            <input type='radio' class='btn-check' name='status' id='clear" . $adminrow['pID'] . "'>
                            <label class='btn btn-outline-success opacity-25' value='c' for='clear" . $adminrow['pID'] . "'>Clear</label>
                            </div></td>";
                            break;
                        case 'c':
                          echo"
                          <input type='radio' class='btn-check' name='status' id='prep" . $adminrow['pID'] . "'>
                          <label class='btn btn-outline-danger opacity-25' value='p' for='prep" . $adminrow['pID'] . "'>Prep</label>
      
                          <input type='radio' class='btn-check' name='status' id='surg" . $adminrow['pID'] . "'>
                          <label class='btn btn-outline-warning opacity-25' value='s' for='surg" . $adminrow['pID'] . "'>Surg</label>
      
                          <input type='radio' class='btn-check' name='status' id='recov" . $adminrow['pID'] . "'>
                          <label class='btn btn-outline-primary opacity-25' value='r' for='recov" . $adminrow['pID'] . "'>Recov</label>
      
                          <input type='radio' class='btn-check' name='status' id='clear" . $adminrow['pID'] . "'>
                          <label class='btn btn-outline-success' value='c' for='clear" . $adminrow['pID'] . "'>Clear</label>
                          </div></td>";
                          break;        
                      }

                      <td><textarea id='alert' name='alert' rows='6' cols='50'></textarea></td>

                      <input type='hidden' name='pID' value=" . $adminrow['pID'] . ">
                      <input type='hidden' name='stat' value=" . $adminrow['status'] . ">

                      <td><input type='submit' id='confirm' name='confirm' value='Submit'>
                      </tr>
                      </form>";
                                              
              }                
            }
            

            
            if(isset($_POST['confirm'] )){

              $pID = $_POST['pID'];
              $status = $_POST['status'];
              
              echo "<br>";
              echo "pID is " . $pID . ".";
              echo "<br>";
              echo "status is " . $status . ".";


              $updatesql = "UPDATE PROCS
                            SET procs.status = '$status' 
                            WHERE procs.procID = '$pID'";

              $alertsql = "INSERT INTO ";

            if (mysqli_query($conn, $updatesql)) {
              echo "Record Updated successfully.";
              
            } else {
                echo "Error: " . $updatesql . "<br>" . mysqli_error($conn);
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
