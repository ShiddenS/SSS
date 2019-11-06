<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:49:31
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\addons\gift_certificates\views\gift_certificates\update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6460028555db2d33bd43783-29700765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05b974d0ee235aa270d350a4150876fe1161ccc6' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\addons\\gift_certificates\\views\\gift_certificates\\update.tpl',
      1 => 1571327760,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '6460028555db2d33bd43783-29700765',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'addons' => 0,
    'primary_currency' => 0,
    'currencies' => 0,
    'min_amount' => 0,
    'max_amount' => 0,
    'gift_cert_data' => 0,
    'gift_cert_id' => 0,
    'config' => 0,
    'no_ajax' => 0,
    'is_ajax' => 0,
    'type' => 0,
    'base_currency' => 0,
    'text_gift_cert_amount_alert' => 0,
    'is_text' => 0,
    'templates' => 0,
    'file' => 0,
    'name' => 0,
    'settings' => 0,
    'countries' => 0,
    '_country' => 0,
    'code' => 0,
    'country' => 0,
    'states' => 0,
    'state' => 0,
    '_state' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2d33c544639_75486743',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2d33c544639_75486743')) {function content_5db2d33c544639_75486743($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_format_price')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.format_price.php';
if (!is_callable('smarty_modifier_sizeof')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.sizeof.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('text_gift_cert_amount_alert','recipients_name','purchasers_name','amount','gift_comment','text_no_products_defined','gift_add_products','how_to_send','send_via_email','send_via_postal_mail','email','template','phone','address','city','country','select_country','state','select_state','zip_postal_code','preview','purchase_gift_certificate','gift_certificate','text_gift_cert_amount_alert','recipients_name','purchasers_name','amount','gift_comment','text_no_products_defined','gift_add_products','how_to_send','send_via_email','send_via_postal_mail','email','template','phone','address','city','country','select_country','state','select_state','zip_postal_code','preview','purchase_gift_certificate','gift_certificate'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
ob_start();?><?php echo smarty_modifier_format_price($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['min_amount'],$_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['min_amount'] = new Smarty_variable($_tmp1, null, 0);?>
<?php ob_start();?><?php echo smarty_modifier_format_price($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['max_amount'],$_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['max_amount'] = new Smarty_variable($_tmp2, null, 0);?>

<?php $_smarty_tpl->tpl_vars['text_gift_cert_amount_alert'] = new Smarty_variable($_smarty_tpl->__("text_gift_cert_amount_alert",array("[min]"=>$_smarty_tpl->tpl_vars['min_amount']->value,"[max]"=>$_smarty_tpl->tpl_vars['max_amount']->value)), null, 0);?>

<?php echo '<script'; ?>
 type="text/javascript">
(function(_, $) {

    var max_amount = '<?php echo strtr($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['max_amount'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
';
    var min_amount = '<?php echo strtr($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['min_amount'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
';
    var send_via = '<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via'])===null||$tmp==='' ? "E" : $tmp), ENT_QUOTES, 'UTF-8');?>
';

    $.ceEvent('on', 'ce.commoninit', function() {

        $.ceFormValidator('registerValidator', {
            class_name: 'cm-gc-validate-amount',
            message: '',
            func: function(id) {
                var max = parseFloat(max_amount);
                var min = parseFloat(min_amount);

                var amount = parseFloat($('#' + id).autoNumeric('get'));
                if ((amount <= max) && (amount >= min)) {
                    return true;
                }

                return false;
            }
        });

        if ($('#send_via').val() == 'P') {
            send_via = 'P';
            $('#post_block').switchAvailability(false, true);
        } else {
            send_via = 'E';
            $('#email_block').switchAvailability(false, true);
        }

        $('#' + (send_via == 'E' ? 'post' : 'email') + '_block').switchAvailability(true, true);

        $(_.doc).on('click', 'input[name="gift_cert_data[send_via]"]', function() {
            if ($(this).val() == 'P') {
                $('#send_via').val('P');
            } else {
                $('#send_via').val('');
            }

            $('#email_block').switchAvailability($(this).val() == 'P', true);
            $('#post_block').switchAvailability($(this).val() == 'E', true);
        });
    });
}(Tygh, Tygh.$));
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="ty-gift-certificate" id="gift_certificate_<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_id']->value)===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
">

<?php if (!$_smarty_tpl->tpl_vars['config']->value['tweaks']['disable_dhtml']&&!$_smarty_tpl->tpl_vars['no_ajax']->value&&$_smarty_tpl->tpl_vars['runtime']->value['mode']!="update") {?>
    <?php $_smarty_tpl->tpl_vars["is_ajax"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<form <?php if ($_smarty_tpl->tpl_vars['is_ajax']->value) {?>class="cm-ajax cm-ajax-full-render" <?php }?>action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" target="_self" name="gift_certificates_form">
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="update") {?>
<input type="hidden" name="gift_cert_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_id']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="type" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value, ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['is_ajax']->value) {?>
<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>

<div class="ty-control-group">
    <label for="gift_cert_recipient" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("recipients_name");?>
</label>
    <input type="text" id="gift_cert_recipient" name="gift_cert_data[recipient]" class="ty-input-text-full cm-focus" size="50" maxlength="255" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['recipient'], ENT_QUOTES, 'UTF-8');?>
" />
</div>

<div class="ty-control-group">
    <label for="gift_cert_sender" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("purchasers_name");?>
</label>
    <input type="text" id="gift_cert_sender" name="gift_cert_data[sender]" class="ty-input-text-full" size="50" maxlength="255" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['sender'], ENT_QUOTES, 'UTF-8');?>
" />
</div>

<div class="ty-control-group ty-gift-certificate__amount">
    <?php $_smarty_tpl->tpl_vars['base_currency'] = new Smarty_variable($_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value], null, 0);?>
    <label for="gift_cert_amount" class="ty-control-group__title cm-required cm-gc-validate-amount"><?php echo $_smarty_tpl->__("amount");?>
</label>
    
    <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['after']=="N") {?>
        <span class="ty-gift-certificate__currency"><?php echo $_smarty_tpl->tpl_vars['base_currency']->value['symbol'];?>
</span>
    <?php }?>
    
    <input 
        type="text"
        id="gift_cert_amount"
        name="gift_cert_data[amount]"
        class="ty-gift-certificate__amount-input cm-numeric"
        data-p-sign="s"
        data-a-sep="<?php if ($_smarty_tpl->tpl_vars['base_currency']->value['thousands_separator']) {
