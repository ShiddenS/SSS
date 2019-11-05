{** block-description:tmpl_logo **}
<div class="ty-logo-container">
    {$logo_link = $block.properties.enable_link|default:"Y" == "Y"}

    {if $logo_link}
        <a href="{""|fn_url}" title="{$logos.theme.image.alt}">
    {/if}

<span style="text-transform: uppercase">
    <span style="color: #757575;">    
    <span style="font-size: 26px;">
    <span style="font-weight: 400;">
    <span style="letter-spacing: 2px;">
    <span style="line-height: 50px;">
    <span style="margin: 0;">
    <span class="logoname">Miniml.
</span>
  
    {* include file="common/image.tpl"
             images=$logos.theme.image
             class="ty-logo-container__image"
             image_additional_attrs=["width" => $logos.theme.image.image_x, "height" => $logos.theme.image.image_y]
             obj_id=false
             show_no_image=false
             show_detailed_link=false
             capture_image=false
               style="color:red;" 

  *}  
    {if $logo_link}
        </a>
    {/if}
</div>
