<?php 
require 'connect.php'; 
$dbhandle =new mysqli($hostname, $username, $password,$databasename)
  or die("Unable to connect to MySQL");

if ($dbhandle->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}


$question=$_POST["question"];
$question_id=$_POST["question_id"];
$marks=$_POST["marks"];
$answer=$_POST["answer"];
$query=$dbhandle->prepare("insert into Questions values(?,?,?,?)") or die("prpare fail");
#echo "$question\n";
$query->bind_param("dsdd",$question_id,$question,$marks,$answer);
if(!$query->execute())
  {
   echo $query->error;
  echo "something went wrong";
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
  echo "something went wrong";
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
  echo "something went wrong</body></html>";
  
  exit();
  }
$query->bind_result($question_id,$question,$marks);
$query->fetch();
echo "<hr><h4><pre>$question_id) $question<pre></h4>";
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
 echo "marks :$marks,ansewr :$answer</body></html>"
?>
