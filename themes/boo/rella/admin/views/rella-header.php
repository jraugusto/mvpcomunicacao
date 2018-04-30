<?php $theme = rella_helper()->get_current_theme(); ?>
<header class="rella-dashboard-header">

	<div class="rella-dashboard-title  clearfix">

		<div class="rella-left">

			<h1>
				<?php printf( esc_html__( 'Welcome to %s!', 'boo' ), $theme->name ) ?>
				<div class="rella-label">
					<span><?php printf( esc_html__( 'Theme Version: %s', 'boo' ), $theme->version ) ?></span>
				</div>
			</h1>

			<p><?php //esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum dui malesuada eros.', 'boo' ) ?></p>

		</div>

		<figure class="rella-right">
			<img src="<?php echo rella()->load_assets( 'img/rella-logo.png' ); ?>" alt="Rella Logo">
		</figure>
		

	</div>

	<div class="clearfix"></div>

	<?php include_once( get_template_directory() . '/rella/admin/views/rella-tabs.php' ); ?>

</header>
