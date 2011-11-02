
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Galerie photo</title>
	<script src="jquery-1.4.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="loopedslider.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="style.css" />
	
	<style type="text/css" media="screen">	
		/*
		 * Required 
		*/
		.container { width:500px; height:375px; overflow:hidden; position:relative; cursor:pointer; }
		.slides { position:absolute; top:0; left:0; }
		.slides > div { position:absolute; top:0; width:500px; display:none; }
		/*
		 * Optional
		*/
		#loopedSlider,#newsSlider { margin:0 auto; width:500px; position:relative; clear:both; }
		ul.pagination { list-style:none; padding:0; margin:0; }
		ul.pagination li  { float:left; }
		ul.pagination li a { padding:2px 4px; }
		ul.pagination li.active a { background:blue; color:white; }
	</style>
</head>

   <body class="body">
         
              <?php
                 $simple_xml = simplexml_load_file( "http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=en_US" );
                 $j=0;
				 $Member_List = array(array()) ;
				 
                 foreach ( $simple_xml->channel->item as $tab ) {
				          $Member_List[$j][0] =$tab->enclosure['url'];
					      $tab_list= Cut_Tilte($tab->title);
					      $taille = count($tab_list);
						     
					         for($i=0; $i<$taille;$i++ )
					         { $Member_List[$j][$i+1] =$tab_list[$i]; }
							 if($taille=2) $Member_List[$j][3]=" ";
				
					 $j=$j+1;
					//  print_r($Member_List);
				 } 
				// print_r($Member_List);
             ?> 
     <div id="contenu">
	     <div id="top">
                     <div id="topnav">
					     <table>
					         <tr>
						         <td>
							   
							     </td>
                                 <td>
							        <a href="http://hypermedia.univ-paris8.fr">D&eacute;partement Hyperm&eacute;dia             </a>
							     </td>
							     <td class="">
							     <a href="http://www.univ-paris8.fr">Universit&eacute; Paris8</a>
						         </td>
                             </tr>
					     </table> 
					 </div>
					 <div id="header">
                         <a href="hypermedia.univ-paris8.fr">
                             <img class="logo" alt="logo-hyper" src="images/logo.jpg">
                         </a>
					 </div> 
					 <div id="titre">
                         <h3 class="texttitre"> Galerie de photos promotion 2011-2012 Hypermedia Thyp </h3>  
					 </div> 
	      </div>
		    <table>
			<tr>
			   <td>
					 <div id="slide">
					     <div id="loopedSlider">	
						     <div class="container">
						         <div class="slides">
		                          <?php for($Np = 0; $Np< $j; $Np++) { //boucle sur les les personnes 
		                          ?>
			                     <div><img src="<?php echo  $Member_List[$Np][0] ;?>" width="500" height="375" alt=" <?php echo $Member_List[$Np][1];?>" title="" <?php echo $Member_List[$Np][1];?>"" />
								  <div id="infoslide"> <?php echo $Member_List[$Np][1];?> 
								  </div> 
								  </div>
								   <?php 
                                 } 
                                 ?>
	      	                     </div>
								 
	                         </div>
							 
	                           <a href="#" class="previous">previous</a>
	                           <a href="#" class="next">next</a>
                         </div>
						  
		             </div>
                </td>
				</tr>
				<tr>
				<td > Envoyer un Mail
				 <div id="mail">
					<form method=POST action=formmail.php >
                      <input type=hidden name=subject value=formmail>
                      <table>
					 
                      <tr><td>Votre Nom:</td>
                      <td><input type=text name=realname size=30></td></tr>
                      <tr><td>Votre Email:</td>
                      <td><input type=text name=email size=30></td></tr>
                      <tr><td>Sujet:</td>
                      <td><input type=text name=title size=30></td></tr>
                      <tr><td colspan=2>Commentaires:<br>
                      <textarea COLS=50 ROWS=6 name=comments></textarea>
                       </td></tr>
                      </table>
                     <br> <input type=submit value=Envoyer> 
                       <input type=reset value=Annuler>
                 </form>
					      
                  </div>
				</td>
				</tr>
			</table>	 
					 
	 </div>

<?php // une fonction pour decouper le title en nom prénom et mail: 

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
<script type="text/javascript" charset="utf-8">
	$(function(){
		// Option set as a global variable
		$.fn.loopedSlider.defaults.addPagination = true;
		
		$('#loopedSlider').loopedSlider({
			autoStart: 3500,
			hoverPause: true
		});
	});
</script>

</body>
</html>
