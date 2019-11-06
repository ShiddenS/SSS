<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:16:46
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\products\update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19213057785daf1d5e41cde9-90322814%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55523665e797d157b8c1bd6f921c23f1e8862c11' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\products\\update.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '19213057785daf1d5e41cde9-90322814',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'language_direction' => 0,
    'product_data' => 0,
    'runtime' => 0,
    'id' => 0,
    'is_form_readonly' => 0,
    'no_hide_input_if_shared_product' => 0,
    'show_update_for_all' => 0,
    'mode' => 0,
    'companies_tooltip' => 0,
    'result_ids' => 0,
    'rnd' => 0,
    'tabindex' => 0,
    'select2_disabled' => 0,
    'categories_data' => 0,
    'primary_currency' => 0,
    'currencies' => 0,
    'view_uri' => 0,
    'is_shared_product' => 0,
    'allow_update_files' => 0,
    'promo_class' => 0,
    'disable_selectors' => 0,
    'settings' => 0,
    'product_options' => 0,
    'taxes' => 0,
    'tax' => 0,
    'layout' => 0,
    'item' => 0,
    'disable_edit_popularity' => 0,
    'allow_clone' => 0,
    'allow_save' => 0,
    'title_start' => 0,
    'title_end' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d5e9f97a0_42364034',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d5e9f97a0_42364034')) {function content_5daf1d5e9f97a0_42364034($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_function_math')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.math.php';
if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.enum.php';
if (!is_callable('smarty_modifier_in_array')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.in_array.php';
if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('information','name','text_ult_product_store_field_tooltip','categories','tt_views_products_update_categories','price','full_description','edit_content_on_site','images','options_settings','options_type','simultaneous','sequential','exceptions_type','forbidden','allowed','pricing_inventory','sku','list_price','tt_views_products_update_list_price','in_stock','edit','zero_price_action','zpa_refuse','zpa_permit','zpa_ask_price','inventory','tt_views_products_update_inventory','track_with_options','track_without_options','dont_track','min_order_qty','max_order_qty','quantity_step','list_quantity_count','taxes','availability','usergroups','creation_date','available_since','out_of_stock_actions','tt_views_products_update_out_of_stock_actions','none','buy_in_advance','sign_up_for_notification','product_details_view','downloadable','edp_enable_shipping','time_unlimited_download','short_description','popularity','ttc_popularity','search_words','ttc_search_words','promo_text','extra','seo_meta_data','page_title','ttc_page_title','meta_description','meta_keywords','preview','clone','delete','editing_product','new_product'));
?>
<?php if ($_smarty_tpl->tpl_vars['language_direction']->value=="rtl") {?>
    <?php $_smarty_tpl->tpl_vars['direction'] = new Smarty_variable("right", null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['direction'] = new Smarty_variable("left", null, 0);?>
<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("tabsbox", null, null); ob_start(); ?>
        

        <?php $_smarty_tpl->tpl_vars["categories_company_id"] = new Smarty_variable($_smarty_tpl->tpl_vars['product_data']->value['company_id'], null, 0);?>
        <?php $_smarty_tpl->tpl_vars["allow_save"] = new Smarty_variable(fn_allow_save_object($_smarty_tpl->tpl_vars['product_data']->value,"product"), null, 0);?>

        <?php if (fn_allowed_for("ULTIMATE")) {?>
            <?php $_smarty_tpl->tpl_vars["categories_company_id"] = new Smarty_variable('', null, 0);?>
            <?php if ($_smarty_tpl->tpl_vars['runtime']->value['company_id']&&$_smarty_tpl->tpl_vars['product_data']->value['shared_product']=="Y"&&$_smarty_tpl->tpl_vars['product_data']->value['company_id']!=$_smarty_tpl->tpl_vars['runtime']->value['company_id']) {?>
                <?php $_smarty_tpl->tpl_vars["no_hide_input_if_shared_product"] = new Smarty_variable("cm-no-hide-input", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["is_shared_product"] = new Smarty_variable(true, null, 0);?>
            <?php }?>

            <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']&&$_smarty_tpl->tpl_vars['product_data']->value['shared_product']=="Y") {?>
                <?php $_smarty_tpl->tpl_vars["show_update_for_all"] = new Smarty_variable(true, null, 0);?>
            <?php }?>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['product_data']->value['product_id']) {?>
            <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['product_data']->value['product_id'], null, 0);?>
        <?php } else { ?>
            <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable(0, null, 0);?>
        <?php }?>

        <?php $_smarty_tpl->tpl_vars['is_form_readonly'] = new Smarty_variable(fn_check_form_permissions('')||($_smarty_tpl->tpl_vars['id']->value&&$_smarty_tpl->tpl_vars['runtime']->value['company_id']&&(fn_allowed_for("MULTIVENDOR")||$_smarty_tpl->tpl_vars['product_data']->value['shared_product']=="Y")&&$_smarty_tpl->tpl_vars['product_data']->value['company_id']!=$_smarty_tpl->tpl_vars['runtime']->value['company_id']), null, 0);?>

        <form id="form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="product_update_form" class="form-horizontal form-edit  cm-disable-empty-files <?php if ($_smarty_tpl->tpl_vars['is_form_readonly']->value) {?>cm-hide-inputs<?php }?>" enctype="multipart/form-data"> 
            <input type="hidden" name="fake" value="1" />
            <input type="hidden" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
" name="selected_section" id="selected_section" value="<?php echo htmlspecialchars($_REQUEST['selected_section'], ENT_QUOTES, 'UTF-8');?>
" />
            <input type="hidden" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
" name="product_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" />

            

            <div class="product-manage hidden" id="content_detailed"> 

                
                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("information"),'target'=>"#acc_information"), 0);?>


                <div id="acc_information" class="collapse in collapse-visible">

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_name")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_name"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label for="product_description_product" class="control-label cm-required"><?php echo $_smarty_tpl->__("name");?>
</label>
                        <div class="controls">
                            <input class="input-large" form="form" type="text" name="product_data[product]" id="product_description_product" size="55" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_data']->value['product'], ENT_QUOTES, 'UTF-8');?>
" />
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"product",'name'=>"update_all_vendors[product]"), 0);?>

                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_name"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:categories_section")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:categories_section"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <?php $_smarty_tpl->tpl_vars['result_ids'] = new Smarty_variable("product_categories", null, 0);?>

                        <?php if (fn_allowed_for("MULTIVENDOR")&&$_smarty_tpl->tpl_vars['mode']->value!="add") {?>
                             <?php $_smarty_tpl->tpl_vars['js_action'] = new Smarty_variable("fn_change_vendor_for_product();", null, 0);?>
                        <?php }?>

                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"companies:product_details_fields")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"companies:product_details_fields"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


                        <?php if (fn_allowed_for("ULTIMATE")) {?>
                            <?php $_smarty_tpl->tpl_vars["companies_tooltip"] = new Smarty_variable($_smarty_tpl->__("text_ult_product_store_field_tooltip"), null, 0);?>
                        <?php }?>

                        <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/company_field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('name'=>"product_data[company_id]",'id'=>"product_data_company_id",'selected'=>$_smarty_tpl->tpl_vars['product_data']->value['company_id'],'tooltip'=>$_smarty_tpl->tpl_vars['companies_tooltip']->value), 0);?>


                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"companies:product_details_fields"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                        <input type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['result_ids']->value, ENT_QUOTES, 'UTF-8');?>
