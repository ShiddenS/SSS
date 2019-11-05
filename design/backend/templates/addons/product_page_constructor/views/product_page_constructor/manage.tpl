{$show_layout_controls = !$dynamic_object.object_id && ("ULTIMATE"|fn_allowed_for || !$runtime.company_id)}

{assign var="m_url" value=$smarty.request.manage_url|escape:"url"}

{script src="js/tygh/block_manager.js"}

<script type="text/javascript" class="cm-ajax-force">
    var selected_location = '{$location.location_id|default:0}';

    var dynamic_object_id = '{$dynamic_object.object_id|default:0}';
    var dynamic_object_type = '{$dynamic_object_scheme.object_type|default:''}';

    var BlockManager = new BlockManager_Class();

    // New traslations
    Tygh.tr({
        block_already_exists_in_grid: '{__("block_already_exists_in_grid")|escape:"javascript"}'
    });

{literal}
    if (dynamic_object_id > 0) {
        var items = null;
        var grid_items = null;
    } else {
        var items = '.block';
        var grid_items = '.grid';
    }

    (function(_, $) {
        $(document).ready(function() {
            $('#content_location_' + selected_location).appear(function(){
                BlockManager.init('.grid', {
                    // UI settings
                    connectWith: '.grid',
                    items: items,
                    grid_items: grid_items,
                    revert: true,
                    placeholder: 'ui-hover-block',
                    opacity: 0.5,
                    
                    // BlockManager_Class settings
                    parent: this,
                    container_class: 'container',
                    grid_class: 'grid',
                    block_class: 'block',
                    hover_element_class: 'hover-element'
                });
            });
        });
    }(Tygh, Tygh.$));
{/literal}
</script>

{if $dynamic_object.object_id > 0}
    {style src="block_manager_in_tab.css"}
{/if}
{style src="lib/960/960.css"}

<div id="block_window" class="grid-block hidden"></div>
<div id="block_manager_menu" class="grid-menu hidden"></div>
<div id="block_manager_prop" class="grid-prop hidden"></div>

{include file="views/block_manager/render/grid.tpl" default_class="base-grid hidden" show_menu=true}
{include file="views/block_manager/render/block.tpl" default_class="base-block hidden" block_data=true}

{capture name="mainbox"}
{capture name="tabsbox"}
    <div id="content_location_{$location.location_id}">
        {render_location
            dispatch=$location.dispatch
            location_id=$location.location_id
            area='A'
            lang_code=$location.lang_code
        }
    </div>
{/capture}

{capture name="export_layout"}
    {include file="addons/product_page_constructor/views/block_manager/components/export_layout.tpl"}
{/capture}
{include file="common/popupbox.tpl" text=__("export_layout") content=$smarty.capture.export_layout id="export_layout_manager"}

{capture name="import_layout"}
    {include file="views/block_manager/components/import_layout.tpl"}
{/capture}
{include file="common/popupbox.tpl" text=__("import_layout") content=$smarty.capture.import_layout id="import_layout_manager"}

{capture name="buttons"}
    {* Display this buttons only on block manager page *}
    {if $show_layout_controls}
        {capture name="tools_list"}
            {*<li>
                {include file="common/popupbox.tpl"
                id="manage_blocks"
                text=__("block_manager")
                link_text=__("manage_blocks")
                link_class="cm-action bm-action-manage-blocks"
                act="link"
                content=""
                general_class="action-btn"}
            </li>
            <li class="divider"></li>*}
            <li>
                {include file="common/popupbox.tpl"
                id="export_layout_manager"
                link_text=__("export_layout")
                act="link"
                content=""
                general_class="action-btn"}
            </li>
            <li>
                {include file="common/popupbox.tpl"
                id="import_layout_manager"
                link_text=__("import_layout")
                act="link"
                link_class="cm-dialog-auto-size"
                content=""
                general_class="action-btn"
            }
            </li>
        {/capture}
        {dropdown content=$smarty.capture.tools_list}
    {/if}
{/capture}

{script src="js/tygh/tabs.js"}

<div class="cm-j-tabs tabs tabs-with-conf">

    <ul class="nav nav-tabs">
        <input type="hidden" id="s_layout" name="s_layout" value="{$location.layout_id}" />
        {foreach from=$navigation.tabs item=tab key=key name=tabs}
                <li key="{$key}_{"location_`$location.location_id`"}" id="{$key}{$id_suffix}" class="{if $tab.hidden == "Y"}hidden {/if}{if $key == "location_`$location.location_id`"}active extra-tab{/if}">
                    {if $key == "location_`$location.location_id`" && $show_layout_controls}
                        {btn type="dialog" class="cm-ajax-force hand icon-cog" href="block_manager.update_product_page_location?location=`$location.location_id`&s_layout=`$location.layout_id`" id="tab_location_`$location.location_id`" title="{__("block_manager.editing_layout_page")}: `$tab.title`"}
                    {/if}
                    <a {if $tab.href}href="{$tab.href|fn_url}"{/if}>{$tab.title}</a>
                </li>
        {/foreach}
        {if $show_layout_controls}
            <li class="cm-no-highlight">
                {include file="common/popupbox.tpl"
                id="add_new_location"
                text=__("block_manager.new_layout_page")
                link_text="{__("block_manager.add_layout_page")}…"
                act="link"
                href="block_manager.update_product_page_location?s_layout=`$location.layout_id`"
                opener_ajax_class="cm-ajax"
                link_class="cm-ajax-force"
                icon="icon-plus"
                content=""}</li>
        {/if}
    </ul>
</div>
<div class="cm-tabs-content">
    {$smarty.capture.tabsbox nofilter}
</div>

{/capture}

{if $dynamic_object.object_id}
    {$smarty.capture.mainbox nofilter}
{else}
    {include file="common/mainbox.tpl"  adv_buttons=$smarty.capture.adv_buttons buttons=$smarty.capture.buttons content=$smarty.capture.mainbox select_languages=true sidebar=$smarty.capture.sidebar}
{/if}
