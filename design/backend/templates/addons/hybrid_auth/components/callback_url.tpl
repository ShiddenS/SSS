{$protocol = ($settings.Security.secure_storefront == "none") ? "http" : "https"}
{$provider_name = $providers_schema[$provider]['provider']}
{$provider = $providers_schema[$provider]}
<div class="control-group">
    <label class="control-label">{$label|default:{__('hybrid_auth.callback_url')}}: </label>
    <div class="controls">
        <input type="text"
               class="span8"
               readonly="readonly"
               value="{"auth.process?hauth_done={$provider_name}"|fn_url:"C":$protocol}"
               onclick="this.select()"
        />
    </div>
</div>
