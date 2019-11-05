{if $company_data.company_id}
    {assign var="id" value=$company_data.company_id}
{else}
    {assign var="id" value=0}
{/if}

{include file="views/profiles/components/profiles_scripts.tpl"}

{capture name="mainbox"}

{capture name="tabsbox"}
{** /Item menu section **}

<form class="form-horizontal form-edit {$form_class} {if !fn_check_view_permissions("companies.update", "POST")}cm-hide-inputs{/if} {if !$id}cm-ajax cm-comet cm-disable-check-changes{/if}" action="{""|fn_url}" method="post" id="company_update_form" enctype="multipart/form-data"> {* company update form *}
{* class=""*}
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="selected_section" id="selected_section" value="{$smarty.request.selected_section}" />
<input type="hidden" name="company_id" value="{$id}" />

{** General info section **}
<div id="content_detailed" class="hidden"> {* content detailed *}
<fieldset>

{if "ULTIMATE"|fn_allowed_for && !$id && !$runtime.company_id}
    {include file="common/subheader.tpl" title=__("use_existing_store")}

    <div class="control-group">
        <label class="control-label" for="elm_company_exists_store">{__("store")}:</label>
        <div class="controls">
            <input type="hidden" name="company_data[clone_from]" id="elm_company_exists_store" value="" onchange="fn_switch_store_settings(this);" />
            {include file="common/ajax_select_object.tpl" data_url="companies.get_companies_list?show_all=Y&default_label=none" text=__("none") result_elm="elm_company_exists_store" id="exists_store_selector"}
        </div>
    </div>

    <div id="clone_settings_container" class="hidden">

    {split data=$clone_schema size=ceil(sizeof($clone_schema) / 2) assign="splitted_objects" vertical_delimition=false preverse_keys=true}
    <div class="control-group">
        <div class="controls">
            <table cellpadding="10">
            <tr valign="top">
                {foreach from=$splitted_objects item="s_object"}
                    <td>
                    <ul class="unstyled">
                        {foreach from=$s_object key="object" item="object_data"}
                            <li>
                                {if $object_data}
                                    {assign var="label" value="clone_`$object`"}
                                    <label class="checkbox">

                                        <input type="checkbox" name="company_data[clone][{$object}]" {if $object_data.checked_by_default}checked="checked"{/if} class="cm-item-s cm-dependence-{$object}" value="Y" {if $object_data.dependence}onchange="fn_check_dependence('{$object_data.dependence}', this.checked)"{/if} />
                                    {__($label)}{if $object_data.tooltip}{include file="common/tooltip.tpl" tooltip=__($object_data.tooltip)}{/if}{if $object_data.checked_by_default}&nbsp;<span class="muted">({__("recommended")})</span>{/if}</label>
                                {/if}
                            </li>
                        {/foreach}
                    </ul>
                    </td>
                {/foreach}
            </tr></table>
            <p>
            {include file="common/check_items.tpl" check_target="s" style="links"}
            </p>
        </div>
    </div>
    </div>
{/if}

{include file="common/subheader.tpl" title=__("information")}

{hook name="companies:general_information"}

{if "ULTIMATE"|fn_allowed_for}
<div class="control-group">
    <label for="elm_company_name" class="control-label cm-required">{__("vendor_name")}:</label>
    <div class="controls">
        <input type="text" name="company_data[company]" id="elm_company_name" size="32" value="{$company_data.company}" class="input-large" />
    </div>
</div>

{hook name="companies:storefronts"}
<div class="control-group">
    <label for="elm_company_storefront" class="control-label cm-required">{__("storefront_url")}:</label>
    <div class="controls">
    {if $runtime.company_id}
        http://{$company_data.storefront|puny_decode}
    {else}
        <input type="text" name="company_data[storefront]" id="elm_company_storefront" size="32" value="{$company_data.storefront|puny_decode}" class="input-large" />
    {/if}
    </div>
</div>
{/hook}

{hook name="companies:storefronts_design"}

{if $id}
{include file="views/storefronts/components/status.tpl"
    id=$id
    status=$company_data.storefront_status
    input_name="company_data[storefront_status]"
}

