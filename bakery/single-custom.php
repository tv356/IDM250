<?php
/**
 * Template Name: Custom Post Style
 * Template Post Type: post
 */
get_header(); ?>

<!-- Inline Styling -->
<style>
    /* Custom Blue Banner */
    .custom-banner {
        background-color: #0066CC;
        color: white;
        padding: 30px;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .custom-banner h1 {
        font-size: 36px;
        font-weight: bold;
        margin: 0;
    }

    /* Post Meta Information */
    .post-meta {
        text-align: center;
        color: #666;
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* Post Content */
    .post-content {
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 40px;
    }

    /* Quote Banner */
    .quote-banner {
        background-color: #f0f0f0;
        border-left: 5px solid #0066CC;
        padding: 20px 30px;
        border-radius: 10px;
        margin-bottom: 40px;
        font-style: italic;
    }

    .quote-banner blockquote {
        margin: 0;
        padding: 0;
    }

    .quote-banner footer {
        text-align: right;
        font-weight: bold;
        margin-top: 10px;
    }

    /* External Links Section */
    .external-links {
        margin-top: 50px;
    }

    .external-links h2 {
        font-size: 24px;
        color: #0066CC;
        margin-bottom: 20px;
    }

    /* External Link Box */
    .external-link-box {
        margin-bottom: 20px;
    }

    .external-link {
        display: flex;
        align-items: center;
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 10px;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .external-link:hover {
        background-color: #e6f7ff;
    }

    .external-link .link-thumbnail {
        width: 60px;
        height: 60px;
        margin-right: 20px;
        border-radius: 5px;
        overflow: hidden;
    }

    .external-link .link-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }

    .external-link .link-text {
        font-size: 18px;
        font-weight: 500;
        max-width: 80%;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    /* Add padding on the sides for all content */
    .custom-post-container {
        padding: 0 20px;
    }
    body {
        padding: 5vw;
    }

</style>

<!-- Blue Banner -->
<div class="custom-banner">
    <h1><?php the_title(); ?></h1>
</div>

<div class="custom-post-container">
    <!-- Post Meta Information -->
    <div class="post-meta">
        <span>By <?php the_author(); ?> | <?php the_date(); ?></span>
    </div>

    <!-- Post Content -->
    <div class="post-content">
        <?php the_content(); ?>
    </div>

    <!-- Quote Box -->
    <div class="quote-banner">
        <blockquote>
            <p>"<?php the_field('quote_text'); ?>"</p> <!-- If you use a custom field for quotes -->
            <footer>— <?php the_field('quote_author'); ?></footer> <!-- Custom field for author -->
        </blockquote>
    </div>

    <!-- External Links Section -->
    <div class="external-links">
        <h2>Related Links</h2>
        <?php
        // Assuming you have custom fields for external links (e.g., 'external_links' array with 'link' and 'thumbnail')
        $external_links = get_field('external_links'); // Custom field that returns an array of links

        if ($external_links) :
            foreach ($external_links as $link) :
                $url = $link['link'];  // Get URL
                $thumb = $link['thumbnail'];  // Get thumbnail image
                ?>
                <div class="external-link-box">
                    <a href="<?php echo esc_url($url); ?>" target="_blank" class="external-link">
                        <?php if ($thumb) : ?>
                            <div class="link-thumbnail">
                                <img src="<?php echo esc_url($thumb['url']); ?>" alt="<?php echo esc_attr($thumb['alt']); ?>" />
                            </div>
                        <?php endif; ?>
                        <span class="link-text"><?php echo esc_html($link['link_title']); ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No related links available.</p>
        <?php endif; ?>
    </div>

</div>

<?php get_footer(); ?>
