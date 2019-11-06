<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:20:23
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\categories\components\categories_tree_simple.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12124180345db2cc674a44e8-65568705%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e7d014e912b2629a227ee60331daf63f17530ca' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\categories\\components\\categories_tree_simple.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '12124180345db2cc674a44e8-65568705',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'random' => 0,
    'rnd_value' => 0,
    'parent_id' => 0,
    'categories_tree' => 0,
    'cur_cat' => 0,
    'header' => 0,
    'display' => 0,
    'show_all' => 0,
    'expand_all' => 0,
    'runtime' => 0,
    'comb_id' => 0,
    'category' => 0,
    'has_children' => 0,
    'checkbox_name' => 0,
    '_except_id' => 0,
    'level' => 0,
    'radio_class' => 0,
    'shift' => 0,
    'direction' => 0,
    '_shift' => 0,
    'cat_id' => 0,
    'path' => 0,
    'except_id' => 0,
    'ldelim' => 0,
    'rdelim' => 0,
    'title_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2cc676190a4_79818444',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2cc676190a4_79818444')) {function content_5db2cc676190a4_79818444($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.math.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','categories','products','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','disabled'));
?>
<?php echo smarty_function_math(array('equation'=>"rand()",'assign'=>"rnd_value"),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars["random"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['random']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['rnd_value']->value : $tmp), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['parent_id']->value) {?>
<div class="hidden" id="cat_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['parent_id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['random']->value, ENT_QUOTES, 'UTF-8');?>
">
<?php }?>
<?php  $_smarty_tpl->tpl_vars['cur_cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur_cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories_tree']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur_cat']->key => $_smarty_tpl->tpl_vars['cur_cat']->value) {
$_smarty_tpl->tpl_vars['cur_cat']->_loop = true;
?>
<?php $_smarty_tpl->tpl_vars["cat_id"] = new Smarty_variable($_smarty_tpl->tpl_vars['cur_cat']->value['category_id'], null, 0);?>
<?php $_smarty_tpl->tpl_vars["comb_id"] = new Smarty_variable("cat_".((string)$_smarty_tpl->tpl_vars['cur_cat']->value['category_id'])."_".((string)$_smarty_tpl->tpl_vars['random']->value), null, 0);?>
<?php $_smarty_tpl->tpl_vars["title_id"] = new Smarty_variable("category_".((string)$_smarty_tpl->tpl_vars['cur_cat']->value['category_id']), null, 0);?>

<div class="table-wrapper">
    <table width="100%" class="table table-tree table-middle">
    <?php if ($_smarty_tpl->tpl_vars['header']->value&&!$_smarty_tpl->tpl_vars['parent_id']->value) {?>
    <?php $_smarty_tpl->tpl_vars["header"] = new Smarty_variable('', null, 0);?>
    <thead>
    <tr>
        <th>
        <?php if ($_smarty_tpl->tpl_vars['display']->value!="radio") {?>
            <?php echo $_smarty_tpl->getSubTemplate ("common/check_items.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('class'=>"checkbox--large"), 0);?>

        <?php }?>
        </th>
        <th width="84%">
            <?php if ($_smarty_tpl->tpl_vars['show_all']->value) {?>
            <div class="pull-left">
                <span id="on_cat" alt="<?php echo $_smarty_tpl->__("expand_collapse_list");?>
" title="<?php echo $_smarty_tpl->__("expand_collapse_list");?>
" class="hand cm-combinations-cat <?php if ($_smarty_tpl->tpl_vars['expand_all']->value) {?>hidden<?php }?>"><span class="icon-caret-right"> </span></span>
                <span id="off_cat" alt="<?php echo $_smarty_tpl->__("expand_collapse_list");?>
" title="<?php echo $_smarty_tpl->__("expand_collapse_list");?>
" class="hand cm-combinations-cat <?php if (!$_smarty_tpl->tpl_vars['expand_all']->value) {?>hidden<?php }?>"><span class="icon-caret-down"> </span></span>
            </div>
            <?php }?>
            <?php echo $_smarty_tpl->__("categories");?>

        </th>
        <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']) {?>
        <th class="right"><?php echo $_smarty_tpl->__("products");?>
</th>
        <?php }?>
    </tr>
    </thead>
    <?php }?>

    <?php $_smarty_tpl->tpl_vars["level"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['cur_cat']->value['level'])===null||$tmp==='' ? 0 : $tmp), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['has_children'] = new Smarty_variable($_smarty_tpl->tpl_vars['cur_cat']->value['has_children']||$_smarty_tpl->tpl_vars['cur_cat']->value['subcategories'], null, 0);?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"categories:tree_simple_tr")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"categories:tree_simple_tr"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <tr id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
_container"
        class="cm-row-status-<?php echo htmlspecialchars(mb_strtolower($_smarty_tpl->tpl_vars['category']->value['status'], 'UTF-8'), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['has_children']->value) {?> cm-click-on-visible<?php } else { ?> cm-toggle-checked<?php }
