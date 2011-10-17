<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
</head>
<body>
<?php
include "entete.php";
$photo=$_GET["fichier"];

echo"<br> <center>";
echo"<img src='$photo' border='0' width=350 height=310><br>";
?>

 
<a href="#" onClick="formulaire()">Inserer une légende</a></br>

<a href='tof.php'> Retour </a>

</body>
</html>








