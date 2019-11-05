{capture name="mainbox"}

{*include file="views/products/components/products_search_form.tpl" dispatch="products.p_subscr"*}

<form action="{""|fn_url}" method="post" name="manage_products_form">
<input type="hidden" name="category_id" value="{$search.cid}" />

{include file="common/pagination.tpl" save_current_page=true save_current_url=true}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}
{assign var="c_icon" value="<i class=\"icon-`$search.sort_order_rev`\"></i>"}
{assign var="c_dummy" value="<i class=\"icon-dummy\"></i>"}

{if $products}
<div class="table-responsive-wrapper">
    <table width="100%" class="table table-middle table-responsive">
    <thead>
    <tr>
        <th width="5%" class="center mobile-hide">
            {include file="common/check_items.tpl"}</th>
        {if $search.cid && $search.subcats != "Y"}
        <th><a class="cm-ajax" href="{"`$c_url`&sort_by=position&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id="pagination_contents">{__("position_short")}{if $search.sort_by == "position"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        {/if}
        <th width="15%"><a class="cm-ajax" href="{"`$c_url`&sort_by=code&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id="pagination_contents">{__("sku")}{if $search.sort_by == "code"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        <th width="60%"><a class="cm-ajax" href="{"`$c_url`&sort_by=product&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id="pagination_contents">{__("name")}{if $search.sort_by == "product"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>    
        <th>{hook name="products:p_subscr_head"}{/hook}</th>
        <th class="center" width="15%"><a class="cm-ajax" href="{"`$c_url`&sort_by=num_subscr&sort_order=`$search.sort_order_rev`"|fn_url}" data-ca-target-id="pagination_contents">{__("subscribers")}{if $search.sort_by == "num_subscr"}{$c_icon nofilter}{else}{$c_dummy nofilter}{/if}</a></th>
        <th width="5%">&nbsp;</th>
    </tr>
    </thead>
    {foreach from=$products item=product}
    <tr class="cm-row-status-{$product.status|lower}">
        <td class="center mobile-hide">
               <input type="checkbox" name="product_ids[]" value="{$product.product_id}" class="cm-item" /></td>
        {if $search.cid && $search.subcats != "Y"}
        <td data-th="{__("position_short")}">
            <input type="text" name="products_data[{$product.product_id}][position]" size="3" value="{$product.position}" class="input-small input-hidden" /></td>
        {/if}
        <td data-th="{__("sku")}">
            <input type="text" name="products_data[{$product.product_id}][product_code]" size="6" maxlength={"ProductFieldsLength::PRODUCT_CODE"|enum} value="{$product.product_code}" class="input-small input-hidden" /></td>
        <td class="row-status" data-th="{__("name")}">
            <input type="hidden" name="products_data[{$product.product_id}][product]" value="{$product.product}" />
            <a href="{"products.update?product_id=`$product.product_id`&selected_section=subscribers"|fn_url}" {if $product.status == "N"}class="manage-root-item-disabled"{/if}>{$product.product nofilter}</a>
            <div class="product-list__labels">
                {hook name="products:product_additional_info"}
                    <div class="product-code">
                        <span class="product-code__label">{$product.product_code}</span>
                    </div>
                {/hook}
            </div>
            {include file="views/companies/components/company_name.tpl" object=$product}
        </td>
        <td>{hook name="products:p_subscr_body"}{/hook}</td>
        <td class="center" data-th="{__("subscribers")}">
            <span>&nbsp;{$product.num_subscr}&nbsp;</span>
        </td>
        <td class="nowrap" data-th="tools">
            {capture name="tools_list"}
                {hook name="products:p_subscr_extra_links"}
                    <li>{btn type="list" text=__("edit") href="products.update?product_id=`$product.product_id`&selected_section=subscribers"}</li>
                    <li>{btn type="list" class="cm-confirm" text=__("delete") href="products.delete_subscr?product_id=`$product.product_id`" method="POST"}</li>
                {/hook}
            {/capture}
            <div class="hidden-tools">
                {dropdown content=$smarty.capture.tools_list}
            </div>
        </td>
    </tr>
    {/foreach}
    </table>
</div>
{else}
    <p class="no-items">{__("no_data")}</p>
{/if}

{include file="common/pagination.tpl"}

{capture name="buttons"}
    <span class="mobile-hide shift-right">
    {capture name="tools_list"}
        {if $products}
            <li>{btn type="delete_selected" dispatch="dispatch[products.m_delete_subscr]" form="manage_products_form"}</li>
        {/if}
    {/capture}
    {dropdown content=$smarty.capture.tools_list}
    </span>

    {if $products}
        {include file="buttons/save.tpl" but_name="dispatch[products.m_update]" but_role="submit-link" but_target_form="manage_products_form"}
    {/if}
{/capture}

{capture name="select_fields_to_edit"}

<p>{__("text_select_fields2edit_note")}</p>
{include file="views/products/components/products_select_fields.tpl"}

<div class="buttons-container">
    {include file="buttons/save_cancel.tpl" but_text=__("modify_selected") but_name="dispatch[products.store_selection]" cancel_action="close"}
</div>
{/capture}
{include file="common/popupbox.tpl" id="select_fields_to_edit" text=__("select_fields_to_edit") content=$smarty.capture.select_fields_to_edit}

</form>

{/capture}
{include file="common/mainbox.tpl" title=__("product_subscriptions") content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra adv_buttons=$smarty.capture.adv_buttons buttons=$smarty.capture.buttons select_languages=true}
