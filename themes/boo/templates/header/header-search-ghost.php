<?php

wp_enqueue_script( 'TweenMax' );

$icon_opts = rella_get_icon( $atts );
$svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 43.75 43.688">
			  <defs>
			    <style>
			      .cls-1 {
			        stroke: #000;
			        stroke-width: 0.25px;
			        fill-rule: evenodd;
			      }
			    </style>
			  </defs>
			  <path class="cls-1" d="M43.36,41.516L32.792,30.953a18.559,18.559,0,1,0-1.832,1.831L41.528,43.347a1.31,1.31,0,0,0,.916.385,1.271,1.271,0,0,0,.916-0.385A1.3,1.3,0,0,0,43.36,41.516ZM2.852,18.8A15.939,15.939,0,1,1,18.791,34.741,15.953,15.953,0,0,1,2.852,18.8Z" transform="translate(-0.125 -0.156)"/>
			</svg>';
$icon = ! empty( $icon_opts['type'] ) && ! empty( $icon_opts['icon'] ) ? '<i class="' . esc_attr( $icon_opts['icon'] ) . '"></i>' : $svg_icon;

?>
<div class="header-module module-search-form style-ghost">

	<span class="module-trigger <?php echo esc_attr( $atts['trigger_size'] ) ?>" data-target="#search-module-fullscreen">
		<?php echo $icon; ?>
	</span>

	<div class="module-container" id="search-module-fullscreen">

		<span class="module-trigger <?php echo esc_attr( $atts['trigger_size'] ) ?>" data-target="#search-module-fullscreen">
			<i class="icon-cross"></i>
		</span>

		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
            <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'boo' ) ?></span>
            <input type="search" placeholder="<?php echo esc_attr_x( 'type and hit enter', 'placeholder', 'boo' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
			<span class="placeholder"><i class="icon-search"></i></span>
			<button type="submit"><i class="icon-search"></i></button>
		</form>

	</div><!-- /module-container -->

</div><!-- /module -->
