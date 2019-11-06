(function(_, $) {
    $(_.doc).ready(function() {
        $(_.doc).on('click', '.cm-sl-pickup-select-store', function(e) {
            $.ceEvent('trigger', 'ce.shipping.select-store', []);
            fn_calculate_total_shipping_cost();
        });

        $(_.doc).on('click', '.cm-sl-pickup-show-all-on-map', function (e) {
            var $btn = $(this),
                container_id = $btn.data('caTargetMapId'),
                $container = $('#' + container_id);

            if (!$container.length) {
                return false;
            }

            $container.ceGeoMap('adjustMapBoundariesToSeeAllMarkers');

            var scroll_to = $btn.data('caScroll');
            if (scroll_to) {
                $.scrollToElm(scroll_to);
            }
        });

        $(_.doc).on('click', '.cm-sl-pickup-view-location', function () {
            var $btn = $(this),
                container_id = $btn.data('caTargetMapId'),
                $container = $('#' + container_id),
                lat = $btn.data('caGeoMapMarkerLat'),
                lng = $btn.data('caGeoMapMarkerLng');

            if (!$container.length) {
                return false;
            }

            $container.ceGeoMap('setCenter', lat, lng);

            var scroll_to = $btn.data('caScroll');
            if (scroll_to) {
                $.scrollToElm(scroll_to);
            }
        });

        $(_.doc).on('click', '.cm-sl-pickup-select-location', function () {
            var $jelm = $(this),
                location = $jelm.data('caLocationId'),
                group_key = $jelm.data('caGroupKey'),
                shipping_id = $jelm.data('caShippingId');

            $('#store_' + group_key + '_' + shipping_id + '_' + location).prop('checked', true);
            fn_calculate_total_shipping_cost();
        });
    });
})(Tygh, Tygh.$);
