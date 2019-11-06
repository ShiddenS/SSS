(function(_, $) {
    $.ceEvent('on', 'ce.tab.pre_init', function (tabs_elm) {
        if (tabs_elm.attr('id') == 'addons_nav_tabs') {
            var preset_tab = tabs_elm.data('caPresetTabId');
            if (preset_tab) {
                localStorage.setItem('addons_manage_active_tab_id', preset_tab);
            }

            var last_tab = localStorage.getItem('addons_manage_active_tab_id');
            if (last_tab) {
                $('#'+last_tab).addClass('active');
            }
        }
    });
    
    $.ceEvent('on', 'ce.tab.show', function (tab_id, tabs_elm) {
        if (tabs_elm.attr('id') == 'addons_nav_tabs') {
            localStorage.setItem('addons_manage_active_tab_id', tab_id);
        }
    });
    
    $(document).ready(function() {
        var
            $tables = $('.table-addons.cm-filter-table'),
            $addon_status = $('#elm_addon_status'),
            $addon_source = $('#elm_addon_source');

        $.ceEvent('on', 'ce.commoninit', function(context) {
            var $temp_tables = context.find('.table-addons.cm-filter-table');

            if ($temp_tables.length) {
                $tables = $temp_tables;
                $tables.ceFilterTable('filter');
            }
        });

        $.ceEvent('on', 'ce.filter_table_show_items', function (container, data) {
            if (!container.hasClass('table-addons')) {
                return;
            }

            var status = $addon_status.val(),
                source = $addon_source.val();

            switch (status) {
                case 'not_installed':
                    data.items = data.items.filter('.filter_status_N');
                    break;
                case 'installed':
                    data.items = data.items.filter('.filter_status_A,.filter_status_D');
                    break;
                case 'active':
                    data.items = data.items.filter('.filter_status_A');
                    break;
                case 'disabled':
                    data.items = data.items.filter('.filter_status_D');
                    break;
            }

            switch (source) {
                case 'core':
                    data.items = data.items.filter('.filter_source_built_in');
                    break;
                case 'third_party':
                    data.items = data.items.filter('.filter_source_third_party');
                    break;
            }
        });

        $addon_status.on('change', function() {
            $tables.ceFilterTable('filter');
            
            var tabs_elm = $('#addons_nav_tabs');
            var status = $(this).val();
            
            switch (status) {
                case 'not_installed':
                    tabs_elm.ceTabs('switch', 'tab_browse_all_available_addons');
                    break;
                case 'installed':
                    tabs_elm.ceTabs('switch', 'tab_installed_addons');
                    break;
                case 'active':
                    tabs_elm.ceTabs('switch', 'tab_installed_addons');
                    break;
                case 'disabled':
                    tabs_elm.ceTabs('switch', 'tab_installed_addons');
                    break;
            }
        });
        
        $addon_source.on('change', function() {
            $tables.ceFilterTable('filter');
        });
    });
}(Tygh, Tygh.$));