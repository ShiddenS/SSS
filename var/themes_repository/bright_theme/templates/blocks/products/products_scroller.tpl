{** block-description:tmpl_scroller **}

{if $settings.Appearance.enable_quick_view == "Y" && $block.properties.enable_quick_view == "Y"}
    {$quick_nav_ids = $items|fn_fields_from_multi_level:"product_id":"product_id"}    
    {$show_quick_view = true}
{/if}

{if $block.properties.hide_add_to_cart_button == "Y"}
    {assign var="show_add_to_cart" value=false}
{else}
    {assign var="show_add_to_cart" value=true}
{/if}
{if $block.properties.show_price == "Y"}
    {assign var="hide_price" value=false}
{else}
    {assign var="hide_price" value=true}
{/if}

{assign var="show_trunc_name" value=true}
{assign var="show_old_price" value=true}
{assign var="show_price" value=true}
{assign var="show_rating" value=true}
{assign var="show_clean_price" value=true}
{assign var="show_list_discount" value=true}
{assign var="but_role" value="action"}
{assign var="show_product_labels" value=true}
{assign var="show_discount_label" value=true}
{assign var="show_shipping_label" value=true}

{* FIXME: Don't move this file *}
{script src="js/tygh/product_image_gallery.js"}

{assign var="obj_prefix" value="`$block.block_id`000"}
{$block.properties.outside_navigation = "N"}

<div id="scroll_list_{$block.block_id}" class="owl-carousel ty-scroller-list grid-list ty-scroller-advanced">
    {foreach from=$items item="product" name="for_products"}
        {hook name="products:product_scroller_advanced_list"}
        <div class="ty-scroller-list__item">
            {if $product}
                {assign var="obj_id" value=$product.product_id}
                {assign var="obj_id_prefix" value="`$obj_prefix``$product.product_id`"}
                {include file="common/product_data.tpl" product=$product}

                <div class="ty-grid-list__item ty-quick-view-button__wrapper ty-left
                {if $show_quick_view} ty-grid-list__item--overlay{/if}">
                    {assign var="form_open" value="form_open_`$obj_id`"}
                    {$smarty.capture.$form_open nofilter}

                    <div class="ty-grid-list__image">
                        {assign var="product_labels" value="product_labels_`$obj_prefix``$obj_id`"}
                        {$smarty.capture.$product_labels nofilter}

                        {include file="views/products/components/product_icon.tpl" product=$product show_gallery=true}
                    </div>

                    <div class="ty-grid-list__item-name">
                        {if $item_number == "Y"}
                            <span class="item-number">{$cur_number}.&nbsp;</span>
                            {math equation="num + 1" num=$cur_number assign="cur_number"}
                        {/if}

                        {assign var="name" value="name_$obj_id"}
                        <bdi>{$smarty.capture.$name nofilter}</bdi>
                    </div>

                    {if !$hide_price}
                        <div class="ty-grid-list__price {if $product.price == 0}ty-grid-list__no-price{/if}">
                            {assign var="old_price" value="old_price_`$obj_id`"}
                            {if $smarty.capture.$old_price|trim}{$smarty.capture.$old_price nofilter}{/if}

                            {assign var="price" value="price_`$obj_id`"}
                            {$smarty.capture.$price nofilter}

                            {assign var="clean_price" value="clean_price_`$obj_id`"}
                            {$smarty.capture.$clean_price nofilter}

                            {assign var="list_discount" value="list_discount_`$obj_id`"}
                            {$smarty.capture.$list_discount nofilter}
                        </div>
                    {/if}

                    {assign var="rating" value="rating_$obj_id"}
                    {if $smarty.capture.$rating}
                        <div class="grid-list__rating">
                            {$smarty.capture.$rating nofilter}
                        </div>
                    {/if}

                    {capture name="product_multicolumns_list_control_data_wrapper"}
                        <div class="ty-grid-list__control">
                            {capture name="product_multicolumns_list_control_data"}
                                {if $show_quick_view}
                                    {include file="views/products/components/quick_view_link.tpl" quick_nav_ids=$quick_nav_ids}
                                {/if}

                                {if $show_add_to_cart}
                                    <div class="button-container">
                                        {$add_to_cart = "add_to_cart_`$obj_id`"}
                                        {$smarty.capture.$add_to_cart nofilter}
                                    </div>
                                {/if}
                            {/capture}
                            {$smarty.capture.product_multicolumns_list_control_data nofilter}
                        </div>
                    {/capture}


                    {if $smarty.capture.product_multicolumns_list_control_data|trim}
                        {$smarty.capture.product_multicolumns_list_control_data_wrapper nofilter}
                    {/if}

                    {assign var="form_close" value="form_close_`$obj_id`"}
                    {$smarty.capture.$form_close nofilter}
                </div>
            {/if}
        </div>
        {/hook}
    {/foreach}
</div>

{include file="common/scroller_init.tpl"}
