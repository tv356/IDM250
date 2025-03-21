<?php get_header(); ?>
<div class="page_category-blog container">
    <div class="row">
        <div class="box_title">
            <div class="title">
                <h3>
                    <?php single_cat_title() ?>
                </h3>
            </div>
        </div>
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="list_blog col-lg-4 col-md-4 col-12 ">
                <div class="list_blog-box">
                    <div class="news_img">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                    </div>
                    <div class="box">
                    <div class="date">
                        <?php echo get_the_date(); ?>
                    </div>
                    <div class="blog_title">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
                    </div>
                    </div>
                </div>
            </div>
        <?php endwhile;?>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
