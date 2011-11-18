{if $status == 'ok'}
	<p>{l s='Your order on' mod='paypalapi'} <span class="bold">{$shop_name}</span> {l s='is complete.' mod='paypalapi'}
		<br /><br />
		<br /><br /><span class="bold">{l s='Your order will be sent as soon as possible.' mod='paypalapi'}</span>
		<br /><br />{l s='For any questions or for further information, please contact our' mod='paypalapi'} <a href="{$base_dir_ssl}contact-form.php">{l s='customer support' mod='paypalapi'}</a>.
	</p>
{elseif $status == 'pending'}
	<p>{l s='Your order on' mod='paypalapi'} <span class="bold">{$shop_name}</span> {l s='is pending.' mod='paypalapi'}
		<br /><br />
		<br /><br /><span class="bold">{l s='Your order will be sent as soon as we receive your settlement.' mod='paypalapi'}</span>
		<br /><br />{l s='For any questions or for further information, please contact our' mod='paypalapi'} <a href="{$base_dir_ssl}contact-form.php">{l s='customer support' mod='paypalapi'}</a>.
	</p>
{else}
	<p class="warning">
		{l s='We noticed a problem with your order. If you think this is an error, you can contact our' mod='paypalapi'} 
		<a href="{$base_dir_ssl}contact-form.php">{l s='customer support' mod='paypalapi'}</a>.
	</p>
{/if}