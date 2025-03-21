<?php get_header() ?>
    <div id="main-content">
        <div class="banner">
            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/banner.webp" alt="">
        </div>
        <div class="main_new container">
            <div class="main_new-box">
                <div class="title">
                    <h3>NEWS</h3>
                </div>
                <!-- Get post News Query -->
                <?php $getposts = new WP_query(); $getposts->query('post_status=publish&showposts=4&post_type=post'); ?>
                <?php global $wp_query; $wp_query->in_the_loop = true; ?>
                <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                    <div class="list_blog">
                        <div class="list_blog-box">
                            <div class="news_img">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            </div>
                            <div class="blog_title">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
                                <?php the_excerpt('15'); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <!-- Get post News Query -->
            </div>
        </div>
        <div class="main_products container">
            <div class="title">
                <h3>BLIND BOX COLLECTIONS</h3>
            </div>
            <nav class="custom_nav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">CHRISTMAS DREAMS</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">CHRISTMAS DREAMS</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">CHRISTMAS DREAMS</button>
                </div>
            </nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active main_product-list" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <div class="row">
            <?php 
            $args = array( 
                'hide_empty' => 0,
                'taxonomy'   => 'custom_product_category',
                'orderby'    => 'id',
                'parent'     => 0
            ); 
            $categories = get_terms($args); 
            foreach ($categories as $category) {  
                
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
				
				
				    $image_id = get_term_meta($category->term_id, 'custom_product_category_image', true);
    
    $image_url = $image_id ? wp_get_attachment_url($image_id) : get_template_directory_uri() . '/assets/images/default-category.jpg';
				
				
            ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="box_product">
<div class="img">
    <a href="<?php echo get_term_link($category->slug, 'custom_product_category'); ?>">
        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" style="max-width: 150px;">
    </a>
</div>
                        <div class="content">
                            <div class="product_title">
                                <a href="<?php echo get_term_link($category->slug, 'custom_product_category'); ?>">
                                    <h3><?php echo esc_html($category->name); ?></h3>
                                </a>
                                <div class="cont"><?php echo $category->count; ?> <p>Products</p></div>
                            </div>
                            <div class="read_more">
                                <a href="<?php echo get_term_link($category->slug, 'custom_product_category'); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/next.png" alt="arrow">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

        </div>
        <div class="follow">
            <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-12 col_right">
                    <h3>FOLLOW US ON INSTAGRAM</h3>
                    <div class="img">
                        <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/CleanShot 2025-03-12 at 18.30.23@2x.png" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-12 col_lefft">
                    <div class="row">
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/CleanShot 2025-03-12 at 18.30.23@2x.png" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/hello.JPG" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/banana.PNG" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/coconut.PNG" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/E07B22AC-6254-4E12-86C3-F7763E417DDB.JPG" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/_MOP1888.PNG" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/oreo.PNG" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/Untitled-1 2.PNG" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/CleanShot 2025-03-12 at 18.31.10@2x.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php get_footer() ?>
