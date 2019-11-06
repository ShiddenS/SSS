{if $cart.points_info.in_use}
    <li class="ty-cart-statistic__item">
        {assign var="_redirect_url" value=$config.current_url|escape:url}
            {if $use_ajax}{assign var="_class" value="cm-ajax"}{/if}
        <span class="ty-cart-statistic__title">{__("points_in_use")}&nbsp;({__("points_lowercase", [$cart.points_info.in_use.points])}){include file="buttons/button.tpl" but_href="checkout.delete_points_in_use?redirect_url=`$_redirect_url`" but_meta="cm-post ty-reward-points__delete-icon" but_role="delete" but_target_id="checkout_totals,subtotal_price_in_points,checkout_steps,litecheckout_form`$additional_ids`"}</span>
    </li>
{/if}

{if $cart.points_info.reward}
    <li class="ty-cart-statistic__item">
        <span class="ty-cart-statistic__title">{__("points")}</span>
        <span class="ty-cart-statistic__value">+{$cart.points_info.reward}</span>
    </li>
{/if}