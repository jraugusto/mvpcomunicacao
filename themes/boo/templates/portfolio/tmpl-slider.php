<div class="col-xs-12 no-padding">
	<div class="portfolio-item portfolio-fullwidth <?php echo esc_attr( $this->atts['color_type'] ); ?>">

		<div class="portfolio-main-image">
			<?php $this->get_full_image(); ?>
		</div><!-- /.portfolio-main-image -->

		<div class="portfolio-content">
			<?php echo $this->before_portfolio_meta( array( 'show_like', 'show_client', 'show_date' ) ); ?>
				<?php $this->entry_like() ?>
				<?php $this->entry_client() ?>
				<?php $this->entry_date() ?>
			<?php echo $this->after_portfolio_meta( array( 'show_like', 'show_client', 'show_date' ) ); ?>

			<?php echo $this->before_portfolio_title( array( 'show_title', 'show_category' ) ); ?>
				<?php $this->entry_cats() ?>
				<?php $this->entry_title() ?>
			<?php echo $this->after_portfolio_title( array( 'show_title', 'show_category' ) ); ?>

			<?php $this->entry_content(); ?>

		</div><!-- /.portfolio-content -->
		
	</div><!-- /.portfolio-item -->
</div><!-- /.col-xs-12 -->