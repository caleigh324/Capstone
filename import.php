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
  <li><a href="form.html">Add Course</a></li>
  <li><a href="import.php">Import New CSV</a></li>
</ul>

</body>

<div class = "import">
<form action = "import.php" method = "post" enctype="multipart/form-data">
<input type = "file" name = "file" value = ""/>
<input type ="submit" name = "submit" value = "Import CSV">
</form>
<?php
$conn = mysqli_connect("localhost", "root", "", "transfer");

if (isset($_POST["submit"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
         $sqlDelete = "DELETE FROM data1";
         $result1 = mysqli_query($conn, $sqlDelete);
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into data1 (ORG_CODE_ID,SCHOOL,TRANSFER_COURSE,TRANSFER_TITLE,TRANSFER_SUB_TYPE,ARCADIA_COURSE,ARCADIA_SUB_TYPE,ARCADIA_TITLE,CURRICULAR_REQUIREMENT)
                   values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','". $column[5]."','".$column[6]."','". $column[7]."','". $column[8]."')";
            $result = mysqli_query($conn, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}

?>
</div>
</br>
</html>
