<form action="{""|fn_url}" class="ty-orders-search-options" name="orders_search_form" method="get">

<div class="clearfix">
    {if $auth.user_id}
    <div class="span4 ty-control-group">
        <label class="ty-control-group__title">{__("order_id")}</label>
        <input type="text" name="order_id" value="{$search.order_id}" size="10" class="ty-search-form__input" />
    </div>
    {/if}

    <div class="span4 ty-control-group">
        <label class="ty-control-group__title">{__("total")}&nbsp;({$currencies.$secondary_currency.symbol nofilter})</label>
        <input type="text" name="total_sec_from" value="{$search.total_sec_from}" size="3" class="ty-control-group__price" />&nbsp;&#8211;&nbsp;<input type="text" name="total_sec_to" value="{$search.total_sec_to}" size="3" class="ty-control-group__price" />
    </div>

    {include file="common/period_selector.tpl" period=$search.period form_name="orders_search_form"}
</div>

<hr>

<div class="ty-control-group">
    <label class="ty-control-group__title">{__("order_status")}</label>
    {include file="common/status.tpl" status=$search.status display="checkboxes" name="status" checkboxes_meta="ty-orders-search__options-status"}
</div>

<div class="buttons-container ty-search-form__buttons-container">
    {include file="buttons/button.tpl" but_meta="ty-btn__secondary" but_text=__("search") but_name="dispatch[orders.search]"}
</div>
</form>