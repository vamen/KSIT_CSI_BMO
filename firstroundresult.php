<html>
<head>
<title>Thank you</title>
<link rel="stylesheet" href="http://127.0.0.1/csi/header.css">
</head>
<body>
<div align="center" id="id1">
<div style="display:inline-block;float:left" align="left">
<img id="id5" src="ksitlogo.jpg" alt="ksit"/>
</div>
<div style="display:inline-block;float:right" align="right">
<img id="id6" src="CSILogo.jpg" alt="ksit"/>
</div>
<div style="display:inline-block;" align="center">
<p id="id2">BUG ME OUT</p>
<p id="id3">Jointly Organized By</p>
<p id="id4">CSI and K.S Institute Of Technlology</p>  
</div>
<hr>
</div>

<div align="center">
<h1>contestants made though first round</h1>
<table border="1">
<tr><th>usn</th><th>name</th><th>college</th></tr>
<?php
require 'connect.php';
#number of contestants selected
$username = "root";
$password = "root";
$hostname = "localhost"; 
$databasename="csi_BMO";
$dbhandle =new mysqli($hostname, $username, $password,$databasename)
  or die("Unable to connect to MySQL");

if ($dbhandle->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

#$result=$dbhandle->query("select * from contestents where usn=$usn and usn in select usn from contestents order by total_marks DESC,submit_time ASC limit 2") or die("incorrect query");

$result=$dbhandle->query("select usn,username as name,college from contestents order by total_marks DESC,submit_time ASC") or die("query error");
for($i=0;$i<$n;$i++)
  {  
     $row=$result->fetch_row();
     echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
   } 
?>
</table>
</div>
<hr>
<div  style="position:relative;bottom:0;width:99%" align="center" >
<hr>
developed by department of computer science(by vivek,under the guidance of Mr.Harshavardhan jr,Associate professor) , KSIT.
</div>
</body>
</html>
