<?php
	
	$login_url = '#';
	$is_valid = false;

	if( ! class_exists( 'Rella_Addons' ) ) {
		$explain_notice = wp_kses_post( __( 'Please, activate the Infinite Addons plugin', 'boo' ) );
	}

	$get_token = $logged_in_mail = '';
	$get_info = array();

	if( class_exists( 'RellaCheck' ) && class_exists( 'RellaEnvato' ) ) {

		$rellaEnvato = new RellaEnvato;
		$rellaCheck  = new RellaCheck;
		$login_url   = $rellaEnvato->login_url();
		$is_valid    = $rellaCheck->is_vaild();

	};

?>

<div class="wrap rella-wrap">
	<div class="rella-dashboard">

	<header class="rella-dashboard-header">
        <div class="rella-dashboard-title  clearfix">
			<h1><?php esc_html_e( 'Boo Demos', 'boo' ); ?></h1>
		</div>
			
		<?php
			if ( ! defined('ENVATO_HOSTED_SITE') && ! $is_valid ) { 
		?>
			<div class="notice-warning settings-error notice">
				<a href="<?php echo esc_url( $login_url ); ?>"><strong><?php esc_html_e( 'Please, activate Boo', 'boo' ) ?></strong></a> <?php esc_html_e( 'to use the demo importer', 'boo' ) ?>
			</div>
		
		<?php } ?>
		
        <?php include_once( get_template_directory() . '/rella/admin/views/rella-tabs.php' ); ?>
   </header>
		
	<div class="rella-tab-pane">
		<div class="rella-info rella-align-center bg-seashell">
			<h4><i class="fa fa-info-circle text-gradient"></i> <?php esc_html_e( 'Importing a demo will create pages, posts, add images, theme options, widgets, sliders and others.', 'boo' ); ?><br/>
