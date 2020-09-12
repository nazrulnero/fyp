     <aside id="slide-out" class="side-nav white fixed">
         <div class="side-nav-wrapper">
             <div class="sidebar-profile">
                 <div class="sidebar-profile-image">
                     <img src="assets/images/studentIcon.png" class="circle" alt="">
                 </div>
                 <div class="sidebar-profile-info">
                     <p>Student</p>
                     <?php
                        $sid = $_SESSION['sid'];
                        $sql = "SELECT FirstName,LastName,StudId from tbllecturers where id=:sid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {               ?>
                             <p><?php echo htmlentities($result->FirstName . " " . $result->LastName); ?></p>
                             <span><?php echo htmlentities($result->StudId) ?></span>
                     <?php }
                        } ?>
                 </div>
             </div>

             <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                 <li class="no-padding"><a class="waves-effect waves-grey" href="studProfile.php"><i class="material-icons">account_box</i>Student Profiles</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="studChangePassword.php"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="studLectView.php"><i class="material-icons">account_box</i>View lecturers</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="studProjectHistory.php"><i class="material-icons">apps</i>Project History</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="logout.php"><i class="material-icons">exit_to_app</i>Sign Out</a></li>
             </ul>
             <div class="footer">
                 <p class="copyright">FYP by Nazrul Nero</a>©</p>
             </div>
         </div>
     </aside>