<?php
// Background

$bg = '';
$bg_type = rella_helper()->get_option( 'title-background-type' );
$bg_attachment = rella_helper()->get_option( 'title-bar-bg-attachment' );
if( 'solid' === $bg_type && $color = rella_helper()->get_option( 'title-bar-solid' ) ) {
	$bg = ' style="background-color: ' . $color . '"';
}
elseif( 'gradient' === $bg_type && $gradient = rella_helper()->get_option( 'title-bar-gradient' ) ) {
	if( ! empty( $gradient ) ) {
		$gradient = explode( '|', $gradient );
		$gradient[0] = 'background-image:' . $gradient[0];
		$bg = ' style="' . join( ';', $gradient ) . '"';
	}
}
elseif( 'image' === $bg_type && $bg = rella_helper()->get_option( 'title-bar-bg' ) ) {
	$bg = ' style="background-image: url(' . $bg['url'] . '); background-attachment:' . $bg_attachment . ';"';
}

//Parallax
$parallax = '';
if( 'on' === rella_helper()->get_option( 'title-bar-parallax' ) ) {
	$parallax = 'data-parallax-bg="true"';
}

//Overlay
$overlay_html= '';
if( 'on' === rella_helper()->get_option( 'title-bar-overlay' ) ) {
	$overlay_html = '<div class="rella-row-overlay"></div>';
}

// Classes
$classes = array( 'titlebar' );
if( ! class_exists( 'ReduxFramework' ) ) { 
	$classes[] = 'titlebar-default';	
}
if( $size = rella_helper()->get_option( 'title-bar-size' ) ) {
	$classes[] = 'titlebar-title-' . $size;
}
if( $height = rella_helper()->get_option( 'title-bar-height' ) ) {
	if( 'full' !== $height ) {
		$classes[] = 'titlebar-height-' . $height;
		$height = '';
	}
	else {
		$height = ' data-enable-fullheight="true"';
	}
}
if( $scheme = rella_helper()->get_option( 'title-bar-scheme' ) ) {
	$classes[] = $scheme;
}
if( $align = rella_helper()->get_option( 'title-bar-align' ) ) {
	$classes[] = $align;
}
if( $position = rella_helper()->get_option( 'title-bar-position' ) ) {
	$classes[] = $position;
}
if( $extra = rella_helper()->get_option( 'title-bar-classes' ) ) {
	$classes[] = $extra;
}
$style = rella_helper()->get_option( 'title-bar-content-style' );
// Content
$content = $heading = $subheading = '';
if( ! class_exists( 'ReduxFramework' ) && is_home() ) { 
	$heading = esc_html__( 'Blog', 'boo' );
	$subheading = '';
}
elseif( !rella_helper()->get_current_page_id() && is_home() ) {
	$heading = rella_helper()->get_option( 'blog-title-bar-heading', 'html' );
	$subheading = rella_helper()->get_option( 'blog-title-bar-subheading', 'html' );
}
elseif( is_search() ) {
	$heading = sprintf( esc_html__( 'Search Results for: %s', 'boo' ), '<span>' . get_search_query() . '</span>' );
	$subheading = rella_helper()->get_option( 'search-title-bar-subheading', 'html' );
}
elseif( is_post_type_archive( 'rella-portfolio' ) || is_tax( 'rella-portfolio-category' ) ) {
	$heading = rella_helper()->get_option( 'portfolio-title-bar-heading', 'html' ) ? do_shortcode( rella_helper()->get_option( 'portfolio-title-bar-heading', 'html' ) ) : single_cat_title( '', false );
	$subheading = rella_helper()->get_option( 'portfolio-title-bar-subheading', 'html' );
}
elseif( class_exists( 'WooCommerce' ) && is_shop() ) {
	$shop    = get_option( 'woocommerce_shop_page_id' );
	$heading = rella_helper()->get_option( 'title-bar-heading', 'html' ) ? rella_helper()->get_option( 'title-bar-heading', 'html' ) : get_the_title( $shop );
}
elseif( class_exists( 'WooCommerce' ) && ( is_product_taxonomy() || is_product_category() ) ) {
	$heading = rella_helper()->get_option( 'wc-archive-title-bar-heading', 'html' ) ? rella_helper()->get_option( 'wc-archive-title-bar-heading', 'html' ) : single_cat_title( '', false );
	$category_description = category_description();
	$subheading = ! empty( $category_description ) ? $category_description : rella_helper()->get_option( 'wc-archive-title-bar-subheading', 'html' );
}
elseif( is_category() ) {
	$heading = rella_helper()->get_option( 'category-title-bar-heading', 'html' ) ? do_shortcode( rella_helper()->get_option( 'category-title-bar-heading', 'html' ) ) : single_cat_title( '', false );
	$category_description = category_description();
	$subheading = ! empty( $category_description ) ? $category_description : rella_helper()->get_option( 'category-title-bar-subheading', 'html' );		
}
elseif( is_tag() ) {
	$heading = rella_helper()->get_option( 'tag-title-bar-heading', 'html' ) ? do_shortcode( rella_helper()->get_option( 'tag-title-bar-heading', 'html' ) ) : single_tag_title( '', false ) ;
	$subheading = rella_helper()->get_option( 'tag-title-bar-subheading', 'html' );	
}
elseif( is_author() ) {
	$heading = rella_helper()->get_option( 'author-title-bar-heading', 'html' ) ? do_shortcode( rella_helper()->get_option( 'author-title-bar-heading', 'html' ) ) : get_the_author();
	$subheading = rella_helper()->get_option( 'author-title-bar-subheading', 'html' );
}
elseif( is_archive() ) {
	$heading = esc_html__( 'Archive', 'boo' );
	$subheading = '';	
}
else {
	$heading = rella_helper()->get_option( 'title-bar-heading', 'html' );
	$subheading = rella_helper()->get_option( 'title-bar-subheading', 'html' );
}
$heading_class = rella_helper()->get_option( 'title-bar-weight' );
$default_title = '';

