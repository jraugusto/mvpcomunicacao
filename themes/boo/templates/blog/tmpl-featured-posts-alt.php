<?php

$format = get_post_format();

?>
<div class="blog-post-inner" data-stacking-factor="0.5">

	<figure class="post-image hmedia">
		<?php $this->entry_thumbnail( 'rella-dhover-blog' ) ?>
		<a href="<?php the_permalink() ?>"></a>
	</figure><!-- /.main-image -->

	<div class="post-contents">
		<header>
			<?php $this->entry_title() ?>
			<div class="post-info">
			<?php
				$this->entry_author();
				if( 'link' !== $format ) {
					$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s <span>%3$s</span></time>';
					printf( $time_string,
						esc_attr( get_the_date( 'c' ) ),
						get_the_date( 'd' ),
						get_the_date( 'M' )
					);
				}
			?>
			</div><!-- /.post-info -->

		</header>

	</div><!-- /.contents -->

</div> <!-- /.blog-post-inner -->

<a href="<?php the_permalink() ?>" class="overlay-link"></a>