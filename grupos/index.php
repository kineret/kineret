
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
		
			<script type="text/javascript">
			$(document).ready(function(){
			$("#init_grupos").show(300);
			  	$("	#gaash_badge_wrapper img").click(function(){return false;
			});
	
				
				$("#grupo_yachad").click(function(){
					$("#grupo_yachad").hide(300);
					$("#grupo_aviv").show(300);
					$("#grupo_medura").show(300);
					$("#grupo_gaash").show(300);
					$("#grupo_akahel").show(300);
					$("#grupo_chavaia").show(300);
					
					if ($("#aviv").is(":visible")){
					$("#aviv").slideUp(300,function(){$("#yachad").slideDown(800);});
					}
					else
					{
						if ($("#medura").is(":visible")){
						$("#medura").slideUp(300,function(){$("#yachad").slideDown(800);});
						}
						else
						{
							if ($("#gaash").is(":visible")){
							$("#gaash").slideUp(300,function(){$("#yachad").slideDown(800);});
							}
							else
							{
								if ($("#akahel").is(":visible")){
								$("#akahel").slideUp(300,function(){$("#yachad").slideDown(800);});
								}
								else
								{
									if ($("#chavaia").is(":visible")){
									$("#chavaia").slideUp(300,function(){$("#yachad").slideDown(800);});
									}
									else
									{$("#init_grupos").slideUp(300,function(){$("#yachad").slideDown(800);});}
								}
							}
						}
					}
				
				
			});
				$("#grupo_aviv").click(function(){
					$("#grupo_yachad").show(300);
					$("#grupo_aviv").hide(300);
					$("#grupo_medura").show(300);
					$("#grupo_gaash").show(300);
					$("#grupo_akahel").show(300);
					$("#grupo_chavaia").show(300);
					
					if ($("#yachad").is(":visible")){
						$("#yachad").slideUp(300,function(){$("#aviv").slideDown(800);});
						}
						else
						{
							if ($("#medura").is(":visible")){
							$("#medura").slideUp(300,function(){$("#aviv").slideDown(800);});
							}
							else
							{
								if ($("#gaash").is(":visible")){
								$("#gaash").slideUp(300,function(){$("#aviv").slideDown(800);});
								}
								else
								{
									if ($("#akahel").is(":visible")){
									$("#akahel").slideUp(300,function(){$("#aviv").slideDown(800);});
									}
									else
									{
										if ($("#chavaia").is(":visible")){
										$("#chavaia").slideUp(300,function(){$("#aviv").slideDown(800);});
										}
										else
										{$("#init_grupos").slideUp(300,function(){$("#aviv").slideDown(800);});}
									}
								}
							}
						}
			});
				$("#grupo_medura").click(function(){
					$("#grupo_yachad").show(300);
					$("#grupo_aviv").show(300);
					$("#grupo_medura").hide(300);
					$("#grupo_gaash").show(300);
					$("#grupo_akahel").show(300);
					$("#grupo_chavaia").show(300);
				
					if ($("#yachad").is(":visible")){
						$("#yachad").slideUp(300,function(){$("#medura").slideDown(800);});
						}
						else
						{
							if ($("#aviv").is(":visible")){
							$("#aviv").slideUp(300,function(){$("#medura").slideDown(800);});
							}
							else
							{
								if ($("#gaash").is(":visible")){
								$("#gaash").slideUp(300,function(){$("#medura").slideDown(800);});
								}
								else
								{
									if ($("#akahel").is(":visible")){
									$("#akahel").slideUp(300,function(){$("#medura").slideDown(800);});
									}
									else
									{
										if ($("#chavaia").is(":visible")){
										$("#chavaia").slideUp(300,function(){$("#medura").slideDown(800);});
										}
										else
										{$("#init_grupos").slideUp(300,function(){$("#medura").slideDown(800);});}
									}
								}
							}
						}
			});
				$("#grupo_gaash").click(function(){
					$("#grupo_yachad").show(300);
					$("#grupo_aviv").show(300);
					$("#grupo_medura").show(300);
					$("#grupo_gaash").hide(300);
					$("#grupo_akahel").show(300);
					$("#grupo_chavaia").show(300);
				
				   	if ($("#yachad").is(":visible")){
						$("#yachad").slideUp(300,function(){$("#gaash").slideDown(800);});
						}
						else
						{
							if ($("#aviv").is(":visible")){
							$("#aviv").slideUp(300,function(){$("#gaash").slideDown(800);});
							}
							else
							{
								if ($("#medura").is(":visible")){
								$("#medura").slideUp(300,function(){$("#gaash").slideDown(800);});
								}
								else
								{
									if ($("#akahel").is(":visible")){
									$("#akahel").slideUp(300,function(){$("#gaash").slideDown(800);});
									}
									else
									{
										if ($("#chavaia").is(":visible")){
										$("#chavaia").slideUp(300,function(){$("#gaash").slideDown(800);});
										}
										else
										{$("#init_grupos").slideUp(300,function(){$("#gaash").slideDown(800);});}
									}
								}
							}
						}
			});		
				$("#grupo_akahel").click(function(){
					$("#grupo_yachad").show(300);
					$("#grupo_aviv").show(300);
					$("#grupo_medura").show(300);
					$("#grupo_gaash").show(300);
					$("#grupo_akahel").hide(300);
					$("#grupo_chavaia").show(300);
				
					if ($("#yachad").is(":visible")){
						$("#yachad").slideUp(300,function(){$("#akahel").slideDown(800);});
						}
						else
						{
							if ($("#aviv").is(":visible")){
							$("#aviv").slideUp(300,function(){$("#akahel").slideDown(800);});
							}
							else
							{
								if ($("#medura").is(":visible")){
								$("#medura").slideUp(300,function(){$("#akahel").slideDown(800);});
								}
								else
								{
									if ($("#gaash").is(":visible")){
									$("#gaash").slideUp(300,function(){$("#akahel").slideDown(800);});
									}
									else
									{
										if ($("#chavaia").is(":visible")){
										$("#chavaia").slideUp(300,function(){$("#akahel").slideDown(800);});
										}
										else
										{$("#init_grupos").slideUp(300,function(){$("#akahel").slideDown(800);});}
									}
								}
							}
						}
			});
				$("#grupo_chavaia").click(function(){
					$("#grupo_yachad").show(300);
					$("#grupo_aviv").show(300);
					$("#grupo_medura").show(300);
					$("#grupo_gaash").show(300);
					$("#grupo_akahel").show(300);
					$("#grupo_chavaia").hide(300);
				
					if ($("#yachad").is(":visible")){
						$("#yachad").slideUp(300,function(){$("#chavaia").slideDown(800);});
						}
						else
						{
							if ($("#aviv").is(":visible")){
							$("#aviv").slideUp(300,function(){$("#chavaia").slideDown(800);});
							}
							else
							{
								if ($("#medura").is(":visible")){
								$("#medura").slideUp(300,function(){$("#chavaia").slideDown(800);});
								}
								else
								{
									if ($("#gaash").is(":visible")){
									$("#gaash").slideUp(300,function(){$("#chavaia").slideDown(800);});
									}
									else
									{
										if ($("#akahel").is(":visible")){
										$("#akahel").slideUp(300,function(){$("#chavaia").slideDown(800);});
										}
										else
										{$("#init_grupos").slideUp(300,function(){$("#chavaia").slideDown(800);});}
									}
								}
							}
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
	<body class="grupos">
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
		<div class="nome_grupos">
		<a class="a_grupos" id="grupo_yachad" href="#">Yachad</a>
		<a class="a_grupos" id="grupo_aviv" href="#">Aviv</a>
		<a class="a_grupos" id="grupo_medura" href="#">Medurá</a>
		<a class="a_grupos" id="grupo_gaash" href="#">Gaash</a>
		<a class="a_grupos" id="grupo_chavaia" href="#">Chavaiá</a>
		</div>
		<div class="desc_grupos">
		<div id="init_grupos">
			
			<h2 style="padding-bottom:20px;">O Instituto <img src="../assets/kineret_escrito.png" style="height:30px; padding-left:10px;padding-top:10px;"></img>possui grupos das mais diversas idades.</h2>
			<h2 class="h2dourado">Navegue pelas opções acima e encontre o seu!</h2>

		</div>
		
			<div id="yachad">
				<p class="tit_grupos" style="background-color:#3aaa42">Lehaká Yachad</p>
				
				<p class="par_grupos">Idade:<br> <span>até o 7º ano escolar </span></p>
				<p class="par_grupos">Horário:<br> <span>Domingos de 17h às 19h</span></p>
				<p class="par_grupos">Professores:<br><span>Tamar Zalcman, Julia Beida e Rachel Benoliel Contente</span></p>
				<p class="par_grupos">Fotos:</p>
				<p>
					<table style="display:block;float:left;width:600px;" cellpadding="0" cellspacing="10" border="0" id="gaash_badge_wrapper">
						<tr><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=3&display=random&size=m&layout=h&source=user_tag&user=47199195%40N06&tag=yachad"></script>
						</tr>
					</table>
				</p>
			</div>
			
			
			
			<div id="aviv">	
				<p class="tit_grupos" style="background-color:#633418">Lehaká Aviv</p>
				
				<p class="par_grupos">Idade:<br> <span>8º e 9º ano escolar </span></p>
				<p class="par_grupos">Horário:<br> <span>Domingos de 17h às 19h</span></p>
				<p class="par_grupos">Professores:<br><span>Diana Borschiver, Paula Toledano Paixão e Daniele Pitkowski</span></p>
				<p class="par_grupos">Fotos:</p>
				<p>
				<table cellpadding="0" cellspacing="10" border="0" id="gaash_badge_wrapper">
				<tr>
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=3&display=random&size=m&layout=h&source=user_tag&user=47199195%40N06&tag=aviv"></script>
				</tr>
				</table>
			</p>
			<p></p>
			</div>
			
			
			<div id="medura">
			<p class="tit_grupos" style="background-color:#d72b2b;">Lehaká Medurá</p>
				<p class="par_grupos">Idade:<br> <span>Ensino Médio </span></p>
				<p class="par_grupos">Horário:<br> <span>Domingos de 16h às 19h</span></p>
				<p class="par_grupos">Professores:<br><span>Camila Dudenhoeffer e Daniel Adesse</span></p>
				<p class="par_grupos">Fotos:</p>
			<p>
				<table cellpadding="0" cellspacing="10" border="0" id="gaash_badge_wrapper">
				<tr id="fotos_grupos">
								<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=3&display=random&size=m&layout=h&source=user_tag&user=47199195%40N06&tag=medura"></script>
								</tr>
								</table>		</p>
			</div>
			<div id="gaash">
			<p class="tit_grupos" style="background-color:#2b5cd7;">Lehaká Gaash</p>
				<p class="par_grupos">Idade:<br> <span>Entre 18 e 24 anos</span></p>
				<p class="par_grupos">Horário:<br> <span>Quartas e Domingos de 19h às 22h</span></p>
				<p class="par_grupos">Professores:<br><span>Daniel Adesse e Ilana Nigri</span></p>
				<p class="par_grupos">Fotos:</p>
				<p>
				<table cellpadding="0" cellspacing="10" border="0" id="gaash_badge_wrapper">
				<tr>
								<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=3&display=random&size=m&layout=h&source=user_tag&user=47199195%40N06&tag=gaash"></script>
								</tr>
								</table>		</p>
			</div>
			<div id="chavaia">
			<p class="tit_grupos" style="background-color:#b01eca;">Lehaká Chavaiá</p>
				<p class="par_grupos">Idade:<br> <span>Acima de 35 anos</span></p>
				<p class="par_grupos">Horário:<br> <span>Segundas de 20h às 22h</span></p>
				<p class="par_grupos">Professores:<br><span>Rafael Barreto de Castro e Camila Dudenhoeffer</span></p>
				<p class="par_grupos">Fotos:</p>
					<p>
				<table cellpadding="0" cellspacing="10" border="0" id="gaash_badge_wrapper">
				<tr>
								<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=3&display=random&size=m&layout=h&source=user_tag&user=47199195%40N06&tag=chavaia"></script>
								</tr>
								</table>		</p>
			</div>
		</div>
	</div>


		
		<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$(".gallery a[rel^='prettyPhoto']").prettyPhoto({theme:'facebook'});
		});
		</script>
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