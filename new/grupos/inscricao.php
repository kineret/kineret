
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instituto Kineret de Dança Israeli</title>
<link rel="stylesheet" type="text/css" href="../page.css" />

</head>

<body class="inscricao">
<div id="header-top">
	<ul id="menu">
		<li id="menu-home"><a href="/" title="Página Inicial"><span class="bgimage">Home</span></a></li>
		<li id="menu-grupos"><a href="../grupos/" title="Idades, Horário, Local, Professores..."><span class="bgimage">Grupos</span></a></li>
		<li id="menu-fotos"><a href="../fotos/" title="Viagens, Apresentações, Eventos..."><span class="bgimage">Fotos</span></a></li> 
		<li id="menu-depo"><a href="../depoimentos/" title="O que andam dizendo..."><span class="bgimage">Depoimentos</span></a></li>
		<li id="menu-eventos"><a href="../eventos/" title="Veja onde estaremos..."><span class="bgimage">Loja Virtual</span></a></li> 
		<li id="menu-blog"><a href="../blog/" title="Muitas histórias boas..."><span class="bgimage">Blog</span></a></li>
		<li id="menu-contato"><a href="../contato/" title="Somos todo ouvidos..."><span class="bgimage">Contato</span></a></li>
		<li id="menu-logo"><a href="/" title="Conheça o Instituto Kineret"><span class="bgimage">Home</span></a></li>
	</ul>
</div>

<div id="patrocinio_content">
		<table>
			<tr>
				<td class="patro">
					<img id="chcj" src="../assets/logos/klabin.png"></img>
					<img id="werner" src="../assets/logos/Logo_Werner.png"></img>
				</td>
			</tr>
		</table>
</div>
<div id="content">

	<h2>Preencha o formulário abaixo e entre para o Instituto Kineret!</h2>
	<h2 class="h2dourado">Venha fazer parte de nossa família.</h2>
 	
<!-- Begin MailChimp Signup Form -->
<!--[if IE]>
<style type="text/css" media="screen">
	#mc_embed_signup fieldset {position: relative;}
	#mc_embed_signup legend {position: absolute; top: -1em; left: .2em;}
</style>
<![endif]--> 

<!--[if IE 7]>
<style type="text/css" media="screen">
	.mc-field-group {overflow:visible;}
</style>
<![endif]--><script type="text/javascript" src="http://kineret.us1.list-manage.com/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="http://kineret.us1.list-manage.com/js/jquery.validate.js"></script>
<script type="text/javascript" src="http://kineret.us1.list-manage.com/js/jquery.form.js"></script>
<script type="text/javascript" src="http://kineret.us1.list-manage.com/subscribe/xs-js?u=dd5e81594d7c5e32ede813cac&amp;id=9e5dbd2154"></script>

<div id="divfoto" style="-moz-border-radius: 4px;border-radius: 4px;-webkit-border-radius: 4px;border: 1px dashed #fdb813;margin:20px 0;color: #525252;width:540px;padding:20px 10px;">  
<h4 style="font-size:16pt;font-family:helvetica, arial, sans serif;color:#fdb813; font-weight:bold;display:block;float:left;text-decoration:none;position:relative;padding:0 6px 0 0;">1º Passo:</h4><h4  style="width:300px;position:relative;font-size:16pt;font-family:helvetica, arial, sans serif;font-weight:bold;display:block;float:left;text-decoration:none;color:#525252;"> Envie sua Foto</h4>
<h6 style="position:relative;display:block;float:left;width:530px;padding:20px 20px;font-family:helvetica, arial, sans serif;font-size:8pt;text-decoration:none;color:#525252">* Dê preferência a fotos que você aparece sozinho(a). Essa foto será usada para inscrição nos eventos que participamos.</h6>

<?php
//define a maxim size for the uploaded images in Kb
define ("MAX_SIZE","2000");

//This function reads the extension of the file. It is used to determine if the file is an image by checking the extension.
function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}

