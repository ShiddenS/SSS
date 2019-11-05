<div id="qb_token_section">
<input type="hidden" name="payment_data[processor_params][oauth_client_id]"     value="{$processor_params.oauth_client_id}" />
<input type="hidden" name="payment_data[processor_params][oauth_client_secret]" value="{$processor_params.oauth_client_secret}" />
<input type="hidden" name="payment_data[processor_params][realm_id]"            value="{$processor_params.realm_id}" />
<input type="hidden" name="payment_data[processor_params][token_expire_time]"   value="{$processor_params.token_expire_time}" />
<input type="hidden" name="payment_data[processor_params][refresh_token]"   value="{$processor_params.refresh_token}" />
<input type="hidden" name="payment_data[processor_params][access_token]"   value="{$processor_params.access_token}" />

{if $processor_params.oauth_client_id && $processor_params.oauth_client_secret}
    <div class="control-group">
        <label class="control-label" for="elm_oauth_token">{__("payments.qbms.quickbooks_connection")}:</label>
        <div class="controls">
            <ipp:connectToIntuit></ipp:connectToIntuit>
            <div class="help-inline">
            {if $processor_params.token_expire_time > $smarty.const.TIME}
                {__("payments.qbms.token_expires", [
                    "[date]" => $processor_params.token_expire_time|fn_date_format:$settings.Appearance.date_format,
                    "[time]" => $processor_params.token_expire_time|fn_date_format:$settings.Appearance.time_format
                ])}
                {if $processor_params.token_expire_time - $smarty.const.TIME < 30 * $smarty.const.SECONDS_IN_DAY}
                    {__("payments.qbms.renew_token")}
                {/if}
            {elseif $processor_params.token_expire_time}
                {__("payments.qbms.token_expired")}
                {__("payments.qbms.renew_token")}
            {/if}
            </div>
            <script type="application/javascript">
                (function(_, $) {
                    $.ceEvent('on', 'ce.commoninit', function() {
                        if (window.isQuickbooksSdkLoaded) {
                            return;
                        }
                        window.isQuickbooksSdkLoaded = true;
                        var quickbooksSdk = 'https://appcenter.intuit.com/Content/IA/intuit.ipp.anywhere.js?v=' + Math.random();
                        var sdkScript = document.createElement('script');
                        sdkScript.type = 'application/javascript';
                        sdkScript.src = quickbooksSdk;

                        var sdkLoadCallback = function() {
                            intuit.ipp.anywhere.setup({
                                menuProxy: '',
                                datasources: {
                                    quickbooks: true,
                                    payments: true
                                },
                                grantUrl: "{"current"|fn_payment_url:"qbms.php"}?qb_action=auth_start&payment_id={$payment_id}"
                            });

                            $(document).on('click', '.intuitPlatformConnectButton', function (e) {
                                // destroy and remove pop-up
                                var dialog = $.ceDialog('get_last');
                                dialog.ceDialog('destroy');
                                dialog.remove();
                            });
                        };

                        sdkScript.onreadystatechange = function() {
                            if (this.readyState === 'complete') {
                                sdkLoadCallback();
                            }
                        };
                        sdkScript.onload = sdkLoadCallback;

                        document.getElementsByTagName('head')[0].appendChild(sdkScript);
                    });
                })(Tygh, Tygh.$);
            </script>
        </div>
    </div>
    {__("payments.qbms.tip_fill_redirect", ["[url]" => "{"current"|fn_payment_url:"qbms.php"}?qb_action=auth_callback&payment_id={$payment_id}"])}
{else}
    {__("payments.qbms.configure_payment_method", ["[product]" => $smarty.const.PRODUCT_NAME])}
{/if}
<!--qb_token_section--></div>
<hr>

<div class="control-group">
    <label class="control-label" for="elm_oauth_client_id">{__("payments.qbms.oauth_client_id")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][oauth_client_id]" id="elm_oauth_client_id" value="{$processor_params.oauth_client_id}" />
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="elm_oauth_client_secret">{__("payments.qbms.oauth_client_secret")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][oauth_client_secret]" id="elm_oauth_client_secret" value="{$processor_params.oauth_client_secret}" />
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="mode">{__("test_live_mode")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][mode]" id="mode">
            <option value="test" {if $processor_params.mode == "test"}selected="selected"{/if}>{__("test")}</option>
            <option value="live" {if $processor_params.mode == "live"}selected="selected"{/if}>{__("live")}</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="order_prefix">{__("order_prefix")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][order_prefix]" id="order_prefix" value="{$processor_params.order_prefix}" >
    </div>
</div>