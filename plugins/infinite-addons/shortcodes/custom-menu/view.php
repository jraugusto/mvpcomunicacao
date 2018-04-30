<?php

extract( $atts );

// Enqueue Conditional Script
$this->scripts();

$classes = array( 'custom-menu', $el_class, $this->get_id() );

$this->generate_css();

remove_filter( 'wp_nav_menu_args', 'rella_nav_menu_args' );

?>
<div class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">
<?php
	if( $title ) {
		$icon = rella_get_icon( $atts );

		if( !empty( $icon['type'] ) ) {
			$title = sprintf( ('right' == $icon['align'] ? '%1$s<i class="%2$s"></i>' : '<i class="%2$s"></i>%1$s'), $title, $icon['icon'] );
		}

		if( 'dropdown' === $style ) {
			printf( '<span class="module-trigger">%s</span>', $title );
		}
		else {
			printf( '<h5>%s</h5>', $title );
		}
	}

	$this->get_nav();

	if ( !empty( $this->atts['show_button'] ) && 'dropdown' === $style ) {
		echo '<span class="module-trigger">';
			$this->get_button();
		echo '</span>';
	}
	else {
		$this->get_button();
	}
?>
</div>