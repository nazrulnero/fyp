<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['lectlogin']) == 0) {
    header('location:index.php');
} else {

    // code for update the read notification status
    $isread = 1;
    $pid = intval($_GET['projid']);
    date_default_timezone_set('Asia/Kolkata');
    $lectremarkdate = date('Y-m-d G:i:s ', strtotime("now"));
    $sql = "update tblprojects set IsRead=:isread where id=:pid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':isread', $isread, PDO::PARAM_STR);
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->execute();

    // code for action taken on leave
    if (isset($_POST['update'])) {
        $pid = intval($_GET['projid']);
        $description = $_POST['description'];
        $status = $_POST['status'];
        date_default_timezone_set('Asia/Kolkata');
        $lectremarkdate = date('Y-m-d G:i:s ', strtotime("now"));
        $sql = "update tblprojects set LecturerRemark=:description,Status=:status,LecturerRemarkDate=:lectremarkdate where id=:pid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':lectremarkdate', $lectremarkdate, PDO::PARAM_STR);
        $query->bindParam(':pid', $pid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Project updated Successfully";
    }



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Lecturer | Project Details </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

        <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css" />
        <!-- Theme Styles -->
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
                    <div class="page-title">Project Details</div>
                </div>

                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                        <style>
                                body {
                                    background-image: url('../assets/images/hd2.jpg');
                                    background-repeat: no-repeat;
                                    background-attachment: fixed;
                                    background-size: cover;
                                }
                            </style>
                            <h3>Project Detail</h3>
                            <?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                            <table id="example" class="display responsive-table ">


                                <tbody>
                                    <?php
                                    $pid = intval($_GET['projid']);
                                    $sql = "SELECT tblprojects.id as pid,tblstudents.FirstName,tblstudents.LastName,tblstudents.StudId,tblstudents.id,tblstudents.Gender,tblstudents.Phonenumber,tblstudents.EmailId,tblprojects.ProjTitle,tblprojects.Description,tblprojects.PostingDate,tblprojects.Status,tblprojects.LecturerRemark,tblprojects.LecturerRemarkDate from tblprojects join tblstudents on tblprojects.studid=tblstudents.id where tblprojects.id=:pid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                    ?>

                                            <tr>
                                                <td style="font-size:16px;"><b>Student Name:</b></td>
                                                <td><?php echo htmlentities($result->FirstName . " " . $result->LastName); ?></td>
                                                <td style="font-size:16px;"><b>Student Id:</b></td>
                                                <td><?php echo htmlentities($result->StudId); ?></td>
                                                <td style="font-size:16px;"><b>Gender:</b></td>
                                                <td><?php echo htmlentities($result->Gender); ?></td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b>Email ID:</b></td>
                                                <td><?php echo htmlentities($result->EmailId); ?></td>
                                                <td style="font-size:16px;"><b>Contact No.:</b></td>
                                                <td><?php echo htmlentities($result->Phonenumber); ?></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b>Posting Date:</b></td>
                                                <td><?php echo htmlentities($result->PostingDate); ?></td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b>Title: </b></td>
                                                <td colspan="5"><?php echo htmlentities($result->ProjTitle); ?></td>

                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b>Project Description: </b></td>
                                                <td colspan="5"><?php echo htmlentities($result->Description); ?></td>

                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b>Project Status:</b></td>
                                                <td colspan="5"><?php $stats = $result->Status;
                                                                if ($stats == 1) {
                                                                ?>
                                                        <span style="color: green">Approved</span>
                                                    <?php }
                                                                if ($stats == 2) { ?>
                                                        <span style="color: red">Not Approved</span>
                                                    <?php }
                                                                if ($stats == 0) { ?>
                                                        <span style="color: blue">Waiting for approval</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b>Lecturer Remark: </b></td>
                                                <td colspan="5"><?php
                                                                if ($result->LecturerRemark == "") {
                                                                    echo "waiting for Approval";
                                                                } else {
                                                                    echo htmlentities($result->LecturerRemark);
                                                                }
                                                                ?></td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b>Lecturer Action taken date: </b></td>
                                                <td colspan="5"><?php
                                                                if ($result->LecturerRemarkDate == "") {
                                                                    echo "NA";
                                                                } else {
                                                                    echo htmlentities($result->LecturerRemarkDate);
                                                                }
                                                                ?></td>
                                            </tr>
                                            <?php
                                            if ($stats == 0) {

                                            ?>
                                                <tr>
                                                    <td colspan="5">
                                                        <a class="modal-trigger waves-effect waves-light btn" href="#modal1">Take&nbsp;Action</a>
                                                        <form name="adminaction" method="post">
                                                            <div id="modal1" class="modal modal-fixed-footer" style="height: 60%">
                                                                <div class="modal-content" style="width:90%">
                                                                    <h4>Project take action</h4>
                                                                    <select class="browser-default" name="status" required="">
                                                                        <option value="">Choose your option</option>
                                                                        <option value="1">Approved</option>
                                                                        <option value="2">Not Approved</option>
                                                                    </select></p>
                                                                    <p><textarea id="textarea1" name="description" class="materialize-textarea" name="description" placeholder="Description" length="500" maxlength="500" required></textarea></p>
                                                                </div>
                                                                <div class="modal-footer" style="width:90%">
                                                                    <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">
                                                                </div>

                                                            </div>

                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </form>
                                            </tr>
                                    <?php $cnt++;
                                        }
                                    } ?>
                                </tbody>
                            </table>
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
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
        <script src="../assets/js/pages/ui-modals.js"></script>
        <script src="../assets/plugins/google-code-prettify/prettify.js"></script>

    </body>

    </html>
<?php } ?>