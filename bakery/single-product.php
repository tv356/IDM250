<?php
get_header();

if (have_posts()) : while (have_posts()) : the_post();
    $product_id = get_the_ID();
    $product_title = get_the_title();
    $product_price = get_post_meta($product_id, '_custom_product_price', true); 
    $product_description = get_the_content();
    $product_thumbnail = get_the_post_thumbnail_url($product_id, 'full');
    $categories = get_the_terms($product_id, 'custom_product_category');
    $related_products = get_posts([
        'post_type' => 'custom_product',
        'posts_per_page' => 4,
        'post__not_in' => [$product_id],
    ]);
?>

<div class="product_detail" id="product-<?php echo $product_id; ?>">
    <div class="container">
        <div class="box_product_detail">
            <div class="product_img-slider">
                <div class="box_silder">
                    <div class="slider-for">
                        <img src="<?php echo esc_url($product_thumbnail); ?>" alt="<?php echo esc_attr($product_title); ?>">
                    </div>
                </div>
            </div>
            <div class="product_content summary entry-summary">
                <h1 class="product_title entry-title"> <?php echo esc_html($product_title); ?> </h1>
                <p class="price"> <?php echo esc_html(number_format($product_price, 0, ',', '.')); ?>₫ </p>
                <div class="woocommerce-product-details__short-description">
                    <p><?php echo esc_html($product_description); ?></p>
                </div>
                <div class="product_meta">
                    <span class="posted_in">Categories: 
                        <?php if ($categories) : 
                            foreach ($categories as $category) {
                                echo '<a href="' . get_term_link($category) . '">' . esc_html($category->name) . '</a>, ';
                            }
                        endif; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="related block-product">
            <h3 class="title-related">Related Products</h3>
            <ul class="products columns-4">
                <?php foreach ($related_products as $related) : 
                    $related_id = $related->ID;
                    $related_title = get_the_title($related_id);
                    $related_price = get_post_meta($related_id, '_custom_product_price', true);
                    $related_thumbnail = get_the_post_thumbnail_url($related_id, 'medium');
                ?>
                    <li>
                        <div class="box">
                            <a href="<?php echo get_permalink($related_id); ?>">
                                <img src="<?php echo esc_url($related_thumbnail); ?>" alt="<?php echo esc_attr($related_title); ?>">
                            </a>
                            <div class="before_box">
                                <h4><a href="<?php echo get_permalink($related_id); ?>"> <?php echo esc_html($related_title); ?> </a></h4>
                                <span class="woocommerce-Price-amount amount"> <?php echo esc_html(number_format($related_price, 0, ',', '.')); ?>₫ </span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php
endwhile; endif;
get_footer();
?>
