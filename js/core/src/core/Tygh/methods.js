import $ from 'jquery';
import { Tygh } from '.';
const _ = Tygh;

export const select2Sortable = function () {
    var $select = $(this);

    if (typeof ($select.data('select2')) !== 'object') {
        $select.select2();
    }

    var $container = $select.siblings('.select2-container').first('ul.select2-selection__rendered');

    $container.sortable({
        placeholder: 'ui-select2-sortable-placeholder',
        forcePlaceholderSize: true,
        items: 'li:not(.select2-search,.select2-drag--disabled)',
        tolerance: 'pointer',
        stop: function () {
            $.each($container.find('.select2-selection__choice').get().reverse(), function () {
                var id = $(this).data('data').id;
                var option = $select.find('option[value="' + id + '"]').get();
                $select.prepend(option);
            });
        }
    });
}

export const toggleBy = function (flag) {
    if (flag == false || flag == true) {
        if (flag == false) {
            this.show();
        } else {
            this.hide();
        }
    } else {
        this.toggle();
    }

    return true;
}

export const moveOptions = function (to, params) {
    var params = params || {};
    $('option' + ((params.move_all ? '' : ':selected') + ':not(.cm-required)'), this).appendTo(to);

    if (params.check_required) {
        var f = [];
        $('option.cm-required:selected', this).each(function () {
            f.push($(this).text());
        });

        if (f.length) {
            fn_alert(params.message + "\n" + f.join(', '));
        }
    }

    this.change();
    $(to).change();

    return true;
}

export const swapOptions = function (direction) {
    $('option:selected', this).each(function () {
        if (direction == 'up') {
            $(this).prev().insertAfter(this);
        } else {
            $(this).next().insertBefore(this);
        }
    });

    this.change();

    return true;
}

export const selectOptions = function (flag) {
    $('option', this).prop('selected', flag);

    return true;
}

export const alignElement = function () {
    var w = $.getWindowSizes();
    var self = $(this);

    self.css({
        display: 'block',
        top: w.offset_y + (w.view_height - self.height()) / 2,
        left: w.offset_x + (w.view_width - self.width()) / 2
    });
}

export const formIsChanged = function () {
    var changed = false;
    if ($(this).hasClass('cm-skip-check-items')) {
        return false;
    }
    $(':input:visible', this).each(function () {
        changed = $(this).fieldIsChanged();

        // stop checking fields if changed field finded
        return !changed;
    });

    return changed;
}

export const fieldIsChanged = function (check_cm_item) {
    var changed = false;
    var self = $(this);
    var dom_elm = self.get(0);

    if (typeof check_cm_item == 'undefined') {
        check_cm_item = false;
    }

    if (!check_cm_item && (self.hasClass('cm-item') || self.hasClass('cm-check-items'))) {
        return changed;
    }

    if (self.is('select')) {
        var default_exist = false;
        var changed_elms = [];
        $('option', self).each(function () {
            if (this.defaultSelected) {
                default_exist = true;
            }
            if (this.selected != this.defaultSelected) {
                changed_elms.push(this);
            }
        });
        if ((default_exist == true && changed_elms.length) || (default_exist != true && ((changed_elms.length && self.prop('type') == 'select-multiple') || (self.prop('type') == 'select-one' && dom_elm.selectedIndex > 0)))) {
            changed = true;
        }
    } else if (self.is('input[type=radio], input[type=checkbox]')) {
        if (dom_elm.checked != dom_elm.defaultChecked) {
            changed = true;
        }
    } else if (self.is('input,textarea')) {
        if (self.hasClass('cm-numeric')) {
            var val = self.autoNumeric('get');
        } else {
            var val = dom_elm.value;
        }

        if (val != dom_elm.defaultValue) {
            changed = true;
        }
    }

    return changed;
}