<?php esc_html_e( 'IMPORTANT: Please, install and activate required plugins  before to import any demo.', 'boo' ); ?></h4>
		</div>
		<?php

			include( locate_template( 'theme/theme-demo-config.php' ) );
		
			$i = 0;
		
		if( is_array( $demos ) ) :

			wp_localize_script( 'rella-admin', 'rella_demos', $demos );

		?>
		<ul class="rella-cards-container clearfix">
		<?php foreach( $demos as $id => $demo ): ?>
			<li class="rella-card rella-card-demo rella-card-is-active">
				<div class="rella-card-inner">
					<div class="rella-icon-container">
						<img src="<?php echo esc_url( $demo['screenshot'] ); ?>" alt="<?php echo esc_attr( $demo['title'] ); ?>" />
						<a target="_blank" class="rella-button" href="<?php echo esc_url( $demo['preview'] ); ?>"><span><?php esc_html_e( 'Preview', 'boo' ) ?></span> <i class="fa fa-angle-right"></i></a>
					</div>
					<h3><?php echo esc_html( $demo['title'] ); ?></h3>
					<p><?php echo esc_html( $demo['description'] ); ?></p>
					<div class="rella-card-footer clearfix">
						<a class="rella-button rella-import-popup" id="import-id" href="#" data-import-id="<?php echo esc_attr( $i ); ?>" data-demo-id="<?php echo esc_attr( $id ); ?>"><span><?php esc_html_e( 'Import Demo', 'boo' ) ?></span> <i class="fa fa-angle-right"></i></a>
					</div>
				</div>
			</li>
            <?php $i++; ?>
		<?php endforeach; ?>
		</ul>

		<script type="text/template" id="tmpl-demo-import-modules">

			<div class="rella-popup-right rella-popup-import-modules">
				<h4 class="importing"><?php esc_html_e( 'Importing', 'boo' ); ?> <span>.</span><span>.</span><span>.</span></h4>
				<p><?php esc_html_e( 'Import in progress, don\'t close the window.', 'boo' ); ?></p>
				<div>
				<div id="rella-progress" class="importing"><?php esc_html_e( 'Working', 'boo' )?> <span>.</span><span>.</span><span>.</span></div>
				<div id="rella-loader"><span class="text">0%</span><div></div></div>
				<div id="rella-import-emoj" style="display:none;"><img src="<?php echo esc_url( rella()->load_assets('img/smily.png') ); ?>" />
				</div>
				<div id="rela-import-complete"><?php esc_html_e( 'Congratulations, the Demo has been successfully Imported!', 'boo' ); ?></div>
				
				</div>

			</div>
		</script>

		<script type="text/template" id="tmpl-demo-download-loading">
		    <div class="rella-popup" id="rella-popup-loading">
		        <div class="rella-popup-body">
		            <div class="loading"><h1><span><?php esc_html_e( 'Please wait..', 'boo' ); ?></span></h1></div>
		        </div>
		    </div>
		</script>

		<script type="text/template" id="tmpl-demo-popup">
			<div class="rella-popup" id="rella-popup">
				<div class="rella-popup-body">
					<span class="rella-popup-close">&times;</span>
					<div class="rella-popup-content">

						<div class="rella-huge-text">
							<h3><?php esc_html_e( 'Boo', 'boo' ); ?></h3>
						</div>

						
						<div class="rella-popup-content-inner">

							<div class="rella-popup-left">
								<a class="live-demo" target="_blank" href="<%= preview %>"><span><?php esc_html_e( 'View Demo', 'boo' ); ?></span></a>
								<img class="demo-image-blur" src="<%= screenshot %>" alt="Demo Image"></img>
								<img class="demo-image" src="<%= screenshot %>" alt="Demo Image"></img>
							</div>

							<?php //if( rella_core('RellaCheck')->is_vaild() ) { ?>
							<div class="rella-popup-right rella-popup-getting-started">

								<h3><?php esc_html_e( 'What You Get In This Package', 'boo' ); ?></h3>
								<p><?php esc_html_e( 'This package will import the content you choose using bottoms below. Please note that choosing media, will increase the import time dramatically. Also you need to install required plugins like contact form 7 before importing the demos.', 'boo' ); ?></p>

								<div class="import-option-group">

									<span class="import-option">
										<input id="rella-import-content" type="checkbox" value="set_demo_content" checked="">
										<label for="rella-import-content">
											<i class="option-icon fa fa-check"></i><?php esc_html_e( 'CONTENT', 'boo' ); ?>
										</label>
									</span>

									<span class="import-option">
										<input id="rella-import-media" type="checkbox" value="import_media" checked="">
										<label for="rella-import-media">
											<i class="option-icon fa fa-check"></i><?php esc_html_e( 'MEDIA', 'boo' ); ?>
										</label>
									</span>

									<% if( has_yellow ) { %>
									<span class="import-option">
										<input id="rella-import-yellow" type="checkbox" value="yellow" checked="">
										<label for="rella-import-yellow">
											<i class="option-icon fa fa-check"></i><?php esc_html_e( 'YELLOW', 'boo' ); ?>
										</label>
									</span>
									<% } %>

									<% if( has_widgets ) { %>
									<span class="import-option">
										<input id="rella-import-widget" type="checkbox" value="import_theme_widgets" checked="">
										<label for="rella-import-widget">
											<i class="option-icon fa fa-check"></i><?php esc_html_e( 'WIDGETS', 'boo' ); ?>
										</label>
									</span>
									<% } %>

									
									<span class="import-option">
										<input id="rella-import-sliders" type="checkbox" value="import_slider" checked="">
										<label for="rella-import-sliders">
											<i class="option-icon fa fa-check"></i><?php esc_html_e( 'SLIDERS', 'boo' ); ?>
										</label>
									</span>
									

									<span class="import-option">
										<input id="rella-import-setting" type="checkbox" value="import_theme_options" checked="">
										<label for="rella-import-setting">
											<i class="option-icon fa fa-check"></i><?php esc_html_e( 'SETTING', 'boo' ); ?>
										</label>
									</span>

									<span class="import-option">
										<input id="rella-import-home" type="checkbox" value="set_home_page" checked="">
										<label for="rella-import-home">
											<i class="option-icon fa fa-check"></i><?php esc_html_e( 'HOME PAGE', 'boo' ); ?>
										</label>
									</span>

									

								</div><!-- /.import-option-group -->

								<hr>
								<p><?php esc_html_e( 'New builder settings will overwrite your current settings, are you sure about this?', 'boo' ); ?></p>
								<div class="rella-agree-box"></div><!-- /.rella-agree-box -->

								<div class="import-option">
									<input class="agree" id="agree" name="agree" type="checkbox" value="no">
									<label for="agree"><i class="option-icon fa fa-check"></i><?php esc_html_e( 'Yes, Im sure about this', 'boo' ); ?></label>
								</div>

								<a class="rella-import-demo purchase-code-false" data-revslider="true" data-id="0"><span><?php esc_html_e( 'import demo', 'boo' ); ?></span></a>

							</div>
							<?php //} else { ?>
							<!-- <div class="rella-error-message">
							    <h3><?php //esc_html_e( 'Error: Theme license is not vaild', 'boo' ); ?></h3>
							</div> -->
							<?php //} ?>
						</div><!-- /.rella-popup-content-inner -->
						
					</div><!-- /.rella-popup-content -->
				</div><!-- /.rella-popup-body -->
			</div><!-- /.rella-popup -->
		</script>
		<?php endif; ?>
		</div>
	</div>
</div>