" name="result_ids">

                        <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_categories">
                            <?php echo smarty_function_math(array('equation'=>"rand()",'assign'=>"rnd"),$_smarty_tpl);?>

                            <?php if ($_REQUEST['category_id']) {?>
                                <?php $_smarty_tpl->tpl_vars["request_category_id"] = new Smarty_variable(explode(",",$_REQUEST['category_id']), null, 0);?>
                            <?php } else { ?>
                                <?php $_smarty_tpl->tpl_vars["request_category_id"] = new Smarty_variable('', null, 0);?>
                            <?php }?>
                            <label for="product_categories_add_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rnd']->value, ENT_QUOTES, 'UTF-8');?>
" class="control-label cm-required"><?php echo $_smarty_tpl->__("categories");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("tt_views_products_update_categories")), 0);?>
</label>
                            <div class="controls">
                                <?php echo $_smarty_tpl->getSubTemplate ("common/select2_categories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('select2_tabindex'=>$_smarty_tpl->tpl_vars['tabindex']->value,'select2_multiple'=>true,'select2_disabled'=>(($tmp = @$_smarty_tpl->tpl_vars['select2_disabled']->value)===null||$tmp==='' ? false : $tmp),'select2_select_id'=>"product_categories_add_".((string)$_smarty_tpl->tpl_vars['rnd']->value),'select2_name'=>"product_data[category_ids]",'select2_allow_sorting'=>true,'select2_category_ids'=>$_smarty_tpl->tpl_vars['product_data']->value['category_ids'],'select2_main_category'=>$_smarty_tpl->tpl_vars['product_data']->value['main_category'],'categories_data'=>$_smarty_tpl->tpl_vars['categories_data']->value,'disable_categories'=>true,'select2_wrapper_meta'=>"cm-field-container",'select2_select_meta'=>"input-large",'select2_required'=>"true"), 0);?>

                        </div>
                    <!--product_categories--></div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:categories_section"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_update_price")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_update_price"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label for="elm_price_price" class="control-label cm-required"><?php echo $_smarty_tpl->__("price");?>
 (<?php echo $_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]['symbol'];?>
):</label>
                        <div class="controls">
                            <input type="text" name="product_data[price]" id="elm_price_price" size="10" value="<?php echo htmlspecialchars(fn_format_price((($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['price'])===null||$tmp==='' ? "0.00" : $tmp),$_smarty_tpl->tpl_vars['primary_currency']->value,null,false), ENT_QUOTES, 'UTF-8');?>
