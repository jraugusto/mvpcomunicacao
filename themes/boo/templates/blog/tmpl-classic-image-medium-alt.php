<figure class="post-image hmedia">
	<?php $this->entry_thumbnail( 'rella-split-alt-blog' ) ?>
</figure><!-- /.main-image -->

<div class="post-contents">

	<header>

		<?php $this->entry_tags() ?>
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

</div><!-- /.contents -->