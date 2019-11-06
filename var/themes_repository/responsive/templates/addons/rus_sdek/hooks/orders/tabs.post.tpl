<div id="content_sdek_information" >
{if $data_status}
{foreach from=$data_status item="d_status" key="id"}
    {math equation="id + 1" id=$id assign="shipment_display_id"}
    {include file="common/subheader.tpl" title="{__("shipment")} #`$shipment_display_id`"}
    <table class="ty-orders-detail__table ty-table">
    <thead>
    <tr>
        <th>{__("code")}</th>
        <th>{__("status")}</th>
        <th class="left">{__("date")}</th>
        <th class="left">{__("sdek.lang_city")}<br/></th>
    </tr>
    </thead>

    {foreach from=$d_status item="status"}
    {cycle values=",class=\"table-row\"" name="class_cycle" assign="_class"}
        <tr {$_class} style="vertical-align: top;">
            <td>
                {$status.id} ({$status.shipment_id})
            </td>
            <td class="nowrap">
                {$status.status}
            </td>
            <td class="nowrap">
                {$status.timestamp|date_format:"`$settings.Appearance.date_format`"}
            </td>
            <td class="nowrap">
                {$status.city}
            </td>
        </tr>
    {/foreach}
    </table>
{/foreach}
{/if}
<!--content_sdek_information--></div>