echo $_smarty_tpl->tpl_vars['base_currency']->value['thousands_separator'];
}?>"
        data-m-dec="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['base_currency']->value['decimals'], ENT_QUOTES, 'UTF-8');?>
"
        <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['decimals_separator']) {?> data-a-dec="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['base_currency']->value['decimals_separator'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
        size="5"
        value="<?php if ($_smarty_tpl->tpl_vars['gift_cert_data']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['amount'], ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['min_amount'], ENT_QUOTES, 'UTF-8');
}?>" />
    
    <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['after']=="Y") {?>
        <span class="ty-gift-certificate__currency"><?php echo $_smarty_tpl->tpl_vars['base_currency']->value['symbol'];?>
</span>
    <?php }?>
    
    <div class="ty-gift-certificate__amount-alert form-field-desc"><?php echo $_smarty_tpl->tpl_vars['text_gift_cert_amount_alert']->value;?>
</div>
</div>

<div class="ty-control-group">
    <label for="gift_cert_message" class="ty-control-group__title"><?php echo $_smarty_tpl->__("gift_comment");?>
</label>
    <textarea id="gift_cert_message" name="gift_cert_data[message]" cols="72" rows="4" class="ty-input-text-full" <?php if ($_smarty_tpl->tpl_vars['is_text']->value=="Y") {?>readonly="readonly"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['message'], ENT_QUOTES, 'UTF-8');?>
</textarea>
</div>