" class="input-long" />
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"price",'name'=>"update_all_vendors[price]"), 0);?>

                            </div>
                        </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_update_price"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_full_description")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_full_description"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group cm-no-hide-input">
                        <label class="control-label" for="elm_product_full_descr"><?php echo $_smarty_tpl->__("full_description");?>
:</label>
                        <div class="controls">
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"full_description",'name'=>"update_all_vendors[full_description]"), 0);?>

                            <textarea id="elm_product_full_descr"
                                      name="product_data[full_description]"
                                      cols="55"
                                      rows="8"
                                      class="cm-wysiwyg input-large"
                                      data-ca-is-block-manager-enabled="<?php echo htmlspecialchars(intval(fn_check_view_permissions("block_manager.block_selection","GET")), ENT_QUOTES, 'UTF-8');?>
"
                            ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_data']->value['full_description'], ENT_QUOTES, 'UTF-8');?>
</textarea>

                            <?php if ($_smarty_tpl->tpl_vars['view_uri']->value) {?>
                                <?php ob_start();
echo htmlspecialchars(urlencode($_smarty_tpl->tpl_vars['view_uri']->value), ENT_QUOTES, 'UTF-8');
$_tmp1=ob_get_clean();?><?php ob_start();
if (fn_allowed_for("ULTIMATE")) {?><?php echo "&switch_company_id=";?><?php echo (string)$_smarty_tpl->tpl_vars['product_data']->value['company_id'];?><?php }
$_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"customization.update_mode?type=live_editor&status=enable&frontend_url=".$_tmp1.$_tmp2,'but_text'=>$_smarty_tpl->__("edit_content_on_site"),'but_role'=>"action",'but_meta'=>"btn-small btn-live-edit cm-post",'but_target'=>"_blank"), 0);?>

                            <?php }?>
                            </div>
                        </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_full_description"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    

                    <?php echo $_smarty_tpl->getSubTemplate ("common/select_status.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('input_name'=>"product_data[status]",'id'=>"elm_product_status",'obj'=>$_smarty_tpl->tpl_vars['product_data']->value,'hidden'=>true), 0);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_detailed_images")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_detailed_images"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label"><?php echo $_smarty_tpl->__("images");?>
:</label>
                        <div class="controls">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/form_file_uploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('existing_pairs'=>($_smarty_tpl->tpl_vars['product_data']->value['main_pair'] ? array($_smarty_tpl->tpl_vars['product_data']->value['main_pair']) : array())+(($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['image_pairs'])===null||$tmp==='' ? array() : $tmp),'file_name'=>"file",'image_pair_types'=>array('N'=>'product_add_additional_image','M'=>'product_main_image','A'=>'product_additional_image'),'allow_update_files'=>!$_smarty_tpl->tpl_vars['is_shared_product']->value&&(($tmp = @$_smarty_tpl->tpl_vars['allow_update_files']->value)===null||$tmp==='' ? true : $tmp)), 0);?>

                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_detailed_images"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                </div>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_options_settings")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_options_settings"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <hr>

                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("options_settings"),'target'=>"#acc_options"), 0);?>


                <div id="acc_options" class="collapse in">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_options_type")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_options_type"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['promo_class']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label class="control-label" for="elm_options_type"><?php echo $_smarty_tpl->__("options_type");?>
:</label>
                        <div class="controls">
                            <select class="span3" name="product_data[options_type]" id="elm_options_type" <?php if ($_smarty_tpl->tpl_vars['disable_selectors']->value) {?>disabled="disabled"<?php }?>>
                                <option value="P" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['options_type']=="P") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("simultaneous");?>
</option>
                                <option value="S" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['options_type']=="S") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("sequential");?>
