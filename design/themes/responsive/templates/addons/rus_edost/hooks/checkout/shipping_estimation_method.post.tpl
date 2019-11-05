{if $cart.chosen_shipping.$group_key == $shipping.shipping_id && $shipping.module == 'edost'}
    <div class="clearfix">
        <div class="ty-checkout-select-store__estimation">
            {assign var="office_count" value=$shipping.data.office|count}
            {assign var="shipping_id" value=$shipping.shipping_id}
            {assign var="old_office_id" value=$select_office.$group_key.$shipping_id}

            {if !$old_office_id && $office_count > 1}
                {assign var="old_office_id" value=$shipping.data.office|key}
            {/if}

            <div class="ty-checkout-select-terminals">
                {foreach from=$shipping.data.office item=office}
                    <div class="ty-one-office">
                        <input type="radio" name="select_office[{$group_key}][{$shipping.shipping_id}]" value="{$office.office_id}" {if $old_office_id == $office.office_id || $office_count == 1}checked="checked"{/if} id="office_{$group_key}_{$shipping.shipping_id}_{$office.office_id}" class="ty-office-radio" >
                        <div class="ty-one-office__label">
                            <label for="office_{$group_key}_{$shipping.shipping_id}_{$office.office_id}" >
                                <p class="ty-one-office__name">{$office.name}</p>
                                <div class="ty-one-office__description">{$office.address} (<a target="_blank" href="http://www.edost.ru/office.php?c={$office.office_id}">{__("edost.header.office_map")}</a>)
                                    <br />
                                    {$office.tel}<br />
                                    {$office.schedule}<br />
                                </div>
                            </label>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
{/if}