//This variable is used as a flag. The value is initialized with 0 (meaning no error found)
//and it will be changed to 1 if an errro occures.
//If the error occures the file will not be uploaded.
$errors=0;
//checks if the form has been submitted
if(isset($_POST['Submit']))
{
//reads the name of the file the user submitted for uploading
$image=$_FILES['image']['name'];
//if it is not empty
if ($image)
{
//get the original name of the file from the clients machine
$filename = stripslashes($_FILES['image']['name']);
//get the extension of the file in a lower case format
$extension = getExtension($filename);
$extension = strtolower($extension);
//if it is not a known extension, we will suppose it is an error and will not upload the file,
//otherwise we will do more tests
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
{
//print error message
echo '<h6 style="position:absolute;top:292px;left:240px;text-decoration:none;font-size:8pt;color:#fdb813;padding:0 20px 0 0;">Extensão de arquivo não permitida!</h6>';
$errors=1;
}
else
{
//get the size of the image in bytes
//$_FILES['image']['tmp_name'] is the temporary filename of the file
//in which the uploaded file was stored on the server
$size=filesize($_FILES['image']['tmp_name']);

//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
{
echo '<br><h6 style="position:absolute;top:292px;left:240px;text-decoration:none;font-size:8pt;color:#fdb813;padding:0 20px 0 0;">O arquivo excedeu o tamanho limite!</h6>';
$errors=1;
}

//we will give an unique name, for example the time in unix time format
$image_name=time().'.'.$extension;
//the new name will be containing the full path where will be stored (images folder)
$newname="images/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied)
{
echo '<br><h6 style="position:absolute;top:292px;left:240px;text-decoration:none;font-size:8pt;color:#fdb813;padding:0 20px 0 0;">Tente de novo!</h6>';
$errors=1;
}}}}

//If no errors registred, print the success message
if(isset($_POST['Submit']) && !$errors)
{
echo '<h6 style="position:absolute;top:292px;left:240px;text-decoration:none;font-size:8pt;color:#fdb813;padding:0 20px 0 0;">Foto Enviada com Sucesso!</h6>';
}

?>
<!--next comes the form, you must set the enctype to "multipart/frm-data" and use an input type "file" -->
<form id="formfoto" name="newad" method="post" enctype="multipart/form-data" action="" style="padding:0 20px;postion:relative;display:block:width:540px;">
<input type="file" name="image">
<input name="Submit" type="submit" value="Enviar Foto">
</form>
 </div>

<div id="mc_embed_signup">
<form action="http://kineret.us1.list-manage.com/subscribe/post?u=dd5e81594d7c5e32ede813cac&amp;id=9e5dbd2154" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" style="padding-top:20px;font: normal 100% helvetica, arial, sans-serif;font-size: 12px;">
	<fieldset style="-moz-border-radius: 4px;border-radius: 4px;-webkit-border-radius: 4px;border: 1px dashed #fdb813;margin:0 0;color: #525252;">
<h4 style="font-size:16pt;font-family:helvetica, arial, sans serif;color:#fdb813; font-weight:bold;display:block;float:left;text-decoration:none;position:relative;padding:20px 6px 0 10px;">2º Passo:</h4><h4  style="position:relative;font-size:16pt;font-family:helvetica, arial, sans serif;font-weight:bold;display:block;float:left;text-decoration:none;color:#525252;padding:20px 0 0 0;"> Preencha seus Dados</h4>

<div class="indicate-required" style="text-align: right;font-style: italic;overflow: hidden;color: #525252;margin: 0 9% 0 0;">* campo obrigatório</div>
<div class="mc-field-group">
<label for="mce-LEHAKA" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Grupo <strong class="note-required">*</strong>
</label>
<select name="LEHAKA" class="required" id="mce-LEHAKA" style="margin-right: 1.5em;padding: .2em .3em;float: left;z-index: 999;">
<option value="Yachad (9 a 12 anos)">Yachad (9 a 12 anos)</option>
<option value="Aviv (13 a 15 anos)">Aviv (13 a 15 anos)</option>
<option value="Medurá (16 e 17 anos)">Medurá (16 e 17 anos)</option>
<option value="Gaash (acima de 18 anos)">Gaash (acima de 18 anos)</option>
<option value="Akahel (acima de 25 anos)">Akahel (acima de 25 anos)</option>
<option value="Chavaiá Laranjeiras (acima de 35 anos)">Chavaiá Laranjeiras (acima de 35 anos)</option>
<option value="Chavaiá Barra (acima de 35 anos)">Chavaiá Barra (acima de 35 anos)</option>
</select>
</div>
<div class="mc-field-group">
<label for="mce-FNAME" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Nome Completo <strong class="note-required">*</strong>
</label>
<input type="text" value="" name="FNAME" class="required" id="mce-FNAME" style="margin-right: 1.5em;padding: .2em .3em;width: 95%;float: left;z-index: 999;">
</div>
<div class="mc-field-group">
<label for="mce-EMAIL" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Email <strong class="note-required">*</strong>
</label>
<input type="text" value="" name="EMAIL" class="required email" id="mce-EMAIL" style="margin-right: 1.5em;padding: .2em .3em;width: 95%;float: left;z-index: 999;">
</div>
<div class="mc-field-group">
<label for="mce-RG" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">RG ou Certidão de Nascimento <strong class="note-required">*</strong>
</label>
<input type="text" value="" name="RG" class="required" id="mce-RG" style="margin-right: 1.5em;padding: .2em .3em;width: 230px;float: left;z-index: 999;">
</div>

