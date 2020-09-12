<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['studlogin']) == 0) {
    header('location:index.php');
} else {
    $lid = intval($_GET['lectid']);
    if (isset($_POST['apply'])) {
        //$file_loc = $_FILES['file']['tmp_name'];
        //$folder = "upload/";
        $studid = $_SESSION['sid'];
        //$superid = $_SESSION['lid'];
        $projtitle = $_POST['projtitle'];
        $description = $_POST['description'];
        //$file = $_POST['file'];
        $status = 0;
        $isread = 0;
        $sql = "INSERT INTO tblprojects(ProjTitle,Description,Status,IsRead,studid) VALUES(:projtitle,:description,:status,:isread,:studid)";
        //$sql = "update tblprojects set Description=:description,Status=:status,Isread=:isread,studid=:studid,superid=:superid";
        //$sql = "update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where id=:eid";
        //$sql = "update into tblprojects where tblprojects.superid where tbllecturers.id=:lid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':projtitle', $projtitle, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        //$query->bindParam(':file', $file, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':isread', $isread, PDO::PARAM_STR);
        $query->bindParam(':studid', $studid, PDO::PARAM_STR);
        //$query->bindParam(':superid', $superid, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Project applied successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Title -->
        <title>Student | Apply Project</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="assets/css/customs.css" rel="stylesheet" type="text/css" />
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
                    <div class="page-title">Apply for Project</div>
                </div>
                <div class="col s12 m12 l8">
                    <div class="card">
                        <div class="card-content">
                            <style>
                                body {
                                    background-image: url('assets/images/hd.png');
                                    background-repeat: no-repeat;
                                    background-attachment: fixed;
                                    background-size: cover;
                                }
                            </style>
                            <form id="example-form" method="post" name="addemp">
                                <div>
                                    <h3><b>Project Detail</b></h3>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="">
                                                    <div class="row">
                                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                                        <div>
                                                            <h5><b>Project Title</b></h5>
                                                            <textarea id="textarea1" name="projtitle" class="materialize-textarea" length="100" required></textarea>
                                                        </div>
                                                        <div>
                                                            <h5><b>Project Description</b></h5>
                                                            <textarea id="textarea1" name="description" class="materialize-textarea" length="500" required></textarea>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="apply" id="apply" class="waves-effect waves-light btn green m-b-xs">Apply Project</button>
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
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
        <script src="assets/js/pages/form-input-mask.js"></script>
        <script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    </body>

    </html>
<?php } ?>