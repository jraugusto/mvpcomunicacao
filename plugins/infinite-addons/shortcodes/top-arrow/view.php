<?php

extract( $atts );
// Enqueue Conditional Script
$this->scripts();
$classes = array( 'widget local-scroll', $this->get_class( $style ), $el_class, $this->get_id() );

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ra_helper()->sanitize_html_classes( $classes ); ?>">

	<a class="back-to-top" href="#wrap" rel="nofollow">
		<?php $this->get_label(); ?>
		<i class="fa fa-angle-up"></i>
	</a>

</div>