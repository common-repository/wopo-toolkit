<?php
/**
 * Plugin Name: WoPo Toolkit
 * Plugin URI:  https://wopoweb.com
 * Description: Toolkit for Wordpress
 * Version:     1.2.0
 * Author:      WoPo
 * Author URI:  https://wopoweb.com/contact-us/
 * Text Domain: wopotoolkit
 * Domain Path: /languages
 * License:     GPL2
 */

// define the woocommerce_before_my_account callback 
function wopotk_action_woocommerce_before_my_account( $wccm_before_checkout ) { 
    global $current_user;
    echo get_avatar($current_user->data->ID);
    echo '<span>'.make_clickable(get_the_author_meta('user_description',$current_user->data->ID)).'</span>';
}; 
         
// Show profile picture and Biographical Info
if (esc_attr(get_option('wopotk_show_profile_picture'))){
  add_action( 'woocommerce_account_dashboard', 'wopotk_action_woocommerce_before_my_account', 10, 1 ); 
}


// hide choose an option 
if (esc_attr(get_option('wopotk_hide_choose_an_option'))){
  add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'wopotk_filter_dropdown_option_html', 12, 2 );
}
function wopotk_filter_dropdown_option_html( $html, $args ) {
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
    $show_option_none_html = '<option value="">' . esc_html( $show_option_none_text ) . '</option>';

    $html = str_replace($show_option_none_html, '', $html);

    return $html;
}


function wopotk_enqueue_script() {
  $custom_css = '';
  $jsvar = array();
  //show popup after process NBDesigner
  wp_enqueue_style( 'wopo_toolkit_style', plugin_dir_url( __FILE__ ) . 'assets/css/frontend.css');
  wp_enqueue_script( 'wopo_toolkit_script', plugin_dir_url( __FILE__ ) . 'assets/js/frontend.js', array('jquery'), '1.0.0', true );
  //define variable for javascript  
  if (esc_attr(get_option('wopotk_nbdesigner_checkbox_label'))){
    $jsvar['wopotk_nbdesigner_checkbox_label'] = true;
    $custom_css .= ".nbo-checkbox{width:auto !important;height:auto !important;padding: 5px 10px;}.nbo-checkbox:after{display:none !important}\r\n";
  }
  //teepro move variation form 2 above start design button
  if (esc_attr(get_option('wopotk_teepro_variation_form_2_start_design'))){
    $jsvar['wopotk_teepro_variation_form_2_start_design'] = true;
  }
  //teepro hide usermenu when click outside 
  if (esc_attr(get_option('wopotk_teepro_click_outside_usermenu_hide'))){
    $jsvar['wopotk_teepro_click_outside_usermenu_hide'] = true;
  }
  //move design category to top sidebar
  if (esc_attr(get_option('wopotk_nbdesigner_move_design_category_to_top'))){
    $jsvar['wopotk_nbdesigner_move_design_category_to_top'] = true;
  }
  //hide products widget on templates sidebar
  if (esc_attr(get_option('wopotk_nbdesigner_hide_products_widget'))){
    $jsvar['wopotk_nbdesigner_hide_products_widget'] = true;
  }
  // move design button left side clear section
  if (esc_attr(get_option('wopotk_nbdesigner_move_design_button'))){
    $jsvar['wopotk_nbdesigner_move_design_button'] = true;
    $custom_css .= ".nbo-clear-option-wrap,.nbdesigner_frontend_container{display:inline}.nbdesigner_frontend_container{float:left}\r\n";
  }
  // Change single product for NBDesigner Visual Design editor layout
  if (esc_attr(get_option('wopotk_teepro_change_single_product'))){
    $custom_css .= "@media (min-width:768px){body.nbd-visual-layout .shop-main:not(.wide) .single-product-wrap .entry-summary,body.nbd-visual-layout .shop-main:not(.wide) .single-product-wrap .product-image{-ms-flex:0 0 100% !important;flex:0 0 100% !important;max-width:100% !important}}\r\n";
  }
  if (esc_attr(get_option('wopotk_show_popup_after_process'))){
    add_action('wp_footer', 'wopotk_insert_my_footer');

    wp_enqueue_script('jquery-modal',plugin_dir_url( __FILE__ ) . 'assets/libs/jquery.modal.min.js',array('jquery'), '1.0.0', true);
    wp_enqueue_style('jquery-modal',plugin_dir_url( __FILE__ ) . 'assets/libs/jquery.modal.min.css');
    $jsvar['wopotk_show_popup_after_process'] = true;
  }
  // Nbdesigner: Alway on top
  if (esc_attr(get_option('wopotk_nbdesigner_alway_on_top'))){
    $jsvar['wopotk_nbdesigner_alway_on_top'] = true;
  }
  //add style inline block for NBdesigner swatch
  if (esc_attr(get_option('wopotk_add_swatch_inline_block_style'))){
    $custom_css .= ".nbd-swatch{display:inline-block !important}\r\n";
  }

  // css vertical bulk variantion for NBdesigner
  if (esc_attr(get_option('wopotk_nbdesigner_bulk_vari_vertical'))){
    $custom_css .= ".nbo-bulk-variation tr > *{display:block;height:60px;}.nbo-bulk-variation tr{display:table-cell;}\r\n";
  }

  // Scrollable printing option on Mobile device
  if (esc_attr(get_option('wopotk_nbdesigner_mobile_option_scroll'))){
    $custom_css .= ".single-product-wrap .cart{max-width:100%;}\r\n";
  }

 // Show Our Capabilities on mobile
  if (esc_attr(get_option('wopotk_printshop_show_our_capabilities_mobile'))){
    $custom_css .= "@media (max-width:767px){#home-content-out-cap.panel-row-style{display:block!important}}\r\n";
  }

  if (!empty($custom_css)){
    wp_add_inline_style( 'wopo_toolkit_style', $custom_css );
  }

  if (count($jsvar)){
    wp_localize_script('wopo_toolkit_script','wopotk',$jsvar);
  }
}
add_action('wp_enqueue_scripts', 'wopotk_enqueue_script', 20, 1);

