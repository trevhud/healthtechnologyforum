<?php
	if(is_search()){
		$posts = new WP_Query('paged='. get_query_var('paged').'&s='.get_query_var('s') );

		$paged = get_query_var('paged');

		global $wp_rewrite;

		$paged > 1 ? $current = $paged : $current = 1;

		$pagination = array(
			'base' => @add_query_arg('paged','%#%'),
			'format' => '',
			'total' => $posts->max_num_pages,
			'current' => $current,
			'show_all' => false,
			'prev_next'=> true,
			'prev_text'=> __('&laquo; Previous','cosmotheme'),
			'next_text'=> __('Next &raquo;','cosmotheme'),
			'type' => 'array'
		);

		if( $wp_rewrite->using_permalinks() )
				$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('search',remove_query_arg( 's', get_pagenum_link( 1 ) )) ) . 'page/%#%/', 'paged' );

		if( !empty($posts->query_vars['s']) )
				$pagination['add_args'] = array( 's' => get_query_var( 's' ) );



		$pgn = paginate_links( $pagination );
		if( !empty( $pgn ) ){
			echo '<div class="pag">';
			echo '<ul class="b_pag center p_b">';
			if( $current == 1 ){
				$current--;
			}
			foreach($pgn as $k => $link){ 
				print '<li>'.str_replace('class="prev ','class="no_link ',str_replace('class="next ','class="no_link ',str_replace("'",'"',$link) ) ).'</li>';
				
			}
			echo '</ul>';
			echo '</div>';
		}
	}else{
		global $wp_rewrite;
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$pagination = array(
				'base' => @add_query_arg('paged','%#%'),
				'format' => '',
				'total' => $wp_query->max_num_pages,
				'current' => $current,
				'show_all' => false,
				'type' => 'array'
				);

		if( $wp_rewrite->using_permalinks() )
				$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

		if( !empty($wp_query->query_vars['s']) )
				$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

		$pgn = paginate_links( $pagination );
		if( $current == 1 ){
			$current--;
		}
		
		if(!empty($pgn)){
			echo '<div class="pag">';
			echo '<ul class="b_pag center p_b">';
			foreach($pgn as $k => $link){
				print '<li>'.str_replace('class="prev ','class="no_link ',str_replace('class="next ','class="no_link ',str_replace("'",'"',$link) ) ).'</li>';

			}
			echo '</ul>';
			echo '</div>';
		}
	}
?>