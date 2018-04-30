<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$attributes          = rella_get_link_attributes( $link );
$attributes['class'] = 'navbar-brand';

$header = rella_get_header_layout();

$this->generate_css( $header );

?>
<div class="navbar-header hidden-lg hidden-md">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-header-nav" aria-expanded="false">
		<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'infinite-addons' ) ?></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a<?php echo ra_helper()->html_attributes( $attributes ) ?>>
		<?php $this->get_mobile_logo(); ?>
	</a>
</div>

<?php

if( in_array( $style, array( 'fs1', 'fs3', 'fs4', 'fs5', 'fs6', 'fs7' ) ) ):
	$fs_hash = array(
		'fs1' => ' style1',
		'fs3' => ' style3',
		'fs4' => ' style5',
		'fs5' => ' style4',
		'fs6' => ' style6',
		'fs7' => ' style7',
	);

?>
<div class="header-module module-nav-trigger<?php echo $fs_hash[$style] ?>">
	<span class="module-trigger" data-target="#main-header-nav">
		<span class="bars">
			<span></span>
			<span></span>
			<span></span>
		</span>
		<?php
			if( ! empty( $fs_menu_title ) ) {
				echo '<span>' . esc_html( $fs_menu_title ) . '</span>';
			}
		?>
	</span>
</div>
<?php endif; ?>

<?php if( 'hide' !== $logo_visibility && 'dm' !== $style ) : $attributes['class'] = 'navbar-brand hidden-sm hidden-xs no-tb-padding';  ?>
<a<?php echo ra_helper()->html_attributes( $attributes ) ?>>
	<span class="brand-inner">
		<?php $this->get_sticky_light_logo(); ?>
		<?php $this->get_sticky_logo(); ?>
	
		<?php $this->get_light_logo(); ?>
		<?php $this->get_logo(); ?>
	</span>
</a>
<?php endif; ?>

<?php if( 'fs2' === $style ): ?>
<div class="header-module module-nav-trigger style2">
	<span class="module-trigger" data-target="#main-header-nav">
		<span class="bars">
			<span></span>
			<span></span>
			<span></span>
		</span>
		<?php
			if( ! empty( $fs_menu_title ) ) {
				echo '<span>' . esc_html( $fs_menu_title ) . '</span>';
			}
		?>
	</span>
</div>
<?php endif; ?>

<?php

$extra_cc = '';
if( 'off-canvas' === $style ) {
	$extra_cc = ' hidden-lg hidden-md';
}

$extra_nav = '';
if ( 'yes' === $add_divider ) {
	$extra_nav = ' add-hsep-light';
}

if( is_nav_menu( $menu_slug ) ) {

	$raw = wp_nav_menu( array(
		'theme_location'   => 'primary',
		'menu'             => $menu_slug,
		'container_id'     => 'main-header-nav',
		'container_class'  => 'collapse navbar-collapse' . $extra_cc,
		'menu_class'       => 'nav navbar-nav main-nav' . $this->get_style( $style ) . $extra_nav,
		'link_before'      => '<span class="link-txt">',
		'link_after'       => '</span>',
		'caret_visibility' => $caret_visibility,
		'local_scroll'     => $local_scroll,
		'nav_style'        => $style,
		'echo'             => false,
		'walker'           => class_exists( 'Rella_Mega_Menu_Walker' ) ? new Rella_Mega_Menu_Walker : ''
	));

} else {

	$raw = wp_nav_menu( array(
		'container_id'     => 'main-header-nav',
		'container_class'  => 'collapse navbar-collapse' . $extra_cc,
		'menu_class'       => 'nav navbar-nav main-nav' . $this->get_style( $style ) . $extra_nav,
		'link_before'      => '<span class="link-txt">',
		'link_after'       => '</span>',
		'caret_visibility' => $caret_visibility,
		'local_scroll'     => $local_scroll,
		'nav_style'        => $style,
		'echo'             => false,
		'walker'           => class_exists( 'Rella_Mega_Menu_Walker' ) ? new Rella_Mega_Menu_Walker : ''
	));

}

if( in_array( $style, array( 'fs1', 'fs2', 'fs3', 'fs4', 'fs5', 'fs6', 'fs7' ) ) ) {
	$raw = str_replace( 'navbar-collapse"', 'navbar-collapse" data-enable-fullheight="true"', $raw );
}
echo $raw;

if( 'hide' !== $logo_visibility && 'dm' === $style && ! empty( $second_menu_slug ) ) : $attributes['class'] = 'navbar-brand hidden-sm hidden-xs no-tb-padding';  ?>
<a<?php echo ra_helper()->html_attributes( $attributes ) ?>>
	<span class="brand-inner">
		<?php $this->get_sticky_light_logo(); ?>
		<?php $this->get_sticky_logo(); ?>
	
		<?php $this->get_light_logo(); ?>
		<?php $this->get_logo(); ?>
	</span>
</a>
<?php endif;


if( ! empty( $second_menu_slug ) && is_nav_menu( $second_menu_slug ) ) {

	$raw = wp_nav_menu( array(
		'theme_location'   => 'primary',
		'menu'             => $second_menu_slug,
		'container_id'     => 'main-header-nav',
		'container_class'  => 'collapse navbar-collapse' . $extra_cc,
		'menu_class'       => 'nav navbar-nav main-nav' . $this->get_style( $style ) . $extra_nav,
		'link_before'      => '<span class="link-txt">',
		'link_after'       => '</span>',
		'caret_visibility' => $caret_visibility,
		'local_scroll'     => $local_scroll,
		'nav_style'        => $style,
		'echo'             => false,
		'walker'           => class_exists( 'Rella_Mega_Menu_Walker' ) ? new Rella_Mega_Menu_Walker : ''
	));
	
	echo $raw;
}



if( 'off-canvas' === $style ):
?>
<div class="header-module module-nav-trigger style4 dark">
	<span class="module-trigger" data-target="#main-header-off-canvas">
		<span class="bars">
			<span></span>
			<span></span>
			<span></span>
		</span>
	</span>
</div>
<?php endif; ?>