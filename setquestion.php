<?php 
$username = "root";
$password = "root";
$hostname = "127.0.0.1"; 
$databasename="csi_BMO";

$dbhandle =new mysqli($hostname, $username, $password,$databasename)
  or die("Unable to connect to MySQL");

if ($dbhandle->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}


$question=$_POST["question"];
$question_id=$_POST["question_id"];
$marks=$_POST["marks"];
$query=$dbhandle->prepare("insert into Questions values(?,?,?)") or die("prpare fail");
#echo "$question\n";
$query->bind_param("dsd",$question_id,$question,$marks);
if(!$query->execute())
  {
  echo "somthing went wron";
  exit();
  }
$query->close(); 
  #echo "inserted question<br>";
for($i=1;$i<=4;$i++)
  {
$ch=$_POST["choice".$i.""];
$query=$dbhandle->prepare("insert into Choice values(?,?)");
$query->bind_param("ds",$question_id,$ch);
if(!$query->execute())
  {
  echo "somthing went wron";
  exit();
  }
  # echo "inserting choice<br>";
}
$query->close();
echo "<html><head><title>question</title></head><body>"; 
echo "<h3>insertion success</h3><br>";
$query=$dbhandle->prepare("select * from Questions where question_id=?");
$query->bind_param("d",$question_id);
if(!$query->execute())
  {
  echo "somthing went wron</body></html>";
  
  exit();
  }
$query->bind_result($question_id,$question,$marks);
$query->fetch();
echo "<hr><h4>$question_id) $question</h4>";
$query->close();
$ch=array('a','b','c','d');
$query=$dbhandle->prepare("select choice_text from Choice where question_id=?");
$query->bind_param("d",$question_id);

if(!$query->execute())
  {
  echo "somthing went wrong</body></html>";
  
  exit();
  }
  $query->bind_result($choice);
  $i=0; 
   while($query->fetch())
     {
      echo "$ch[$i]) $choice<br>";
     $i=$i+1;
     }
$query->close();
$dbhandle->close();
 echo "marks :$marks</body></html>"
?>
