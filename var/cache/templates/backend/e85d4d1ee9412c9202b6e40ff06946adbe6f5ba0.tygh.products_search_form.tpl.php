<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:13:13
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\products\components\products_search_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6029212535daf1c89c842d4-77673091%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e85d4d1ee9412c9202b6e40ff06946adbe6f5ba0' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\products\\components\\products_search_form.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '6029212535daf1c89c842d4-77673091',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'in_popup' => 0,
    'page_part' => 0,
    '_page_part' => 0,
    'product_search_form_prefix' => 0,
    'form_meta' => 0,
    'search_type' => 0,
    'selected_section' => 0,
    'put_request_vars' => 0,
    'extra' => 0,
    'search' => 0,
    'primary_currency' => 0,
    'currencies' => 0,
    'picker_selected_companies' => 0,
    's_cid' => 0,
    'runtime' => 0,
    'category_data' => 0,
    'search_cat' => 0,
    'trunc' => 0,
    'close_optgroup' => 0,
    'filter_items' => 0,
    'feature_items' => 0,
    'feature_items_too_many' => 0,
    'settings' => 0,
    'ff' => 0,
    'have_amount_filter' => 0,
    'picker_selected_company' => 0,
    'dispatch' => 0,
    'is_order_management' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c8a280a07_52204709',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c8a280a07_52204709')) {function content_5daf1c8a280a07_52204709($_smarty_tpl) {?><?php if (!is_callable('smarty_function_array_to_fields')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.array_to_fields.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_modifier_truncate')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.truncate.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('search','find_results_with','price','search_in_category','all_categories','all_categories','search_in','product_name','short_description','full_description','keywords','search_by_product_filters','search_by_product_features','error_features_too_many_variants','search_by_sku','popularity','ttc_popularity','subcategories','shipping_freight','weight','quantity','free_shipping','yes','no','status','active','hidden','disabled','purchased_in_orders','no_items','sort_by','list_price','name','price','sku','quantity','status','desc','asc','creation_date','updated_last','hour_or_hours'));
?>
<?php if ($_smarty_tpl->tpl_vars['in_popup']->value) {?>
    <div class="adv-search">
    <div class="group">
<?php } else { ?>
    <div class="sidebar-row">
    <h6><?php echo $_smarty_tpl->__("search");?>
</h6>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['page_part']->value) {?>
    <?php $_smarty_tpl->tpl_vars["_page_part"] = new Smarty_variable("#".((string)$_smarty_tpl->tpl_vars['page_part']->value), null, 0);?>
<?php }?>

<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['_page_part']->value, ENT_QUOTES, 'UTF-8');?>
" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_search_form_prefix']->value, ENT_QUOTES, 'UTF-8');?>
search_form" method="get" class="cm-disable-empty <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_meta']->value, ENT_QUOTES, 'UTF-8');?>
" id="search_form">
<input type="hidden" name="type" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['search_type']->value)===null||$tmp==='' ? "simple" : $tmp), ENT_QUOTES, 'UTF-8');?>
" autofocus="autofocus" />
<?php if ($_REQUEST['redirect_url']) {?>
    <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_REQUEST['redirect_url'], ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['selected_section']->value!='') {?>
    <input type="hidden" id="selected_section" name="selected_section" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_section']->value, ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<input type="hidden" name="pcode_from_q" value="Y" />

<?php if ($_smarty_tpl->tpl_vars['put_request_vars']->value) {?>
    <?php echo smarty_function_array_to_fields(array('data'=>$_REQUEST,'skip'=>array("callback")),$_smarty_tpl);?>

<?php }?>

<?php echo $_smarty_tpl->tpl_vars['extra']->value;?>


<?php $_smarty_tpl->_capture_stack[0][] = array("simple_search", null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:simple_search")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:simple_search"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="sidebar-field">
        <label><?php echo $_smarty_tpl->__("find_results_with");?>
</label>
        <input type="text" name="q" size="20" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['q'], ENT_QUOTES, 'UTF-8');?>
" />
    </div>

    <div class="sidebar-field">
        <label><?php echo $_smarty_tpl->__("price");?>
&nbsp;(<?php echo $_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]['symbol'];?>
)</label>
        <input type="text" name="price_from" size="1" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['price_from'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-small" /> - <input type="text" size="1" name="price_to" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['price_to'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-small" />
    </div>

    <div class="sidebar-field">
        <label><?php echo $_smarty_tpl->__("search_in_category");?>
</label>
        <?php if (fn_show_picker("categories",@constant('CATEGORY_THRESHOLD'))) {?>
            <?php if ($_smarty_tpl->tpl_vars['search']->value['cid']) {?>
                <?php $_smarty_tpl->tpl_vars["s_cid"] = new Smarty_variable($_smarty_tpl->tpl_vars['search']->value['cid'], null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["s_cid"] = new Smarty_variable("0", null, 0);?>
            <?php }?>
            <div class="controls">
            <?php echo $_smarty_tpl->getSubTemplate ("pickers/categories/picker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('company_ids'=>$_smarty_tpl->tpl_vars['picker_selected_companies']->value,'data_id'=>"location_category",'input_name'=>"cid",'item_ids'=>$_smarty_tpl->tpl_vars['s_cid']->value,'hide_link'=>true,'hide_delete_button'=>true,'default_name'=>$_smarty_tpl->__("all_categories"),'extra'=>''), 0);?>

            </div>
        <?php } else { ?>
            <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="picker") {?>
                <?php $_smarty_tpl->tpl_vars["trunc"] = new Smarty_variable("38", null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["trunc"] = new Smarty_variable("25", null, 0);?>
            <?php }?>
            <select name="cid">
                <option value="0" <?php if ($_smarty_tpl->tpl_vars['category_data']->value['parent_id']=="0") {?>selected="selected"<?php }?>>- <?php echo $_smarty_tpl->__("all_categories");?>
 -</option>
                <?php  $_smarty_tpl->tpl_vars["search_cat"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["search_cat"]->_loop = false;
 $_from = fn_get_plain_categories_tree(0,false,@constant('CART_LANGUAGE'),$_smarty_tpl->tpl_vars['picker_selected_companies']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["search_cat"]->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars["search_cat"]->key => $_smarty_tpl->tpl_vars["search_cat"]->value) {
$_smarty_tpl->tpl_vars["search_cat"]->_loop = true;
 $_smarty_tpl->tpl_vars["search_cat"]->index++;
 $_smarty_tpl->tpl_vars["search_cat"]->first = $_smarty_tpl->tpl_vars["search_cat"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['search_cat']['first'] = $_smarty_tpl->tpl_vars["search_cat"]->first;
?>
                <?php if ($_smarty_tpl->tpl_vars['search_cat']->value['store']) {?>
                <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['search_cat']['first']) {?>
                    </optgroup>
                <?php }?>

                <optgroup label="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_cat']->value['category'], ENT_QUOTES, 'UTF-8');?>
">
                    <?php $_smarty_tpl->tpl_vars["close_optgroup"] = new Smarty_variable(true, null, 0);?>
                    <?php } else { ?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_cat']->value['category_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['search_cat']->value['disabled']) {?>disabled="disabled"<?php }?> <?php if ($_smarty_tpl->tpl_vars['search']->value['cid']==$_smarty_tpl->tpl_vars['search_cat']->value['category_id']) {?>selected="selected"<?php }?> title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_cat']->value['category'], ENT_QUOTES, 'UTF-8');?>
"><?php echo preg_replace('!^!m',str_repeat("&#166;&nbsp;&nbsp;&nbsp;&nbsp;",$_smarty_tpl->tpl_vars['search_cat']->value['level']),smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['search_cat']->value['category'], ENT_QUOTES, 'UTF-8', true),$_smarty_tpl->tpl_vars['trunc']->value,"...",true));?>
</option>
                    <?php }?>
                    <?php } ?>
                    <?php if ($_smarty_tpl->tpl_vars['close_optgroup']->value) {?>
                </optgroup>
                <?php }?>
            </select>
        <?php }?>
    </div>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:simple_search"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("advanced_search", null, null); ob_start(); ?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:advanced_search")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:advanced_search"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="group form-horizontal">
    <div class="control-group">
    <label><?php echo $_smarty_tpl->__("search_in");?>
</label>
    <div class="table-wrapper">
        <table width="100%">
            <tr class="nowrap">
                <td><label for="pname" class="checkbox inline"><input type="checkbox" value="Y" <?php if ($_smarty_tpl->tpl_vars['search']->value['pname']=="Y") {?>checked="checked"<?php }?> name="pname" id="pname" /><?php echo $_smarty_tpl->__("product_name");?>
</label></td>
                <td><label for="pshort" class="checkbox inline"><input type="checkbox" value="Y" <?php if ($_smarty_tpl->tpl_vars['search']->value['pshort']=="Y") {?>checked="checked"<?php }?> name="pshort" id="pshort"  /><?php echo $_smarty_tpl->__("short_description");?>
</label></td>
                <td><label for="pfull" class="checkbox  inline"><input type="checkbox" value="Y" <?php if ($_smarty_tpl->tpl_vars['search']->value['pfull']=="Y") {?>checked="checked"<?php }?> name="pfull" id="pfull" /><?php echo $_smarty_tpl->__("full_description");?>
</label></td>
                <td><label for="pkeywords" class="checkbox  inline"><input type="checkbox" value="Y" <?php if ($_smarty_tpl->tpl_vars['search']->value['pkeywords']=="Y") {?>checked="checked"<?php }?> name="pkeywords" id="pkeywords"  /><?php echo $_smarty_tpl->__("keywords");?>
</label></td>
            </tr>
        </table>
    </div>
    </div>
</div>

<div class="group form-horizontal">
<?php if (!fn_allowed_for("ULTIMATE:FREE")&&$_smarty_tpl->tpl_vars['filter_items']->value) {?>
<div class="control-group">

    <a href="#" class="search-link cm-combination open cm-save-state" id="sw_filter">
    <span id="on_filter" class="icon-caret-right cm-save-state <?php if ($_COOKIE['filter']) {?>hidden<?php }?>"> </span>
    <span id="off_filter" class="icon-caret-down cm-save-state <?php if (!$_COOKIE['filter']) {?>hidden<?php }?>"></span>
    <?php echo $_smarty_tpl->__("search_by_product_filters");?>
</a>

    <div id="filter"<?php if (!$_COOKIE['filter']) {?> class="hidden"<?php }?>>
        <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/advanced_search_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('filter_features'=>$_smarty_tpl->tpl_vars['filter_items']->value,'prefix'=>"filter_",'data_name'=>"filter_variants"), 0);?>

    </div>
</div>
<?php }?>
</div>

<?php if ($_smarty_tpl->tpl_vars['feature_items']->value) {?>
<div class="group form-horizontal">
    <div class="control-group">

        <a class="search-link cm-combination nowrap open cm-save-state" id="sw_feature"><span id="on_feature" class="cm-combination cm-save-state <?php if ($_COOKIE['feature']) {?>hidden<?php }?>"><span class="icon-caret-right"></span></span><span id="off_feature" class="cm-combination cm-save-state <?php if (!$_COOKIE['feature']) {?>hidden<?php }?>"><span class="icon-caret-down"></span></span><?php echo $_smarty_tpl->__("search_by_product_features");?>
</a>

        <div id="feature"<?php if (!$_COOKIE['feature']) {?> class="hidden"<?php }?>>
            <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/advanced_search_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('filter_features'=>$_smarty_tpl->tpl_vars['feature_items']->value,'prefix'=>"feature_",'data_name'=>"feature_variants"), 0);?>

        </div>
    </div>
</div>
<?php } elseif ($_smarty_tpl->tpl_vars['feature_items_too_many']->value) {?>
<div class="group form-horizontal">
    <?php echo $_smarty_tpl->__("error_features_too_many_variants");?>

</div>
<?php }?>

