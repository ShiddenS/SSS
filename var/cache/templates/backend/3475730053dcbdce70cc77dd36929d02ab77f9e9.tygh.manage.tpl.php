<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:40
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\product_variations\views\product_variations\manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6375545745daf1d94789e98-20760460%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3475730053dcbdce70cc77dd36929d02ab77f9e9' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\product_variations\\views\\product_variations\\manage.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '6375545745daf1d94789e98-20760460',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'runtime' => 0,
    'product' => 0,
    'is_form_readonly' => 0,
    'product_id' => 0,
    'redirect_url' => 0,
    'group' => 0,
    'selected_features' => 0,
    'products' => 0,
    'feature' => 0,
    'primary_currency' => 0,
    'currencies' => 0,
    'variant' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d948fe209_57356934',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d948fe209_57356934')) {function content_5daf1d948fe209_57356934($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('product_variations.manage','product_variations.edit_features','product_variations.delete','actions','product_variations.add_variations','product_variations.add_variations','name','sku','price','quantity','product_variations.add_variations_description'));
?>
<?php $_smarty_tpl->tpl_vars['is_form_readonly'] = new Smarty_variable(($_smarty_tpl->tpl_vars['id']->value&&$_smarty_tpl->tpl_vars['runtime']->value['company_id']&&(fn_allowed_for("MULTIVENDOR")||$_smarty_tpl->tpl_vars['product']->value['shared_product']=="Y")&&$_smarty_tpl->tpl_vars['product']->value['company_id']!=$_smarty_tpl->tpl_vars['runtime']->value['company_id']), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['is_form_readonly']->value) {?>
    <?php $_smarty_tpl->tpl_vars['hide_inputs_if_shared_product'] = new Smarty_variable("cm-hide-inputs", null, 0);?>
    <?php $_smarty_tpl->tpl_vars['no_hide_input_if_shared_product'] = new Smarty_variable("cm-no-hide-input", null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['hide_inputs_if_shared_product'] = new Smarty_variable('', null, 0);?>
    <?php $_smarty_tpl->tpl_vars['no_hide_input_if_shared_product'] = new Smarty_variable('', null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars['redirect_url'] = new Smarty_variable("products.update?product_id=".((string)$_smarty_tpl->tpl_vars['product_id']->value)."&selected_section=variations", null, 0);?>

<div id="content_variations">
    <?php echo smarty_function_script(array('src'=>"js/tygh/backend/products_manage.js"),$_smarty_tpl);?>

    <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="manage_variation_products_form" id="manage_variation_products_form" data-ca-main-content-selector="[data-ca-main-content]" class="js-manage-variation-products-form">
        <input type="hidden" value="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['redirect_url']->value), ENT_QUOTES, 'UTF-8');?>
" name="redirect_url">

        <div class="product-variations__toolbar">
            <div class="product-variations__toolbar-left">
                <?php if ($_smarty_tpl->tpl_vars['group']->value) {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("addons/product_variations/views/product_variations/components/group_code.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('group'=>$_smarty_tpl->tpl_vars['group']->value), 0);?>

                <?php } elseif (!$_smarty_tpl->tpl_vars['is_form_readonly']->value) {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("addons/product_variations/views/product_variations/components/link_to_group.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                <?php }?>
            </div>
            <div class="product-variations__toolbar-right cm-hide-with-inputs">
                <?php if ($_smarty_tpl->tpl_vars['group']->value) {?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
                        <?php if ($_smarty_tpl->tpl_vars['group']->value) {?>
                            <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'id'=>"manage_variations",'text'=>$_smarty_tpl->__("product_variations.manage"),'href'=>"products.manage?variation_group_id=".((string)$_smarty_tpl->tpl_vars['group']->value->getId())."&is_search=Y"));?>
</li>
                            <li><?php ob_start();
echo htmlspecialchars(http_build_query(array("feature_id"=>array_keys($_smarty_tpl->tpl_vars['selected_features']->value))), ENT_QUOTES, 'UTF-8');
$_tmp1=ob_get_clean();?><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'id'=>"edit_variations_features",'text'=>$_smarty_tpl->__("product_variations.edit_features"),'href'=>"product_features.manage?".$_tmp1));?>
</li>

                            <?php if (!$_smarty_tpl->tpl_vars['is_form_readonly']->value) {?>
                                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'id'=>"delete_variations",'class'=>"cm-confirm",'text'=>$_smarty_tpl->__("product_variations.delete"),'href'=>"product_variations.delete?product_id=".((string)$_smarty_tpl->tpl_vars['product_id']->value),'method'=>"POST"));?>
</li>
                            <?php }?>
                        <?php }?>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list'],'icon'=>" ",'text'=>$_smarty_tpl->__("actions")));?>

                <?php }?>
                <?php if (!$_smarty_tpl->tpl_vars['is_form_readonly']->value) {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"update_product_group",'text'=>$_smarty_tpl->__("product_variations.add_variations"),'href'=>"product_variations.update?product_id=".((string)$_smarty_tpl->tpl_vars['product_id']->value),'link_text'=>$_smarty_tpl->__("product_variations.add_variations"),'act'=>"general",'icon'=>"icon-plus",'meta'=>"shift-left"), 0);?>

                <?php }?>
            </div>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
            <div class="object-container product-variations__container">
                <table width="100%" class="table table-middle" data-ca-main-content>
                    <thead>
                    <tr>
                        <th width="2%">&nbsp;</th>
                        <th width="5%" class="product-variations__th-img">&nbsp;</th>
                        <th width="25%" class="nowrap"><span><?php echo $_smarty_tpl->__("name");?>
