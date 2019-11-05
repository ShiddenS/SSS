{* rus_build_pack dbazhenov *}

{script src="js/addons/rus_payments/assist_payment_url.js"}

<div> 
{__("text_assist_notice")}
</div>
<hr>

<div class="control-group">
    <label class="control-label" for="merchant_id">{__("merchant_id")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][merchant_id]" id="merchant_id" value="{$processor_params.merchant_id}"  size="60">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="login">{__("login")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][login]" id="login" value="{$processor_params.login}"  size="60">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="password">{__("password")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][password]" id="password" value="{$processor_params.password}"  size="60">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="language">{__("language")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][language]" id="language">
            <option value="RU" {if $processor_params.language == "RU"}selected="selected"{/if}>{__("russian")}</option>
            <option value="en" {if $processor_params.language == "en"}selected="selected"{/if}>{__("english")}</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="mode">{__("test_live_mode")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][mode]" id="mode">
            <option value="T" {if $processor_params.mode !== "L"}selected="selected"{/if}>{__("test")}</option>
            <option value="L" {if $processor_params.mode == "L"}selected="selected"{/if}>{__("live")}</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label cm-required"
        for="{if $processor_params.mode !== "L"}payment_url_test{else}payment_url_live{/if}">{__("payment_url")}
        {include file="common/tooltip.tpl" tooltip=__("addons.rus_payments.payment_url")}:
    </label>
    <div class="controls">
        <input type="{if $processor_params.mode !== "L"}text{else}hidden{/if}"
               name="payment_data[processor_params][payment_url_test]" id="payment_url_test"
               value="{$processor_params.payment_url_test}">
        <input type="{if $processor_params.mode == "L"}text{else}hidden{/if}"
               name="payment_data[processor_params][payment_url_live]" id="payment_url_live"
               value="{$processor_params.payment_url_live}">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="order_prefix">{__("order_prefix")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][order_prefix]" id="order_prefix" value="{$processor_params.order_prefix}" >
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="salt">{__("salt")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][salt]" id="salt" value="{$processor_params.salt}" >
    </div>
</div>
