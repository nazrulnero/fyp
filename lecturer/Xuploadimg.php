<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['submit'])) {
    /*--*/
    $Picture = $_FILES['Picture']['name'];
    $filetemp = $_FILES['Picture']['tmp_name'];
    $target = "images/".basename($Picture);
    /*--*/

    $sql = "INSERT INTO tbllecturers(tbllecturers.Picture) VALUES ('$Picture')";
    mysqli_query($dbh,$sql);

    if (move_uploaded_file($filetemp, $target)) {
        echo "<script type='text/javascript'>alert('Homeless record has success to save');
                  window.location='profile.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error'. mysqli_error($connection));
                window.location='profile.php';</script>";
    }
}
?>


