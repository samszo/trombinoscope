<?php 
$adress=$_GET['m'];
$subject=$_GET['subject'];
$msg=$_GET['msg'];
$your_mail=$_GET['your_mail'];
$msg="E-mail from: ".$your_mail."<br/>"."Message: ".$msg;
$x=""; 
for ($i=0;$i<count($adress);$i++)
 $x=$adress[$i].",".$x;
  if(mail($x,$subject,$msg))
 
?>
