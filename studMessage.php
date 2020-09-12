<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['studlogin']) == 0) {
    header('location:index.php');
} else {
    $lid = intval($_GET['lectid']);
    if (isset($_POST['apply'])) {

        $studid = $_SESSION['sid'];
        $superid = $_POST['superid'];

        $projtitle = $_POST['projtitle'];
        $description = $_POST['description'];
        $status = 0;
        $isread = 0;
        $sql = "INSERT INTO tblprojects(ProjTitle,Description,Status,IsRead,studid,superid) VALUES(:projtitle,:description,:status,:isread,:studid,:superid)";
        //$sql = "update tblprojects set Description=:description,Status=:status,Isread=:isread,studid=:studid,superid=:superid";
        //$sql = "update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where id=:eid";
        //$sql = "update into tblprojects where tblprojects.superid where tbllecturers.id=:lid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':projtitle', $projtitle, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':isread', $isread, PDO::PARAM_STR);
        $query->bindParam(':studid', $studid, PDO::PARAM_STR);
        $query->bindParam(':superid', $superid, PDO::PARAM_STR);
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
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
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
                            <form id="example-form" method="post" name="addemp">
                                <div>
                                    <h3>Apply for Project</h3>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m12">
                                                    <div class="row">
                                                        <?php
                                                        $lid = intval($_GET['lectid']);
                                                        $sql = "SELECT * from  tbllecturers where id=:lid";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':lid', $lid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {               ?>
                                                                <div class="input-field col  s12">
                                                                    <input name="lectcode" id="lectcode" value="<?php echo htmlentities($result->LectId); ?>" type="text" autocomplete="off" readonly>
                                                                    <span id="lectcode-availability" style="font-size:12px;"></span>
                                                                </div>
                                                                <?php if ($error) { ?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                                                <div class="input-field col m8 s12">
                                                                    <label for="title">Title</label>
                                                                    <textarea id="textarea1" name="projtitle" class="materialize-textarea" length="100" required></textarea>
                                                                </div>
                                                                <div class="input-field col m12 s12">
                                                                    <label for="desc">Description</label>
                                                                    <textarea id="textarea1" name="description" class="materialize-textarea" length="500" required></textarea>
                                                                </div>
                                                                <div class="input-field col m6 s12">
                                                                    <select name="superid" autocomplete="off">
                                                                        <option value="<?php echo htmlentities($result->Department); ?>"><?php echo htmlentities($result->Department); ?></option>
                                                                        <?php $sql = "SELECT id from tbllecturers";
                                                                        $query = $dbh->prepare($sql);
                                                                        $query->execute();
                                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                        $cnt = 1;
                                                                        if ($query->rowCount() > 0) {
                                                                            foreach ($results as $resultt) {   ?>
                                                                                <option value="<?php echo htmlentities($resultt->id); ?>"><?php echo htmlentities($resultt->id); ?></option>
                                                                        <?php }
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                    <button type="submit" name="apply" id="apply" class="waves-effect waves-light btn indigo m-b-xs">Apply</button>

                                                </div>
                                            </div>
                                    </section>


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