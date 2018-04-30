<?php
	
// Enqueue Conditional Script
$this->scripts();	

// check
if( ! rella_helper()->is_woocommerce_active() ) {
	return;
}

?>
<div class="header-module module-user-links <?php $this->get_id() ?>" id="<?php echo $this->get_id() ?>">
	<a href="<?php echo esc_url( wc_get_cart_url() ) ?>"><i class="fa fa-shopping-bag"></i> <?php esc_html_e( 'Cart', 'infinite-addons' ); ?></a>
	<span class="module-trigger"><?php esc_html_e( 'My Account', 'infinite-addons' ); ?> <i class="fa fa-angle-down"></i></span>
	<div class="module-container">
		<ul>
			<?php if( is_user_logged_in() ): ?>
			<li><a href="<?php echo wc_get_account_endpoint_url( 'dashboard' ) ?>"><?php esc_html_e( 'Dashboard', 'infinite-addons' ); ?></a></li>
			<li><a href="<?php echo wc_get_account_endpoint_url( 'orders' ) ?>"><?php esc_html_e( 'Orders', 'infinite-addons' ); ?></a></li>
			<li><a href="<?php echo wc_get_account_endpoint_url( 'downloads' ) ?>"><?php esc_html_e( 'Downloads', 'infinite-addons' ); ?></a></li>
			<li><a href="<?php echo wc_get_account_endpoint_url( 'edit-account' ) ?>"><?php esc_html_e( 'Edit Profile', 'infinite-addons' ); ?></a></li>
			<li><a href="<?php echo wc_get_account_endpoint_url( 'customer-logout' ) ?>"><?php esc_html_e( 'Logout', 'infinite-addons' ); ?></a></li>
			<?php else: ?>
			<li><a href="<?php echo wc_get_account_endpoint_url( 'dashboard' ) ?>"><?php esc_html_e( 'Signup/Login', 'infinite-addons' ); ?></a></li>
			<?php endif; ?>
		</ul>
	</div>
	<!-- /.module-container -->
</div>