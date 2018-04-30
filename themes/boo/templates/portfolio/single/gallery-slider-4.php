<?php

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

    					<div class="col-md-4">

    						<?php rella_portfolio_the_content() ?>

    					</div><!-- /.col-md- -->

    					<div class="col-md-4">

    						<div class="row">

								<?php rella_portfolio_date() ?>
								<?php rella_portfolio_atts() ?>

    						</div><!-- /.row -->

    					</div><!-- /.col-md-4 -->

						<?php if( 'on' === $enable_likes || 'on' === $enable_social_box ) : ?>

    					<div class="col-md-4">

    						<div class="portfolio-single-share style-alt clearfix">
								<?php if( function_exists( 'rella_portfolio_share' ) ) : ?>
									<?php rella_portfolio_share( get_post_type() ); ?>
    							<?php endif; ?>

								<?php if( function_exists( 'rella_portfolio_likes' ) ) : ?>
									<?php rella_portfolio_likes(); ?>
								<?php endif; ?>

    						</div><!-- /.portfolio-single-share -->

    					</div><!-- /.col-md-4 -->
    					
    					<?php endif; ?>

    				</div><!-- /.row -->

    			</div><!-- /.portfolio-info -->

    		</div><!-- /.col-md-12 -->

    	</div><!-- /.row -->

    </div><!-- /.container -->

   <?php rella_render_related_posts( get_post_type() ) ?>

	<?php rella_render_post_nav( get_post_type() ) ?>

</div><!-- /.portfolio-details -->