<div class="mc-field-group">
	<div class="datefield" style="clear: both;">
		<label for="mce-DATAN-month" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Data de Nascimento <strong class="note-required">*</strong>
</label>
		<span class="dayfield" style="display: inline-block;margin: 0 .5em;"><input type="text" value="DD" size="2" maxlength="2" name="DATAN[day]" id="mce-DATAN-day" style="width: 24%;min-width: 3em;margin-right: 0;padding: .2em .3em;float: none;z-index: 999;display: inline;"></span> / 
        <span class="monthfield" style="display: inline-block;margin: 0 .5em;"><input type="text" value="MM" size="2" maxlength="2" name="DATAN[month]" id="mce-DATAN-month" style="margin-right: 0;padding: .2em .3em;width: 12%;float: none;z-index: 999;display: inline;min-width: 3em;"></span> / 
		<span class="yearfield" style="display: inline-block;margin: 0 .5em;"><input type="text" value="AAAA" size="4" maxlength="4" name="DATAN[year]" id="mce-DATAN-year" style="margin-right: 0;padding: .2em .3em;width: 75%;float: none;z-index: 999;display: inline;"></span>
        <div class="fake-date" style="margin-top: .5em;padding-top: .1em;"><input type="hidden" class="required date" id="DATAN-fake-date" value="" style="margin-right: 1.5em;padding: .2em .3em;width: 95%;float: left;z-index: 999;"></div>
	</div>
</div>
<div class="mc-address-group">
	<label for="mce-ENDERECO-addr1" style="font-weight: bold;">Endereço Completo <strong class="note-required">*</strong>