</span></th>
                        <th width="13%" class="nowrap"><?php echo $_smarty_tpl->__("sku");?>
</th>
                        <?php  $_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['feature']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selected_features']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['feature']->key => $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->_loop = true;
?>
                            <th><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['description'], ENT_QUOTES, 'UTF-8');?>
</span></th>
                        <?php } ?>
                        <th width="13%" class="nowrap"><?php echo $_smarty_tpl->__("price");?>
 (<?php echo $_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]['symbol'];?>
)</th>
                        <th width="9%" class="nowrap"><?php echo $_smarty_tpl->__("quantity");?>
</th>
                        <th width="6%" class="mobile-hide">&nbsp;</th>
                    </tr>
                    </thead>
                    <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
?>
                        <?php if (!$_smarty_tpl->tpl_vars['product']->value['parent_product_id']) {?>
                            <?php if (!$_smarty_tpl->tpl_vars['product']->first) {?>
                                </tbody>
                            <?php }?>

                            <tbody>
                                <?php echo $_smarty_tpl->getSubTemplate ("addons/product_variations/views/product_variations/components/product_item.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                            </tbody>
                            <tbody data-ca-switch-id="product_variations_group_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
">
                        <?php } else { ?>
                            <?php echo $_smarty_tpl->getSubTemplate ("addons/product_variations/views/product_variations/components/product_item.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                        <?php }?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="hidden">
                <?php  $_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['feature']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selected_features']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['feature']->key => $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->_loop = true;
?>
                    <select class="js-product-variation-feature" data-ca-feature-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['feature_id'], ENT_QUOTES, 'UTF-8');?>
">
                        <?php  $_smarty_tpl->tpl_vars['variant'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['variant']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['feature']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['variant']->key => $_smarty_tpl->tpl_vars['variant']->value) {
$_smarty_tpl->tpl_vars['variant']->_loop = true;
?>
                            <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value['variant_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value['variant'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php } ?>
                    </select>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="no-items"><?php echo $_smarty_tpl->__("product_variations.add_variations_description");?>
</p>
        <?php }?>
    </form>
<!--content_variations--></div>
<?php }} ?>