</option>
                            </select>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_options_type"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_exceptions_type")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_exceptions_type"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['promo_class']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label class="control-label" for="elm_exceptions_type"><?php echo $_smarty_tpl->__("exceptions_type");?>
:</label>
                        <div class="controls">
                            <select class="span3" name="product_data[exceptions_type]" id="elm_exceptions_type" <?php if ($_smarty_tpl->tpl_vars['disable_selectors']->value) {?>disabled="disabled"<?php }?>>
                                <option value="F" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['exceptions_type']=="F") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("forbidden");?>
</option>
                                <option value="A" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['exceptions_type']=="A") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("allowed");?>
</option>
                            </select>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_exceptions_type"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </div>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_options_settings"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                <hr>

                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("pricing_inventory"),'target'=>"#acc_pricing_inventory"), 0);?>

                <div id="acc_pricing_inventory" class="collapse in">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_code")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_code"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_product_code"><?php echo $_smarty_tpl->__("sku");?>
:</label>
                        <div class="controls">
                            <input type="text" name="product_data[product_code]" id="elm_product_code" size="20" maxlength=<?php echo htmlspecialchars(smarty_modifier_enum("ProductFieldsLength::PRODUCT_CODE"), ENT_QUOTES, 'UTF-8');?>
  value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_data']->value['product_code'], ENT_QUOTES, 'UTF-8');?>
" class="input-large" />
                            </div>
                        </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_code"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_list_price")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_list_price"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_list_price"><?php echo $_smarty_tpl->__("list_price");?>
 (<?php echo $_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]['symbol'];?>
) <?php echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("tt_views_products_update_list_price")), 0);?>
:</label>
                        <div class="controls">
                            <input type="text" name="product_data[list_price]" id="elm_list_price" size="10" value="<?php echo htmlspecialchars(fn_format_price((($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['list_price'])===null||$tmp==='' ? "0.00" : $tmp),$_smarty_tpl->tpl_vars['primary_currency']->value,null,false), ENT_QUOTES, 'UTF-8');?>
" class="input-long" />
                            </div>
                        </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_list_price"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_amount")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_amount"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_in_stock"><?php echo $_smarty_tpl->__("in_stock");?>
:</label>
                        <div class="controls">
                        <?php if ($_smarty_tpl->tpl_vars['product_data']->value['tracking']==smarty_modifier_enum("ProductTracking::TRACK_WITH_OPTIONS")) {?>
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("edit"),'but_href'=>"product_options.inventory?product_id=".((string)$_smarty_tpl->tpl_vars['id']->value),'but_role'=>"edit"), 0);?>

                        <?php } else { ?>
                            <input type="text" name="product_data[amount]" id="elm_in_stock" size="10" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['amount'])===null||$tmp==='' ? "1" : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="input-small" />
                        <?php }?>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_amount"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_zero_price_action")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_zero_price_action"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_zero_price_action"><?php echo $_smarty_tpl->__("zero_price_action");?>
:</label>
                        <div class="controls">
                            <select class="span5" name="product_data[zero_price_action]" id="elm_zero_price_action">
                                <option value="R" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['zero_price_action']=="R") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("zpa_refuse");?>
</option>
                                <option value="P" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['zero_price_action']=="P") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("zpa_permit");?>
</option>
                                <option value="A" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['zero_price_action']=="A") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("zpa_ask_price");?>
</option>
                            </select>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_zero_price_action"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_tracking")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_tracking"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_product_tracking"><?php echo $_smarty_tpl->__("inventory");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("tt_views_products_update_inventory")), 0);?>
:</label>
                        <div class="controls">
                            <select class="span5" name="product_data[tracking]" id="elm_product_tracking" <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="N") {?>disabled="disabled"<?php }?>>
                                <?php if ($_smarty_tpl->tpl_vars['product_options']->value) {?>
                                    <option value="<?php echo htmlspecialchars(smarty_modifier_enum("ProductTracking::TRACK_WITH_OPTIONS"), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['tracking']==smarty_modifier_enum("ProductTracking::TRACK_WITH_OPTIONS")&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("track_with_options");?>
</option>
                                <?php }?>
                                <option value="<?php echo htmlspecialchars(smarty_modifier_enum("ProductTracking::TRACK_WITHOUT_OPTIONS"), ENT_QUOTES, 'UTF-8');?>
" <?php ob_start();
echo htmlspecialchars(smarty_modifier_enum("ProductTracking::TRACK_WITHOUT_OPTIONS"), ENT_QUOTES, 'UTF-8');
$_tmp3=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['product_data']->value['tracking']==$_tmp3&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("track_without_options");?>
</option>
                                <option value="<?php echo htmlspecialchars(smarty_modifier_enum("ProductTracking::DO_NOT_TRACK"), ENT_QUOTES, 'UTF-8');?>
