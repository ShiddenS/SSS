{if !$location.location_id}
    {assign var="html_id" value="0"}
{else}
    {assign var="html_id" value=$location.location_id}
{/if}

<form action="{""|fn_url}" method="post" enctype="multipart/form-data" class=" form-horizontal" name="location_{$html_id}_update_form">
<div id="location_properties_{$html_id}">
    <input type="hidden" id="s_layout" name="s_layout" value="{$location.layout_id}" />
    <input type="hidden" name="result_ids" value="location_properties_{$html_id}" class="cm-no-hide-input"/>
    <input type="hidden" name="location" value="{$location.location_id}" />
    <input type="hidden" name="location_data[location_id]" value="{$location.location_id}" />
    <input type="hidden" name="return_url" value="product_page_constructor.manage" />

    <div class="tabs cm-j-tabs">
        <ul class="nav nav-tabs">
            <li id="location_general_{$html_id}" class="cm-js active"><a>{__("general")}</a></li>
            {if $dynamic_object_scheme}
                <li id="location_object_{$dynamic_object_scheme.object_type}" class="cm-js"><a>{__($dynamic_object_scheme.object_type)}</a></li>
            {/if}
        </ul>
    </div>

    <div class="cm-tabs-content" id="tabs_content_location_{$html_id}">
        <div id="content_location_general_{$html_id}">
                <div class="control-group hidden">
                    <label for="location_dispatch_{$html_id}" class="cm-required control-label">{__("dispatch")}: </label>
                    <div class="controls">
                        <input id="location_dispatch_{$html_id}" class="input-text{if $not_custom_dispatch} input-text-disabled{/if}" {if $not_custom_dispatch}disabled{/if} name="location_data[dispatch]" value="product_page" type="hidden"></div>
                </div>
                <div class="control-group">
                    <label for="location_name" class="cm-required control-label">{__("name")}: </label>
                    <div class="controls">
                        <input id="location_name" type="text" name="location_data[name]" value="{$location.name}">
                    </div>
                </div>

                <div class="control-group">
                    <label for="location_position" class="control-label">{__("position")}: </label>
                    <div class="controls">
                        <input id="location_position" type="text" name="location_data[position]" value="{$location.position}">
                    </div>
                </div>
        </div>
        {if $dynamic_object_scheme}
            <div id="content_location_object_{$dynamic_object_scheme.object_type}">
                {include_ext
                    file=$dynamic_object_scheme.picker 
                        data_id="location_`$html_id`_object_ids"
                        input_name="location_data[object_ids]"
                        item_ids=$location.object_ids
                        view_mode="links"
                        params_array=$dynamic_object_scheme.picker_params
                        start_pos=$start_position
                    }
            </div>
        {/if}
    </div>
<!--location_properties_{$html_id}--></div>
<div class="buttons-container">
    {if !$location.is_default && $location.location_id > 0}
        <div class="botton-picker-remove pull-left">
            {assign var="c_url" value='product_page_constructor.manage'}
            <a class="cm-confirm cm-post btn cm-tooltip" href="{"block_manager.delete_location?location_id=`$location.location_id`&return_url=`$c_url`"|fn_url}" title="Remove current location">
                <i class="icon-trash"></i>
            </a>
        </div>
    {/if}
    {include file="buttons/save_cancel.tpl" but_name="dispatch[block_manager.update_location]" cancel_action="close" save=$html_id}
</div>
</form>
