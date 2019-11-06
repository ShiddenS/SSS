(function (_, $) {
    var mask_list;

    $.ceEvent('on', 'ce.commoninit', function (context) {
        var $phone_elems = context.find('.cm-mask-phone'),
            phone_validation_mode = _.phone_validation_mode || 'international_format',
            is_international_format = phone_validation_mode === 'international_format',
            is_any_digits = phone_validation_mode === 'any_digits';

        if (!$phone_elems.length || (is_international_format && !window.localStorage)) {
            return;
        }

        if (is_international_format) {
            loadPhoneMasks().then(function (phone_masks) {
                _.phone_masks_list = phone_masks;
                // backward compatibility
                _.call_requests_phone_masks_list = _.phone_masks_list;

                mask_list = $.masksSort(_.phone_masks_list, ['#'], /[0-9]|#/, "mask");

                var mask_opts = {
                    inputmask: {
                        definitions: {
                            '#': {
                                validator: "[0-9]",
                                cardinality: 1
                            }
                        },
                        showMaskOnHover: false,
                        autoUnmask: false,
                        onKeyDown: function () {
                            $(this).trigger('_input');
                        }
                    },
                    match: /[0-9]/,
                    replace: '#',
                    list: mask_list,
                    listKey: "mask"
                };

                $phone_elems.each(function (index, elm) {
                    if (_.call_phone_mask && $(elm).data('enableCustomMask')) {
                        $(elm).inputmask({
                            mask: _.call_phone_mask,
                            showMaskOnHover: false,
                            autoUnmask: false,
                            onKeyDown: function () {
                                $(this).trigger('_input');
                            }
                        });
                    } else {
                        $(elm).inputmasks(mask_opts);
                    }

                    $(elm).addClass('js-mask-phone-inited');

                    if ($(elm).val()) {
                        $(elm).oneFirst('keypress keydown', function () {
                            if (!validatePhone($(elm))) {
                                $(elm).trigger('paste');
                            }
                        });
                        $(elm).prop('defaultValue', $(elm).val());
                    }
                });
            });

            $.ceFormValidator('registerValidator', {
                class_name: 'cm-mask-phone-label',
                message: _.tr('error_validator_phone_mask'),
                func: function (id) {
                    return validatePhone($('#' + id));
                }
            });
        } else if (is_any_digits) {
            $.ceFormValidator('registerValidator', {
                class_name: 'cm-mask-phone-label',
                message: _.tr('error_validator_phone'),
                func: function (elm_id, elm, lbl) {
                    return $.is.blank(elm.val()) || $.is.phone(elm.val());
                }
            });
        }
    });

    function validatePhone($input)
    {
        if ($.is.blank($input.val()) || !$input.hasClass('js-mask-phone-inited')) {
            return true;
        }

        var mask_is_valid = false;

        if (_.call_phone_mask && $input.data('enableCustomMask')) {
            mask_is_valid = _toRegExp(_.call_phone_mask).test($input.val());
        } else {
            mask_list.forEach(function (mask) {
                mask_is_valid = (mask_is_valid || _toRegExp(mask.mask).test($input.val()));
            });
        }

        return mask_is_valid && $input.inputmask("isComplete");

        function _toRegExp(mask) {
            var _convertedMask = mask
                .str_replace('#', '.')
                .str_replace('+', '\\+')
                .str_replace('(', '\\(')
                .str_replace(')', '\\)');

            return new RegExp(_convertedMask);
        }
    }

    function loadPhoneMasks()
    {
        var raw_phone_masks = window.localStorage.getItem('phoneMasks'),
            phone_masks,
            d = $.Deferred();

        if (raw_phone_masks) {
            phone_masks = JSON.parse(raw_phone_masks);
        }

        if (!phone_masks) {
            $.ceAjax('request', fn_url('phone_masks.get_masks'), {
                method: 'get',
                caching: false,
                data: {},
                callback: function (response) {
                    if (!response || !response.phone_mask_codes) {
                        return;
                    }

                    $.ceEvent('trigger', 'ce.phone_masks.masks_loaded', [response]);

                    phone_masks = Object.keys(response.phone_mask_codes).map(function (key) {
                        return response.phone_mask_codes[key];
                    });

                    window.localStorage.setItem('phoneMasks', JSON.stringify(phone_masks));

                    d.resolve(phone_masks);
                },
                repeat_on_error: false,
                hidden: true,
                pre_processing: function (response) {
                    if (response.force_redirection) {
                        delete response.force_redirection;
                    }

                    return false;
                },
                error_callback: function () {
                    d.reject();
                }
            });
        } else {
            d.resolve(phone_masks);
        }

        return d.promise();
    }

})(Tygh, Tygh.$);
