
{foreach from=$items item="item"}
    <div class="table-wrapper">
        <table class="table table-middle table-tree hidden-inputs">
        {if $items|count == 0}
            <thead>
            <tr>
                <th class="left" width="5%"></th>
                <th width="10%">{__("position_short")}</th>
                <th width="65%">
                    &nbsp;{__("name")}
                </th>
                <th width="10%">&nbsp;</th>
                <th width="10%" class="center">{__("status")}</th>
            </tr>
            </thead>
        {/if}
        {if $header}
            {assign var="header" value=""}
            <thead>
            <tr>
                <th class="left" width="5%">
                    {include file="common/check_items.tpl"}
                </th>
                <th width="10%">{__("position_short")}</th>
                <th width="65%">
                    <div class="pull-left">
                    <span class="hand cm-combinations cm-tooltip" title="{__("expand_collapse_list")}" id="on_item">
                        <span class="icon-caret-right"></span>
                    </span>
                    <span class="hand cm-combinations hidden cm-tooltip" title="{__("expand_collapse_list")}" id="off_item">
                        <span class="icon-caret-down"></span>
                    </span>
                    </div>
                    &nbsp;{__("name")}
                </th>
                <th width="10%">&nbsp;</th>
                <th width="10%" class="center">{__("status")}</th>
            </tr>
            </thead>
        {/if}
        <tr class="{if $item.level > 0}multiple-table-row{/if} cm-row-item cm-row-status-{$item.status|lower}">
            <td class="left" width="5%">
                <input type="checkbox" name="static_data_ids[]" value="{$item.param_id}" class="cm-item">
            </td>
            <td width="10%">
                <input type="text" name="static_data[{$item.param_id}][position]" value="{$item.position}" size="3" class="input-micro input-hidden">
            </td>
            <td width="65%">
            <span style="padding-{$direction}: {math equation="x*14" x=$item.level|default:0}px;" class="table-elem">
                {if $item.subitems}
                    <span class="hand cm-combination cm-tooltip" id="on_item_{$item.param_id}" title="{__("expand_sublist_of_items")}">
                        <span class="icon-caret-right"></span>
                    </span>
                    <span class="hand cm-combination hidden cm-tooltip" id="off_item_{$item.param_id}" title="{__("collapse_sublist_of_items")}">
                        <span class="icon-caret-down"></span>
                    </span>
                {else}
                    &nbsp;&nbsp;&nbsp;
                {/if}
                <a class="cm-external-click" data-ca-external-click-id="{"opener_group`$item.param_id`"}">{$item.descr}</a>
            </span>
            </td>
            <td class="nowrap" width="10%">
                <div class="pull-right hidden-tools">
                    {capture name="tools_list"}
                        <li>{include file="common/popupbox.tpl" act="edit" title_start=__($section_data.edit_title) title_end=$item.descr link_text=__("edit") id="group`$item.param_id`" link_class="tool-link" no_icon_link=true href="static_data.update?param_id=`$item.param_id`&section=`$section`&`$owner_condition`"}</li>
                        <li>{btn type="list" text=__("delete") href="static_data.delete?param_id=`$item.param_id`&section=`$section`&`$owner_condition`" class="cm-confirm cm-ajax cm-delete-row"  data=['data-ca-target-id'=>'static_data_list'] method="POST"}</li>
                    {/capture}
                    {dropdown content=$smarty.capture.tools_list}
                </div>
            </td>
            <td class="right" width="10%">
                {include file="common/select_popup.tpl" id=$item.param_id status=$item.status hidden=true object_id_name="param_id" table="static_data"}
            </td>
        </tr>
        </table>
    </div>
    {if $item.subitems}
        <div id="item_{$item.param_id}" class="hidden">
            {include file="views/static_data/components/multi_list.tpl"
                items=$item.subitems
                header=false
                direction=$direction
            }
        </div>
    {/if}
{/foreach}