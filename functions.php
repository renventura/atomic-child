<?php
/**
 * Our child theme's functions. This will NOT override the parent's functions.php.
 */

/**
 * Load the parent and child theme styles
 */
function atomic_parent_theme_style() {

	// Parent theme styles
	wp_enqueue_style( 'atomic-style', get_template_directory_uri(). '/style.css' );

	// Child theme styles
	wp_enqueue_style( 'atomic-child-style', get_stylesheet_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'atomic_parent_theme_style' );

/**
 * Add additional functions below
 */


/**
 * Override the atomic_author_box() function to customize the output
 */
if ( ! function_exists( 'atomic_author_box' ) ) :
function atomic_author_box() {
	global $post, $current_user;
	$author = get_userdata( $post->post_author );
	if ( $author && ! empty( $author->description ) ) {
	?>
	<div class="author-profile">

		<a class="author-profile-avatar" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Posts by %s', 'atomic' ), get_the_author() ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'atomic_author_bio_avatar_size', 65 ) ); ?></a>

		<div class="author-profile-info">
			<h3 class="author-profile-title">
				<?php if ( is_archive() ) { ?>
					<?php echo esc_html( sprintf( esc_html__( 'All posts by %s', 'atomic' ), get_the_author() ) ); ?>
				<?php } else { ?>
					<?php echo esc_html( sprintf( esc_html__( 'Posted by %s', 'atomic' ), get_the_author() ) ); ?>
				<?php } ?>
			</h3>

			<div class="author-description">
				<p><?php the_author_meta( 'description' ); ?></p>
			</div>

			<div class="author-profile-links">
				<a href="<?php echo esc_url( get_author_posts_url( $author->ID ) ); ?>"><i class="fa fa-pencil-square-o"></i> <?php esc_html_e( 'All Posts', 'atomic' ); ?></a>

				<?php if ( $author->user_url ) { ?>
					<?php printf( '<a href="%1$s"><i class="fa fa-external-link"></i> %2$s</a>', esc_url( $author->user_url ), 'Website', 'atomic' ); ?>
				<?php } ?>

				<?php
					if ( $twitter_profile = get_the_author_meta( 'twitter', $author->ID ) ) {
						printf( '<a href="%1$s"><i class="fa fa-external-link"></i> %2$s</a>', "https://twitter.com/{$twitter_profile}" , __( 'Twitter' ) );
					}
				?>
			</div>
		</div><!-- .author-drawer-text -->
	</div><!-- .author-profile -->

<?php } } endif;