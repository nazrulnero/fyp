<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $sid = intval($_GET['studid']);
    if (isset($_POST['update'])) {
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $major = $_POST['major'];
        $semester = $_POST['semester'];
        $nationality = $_POST['nationality'];
        $mobileno = $_POST['mobileno'];
        $sql = "update tblstudents set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Major=:major,Semester=:semester,Nationality=:nationality,Phonenumber=:mobileno where id=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':major', $major, PDO::PARAM_STR);
        $query->bindParam(':semester', $semester, PDO::PARAM_STR);
        $query->bindParam(':nationality', $nationality, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Student record updated Successfully";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Title -->
        <title>Admin | Update Student</title>
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
    </head>

    <body>
        <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>
        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="page-title">Update Student</div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="updatemp">
                                <div>
                                    <h3>Update Student Info</h3>
                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m6">
                                                    <div class="row">
                                                        <?php
                                                        $sql = "SELECT * from  tblstudents where id=:sid";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {               ?>
                                                                <div class="input-field col  s12">
                                                                    <label for="studcode">Student Code(Must be unique)</label>
                                                                    <input name="studcode" id="studcode" value="<?php echo htmlentities($result->StudId); ?>" type="text" autocomplete="off" readonly required>
                                                                    <span id="studid-availability" style="font-size:12px;"></span>
                                                                </div>
                                                                <div class="input-field col m6 s12">
                                                                    <label for="firstName">First name</label>
                                                                    <input id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName); ?>" type="text" required>
                                                                </div>
                                                                <div class="input-field col m6 s12">
                                                                    <label for="lastName">Last name </label>
                                                                    <input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName); ?>" type="text" autocomplete="off" required>
                                                                </div>
                                                                <div class="input-field col s12">
                                                                    <label for="email">Email</label>
                                                                    <input name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId); ?>" readonly autocomplete="off" required>
                                                                    <span id="emailid-availability" style="font-size:12px;"></span>
                                                                </div>
                                                                <div class="input-field col s12">
                                                                    <label for="phone">Mobile number</label>
                                                                    <input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber); ?>" maxlength="10" autocomplete="off" required>
                                                                </div>
                                                    </div>
                                                </div>
                                                <div class="col m6">
                                                    <div class="row">
                                                        <div class="input-field col m6 s12">
                                                            <select name="gender" autocomplete="off">
                                                                <option value="<?php echo htmlentities($result->Gender); ?>"><?php echo htmlentities($result->Gender); ?></option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="birthdate"></label>
                                                            <input id="birthdate" name="dob" class="datepicker" value="<?php echo htmlentities($result->Dob); ?>">
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <select name="major" autocomplete="off">
                                                                <option value="<?php echo htmlentities($result->Major); ?>"><?php echo htmlentities($result->Major); ?></option>
                                                                <option value="System Netwok">System Netwok</option>
                                                                <option value="Software Engineering">Software Engineering</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <select name="semester" autocomplete="off">
                                                                <option value="<?php echo htmlentities($result->Semester); ?>"><?php echo htmlentities($result->Semester); ?></option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="nationality">Nationality</label>
                                                            <input id="nationality" name="nationality" type="text" value="<?php echo htmlentities($result->Nationality); ?>" autocomplete="off" required>
                                                        </div>
                                                <?php }
                                                        } ?>
                                                <div class="input-field col s12">
                                                    <button type="submit" name="update" id="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>
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