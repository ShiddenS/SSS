{if "THEMES_PANEL"|defined}
    {$sticky_top = -5}
    {$sticky_padding = 35}
{else}
    {$sticky_top = -40}
    {$sticky_padding = 0}
{/if}

{function menu_attrs attrs=[]}
    {foreach $attrs as $attr => $value}
        {$attr}="{$value}"
    {/foreach}
{/function}
<div class="navbar-admin-top cm-sticky-scroll" data-ca-stick-on-screens="sm-large,md,md-large,lg,uhd" data-ca-top="{$sticky_top}" data-ca-padding="{$sticky_padding}">
    <!--Navbar-->
    <div class="navbar navbar-inverse mobile-hidden" id="header_navbar">
        <div class="navbar-inner{if $runtime.is_current_storefront_closed || $runtime.are_all_storefronts_closed} navbar-inner--disabled{/if}">
        {if $runtime.company_data.company}
            {$name = $runtime.company_data.company}
        {else}
            {$name = $settings.Company.company_name}
        {/if}

        {if "ULTIMATE"|fn_allowed_for}
            {if $runtime.is_current_storefront_closed || $runtime.are_all_storefronts_closed}
                {$storefront_status_icon = "icon-lock"}
            {elseif $runtime.have_closed_storefronts}
                {$storefront_status_icon = "icon-unlock-alt"}
            {/if}

            <div class="nav-ult">
                {hook name="menu:storefront_icon"}
                    {if !$runtime.company_data.company_id}
                        {$name = __("all_vendors")}
                    {/if}
                <li class="nav-company">
                {if $runtime.company_data.storefront}
                    {$storefront_url = fn_url("profiles.act_as_user?user_id={$auth.user_id}&area=C")}
                    <a href="{$storefront_url}" target="_blank" class="brand" title="{__("view_storefront")}">
                        <i class="icon-shopping-cart icon-white"></i>
                    </a>
                {else}
                    <a class="brand" title="{__("storefront_url_not_defined")}"><i class="icon-shopping-cart icon-white cm-tooltip"></i></a>
                {/if}
                </li>
                {/hook}
                {if $runtime.companies_available_count > 1}
                    <ul class="nav">
                    {capture name="extra_content"}
                        {if fn_check_view_permissions("companies.manage", "GET")}
                            <li class="divider"></li>
                            <li><a href="{"companies.manage?switch_company_id=0"|fn_url}">{__("manage_stores")}...</a></li>
                        {/if}
                    {/capture}

                    {include file="common/ajax_select_object.tpl"
                        data_url="companies.get_companies_list?show_all=Y&action=href"
                        text=$name
                        dropdown_icon=$storefront_status_icon
                        id="top_company_id"
                        type="list"
                        extra_content=$smarty.capture.extra_content
                    }

                    </ul>
                {else}
                    <ul class="nav">
                        {if $auth.company_id}
                            <li class="dropdown">
                                <a href="{"companies.update?company_id=`$runtime.company_id`"|fn_url}">{__("vendor")}: {$runtime.company_data.company}</a>
                            </li>
                        {else}
                            {if fn_check_view_permissions("companies.manage", "GET")}
                                <li class="dropdown vendor-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span>{$name|truncate:60:"...":true}</span>{if $storefront_status_icon}<i class="{$storefront_status_icon} dropdown-menu__icon"></i>{/if}<b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu" id="top_company_id_ajax_select_object">
                                        <li><a href="{"companies.manage?switch_company_id=0"|fn_url}">{__("manage_stores")}...</a></li>
                                    </ul>
                                </li>
                            {/if}
                        {/if}
                    </ul>
                {/if}
            </div>
        {/if}

        {if "MULTIVENDOR"|fn_allowed_for && !$runtime.simple_ultimate}

            {if $runtime.are_all_storefronts_closed}
                {$storefront_status_icon = "icon-lock"}
            {elseif $runtime.have_closed_storefronts}
                {$storefront_status_icon = "icon-unlock-alt"}
            {/if}

            <ul class="nav">
                <li class="nav-company">
                    {if $auth.user_type == "UserTypes::ADMIN"|enum}
                        {$storefront_url = fn_url("profiles.act_as_user?user_id={$auth.user_id}&area=C")}
                    {else}
                        {$storefront_url = fn_url("", "C")}
                        {if $runtime.storefront_access_key}
                            {$storefront_url = $storefront_url|fn_link_attach:"store_access_key={$runtime.storefront_access_key}"}
                        {/if}
                    {/if}
                    <a href="{$storefront_url}" target="_blank" class="brand" title="{__("view_storefront")}">
                        <i class="icon-shopping-cart icon-white"></i>
                    </a>
                    <a href="{""|fn_url}" class="brand company-name">{$settings.Company.company_name|truncate:60:"...":true}</a>
                    {if $storefront_status_icon}
                    <a href="{"storefronts.manage"|fn_url}" class="brand">
                        <i class="{$storefront_status_icon} dropdown-menu__icon"></i>
                    </a>
                    {/if}
                    {if $runtime.customization_mode.live_editor}
                        {assign var="company_name" value=$runtime.company_data.company}
                    {else}
                        {assign var="company_name" value=$runtime.company_data.company|truncate:43:"...":true}
                    {/if}
                </li>
                {if $auth.company_id}
                    <li class="dropdown">
                        <a href="{"companies.update?company_id=`$runtime.company_id`"|fn_url}">{__("vendor")}: {$runtime.company_data.company}</a>
                    </li>
                {else}
                    {if fn_check_view_permissions("companies.get_companies_list", "GET")}
                        {capture name="extra_content"}
                            <li class="divider"></li>
                            <li><a href="{"companies.manage?switch_company_id=0"|fn_url}">{__("manage_vendors")}...</a></li>
                        {/capture}

                        {include
                            file="common/ajax_select_object.tpl"
                            data_url="companies.get_companies_list?show_all=Y&action=href"
                            text=$company_name
                            dropdown_icon=false
                            id="top_company_id"
                            type="list"
                            extra_content=$smarty.capture.extra_content
                        }
                    {else}
                        <li class="dropdown">
                            <a class="unedited-element">{$company_name}</a>
                        </li>
                    {/if}
                {/if}
            </ul>
        {/if}

            <ul id="mainrightnavbar" class="nav hover-show navbar-right">
            {if $auth.user_id && $navigation.static}

                {foreach from=$navigation.static.top key=first_level_title item=m name="first_level_top"}
                    <li class="dropdown dropdown-top-menu-item{if $first_level_title == $navigation.selected_tab} active{/if} navigate-items">
                        <a id="elm_menu_{$first_level_title}" href="#" class="dropdown-toggle {$first_level_title}">
                            {__($first_level_title)}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            {foreach from=$m.items key=second_level_title item="second_level" name="sec_level_top"}
                                <li class="{if $second_level.subitems}dropdown-submenu{/if}{if $second_level_title == $navigation.subsection} active{/if} {if $second_level.is_promo}cm-promo-popup{/if} {$second_level.attrs.class}" {menu_attrs attrs=$second_level.attrs.main}>
                                    {if $second_level.type == "title"}
                                        <a id="elm_menu_{$first_level_title}_{$second_level_title}" {if $second_level.attrs.class_href}class="{$second_level.attrs.class_href}"{/if} {menu_attrs attrs=$second_level.attrs.href}>
                                            {$second_level.title|default:__($second_level_title)}
                                            {if $second_level.attrs.class == "is-addon"}<span><i class="icon-is-addon"></i></span>{/if}
                                        </a>
                                    {elseif $second_level.type != "divider"}
                                        <a id="elm_menu_{$first_level_title}_{$second_level_title}" {if $second_level.attrs.class_href}class="{$second_level.attrs.class_href}"{/if} href="{$second_level.href|fn_url}" {menu_attrs attrs=$second_level.attrs.href}>
                                            {$second_level.title|default:__($second_level_title)}
                                            {if $second_level.attrs.class == "is-addon"}<span><i class="icon-is-addon"></i></span>{/if}
                                        </a>
                                    {/if}
                                    {if $second_level.subitems}
                                        <ul class="dropdown-menu">
                                            {foreach from=$second_level.subitems key=subitem_title item=sm}
                                                {if $sm.type != "divider"}
                                                <li class="{if $sm.active}active{/if} {if $sm.is_promo}cm-promo-popup{/if} {$second_level.attrs.class}" {menu_attrs attrs=$sm.attrs.main}>
                                                    {if $sm.type == "title"}
                                                        {__($subitem_title)}
                                                    {elseif $sm.type != "divider"}
                                                        <a id="elm_menu_{$first_level_title}_{$second_level_title}_{$subitem_title}" href="{$sm.href|fn_url}" {menu_attrs attrs=$sm.attrs.href}>{$sm.title|default:__($subitem_title)}</a>
                                                    {/if}
                                                </li>
                                                {elseif $sm.type == "divider"}
                                                    <li class="divider"></li>
                                                {/if}
                                            {/foreach}
                                        </ul>
                                    {/if}
                                </li>
                                {if $second_level.type == "divider"}
                                    <li class="divider"></li>
                                {/if}
                            {/foreach}
                        </ul>
                    </li>
                {/foreach}
            {/if}
                <!-- end navbar-->

            {if $auth.user_id}

                {if $languages|sizeof > 1 || $currencies|sizeof > 1}
                    <li class="divider-vertical"></li>
                {/if}

                <!--language-->
                {if !"ULTIMATE:FREE"|fn_allowed_for}
                    {if $languages|sizeof > 1}
                        {include file="common/select_object.tpl" style="dropdown" link_tpl=$config.current_url|fn_link_attach:"sl=" items=$languages selected_id=$smarty.const.CART_LANGUAGE display_icons=true key_name="name" key_selected="lang_code" class="languages"}
                    {/if}
                {/if}
                <!--end language-->

                <!-- Notification Center -->
                    {include file="components/notifications_center/opener.tpl"}
                <!-- /Notification Center -->

                <!--Curriencies-->
                {if $currencies|sizeof > 1}
                {include file="common/select_object.tpl" style="dropdown" link_tpl=$config.current_url|fn_link_attach:"currency=" items=$currencies selected_id=$secondary_currency display_icons=false key_name="description" key_selected="currency_code"}
                {/if}
                <!--end curriencies-->

                <li class="divider-vertical"></li>

                <!-- user menu -->
                <li class="dropdown dropdown-top-menu-item">
                    {hook name="index:top_links"}
                        <a class="dropdown-toggle">
                            <i class="icon-white icon-user"></i>
                            <b class="caret"></b>
                        </a>
                    {/hook}
                    <ul class="dropdown-menu pull-right">
                        <li class="disabled">
                            <a><strong>{__("signed_in_as")}</strong><br>{$user_info.email}</a>
                        </li>
                        <li class="divider"></li>
                        {hook name="menu:profile"}
                        <li><a href="{"profiles.update?user_id=`$auth.user_id`"|fn_url}">{__("edit_profile")}</a></li>
                        <li><a href="{"auth.logout"|fn_url}">{__("sign_out")}</a></li>
                        {if !$runtime.company_id}
                            <li class="divider"></li>
                            <li>
                                {include file="common/popupbox.tpl" id="group`$id_prefix`feedback" edit_onclick=$onclick text=__("feedback_values") act="link" picker_meta="cm-clear-content" link_text=__("send_feedback", ["[product]" => $smarty.const.PRODUCT_NAME]) content=$smarty.capture.update_block href="feedback.prepare" no_icon_link=true but_name="dispatch[feedback.send]" opener_ajax_class="cm-ajax"}
                            </li>
                        {/if}
                        {/hook}
                    </ul>
                </li>
                <!--end user menu -->
            {/if}
            </ul>

        </div>
    <!--header_navbar--></div>

    <!--Subnav-->
    <div class="subnav" id="header_subnav">
        <!--quick search-->
        <div class="search pull-right">
            {hook name="index:global_search"}
                <form id="global_search" method="get" action="{""|fn_url}">
                    <input type="hidden" name="dispatch" value="search.results" />
                    <input type="hidden" name="compact" value="Y" />
                    <button class="icon-search cm-tooltip " type="submit" title="{__("search_tooltip")}" id="search_button"></button>
                    <label for="gs_text"><input type="text" class="cm-autocomplete-off" id="gs_text" name="q" value="{$smarty.request.q}" /></label>
                </form>
            {/hook}

        </div>
        <!--end quick search-->

        <!-- quick menu -->
        {include file="common/quick_menu.tpl"}
        <!-- end quick menu -->

        <ul class="nav hover-show nav-pills">
            <li class="mobile-hidden"><a href="{""|fn_url}" class="home"><i class="icon-home"></i></a></li>

            <div class="menu-heading mobile-visible">

                <button class="btn btn-primary mobile-visible-inline mobile-menu-closer">{__("close")}</button>

                {if "ULTIMATE"|fn_allowed_for}
                    <!-- title of heading -->
                    <p class="menu-heading__title-block ult">
                        <span class="menu-heading__title-block--text">
                            {if $auth.company_id}
                                <span>{$runtime.company_data.company}</span>
                            {else}
                                {if fn_check_view_permissions("companies.manage", "GET")}
                                    <span>{$name|truncate:60:"...":true}</span>
                                {/if}
                            {/if}
                            {if $storefront_status_icon}<i class="{$storefront_status_icon}"></i>{/if}
                            <span class="caret"></span>
                        </span>
                    </p>
                {/if}

                {if "MULTIVENDOR"|fn_allowed_for && !$runtime.simple_ultimate}
                    <!-- title of heading (if multivendor edition) -->
                    <p class="menu-heading__title-block mve">
                        <span class="menu-heading__title-block--text">
                            <span>{$company_name}</span>
                            <a href="{"storefronts.manage"|fn_url}">
                                <i class="{$storefront_status_icon}"></i>
                            </a>
                            <span class="caret"></span>
                        </span>
                    </p>
                {/if}

                <div class="menu-heading__dropdowned closed">
                <ul class="dropdown-menu menu-heading__dropdowned-menu">
                    {* select vendor *}
                    {if "MULTIVENDOR"|fn_allowed_for && !$runtime.simple_ultimate}
                        <li class="divider"></li>
                        {if $auth.company_id}
                            <li class="dropdown" data-disable-dropdown-processing="true">
                                <a href="{"companies.update?company_id=`$runtime.company_id`"|fn_url}">{__("vendor")}: {$runtime.company_data.company}</a>
                            </li>
                        {else}
                            {if fn_check_view_permissions("companies.get_companies_list", "GET")}
                                <li class="dropdown" data-disable-dropdown-processing="true">
                                    <a
                                        class="unedited-element mobile-menu--js-companies-popup"
                                        data-ca-selector-href="companies.get_companies_list?show_all=Y&action=href&render_html=N"
                                        data-ca-selector-elements="20"
                                        data-ca-selector-start="0"
                                    >{$company_name}</a>
                                </li>
                            {else}
                                <li class="dropdown" data-disable-dropdown-processing="true">
                                    <a class="unedited-element">{$company_name}</a>
                                </li>
                            {/if}
                        {/if}
                    {/if}
                    {* end select vendor *}

                    {* select store *}
                    {if "ULTIMATE"|fn_allowed_for}
                        {if $runtime.companies_available_count > 1}
                            {if fn_check_view_permissions("companies.get_companies_list", "GET")}
                                <li class="dropdown" data-disable-dropdown-processing="true">
                                    <a
                                        class="unedited-element mobile-menu--js-companies-popup"
                                        data-ca-selector-href="companies.get_companies_list?show_all=Y&action=href&render_html=N"
                                        data-ca-selector-elements="20"
                                        data-ca-selector-start="0"
                                    >{$name}</a>
                                </li>
                            {else}
                                <li class="dropdown" data-disable-dropdown-processing="true">
                                    <a class="unedited-element">{$name}</a>
                                </li>
                            {/if}
                        {/if}
                    {/if}
                    {* end select store *}

                    {* user menu *}
                    <li class="disabled">
                        <a><strong>{__("signed_in_as")}</strong><br>{$user_info.email}</a>
                    </li>
                    <li class="divider"></li>
                    {hook name="menu:profile"}
                        <li><a href="{"profiles.update?user_id=`$auth.user_id`"|fn_url}">{__("edit_profile")}</a></li>
                        <li><a href="{"auth.logout"|fn_url}">{__("sign_out")}</a></li>
                    {/hook}
                    {* end user menu *}

                    {if "ULTIMATE"|fn_allowed_for}
                        {if fn_check_view_permissions("companies.manage", "GET")}
                            <li class="divider"></li>
                            <li><a href="{"companies.manage?switch_company_id=0"|fn_url}">{__("manage_stores")}...</a></li>
                        {/if}
                    {/if}

                    {* feedback *}
                    {if !$runtime.company_id}
                        <li class="divider"></li>
                        <li>
                            {include file="common/popupbox.tpl" id="group`$id_prefix`feedback" edit_onclick=$onclick text=__("feedback_values") act="link" picker_meta="cm-clear-content" link_text=__("send_feedback", ["[product]" => $smarty.const.PRODUCT_NAME]) content=$smarty.capture.update_block href="feedback.prepare" no_icon_link=true but_name="dispatch[feedback.send]" opener_ajax_class="cm-ajax"}
                        </li>
                    {/if}
                    {* end feedback *}
                </ul>
                </div>
            </div>

            <ul class="nav hover-show nav-pills nav-child mobile-visible nav-first">
            {if $runtime.company_data.storefront}
                <li class="dropdown">
                    {$storefront_url = fn_url("profiles.act_as_user?user_id={$auth.user_id}&area=C")}
                    <a  href="{$storefront_url}"
                        target="_blank"
                        title="{__("view_storefront")}"
                        class="dropdown-toggle"
                    >{__("view_storefront")}</a>
                </li>
            {elseif "MULTIVENDOR"|fn_allowed_for}
                <li class="dropdown">
                    {if $auth.user_type == "UserTypes::ADMIN"|enum}
                        {$storefront_url = fn_url("profiles.act_as_user?user_id={$auth.user_id}&area=C")}
                    {else}
                        {$storefront_url = fn_url("", "C")}
                        {if $runtime.storefront_access_key}
                            {$storefront_url = $storefront_url|fn_link_attach:"store_access_key={$runtime.storefront_access_key}"}
                        {/if}
                    {/if}
                    <a  href="{$storefront_url}"
                        target="_blank"
                        title="{__("view_storefront")}"
                        class="dropdown-toggle"
                    >{__("view_storefront")}</a>
                </li>
            {/if}
                <li class="dropdown"><a href="{""|fn_url}" class="dropdown-toggle">{__("home")}</a></li>
            </ul>

            {if $auth.user_id && $navigation.static.central}
            <hr class="mobile-visible navbar-hr" />
            <ul class="nav hover-show nav-pills nav-child">
            {foreach from=$navigation.static.central key=first_level_title item=m name="first_level"}
                <li class="dropdown {if $first_level_title == $navigation.selected_tab} active{/if} ">
                    <a href="#" class="dropdown-toggle">
                        {__($first_level_title)}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        {foreach from=$m.items key=second_level_title item="second_level" name="sec_level"}
                            <li class="{$second_level_title}{if $second_level.subitems} dropdown-submenu{/if}{if $second_level_title == $navigation.subsection && $first_level_title == $navigation.selected_tab} active{/if}" {menu_attrs attrs=$second_level.attrs.main}><a class="{if $second_level.is_promo}cm-promo-popup{/if} {$second_level.attrs.class}" {if !$second_level.is_promo}href="{$second_level.href|fn_url}"{/if} {menu_attrs attrs=$second_level.attrs.href}>
                                <span>{__($second_level_title)}{if $second_level.attrs.class == "is-addon"}<i class="icon-is-addon"></i>{/if}</span>
                                {if __($second_level.description) != "_`$second_level_title`_menu_description"}{if $settings.Appearance.show_menu_descriptions == "Y"}<span class="hint">{__($second_level.description)}</span>{/if}{/if}</a>

                                {if $second_level.subitems}
                                    <ul class="dropdown-menu">
                                        {foreach from=$second_level.subitems key=subitem_title item=sm}
                                            <li class="{if $sm.active}active{/if} {if $sm.is_promo}cm-promo-popup{/if} {$second_level.attrs.class}" {menu_attrs attrs=$sm.attrs.main}><a href="{$sm.href|fn_url}" {menu_attrs attrs=$sm.attrs.href}>{__($subitem_title)}</a></li>
                                        {/foreach}
                                    </ul>
                                {/if}
                            </li>
                        {/foreach}
                    </ul>
                </li>
            {/foreach}
            </ul>
            {/if}

            {if $auth.user_id && $navigation.static.top}
            <hr class="mobile-visible navbar-hr" />
            <ul class="nav hover-show nav-pills nav-child mobile-visible">
            {foreach from=$navigation.static.top key=first_level_title item=m name="first_level_top"}
                <li class="dropdown dropdown-top-menu-item{if $first_level_title == $navigation.selected_tab} active{/if} navigate-items">
                    <a id="elm_menu_{$first_level_title}" href="#" class="dropdown-toggle {$first_level_title}">
                        {__($first_level_title)}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        {foreach from=$m.items key=second_level_title item="second_level" name="sec_level_top"}
                            <li class="{if $second_level.subitems}dropdown-submenu{/if}{if $second_level_title == $navigation.subsection} active{/if} {if $second_level.is_promo}cm-promo-popup{/if} {$second_level.attrs.class}" {menu_attrs attrs=$second_level.attrs.main}>
                                {if $second_level.type == "title"}
                                    <a id="elm_menu_{$first_level_title}_{$second_level_title}" {if $second_level.attrs.class_href}class="{$second_level.attrs.class_href}"{/if} {menu_attrs attrs=$second_level.attrs.href}>{$second_level.title|default:__($second_level_title)}</a>
                                {elseif $second_level.type != "divider"}
                                    <a id="elm_menu_{$first_level_title}_{$second_level_title}" {if $second_level.attrs.class_href}class="{$second_level.attrs.class_href}"{/if} href="{$second_level.href|fn_url}" {menu_attrs attrs=$second_level.attrs.href}>{$second_level.title|default:__($second_level_title)}
                                        {if $second_level.attrs.class == "is-addon"}<span><i class="icon-is-addon"></i></span>{/if}
                                    </a>
                                {/if}
                                {if $second_level.subitems}
                                    <ul class="dropdown-menu">
                                        {foreach from=$second_level.subitems key=subitem_title item=sm}
                                            <li class="{if $sm.active}active{/if} {if $sm.is_promo}cm-promo-popup{/if} {$second_level.attrs.class}" {menu_attrs attrs=$sm.attrs.main}>
                                                {if $sm.type == "title"}
                                                    {__($subitem_title)}
                                                {elseif $sm.type != "divider"}
                                                    <a id="elm_menu_{$first_level_title}_{$second_level_title}_{$subitem_title}" href="{$sm.href|fn_url}" {menu_attrs attrs=$sm.attrs.href}>{$sm.title|default:__($subitem_title)}</a>
                                                {/if}
                                            </li>
                                            {if $sm.type == "divider"}
                                                <li class="divider"></li>
                                            {/if}
                                        {/foreach}
                                    </ul>
                                {/if}
                            </li>
                            {if $second_level.type == "divider"}
                                <li class="divider"></li>
                            {/if}
                        {/foreach}
                    </ul>
                </li>
            {/foreach}
            </ul>
            {/if}

            <hr class="mobile-visible navbar-hr" />
            <ul class="nav hover-show nav-pills nav-child mobile-visible">
                <!--language-->
                {if $languages|sizeof > 1}
                    {include file="common/select_object.tpl" style="dropdown" link_tpl=$config.current_url|fn_link_attach:"sl=" items=$languages selected_id=$smarty.const.CART_LANGUAGE display_icons=true key_name="name" key_selected="lang_code" class="languages" plain_name=__("language")}
                {/if}
                <!--end language-->

                <!--curriencies-->
                {if $currencies|sizeof > 1}
                    {include file="common/select_object.tpl" style="dropdown" link_tpl=$config.current_url|fn_link_attach:"currency=" items=$currencies selected_id=$secondary_currency display_icons=false key_name="description" key_selected="currency_code" plain_name=__("currency")}
                {/if}
                <!--end curriencies-->
            </ul>
            <hr class="mobile-visible navbar-hr" />

        </ul>
    <!--header_subnav--></div>
