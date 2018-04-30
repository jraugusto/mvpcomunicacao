<div class="col-md-<?php echo $this->get_column_class() ?> col-sm-6 col-xs-12 masonry-item <?php echo $this->entry_term_classes() ?>">
	<article<?php echo rella_helper()->html_attributes( $attributes ) ?> >
		<div class="inner-wrapper <?php echo $this->get_animation() ?>">
			<div class="portfolio-inner">

				<div class="portfolio-main-image" <?php $this->get_zoom_effect(); ?>>
					<?php $this->entry_thumbnail(); ?>
					<?php if( in_array( $sub_style, array( 'list', 'shadow', 'outline', 'caption-fixed' ) ) ) : ?>
						<a class="portfolio-overlay-link" href="<?php the_permalink(); ?>"></a>
					<?php endif; ?>
				</div>

				<div class="portfolio-content">

					<?php if( 'hover-bottom-left' === $sub_style ) : ?>
						<?php echo $this->before_portfolio_footer( array( 'show_ext_link', 'show_link', 'show_lightbox', 'show_share' ) ); ?>
							<?php $this->entry_ext_link() ?>
							<?php $this->entry_footer_link() ?>
							<?php $this->entry_lightbox() ?>
							<?php $this->entry_share() ?>
						<?php echo $this->after_portfolio_footer( array( 'show_ext_link', 'show_link', 'show_lightbox', 'show_share' ) ); ?>
					<?php endif; ?>

					<?php if( ! in_array( $sub_style, array( 'hover-elegant', 'hover-bottom', 'hover-only-icons', 'hover-bottom-shadow' ) ) ) : ?>
						<?php echo $this->before_portfolio_meta( array( 'show_like', 'show_client', 'show_date' ) ); ?>
							<?php $this->entry_like() ?>
							<?php $this->entry_client() ?>
							<?php $this->entry_date() ?>
						<?php echo $this->after_portfolio_meta( array( 'show_like', 'show_client', 'show_date' ) ); ?>
					<?php endif; ?>

					<?php if( ! in_array( $sub_style, array( 'hover-only-icons' ) ) ) : ?>
						<?php echo $this->before_portfolio_title( array( 'show_title', 'show_category' ) ); ?>
							<?php $this->entry_title() ?>
							<?php $this->entry_cats() ?>
						<?php echo $this->after_portfolio_title( array( 'show_title', 'show_category' ) ); ?>
					<?php endif; ?>

					<?php if( 'hover-elegant' === $sub_style ) : ?>
						<?php echo $this->before_portfolio_meta( array( 'show_like' ) ); ?>
							<?php $this->entry_like() ?>
						<?php echo $this->after_portfolio_meta( array( 'show_like' ) ); ?>
					<?php endif; ?>

					<?php if( ! in_array( $sub_style, array( 'hover-elegant', 'hover-bottom', 'hover-only-icons', 'hover-bottom-shadow' ) ) ) {
						$this->entry_content();
					} ?>

					<?php if( !in_array( $sub_style, array( 'hover-bottom-left', 'caption-fixed' ) ) ) : ?>
						<?php echo $this->before_portfolio_footer( array( 'show_ext_link', 'show_link', 'show_lightbox', 'show_share' ) ); ?>
							<?php $this->entry_ext_link() ?>
							<?php $this->entry_footer_link() ?>
							<?php $this->entry_lightbox() ?>
							<?php $this->entry_share() ?>
						<?php echo $this->after_portfolio_footer( array( 'show_ext_link', 'show_link', 'show_lightbox', 'show_share' ) ); ?>
					<?php endif; ?>
					
					<?php if( ! in_array( $sub_style, array( 'list', 'shadow', 'outline', 'caption-fixed' ) ) ) : ?>
						<a class="portfolio-overlay-link" href="<?php the_permalink(); ?>"></a>
					<?php endif; ?>

				</div>

				<?php if( 'caption-fixed' === $sub_style ) : ?>
					<div class="overlay-link">
						<?php $this->entry_title() ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</article>
</div>
