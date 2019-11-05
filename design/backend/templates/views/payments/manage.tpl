{script src="js/tygh/tabs.js"}

{capture name="mainbox"}

<script type="text/javascript">
var processor_descriptions = [];
{foreach $payment_processors as $p}
processor_descriptions[{$p.processor_id}] = '{$p.description|escape:javascript nofilter}';
{/foreach}
function fn_switch_processor(payment_id, processor_id)
{
    Tygh.$('#tab_conf_' + payment_id).toggleBy(processor_id == 0);
    if (processor_id != 0) {
        var url = fn_url('payments.processor?payment_id=' + payment_id + '&processor_id=' + processor_id);
        Tygh.$('#tab_conf_' + payment_id + ' a').prop('href', url);
        Tygh.$('#elm_payment_tpl_' + payment_id).prop('disabled', true);
        Tygh.$('#elm_payment_instructions_' + payment_id).ceEditor('destroy');
        if (processor_descriptions[processor_id]) {
            Tygh.$('#elm_processor_description_' + payment_id).html(processor_descriptions[processor_id]).show();
        } else {
            Tygh.$('#elm_processor_description_' + payment_id).hide();
        }

        Tygh.$('#elm_payment_instructions_' + payment_id).ceEditor('recover');

        Tygh.$.ceAjax('request', url, {
            result_ids: 'content_tab_details_*,content_tab_conf_*'
        });
    } else {
        Tygh.$('#elm_payment_tpl_' + payment_id).prop('disabled', false);
        Tygh.$('#content_tab_conf_' + payment_id).html('<!--content_tab_conf_' + payment_id + '-->');
        Tygh.$('#elm_processor_description_' + payment_id).hide();
    }
}
</script>

{$skip_delete=false}
{$draggable = $draggable|default:true}
{hook name="payments:list"}
{if $payments}
<div class="items-container payment-methods {if $draggable}cm-sortable{/if}"
     {if $draggable}data-ca-sortable-table="payments" data-ca-sortable-id-name="payment_id"{/if}
     id="payments_list">
<div class="table-wrapper">
    <table class="table table-middle table-objects table-striped payment-methods__list">
        <tbody>
            {foreach $payments as $pf => $payment}
                {if "ULTIMATE"|fn_allowed_for}
                    {if $runtime.company_id && $runtime.company_id != $payment.company_id}
                        {$skip_delete=true}
                        {$hide_for_vendor=true}

                    {else}
                        {$skip_delete=false}
                        {$hide_for_vendor=false}
                    {/if}
                {/if}

                {if $payment.processor_status == "D"}
                    {$status = "D"}
                    {$can_change_status = false}
                    {$display= "text"}
                {else}
                    {$status = $payment.status}
                    {$can_change_status = true}
                    {$display= ""}
                {/if}

                {capture name="tool_items"}
                    {hook name="payments:list_extra_links"}{/hook}
                {/capture}

                {capture name="extra_data"}
                    {hook name="payments:extra_data"}{/hook}
                {/capture}

                {include file="common/object_group.tpl"
                    id=$payment.payment_id
                    text=$payment.payment
                    status=$status
                    href="payments.update?payment_id=`$payment.payment_id`"
                    object_id_name="payment_id"
                    table="payments"
                    href_delete="payments.delete?payment_id=`$payment.payment_id`"
                    delete_target_id="payments_list"
                    skip_delete=$skip_delete
                    header_text="{__("editing_payment")}: `$payment.payment`"
                    additional_class="cm-sortable-row cm-sortable-id-`$payment.payment_id`"
                    no_table=true
                    draggable=$draggable
                    can_change_status=$can_change_status
                    display=$display
                    tool_items=$smarty.capture.tool_items
                    extra_data=$smarty.capture.extra_data
                }
            {/foreach}
        </tbody>
    </table>
</div>
{else}
    <p class="no-items">{__("no_data")}</p>
{/if}
{/hook}
<!--payments_list--></div>
{/capture}

{capture name="buttons"}
    {capture name="tools_list"}
        {hook name="payments:manage_tools_list"}
        {/hook}
    {/capture}
    {dropdown content=$smarty.capture.tools_list}
{/capture}

{capture name="adv_buttons"}
    {capture name="add_new_picker"}
        {include file="views/payments/update.tpl"
            payment=[]
            hide_for_vendor=false
        }
    {/capture}
    {include file="common/popupbox.tpl"
        id="add_new_payments"
        text=__("new_payments")
        content=$smarty.capture.add_new_picker
        title=__("add_payment")
        act="general"
        icon="icon-plus"
    }
{/capture}

{include file="common/mainbox.tpl"
        title=__("payment_methods")
        content=$smarty.capture.mainbox
        select_languages=true
        buttons=$smarty.capture.buttons
        adv_buttons=$smarty.capture.adv_buttons
}
