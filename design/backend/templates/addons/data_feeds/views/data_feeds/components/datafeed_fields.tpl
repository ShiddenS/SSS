<script type="text/javascript">
//<![CDATA[
    (function(_, $) {
        $(_.doc).on('change', '.cm-export-fields', function() {
            var elm_value = $(this).val();
            var elm_class = $("option[value='" + elm_value + "']").attr("class");
            if (elm_class == 'cm-google-option') {
                fn_alert($("#text_info_setting_options").val());
            }
        });
    })(Tygh, Tygh.$);
//]]>
</script>

<div id="field_list">
{assign var="key" value="0"}
<input type="hidden" id="text_info_setting_options" {if $addons.google_export.status == 'A'}value='{__("addons.google_export.text_info_setting_options")}'}{else}value=""{/if} />

<div class="table-responsive-wrapper">
    <table class="table">
    <thead class="cm-first-sibling">
    <tr>
        <th>{__("position_short")}</th>
        <th>{__("field_name")} {include file="common/tooltip.tpl" tooltip=__("data_feeds.text_tooltip_field_name")}</th>
        <th>{__("field_type")} {include file="common/tooltip.tpl" tooltip=__("data_feeds.text_tooltip_field_type")}</th>
        <th class="center">{__("active")}</th>
        <th>&nbsp;</th>
    </tr>
    </thead>

    <tbody>
    {if $datafeed_data.fields}
    {foreach from=$datafeed_data.fields item="field" key="key"}
    <tr class="cm-row-item">
        <td>
            <input type="text" name="datafeed_data[fields][{$key}][position]" value="{$field.position|default:"0"}" class="input-mini">
        </td>
        <td>
            <input type="text" name="datafeed_data[fields][{$key}][export_field_name]" value="{$field.export_field_name}" size="60">
        </td>
        <td>
            {if $export_fields}
                <select class="cm-export-fields " id="export_fields" name="datafeed_data[fields][{$key}][field]">
                    <optgroup label="{__("fields")}">
                    {foreach from=$export_fields item="params" key="_field"}
                        <option {if $field.field == $_field}selected="selected"{/if} value="{$_field}">{$_field}</option>
                    {/foreach}
                    </optgroup>

                    {if $feature_fields}
                        <optgroup label="{__("features")}">
                        {foreach from=$feature_fields item="params" key="_field"}
                            <option {if $field.field == $_field}selected="selected"{/if} value="{$_field}">{$params.description}</option>
                        {/foreach}
                        </optgroup>
                    {/if}

                    {if $export_options}
                        <optgroup label="{__("options")}">
                        {foreach from=$export_options item="params" key="_field"}
                            <option class="{$params.option_class}" {if $field.field == $_field}selected="selected"{/if} value="{$_field}">{$_field}</option>
                        {/foreach}
                        </optgroup>
                    {/if}
                </select>
            {else}
                <input type="text" value="" />
            {/if}
        </td>

        <td class="center" data-th="{__("active")}">
            <input type="hidden" name="datafeed_data[fields][{$key}][avail]" value="N" />
            <input type="checkbox" name="datafeed_data[fields][{$key}][avail]" value="Y" {if $field.avail == "Y"}checked="checked"{/if} /></td>

        <td data-th="">{include file="buttons/clone_delete.tpl" microformats="cm-delete-row" no_confirm=true}</td>
    </tr>
    {/foreach}
    {/if}

    {math equation="x + 1" x=$key assign="key"}

    <tr id="box_add_datafeed_fields">
        <td data-th="{__("position_short")}">
            <input type="text" name="datafeed_data[fields][{$key}][position]" value="" class="input-mini">
        </td>
        <td data-th="{__("field_name")}">
            <input type="text" name="datafeed_data[fields][{$key}][export_field_name]" value="" size="60"></td>
        <td data-th="{__("field_type")}">
            {if $export_fields}
                <select class="cm-export-fields " id="export_fields" name="datafeed_data[fields][{$key}][field]">
                    <optgroup label="{__("fields")}">
                    {foreach from=$export_fields item="params" key="_field"}
                        <option value="{$_field}">{$_field}</option>
                    {/foreach}
                    </optgroup>

                    {if $feature_fields}
                        <optgroup label="{__("features")}">
                        {foreach from=$feature_fields item="params" key="_field"}
                            <option value="{$_field}">{$params.description}</option>
                        {/foreach}
                        </optgroup>
                    {/if}

                    {if $export_options}
                        <optgroup label="{__("options")}">
                        {foreach from=$export_options item="params" key="_field"}
                            <option class="{$params.option_class}" {if $field.field == $_field}selected="selected"{/if} value="{$_field}">{$_field}</option>
                        {/foreach}
                        </optgroup>
                    {/if}
                </select>
            {/if}
        </td>

        <td class="center" data-th="{__("active")}">
            <input type="hidden" name="datafeed_data[fields][{$key}][avail]" value="N" />
            <input type="checkbox" name="datafeed_data[fields][{$key}][avail]" value="Y" checked="checked" />
        </td>

        <td>
            {include file="buttons/multiple_buttons.tpl" item_id="add_datafeed_fields"}
        </td>
    </tr>
    </tbody>
    </table>
</div>
<!--field_list--></div>