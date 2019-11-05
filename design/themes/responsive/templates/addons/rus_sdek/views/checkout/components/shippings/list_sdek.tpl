{$_max_desktop_items = $max_desktop_items|default:5}
{$sdek_map_container = "sdek_map_container_`$shipping.shipping_id`"}

<div class="ty-checkout-select-store__map-full-div pickup pickup--list">

    {* For mobiles; List wrapper with selected pickup item *}
    {foreach from=$shipping.data.offices item=store}
        {capture name="marker_content"}
            <div class="litecheckout-ya-baloon">
                <strong class="litecheckout-ya-baloon__store-name">{$store.Name}</strong>

                {if $store.Address}<p class="litecheckout-ya-baloon__store-address">{$store.Address nofilter}</p>{/if}

                <p class="litecheckout-ya-baloon__select-row">
                    <a data-ca-shipping-id="{$shipping.shipping_id}"
                       data-ca-group-key="{$group_key}"
                       data-ca-location-id="{$store.Code}"
                       data-ca-target-map-id="{$sdek_map_container}"
                       class="cm-sdek-select-location ty-btn ty-btn__primary text-button ty-width-full"
                    >{__("select")}</a>
                </p>

                {if $store.Phone}<p class="litecheckout-ya-baloon__store-phone"><a href="tel:{$store.Phone nofilter}">{$store.Phone nofilter}</a></p>{/if}
                {if $store.WorkTime}<p class="litecheckout-ya-baloon__store-time">{$store.WorkTime nofilter}</p>{/if}
                {if $store.AddressComment}<div class="litecheckout-ya-baloon__store-description">{$store.AddressComment nofilter}</div>{/if}
            </div>
        {/capture}

        <div class="cm-rus-sdek-map-marker-{$shipping.shipping_id} hidden"
             data-ca-geo-map-marker-lat="{$store.coordY}"
             data-ca-geo-map-marker-lng="{$store.coordX}"
                {if $old_office_id == $store.Code || $store_count == 1}
                    data-ca-geo-map-marker-selected="true"
                {/if}
        >{$smarty.capture.marker_content nofilter}</div>

        {if $old_office_id == $store.Code}
        <div class="ty-checkout-select-store pickup__offices-wrapper visible-phone pickup__offices-wrapper--near-map">
            {* List *}
            <div class="litecheckout__fields-row litecheckout__fields-row--wrapped pickup__offices pickup__offices--list pickup__offices--list-no-height">
                {include file="addons/rus_sdek/views/checkout/components/shippings/items/sdek.tpl"    
                         store=$store
                         ids_prefix="mobile_"
                }
            </div>
            {* End of List *}
        </div>
        {/if}
    {/foreach}
    {* For mobiles; List wrapper with selected pickup item *}

    {* For mobiles; button for popup with pickup points *}
    <button class="ty-btn ty-btn__secondary cm-open-pickups pickup__open-pickupups-btn visible-phone"
        data-ca-title="{__('lite_checkout.choose_from_list')}"
        data-ca-target=".pickup__offices-wrapper-open"
        type="button"
    >{__('lite_checkout.choose_from_list')}</button>
    <span class="visible-phone cm-open-pickups-msg"></span>
    {* For mobiles; button for popup with pickup points *}

    {* List wrapper *}
    <div class="ty-checkout-select-store pickup__offices-wrapper pickup__offices-wrapper-open hidden-phone">

        {* Search *}
        {if $store_count >= $_max_desktop_items}
        <div class="pickup__search">
            <div class="pickup__search-field litecheckout__field">
                <input type="text"
                       id="pickup-search"
                       class="litecheckout__input js-pickup-search-input"
                       placeholder=" "
                       value=""
                />
                <label class="litecheckout__label" for="pickup-search">{__("search")}</label>
            </div>
        </div>
        {/if}
        {* End of Search *}

        {* List *}
        <label for="pickup_office_list"
               class="cm-required cm-multiple-radios hidden"
               data-ca-validator-error-message="{__("pickup_point_not_selected")}"></label>
        <div class="litecheckout__fields-row litecheckout__fields-row--wrapped pickup__offices pickup__offices--list"
             id="pickup_office_list"
             data-ca-error-message-target-node-change-on-screen="xs,xs-large,sm"
             data-ca-error-message-target-node-after-mode="true"
             data-ca-error-message-target-node-on-screen=".cm-open-pickups-msg"
             data-ca-error-message-target-node=".pickup__offices--list"
        >
            {foreach $shipping.data.offices as $store}
                {include file="addons/rus_sdek/views/checkout/components/shippings/items/sdek.tpl"
                         store=$store
                         ids_prefix="std_"
                }
            {/foreach}
        </div>
        {* End of List *}

    </div>
    {* End of List wrapper *}

</div>
