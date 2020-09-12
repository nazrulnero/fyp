<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['lectlogin']) == 0) {
    header('location:index.php');
} else {
    $lid = $_SESSION['lectlogin'];
    if (isset($_POST['update'])) {

        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        if (!is_dir($dir)) {
            mkdir("images/" . $propic);
        }
        move_uploaded_file($_FILES["propic"]["tmp_name"], "images/" . $propic);
        $gender = $_POST['gender'];
        $section = $_POST['section'];
        $research = $_POST['research'];
        $background = $_POST['background'];
        $nationality = $_POST['nationality'];
        $mobileno = $_POST['mobileno'];
        $propic = $_FILES["propic"]["name"];
        $result = mysqli_fetch_array($query);
        $dir = "images/$propic";


        $sql = "update tbllecturers set FirstName=:fname,LastName=:lname,Picture=:tpics,Gender=:gender,Section=:section,Research=:research,Background=:background,Nationality=:nationality,Phonenumber=:mobileno where EmailId=:lid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':tpics', $propic, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':section', $section, PDO::PARAM_STR);
        $query->bindParam(':research', $research, PDO::PARAM_STR);
        $query->bindParam(':background', $background, PDO::PARAM_STR);
        $query->bindParam(':nationality', $nationality, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':lid', $lid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Lecturer record updated Successfully";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Title -->
        <title>Lecturer | My Profile</title>

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
    <style>
        body {
            background-image: url('../assets/images/hd2.jpg');
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
                    <div class="page-title">My Profile</div>
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
                            <form id="example-form" method="post" name="updatemp">
                                <div>
                                    <h3>Update Info</h3>
                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m6">
                                                    <div class="row">
                                                        <?php
                                                        $sid = $_SESSION['lectlogin'];
                                                        $sql = "SELECT * from  tbllecturers where EmailId=:sid";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {               ?>
                                                                <div class="form-group"><label for="company" class=" form-control-label">Teacher Pic</label><input type="file" name="propic" value="" class="form-control" id="propic" required="true"></div>
                                                                <div class="input-field col s12">
                                                                    <label for="lectcode">Lecturer Code</label>
                                                                    <input name="lectcode" id="lectcode" value="<?php echo htmlentities($result->LectId); ?>" type="text" autocomplete="off" readonly required>
                                                                    <span id="lectid-availability" style="font-size:12px;"></span>
                                                                </div>
                                                                <div class="input-field col m6 s12">
                                                                    <label for="firstName">First name</label>
                                                                    <input id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName); ?>" type="text" readonly required>
                                                                </div>
                                                                <div class="input-field col m6 s12">
                                                                    <label for="lastName">Last name </label>
                                                                    <input id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName); ?>" type="text" autocomplete="off" readonly required>
                                                                </div>

                                                                <div class="input-field col s12">
                                                                    <label for="email">Email</label>
                                                                    <input name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId); ?>" autocomplete="off" readonly required>
                                                                    <span id="emailid-availability" style="font-size:12px;"></span>
                                                                </div>
                                                    </div>
                                                </div>
                                                <div class="col m6">
                                                    <div class="row">
                                                        <div class="input-field col m6 s12">
                                                            <label for="gender">Gender</label>
                                                            <input id="gender" name="gender" value="<?php echo htmlentities($result->Gender); ?>" type="text" autocomplete="off" readonly required>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="section">Section</label>
                                                            <input id="section" name="section" type="text" value="<?php echo htmlentities($result->Section); ?>" autocomplete="off" readonly required>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="phone">Mobile number</label>
                                                            <input id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber); ?>" maxlength="10" autocomplete="off" required>
                                                        </div>
                                                        <div class="input-field col m6 s12">
                                                            <label for="nationality">Nationality</label>
                                                            <input id="nationality" name="nationality" type="text" value="<?php echo htmlentities($result->Nationality); ?>" autocomplete="off" required>
                                                        </div>
                                                        <div class="input-field">
                                                            <h5>Research</h5>
                                                            <textarea name="research" id="research" cols="30" rows="100"> <?php echo htmlentities($result->Research); ?></textarea>
                                                        </div>
                                                        <div class="input-field">
                                                            <h5>Background</h5>
                                                            <textarea name="background" id="background"> <?php echo htmlentities($result->Background); ?></textarea>
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <button type="submit" name="update" id="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>
                                                        </div>
                                                <?php }
                                                        } ?>
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
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
        <script src="../assets/js/pages/ui-modals.js"></script>
        <script src="../assets/plugins/google-code-prettify/prettify.js"></script>

    </body>

    </html>
<?php } ?>