<?php
require 'connect.php';
session_start();
$usn = $_SESSION['usn'];
echo  $usn."<br>";

$dbhandle =new mysqli($hostname, $username, $password,$databasename)
  or die("Unable to connect to MySQL");

if ($dbhandle->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

$result=$dbhandle->query("select * from Questions");
$n=$result->num_rows;
echo "toatal number of questions :".$n."<br>";

echo "<h1>usn=$usn</h1>";
$time=date("h:i:sa");
$total=0;
for($i=0;$i<$n;$i++)
{  
   $row=$result->fetch_row(); 
   $query=$dbhandle->prepare("insert into marks(usn,question_id,u_marks,s_choice) values(?,?,?,?)");
   echo $_POST[$row[0]]."<br>";
   $choice=$_POST[$row[0]]; 
   if($row[3]==($_POST[$row[0]]))
       {
          $total+=$row[2]; 
          
          
          $query->bind_param("sddd",$usn,$row[0],$row[2],$choice);  
          if(!$query->execute())
            {
  			echo "<br>somthing went wrong in choice ".$query->error;
  
 		    exit();
            }
       }
    else {  
                $temp=0;
                $query->bind_param("sddd",$usn,$row[0],$temp,$choice);  
          if(!$query->execute())
            {
  			echo "<br>somthing went wrong ".$query->error."<br> ";
  
 		    exit();
            }
 
     
       }
    $query->close();   
}

  $query=$dbhandle->prepare("update contestents  set total_marks=?,submit_time=? where usn=? ") or die("prepare wrong");
  $query->bind_param("dss",$total,$time,$usn);
      if(!$query->execute())
            {
  			echo "<br>somthing went wrong ".$query->error."<br> ";
  
 		    exit();
            }
$query->close();
$result->free();
echo "<br>total score : $total";
$dbhandle->close();
header("Location: http://".$baseurl."/csi/endtest.php");
?>
