<?php get_header() ?>
    <div class="main_page container">
        <div class="box_page">
            <div class="box_img">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="content">
                 <?php the_content();  ?>
            </div>
        </div>
    </div>
<?php get_footer() ?>
