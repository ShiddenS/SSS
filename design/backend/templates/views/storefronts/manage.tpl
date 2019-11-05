{*
\Tygh\Storefront\Storefront[] $storefronts                  Storefronts list
array                         $search                       Storefronts search parameters
bool                          $is_storefronts_limit_reached Whether new storefronts can be created
array                         $config                       Runtime configuration
*}
{capture name="mainbox"}
    <form action="{""|fn_url}"
          method="post"
          name="storefronts_list_form"
          class="{if ""|fn_check_form_permissions}cm-hide-inputs{/if}"
    >

        {include file="common/pagination.tpl"
            save_current_page=true
            save_current_url=true
        }

        {include file="views/storefronts/components/list.tpl"
            storefronts = $storefronts
            search = $search
            sort_url = $config.current_url|fn_query_remove:"sort_by":"sort_order"
            sort_active_icon_class = "<i class='icon-{$search.sort_order_rev}'></i>"
            sort_dummy_icon_class = "<i class='icon-dummy'></i>"
            return_url = fn_url($config.current_url)|escape:url
            is_readonly = false
            select_mode = "multiple"
        }

        {include file="common/pagination.tpl"}
    </form>
{/capture}

{capture name="buttons"}
    {capture name="tools_list"}
        {hook name="storefronts:manage_tools_list"}
        {if $storefronts}
            <li>
                {btn type="list"
                    text=__("open_selected_storefronts")
                    dispatch="dispatch[storefronts.m_open]"
                    form="storefronts_list_form"
                    class="cm-process-items cm-submit cm-confirm"
                }
            </li>
            <li>
                {btn type="list"
                    text=__("close_selected_storefronts")
                    dispatch="dispatch[storefronts.m_close]"
                    form="storefronts_list_form"
                    class="cm-process-items cm-submit cm-confirm"
                }
            </li>
            <li>
                {btn type="delete_selected"
                    text=__("delete_selected")
                    dispatch="dispatch[storefronts.m_delete]"
                    form="storefronts_list_form"
                }
            </li>
        {/if}
        {/hook}
    {/capture}
    {dropdown content=$smarty.capture.tools_list class="mobile-hide"}
{/capture}

{capture name="adv_buttons"}
    {if $is_storefronts_limit_reached}
        {$promo_popup_title = __("mve_ultimate_license_required", ["[product]" => $smarty.const.PRODUCT_NAME])}

        {include file="common/tools.tpl"
            tool_override_meta="btn cm-dialog-opener cm-dialog-auto-size"
            tool_href="functionality_restrictions.mve_ultimate_license_required"
            prefix="top"
            hide_tools=true
            title=__("add_storefront")
            icon="icon-plus"
            meta_data="data-ca-dialog-title='$promo_popup_title'"
        }
    {else}
        {include file="common/tools.tpl"
            tool_href="storefronts.add"
            prefix="top"
            title=__("add_storefront")
            hide_tools=true
            icon="icon-plus"
        }
    {/if}
{/capture}

{capture name="sidebar"}
    {hook name="storefronts:manage_sidebar"}
        {include file="views/storefronts/components/search_form.tpl"
            dispatch="storefronts.manage"
            search=$search
            in_popup=false
        }
    {/hook}
{/capture}

{include file="common/mainbox.tpl"
    title=__("storefronts")
    content=$smarty.capture.mainbox
    tools=$smarty.capture.tools
    buttons=$smarty.capture.buttons
    adv_buttons=$smarty.capture.adv_buttons
    sidebar=$smarty.capture.sidebar
}
