<html>
<head>
<title>Bug Me Out</title>
</head>
<link rel="stylesheet" href="http://127.0.0.1/csi/header.css">

<script type="text/javascript" language="javascript">
var h=0;
var m=1;
var s=5;
function renderTime() {
				
setTimeout('renderTime()',1000);

if(s == 0){
if(m==0)
 {
  

  alert("form is submitting\n");
  document.contest.submit(); 
  return ;
 }
s=59;
--m;
	if(m<10)
	{
	m="0"+m;
	}
}	
else {
--s;
if(s<10)
{
	s="0"+s;
}
}


 var myClock = document.getElementById('clockDisplay');
myClock.textContent =  m + ":" + s ;
myClock.innerText = m + ":" + s;
}
renderTime();

</script>

<body  >

<!--<div id="clockdiv">
 
  
  <div>
    <span class="minutes"></span>
    <div class="smalltext">Minutes</div>
  </div>
  <div>
    <span class="seconds"></span>
    <div class="smalltext">Seconds</div>
  </div>
</div>-->










<div>
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
<hr>
<div ><span>Time left :</span><lable id="clockDisplay" class="clockStyle"></lable></div>
</div>



</div>

</div>



<div id="div1" style="padding-left:20px;padding-right:20px">

<?php
require 'connect.php';
/*
if(!isset($_COOKIE['csiusn']))
{
echo "something is wrong contact coordinator<br>(cookie not set)";
exit();
}
*/


$dbhandle =new mysqli($hostname, $username, $password,$databasename)
  or die("Unable to connect to MySQL");

if ($dbhandle->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
session_start();
$usn = $_SESSION['usn'];
$result=$dbhandle->query("select * from Questions");

$choices=$dbhandle->prepare("select choice_text from Choice where question_id=?");


echo "<form action=\"http://".$baseurl."/csi/storeresult.php\" id=\"contest\" name=\"contest\" method=\"POST\" onkeypress=\"return event.keyCode != 13;\">";
echo "<lable><h1>usn : $usn</h1><lable> "; 

 while($row=$result->fetch_row())
    {
    	echo "<pre><lable>$row[0] ) $row[1]</lable></pre><br>";
    	
        
        $choices->bind_param("d",$row[0]);
            	
    	if(!$choices->execute())
        {
  			echo "somthing went wrong in choice ".$choices->error."</body></html>";
  
 		    exit();
        }
        $choices->bind_result($choice_text);  
        $ch=array('a','b','c','d');
        $i=1;
        while($choices->fetch())
        {
            echo "<input type=\"radio\" value=\"$i\" name=\"".$row[0]."\">".$choice_text."<br>";
            $i=$i+1;
        }  
         echo "<input type=\"radio\" value=\"0\" name=\"".$row[0]."\" checked=\"checked\">not answered";
       echo "<hr width=\"80%\"><br>";
    }
echo "<div align=\"center\"><input style=\"width:80px;height:30px;background-color:#0f3260;color:white;border:0px;\"type=\"submit\" value=\"Submit\"/></div>";
echo "</form>";
$choices->close();
$dbhandle->close();

?>
</div>



<div  style="position:relative;bottom:0;width:99%" align="center" >
<hr>
developed by department of computer science(vivek,under the guidance of Mr.Harshavardhan jr,Associate professor), KSIT.
</div>
</body>
</html>

