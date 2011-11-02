<?php





$TO = "rosa.lakroue@gmail.com";

$h  = "From: " . $TO;

$message = "";

while (list($key, $val) = each($HTTP_POST_VARS)) {
  $message .= "$key : $val\n";
}

mail($TO, $subject, $message, $h);

Header("Location: GalerieComplete.php");



 // une fonction pour decouper le title en nom prénom et mail: 

	function Cut_Tilte($title)
	{ // declarer le tableau a vide il sera returer par la fonction
	$separateur=",";
	$tab_elements=array();
	  $tok= strtok($title, $separateur);
	  while ($tok !=false)
	   {$tab_elements[]=$tok;
	  // à fragmenter on continue
	 $tok = strtok($separateur);
	  }
	  return $tab_elements;
	  }
  
?>