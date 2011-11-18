
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instituto Kineret de Dança Israeli</title>
<link rel="stylesheet" type="text/css" href="../page.css" />
		<script src="http://www.google.com/jsapi" type="text/javascript"></script>
		<script type="text/javascript" charset="utf-8">
			google.load("jquery", "1.3");
		</script>
		
		<script src="http://connect.facebook.net/en_US/all.js#appId=195665680459157&amp;xfbml=1"></script>
		
			<script type="text/javascript">
			$(document).ready(function(){
			$("#init_grupos").show(300);
			  	$("	#gaash_badge_wrapper img").click(function(){return false;
			});
			
			$("#f_2008").mouseenter(function(){
					$("#f_2008").css("color","#fdb813");
					$("#f_2008").css("opacity","1");	
			});
			$("#f_2009").mouseenter(function(){
					$("#f_2009").css("color","#fdb813");
					$("#f_2009").css("opacity","1");	
			});
			$("#f_2010").mouseenter(function(){
					$("#f_2010").css("color","#fdb813");
					$("#f_2010").css("opacity","1");	
			});
			$("#f_2011").mouseenter(function(){
					$("#f_2011").css("color","#fdb813");
					$("#f_2011").css("opacity","1");	
			});
			
			$("#f_2008").mouseleave(function(){
					if ($(".c_2008").is(":hidden")){
						$("#f_2008").css("color","#525252");				
											
						$("#f_2008").css("opacity","0.5");		
					}
					else	{	
						$("#f_2008").css("color","#440740");				
						
						$("#f_2008").css("opacity","1");		
					}			
			});
			$("#f_2009").mouseleave(function(){
					if ($(".c_2009").is(":hidden")){
						$("#f_2009").css("color","#525252");				
											
						$("#f_2009").css("opacity","0.5");		
					}
					else	{	
						$("#f_2009").css("color","#440740");				
						
						$("#f_2009").css("opacity","1");		
					}			
			});
			$("#f_2010").mouseleave(function(){
				if ($(".c_2010").is(":hidden")){
					$("#f_2010").css("color","#525252");				
										
					$("#f_2010").css("opacity","0.5");		
				}
				else	{	
					$("#f_2010").css("color","#440740");				
					
					$("#f_2010").css("opacity","1");		
				}
			});
			$("#f_2011").mouseleave(function(){
				if ($(".c_2011").is(":hidden")){
					$("#f_2011").css("color","#525252");				
										
					$("#f_2011").css("opacity","0.5");		
				}
				else	{	
					$("#f_2011").css("color","#440740");				
					
					$("#f_2011").css("opacity","1");		
				}
		});
			
			
			$("#f_2008").click(function(){
					$("#f_2011").css("color","#525252");
					$("#f_2011").css("opacity","0.5");
					$("#f_2008").css("color","#440740");
					$("#f_2008").css("opacity","1");
					$("#f_2009").css("color","#525252");
					$("#f_2009").css("opacity","0.5");
					$("#f_2010").css("color","#525252");
					$("#f_2010").css("opacity","0.5");
					
					$(".c_2008").show(700);
					$(".c_2009").hide(700);
					$(".c_2010").hide(700);
					$(".c_2011").hide(700);
					
					$(".slideshow").hide(600);
					$(".facebook").hide(600);
					$(".desc_recs span").hide(600);
					
					
			});
			$("#f_2009").click(function(){
					$("#f_2011").css("color","#525252");
					$("#f_2011").css("opacity","0.5");
					$("#f_2009").css("color","#440740");
					$("#f_2009").css("opacity","1");
					$("#f_2008").css("color","#525252");
					$("#f_2008").css("opacity","0.5");
					$("#f_2010").css("color","#525252");
					$("#f_2010").css("opacity","0.5");
					$(".c_2008").hide(700);
					$(".c_2009").show(700);
					$(".c_2010").hide(700);
					$(".c_2011").hide(700);
					$(".slideshow").hide(600);
					$(".facebook").hide(600);
					$(".desc_recs span").hide(600);
					
			});
			$("#f_2010").click(function(){
					$("#f_2011").css("color","#525252");
					$("#f_2011").css("opacity","0.5");
					$("#f_2010").css("color","#440740");
					$("#f_2010").css("opacity","1");
					$("#f_2009").css("color","#525252");
					$("#f_2009").css("opacity","0.5");
					$("#f_2008").css("color","#525252");
					$("#f_2008").css("opacity","0.5");
				$(".c_2008").hide(700);
				$(".c_2009").hide(700);
				$(".c_2010").show(700);
				$(".c_2011").hide(700);
				$(".slideshow").hide(600);
				$(".facebook").hide(600);
				$(".desc_recs span").hide(600);
				
			});
			$("#f_2011").click(function(){
					$("#f_2011").css("color","#440740");
					$("#f_2011").css("opacity","1");
					$("#f_2010").css("color","#525252");
					$("#f_2010").css("opacity","0.5");
					$("#f_2009").css("color","#525252");
					$("#f_2009").css("opacity","0.5");
					$("#f_2008").css("color","#525252");
					$("#f_2008").css("opacity","0.5");
				$(".c_2008").hide(700);
				$(".c_2009").hide(700);
				$(".c_2010").hide(700);
				$(".c_2011").show(700);
				$(".slideshow").hide(600);
				$(".facebook").hide(600);
				$(".desc_recs span").hide(600);
				
			});
				
				$("#e_20114 h2 a.recs_title").click(function(){
					$("#s_20114").show(700);
					$("#e_20114 h2 span").show();
					$("#e_20114 .facebook").show(400);
				});
				$("#e_20114 h2 span").click(function(){
				$("#s_20114").hide(700);	
				$("#e_20114 h2 span").hide();
				$("#e_20114 .facebook").hide(400);
				});
				
				$("#e_20111 h2 a.recs_title").click(function(){
					$("#s_20111").show(700);
					$("#e_20111 h2 span").show();
					$("#e_20111 .facebook").show(400);
				});
				$("#e_20111 h2 span").click(function(){
				$("#s_20111").hide(700);	
				$("#e_20111 h2 span").hide();
				$("#e_20111 .facebook").hide(400);					});
				
				$("#e_20107 h2 a.recs_title").click(function(){
					$("#s_20107").show(700);
					$("#e_20107 h2 span").show();
					$("#e_20107 .facebook").show(400);
				});
				$("#e_20107 h2 span").click(function(){
				$("#s_20107").hide(700);	
				$("#e_20107 h2 span").hide();
				$("#e_20107 .facebook").hide(400);
				});
				
				$("#e_20106 h2 span").click(function(){
				$("#s_20106").hide(700);	
				$("#e_20106 h2 span").hide();
				$("#e_20106 .facebook").hide(400);
				});
				$("#e_20106 h2 a.recs_title").click(function(){
					$("div.slide_recs #s_20106").show(700);
					$("#e_20106 h2 span").show();
					$("#e_20106 .facebook").show(400);
				});
				
				$("#e_20105 h2 span").click(function(){
				$("#s_20105").hide(700);	
				$("#e_20105 h2 span").hide();
				$("#e_20105 .facebook").hide(400);
				
				});
				$("#e_20105 h2 a.recs_title").click(function(){
					$("#s_20105").show(700);
					$("#e_20105 h2 span").show();
					$("#e_20105 .facebook").show(400);
				});
				$("#e_20104 h2 span").click(function(){
				$("#s_20104").hide(700);	
				$("#e_20104 h2 span").hide();
				$("#e_20104 .facebook").hide(400);
				
				});
				$("#e_20104 h2 a.recs_title").click(function(){
					$("#s_20104").show(700);
					$("#e_20104 h2 span").show();
					$("#e_20104 .facebook").show(400);
				});
				$("#e_20103 h2 span").click(function(){
				$("#s_20103").hide(700);	
				$("#e_20103 h2 span").hide();
				$("#e_20103 .facebook").hide(400);
				
				});
				$("#e_20103 h2 a.recs_title").click(function(){
					$("#s_20103").show(700);
					$("#e_20103 h2 span").show();
					$("#e_20103 .facebook").show(400);
				});
				$("#e_20102 h2 span").click(function(){
				$("#s-20102").hide(700);	
				$("#e_20102 h2 span").hide();
				$("#e_20102 .facebook").hide(400);
				
				});
				$("#e_20102 h2 a.recs_title").click(function(){
					$("#s_20102").show(700);
					$("#e_20102 h2 span").show();
					$("#e_20102 .facebook").show(400);
				});
				$("#e_20101 h2 span").click(function(){
				$("#s_20101").hide(700);	
				$("#e_20101 h2 span").hide();
				$("#e_20101 .facebook").hide(400);
				
				});
				$("#e_20101 h2 a.recs_title").click(function(){
					$("#s_20101").show(700);
					$("#e_20101 h2 span").show();
					$("#e_20101 .facebook").show(400);
				});
				$("#e_20097 h2 span").click(function(){
				$("#s_20097").hide(700);	
				$("#e_20097 h2 span").hide();
				$("#e_20097 .facebook").hide(400);
				
				});
				$("#e_20097 h2 a.recs_title").click(function(){
					$("#s_20097").show(700);
					$("#e_20097 h2 span").show();
					$("#e_20097 .facebook").show(400);
				});
				$("#e_20096 h2 span").click(function(){
				$("#s_20096").hide(700);	
				$("#e_20096 h2 span").hide();
				$("#e_20096 .facebook").hide(400);
				
				});
				$("#e_20096 h2 a.recs_title").click(function(){
					$("#s_20096").show(700);
					$("#e_20096 h2 span").show();
					$("#e_20096 .facebook").show(400);
				});
				$("#e_20095 h2 span").click(function(){
				$("#s_20095").hide(700);	
				$("#e_20095 h2 span").hide();
				$("#e_20095 .facebook").hide(400);
				
				});
				$("#e_20095 h2 a.recs_title").click(function(){
					$("#s_20095").show(700);
					$("#e_20095 h2 span").show();
					$("#e_20095 .facebook").show(400);
				});
				$("#e_20094 h2 span").click(function(){
				$("#s_20094").hide(700);	
				$("#e_20094 h2 span").hide();
				$("#e_20094 .facebook").hide(400);
				
				});
				$("#e_20094 h2 a.recs_title").click(function(){
					$("#s_20094").show(700);
					$("#e_20094 h2 span").show();
					$("#e_20094 .facebook").show(400);
				});
				$("#e_20093 h2 span").click(function(){
				$("#s_20093").hide(700);	
				$("#e_20093 h2 span").hide();
				$("#e_20093 .facebook").hide(400);
				
				});
				$("#e_20093 h2 a.recs_title").click(function(){
					$("#s_20093").show(700);
					$("#e_20093 h2 span").show();
					$("#e_20093 .facebook").show(400);
				});
				$("#e_20092 h2 span").click(function(){
				$("#s_20092").hide(700);	
				$("#e_20092 h2 span").hide();
				$("#e_20092 .facebook").hide(400);
				
				});
				$("#e_20092 h2 a.recs_title").click(function(){
					$("#s_20092").show(700);
					$("#e_20092 h2 span").show();
					$("#e_20092 .facebook").show(400);
				});
				$("#e_20091 h2 span").click(function(){
				$("#s_20091").hide(700);	
				$("#e_20091 h2 span").hide();
				$("#e_20091 .facebook").hide(400);
				
				});
				$("#e_20091 h2 a.recs_title").click(function(){
					$("#s_20091").show(700);
					$("#e_20091 h2 span").show();
					$("#e_20091 .facebook").show(400);
				});
				$("#e_20083 h2 span").click(function(){
				$("#s_20083").hide(700);	
				$("#e_20083 h2 span").hide();
				$("#e_20083 .facebook").hide(400);
				
				});
				$("#e_20083 h2 a.recs_title").click(function(){
					$("#s_20083").show(700);
					$("#e_20083 h2 span").show();
					$("#e_20083 .facebook").show(400);
				});
				$("#e_20082 h2 span").click(function(){
				$("#s_20082").hide(700);	
				$("#e_20082 h2 span").hide();
				$("#e_20082 .facebook").hide(400);
				
				});
				$("#e_20082 h2 a.recs_title").click(function(){
					$("#s_20082").show(700);
					$("#e_20082 h2 span").show();
					$("#e_20082 .facebook").show(400);
				});
				$("#e_20081 h2 span").click(function(){
				$("#s_20081").hide(700);	
				$("#e_20081 h2 span").hide();
				$("#e_20081 .facebook").hide(400);
				
				});
				$("#e_20081 h2 a.recs_title").click(function(){
					$("#s_20081").show(700);
					$("#e_20081 h2 span").show();
					$("#e_20081 .facebook").show(400);
				});
			
				
		
				$("#grupo_yachad").click(function(){
					if ($("#grupo_yachad .unchecked").is(":hidden")){					
					$("#grupo_yachad .unchecked").slideDown(200,function(){$("#grupo_yachad .checked").slideUp(200);});
					$(".desc_recs div:contains('Yachad')").slideToggle(700);
					}
					else
					{	$("#grupo_yachad .checked").slideDown(200,function(){$("#grupo_yachad .unchecked").slideUp(200);});
					$(".desc_recs div:contains('Yachad')").slideToggle(700);
					}
							
				});
			
				$("#grupo_aviv").click(function(){
					if ($("#grupo_aviv .unchecked").is(":hidden")){					
					$("#grupo_aviv .unchecked").slideDown(200,function(){$("#grupo_aviv .checked").slideUp(200);});
					$(".desc_recs div:contains('Aviv')").slideToggle(700);
					}
					else
					{	$("#grupo_aviv .checked").slideDown(200,function(){$("#grupo_aviv .unchecked").slideUp(200);});
					$(".desc_recs div:contains('Aviv')").slideToggle(700);
					}
					
				});
				$("#grupo_medura").click(function(){
					if ($("#grupo_medura .unchecked").is(":hidden")){					
					$("#grupo_medura .unchecked").slideDown(200,function(){$("#grupo_medura .checked").slideUp(200);});
					$(".desc_recs div:contains('Medura')").slideToggle(700);
					}
					else
					{	$("#grupo_medura .checked").slideDown(200,function(){$("#grupo_medura .unchecked").slideUp(200);});
					$(".desc_recs div:contains('Medura')").slideToggle(700);
					}
					
				});
				$("#grupo_gaash").click(function(){
					if ($("#grupo_gaash .unchecked").is(":hidden")){					
					$("#grupo_gaash .unchecked").slideDown(200,function(){$("#grupo_gaash .checked").slideUp(200);});
					$(".desc_recs div:contains('Gaash')").slideToggle(700);
					}
					else
					{	$("#grupo_gaash .checked").slideDown(200,function(){$("#grupo_gaash .unchecked").slideUp(200);});
					$(".desc_recs div:contains('Gaash')").slideToggle(700);
					}
					
			});		
				$("#grupo_akahel").click(function(){
					if ($("#grupo_akahel .unchecked").is(":hidden")){					
					$("#grupo_akahel .unchecked").slideDown(200,function(){$("#grupo_akahel .checked").slideUp(200);});
					$(".desc_recs div:contains('Akahel')").slideToggle(700);
					}
					else
					{	$("#grupo_akahel .checked").slideDown(200,function(){$("#grupo_akahel .unchecked").slideUp(200);});
					$(".desc_recs div:contains('Akahel')").slideToggle(700);
					}
					
			});
				$("#grupo_chavaia").click(function(){
					if ($("#grupo_chavaia .unchecked").is(":hidden")){					
					$("#grupo_chavaia .unchecked").slideDown(200,function(){$("#grupo_chavaia .checked").slideUp(200);});
					$(".desc_recs div:contains('Chavaia')").slideToggle(700);
					}
					else
					{	$("#grupo_chavaia .checked").slideDown(200,function(){$("#grupo_chavaia .unchecked").slideUp(200);});
					$(".desc_recs div:contains('Chavaia')").slideToggle(700);
					}
			});
		});
		</script>
		
				<!-- Start of Flickr Badge -->
				<style type="text/css">
				#gaash_badge_source_txt {padding:0; font: 11px Arial, Helvetica, Sans serif; color:#666666;}
				#gaash_badge_icon {display:block !important; margin:0 !important; border: 1px solid rgb(0, 0, 0) !important; padding:10px 3px 0;}
				#gaash_icon_td {padding:0 5px 0 0 !important; padding:10px 3px 0;}
				.gaash_badge_image {text-align:center !important; padding:10px 3px 0;}
				.gaash_badge_image img {border: 1px solid #440740 !important; padding:10px 3px 0;}
				#gaash_www {display:block; padding:0 10px 0 10px !important; font: 11px Arial, Helvetica, Sans serif !important; color:#3993ff !important;}
				
				#gaash_badge_uber_wrapper a:hover,
				#gaash_badge_uber_wrapper a:link,
				#gaash_badge_uber_wrapper a:active,
				#gaash_badge_uber_wrapper a:visited {text-decoration:none !important; background:inherit !important;color:#3993ff;}
				#gaash_badge_wrapper{margin-left:15px;}
				#gaash_badge_wrapper img{margin:0px 5px 20px;border: 0.5px solid #440740 !important;}
				#gaash_badge_wrapper img:hover{cursor:default;}
				#gaash_badge_source {padding:0 !important; font: 11px Arial, Helvetica, Sans serif !important; color:#666666 !important;}
				</style>
		
				<!-- End of Flickr Badge -->
		
		
		<style type="text/css" media="screen">
			
			ul li { display: inline; }
			
			}
		</style>
	</head>
	<body class="recs">
