<div class="<?php echo $this->get_grid_class() ?> masonry-item <?php echo $this->entry_term_classes() ?>">
	<article<?php echo rella_helper()->html_attributes( $attributes ) ?>>
		<div class="inner-wrapper <?php echo $this->get_animation() ?>">
			<div class="portfolio-inner">

				<div class="portfolio-main-image" <?php $this->get_zoom_effect(); ?>>
					<?php $this->entry_thumbnail(); ?>
				</div>

				<div class="portfolio-content">

					<?php echo $this->before_portfolio_title( array( 'show_title' ) ); ?>
						<?php $this->entry_title() ?>
					<?php echo $this->after_portfolio_title( array( 'show_title' ) ); ?>

				</div>

			</div>
		</div>
	</article>
</div>
