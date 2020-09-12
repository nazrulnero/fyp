<?php
require_once("includes/config.php");
// code for empid availablity
if (!empty($_POST["lectcode"])) {
	$lectid = $_POST["lectcode"];

	$sql = "SELECT LectId FROM tbllecturers WHERE LectId=:lectid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':lectid', $lectid, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		echo "<span style='color:red'> Lecturer id already exists .</span>";
		echo "<script>$('#add').prop('disabled',true);</script>";
	} else {

		echo "<span style='color:green'> Lecturer id available for Registration .</span>";
		echo "<script>$('#add').prop('disabled',false);</script>";
	}
}

// code for emailid availablity
if (!empty($_POST["emailid"])) {
	$lectid = $_POST["emailid"];
	$sql = "SELECT EmailId FROM tbllecturers WHERE EmailId=:emailid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':emailid', $lectid, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		echo "<span style='color:red'> Email id already exists .</span>";
		echo "<script>$('#add').prop('disabled',true);</script>";
	} else {

		echo "<span style='color:green'> Email id available for Registration .</span>";
		echo "<script>$('#add').prop('disabled',false);</script>";
	}
}
