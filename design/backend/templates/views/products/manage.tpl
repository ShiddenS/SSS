{script src="js/tygh/backend/products_manage.js"}

{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="manage_products_form" id="manage_products_form" data-ca-main-content-selector="[data-ca-main-content]">
<input type="hidden" name="category_id" value="{$search.cid}" />

{include file="common/pagination.tpl" save_current_page=true save_current_url=true div_id=$smarty.request.content_id}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

{assign var="rev" value=$smarty.request.content_id|default:"pagination_contents"}
{assign var="c_icon" value="<i class=\"icon-`$search.sort_order_rev`\"></i>"}
{assign var="c_dummy" value="<i class=\"icon-dummy\"></i>"}

{if $products}

{hook name="products:bulk_edit"}
    {include file="views/products/components/bulk_edit.tpl"}
{/hook}

<div class="table-responsive-wrapper longtap-selection">
    <table width="100%" class="table table-middle table-responsive products-table" data-ca-main-content>
    <thead data-ca-bulkedit-default-object="true" data-target=".products-table" class="cm-hidden-visibility">
    <tr>
        {hook name="products:manage_head"}
        <th width="6%" class="left mobile-hide">
            {include file="common/check_items.tpl" check_statuses=''|fn_get_default_status_filters:true}

            <input type="checkbox"
                   class="bulkedit-toggler hide"
                   data-ca-bulkedit-toggler="true"
                   data-ca-bulkedit-disable="[data-ca-bulkedit-default-object=true]" 
                   data-ca-bulkedit-enable="[data-ca-bulkedit-expanded-object=true]"
            />
        </th>
        {if $search.cid && $search.subcats != "Y"}
        <th class="nowrap"><a class="cm-ajax" href="{"`$c_url`&sort_by=position&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id={$rev}>{__("position_short")}{if $search.sort_by == "position"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        {/if}
        <th></th>
        <th><a class="cm-ajax" href="{"`$c_url`&sort_by=product&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id={$rev}>{__("name")}{if $search.sort_by == "product"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a> /&nbsp;&nbsp;&nbsp; <a class="{$ajax_class}" href="{"`$c_url`&sort_by=code&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id={$rev}>{__("sku")}{if $search.sort_by == "code"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        <th width="13%"><a class="cm-ajax" href="{"`$c_url`&sort_by=price&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id={$rev}>{__("price")} ({$currencies.$primary_currency.symbol nofilter}){if $search.sort_by == "price"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        <th width="12%" class="mobile-hide"><a class="cm-ajax" href="{"`$c_url`&sort_by=list_price&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id={$rev}>{__("list_price")} ({$currencies.$primary_currency.symbol nofilter}){if $search.sort_by == "list_price"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        {if $search.order_ids}
        <th width="9%"><a class="cm-ajax" href="{"`$c_url`&sort_by=p_qty&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id={$rev}>{__("purchased_qty")}{if $search.sort_by == "p_qty"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        <th width="9%"><a class="cm-ajax" href="{"`$c_url`&sort_by=p_subtotal&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id={$rev}>{__("subtotal_sum")} ({$currencies.$primary_currency.symbol nofilter}){if $search.sort_by == "p_subtotal"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        {/if}
        <th width="9%" class="nowrap"><a class="cm-ajax" href="{"`$c_url`&sort_by=amount&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id={$rev}>{__("quantity")}{if $search.sort_by == "amount"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        {/hook}
        <th width="9%" class="mobile-hide">&nbsp;</th>
        <th width="9%" class="right"><a class="cm-ajax" href="{"`$c_url`&sort_by=status&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id={$rev}>{__("status")}{if $search.sort_by == "status"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$products item=product}
    {hook name="products:manage_table_body"}

    {if "ULTIMATE"|fn_allowed_for}
        {if $runtime.company_id && $product.is_shared_product == "Y" && $product.company_id != $runtime.company_id}
            {assign var="hide_inputs_if_shared_product" value="cm-hide-inputs"}
            {assign var="no_hide_input_if_shared_product" value="cm-no-hide-input"}
        {else}
            {assign var="hide_inputs_if_shared_product" value=""}
            {assign var="no_hide_input_if_shared_product" value=""}
        {/if}
        {if !$runtime.company_id && $product.is_shared_product == "Y"}
            {assign var="show_update_for_all" value=true}
        {else}
            {assign var="show_update_for_all" value=false}
        {/if}
    {/if}

        <tr class="cm-row-status-{$product.status|lower} cm-longtap-target {$hide_inputs_if_shared_product}"
            data-ca-longtap-action="setCheckBox"
            data-ca-longtap-target="input.cm-item"
            data-ca-id="{$product.product_id}"
            data-ca-category-ids="{$product.category_ids|to_json}"
        >
            {hook name="products:manage_body"}
            <td width="6%" class="left mobile-hide">
            <input type="checkbox" name="product_ids[]" value="{$product.product_id}" class="cm-item cm-item-status-{$product.status|lower} hide" /></td>
            {if $search.cid && $search.subcats != "Y"}
            <td class="{if $no_hide_input_if_shared_product}{$no_hide_input_if_shared_product}{/if}">
                <input type="text" name="products_data[{$product.product_id}][position]" size="3" value="{$product.position}" class="input-micro" /></td>
            {/if}
            <td class="products-list__image">
                {include 
                        file="common/image.tpl" 
                        image=$product.main_pair.icon|default:$product.main_pair.detailed 
                        image_id=$product.main_pair.image_id 
                        image_width=$settings.Thumbnails.product_admin_mini_icon_width 
                        image_height=$settings.Thumbnails.product_admin_mini_icon_height 
                        href="products.update?product_id=`$product.product_id`"|fn_url
                        image_css_class="products-list__image--img"
                        link_css_class="products-list__image--link"
                }
            </td>
            <td class="product-name-column" data-th="{__("name")}">
                <input type="hidden" name="products_data[{$product.product_id}][product]" value="{$product.product}" {if $no_hide_input_if_shared_product} class="{$no_hide_input_if_shared_product}"{/if} />
                <a class="row-status" title="{$product.product|strip_tags}" href="{"products.update?product_id=`$product.product_id`"|fn_url}">{$product.product|truncate:40 nofilter}</a>
                <div class="product-list__labels">
                    {hook name="products:product_additional_info"}
                        <div class="product-code">
                            <span class="product-code__label">{$product.product_code}</span>
                        </div>
                    {/hook}
                </div>
                {include file="views/companies/components/company_name.tpl" object=$product}
            </td>
            <td width="13%" class="{if $no_hide_input_if_shared_product}{$no_hide_input_if_shared_product}{/if}" data-th="{__("price")}">
                {include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id="price_`$product.product_id`" name="update_all_vendors[price][`$product.product_id`]"}
                <input type="text" name="products_data[{$product.product_id}][price]" size="6" value="{$product.price|fn_format_price:$primary_currency:null:false}" class="input-mini input-hidden"/>
            </td>
            <td width="12%" class="mobile-hide" data-th="{__("list_price")}">
                {hook name="products:list_list_price"}
                    <input type="text" name="products_data[{$product.product_id}][list_price]" size="6" value="{$product.list_price|fn_format_price:$primary_currency:null:false}" class="input-mini input-hidden" />
                {/hook}
            </td>
            {if $search.order_ids}
            <td width="9%" data-th="{__("purchased_qty")}">{$product.purchased_qty}</td>
            <td width="9%" data-th="{__("subtotal_sum")}">{$product.purchased_subtotal}</td>
            {/if}
            <td width="9%" data-th="{__("quantity")}">
                {hook name="products:list_quantity"}
                    {if $product.tracking == "ProductTracking::TRACK_WITH_OPTIONS"|enum}
                        {include file="buttons/button.tpl" but_text=__("edit") but_href="product_options.inventory?product_id=`$product.product_id`" but_role="edit"}
                    {else}
                        <input type="text" name="products_data[{$product.product_id}][amount]" size="6" value="{$product.inventory_amount|default:$product.amount}" class="input-full input-hidden" />
                    {/if}
                {/hook}
            </td>
            {/hook}
            <td width="9%" class="nowrap mobile-hide">
                <div class="hidden-tools">
                    {capture name="tools_list"}
                        {hook name="products:list_extra_links"}
                            <li>{btn type="list" text=__("edit") href="products.update?product_id=`$product.product_id`"}</li>
                            {if !$hide_inputs_if_shared_product}
                                <li>{btn type="list" text=__("delete") class="cm-confirm" href="products.delete?product_id=`$product.product_id`" method="POST"}</li>
                            {/if}
                        {/hook}
                    {/capture}
                    {dropdown content=$smarty.capture.tools_list}
                </div>
            </td>
            <td width="9%" class="right nowrap" data-th="{__("status")}">
            {include file="common/select_popup.tpl" popup_additional_class="dropleft" id=$product.product_id status=$product.status hidden=true object_id_name="product_id" table="products"}
            </td>
        </tr>
        {/hook}
        {/foreach}
    </tbody>
    </table>
</div>
{else}
    <p class="no-items">{__("no_data")}</p>
{/if}

{capture name="select_fields_to_edit"}

{include file="components/easter_egg.tpl"}

<p>{__("text_select_fields2edit_note")}</p>
{include file="views/products/components/products_select_fields.tpl"}

<div class="buttons-container">
    {include file="buttons/save_cancel.tpl" but_text=__("modify_selected") but_name="dispatch[products.store_selection]" cancel_action="close"}
</div>
{/capture}

{capture name="buttons"}
    {capture name="tools_list"}
        {hook name="products:action_buttons"}
        <li>{btn type="list" text=__("global_update") href="products.global_update"}</li>
        <li>{btn type="list" text=__("bulk_product_addition") href="products.m_add"}</li>
        <li>{btn type="list" text=__("product_subscriptions") href="products.p_subscr"}</li>
        {/hook}
    {/capture}
    {dropdown content=$smarty.capture.tools_list}
    {if $products}
        {include file="buttons/save.tpl" but_name="dispatch[products.m_update]" but_role="action" but_target_form="manage_products_form" but_meta="cm-submit"}
    {/if}
{/capture}

{capture name="adv_buttons"}
    {hook name="products:manage_tools"}
        {include file="common/tools.tpl" tool_href="products.add" prefix="top" title=__("add_product") hide_tools=true icon="icon-plus"}
    {/hook}
{/capture}

{include file="common/popupbox.tpl" id="select_fields_to_edit" text=__("select_fields_to_edit") content=$smarty.capture.select_fields_to_edit}

<div class="clearfix">
    {include file="common/pagination.tpl" div_id=$smarty.request.content_id}
</div>

</form>

{/capture}

{capture name="sidebar"}
    {hook name="products:manage_sidebar"}
    {include file="common/saved_search.tpl" dispatch="products.manage" view_type="products"}
    {include file="views/products/components/products_search_form.tpl" dispatch="products.manage"}
    {/hook}
{/capture}

{include file="common/mainbox.tpl" title=__("products") content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra adv_buttons=$smarty.capture.adv_buttons select_languages=true buttons=$smarty.capture.buttons sidebar=$smarty.capture.sidebar content_id="manage_products"}
