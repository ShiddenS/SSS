<script type="text/javascript">
(function(_, $) {

    function getFieldType(element) {
        if ($(element).is('input[type=radio], input[type=checkbox], select')) {
            return 'elm-disabled';
        } else if ($(element).is('div')){
            return '';
        } else {
            return 'input-text-disabled';
        }
    }

    $(document).ready(function(){
        $(_.doc).on('click', '[id*=elements-switcher-]', function(){
            var id = $(this).prop('id');
            var id_template = /elements-switcher-(\S+)/i;
            id = 'field_' + id.match(id_template)[1];

            var checked = $(this).prop('checked');
            $('[id*=' + id + ']').each(function(index, element){
                $el = $(element);
                $el.toggleClass(getFieldType(element), !checked);
                $el.prop('disabled', !checked);
                if (!checked) {
                    $el.prop('checked', false);
                }
            });
            $('#' + id + ' .correct-picker-but input').prop('disabled', !checked);
            $('#' + id + ' .correct-picker-but a').toggle(checked);
        });

        $('[id*=field_] .correct-picker-but a').hide();

        // Double scroll
        var elm_orig = $("#scrolled_div");
        var elm_scroller = $("#scrolled_div_top");

        var dummy = $("<div></div>");
        dummy.width(elm_orig.get(0).scrollWidth);
        dummy.height(24);
        elm_scroller.append(dummy);

        elm_scroller.scroll(function(){
            elm_orig.scrollLeft(elm_scroller.scrollLeft());
        });
        elm_orig.scroll(function(){
            elm_scroller.scrollLeft(elm_orig.scrollLeft());
        });
    });
}(Tygh, Tygh.$));
</script>

{assign var="all_categories_list" value=0|fn_get_plain_categories_tree:false}
{capture name="mainbox"}

{capture name="extra_tools"}
    {include file="buttons/button.tpl" but_text=__("override_product_data") but_onclick="Tygh.$('#override_box').toggle()" but_role="tool"}
{/capture}

<div id="override_box" class="hidden">

<form action="{""|fn_url}" method="post" name="override_form" class="form-horizontal form-edit products-update" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="redirect_url" value="{"products.m_update"|fn_url}" />

