<?php

extract( $atts );

// classes
$classes = array( $this->get_style_class( $template ), $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="team-member <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>" data-heighttowidth="true" data-heighttowidth-target=".team-member-details">

	<figure>
		<?php $this->get_image(); ?>
		<?php
			$link = rella_get_link_attributes( $link, false );
			if ( ! empty( $link['href'] ) ) {
			$link['class'] = 'btn btn-lg wide btn-solid text-uppercase';
		?>
		<a<?php echo ra_helper()->html_attributes( $link ); ?>>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" xml:space="preserve">
			<rect x="0" y="0" width="100%" height="100%"/>
			</svg>
			<span><?php echo esc_html( $link['title'] ); ?></span>
		</a>
		<?php } ?>
	</figure>

	<div class="team-member-details">

		<div class="details-container">

			<div class="details-inner">

				<?php $this->get_social(); ?>
				<?php if ( ! empty( $phone ) ) { ?>
					<span><?php echo esc_html( $phone ); ?></span>
				<?php } ?>

			</div><!-- /.details-inner -->

		</div><!-- /.details-container -->
	</div><!-- /.team-member-details -->

</div>