" <?php ob_start();
echo htmlspecialchars(smarty_modifier_enum("ProductTracking::DO_NOT_TRACK"), ENT_QUOTES, 'UTF-8');
$_tmp4=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['product_data']->value['tracking']==$_tmp4||$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="N") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("dont_track");?>
</option>
                            </select>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_tracking"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_min_qty")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_min_qty"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_min_qty"><?php echo $_smarty_tpl->__("min_order_qty");?>
:</label>
                        <div class="controls">
                            <input type="text" name="product_data[min_qty]" size="10" id="elm_min_qty" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['min_qty'])===null||$tmp==='' ? "0" : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="input-small" />
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_min_qty"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_max_qty")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_max_qty"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_max_qty"><?php echo $_smarty_tpl->__("max_order_qty");?>
:</label>
                        <div class="controls">
                            <input type="text" name="product_data[max_qty]" id="elm_max_qty" size="10" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['max_qty'])===null||$tmp==='' ? "0" : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="input-small" />
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_max_qty"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_qty_step")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_qty_step"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_qty_step"><?php echo $_smarty_tpl->__("quantity_step");?>
:</label>
                        <div class="controls">
                            <input type="text" data-v-min="0" data-m-dec="0" data-a-sep="" name="product_data[qty_step]" id="elm_qty_step" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['qty_step'])===null||$tmp==='' ? "0" : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="input-small cm-numeric" />
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_qty_step"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_list_qty_count")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_list_qty_count"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_list_qty_count"><?php echo $_smarty_tpl->__("list_quantity_count");?>
:</label>
                        <div class="controls">
                            <input type="text" name="product_data[list_qty_count]" id="elm_list_qty_count" size="10" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['list_qty_count'])===null||$tmp==='' ? "0" : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="input-small" />
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_list_qty_count"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_tax_ids")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_tax_ids"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label"><?php echo $_smarty_tpl->__("taxes");?>
:</label>
                        <div class="controls">
                            <input type="hidden" name="product_data[tax_ids]" value="" />
                            <?php  $_smarty_tpl->tpl_vars["tax"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["tax"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['taxes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["tax"]->key => $_smarty_tpl->tpl_vars["tax"]->value) {
$_smarty_tpl->tpl_vars["tax"]->_loop = true;
?>
                                <label class="checkbox inline" for="elm_taxes_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['tax_id'], ENT_QUOTES, 'UTF-8');?>
">
                                    <input type="checkbox" name="product_data[tax_ids][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['tax_id'], ENT_QUOTES, 'UTF-8');?>
]" id="elm_taxes_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['tax_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if (smarty_modifier_in_array($_smarty_tpl->tpl_vars['tax']->value['tax_id'],$_smarty_tpl->tpl_vars['product_data']->value['tax_ids'])) {?>checked="checked"<?php }?> value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['tax_id'], ENT_QUOTES, 'UTF-8');?>
" />
                                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['tax'], ENT_QUOTES, 'UTF-8');?>
</label>
                                <?php }
if (!$_smarty_tpl->tpl_vars["tax"]->_loop) {
?>
                                &ndash;
                            <?php } ?>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_tax_ids"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </div>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_availability")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_availability"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <hr>
                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("availability"),'target'=>"#acc_availability"), 0);?>

                <div id="acc_availability" class="collapse in">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_usergroup_ids")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_usergroup_ids"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php if (!fn_allowed_for("ULTIMATE:FREE")) {?>
                        <div class="control-group">
                            <label class="control-label"><?php echo $_smarty_tpl->__("usergroups");?>
:</label>
                            <div class="controls">
                                <?php echo $_smarty_tpl->getSubTemplate ("common/select_usergroups.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"ug_id",'name'=>"product_data[usergroup_ids]",'usergroups'=>fn_get_usergroups(array("type"=>"C","status"=>array("A","H")),@constant('DESCR_SL')),'usergroup_ids'=>$_smarty_tpl->tpl_vars['product_data']->value['usergroup_ids'],'input_extra'=>'','list_mode'=>false), 0);?>

                            </div>
                        </div>
                    <?php }?>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_usergroup_ids"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_timestamp")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_timestamp"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_date_holder"><?php echo $_smarty_tpl->__("creation_date");?>
