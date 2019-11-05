{scripts}

{script src="js/lib/jquery/jquery-3.3.1.min.js"}
{script src="js/lib/jquery/jquery-migrate-3.0.1.min.js"}
{script src="js/lib/js-webshim/polyfiller.js"}
{script src="js/lib/modernizr/modernizr.custom.js"}
{script src="js/tygh/core.js"}
{script src="js/tygh/history.js"}

{script src="js/lib/twitterbootstrap/bootstrap.min.js"}
{script src="js/lib/jqueryui/jquery-ui.custom.min.js"}
{script src="js/lib/autonumeric/autoNumeric.js"}
{script src="js/lib/appear/jquery.appear-1.1.1.js"}
{script src="js/lib/tools/tooltip.min.js"}
{script src="js/lib/dropzone/dist/dropzone.js"}
{script src="js/lib/bootstrap_switch/js/bootstrapSwitch.js"}
{script src="js/tygh/backend/companies.js"}
{script src="js/tygh/editors/`$settings.Appearance.default_wysiwyg_editor`.editor.js"}

{script src="js/tygh/ajax.js"}

{script src="js/tygh/quick_menu.js"}
{script src="js/tygh/file_uploader.js"}

{* Responsive adminpanel helpers scripts *}
{script src="js/tygh/backend/bulkedit.js"}
{script src="js/tygh/backend/tap.plugin.js"}
{script src="js/tygh/backend/tap_multiple_selection.js"}
{script src="js/tygh/backend/mobile_menu.js"}

{script src="js/tygh/backend/text_toggle.js"}

{script src="js/lib/maskedinput/jquery.maskedinput.min.js"}

{script src="js/lib/inputmask/jquery.inputmask.min.js"}
{script src="js/lib/jquery-bind-first/jquery.bind-first-0.2.3.js"}
{script src="js/lib/inputmask-multi/jquery.inputmask-multi.js"}

{script src="js/tygh/phone_mask.js"}

