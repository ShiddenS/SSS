<div class="bulk-edit-inner bulk-edit-inner--categories">
    <div class="bulk-edit-inner__header">
        <span>{__("categories")}</span>
    </div>

    <div class="bulk-edit-inner__body" id="bulk_edit_categories_list">

        <div class="bulk-edit-inner__hint">
            <p><strong>{__("bulk_edit.what_do_these_checkboxes_mean")} (<a href="#" class="cm-toggle" data-toggle=".bulk-edit-inner--categories .bulk-edit-inner__hint > .bulk-edit--category-hint-wrapper" data-show-text="{__('show')}" data-hide-text="{__('hide')}" data-state="show">{__("show")}</a>)</strong></p>

            <div class="bulk-edit--category-hint-wrapper hidden">
                <span><input type="checkbox" class="cm-readonly no-margin" checked="checked" /> {__("bulk_edit.what_do_these_checkboxes_mean_checked")}</span> <br />
                <span><input type="checkbox" class="cm-readonly no-margin" /> {__("bulk_edit.what_do_these_checkboxes_mean_unchecked")}</span> <br />
                <span><input type="checkbox" class="cm-readonly no-margin" data-set-indeterminate="true" /> {__("bulk_edit.what_do_these_checkboxes_mean_indeterminate")}</span>
                
                <hr>
            </div>
        </div>

        <div class="control-group">
            <div class="controls" id="bulk_edit_categories_list_content">
                {include file="common/select2_categories_bulkedit.tpl"
                    select2_multiple=true
                    select2_select_id="product_categories_add_{$rnd|default:uniqid()}"
                    select2_name="product_data[category_ids]"
                    select2_allow_sorting=true
                    select2_dropdown_parent="#bulk_edit_categories_list_content"
                    select2_category_ids=$bulk_edit_ids_flat
                    select2_bulk_edit_mode=true
                    select2_bulk_edit_mode_category_ids=$bulk_edit_ids
                    disable_categories=true
                    select2_wrapper_meta="cm-field-container"
                    select2_select_meta="input-large"
                }
            <!--bulk_edit_categories_list_content--></div>
        </div>
    <!--bulk_edit_categories_list--></div>

    <div class="bulk-edit-inner__footer">
        <button class="btn bulk-edit-inner__btn"
                role="button"
                data-ca-bulkedit-mod-cat-cancel
        >{__("reset")}</button>
        <button class="btn btn-primary bulk-edit-inner__btn"
                role="button"
                data-ca-bulkedit-mod-cat-update
                data-ca-bulkedit-mod-target-form="[name=manage_products_form]"
                data-ca-bulkedit-mod-target-form-active-objects="tr.selected:has(input[type=checkbox].cm-item:checked)"
                data-ca-bulkedit-mod-dispatch="products.bulk_edit_get_categories_list"
        >{__("apply")}</button>
    </div>
</div>