:</label>
                        <div class="controls">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('date_id'=>"elm_date_holder",'date_name'=>"product_data[timestamp]",'date_val'=>(($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['timestamp'])===null||$tmp==='' ? @constant('TIME') : $tmp),'start_year'=>$_smarty_tpl->tpl_vars['settings']->value['Company']['company_start_year']), 0);?>

                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_timestamp"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_avail_since")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_avail_since"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_date_avail_holder"><?php echo $_smarty_tpl->__("available_since");?>
:</label>
                        <div class="controls">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('date_id'=>"elm_date_avail_holder",'date_name'=>"product_data[avail_since]",'date_val'=>(($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['avail_since'])===null||$tmp==='' ? '' : $tmp),'start_year'=>$_smarty_tpl->tpl_vars['settings']->value['Company']['company_start_year']), 0);?>

                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_avail_since"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_out_of_stock_actions")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_out_of_stock_actions"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_out_of_stock_actions"><?php echo $_smarty_tpl->__("out_of_stock_actions");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("tt_views_products_update_out_of_stock_actions")), 0);?>
:</label>
                        <div class="controls">
                            <select class="span3" name="product_data[out_of_stock_actions]" id="elm_out_of_stock_actions">
                                <option value="N" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['out_of_stock_actions']=="N") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("none");?>
</option>
                                <option value="B" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['out_of_stock_actions']=="B") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("buy_in_advance");?>
</option>
                                <option value="S" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['out_of_stock_actions']=="S") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("sign_up_for_notification");?>
</option>
                            </select>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_out_of_stock_actions"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </div>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_availability"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                <?php $_smarty_tpl->_capture_stack[0][] = array("product_extra", null, null); ob_start(); ?>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_details_layout")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_details_layout"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_details_layout"><?php echo $_smarty_tpl->__("product_details_view");?>
:</label>
                        <div class="controls">
                            <select class="span5" id="elm_details_layout" name="product_data[details_layout]">
                                <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_smarty_tpl->tpl_vars["layout"] = new Smarty_Variable;
 $_from = fn_get_product_details_views($_smarty_tpl->tpl_vars['id']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value) {
$_smarty_tpl->tpl_vars["item"]->_loop = true;
 $_smarty_tpl->tpl_vars["layout"]->value = $_smarty_tpl->tpl_vars["item"]->key;
?>
                                    <option <?php if ($_smarty_tpl->tpl_vars['product_data']->value['details_layout']==$_smarty_tpl->tpl_vars['layout']->value) {?>selected="selected"<?php }?> value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_details_layout"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_edp_section")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_edp_section"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['enable_edp']=="Y") {?>
                    <div class="control-group">
                        <label class="control-label" for="elm_product_is_edp"><?php echo $_smarty_tpl->__("downloadable");?>
:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="hidden" name="product_data[is_edp]" value="N" />
                                <input type="checkbox" name="product_data[is_edp]" id="elm_product_is_edp" value="Y" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['is_edp']=="Y") {?>checked="checked"<?php }?> onclick="Tygh.$("#edp_shipping").toggleBy(); Tygh.$("#edp_unlimited").toggleBy();"/>
                            </label>
                        </div>
                    </div>

                    <div class="control-group <?php if ($_smarty_tpl->tpl_vars['product_data']->value['is_edp']!="Y") {?>hidden<?php }?>" id="edp_shipping">
                        <label class="control-label" for="elm_product_edp_shipping"><?php echo $_smarty_tpl->__("edp_enable_shipping");?>
:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="hidden" name="product_data[edp_shipping]" value="N" />
                                <input type="checkbox" name="product_data[edp_shipping]" id="elm_product_edp_shipping" value="Y"<?php if ($_smarty_tpl->tpl_vars['product_data']->value['edp_shipping']=="Y") {?>checked="checked"<?php }?> />
                            </label>
                        </div>
                    </div>

                    <div class="control-group <?php if ($_smarty_tpl->tpl_vars['product_data']->value['is_edp']!="Y") {?>hidden<?php }?>" id="edp_unlimited">
                        <label class="control-label" for="elm_product_edp_unlimited"><?php echo $_smarty_tpl->__("time_unlimited_download");?>
:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <input type="hidden" name="product_data[unlimited_download]" value="N" />
                                <input type="checkbox" name="product_data[unlimited_download]" id="elm_product_edp_unlimited" value="Y" <?php if ($_smarty_tpl->tpl_vars['product_data']->value['unlimited_download']=="Y") {?>checked="checked"<?php }?> />
                            </label>
                        </div>
                    </div>
                    <?php }?>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_edp_section"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php echo $_smarty_tpl->getSubTemplate ("views/localizations/components/select.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('data_from'=>$_smarty_tpl->tpl_vars['product_data']->value['localization'],'data_name'=>"product_data[localization]"), 0);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_short_description")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_short_description"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label class="control-label" for="elm_product_short_descr"><?php echo $_smarty_tpl->__("short_description");?>
