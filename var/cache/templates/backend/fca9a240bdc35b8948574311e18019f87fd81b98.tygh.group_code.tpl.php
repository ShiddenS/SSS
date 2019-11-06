<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:41
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\product_variations\views\product_variations\components\group_code.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7178830405daf1d95a801d5-63324644%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fca9a240bdc35b8948574311e18019f87fd81b98' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\product_variations\\views\\product_variations\\components\\group_code.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '7178830405daf1d95a801d5-63324644',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'group' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d95aa2fb3_35201247',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d95aa2fb3_35201247')) {function content_5daf1d95aa2fb3_35201247($_smarty_tpl) {?><?php
\Tygh\Languages\Helper::preloadLangVars(array('product_variations.group_code','product_variations.group_code.description','product_variations.group_code.placeholder'));
?>
<input type="hidden" name="variation_group[id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value->getId(), ENT_QUOTES, 'UTF-8');?>
" />
<div class="input-prepend shift-left product-variations__toolbar-code-wrapper">
    <span class="add-on product-variations__toolbar-code-addon"><?php echo $_smarty_tpl->__("product_variations.group_code");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("product_variations.group_code.description")), 0);?>
</span>
    <input class="product-variations__toolbar-code" id="prependedInput" type="text" name="variation_group[code]" data-ca-meta-class="product-variations__toolbar-code product-variations__toolbar-code--text" placeholder="<?php echo $_smarty_tpl->__("product_variations.group_code.placeholder");?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value->getCode(), ENT_QUOTES, 'UTF-8');?>
">
</div><?php }} ?>
