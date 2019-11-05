{script src="js/tygh/tabs.js"}
{script src="js/tygh/backend/product_feature_purpose.js"}
{script src="js/tygh/product_features.js"}

{$selectable_group = "ProductFeatures::TEXT_SELECTBOX"|enum}
{$selectable_group = "ProductFeatures::MULTIPLE_CHECKBOX"|enum|cat:$selectable_group}
{$selectable_group = "ProductFeatures::NUMBER_SELECTBOX"|enum|cat:$selectable_group}
{$selectable_group = "ProductFeatures::EXTENDED"|enum|cat:$selectable_group}

{if $feature}
    {$id = $feature.feature_id}
{else}
    {if $is_group == true}
        {$id = $smarty.const.NEW_FEATURE_GROUP_ID}
    {else}
        {$id = 0}
    {/if}
{/if}

{if $smarty.request.selected_section}
    {$active_tab = $smarty.request.selected_section}
{else}
    {$active_tab = "tab_details"}
{/if}

{$allow_save = true}

{if "ULTIMATE"|fn_allowed_for}
    {$allow_save = $feature|fn_allow_save_object:"product_features"}
{/if}

{$hide_inputs_class = ""}

{if ""|fn_check_form_permissions || !$allow_save}
    {$hide_inputs_class = "cm-hide-inputs"}
{/if}


{capture name="mainbox"}

<div id="content_group{$id}">
<form action="{""|fn_url}" method="post" name="update_features_form_{$id}" class="form-horizontal form-edit cm-disable-empty-files {$hide_inputs_class}" enctype="multipart/form-data">
<input type="hidden" class="cm-no-hide-input" name="feature_id" value="{$id}" />
{if !$in_popup}
    <input type="hidden" name="selected_section" id="selected_section" value="{$smarty.request.selected_section}" />
{/if}
<input type="hidden" class="cm-no-hide-input" name="redirect_url" value="{$return_url|default:$smarty.request.return_url}" />

<div class="tabs cm-j-tabs cm-track">
    <ul class="nav nav-tabs">
        <li id="tab_details_{$id}" class="cm-js {if $active_tab == "tab_details_`$id`"} active{/if}"><a>{__("general")}</a></li>
        <li id="tab_variants_{$id}" class="cm-js {if $feature.feature_type && $selectable_group|strpos:$feature.feature_type === false || !$feature}hidden{/if} {if $active_tab == "tab_variants_`$id`"} active{/if}"><a>{__("variants")}</a></li>
        <li id="tab_categories_{$id}" class="cm-js {if $feature.parent_id} hidden{/if} {if $active_tab == "tab_categories_`$id`"} active{/if}"><a>{__("categories")}</a></li>
    </ul>
</div>

