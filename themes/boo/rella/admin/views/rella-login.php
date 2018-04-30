<?php 
	if( ! class_exists( 'RellaCheck' ) || ! class_exists( 'RellaEnvato' ) ) {
		echo '<div class="rella-info rella-align-center">Please activate the Infinite Addons</div>';
		return; 
	};
	
	$rellaCheck = new RellaCheck;
	$rellaEnvato = new RellaEnvato;
	
	$get_token = $rellaCheck->get_token();
	$logged_in_mail = $rellaCheck->logged_in_mail();
	$get_info = $rellaCheck->get_info();
	
	$login_url = $rellaEnvato->login_url()
	
?>

<div class="wrap rella-wrap">
   <div class="rella-dashboard">

   <header class="rella-dashboard-header">
        <div class="rella-dashboard-title  clearfix">
            <h1><?php esc_html_e( 'Boo License', 'boo' ); ?></h1>
        </div>
        <?php include_once( get_template_directory() . '/rella/admin/views/rella-tabs.php' ); ?>
   </header>

   <div class="tab-content">
        <div id="rella-license" class="rella-register rella-tab-pane rella-tab-is-active">

        <?php if( strlen( $get_token ) <= 30 || $logged_in_mail === null ) { ?>
        <div class="clearfix">
	        <div class="rella-info rella-align-center bg-seashell">
	            <h2><?php esc_html_e( 'Why to activate your theme ?', 'boo' ); ?></h2>
	            <ul>
		            <!-- <li><?php //esc_html_e( 'Unlock automatic updates', 'boo' ); ?></li> -->
		            <li><?php esc_html_e( 'Access over than 30 demo', 'boo' ); ?></li>
		            <li><?php esc_html_e( 'Access the support forum', 'boo' ); ?></li>
		            <li><?php esc_html_e( 'Access the online knowledge base', 'boo' ); ?></li>
	            </ul>
	        </div>
        </div>
		<a href="<?php echo esc_attr( $login_url ); ?>" id="rella-envato-login" class="color-envato rella-button"><?php esc_html_e( 'Login With Envato', 'boo' ); ?></a>

        <?php  } 

        elseif( is_array( $get_info ) ){ //print_r( $get_info );
      
        ?>
            <a href="#" id="rella-logout-envato"><?php esc_html_e( 'Log Out Envato Account', 'boo' ); ?></a>
            <?php } else {
                echo 'Loading..';
        } ?>
            </div>
        </div>
    </div>
</div>