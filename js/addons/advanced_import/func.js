(function (_, $) {

    var preset_id, object_type,
        company_selector, file_type_selector,
        file_selector, preset_name_selector,
        preset_file,
        preset_file_type,
        xml_target_node_wrapper,
        nesting_padding_size = 20;

    var methods = {
        initPresetEditor: function () {

            $.ceEvent('on', 'ce.fileuploader.display_filename', function (id, file_type, file) {
                if (file_type === 'server' || file_type === 'url') {
                    file = $('#file_' + id).val();
                    $.ceAdvancedImport('getFields', file_type, file);
                    $('#advanced_import_save_and_import, li#fields').removeClass('hidden');
                } else if (file_type === 'local') {
                    $('#advanced_import_save_and_import, li#fields').addClass('hidden');
                }

                var ext = /\.([^.]+)?$/.exec(file);
                var file_extension = ext ? ext[1] : null;
                $.ceAdvancedImport('toggleXmlTargetNode', file_extension);

                if (!preset_name_selector.val()) {
                    preset_name_selector.val(file)
                }

                preset_file.val(file);
                preset_file_type.val(file_type);
            });

            if (xml_target_node_wrapper.data('caDefaultHidden')) {
                xml_target_node_wrapper.hide();
            }
        },

        getFields: function (file_type, file, options) {

            file_type = file_type || file_type_selector.val();
            file = file || file_selector.val();

            var company_id = company_selector.val();

            var data = {
                preset_id: preset_id,
                object_type: object_type,
                company_id: company_id
            };
            if (file_type) {
                data.file_type = file_type;
            }
            if (file) {
                data.file = file;
            }

            $.ceAjax('request', fn_url('import_presets.get_fields'), {
                result_ids: 'content_fields',
                caching: false,
                data: data,
                callback: function (data) {
                    var file_extension = data['file_extension'];
                    $.ceAdvancedImport('toggleXmlTargetNode', file_extension);
                }
            });
        },

        toggleXmlTargetNode: function (file_extension) {
            if (!file_extension || file_extension !== 'xml') {
                xml_target_node_wrapper.hide();
            } else {
                xml_target_node_wrapper.show();
            }
        },

        initRelatedObjectSelectors: function (selectors) {
            selectors.change(function () {
                var type_holder = $('#elm_field_related_object_type_' + $(this).data('caAdvancedImportFieldId'));
                var type = $('option:selected', $(this)).data('caAdvancedImportFieldRelatedObjectType');
                type_holder.val(type);
            });

            selectors.each(function () {
                $(this).trigger('change');
            });
        },

        showFieldsPreview: function (opener) {
            var params = $.ceDialog('get_params', opener);
            $('#' + opener.data('caTargetId')).ceDialog('open', params);
            if (window.history.replaceState) {
                window.history.replaceState({}, '', _.current_url.replace(/&preview_preset_id=\d+/, ''));
            }
        },

        // FIXME: Dirty hack
        // Pop-up with the fields mapping is destroyed before a Comet request is sent,
        // so fields must be manually transfered to the parent form.
        setFieldsForImport: function (preset_id) {
            var form = $('[data-ca-advanced-import-element="management_form"]');

            form.append('<input type="hidden" name="preset_id" value="' + preset_id + '" />');
            form.append('<input type="hidden" name="dispatch[advanced_import.import]" value="OK" />');

            var fields = form.serializeArray();

            for (var i in fields) {
                var field = fields[i];
                if (/^fields\[/.test(field.name)) {
                    form.append($('<input>', {
                        type: "hidden",
                        name: field.name,
                        value: field.value
                    }));
                }
            }
        },

        changeCompanyId: function () {
            $.ceAdvancedImport('getFields');
            $.ceAdvancedImport('getImagesPrefixPath');
        },

        getImagesPrefixPath: function () {
            var $elem = $('#advanced_import_images_path_prefix'),
                companies_image_directories = $elem.data('companiesImageDirectories'),
                company_id = company_selector.val();

            if ('relative_path' in companies_image_directories[company_id]) {
                $elem.text(companies_image_directories[company_id].relative_path);
            }
        },

        validateModifier: function ($modifier, $modifier_control_group, show_notifications) {

            $.ceAjax('request', fn_url('import_presets.validate_modifier'), {
                data: {
                    modifier: $modifier.val(),
                    value: $modifier.data('caAdvancedImportOriginalValue'),
                    notify: show_notifications
                },
                hidden: true,
                method: 'post',
                callback: function (response) {
                    $modifier
                        .toggleClass('cm-failed-field', !response.is_valid)
                        .prop('data-ca-advanced-import-needs-validation', false);
                    $modifier_control_group.toggleClass('error', !response.is_valid);
                }
            });
        },

        initModifiersValidation: function (modifiers) {

            var validation_timeout;

            modifiers
                .on('focusout', function () {
                    if (validation_timeout) {
                        clearTimeout(validation_timeout);
                    }

                    var $elm = $(this),
                        $elm_group = $elm.closest('.control-group');

                    $.ceAdvancedImport('validateModifier', $elm, $elm_group, 'Y');
                })
                .on('keyup', function () {
                    if (validation_timeout) {
                        clearTimeout(validation_timeout);
                    }

                    var $elm = $(this),
                        $elm_group = $elm.closest('.control-group');

                    validation_timeout = setTimeout(function () {
                        $.ceAdvancedImport('validateModifier', $elm, $elm_group, 'N');
                    }, 500);
                });

            $.ceEvent('on', 'ce.formpre_import_preset_update_form', function (form, clicked_elm) {
                if ($('.error', form).length) {
                    $.ceNotification('show', {
                        title: _.tr('error'),
                        message: _.tr('advanced_import.cant_save_preset_invalid_modifiers'),
                        type: 'E'
                    });
                    return false;
                }
            });
        },

        convertXpathToTree: function (fields) {
            fields.each(function () {
                var $self = $(this),
                    attr_name = $self.text(),
                    depth = 0;

                var attr_path_parts = /^([^@]+)((@[^=]+)(="[^"]*")?)?/.exec(attr_name);
                if (attr_path_parts) {
                    var name_parts = attr_path_parts[1].split('/');
                    depth = name_parts.length - 2;
                    attr_name = name_parts.pop();

                    if (attr_path_parts[3]) {
                        depth++;
                        attr_name = attr_path_parts[2]
                            ? attr_path_parts[2]
                            : attr_path_parts[3];
                    }
                }

                $self
                    .css('paddingLeft', (nesting_padding_size * depth) + 'px')
                    .text(attr_name);
            });
        }
    };

    $.extend({
        ceAdvancedImport: function (method) {
            if (methods[method]) {
                return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
            } else {
                $.error('ty.advancedImport: method ' + method + ' does not exist');
            }
        }
    });

    $.ceEvent('on', 'ce.commoninit', function (context) {
        if (typeof _.advanced_import == 'undefined') {
            return;
        }

        $('.cm-adv-import-placeholder', context).each(function (index, elm) {
            var $elm;

            try {
                $elm = _createSelector($(elm).data());
            } catch (Error) {
                $.ceNotification('show', {
                    title: _.tr('error'),
                    message: Error.toString(),
                    type: 'E'
                });
            }

            $(elm).after($elm);
        });

        $('.cm-object-selector', $('.preview-fields-mapping__wrapper', context)).ceObjectSelector();

        function _createSelector(data) {

            var $selectElm = $('<select></select>'),
                $dummyOption = $('<option data-ca-advanced-import-field-related-object-type="skip"></option>');

            $selectElm.attr({
                'class': 'input-hidden cm-object-selector import-field__related_object-select',
                'id': 'elm_import_field_' + data.caAdvancedImportFieldId,
                'name': data.caAdvancedImportSelectName,
                'data-ca-advanced-import-field-related-object-selector': 'true',
                'data-ca-advanced-import-field-id': data.caAdvancedImportFieldId,
                'data-ca-enable-search': 'true',
                'data-ca-placeholder': data.caPlaceholder,
                'data-ca-allow-clear': 'true'
            });

            var name = data.caAdvancedImportFieldName;

            $selectElm.append($dummyOption);

            var preset_fields = _.advanced_import.preset_fields;

            for (var relatedObjectType in _.advanced_import.relations) {
                if (!_.advanced_import.relations.hasOwnProperty(relatedObjectType)) {
                    continue;
                }

                var groupInfo     = _.advanced_import.relations[relatedObjectType];
                var $groupWrapper = $('<optgroup label="' + (groupInfo.description || '-----') + '"></optgroup>');

                for (var objectName in groupInfo.fields) {
                    if (!groupInfo.fields.hasOwnProperty(objectName) || groupInfo.fields[objectName].hidden) {
                        continue;
                    }

                    var object = groupInfo.fields[objectName];
                    var optionText = '';

                    if (object.show_name) {
                        optionText += objectName;
                    }

                    if (object.show_name && object.show_description) {
                        optionText += ' (';
                    }

                    if (object.show_description) {
                        optionText += object.description;
                    }

                    if (object.show_name && object.show_description) {
                        optionText += ')';
                    }

                    var $option = $('<option data-ca-advanced-import-field-related-object-type="' + relatedObjectType + '">' + optionText + '</option>');
                        $option.attr('value', objectName);

                    if (object.required) {
                        $option.toggleClass('selectbox-highlighted');
                    }

                    if (preset_fields[name] &&
                        preset_fields[name].related_object_type === relatedObjectType &&
                        preset_fields[name].related_object === objectName
                    ) {
                        $option.prop('selected', true);
                    }

                    $groupWrapper.append($option);
                }

                $selectElm.append($groupWrapper);
            }

            return $selectElm;
        }
    });

    $.ceEvent('on', 'ce.commoninit', function (context) {
        var preset = $('[data-ca-advanced-import-element="editor"]', context);
        if (preset.length) {
            preset_id = preset.data('caAdvancedImportPresetId');
            object_type = preset.data('caAdvancedImportPresetObjectType');
            company_selector = $('#elm_company_id', context);
            file_type_selector = $('[name="type_upload[]"]');
            file_selector = $('[name="file_upload[]"]');
            preset_name_selector = $('#elm_preset', context);
            preset_file = $('[data-ca-advanced-import-element="file"]', context);
            preset_file_type = $('[data-ca-advanced-import-element="file_type"]', context);
            xml_target_node_wrapper = $('#target_node').closest('.control-group');

            $.ceAdvancedImport('initPresetEditor');
        }

        var related_object_selectors = $('[data-ca-advanced-import-field-related-object-selector]', context);
        if (related_object_selectors.length) {
            $.ceAdvancedImport('initRelatedObjectSelectors', related_object_selectors);
        }

        var fields_preview_opener = $('.import-preset__preview-fields-mapping', context);
        if (fields_preview_opener.length) {
            $.ceAdvancedImport('showFieldsPreview', fields_preview_opener);
        }

        var import_start_button = $('.cm-advanced-import-start-import', context);
        if (import_start_button.length) {
            import_start_button.click();
        }

        var modifiers = $('[data-ca-advanced-import-element="modifier"]', context);
        if (modifiers.length) {
            $.ceAdvancedImport('initModifiersValidation', modifiers);
        }

        var is_xml = $('[data-ca-advanced-import-preset-file-extension="xml"]', context);
        var fields = $('[data-ca-advanced-import-element="field"]', context);
        if (is_xml.length && fields.length) {
            $.ceAdvancedImport('convertXpathToTree', fields);
        }
    });

    $(document).ready(function () {
        $('.advanced-import-file-editor-opener').on('click', function (e) {
            var $target = $(e.target),
                option_id = $target.data('targetInputId'),
                company_id = $target.closest('form').find('#elm_company_id').val(),
                relative_path = $('#' + option_id).val(),
                url = fn_url('import_presets.file_manager&path=' + relative_path + '&company_id=' + company_id),
                $finder_dialog = $('#' + option_id + '_dialog');

            $finder_dialog.ceDialog('destroy');
            $finder_dialog.empty();

            $finder_dialog.ceDialog('open', {
                'href': url,
                'title': _.tr('file_editor')
            });

            return false;
        });
    });
})(Tygh, Tygh.$);
