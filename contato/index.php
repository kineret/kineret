
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instituto Kineret de Dança Israeli</title>
<link rel="stylesheet" type="text/css" href="../page.css" />
<script src="jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery.defaultvalue2.js" type="text/javascript" charset="utf-8"></script>



	<script src="jquery.defaultvalue2.js" type="text/javascript" charset="utf-8"></script>
			

	
		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(function($) {
			$("#nome, #email, #texto").defaultvalue("Seu nome", "Seu e-mail", "Escreva sua mensagem! Sua resposta será quase que imediata!");
		});
		/* ]]> */
		</script>
		
		
</head>

<body class="contato">
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
	<h2>Quer patrocinar? Dar uma sugestão? Nos chamar para eventos? Elogiar?</h2>
	<h2 class="h2dourado">Fique a vontade para deixar seu recado.</h2>
	
	
	
	<div id="top-left-content">
			<form id="contato" method="post" action="envio.php"  name="form" onsubmit="return validateForm()">	
				<fieldset>
					<textarea name="texto" id="texto"></textarea>
					<input type="text" name="nome" value="" id="nome" />
					<input type="text" name="email" value="" id="email" />
					<button class="bgimage" type="submit">Send</button>
					
				</fieldset>
					
			</form>
			
			<script type="text/javascript">
			function validateForm(){
				var nome=document.forms["form"]["nome"].value
				var email=document.forms["form"]["email"].value
				var texto=document.forms["form"]["texto"].value

				if (texto==null || texto=="" || texto=="Escreva sua mensagem! Sua resposta será quase que imediata!"){
					form.texto.focus();
					alert("Digite o corpo da mensagem");
					return false;
				}
				else if (nome==null || nome=="" || nome=="Seu nome"){
					form.nome.focus();
					 alert("Digite um nome");
					 return false;
				}
				else if (email==null || email=="" || email=="Seu e-mail"){
					form.email.focus();
					alert("Digite um email");
					return false;
				}
		}
		</script>
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