{include file="views/storefronts/components/access_key.tpl"
    id=$id
    access_key=$company_data.store_access_key
    input_name="company_data[store_access_key]"
}

{include file="common/subheader.tpl" title=__("design")}

<div class="control-group">
    <label class="control-label">{__("store_theme")}:</label>
    <div class="controls">
        <p>{$theme_info.title}: {$current_style.name}</p>
        <a href="{"themes.manage?switch_company_id=`$id`"|fn_url}">{__("goto_theme_configuration")}</a>
    </div>
</div>
{else}
    {* TODO: Make theme selector *}
    <input type="hidden" value="responsive" name="company_data[theme_name]">
{/if}
{/hook}

{/if}

{if "MULTIVENDOR"|fn_allowed_for}
    {include file="views/profiles/components/profile_fields.tpl" section="C" default_data_name="company_data" profile_data=$company_data include=["company"] nothing_extra=true}
    {if !$runtime.company_id}
        {include file="common/select_status.tpl" input_name="company_data[status]" id="company_data" obj=$company_data items_status="companies"|fn_get_predefined_statuses:$company_data.status}
    {else}
        <div class="control-group">
            <label class="control-label">{__("status")}:</label>
            <div class="controls">
                <label class="radio"><input type="radio" checked="checked" />{if $company_data.status == "A"}{__("active")}{elseif $company_data.status == "P"}{__("pending")}{elseif $company_data.status == "N"}{__("new")}{elseif $company_data.status == "D"}{__("disabled")}{/if}</label>
            </div>
        </div>
    {/if}

    <div class="control-group">
        <label class="control-label" for="elm_company_language">{__("language")}:</label>
        <div class="controls">
        <select name="company_data[lang_code]" id="elm_company_language">
            {foreach from=$languages item="language" key="lang_code"}
                <option value="{$lang_code}" {if $lang_code == $company_data.lang_code}selected="selected"{/if}>{$language.name}</option>
            {/foreach}
        </select>
        </div>
    </div>
{/if}


{if !$id}
    {literal}
    <script type="text/javascript">
    function fn_switch_store_settings(elm)
    {
        jelm = Tygh.$(elm);
        var close = true;
        if (jelm.val() != 'all' && jelm.val() != '' && jelm.val() != 0) {
            close = false;
        }

        Tygh.$('#clone_settings_container').toggleBy(close);
    }

    function fn_check_dependence(object, enabled)
    {
        if (enabled) {
            Tygh.$('.cm-dependence-' + object).prop('checked', true).prop('readonly', true).on('click', function(e) {
                return false
            });
        } else {
            Tygh.$('.cm-dependence-' + object).prop('readonly', false).off('click');
        }
    }
    </script>
    {/literal}

    {if !"ULTIMATE"|fn_allowed_for}
        <div class="control-group">
            <label class="control-label" for="elm_company_vendor_admin">{__("create_administrator_account")}:</label>
            <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" name="company_data[is_create_vendor_admin]" id="elm_company_vendor_admin" checked="checked" value="Y" />
                </label>
            </div>
        </div>
    {/if}
{/if}


{if "MULTIVENDOR"|fn_allowed_for}
    {$excluded_fields=["company", "company_description", "accept_terms", "admin_firstname", "admin_lastname"]}
    {hook name="companies:contact_information"}
    {include file="views/profiles/components/profile_fields.tpl" section="C" default_data_name="company_data" profile_data=$company_data exclude=$excluded_fields nothing_extra=true}
    {/hook}

    {hook name="companies:shipping_address"}
    {/hook}
{/if}

{if "ULTIMATE"|fn_allowed_for}
    {include file="common/subheader.tpl" title="{__("settings")}: {__("company")}" }

    {foreach from=$company_settings key="field_id" item="item"}
        {include file="common/settings_fields.tpl" item=$item section="Company" html_id="field_`$section`_`$item.name`_`$item.object_id`" html_name="update[`$item.object_id`]"}
    {/foreach}
{/if}

{/hook}

</fieldset>
</div> {* /content detailed *}
{** /General info section **}



