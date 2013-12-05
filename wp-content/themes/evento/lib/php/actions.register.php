<?php
    /* aditional options and meta-data init menu, register functions and options labels */
    add_action('admin_menu', array( 'options' , 'menu' ) );
    add_action('admin_init', array( 'options' , 'register' ) );
    /* register resource */
    add_action('init', array( 'resources' , 'register' ) , 1 );
    //add_action('admin_init', array( 'options' , 'meta' ) , 1 );
    add_action('admin_init', array( 'includes' , 'load_css' ) , 1 );
    add_action('admin_init', array( 'includes' , 'load_js' ) , 1 );
	
	
	/* ajax actions */
	/* meta actions */
	add_action('wp_ajax_meta_save', array( 'meta' , 'save' ) );
    add_action('wp_ajax_meta_delete' , array( 'meta' , 'delete') );
    add_action('wp_ajax_meta_sort' , array( 'meta' , 'sort') );
    add_action('wp_ajax_meta_update' , array( 'meta' , 'update') );


    //add_action('wp_ajax_nopriv_meta_save', array( 'meta' , 'save' ) );
    //add_action('wp_ajax_nopriv_meta_delete' , array( 'meta' , 'delete') );

    /* options actions */
    add_action( 'wp_ajax_text_preview' , array( 'text' , 'preview' ) );
	
	/* extra actions */
	add_action('wp_ajax_get_rows'       ,   array('extra' , 'get') );
    add_action('wp_ajax_extra_add'      ,   array('extra' , 'add') );
    add_action('wp_ajax_extra_del'      ,   array('extra' , 'del') );
    add_action('wp_ajax_extra_update'   ,   array('extra' , 'update') );

	/*action for cosmo news */
	add_action( 'wp_ajax_set_cosmo_news' , array( 'options' , 'set_cosmo_news' ) );
	
    /* new action */
    add_action('wp_ajax_post_relation'  , 'get_post_relation' );
    add_action('wp_ajax_search_relation'  , 'search_relation' );

    add_action('wp_ajax_get_slide_resources' , 'get_slide_resources' );
    add_action('wp_ajax_get_slide_resources_label' , 'get_slide_resources_label' );

    /* add to cart action action */
    if(is_user_logged_in () ){
        add_action('wp_ajax_add_to_cart' , array('cart' , 'addtocart') );
    }else{
        add_action('wp_ajax_nopriv_add_to_cart' , array('cart' , 'addtocart') );
    }
    
    /* get cart total action */
    if(is_user_logged_in () ){
        add_action('wp_ajax_get_cart_total' , array('cart' , 'show_cart_total') );
    }else{
        add_action('wp_ajax_nopriv_get_cart_total' , array('cart' , 'show_cart_total') );
    }

    /* get get_cart_details_updated action */
    if(is_user_logged_in () ){
        add_action('wp_ajax_get_cart_details_updated' , array('cart' , 'get_cart_details_updated') );
    }else{
        add_action('wp_ajax_nopriv_get_cart_details_updated' , array('cart' , 'get_cart_details_updated') );
    }
    
    
    /* get remove_cart_item action */
    if(is_user_logged_in () ){
        add_action('wp_ajax_remove_cart_item' , array('cart' , 'remove_product') );
    }else{
        add_action('wp_ajax_nopriv_remove_cart_item' , array('cart' , 'remove_product') );
    }
    
    /* contact form action */
    if(is_user_logged_in () ){
        add_action('wp_ajax_contact' , array('contact' , 'send_mail') );
    }else{
        add_action('wp_ajax_nopriv_contact' , array('contact' , 'send_mail') );
    }
    
    
    /* google map actions */
    add_action('wp_ajax_load_map' , array( 'map' ,'load_map' ) );
    add_action('wp_ajax_set_map_meta' , array( 'map' ,'set_map_meta' ) );
    add_action('wp_ajax_get_contact_map' , array( 'map' ,'get_contact_map' ) );


    /* shortcode */
    /* columns shortcodes */
    add_shortcode('twocol_one', array( 'shcode' , 'de_twocol_one' ) );
    add_shortcode('twocol_one_first', array( 'shcode' , 'de_twocol_one_first' ) );
    add_shortcode('twocol_one_last', array( 'shcode' , 'de_twocol_one_last' ) );
    add_shortcode('threecol_one', array( 'shcode' , 'de_threecol_one' ) );
    add_shortcode('threecol_one_first', array( 'shcode' , 'de_threecol_one_first' ) );
    add_shortcode('threecol_one_last', array( 'shcode' , 'de_threecol_one_last' ) );
    add_shortcode('threecol_two', array( 'shcode' , 'de_threecol_two' ) );
    add_shortcode('threecol_two_first', array( 'shcode' , 'de_threecol_two_first' ) );
    add_shortcode('threecol_two_last', array( 'shcode' , 'de_threecol_two_last' ) );
    add_shortcode('fourcol_one', array( 'shcode' , 'de_fourcol_one' ) );
    add_shortcode('fourcol_one_first', array( 'shcode' , 'de_fourcol_one_first' ) );
    add_shortcode('fourcol_one_last', array( 'shcode' , 'de_fourcol_one_last' ) );
    add_shortcode('fourcol_two', array( 'shcode' , 'de_fourcol_two' ) );
    add_shortcode('fourcol_two_first', array( 'shcode' , 'de_fourcol_two_first' ) );
    add_shortcode('fourcol_two_last', array( 'shcode' , 'de_fourcol_two_last' ) );
    add_shortcode('fourcol_three', array( 'shcode' , 'de_fourcol_three' ) );
    add_shortcode('fourcol_three_first', array( 'shcode' , 'de_fourcol_three_first' ) );
    add_shortcode('fourcol_three_last', array( 'shcode' , 'de_fourcol_three_last' ) );
    add_shortcode('fivecol_one', array( 'shcode' , 'de_fivecol_one' ) );
    add_shortcode('fivecol_one_first', array( 'shcode' , 'de_fivecol_one_first' ) );
    add_shortcode('fivecol_one_last', array( 'shcode' , 'de_fivecol_one_last' ) );
    add_shortcode('fivecol_two', array( 'shcode' , 'de_fivecol_two' ) );
    add_shortcode('fivecol_two_first', array( 'shcode' , 'de_fivecol_two_first' ) );
    add_shortcode('fivecol_two_last', array( 'shcode' , 'de_fivecol_two_last' ) );
    add_shortcode('fivecol_three', array( 'shcode' , 'de_fivecol_three' ) );
    add_shortcode('fivecol_three_first', array( 'shcode' , 'de_fivecol_three_first' ) );
    add_shortcode('fivecol_three_last', array( 'shcode' , 'de_fivecol_three_last' ) );
    add_shortcode('fivecol_four', array( 'shcode' , 'de_fivecol_four' ) );
    add_shortcode('fivecol_four_first', array( 'shcode' , 'de_fivecol_four_first' ) );
    add_shortcode('fivecol_four_last', array( 'shcode' , 'de_fivecol_four_last' ) );
    
    add_shortcode( 'price_table' , array( 'shcode' , 'price_table' ) );
    add_shortcode( 'price_table_col' , array( 'shcode' , 'price_table_col' ) );

    /* extra shortcode */
    add_shortcode('button', array( 'shcode' , 'add_button' ) );
    add_shortcode('hr', array( 'shcode' , 'add_hr' ) );
    add_shortcode('divider', array( 'shcode' , 'add_divider' ) );
    add_shortcode('quote', array( 'shcode' , 'add_quote' ) );
    add_shortcode('box', array( 'shcode' , 'add_box' ) );
    add_shortcode('unordered_list', array( 'shcode' , 'add_unordered_list' ) );
    add_shortcode('ordered_list', array( 'shcode' , 'add_ordered_list' ) );
    add_shortcode('highlight', array( 'shcode' , 'add_highlight' ) );
    add_shortcode('dropcap', array( 'shcode' , 'add_dropcap' ) );
    add_shortcode('toggle', array( 'shcode' , 'add_toggle' ) );

    /* shortcode for conference */
    add_shortcode('speakers', array( 'shcode' , 'add_speakers' ) );
    add_shortcode('conferences', array( 'shcode' , 'add_conferences' ) );
    add_shortcode('testimonials', array( 'shcode' , 'add_testimonials' ) );
    add_shortcode('presentation_speakers', array( 'shcode' , 'add_presentation_speakers' ) );
    add_shortcode('presentations', array( 'shcode' , 'add_presentations' ) );
    add_shortcode('exhibitors', array( 'shcode' , 'add_exhibitors' ) );
    add_shortcode('sponsors', array( 'shcode' , 'add_sponsors' ) );
    add_shortcode('program', array( 'shcode' , 'add_program' ) );
    add_shortcode('guests', array( 'shcode' , 'add_guests' ) );
    add_shortcode('pricing', array( 'shcode' , 'add_pricing' ) );
    
    

    add_shortcode('demo', array( 'shcode' , 'de_demo' ) );
    add_shortcode('tabs', array( 'shcode' , 'add_tabs' ) );
    add_shortcode('accordion', array( 'shcode' , 'add_accordion' ) );

    /* contact with google.map */
    add_shortcode('contact', array( 'shcode' , 'contact' ) );

    add_filter('the_content', 'do_shortcode');  /*we need this to be able to have nested shortcodes*/
    add_filter('widget_text', 'do_shortcode');

    add_filter( 'post_gallery', 'de_post_gallery', 10, 2 );

    /* widgets */
    register_widget("widget_exhibitors");
    register_widget("widget_sponsors");
    register_widget("widget_animated_sponsors");
    register_widget("widget_speakers");
    register_widget("widget_presentations");
    register_widget("widget_program");
    register_widget("widget_guests");
    register_widget("widget_registration");
    register_widget("widget_testimonials");
    register_widget("widget_conferences");

    /* general widgets */
    register_widget("widget_tweets");
    register_widget("widget_flickr");
    register_widget("widget_contact");
	register_widget("widget_social_media");
    register_widget("widget_latest_posts");

    /* register sidebars */
    if ( function_exists('register_sidebar') ) {
        register_sidebar(array(
			'name' => __( 'Main Sidebar', 'cosmotheme' ),
			'id' => 'main',
			'before_widget' => '<li id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4><p class="delimiter">&nbsp;</p>',
		));
		
		register_sidebar(array(
			'name' => __( 'Special area for small icons', 'cosmotheme' ),
			'id' => 'headarea',
			'before_widget' => '<ul><li id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></li></ul>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4><p class="delimiter">&nbsp;</p>',
		));

		register_sidebar(array(
			'name' => __( 'Register', 'cosmotheme' ),
			'id' => 'register',
			'before_widget' => '<li id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4><p class="delimiter">&nbsp;</p>',
		));
  
        /* front page sidebars */
        /* top */
        register_sidebar(array(
			'name' => __( 'Front Page Top Left Sidebar', 'cosmotheme' ),
			'id' => 'front-top-left',
			'before_widget' => '<li id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3><p class="delimiter">&nbsp;</p>',
		));
        register_sidebar(array(
			'name' => __( 'Front Page Top Middle Sidebar', 'cosmotheme' ),
			'id' => 'front-top-middle',
			'before_widget' => '<li id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3><p class="delimiter">&nbsp;</p>',
		));
        register_sidebar(array(
			'name' => __( 'Front Page Top Right Sidebar', 'cosmotheme' ),
			'id' => 'front-top-right',
			'before_widget' => '<li id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3><p class="delimiter">&nbsp;</p>',
		));
        /* bottom */
        register_sidebar(array(
			'name' => __( 'Front Page Bottom Left Sidebar', 'cosmotheme' ),
			'id' => 'front-bottom-left',
			'before_widget' => '<li id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3><p class="delimiter">&nbsp;</p>',
		));
        register_sidebar(array(
			'name' => __( 'Front Page Bottom Middle Sidebar', 'cosmotheme' ),
			'id' => 'front-bottom-middle',
			'before_widget' => '<li id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3><p class="delimiter">&nbsp;</p>',
		));
        register_sidebar(array(
			'name' => __( 'Front Page Bottom Right Sidebar', 'cosmotheme' ),
			'id' => 'front-bottom-right',
			'before_widget' => '<li id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3><p class="delimiter">&nbsp;</p>',
		));

        /* footer sidebars */
        register_sidebar(array(
			'name' => __( 'Footer First Sidebar', 'cosmotheme' ),
			'id' => 'footer-first',
			'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5><p class="delimiter">&nbsp;</p>',
		));
        register_sidebar(array(
			'name' => __( 'Footer Second Sidebar', 'cosmotheme' ),
			'id' => 'footer-second',
			'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5><p class="delimiter">&nbsp;</p>',
		));
        register_sidebar(array(
			'name' => __( 'Footer Third Sidebar', 'cosmotheme' ),
			'id' => 'footer-third',
			'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
			'after_widget' => '</div></li>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5><p class="delimiter">&nbsp;</p>',
		));

        $sidebars = options::get_value( '_sidebar' );
        
        /* register dinamic sidebar */
        if( is_array( $sidebars ) && !empty( $sidebars ) ){
            foreach( $sidebars as $sidebar ){
                register_sidebar(array(
                    'name' => $sidebar['title'] ,
                    'id' => trim( strtolower( str_replace( ' ' , '-' , $sidebar['title'] ) ) ),
                    'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
                    'after_widget' => '</div></li>',
                    'before_title' => '<h4  class="widget-title">',
                    'after_title' => '</h4><p class="delimiter">&nbsp;</p>',
                ));
            }
        }

    }

?>