<?php if ($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['free_products_allow']=="Y") {?>
    <div class="ty-gift-certificate__products ty-control-group">
        <?php echo $_smarty_tpl->getSubTemplate ("pickers/products/picker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('data_id'=>"free_products",'item_ids'=>$_smarty_tpl->tpl_vars['gift_cert_data']->value['products'],'input_name'=>"gift_cert_data[products]",'type'=>"table",'no_item_text'=>$_smarty_tpl->__("text_no_products_defined"),'holder_name'=>"gift_certificates",'but_role'=>"text",'but_meta'=>"ty-btn__tertiary",'but_text'=>$_smarty_tpl->__("gift_add_products"),'no_container'=>true,'icon_plus'=>true), 0);?>

    </div>
<?php }?>

<div class="ty-gift-certificate__switch clearfix">
    <div class="ty-gift-certificate__switch-label gift-send-right"><?php echo $_smarty_tpl->__("how_to_send");?>
</div>
    <div class="ty-gift-certificate__switch-mail">
        <input type="hidden" id="send_via" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via'], ENT_QUOTES, 'UTF-8');?>
" />
        <div class="ty-gift-certificate__send">
            <input type="radio" name="gift_cert_data[send_via]" value="E" <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add"||$_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via']=="E") {?>checked="checked"<?php }?> class="radio" id="sw_gc_switcher_suffix_e" /><label for="sw_gc_switcher_suffix_e" class="ty-valign"><?php echo $_smarty_tpl->__("send_via_email");?>
</label>
        </div>
        <div class="ty-gift-certificate__send">
            <input type="radio" name="gift_cert_data[send_via]" value="P" <?php if ($_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via']=="P") {?>checked="checked"<?php }?> class="radio" id="sw_gc_switcher_suffix_p" /><label for="sw_gc_switcher_suffix_p" class="ty-valign"><?php echo $_smarty_tpl->__("send_via_postal_mail");?>
</label>
        </div>
    </div>
</div>

<div id="gc_switcher">

    <div class="ty-gift-certificate__block <?php if ($_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via']=="P") {?> hidden<?php }?>" id="email_block">
        <div class="ty-control-group">
            <label for="gift_cert_email" class="cm-required cm-email ty-control-group__title"><?php echo $_smarty_tpl->__("email");?>
</label>
            <input type="text" id="gift_cert_email" name="gift_cert_data[email]" class="ty-input-text-full" size="40" maxlength="128" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['email'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>
        <div class="ty-control-group">
            <?php if (smarty_modifier_sizeof($_smarty_tpl->tpl_vars['templates']->value)>1) {?>
                <label for="gift_cert_template" class="ty-control-group__title"><?php echo $_smarty_tpl->__("template");?>
</label>
                <select id="gift_cert_template" name="gift_cert_data[template]">
                <?php  $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["name"]->_loop = false;
 $_smarty_tpl->tpl_vars["file"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['templates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["name"]->key => $_smarty_tpl->tpl_vars["name"]->value) {
$_smarty_tpl->tpl_vars["name"]->_loop = true;
 $_smarty_tpl->tpl_vars["file"]->value = $_smarty_tpl->tpl_vars["name"]->key;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['file']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['file']->value==$_smarty_tpl->tpl_vars['gift_cert_data']->value['template']) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
                </select>
            <?php } else { ?>
                <?php  $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["name"]->_loop = false;
 $_smarty_tpl->tpl_vars["file"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['templates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["name"]->key => $_smarty_tpl->tpl_vars["name"]->value) {
$_smarty_tpl->tpl_vars["name"]->_loop = true;
 $_smarty_tpl->tpl_vars["file"]->value = $_smarty_tpl->tpl_vars["name"]->key;
?>
                    <input id="gift_cert_template" type="hidden" name="gift_cert_data[template]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['file']->value, ENT_QUOTES, 'UTF-8');?>
" />
                <?php } ?>
            <?php }?>
        </div>
    </div>

    <div class="ty-gift-certificate__block<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add"||$_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via']=="E") {?> hidden<?php }?>" id="post_block">

        <div class="ty-control-group">
            <label for="gift_cert_phone" class="ty-control-group__title cm-mask-phone-label"><?php echo $_smarty_tpl->__("phone");?>
</label>
            <input type="text" id="gift_cert_phone" class="ty-input-text-full cm-mask-phone" name="gift_cert_data[phone]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['phone'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

        <div class="ty-control-group">
            <label for="gift_cert_address" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("address");?>
</label>
            <input type="text" id="gift_cert_address" name="gift_cert_data[address]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['address'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

        <div class="ty-control-group">
            <input type="text" id="gift_cert_address_2" name="gift_cert_data[address_2]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['address_2'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

        <div class="ty-control-group">
            <label for="gift_cert_city" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("city");?>
</label>
            <input type="text" id="gift_cert_city" name="gift_cert_data[city]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['city'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

        <?php $_smarty_tpl->tpl_vars['_country'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_data']->value['country'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['Checkout']['default_country'] : $tmp), null, 0);?>
        <div class="ty-control-group ty-float-left ty-gift-certificate__country country">
            <label for="gift_cert_country" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("country");?>
</label>
            <select id="gift_cert_country" name="gift_cert_data[country]" class="ty-gift-certificate__select cm-country cm-location-billing" >
                <option value="">- <?php echo $_smarty_tpl->__("select_country");?>
 -</option>
                <?php  $_smarty_tpl->tpl_vars["country"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["country"]->_loop = false;
 $_smarty_tpl->tpl_vars["code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['countries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["country"]->key => $_smarty_tpl->tpl_vars["country"]->value) {
$_smarty_tpl->tpl_vars["country"]->_loop = true;
 $_smarty_tpl->tpl_vars["code"]->value = $_smarty_tpl->tpl_vars["country"]->key;
?>
                <option <?php if ($_smarty_tpl->tpl_vars['_country']->value==$_smarty_tpl->tpl_vars['code']->value) {?>selected="selected"<?php }?> value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['country']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
            </select>
        </div>

        <?php $_smarty_tpl->tpl_vars['_state'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_data']->value['state'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['Checkout']['default_state'] : $tmp), null, 0);?>
        <div class="ty-control-group ty-float-right ty-gift-certificate__state state">
            <label for="gift_cert_state" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("state");?>
</label>
            <select class="ty-gift-certificate__select cm-state cm-location-billing" id="gift_cert_state" name="gift_cert_data[state]">
                <option value="">- <?php echo $_smarty_tpl->__("select_state");?>
 -</option>
                <?php if ($_smarty_tpl->tpl_vars['states']->value&&$_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>
                    <?php  $_smarty_tpl->tpl_vars['state'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['state']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['state']->key => $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['code'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['_state']->value==$_smarty_tpl->tpl_vars['state']->value['code']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['state'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                <?php }?>
            </select>
            <input type="text" id="gift_cert_state_d" name="gift_cert_data[state]" class="cm-state cm-location-billing ty-input-text hidden" size="50" maxlength="64" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_state']->value, ENT_QUOTES, 'UTF-8');?>
" disabled="disabled"  />
        </div>

        <div class="ty-control-group ty-billing-zip-code">
            <label for="gift_cert_zipcode" class="ty-control-group__title cm-required cm-zipcode cm-location-billing"><?php echo $_smarty_tpl->__("zip_postal_code");?>
</label>
            <input type="text" id="gift_cert_zipcode" name="gift_cert_data[zipcode]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['zipcode'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

    </div>

    <div class="ty-gift-certificate__block">
        <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"gift_certificates"), 0);?>

    </div>

</div>

<div class="ty-gift-certificate__buttons buttons-container">

<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add") {?>
    <input type="hidden" name="result_ids" value="cart_status*,wish_list*,account_info*,gift_certificate*" />
    <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"gift_certificates:buttons")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"gift_certificates:buttons"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo $_smarty_tpl->getSubTemplate ("buttons/add_to_cart.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[gift_certificates.add]",'but_role'=>"action"), 0);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"gift_certificates:buttons"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php } else { ?>
    <?php echo $_smarty_tpl->getSubTemplate ("buttons/save.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[gift_certificates.update]"), 0);?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['templates']->value) {?>
    <div class="ty-float-right ty-gift-certificate__preview-btn">
    <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("preview"),'but_name'=>"dispatch[gift_certificates.preview]",'but_role'=>"submit",'but_meta'=>"ty-btn__tertiary cm-new-window"), 0);?>

    </div>
<?php }?>
</div>

</form>
<!--gift_certificate_<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_id']->value)===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
--></div>


<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add") {
echo $_smarty_tpl->__("purchase_gift_certificate");
} else {
echo $_smarty_tpl->__("gift_certificate");
}
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/gift_certificates/views/gift_certificates/update.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/gift_certificates/views/gift_certificates/update.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
ob_start();?><?php echo smarty_modifier_format_price($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['min_amount'],$_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['min_amount'] = new Smarty_variable($_tmp3, null, 0);?>
<?php ob_start();?><?php echo smarty_modifier_format_price($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['max_amount'],$_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]);?>
<?php $_tmp4=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['max_amount'] = new Smarty_variable($_tmp4, null, 0);?>

<?php $_smarty_tpl->tpl_vars['text_gift_cert_amount_alert'] = new Smarty_variable($_smarty_tpl->__("text_gift_cert_amount_alert",array("[min]"=>$_smarty_tpl->tpl_vars['min_amount']->value,"[max]"=>$_smarty_tpl->tpl_vars['max_amount']->value)), null, 0);?>

<?php echo '<script'; ?>
 type="text/javascript">
(function(_, $) {

    var max_amount = '<?php echo strtr($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['max_amount'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
';
    var min_amount = '<?php echo strtr($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['min_amount'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
';
    var send_via = '<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via'])===null||$tmp==='' ? "E" : $tmp), ENT_QUOTES, 'UTF-8');?>
';

    $.ceEvent('on', 'ce.commoninit', function() {

        $.ceFormValidator('registerValidator', {
            class_name: 'cm-gc-validate-amount',
            message: '',
            func: function(id) {
                var max = parseFloat(max_amount);
                var min = parseFloat(min_amount);

                var amount = parseFloat($('#' + id).autoNumeric('get'));
                if ((amount <= max) && (amount >= min)) {
                    return true;
                }

                return false;
            }
        });

        if ($('#send_via').val() == 'P') {
            send_via = 'P';
            $('#post_block').switchAvailability(false, true);
        } else {
            send_via = 'E';
            $('#email_block').switchAvailability(false, true);
        }

        $('#' + (send_via == 'E' ? 'post' : 'email') + '_block').switchAvailability(true, true);

        $(_.doc).on('click', 'input[name="gift_cert_data[send_via]"]', function() {
            if ($(this).val() == 'P') {
                $('#send_via').val('P');
            } else {
                $('#send_via').val('');
            }

            $('#email_block').switchAvailability($(this).val() == 'P', true);
            $('#post_block').switchAvailability($(this).val() == 'E', true);
        });
    });
}(Tygh, Tygh.$));
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="ty-gift-certificate" id="gift_certificate_<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_id']->value)===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
">

