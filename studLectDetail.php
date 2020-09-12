<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['studlogin']) == 0) {
    header('location:index.php');
} else {
    $lid = intval($_GET['lectid']);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Student | Lecturer Detail</title>

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
    <style>
        body {
            background-image: url('assets/images/hd.png');
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
                    <div class="page-title">Lecturer Detail</div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="updatemp">
                                <div>
                                    <h3>Lecturer Info</h3>
                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m6">
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
                                                                <div class="col s12">
                                                                    <h5><b>Full Name</b></h5>
                                                                    <h5 colspan="5"><?php echo htmlentities($result->FirstName); ?>&nbsp;<?php echo htmlentities($result->LastName); ?></h5>
                                                                </div>
                                                                <div class="col m4 s12">
                                                                    <h5><b>Email</b></h5>
                                                                    <td colspan="5"><?php echo htmlentities($result->EmailId); ?></td>
                                                                </div>
                                                                <div class="col m4 s12">
                                                                    <h5><b>Contact Nom.</b></h5>
                                                                    <td colspan="5"><?php echo htmlentities($result->Phonenumber); ?></td>
                                                                </div>
                                                                <div class="col m4 s12">
                                                                    <h5><b>Room</b></h5>
                                                                    <td colspan="5"><?php echo htmlentities($result->Room); ?> </td>
                                                                </div>
                                                                <div class="col 12">
                                                                    <h5><b>Background</b></h5>
                                                                    <td colspan="5"><?php echo htmlentities($result->Background); ?></td>
                                                                </div>

                                                    </div>
                                                </div>
                                                <div class="col m6">
                                                    <div class="row">
                                                        <div class="col m6 s12">
                                                            <h5><b>Gender</b></h5>
                                                            <td colspan="5"><?php echo htmlentities($result->Gender); ?></td>
                                                        </div>
                                                        <div class="col m6 s12">
                                                            <h5><b>Nationality</b></h5>
                                                            <td colspan="5"><?php echo htmlentities($result->Nationality); ?></td>
                                                        </div>
                                                        <div class="col s12">
                                                            <h5><b>Section</b></h5>
                                                            <td colspan="5"><?php echo htmlentities($result->Section); ?></td>
                                                        </div>
                                                        <div class="col m6 12">
                                                            <h5><b>Research</b></h5>
                                                            <td colspan="5"><?php echo htmlentities($result->Research); ?></td>
                                                        </div>
                                                <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <td><a href="studApplyProject.php?lectid=<?php echo htmlentities($result->id); ?>" class="waves-effect waves-light btn green m-b-xs"> Apply Project</a></td>
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

    </body>

    </html>
<?php } ?>