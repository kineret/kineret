{if $status == 'ok'}
	<center>
	<img src="modules/pagseguro/imagens/btnFinal.gif" alt="{l s='Pague com PagSeguro' mod='pagseguro'}" />
	</center>
	<br />
	<h3>{l s='Parabéns! Seu pedido foi gerado com sucesso.' mod='pagseguro'}</h3>
	<p>{l s='O valor da sua compra é de:' mod='pagseguro'} <span class="price">{$totalApagar}</span></p>
	<p>{l s='Para efetuar o pagamento utilize o botão abaixo' mod='pagseguro'}</p>
	<p>{l s='Em caso de dúvidas favor utilizar o' mod='pagseguro'}	<a href="{$base_dir}contact-form.php">{l s='formulário de contato' mod='cheque'}</a>.</p>
	<br />
	{$formPagSeguro}
	{else}
	<p class="warning">
	{l s='Houve alguma falha no envio do seu pedido. Por Favor entre em contato com o nosso Suporte' mod='pagseguro'} 
	<a href="{$base_dir}contact-form.php">{l s='customer support' mod='pagseguro'}</a>.
	</p>
{/if}
