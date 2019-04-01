<?php
if($_POST["Uname"]) {
    mail("caleighdief@gmail.com", "Form to email message", $_POST["Uname"], $_POST["Ccode"], $_POST["Cname"], "From Course Equivalency Website");
}
?>
