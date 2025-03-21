<?php

function display_custom_products_shortcode($atts) {
    ob_start();


    $args = array(
        'post_type'      => 'custom_product',
        'posts_per_page' => -1, 
        'post_status'    => 'publish',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<ul class="products columns-4"><div class="container"><div class="custom_col_category">';

        while ($query->have_posts()) {
            $query->the_post();
            $product_id = get_the_ID();
            $product_title = get_the_title();
            $product_url = get_permalink();
            $product_image = get_the_post_thumbnail_url($product_id, 'woocommerce_thumbnail') ?: 'https://via.placeholder.com/358x451';
            $product_price = get_post_meta($product_id, '_custom_product_price', true) ?: 'Liên hệ'; 
			
			
            $currency_symbol = '₫'; 

            ?>
            <li class="product type-product">
                <a href="<?php echo esc_url($product_url); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                    <img width="358" height="451" src="<?php echo esc_url($product_image); ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="<?php echo esc_attr($product_title); ?>" loading="lazy">
                    <h2 class="woocommerce-loop-product__title"><?php echo esc_html($product_title); ?></h2>
                    <span class="price">
                        <span class="woocommerce-Price-amount amount">
                            <bdi><?php echo esc_html($product_price); ?>&nbsp;<span class="woocommerce-Price-currencySymbol"><?php echo esc_html($currency_symbol); ?></span></bdi>
                        </span>
                    </span>
                </a>
                <a href="?add-to-cart=<?php echo esc_attr($product_id); ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr($product_id); ?>" rel="nofollow">
                    Add to cart
                </a>
            </li>
            <?php
        }

        echo '</div></div></ul>';
        wp_reset_postdata();
    } else {
        echo '<p>No products.</p>';
    }

    return ob_get_clean();
}

add_shortcode('custom_product_list', 'display_custom_products_shortcode');




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
    
    // Set menu icon
    $args->supports = array('thumbnail');
    
    $wp_post_types[$post_type] = $args;
    
}
add_action( 'registered_post_type', 'hw_modify_timeline_menu_icon', 10, 2 );
function twentyseventeen_setup() {
    //global $_wp_post_type_features;
    
    add_theme_support( 'post-thumbnails' );
    
    //$_wp_post_type_features['post']['thumbnail']=1;
    
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

function get_primary_category($category){
    $useCatLink = true;
    // If post has a category assigned.
    if ($category){
      $category_display = '';
      $category_link = '';
      if ( class_exists('WPSEO_Primary_Term') )
      {
        // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
        $wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
        $term = get_term( $wpseo_primary_term );
        if (is_wp_error($term)) {
          // Default to first category (not Yoast) if an error is returned
          $category_display = $category[0]->name;
          $category_link = get_category_link( $category[0]->term_id );
        } else {
          // Yoast Primary category
          $category_display = $term->name;
          $category_link = get_category_link( $term->term_id );
        }
      }
      else {
        // Default, display the first category in WP's list of assigned categories
        $category_display = $category[0]->name;
        $category_link = get_category_link( $category[0]->term_id );
      }
      // Display category
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







function create_custom_product_post_type() {
    $args = array(
        'label'         => 'Products',
        'public'        => true,
        'menu_icon'     => 'dashicons-cart',
        'supports'      => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'products'),
    );
    register_post_type('custom_product', $args);
}
add_action('init', 'create_custom_product_post_type');

function create_custom_product_taxonomies() {
    // Product Categories
    register_taxonomy('custom_product_category', 'custom_product', array(
        'label'        => 'Product Categories',
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'product-categories'),
    ));

    // Product Brands
    register_taxonomy('custom_product_brand', 'custom_product', array(
        'label'        => 'Product Brands',
        'hierarchical' => false,
        'rewrite'      => array('slug' => 'product-brands'),
    ));
}
add_action('init', 'create_custom_product_taxonomies');


function custom_product_custom_fields() {
    add_meta_box('custom_product_price', 'Price', 'custom_product_price_callback', 'custom_product', 'side');
}
add_action('add_meta_boxes', 'custom_product_custom_fields');

function custom_product_price_callback($post) {
    $price = get_post_meta($post->ID, '_custom_product_price', true);
    echo '<input type="number" name="custom_product_price" value="' . esc_attr($price) . '" placeholder="Enter product price"> VND';
}

function save_custom_product_price($post_id) {
    if (isset($_POST['custom_product_price'])) {
        update_post_meta($post_id, '_custom_product_price', $_POST['custom_product_price']);
    }
}
add_action('save_post', 'save_custom_product_price');


function add_custom_product_category_fields($term) {
    $image_id = get_term_meta($term->term_id, 'custom_product_category_image', true);
    $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="custom_product_category_image">Category Image</label></th>
        <td>
            <input type="hidden" id="custom_product_category_image" name="custom_product_category_image" value="<?php echo esc_attr($image_id); ?>">
            <div id="custom_product_category_image_preview">
                <?php if ($image_url) : ?>
                    <img src="<?php echo esc_url($image_url); ?>" style="max-width: 150px;">
                <?php endif; ?>
            </div>
            <button class="upload_image_button button">Upload Image</button>
            <button class="remove_image_button button">Remove Image</button>
        </td>
    </tr>
    <?php
}
add_action('custom_product_category_add_form_fields', 'add_custom_product_category_fields');
add_action('custom_product_category_edit_form_fields', 'add_custom_product_category_fields');


function save_custom_product_category_image($term_id) {
    if (isset($_POST['custom_product_category_image'])) {
        update_term_meta($term_id, 'custom_product_category_image', absint($_POST['custom_product_category_image']));
    }
}
add_action('edited_custom_product_category', 'save_custom_product_category_image');
add_action('create_custom_product_category', 'save_custom_product_category_image');

function custom_product_category_scripts($hook) {
    if (isset($_GET['taxonomy']) && $_GET['taxonomy'] === 'custom_product_category') {
        wp_enqueue_media(); 
        wp_enqueue_script('custom-product-category-script', get_template_directory_uri() . '/assets/js/custom-category.js', array('jquery', 'wp-util', 'wp-mediaelement', 'media-views'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'custom_product_category_scripts');
function enqueue_bakery_template_css() {
    if (is_page_template('bakery-template-01.php')) { 
        wp_enqueue_style('custom-bakery-template-style', get_template_directory_uri() . '/assets/css/bakery-template-01.css');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_bakery_template_css');