<div class="row-fluid">
<div class="group span6">
    <div class="form-horizontal">
        <div class="control-group">
            <label for="pcode" class="control-label"><?php echo $_smarty_tpl->__("search_by_sku");?>
</label>
            <div class="controls">
                <input type="text" name="pcode" id="pcode" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['pcode'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();"/>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="popularity_from"><?php echo $_smarty_tpl->__("popularity");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("ttc_popularity")), 0);?>
</label>
            <div class="controls">
                <input type="text" name="popularity_from" id="popularity_from" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['popularity_from'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-mini" /> - <input type="text" name="popularity_to" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['popularity_to'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-mini" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="subcats"><?php echo $_smarty_tpl->__("subcategories");?>
</label>
            <div class="controls">
                <input type="hidden" name="subcats" value="N" />
                <input type="checkbox" value="Y"<?php if ($_smarty_tpl->tpl_vars['search']->value['subcats']=="Y"||!$_smarty_tpl->tpl_vars['search']->value['subcats']) {?> checked="checked"<?php }?> name="subcats"  id="subcats" />
            </div>
        </div>
    </div>
</div>

<div class="group span6 form-horizontal">
    <div class="control-group">
        <label class="control-label" for="shipping_freight_from"><?php echo $_smarty_tpl->__("shipping_freight");?>
&nbsp;(<?php echo $_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]['symbol'];?>
)</label>
        <div class="controls">
            <input type="text" name="shipping_freight_from" id="shipping_freight_from" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['shipping_freight_from'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-mini" /> - <input type="text" name="shipping_freight_to" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['shipping_freight_to'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-mini" />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="weight_from"><?php echo $_smarty_tpl->__("weight");?>
&nbsp;(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value['General']['weight_symbol'], ENT_QUOTES, 'UTF-8');?>
)</label>
        <div class="controls">
            <input type="text" name="weight_from" id="weight_from" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['weight_from'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-mini" /> - <input type="text" name="weight_to" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['weight_to'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-mini" />
        </div>
    </div>

    <?php $_smarty_tpl->tpl_vars["have_amount_filter"] = new Smarty_variable(0, null, 0);?>
    <?php if (!fn_allowed_for("ULTIMATE:FREE")) {?>
        <?php  $_smarty_tpl->tpl_vars["ff"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["ff"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['filter_items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["ff"]->key => $_smarty_tpl->tpl_vars["ff"]->value) {
$_smarty_tpl->tpl_vars["ff"]->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['ff']->value['field_type']=="A") {?>
                <?php $_smarty_tpl->tpl_vars["have_amount_filter"] = new Smarty_variable(1, null, 0);?>
            <?php }?>
        <?php } ?>
    <?php }?>
    <?php if (!$_smarty_tpl->tpl_vars['have_amount_filter']->value) {?>
    <div class="control-group">
        <label class="control-label" for="amount_from"><?php echo $_smarty_tpl->__("quantity");?>
:</label>
        <div class="controls">
            <input type="text" name="amount_from" id="amount_from" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['amount_from'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-mini" /> - <input type="text" name="amount_to" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['amount_to'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-mini" />
        </div>
    </div>
    <?php }?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"companies:products_advanced_search")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"companies:products_advanced_search"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if (fn_string_not_empty($_smarty_tpl->tpl_vars['picker_selected_company']->value)) {?>
        <input type="hidden" name="company_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['picker_selected_company']->value, ENT_QUOTES, 'UTF-8');?>
" />
    <?php } else { ?>
        <?php echo $_smarty_tpl->getSubTemplate ("common/select_vendor.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"companies:products_advanced_search"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


</div>
</div>

<div class="row-fluid">
    <div class="group span6 form-horizontal">
        <div class="control-group">
            <label class="control-label" for="free_shipping"><?php echo $_smarty_tpl->__("free_shipping");?>
</label>
            <div class="controls">
            <select name="free_shipping" id="free_shipping">
                <option value="">--</option>
                <option value="Y" <?php if ($_smarty_tpl->tpl_vars['search']->value['free_shipping']=="Y") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("yes");?>
</option>
                <option value="N" <?php if ($_smarty_tpl->tpl_vars['search']->value['free_shipping']=="N") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("no");?>
</option>
            </select>
            </div>
        </div>

        <div class="control-group">
            <label for="status" class="control-label"><?php echo $_smarty_tpl->__("status");?>
</label>
            <div class="controls">
            <select name="status" id="status">
                <option value="">--</option>
                <option value="A" <?php if ($_smarty_tpl->tpl_vars['search']->value['status']=="A") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("active");?>
</option>
                <option value="H" <?php if ($_smarty_tpl->tpl_vars['search']->value['status']=="H") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("hidden");?>
</option>
                <option value="D" <?php if ($_smarty_tpl->tpl_vars['search']->value['status']=="D") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("disabled");?>
</option>
            </select>
            </div>
        </div>
                
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:search_form")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:search_form"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:search_form"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </div>

    <div class="group span6 form-horizontal">
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:search_in_orders")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:search_in_orders"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <div class="control-group">
            <label class="control-label" for="popularity_from"><?php echo $_smarty_tpl->__("purchased_in_orders");?>
</label>
            <div class="right">
                <?php echo $_smarty_tpl->getSubTemplate ("pickers/orders/picker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item_ids'=>$_smarty_tpl->tpl_vars['search']->value['order_ids'],'no_item_text'=>$_smarty_tpl->__("no_items"),'data_id'=>"order_ids",'input_name'=>"order_ids",'view_mode'=>"simple"), 0);?>

            </div>
        </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:search_in_orders"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <div class="control-group">
            <label class="control-label" for="sort_by"><?php echo $_smarty_tpl->__("sort_by");?>
</label>
            <div class="controls">
            <select class="select-mini" name="sort_by" id="sort_by">
                <option <?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="list_price") {?>selected="selected"<?php }?> value="list_price"><?php echo $_smarty_tpl->__("list_price");?>
</option>
                <option <?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="product") {?>selected="selected"<?php }?> value="product"><?php echo $_smarty_tpl->__("name");?>
</option>
                <option <?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="price") {?>selected="selected"<?php }?> value="price"><?php echo $_smarty_tpl->__("price");?>
</option>
                <option <?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="code") {?>selected="selected"<?php }?> value="code"><?php echo $_smarty_tpl->__("sku");?>
</option>
                <option <?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="amount") {?>selected="selected"<?php }?> value="amount"><?php echo $_smarty_tpl->__("quantity");?>
</option>
                <option <?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="status") {?>selected="selected"<?php }?> value="status"><?php echo $_smarty_tpl->__("status");?>