<?php if (!$_smarty_tpl->tpl_vars['config']->value['tweaks']['disable_dhtml']&&!$_smarty_tpl->tpl_vars['no_ajax']->value&&$_smarty_tpl->tpl_vars['runtime']->value['mode']!="update") {?>
    <?php $_smarty_tpl->tpl_vars["is_ajax"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<form <?php if ($_smarty_tpl->tpl_vars['is_ajax']->value) {?>class="cm-ajax cm-ajax-full-render" <?php }?>action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" target="_self" name="gift_certificates_form">
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="update") {?>
<input type="hidden" name="gift_cert_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_id']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="type" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value, ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['is_ajax']->value) {?>
<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>

<div class="ty-control-group">
    <label for="gift_cert_recipient" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("recipients_name");?>
</label>
    <input type="text" id="gift_cert_recipient" name="gift_cert_data[recipient]" class="ty-input-text-full cm-focus" size="50" maxlength="255" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['recipient'], ENT_QUOTES, 'UTF-8');?>
" />
</div>

<div class="ty-control-group">
    <label for="gift_cert_sender" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("purchasers_name");?>
</label>
    <input type="text" id="gift_cert_sender" name="gift_cert_data[sender]" class="ty-input-text-full" size="50" maxlength="255" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['sender'], ENT_QUOTES, 'UTF-8');?>