if (!$_smarty_tpl->tpl_vars['cur_cat']->value['company_categories']) {?> cm-click-and-close<?php }?> <?php if ($_smarty_tpl->tpl_vars['display']->value=="radio") {?>row-actionable cm-click-and-close-forced<?php }?>"
        <?php if ($_smarty_tpl->tpl_vars['has_children']->value) {?>
        data-ca-target="[data-ca-categories-expand-target]"
        data-ca-search-inner
        data-ca-search-inner-container="#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
_container"
        data-ca-target-checkbox="#input_cat_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category_id'], ENT_QUOTES, 'UTF-8');?>
"

        <?php if ($_smarty_tpl->tpl_vars['display']->value=="radio") {?>
        data-ca-target-combination-container="#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
"
        data-ca-target-combination-expander="#on_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
"
        data-ca-target-combination-fetch-url="<?php echo fn_url("categories.picker?category_id=".((string)$_smarty_tpl->tpl_vars['cur_cat']->value['category_id'])."&random=".((string)$_smarty_tpl->tpl_vars['random']->value)."&display=".((string)$_smarty_tpl->tpl_vars['display']->value)."&checkbox_name=".((string)$_smarty_tpl->tpl_vars['checkbox_name']->value).((string)$_smarty_tpl->tpl_vars['_except_id']->value));?>
"
        data-ca-target-combination-fetch-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
"
        <?php }?>

        <?php } else { ?>
        data-ca-target="#input_cat_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category_id'], ENT_QUOTES, 'UTF-8');?>
"
        <?php }?>
    >
           <?php echo smarty_function_math(array('equation'=>"x*14",'x'=>$_smarty_tpl->tpl_vars['level']->value,'assign'=>"shift"),$_smarty_tpl);?>

        <td class="left first-column" width="1%">
            <?php if ($_smarty_tpl->tpl_vars['cur_cat']->value['company_categories']) {?>
                &nbsp;
                <?php $_smarty_tpl->tpl_vars["comb_id"] = new Smarty_variable("comp_".((string)$_smarty_tpl->tpl_vars['cur_cat']->value['company_id'])."_".((string)$_smarty_tpl->tpl_vars['random']->value), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["title_id"] = new Smarty_variable("c_company_".((string)$_smarty_tpl->tpl_vars['cur_cat']->value['company_id']), null, 0);?>
            <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['display']->value=="radio") {?>
                <input type="radio"
                       id="input_cat_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category_id'], ENT_QUOTES, 'UTF-8');?>
"
                       name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['checkbox_name']->value, ENT_QUOTES, 'UTF-8');?>
"
                       value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category_id'], ENT_QUOTES, 'UTF-8');?>
" 
                       class="cm-item checkbox--large <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['radio_class']->value, ENT_QUOTES, 'UTF-8');?>
"
                />
                <?php } else { ?>
                <input type="checkbox" 
                       id="input_cat_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category_id'], ENT_QUOTES, 'UTF-8');?>
" 
                       name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['checkbox_name']->value, ENT_QUOTES, 'UTF-8');?>
[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category_id'], ENT_QUOTES, 'UTF-8');?>
]" 
                       value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category_id'], ENT_QUOTES, 'UTF-8');?>
" 
                       class="cm-item checkbox--large"
                />
                <?php }?>
            <?php }?>
        </td>
        <?php if ($_smarty_tpl->tpl_vars['cur_cat']->value['has_children']||$_smarty_tpl->tpl_vars['cur_cat']->value['subcategories']) {?>
            <?php echo smarty_function_math(array('equation'=>"x+10",'x'=>$_smarty_tpl->tpl_vars['shift']->value,'assign'=>"_shift"),$_smarty_tpl);?>

        <?php } else { ?>
            <?php echo smarty_function_math(array('equation'=>"x+21",'x'=>$_smarty_tpl->tpl_vars['shift']->value,'assign'=>"_shift"),$_smarty_tpl);?>

        <?php }?>
        <td style="padding-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['direction']->value, ENT_QUOTES, 'UTF-8');?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_shift']->value, ENT_QUOTES, 'UTF-8');?>
