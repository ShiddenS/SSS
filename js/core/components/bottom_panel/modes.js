import { params } from './params';
import { state } from './state';

export const modes = {
    _setActive: function (elem) {
        if (elem) {
            state.modesActive = elem.data('bpModesItem');
        }
        $(state.bottomPanel).data('modesActive', state.modesActive);
        modes._setPosition();
        modes._setClass(elem);
    },

    _getButtons: function () {
        $(state.bottomPanel).find(params.modesItemSelector).each(function () {
            state.modes.push($(this));
        });
    },

    _setPosition: function () {
        $(params.modesActiveSelector).css('transform', 'translate(' +
            $(state.bottomPanel)
            .find(params.modesItemSpecificSelector.replace('{placeholder}', state.modesActive))
            .position().left + 'px)');
    },

    _setClass: function (elem) {

        $(params.modesActiveSelector)
            .removeClass(params.modesActiveClasses.join(' '))
            .addClass(params.modesActiveClass.replace('{placeholder}', state.modesActive));

        if (elem) {
            $(state.modes).each(function () {
                $(this).removeClass(params.modesItemActiveClass);
            });
            $(elem).addClass(params.modesItemActiveClass);

        }
    },

    _addSetActiveListeners: function () {
        $(Tygh.doc).on('click', params.modesItemNotDisabledSelector, function (e) {
            return modes._setActive($(this));
        });
    },
};
