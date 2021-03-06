<?php /*
Theme setup
*/

add_action( 'after_setup_theme', 'wpt_setup' );
if ( ! function_exists( 'wpt_setup' ) ):
	function wpt_setup() {
		register_nav_menus(
		array(
			'principal' => __( 'Principal' ),
			'cardapio' => __( 'Cardapio' ),
			'brinquedos' => __( 'Brinquedos' ),
		)
		);
	} endif;


add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( );


add_action( 'widgets_init', 'widgets_init' );
function widgets_init() {
register_sidebar( array(
	'name' => __( 'Sidebar Primary', 'widgets_init' ),
	'id' => 'sidebar-1',
	'before_widget' => '<aside id="%1$s" class="widget %2$s" style="display: table-cell">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
register_sidebar( array(
	'name' => __( 'Footer', 'widgets_init' ),
	'id' => 'sidebar-2',
	'before_widget' => '<div id="%1$s" class="widget %2$s" style="display: table-cell">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
}


add_action("login_head", "my_login_head");
function my_login_head() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('".get_bloginfo('template_url')."/img/logo.png') no-repeat scroll center top transparent;
		background-size: contain;
		height: 150px;
		width: 300px;
	}
	</style>
	";
}


// split content at the more tag and return an array
function split_content() {
	global $more;
	$more = true;
	$content = preg_split('/<span id="more-d+"></span>/i', get_the_content('more'));
	for($c = 0, $csize = count($content); $c < $csize; $c++) {
		$content[$c] = apply_filters('the_content', $content[$c]);
	}
	return $content;
} ?>