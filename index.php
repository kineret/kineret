<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instituto Kineret de Dança Israeli</title>


<link rel="stylesheet" type="text/css" href="page.css" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="ie7.css" />
<![endif]-->

	<script type="text/javascript" src="contato/jquery.js"></script>

	<script src="jquery.defaultvalue.js" type="text/javascript" charset="utf-8"></script>
			<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(function($) {
				$("#EMAIL").defaultvalue("Seu e-mail aqui...");
			});
			/* ]]> */
			</script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://downloads.mailchimp.com/js/jquery.validate.js"></script>
	<script type="text/javascript" src="http://downloads.mailchimp.com/js/jquery.form.js"></script>

	<script src="http://www.google.com/jsapi" type="text/javascript"></script>
		<script type="text/javascript" charset="utf-8">
			google.load("jquery", "1.3");
	</script>
	<script src="grupos/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>

		<script type="text/javascript">
		$(document).ready(function(){
			$("#flickr-content a").click(function(){return false;
		});
		  	$("#icon_mail").hover(function(){
				$(".text_fb").hide(1);
				$(".text_mail").show(500);
				$(".text_twitter").hide(1);
				$(".text_rss").hide(1);		
		});
			$("#icon_fb").hover(function(){
				$(".text_fb").show(500);
				$(".text_mail").hide(1);
				$(".text_twitter").hide(1);
				$(".text_rss").hide(1);		
		});
			$("#icon_twitter").hover(function(){
				$(".text_fb").hide(1);
				$(".text_mail").hide(1);
				$(".text_twitter").show(500);
				$(".text_rss").hide(1);		
		});
			$("#icon_rss").hover(function(){
				$(".text_fb").hide(1);
				$(".text_mail").hide(1);
				$(".text_twitter").hide(1);
				$(".text_rss").show(500);		
		});
			});
			</script>

	<script type="text/javascript">
	$(document).ready(function(){
	  $("#icon_mail").click(function(){
	   if ($(".text_mail").is(":hidden")){
		$(".text_fb").slideUp();
		$(".text_mail").slideDown();
		$(".text_twitter").slideUp();
		$(".text_rss").slideUp();
		}
		else
		{	$(".text_mail").slideUp();}
	  });
	$("#icon_fb").click(function(){
	   if ($(".text_fb").is(":hidden")){
		$(".text_fb").slideDown();
		$(".text_mail").slideUp();
		$(".text_twitter").slideUp();
		$(".text_rss").slideUp();
		}
		else
		{	$(".text_fb").slideUp();}
	  });
	$("#icon_twitter").click(function(){
	   if ($(".text_twitter").is(":hidden")){
		$(".text_fb").slideUp();
		$(".text_mail").slideUp();
		$(".text_twitter").slideDown();
		$(".text_rss").slideUp();
		}
		else
		{	$(".text_twitter").slideUp();}
	  });
	$("#icon_rss").click(function(){
	   if ($(".text_rss").is(":hidden")){
		$(".text_fb").slideUp();
		$(".text_mail").slideUp();
		$(".text_twitter").slideUp();
		$(".text_rss").slideDown();
		}
		else
		{	$(".text_rss").slideUp();}
	  });
	});
	</script>

</head>

<body class="intro">

<div id="header-top">
	<?php include ("menu.html"); ?>
</div>
<div id="header-mid">
	<div id="painel">
	<div id="painel-left">
		<img style="width:350px;padding-top:20px;" id="logo2" src="assets/sometradicao.jpg"/>
<!--		<img id="logo" src="assets/logo_vertical.png"/> -->
	</div>