px;">
            <?php if ($_smarty_tpl->tpl_vars['cur_cat']->value['has_children']||$_smarty_tpl->tpl_vars['cur_cat']->value['subcategories']) {?>
                <?php if ($_smarty_tpl->tpl_vars['show_all']->value) {?>
                    <span title="<?php echo $_smarty_tpl->__("expand_sublist_of_items");?>
"
                          id="on_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
"
                          class="hand cm-combination-cat cm-uncheck <?php if (isset($_smarty_tpl->tpl_vars['path']->value[$_smarty_tpl->tpl_vars['cat_id']->value])||$_smarty_tpl->tpl_vars['expand_all']->value) {?>hidden<?php }?>"
                          data-ca-categories-expand-target
                    >
                        <span class="icon-caret-right <?php if ($_smarty_tpl->tpl_vars['display']->value=="radio") {?> icon-caret--big<?php }?>"></span>
                    </span>
                <?php } else { ?>
                    <?php if ($_smarty_tpl->tpl_vars['except_id']->value) {?>
                        <?php $_smarty_tpl->tpl_vars["_except_id"] = new Smarty_variable("&except_id=".((string)$_smarty_tpl->tpl_vars['except_id']->value), null, 0);?>
                    <?php }?>
                    <span title="<?php echo $_smarty_tpl->__("expand_sublist_of_items");?>
"
                          id="on_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
"
                          class="hand cm-combination-cat cm-uncheck <?php if ((isset($_smarty_tpl->tpl_vars['path']->value[$_smarty_tpl->tpl_vars['cat_id']->value]))) {?>hidden<?php }?>" 
                          <?php if ($_smarty_tpl->tpl_vars['display']->value!="radio") {?>
                          onclick="if (!Tygh.$('#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
').children().length) Tygh.$.ceAjax('request', '<?php echo fn_url("categories.picker?category_id=".((string)$_smarty_tpl->tpl_vars['cur_cat']->value['category_id'])."&random=".((string)$_smarty_tpl->tpl_vars['random']->value)."&display=".((string)$_smarty_tpl->tpl_vars['display']->value)."&checkbox_name=".((string)$_smarty_tpl->tpl_vars['checkbox_name']->value).((string)$_smarty_tpl->tpl_vars['_except_id']->value));?>
', <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ldelim']->value, ENT_QUOTES, 'UTF-8');?>
result_ids: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
'<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rdelim']->value, ENT_QUOTES, 'UTF-8');?>
)"
                          <?php }?>
                          data-ca-categories-expand-target
                    >
                        <span class="icon-caret-right<?php if ($_smarty_tpl->tpl_vars['display']->value=="radio") {?> icon-caret--big<?php }?>"></span>
                    </span>
                <?php }?>
                <span title="<?php echo $_smarty_tpl->__("collapse_sublist_of_items");?>
"
                      id="off_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
"
                      class="hand cm-combination-cat cm-uncheck <?php if (!isset($_smarty_tpl->tpl_vars['path']->value[$_smarty_tpl->tpl_vars['cat_id']->value])&&(!$_smarty_tpl->tpl_vars['expand_all']->value||!$_smarty_tpl->tpl_vars['show_all']->value)) {?>hidden<?php }?>"
                      data-ca-categories-expand-target
                      data-ca-categories-hide-target
                >
                    <span class="icon-caret-down <?php if ($_smarty_tpl->tpl_vars['display']->value=="radio") {?> icon-caret--big<?php }?>"></span>
                </span>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['cur_cat']->value['company_categories']) {?>
                <span id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category'], ENT_QUOTES, 'UTF-8');?>
</span>
            <?php } else { ?>
                <label id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="inline-label" for="input_cat_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if (!$_smarty_tpl->tpl_vars['cur_cat']->value['has_children']&&!$_smarty_tpl->tpl_vars['cur_cat']->value['subcategories']) {?> style="padding-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['direction']->value, ENT_QUOTES, 'UTF-8');?>
: 6px;"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['category'], ENT_QUOTES, 'UTF-8');?>
</label>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['cur_cat']->value['status']=="N") {?>&nbsp;<span class="small-note">-&nbsp;[<?php echo $_smarty_tpl->__("disabled");?>
]</span><?php }?>
        </td>
        <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']) {?>
        <td class="right">
            <?php if ($_smarty_tpl->tpl_vars['cur_cat']->value['company_categories']) {?>
                &nbsp;
            <?php } else { ?>
                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_cat']->value['product_count'], ENT_QUOTES, 'UTF-8');?>
&nbsp;&nbsp;&nbsp;
            <?php }?>
        </td>
        <?php }?>
    </tr>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"categories:tree_simple_tr"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </table>
</div>

<?php if ($_smarty_tpl->tpl_vars['cur_cat']->value['has_children']||$_smarty_tpl->tpl_vars['cur_cat']->value['subcategories']) {?>
    <div<?php if (!$_smarty_tpl->tpl_vars['expand_all']->value) {?> class="hidden"<?php }?> id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
">
    <?php if ($_smarty_tpl->tpl_vars['cur_cat']->value['subcategories']) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("views/categories/components/categories_tree_simple.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('categories_tree'=>$_smarty_tpl->tpl_vars['cur_cat']->value['subcategories'],'parent_id'=>false,'direction'=>$_smarty_tpl->tpl_vars['direction']->value), 0);?>

    <?php }?>
    <!--<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['comb_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php }?>
<?php } ?>
<?php if ($_smarty_tpl->tpl_vars['parent_id']->value) {?><!--cat_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['parent_id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['random']->value, ENT_QUOTES, 'UTF-8');?>
--></div><?php }?>
<?php }} ?>