<div id="header-top">
	<?php include ("../menu.html"); ?>
</div>
<div id="patrocinio_content">
		<table>
			<tr>
				<td class="patro">
					<img id="chl" src="../assets/logos/patro2.png"></img>
					<img id="chcj" src="../assets/logos/klabin.png"></img>
					<img id="werner" src="../assets/logos/Logo_Werner.png"></img>
					<img id="werner" src="../assets/logos/jocitex.png"></img>
					<img id="tenax" src="../assets/logos/tenax.png"></img>
				</td>
				<!--
				<td class="patro">
					<img id="chcj" src="../assets/logos/chcj.png"></img>
					<img id="mourady" src="../assets/logos/patro1.png"></img>
					<img id="chl" src="../assets/logos/patro2.png"></img>
					<img id="tenax" src="../assets/logos/tenax.png"></img>
				</td>
				<td class="patro2">
					<img id="enjoy" src="../assets/logos/enjoy.png"></img>
					<img id="novatec" src="../assets/logos/novatec.png"></img>
				</td>
				<td class="apoio">
					<img id="cotrauma" src="../assets/logos/cotrauma.png"></img>
					<img id="brokers" src="../assets/logos/brokers.png"></img>
					<img id="sender" src="../assets/logos/sender.png"></img>
					<img id="mahogany" src="../assets/logos/mahogany.png"></img>
					<img id="apoio1" src="../assets/logos/apoio1.png"></img>
					<img id="apoio2" src="../assets/logos/apoio2.png"></img>
					<img id="apoio3" src="../assets/logos/apoio3.png"></img>
					<img id="apoio4" src="../assets/logos/apoio4.png"></img>
				</td> -->
			</tr>
		</table>