<!--	<div id="painel-center">
			<div id="flickr-content">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=3&display=random&layout=v&size=m&source=user&user=47199195%40N06"></script>
				
			</div>
	</div>
	-->
	<div id="painel-right">
		<h2 class="h2dourado">Espetáculo Som & Tradição</h2>
		<h2 style="padding-top:10px;">DVD Duplo - R$ 35,00</h2>
		<h2>Fotos - R$ 15,00 cada</h2>
		<h5>Cada foto comprada será entregue impressa em formato 15cm x 21cm</h5>
		<h5>Acesse os links, anote o nome das fotos desejadas, e preencha-as no formulário abaixo</h5>

		<h2 style="padding-top:10px;"class="h2dourado">Veja as fotos aqui: 
				<a target="_blank" href="http://www.marianstarosta.com/kineret/">Parte 1</a>
				<a target="_blank" href="http://www.marianstarosta.com/kineret2/">Parte 2</a>
				
		</h2>

		<form id="contato" method="post" action="envio.php"  name="form">	
			<fieldset>
						<h3 class="h2dourado">Nome Completo:</h3>
				<input type="text" name="nome" value="" id="nome" />
						<h3 class="h2dourado">Email:</h3>
				<input type="text" name="email" value="" id="email" />
				<h3 class="h2dourado">Quantidade de DVDs desejada:</h3>
				<input type="text" name="qtde" value="" id="qtde" />
				
				<h3 class="h2dourado">Fotos desejadas:</h3>
				<input type="text" name="fotos" value="" id="fotos" />
				<button class="bgimage" type="submit">Send</button>
				
			</fieldset>
				
		</form>
		
		<!--	<h2 style="padding-top:30px;">O Instituto Kineret, fundado em 2008, é o principal centro de referência em ensino de dança 		folclórica israelí no Rio de Janeiro. Nosso repertório de coreografias abrange diferentes estilos e temas, proporcionando a seus alunos e público um profundo conhecimento sobre as diversas formas que a cultura e tradição judaicas assumem ao redor do mundo.</h2>
		
		<h2>Marcadas pela força das musicas e destreza dos movimentos, as coreografias são fruto do intenso trabalho realizado pelos grupos, desenvolvido durante os ensaios que acontecem semanalmente. A interação entre professores e alunos, peça fundamental para o nosso crescimento, gera um ambiente rico em troca de experiências e diversão, complementando os ensinamentos de danças folclóricas e o constante aprimoramento técnico.</h2>
		<h2>Para garantir a continuidade de nosso trabalho, estimulamos a participação de nossos alunos na organização das mais variadas atividades do Instituto Kineret. O objetivo é formar os futuros lideres da comunidade judaica carioca através da dança israeli.</h2>
		<h2>Venha fazer parte desta família que não para de crescer!</h2>
		<h2>Acompanhe de perto nosso trabalho, cadastrando-se nos canais abaixo.</h2>
			<div class="div_icons">



			<a href="#"><img id="icon_mail" src="../assets/logo_mail.png" title="Receba notícias do Kineret no seu email"></img></a>
			<a href="#"><img id="icon_fb" src="../assets/logo_fb.png" title="Curta nossa página no Facebook"></img></a>
			<a href="#"><img id="icon_twitter" src="../assets/logo_twitter.png" title="Siga-nos no Twitter"></img></a>
			<a href="#"><img id="icon_rss" src="../assets/logo_rss.png" title="Assine o feed do nosso Blog"></img></a>
			-->		<!-- Begin MailChimp Signup Form -->
			<!--
				<p class="text_mail"><iframe src="form.php" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:242px; height:30px;" allowTransparency="true"></iframe>
			</p>

			-->		<!--End mc_embed_signup-->	

<!--
				<p class="text_fb"><iframe src="http://www.facebook.com/plugins/like.php?href=www.facebook.com%2Fpages%2FInstituto-Kineret%2F136305039732604&amp;layout=standard&amp;show_faces=false&amp;width=230&amp;action=like&amp;colorscheme=light&amp;height=25px" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:230px; height:25px; float:right;" allowTransparency="true"></iframe></p>
				<p class="text_twitter"><a href="http://www.twitter.com/kineret"><img src="http://twitter-badges.s3.amazonaws.com/follow_us-b.png" alt="Follow kineret on Twitter" style="height:25px;"/></a></p>
				<p class="text_rss" style="height:20px;"><textarea style="display:block;float:right;width:235px;height:18px; font-size:9pt; font-family:Georgia;padding:1px 0 0 0;border-color:#fdb813; color:#440740;border-style:dotted;" columns="40" rows="1"  scrolling="no">http://www.kineret.com.br/blog/?feed=rss</textarea></p>
			</div>
	-->
	
	</div>	
	</div>
	</div>
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
			
			
			</tr>
		</table>
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