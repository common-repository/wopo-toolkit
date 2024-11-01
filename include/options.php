<?php
// create custom plugin settings menu
add_action('admin_menu', 'wopotoolkit_plugin_create_menu');

function wopotoolkit_plugin_create_menu() {

  //create new top-level menu
  add_menu_page('WoPo Toolkit', 'WoPo Toolkit', 'administrator', 'wopo-toolkit', 'wopotoolkit_plugin_settings_page' , 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGc+PGc+PGc+PHBhdGggZD0iTTQwOS42LDIwMS4zMzFjMC0yLjc5LTIuMjc4LTUuMDY5LTUuMDY5LTUuMDY5aC00MS4wNjJjLTIuNzksMC01LjA2OSwyLjI3OC01LjA2OSw1LjA2OXYyMC41MzFoNTEuMlYyMDEuMzMxeiIvPjxwYXRoIGQ9Ik00NzUuMTk2LDEzNi41MzNoLTk5LjcyOVYxMDIuNEgzNTguNHYtOS40ODljMC0zMi40MS0yNi4zNjgtNTguNzc4LTU4Ljc4Ni01OC43NzhoLTg3LjIyOGMtMzIuNDE4LDAtNTguNzg2LDI2LjM2OC01OC43ODYsNTguNzc4djkuNDg5aC0xNy4wNjd2MzQuMTMzSDM2Ljc5NkMxNi41MTIsMTM2LjUzMywwLDE1My4wMzcsMCwxNzMuMzI5djQ4LjUzOGg4NS4zMzN2LTIwLjUzMWMwLTEyLjIxMSw5LjkyNC0yMi4xMzUsMjIuMTM1LTIyLjEzNWg0MS4wNjJjMTIuMjExLDAsMjIuMTM1LDkuOTI0LDIyLjEzNSwyMi4xMzV2MjAuNTMxaDE3MC42Njd2LTIwLjUzMWMwLTEyLjIxMSw5LjkyNC0yMi4xMzUsMjIuMTM1LTIyLjEzNWg0MS4wNjJjMTIuMjExLDAsMjIuMTM1LDkuOTI0LDIyLjEzNSwyMi4xMzV2MjAuNTMxSDUxMnYtNDguNTM4QzUxMiwxNTMuMDM3LDQ5NS40ODgsMTM2LjUzMyw0NzUuMTk2LDEzNi41MzN6IE0yOTAuMTMzLDEzNi41MzNoLTY4LjI2N1YxMDIuNEgyMDQuOFY4OS4xMjJjMC0yLjMxMywxLjQ5My0zLjU1OCwyLjEzMy0zLjk5NGMwLjYzMS0wLjQyNywyLjM0Ny0xLjMyMyw0LjQ5Ny0wLjQ0NGMyOC43NDksMTEuODc4LDYwLjM5OSwxMS44NzgsODkuMTM5LDBjMi4xNDItMC44NzksMy44NTcsMC4wMTcsNC40OTcsMC40NDRjMC42NCwwLjQzNSwyLjEzMywxLjY4MSwyLjEzMywzLjk5NFYxMDIuNGgtMTcuMDY3VjEzNi41MzN6Ii8+PHBhdGggZD0iTTM1OC40LDI1OS40NjVjMCwyLjc5LDIuMjc4LDUuMDY5LDUuMDY5LDUuMDY5aDQxLjA2MmMyLjc5LDAsNS4wNjktMi4yNzgsNS4wNjktNS4wNjl2LTIwLjUzMWgtNTEuMlYyNTkuNDY1eiIvPjxwYXRoIGQ9Ik0xMDIuNCwyNTkuNDY1YzAsMi43OSwyLjI3OCw1LjA2OSw1LjA2OSw1LjA2OWg0MS4wNjJjMi43OSwwLDUuMDY5LTIuMjc4LDUuMDY5LTUuMDY5di0yMC41MzFoLTUxLjJWMjU5LjQ2NXoiLz48cGF0aCBkPSJNMTUzLjYsMjAxLjMzMWMwLTIuNzktMi4yNzgtNS4wNjktNS4wNjktNS4wNjloLTQxLjA2MmMtMi43OSwwLTUuMDY5LDIuMjc4LTUuMDY5LDUuMDY5djIwLjUzMWg1MS4yVjIwMS4zMzF6Ii8+PHBhdGggZD0iTTQyNi42NjcsMjU5LjQ2NWMwLDEyLjIxMS05LjkyNCwyMi4xMzUtMjIuMTM1LDIyLjEzNWgtNDEuMDYyYy0xMi4yMTEsMC0yMi4xMzUtOS45MjQtMjIuMTM1LTIyLjEzNXYtMjAuNTMxSDE3MC42Njd2MjAuNTMxYzAsMTIuMjExLTkuOTI0LDIyLjEzNS0yMi4xMzUsMjIuMTM1aC00MS4wNjJjLTEyLjIxMSwwLTIyLjEzNS05LjkyNC0yMi4xMzUtMjIuMTM1di0yMC41MzFIMHYyMDIuMTI5YzAsMjAuMjkyLDE2LjUxMiwzNi44MDQsMzYuNzk2LDM2LjgwNGg0MzguNDA5YzIwLjI4NCwwLDM2Ljc5Ni0xNi41MTIsMzYuNzk2LTM2LjgwNFYyMzguOTMzaC04NS4zMzNWMjU5LjQ2NXogTTM2Ni45MzMsNDA2LjY2NWMwLDExLjAyNS04Ljk3NywyMC4wMDItMjAuMDAyLDIwLjAwMkgxNjUuMDY5Yy0xMS4wMjUsMC0yMC4wMDItOC45NzctMjAuMDAyLTIwLjAwMnYtNzkuNDcxYzAtMTEuMDE3LDguOTc3LTE5Ljk5NCwyMC4wMDItMTkuOTk0aDE4MS44NjJjMTEuMDI1LDAsMjAuMDAyLDguOTc3LDIwLjAwMiwxOS45OTRWNDA2LjY2NXoiLz48cGF0aCBkPSJNMzQ2LjkzMywzMjQuMjY1SDE2NS4wN2MtMS42MjEsMC0yLjkzNSwxLjMxNC0yLjkzNSwyLjkzNXY3OS40NjJjMCwxLjYyMSwxLjMxNCwyLjkzNSwyLjkzNSwyLjkzNWgxODEuODYyYzEuNjEzLDAsMi45MzUtMS4zMTQsMi45MzUtMi45MzVWMzI3LjJDMzQ5Ljg2OCwzMjUuNTc5LDM0OC41NDYsMzI0LjI2NSwzNDYuOTMzLDMyNC4yNjV6Ii8+PC9nPjwvZz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PC9zdmc+' );

  //call register settings function
  add_action( 'admin_init', 'register_wopotoolkit_plugin_settings' );
}


function register_wopotoolkit_plugin_settings() {
  //register our settings
  register_setting( 'wopotoolkit-settings-group', 'wopotk_disable_password_change' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_excerpt_line_break' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_keep_first_tab' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_show_profile_picture' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_show_popup_after_process' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_hide_choose_an_option' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_add_swatch_inline_block_style' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_main_color' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_bulk_vari_vertical' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_checkbox_label' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_move_design_button' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_my_account_login' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_mobile_option_scroll' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_blur_license_key' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_move_design_category_to_top' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_hide_products_widget' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_alway_on_top' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_nbdesigner_hide_process_button' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_dokan_number_vendor_per_page' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_dokan_ensure_vendor_coupon' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_printshop_show_our_capabilities_mobile' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_teepro_click_outside_usermenu_hide' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_teepro_add_policy_widget' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_teepro_change_single_product' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_teepro_variation_form_2_start_design' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_woocommerce_search_product_only' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_woocommerce_change_to_product_search_form' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_woocommerce_product_gallery_zoom' );
  register_setting( 'wopotoolkit-settings-group', 'wopotk_woocommerce_update_cart_button' );
}

function wopotoolkit_plugin_settings_page() {
?>
<div class="wrap">
<h1>WoPo Toolkit</h1>
<?php include( plugin_dir_path( __FILE__ ) . 'tools.php'); ?>
<style>
  table.woocommerce th{
    color:blue;;
  }
  table.nbdesigner th{
    color:green;
  }
  table.dokan th{
    color:violet;
  }
  table.printshop th{
    color:crimson;
  }
  table.teepro th{
    color:olive;
  }
  table.tools th{
    color:orange;
  }
</style>

<form method="post" action="options.php">
    <?php settings_fields( 'wopotoolkit-settings-group' ); ?>
    <?php do_settings_sections( 'wopotoolkit-settings-group' ); ?>

    <table class="form-table wordpress">
      <tr valign="top">
        <th scope="row">Wordpress: Disable Password Change</th>
        <td>
          <input type="checkbox" name="wopotk_disable_password_change" value="1" <?php echo esc_attr(get_option('wopotk_disable_password_change'))  ? 'checked' : ''; ?> /> 
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">Wordpress: Add line break in post's excerpt</th>
        <td>
          <input type="checkbox" name="wopotk_excerpt_line_break" value="1" <?php echo esc_attr(get_option('wopotk_excerpt_line_break'))  ? 'checked' : ''; ?> /> 
        </td>
      </tr>
    </table>

    <table class="form-table woocommerce">
        <tr valign="top">
          <th scope="row">WooCommerce: Keep only first product tab</th>
          <td>
            <input type="checkbox" name="wopotk_keep_first_tab" value="1" <?php echo esc_attr(get_option('wopotk_keep_first_tab'))  ? 'checked' : ''; ?> /> 
          </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">WooCommerce: Show Biographical Info and Profile Picture on My Account </th>
        <td>
          <input type="checkbox" name="wopotk_show_profile_picture" value="1" <?php echo esc_attr(get_option('wopotk_show_profile_picture'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>        

        <tr valign="top">
        <th scope="row">WooCommerce: Hide Choose an option</th>
        <td>
          <input type="checkbox" name="wopotk_hide_choose_an_option" value="1" <?php echo esc_attr(get_option('wopotk_hide_choose_an_option'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">WooCommerce: Search product only</th>
        <td>
          <input type="checkbox" name="wopotk_woocommerce_search_product_only"  value="1" <?php echo esc_attr(get_option('wopotk_woocommerce_search_product_only'))  ? 'checked' : ''; ?>  /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">WooCommerce: Change to product search form</th>
        <td>
          <input type="checkbox" name="wopotk_woocommerce_change_to_product_search_form"  value="1" <?php echo esc_attr(get_option('wopotk_woocommerce_change_to_product_search_form'))  ? 'checked' : ''; ?>  /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">WooCommerce: Product gallery zoom</th>
        <td>
          <input type="checkbox" name="wopotk_woocommerce_product_gallery_zoom"  value="1" <?php echo esc_attr(get_option('wopotk_woocommerce_product_gallery_zoom'))  ? 'checked' : ''; ?>  /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">WooCommerce: Change Add to cart button to Update cart if product added to cart</th>
        <td>
          <input type="checkbox" name="wopotk_woocommerce_update_cart_button"  value="1" <?php echo esc_attr(get_option('wopotk_woocommerce_update_cart_button'))  ? 'checked' : ''; ?>  /> 
        </td>
        </tr>
      </table>

      <table class="form-table nbdesigner">
        <tr valign="top">
        <th scope="row">NBdesigner: Show Popup after process</th>
        <td>
          <input type="checkbox" name="wopotk_show_popup_after_process" value="1" <?php echo esc_attr(get_option('wopotk_show_popup_after_process'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBdesigner: Add stylesheet inline block for NBdesigner swatch</th>
        <td>
          <input type="checkbox" name="wopotk_add_swatch_inline_block_style" value="1" <?php echo esc_attr(get_option('wopotk_add_swatch_inline_block_style'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBdesigner: Change main color</th>
        <td>
          <input type="text" name="wopotk_nbdesigner_main_color" value="<?php echo esc_attr(get_option('wopotk_nbdesigner_main_color')); ?>" /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBdesigner: Show Bulk Variation vertical</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_bulk_vari_vertical" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_bulk_vari_vertical'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBdesigner: Show Printing Options 2 to label</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_checkbox_label" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_checkbox_label'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBdesigner: Move Start Design button to left side of Clear Selection button</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_move_design_button" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_move_design_button'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>        

        <tr valign="top">
        <th scope="row">NBDesigner: Change login popup to My Account for Image upload required function</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_my_account_login" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_my_account_login'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBDesigner: Scrollable printing option on Mobile device</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_mobile_option_scroll" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_mobile_option_scroll'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBDesigner: Blur license key input</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_blur_license_key" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_blur_license_key'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBDesigner: Move Design Category to top of sidebar on templates page</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_move_design_category_to_top" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_move_design_category_to_top'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBDesigner: Hide Products widget of sidebar on templates page</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_hide_products_widget" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_hide_products_widget'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBDesigner: Alway on top</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_alway_on_top" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_alway_on_top'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">NBDesigner: Hide process button</th>
        <td>
          <input type="checkbox" name="wopotk_nbdesigner_hide_process_button" value="1" <?php echo esc_attr(get_option('wopotk_nbdesigner_hide_process_button'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>
      </table>
      
      <table class="form-table dokan">
        <tr valign="top">
        <th scope="row">Dokan: Change number vendor per page</th>
        <td>
          <input type="text" name="wopotk_dokan_number_vendor_per_page" value="<?php echo esc_attr(get_option('wopotk_dokan_number_vendor_per_page')); ?>" /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Dokan: Disable Ensure vendor coupon</th>
        <td>
        <input type="checkbox" name="wopotk_dokan_ensure_vendor_coupon"  value="1" <?php echo esc_attr(get_option('wopotk_dokan_ensure_vendor_coupon'))  ? 'checked' : ''; ?>  />
        </td>
        </tr>
      </table>
      
      <table class="form-table printshop">
        <tr valign="top">
        <th scope="row">Printshop: Show Our Capabilities on Mobile</th>
        <td>
          <input type="checkbox" name="wopotk_printshop_show_our_capabilities_mobile"  value="1" <?php echo esc_attr(get_option('wopotk_printshop_show_our_capabilities_mobile'))  ? 'checked' : ''; ?>  /> 
        </td>
        </tr>        
      </table>
      
      <table class="form-table teepro">
        <tr valign="top">
        <th scope="row">Teepro: Hide User Menu when click outside</th>
        <td>
          <input type="checkbox" name="wopotk_teepro_click_outside_usermenu_hide" value="1" <?php echo esc_attr(get_option('wopotk_teepro_click_outside_usermenu_hide'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Teepro: Add Policy Widget</th>
        <td>
          <input type="checkbox" name="wopotk_teepro_add_policy_widget" value="1" <?php echo esc_attr(get_option('wopotk_teepro_add_policy_widget'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Teepro: Change single product for NBDesigner Visual Design editor layout</th>
        <td>
          <input type="checkbox" name="wopotk_teepro_change_single_product" value="1" <?php echo esc_attr(get_option('wopotk_teepro_change_single_product'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Teepro: Move variation form to above start design button</th>
        <td>
          <input type="checkbox" name="wopotk_teepro_variation_form_2_start_design" value="1" <?php echo esc_attr(get_option('wopotk_teepro_variation_form_2_start_design'))  ? 'checked' : ''; ?> /> 
        </td>
        </tr>
      </table>
      
      <table class="form-table tools">
        <tr valign="top">
        <th scope="row">Tools: Save and restore actived plugins</th>
        <td>
          <?php
          if ($wopotk_active_plugins_saved===false):
          ?>
          <a href='?page=wopo-toolkit&tool=save-actived-plugin'>Save</a><br/>
          <?php
          else:
          ?>
            <a href='?page=wopo-toolkit&tool=restore-actived-plugin' style=>Restore</a><br/>
            <a href='?page=wopo-toolkit&tool=delete-actived-plugin' style=>Delete</a>
          <?php
          endif;
          ?>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Tools: Record updated plugins</th>
        <td>
          <?php
          if ($wopotk_update_log===false):
          ?>
            <a href='?page=wopo-toolkit&tool=start-update-log'>Start record log</a><br/>
          <?php
          else:
          ?>
            <a href='?page=wopo-toolkit&tool=view-update-log' style=>View log</a><br/>
            <a href='?page=wopo-toolkit&tool=stop-update-log' style=>Stop record log</a>
          <?php
          endif;
          ?>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Tools: phpinfo() & imagick</th>
        <td>
          <a target='_blank' href='<?= site_url() ?>?wopo-toolkit=phpinfo'>View</a><br/>
        </td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php }