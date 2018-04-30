<?php

$format = get_post_format();

if( 'audio' === $format ) {
	$this->entry_thumbnail();
}
elseif( 'video' === $format ) {
?>
<div class="post-video">
	<?php $this->entry_thumbnail() ?>
	<div class="categories">
		<?php $this->entry_tags() ?>
		<span class="trending">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="10" viewBox="0 0 16 10">
			  <polygon fill-rule="evenodd" points="104.988 9.2 109.488 9.2 109.488 13.7 107.76 11.972 103.062 16.688 100.074 13.7 95.574 18.2 94.512 17.138 100.074 11.594 103.062 14.582 106.716 10.928" transform="translate(-94 -9)"/>
			</svg>
		</span>
	</div>
</div>
<?php
}
elseif( 'link' !== $format ) {
?>
<figure class="post-image hmedia">

	<a href="<?php the_permalink() ?>">
		<?php $this->entry_thumbnail( 'rella-thumbnail-post' ) ?>
	</a>

	<div class="categories">
		<?php $this->entry_tags() ?>
		<span class="trending">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="10" viewBox="0 0 16 10">
			  <polygon fill-rule="evenodd" points="104.988 9.2 109.488 9.2 109.488 13.7 107.76 11.972 103.062 16.688 100.074 13.7 95.574 18.2 94.512 17.138 100.074 11.594 103.062 14.582 106.716 10.928" transform="translate(-94 -9)"/>
			</svg>
		</span>
	</div>

</figure><!-- /.main-image -->
<?php
}

?>
<div class="post-contents">

	<header>

		<?php $this->entry_title() ?>
		<div class="post-info">
		<?php

			$this->entry_author();

			$time_string = '<span><time class="published updated" datetime="%1$s">%2$s</time></span>';
			printf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date( get_option( 'date_time' ) )
			);

		?>
		</div><!-- /.post-info -->

	</header>

	<?php $this->entry_content() ?>

</div><!-- /.contents -->
