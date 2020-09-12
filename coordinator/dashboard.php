<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['coorlogin']) == 0) {
    header('location:index.php');
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Coordinator | Total Students</title>

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
    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>
        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="page-title">Coordinator | Dashboard</div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="card transparent">
                        <div class="card-content">
                            <style>
                                body {
                                    background-image: url('../assets/images/hd2.jpg');
                                    background-repeat: no-repeat;
                                    background-attachment: fixed;
                                    background-size: cover;
                                }
                            </style>
                            <div class="col s12 m12 l4">
                                <div class="card stats-card">
                                    <div class="card-content">

                                        <span class="card-title">Total Registered Student</span>
                                        <span class="stats-counter">
                                            <?php
                                            $sql = "SELECT id from tblstudents";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $empcount = $query->rowCount();
                                            ?>

                                            <span class="counter"><?php echo htmlentities($empcount); ?></span></span>
                                    </div>
                                    <div id="sparkline-bar"></div>
                                </div>
                            </div>
                            <div class="row no-m-t no-m-b">
                                <div class="col s12 m12 l12">
                                    <div class="card invoices-card">
                                        <div class="card-content">

                                            <span class="card-title">Latest Project Applications</span>
                                            <table id="example" class="display responsive-table ">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Student Id</th>
                                                        <th>Full Name</th>
                                                        <th>Project Title</th>
                                                        <th>Supervisor</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT StudId,FirstName,LastName,ProjectTitle,Supervisor from tblstudents";
                                                    //$sql = "SELECT tblprojects.id as pid,tblstudents.FirstName,tblstudents.LastName,tblstudents.StudId,tblstudents.id,tblstudents.Major,tblprojects.ProjTitle,tblstudents.Supervisor,tblprojects.Status from tblprojects join tblstudents on tblprojects.studid=tblstudents.id order by pid desc";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {
                                                    ?>

                                                            <tr>
                                                                <td> <b><?php echo htmlentities($cnt); ?></b></td>
                                                                <td><?php echo htmlentities($result->StudId); ?></td>
                                                                <td><?php echo htmlentities($result->FirstName); ?>&nbsp;<?php echo htmlentities($result->LastName); ?></td>
                                                                <td><?php echo htmlentities($result->ProjectTitle); ?></td>
                                                                <td><?php echo htmlentities($result->Supervisor); ?></td>
                                                            </tr>
                                                    <?php $cnt++;
                                                        }
                                                    } ?>
                                                </tbody>                                                
                                            </table>
                                            <button onclick="printDiv()">Print this page</button>
                                            <button onclick="window.print()">Print this page</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        </div>
        <div class="left-sidebar-hover"></div>

        <script>
            function printDiv() {
                var divToPrint = document.getElementById('example');
                newWin = window.open("");
                newWin.document.write(divToPrint.outerHTML);
                newWin.print();
                newWin.close();
                newWin.document.close();
            }
        </script>
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