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
<?php
require 'connect.php';

$dbhandle =new mysqli($hostname, $username, $password,$databasename)
  or die("Unable to connect to MySQL");

if ($dbhandle->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
if(!$result=$dbhandle->query("select etime from endtime"))
{
echo "something went wrong";
exit;
}

$row=$result->fetch_row();
$etime=$row[0];
$etime=explode(":",$etime);
$ctime=date("h:i:sa");
$ctime=explode(":",$ctime);
$left=($etime[2]+60*$etime[1]+(60*60)*$etime[0])-($ctime[2]+60*$ctime[1]+60*60*$ctime[0]);
$result->free;
$dbhandle->close();
echo "<div align=\"center\" style=\"position:absolute;top:50%;left:40%;\">
<span style=\"text-align:center;\">Thank You for participating in <h3>BUG ME OUT</h3></span>
<span style=\"text-align:center;\">This page will be reloded once results are out pobebaly after ".$row[0]."</span>
</div>


<div  style=\"position:absolute;bottom:0;width:99%\" align=\"center\" >
<hr>
developed by department of computer science(by vivek,under the guidance of Mr.Harshavardhan jr,Associate professor) , KSIT.
</div>
</body>
</html>";


header( "refresh:$left;url=http://".$baseurl."/csi/firstroundresult.php" );
?>