export const disableFields = function () {
    if (_.area == 'A') {
        $(this).each(function () {
            var self = $(this);

            var hide_filter = ":not(.cm-no-hide-input):not(.cm-no-hide-input *)"
            var text_elms = $('input[type=text]', self).filter(hide_filter);
            text_elms.each(function () {
                var elm = $(this);
                var hidden_class = elm.hasClass('hidden') ? ' hidden' : '';
                var value = '';
                var meta_class = elm.data('caMetaClass') ? ' ' + elm.data('caMetaClass') : '';
                
                if (elm.prev().hasClass('cm-field-prefix')) {
                    value += elm.prev().text();
                    elm.prev().remove();
                }
                value += elm.val();
                if (elm.next().hasClass('cm-field-suffix')) {
                    value += elm.next().text();
                    elm.next().remove();
                }

                elm.wrap('<span class="shift-input' + hidden_class + meta_class + '">' + value + '</span>');
                elm.remove();
            });

            var label_elms = $('label.cm-required', self).filter(hide_filter);
            label_elms.each(function () {
                $(this).removeClass('cm-required');
            });

            var text_elms = $('textarea', self).filter(hide_filter);
            text_elms.each(function () {
                var elm = $(this);
                elm.wrap('<div class="shift-input">' + elm.val() + '</div>');
                elm.remove();
            });

            var text_elms = $('select:not([multiple])', self).filter(hide_filter);
            text_elms.each(function () {
                var elm = $(this);
                var hidden_class = elm.hasClass('hidden') ? ' hidden' : '';
                elm.wrap('<span class="shift-input' + hidden_class + '">' + $(':selected', elm).text() + '</span>');
                elm.remove();
            });

            var text_elms = $('input[type=radio]', self).filter(hide_filter);
            text_elms.each(function () {
                var elm = $(this);
                var label = $('label[for=' + elm.prop('id') + ']');
                var hidden_class = elm.hasClass('hidden') ? ' hidden' : '';
                if (elm.prop('checked')) {
                    label.wrap('<span class="shift-input' + hidden_class + '">' + label.text() + '</span>');
                    $('<input type="radio" checked="checked" disabled="disabled">').insertAfter(elm);
                } else {
                    $('<input type="radio" disabled="disabled">').insertAfter(elm);
                }
                if (elm.prop('id')) {
                    label.remove();
                }
                elm.remove();
            });

            var text_elms = $(':input:not([type=submit])', self).filter(hide_filter);
            text_elms.each(function () {
                $(this).prop('disabled', true);
            });

            $("a[id^='on_b']", self).remove();
            $("a[id^='off_b']", self).remove();

            var a_elms = $('a', self).filter(hide_filter);
            a_elms.prop('onclick', ''); // unbind do not "unbind" hardcoded onclick attribute

            // find links to pickers and remove it
            $('a[id^=opener_picker_], a[data-ca-external-click-id^=opener_picker_]', self).filter(hide_filter).each(function () {
                $(this).remove();
            });

            $('.attach-images-alt', self).filter(hide_filter).remove();

            $("tbody[id^='box_add_']", self).filter(hide_filter).remove();
            var tmp_tr_box_add = $("tr[id^='box_add_']", self).filter(hide_filter);
            tmp_tr_box_add.remove();

            //Ajax selectors
            var aj_elms = $("[id$='_ajax_select_object']", self).filter(hide_filter)
            aj_elms.each(function () {
                var id = $(this).prop('id').replace(/_ajax_select_object/, '');
                var aj_link = $('#sw_' + id + '_wrap_');
                var aj_elm = aj_link.closest('.dropdown-toggle').parent();
                aj_elm.wrap('<span class="shift-input">' + aj_link.html() + '</span>');
                aj_elm.remove();
                $(this).remove();
            });

            $('a.cm-delete-row', self).filter(hide_filter).each(function () {
                $(this).remove();
            });
            $('button.cm-delete-row', self).filter(hide_filter).each(function() {
                $(this).remove();
            });
            $(self).removeClass('cm-sortable');
            $('.cm-sortable-row', self).filter(hide_filter).removeClass('cm-sortable-row');
            $('p.description', self).filter(hide_filter).remove();
            $('a.cm-delete-image-link', self).filter(hide_filter).remove();
            $('.action-add', self).filter(hide_filter).remove();
            $('.cm-hide-with-inputs', self).filter(hide_filter).remove();
        });
    }
}

// Override default $ click method with more smart and working :)
export const click = function (fn) {
    if (fn) {
        return this.on('click', fn);
    }

    $(this).each(function () {
        if (document.createEventObject) {
            $(this).trigger('click');
        } else {
            var evt_obj = document.createEvent('MouseEvents');
            evt_obj.initEvent('click', true, true);
            this.dispatchEvent(evt_obj);
        }
    });

    return this;
}

export const switchAvailability = function (flag, hide) {
    if (hide != true && hide != false) {
        hide = true;
    }

    if (flag == false || flag == true) {
        $(':input:not(.cm-skip-avail-switch)', this).prop('disabled', flag).toggleClass('disabled', flag);
        if (hide) {
            this.toggle(!flag);
        }
    } else {
        $(':input:not(.cm-skip-avail-switch)', this).each(function () {
            var self = $(this);
            var state = self.prop('disabled');
            self.prop('disabled', !state);
            self[state ? 'removeClass' : 'addClass']('disabled');
        });
        if (hide) {
            this.toggle();
        }
    }
}

export const serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (typeof (o[this.name]) !== 'undefined' && this.name.indexOf('[]') > 0) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });

    var active_tab = this.find('.cm-j-tabs .active');
    if (typeof (active_tab) != 'undefined' && active_tab.length > 0) {
        o['active_tab'] = active_tab.prop('id');
    }

    return o;
}

export const positionElm = function (pos) {
    var elm = $(this);
    elm.css('position', 'absolute');

    // show hidden element to apply correct position
    var is_hidden = elm.is(':hidden');
    if (is_hidden) {
        elm.show();
    }

    elm.position(pos);
    if (is_hidden) {
        elm.hide();
    }
}