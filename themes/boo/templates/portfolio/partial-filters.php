<?php
extract( $atts );
if(function_exists('ra_helper')) {
	$filter_cats = ra_helper()->terms_are_ids_or_slugs($filter_cats, 'rella-portfolio-category');
}

$terms = get_terms( array(
	'taxonomy' => 'rella-portfolio-category',
	'hide_empty' => false,
	'include' => $filter_cats
) );

if( empty( $terms ) ) {
	return;
}


?>
    <div class="row">
		
	<?php if( $show_order || $show_orderby ) { ?>
        <div class="col-md-7">
	<?php } else { ?> 
		<div class="col-md-12"> 
	<?php } ?>

            <div class="masonry-filters <?php echo $filter_style; ?> <?php echo $filter_color; ?>" data-target="#<?php echo $this->grid_id; ?>">
			<?php if( 'classic' !== $filter_style ) { ?>
				<span class="filters-toggle-link">
					<?php echo $filter_title ?>
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
						<g>
							<line x1="0" y1="32" x2="63" y2="32"/>
						</g>
						<polyline  points="50.7,44.6 63.3,32 50.7,19.4 "/>
						<circle cx="32" cy="32" r="31"/>
					</svg>
				</span>
			<?php } ?>
                <ul class="list-unstyled list-inline">
                    <li data-filter="*" class="active"><span><span><?php echo $filter_lbl_all ?></span></span></li>
					<?php foreach( $terms as $term ) {
						printf( '<li data-filter=".%s"><span><span>%s</span></span></li>', $term->slug, $term->name );
					} ?>
                </ul>
            </div>

        </div>

		<?php if( $show_order || $show_orderby ): ?>
        <div class="col-md-5">

			<?php if( $show_order ): ?>
            <div class="sorting-option<?php echo isset( $_GET['orderby'] ) ? ' checked' : '' ?>">
				<span>
					<label for="post-orderby"><?php esc_html_e( 'Date', 'boo' ); ?></label>
					<input type="checkbox" name="post-orderby" id="post-orderby" data-metric="orderby" value="title" <?php checked( isset( $_GET['orderby'] ) ) ?>>
					<span class="input-dummy"></span>
					<label for="post-orderby"><?php esc_html_e( 'Name', 'boo' ); ?></label>
				</span>
            </div>
			<?php endif; ?>

			<?php if( $show_orderby ): ?>
            <div class="sorting-option<?php echo isset( $_GET['order'] ) ? ' checked' : '' ?>">
                <span>
					<label for="post-order"><?php esc_html_e( 'Desc', 'boo' ); ?></label>
					<input type="checkbox" name="post-order" id="post-order" data-metric="order" value="Asc" <?php checked( isset( $_GET['order'] ) ) ?>>
					<span class="input-dummy"></span>
					<label for="post-order"><?php esc_html_e( 'Asc', 'boo' ); ?></label>
				</span>
            </div>
			<?php endif; ?>

        </div>
		<?php endif; ?>

    </div>
