<?php
	
	$enable_likes      = rella_helper()->get_option( 'portfolio-likes-enable' );
	$enable_social_box = rella_helper()->get_option( 'portfolio-social-box-enable' );

?>
<div class="portfolio-details">

	<div class="container">

		<?php rella_portfolio_the_content() ?>

		<?php rella_portfolio_the_vc() ?>

	</div>
	
	<?php if( 'on' === $enable_likes || 'on' === $enable_social_box ) : ?>

	<div class="portfolio-single-share style-alt clearfix">

		<div class="container">

			<div class="row">

				<div class="col-md-6 col-md-offset-3">

				<?php if( function_exists( 'rella_portfolio_share' ) ) : ?>
					<?php rella_portfolio_share( get_post_type(), array(
						'class' => 'social-icon scheme-gray text',
						'before' => '<h6>' . esc_html__( 'Share', 'boo' ) . '</h6>',
						'style' => 'label'
					) ); ?>
				<?php endif; ?>
				
				<?php if( function_exists( 'rella_portfolio_likes' ) ) : ?>
					<?php rella_portfolio_likes(); ?>
				<?php endif; ?>

				</div><!-- /.col-md-6 col-md-offset-3 -->

			</div><!-- /.row -->

		</div><!-- /.container -->

	</div><!-- /.portfolio-single-share -->
	
	<?php endif; ?>

	<?php rella_render_related_posts( get_post_type() ) ?>

	<?php rella_render_post_nav( get_post_type() ) ?>

</div>
