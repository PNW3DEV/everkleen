
<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( get_permalink( woocommerce_get_page_id('shop') ) ); ?>">
	<input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>">
	<input type="submit" value="Search" class="btn btn-primary hidden-xs hidden-sm hidden-md hidden-lg">
</form>