if( is_post_type_archive( 'rella-portfolio' ) || is_tax( 'rella-portfolio-category' ) ) {
	if( 'overlay' === $style ) {
		$default_title =  get_the_archive_title();
	} else {
		$default_title = '<h1 class="' . $heading_class . '">'. get_the_archive_title() .'</h1>';
	}
}
elseif( ! is_singular( 'post' )) {
	if( 'overlay' === $style ) {
		$default_title =  get_the_title();
	} else {
		$default_title = '<h1 class="' . $heading_class . '">'. get_the_title() .'</h1>';
	}
}

$max_fontsize = rella_helper()->get_option( 'title-bar-overlay-size' );
if( empty( $max_fontsize ) ) {
	$max_fontsize = '125px';	
}

if( 'overlay' === $style ) {
	$heading = $heading ? $heading : $default_title;
		
} else {
	$heading = $heading ? '<h1 class="' . $heading_class . '">'. $heading .'</h1>' : $default_title;
}
//check the option is enabled to hide title
if( 'on' === rella_helper()->get_option( 'title-bar-heading-empty' ) ) {
	$heading = '';
}

$subheading = $subheading ? '<h6>'. $subheading .'</h6>' : '';
$content = do_shortcode( rella_helper()->get_option( 'title-bar-content', 'post' ) );

// Breadcrumb
$breadcrumb = ('on' === rella_helper()->get_option( 'title-bar-breadcrumb' ));
$breadcrumb_args = array(
	'classes' => rella_helper()->get_option( 'title-bar-breadcrumb-style' )
);

// Local Scroll
$scroll = ('on' === rella_helper()->get_option( 'title-bar-scroll' ));
$scroll_id = rella_helper()->get_option( 'title-bar-scroll-id' );

