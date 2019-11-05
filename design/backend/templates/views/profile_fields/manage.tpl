{capture name="mainbox"}

    {assign var="update_link_text" value=__("edit")}
    {if ""|fn_check_form_permissions}
        {assign var="update_link_text" value=__("view")}
        {assign var="hide_inputs" value="cm-hide-inputs"}
    {/if}
    <form action="{""|fn_url}" method="post" name="fields_form" class="{$hide_inputs}">
        <input type="hidden" name="profile_type" value="{$profile_type}"/>
        {math equation = "x + 5" assign="_colspan" x=$profile_fields_areas|sizeof}

        {if $profile_fields}
        {$check_items_col_width = 5}
        {$position_col_width = 10}
        {$description_col_width = 30}
        {$type_col_width = 10}
        {$tools_col_width = 5}
        {$total_width = $check_items_col_width + $position_col_width + $description_col_width + $type_col_width + $tools_col_width}
        {$rest_width = 100 - $total_width}
        {$area_col_width = $rest_width / $profile_types[$profile_type]["allowed_areas"]|count}
        <div class="table-responsive-wrapper" id="profile_fields">
            <table width="100%" class="table table-middle table-responsive">
                <thead>
                <tr>
                    <th class="mobile-hide" width="{$check_items_col_width}%">
                        {include file="common/check_items.tpl"}</th>
                    <th width="{$position_col_width}%">{__("position_short")}</th>
                    <th width="{$description_col_width}%">{__("description")}</th>
                    <th width="{$type_col_width}%">{__("type")}</th>
                    {foreach $profile_types[$profile_type]["allowed_areas"] as $area}
                        <th class="center" width="{$area_col_width}%">
                            {__($area)}<br/>{__("show")}&nbsp;/&nbsp;{__("required")}
                        </th>
                    {/foreach}
                    <th class="mobile-hide" width="{$tools_col_width}%">&nbsp;</th>
                </tr>
                </thead>
            </table>
            {foreach from=$profile_fields key=section item=fields name="profile_fields"}
            <table width="100%" class="table table-middle table-responsive profile-fields__section">
                {if $section != "ProfileFieldSections::ESSENTIALS"|enum}
                    <input class="js-profile-field-position" type="hidden" name="profile_field_sections[{$profile_fields_sections[$section]["section_id"]}][position]" value="{$profile_fields_sections[$section]["position"]}" />
                    {$is_deprecated = $profile_fields_sections[$section]["status"] == "ProfileFieldSections::STATUS_DEPRECATED"|enum}
                    <tr>
                        <td colspan="{$_colspan}" class="row-header">
                            <h5>
                                <span alt="{__("expand_section")}" title="{__("expand_section")}" id="on_section_fields_{$section}" class="cm-combination {if !$is_deprecated}hidden{/if}"><span class="icon-caret-right"> </span></span>
                                <span alt="{__("collapse_section")}" title="{__("collapse_section")}" id="off_section_fields_{$section}" class="cm-combination{if $is_deprecated} hidden{/if}"><span class="icon-caret-down"> </span></span>
                                {$profile_fields_sections[$section]["section_name"]}
                                {if $is_deprecated}
                                    ({__("deprecated")|lower})
                                {/if}
                            </h5>
                        </td>
                    </tr>
                    <tbody id="section_fields_{$section}" {if $is_deprecated}class="hidden"{/if}>
                    {foreach from=$fields item=field}
                        <tr data-ca-profile-fields-row="{$field.field_name}" data-ca-profile-fields-section="{$section}">
                            <td class="center mobile-hide" width="{$check_items_col_width}%">
                                {if $section != "ProfileFieldSections::BILLING_ADDRESS"|enum && $field.is_default != "Y"}
                                    {assign var="extra_fields" value=true}
                                    {assign var="custom_fields" value=true}
                                    {if $field.matching_id}
                                        <input type="hidden" name="matches[{$field.matching_id}]" value="{$field.field_id}"/>
                                    {/if}
                                    <input type="checkbox" name="field_ids[]" value="{$field.field_id}" class="cm-item"/>
                                {/if}
                            </td>
                            <td data-th="{__("position_short")}" width="{$position_col_width}%">
                                <input class="input-micro input-hidden" type="text" size="3" name="fields_data[{$field.field_id}][position]" value="{$field.position}"/>
                            </td>
                            <td data-th="{__("description")}" width="{$description_col_width}%">
                                <a href="{"profile_fields.update?field_id=`$field.field_id`"|fn_url}" data-ct-field-section="{$section}">{$field.description}</a>
                            </td>
                            <td class="nowrap" data-th="{__("type")}" width="{$type_col_width}%">
                                {hook name="profile_fields:field_type_description"}
                                {if $field.field_type == "{"ProfileFieldTypes::CHECKBOX"|enum}"}{__("checkbox")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::INPUT"|enum}"}{__("input_field")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::RADIO"|enum}"}{__("radiogroup")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::SELECT_BOX"|enum}"}{__("selectbox")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::TEXT_AREA"|enum}"}{__("textarea")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::DATE"|enum}"}{__("date")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::EMAIL"|enum}"}{__("email")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::POSTAL_CODE"|enum}"}{__("zip_postal_code")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::PHONE"|enum}"}{__("phone")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::COUNTRY"|enum}"}<a href="{"countries.manage"|fn_url}" class="underlined">{__("country")}&nbsp;&rsaquo;&rsaquo;</a>
                                {elseif $field.field_type == "{"ProfileFieldTypes::STATE"|enum}"}<a href="{"states.manage"|fn_url}" class="underlined">{__("state")}&nbsp;&rsaquo;&rsaquo;</a>
                                {elseif $field.field_type == "{"ProfileFieldTypes::ADDRESS_TYPE"|enum}"}{__("address_type")}
                                {elseif $field.field_type == "{"ProfileFieldTypes::VENDOR_TERMS"|enum}"}{__("vendor_terms")}
                                {/if}
                                {/hook}
                                <input type="hidden" name="fields_data[{$field.field_id}][field_id]" value="{$field.field_id}"/>
                                <input type="hidden" name="fields_data[{$field.field_id}][field_name]" value="{$field.field_name}"/>
                                <input type="hidden" name="fields_data[{$field.field_id}][section]" value="{$section}"/>
                                <input type="hidden" name="fields_data[{$field.field_id}][matching_id]" value="{$field.matching_id}"/>
                                <input type="hidden" name="fields_data[{$field.field_id}][field_type]" value="{$field.field_type}"/>
                            </td>

                            {foreach $profile_types[$profile_type]["allowed_areas"] as $area}
                                {$_show = "`$area`_show"}
                                {$_required = "`$area`_required"}
                                <td class="center" data-th="{__($area)} ({__("show")} / {__("required")})" data-ca-profile-fields-area-group="{$area}" width="{$area_col_width}%">
                                    {hook name="profile_fields:field_settings"}
                                    <input type="hidden" name="fields_data[{$field.field_id}][{$_show}]" value="N"/>
                                    {if $field.field_name == "company" && $field.profile_type == "ProfileTypes::CODE_SELLER"|enum}
                                        <input type="radio" name="fields_data[{$field.field_id}][{$_show}]" value="Y" {if $field.$_show == "Y"}checked="checked"{/if} id="sw_req_{$area}_{$field.field_id}" class="cm-switch-availability"/>
                                    {else}
                                        <input type="checkbox" name="fields_data[{$field.field_id}][{$_show}]" value="Y" {if $field.$_show == "Y"}checked="checked"{/if} id="sw_req_{$area}_{$field.field_id}" class="cm-switch-availability" data-ca-profile-fields-area="{$area}"/>
                                    {/if}
                                    <input type="hidden" name="fields_data[{$field.field_id}][{$_required}]" value="{if $field.field_name == "company" && $field.profile_type == "ProfileTypes::CODE_SELLER"|enum}Y{else}N{/if}"/>
                                    <span id="req_{$area}_{$field.field_id}">
                                        <input type="checkbox" name="fields_data[{$field.field_id}][{$_required}]" value="Y" {if $field.$_required == "Y"}checked="checked"{/if} {if $field.$_show == "N" || ($field.field_name == "company" && $field.profile_type == "ProfileTypes::CODE_SELLER"|enum)}disabled="disabled"{/if} data-ca-profile-fields-area="{$area}"/>
                                    </span>
                                    {/hook}
                                </td>
                            {/foreach}
                            <td class="nowrap mobile-hide" width="{$tools_col_width}%">
                                {capture name="tools_list"}
                                    {if $custom_fields}
                                        <li>{btn type="list" text=__("delete") class="cm-confirm" href="profile_fields.delete?field_id=`$field.field_id`&profile_type={$profile_type}" method="POST"}</li>
                                    {/if}
                                    <li>{btn type="list" text=$update_link_text href="profile_fields.update?field_id=`$field.field_id`"|fn_url}</li>
                                {/capture}
                                <div class="hidden-tools">
                                    {dropdown content=$smarty.capture.tools_list}
                                </div>
                            </td>
                        </tr>
                        {assign var="custom_fields" value=false}
                    {/foreach}
                    </tbody>
                {/if}
                {/foreach}
            </table>
            {else}
            <p class="no-items">{__("no_items")}</p>
            {/if}
        </div>
    </form>
    {capture name="adv_buttons"}
        {include file="common/tools.tpl" tool_href="profile_fields.add{if $profile_type}?profile_type={$profile_type}{/if}" prefix="top" title=__("add_field") hide_tools=true icon="icon-plus"}
    {/capture}

    {capture name="buttons"}
        {if $extra_fields}
            {capture name="tools_list"}
                <li>{btn type="delete_selected" dispatch="dispatch[profile_fields.m_delete]" form="fields_form"}</li>
            {/capture}
            {dropdown content=$smarty.capture.tools_list}
        {/if}
        {if $profile_fields}
            {include file="buttons/save.tpl" but_name="dispatch[profile_fields.m_update]" but_role="action" but_target_form="fields_form" but_meta="cm-submit"}
        {/if}
    {/capture}
{/capture}

{script src="js/tygh/backend/profile_fields.js"}

{include file="common/mainbox.tpl" title=__("profile_fields") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons adv_buttons=$smarty.capture.adv_buttons select_languages=true}