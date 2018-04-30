<?php

// Enqueue Conditional Script
$this->scripts();

$style = $atts['style'];
$classes = array( $this->get_class( $style ), $atts['color_type'] );

// Locate the template and check if exists.
$located = locate_template( array(
	"templates/portfolio/tmpl-$style.php"
) );
if ( ! $located ) {
	return;
}

// Build Query and check for posts
$the_query = new WP_Query( $this->build_query() );
if( !$the_query->have_posts() ) {
	return;
}

?>
<div id="gallery-1" class="<?php echo ra_helper()->sanitize_html_classes( $classes ) ?>">
<div class="row carousel-items" data-flickity-options=' { "prevNextButtons": false, "pageDots": false, "selectedAttraction": 0.025, "friction": 0.28, "autoPlay": 5000, "adaptiveHeight": true, "percentPosition": true } '>

<?php

// Build Query and check for posts
$the_query = new WP_Query( $this->build_query() );
if( !$the_query->have_posts() ) {
	return;
}
// The CSS
$this->generate_css();

// Build Query
$GLOBALS['wp_query'] = $the_query;
$before = $after = '';

	$this->add_loader();

	$this->add_excerpt_hooks();

	while( have_posts() ): the_post();

		echo $before;

			include $located;

		echo $after;

	endwhile;

	$this->remove_excerpt_hooks();


wp_reset_query();

?>

</div><!-- /.carousel-items -->

<div class="thumbs row">

	<div class="thumbs-wrapper">

		<div class="thumbs-inner">

			<?php

					// Build Query and check for posts
					$the_query = new WP_Query( $this->build_query() );
					if( !$the_query->have_posts() ) {
						return;
					}

					// Build Query
					$GLOBALS['wp_query'] = $the_query;

					while( have_posts() ): the_post();

					?>
					<figure>
						<?php rella_the_post_thumbnail( 'rella-slider-nav' ); ?>
						<div class="progress">
							<div class="progress-inner"></div><!-- /.progress-inner -->
						</div><!-- /.progress -->
					</figure>
					<?php

				endwhile;
				wp_reset_query();

			?>

		</div><!-- /.thumbs-inner -->

	</div><!-- /.thumbs-wrapper -->

</div>

<div class="carousel-nav">

		<div class="toggle-thumbs off">
			<button class="toggle-thumbs-off">
				<svg xmlns="http://www.w3.org/2000/svg" width="35.12" height="35.124" viewBox="0 0 35.12 35.124">
				  <path fill="#ecf1f8" d="M2758.02,126.95h14.03v14.034h-14.03V126.95Z" transform="translate(-2736.94 -126.938)"/>
				  <path fill="#ecf1f8" d="M2736.95,126.95h14.03v14.034h-14.03V126.95Z" transform="translate(-2736.94 -126.938)"/>
				  <path fill="#ecf1f8" d="M2736.95,148.016h14.03V162.05h-14.03V148.016Z" transform="translate(-2736.94 -126.938)"/>
				  <path fill="#ecf1f8" d="M2758.02,148.016h14.03V162.05h-14.03V148.016Z" transform="translate(-2736.94 -126.938)"/>
				</svg>
			</button>
			<button class="toggle-thumbs-on">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 64 64">
				  <g>
				    <path fill="#1D1D1B" d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z"/>
				  </g>
				</svg>
			</button>
		</div><!-- /.toggle-thumbs -->

		<button class="flickity-prev-next-button next">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				viewBox="0 0 268.832 268.832" style="enable-background:new 0 0 268.832 268.832;"
				xml:space="preserve">
				<g>
					<path d="M265.171,125.577l-80-80c-4.881-4.881-12.797-4.881-17.678,0c-4.882,4.882-4.882,12.796,0,17.678l58.661,58.661H12.5
					c-6.903,0-12.5,5.597-12.5,12.5c0,6.902,5.597,12.5,12.5,12.5h213.654l-58.659,58.661c-4.882,4.882-4.882,12.796,0,17.678
					c2.44,2.439,5.64,3.661,8.839,3.661s6.398-1.222,8.839-3.661l79.998-80C270.053,138.373,270.053,130.459,265.171,125.577z"/>
				</g>
			</svg>
		</button>
		<button class="flickity-prev-next-button previous">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 268.833 268.833" style="enable-background:new 0 0 268.833 268.833;"
				 xml:space="preserve">
				<g>
					<path d="M256.333,121.916H42.679l58.659-58.661c4.882-4.882,4.882-12.796,0-17.678c-4.883-4.881-12.797-4.881-17.678,0l-79.998,80
						c-4.883,4.882-4.883,12.796,0,17.678l80,80c2.439,2.439,5.64,3.661,8.839,3.661s6.397-1.222,8.839-3.661
						c4.882-4.882,4.882-12.796,0-17.678l-58.661-58.661h213.654c6.903,0,12.5-5.598,12.5-12.5
						C268.833,127.513,263.236,121.916,256.333,121.916z"/>
				</g>
			</svg>
		</button>

	</div><!-- /.carousel-nav -->

</div>
