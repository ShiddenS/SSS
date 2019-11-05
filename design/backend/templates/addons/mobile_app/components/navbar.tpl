<div class="span16 mockup__mockups-container">
    <div class="span4 mockup">
        <div class="mockup__container">
            <div class="mockup__status-bar drawerBgColor__background">

                <img src="{$images_dir}/addons/mobile_app/status_bar_example.png">

            </div>

            {include file="addons/mobile_app/components/atoms/navbar.tpl"}

            <div 
                class="mockup__body body mockup__category screenBackgroundColor__background"
                style="min-height: calc(100% - 65px); max-height: calc(100% - 65px);"
            >

            </div>

        </div>
    </div>

    <div class="span8">
        {include file="common/subheader.tpl" title=__("mobile_app.section.navbar")}

        {foreach $config_data.app_appearance.colors.navbar as $col_name => $color}
        <div class="control-group">
            <label class="control-label" for="">{$color.name} {include file="common/tooltip.tpl" tooltip=$color.description}: </label>
            <div class="controls">
                <div class="colorpicker">
                    <input {if $color.type != "number"}type="text"{else}type="number"{/if} 
                        data-target="{$col_name}" 
                        {if $color.type == "color" || $color.type == "rgba"}
                            data-ca-spectrum-show-alpha="true"
                        {/if}
                        name="m_settings[app_appearance][colors][navbar][{$col_name}]"
                        id="{$col_name}" 
                        value="{$color.value}" 
                        {if $color.type == "color" || $color.type == "rgba"}
                            class="js-mobile-app-input cm-colorpicker"
                        {else}
                            class="js-mobile-app-input"
                        {/if}
                    />
                </div>
            </div>
        </div>
        {/foreach}
    </div>
</div>