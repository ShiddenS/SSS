{*
array  $id         Storefront ID
string $status     Storefront status
string $input_name Input name
*}

{$input_name = $input_name|default:"storefront_data[status]"}

<div class="control-group">
    <label for="status_{$id}"
           class="control-label"
    >
        {__("storefront_status")}
        {include file="common/tooltip.tpl"
            tooltip=__("ttc_stores_status")
        }
    </label>
    <div class="controls">
        <input type="hidden"
               name="{$input_name}"
               value="{"StorefrontStatuses::CLOSED"|enum}"
        />

        {include file="common/switcher.tpl"
            checked=$status === "StorefrontStatuses::OPEN"|enum
            input_name="{$input_name}"
            input_value="StorefrontStatuses::OPEN"|enum
            input_id="status_{$id}"
        }

        <p>
            {__("storefront_status.tooltip")}
        </p>
    </div>
</div>
