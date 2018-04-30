<?php

	$url          = get_post_meta( get_the_ID(), 'portfolio-website', true );
	$button_label = get_post_meta( get_the_ID(), 'portfolio-website-label', true );
	if( empty( $button_label ) ) {
		$button_label = esc_html__( 'Launch', 'boo' );
	}
	
	$enable_likes      = rella_helper()->get_option( 'portfolio-likes-enable' );
	$enable_social_box = rella_helper()->get_option( 'portfolio-social-box-enable' );

?>
<div class="portfolio-details">
	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<?php rella_portfolio_media() ?>

			</div><!-- /.col-md-12 -->

			<div class="col-md-12">

				<div class="portfolio-info">

					<div class="row">

						<div class="col-md-8">

							<?php the_title( '<h2 '. rella_helper()->get_attr( 'entry-title', array( 'class' => 'portfolio-title' ) ) .'>', '</h2>' ); ?>

							<?php rella_portfolio_the_content() ?>

							<?php if( $url ) : ?>
                            <p>
                                <a href="<?php echo esc_url( $url ) ?>" class="btn btn-xlg semi-round text-uppercase"><span><?php echo esc_html( $button_label ); ?> <i class="fa fa-angle-right"></i></span></a>
                            </p>
							<?php endif; ?>

						</div><!-- /.col-md-8 -->

						<div class="col-md-4">

							<div class="row">

								<?php rella_portfolio_date() ?>
								<?php rella_portfolio_atts() ?>
								
								<?php if( 'on' === $enable_likes || 'on' === $enable_social_box ) : ?>

								<div class="col-md-12">

									<div class="portfolio-single-share clearfix">

										<?php if( function_exists( 'rella_portfolio_likes' ) ) : ?>
											<?php rella_portfolio_likes(); ?>
										<?php endif; ?>
										
										<?php if( function_exists( 'rella_portfolio_share' ) ) : ?>	
		                                	<?php rella_portfolio_share( get_post_type() ) ?>
		                                <?php endif; ?>

									</div><!-- /.portfolio-single-share -->

								</div><!-- /.col-md-12 -->
								
								<?php endif; ?>

							</div><!-- /.row -->

						</div><!-- /.col-md-4 -->

					</div><!-- /.row -->

				</div><!-- /.portfolio-info -->

			</div><!-- /.col-md-12 -->

		</div><!-- /.row -->

	</div><!-- /.container -->

	<div class="container">
		<?php rella_portfolio_the_vc() ?>
	</div>

	<?php rella_render_related_posts( get_post_type() ) ?>

</div>
