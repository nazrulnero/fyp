<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add'])) {
        $studid = $_POST['studcode'];
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $major = $_POST['major'];
        $semester = $_POST['semester'];
        $nationality = $_POST['nationality'];
        $mobileno = $_POST['mobileno'];
        $status = 1;
        $sql = "INSERT INTO tblstudents(StudId,FirstName,LastName,EmailId,Password,Gender,Dob,Major,Semester,Nationality,Phonenumber,Status) VALUES(:studid,:fname,:lname,:email,:password,:gender,:dob,:major,:semester,:nationality,:mobileno,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studid', $studid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':major', $major, PDO::PARAM_STR);
        $query->bindParam(':semester', $semester, PDO::PARAM_STR);
        $query->bindParam(':nationality', $nationality, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Student record added Successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Title -->
        <title>Admin | Add Student</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/css/customs.css" rel="stylesheet" type="text/css" />
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
        <script type="text/javascript">
            function valid() {
                if (document.addstud.password.value != document.addstud.confirmpassword.value) {
                    alert("New Password and Confirm Password Field do not match  !!");
                    document.addstud.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
        <script>
            function checkAvailabilityStudid() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "checkAvailablity_student.php",
                    data: 'studcode=' + $("#studcode").val(),
                    type: "POST",
                    success: function(data) {
                        $("#studid-availability").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
        <script>
            function checkAvailabilityEmailid() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "checkAvailablity_student.php",
                    data: 'emailid=' + $("#email").val(),
                    type: "POST",
                    success: function(data) {
                        $("#emailid-availability").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
    </head>
    <style>
        body {
            background-image: url('../assets/images/hd3.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

    <body>
        <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>
        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="page-title">Add Student</div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="addstud">
                                <div>
                                    <h3>Student Info</h3>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m6">
                                                    <div class="row">
                                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                                        <div class="input-field col  s12">
                                                            <label for="studcode">Student Code (Required) (Must be unique)</label>
                                                            <input name="studcode" id="studcode" onBlur="checkAvailabilityStudid()" type="text" autocomplete="off" required>
                                                            <span id="studid-availability" style="font-size:12px;"></span>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="firstName">First name (Required)</label>
                                                            <input id="firstName" name="firstName" type="text" required>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="lastName">Last name (Required)</label>
                                                            <input id="lastName" name="lastName" type="text" autocomplete="off" required>
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <label for="email">Email (Required)</label>
                                                            <input name="email" type="email" id="email" onBlur="checkAvailabilityEmailid()" autocomplete="off" required>
                                                            <span id="emailid-availability" style="font-size:12px;"></span>
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <label for="password">Password (Required)</label>
                                                            <input id="password" name="password" type="password" autocomplete="off" required>
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <label for="confirm">Confirm password (Required)</label>
                                                            <input id="confirm" name="confirmpassword" type="password" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col m6">
                                                    <div class="row">
                                                        <div class="input-field col m6 s12">
                                                            <select name="gender" autocomplete="off" required>
                                                                <option value="">Gender (Required)</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="birthdate">Birthdate</label>
                                                            <input id="birthdate" name="dob" type="date" class="datepicker" autocomplete="off">
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <select name="major" autocomplete="off" required>
                                                                <option value="">Major (Required)</option>
                                                                <option value="System Netwok">System Netwok</option>
                                                                <option value="Software Engineering">Software Engineering</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <select name="semester" autocomplete="off" required>
                                                                <option value="">Semester (Required)</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="nationality">Nationality</label>
                                                            <input id="nationality" name="nationality" type="text" autocomplete="off">
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <label for="phone">Mobile number</label>
                                                            <input id="phone" name="mobileno" type="tel" maxlength="10" autocomplete="off">
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <button type="submit" name="add" onclick="return valid();" id="add" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
        <div class="left-sidebar-hover"></div>
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
    </body>

    </html>
<?php } ?>