<div class="cm-tabs-content" id="tabs_content_{$id}">

    <div id="content_tab_details_{$id}">
    <fieldset>
        <div class="control-group">
            <label class="control-label cm-required" for="elm_feature_name_{$id}">{__("name")}</label>
            <div class="controls">
            <input class="span9" type="text" name="feature_data[description]" value="{$feature.description}" id="elm_feature_name_{$id}" />
            </div>
        </div>

        {if "ULTIMATE"|fn_allowed_for}
            {include file="views/companies/components/company_field.tpl"
                name="feature_data[company_id]"
                id="elm_feature_data_`$id`"
                selected=$feature.company_id
            }
        {/if}

        {if $is_group || $feature.feature_type == "ProductFeatures::GROUP"|enum}
            <input type="hidden" name="feature_data[feature_type]" value="{"ProductFeatures::GROUP"|enum}" />
        {else}
            {foreach $purposes as $purpose => $purpose_data}
                {foreach $purpose_data.styles_map as $key => $item}
                    {if $item.feature_type === "ProductFeatures::NUMBER_FIELD"|enum && $feature.feature_type != "ProductFeatures::NUMBER_FIELD"|enum}
                        {$purposes[$purpose].styles_map[$key] = null}
                        {continue}
                    {/if}
                    {if $item.feature_style}
                        {$purposes[$purpose].styles_map[$key].feature_style_text = __("product_feature.feature_style.{$item.feature_style}")}
                    {/if}
                    {if $item.filter_style}
                        {$purposes[$purpose].styles_map[$key].filter_style_text = __("product_feature.filter_style.{$item.filter_style}")}
                    {/if}
                {/foreach}
            {/foreach}

            <div
                class="control-group cm-feature-purpose control-group-feature-purpose"
                data-ca-feature-id="{$id}"
                data-ca-feature-purpose="{$feature.purpose|default:$default_purpose}"
                data-ca-feature-purposes="{$purposes|to_json}"
                data-ca-feature-type="{$feature.feature_type}"
                data-ca-feature-type-elem-id="elm_feature_feature_type_{$id}"
                data-ca-feature-style="{$feature.feature_style}"
                data-ca-feature-style-elem-id="elm_feature_feature_style_{$id}"
                data-ca-filter-style="{$feature.filter_style}"
                data-ca-filter-style-elem-id="elm_feature_filter_style_{$id}"
                data-ca-variants-list-elem-id="content_tab_variants_{$id}"
                data-ca-variants-remove-warning-elem-id="warning_feature_change_{$id}">

                <label class="control-label cm-required cm-multiple-radios" for="elm_feature_purpose_{$id}">{__("product_feature.purpose")}</label>
                <div class="controls">
                    <div class="row-fluid">
                        <div class="span6">
                            <ul class="unstyled">
                                {foreach $purposes as $purpose => $purpose_data}
                                    <li>

                                        <label for="elm_feature_purpose_{$id}_{$purpose}" class="radio inline">{strip}
                                            {__("product_feature.purpose.{$purpose}")}
                                            <input{/strip}
                                                type="radio"
                                                name="feature_data[purpose]"
                                                value="{$purpose}"
                                                id="elm_feature_purpose_{$id}_{$purpose}"
                                                data-ca-purpose-description-elem-id="elm_feature_purpose_{$id}_{$purpose}_description"
                                                {if $feature.purpose|default:$default_purpose == $purpose}checked="checked"{/if}>
                                        </label>
                                    </li>
                                {/foreach}
                            </ul>
                        </div>
                        <div class="span6">
                            {foreach $purposes as $purpose => $purpose_data}
                                <div id="elm_feature_purpose_{$id}_{$purpose}_description" class="description cm-feature-purpose-description {if $feature.purpose|default:$default_purpose != $purpose}hidden{/if}"><small>{__("product_feature.purpose.{$purpose}.description")}</small></div>
                            {/foreach}
                        </div>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label cm-required" for="elm_feature_feature_style_{$id}">{__("product_feature.feature_style")}</label>
                <div class="controls">
                    <select name="feature_data[feature_style]" id="elm_feature_feature_style_{$id}"></select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label cm-required" for="elm_feature_filter_style_{$id}">{__("product_feature.filter_style")}</label>
                <div class="controls">
                    <input type="hidden" name="feature_data[filter_style]" value="" />
                    <select name="feature_data[filter_style]" id="elm_feature_filter_style_{$id}"></select>

                    <div class="text-error feature_type_{$id} hidden" id="warning_feature_change_{$id}"><div class="arrow"></div><div class="message"><p>{__("warning_variants_removal")}</p></div></div>
                </div>
            </div>

            <input type="hidden" name="feature_data[feature_type]" id="elm_feature_feature_type_{$id}"  class="{if !$id}cm-new-feature{/if}" data-ca-default-value="{$feature.feature_type}" data-ca-feature-id="{$id}" value="{$feature.feature_type}" />

            <div class="control-group">
                <label class="control-label" for="elm_feature_group_{$id}">{__("group")}</label>
                <div class="controls">
                    {if $feature.feature_type == "ProductFeatures::GROUP"|enum}-{else}
                        <select name="feature_data[parent_id]" id="elm_feature_group_{$id}" data-ca-feature-id="{$id}" class="cm-feature-group">
                            <option value="0">-{__("none")}-</option>
                            {foreach $group_features as $group_feature}
                                {if $group_feature.feature_type == "ProductFeatures::GROUP"|enum}
                                    <option data-ca-display-on-product="{$group_feature.display_on_product}" data-ca-display-on-catalog="{$group_feature.display_on_catalog}" data-ca-display-on-header="{$group_feature.display_on_header}" value="{$group_feature.feature_id}"{if $group_feature.feature_id == $feature.parent_id}selected="selected"{/if}>{$group_feature.description}</option>
                                {/if}
                            {/foreach}
                        </select>
                    {/if}
                </div>
            </div>
        {/if}

        <div class="control-group">
            <label class="control-label" for="elm_feature_code_{$id}">{__("feature_code")}</label>
            <div class="controls">
                <input type="text" size="3" name="feature_data[feature_code]" value="{$feature.feature_code}" class="input-medium" id="elm_feature_code_{$id}" />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="elm_feature_position_{$id}">{__("position")}</label>
            <div class="controls">
                <input type="text" size="3" name="feature_data[position]" value="{$feature.position}" class="input-medium" id="elm_feature_position_{$id}" />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="elm_feature_description_{$id}">{__("description")}</label>
            <div class="controls">
                <textarea name="feature_data[full_description]" cols="55" rows="4" class="cm-wysiwyg input-textarea-long" id="elm_feature_description_{$id}">{$feature.full_description}</textarea>
            </div>
        </div>

        {include file="common/select_status.tpl" input_name="feature_data[status]" id="elm_feature_status_{$id}" obj=$feature hidden=true}

        <div class="control-group">
            <label class="control-label" for="elm_feature_display_on_product_{$id}">{__("feature_display_on_product")}</label>
            <div class="controls">
            <input type="hidden" name="feature_data[display_on_product]" value="N" />
            <input id="elm_feature_display_on_product_{$id}" type="checkbox" name="feature_data[display_on_product]" value="Y" data-ca-display-id="OnProduct" {if $feature.display_on_product == "Y"}checked="checked"{/if} {if $feature.parent_id && $group_features[$feature.parent_id].display_on_product == "Y"}disabled="disabled"{/if}/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="elm_feature_display_on_catalog_{$id}">{__("feature_display_on_catalog")}</label>
            <div class="controls">
            <input type="hidden" name="feature_data[display_on_catalog]" value="N" />
            <input id="elm_feature_display_on_catalog_{$id}" type="checkbox" name="feature_data[display_on_catalog]" value="Y"  data-ca-display-id="OnCatalog" {if $feature.display_on_catalog == "Y"}checked="checked"{/if} {if $feature.parent_id && $group_features[$feature.parent_id].display_on_catalog == "Y"}disabled="disabled"{/if} />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="elm_feature_display_on_header_{$id}">{__("feature_display_on_header")}</label>
            <div class="controls">
            <input type="hidden" name="feature_data[display_on_header]" value="N" />
            <input id="elm_feature_display_on_header_{$id}" type="checkbox" name="feature_data[display_on_header]" value="Y"  data-ca-display-id="OnHeader" {if $feature.display_on_header == "Y"}checked="checked"{/if} {if $feature.parent_id && $group_features[$feature.parent_id].display_on_header == "Y"}disabled="disabled"{/if} />
            </div>
        </div>

        {if (!$feature && !$is_group) || ($feature.feature_type && $feature.feature_type != "ProductFeatures::GROUP"|enum)}
        <div class="control-group">
            <label class="control-label" for="elm_feature_prefix_{$id}">{__("prefix")}</label>
            <div class="controls">
            <input type="text" name="feature_data[prefix]" value="{$feature.prefix}" id="elm_feature_prefix_{$id}" />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="elm_feature_suffix_{$id}">{__("suffix")}</label>
            <div class="controls">
            <input type="text" name="feature_data[suffix]" value="{$feature.suffix}" id="elm_feature_suffix_{$id}" /></div>
        </div>
        {/if}

        {hook name="product_features:properties"}
        {/hook}
    </fieldset>
    <!--content_tab_details_{$id}--></div>

    {if !$feature.parent_id}
    
    <div class="hidden" id="content_tab_categories_{$id}">
    {if $feature.categories_path}
        {$items = ","|explode:$feature.categories_path}
    {/if}
    {include
        file="pickers/categories/picker.tpl"
        company_ids=$picker_selected_companies
        multiple=true
        input_name="feature_data[categories_path]"
        item_ids=$items
        data_id="category_ids_`$id`"
        no_item_text=__("text_all_categories_included")
        use_keys="N"
        owner_company_id=$feature.company_id
        but_meta="pull-right"
    }
    <!--content_tab_categories_{$id}--></div>
    {/if}

    {if ($id && $id != $smarty.const.NEW_FEATURE_GROUP_ID) || !$id}
    <div class="hidden" id="content_tab_variants_{$id}">
        {include file="views/product_features/components/variants_list.tpl" feature_type=$feature.feature_type feature=$feature}
    <!--content_tab_variants_{$id}--></div>
    {/if}

</div>

{if $in_popup}
    <div class="buttons-container">
        {if "ULTIMATE"|fn_allowed_for && !$allow_save}
            {$hide_first_button = true}
        {/if}
        {include file="buttons/save_cancel.tpl" but_name="dispatch[product_features.update]" cancel_action="close" hide_first_button=$hide_first_button save=$feature.feature_id}
    </div>
{else}
    {capture name="buttons"}
        {include file="buttons/save_cancel.tpl" but_role="submit-link" but_name="dispatch[product_features.update]" but_target_form="update_features_form_{$id}" save=$id}
    {/capture}
{/if}


</form>
<!--content_group{$id}--></div>
{/capture}

{if $in_popup}
    {$smarty.capture.mainbox nofilter}
{else}
    {include file="common/mainbox.tpl" title_start=__("editing_product_feature") title_end=$feature.description content=$smarty.capture.mainbox buttons=$smarty.capture.buttons select_languages=true}
{/if}