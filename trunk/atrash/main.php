<html>
<head>
<title>ALA ATRASH PROJECT</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="photo.css" />

</head>
<body>
<script type="text/javascript">
 function show_table() {
	 document.getElementById("send").style.display="block" ;    
	 }
 
</script>
<div class="title">***************This is done by Ala ATRASH
***************</div>
<br />
<input type="button" value="Send an e-mail to selected persons" onclick="show_table();" />
<br />
<br />
<form action="sendmail.php" method="get">

<table id="send" style="display:none;">
	<tr>
		<td>your e-mail:</td>
		<td><input type="text" name=your_mail /></td>
	</tr>
	<tr>
		<td>subject:</td>
		<td><input type="text" name=subject /></td>
	</tr>
	<tr>
		<td>your message:</td>
		<td><textarea name="msg" rows="10" cols="30"></textarea></td>
	</tr>
	<tr>
		<td><input type="submit" value="send"></td>
	</tr>
</table>
<?php
 $mail_list= array();

 $simple_xml = simplexml_load_file ( "http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=en_US" );
 foreach ( $simple_xml->channel->item as $x ) {
 ?>
<div class="imge"><img src="<?php echo $x->enclosure['url'];?>"
	width="150" height="150" />
<div class="des">
     <?php
       $strings = explode(", ",$x->title);  
       echo $strings[0]." ".$strings[1]."<br/>" ; 
       echo "E-mail: ".$strings[2]."<br/>";
       echo '<input type="checkbox" name="m[]" value="'.$strings[2].'"> send mail </input> <br/> ' ;
      
     ?>
    </div>
</div>    
<?php }?>
</form>
</body>
</html>