:</label>
                        <div class="controls">
                            <textarea id="elm_product_short_descr"
                                      name="product_data[short_description]"
                                      cols="55"
                                      rows="2"
                                      class="cm-wysiwyg input-large"
                            ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_data']->value['short_description'], ENT_QUOTES, 'UTF-8');?>
</textarea>
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"short_description",'name'=>"update_all_vendors[short_description]"), 0);?>

                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_short_description"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_popularity")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_popularity"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group">
                        <label class="control-label" for="elm_product_popularity"><?php echo $_smarty_tpl->__("popularity");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("ttc_popularity")), 0);?>
:</label>
                        <div class="controls">
                            <input type="text" <?php if ($_smarty_tpl->tpl_vars['disable_edit_popularity']->value) {?>disabled="disabled"<?php }?> name="product_data[popularity]" id="elm_product_popularity" size="55" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product_data']->value['popularity'])===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="input-long" />
                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_popularity"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_search_words")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_search_words"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label class="control-label" for="elm_product_search_words"><?php echo $_smarty_tpl->__("search_words");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("ttc_search_words")), 0);?>
:</label>
                        <div class="controls">
                            <textarea name="product_data[search_words]" id="elm_product_search_words" cols="55" rows="2" class="input-large"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_data']->value['search_words'], ENT_QUOTES, 'UTF-8');?>
</textarea>
                                <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"search_words",'name'=>"update_all_vendors[search_words]"), 0);?>

                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_search_words"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_promo_text")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_promo_text"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label class="control-label" for="elm_product_promo_text"><?php echo $_smarty_tpl->__("promo_text");?>
:</label>
                        <div class="controls">
                            <textarea id="elm_product_promo_text" name="product_data[promo_text]" cols="55" rows="2" class="cm-wysiwyg input-large"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_data']->value['promo_text'], ENT_QUOTES, 'UTF-8');?>
</textarea>
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"promo_text",'name'=>"update_all_vendors[promo_text]"), 0);?>

                        </div>
                    </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_promo_text"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                <?php if (trim(preg_replace('!<[^>]*?>!', ' ', Smarty::$_smarty_vars['capture']['product_extra']))) {?>
                    <hr>
                    <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("extra"),'target'=>"#acc_extra"), 0);?>

                    <div id="acc_extra" class="collapse in">
                        <?php echo Smarty::$_smarty_vars['capture']['product_extra'];?>

                </div>
                <?php }?>
                <!--content_detailed--></div> 

            

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_seo_settings")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_seo_settings"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            
            <div id="content_seo" class="hidden">

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_seo")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_seo"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("seo_meta_data"),'target'=>"#acc_seo_meta"), 0);?>

                <div id="acc_seo_meta" class="collapse in">
                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label class="control-label" for="elm_product_page_title"><?php echo $_smarty_tpl->__("page_title");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("ttc_page_title")), 0);?>
:</label>
                        <div class="controls">
                            <input type="text" name="product_data[page_title]" id="elm_product_page_title" size="55" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_data']->value['page_title'], ENT_QUOTES, 'UTF-8');?>
" class="input-large" />
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"page_title",'name'=>"update_all_vendors[page_title]"), 0);?>

                        </div>
                    </div>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label class="control-label" for="elm_product_meta_descr"><?php echo $_smarty_tpl->__("meta_description");?>
:</label>
                        <div class="controls">
                            <textarea name="product_data[meta_description]" id="elm_product_meta_descr" cols="55" rows="2" class="input-large"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_data']->value['meta_description'], ENT_QUOTES, 'UTF-8');?>
</textarea>
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"meta_description",'name'=>"update_all_vendors[meta_description]"), 0);?>

                        </div>
                    </div>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <label class="control-label" for="elm_product_meta_keywords"><?php echo $_smarty_tpl->__("meta_keywords");?>
:</label>
                        <div class="controls">
                            <textarea name="product_data[meta_keywords]" id="elm_product_meta_keywords" cols="55" rows="2" class="input-large"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_data']->value['meta_keywords'], ENT_QUOTES, 'UTF-8');?>
