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
			<div class="hover-image" style="background-color:<?php
			switch ($category[0]->cat_name) {
				case "#LOOKMACHINECasual":
					echo "#ef9486";
					break;
				case "#LOOKMACHINEWork":
					echo "#d1c4e9";
					break;
				case "#LOOKMACHINEGoingout":
					echo "#a7ea83";
					break;
				default:
					echo "#ef9486";}?>">
				<a href="http://instagram.com/lookmachine" target="_blank">
					<span><?php echo $category[0]->cat_name; ?></span>
						<?php the_post_thumbnail( 'thumbnail' ); ?>
				</a>
			</div>
		<?php } else {
			the_post_thumbnail( 'thumbnail');
		} ?>
	</div>
<?php } ?>