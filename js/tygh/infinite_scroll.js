(function (_, $) {
    var count = 20;
    var begin = 1;
    var scroll_id = 0;
    var ajax_ids;
    var loader_id = 0;

    (function ($) {

        $.ceEvent('on', 'ce.commoninit', function (context) {
            $('.cm-table-tbody td').unbind('click');

            $('.cm-table-tbody td').on('click', function (e) {
                $(this).parent('tr').toggleClass('tr-color_mark');
            });

            context.find('.cm-scroll-data').each(function () {
                if ($(this).data('caTargetId')) {
                    ajax_ids = $(this).data('caTargetId');
                    scroll_id = $(this).attr('id').replace('scroll_content_', '');
                }

                if ($('.cm-table-tbody').css('height')) {
                    var height = $('.cm-table-tbody').height();
                    res = height - 50;
                    $('.cm-table-tbody').css('height', res + "px");
                }

                var scrollTimeoutID = null;

                $('[id=' + scroll_id + ']' + '.cm-scroll-content').on('scroll', function() {
                    $(window).unbind('scroll');

                    if ($(this).attr('id')) {
                        scroll_id = $(this).attr('id');
                    }
                    disabledBlock(begin - 1, begin);

                    if (scrollTimeoutID) {
                        clearTimeout(scrollTimeoutID);
                    }

                    var self = this;

                    scrollTimeoutID = setTimeout(function() {
                        ajax_ids = $('#scroll_content_' + scroll_id).data('caTargetId');

                        if ($(self).attr('id')) {
                            scroll_id = $(self).attr('id');
                        }

                        count = $('#count_scroll_' + scroll_id).val();
                        begin = parseInt($('#begin_scroll_' + scroll_id).val()) + 1;

                        var currentHeight = $('[id=' + scroll_id + ']' + '.cm-scroll-content').get(0).scrollHeight;
                        if($('#' + scroll_id).scrollTop() >= (currentHeight - $('#' + scroll_id).height())){
                            loader();
                        }
                    }, 200);
                });
            });
        });

        function disabledBlock(elm_start, elm_head_scroll) {
            $('[id="' + 'elm_head_scroll_' + scroll_id + '_' + elm_head_scroll + '"]').addClass('cm-block-elm-head-scroll');
            $('[id="' + 'head_scroll_' + scroll_id + '_' + elm_head_scroll + '"]').addClass('cm-block-head-scroll');
        }

        function activatedBlock(elm_start, elm_head_scroll) {
            $('[id="' + 'elm_head_scroll_' + scroll_id + '_' + elm_head_scroll + '"]').removeClass('cm-block-elm-head-scroll');
            $('[id="' + 'head_scroll_' + scroll_id + '_' + elm_head_scroll + '"]').removeClass('cm-block-head-scroll');
        }

        function loader() {
            var elm_start = begin - 1;
            var elm_head_scroll = begin;
            var elm_scroll_id = scroll_id;
            var elm_loader_id = scroll_id + '_' + begin;

            if (loader_id != elm_loader_id) {
                loader_id = scroll_id + '_' + begin;
                $.ceAjax('request', _.current_url, {
                    method: 'get',
                    result_ids: ajax_ids,
                    data: {
                        count: count,
                        begin: begin * count,
                        scroll_id: elm_scroll_id,
                        table_id: elm_scroll_id
                    },
                    append: true,
                    caching: false,
                    callback: function(data) {
                        if (data.html) {
                            scroll_id = elm_scroll_id;
                            disabledBlock(elm_start, elm_head_scroll);

                            $('#count_scroll_' + elm_scroll_id).val(count);
                            $('#begin_scroll_' + elm_scroll_id).val(elm_head_scroll);
                        } else {
                            activatedBlock(elm_start, elm_head_scroll);
                            $('#' + elm_scroll_id).unbind('scroll');
                        }

                        if ($('#total_scroll_' + elm_scroll_id).length) {
                            $('#' + elm_scroll_id).unbind('scroll');
                        }
                    }
                });
            }

            begin++;
            return false;
        }
    })($);

}(Tygh, Tygh.$));
