{capture name="val_hide_form"}{/capture}
{capture name="val_capture_options_vs_qty"}{/capture}
{capture name="val_capture_buttons"}{/capture}
{capture name="val_no_ajax"}{/capture}

{hook name="products:layout_content"}

{* NOTE: One of the selected product templates will be connected, depending on the 'Product details view' setting.
	You can find product templates in the following directory: responsive/templates/blocks/product_templates/
	Below are the display parameters we send to the product template.
*}
{include 
	file=$product.product_id|fn_get_product_details_view
	product=$product
	show_sku=true
	show_rating=true
	show_old_price=true
	show_price=true
	show_list_discount=true
	show_clean_price=true
	details_page=true
	show_product_labels=true
	show_discount_label=true
	show_shipping_label=true
	show_product_amount=true
	show_product_options=true
	hide_form=$smarty.capture.val_hide_form
	min_qty=true
	show_edp=true
	show_add_to_cart=true
	show_list_buttons=true
	but_role="action"
	capture_buttons=$smarty.capture.val_capture_buttons
	capture_options_vs_qty=$smarty.capture.val_capture_options_vs_qty
	separate_buttons=$smarty.capture.val_separate_buttons
	show_add_to_cart=$show_add_to_cart|default:true
	show_list_buttons=true
	but_role="action"
	block_width=true
	no_ajax=$smarty.capture.val_no_ajax
	show_product_tabs=true
}
{/hook}