</div>

{* Template for mobile sidebar menu *}
<div class="overlayed-mobile-menu mobile-visible">
    <div class="overlayed-mobile-menu__content">
        <div class="overlayed-mobile-menu__title-container">
            <h3 class="overlayed-mobile-menu-title"></h3>
        </div>

        <div class="overlayed-mobile-menu-closer">
            <button class="mobile-visible-inline overlay-navbar-close btn btn-primary">{__("go_back")}</button>
        </div>
    </div>

    <div class="overlayed-mobile-menu__content">
    </div>
    <div class="overlayed-mobile-menu-container"></div>
</div>
{* End of template for mobile sidebar menu *}

{* Dummy containers for store/vendor selector *}
<div class="hidden store-vendor-selector--dummy-dialog"></div>

<ul class="hidden store-vendor-selector--list-container">
    <input
        class="store-vendor-selector--search cm-ajax-content-input"
        type="text"
        value=""
        placeholder="{__("search")}"
    />
    <div class="store-vendor-selector--list-wrapper-container">
        <ul class="store-vendor-selector--list-wrapper"></ul>
    </div>
</ul>
<li class="hidden store-vendor-selector--list-element">
    <a class="store-vendor-selector--list-element-link" href="#"></a>
</li>
<button class="hidden btn btn-primary store-vendor-selector--show-more-btn">{__("more")}</button>
<span class="hidden store-vendor-selector--list-element-storefront-status"><i class="icon-lock dropdown-menu__item-icon"></i></span>
{* Dummy containers for store/vendor selector *}
