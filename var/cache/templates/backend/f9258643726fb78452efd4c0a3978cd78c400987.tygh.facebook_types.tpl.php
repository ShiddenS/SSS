<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:19
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\social_buttons\common\facebook_types.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12408915125daf1d7f7915c2-71694658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9258643726fb78452efd4c0a3978cd78c400987' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\social_buttons\\common\\facebook_types.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '12408915125daf1d7f7915c2-71694658',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'object_type' => 0,
    'object_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d7f88a543_57269302',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d7f88a543_57269302')) {function content_5daf1d7f88a543_57269302($_smarty_tpl) {?><?php
\Tygh\Languages\Helper::preloadLangVars(array('facebook','facebook_obj_type','fb_activities','fb_businesses','fb_groups','fb_organizations','fb_people','fb_places','fb_products_entertainment','fb_websites'));
?>
<?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("facebook"),'target'=>"#facebook_settings"), 0);?>

<div id="facebook_settings" class="in collapse">
    <div class="control-group cm-no-hide-input">
        <label for="facebook_obj_type" class="control-label"><?php echo $_smarty_tpl->__("facebook_obj_type");?>
:</label>
        <div class="controls">
            <select name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_type']->value, ENT_QUOTES, 'UTF-8');?>
[facebook_obj_type]" id="facebook_obj_type">
                <optgroup label="<?php echo $_smarty_tpl->__("fb_activities");?>
">
                    <option value="activity" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="activity") {?>selected="selected"<?php }?>>activity</option>
                    <option value="sport" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="sport") {?>selected="selected"<?php }?>>sport</option>
                </optgroup>
                <optgroup label="<?php echo $_smarty_tpl->__("fb_businesses");?>
">
                    <option value="bar" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="bar") {?>selected="selected"<?php }?>>bar</option>
                    <option value="company" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="company") {?>selected="selected"<?php }?>>company</option>
                    <option value="cafe" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="cafe") {?>selected="selected"<?php }?>>cafe</option>
                    <option value="hotel" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="hotel") {?>selected="selected"<?php }?>>hotel</option>
                    <option value="restaurant" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="restaurant") {?>selected="selected"<?php }?>>restaurant</option>
                </optgroup>
                <optgroup label="<?php echo $_smarty_tpl->__("fb_groups");?>
">
                    <option value="cause" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="cause") {?>selected="selected"<?php }?>>cause</option>
                    <option value="sports_league" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="sports_league") {?>selected="selected"<?php }?>>sports_league</option>
                    <option value="sports_team" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="sports_team") {?>selected="selected"<?php }?>>sports_team</option>
                </optgroup>
                <optgroup label="<?php echo $_smarty_tpl->__("fb_organizations");?>
">
                    <option value="band" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="band") {?>selected="selected"<?php }?>>band</option>
                    <option value="government" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="government") {?>selected="selected"<?php }?>>government</option>
                    <option value="non_profit" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="non_profit") {?>selected="selected"<?php }?>>non_profit</option>
                    <option value="school" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="school") {?>selected="selected"<?php }?>>school</option>
                    <option value="university" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="university") {?>selected="selected"<?php }?>>university</option>
                </optgroup>
                <optgroup label="<?php echo $_smarty_tpl->__("fb_people");?>
">
                    <option value="actor" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="actor") {?>selected="selected"<?php }?>>actor</option>
                    <option value="athlete" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="athlete") {?>selected="selected"<?php }?>>athlete</option>
                    <option value="author" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="author") {?>selected="selected"<?php }?>>author</option>
                    <option value="director" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="director") {?>selected="selected"<?php }?>>director</option>
                    <option value="musician" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="musician") {?>selected="selected"<?php }?>>musician</option>
                    <option value="politician" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="politician") {?>selected="selected"<?php }?>>politician</option>
                    <option value="public_figure" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="public_figure") {?>selected="selected"<?php }?>>public_figure</option>
                </optgroup>
                <optgroup label="<?php echo $_smarty_tpl->__("fb_places");?>
">
                    <option value="city" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="city") {?>selected="selected"<?php }?>>city</option>
                    <option value="country" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="country") {?>selected="selected"<?php }?>>country</option>
                    <option value="landmark" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="landmark") {?>selected="selected"<?php }?>>landmark</option>
                    <option value="state_province" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="state_province") {?>selected="selected"<?php }?>>state_province</option>
                </optgroup>
                <optgroup label="<?php echo $_smarty_tpl->__("fb_products_entertainment");?>
">
                    <option value="album" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="album") {?>selected="selected"<?php }?>>album</option>
                    <option value="book" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="book") {?>selected="selected"<?php }?>>book</option>
                    <option value="drink" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="drink") {?>selected="selected"<?php }?>>drink</option>
                    <option value="food" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="food") {?>selected="selected"<?php }?>>food</option>
                    <option value="game" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="game") {?>selected="selected"<?php }?>>game</option>
                    <option value="product" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="product") {?>selected="selected"<?php }?>>product</option>
                    <option value="song" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="song") {?>selected="selected"<?php }?>>song</option>
                    <option value="movie" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="movie") {?>selected="selected"<?php }?>>movie</option>
                    <option value="tv_show" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="tv_show") {?>selected="selected"<?php }?>>tv_show</option>
                </optgroup>
                <optgroup label="<?php echo $_smarty_tpl->__("fb_websites");?>
">
                    <option value="blog" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="blog") {?>selected="selected"<?php }?>>blog</option>
                    <option value="website" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="website") {?>selected="selected"<?php }?>>website</option>
                    <option value="article" <?php if ($_smarty_tpl->tpl_vars['object_data']->value['facebook_obj_type']=="article") {?>selected="selected"<?php }?>>article</option>
                </optgroup>
            </select>
        </div>
    </div>
</div>
<?php }} ?>