</div>
<div id="content">

	<div id="tabela">
				<div class="filtro_anos">
					<p>Quero ver as recordações de
					<a class="f_ano" id="f_2008" style="opacity:0.5;filter:alpha(opacity=50);" href="#">2008</a>
					<a class="f_ano" id="f_2009" style="opacity:0.5;filter:alpha(opacity=50);" href="#">2009</a>
					<a class="f_ano" id="f_2010" style="opacity:0.5;filter:alpha(opacity=50);" href="#">2010</a>
					<a class="f_ano" id="f_2011" style="color:#440740" href="#">2011</a></p>
				</div>
		<div class="slide_recs">
			<div class="slideshow" id="s_20114">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157627996722513&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20111">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157626327523342&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20107">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157625690650524&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow"  id="s_20106">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157625565450163&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20105">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157625690646560&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20104">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157625684753882&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20103">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157625684744098&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20102">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157623707611086&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20101">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157624019889307&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20097">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157623584325249&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20096">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157623708860556&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20095">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157623708873996&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20094">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157623708868808&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20093">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157623708632660&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20092">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157623708646422&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20091">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157625690650524&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20083">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157623708860556&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20082">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157625690650524&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
			<div class="slideshow" id="s_20081">
				<iframe align="right" src="http://www.flickr.com/slideShow/index.gne?set_id=72157625690650524&" frameBorder="0" width="500" scrolling="no" height="450"></iframe>
			</div>
		</div>	
		<div class="desc_recs">
	
			<div class="c_2011" id="e_20114">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">41º Festival Hava Netze Bemachol</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Novembro de 2011, Rio de Janeiro, Brasil</h2>		
					<div class="facebook">
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=193586320656604&amp;xfbml=1"></script><fb:comments xid="19"  numposts="10" width="300" publish_feed="true"></fb:comments>
			</div>
			</div>
			<div class="c_2011" id="e_20111">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">3ª Arkadá do Kineret - Purim</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Março de 2011, Rio de Janeiro, Brasil</h2>		
					<div class="facebook">
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=193586320656604&amp;xfbml=1"></script><fb:comments xid="18"  numposts="10" width="300" publish_feed="true"></fb:comments>
			</div>
					
			</div>
			<div class="c_2010" id="e_20107">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">30º Festival Carmel</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Dezembro de 2010, São Paulo, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=193586320656604&amp;xfbml=1"></script><fb:comments xid="17"  numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
					
			</div>
		
			<div class="c_2010" id="e_20106">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">2ª Mostra Kineret</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Dezembro de 2010, Rio de Janeiro, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=193586320656604&amp;xfbml=1"></script><fb:comments xid="16" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
					
		
			<div class="c_2010" id="e_20105">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">40º Festival Hava Netze Bemachol</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Outubro de 2010, Rio de Janeiro, Brasil</h2>
					<div class="facebook">	<div id="fb-root"></div> <fb:comments xid="15" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>		
			</div>
			
			<div class="c_2010" id="e_20104">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">13º Festival Choref</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Outubro de 2010, Porto Alegre, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="14" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>		
			</div>
			<div class="c_2010" id="e_20103">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">Espetáculo 'Israel de Norte a Sul'</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Agosto de 2010, Rio de Janeiro, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="13" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>		
			</div>
			<div class="c_2010" id="e_20102">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">2ª Arkadá do Kineret</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Maio de 2010, Rio de Janeiro, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="12" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
			<div class="c_2010" id="e_20101">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">37º Festival Aviv</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Março de 2010, Cancún e Cidade do México, México</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="11" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
			<div class="c_2009" id="e_20097">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">1ª Mostra Kineret</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Dezembro de 2009, Rio de Janeiro, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="10" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
			<div class="c_2009" id="e_20096">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">29º Festival Carmel</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Dezembro de 2009, São Paulo, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="9" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
			<div class="c_2009" id="e_20095">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">39º Festival Hava Netze Bemachol</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Novembro de 2009, Rio de Janeiro, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="8" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
			<div class="c_2009" id="e_20094">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">19º Festival de Cultura</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Novembro de 2009, Recife, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="7" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
			<div class="c_2009" id="e_20093">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">3º Festival CCBB de Folclore</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Agosto de 2009, Rio de Janeiro, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="6" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
			<div class="c_2009" id="e_20092">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">13º Festival Yachad</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Junho de 2009, Miami e Orlando, Estados Unidos</h2>
					<div class="facebook">
					<div id="fb-root"></div> <fb:comments xid="5" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
			<div class="c_2009" id="e_20091">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">1ª Arkadá do Kineret</a><a href="#"><span>     (fechar)</span></a></h2>
					<h2 class="h2dourado">Maio de 2009, Rio de Janeiro, Brasil</h2>
					<div class="facebook">
					<div id="fb-root"></div><fb:comments xid="4" numposts="10" width="300" publish_feed="true"></fb:comments>
					</div>
			</div>
			
			
			<div class="c_2008" id="e_20083">
					<h2 style="margin-top:20px;"><a class="recs_title" href="#">Em breve</a><a href="#"><span>     (fechar)</span></a></h2>
					
			</div>
			
			
			
		</div>
	</div>


</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8926866-1");
pageTracker._trackPageview();
} catch(err) {}</script>
	</body>
</html>