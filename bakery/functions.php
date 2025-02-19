<?php

function my_custom_wc_theme_support() {
  add_theme_support( 'woocommerce' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
  add_theme_support('woocommerce_show_product_images');
  add_theme_support('woocommerce_show_product_sale_flash');

}
add_action( 'after_setup_theme', 'my_custom_wc_theme_support' );
function custom_remove_acction_woo(){
  remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count',20 );
  remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
  remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs',10);
  remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display',15);
}
add_action('init','custom_remove_acction_woo');

function slider_post_type(){
  $label = array(
      'name' => 'Ảnh slider',
      'singular_name' => 'Ảnh slider'
  );
  $args = array(
      'labels' => $label, 
      'description' => 'Ảnh slider', 
      'supports' => array(
          'title',
          'thumbnail'
      ), 
      'hierarchical' => false, 
      'public' => true, 
      'show_ui' => true, 
      'show_in_menu' => true, 
      'show_in_nav_menus' => true, 
      'show_in_admin_bar' => true, 
      'menu_position' => 5, 
      'menu_icon' => 'dashicons-format-gallery', 
      'can_export' => true, 
      'has_archive' => true, 
      'exclude_from_search' => false, 
      'publicly_queryable' => true, 
      'capability_type' => 'post' 
  );
  register_post_type('slider', $args); 
}
add_action('init', 'slider_post_type');


function hw_custom_post_type_args( $args, $post_type ) {
    if ( $post_type == "post" ) {
        $args['supports'][]='thumbnail';
    }

    return $args;
}
add_filter( 'register_post_type_args', 'hw_custom_post_type_args', 200, 2 );

function hw_modify_timeline_menu_icon( $post_type, $args ) {
    
    if ( 'post' != $post_type )
        return;

	global $wp_post_types;
    
    
    $args->supports = array('thumbnail');
    
    $wp_post_types[$post_type] = $args;
    
}
add_action( 'registered_post_type', 'hw_modify_timeline_menu_icon', 10, 2 );
function twentyseventeen_setup() {
   
    
    add_theme_support( 'post-thumbnails' );
    
    
    
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

function get_primary_category($category){
    $useCatLink = true;
    
    if ($category){
      $category_display = '';
      $category_link = '';
      if ( class_exists('WPSEO_Primary_Term') )
      {
        
        $wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
        $term = get_term( $wpseo_primary_term );
        if (is_wp_error($term)) {
          
          $category_display = $category[0]->name;
          $category_link = get_category_link( $category[0]->term_id );
        } else {
          
          $category_display = $term->name;
          $category_link = get_category_link( $term->term_id );
        }
      }
      else {
        
        $category_display = $category[0]->name;
        $category_link = get_category_link( $category[0]->term_id );
      }
      
      if ( !empty($category_display) ){
        if ( $useCatLink == true && !empty($category_link) ){
        return ''.htmlspecialchars($category_display).'';
        } else {
        return ''.htmlspecialchars($category_display).'';
        }
      }
    }
  }


add_filter('add_to_cart_redirect', 'custom_add_to_cart_redirect');
 
function custom_add_to_cart_redirect() {
     return get_permalink(get_option('woocommerce_cart_page_id')); 
}
?>

<?php
function theme_setup(){
  register_nav_menu('top_menu', 'Menu chính');
}

add_action('init','theme_setup');

?>
