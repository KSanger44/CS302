<!DOCTYPE html>

<html>
<head>
    <title>Surgery Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <table>
        <tr>
            <th>Name</th>
            <th>Appointment</th>
            <th>Status</th>
        </tr>

        <tr>
            <td>Kyle</td>
            <td>CS 302</td>
            <td>

<div class='btn-group-vertical' role='group' aria-label='Basic radio toggle button group'>
<input type='radio' class='btn-check' name='status' id='btnradio1' autocomplete='off' checked>
  <label class='btn btn-outline-danger' for='btnradio1'>Prep</label>

  <input type='radio' class='btn-check' name='status' id="btnradio2" autocomplete="off">
  <label class='btn btn-outline-warning' for='btnradio2'>Surg</label>

  <input type='radio' class='btn-check' name='status' id='btnradio3' autocomplete="off">
  <label class='btn btn-outline-primary' for='btnradio3'>Recov</label>

  <input type='radio' class='btn-check' name='status' id='btnradio4' autocomplete='off'>
  <label class='btn btn-outline-success' for='btnradio4'>Clear</label>
</div>

</td>
</tr>
</table>


</body>

</html>



                    <input type='radio' class='btn-check' name='status" . $adminrow['pID'] . "' id='prep" . $adminrow['pID'] . "'>
                    <label class='btn btn-outline-danger' value='p' for='prep" . $adminrow['pID'] . "'>Prep</label>

                    <input type='radio' class='btn-check' name='status" . $adminrow['pID'] . "' id='surg" . $adminrow['pID'] . "'>
                    <label class='btn btn-outline-warning' value='s' for='surg" . $adminrow['pID'] . "'>Surg</label>

                    <input type='radio' class='btn-check' name='status" . $adminrow['pID'] . "' id='recov" . $adminrow['pID'] . "'>
                    <label class='btn btn-outline-primary' value='r' for='recov" . $adminrow['pID'] . "'>Recov</label>

                    <input type='radio' class='btn-check' name='status" . $adminrow['pID'] . "' id='clear" . $adminrow['pID'] . "'>
                    <label class='btn btn-outline-success' value='c' for='clear" . $adminrow['pID'] . "'>Clear</label>