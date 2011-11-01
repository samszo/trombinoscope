<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>M2 THYP</title>	
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="js/jquery-easing-1.3.pack.js"></script>
	<script type="text/javascript" src="js/jquery-easing-compatibility.1.2.pack.js"></script>
	<script type="text/javascript" src="js/coda-slider.1.1.1.pack.js"></script>	
	<script type="text/javascript">
	
		var theInt = null;
		var $crosslink, $navthumb;
		var curclicked = 0;
		
		theInterval = function(cur){
			clearInterval(theInt);
			
			if( typeof cur != 'undefined' )
				curclicked = cur;
			
			$crosslink.removeClass("active-thumb");
			$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');
			
			theInt = setInterval(function(){
				$crosslink.removeClass("active-thumb");
				$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');
				curclicked++;
				if( 14 == curclicked )
					curclicked = 0;
				
			}, 3000);
		};
		
		$(function(){
			
			$("#main-photo-slider").codaSlider();
			
			$navthumb = $(".nav-thumb");
			$crosslink = $(".cross-link");
			
			$navthumb
			.click(function() {
				var $this = $(this);
				theInterval($this.parent().attr('href').slice(1) - 1);
				return false;
			});
			
			theInterval();
		});
	</script>
<body>
<div class="cadre1">
	
	<div id="page-wrap">
	<div class="promo">
	<span  style="color: #7C93F9;font-size: 16px;margin: 0;padding: 0;text-align: center;">PROMO THYP 11-12</span>
	</div>										
	<div class="slider-wrap">
		<div id="main-photo-slider" class="csw">
			<div class="panelContainer">
				<?php
				$simple_xml = simplexml_load_file ( "http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=en_US" );
				foreach ( $simple_xml->channel->item as $x ) {
				?>
				<div class="panel" title="Panel 1">
					<div class="wrapper">
						<img class="big_img" src="<?php echo $x->enclosure['url'];?>" alt="temp" width="150" height="150" />
						<div class="photo-meta-data">
							Contact: <a href="#"><?php echo $x->title;?></a><br />
							
						</div>
					</div>
				</div>
			 <?php }?>
			</div>
		</div>		
		<div id="movers-row">
		<?php
			$i = 1;
			$adr = "#";
			$simple_xml = simplexml_load_file ( "http://picasaweb.google.com/data/feed/base/user/107353736179759429408/albumid/5659262403796066625?alt=rss&kind=photo&hl=en_US" );
			foreach ( $simple_xml->channel->item as $x ) {				
		?>
			<div><a href="<?php   echo $adr . $i; $i = $i +1; ?>" class="cross-link"><img src="<?php echo $x->enclosure['url'];?>" class="nav-thumb" alt="temp-thumb" /></a></div>
		 <?php }?>
		</div>		
	</div>	
	</div>
</div>
</body>
</html>