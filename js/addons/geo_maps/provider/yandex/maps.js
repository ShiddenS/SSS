(function (_, $) {
    var yandex = {
        default_zoom: 16,

        init: function (options) {
            var $container = $(this),
                self = yandex;

            if ($container.data('ceGeoMapInitialized')) {
                return true;
            }

            $.geoMapInitYandexApi(options)
                .done(function () {
                    self._initMap($container, options);

                    self._registerMapClickEvent($container);
                    self._registerSearchEvent($container);

                    self._fireEvent($container, 'ce:geomap:init');
                })
                .fail(function () {
                    self._fireEvent($container, 'ce:geomap:init_failed');
                });

            return this;
        },

        _initMap: function ($container, options) {
            options = options || {};
            var self = yandex,
                controls = self._initMapControls(options),
                behaviors = self._initMapBehaviors(options);

            // Required fields - zoom, center
            var map_state = {
                zoom: parseInt(options.zoom) || self.default_zoom,
                type: 'yandex#map',
                center: [options.initial_lat || 0, options.initial_lng || 0],
                controls: controls,
                behaviors: behaviors,
                draggableCursor: 'crosshair',
                draggingCursor: 'pointer',
            };

            $container.ceGeoMap('destroy');
            var map = new geo_maps_yandex.Map($container[0], map_state);
            $container.data('caGeoMap', map);

            var clusterer = self._getClusterer($container) || new geo_maps_yandex.Clusterer();
            $container.data('caYandexClusterer', clusterer);

            self._renderMarkers($container, options.markers, options);
        },

        _initMapControls: function (options) {
            var controls = options.controls;
            if ($.isEmptyObject(controls)) {
                return ['default'];
            } else if (controls.no_controls) {
                return [];
            }

            var ctls = [];
            if (controls.enable_traffic) {
                ctls.push('trafficControl');
            } if (controls.enable_layers) {
                ctls.push('typeSelector');
            } if (controls.enable_fullscreen) {
                ctls.push('fullscreenControl');
            } if (controls.enable_zoom) {
                ctls.push('zoomControl');
            } if (controls.enable_ruler) {
                ctls.push('rulerControl');
            } if (controls.enable_search) {
                ctls.push('searchControl');
            } if (controls.enable_routing) {
                ctls.push('routeButtonControl');
            } if (controls.enable_geolocation) {
                ctls.push('geolocationControl');
            }

            return ctls;
        },

        _initMapBehaviors: function (options) {
            var behaviors = options.behaviors;
            if ($.isEmptyObject(behaviors)) {
                return ['default'];
            } else if (behaviors.no_behaviors) {
                return [];
            }

            var bhvs = [];
            if (behaviors.enable_drag) {
                bhvs.push('drag');
            } if (behaviors.enable_scroll_zoom) {
                bhvs.push('scrollZoom');
            } if (behaviors.enable_dbl_click_zoom) {
                bhvs.push('dblClickZoom');
            } if (behaviors.enable_multi_touch) {
                bhvs.push('multiTouch');
            } if (behaviors.enable_ruler) {
                bhvs.push('ruler');
            } if (behaviors.enable_route_editor) {
                bhvs.push('routeEditor');
            }

            return bhvs;
        },

        _renderMarkers: function ($container, markers, options) {
            var self = yandex;

            $container.ceGeoMap('removeAllMarkers');
            $container.ceGeoMap('addMarkers', markers);

            options = options || {};
            self._showSelectedMarker($container, markers, options);

            return true;
        },

        _getGeoMap: function ($container) {
            return $container.data('caGeoMap');
        },

        _addMarkersToCluster: function ($container, markers) {
            var self = yandex,
                clusterer = self._getClusterer($container),
                map = self._getGeoMap($container),
                cluster = [],
                map_marker;

            if (!clusterer) {
                return;
            }

            $.each(markers, function (index, marker) {
                map_marker = self._prepareMarker(marker, $container);
                cluster.push(map_marker);
            });

            clusterer.add(cluster);
            map.geoObjects.add(clusterer);
        },

        _prepareMarker: function (marker, $container) {
            var marker_data = {};
            if (marker.content) {
                marker_data.balloonContentBody = marker.content;
            }

            var map_marker = new geo_maps_yandex.Placemark(
                [marker.lat, marker.lng],
                marker_data
            );

            map_marker.events.add('click', function (e) {
                var self = yandex,
                    marker = self._normalizeMarkerClickResult(e);
                self._fireEvent($container, 'ce:geomap:click_marker', [marker]);
            });

            return map_marker;
        },

        _addStaticMarkers: function ($container, markers) {
            var self = yandex,
                map = self._getGeoMap($container),
                map_marker;

            $.each(markers, function (index, marker) {
                map_marker = self._prepareMarker(marker, $container);
                map.geoObjects.add(map_marker);
            });
        },

        _normalizeMarkerClickResult: function (result) {
            var coords = result.get('target').geometry.getCoordinates(),
                marker = {
                    lat: coords[0],
                    lng: coords[1],
                };

            return marker;
        },

        _showSelectedMarker: function ($container, markers, options) {
            var self = yandex;

            if (markers.length === 1) {
                var selected_marker = markers[0];
            } else {
                var selected_marker = $.grep(markers, function (marker) {
                    return marker.selected;
                })[0];
            }

            if (selected_marker) {
                $container.ceGeoMap(
                    'setCenter',
                    selected_marker.lat,
                    selected_marker.lng,
                    parseInt(options.zoom) || self.default_zoom
                );
            } else if (markers.length > 1) {
                $container.ceGeoMap('adjustMapBoundariesToSeeAllMarkers');
            }

            return true;
        },

        _registerMapClickEvent: function ($container) {
            var self = yandex,
                map = self._getGeoMap($container);

            if (!map) {
                return false;
            }

            map.events.add('click', function (result) {
                var data = self._normalizeClickResult(result);
                self._fireEvent($container, 'ce:geomap:click', [data]);
            });

            return true;
        },

        _fireEvent: function ($container, name, data) {
            data = data || [];
            $container.trigger(name, data);

            data = data.unshift($container);
            $.ceEvent('trigger', name, data);
        },

        _normalizeClickResult: function (result) {
            var coordinates = result.get('coords');
            var normalized_result = {
                lat: coordinates[0],
                lng: coordinates[1],
            };

            return normalized_result;
        },

        _registerSearchEvent: function ($container) {
            var self = yandex,
                map = self._getGeoMap($container),
                searchControl = map ? map.controls.get('searchControl') : null;

            if (!searchControl) {
                return false;
            }

            searchControl.events.add('resultselect', function (e) {
                var index = e.get('index');

                searchControl.getResult(index).then(function (result) {
                    result.getParent().remove(result); // remove marker from map
                    var data = self._normalizeSearchResult(result);

                    self._fireEvent($container, 'ce:geomap:search_result_select', [data]);
                });
            });

            return true;
        },

        _normalizeSearchResult: function (result) {
            var coords = result.geometry.getCoordinates();
            var normalized_result = {
                lat: coords[0],
                lng: coords[1],
            };

            return normalized_result;
        },

        resize: function () {
            var self = yandex,
                $container = $(this),
                map = self._getGeoMap($container);

            if (!map) {
                return false;
            }

            map.container.fitToViewport();
            return true;
        },

        destroy: function () {
            var self = yandex,
                $container = $(this),
                map = self._getGeoMap($container);

            if (!map) {
                return false;
            }

            map.destroy();
            return true;
        },

        removeAllMarkers: function () {
            var self = yandex,
                $container = $(this),
                clusterer = self._getClusterer($container),
                map = self._getGeoMap($container);

            if (clusterer) {
                clusterer.removeAll();
            }
            if (map) {
                map.geoObjects.removeAll();
            }

            return true;
        },

        _getClusterer: function ($container) {
            return $container.data('caYandexClusterer');
        },

        addMarkers: function (markers) {
            var self = yandex,
                $container = $(this);

            var cluster_markers = $.grep(markers, function (marker) {
                return !marker.static;
            });
            self._addMarkersToCluster($container, cluster_markers);

            var static_markers = $.grep(markers, function (marker) {
                return marker.static;
            });
            self._addStaticMarkers($container, static_markers);
        },

        adjustMapBoundariesToSeeAllMarkers: function () {
            var self = yandex,
                $container = $(this),
                clusterer = self._getClusterer($container),
                map = self._getGeoMap($container);

            if (!clusterer || !map) {
                return false;
            }

            map.setBounds(clusterer.getBounds(), {
                checkZoomRange: true
            });

            return true;
        },

        setCenter: function (lat, lng, zoom) {
            var self = yandex,
                $container = $(this),
                map = self._getGeoMap($container);

            if (!map) {
                return false;
            }

            map.setCenter([lat, lng]);
            map.setZoom(parseInt(zoom) || self.default_zoom);
            return true;
        },

        getCenter: function () {
            var self = yandex,
                $container = $(this),
                map = self._getGeoMap($container);

            if (!map) {
                return {};
            }

            var coords = map.getCenter();

            return {
                lat: coords[0],
                lng: coords[1],
            };
        },

        exitFullscreen: function () {
            var self = yandex,
                $container = $(this),
                map = self._getGeoMap($container);

            if (map) {
                map.container.exitFullscreen();
                return true;
            }

            return false;
        }
    };

    $.ceGeoMap('setHandlers', yandex);
})(Tygh, Tygh.$);
