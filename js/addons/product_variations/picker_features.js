(function(_, $) {
    $.ceEvent('on', 'ce.commoninit', function (context) {
        var $elems = $(context).find('.cm-picker-product-variation-features');

        if ($elems.length) {
            $elems.find('select,input[type="radio"]').on('change', function () {
                var $self = $(this),
                    $option;
                if ($self.prop('tagName').toLowerCase() === 'select') {
                    $option = $self.find('option:selected');
                } else {
                    $option = $self;
                }

                if ($option.length) {
                    if ($self.hasClass('cm-ajax')) {
                        $.ceAjax('request', $option.data('caProductUrl'), {
                            result_ids: $self.data('caTargetId'),
                            save_history: $self.hasClass('cm-history'),
                            force_exec: $self.hasClass('cm-ajax-force'),
                            caching: true
                        });
                    } else {
                        $.redirect($option.data('caProductUrl'));
                    }
                }
            });
        }
    });
}(Tygh, Tygh.$));
