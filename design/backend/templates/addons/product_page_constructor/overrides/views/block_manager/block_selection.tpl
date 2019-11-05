{script src="js/tygh/tabs.js"}

<div class="tabs cm-j-tabs">
    <ul class="nav nav-tabs">
        <li id="user_existing_blocks_{$grid_id}{$extra_id}" class="cm-js active"><a>{if $smarty.request.manage && $smarty.request.manage == "Y"}{__("manage_existing_block")}{else}{__("use_existing_block")}{/if}</a></li>
	{if $product_page_blocks}<li id="user_existing_product_blocks_{$grid_id}{$extra_id}" class="cm-js"><a>{__("use_existing_product_block")}</a></li>{/if}
        <li id="create_new_blocks_{$grid_id}{$extra_id}" class="cm-js"><a>{__("create_new_block")}</a></li>
    </ul>
</div>

<div class="cm-tabs-content tabs_content_blocks" id="tabs_content_blocks_{$grid_id}{$extra_id}">
    {if $product_page_blocks}
    <div id="content_user_existing_product_blocks_{$grid_id}{$extra_id}">
        {include file="addons/product_page_constructor/views/block_manager/components/existing_product_blocks_list.tpl" manage=$smarty.request.manage|default:""}
    <!--content_user_existing_product_blocks--></div>
    {/if}
    <div id="content_create_new_blocks_{$grid_id}{$extra_id}">
        {include file="views/block_manager/components/new_blocks_list.tpl" manage=$smarty.request.manage|default:""}
    <!--content_create_new_blocks--></div>

    <div id="content_user_existing_blocks_{$grid_id}{$extra_id}">
        {include file="views/block_manager/components/existing_blocks_list.tpl" manage=$smarty.request.manage|default:""}
    <!--content_user_existing_blocks--></div>
</div>