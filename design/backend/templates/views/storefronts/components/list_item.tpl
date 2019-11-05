{*
\Tygh\Storefront\Storefront $storefront             Storefront item to display
string                      $return_url             URL to redirect to after storefront status is changed or storefront is deleted
string                      $select_mode            Storefront selection mode: multiple for checkobes, single for radio
bool                        $force_selector_display Whether storefront selector (checkbox/radio) must be displayed.
                                                    By default, it's hidden on mobile
bool                        $get_company_ids        Whether to get storefront company IDs
bool                        $get_language_ids       Whether to get storefront language IDs
bool                        $get_currency_ids       Whether to get storefront currency IDs
bool                        $get_country_codes      Whether to get storefront county codes
*}
<tr class="storefront"
    data-ca-storefront-id="{$storefront->storefront_id}"
    {if $get_company_ids}
        data-ca-storefront-company-ids="{$storefront->getCompanyIds()|json_encode}"
    {/if}
    {if $get_language_ids}
        data-ca-storefront-language-ids="{$storefront->getLanguageIds()|json_encode}"
    {/if}
    {if $get_currency_ids}
        data-ca-storefront-currency-ids="{$storefront->getCurrencyIds()|json_encode}"
    {/if}
    {if $get_country_codes}
        data-ca-storefront-country-codes="{$storefront->getCountryCodes()|json_encode}"
    {/if}
>
    <td data-th=""
        class="center {if !$force_selector_display}mobile-hide{/if}"
    >
        {if $select_mode == "multiple"}
            <input type="checkbox"
                   name="storefront_ids[{$storefront->storefront_id}]"
                   value="{$storefront->storefront_id}"
                   class="cm-item storefront__selector storefront__selector--multiple"
            />
        {elseif $select_mode == "single"}
            <input type="radio"
                   name="storefront_id"
                   value="{$storefront->storefront_id}"
                   class="cm-item storefront__selector storefront__selector--single"
            />
        {else}
            &nbsp;
        {/if}
    </td>

    <td data-th="{__("url")}">
        <a class="storefront__name"
           href="{"storefronts.update?storefront_id={$storefront->storefront_id}"|fn_url}"
        >{$storefront->url}</a>
        {if $storefront->is_default}
            <span class="muted">({__("default_storefront")})</span>
        {/if}
    </td>

    <td width="5%" class="nowrap" data-th="{__("tools")}">
        {capture name="tools_items"}
            {hook name="orders:list_extra_links"}
                <li>
                    {btn type="list"
                        href="storefronts.update?storefront_id={$storefront->storefront_id}"
                        text=__("edit")
                    }
                </li>
            {if !$storefront->is_default}
                <li>
                    {btn type="list"
                        href="storefronts.delete?storefront_id={$storefront->storefront_id}&redirect_url={$return_url}"
                        class="cm-confirm"
                        text={__("delete")}
                        method="POST"
                    }
                </li>
            {/if}
            {/hook}
        {/capture}
        <div class="hidden-tools">
            {dropdown content=$smarty.capture.tools_items}
        </div>
    </td>

    <td width="10%" class="right" data-th="{__("storefront_status")}">
        {include file="common/switcher.tpl"
            meta = "company-switch-storefront-status-button storefront__status"
            checked = $storefront->status == "StorefrontStatuses::OPEN"|enum
            extra_attrs = [
                "data-ca-submit-url" => 'storefronts.update_status',
                "data-ca-storefront-id" => $storefront->storefront_id,
                "data-ca-opened-status" => {"StorefrontStatuses::OPEN"|enum},
                "data-ca-closed-status" => {"StorefrontStatuses::CLOSED"|enum},
                "data-ca-return-url" => $return_url
            ]
        }
    </td>
</tr>
