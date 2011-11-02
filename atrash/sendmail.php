<?php 
$adress=$_GET['m'];
$subject=$_GET['subject'];
$msg=$_GET['msg'];
$your_mail=$_GET['your_mail'];
$msg="E-mail from: ".$your_mail."<br/>"."Message: ".$msg;
$x=""; 
for ($i=0;$i<count($adress);$i++)
//$x is all the mail adreses separated by cammas
 $x=$adress[$i].",".$x;
 //sending the mails
  mail($x,$subject,$msg);
   header('Location:main.php');
?>
