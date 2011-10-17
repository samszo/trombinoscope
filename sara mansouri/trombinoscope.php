<?php

include"entete.php";

$rep="photo";
$id_rep=opendir($rep);

function vignette($fichier)
{
$size=getimagesize("photo/$fichier");
$source_image=imagecreatefromjpeg("photo/$fichier");
$dest_image=imagecreatetruecolor(120,80);

imagecopyresampled($dest_image,$source_image,0,0,0,0,120,80,$size[0],$size[1]);
imagejpeg($dest_image,"Vignette/_$fichier",60);
imagedestroy($source_image);
imagedestroy($dest_image);
}


echo"<table border='0' cellspacing='5'>";
$n=0;
while($fichier=readdir($id_rep))

{
$nom_fichier=substr("$fichier",0,strpos("$fichier","."));
$extension=substr($fichier,-3);
if($fichier!="." && $fichier!=".." && (@eregi("gif",$extension)||@eregi("jpg",$extension)))
{
vignette($fichier);
echo "<td> 
<a href='Affichagephoto.php?fichier=$rep/$fichier'><div style='text-align:center;width:auto;' ><img src='Vignette/_$fichier' border='O' alt='$fichier' vspace='10' title='$nom_fichier' style='margin-bottom:5px;'>
<span style='position:relative;top:-6px;'><h5> $nom_fichier</h5></div></a>

</td>";
 $n++;
 if($n==6)
 {
 echo"</tr><tr>";
 $n=0;
 }
}
}
?>


