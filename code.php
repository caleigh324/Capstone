<?php
  include_once 'dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Arcadia Transfer Equivalency</title>
  <link rel ="stylesheet" type= "text/css" href="style.css">
</head>
<body>
  <?php
  $sql = "SELECT DISTINCT school FROM data;";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
?>
<div class ="intro">
<h1>Arcadia Transfer Equivalency</h1>
<br>
<p>This website is the Capstone project for Caleigh Diefenthaler,
  Christian Charney, and Dylan Power for the registrar and Bill Elnick</p>
</div>
<div class = "school">
<h3>Please select the university you previously attended</h3>
<form action = "#" method = "post">
<select name="school" size ="10">
  <?php
  if ($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
      // inserts all data as array
      echo "<option>". $row['school'] ."</option>";
          }
  }
  ?>
</select>
<br>
<input type ="submit" name = "submit_school" value = "Enter">
</form>
<?php
$selected_school = "";
if(isset($_POST['submit_school'])){
  $selected_school = mysqli_real_escape_string($conn, $_POST['school']);
  echo "You have selected: " .$selected_school;
}
 ?>
</div>

<div class ="courses">
<h3>Please select the courses you took</h3>

<form action = "#" method ="post">
  <?php
  //$courseName = $row['transfer_course'] . ' ' . $row['transfer_title'];
  //create template
  $sql = "SELECT transfer_course, transfer_title FROM data WHERE school = ? ORDER BY transfer_course ASC";
  //create prepared statement
  $stmt = mysqli_stmt_init($conn);
  //prepare prepared Statement
  //if it doesn't work
  if(!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed";
  } else {
    //bind parameters to the placeholder
    //s is for one single string value
    mysqli_stmt_bind_param($stmt, "s", $selected_school);
    //run parameters inside database
    mysqli_stmt_execute($stmt);
    $result2 = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($result2)){
      // inserts all data as array
      //echo "<option>". $row['courses'] ."</option>";
      echo "<input type='checkbox' name ='boxes[]' value = '" . $row['transfer_course'] . ' ' . $row['transfer_title'] ."' >" . $row['transfer_course'] . ' ' . $row['transfer_title'] . "<br>";
          }
  }
  $selected_course = $row['transfer_course'];

  //value =' . $row['transfer_course'] . '
  ?>
<br>
<input type ="submit" name = "submit_courses" value = "Enter">
</form>
<?php
if(isset($_POST['submit_courses'])){//to run PHP script on submit
  if(!empty($_POST['boxes'])){
    // Loop to store and display values of individual checked checkbox.
    foreach($_POST['boxes'] as $selected){
      echo "You have selected: " . $selected . "</br>";
    }
  }
}
 ?>
</div>


<div class ="other">
<h3>If your university or course was not listed, please enter it here</h3>
<textarea name="message" rows="10" cols="50">
</textarea>
</div>
</body>

</html>