</option>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:select_search")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:select_search"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:select_search"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </select> -
            <select class="select-mini" name="sort_order" id="sort_order">
                <option <?php if ($_smarty_tpl->tpl_vars['search']->value['sort_order_rev']=="asc") {?>selected="selected"<?php }?> value="desc"><?php echo $_smarty_tpl->__("desc");?>
</option>
                <option <?php if ($_smarty_tpl->tpl_vars['search']->value['sort_order_rev']=="desc") {?>selected="selected"<?php }?> value="asc"><?php echo $_smarty_tpl->__("asc");?>
</option>
            </select>
            </div>
        </div>
    </div>
</div>

<div class="group form-horizontal">
    <div class="control-group">
        <label class="control-label"><?php echo $_smarty_tpl->__("creation_date");?>
</label>
        <div class="controls">
            <?php echo $_smarty_tpl->getSubTemplate ("common/period_selector.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('period'=>$_smarty_tpl->tpl_vars['search']->value['period'],'form_name'=>((string)$_smarty_tpl->tpl_vars['product_search_form_prefix']->value)."search_form"), 0);?>

        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="group span6 form-horizontal">
        <div class="control-group">
            <label class="control-label" for="updated_in_hours"><?php echo $_smarty_tpl->__("updated_last");?>
</label>
            <div class="controls">
                <input type="text" name="updated_in_hours" id="updated_in_hours" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['updated_in_hours'], ENT_QUOTES, 'UTF-8');?>
" onfocus="this.select();" class="input-mini" />&nbsp;&nbsp;<?php echo $_smarty_tpl->__("hour_or_hours");?>

            </div>
        </div>
    </div>
</div>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:advanced_search"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php echo $_smarty_tpl->getSubTemplate ("common/advanced_search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('simple_search'=>Smarty::$_smarty_vars['capture']['simple_search'],'advanced_search'=>Smarty::$_smarty_vars['capture']['advanced_search'],'dispatch'=>$_smarty_tpl->tpl_vars['dispatch']->value,'view_type'=>"products",'in_popup'=>$_smarty_tpl->tpl_vars['in_popup']->value,'is_order_management'=>$_smarty_tpl->tpl_vars['is_order_management']->value), 0);?>


<!--search_form--></form>
<?php if ($_smarty_tpl->tpl_vars['in_popup']->value) {?>
    </div></div>
<?php } else { ?>
    </div><hr>
<?php }?><?php }} ?>
