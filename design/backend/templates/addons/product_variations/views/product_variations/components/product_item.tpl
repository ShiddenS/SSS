<tr>
    <td width="40">
        {if !$product.parent_product_id && $product.has_children}
            <button alt="{__("expand_collapse_list")}" title="{__("expand_collapse_list")}" id="sw_product_variations_group_{$product.product_id}" aaaid="on_variations" class="cm-combinations cm-product-variations__collapse product-variations__collapse-btn product-variations__collapse-btn--collapsed" type="button">
                <span class="icon-caret-down" data-ca-switch-id="product_variations_group_{$product.product_id}"> </span>
                <span class="icon-caret-right hidden" data-ca-switch-id="product_variations_group_{$product.product_id}"> </span>
            </button>
        {else}
            &nbsp;
        {/if}
    </td>
    {if $product.parent_product_id}
        <td>
            <div class="product-variations__table-img product-variations__table-img--main">
                {include file="common/image.tpl" image=$product.main_pair.icon|default:$product.main_pair.detailed image_id=$product.main_pair.image_id image_width=40 href="products.update?product_id=`$product.product_id`"|fn_url}
            </div>
        </td>
    {else}
        <td>
            <div class="product-variations__table-img product-variations__table-img--main">
                {include file="common/image.tpl" image=$product.main_pair.icon|default:$product.main_pair.detailed image_id=$product.main_pair.image_id image_width=70 href="products.update?product_id=`$product.product_id`"|fn_url }
            </div>
        </td>
    {/if}

    <td class="product-variations__table-name">
        <input type="hidden" name="products_data[{$product.product_id}][product]" value="{$product.product}" />

        {if $product_id == $product.product_id}
            <strong>{$product.product|truncate:140 nofilter}</strong>
        {else}
            <a title="{$product.product|strip_tags}" href="{"products.update?product_id=`$product.product_id`"|fn_url}">{$product.product|truncate:140 nofilter}</a>
        {/if}
        {include file="views/companies/components/company_name.tpl" object=$product}
    </td>

    <td width="13%" data-th="{__("sku")}">
        {if $is_form_readonly || !$product.product_type_instance->isFieldAvailable("product_code")}
            <div class="product-variations__table-code">{$product.product_code}</div>
        {else}
            <input type="text" name="products_data[{$product.product_id}][product_code]" value="{$product.product_code}" class="input-full input-hidden product-variations__table-code" />
        {/if}
    </td>

    {foreach $selected_features as $feature}
        {if $is_form_readonly || !$product.product_type_instance->isFieldAvailable("variation_features")}
            <td><span>{$product.variation_features[$feature.feature_id].variant}</span></td>
        {else}
            <td><select
                        name="products_variation_feature_values[{$product.product_id}][{$feature.feature_id}]"
                        class="input-hidden product-variations__table-select js-product-variation-feature-item"
                        data-ca-feature-id="{$feature.feature_id}"
                >
            {foreach $feature.variants as $variant}
                {if $product.variation_features[$feature.feature_id].variant_id == $variant.variant_id}
                    <option value="{$variant.variant_id}" selected>{$variant.variant}</option>
                {/if}
            {/foreach}
            </select></td>
        {/if}
    {/foreach}

    <td width="13%" data-th="{__("price")}">
        <input type="text" name="products_data[{$product.product_id}][price]" value="{$product.price|fn_format_price:$primary_currency:null:false}" class="input-full input-hidden product-variations__table-price"/>
    </td>
    <td width="9%" data-th="{__("quantity")}">
        {if $is_form_readonly}
            <div class="product-variations__table-quantity">{$product.amount}</div>
        {else}
            <input type="text" name="products_data[{$product.product_id}][amount]" size="6" value="{$product.amount}" class="input-full input-hidden product-variations__table-quantity" />
        {/if}
    </td>
    <td width="6%" class="nowrap mobile-hide">
        <div class="hidden-tools cm-hide-with-inputs">
            {capture name="tools_list"}
                {if !$is_form_readonly && $product.parent_product_id}
                    <li>{btn type="list" id="mark_main_product_product_from_group_{$product.product_id}" text=__("product_variations.mark_main_product") class="cm-post cm-confirm" href="product_variations.mark_main_product?product_id={$product.product_id}&redirect_url={$redirect_url|escape:url}" method="POST"}</li>
                {/if}
                <li>{btn type="list" text=__("edit") href="{"products.update?product_id=`$product.product_id`"|fn_url}"}</li>
                {if !$is_form_readonly}
                    <li>{btn type="list" id="remove_product_from_group_{$product.product_id}" text=__("product_variations.remove_variation") class="cm-post cm-confirm" href="product_variations.delete_product?product_id={$product.product_id}&redirect_url={$redirect_url|escape:url}" method="POST"}</li>
                    <li class="divider"></li>
                    <li>{btn type="list" id="delete_product_{$product.product_id}" text=__("product_variations.delete_product") class="cm-post cm-confirm" href="products.delete?product_id={$product.product_id}&redirect_url={$redirect_url|escape:url}" method="POST"}</li>
                {/if}
            {/capture}
            {dropdown content=$smarty.capture.tools_list}
        </div>
    </td>
</tr>