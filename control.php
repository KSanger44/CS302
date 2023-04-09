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
            <tr>
            <th scope="row">Kyle Sanger</th>
            <td><input type="text" class="form-control" name = "date" placeholder="Dudley Doolittle" value="" /></td>
            <td>Appendectomy</td>
            <td><input type="text" class="form-control" name = "date" placeholder="11/26/2022" value="" /></td>
            <td><input type="text" class="form-control" name = "time" placeholder="6:00" value="" /></td>
            <td class="fit"><div class='btn-group-vertical ' role='group'>
                     <button type='button' id='prep' class='btn btn-danger'>Prep</button>
                     <button type='button' id='surg' class='btn btn-warning opacity-25'>Surg</button>
                     <button type='button' id='recov' class='btn btn-primary opacity-25'>Recov</button>
                     <button type='button' id='clear' class='btn btn-success opacity-25'>Clear</button>
                </div>     
                </td>
            <td><textarea id="alert" name="alert" rows="4" cols="50"></textarea></td>
            <td><button type='button'>Confirm</button></td>
            </tr>

            <tr>
            <th scope="row">Eddie Eagle</th>
            <td><input type="text" class="form-control" name = "date" placeholder="Dudley Doolittle" value="" /></td>
            <td>Cataract Surgery</td>
            <td><input type="text" class="form-control" name = "date" placeholder="11/28/2022" value="" /></td>
            <td><input type="text" class="form-control" name = "time" placeholder="5:37" value="" /></td>
            <td class="fit"><div class='btn-group-vertical ' role='group'>
                     <button type='button' id='prep' class='btn btn-danger opacity-25'>Prep</button>
                     <button type='button' id='surg' class='btn btn-warning'>Surg</button>
                     <button type='button' id='recov' class='btn btn-primary opacity-25'>Recov</button>
                     <button type='button' id='clear' class='btn btn-success opacity-25'>Clear</button>
                </div>     
                </td>
            <td><textarea id="alert" name="alert" rows="4" cols="50"></textarea></td>
            <td><button type='button'>Confirm</button></td>
            </tr>

            <tr>
            <th scope="row">Hamilton Urglar</th>
            <td><input type="text" class="form-control" name = "date" placeholder="Stephen Strange" value="" /></td>
            <td>Coronary Bypass</td>
            <td><input type="text" class="form-control" name = "date" placeholder="12/2/2022" value="" /></td>
            <td><input type="text" class="form-control" name = "time" placeholder="8:40" value="" /></td>
            <td class="fit"><div class='btn-group-vertical ' role='group'>
                     <button type='button' id='prep' class='btn btn-danger opacity-25'>Prep</button>
                     <button type='button' id='surg' class='btn btn-warning opacity-25'>Surg</button>
                     <button type='button' id='recov' class='btn btn-primary'>Recov</button>
                     <button type='button' id='clear' class='btn btn-success opacity-25'>Clear</button>
                </div>     
                </td>
            <td><textarea id="alert" name="alert" rows="4" cols="50"></textarea></td>
            <td><button type='button'>Confirm</button></td>
            </tr>
        </tbody>
        </table>
    
    </div> 
</div>

</html>
