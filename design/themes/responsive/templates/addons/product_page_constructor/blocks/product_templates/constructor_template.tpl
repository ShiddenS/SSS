{if $product.constructor_template}
{script src="js/tygh/exceptions.js"}
<div class="ty-product-block ty-product-detail">
	<div class="ty-product-block__wrapper constructor-wrapper clearfix" data-no-defer>
		{hook name="products:view_main_info"}
		{if $product}
			{assign var="obj_id" value="ppc_`$product.product_id`"}
			{include file="common/product_data.tpl" product=$product but_role="big" but_text=__("add_to_cart")}
				{assign var="form_open" value="form_open_`$obj_id`"}
				{$smarty.capture.$form_open nofilter}

				{capture name='content'}
					{render_location location_id=$product.constructor_template}
				{/capture}
				{eval_string var=$smarty.capture.content}

				{assign var="form_close" value="form_close_`$obj_id`"}
				{$smarty.capture.$form_close nofilter}
		{/if}
		{/hook}
	</div>
</div>

<div class="product-details">
</div>

{capture name="mainbox_title"}{assign var="details_page" value=true}{/capture}

{else} 
	{include file='blocks/product_templates/default_template.tpl'}
{/if}
