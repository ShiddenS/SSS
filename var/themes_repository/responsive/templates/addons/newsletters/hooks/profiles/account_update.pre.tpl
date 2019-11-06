{if $page_mailing_lists}
    {capture name="mailing_lists"}
        {assign var="show_newsletters_content" value=false}

        <div class="ty-newsletters">

            {hook name="newsletters:profile_email_subscription"}
                <p>{__("text_signup_for_subscriptions")}</p>
            {/hook}

            {foreach from=$page_mailing_lists item=list}
                {if $list.show_on_registration}
                    {assign var="show_newsletters_content" value=true}
                {/if}
                <input id="all_profile_mailing_list_{$list.list_id}" type="hidden" name="all_mailing_lists[]" value="{$list.list_id}" />

                <div class="ty-newsletters__item{if !$list.show_on_registration} hidden{/if}">
                    <input id="profile_mailing_list_{$list.list_id}" type="checkbox" name="mailing_lists[]" value="{$list.list_id}" {if $user_mailing_lists[$list.list_id]}checked="checked"{/if} class="checkbox" /><label for="profile_mailing_list_{$list.list_id}">{$list.object}</label>
                </div>
            {/foreach}
        </div>
    {/capture}

    {if $show_newsletters_content}
        {include file="common/subheader.tpl" title=__("mailing_lists")}

        {$smarty.capture.mailing_lists nofilter}
    {/if}
{/if}
