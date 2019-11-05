{assign var="result_ids" value="cart_items,checkout_totals,checkout_steps,cart_status*,checkout_cart"}

<form name="checkout_form" class="cm-check-changes" action="{""|fn_url}" method="post" enctype="multipart/form-data">
<input type="hidden" name="redirect_mode" value="cart" />
<input type="hidden" name="result_ids" value="{$result_ids}" />

<h1 class="ty-mainbox-title">{__("cart_contents")}</h1>

{include file="views/checkout/components/cart_items.tpl" disable_ids="button_cart"}

<div class="buttons-container ty-cart-content__bottom-buttons clearfix">
        <form name="checkout_form" class="cm-check-changes" action="{""|fn_url}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="redirect_mode" value="cart" />
            <input type="hidden" name="result_ids" value="{$result_ids}" />

            <div class="ty-float-left ty-cart-content__left-buttons">
                {include file="buttons/continue_shopping.tpl" but_href=$continue_url|fn_url }
            </div>
            <div class="ty-float-right ty-cart-content__right-buttons">
                {include file="buttons/clear_cart.tpl" but_href="checkout.clear" but_role="text" but_meta="cm-confirm ty-cart-content__clear-button"}
                {include file="buttons/update_cart.tpl" but_id="button_cart" but_name="dispatch[checkout.update]"}
            </div>
        </form>
    </div>
</form>

{include file="views/checkout/components/checkout_totals.tpl" location="cart"}
