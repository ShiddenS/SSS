{if $notes}
    {include file="common/help.tpl" content=$notes id=$notes_id}
{/if}
<h4 class="subheader {$meta} {if $target} hand{/if}" {if $target}data-toggle="collapse" data-target="{$target}"{/if}>
    {$title}
    {if $additional_id}<span class="muted"><small> #{$additional_id}</small></span>{/if}
    {if $target}<span class="icon-caret-down"></span>{/if}
</h4>
