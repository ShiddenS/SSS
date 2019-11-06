(function(_, $) {

    $.ceEvent('on', 'ce.change_select_list', function(object, elm) {

        if (elm.hasClass('cm-object-product-add') && object.data) {
            object.context = object.data.content;
        }

        if (elm.hasClass('cm-object-customer-add')) {
            var contextTemplate = '<table class="table-select2-customer"><tr><td class="table-select2-column-firstname-lastname">??</td></tr><tr><td class="table-select2-column-email">??</td></tr><tr><td class="table-select2-column-phone">??</td></tr></table>';

            var contextData = [
                object.text, object.email, object.phone
            ];
            object.context = $.sprintf(contextTemplate, contextData, '??');
        }

    });

    $(document).ready(function(){
        $(_.doc).on('change', '.cm-om-totals input:visible, .cm-om-totals select:visible, .cm-om-totals textarea:visible', function(){
            var is_changed = $('.cm-om-totals').formIsChanged();
            $('.cm-om-totals-price').toggleBy(is_changed);
            $('.cm-om-totals-recalculate').toggleBy(!is_changed);
        });

        $(_.doc).on('change', '.cm-object-product-add', function () {
            var $container = $(this).closest('.cm-object-product-add-container'),
                product_id = $(this).val(),
                url = $.sprintf(
                    '??&product_id=??&product_data[??][amount]=??',
                    [ fn_url('order_management.add'), product_id, product_id, 1 ],
                    '??'
                );

            $container.find('input.select2-search__field').addClass('hidden');

            $.ceAjax('request', url, {
                method: 'post',
                result_ids: 'button_trash_products,om_ajax_update_totals,om_ajax_update_payment,om_ajax_update_shipping',
                full_render: true
            });
        });

        $(_.doc).on('change', '.cm-object-customer-add', function () {
            var $container = $(this).closest('.cm-object-customer-add-container'),
                selected_user_id = $(this).val();
                url = $.sprintf(
                    '??&selected_user_id=??',
                    [ fn_url('order_management.select_customer'), selected_user_id ],
                    '??'
                );

            $container.find('input.select2-search__field').addClass('hidden');

            $.ceAjax('request', url, {
                method: 'post',
                result_ids: 'order_update,customer_info,om_ajax_customer_info,om_ajax_update_payment,om_ajax_update_shipping',
                full_render: true
            });
        });

        $(_.doc).on('keypress', 'form[name=om_cart_form] input[type=text]', function(e) {
            if(e.keyCode == 13) {
                $(this).blur();
                return false;
            }
        });
    });
    
}(Tygh, Tygh.$));
