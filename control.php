<!DOCTYPE html>

<html>
<head>
    <title>Surgery Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

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
        <tbody>
          <?php
            include("config.php");

            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }   
            

            $docsql= "SELECT * FROM doctor";
            $docresult = mysqli_query($conn,$docsql);
            $docrow = mysqli_fetch_array($docresult,MYSQLI_ASSOC);

            $adminsql ="SELECT patient.fname, patient.lname,
                        procs.procedure, procs.date, procs.time, procs.status,
                        doctor.dname
                        FROM procs
                        JOIN patient
                        ON procs.pID = patient.pID
                        JOIN doctor
                        ON procs.dID = doctor.dID";

            $adminresult = mysqli_query($conn,$adminsql);
            $adminrow = mysqli_fetch_array($adminresult,MYSQLI_ASSOC);

            //display the sql result set in an html table
            $table = $conn->query($adminsql);
            echo "There are " . $table->num_rows . " patient(s) currently in surgery.";
            if ($table->num_rows > 0) {
              //output each result row
              while($adminrow = $adminresult->fetch_assoc()){
                
                echo "<tr>
                      <th scope='row'>" . $adminrow['fname'] . " " . $adminrow['lname'] . "</th>
                      <td><input type='text' class='form-control' name='doctor' placeholder='" . $adminrow['dname'] . "value=''/></td>
                      <td>" . $adminrow['procedure'] . "</td>
                      <td><input type='text' class='form-control' name='date' placeholder='" . $adminrow['date'] . "value=''/></td>
                      <td><input type='text' class='form-control' name='time' placeholder='" . $adminrow['time'] . "value=''/></td>

                      <td class='fit'<div class='btn-group-vertical ' role='group'>
                      <button type='button' id='prep' class='btn btn-danger'>Prep</button>
                      <button type='button' id='surg' class='btn btn-warning opacity-25'>Surg</button>
                      <button type='button' id='recov' class='btn btn-primary opacity-25'>Recov</button>
                      <button type='button' id='clear' class='btn btn-success opacity-25'>Clear</button>
                      </div></td>
                      
                      <td><textarea id='alert' name='alert' rows='4' cols='50'></textarea></td>
                      <td><button type='button'>Confirm</button></td>
                      </tr>";
                                              
              }
                
            }
          ?> 
        </tbody>
        </table>
    
    </div> 

    <a href="logout.php" role="button" class="btn btn-lg btn-light w-100">Logout</a>
</div>

</html>