function wopotk_insert_my_footer() {
    ?>
    <div id="cmdialog">
    <p>Your design has been successfully processed. You are now ready to add the product to cart.</p>
  </div>
    <?php
}


/* start menu admin */
include( plugin_dir_path( __FILE__ ) . 'include/options.php');


if (esc_attr(get_option('wopotk_keep_first_tab'))){
  //remove all other tabs
  add_filter( 'woocommerce_product_tabs', 'wopotk_remove_product_tabs', 98 );

  function wopotk_remove_product_tabs( $tabs ) {
    while (count($tabs)>1) {
      array_pop($tabs);
    }
      return $tabs;
  }
}

if (esc_attr(get_option('wopotk_excerpt_line_break'))){
  //add line break to post's excerpt
  function wopotk_add_post_excerpt_line_break( $excerpt ) {
    if ( is_admin() ) {
      return $excerpt;
    }
    $excerpt = get_the_excerpt();
    $excerpt = str_replace( array("\r\n", "\r", "\n"), '<br />', $excerpt );
    return $excerpt;
  }

  add_filter( 'the_excerpt', 'wopotk_add_post_excerpt_line_break', 999 );
}

if (esc_attr(get_option('wopotk_disable_password_change'))){
  //disable password change
  add_filter('wp_pre_insert_user_data', function($data, $update, $user_id){
    $old_user_data = get_userdata( $user_id );
  
    if ($old_user_data->data->user_pass != $data['user_pass']){
      add_action( 'admin_notices', function(){
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php _e( 'Password change is disabled.', 'wopotoolkit' ); ?></p>
        </div>
        <?php
      } );
  
      return null;
    }
  
    return $data;
  }, 3, 10);
}

add_action( 'nbd_js_config', 'wopotk_add_nbdesign_config' );
add_action( 'template_redirect', 'wopotk_add_custom_css_content' );