" />
</div>

<div class="ty-control-group ty-gift-certificate__amount">
    <?php $_smarty_tpl->tpl_vars['base_currency'] = new Smarty_variable($_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value], null, 0);?>
    <label for="gift_cert_amount" class="ty-control-group__title cm-required cm-gc-validate-amount"><?php echo $_smarty_tpl->__("amount");?>
</label>
    
    <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['after']=="N") {?>
        <span class="ty-gift-certificate__currency"><?php echo $_smarty_tpl->tpl_vars['base_currency']->value['symbol'];?>
</span>
    <?php }?>
    
    <input 
        type="text"
        id="gift_cert_amount"
        name="gift_cert_data[amount]"
        class="ty-gift-certificate__amount-input cm-numeric"
        data-p-sign="s"
        data-a-sep="<?php if ($_smarty_tpl->tpl_vars['base_currency']->value['thousands_separator']) {
echo $_smarty_tpl->tpl_vars['base_currency']->value['thousands_separator'];
}?>"
        data-m-dec="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['base_currency']->value['decimals'], ENT_QUOTES, 'UTF-8');?>
"
        <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['decimals_separator']) {?> data-a-dec="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['base_currency']->value['decimals_separator'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
        size="5"
        value="<?php if ($_smarty_tpl->tpl_vars['gift_cert_data']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['amount'], ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['min_amount'], ENT_QUOTES, 'UTF-8');
}?>" />
    
    <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['after']=="Y") {?>
        <span class="ty-gift-certificate__currency"><?php echo $_smarty_tpl->tpl_vars['base_currency']->value['symbol'];?>
</span>
    <?php }?>
    
    <div class="ty-gift-certificate__amount-alert form-field-desc"><?php echo $_smarty_tpl->tpl_vars['text_gift_cert_amount_alert']->value;?>
