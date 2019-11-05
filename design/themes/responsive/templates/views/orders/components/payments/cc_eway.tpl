{script src="js/lib/inputmask/jquery.inputmask.min.js"}
{script src="js/lib/creditcardvalidator/jquery.creditCardValidator.js"}

{if $card_id}
    {assign var="id_suffix" value="`$card_id`"}
{else}
    {assign var="id_suffix" value=""}
{/if}

<div class="clearfix">
    <div class="ty-credit-card">
            <div class="ty-credit-card__control-group ty-control-group">
                <label for="eway_cc_number_{$id_suffix}" class="cm-cc-number ty-control-group__title cm-required">{__("card_number")}</label>
                <input size="35" type="text" id="eway_cc_number_{$id_suffix}" value="" class="ty-credit-card__input cm-focus cm-autocomplete-off" />
                <input size="35" type="hidden" id="eway_cc_number_enc_{$id_suffix}" name="payment_info_enc[card_number]" value="" class="ty-credit-card__input cm-focus cm-autocomplete-off" />
                <ul class="ty-cc-icons cm-cc-icons">
                    <li class="ty-cc-icons__item cc-default cm-cc-default"><span class="ty-cc-icons__icon default">&nbsp;</span></li>
                    <li class="ty-cc-icons__item cm-cc-visa"><span class="ty-cc-icons__icon visa">&nbsp;</span></li>
                    <li class="ty-cc-icons__item cm-cc-visa_electron"><span class="ty-cc-icons__icon visa-electron">&nbsp;</span></li>
                    <li class="ty-cc-icons__item cm-cc-mastercard"><span class="ty-cc-icons__icon mastercard">&nbsp;</span></li>
                    <li class="ty-cc-icons__item cm-cc-maestro"><span class="ty-cc-icons__icon maestro">&nbsp;</span></li>
                    <li class="ty-cc-icons__item cm-cc-amex"><span class="ty-cc-icons__icon american-express">&nbsp;</span></li>
                    <li class="ty-cc-icons__item cm-cc-discover"><span class="ty-cc-icons__icon discover">&nbsp;</span></li>
                </ul>
            </div>
    
            <div class="ty-credit-card__control-group ty-control-group">
                <label for="credit_card_month_{$id_suffix}" class="ty-control-group__title cm-cc-date cm-cc-exp-month cm-required">{__("valid_thru")}</label>
                <label for="credit_card_year_{$id_suffix}" class="cm-required cm-cc-date cm-cc-exp-year hidden"></label>
                <input type="number" id="credit_card_month_{$id_suffix}" name="payment_info[expiry_month]" value="" size="2" maxlength="2" class="ty-credit-card__input-short " />&nbsp;&nbsp;/&nbsp;&nbsp;<input type="number" id="credit_card_year_{$id_suffix}"  name="payment_info[expiry_year]" value="" size="2" maxlength="2" class="ty-credit-card__input-short" />&nbsp;
            </div>
    
            <div class="ty-credit-card__control-group ty-control-group">
                <label for="credit_card_name_{$id_suffix}" class="ty-control-group__title cm-required">{__("cardholder_name")}</label>
                <input size="35" type="text" id="credit_card_name_{$id_suffix}" name="payment_info[cardholder_name]" value="" class="cm-cc-name ty-credit-card__input ty-uppercase" />
            </div>
    </div>
    
    <div class="ty-control-group ty-credit-card__cvv-field">
        <label for="eway_cvv2_{$id_suffix}" class="cm-cc-cvv2 ty-control-group__title cm-required cm-autocomplete-off">{__("cvv2")}</label>
        <input type="text" id="eway_cvv2_{$id_suffix}" value="" size="4" maxlength="4" class="cm-autocomplete-off" />
        <input type="hidden" id="eway_cvv2_enc_{$id_suffix}" name="payment_info_enc[cvv2]" value="" size="4" maxlength="4" class="cm-autocomplete-off" />
    </div>
</div>
<script class="cm-ajax-force">
(function(_, $) {

    $.ceEvent('on', 'ce.commoninit', function() {
        var icons = $('.cm-cc-icons li');
        var ccNumber = $(".cm-cc-number");
        var ccNumberInput = $("#" + ccNumber.attr("for"));
        var ccCv2 = $(".cm-cc-cvv2");
        var ccCv2Input = $("#" + ccCv2.attr("for"));
        var ccMonth = $(".cm-cc-exp-month");
        var ccMonthInput = $("#" + ccMonth.attr("for"));
        var ccYear = $(".cm-cc-exp-year");
        var ccYearInput = $("#" + ccYear.attr("for"));

        if(_.isTouch === false && jQuery.isEmptyObject(ccNumberInput.data("_inputmask")) == true) {
            ccNumberInput.inputmask("9999 9999 9999 9[9][9][9]", {
                placeholder: ' '
            });

            $.ceFormValidator('registerValidator', {
                class_name: 'cm-cc-number',
                message: '',
                func: function(id) {
                    return ccNumberInput.inputmask("isComplete");
                }
            });

            ccCv2Input.inputmask("999[9]", {
                placeholder: ''
            });

            $.ceFormValidator('registerValidator', {
                class_name: 'cm-cc-cvv2',
                message: "{__("error_validator_ccv")}",
                func: function(id) {
                    return ccCv2Input.inputmask("isComplete");
                }
            });

            ccMonthInput.inputmask("99", {
                placeholder: ''
            });

            ccYearInput.inputmask("99", {
                placeholder: ''
            });

            $.ceFormValidator('registerValidator', {
                class_name: 'cm-cc-date',
                message: '',
                func: function(id) {
                    return (ccYearInput.inputmask("isComplete") && ccMonthInput.inputmask("isComplete"));
                }
            });
        }

        if (ccNumber.length && ccNumberInput.length) {
            ccNumberInput.validateCreditCard(function (result) {
                icons.removeClass('active');
                if (result.card_type) {
                    icons.filter('.cm-cc-' + result.card_type.name).addClass('active');
                    if (['visa_electron', 'maestro', 'laser'].indexOf(result.card_type.name) != -1) {
                        ccCv2.removeClass("cm-required");
                    } else {
                        ccCv2.addClass("cm-required");
                    }
                }
            });
        }
    });

    $(document).ready(function(){
        var eway_enc_key = '{$cart.payment_method_data.processor_params.encryption_key}';
        if (window.tygh_eway_ready) {
            return true;
        }
        window.tygh_eway_ready = true;

        $.getScript("https://secure.ewaypayments.com/scripts/eCrypt.js");
        var elm_num = $("#eway_cc_number_{$id_suffix}");
        var form = elm_num.closest('form');
        var form_name = form.prop('name');
        $.ceEvent('on', 'ce.formpost_' + form_name, function(form, clicked_elm) {
            var elm_num_enc = $("#eway_cc_number_enc_{$id_suffix}");
            if (elm_num.length > 0 && elm_num.attr('data-eway-encrypted') != 'yes') {
                var elm_cvv = $("#eway_cvv2_{$id_suffix}");
                var elm_cvv_enc = $("#eway_cvv2_enc_{$id_suffix}");
                var cvv_val = elm_cvv.val();
                var num_val = elm_num.val().replace(/\s/g, '');
                var enc_cvv = eCrypt.encryptValue(cvv_val, eway_enc_key);
                var enc_num = eCrypt.encryptValue(num_val, eway_enc_key);
                elm_cvv_enc.val(enc_cvv);
                elm_num_enc.val(enc_num);
                elm_num.attr('data-eway-encrypted', 'yes');
            }
        });
    });
})(Tygh, Tygh.$);
</script>