{** Company description section **}
<div id="content_description" class="hidden"> {* content description *}
<fieldset>
{hook name="companies:description"}
<div class="control-group">
    <label class="control-label" for="elm_company_description">{__("description")}:</label>
    <div class="controls">
        <textarea id="elm_company_description" name="company_data[company_description]" cols="55" rows="8" class="cm-wysiwyg input-large">{$company_data.company_description}</textarea>
    </div>
</div>
{/hook}
</fieldset>
</div> {* /content description *}
{** /Company description section **}


{if "MULTIVENDOR"|fn_allowed_for}
    {** Company logos section **}
    <div id="content_logos" class="hidden">
        {hook name="companies:logos"}
        {include file="views/companies/components/logos_list.tpl" logos=$company_data.logos company_id=$id}
        {/hook}
    </div>
    {** /Company logos section **}
{/if}


{if "ULTIMATE"|fn_allowed_for}
{** Company regions settings section **}
<div id="content_regions" class="hidden">
    <fieldset>
        <div class="control-group">
            <div class="controls">
            <input type="hidden" name="company_data[redirect_customer]" value="N" checked="checked"/>
            <label class="checkbox"><input type="checkbox" name="company_data[redirect_customer]" id="sw_company_redirect" {if $company_data.redirect_customer == "Y"}checked="checked"{/if} value="Y" class="cm-switch-availability cm-switch-inverse" />{__("redirect_customer_from_storefront")}</label>
            </div>
        </div>

        <div class="control-group" id="company_redirect">
            <label class="control-label" for="elm_company_entry_page">{__("entry_page")}</label>
            <div class="controls">
            <select name="company_data[entry_page]" id="elm_company_entry_page" {if $company_data.redirect_customer == "Y"}disabled="disabled"{/if}>
                <option value="none" {if $company_data.entry_page == "none"}selected="selected"{/if}>{__("none")}</option>
                <option value="index" {if $company_data.entry_page == "index"}selected="selected"{/if}>{__("index")}</option>
                <option value="all_pages" {if $company_data.entry_page == "all_pages"}selected="selected"{/if}>{__("all_pages")}</option>
            </select>
            </div>
        </div>

        {include file="common/double_selectboxes.tpl"
            title=__("countries")
            first_name="company_data[countries_list]"
            first_data=$company_data.countries_list
            second_name="all_countries"
            second_data=$countries_list}
    </fieldset>
</div>
{** /Company regions settings section **}

{/if}

{if "MULTIVENDOR"|fn_allowed_for && !$runtime.company_id}
{** Shipping methods section **}
<div id="content_shipping_methods" class="hidden">
    {hook name="companies:shipping_methods"}
        {if $shippings}
        <input type="hidden" name="company_data[shippings]" value="" />
        <div class="table-responsive-wrapper">
            <table width="100%" class="table table-middle table-responsive">
            <thead>
            <tr>
                <th width="50%">{__("shipping_methods")}</th>
                <th class="center">{__("available_for_vendor")}</th>
            </tr>
            </thead>
            {foreach from=$shippings item="shipping" key="shipping_id"}
            <tr>
                <td data-th="{__("shipping_methods")}"><a href="{"shippings.update?shipping_id=`$shipping_id`"|fn_url}">{$shipping.shipping}{if $shipping.status == "D"} ({__("disabled")|lower}){/if}</a></td>
                <td class="center" data-th="{__("available_for_vendor")}">
                    <input type="checkbox" {if !$id || $shipping_id|in_array:$company_data.shippings_ids} checked="checked"{/if} name="company_data[shippings][]" value="{$shipping_id}">
                </td>
            </tr>
            {/foreach}
            </table>
        </div>
        {else}
            <p class="no-items">{__("no_data")}</p>
        {/if}
    {/hook}
</div>
{** /Shipping methods section **}
{/if}

<div id="content_addons" class="hidden">
    {hook name="companies:detailed_content"}{/hook}
</div>

{hook name="companies:tabs_content"}{/hook}

</form> {* /product update form *}

{hook name="companies:tabs_extra"}{/hook}

{/capture}
{include file="common/tabsbox.tpl" content=$smarty.capture.tabsbox group_name="companies" active_tab=$smarty.request.selected_section track=true}

{/capture}