$wopotk_designer_style = '';
//add nbdesigner color
$wopotk_nbdesigner_color = esc_attr(get_option('wopotk_nbdesigner_main_color'));
if (!empty($wopotk_nbdesigner_color)){
  $wopotk_designer_style .= '.nbd-main-bar ul.menu-right .menu-item.item-process,
        #selectedTab span:after,
        .nbd-sidebar .tabs-nav{background:'.$wopotk_nbdesigner_color.'}';
}
//hide nbdesigner process button
if (esc_attr(get_option('wopotk_nbdesigner_hide_process_button'))){
  $wopotk_designer_style .= '.item-process{display:none !important}';
}

function wopotk_add_nbdesign_config()
{  
  global $wopotk_designer_style;
  if (!empty($wopotk_designer_style)){
    echo 'var head = document.getElementsByTagName("HEAD")[0];  
          var link = document.createElement("link"); 
    
          // set the attributes for link element  
          link.rel = "stylesheet";  
        
          link.type = "text/css"; 
        
          link.href = "'.site_url().'?wopo-toolkit";  
    
          // Append link element to HTML head 
          head.appendChild(link);';
  }
  if (esc_attr(get_option('wopotk_nbdesigner_my_account_login'))){
    ?>
    NBDESIGNCONFIG['login_url'] = "<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ).'?nbd_redirect=1'; ?>";
    <?php
  }
}

function wopotk_add_custom_css_content()
{
  if( is_front_page() && isset($_GET['wopo-toolkit'])){
    if ($_GET['wopo-toolkit']=='phpinfo' && current_user_can('administrator'))
    {      
      // view phpinfo() 
      if (!extension_loaded('imagick')){
        echo '<span style="color:red">imagick not installed</span>';
      }else{
        echo '<span style="color:green">imagick installed</span>';
      }
        
      phpinfo();
      die();      
    }else{
      global $wopotk_designer_style;
      $nbdesigner_color = esc_attr(get_option('wopotk_nbdesigner_main_color'));
      header("Content-Type: text/css; charset=utf-8");
      echo "/* WoPo Toolkit style */\r\n";
      echo $wopotk_designer_style;
      die;
    }
  }
}

//number vendor per page
$wopotk_dokan_number_vendor_per_page = esc_attr(get_option('wopotk_dokan_number_vendor_per_page'));
if (!empty($wopotk_dokan_number_vendor_per_page)){
  add_filter('dokan_store_listing_per_page','wopotk_change_store_listing',10,1);
  function wopotk_change_store_listing($atts){
    global $wopotk_dokan_number_vendor_per_page;
    $atts['per_page'] = $wopotk_dokan_number_vendor_per_page;
    return $atts;
  }
}

if (esc_attr(get_option('wopotk_nbdesigner_blur_license_key'))){
  add_action( 'admin_enqueue_scripts', 'wopotk_load_admin_styles',31 );
  function wopotk_load_admin_styles() {
    $custom_style = '#nbdesigner_input_key:not(:focus) {
    filter: blur(3px);
    -webkit-filter: blur(3px);
  }';
    wp_add_inline_style( 'nbdesigner_settings_css', $custom_style);
  }
}

class wopotk_Teepro_Policy_Widget extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'teepro-policy-widget',  // Base ID
            'Teepro Policy Widget'   // Name
        );
    }
 
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );
    
 
    public function widget( $args, $instance ) {
 
        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
 
        echo '<div class="textwidget">';
 
        echo $instance['text'];
 
        echo '</div>';
 
        echo $args['after_widget'];
 
    }
 
    public function form( $instance ) {
      $defaultText = '<ul class="sidebar-policy">
  <li class="clear">
    <div class="sidebar-top-icon">
      <i class="fa fa-cog" ></i>
    </div>
    <p><a href="#">We will send this product in 2 days. Read more...</a></p>
  </li>
  <li class="clear">
    <div class="sidebar-top-icon">
      <i class="fa fa-transgender" ></i>
    </div>
    <p><a href="#">Call us now for more info about our products.</a></p>
  </li>
  <li class="clear">
    <div class="sidebar-top-icon">
      <i class="fa fa-desktop"></i>
    </div>
    <p><a href="#">Return purchased items and get all your money back.</a></p>
  </li>
  <li class="clear">
    <div class="sidebar-top-icon">
      <i class="fa fa-ban" ></i>
    </div>
    <p><a href="#">Buy this product and earn 10 special loyalty points!</a></p>
  </li>
</ul>';
 
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : $defaultText;
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'Text' ) ); ?>"><?php echo esc_html__( 'Text:', 'text_domain' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" cols="30" rows="10"><?php echo esc_attr( $text ); ?></textarea>
        </p>
        <?php
 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
 
        return $instance;
    }
 
}

