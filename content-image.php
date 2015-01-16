<?php
/**
 * Template for display image post media
 *
 * @package Mesh
 * @since Mesh 1.0
 */

$category = get_the_category()
?>

<?php if( has_post_thumbnail() ) { ?>
	<div class="post-media">
		<?php if( !is_singular() ) { ?>
			<div class="hover-image">
				<a href="http://instagram.com/lookmachine" target="_blank">
					<span><?php echo $category[0]->cat_name; ?></span>
						<?php the_post_thumbnail(); ?>
				</a>
			</div>
		<?php } else {
			the_post_thumbnail('full');
		} ?>
	</div>
<?php } ?>