<div class="table-wrapper">
    <table class="products-update__table">
    <tr>
        <td>
            <div class="scroll-x scroll-border">
            <table class="table-fixed table--relative">
            <tr>
                {foreach from=$filled_groups item=v}
                <th>&nbsp;</th>
                {/foreach}
                {foreach from=$field_names item="field_name" key="field_key"}
                {if $field_key == "company_id"}
                <th>{__("vendor")}</th>
                {else}
                <th>{if $field_name|is_array}{__($field_key)}{else}{$field_name}{/if}</th>
                {/if}
                {/foreach}
            </tr>
            <tr >
                {foreach from=$filled_groups item=v key=type}
                <td valign="top" class="pad">
                {if $type != "L" || $type == "L" && $localizations}
                    <table>
                    {foreach from=$field_groups.$type item=name key=field}
                    {if $v.$field}
                    <tr>
                        <td valign="top" class="nowrap pad {if $field == "product"}strong{/if}"><label class="checkbox" for="elements-switcher-{$field}__"><input type="checkbox" name="" id="elements-switcher-{$field}__" value="Y" />{$v.$field}:&nbsp;</label></td>
                        <td valign="top" class="pad">
                            {if $type == "A"}
                            <input id="field_{$field}__" type="text" value="" name="override_{$name}[{$field}]" disabled="disabled" />
                            {elseif $type == "B"}
                            <input id="field_{$field}__" type="text" value=""  size="3" name="override_{$name}[{$field}]" disabled="disabled" />
                            {elseif $type == "C"}
                            <input id="field_{$field}__h" type="hidden" name="override_{$name}[{$field}]" value="N" disabled="disabled" />
                            <input id="field_{$field}__" type="checkbox" class="elm-disabled" name="override_{$name}[{$field}]" value="Y" disabled="disabled" />
                            {elseif $type == "D"}
                            <textarea id="field_{$field}__" name="override_{$name}[{$field}]" rows="3" cols="40" disabled="disabled"></textarea>
                            {elseif $type == "S"}
                            <select id="field_{$field}__" name="override_{$name.name}[{$field}]" class="elm-disabled" disabled="disabled">
                            {foreach from=$name.variants key=v_id item=v_name}
                            <option value="{$v_id}">{__($v_name)}</option>
                            {/foreach}
                            </select>
                            {elseif $type == "T"}
                                <div class="correct-picker-but">
                                {if $field == "timestamp"}
                                {include file="common/calendar.tpl" date_id="field_`$field`__date" date_name="override_$name[$field]" date_val=$smarty.const.TIME start_year=$settings.Company.company_start_year extra=" disabled=\"disabled\"" date_meta="input-text-disabled"}
                                {elseif $field == "avail_since"}
                                {include file="common/calendar.tpl" date_id="field_`$field`__date" date_name="override_$name[$field]" date_val=$smarty.const.TIME start_year=$settings.Company.company_start_year extra=" disabled=\"disabled\"" date_meta="input-text-disabled"}
                                {/if}
                                </div>
                            {elseif $type == "L"}
                                {include file="views/localizations/components/select.tpl" no_div=true disabled=true id="field_`$field`__" data_name="override_products_data[localization]"}
                            {elseif $type == "E"} {* Categories *}
                            <div class="clear" id="field_{$field}__">
                                <div class="correct-picker-but">
                                    {include file="pickers/categories/picker.tpl" data_id="categories" input_name="override_`$name`[category_ids]" radio_input_name="override_`$name`[main_category]" item_ids="" hide_link=true display_input_id="category_ids" view_mode="list"}
                                </div>
                            </div>
                            {elseif $type == "W"} {* Product details layout *}
                                <select id="field_{$field}__" name="override_{$name}[{$field}]" class="elm-disabled" disabled="disabled">
                                {foreach from=$product_data.product_id|fn_get_product_details_views key="layout" item="item"}
                                    <option value="{$layout}">{$item}</option>
                                {/foreach}
                                </select>
                            {else} {** Hook for extending field types *}
                                {hook name="products:update_types"}
                                {/hook}
                            {/if}
                        </td>
                    </tr>
                    {/if}
                    {/foreach}
                    </table>
                {/if}
                </td>
                {/foreach}


                {foreach from=$field_names key="field" item=v}
                <td valign="top" class="pad">
                {if $field != "localization" || $field == "localization" && $localizations}
                    <table class="no-border">
                    <tr>
                        <td valign="top" class="pad">{if $field != "main_pair" && $field != "features"}<input type="checkbox" name="" value="Y" id="elements-switcher-{$field}__" />{else}&nbsp;{/if}</td>
                        <td valign="top" class="pad">
                        {if $field == "main_pair"}
                            <table width="420">
                            <tr>
                                <td>{include file="common/attach_images.tpl" image_name="product_main" image_object_type="product" image_type="M" no_thumbnail=true}</td>
                            </tr>
                            </table>
                        {elseif $field == "tracking"}
                            <select    id="field_{$field}__" name="override_products_data[{$field}]" class="elm-disabled" disabled="disabled">
                                <option value="{"ProductTracking::TRACK_WITH_OPTIONS"|enum}">{__("track_with_options")}</option>
                                <option value="{"ProductTracking::TRACK_WITHOUT_OPTIONS"|enum}">{__("track_without_options")}</option>
                                <option value="{"ProductTracking::DO_NOT_TRACK"|enum}">{__("dont_track")}</option>
                            </select>
                        {elseif $field == "zero_price_action"}
                            <select id="field_{$field}__" name="override_products_data[{$field}]" class="elm-disabled" disabled="disabled">
                                <option value="R">{__("zpa_refuse")}</option>
                                <option value="P">{__("zpa_permit")}</option>
                                <option value="A">{__("zpa_ask_price")}</option>
                            </select>
                        {elseif $field == "taxes"}
                            <input id="field_{$field}__h" type="hidden" name="override_products_data[tax_ids]" value="" disabled="disabled" />
                            {foreach from=$taxes item="tax"}
                            <div class="select-field nowrap no-padding">
                                <label class="checkbox" for="field_{$field}__{$tax.tax_id}"><input type="checkbox" name="override_products_data[tax_ids][{$tax.tax_id}]" id="field_{$field}__{$tax.tax_id}"  value="{$tax.tax_id}" disabled="disabled" />{$tax.tax}</label>
                            </div>
                            {/foreach}
                        {elseif $field == "features"}
                            {if $all_product_features}
                                {include file="views/products/components/products_m_update_features.tpl"
                                    product_features=$all_product_features
                                    features_search=$all_features_search
                                    product_id=0
                                    over=true
                                    data_name="override_products_data"}
                            {/if}
                        {elseif $field == "timestamp"}
                            <div class="correct-picker-but">
                            {include file="common/calendar.tpl" date_id="field_`$field`" date_name="override_products_data[`$field`]" date_val=$smarty.const.TIME extra=" disabled=\"disabled\"" start_year=$settings.Company.company_start_year}
                            </div>
                        {elseif $field == "localization"}
                            {include file="views/localizations/components/select.tpl" no_div=true data_name="products_data[`$product.product_id`][localization]" data_from=$product.localization}
                        {elseif $field == "usergroup_ids"}
                            {if !"ULTIMATE:FREE"|fn_allowed_for}
                                {include file="common/select_usergroups.tpl" id="field_`$field`_" name="override_products_data[`$field`]" usergroups=["type"=>"C", "status"=>["A", "H"]]|fn_get_usergroups:$smarty.const.DESCR_SL usergroup_ids="" input_extra=" disabled=\"disabled\"" list_mode=true}
                            {/if}
                        {elseif $field == "company_id"}
                            <div class="clear" id="field_{$field}__">
                                <div class="correct-picker-but">
                                {include file="views/products/components/products_m_update_company.tpl" override_box="Y"}
                                </div>
                            </div>
                        {else}
                            {hook name="products:update_fields"}
                                {hook name="products:update_fields_inner"}
                                    <input id="field_{$field}__" type="text" value="" name="override_products_data[{$field}]" disabled="disabled" />
                                {/hook}
                            {/hook}
                        {/if}
                        </td>
                    </tr>
                    </table>
                {/if}
                </td>
                {/foreach}
            </tr>
            </table>
            </div>
        </td>
    </tr>
    </table>
