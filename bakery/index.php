<?php get_header() ?>
    <div id="main-content">
        <div class="banner home_banner-slider">
            <?php $getposts = new WP_query(); 
            $getposts->query('post_status=publish&showposts=3&post_type=slider'); ?>
            <?php global $wp_query; $wp_query->in_the_loop = true; ?>
            <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                <?php echo get_the_post_thumbnail( '', 'full', array( 'class' =>'banner_item') ); ?>
            <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <div class="main_new container">
            <div class="main_new-box">
                <div class="title">
                    <h3>NEWS</h3>
                </div>
                
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
                        <?php $args = array( 
                            'hide_empty' => 0,
                            'taxonomy' => 'product_cat',
                            'orderby' => 'id',
                            'parent' => 0
                            ); 
                            $cates = get_categories( $args ); 
                            foreach ( $cates as $cate ) {  ?>
                                <?php 
                                    $thumbnail_id = get_woocommerce_term_meta($cate->term_id, 'thumbnail_id', true );
                                    $image = wp_get_attachment_url( $thumbnail_id );
                                ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="box_product">
                                        <div class="img">
                                        <a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>">
                                            <img src="<?php echo $image; ?>" alt="<?php echo $cate->name; ?>">
                                        </a>
                                        </div>
                                        <div class="content">
                                            <div class="product_title">
                                                <a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>"><h3><?php echo $cate->name; ?></h3></a>
                                                <div class="cont"><?php echo $cate->count; ?> <p>Products</p></div>
                                            </div>
                                            <div class="read_more">
                                                <a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>"><img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/next.png" alt="arrow"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade main_product-list" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <div class="row">
                        <?php $args = array( 
                            'hide_empty' => 0,
                            'taxonomy' => 'product_cat',
                            'orderby' => 'id',
                            'parent' => 0
                            ); 
                            $cates = get_categories( $args ); 
                            foreach ( $cates as $cate ) {  ?>
                                <?php 
                                    $thumbnail_id = get_woocommerce_term_meta($cate->term_id, 'thumbnail_id', true );
                                    $image = wp_get_attachment_url( $thumbnail_id );
                                ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="box_product">
                                        <div class="img">
                                        <a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>">
                                            <img src="<?php echo $image; ?>" alt="<?php echo $cate->name; ?>">
                                        </a>
                                        </div>
                                        <div class="content">
                                            <div class="product_title">
                                                <a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>"><h3><?php echo $cate->name; ?></h3></a>
                                                <div class="cont"><?php echo $cate->count; ?> <p>Products</p></div>
                                            </div>
                                            <div class="read_more">
                                                <a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>"><img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/next.png" alt="arrow"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade main_product-list" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                    <div class="row">
                        <?php $args = array( 
                            'hide_empty' => 0,
                            'taxonomy' => 'product_cat',
                            'orderby' => 'id',
                            'parent' => 0
                            ); 
                            $cates = get_categories( $args ); 
                            foreach ( $cates as $cate ) {  ?>
                                <?php 
                                    $thumbnail_id = get_woocommerce_term_meta($cate->term_id, 'thumbnail_id', true );
                                    $image = wp_get_attachment_url( $thumbnail_id );
                                ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="box_product">
                                        <div class="img">
                                        <a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>">
                                            <img src="<?php echo $image; ?>" alt="<?php echo $cate->name; ?>">
                                        </a>
                                        </div>
                                        <div class="content">
                                            <div class="product_title">
                                                <a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>"><h3><?php echo $cate->name; ?></h3></a>
                                                <div class="cont"><?php echo $cate->count; ?> <p>Products</p></div>
                                            </div>
                                            <div class="read_more">
                                                <a href="<?php echo get_term_link($cate->slug, 'product_cat'); ?>"><img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/next.png" alt="arrow"></a>
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
                        <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/flow2.webp" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-12 col_lefft">
                    <div class="row">
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/follow.webp" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/follow.webp" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/follow.webp" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/follow.webp" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/follow.webp" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/follow.webp" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/follow.webp" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/follow.webp" alt="">
                        </div>
                        <div class="col-4 list_img">
                            <img src="<?php bloginfo('stylesheet_directory') ?>/assets/images/follow.webp" alt="">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php get_footer() ?>