</div>
</div>

<div class="ty-control-group">
    <label for="gift_cert_message" class="ty-control-group__title"><?php echo $_smarty_tpl->__("gift_comment");?>
</label>
    <textarea id="gift_cert_message" name="gift_cert_data[message]" cols="72" rows="4" class="ty-input-text-full" <?php if ($_smarty_tpl->tpl_vars['is_text']->value=="Y") {?>readonly="readonly"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['message'], ENT_QUOTES, 'UTF-8');?>
</textarea>
</div>

<?php if ($_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['free_products_allow']=="Y") {?>
    <div class="ty-gift-certificate__products ty-control-group">
        <?php echo $_smarty_tpl->getSubTemplate ("pickers/products/picker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('data_id'=>"free_products",'item_ids'=>$_smarty_tpl->tpl_vars['gift_cert_data']->value['products'],'input_name'=>"gift_cert_data[products]",'type'=>"table",'no_item_text'=>$_smarty_tpl->__("text_no_products_defined"),'holder_name'=>"gift_certificates",'but_role'=>"text",'but_meta'=>"ty-btn__tertiary",'but_text'=>$_smarty_tpl->__("gift_add_products"),'no_container'=>true,'icon_plus'=>true), 0);?>

    </div>
<?php }?>

<div class="ty-gift-certificate__switch clearfix">
    <div class="ty-gift-certificate__switch-label gift-send-right"><?php echo $_smarty_tpl->__("how_to_send");?>
</div>
    <div class="ty-gift-certificate__switch-mail">
        <input type="hidden" id="send_via" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via'], ENT_QUOTES, 'UTF-8');?>
" />
        <div class="ty-gift-certificate__send">
            <input type="radio" name="gift_cert_data[send_via]" value="E" <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add"||$_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via']=="E") {?>checked="checked"<?php }?> class="radio" id="sw_gc_switcher_suffix_e" /><label for="sw_gc_switcher_suffix_e" class="ty-valign"><?php echo $_smarty_tpl->__("send_via_email");?>
</label>
        </div>
        <div class="ty-gift-certificate__send">
            <input type="radio" name="gift_cert_data[send_via]" value="P" <?php if ($_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via']=="P") {?>checked="checked"<?php }?> class="radio" id="sw_gc_switcher_suffix_p" /><label for="sw_gc_switcher_suffix_p" class="ty-valign"><?php echo $_smarty_tpl->__("send_via_postal_mail");?>
</label>
        </div>
    </div>
</div>

<div id="gc_switcher">

    <div class="ty-gift-certificate__block <?php if ($_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via']=="P") {?> hidden<?php }?>" id="email_block">
        <div class="ty-control-group">
            <label for="gift_cert_email" class="cm-required cm-email ty-control-group__title"><?php echo $_smarty_tpl->__("email");?>
</label>
            <input type="text" id="gift_cert_email" name="gift_cert_data[email]" class="ty-input-text-full" size="40" maxlength="128" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['email'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>
        <div class="ty-control-group">
            <?php if (smarty_modifier_sizeof($_smarty_tpl->tpl_vars['templates']->value)>1) {?>
                <label for="gift_cert_template" class="ty-control-group__title"><?php echo $_smarty_tpl->__("template");?>
</label>
                <select id="gift_cert_template" name="gift_cert_data[template]">
                <?php  $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["name"]->_loop = false;
 $_smarty_tpl->tpl_vars["file"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['templates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["name"]->key => $_smarty_tpl->tpl_vars["name"]->value) {
$_smarty_tpl->tpl_vars["name"]->_loop = true;
 $_smarty_tpl->tpl_vars["file"]->value = $_smarty_tpl->tpl_vars["name"]->key;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['file']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['file']->value==$_smarty_tpl->tpl_vars['gift_cert_data']->value['template']) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
                </select>
            <?php } else { ?>
                <?php  $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["name"]->_loop = false;
 $_smarty_tpl->tpl_vars["file"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['templates']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["name"]->key => $_smarty_tpl->tpl_vars["name"]->value) {
$_smarty_tpl->tpl_vars["name"]->_loop = true;
 $_smarty_tpl->tpl_vars["file"]->value = $_smarty_tpl->tpl_vars["name"]->key;
?>
                    <input id="gift_cert_template" type="hidden" name="gift_cert_data[template]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['file']->value, ENT_QUOTES, 'UTF-8');?>
" />
                <?php } ?>
            <?php }?>
        </div>
    </div>

    <div class="ty-gift-certificate__block<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add"||$_smarty_tpl->tpl_vars['gift_cert_data']->value['send_via']=="E") {?> hidden<?php }?>" id="post_block">

        <div class="ty-control-group">
            <label for="gift_cert_phone" class="ty-control-group__title cm-mask-phone-label"><?php echo $_smarty_tpl->__("phone");?>
</label>
            <input type="text" id="gift_cert_phone" class="ty-input-text-full cm-mask-phone" name="gift_cert_data[phone]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['phone'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

        <div class="ty-control-group">
            <label for="gift_cert_address" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("address");?>
</label>
            <input type="text" id="gift_cert_address" name="gift_cert_data[address]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['address'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

        <div class="ty-control-group">
            <input type="text" id="gift_cert_address_2" name="gift_cert_data[address_2]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['address_2'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

        <div class="ty-control-group">
            <label for="gift_cert_city" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("city");?>
</label>
            <input type="text" id="gift_cert_city" name="gift_cert_data[city]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['city'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

        <?php $_smarty_tpl->tpl_vars['_country'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_data']->value['country'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['Checkout']['default_country'] : $tmp), null, 0);?>
        <div class="ty-control-group ty-float-left ty-gift-certificate__country country">
            <label for="gift_cert_country" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("country");?>
</label>
            <select id="gift_cert_country" name="gift_cert_data[country]" class="ty-gift-certificate__select cm-country cm-location-billing" >
                <option value="">- <?php echo $_smarty_tpl->__("select_country");?>
 -</option>
                <?php  $_smarty_tpl->tpl_vars["country"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["country"]->_loop = false;
 $_smarty_tpl->tpl_vars["code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['countries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["country"]->key => $_smarty_tpl->tpl_vars["country"]->value) {
$_smarty_tpl->tpl_vars["country"]->_loop = true;
 $_smarty_tpl->tpl_vars["code"]->value = $_smarty_tpl->tpl_vars["country"]->key;
?>
                <option <?php if ($_smarty_tpl->tpl_vars['_country']->value==$_smarty_tpl->tpl_vars['code']->value) {?>selected="selected"<?php }?> value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['country']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
            </select>
        </div>

        <?php $_smarty_tpl->tpl_vars['_state'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_data']->value['state'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['Checkout']['default_state'] : $tmp), null, 0);?>
        <div class="ty-control-group ty-float-right ty-gift-certificate__state state">
            <label for="gift_cert_state" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("state");?>
</label>
            <select class="ty-gift-certificate__select cm-state cm-location-billing" id="gift_cert_state" name="gift_cert_data[state]">
                <option value="">- <?php echo $_smarty_tpl->__("select_state");?>
 -</option>
                <?php if ($_smarty_tpl->tpl_vars['states']->value&&$_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>
                    <?php  $_smarty_tpl->tpl_vars['state'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['state']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['state']->key => $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['code'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['_state']->value==$_smarty_tpl->tpl_vars['state']->value['code']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['state'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                <?php }?>
            </select>
            <input type="text" id="gift_cert_state_d" name="gift_cert_data[state]" class="cm-state cm-location-billing ty-input-text hidden" size="50" maxlength="64" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_state']->value, ENT_QUOTES, 'UTF-8');?>
" disabled="disabled"  />
        </div>

        <div class="ty-control-group ty-billing-zip-code">
            <label for="gift_cert_zipcode" class="ty-control-group__title cm-required cm-zipcode cm-location-billing"><?php echo $_smarty_tpl->__("zip_postal_code");?>
</label>
            <input type="text" id="gift_cert_zipcode" name="gift_cert_data[zipcode]" class="ty-input-text-full" size="50" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_cert_data']->value['zipcode'], ENT_QUOTES, 'UTF-8');?>
" />
        </div>

    </div>

    <div class="ty-gift-certificate__block">
        <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"gift_certificates"), 0);?>

    </div>

</div>

<div class="ty-gift-certificate__buttons buttons-container">

<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add") {?>
    <input type="hidden" name="result_ids" value="cart_status*,wish_list*,account_info*,gift_certificate*" />
    <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"gift_certificates:buttons")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"gift_certificates:buttons"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php echo $_smarty_tpl->getSubTemplate ("buttons/add_to_cart.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[gift_certificates.add]",'but_role'=>"action"), 0);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"gift_certificates:buttons"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php } else { ?>
    <?php echo $_smarty_tpl->getSubTemplate ("buttons/save.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[gift_certificates.update]"), 0);?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['templates']->value) {?>
    <div class="ty-float-right ty-gift-certificate__preview-btn">
    <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("preview"),'but_name'=>"dispatch[gift_certificates.preview]",'but_role'=>"submit",'but_meta'=>"ty-btn__tertiary cm-new-window"), 0);?>

    </div>
<?php }?>
</div>

</form>
<!--gift_certificate_<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['gift_cert_id']->value)===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
--></div>


<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add") {
echo $_smarty_tpl->__("purchase_gift_certificate");
} else {
echo $_smarty_tpl->__("gift_certificate");
}
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?><?php }} ?>
