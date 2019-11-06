{if $capture_link}
    {capture name="link"}
{/if}


{if $text}
    {$dialog_title = $text}
{/if}

{if $title}
    {$dialog_title = $title}
{/if}


{if $show_brackets}({/if}<a id="opener_{$id}" class="cm-dialog-opener cm-dialog-auto-size {$link_meta}" {if $href}href="{$href|fn_url}"{/if} data-ca-target-id="content_{$id}" {if $edit_onclick}onclick="{$edit_onclick}"{/if} {if $dialog_title}data-ca-dialog-title="{$dialog_title}"{/if} rel="nofollow">{if $link_icon && $link_icon_first}<i class="{$link_icon}"></i>{/if}<span {if $link_text_meta}class="{$link_text_meta}"{/if}>{$link_text nofilter}</span>{if $link_icon && !$link_icon_first}<i class="{$link_icon}"></i>{/if}</a>{if $show_brackets}){/if}

{if $capture_link}
    {/capture}
{/if}

{if $content || $href || $edit_picker}
<div class="hidden{if $wysiwyg} ty-wysiwyg-content{/if}" id="content_{$id}" title="{$text}">
    {$content nofilter}
</div>
{/if}