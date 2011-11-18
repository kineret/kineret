<?php

/*A variável $mensagem recebe os dados da array.  */
$mensagem = "Nome: ".$_POST['nome']." \n";
$mensagem .= "Email: ".$_POST['email']." \n";
$mensagem .= "Qtde Camisas Infantil: ".$_POST['qtdcamisaf']." \n";
$mensagem .= "Tamanho Camisas Infantil: ".$_POST['tamanhof']." \n";
$mensagem .= "Qtde Camisas Adulto: ".$_POST['qtdcamisam']." \n";
$mensagem .= "Tamanho Camisas Adulto: ".$_POST['tamanhom']." \n";
$mensagem .= "DVD Simples: ".$_POST['dvd']." \n";
$mensagem .= "DVD + Fotos: ".$_POST['combo']." \n";
$mensagem .= "Fotos: ".$_POST['fotos']." \n";

/*
Função Mail:
1: Coloque o email que vai receber os dados do formulário;
2: Coloque o titulo do email;
3: Os dados do formulário.
*/
mail("kineret@kineret.com.br","Pedido Efetuado pelo Site do Kineret",$mensagem);

/*
Mensagem que será impressa 
*/

header ('Location:http://www.kineret.com.br/espetaculo/resposta.html');
?>