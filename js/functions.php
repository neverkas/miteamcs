<?php

include('custom-gmaps.php');
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 600;

/**
 * Tell WordPress to run colormagic_setup() when the 'after_setup_theme' hook is run.
 */
 if ( function_exists( 'add_theme_support' ) )  add_theme_support( 'post-thumbnails' );


add_action( 'after_setup_theme', 'colormagic_setup' );

if ( ! function_exists( 'colormagic_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
**/
function colormagic_setup() {

	// Make Color Magic available for translation.
	load_theme_textdomain( 'colormagic', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'colormagic' ) );

}
endif; // colormagic_setup

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function colormagic_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'colormagic_excerpt_length' );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function colormagic_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'colormagic_page_menu_args' );

/**
 * Register our sidebars and widgetized areas.
 *
 */
function colormagic_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'colormagic' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'colormagic_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
function colormagic_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>

<nav id="<?php echo $nav_id; ?>">
  <div class="nav-previous">
    <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'colormagic' ) ); ?>
  </div>
  <div class="nav-next">
    <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'colormagic' ) ); ?>
  </div>
</nav>
<!-- #nav-above -->
<?php endif;
}

if ( ! function_exists( 'colormagic_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own colormagic_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Color Magic 1.0
 */
function colormagic_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'colormagic' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( 'Edit', 'colormagic' ), '<span class="edit-link">', '</span>' ); ?>
  </p>
  <?php
			break;
		default :
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>" class="comment">
    <footer class="comment-meta">
      <div class="comment-author vcard">
        <?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'colormagic' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'colormagic' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
        <?php edit_comment_link( __( 'Edit', 'colormagic' ), '<span class="edit-link">', '</span>' ); ?>
      </div>
      <!-- .comment-author .vcard -->
      
      <?php if ( $comment->comment_approved == '0' ) : ?>
      <em class="comment-awaiting-moderation">
      <?php _e( 'Your comment is awaiting moderation.', 'colormagic' ); ?>
      </em> <br />
      <?php endif; ?>
    </footer>
    <div class="comment-content">
      <?php comment_text(); ?>
    </div>
    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'colormagic' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .reply --> 
  </article>
  <!-- #comment-## -->
  
  <?php
			break;
	endswitch;
}
endif; // ends check for colormagic_comment()

// Hidden category
function the_category_filter($thelist,$separator=' ') { 
if(!defined('WP_ADMIN')) { 
//Category IDs to exclude 
$exclude = array(1); 

$exclude2 = array(); 
foreach($exclude as $c) { 
$exclude2[] = get_cat_name($c); 
} 

$cats = explode($separator,$thelist); 
$newlist = array(); 
foreach($cats as $cat) { 
$catname = trim(strip_tags($cat)); 
if(!in_array($catname,$exclude2)) 
$newlist[] = $cat; 
} 
return implode($separator,$newlist); 
} else { 
return $thelist; 
} 
} 
add_filter('the_category','the_category_filter', 10, 2); 

?>