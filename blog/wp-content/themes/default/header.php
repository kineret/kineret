<?php
/**
 *<div id="header" role="banner">
 *	<div id="headerimg">
 *		<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
 *		<div class="description"><?php bloginfo('description'); ?></div>
 *	</div>
 * </div>
 * @package WordPress
 * @subpackage Default_Theme
 *
 *
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="http://www.kineret.com.br/blog/wp-content/themes/default/style.css" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body class="blog">
	<div id="header-top">
			<ul id="menu">
				<li id="menu-home"><a href="/" title="Página Inicial"><span class="bgimage">Home</span></a></li>
				<li id="menu-grupos"><a href="http://www.kineret.com.br/grupos/" title="Idades, Horário, Local, Professores..."><span class="bgimage">Grupos</span></a></li>
				<li id="menu-recs"><a href="http://www.kineret.com.br/recordacoes/" title="Memórias áudio-visuais do Kineret..."><span class="bgimage">Recordações</span></a></li> 
				<li id="menu-news"><a href="http://www.kineret.com.br/blog/" title="Saiba de tudo que rola no Kineret..."><span class="bgimage">Novidades</span></a></li>
				<li id="menu-calendar"><a href="http://www.kineret.com.br/calendario/" title="Fique por dentro da programação..."><span class="bgimage">Calendário</span></a></li>
				<li id="menu-contato"><a href="http://www.kineret.com.br/contato/" title="Somos todo ouvidos..."><span class="bgimage">Contato</span></a></li>
				<li id="menu-logo"><a href="/" title="Conheça o Instituto Kineret"><span class="bgimage">Home</span></a></li>
			</ul>
	</div>
	<div id="patrocinio_content">
			<table>
				<tr>
					<td class="patro">
					<img id="chl" src="http://www.kineret.com.br/assets/logos/patro2.png"></img>
						<img id="chcj" src="http://www.kineret.com.br/assets/logos/klabin.png"></img>
						<img id="werner" src="http://www.kineret.com.br/assets/logos/Logo_Werner.png"></img>
						<img id="werner" src="http://www.kineret.com.br/assets/logos/jocitex.png"></img>
						<img id="tenax" src="http://www.kineret.com.br/assets/logos/tenax.png"></img>
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
		<h2 style="padding-bottom:20px; text-align:center;text-decoration:none;font-family: helvetica, arial, sans-serif;letter-spacing:-1px;color:#440740;font-weight:normal;font-size:16pt;padding-top:20px;">Fique por dentro de todas as novidades do Instituto <img src="http://www.kineret.com.br/assets/kineret_escrito.png" style="height:30px; padding-left:10px;padding-top:10px;"></img>.</h2>
	
<div id="page">

