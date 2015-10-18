<form role="search" method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<input type="text" class="search-line" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" id="s" />
		<input type="submit" class="search-button" id="searchsubmit" value="<?php echo esc_attr_x( '', 'submit button' ); ?>" />
	</div>
</form>