<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta http-equiv="Content-Script-Type" content="text/javascript"; charset=ISO-8859-1">
<script type="text/javascript">
function afficher(formulaire){

}
.../...
</script>
<title>Insert title here</title>
</head>
<body>
<?php
include "entete.php";
$photo=$_GET["fichier"];

echo"<br> <center>";
echo"<img src='$photo' border='0' width=350 height=310><br>";

echo"<a href='trombinoscope.php'> Retour </a>";
?>
<form name="formulaire">
<input type="text" name ="input" value="">
<input type="button" name ="buton" value="Afficher" onclick="afficher(formulaire)"></br>
<input type="text" name ="output" value="">
</form>

</body>
</html>








