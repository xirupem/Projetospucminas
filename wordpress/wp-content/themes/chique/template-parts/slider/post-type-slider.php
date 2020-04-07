<?php
/**
 * The template used for displaying slider
 *
 * @package Chique
 */

$quantity     = get_theme_mod( 'chique_slider_number', 4 );
$no_of_post   = 0; // for number of posts
$post_list    = array(); // list of valid post/page ids

$args = array(
	'post_type'           => 'any',
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1, // ignore sticky posts
);
//Get valid number of posts

for ( $i = 1; $i <= $quantity; $i++ ) {
	$post_id = '';

	$post_id = get_theme_mod( 'chique_slider_page_' . $i );

	if ( $post_id && '' !== $post_id ) {
		$post_list = array_merge( $post_list, array( $post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	$loop->the_post();

	$classes = 'post post-' . get_the_ID() . ' hentry slides';

	$thumbnail = 'chique-slider';
	?>
	<article class="<?php echo esc_attr( $classes ); ?>">
		<div class="hentry-inner">
			<?php chique_post_thumbnail( $thumbnail, 'html', true, true ); ?>

			<div class="entry-container">
				<header class="entry-header">
					<h2 class="entry-title">
						<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
				</header>
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article><!-- .slides -->
<?php
endwhile;

wp_reset_postdata();
