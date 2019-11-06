import { Tygh } from "../..";
import { matchScreenSize } from "../../core_methods";
import $ from "jquery";

var _ = Tygh;

var clicked_elm; // last clicked element
var zipcode_regexp = {}; // zipcode validation regexps
var regexp = {}; // validation regexps - deprecated
var validators = []; // registered custom validators

var errors = {};

function _fillRequirements(form, check_filter)
{
    var lbl, lbls, id, elm, requirements = {};

    if (check_filter) {
        lbls = $(check_filter, form).find('label');
    } else {
        lbls = $('label', form);
    }

    for (var k = 0; k < lbls.length; k++) {
        lbl = $(lbls[k]);
        id = lbl.prop('for');

        // skip lables with not assigned element, class or not-valid id (e.g. with placeholders)
        if (!id || !lbl.prop('class') || !id.match(/^([a-z0-9-_]+)$/i) || lbl.parents('.cm-skip-validation').length) {
            continue;
        }

        elm = $('#' + id);

        if (elm.length && !elm.prop('disabled')) {
            requirements[id] = {
                elm: elm,
                lbl: lbl
            };
        }
    }

    return requirements;
}

function _checkFields(form, requirements, only_check)
{
    var set_mark, elm, lbl, container, _regexp, _message;
    var message_set = false;

    // Reset all failed fields
    $('.cm-failed-field', form).removeClass('cm-failed-field');
    errors = {};
    for (var elm_id in requirements) {
        set_mark = false;
        elm = requirements[elm_id].elm;
        lbl = requirements[elm_id].lbl;

        // Check the need to trim value
        if (lbl.hasClass('cm-trim')) {
            elm.val($.trim(elm.val()));
        }

        // Check the email field
        if (lbl.hasClass('cm-email')) {
            if (!$.is.email(elm.val()) && !$.is.blank(elm.val())) {
                _formMessage(_.tr('error_validator_email'), lbl);
                set_mark = true;
            }
        }

        // Check for correct color code
        if (lbl.hasClass('cm-color')) {
            if ($.is.color(elm.val()) == false) {
                if (lbl.hasClass('cm-required') || $.is.blank(elm.val()) == false) {
                    _formMessage(_.tr('error_validator_color'), lbl);
                    set_mark = true;
                }
            }
        }

        // Check the phone field
        if (lbl.hasClass('cm-phone')) {
            if ($.is.phone(elm.val()) != true) {
                if (lbl.hasClass('cm-required') || $.is.blank(elm.val()) == false) {
                    _formMessage(_.tr('error_validator_phone'), lbl);
                    set_mark = true;
                }
            }
        }

        // Check the zipcode field
        if (lbl.hasClass('cm-zipcode')) {
            var loc = lbl.prop('class').match(/cm-location-([^\s]+)/i)[1] || '';
            var country = $('.cm-country' + (loc ? '.cm-location-' + loc : ''), form).val();
            var val = elm.val();

            if (zipcode_regexp[country] && !elm.val().match(zipcode_regexp[country]['regexp'])) {
                if (lbl.hasClass('cm-required') || $.is.blank(elm.val()) == false) {
                    _formMessage(_.tr('error_validator_zipcode'), lbl, null, zipcode_regexp[country]['format']);
                    set_mark = true;
                }
            }
        }

        // Check for integer field
        if (lbl.hasClass('cm-integer')) {
            if ($.is.integer(elm.val()) == false) {
                if (lbl.hasClass('cm-required') || $.is.blank(elm.val()) == false) {
                    _formMessage(_.tr('error_validator_integer'), lbl);
                    set_mark = true;
                }
            }
        }

        // Check for multiple selectbox
        if (lbl.hasClass('cm-multiple') && elm.prop('length') == 0) {
            _formMessage(_.tr('error_validator_multiple'), lbl);
            set_mark = true;
        }

        // Check for passwords
        if (lbl.hasClass('cm-password')) {
            var pair_lbl = $('label.cm-password', form).not(lbl);
            var pair_elm = $('#' + pair_lbl.prop('for'));

            if (elm.val() && elm.val() != pair_elm.val()) {
                _formMessage(_.tr('error_validator_password'), lbl, pair_lbl);
                set_mark = true;
            }
        }

        if (validators) {
            for (var i = 0; i < validators.length; i++) {
                if (lbl.hasClass(validators[i].class_name)) {
                    result = validators[i].func(elm_id, elm, lbl);
                    if (result != true) {
                        _formMessage(validators[i].message, lbl);
                        set_mark = true;
                    }
                }
            }
        }

        if (lbl.hasClass('cm-regexp')) {
            _regexp = null;
            _message = null;
            if (elm_id in regexp) {
                _regexp = regexp[elm_id]['regexp'];
                _message = regexp[elm_id]['message'] ? regexp[elm_id]['message'] : _.tr('error_validator_message');
            } else if (lbl.data('caRegexp')) {
                _regexp = lbl.data('caRegexp');
                _message = lbl.data('caMessage');
            }

            if (_regexp && !elm.ceHint('is_hint')) {
                var val = elm.val();
                var expr = new RegExp(_regexp);
                var result = expr.test(val);

                if (!result && !(!lbl.hasClass('cm-required') && elm.val() == '')) {
                    _formMessage(_message, lbl);
                    set_mark = true;
                }
            }
        }

        // Check for the multiple checkboxes/radio buttons
        if (lbl.hasClass('cm-multiple-checkboxes') || lbl.hasClass('cm-multiple-radios')) {
            if (lbl.hasClass('cm-required')) {
                var el_filter = lbl.hasClass('cm-multiple-checkboxes') ? '[type=checkbox]' : '[type=radio]';
                if ($(el_filter + ':not(:disabled)', elm).length && !$(el_filter + ':checked', elm).length) {
                    var message = lbl.data('caValidatorErrorMessage') || _.tr('error_validator_required');
                    _formMessage(message, lbl);
                    set_mark = true;
                }
            }
        }

        // Select all items in multiple selectbox
        if (lbl.hasClass('cm-all')) {
            if (elm.prop('length') == 0 && lbl.hasClass('cm-required')) {
                _formMessage(_.tr('error_validator_multiple'), lbl);
                set_mark = true;
            } else {
                $('option', elm).prop('selected', true);
            }

        // Check for blank value
        } else {

            // Check for multiple selectbox
            if (elm.is(':input')) {
                if (lbl.hasClass('cm-required') && ((elm.is('[type=checkbox]') && !elm.prop('checked')) || $.is.blank(elm.val()) == true || elm.ceHint('is_hint'))) {
                    _formMessage(_.tr('error_validator_required'), lbl);
                    set_mark = true;
                }
            }
        }

        // Check if required field is disable
        if (lbl.hasClass('cm-required') && elm.is(':disabled')) {
            _formMessage(_.tr('error_validator_required'), lbl);
            set_mark = true;
        }

        container = elm.closest('.cm-field-container');
        if (container.length) {
            elm = container;
        }

        if (!only_check) {

            $('[id="' + elm_id + '_error_message"].help-inline', elm.parent()).remove();

            if (set_mark == true) {
                lbl.parent().addClass('error');
                elm.addClass('cm-failed-field');
                lbl.addClass('cm-failed-label');

                const {
                    caErrorMessageTargetNode,
                    caErrorMessageTargetNodeOnScreen,
                    caErrorMessageTargetNodeAfterMode,
                    caErrorMessageTargetNodeChangeOnScreen
                } = elm.data();

                let _targetNodeChanged = false,
                    targetNode = $(elm),
                    targetMethod = 'after'; // We cant use direct link to method (targetNode.after), cause we got Security Policy Issue on Firefox

                if (caErrorMessageTargetNodeChangeOnScreen) {
                    if (matchScreenSize(caErrorMessageTargetNodeChangeOnScreen.split(','))) {
                        targetNode = $(caErrorMessageTargetNodeOnScreen);
                        _targetNodeChanged = true;
                    }
                }

                if (caErrorMessageTargetNode && !_targetNodeChanged) {
                    targetNode = $(caErrorMessageTargetNode);

                    if (!caErrorMessageTargetNodeAfterMode) {
                        targetMethod = 'html';
                    }
                }

                if (!elm.hasClass('cm-no-failed-msg')) {
                    const errorMessage = `<span id="${elm_id}_error_message" class="help-inline">${_getMessage(elm_id)}</span>`;

                    targetNode[targetMethod](errorMessage);
                }

                if (!message_set) {
                    if (!targetNode.data('caNoScroll')) {
                        $.scrollToElm(targetNode);
                    }

                    message_set = true;
                }

                // Resize dialog if we have errors
                var dlg = $.ceDialog('get_last');
                var dlg_target = $('.cm-dialog-auto-size[data-ca-target-id="'+ dlg.attr('id') +'"]');

                if(dlg_target.length) {
                    dlg.ceDialog('reload');
                }

                if ($.fn.ceSidebar) {
                    var $sidebar = elm.closest('.cm-sidebar');

                    if ($sidebar.length) {
                        $sidebar.ceSidebar('open');
                    }
                }
            } else {
                lbl.parent().removeClass('error');
                elm.removeClass('cm-failed-field');
                lbl.removeClass('cm-failed-label');
            }

        } else {
            if (set_mark) {
                message_set = true;
            }
        }
    }
    return !message_set;
}