</label>
	<ul class="addressfield" style="padding: .5em;margin: 0 0 1em 0;overflow: hidden;">
		<li class="addr1field" style="padding: .3em;color: #333;font-style: italic;font-size: .8em;list-style: none;"><label for="mce-ENDERECO-addr1" style="font-weight: normal;display: block;font-size: 1.1em;">Logradouro</label><input type="text" value="" maxlength="70" name="ENDERECO[addr1]" id="mce-ENDERECO-addr1" class="required" style="width: 95%;margin: .3em .5em .3em 0;"></li>
		<li class="addr2field" style="padding: .3em;color: #333;font-style: italic;font-size: .8em;list-style: none;"><label for="mce-ENDERECO-addr2" style="font-weight: normal;display: block;font-size: 1.1em;">Complemento</label><input type="text" value="" maxlength="70" name="ENDERECO[addr2]" id="mce-ENDERECO-addr2" style="width: 95%;margin: .3em .5em .3em 0;"></li>
		<li class="cityfield" style="padding: .3em;color: #333;font-style: italic;font-size: .8em;list-style: none;"><label for="mce-ENDERECO-city" style="font-weight: normal;display: block;font-size: 1.1em;">Cidade</label><input type="text" value="" maxlength="40" name="ENDERECO[city]" id="mce-ENDERECO-city" class="required" style="width: 95%;margin: .3em .5em .3em 0;"></li>
		<li class="statefield" style="padding: .3em;color: #333;font-style: italic;font-size: .8em;list-style: none;"><label for="mce-ENDERECO-state" style="font-weight: normal;display: block;font-size: 1.1em;">Estado</label><input type="text" value="" maxlength="20" name="ENDERECO[state]" id="mce-ENDERECO-state" class="required" style="width: 30px;margin: .3em .5em .3em 0;"></li>
		<li class="zipfield" style="padding: .3em;color: #333;font-style: italic;font-size: .8em;list-style: none;"><label for="mce-ENDERECO-zip" style="font-weight: normal;display: block;font-size: 1.1em;">CEP</label><input type="text" value="" maxlength="10" name="ENDERECO[zip]" id="mce-ENDERECO-zip" class="required" style="width: 100px;margin: .3em .5em .3em 0;"></li>
		<li class="countryfield" style="padding: .3em;color: #333;font-style: italic;font-size: .8em;list-style: none;"><label for="mce-ENDERECO-country" style="font-weight: normal;display: block;font-size: 1.1em;">País</label><select name="ENDERECO[country]" id="mce-ENDERECO-country" class="required" style="margin-right: 1.5em;padding: .2em;float: left;z-index: 999;"><option selected="selected" value="24">Brasil</option><option value="2">Albania</option><option value="4">Andorra</option><option value="6">Argentina</option><option value="8">Australia</option><option value="9">Austria</option><option value="11">Bahamas</option><option value="13">Bangladesh</option><option value="14">Barbados</option><option value="15">Belarus</option><option value="16">Belgium</option><option value="19">Bermuda</option><option value="22">Bosnia and Herzegovina</option><option value="23">Botswana</option><option value="24">Brazil</option><option value="271">British West Indies</option><option value="25">Bulgaria</option><option value="30">Canada</option><option value="32">Cayman Islands</option><option value="35">Chile</option><option value="36">China</option><option value="37">Colombia</option><option value="268">Costa Rica</option><option value="40">Croatia</option><option value="41">Cyprus</option><option value="42">Czech Republic</option><option value="43">Denmark</option><option value="187">Dominican Republic</option><option value="45">Ecuador</option><option value="46">Egypt</option><option value="47">El Salvador</option><option value="50">Estonia</option><option value="191">Faroe Islands</option><option value="52">Fiji</option><option value="53">Finland</option><option value="54">France</option><option value="59">Germany</option><option value="60">Ghana</option><option value="194">Gibraltar</option><option value="61">Greece</option><option value="195">Greenland</option><option value="192">Grenada</option><option value="198">Guatemala</option><option value="270">Guernsey</option><option value="66">Honduras</option><option value="67">Hong Kong</option><option value="68">Hungary</option><option value="69">Iceland</option><option value="70">India</option><option value="71">Indonesia</option><option value="74">Ireland</option><option value="75">Israel</option><option value="76">Italy</option><option value="202">Jamaica</option><option value="78">Japan</option><option value="81">Kenya</option><option value="269">Kuwait</option><option value="82">Kuwait</option><option value="85">Latvia</option><option value="86">Lebanon</option><option value="90">Liechtenstein</option><option value="91">Lithuania</option><option value="92">Luxembourg</option><option value="93">Macedonia</option><option value="96">Malaysia</option><option value="97">Maldives</option><option value="99">Malta</option><option value="212">Mauritius</option><option value="101">Mexico</option><option value="102">Moldova, Republic of</option><option value="103">Monaco</option><option value="105">Morocco</option><option value="109">Netherlands</option><option value="110">Netherlands Antilles</option><option value="111">New Zealand</option><option value="112">Nicaragua</option><option value="116">Norway</option><option value="118">Pakistan</option><option value="119">Panama</option><option value="219">Papua New Guinea</option><option value="121">Peru</option><option value="122">Philippines</option><option value="123">Poland</option><option value="124">Portugal</option><option value="128">Romania</option><option value="254">Russia</option><option value="129">Russian Federation</option><option value="205">Saint Kitts and Nevis</option><option value="206">Saint Lucia</option><option value="227">San Marino</option><option value="133">Saudi Arabia</option><option value="256">Scotland</option><option value="266">Serbia</option><option value="137">Singapore</option><option value="138">Slovakia</option><option value="139">Slovenia</option><option value="141">South Africa</option><option value="143">Spain</option><option value="148">Sweden</option><option value="149">Switzerland</option><option value="152">Taiwan</option><option value="154">Thailand</option><option value="267">Tobago</option><option value="261">Trinidad</option><option value="157">Turkey</option><option value="161">Ukraine</option><option value="162">United Arab Emirates</option><option value="262">United Kingdom</option><option value="163">Uruguay</option><option value="166">Vatican City State (Holy See)</option><option value="167">Venezuela</option><option value="168">Vietnam</option><option value="265">Wales</option><option value="174">Zimbabwe</option></select>
		</li>
	</ul>
