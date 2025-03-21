<?php
/*
Template Name: Project Listing
*/

get_header();  // Include the header.php file

// Define the custom query to display posts or custom post types
$args = array(
    'post_type' => 'project', // Replace 'project' with your custom post type, if applicable
    'posts_per_page' => 10,   // Limit the number of posts displayed per page
);

$query = new WP_Query( $args );

// Check if there are posts to display
if ( $query->have_posts() ) : ?>
    <div class="project-listing">
        <?php
        // Start the Loop to display posts
        while ( $query->have_posts() ) : $query->the_post();
            ?>
            <div class="project-item">
                <h2 class="project-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="project-excerpt"><?php the_excerpt(); ?></div>
            </div>
        <?php
        endwhile;
        ?>

        <!-- Pagination for custom query -->
        <div class="pagination">
            <?php
            // Display pagination links for the custom query
            echo paginate_links( array(
                'total' => $query->max_num_pages,
            ) );
            ?>
        </div>

    </div>

<?php else : ?>
    <p>No projects found.</p>
<?php endif; ?>

<?php
// Reset post data to avoid conflicts
wp_reset_postdata();

get_footer();  // Include the footer.php file
