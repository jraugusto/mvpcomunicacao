<?php 

extract( $atts );

?>
<div class="twitter-container">

	<div class="content">
		<?php $this->get_tweet_data(); ?>
	</div> <!-- /.content -->

	<?php $this->get_button(); ?>

</div> <!-- /.twitter-container -->