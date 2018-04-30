<?php

	$url          = get_post_meta( get_the_ID(), 'portfolio-website', true );
	$button_label = get_post_meta( get_the_ID(), 'portfolio-website-label', true );
	if( empty( $button_label ) ) {
		$button_label = esc_html__( 'See Details', 'boo' );
	}

?>
<div class="portfolio-details">
	<div class="container">

		<div class="row">

			<div class="col-md-9">

				<?php rella_portfolio_media() ?>

			</div><!-- /.col-md-9 -->

			<div class="col-md-3">

				<div class="portfolio-info">

					<div class="row">

						<div class="col-md-12 mb-20">

							<?php the_title( '<h2 '. rella_helper()->get_attr( 'entry-title', array( 'class' => 'portfolio-title' ) ) .'>', '</h2>' ); ?>

							<?php rella_portfolio_the_content() ?>

						</div><!-- /.col-md-12 -->

						<div class="col-md-12">

							<div class="wpb_wrapper align-center" style="padding-bottom: 20px; border: 1px solid #ededed;">

								<h3><?php esc_html_e( 'Details', 'boo' ); ?></h3>

								<div class="row">
								<?php rella_portfolio_date(12) ?>
								<?php rella_portfolio_atts(12) ?>
								</div>

								<?php rella_portfolio_likes( 'portfolio-likes' ) ?>

							</div><!-- /.wpb_wrapper -->

						</div><!-- /.col-md-12 -->

						<div class="col-md-12 align-center">

							<?php if( $url ) : ?>
							<a href="<?php echo esc_url( $url ) ?>" class="btn btn-xxsm semi-round"><span><?php echo esc_html( $button_label ); ?> <i class="fa fa-long-arrow-right"></i></span></a>
							<?php endif; ?>
							
							<?php if( function_exists( 'rella_portfolio_share' ) ) : ?>
								<?php rella_portfolio_share( get_post_type(), array(
									'class' => 'social-icon',
									'before' => '<div class="portfolio-share"><span class="btn btn-xsm semi-round"><span><i class="fa fa-share"></i></span></span><div class="portfolio-share-popup">',
									'after' => '</div></div>'
								) ); ?>
							<?php endif; ?>

						</div><!-- /.col-md-12 -->

					</div><!-- /.row -->

				</div><!-- /.portfolio-info -->

				<?php rella_portfolio_the_vc() ?>

			</div><!-- /.col-md-3 -->

		</div><!-- /.row -->

	</div><!-- /.container -->

	<?php rella_render_post_nav( get_post_type() ) ?>

</div>
