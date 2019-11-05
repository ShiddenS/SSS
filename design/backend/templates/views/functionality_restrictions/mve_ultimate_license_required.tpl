{if "MULTIVENDOR"|fn_allowed_for && $store_mode !== "ultimate"}
    <div id="restriction_promo_dialog" class="restriction-promo restriction-promo--ult">

        {__("max_storefronts_reached", [
            "[product]" => $smarty.const.PRODUCT_NAME,
            "[mve_ultimate_license_url]" => $config.resources.mve_ultimate_license_url
        ])}

        <div class="center">
            <a class="restriction-update-btn restriction-update-btn--single"
               href="{$config.resources.mve_ultimate_license_url}"
               target="_blank"
            >{__("upgrade_license")}</a>
        </div>
    </div>
{/if}
