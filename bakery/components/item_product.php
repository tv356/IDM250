
    <?php global $product; ?>
	<li>
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail( get_the_id(), 'full', array( 'class' =>'thumnail') ); ?>
		</a>
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php echo $product->get_price_html(); ?>
        <a href="<?php get_checkout_url(); ?>">Buy now</a>
	</li>
