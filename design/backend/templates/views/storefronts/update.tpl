{$id = $storefront->storefront_id|default:0}

{capture name="mainbox"}
    {capture name="tabsbox"}
        <form id="update_storefront_form_{$id}"
              action="{""|fn_url}"
              method="post"
              name="storefront_update_form"
              class="form-horizontal form-edit cm-disable-empty-files {if $is_form_readonly}cm-hide-inputs{/if}"
        >
            <input type="hidden"
                   name="storefront_data[storefront_id]"
                   value="{$id}"
            />

            <div id="content_general">
                {$url = ""}
                {$status = "StorefrontStatuses::OPEN"|enum}
                {$access_key = ""}
                {$is_default = false}
                {$selected_currencies = []}
                {$selected_languages = []}
                {if $storefront}
                    {$url = $storefront->url}
                    {$status = $storefront->status}
                    {$access_key = $storefront->access_key}
                    {$is_default = $storefront->is_default}
                    {$selected_currencies = $storefront->getCurrencyIds()}
                    {$selected_languages = $storefront->getLanguageIds()}
                {/if}

                {include file="views/storefronts/components/url.tpl"
                    id=$id
                    url=$url
                }

                {include file="views/storefronts/components/is_default.tpl"
                    id=$id
                    is_default=$is_default
                }

                {include file="views/storefronts/components/status.tpl"
                    id=$id
                    status=$status
                }

                {include file="views/storefronts/components/access_key.tpl"
                    id=$id
                    access_key=$access_key
                }

                {include file="views/storefronts/components/currencies.tpl"
                    id=$id
                    selected_currencies=$selected_currencies
                    all_currencies=$all_currencies
                }

                {include file="views/storefronts/components/languages.tpl"
                    id=$id
                    selected_languages=$selected_languages
                    all_languages=$all_languages
                }
            </div>

            <div id="content_regions">
                {$selected_countries = []}
                {$redirect_customer = false}
                {if $storefront}
                    {$selected_countries = $storefront->getCountriesList()}
                    {$redirect_customer = $storefront->redirect_customer}
                {/if}

                {include file="views/storefronts/components/redirect_customer.tpl"
                    id=$id
                    redirect_customer = $redirect_customer
                }

                {include file="views/storefronts/components/regions.tpl"
                    id=$id
                    selected_countries=$selected_countries
                    all_countries=$all_countries
                }
            </div>

            <div id="content_companies">
                {$selected_companies = []}
                {if $storefront}
                    {$selected_companies = $storefront->getCompanyIds()}
                {/if}

                {include file="views/storefronts/components/companies.tpl"
                    id=$id
                    selected_companies=$selected_companies
                }
            </div>
        </form>
    {/capture}

    {include file="common/tabsbox.tpl"
        content=$smarty.capture.tabsbox
        group_name=$runtime.controller
        active_tab=$smarty.request.selected_section
        track=true
    }
{/capture}

{capture name="buttons"}
    {if ($runtime.mode === "add" && $is_storefronts_limit_reached)}
        {$promo_popup_title = __("mve_ultimate_license_required", ["[product]" => $smarty.const.PRODUCT_NAME])}

        {include file="common/tools.tpl"
            tool_override_meta="btn btn-primary cm-dialog-opener cm-dialog-auto-size"
            tool_href="functionality_restrictions.mve_ultimate_license_required"
            prefix="top"
            hide_tools=true
            title=__("add_storefront")
            link_text=__("create")
            icon=" "
            meta_data="data-ca-dialog-title='$promo_popup_title'"
        }
    {else}
        {include file="buttons/save_cancel.tpl"
            but_role="submit-link"
            but_name="dispatch[storefronts.update]"
            but_target_form="update_storefront_form_{$id}"
            save=$id
        }
    {/if}
{/capture}

{if $id}
    {$title_start = __("editing_storefront")}
    {$title_end = $storefront->url}
{else}
    {$title = __("creating_storefront")}
{/if}

{include file="common/mainbox.tpl"
    title_start=$title_start
    title_end=$title_end
    content=$smarty.capture.mainbox
    buttons=$smarty.capture.buttons
}
