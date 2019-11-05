{if $block_data}
    {if $block_data.status}
        {$status = $block_data.status}
    {else}
        {$status = "A"}
    {/if}

    {if !$dynamic_object && $block_data.items_count > 0}
        {capture name="confirm_message"}
            {if $status == "A"}
                {$action = __("disable")|lower}
            {else}
                {$action = __("enable")|lower}
            {/if}
            <span class="confirm-message hidden">
                {__("bm_confirm", ["[action]" => $action, "[location_name]" => $location.name])}
            </span>
        {/capture}
    {/if}

    <div class="{$default_class|default:"device-specific-block block"} {if $status != "A"}block-off{/if} {if $parent_grid.content_align == "\Tygh\BlockManager\Grid::ALIGN_RIGHT"|constant}pull-right{elseif $parent_grid.content_align == "\Tygh\BlockManager\Grid::ALIGN_LEFT"}pull-left{/if} {if $external_render}bm-external-render{/if}"
         data-ca-status="{if $status != "A"}disabled{else}active{/if}"
         data-block-id="{$block_data.block_id}"
         {include file="views/block_manager/components/device_availability_attributes.tpl" item=$block_data}
         id="snapping_{$block_data.snapping_id}{if $external_render}{$block_data.block_id}_{$external_id}{/if}"
    >
        <div class="block-header" title="{$block_data.name}">
            {include file="views/block_manager/components/device_icons.tpl"
                item=$block_data
            }
            <div class="block-header-icon {if $block_data.type}bmicon-{$block_data.type|replace:"_":"-"}{/if}" {if $parent_grid.width == 1}hidden{/if}></div>
            <h4 class="block-header-title {if $show_for_location && $block_data.location != $show_for_location}fixed-block{/if} {if $parent_grid.width == 1}hidden{/if}">
                {$block_data.name}
            </h4>
        </div>

        <div class="bm-full-menu block-control-menu bm-control-menu {if $parent_grid.width <= 2 && !$external_render}hidden keep-hidden{/if}">
            {if !$external_render}
                {* We need extra "hidden" div's for tooltips *}
                {if $block_data.is_manageable|default:true}
                    <div class="cm-tooltip cm-action icon-cog bm-action-properties action" title="{__("block_options")}"></div>
                {/if}
                <div class="cm-tooltip cm-action icon-off bm-action-switch{if $status != "A"} switch-off{/if}{if $dynamic_object} bm-dynamic-object{/if}{if !$dynamic_object && $block_data.items_count > 0} bm-confirm{/if} action" title="{__("enable_or_disable_block")}"{if $dynamic_object}data-ca-bm-object-id="{$dynamic_object.object_id}"{/if}>{$smarty.capture.confirm_message nofilter}</div>

            {else}
                <input type="hidden" name="block_data[block_id]" value="{$block_data.block_id}" id="ajax_update_block_{$external_id}"/>
                {include file="common/popupbox.tpl"
                    id="edit_block_properties_`$block_data.block_id`_`$external_id`"
                    text=__("block_settings")
                    link_text="<i class=\"icon-cog\"></i>"
                    act="link"
                    href="block_manager.update_block?block_data[block_id]=`$block_data.block_id`&ajax_update=1&html_id=`$external_id`&force_close=1"
                    opener_ajax_class="cm-ajax cm-ajax-force cm"
                    link_class="action-properties bm-action-properties"
                    content=""
                }
            {/if}
            {if !$dynamic_object && !$external_render}
                <div class="cm-tooltip cm-action icon-trash pull-right bm-action-delete extra action {if $block_data.single_for_location}bm-block-single-for-location{/if}" title="{__("delete_block")}"></div>
            {/if}
        </div>
        {if !$external_render}
        <div class="bm-compact-menu block-control-menu bm-control-menu {if $parent_grid.width > 2}hidden keep-hidden{/if}">
            <div class="action-showmenu action-control-menu">
                <div class="btn-group action">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='icon-align-justify cm-tooltip' title="{__("editing_block")}"></span></a>
                    <ul class="dropdown-menu droptop">
                        {if $block_data.is_manageable}
                            <li><a class="cm-action bm-action-properties">{__("block_options")}</a></li>
                            <li><a class="cm-action bm-action-delete extra">{__("delete_block")}</a></li>
                        {/if}
                        <li><a class="cm-action bm-action-switch {if $status != "A"}switch-off{/if}">{__("on_off")}<span class="action-switch"></span></a></li>
                    </ul>
                </div>

            </div>
        </div>
        {/if}
<!--snapping_{$block_data.snapping_id}{if $external_render}{$block_data.block_id}_{$external_id}{/if}--></div>
{/if}
