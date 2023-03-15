<?php
    include("config.php");
    session_start();

    $pID = $_SESSION['pID'];
    $esql = "SELECT email FROM patient WHERE pID = '$pID'";
    $eresult = mysqli_query($conn,$esql);
    $erow = mysqli_fetch_array($eresult,MYSQLI_ASSOC);
    $email = $erow["email"];
    // the message
    $msg = "Your surgery checkin is overdue\n\nPlease login and complete the checkin.";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    // send email
    mail($email,"Complete Surgery Checkin",$msg);
?>    