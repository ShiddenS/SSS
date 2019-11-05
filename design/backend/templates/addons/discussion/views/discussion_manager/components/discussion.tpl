{if $discussion && $discussion.object_type && !$discussion.is_empty}

    {$is_allowed_to_add_posts = "discussion.add"|fn_check_view_permissions}
    {$is_allowed_to_update_posts = "discussion.update"|fn_check_view_permissions}
    {$is_owned_object = $runtime.company_id == $object_company_id}
    {$is_company_reviews = $discussion.object_type == "Addons\Discussion\DiscussionObjectTypes::COMPANY"|enum}
    {$allow_save = $is_allowed_to_update_posts && !($runtime.company_id && (!$is_owned_object || $is_company_reviews))}

    <div id="content_discussion">
    <div class="clearfix">
        <div class="buttons-container buttons-bg pull-right">
            {if $is_allowed_to_add_posts && !($runtime.company_id && (!$is_owned_object || $is_company_reviews))}
                {if $discussion.object_type == "Addons\Discussion\DiscussionObjectTypes::TESTIMONIALS_AND_LAYOUT"|enum}
                    {capture name="adv_buttons"}
                        {include file="common/popupbox.tpl" id="add_new_post" title=__("add_post") icon="icon-plus" act="general" link_class="cm-dialog-switch-avail"}
                    {/capture}
                {else}
                    {include file="common/popupbox.tpl" id="add_new_post" link_text=__("add_post") act="general" link_class="cm-dialog-switch-avail"}
                {/if}
            {/if}
            {if $discussion.posts && "discussion_manager"|fn_check_view_permissions}
                {$show_save_btn = true scope = root}
                {if $discussion.object_type == "Addons\Discussion\DiscussionObjectTypes::TESTIMONIALS_AND_LAYOUT"|enum}
                    {capture name="buttons_insert"}
                {/if}
                {if "discussion.m_delete"|fn_check_view_permissions}
                    {capture name="tools_list"}
                        <li>{btn type="delete_selected" dispatch="dispatch[discussion.m_delete]" form="update_posts_form"}</li>
                    {/capture}
                    {dropdown content=$smarty.capture.tools_list}
                {/if}
                {if $discussion.object_type == "Addons\Discussion\DiscussionObjectTypes::TESTIMONIALS_AND_LAYOUT"|enum}
                    {/capture}
                {/if}
            {/if}
        </div>
    </div><br>

    {if $discussion.posts}

        {script src="js/addons/discussion/discussion.js"}
        {include file="common/pagination.tpl" save_current_page=true id="pagination_discussion" search=$discussion.search}

        <div class="posts-container {if $allow_save}cm-no-hide-input{else}cm-hide-inputs{/if}">
            {foreach from=$discussion.posts item="post"}
                <div class="post-item {if $discussion.object_type == "Addons\Discussion\DiscussionObjectTypes::ORDER"|enum}{if $post.user_id == $user_id}incoming{else}outgoing{/if}{/if}">
                    {hook name="discussion:items_list_row"}
                        {include file="addons/discussion/views/discussion_manager/components/post.tpl" post=$post type=$discussion.type}
                    {/hook}
                </div>
            {/foreach}
        </div>
        {include file="common/pagination.tpl" id="pagination_discussion" search=$discussion.search}

    {else}
        <p class="no-items">{__("no_data")}</p>
    {/if}

    </div>

{elseif $discussion.is_empty}

    {__("text_enabled_testimonials_notice", ["[link]" => "addons.manage#groupdiscussion"|fn_url])}

{/if}
