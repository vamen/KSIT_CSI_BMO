<?php
require  'connect.php';

$dbhandle =new mysqli($hostname, $username, $password,$databasename)
  or die("Unable to connect to MySQL");

if ($dbhandle->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

$name=$_POST["username"];
$usn=$_POST["usn"];
$college=$_POST["college"];
$phone=$_POST["phone"];
$mail=$_POST["mail"];

$query=$dbhandle->prepare("insert into contestents(usn,username,college,phone,mail) values(?,?,?,?,?)");
$query->bind_param("sssss",$usn,$name,$college,$phone,$mail);
if(!$query->execute())
  {
  echo "somthing went wrong in contestent insert".$query->error;
  exit();
  }
else{
session_start();
$_SESSION['usn']=$usn;
echo "success<br>";
header("Location: http://".$baseurl."/csi/instruction.html");
exit;
}
?>