{capture name="sidebar"}
    {hook name="companies:update_sidebar"}
{if $id}
<div class="sidebar-row">
    <h6>{__("menu")}</h6>
    <ul class="nav nav-list">
        {hook name="companies:sidebar_links"}
        <li><a href="{"products.manage?company_id=`$id`"|fn_url}">{__("view_vendor_products")}</a></li>
        {if "ULTIMATE"|fn_allowed_for && $runtime.company_id}
            <li><a href="{"categories.manage?company_id=`$id`"|fn_url}">{__("view_vendor_categories")}</a></li>
        {/if}
        <li><a href="{"profiles.manage?company_id=`$id`"|fn_url}">{__("view_vendor_users")}</a></li>
        <li><a href="{"orders.manage?company_id=`$id`"|fn_url}">{__("view_vendor_orders")}</a></li>
        {/hook}
    </ul>
</div>
{if "MULTIVENDOR"|fn_allowed_for}
<div class="sidebar-row sidebar-vendor-statistics">
    <h6>{__("vendors_statistics")}</h6>
    <ul class="unstyled">
        {hook name="companies:accounting_sidebar_links"}
            <li class="vendor-statistics">
                <a href="{"companies.balance?vendor=`$id`&selected_section=withdrawals"|fn_url}">
                    {include file="common/price.tpl" value=$company_data.balance}</a>
                <span>{__("balance")}</span>
            </li>
            <li class="vendor-statistics">
                <a href="{"orders.manage?company_id=`$id`"|fn_url}">{$company_data.orders_count}</a>
                <span>{__("orders")}</span>
            </li>
            <li class="vendor-statistics">
                <a href="{"orders.manage?company_id=`$id`&is_search=Y&period=C&time_from=`$time_from`&time_to=`$time_to`"|fn_url}">
                    {include file="common/price.tpl" value=$company_data.sales}</a>
                <span>{__("sales")}</span>
            </li>
            <li class="vendor-statistics">
                <a href="{"companies.balance?vendor=`$id`"|fn_url}">
                    {include file="common/price.tpl" value=$company_data.income}</a>
                <span>{__("income")}</span>
            </li>
            <li class="vendor-statistics">
                <a href="{"products.manage?company_id=`$id`&status=A"|fn_url}">{$company_data.products_count}</a>
                <span>{__("active_products")}</span>
            </li>
            {if $settings.General.inventory_tracking == "Y"}
                <li class="vendor-statistics">
                    <a href="{"products.manage?company_id=`$id`&amount_from=&amount_to=0&tracking[0]={"ProductTracking::TRACK_WITHOUT_OPTIONS"|enum}&tracking[1]={"ProductTracking::TRACK_WITH_OPTIONS"|enum}"|fn_url}">
                        {$company_data.out_of_stock}
                    </a>
                    <span>{__("out_of_stock_products")}</span>
                </li>
            {/if}
        {/hook}
    </ul>
</div>
{/if}
{/if}
    {/hook}
{/capture}

{** Form submit section **}
{capture name="buttons"}
    {if $id}
        {capture name="tools_list"}
        {hook name="companies:tools_list"}
            <li>{btn type="list" text=__("delete") class="cm-confirm" href="companies.delete?company_id=$id" method="POST"}</li>
        {/hook}
        {/capture}
        {dropdown content=$smarty.capture.tools_list}

        {include file="buttons/save_cancel.tpl" but_name="dispatch[companies.update]" but_target_form="company_update_form" save=$id}
    {else}
        {if $is_companies_limit_reached}
            {include file="buttons/save_cancel.tpl" but_meta="btn cm-promo-popup"}
        {else}
            {include file="buttons/save_cancel.tpl" but_name="dispatch[companies.add]" but_target_form="company_update_form" but_meta="cm-comet"}
        {/if}
    {/if}
{/capture}
{** /Form submit section **}

{if $id}
    {include file="common/mainbox.tpl"
        title_start=__("editing_vendor")
        title_end=$company_data.company
        content=$smarty.capture.mainbox
        select_languages=true
        buttons=$smarty.capture.buttons
        sidebar=$smarty.capture.sidebar}
{else}
    {include file="common/mainbox.tpl" title=__("new_vendor") content=$smarty.capture.mainbox sidebar=$smarty.capture.sidebar buttons=$smarty.capture.buttons}
{/if}
