<?php
include('include/config.php');
if (!empty($_POST["studentid"])) {

  $sql = mysqli_query($con, "select Firstname,id from tblstudents where FirstName='" . $_POST['studentid'] . "'"); ?>
  <option selected="selected">Select Doctor </option>
  <?php
  while ($row = mysqli_fetch_array($sql)) { ?>
    <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['FirstName']); ?></option>
  <?php
  }
}


if (!empty($_POST["doctor"])) {

  $sql = mysqli_query($con, "select docFees from doctors where id='" . $_POST['doctor'] . "'");
  while ($row = mysqli_fetch_array($sql)) { ?>
    <option value="<?php echo htmlentities($row['docFees']); ?>"><?php echo htmlentities($row['docFees']); ?></option>
<?php
  }
}

?>