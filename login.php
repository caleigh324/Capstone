<?php
  include_once 'dbh.inc.php';
  session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <style>
  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    border-top-right-radius: 18px;
    border-top-left-radius: 18px;
  }
  li {
    float: left;
  }
  li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  li a:hover {
    background-color: #111;
  }
  </style>
  <title>Arcadia Transfer Equivalency</title>
  <link rel ="stylesheet" type= "text/css" href="style.css">
</head>
<body>

<ul>
  <li><a class="active" href="https://registrar-capstone.herokuapp.com/">Home</a></li>
  <li><a href="about.html">About</a></li>
  <li><a href="login.php">Registrar Login</a></li>
</ul>

</body>


<form method="post">
  Username: <br>
  <input type="text" name="username" value="" style="font-size:18pt;height:40px;width:250px;" id="ip1">
  <br>
  Password: <br>
  <input type="password" name="password" value="" style="font-size:18pt;height:40px;width:250px;" id="ip1">
  <br>
  <input type="submit" name = "submit" value = "Submit">
</form>
<br>
<br>
<?php
$username = 'admin';
$password = 'Capstone19';

if(isset($_POST['submit'])){
  if($_POST['username'] === $username && $_POST['password'] === $password){
    echo "Login successful";
    echo "<br>";
    echo "<div class = 'import'><form action = '' method = 'post' name = 'multipart/form-data'><input type = 'file' name = 'file' value = ''/>  <input type ='submit' name = 'submit' value = 'Import CSV'></form>";
      $conn = mysqli_connect($cleardb_server, "root", "", "transfer");

      if ( isset($_POST["submit"]) ) {
         if ( isset($_FILES["file"])) {
                  //if there was an error uploading the file
              if ($_FILES["file"]["error"] > 0) {
                  echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
              }
              else {
                       //Print file details
                   echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                   echo "Type: " . $_FILES["file"]["type"] . "<br />";
                   echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                   echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
                       //if file already exists
                   if (file_exists("upload/" . $_FILES["file"]["name"])) {
                  echo $_FILES["file"]["name"] . " already exists. ";
                   }
                   else {
                          //Store file in directory "upload" with the name of "uploaded_file.txt"
                  $storagename = "uploaded_file.txt";
                  move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
                  echo "Stored in: " . "upload/" . $_FILES["file"]["name"] . "<br />";
                  }
              }
           } else {
                   echo "No file selected <br />";
           }
     }
  }
  else{
    echo "Login unsuccessful";
    }
  }
else{
  echo "";
}
?>

</div>
</html>
