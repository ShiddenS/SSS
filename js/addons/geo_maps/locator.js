(function (_, $) {
    var methods = {
        init: function ($elm) {
            methods.autoDetect(methods.setLocationAsync, $elm);
        },

        autoDetect: function (callback, $elm) {
            $.ceGeoLocate('getCurrentLocation')
                .then(function (location) {
                    callback(location, $elm);
                });
        },

        setLocation: function (location, $container, auto_detect) {
            var d = $.Deferred();
            $.ceAjax('request', fn_url('geo_maps.set_location'), {
                method: 'post',
                data: {location: location, auto_detect: Number(auto_detect)},
                hidden: true,
                caching: false,
                callback: function (response) {
                    $container.each(function (i, elm) {
                        var $elm = $(elm);
                        $('[data-ca-geo-map-location-element="location"]', $elm).text(response.city);
                        $elm.data('caGeoMapLocationIsLocationDetected', true);
                    });

                    $.ceEvent('trigger', 'ce:geomap:location_set_after', [location, $container, response, auto_detect]);
                    d.resolve(response);
                }
            });

            return d.promise();
        },

        setLocationAsync: function (location, $container) {
            methods.setLocation(location, $container, true);
        },

        initMap: function (elm) {
            var $set_location = $(elm).closest('[data-ca-geo-map-location-element="location_selector"]').find('.ty-geo-maps__geolocation__set-location'),
                coordinates;

            methods.autoDetect(function (location, $container) {
                var options = {
                    initial_lat: location.lat,
                    initial_lng: location.lng,
                    zoom: 10,
                    controls: {
                        enable_search: true,
                    },
                    markers: [
                        {
                            lat: location.lat,
                            lng: location.lng,
                        }
                    ],
                };

                coordinates = [location.lat, location.lng];
                $container.on('ce:geomap:init_failed', function (e) {
                    methods.showMapLoadError($(e.target));
                });

                $container.ceGeoMap(options);

                $container.on('ce:geomap:click_marker', function (e, marker) {
                    coordinates = [marker.lat, marker.lng];
                    $set_location.trigger('click');
                });
                $container.on('ce:geomap:search_result_select', function (e, data) {
                    if (!data.lat || !data.lng) {
                        return;
                    }

                    coordinates = [data.lat, data.lng];
                    var $container = $(e.target);

                    $container.ceGeoMap('removeAllMarkers');
                    $container.ceGeoMap('addMarkers', [data]);
                    $container.ceGeoMap('setCenter', data.lat, data.lng);
                });

                $set_location.removeClass('pending');
            }, $(elm));

            $set_location.click(function (e) {
                if ($(this).is('pending') || !coordinates) {
                    return false;
                }

                var lat = coordinates[0],
                    lng = coordinates[1];

                if (!lat || !lng) {
                    return;
                }

                $.ceGeoLocate('getLocationByCoords', lat, lng)
                    .then(function (location) {
                        methods.setLocation(location, $('[data-ca-geo-map-location-element="location_block"]'), false);
                    }, function () {
                        $.ceNotification('show', {
                            type: 'W',
                            title: _.tr('warning'),
                            message: _.tr('geo_maps_cannot_select_location')
                        });
                    });
            });
        },

        showMapLoadError: function ($elm) {
            $elm.closest('[data-ca-geo-map-location-element="location_selector"]')
                .find('[data-ca-geo-map-location-element="map_load_error_message"]')
                .removeClass('hidden');
            $elm.addClass('hidden');
            $('.ty-geo-maps__geolocation__set-location').removeClass('pending');
        }
    };

    $.extend({
        ceGeoMapLocation: function (method) {
            if (methods[method]) {
                return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
            } else {
                $.error('ty.geo-maps-location: method ' + method + ' does not exist');
            }
        }
    });

    $.ceEvent('on', 'ce.commoninit', function (context) {
        var location_blocks = $('[data-ca-geo-map-location-element="location_block"]', context),
            maps            = $('[data-ca-geo-map-location-element="map"]', context);

        if (location_blocks.length) {
            location_blocks.each(function(i, elm) {
                var $elm = $(elm);
                if (!$elm.data('caGeoMapLocationIsLocationDetected')) {
                    $.ceGeoMapLocation('init', $elm);
                }
            });
        }

        if (maps.length) {
            maps.each(function(i, elm) {
                $.ceGeoMapLocation('initMap', elm);
            });
        }
    });

    $.ceEvent('on', 'ce.dialogshow', function ($context) {
        if (!$('[data-ca-geo-map-location-element="map"]', $context).length) {
            return;
        }

        $('[data-ca-geo-map-location-element="map"]', $context).ceGeoMap('resize');
    });
})(Tygh, Tygh.$);
