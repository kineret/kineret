<?php

/*A variável $mensagem recebe os dados da array.  */
$mensagem = "Nome: ".$_POST['nome']." \n";
$mensagem .= "Email: ".$_POST['email']." \n";
$mensagem .= "Mensagem: ". $_POST['texto'];
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

header ('Location:http://www.kineret.com.br/contato/resposta.php');
?>