if (esc_attr(get_option('wopotk_teepro_add_policy_widget'))){
  add_action( 'widgets_init', function() {
    register_widget( 'wopotk_Teepro_Policy_Widget' );
  });
}

if (esc_attr(get_option('wopotk_woocommerce_search_product_only'))){
  add_action( 'pre_get_posts', 'wopotk_woocommerce_search_product_only' );

  function wopotk_woocommerce_search_product_only( $query ) {
    if( ! is_admin() && is_search() && $query->is_main_query() ) {
      $query->set( 'post_type', 'product' );
    }
  }
}

if (esc_attr(get_option('wopotk_woocommerce_change_to_product_search_form'))){
  add_filter('get_search_form','wopotk_woocommerce_change_to_product_search_form',10,1);

  function wopotk_woocommerce_change_to_product_search_form($form){
    $form = str_replace('</form>','<input type="hidden" name="post_type" value="product" /></form>',$form);
    return $form;
  }
}

if (esc_attr(get_option('wopotk_woocommerce_product_gallery_zoom'))){
  add_theme_support( 'wc-product-gallery-zoom' );
}

if (esc_attr(get_option('wopotk_woocommerce_update_cart_button'))){
  function wopotk_add_to_cart_text($var){
    global $product;
    $in_cart = false;
    $product_id = $product->get_id();
    foreach(WC()->cart->get_cart() as $cart_item ) {
      if ($cart_item['product_id'] == $product_id){
        $in_cart = true;
      }
    }
    if($in_cart){
      return esc_attr__( 'Update cart', 'woocommerce' );
    }
    return $var;
  }

  add_filter( 'woocommerce_product_single_add_to_cart_text', 'wopotk_add_to_cart_text',11,1); 
}

if (esc_attr(get_option('wopotk_dokan_ensure_vendor_coupon'))){
  add_filter('dokan_ensure_vendor_coupon','wopotk_dokan_ensure_vendor_coupon');

  function wopotk_dokan_ensure_vendor_coupon($valid){
    return false;
  }
}

/* record update log */
add_filter('upgrader_package_options','wopotk_before_update',10,1);

function wopotk_before_update($options){
  global $wopotk_plugins;
  $wopotk_plugins = get_plugins();
  return $options;
}

add_action('upgrader_process_complete','wopotk_update_logger',10,2);

function wopotk_update_logger($instant,$option){  
  global $wopotk_plugins;
  $current_plugins = get_plugins();

  $wopotk_update_log = get_option('wopotk_update_log');
  $wopotk_update_log_data = maybe_unserialize($wopotk_update_log);
  if ((isset($wopotk_update_log_data['date']) && $wopotk_update_log_data['date']!= date('Y.m.d'))||($wopotk_update_log == false)){
    $wopotk_update_log_data['date'] = date('Y.m.d');
    $wopotk_update_log_data['log'] = '';
  }

  if ($option['action']=='update' && $option['type']=='plugin'){
    foreach ($option['plugins'] as $plugin){
      $updated = $wopotk_plugins[$plugin]['Name'] . ' plugin updated. Old version: '. $wopotk_plugins[$plugin]['Version'] . ' -> new version: ' . $current_plugins[$plugin]['Version'] . "<br />";
      $wopotk_update_log_data['log'] .= $updated;
    } 
    update_option('wopotk_update_log',maybe_serialize($wopotk_update_log_data)); 
  }
}
