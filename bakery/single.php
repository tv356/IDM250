<?php get_header() ?>
    <div class="main_single">
        <div class="box_single">
            <div class="title">
                <h1><?php the_title(); ?></h1>
            </div>
            <div class="box_img">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="content">
                <h4 class="title_text">Insights</h4>
                 <?php the_content();  ?>
            </div>
            <div class="new_relate">
                <div class="box_relate">
                <?php
                $post_type = get_post_type();
                $posts_per_page = 3;
                $query_args = array(
                            'category__in' => wp_get_post_categories($post->ID), 
                            'post_type' => $post_type, 
                            'posts_per_page' => $posts_per_page,
                            'post__not_in' => array($post->ID) 
                    );
                $related_query = new WP_Query($query_args);

                    if( !$related_query->have_posts() ) { 
                        $tags = wp_get_post_tags($post->ID);
                        $tag_ids = array();
                        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                        $query_args = array(
                            'post_type' => $post_type, 
                            'tag__in' => $tag_ids,
                            'post__not_in' => array($post->ID),
                            'posts_per_page'=> $posts_per_page, // Number of related posts to display.
                            'caller_get_posts'=>1
                        );
                        $related_query = new WP_Query($query_args);
                    }

                  
                    if( !$related_query->have_posts() ) {   
                        $query_args = array(  
                                        'post_type' => $post_type,
                                        'posts_per_page' =>  $posts_per_page  ,
                                        'order'     => 'desc',
                                        'post__not_in' => array($post->ID) 
                            );
                        $related_query = new WP_Query( $query_args );
                    }

     
                    if( $related_query->have_posts() ) { 
                        $category = get_the_category(); 
                    ?>
                        <div class="title">
                            <h3>related post</h3>
                            <a href="'.get_category_link($category[0]->cat_ID).'">View All Insights</a>
                        </div>
                        <ul class="list-news">
                        <?php
                        while ($related_query->have_posts()) : $related_query->the_post();
                        ?>
                        <li>
                            <div class="new-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('alt' =>get_the_title(), 'class'=>'related-thumb', 'itemprop'=>'image' ) ); ?></a></div>
                            <div class="item-list">
                                <h4><a href="<?php the_permalink() ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h4>
                                <?php the_excerpt(); ?>
                            </div>
                        </li> 
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer() ?>