$header_position = rella_helper()->get_option( 'header-position' );
if( 'bottom' === $header_position ) {
	$classes[] = 'titlebar-header-bottom';
}

?>
<section class="<?php echo join( ' ', $classes ) ?>"<?php echo $bg . $height ?> <?php echo $parallax; ?>>

	<?php echo $overlay_html; ?>

	<?php if( 'bottom' !== $header_position ) : ?>
		<?php rella_action( 'header_titlebar' ); ?>
	<?php endif; ?>

    <div class="titlebar-inner">

        <div class="container">

			<?php if( 'split' === $style ) : ?>
	
				<div class="row">
	
					<div class="col-md-6">
					<?php echo wp_kses_post( $subheading ); ?>
					<?php echo wp_kses_post( $heading ); ?>
					<?php echo wp_kses_post( $content ); ?>
					</div>
	
					<div class="col-md-6 align-right">
						<?php if( $breadcrumb ) rella_breadcrumb( $breadcrumb_args ); ?>
					</div>
	
				</div>
				
			<?php elseif( 'overlay' === $style ) : ?>
	
				<div class="row">
					<div class="col-md-6">
					</div>
				</div>
	
			<?php elseif( 'bottom' === $style ) : ?>
	
				<?php echo wp_kses_post( $subheading ); ?>
				<?php echo wp_kses_post( $heading ); ?>
				<?php echo wp_kses_post( $content ); ?>
	
			<?php elseif( 'bottom-bar' === $style ) : ?>
			<?php else: ?>
	
			<?php echo wp_kses_post( $subheading ); ?>
			<?php echo wp_kses_post( $heading ); ?>
			<?php echo wp_kses_post( $content ); ?>
	
				<?php if( $breadcrumb ) rella_breadcrumb( $breadcrumb_args ); ?>
	
			<?php endif; ?>

        </div><!-- /.container -->

	</div><!-- /.titlebar-inner -->
	
	<?php if( 'overlay' === $style && 'on' !== rella_helper()->get_option( 'title-bar-heading-empty' ) ) : ?>	
		<div class="titlebar__masked-text">
	
			<div class="titlebar__masked-text__text-container">
				<h1 data-fitText="true" data-max-fontSize="<?php echo esc_attr( $max_fontsize ); ?>"><span><?php echo wp_kses_post( $heading ); ?></span></h1>
			</div><!-- /.main-text-container -->

			<div class="titlebar__masked-text__svg-text-container" data-svg-text="true" data-svg-text-options='{ "bgColor": "#fff" }'>
			</div>
	
		</div><!-- /.masked-text-container -->
	<?php endif; ?>

	<?php if( 'bottom' === $style && $breadcrumb ) : ?>
	<div class="titlebar-bottom-bar">

		<div class="container">

			<?php rella_breadcrumb( $breadcrumb_args ); ?>

		</div><!-- /.container -->

	</div>
	<?php endif; ?>
	
	

	<?php if( 'bottom-bar' === $style ) : ?>

		<div class="titlebar-bottom-bar">

			<div class="container">

				<div class="row">

					<div class="col-md-6">
					<?php echo wp_kses_post( $subheading ); ?>
					<?php echo wp_kses_post( $heading ); ?>
					<?php echo wp_kses_post( $content ); ?>
					</div>

					<div class="col-md-6 align-right">
						<?php if( $breadcrumb ) rella_breadcrumb( $breadcrumb_args ); ?>
					</div>

				</div>

			</div><!-- /.container -->

		</div>
	<?php endif; ?>

	<?php if( $scroll ) : ?>
		<div class="local-scroll move-bottom">
			<a href="#<?php echo esc_attr( $scroll_id ); ?>"><span><i class="fa fa-angle-down"></i></span></a>
		</div>
	<?php endif; ?>

	<?php if( 'bottom' === $header_position ) : ?>
		<?php rella_action( 'header_titlebar' ); ?>
	<?php endif; ?>

</section>
