<div class="container portfolio-info-container">
	<div class="row">
		<div class="col-xs-12">

			<div class="portfolio-info style-alt bg-dark">

				<div class="row">

					<div class="col-md-4 col-sm-6">

						<?php the_title( '<h2 '. rella_helper()->get_attr( 'entry-title', array( 'class' => 'portfolio-title' ) ) .'>', '</h2>' ); ?>

					</div><!-- /.col-md-4 -->

					<div class="col-md-4 col-sm-6">

						<?php rella_portfolio_the_content() ?>

					</div><!-- /.col-md-4 -->

					<div class="col-md-4 col-sm-12">

						<div class="row">

							<?php rella_portfolio_date() ?>
							<?php rella_portfolio_atts() ?>

						</div><!-- /.row -->

					</div><!-- /.col-md-4 -->

				</div><!-- /.row -->

			</div><!-- /.portfolio-info -->

		</div><!-- /.col-md-12 -->
	</div><!-- /.row -->
</div> <!-- /.container -->
