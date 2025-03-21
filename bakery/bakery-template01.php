<?php
/*
Template Name: Template Bakery 02
*/
get_header(); ?>

<main class="creative-bakery-template-main">
    <style>
        /* Import Single Day Font */
        @import url('https://fonts.googleapis.com/css2?family=Single+Day&display=swap');

        /* General Styling */
        .creative-bakery-template-main {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff; /* White background */
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header Section */
        .bakery-header {
            text-align: center;
            background-color: transparent; /* Transparent background */
            padding: 40px;
            position: relative;
        }

        .bakery-title {
            font-size: 48px;
            color: #3546A1; /* Blue color for title */
            margin-bottom: 10px;
            font-family: "Single Day", cursive; /* Using Single Day font */
        }

        .bakery-meta {
            font-size: 16px;
            color: #3546A1; /* Blue color for meta text */
        }

        /* 1px Blue Line Below Header */
        .bakery-header::after {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: #3546A1; /* Transparent blue line */
            margin-top: 20px;
        }

        /* Featured Image Section */
        .bakery-thumbnail img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            margin-top: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Content Section */
        .bakery-content {
            margin-top: 30px;
        }

        .bakery-introduction p {
            font-size: 18px;
            color: #555;
            line-height: 1.7;
            text-align: justify;
        }

        .bakery-full-content {
            font-size: 18px;
            color: #444;
            margin-top: 30px;
            line-height: 1.8;
            text-align: justify;
        }

        /* Quote Block Section */
        .quote-banner {
            background-color: #3546A1; /* Blue banner */
            padding: 20px;
            margin-top: 40px;
            border-radius: 10px;
            text-align: center;
            color: white;
            font-size: 22px;
            font-style: italic;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Related Posts Section */
        .related-posts {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid #ddd;
        }

        .related-posts h3 {
            text-align: center;
            font-size: 28px;
            color: #3546A1;
            margin-bottom: 30px;
        }

        /* Layout for Related Posts - Display them in 1 horizontal row */
        .related-posts .related-articles {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .related-posts .related-article {
            flex: 1;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .related-posts .related-article img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .related-posts .related-article .related-article-info {
            max-width: 100%;
        }

        /* Related Post Title - Remove outer blue box, keep blue text */
        .related-posts .related-article .related-article-info h4 {
            font-size: 22px;
            color: #3546A1; /* Blue color for title */
            margin-bottom: 10px;
            background-color: transparent; /* Removed blue background */
            padding: 0;
            text-align: left; /* Align text to the left */
        }

        .related-posts .related-article .related-article-info p {
            font-size: 16px;
            color: #777;
            text-align: justify;
        }

        /* Footer and Tags Section */
        .bakery-tags {
            margin-top: 40px;
            font-size: 18px;
            color: #333;
            text-align: center;
        }

        .bakery-tags p {
            margin: 0;
        }

    </style>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="bakery-article">
            
            <!-- Title Section -->
            <header class="bakery-header">
                <h1 class="bakery-title"><?php the_title(); ?></h1>
                <p class="bakery-meta">Published on <?php the_date(); ?> | <?php the_category(', '); ?></p>
            </header>
            
            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="bakery-thumbnail">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            <?php endif; ?>
            
            <!-- Content Section -->
            <div class="bakery-content">
                <div class="bakery-introduction">
                    <p><?php echo wp_trim_words(get_the_content(), 40, '...'); ?></p>
                </div>
                <div class="bakery-full-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- Quote Block Section -->
            <div class="quote-banner">
                <p>"Baking is not just a science, it's an art that creates a piece of happiness with every bite!"</p>
            </div>

            <!-- Tags Section -->
            <div class="bakery-tags">
                <p>Tags: <?php the_tags('', ', '); ?></p>
            </div>

            <!-- Related Posts Section -->
            <div class="related-posts">
                <h3>Related Posts</h3>
                <?php
                    $related_posts = new WP_Query(array(
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'rand'
                    ));

                    if ($related_posts->have_posts()) : 
                        echo '<div class="related-articles">';
                        while ($related_posts->have_posts()) : $related_posts->the_post();
                ?>
                            <div class="related-article">
                                <div class="related-article-thumbnail">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/500" alt="Default Image">
                                    <?php endif; ?>
                                </div>
                                <div class="related-article-info">
                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                                </div>
                            </div>
                <?php endwhile;
                        echo '</div>';
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
