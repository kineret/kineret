{if isset($products)}
	<!-- Products list -->
	<ul id="product_list" class="clear">
	{foreach from=$products item=product name=products}
		<li class="ajax_block_product {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if} {if $smarty.foreach.products.index % 2}alternate_item{else}item{/if} clearfix">
			<div class="center_block">
				<a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_link" title="{$product.name|escape:'htmlall':'UTF-8'}"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home')}" alt="{$product.legend|escape:'htmlall':'UTF-8'}" width="{$homeSize.width}" height="{$homeSize.height}" /></a>
				<h3>{if $product.new == 1}<span class="new">{l s='new'}</span>{/if}<a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|truncate:35:'...'|escape:'htmlall':'UTF-8'}</a></h3>
				<p class="product_desc"><a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.description_short|truncate:360:'...'|escape:'htmlall':'UTF-8'|strip_tags:'UTF-8'}">{$product.description_short|truncate:360:'...'|strip_tags:'UTF-8'}</a></p>
			</div>																				 
			<div class="right_block">
				{if $product.on_sale}
					<span class="on_sale">{l s='On sale!'}</span>
				{elseif ($product.reduction_price != 0 || $product.reduction_percent != 0) && ($product.reduction_from == $product.reduction_to OR ($smarty.now|date_format:'%Y-%m-%d %H:%M:%S' <= $product.reduction_to && $smarty.now|date_format:'%Y-%m-%d %H:%M:%S' >= $product.reduction_from))}
					<span class="discount">{l s='Price lowered!'}</span>
				{/if}
				<div>
					<span class="price" style="display: inline;">{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span><br />
					<span class="availability">{if ($product.allow_oosp OR $product.quantity > 0)}{l s='Available'}{else}{l s='Out of stock'}{/if}</span>
				</div>
				{if ($product.allow_oosp OR $product.quantity > 0) && $product.customizable != 2}
					<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_{$product.id_product|intval}" href="{$base_dir}cart.php?add&amp;id_product={$product.id_product|intval}&amp;token={$static_token}" title="{l s='Add to cart'}">{l s='Add to cart'}</a>
				{else}
						<span class="exclusive">{l s='Add to cart'}</span>
				{/if}
				<a class="button" href="{$product.link|escape:'htmlall':'UTF-8'}" title="{l s='View'}">{l s='View'}</a>
			</div>
		</li>
	{/foreach}
	</ul>
	<!-- /Products list -->
{/if}