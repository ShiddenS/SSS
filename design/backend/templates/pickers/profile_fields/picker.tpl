{math equation="rand()" assign="rnd"}
{assign var="data_id" value="`$data_id`_`$rnd`"}
{assign var="view_mode" value=$view_mode|default:"mixed"}

{script src="js/tygh/picker.js"}

{if $item_ids && !$item_ids|is_array}
    {assign var="item_ids" value=","|explode:$item_ids}
{/if}

{if $view_mode != "list"}
    <div class="clearfix">
        {if $extra_var}
            {assign var="extra_var" value=$extra_var|escape:url}
        {/if}

        {if !$no_container}<div class="buttons-container pull-right">{/if}{if $picker_view}[{/if}
            {$exclude_names = $exclude_names|default:[]}
            {$include_names = $include_names|default:[]}
            {include file="buttons/button.tpl" but_id="opener_picker_`$data_id`" but_href="profile_fields.picker?section={$section}&exclude_names={","|implode:$exclude_names}&include_names={","|implode:$include_names}&data_id={$data_id}"|fn_url but_text=$but_text|default:__("add_profile_fields") but_role="add" but_target_id="content_`$data_id`" but_meta="btn cm-dialog-opener" but_icon="icon-plus"}
        {if $picker_view}]{/if}{if !$no_container}</div>{/if}
        <div class="hidden" id="content_{$data_id}" title="{$but_text|default:__("add_profile_fields")}">
        </div>
    </div>
{/if}

<input id="pf_{$data_id}_ids" type="hidden" name="{$input_name}" value="{if $item_ids}{","|implode:$item_ids}{/if}" />
<div class="table-wrapper">
    <table class="table table-middle">
        <thead>
            <tr>
                <td width="1%"></td>
                <th width="15%">{__("id")}</th>
                <th width="60%">{__("description")}</th>
                <th width="15%" {if $adjust_requireability === false}class="hidden"{/if}>{__("required")}</th>
                {if !$view_only}<th>&nbsp;</th>{/if}
            </tr>
        </thead>
        <tbody id="{$data_id}"{if !$item_ids} class="hidden"{/if}{if $sortable} data-cm-sortable-profile-fields-picker-container="true" data-ca-sortable-item-class="profile-field-picker__sortable-row" data-ca-data-id="{$data_id}"{/if}>
        {include file="pickers/profile_fields/js.tpl" field_id="`$ldelim`field_id`$rdelim`" description="`$ldelim`description`$rdelim`" holder=$data_id clone=true}
        {foreach $item_ids as $field_id}
            {$profile_field = fn_get_profile_field($field_id)}
            {include file="pickers/profile_fields/js.tpl" field_id=$field_id description=$profile_field.description required=$profile_field.checkout_required holder=$data_id}
        {/foreach}
        </tbody>
        <tbody id="{$data_id}_no_item"{if $item_ids} class="hidden"{/if}>
        <tr class="no-items">
            <td colspan="{if !$view_only}5{else}4{/if}"><p>{$no_item_text|default:__("no_items") nofilter}</p></td>
        </tr>
        </tbody>
    </table>
</div>

{script src="js/tygh/backend/pickers/profile_fields.js"}
