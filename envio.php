<?php

/*A variável $mensagem recebe os dados da array.  */
$mensagem = "Nome: ".$_POST['nome']." \n";
$mensagem .= "Email: ".$_POST['email']." \n";
$mensagem .= "Quantidade: ". $_POST['qtde']." \n";
$mensagem .= "Fotos: ". $_POST['fotos'];
/*
Função Mail:
1: Coloque o email que vai receber os dados do formulário;
2: Coloque o titulo do email;
3: Os dados do formulário.
*/
mail("kineret@kineret.com.br","Mensagem Enviada pelo Site do Kineret",$mensagem);

/*
Mensagem que será impressa 
*/

header ('Location:http://www.kineret.com.br/index2.php');
?>