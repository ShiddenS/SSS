{if !$addons.product_page_constructor.license_key}
	<script type="text/javascript">
	Tygh.$(document).ready(function(){$ldelim}
		Tygh.$('#product_page_constructor_activate').trigger('click');
	{$rdelim});
    </script>
{assign var="c_url" value="`$runtime.controller`.`$runtime.mode`"}
<a id="product_page_constructor_activate" class="hidden cm-dialog-opener cm-ajax btn btn-primary" data-ca-target-id="timer_activate_form" title="{__('settings')}: Product page constructor" href="{"addons.update&amp;addon=product_page_constructor&amp;return_url=$c_url"|fn_url}"></a>
{/if}