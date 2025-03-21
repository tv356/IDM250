<?php
get_header();  // Include the header.php file

// Check if there are posts to display
if ( have_posts() ) : ?>
    <header class="archive-header">
        <h1 class="archive-title">
            <?php
            // If it's a category archive, display the category name
            if ( is_category() ) {
                single_cat_title();
            }
            // If it's a tag archive, display the tag name
            elseif ( is_tag() ) {
                single_tag_title();
            }
            // If it's a custom taxonomy, display the taxonomy name
            elseif ( is_tax() ) {
                single_term_title();
            } else {
                echo 'Archives'; // Default archive title
            }
            ?>
        </h1>
    </header>

    <div class="archive-content">
        <?php
        // Start the Loop to display posts
        while ( have_posts() ) : the_post();
            // Display post title and excerpt
            ?>
            <div class="archive-post">
                <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-excerpt"><?php the_excerpt(); ?></div>
            </div>
        <?php
        endwhile;
        ?>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            // Display pagination links
            the_posts_pagination( array(
                'prev_text' => 'Previous',
                'next_text' => 'Next',
            ) );
            ?>
        </div>

    </div>

<?php else : ?>
    <p>No posts found.</p>
<?php endif; ?>

<?php
get_footer();  // Include the footer.php file
