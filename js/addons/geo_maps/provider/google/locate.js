(function(_, $) {
    var geolocate = {
        apiInstancesByLangCode: {},

        getCurrentLocation: function () {
            return geolocate._getCurrentPosition()
                .then(geolocate.getLocationByCoords)
        },

        getLocationByCoords: function (lat, lng) {
            return geolocate.loadLocationDataByLatLng(lat, lng)
                .then(geolocate.loadNormalizedLocationData)
        },

        loadLocationDataByLatLng: function (lat, lng) {
            var self = geolocate;

            return self.geocode({location: {lat: parseFloat(lat), lng: parseFloat(lng)}}).then(function (data) {
                return self._mergeLocationResults(data);
            });
        },

        _mergeLocationResults: function (results, types) {
            var self = geolocate,
                result = {
                    place_id: null,
                    lat: null,
                    lng: null,
                    formatted_address: null,
                    type: null
                };

            types = types || ['country', 'state', 'locality', 'route', 'postal_code', 'street_number'];

            $.each(results, function (key, item) {
                if (!result.place_id) {
                    result.place_id = item.place_id;
                    result.formatted_address = item.formatted_address;
                    result.type = item.types[0];
                    result.lat = item.geometry.location.lat;
                    result.lng = item.geometry.location.lng;
                }

                result = $.extend(result, self._retrieveLocationComponents(item.address_components, types));
            });

            return result;
        },

        _retrieveLocationComponents: function (components, types) {
            var result = {},
                map = {
                    country: 'country',
                    administrative_area_level_1: 'state',
                    locality: 'locality',
                    route: 'route',
                    postal_code: 'postal_code',
                    street_number: 'street_number'
                };

            $.each(components, function (key, component) {
                var type = component.types[0];

                if (map[type]) {
                    type = map[type];
                }

                if ($.inArray(type, types) !== -1) {
                    result[type] = component.short_name;
                    result[type + '_text'] = component.long_name;
                }
            });

            return result;
        },

        loadNormalizedLocationData: function (location) {
            var params = {},
                types = null;

            if (location.type === 'country') {
                types = ['country'];
            } else if (location.type === 'administrative_area_level_1') {
                types = ['country', 'state'];
            } else if (location.type === 'locality') {
                types = ['country', 'state', 'locality'];
            }

            if (typeof location.lat === 'function') {
                location.lat = location.lat();
            }

            if (typeof location.lng === 'function') {
                location.lng = location.lng();
            }

            if ($.inArray(location.type, ['country', 'locality', 'administrative_area_level_1']) !== -1 && location.place_id) {
                params.placeId = location.place_id;
            } else {
                params.location = {lat: parseFloat(location.lat), lng: parseFloat(location.lng)};
            }

            return geolocate.geocode(params, 'en').then(function (results) {
                var result = geolocate._normalizeLocation(geolocate._mergeLocationResults(results, types), location);

                if (result.type !== 'locality') {
                    var locality = geolocate._extractByType(results, 'locality');
                    result.locality_place_id = locality.place_id;
                }

                if (result.type !== 'country') {
                    var country = geolocate._extractByType(results, 'country');
                    result.country_place_id = country.place_id;
                }

                return result;
            });
        },

        loadMapApi: function (lang_code) {
            lang_code = lang_code || geolocate.getLanguageCode();

            var url = 'https://maps.googleapis.com/maps/api/js?key=' + _.geo_maps.api_key + '&libraries=places',
                key = lang_code || 'default',
                d = $.Deferred();

            if (geolocate.apiInstancesByLangCode[key]) {
                window.google = geolocate.apiInstancesByLangCode[key];

                d.resolve();
            } else {
                delete window.google;

                if (lang_code) {
                    url += "&language=" + lang_code;
                }

                $.getScript(url).then(function () {
                    geolocate.apiInstancesByLangCode[key] = window.google;
                    d.resolve();
                });
            }

            return d.promise();
        },

        geocode: function (params, lang_code) {
            var d = $.Deferred();
            lang_code = lang_code || geolocate.getLanguageCode();

            geolocate.loadMapApi(lang_code).then(function () {
                var geocoder = new google.maps.Geocoder();

                geocoder.geocode(params, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        d.resolve(results);
                    } else {
                        d.reject();
                    }
                });
            });

            d.done(function () {
                if (lang_code !== geolocate.getLanguageCode()) {
                    geolocate.loadMapApi(geolocate.getLanguageCode());
                }
            });

            return d.promise();
        },

        _extractByType: function (locations, type) {
            var self = geolocate;
            var location = $(locations).filter(function (key, location) {
                return location.types && location.types[0] === type;
            });

            if (location.length) {
                return self._mergeLocationResults(location);
            }

            return {};
        },

        _normalizeLocation: function (normalized_location, location) {
            var self = geolocate;
            if (normalized_location.country) {
                location.country = self._normalizeLocationCode(normalized_location.country);
                location.country_text = location.country_text || normalized_location.country_text;
            }

            if (normalized_location.state) {
                location.state = self._normalizeLocationCode(normalized_location.state);
                location.state_code = '';
                location.state_text = location.state_text || normalized_location.state_text;
            }

            if (normalized_location.locality) {
                location.locality = normalized_location.locality;
                location.locality_text = location.locality_text || normalized_location.locality_text;
            }

            if (location.route && normalized_location.route) {
                location.route = normalized_location.route;
                location.route_text = location.route_text || normalized_location.route_text;
            }

            if (location.postal_code && normalized_location.postal_code) {
                location.postal_code = normalized_location.postal_code;
                location.postal_code_text = location.postal_code_text || normalized_location.postal_code_text;
            }

            if (location.street_number && normalized_location.street_number) {
                location.street_number = normalized_location.street_number;
                location.street_number_text = location.street_number_text || normalized_location.street_number_text;
            }

            return location;
        },

        _normalizeLocationCode: function (code) {
            return $.trim(code.replace(/[\s]/g, '_')).toUpperCase();
        },

        _getCurrentPosition: function () {
            return geolocate._identifyCurrentPositionByBrowser()
                .then(null, geolocate._identifyCurrentPositionByApi);
        },

        _identifyCurrentPositionByBrowser: function () {
            var self = geolocate,
                d = $.Deferred();

            if (navigator.geolocation && location.protocol == 'https') {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        d.resolve(position.coords.latitude, position.coords.longitude);
                    },
                    function (error) {
                        d.reject();
                    },
                    {
                        maximumAge: 50000,
                        timeout: 5000
                    }
                );
            } else {
                d.reject();
            }

            return d.promise();
        },

        _identifyCurrentPositionByApi: function () {
            return $.post("https://www.googleapis.com/geolocation/v1/geolocate?key=" + _.geo_maps.api_key)
                .then(function (data) {
                    return $.Deferred()
                        .resolve(data.location.lat, data.location.lng)
                        .promise();
                });
        },

        getProviderCode: function () {
            return 'google';
        },

        getLanguageCode: function () {
            return _.geo_maps.language || 'en';
        }
    };

    $.ceGeoLocate('setHandlers', geolocate);
})(Tygh, Tygh.$);