{capture name="promo_data"}
    <div class="commercial-promotion-text">
        <p>{$addon_permissions_text.text nofilter}</p>
    <div>
{/capture}
<script type="text/javascript">
(function(_, $) {
    _.tr({
        no_data: '{__("no_data")|escape:"javascript"}',
        nothing_found: '{__("text_nothing_found")|escape:"javascript"}',
        unable_to_delete_all_categories: '{__("bulk_edit.unable_to_delete_all_categories")|escape:"javascript"}',
        cannot_buy: '{__("cannot_buy")|escape:"javascript"}',
        no_products_selected: '{__("no_products_selected")|escape:"javascript"}',
        error_no_items_selected: '{__("error_no_items_selected")|escape:"javascript"}',
        delete_confirmation: '{__("delete_confirmation")|escape:"javascript"}',
        text_out_of_stock: '{__("text_out_of_stock")|escape:"javascript"}',
        items: '{__("items")|escape:"javascript"}',
        text_required_group_product: '{__("text_required_group_product")|escape:"javascript"}',
        save: '{__("save")|escape:"javascript"}',
        close: '{__("close")|escape:"javascript"}',
        loading: '{__("loading")|escape:"javascript"}',
        notice: '{__("notice")|escape:"javascript"}',
        warning: '{__("warning")|escape:"javascript"}',
        error: '{__("error")|escape:"javascript"}',
        text_are_you_sure_to_proceed: '{__("text_are_you_sure_to_proceed")|escape:"javascript"}',
        text_invalid_url: '{__("text_invalid_url")|escape:"javascript"}',
        error_validator_email: '{__("error_validator_email")|escape:"javascript"}',
        error_validator_phone: '{__("error_validator_phone")|escape:"javascript"}',
        error_validator_phone_mask: '{__("error_validator_phone_mask")|escape:"javascript"}',
        error_validator_integer: '{__("error_validator_integer")|escape:"javascript"}',
        error_validator_multiple: '{__("error_validator_multiple")|escape:"javascript"}',
        error_validator_password: '{__("error_validator_password")|escape:"javascript"}',
        error_validator_required: '{__("error_validator_required")|escape:"javascript"}',
        error_validator_zipcode: '{__("error_validator_zipcode")|escape:"javascript"}',
        error_validator_message: '{__("error_validator_message")|escape:"javascript"}',
        error_validator_color: '{__("error_validator_color")|escape:"javascript"}',
        text_page_loading: '{__("text_page_loading")|escape:"javascript"}',
        error_ajax: '{__("error_ajax")|escape:"javascript"}',
        text_changes_not_saved: '{__("text_changes_not_saved")|escape:"javascript"}',
        text_data_changed: '{__("text_data_changed")|escape:"javascript"}',
        trial_notice: '{__("text_block_trial_notice", ["[href]" => $config.resources.license_url])|escape:"javascript"}',
        expired_license: '{__("text_expired_license", ["[product]" => $smarty.const.PRODUCT_NAME])|escape:"javascript"}',
        file_browser: '{__("file_browser")|escape:"javascript"}',
        editing_block: '{__("editing_block")|escape:"javascript"}',
        editing_grid: '{__("editing_grid")|escape:"javascript"}',
        editing_container: '{__("editing_container")|escape:"javascript"}',
        adding_grid: '{__("adding_grid")|escape:"javascript"}',
        adding_block_to_grid: '{__("adding_block_to_grid")|escape:"javascript"}',
        manage_blocks: '{__("manage_blocks")|escape:"javascript"}',
        add_block: '{__("add_block")|escape:"javascript"}',
        text_position_updating: '{__("text_position_updating")|escape:"javascript"}',
        more: '{__("more")|escape:"javascript"}',
        browse: '{__("browse")|escape:javascript}',
        enter_new_lang_code: '{__("enter_new_lang_code")|escape:javascript}',
        no_image: '{__("no_image")|escape:javascript}',
        cookie_is_disabled: '{__("cookie_is_disabled")|escape:"javascript"}',
        insert_image: '{__("insert_image")|escape:"javascript"}',
        image_url: '{__("image_url")|escape:"javascript"}',
        manage: '{__("manage")|escape:"javascript"}',
        file_uploading_in_progress_please_wait: '{__("file_uploading_in_progress_please_wait")|escape:"javascript"}',
        please_copy_api_key: '{__("please_copy_api_key")|escape:"javascript"}',
        select_block: '{__("select_block")|escape:"javascript"}',
        block_manager: '{__("block_manager")|escape:"javascript"}'
    });

    $.extend(_, {
        index_script: '{if $smarty.const.ACCOUNT_TYPE == 'vendor'}{$config.vendor_index|escape:javascript nofilter}{else}{$config.admin_index|escape:javascript nofilter}{/if}',
        changes_warning: '{$settings.Appearance.changes_warning|escape:javascript nofilter}',
        currencies: {
            'primary': {
                'decimals_separator': '{$currencies.$primary_currency.decimals_separator|escape:javascript nofilter}',
                'thousands_separator': '{$currencies.$primary_currency.thousands_separator|escape:javascript nofilter}',
                'decimals': '{$currencies.$primary_currency.decimals|escape:javascript nofilter}'
            },
            'secondary': {
                'decimals_separator': '{$currencies.$secondary_currency.decimals_separator|escape:javascript nofilter}',
                'thousands_separator': '{$currencies.$secondary_currency.thousands_separator|escape:javascript nofilter}',
                'decimals': '{$currencies.$secondary_currency.decimals|escape:javascript nofilter}',
                'coefficient': '{$currencies.$secondary_currency.coefficient}'
            }
        },
        default_editor: '{$settings.Appearance.default_wysiwyg_editor}',
        default_previewer: '{$settings.Appearance.default_image_previewer}',
        current_path: '{$config.current_path|escape:javascript nofilter}',
        current_location: '{$config.current_location|escape:javascript nofilter}',
        images_dir: '{$images_dir}',
        notice_displaying_time: {if $settings.Appearance.notice_displaying_time}{$settings.Appearance.notice_displaying_time}{else}0{/if},
        cart_language: '{$smarty.const.CART_LANGUAGE}',
        language_direction: '{$language_direction}',
        default_language: '{$smarty.const.DEFAULT_LANGUAGE}',
        cart_prices_w_taxes: {if ($settings.Appearance.cart_prices_w_taxes == 'Y')}true{else}false{/if},
        theme_name: '{$settings.theme_name|escape:javascript nofilter}',
        current_url: '{$config.current_url|fn_url|escape:javascript nofilter}',
        {if $config.tweaks.anti_csrf}
        security_hash: '{""|fn_generate_security_hash}', // CSRF form protection key
        {/if}
        promo_data: {
            title: '{$addon_permissions_text.title|escape:javascript nofilter}',
            text: '{$smarty.capture.promo_data|escape:javascript nofilter}'
        },
        phone_validation_mode: '{$settings.Appearance.phone_validation_mode}'
    });

    $(document).ready(function(){
        $.runCart('A');
    });
}(Tygh, Tygh.$));
</script>

{hook name="index:scripts"}
{/hook}


{/scripts}
