<script>
(function ($, _) {
    $.ceEvent('on', 'ce.commoninit', function () {
        $(_.doc).on('click', '.cm-toggle', function () {
            var params = $(this).data();

            if (params.caToggleTarget == undefined || params.caToggleContainer == undefined) {
                return;
            }

            $(params.caToggleContainer)
                .find('.cm-toggle-target')
                .toggleClass('hidden', true);

            $(params.caToggleTarget)
                .toggleClass('hidden', false);
        });
    });
})($, Tygh);
</script>

<div class="litecheckout__section">
    <div class="litecheckout__group">
    {foreach $payment_methods_list as $tab_id => $payment_data}
        {if $payment_data.status == "A"}
            <label class="cm-toggle litecheckout__shipping-method litecheckout__field litecheckout__field--xsmall"
                data-ca-toggle-target=".cm-toggle-target[data-ca-id={$tab_id}_{$payment_data.payment_id}]"
                data-ca-toggle-container=".payments"
                for="radio_{$tab_id}_{$payment_data.payment_id}"
            >
                <input type="radio"
                        id="radio_{$tab_id}_{$payment_data.payment_id}"
                        class="hidden litecheckout__shipping-method__radio"
                        name="repay_radio_group"
                        {if $payment_id == $payment_data.payment_id}
                        checked="checked"
                        {/if}
                />
                <div class="litecheckout__shipping-method__wrapper">
                    {if $payment_data.image}
                        <div class="litecheckout__shipping-method__logo">
                            {include file="common/image.tpl" obj_id=$payment_data.payment_id images=$payment_data.image class="litecheckout__shipping-method__logo-image"}
                        </div>
                    {/if}
                    <p class="litecheckout__shipping-method__title">{$payment_data.payment}</p>
                    <p class="litecheckout__shipping-method__delivery-time">{$payment_data.description}</p>
                </div>
            </label>
        {/if}
    {/foreach}
    </div>
</div>

<div class="payments">
{foreach $payment_methods_list as $tab_id => $payment_data}
    {if $payment_data.status == "A"}
    <div class="litecheckout__item">
        <form name="payments_form_{$tab_id}"
                action="{""|fn_url}"
                method="post"
                class="payments-form cm-processing-personal-data litecheckout__field cm-toggle-target {if $payment_id != $payment_data.payment_id}hidden{/if}"
                data-ca-processing-personal-data-without-click="true"
                data-ca-id="{$tab_id}_{$payment_data.payment_id}"
        >
            <input type="hidden" name="payment_id" value="{$payment_data.payment_id}" />

            {if $order_id}
                <input type="hidden" name="order_id" value="{$order_id}" />
            {/if}

            {if $payment_data.instructions}
                {$payment_data.instructions nofilter}
            {/if}

            {if $payment_data.template}
                {include file=$payment_data.template}
            {/if}

            <div class="litecheckout__item">
                {include file="buttons/place_order.tpl" 
                        but_text=__("repay_order") 
                        but_name="dispatch[orders.repay]" 
                        but_meta="litecheckout__submit-btn--auto-width" 
                        but_role="big"
                }
            </div>
        </form>
    </div>
    {/if}
{/foreach}
</div>
