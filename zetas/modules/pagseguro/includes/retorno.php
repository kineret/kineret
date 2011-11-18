<?php

/**
 * RETORNO PAGSEGURO CRIADO POR ODLANIER
 * ESPECIALMENTE PRO FILHO DO FERNANDO
 * LoL
 * @author Odlanier de Souza Mendes
 * @email master_odlanier@hotmail.com
 * @email mends@prestashopbr.com
 * @version 1.0
 **/

// Strings Importantes
//VendedorEmail - pagseguro@pagseguro.com.br
//Referencia - PRS-56
//StatusTransacao - Completo
//					Aguardando Pagto
//					Aprovado
//					Em Análise
//					Cancelado

//?VendedorEmail=contato@omegajeans.com.br&TransacaoID=56&Referencia=PRS-56&StatusTransacao=SDSDSD


if (isset($_POST['StatusTransacao']) and isset($_POST['VendedorEmail']))
{
	/*
    $conf = Configuration::getMultiple(array('PAGSEGURO_BUSINESS', 'PAGSEGURO_TOKEN'));
    $token = array_key_exists('pg_token', $_POST) ? $_POST['pg_token'] : (array_key_exists
        ('PAGSEGURO_TOKEN', $conf) ? $conf['PAGSEGURO_TOKEN'] : '');
	*/
    /** ARQUIVO FORNECIDO PELO PAGSEGURO **/
    // RECEBE O POST ENVIADO PELA PagSeguro E ADICIONA OS VALORES PARA VALIDAÇÃO DOS DADOS
    /*
	$PagSeguro = 'Comando=validar';
    $PagSeguro .= '&Token=' . $token;
    $Cabecalho = "";

    foreach ($_POST as $key => $value)
    {
        $value = urlencode(stripslashes($value));
        $PagSeguro .= "&$key=$value";
    }

    if (function_exists('curl_exec'))
    {
        //Prefira utilizar a função CURL do PHP
        //Leia mais sobre CURL em: http://us3.php.net/curl
        $curl = true;
    } elseif ((PHP_VERSION >= 4.3) && ($fp = @fsockopen('ssl://pagseguro.uol.com.br',
    443, $errno, $errstr, 30)))
    {
        $fsocket = true;
    } elseif ($fp = @fsockopen('pagseguro.uol.com.br', 80, $errno, $errstr, 30))
    {
        $fsocket = true;
    }

    // ENVIA DE VOLTA PARA A PagSeguro OS DADOS PARA VALIDAÇÃO
    if ($curl == true)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,
            'https://pagseguro.uol.com.br/Security/NPI/Default.aspx');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $PagSeguro);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($ch);
        if (!tep_not_null($resp))
        {
            curl_setopt($ch, CURLOPT_URL,
                'https://pagseguro.uol.com.br/Security/NPI/Default.aspx');
            $resp = curl_exec($ch);
        }

        curl_close($ch);
        $confirma = (strcmp($resp, "VERIFICADO") == 0);
    } elseif ($fsocket == true)
    {
        $Cabecalho = "POST /Security/NPI/Default.aspx HTTP/1.0\r\n";
        $Cabecalho .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $Cabecalho .= "Content-Length: " . strlen($PagSeguro) . "\r\n\r\n";

        if ($fp || $errno > 0)
        {
            fputs($fp, $Cabecalho . $PagSeguro);
            $confirma = false;
            $resp = '';
            while (!feof($fp))
            {
                $res = @fgets($fp, 1024);
                $resp .= $res;
                // Verifica se o status da transação está VERIFICADO
                if (strcmp($res, "VERIFICADO") == 0)
                {
                    $confirma = true;
                    break;
                }
            }
            fclose($fp);
        } else
        {
            echo "$errstr ($errno)<br />\n";
            // ERRO HTTP
        }
    }
    */
    /** FIM DO ARQUIVO DO PAGSEGURO **/

    /*if ($confirma)
    {*/

        $id_transacao 		= $_POST['Referencia'];
        $id_transacao 		= str_replace('PRS-', '', $id_transacao);
        $status_pagamento 	= $_POST['StatusTransacao'];
        //$valor			= 	$_POST['valor'];

        $order 				= new Order(intval($id_transacao));
        $cart 				= Cart::getCartByOrderId($id_transacao);

        $mailVars 			= array('{bankwire_owner}' => '', '{bankwire_details}' => '',
            '{bankwire_address}' => '');

        if 		($status_pagamento 	== 'Completo')
        $status 			= Configuration::get('PAGSEGURO_STATUS_0');

        elseif ($status_pagamento 	== 'Aguardando Pagto')
        $status 			= Configuration::get('PAGSEGURO_STATUS_1');
            
        elseif ($status_pagamento 	== 'Aprovado')
        $status 			= Configuration::get('PAGSEGURO_STATUS_2');
            
        elseif ($status_pagamento 	== 'Em Análise')
        $status 			= Configuration::get('PAGSEGURO_STATUS_3');
            
        elseif ($status_pagamento 	== 'Cancelado')
        $status 			= Configuration::get('PAGSEGURO_STATUS_4');
        
		else
        $status 			= _PS_OS_ERROR_;

        $total 				= floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', ''));

		/** ENVIO DO EMAIL **/
		$pagseguro			= new pagseguro();	
		$idCustomer 		= $order->id_customer;
		$idLang				= $order->id_lang;
		$customer 			= new Customer(intval($idCustomer));
		$CusMail			= $customer->email;
		
		$mailVars 			= array
		(
			'{email}'			=> Configuration::get('PS_SHOP_EMAIL'),
			'{firstname}' 		=> stripslashes($customer->firstname), 
			'{lastname}' 		=> stripslashes($customer->lastname),
			'{terceiro}'		=> stripslashes($pagseguro->displayName),
			'{id_order}'		=> stripslashes($pagseguro->currentOrder),
			'{status}'			=> stripslashes($pagseguro->getStatus($status))
		);
		$assunto 			= $pagseguro->getStatus($status);
		$pagseguro->enviar($mailVars, 'pagseguro', $assunto, $pagseguro->displayName, $idCustomer, $idLang, $customer->email, 
		'modules/pagseguro/mails/');
		/** /ENVIO DO EMAIL **/

        $extraVars 			= array();
        $history 			= new OrderHistory();
        $history->id_order 	= intval($id_transacao);
        $history->changeIdOrderState(intval($status), intval($id_transacao));
        $history->addWithemail(true, $extraVars);

        exit;
	/*
    }
	*/
}

?>