</textarea>
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"meta_keywords",'name'=>"update_all_vendors[meta_keywords]"), 0);?>

                        </div>
                    </div>
                </div>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_seo"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </div>
            
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_seo_settings"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_shipping_settings")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_shipping_settings"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            
            <div id="content_shippings" class="hidden"> 
                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/products_shipping_settings.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            </div> 
            
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_shipping_settings"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_qty_discounts")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_qty_discounts"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/products_update_qty_discounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_qty_discounts"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_features")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_features"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            
            <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/products_update_features.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_id'=>$_smarty_tpl->tpl_vars['product_data']->value['product_id']), 0);?>

            
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_features"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_addons_section")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_addons_section"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div id="content_addons" class="hidden">
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:detailed_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:detailed_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:detailed_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </div>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_addons_section"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:tabs_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:tabs_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:tabs_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            
            <?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
            <?php $_smarty_tpl->tpl_vars['allow_clone'] = new Smarty_variable(true, null, 0);?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_product_buttons")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_product_buttons"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php echo $_smarty_tpl->getSubTemplate ("common/view_tools.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('url'=>"products.update?product_id="), 0);?>


                <?php if ($_smarty_tpl->tpl_vars['id']->value) {?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_tools_list")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_tools_list"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <?php if ($_smarty_tpl->tpl_vars['view_uri']->value) {?>
                                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'target'=>"_blank",'text'=>$_smarty_tpl->__("preview"),'href'=>$_smarty_tpl->tpl_vars['view_uri']->value));?>
</li>
                                <li class="divider"></li>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['allow_clone']->value) {?>
                            <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("clone"),'href'=>"products.clone?product_id=".((string)$_smarty_tpl->tpl_vars['id']->value),'method'=>"POST"));?>
</li>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['allow_save']->value) {?>
                                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("delete"),'class'=>"cm-confirm",'href'=>"products.delete?product_id=".((string)$_smarty_tpl->tpl_vars['id']->value),'method'=>"POST"));?>
</li>
                            <?php }?>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_tools_list"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list']));?>

                <?php }?>
                <!-- the button goes here -->
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"cm-product-save-buttons",'but_role'=>"submit-link",'but_name'=>"dispatch[products.update]",'but_target_form'=>"product_update_form",'save'=>$_smarty_tpl->tpl_vars['id']->value), 0);?>

                <!-- the button goes there -->
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_product_buttons"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            

        </form> 

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:tabs_extra")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:tabs_extra"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:tabs_extra"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


        <?php if ($_smarty_tpl->tpl_vars['id']->value) {?>
            
            <div class="cm-hide-save-button hidden" id="content_options">
                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/products_update_options.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            </div>
            

            
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['enable_edp']=="Y") {?>
            <div id="content_files" class="cm-hide-save-button hidden">
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:content_files")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:content_files"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/products_update_files.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:content_files"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </div>
            <?php }?>
            

            
            <div id="content_subscribers" class="cm-hide-save-button hidden">
                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_subscribers.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_id'=>$_smarty_tpl->tpl_vars['id']->value), 0);?>

            </div>
            
        <?php }?>

    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/tabsbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('content'=>Smarty::$_smarty_vars['capture']['tabsbox'],'group_name'=>$_smarty_tpl->tpl_vars['runtime']->value['controller'],'active_tab'=>$_REQUEST['selected_section'],'track'=>true), 0);?>


<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:update_mainbox_params")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:update_mainbox_params"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


<?php if ($_smarty_tpl->tpl_vars['id']->value) {?>
    <?php $_smarty_tpl->tpl_vars['title_start'] = new Smarty_variable($_smarty_tpl->__("editing_product"), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['title_end'] = new Smarty_variable(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product_data']->value['product']), null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start(); ?>
        <?php echo $_smarty_tpl->__("new_product");?>

    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:update_mainbox_params"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title_start'=>$_smarty_tpl->tpl_vars['title_start']->value,'title_end'=>$_smarty_tpl->tpl_vars['title_end']->value,'title'=>Smarty::$_smarty_vars['capture']['mainbox_title'],'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'select_languages'=>$_smarty_tpl->tpl_vars['id']->value,'buttons'=>Smarty::$_smarty_vars['capture']['buttons'],'adv_buttons'=>Smarty::$_smarty_vars['capture']['adv_buttons']), 0);?>


<?php if (fn_allowed_for("MULTIVENDOR")) {?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
  var fn_change_vendor_for_product = function(){
    $.ceAjax('request', Tygh.current_url, {
      data: {
        product_data: {
          company_id: $('[name="product_data[company_id]"]').val(),
          category_ids: $('[name="product_data[category_ids]"]').val()
        }
      },
      result_ids: 'product_categories'
    });
  };
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>
<?php }} ?>
