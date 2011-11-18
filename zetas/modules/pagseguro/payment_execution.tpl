{capture name=path}{l s='Shipping'}{/capture}
{include file=$tpl_dir./breadcrumb.tpl}

<h2>{l s='Order summary' mod='pagseguro'}</h2>

{assign var='current_step' value='payment'}
{include file=$tpl_dir./order-steps.tpl}

<h3>{l s='Pagamento via PagSeguro' mod='pagseguro'}</h3>


<p>
	<img src="{$imgBtn}" alt="{l s='PagSeguro' mod='pagseguro'}" style="float:left; margin: 0px 10px 5px 0px;" />
	<br /><br />
	<br /><br />
</p>

<form action="{$this_path_ssl}validation.php" method="post">
<p style="margin-top:20px;">
	{l s='Valor total do pedido:' mod='pagseguro'}
	{if $currencies|@count > 1}
		{foreach from=$currencies item=currency}
			<span id="amount_{$currency.id_currency}" class="price" style="display:none;">R$ {$total}</span>
		{/foreach}
	{else}
			<span id="amount_{$currencies.0.id_currency}" class="price">R$ {$total}</span>
	{/if}
</p>
<p>
	<b>{l s='Por favor confira as formas de pagamento aceitas pelo PagSeguro e 
	confirme sua compra clicando em \'Confirmar Compra\'' mod='pagseguro'}.</b>
</p>

<p>
	<center><img src="{$imgBnr}" alt="{l s='Formas de Pagamento PagSeguro' mod='pagseguro'}"></center>
</p>

<p class="cart_navigation">
	<a href="{$base_dir_ssl}order.php?step=3" class="button_large">{l s='Outras formas de pagamento' mod='pagseguro'}</a>
	<input type="submit" name="submit" value="{l s='Confirmar Compra' mod='pagseguro'}" class="exclusive_large" />
</p>
</form>