{foreach from=$product_features item=feature key="feature_id"}
    {$allow_enter_variant = $feature|fn_allow_save_object:"product_features"}
    {if $feature.feature_type != "ProductFeatures::GROUP"|enum}
        {hook name="products:update_product_feature"}
        <div class="control-group">
            <label class="control-label" for="feature_{$feature_id}">{$feature.description}</label>
            <div class="controls">
            {if $feature.prefix}<span>{$feature.prefix}</span>{/if}

            {if $feature.feature_type == "ProductFeatures::TEXT_SELECTBOX"|enum
                || $feature.feature_type == "ProductFeatures::NUMBER_SELECTBOX"|enum
                || $feature.feature_type == "ProductFeatures::EXTENDED"|enum}
                {assign var="value_selected" value=false}
                <input type="hidden" name="product_data[product_features][{$feature_id}]" id="feature_{$feature_id}"
                       value="{$selected|default:$feature.variant_id}"/>
                <div class="object-selector object-selector--mobile-full-width">
                    <select id="feature_{$feature_id}"
                            class="cm-object-selector object-selector--mobile-full-width"
                            name="product_data[product_features][{$feature_id}]"
                            data-ca-enable-images="true"
                            data-ca-image-width="30"
                            data-ca-image-height="30"
                            data-ca-enable-search="true"
                            data-ca-escape-html="false"
                            data-ca-load-via-ajax="{$feature.use_variant_picker|default:false}"
                            data-ca-page-size="10"
                            data-ca-data-url="{"product_features.get_variants_list?include_empty=Y&feature_id=`$feature_id`&product_id=`$product_id`&lang_code=`$descr_sl`"|fn_url nofilter}"
                            data-ca-placeholder="-{__("none")}-"
                            data-ca-allow-clear="true">
                        <option value="">-{__("none")}-</option>
                        {foreach from=$feature.variants item="variant"}
                            {$item_attrs = []}
                            {if $feature.feature_style == "ProductFeatureStyles::COLOR"|enum || $feature.filter_style == "ProductFilterStyles::COLOR"|enum}
                                {$template = "<div class=\"select2__color-swatch\" style=\"background-color: {$variant.color}\"></div>"}
                                {$template = "{$template}<div class=\"select2__color-name\">{$variant.variant}</div>"}
                                {$item_attrs["data-ca-object-selector-item-template"] = $template}
                            {/if}

                            <option
                                value="{$variant.variant_id}"
                                {if $variant.selected} selected="selected"{/if}
                                {$item_attrs|render_tag_attrs nofilter}
                            >
                                {$variant.variant}
                            </option>
                        {/foreach}
                        <option value="">-{__("none")}-</option>
                    </select>
                </div>
                {if $allow_enter_variant}
                    {if $feature.feature_style == "ProductFeatureStyles::COLOR"|enum || $feature.filter_style == "ProductFilterStyles::COLOR"|enum}
                        <div class="input-prepend">
                            {include file="common/colorpicker.tpl"
                                cp_name="product_data[add_new_variant][{$feature.feature_id}][color]"
                                cp_value="#ffffff"
                                show_picker=true
                            }
                    {/if}
                    <input type="text"
                        class="{if $feature.feature_type == "ProductFeatures::NUMBER_SELECTBOX"|enum} cm-value-decimal{/if}"
                        name="product_data[add_new_variant][{$feature.feature_id}][variant]" id="input_{$feature_id}"
                        placeholder="{__("enter_other")}"/>
                    {if $feature.feature_style == "ProductFeatureStyles::COLOR"|enum || $feature.filter_style == "ProductFilterStyles::COLOR"|enum}
                        </div>
                    {/if}
                {/if}
            {elseif $feature.feature_type == "ProductFeatures::MULTIPLE_CHECKBOX"|enum}
                <input type="hidden" name="product_data[product_features][{$feature_id}]" value=""/>
                <div class="object-selector">
                    <select id="feature_{$feature_id}"
                            class="cm-object-selector"
                            name="product_data[product_features][{$feature_id}][]"
                            multiple
                            data-ca-load-via-ajax="{$feature.use_variant_picker|default:false}"
                            data-ca-placeholder="{__("search")}"
                            data-ca-enable-search="true"
                            data-ca-enable-images="true"
                            data-ca-image-width="30"
                            data-ca-image-height="30"
                            data-ca-close-on-select="false"
                            data-ca-page-size="10"
                            data-ca-data-url="{"product_features.get_variants_list?feature_id=`$feature_id`&product_id=`$product_id`&lang_code=`$descr_sl`"|fn_url nofilter}">
                        {foreach from=$feature.variants item="variant"}
                            <option value="{$variant.variant_id}"{if $variant.selected} selected="selected"{/if}>{$variant.variant}</option>
                        {/foreach}
                    </select>
                </div>
                {if $allow_enter_variant}
                    <input type="text" name="product_data[add_new_variant][{$feature.feature_id}][variant]"
                           id="feature_{$feature_id}" placeholder="{__("enter_other")}"/>
                {/if}
            {elseif $feature.feature_type == "ProductFeatures::SINGLE_CHECKBOX"|enum}
                <label class="checkbox">
                <input type="hidden" name="product_data[product_features][{$feature_id}]" value="N" />
                <input type="checkbox" name="product_data[product_features][{$feature_id}]" value="Y" id="feature_{$feature_id}" {if $feature.value == "Y"}checked="checked"{/if} /></label>
            {elseif $feature.feature_type == "ProductFeatures::DATE"|enum}
                {include file="common/calendar.tpl" date_id="date_`$feature_id`" date_name="product_data[product_features][$feature_id]" date_val=$feature.value_int|default:""}
            {else}
                <input type="text" name="product_data[product_features][{$feature_id}]" value="{if $feature.feature_type == "ProductFeatures::NUMBER_FIELD"|enum}{if $feature.value_int != ""}{$feature.value_int|floatval}{/if}{else}{$feature.value}{/if}" id="feature_{$feature_id}" class="{if $feature.feature_type == "ProductFeatures::NUMBER_FIELD"|enum} cm-value-decimal{/if}" />
            {/if}
            {if $feature.suffix}<span>{$feature.suffix}</span>{/if}
            </div>
        </div>
        {/hook}
    {/if}
{/foreach}

{foreach from=$product_features item=feature key="feature_id"}
    {if $feature.feature_type == "ProductFeatures::GROUP"|enum && $feature.subfeatures}
        {include file="common/subheader.tpl" title=$feature.description additional_id=$feature.feature_id}
        {include file="views/products/components/product_assign_features.tpl" product_features=$feature.subfeatures}
    {/if}
{/foreach}
