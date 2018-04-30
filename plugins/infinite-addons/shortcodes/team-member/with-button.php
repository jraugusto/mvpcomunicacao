<?php

extract( $atts );

// classes
$classes = array( $this->get_style_class( $template ), $el_class, $this->get_id() );
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div class="team-member <?php echo ra_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">

	<figure>
		<?php $this->get_image() ?>
		<?php
			$link = rella_get_link_attributes( $link, false );

			if ( ! empty( $link['href'] ) ) {
				$link['class'] = 'btn btn-sm btn-solid trapezius text-uppercase';
				printf( '<div class="btn-container"><a%s><span>%s</span><i class="fa fa-long-arrow-right"></i></a></div>', ra_helper()->html_attributes( $link ), esc_html( $link['title'] ) );
			}
		?>
	</figure>

	<div class="team-member-details">
		<?php $this->get_name() ?>
		<?php $this->get_position() ?>
		<?php $this->get_content() ?>
	</div>

	<?php $this->get_social() ?>

</div>
