<?php
	$format = get_post_format();
?>
<figure class="post-image hmedia">
    <?php $this->entry_thumbnail( 'rella-portfolio-big-sq', array( 'data-panr' => 'true', 'data-plugin-options' => '{ "scaleDuration": 0.5, "sensitivity": 8, "scaleTo": 1.1, "moveTarget": ".blog-post" }' ) ) ?>
</figure>

<div class="post-contents">

	<header>

		<div class="post-info">
			<?php $this->entry_tags() ?>
		</div><!-- /.post-info -->

		<?php $this->entry_title() ?>

		<div class="post-info">
			<?php
				$time_string = '<span><time class="published updated" datetime="%1$s">%2$s</time></span>';
				printf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					get_the_date( get_option( 'date_time' ) )
				);
			?>
			<?php $this->entry_author(); ?>
		</div><!-- /.post-info -->

	</header>

</div><!-- /.contents -->
