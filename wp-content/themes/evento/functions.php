<?php

    define('_LIMIT_',10);
    /* google maps defines */
    define('MAP_LAT'    , 48.85680934671159 );
    define('MAP_LNG'    , 2.353348731994629 );
    define('MAP_CLAT'   , 48.85700699730661 );
    define('MAP_CLNG'   , 2.354121208190918 );
    define('MAP_ZOOM'   , 15 );
	define('DEFAULT_AVATAR'   , get_template_directory_uri()."/images/default_avatar.jpg" );
    if( function_exists( 'wp_get_theme' ) ){
        define( '_TN_'      , wp_get_theme() );
    }else{
        define( '_TN_'      , get_current_theme() );
    }
    
	define('BRAND'      , '' );
	define('ZIP_NAME'   , 'conference' );
  
	define('EXCERPT_CHAR_LEN'   , '600' );

	include 'lib/php/main.php';
    include 'lib/php/actions.register.php';
    include 'lib/php/menu.register.php';

    $content_width = 600;

    if( function_exists( 'add_theme_support' ) ){
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
    }

    if( function_exists( 'add_image_size' ) ){
        add_image_size( 'slideshow'         , 920   , 460   , true );
        add_image_size( '62x62'     		, 62    , 62    , true );
        add_image_size( '150xXXX'           , 150   , 999   );
        add_image_size( '300xXXX'           , 300   , 999   ); /*used for animated sponsors widget*/
        add_image_size( '600x200'           , 600   , 200   , true );
		add_image_size( '200x100'           , 200   , 100   , true ); /*gallery size*/
		add_image_size( '440x220'           , 440   , 220   , true ); /*used for 2 col gallery*/
        add_image_size( '280x140'           , 280   , 140   , true ); /*used for 3 col gallery*/
		
    }
    
	
    if (version_compare($wp_version, '3.4', '>=')) { 
        add_theme_support( 'custom-background' );
    }else{ 
        if( function_exists( 'add_custom_background' ) ){
            add_custom_background();
        }else{
            add_theme_support( 'custom-background' );
        }
    }   

	add_editor_style('editor-style.css');
	
    /* Localization */
    load_theme_textdomain( 'cosmotheme' );
    load_theme_textdomain( 'cosmotheme' , get_template_directory() . '/languages' );
    
    if ( function_exists( 'load_child_theme_textdomain' ) ){
        load_child_theme_textdomain( 'cosmotheme' );
    }

    $pg = get_pages();
    $do = true;
	$do_cart_page = true;
    foreach( $pg as $p ){
        if( $p -> post_title == 'Registration' ){
            $do = false;
            break;
        }
    }

    foreach( $pg as $p ){
        if( $p -> post_title == 'Shopping cart' ){
            $do_cart_page = false;
            break;
        }
    }
    
    if( $do ){
        $pages = array(
            'post_title' => 'Registration',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        );

        wp_insert_post($pages);
    }

    /*create Shopping cart page*/	
    if( $do_cart_page ){
        $pages = array(
            'post_title' => 'Shopping cart',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        );

        wp_insert_post($pages);
    }

	if(is_admin() && ini_get('allow_url_fopen') == '1'){
		/*New version check*/	
		if( options::logic( 'cosmothemes' , 'show_new_version' ) ){
			function versionNotify(){
				echo api_call::compareVersions(); 
			}
		
			// Add hook for admin <head></head>
			add_action('admin_head', 'versionNotify');
		}

		/*Cosmo news*/
		if( options::logic( 'cosmothemes' , 'show_cosmo_news' ) && !isset($_GET['post_id'])  && !isset($_GET['post'])){
			function doCosmoNews(){
				echo api_call::getCosmoNews(); 
			}
		
			// Add hook for admin <head></head>
			add_action('admin_head', 'doCosmoNews');
		}	
	}

    /* Cosmothemes Backend link */
    function de_cosmotheme() {
        global $wp_admin_bar;
        if ( !is_super_admin() || !is_admin_bar_showing() ){
            return;
        }
		
		
        if( function_exists( 'wp_get_theme' ) ){
            $current_theme_name = wp_get_theme();
        }else{
            
            $current_theme_name = get_current_theme();
        }

        $wp_admin_bar -> add_menu( array(
            'id' => 'cosmothemes',
            'parent' => '',
            'title' => $current_theme_name,
            'href' => admin_url( 'admin.php?page=cosmothemes__general' )
            ) );
    }
    add_action('admin_bar_menu', 'de_cosmotheme');



    add_editor_style('editor-style.css');
?>