{script src="js/tygh/email_templates.js"}

{$id = $snippet->getId()}

{capture name="mainbox"}

{capture name="tabsbox"}

    <div id="content_snippet_general">
        <form action="{""|fn_url}"
              method="post"
              enctype="multipart/form-data"
              name="snippet_form_{$id}"
              class="{if $target == "popup"}cm-ajax cm-form-dialog-closer{/if} form-horizontal"
        >

            <input type="hidden" name="result_ids" value="{$result_ids}" />
            <input type="hidden" name="return_url" value="{$return_url}" />
            <input type="hidden" name="snippet_id" value="{$id}" />
            <input type="hidden" name="snippet[type]" value="{$type}" />
            <input type="hidden" name="snippet[addon]" value="{$snippet->getAddon()}" />

            <div id="content_tab_snippet_{$id}">
                <fieldset>

                    <div class="control-group">
                        <label for="elm_snippet_name_{$id}" class="cm-required cm-focus control-label">{__("name")}:</label>
                        <div class="controls">
                            <input id="elm_snippet_name_{$id}" type="text" name="snippet[name]" value="{$snippet->getName()}" class="span9 cm-emltpl-set-active">
                        </div>
                    </div>

                    {if !$id}
                        <div class="control-group">
                            <label for="elm_snippet_code_{$id}" class="cm-required cm-focus control-label">{__("code")}{include file="common/tooltip.tpl" tooltip=__("text_character_identifier_tooltip")}:</label>
                            <div class="controls">
                                <input id="elm_snippet_code_{$id}" type="text" name="snippet[code]" value="{$snippet->getCode()}" class="span9 cm-emltpl-set-active">
                            </div>
                        </div>
                    {/if}

                    <div class="control-group">
                        <label class="cm-required control-label" for="elm_snippet_template_{$id}">{__("template")}:</label>
                        <div class="controls">
                            <textarea id="elm_snippet_template_{$id}" name="snippet[template]" cols="55" rows="14" class="span9 cm-emltpl-set-active">{$snippet->getTemplate()}</textarea>
                        </div>
                    </div>

                    {include file="common/select_status.tpl" input_name="snippet[status]" id="elm_snippet_status_{$id}" obj=$snippet->toArray() hidden=false}

                </fieldset>
            <!--content_tab_snippet_{$id}--></div>

            {capture name="buttons"}
                {if $id && $snippet->isModified()}
                    {$r_url = $config.current_url|escape:url}
                    {if $target == "popup"}
                        {$restore_btn_class = "cm-confirm cm-ajax"}
                        {$restore_btn_data = ["data-ca-target-id" => "content_tab_snippet_{$id},content_tab_snippet_buttons_{$id}", "data-ca-confirm-text" => __("text_restore_question")]}
                        {$restore_btn_dropdown_class = "droptop"}
                    {else}
                        {$restore_btn_class = "cm-confirm"}
                        {$restore_btn_data = ["data-ca-confirm-text" => __("text_restore_question")]}
                        {$restore_btn_dropdown_class = ""}
                    {/if}
                    {capture name="tools_list"}
                        <li>
                            {btn type="text"
                                href="snippets.restore?snippet_id={$id}&return_url={$r_url}"
                                class=$restore_btn_class
                                data=$restore_btn_data
                                text=__("restore")
                                method="POST"
                            }
                        </li>
                    {/capture}
                    {dropdown content=$smarty.capture.tools_list
                        class="cm-tab-tools {$restore_btn_dropdown_class}"
                        id="tools_general"
                    }
                {/if}

                {if $target == "popup"}
                    {include file="buttons/save_cancel.tpl"
                        but_name="dispatch[snippets.update]"
                        cancel_action="close"
                        save=$id
                    }
                {else}
                    {include file="buttons/save_cancel.tpl"
                        but_role="submit-link"
                        but_name="dispatch[snippets.update]"
                        but_target_form="snippet_form_{$id}"
                        save=$id
                    }
                {/if}

            {/capture}

            {if $target == "popup"}
                <div class="buttons-container" id="content_tab_snippet_buttons_{$id}">
                    {$smarty.capture.buttons nofilter}
                <!--content_tab_snippet_buttons_{$id}--></div>
            {/if}
        </form>
    </div>
    <script type="text/javascript">
        (function(_, $) {
            $.ceEvent('on', 'ce.formajaxpost_snippet_form_{$id}', function(response_data, params) {
                if (response_data.failed_request) {
                    return false;
                }

                var $dialog = $.ceDialog('get_last');

                $dialog.ceDialog('destroy');
                $dialog.remove();
            });
        }(Tygh, Tygh.$));
    </script>

    {hook name="snippets:tabs_extra"}{/hook}
{/capture}

{include file="common/tabsbox.tpl" content=$smarty.capture.tabsbox track=true}

{/capture}

{if $target == "popup"}
    {$smarty.capture.mainbox nofilter}
{else}
    {include file="common/mainbox.tpl"
        title_start=__("editing_snippet")
        title_end=$snippet->getName()
        content=$smarty.capture.mainbox
        buttons=$smarty.capture.buttons
    }
{/if}
