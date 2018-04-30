<div class="<?php echo $this->get_grid_class() ?> masonry-item <?php echo $this->entry_term_classes() ?>">
	<article<?php echo rella_helper()->html_attributes( $attributes ) ?>  data-mh="pf-grid-hover">
		<div class="inner-wrapper">	
			<div class="portfolio-inner">

				<div class="portfolio-main-image">
					<?php $this->entry_thumbnail(); ?>
				</div><!-- /.portfolio-main-image -->	

				<div class="portfolio-content">
	
					<?php echo $this->before_portfolio_title( array( 'show_title', 'show_category' ) ); ?>
						<?php $this->entry_title() ?>
						<?php $this->entry_cats() ?>
					<?php echo $this->after_portfolio_title( array( 'show_title', 'show_category' ) ); ?>

					<?php echo $this->before_portfolio_meta( array( 'show_like', 'show_client', 'show_date' ) ); ?>
						<?php $this->entry_like() ?>
						<?php $this->entry_client() ?>
						<?php $this->entry_date() ?>
					<?php echo $this->after_portfolio_meta( array( 'show_like', 'show_client', 'show_date' ) ); ?>

					<?php $this->entry_content(); ?>	

					<?php echo $this->before_portfolio_footer( array( 'show_ext_link', 'show_link', 'show_lightbox', 'show_share' ) ); ?>
						<?php $this->entry_ext_link() ?>
						<?php $this->entry_footer_link() ?>
						<?php $this->entry_lightbox() ?>
						<?php $this->entry_share() ?>
					<?php echo $this->after_portfolio_footer( array( 'show_ext_link', 'show_link', 'show_lightbox', 'show_share' ) ); ?>
	
				</div><!-- /.portfolio-content -->
	
			</div><!-- /.portfolio-inner -->	
		</div><!-- /.inner-wrapper -->
	</article>
</div><!-- /.portfolio-item -->