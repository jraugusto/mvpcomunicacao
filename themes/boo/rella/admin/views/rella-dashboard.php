<?php
	
	$explain_notice = wp_kses_post( __( 'Login with your Envato account to register your copy and take full advantage of Boo.', 'boo' ) );
	$register_status = wp_kses_post( __( 'Unregistered', 'boo' ) );

	if( ! class_exists( 'Rella_Addons' ) ) {
		$explain_notice = wp_kses_post( __( 'Please, activate the Infinite Addons plugin', 'boo' ) );
	}

	$activate_status = esc_html__( 'Activate Boo', 'boo' );

	$get_token = $logged_in_mail = '';
	$get_info = array();
	$login_url = '#';
	
	$check_updates = esc_html__( 'Disabled', 'boo' );
	
	if ( defined('ENVATO_HOSTED_SITE') ) { 
		$explain_notice = esc_html__( 'Thanks for purchasing the Boo, your license is valid', 'boo' );
		$activate_status = esc_html__( 'Boo is ACTIVATED', 'boo' );
		$register_status = esc_html__( 'Registered', 'boo' );
		if( ! class_exists( 'Rella_Addons' ) ) {
			$explain_notice = wp_kses_post( __( 'Please, activate the Infinite Addons plugin', 'boo' ) );
		}
	} else {
		if( class_exists( 'RellaCheck' ) && class_exists( 'RellaEnvato' ) ) {
	
			$rellaCheck  = new RellaCheck;
			$rellaEnvato = new RellaEnvato;
	
			$get_token      = $rellaCheck->get_token();
			$logged_in_mail = $rellaCheck->logged_in_mail();
			$get_info       = $rellaCheck->get_info();
			$login_url      = $rellaEnvato->login_url();
			
			if( method_exists( 'RellaCheck', 'check_update_status' ) ) {			
				$update_status  = $rellaCheck->check_update_status();
				if( $update_status ) {
					$check_updates = esc_html__( 'Enabled', 'boo' );	
				}
			}
	
			if( is_array( $get_info ) && ! empty( $get_info ) ) {
	
				$is_valid = $rellaCheck->is_vaild();
				if( $is_valid ) {
					$explain_notice = esc_html__( 'Thanks for purchasing the Boo, your license is valid', 'boo' );
					$activate_status = esc_html__( 'Boo is ACTIVATED', 'boo' );
					$register_status = esc_html__( 'Registered', 'boo' );
				} else {
					$explain_notice = esc_html__( 'Sorry, but we didn\'t find license for Boo', 'boo' );
				}
			}
		};
	}

?>

<div class="wrap rella-wrap">

	<div class="rella-dashboard">

		<?php include_once( get_template_directory() . '/rella/admin/views/rella-registration.php' ); ?>

		<div class="tab-content">

			<div id="rella-general" role="tabpanel" class="rella-tab-pane rella-tab-is-active">

				<ul class="rella-cards-container rella-dashboard-inner clearfix">

					<li class="rella-card rella-card-alt fullwidth">

						<div class="rella-card-inner">

							<span class="badge bottom"><?php echo $register_status ?></span>

							<div class="rella-card-header">

								<h3><span class="ring"><img src="<?php echo rella()->load_assets('img/admin/ring.png') ?>" alt="Ring"><i class="fa fa-check"></i></span><?php echo $activate_status; ?></h3>

								<p><?php echo $explain_notice; ?></p>

							</div><!-- /.rella-card-header -->

						<?php if( !defined('ENVATO_HOSTED_SITE') ) { ?>
							<div class="rella-card-footer">


								<?php if( strlen( $get_token ) <= 30 || $logged_in_mail === null ): ?>

									<a class="rella-button" href="<?php echo esc_url( $login_url ); ?>"><span><?php esc_html_e( 'Login with envato', 'boo' ) ?></span> <i class="fa fa-angle-right"></i></a>

								<?php  else: ?>

									<a class="rella-button" href="#" id="rella-logout-envato"><span><?php esc_html_e( 'Log Out', 'boo' ) ?></span> <i class="fa fa-angle-right"></i></a>

								<?php endif; ?>

							</div><!-- /.rella-card-footer -->
						<?php } ?>

						</div><!-- /.rella-card-inner -->

					</li><!-- /.rella-card-alt -->

				</ul>

				<hr>

				<ul class="rella-cards-container rella-dashboard-inner clearfix">

				<?php
					if ( !defined('ENVATO_HOSTED_SITE') ) {
				?>
					<li class="rella-card rella-card-alt">
						<div class="rella-card-inner">
							<span class="badge top"><?php echo $check_updates; ?></span>
							<div class="rella-icon-container">
								<img src="<?php echo rella()->load_assets('img/admin/auto-update.svg') ?>" alt="Auto Update">
							</div>
							<h3><?php esc_html_e( 'Automatic Updates', 'boo' ) ?></h3>
							<p><?php esc_html_e( 'Latest features, demos and more at your fingertips.', 'boo' ) ?></p>
							<div class="rella-card-footer clearfix">
								<!--a class="rella-button" href="<?php echo esc_url( rella_helper()->envato_market_page_url() ); ?>"><span><?php esc_html_e( 'Check for updates', 'boo' ) ?></span> <i class="fa fa-angle-right"></i></a-->
							</div>
						</div>
					</li>
					
				<?php } ?>

					<li class="rella-card rella-card-alt">
						<div class="rella-card-inner">
							<div class="rella-icon-container">
								<img src="<?php echo rella()->load_assets('img/admin/docs.svg') ?>" alt="Docs">
							</div>
							<h3><?php esc_html_e( 'Documentation', 'boo' ) ?></h3>
							<p><?php esc_html_e( 'Extensive documentation including up-to-date changelog.', 'boo' ) ?></p>
							<div class="rella-card-footer clearfix">
								<a class="rella-button" target="_blank" href="http://boo.themerella.com/documentation/index.html"><span><?php esc_html_e( 'Read Docs', 'boo' ) ?></span> <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</li>

					<li class="rella-card rella-card-alt">
						<div class="rella-card-inner">
							<div class="rella-icon-container">
								<img src="<?php echo rella()->load_assets('img/admin/video-tuts.svg') ?>" alt="Video Tuts">
							</div>
							<h3><?php esc_html_e( 'Video Tutorials', 'boo' ) ?></h3>
							<p><?php esc_html_e( 'The fastest and easiest way to learn more about Boo..', 'boo' ) ?></p>
							<div class="rella-card-footer clearfix">
								<a class="rella-button" target="_blank" href="https://www.youtube.com/channel/UCSiSz4yilEFdCNtwUHVjHrg"><span><?php esc_html_e( 'Watch now', 'boo' ) ?></span> <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</li>

				</ul>

				<a href="https://themerella.zendesk.com/" target="_blank" class="rella-button btn-block"><?php esc_html_e('COULDN\'T FIND WHAT YOU\'RE LOOKING FOR? SUBMIT A TICKET', 'boo' ) ?> <i class="fa fa-angle-right"></i></a>

			</div>

		</div>

	</div>

</div>