<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mon formulaire.</title>
</head>
<body>

<form name='formulaire' action='#' method='post'>
<table>
<th>Formulaire de contact</th>

<tr><td>Votre email</td><td><input name='email' type='text' size='50'></td></tr>
<tr><td>Sujet</td><td><input name='sujet' type='text' size='50'></td></tr>
<tr><td>Votre message</td><td><textarea name='texte' cols='50' rows='20'></textarea></td></tr>
<tr><td><input name='annuler' type='reset' value='Annuler'></td><td>
<input  type='submit' value='Envoyer'></td></tr>
</table>
</form>
</body>
</html>
<?php


//Récuperer l'adresse email 
$mail = $_GET['ar']; 

$TO = "$mail";
$from=$_POST['email'];
$h  = "From: " .$from ;

$message = "";

while (list($key, $val) = each($HTTP_POST_VARS)) {
  $message .= "$key : $val\n";
  }
$subject="test";

mail($TO, $subject, $message, $h);



?>