function _disableEmptyFields(form)
{
    var selector = [];

    if (form.hasClass('cm-disable-empty')) {
        selector.push('input[type=text]');
    }
    if (form.hasClass('cm-disable-empty-files')) {
        selector.push('input[type=file]');

        // Disable empty input[type=file] in order to block the "garbage" data
        $('input[type=file][data-ca-empty-file=""]', form).prop('disabled', true);
    }

    if (selector.length) {
        $(selector.join(','), form).each(function() {
            var self = $(this);
            if (self.val() == '') {
                self.prop('disabled', true);
                self.addClass('cm-disabled')
            }
        });
    }
}

function _check(form, params)
{
    var form_result = true,
        check_fields_result = true,
        h,
        result = false;

    params = params || {};
    params.only_check = params.only_check || false;

    if (!clicked_elm) { // workaround for IE when the form has one input only
        if ($('[type=submit]', form).length) {
            clicked_elm = $('[type=submit]:first', form);
        } else if ($('input[type=image]', form).length) {
            clicked_elm = $('input[type=image]:first', form);
        }
    }

    if (!clicked_elm.hasClass('cm-skip-validation')) {

        var requirements = _fillRequirements(form, clicked_elm.data('caCheckFilter'));

        if ($.ceEvent('trigger', 'ce.formpre_' + form.prop('name'), [form, clicked_elm]) === false) {
            form_result = false;
        }

        check_fields_result = _checkFields(form, requirements, params.only_check);
    }

    if (params.only_check) {
        return check_fields_result && form_result;
    }

    if (check_fields_result && form_result) {

        _disableEmptyFields(form);

        // remove currency symbol
        form.find('.cm-numeric').each(function() {
            var val = $(this).autoNumeric('get');
            $(this).prop('value', val);
        });

        h = clicked_elm.data('original_element') ? clicked_elm.data('original_element') : clicked_elm;

        // protect button from double click
        if (h.data('clicked') == true) {
            return false;
        }

        // set clicked flag
        h.data('clicked', true);

        if ((form.hasClass('cm-ajax') || clicked_elm.hasClass('cm-ajax')) && !clicked_elm.hasClass('cm-no-ajax')) {
            // clean clicked flag
            $.ceEvent('one', 'ce.ajaxdone', function() {
                h.data('clicked', false);
            });
        }

        if (clicked_elm.hasClass('cm-comet')) {
            $.ceEvent('one', 'ce.cometdone', function() {
                h.data('clicked', false);
            });
        }

        // If pressed button has cm-new-window microformat, send form to new window
        // otherwise, send to current
        if (clicked_elm.hasClass('cm-new-window')) {
            form.prop('target', '_blank');

            // clean clicked flag
            setTimeout(function() {
                h.data('clicked', false);
            }, 1000);

            return true;

        } else if (clicked_elm.hasClass('cm-parent-window')) {
            form.prop('target', '_parent');
            return true;

        } else {
            form.prop('target', '_self');
        }

        if ($.ceEvent('trigger', 'ce.formpost_' + form.prop('name'), [form, clicked_elm]) === false) {
            form_result = false;
        }

        if (clicked_elm.closest('.cm-dialog-closer').length) {
            setTimeout(function () {
                $.ceDialog('get_last').ceDialog('close');
            }, 100);
        }

        if ((form.hasClass('cm-ajax') || clicked_elm.hasClass('cm-ajax')) && !clicked_elm.hasClass('cm-no-ajax')) {
            // FIXME: this code should be moved to another place I believe
            var collection = form.add(clicked_elm);
            if (collection.hasClass('cm-form-dialog-closer') || collection.hasClass('cm-form-dialog-opener')) {

                $.ceEvent('one', 'ce.formajaxpost_' + form.prop('name'), function(response_data, params) {

                    if (response_data.failed_request) {
                        return false;
                    }

                    if (collection.hasClass('cm-form-dialog-closer')) {
                        if (_.area == "C"){
                            $.ceDialog('get_last').ceDialog('close');
                        } else if (_.area == "A") {
                            $.popupStack.last_close();
                        }
                    }

                    if (collection.hasClass('cm-form-dialog-opener')) {
                        var _id = form.find('input[name=result_ids]').val();
                        if (_id && typeof(response_data.html) !== "undefined") {
                            $('#' + _id).ceDialog('open', $.ceDialog('get_params', form));
                        }
                    }
                });
            }

            form.find('.cm-wysiwyg').each(function() {
                $.ceEditor('updateTextFields', $(this));
            });

            result = $.ceAjax('submitForm', form, clicked_elm);
            
            var dialogs = collection.find('.cm-dialog-opener');

            if (dialogs.length) {
                dialogs.each(function(){
                    if ($(this).attr('href')) {
                        var container = '#'+ $(this).data('caTargetId');
                        $(container).ceDialog('destroy');
                        $(container).find('.object-container').remove();
                        $.popupStack.remove(container);
                    }
                });
            }

            return result;
        }

        if (clicked_elm.hasClass('cm-no-ajax')) {
            $('input[name=is_ajax]', form).remove();
        }

        if (_.embedded && form_result == true && !$.externalLink(form.prop('action'))) {

            form.append('<input type="hidden" name="result_ids" value="' + _.container + '" />');
            clicked_elm.data('caScroll', _.container);
            return $.ceAjax('submitForm', form, clicked_elm);
        }

        if ($.ceEvent('trigger', 'ce.form.beforeSubmit', [form, clicked_elm, form_result]) === false) {
            form_result = false;
        }

        if (form_result == false) {
            h.data('clicked', false); // if form won't be submitted, clear clicked flag
        }

        return form_result;

    } else if (check_fields_result == false) {
        var hidden_tab = $('.cm-failed-field', form).parents('[id^="content_"]:hidden');
        if (hidden_tab.length && $('.cm-failed-field', form).length == $('.cm-failed-field', hidden_tab).length) {
            $('#' + hidden_tab.prop('id').str_replace('content_', '')).click();
        }

        $.ceEvent('trigger', 'ce.formcheckfailed_' + form.prop('name'), [form, clicked_elm]);
    }

    return false;
}

