<?php
/**
 * Default header
 *
 * @package Boo
 */


$logo = $mobile_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
$retina_logo = $retina_mobile_logo = get_template_directory_uri() . '/assets/img/logo/logo@2x.png';

$logo_arr = rella_helper()->get_option( 'header-logo' );
if( is_array( $logo_arr ) && ! empty( $logo_arr['url'] ) ) {
	$logo = $logo_arr['url'];
}
$retina_logo_arr = rella_helper()->get_option( 'header-logo-retina' );
if( is_array( $retina_logo_arr ) && ! empty( $retina_logo_arr['url'] ) ) {
	$retina_logo = $retina_logo_arr['url'];
}
$mobile_logo_arr = rella_helper()->get_option( 'menu-logo' );
if( is_array( $mobile_logo_arr ) && ! empty( $mobile_logo_arr['url'] ) ) {
	$mobile_logo = $mobile_logo_arr['url'];
}
$retina_mobile_logo_arr = rella_helper()->get_option( 'menu-logo-retina' );
if( is_array( $retina_mobile_logo_arr ) && ! empty( $retina_mobile_logo_arr['url'] ) ) {
	$retina_mobile_logo = $retina_mobile_logo_arr['url'];
}

?>

<header class="header-default main-header navbar navbar-default" data-wait-for-images="true">

	<div class="main-bar-container no-side-spacing">

		<div class="container-fluid">

			<div class="row">

				<div class="col-md-12">

					<div class="main-bar">

						<div class="navbar-header hidden-lg hidden-md">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-header-nav4" aria-expanded="false">
								<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'boo' ); ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo esc_url( $mobile_logo ); ?>" data-rjs="<?php echo esc_url( $retina_mobile_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
							</a>
						</div>

						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand hidden-sm hidden-xs no-margin no-padding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<span class="brand-inner">
								<img src="<?php echo esc_url( $logo ); ?>" data-rjs="<?php echo esc_url( $retina_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>">
							</span>
						</a>

						<div class="collapse navbar-collapse" id="main-header-nav4">
						<?php

								if ( has_nav_menu( 'primary' ) ) :

								wp_nav_menu( array(
									'theme_location' => 'primary',
									'container'  => 'ul',
									'before'     => false,
									'after'      => false,
									'menu_id'    => 'primary-nav',
									'menu_class' => 'nav navbar-nav main-nav text-uppercase',
									'walker'         => class_exists( 'Rella_Mega_Menu_Walker' ) ? new Rella_Mega_Menu_Walker : '',
								 ) );

							 else:
								wp_page_menu( array(
									'container'  => 'ul',
									'before'     => false,
									'after'      => false,
									'menu_id'    => 'primary-nav',
									'menu_class' => 'nav navbar-nav main-nav text-uppercase',
									'depth'      => 3
								));

							endif;

						?>
						</div><!-- /.navbar-collapse -->

					</div>

				</div><!-- /.col-md-12 -->

			</div><!-- /.row -->

		</div><!-- /.container-fluid -->

	</div><!-- /.main-bar-container -->

</header>