</div>

<div class="buttons-container">
    {include file="buttons/button.tpl" but_text=__("apply") but_name="dispatch[products.m_override]" but_role="button_main"}
</div>

</form>
</div>
{* ================================ *}

<form action="{""|fn_url}" method="post" name="products_m_update_form" class="products-update" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="redirect_url" value="{"products.m_update"|fn_url}" />

<div class="table-wrapper">
    <table class="products-update__table">
    <tr>
        <td>

            <div id="scrolled_div_top" class="scroll-x scroll-top"></div>
            <div id="scrolled_div" class="scroll-x scroll-border">
            <table class="table-fixed table--relative">
            <tr>
                {foreach from=$filled_groups item=v}
                <th>&nbsp;</th>
                {/foreach}
                {foreach from=$field_names item="field_name" key=field_key}
                {if $field_key == "company_id"}
                <th>{__("vendor")}</th>
                {else}
                <th>{if $field_name|is_array}{__($field_key)}{else}{$field_name}{/if}</th>
                {/if}
                {/foreach}
            </tr>
            {foreach from=$products_data item="product"}
            <tr >
                <td valign="top" class="nowrap pad products-list__image">
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
                {foreach from=$filled_groups item=v key=type}
                <td valign="top" class="pad">
                {if $type != "L" || $type == "L" && $localizations}
                    <table class="no-border">
                    {foreach from=$field_groups.$type item=name key=field}
                    {if $v.$field}
                    {hook name="products:update_fields_item"}
                    <tr>
                        <td valign="top" class="nowrap pad {if $field == "product"}strong{/if}">{$v.$field}:&nbsp;</td>
                        <td valign="top" class="pad nowrap">
                            {if $field == "price" || $field == "list_price"}
                                <input type="text" value="{$product.$field|fn_format_price:$primary_currency:null:false}" class="input-medium" size="5" name="{$name}[{$product.product_id}][{$field}]" />
                            {elseif $type == "A"}
                                <input 
                                    type="text"
                                    value="{$product.$field}"
                                    class="input-medium"
                                    name="{$name}[{$product.product_id}][{$field}]"
                                    {if $field == "product_code"}
                                        maxlength={"ProductFieldsLength::PRODUCT_CODE"|enum}
                                    {/if}
                                />
                            {elseif $type == "B"}
                                <input type="text" value="{$product.$field|default:0}" class="input-medium" size="5" name="{$name}[{$product.product_id}][{$field}]" />
                            {elseif $type == "C"}
                                <input type="hidden" name="{$name}[{$product.product_id}][{$field}]" value="N" />
                            <input type="checkbox" name="{$name}[{$product.product_id}][{$field}]" value="Y" {if $product.$field == "Y"}checked="checked"{/if} />
                            {elseif $type == "D"}
                                <textarea class="input-xlarge" name="{$name}[{$product.product_id}][{$field}]" rows="3" cols="40">{$product.$field}</textarea>
                            {elseif $type == "S"}
                                <select name="{$name.name}[{$product.product_id}][{$field}]">
                                    {foreach from=$name.variants key=v_id item=v_name}
                                        {if $name.skip_lang}
                                            {assign var="option_name" value=$v_name}
                                        {else}
                                            {assign var="option_name" value=__($v_name)}
                                        {/if}
                                    <option value="{$v_id}" {if $product.$field == $v_id}selected="selection"{/if}>{$option_name}</option>
                                    {/foreach}
                                </select>
                            {elseif $type == "T"}
                                <div class="correct-picker-but">
                                {if $field == "timestamp"}
                                {include file="common/calendar.tpl" date_id="date_timestamp_holder_`$product.product_id`" date_name="$name[`$product.product_id`][$field]" date_val=$product.$field start_year=$settings.Company.company_start_year}
                                {elseif $field == "avail_since"}
                                {include file="common/calendar.tpl" date_id="date_avail_holder_`$product.product_id`" date_name="$name[`$product.product_id`][$field]" date_val=$product.$field start_year=$settings.Company.company_start_year}
                                {/if}
                                </div>
                            {elseif $type == "L"}
                                {include file="views/localizations/components/select.tpl" no_div=true data_from=$product.localization data_name="products_data[`$product.product_id`][localization]"}
                            {elseif $type == "E"} {* Categories *}
                                {include file="common/select2_categories.tpl"
                                    select2_tabindex=$tabindex
                                    select2_multiple=true
                                    select2_name="`$name`[`$product.product_id`][category_ids]"
                                    select2_allow_sorting=$product_data.shared_product === 'N'
                                    select2_category_ids=$product.category_ids
                                    select2_main_category=$product.main_category
                                    categories_data=$categories_data
                                    select2_allow_sorting="true"
                                    disable_categories=true
                                    select2_select_id="categories_add_`$product.product_id`"
                                    select2_wrapper_meta="form-inline object-categories-add--fix-width"
                                    select2_width="100%"
                                }
                            {elseif $type == "W"} {* Product details layout *}
                                <select name="{$name}[{$product.product_id}][{$field}]">
                                {foreach from=$product_data.product_id|fn_get_product_details_views key="layout" item="item"}
                                    <option {if $product.details_layout == $layout}selected="selected"{/if} value="{$layout}">{$item}</option>
                                {/foreach}
                                </select>
                            {else} {** Hook for extending field types *}
                                {hook name="products:update_types_extra"}
                                {/hook}
                            {/if}
                        </td>
                    </tr>
                    {/hook}
                    {/if}
                    {/foreach}
                    </table>
                {/if}
                </td>
                {/foreach}

                {foreach from=$field_names key="field" item=v}
                {if $field != "product_id" && ($field != "localization" || $field == "localization" && $localizations)}
                <td valign="top" class="pad">
                        {if $field == "main_pair"}
                            <table width="420"><tr><td>{include file="common/attach_images.tpl" image_name="product_main" image_key=$product.product_id image_pair=$product.main_pair image_object_id=$product.product_id image_object_type="product" image_type="M" no_thumbnail=true}</td></tr></table>
                        {elseif $field == "tracking"}
                            <select    name="products_data[{$product.product_id}][{$field}]">
                                <option value="{"ProductTracking::TRACK_WITH_OPTIONS"|enum}" {if $product.tracking == "ProductTracking::TRACK_WITH_OPTIONS"|enum}selected="selected"{/if}>{__("track_with_options")}</option>
                                <option value="{"ProductTracking::TRACK_WITHOUT_OPTIONS"|enum}" {if $product.tracking == "ProductTracking::TRACK_WITHOUT_OPTIONS"|enum}selected="selected"{/if}>{__("track_without_options")}</option>
                                <option value="{"ProductTracking::DO_NOT_TRACK"|enum}" {if $product.tracking == "ProductTracking::DO_NOT_TRACK"|enum}selected="selected"{/if}>{__("dont_track")}</option>
                            </select>
                        {elseif $field == "zero_price_action"}
                            <select name="products_data[{$product.product_id}][{$field}]">
                                <option value="R" {if $product.zero_price_action == "R"}selected="selected"{/if}>{__("zpa_refuse")}</option>
                                <option value="P" {if $product.zero_price_action == "P"}selected="selected"{/if}>{__("zpa_permit")}</option>
                                <option value="A" {if $product.zero_price_action == "A"}selected="selected"{/if}>{__("zpa_ask_price")}</option>
                            </select>
                        {elseif $field == "taxes"}
                            <input type="hidden" name="products_data[{$product.product_id}][tax_ids]" value="" />
                            {foreach from=$taxes item="tax"}
                            <div class="select-field nowrap">
                                <label class="checkbox" for="products_taxes_{$product.product_id}_{$tax.tax_id}"><input type="checkbox" name="products_data[{$product.product_id}][tax_ids][{$tax.tax_id}]" id="products_taxes_{$product.product_id}_{$tax.tax_id}" {if $tax.tax_id|in_array:$product.tax_ids}checked="checked"{/if}  value="{$tax.tax_id}" />
                                {$tax.tax}</label>
                            </div>
                            {/foreach}
                        {elseif $field == "features"}
                            {if $product_features[$product.product_id]}

                            {include file="views/products/components/products_m_update_features.tpl" product_features=$product_features[$product.product_id] features_search=$features_search[$product.product_id] product_id=$product.product_id data_name="products_data[`$product.product_id`]"}

                            <input type="hidden" name="products_data[{$product.product_id}][features_exist]" value="Y" />
                            {/if}
                        {elseif $field == "timestamp"}
                            <div class="correct-picker-but">
                            {include file="common/calendar.tpl" date_id="prod_date" date_name="products_data[`$product.product_id`][$field]" date_val=$product.timestamp|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}
                            </div>
                        {elseif $field == "localization"}
                            {include file="views/localizations/components/select.tpl" no_div=true data_name="products_data[`$product.product_id`][localization]" data_from=$product.localization}
                        {elseif $field == "usergroup_ids"}
                            {if !"ULTIMATE:FREE"|fn_allowed_for}
                                {include file="common/select_usergroups.tpl" id="product_ug_`$product.product_id`" name="products_data[`$product.product_id`][`$field`]" usergroups=["type"=>"C", "status"=>["A", "H"]]|fn_get_usergroups:$smarty.const.DESCR_SL usergroup_ids=$product.usergroup_ids input_extra="" list_mode=true}
                            {/if}
                        {elseif $field == "company_id"}
                            {include file="views/products/components/products_m_update_company.tpl"}
                        {else}
                            {hook name="products:update_fields_extra"}
                                {hook name="products:update_fields_inner_extra"}
                                    <input type="text" value="{$product.$field}" class="input-medium" name="products_data[{$product.product_id}][{$field}]" />
                                {/hook}
                            {/hook}
                        {/if}
                </td>
                {/if}
                {/foreach}
            </tr>
            {/foreach}
            </table>
            </div>
        </td>
    </tr>
    </table>
</div>

</form>
{/capture}
{capture name="buttons"}
    {include file="buttons/save.tpl" but_name="dispatch[products.m_update]" but_role="submit-link" but_target_form="products_m_update_form"}
{/capture}

{include file="common/mainbox.tpl" title=__("update_products") content=$smarty.capture.mainbox select_languages=true extra_tools=$smarty.capture.extra_tools buttons=$smarty.capture.buttons}