function _formMessage(msg, field, field2, extra)
{
    var id = field.prop('for');

    if (errors[id]) {
        return false;
    }

    errors[id] = [];

    msg = msg.str_replace('[field]', _fieldTitle(field));

    if (field2) {
        msg = msg.str_replace('[field2]', _fieldTitle(field2));
    }
    if (extra) {
        msg = msg.str_replace('[extra]', extra);
    }

    errors[id].push(msg);
};

function _fieldTitle(field)
{
    return field.text().replace(/(\s*\(\?\))?:\s*$/, '');
}

function _getMessage(id)
{
    return '<p>' + errors[id].join('</p><p>') + '</p>';
};

// public methods
export const methods = {
    init: function() {
        var $form = $(this);
        $form.on('submit', function(e) {
            return _check($form);
        })
    },
    setClicked: function(elm) {
        clicked_elm = elm;
    },
    check: function(only_check) {
        var form = $(this);
        if (typeof only_check === 'undefined') {
            only_check = true;
        }
        return _check(form, {only_check: only_check});
    },
    checkFields: function(only_check) {
        const form = $(this);
        if (typeof only_check === 'undefined') {
            only_check = true;
        }
        const requirements = _fillRequirements(form);

        return _checkFields(form, requirements, only_check);
    }
};

/**
 * Form validator
 * @param {JQueryStatic} $ 
 */
export const ceFormValidatorInit = function ($) {
    $.fn.ceFormValidator = function(method) {
        var args = arguments;
        var result;

        $(this).each(function(i, elm) {

            // These vars are local for each element
            var errors = {};

            if (methods[method]) {
                result = methods[method].apply(this, Array.prototype.slice.call(args, 1));
            } else if ( typeof method === 'object' || ! method ) {
                result = methods.init.apply(this, args);
            } else {
                $.error('ty.formvalidator: method ' +  method + ' does not exist');
            }
        });

        return result;
    };

    $.ceFormValidator = function(action, params) {
        params = params || {};
        if (action == 'setZipcode') {
            zipcode_regexp = params;
        } else if (action == 'setRegexp') {
            if ('console' in window) {
                console.log('This method is deprecated, use data-attributes "data-ca-regexp" and "data-ca-message" instead');
            }
            regexp = $.extend(regexp, params);
        } else if (action == 'registerValidator') {
            validators.push(params);
        } else if (action == 'check') {
            if (params.form) {
                if (typeof params.only_check === 'undefined') {
                    params.only_check = true;
                }
                return methods.check.apply(params.form, [params.only_check]);
            }
        }
    }
}