</div>
<div class="mc-field-group">
<label for="mce-FONEC" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Telefone Celular <strong class="note-required">*</strong>
</label>
<input type="text" name="FONEC" class="required" value="" id="mce-FONEC" style="margin-right: 1.5em;padding: .2em .3em;width: 200px;float: left;z-index: 999;">
</div>
<div class="mc-field-group">
<label for="mce-FONER" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Telefone Residencial <strong class="note-required">*</strong>
</label>
<input type="text" name="FONER" class="required" value="" id="mce-FONER" style="margin-right: 1.5em;padding: .2em .3em;width: 200px;float: left;z-index: 999;">
</div>
<div class="mc-field-roup" style="display:hidden;margin: 1.3em 5%;clear: both;overflow: hidden;">
<label for="mce-FOTO" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Foto </label>
<input type="text" value="<?php $newname ?>" name="FOTO" class=" url" id="mce-FOTO" style="margin-right: 1.5em;padding: .2em .3em;width: 95%;float: left;z-index: 999;">
</div>

 <div class="mc-field-group">
<label for="mce-NPLANO" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Nome do Plano de Saúde </label>
<input type="text" value="" name="NPLANO" class="" id="mce-NPLANO" style="margin-right: 1.5em;padding: .2em .3em;width: 95%;float: left;z-index: 999;">
</div>
<div class="mc-field-group">
<label for="mce-NUMPLANO" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Número do Plano de Saúde </label>
<input type="text" value="" name="NUMPLANO" class="" id="mce-NUMPLANO" style="margin-right: 1.5em;padding: .2em .3em;width: 95%;float: left;z-index: 999;">
</div>
		<div id="mce-responses" style="float: left;top: -1.4em;padding: 0em .5em 0em .5em;overflow: hidden;width: 300px;margin: 0 5%;clear: both;">
			<div class="response" id="mce-error-response" style="display: none;margin: 1em 0;padding: 1em .5em .5em 0;font-weight: bold;float: left;top: -1.5em;z-index: 1;width: 500px;background: #FFEEEE;color: #FF0000;"></div>
			<div class="response" id="mce-success-response" style="display: none;margin: 1em 0;padding: 1em .5em .5em 0;font-weight: bold;float: left;top: -1.5em;z-index: 1;width: 500px;color: #fdb813;"></div>
		</div>
		<div><input type="submit" value="Enviar Inscrição" name="subscribe" id="mc-embedded-subscribe" class="btn" style="clear: both;width: auto;display: block;margin: 1em 0 1em 5%;"></div>
	</fieldset>	
	<a href="#" id="mc_embed_close" class="mc_embed_close" style="display: none;">Fechar</a>
</form>
</div>
<!--End mc_embed_signup-->
<div id="divfoto" style="position:relative;-moz-border-radius: 4px;border-radius: 4px;-webkit-border-radius: 4px;border: 1px dashed #fdb813;margin:20px 0;color: #440740;width:540px;height:100px;padding:20px 10px;">  
<h4 style="font-size:16pt;font-family:helvetica, arial, sans serif;color:#fdb813; font-weight:bold;display:block;float:left;text-decoration:none;position:relative;padding:0 6px 0 0;">3º Passo:</h4><h4  style="width:300px;position:relative;font-size:16pt;font-family:helvetica, arial, sans serif;font-weight:bold;display:block;float:left;text-decoration:none;color:#440740;"> Confirme sua Inscrição</h4>
<h6 style="position:relative;display:block;float:left;width:530px;padding:20px 20px;font-family:helvetica, arial, sans serif;font-size:8pt;text-decoration:none;color:#440740">Após concluir o passo 2, você receberá por e-mail um pedido de confirmação de inscrição. Clique no link indicado no e-mail e pronto! Sua inscrição será validada com sucesso!</h6>
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