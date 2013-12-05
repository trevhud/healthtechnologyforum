<?php
    /* register pages */
    options::$menu['cosmothemes']['general']            = array( 'label' => __( 'General' , 'cosmotheme' ) , 'title' => __( 'General Settings' , 'cosmotheme' ) , 'description' => 'General page description.' , 'type' => 'main' , 'main_label' => _TN_ );
    options::$menu['cosmothemes']['front_page']         = array( 'label' => __( 'Front Page'  , 'cosmotheme' ) , 'title' => __( 'Front Page Settings' , 'cosmotheme' )  , 'description' => 'Front page description.' );
    options::$menu['cosmothemes']['layout']             = array( 'label' => __( 'Layout'  , 'cosmotheme' ) , 'title' => __( 'Layout Page Settings' , 'cosmotheme' )  , 'description' => 'Layout page description.' );
    options::$menu['cosmothemes']['styling']            = array( 'label' => __( 'Styling'  , 'cosmotheme' ) , 'title' => __( 'Styling Settings' , 'cosmotheme' )  , 'description' => 'Styling page description.' );
    options::$menu['cosmothemes']['menu']               = array( 'label' => __( 'Menu'  , 'cosmotheme' ) , 'title' => __( 'Menu Settings' , 'cosmotheme' )  , 'description' => 'Menu page description.' );
    options::$menu['cosmothemes']['blog_post']          = array( 'label' => __( 'Blogging'  , 'cosmotheme' ) , 'title' => __( 'Blog Post Settings' , 'cosmotheme' )  , 'description' => 'Blog post page description.' );
    options::$menu['cosmothemes']['social']             = array( 'label' => __( 'Social'  , 'cosmotheme' ) , 'title' => __( 'Social Settings' , 'cosmotheme' )  , 'description' => 'Social page description.' );
    options::$menu['cosmothemes']['slider']             = array( 'label' => __( 'Slideshow'  , 'cosmotheme' ) , 'title' => __( 'Slideshow Settings' , 'cosmotheme' ) , 'description' => 'Slideshow page description.' );
	/*options::$menu['cosmothemes']['checkout']           = array( 'label' => __( 'Checkout'  , 'cosmotheme' ) , 'title' => __( 'Checkout Settings' , 'cosmotheme' )  , 'description' => 'Checkout page settings.'  );  */  
	options::$menu['cosmothemes']['_sidebar']           = array( 'label' => __( 'Sidebar'  , 'cosmotheme' ) , 'title' => __( 'Sidebar Manager' , 'cosmotheme' )  , 'description' => 'Sidebar manager page description.' , 'update' => false );
    options::$menu['cosmothemes']['cosmothemes']        = array( 'label' => __( 'CosmoThemes' , 'cosmotheme' )  , 'title' => __( 'CosmoThemes' , 'cosmotheme' )  , 'description' => __( 'CosmoThemes notifications.' , 'cosmotheme' ) );

    /* fields from general settings */
    $path_parts = pathinfo( options::get_value( 'general' , 'favicon' ) );
    if( strlen( options::get_value( 'general' , 'favicon' ) ) && $path_parts['extension'] != 'ico' ){
        $ico_hint = '<span style="color:#cc0000;">' . __( 'Error, please select "ico" type media file' , 'cosmotheme' ) . '</span>';
    }else{
        $ico_hint = __( "Please select 'ico' type media file. Make sure you allow uploading 'ico' type in General Settings -> Upload file types." , 'cosmotheme' );
    }

    options::$fields['general']['favicon']              = array('type' => 'st--upload' , 'label' => __( 'Custom Favicon' , 'cosmotheme' ) , 'id' => 'favicon_path' , 'hint' => $ico_hint );
    options::$fields['general']['logo_type']            = array('type' => 'st--select' , 'label' => __( 'Type Title ' , 'cosmotheme' ) , 'value' => array( 'text' => 'Text Logo' , 'image' => 'Image Logo' ) , 'hint' => __( 'Enable text-based Site Title and Tagline.' , 'cosmotheme' ) , 'action' => "act.select( '.g_logo_type' , { 'text':'.g_logo_text' , 'image':'.g_logo_image' } , 'sh_' );" , 'iclasses' => 'g_logo_type' );

    /* fields for general -> logo_type */
    options::$fields['general']['logo_url']             = array('type' => 'st--upload' , 'label' => __( 'Custom Logo URL' , 'cosmotheme' ) , 'id' => 'logo_path' );

    /* hide not used fields */
	if( options::get_value( 'general' , 'logo_type') == 'image' ){
        options::$fields['general']['logo_url']['classes'] 			= 'g_logo_image';
        text::fields( 'general' , 'logo' ,  'g_logo_text hidden' , get_option( 'blogname' ) );
        options::$fields['general']['hint']        = array('type' => 'st--hint' , 'classes' => 'g_logo_text hidden' ,'value' => __( 'to change blog title go to <a href="options-general.php">general settings </a> ' , 'cosmotheme') );
    }else{
		options::$fields['general']['logo_url']['classes'] 			= 'generic-hint g_logo_image hidden';
        text::fields( 'general' , 'logo' ,  'g_logo_text' , get_option( 'blogname' ) );
        options::$fields['general']['hint']        = array('type' => 'st--hint' , 'classes' => 'generic-hint g_logo_text' , 'value' => __( 'to change blog title go to <a href="options-general.php">general settings </a> ' , 'cosmotheme') );
    }

    /* default general -> logo options */
    options::$default['general']['logo_type']           = 'text';

	/* preview logo */
    options::$fields['general']['tracking_code']        = array('type' => 'st--textarea' , 'label' => __( 'Tracking Code' , 'cosmotheme' ) , 'hint' => __( 'Paste your Google Analytics or other tracking code here,<br /> and it will be added into the footer of your template.' , 'cosmotheme' ) );

	/*registration option*/
    options::$fields['general']['site_registration']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable conference registration' , 'cosmotheme') , 'hint' => __( 'check to show "register" link.' , 'cosmotheme' ) );
	/*login option*/
    options::$fields['general']['site_login_frontend']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show Log In link' , 'cosmotheme') , 'hint' => __( 'check to show "Log In" link.' , 'cosmotheme' ) );
    /*bread krumbs*/
    options::$fields['general']['enable_breadcrumbs']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable Breadcrumbs' , 'cosmotheme')  );
	/**/
    options::$default['general']['site_registration']   = 'yes';
	options::$default['general']['site_login_frontend'] = 'yes';
	options::$default['general']['enable_breadcrumbs']	= 'no';

    /* layout */
    $layouts                                            = array('left' => __( 'Left Sidebar' , 'cosmotheme' ) , 'right' => __( 'Right Sidebar' , 'cosmotheme' ) , 'full' => __( 'Full Width' , 'cosmotheme' ) );
    options::$fields['layout']['title']                 = array('type' => 'ni--title' , 'title' => __( 'Layout Settings' , 'cosmotheme' ) );

    options::$fields['layout']['404']                   = array('type' => 'st--select' , 'label' => __( 'Layout for 404 page' , 'cosmotheme' ) , 'value' => $layouts );
    
    options::$fields['layout']['author']                = array('type' => 'st--select' , 'label' => __( 'Layout for Author page' , 'cosmotheme' ) , 'value' => $layouts );
    
    options::$fields['layout']['page']                  = array('type' => 'st--select' , 'label' => __( 'Layout for Pages page' , 'cosmotheme' ) , 'value' => $layouts );

    options::$fields['layout']['single']                = array('type' => 'st--select' , 'label' => __( 'Layout for Single Blog post' , 'cosmotheme' ) , 'value' => $layouts );
    options::$fields['layout']['conference']            = array('type' => 'st--select' , 'label' => __( 'Layout for Single Conference page' , 'cosmotheme' ) , 'value' => $layouts );
    options::$fields['layout']['presentation']          = array('type' => 'st--select' , 'label' => __( 'Layout for Single Presentation page' , 'cosmotheme' ) , 'value' => $layouts );
    options::$fields['layout']['exhibitor']             = array('type' => 'st--select' , 'label' => __( 'Layout for Single Exhibitor page' , 'cosmotheme' ) , 'value' => $layouts );
    options::$fields['layout']['sponsor']               = array('type' => 'st--select' , 'label' => __( 'Layout for Single Sponsor page' , 'cosmotheme' ) , 'value' => $layouts );
    options::$fields['layout']['speaker']               = array('type' => 'st--select' , 'label' => __( 'Layout for Single Speaker page' , 'cosmotheme' ) , 'value' => $layouts );

    options::$fields['layout']['blog_page']             = array('type' => 'st--select' , 'label' => __( 'Layout for Blog Page page' , 'cosmotheme' ) , 'value' => $layouts );

    options::$fields['layout']['search']                = array('type' => 'st--select' , 'label' => __( 'Layout for Search page' , 'cosmotheme' ) , 'value' => $layouts );
    options::$fields['layout']['archive']               = array('type' => 'st--select' , 'label' => __( 'Layout for Archive page' , 'cosmotheme' ) , 'value' => $layouts );
    options::$fields['layout']['category']              = array('type' => 'st--select' , 'label' => __( 'Layout for Category page' , 'cosmotheme' ) , 'value' => $layouts );
    options::$fields['layout']['tag']                   = array('type' => 'st--select' , 'label' => __( 'Layout for Tags page' , 'cosmotheme' ) , 'value' => $layouts );
    options::$fields['layout']['attachment']            = array('type' => 'st--select' , 'label' => __( 'Layout for Tags page' , 'cosmotheme' ) , 'value' => $layouts );

	

    /* layout default values */
    options::$default['layout']['404']                  = 'right';
    
    options::$default['layout']['author']               = 'right';
    
    options::$default['layout']['page']                 = 'full';

    options::$default['layout']['single']               = 'right';
    options::$default['layout']['conference']           = 'right';
    options::$default['layout']['presentation']         = 'right';
    options::$default['layout']['exhibitor']            = 'right';
    options::$default['layout']['sponsor']              = 'right';
    options::$default['layout']['speaker']              = 'right';

    options::$default['layout']['blog_page']            = 'right';

    options::$default['layout']['search']               = 'right';
    options::$default['layout']['archive']              = 'right';
    options::$default['layout']['category']             = 'right';
    options::$default['layout']['tag']                  = 'right';
    options::$default['layout']['attachment']           = 'right';

	/*options::$default['general']['site_registration']		= 'site_registration';*/

    /* fields from front page settings */
    options::$fields['front_page']['slideshow']         = array( 'type' => 'st--select' , 'label' => __( 'Select Slideshow on Front Page' , 'cosmotheme' ) , 'value' => get__posts( array( 'post_type' => 'slideshow','numberposts' => -1 ) ) );

    options::$fields['front_page']['resources']         = array( 'type' => 'st--select' , 'label' => __( 'Select front page resource type' , 'cosmotheme' )  , 'value' => array( 'conference' => 'Conference' , 'page' => 'Static Page' ) ,  'action' => "act.select( '.fp_res_type' , { 'conference':'.fp_conf' , 'page':'.fp_page' } , 'sh_' );" , 'iclasses' => 'fp_res_type' );

    options::$fields['front_page']['page']              = array( 'type' => 'st--select' , 'label' => __( 'Select static page for front page' , 'cosmotheme' ) , 'value' => get__pages() );
    
    options::$fields['front_page']['event']             = array( 'type' => 'st--select' , 'label' => __( 'Select Event on Front Page' , 'cosmotheme' ) , 'value' => get__posts( array( 'post_type' => 'conference','numberposts' => -1 ) ),  'hint' => __( 'If none is selected, then the latest event will show up on the front page' , 'cosmotheme' ) );
    options::$fields['front_page']['conf_limit']        = array( 'type' => 'st--digit' , 'label' => __( 'Front Latest Conference content length' , 'cosmotheme' )  );

    options::$fields['front_page']['info']              = array( 'type' => 'st--hint' , 'value' => __( 'If you wish to set blog page go to '  , 'cosmotheme' ) . '<a href="options-reading.php">' . __( 'Settings -> Reading ' , 'cosmotheme' ) . '</a>' );


    /* default value for conference content lenght */
    options::$default['front_page']['conf_limit']       = 600;
    options::$default['front_page']['resources']        = 'conference';
    
    if( options::get_value( 'front_page' , 'resources' ) == 'conference' ){
        options::$fields['front_page']['page']['classes']       = 'fp_page hidden';
        options::$fields['front_page']['conf_limit']['classes'] = 'fp_conf';
        options::$fields['front_page']['event']['classes']      = 'fp_conf';
    }else{
        options::$fields['front_page']['page']['classes']       = 'fp_page';
        options::$fields['front_page']['conf_limit']['classes'] = 'fp_conf hidden';    
        options::$fields['front_page']['event']['classes']      = 'fp_conf hidden';
    }




    $pattern_path = 'pattern/s.pattern.';
    $pattern = array(
        "flowers"=>"flowers.png" , "flowers_2"=>"flowers_2.png" , "flowers_3"=>"flowers_3.png" , "flowers_4"=>"flowers_4.png" ,"circles"=>"circles.png","dots"=>"dots.png","grid"=>"grid.png","noise"=>"noise.png",
        "paper"=>"paper.png","rectangle"=>"rectangle.png","squares_1"=>"squares_1.png","squares_2"=>"squares_2.png","thicklines"=>"thicklines.png","thinlines"=>"thinlines.png","none"=>"none.png"
    );
    options::$fields['styling']['bg_title']             = array( 'type' => 'ni--title' , 'title' => __( 'Select Theme Background' , 'cosmotheme' ) );
    options::$fields['styling']['background']           = array( 'type' => 'ni--radio-icon' ,  'value' => $pattern , 'path' => $pattern_path , 'in_row' => 6 );

    options::$fields['styling']['boxed']                = array( 'type' => 'st--logic-radio' , 'label' => __( 'Set boxed content style' , 'cosmotheme') , 'hint' => __( 'check for boxed content style.' , 'cosmotheme' ) );
    
    /* color */
    /* background */
    options::$fields['styling']['background_color']     = array('type' => 'st--color-picker' , 'label' => __( 'Set background color' , 'cosmotheme' ) );
    options::$fields['styling']['footer_bg_color']      = array('type' => 'st--color-picker' , 'label' => __( 'Set footer background color' , 'cosmotheme' ) );
	
	/*default bg*/
	options::$default['styling']['background']			= 'paper';
  
	/* default color */
	options::$default['styling']['background_color']    = '#ffffff';
    options::$default['styling']['footer_bg_color']     = '#414B52';
	options::$default['styling']['boxed']        		= 'yes';

    /* fields from menu settings */
    options::$fields['menu']['header']                  = array('type' => 'st--select' , 'value' => fields::digit_array( 20 ) , 'label' => __( 'Set limit for Main Menu' , 'cosmotheme' ) , 'hint' => __( 'Set the number of visible menu items. Remaining menu items<br />will be shown in the drop down menu item "More" .' , 'cosmotheme' ) );
    options::$fields['menu']['footer']                  = array('type' => 'st--select' , 'value' => fields::digit_array( 20 ) , 'label' => __( 'Set limit for Footer Menu' , 'cosmotheme' )  );

    /* menu default value */
    options::$default['menu']['header']                 = 8;
    options::$default['menu']['footer']                 = 10;

    /* fields from blog post settings */
    options::$fields['blog_post']['post_title']         = array('type' => 'ni--title' , 'title' => __( 'General Blog Posts Settings' , 'cosmotheme' ) );
    options::$fields['blog_post']['post_similar']       = array('type' => 'st--select' , 'value' => fields::digit_array( 20 , 1 ) , 'label' => __( 'Number of similar posts' , 'cosmotheme' ) );
    options::$fields['blog_post']['post_similar_']      = array('type' => 'st--logic-radio' , 'label' => __( 'Show similar posts' , 'cosmotheme' ) );
    options::$fields['blog_post']['post_sharing']       = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for posts' , 'cosmotheme' ) );
    options::$fields['blog_post']['post_author_box']    = array('type' => 'st--logic-radio' , 'label' => __( 'Post Author Box' , 'cosmotheme' ) , 'hint' => __( 'This will enable the post author box on the single posts page.<br /> Edit description in Users > Your Profile.' , 'cosmotheme' )  );

    options::$fields['blog_post']['page_title']         = array('type' => 'ni--title' , 'title' => __( 'General Blog Page Settings' , 'cosmotheme' ) );
    options::$fields['blog_post']['page_sharing']       = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for page' , 'cosmotheme' ) );
    options::$fields['blog_post']['page_author_box']    = array('type' => 'st--logic-radio' , 'label' => __( 'Page Author Box' , 'cosmotheme' ) , 'hint' => __( 'This will enable the page author box on the single page.<br /> Edit description in Users > Your Profile.' , 'cosmotheme' ) );

    options::$fields['blog_post']['conf_title']         = array('type' => 'ni--title' , 'title' => __( 'Conference Posts Settings' , 'cosmotheme' ) );
	options::$fields['blog_post']['conf_slug']          = array('type' => 'st--text' , 'label' => __( 'Conference Posts Permalink slug' , 'cosmotheme' ) , 'hint' => 'Type it only if you want to change the default post type name that shows up in the permalink.');	
    options::$fields['blog_post']['conf_similar']       = array('type' => 'st--select' , 'value' => fields::digit_array( 20 , 1) , 'label' => __( 'Number of similar posts' , 'cosmotheme' ) );
    options::$fields['blog_post']['conf_similar_']      = array('type' => 'st--logic-radio' , 'label' => __( 'Show similar conferences' , 'cosmotheme' )  );
    options::$fields['blog_post']['conf_sharing']       = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for conference posts' , 'cosmotheme' ) );

    options::$fields['blog_post']['present_title']      = array('type' => 'ni--title' , 'title' => __( 'Presentation Posts Settings' , 'cosmotheme' ) );
	options::$fields['blog_post']['present_slug']       = array('type' => 'st--text' , 'label' => __( 'Presentation Posts Permalink slug' , 'cosmotheme' ) , 'hint' => 'Type it only if you want to change the default post type name that shows up in the permalink.');	
    options::$fields['blog_post']['present_similar']    = array('type' => 'st--select' , 'value' => fields::digit_array( 20 , 1) , 'label' => __( 'Number of similar posts' , 'cosmotheme' ) );
    options::$fields['blog_post']['present_similar_']   = array('type' => 'st--logic-radio' , 'label' => __( 'Show similar presentations' , 'cosmotheme' )  );
    options::$fields['blog_post']['present_sharing']    = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for presentation posts' , 'cosmotheme' ) );

    options::$fields['blog_post']['speaker_title']      = array('type' => 'ni--title' , 'title' => __( 'Speaker Posts Settings' , 'cosmotheme' ) );
	options::$fields['blog_post']['speaker_slug']       = array('type' => 'st--text' , 'label' => __( 'Speaker Posts Permalink slug' , 'cosmotheme' ) , 'hint' => 'Type it only if you want to change the default post type name that shows up in the permalink.');	
    options::$fields['blog_post']['speaker_similar']    = array('type' => 'st--select' , 'value' => fields::digit_array( 20 , 1) , 'label' => __( 'Number of similar speakers' , 'cosmotheme' ) );
    options::$fields['blog_post']['speaker_similar_']   = array('type' => 'st--logic-radio' , 'label' => __( 'Show similar speakers' , 'cosmotheme' )  );
    options::$fields['blog_post']['speaker_sharing']    = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for speaker posts' , 'cosmotheme' ) );

    options::$fields['blog_post']['exhib_title']        = array('type' => 'ni--title' , 'title' => __( 'Exhibitor Posts Settings' , 'cosmotheme' ) );
	options::$fields['blog_post']['exhib_slug']         = array('type' => 'st--text' , 'label' => __( 'Exhibitor Posts Permalink slug' , 'cosmotheme' ) , 'hint' => 'Type it only if you want to change the default post type name that shows up in the permalink.');	
    options::$fields['blog_post']['exhib_sharing']      = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for exhibitor posts' , 'cosmotheme' ) );
 
    options::$fields['blog_post']['sponsor_title']      = array('type' => 'ni--title' , 'title' => __( 'Sponsor Posts Settings' , 'cosmotheme' ) );
	options::$fields['blog_post']['sponsor_slug']          = array('type' => 'st--text' , 'label' => __( 'Sponsor Posts Permalink slug' , 'cosmotheme' ) , 'hint' => 'Type it only if you want to change the default post type name that shows up in the permalink.');	
    options::$fields['blog_post']['sponsor_sharing']    = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for sponsor posts' , 'cosmotheme' ) );

    options::$fields['blog_post']['author_title']       = array('type' => 'ni--title' , 'title' => __( 'Author Settings' , 'cosmotheme' ) );
    options::$fields['blog_post']['author_sharing']     = array('type' => 'st--logic-radio' ,  'label' => __( 'Enable social sharing for author page' , 'cosmotheme' ) );

    options::$fields['blog_post']['attachment_title']   = array('type' => 'ni--title' , 'title' => __( 'Attachment Posts Settings' , 'cosmotheme' ) );
    options::$fields['blog_post']['attachment_sharing'] = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for attachment posts' , 'cosmotheme' ) );
    options::$fields['blog_post']['attachment_comments']= array('type' => 'st--logic-radio' , 'label' => __( 'Enable comments for attachment posts' , 'cosmotheme' ) );

    /* default values  */
    options::$default['blog_post']['post_similar']      = 6;
    options::$default['blog_post']['conf_similar']      = 6;
    options::$default['blog_post']['present_similar']   = 6;
    options::$default['blog_post']['speaker_similar']   = 6;
    options::$default['blog_post']['author_similar']    = 6;

    options::$default['blog_post']['post_similar_']     = 'yes';
    options::$default['blog_post']['conf_similar_']     = 'yes';
    options::$default['blog_post']['present_similar_']  = 'yes';
    options::$default['blog_post']['speaker_similar_']  = 'yes';

    options::$default['blog_post']['post_sharing']      = 'yes';
    options::$default['blog_post']['post_author_box']   = 'no';

    options::$default['blog_post']['page_sharing']      = 'yes';
    options::$default['blog_post']['page_author_box']   = 'no';

    options::$default['blog_post']['conf_sharing']      = 'yes';
    options::$default['blog_post']['present_sharing']   = 'yes';
    options::$default['blog_post']['speaker_sharing']   = 'yes';
    options::$default['blog_post']['exhib_sharing']     = 'yes';
    options::$default['blog_post']['sponsor_sharing']   = 'yes';
    options::$default['blog_post']['author_sharing']    = 'no';
    options::$default['blog_post']['attachment_sharing']= 'yes';
    options::$default['blog_post']['attachment_comments']= 'yes';

    /* fields from social sharing settings */
    options::$fields['social']['twitter']               = array('type' => 'st--text' , 'label' => __( 'Twitter ID' , 'cosmotheme' ) , 'hint' => __( 'If set, Twitter icon will appear in the header area.' , 'cosmotheme' ) );
	options::$fields['social']['twitter_update_intervat']= array('type' => 'st--digit' , 'label' => __( 'Twitter widget update interval' , 'cosmotheme' ) , 'hint' => __( 'How often to ckeck for new tweets (in minutes)' , 'cosmotheme' ));

    options::$fields['social']['facebook']              = array('type' => 'st--text' , 'label' => __( 'Facebook profile ID' , 'cosmotheme' ) , 'hint' => __( 'If set, Facebook icon will appear in the header area.'  , 'cosmotheme' ) );
    options::$fields['social']['google_map']            = array('type' => 'st--text' , 'label' => __( 'Google map key' , 'cosmotheme' ) , 'hint' => __( 'This key is neded if you want to use google map in contact form.'  , 'cosmotheme' ) );

	options::$default['social']['twitter_update_intervat']              = 60;

    /* slider */
    options::$fields['slider']['buttons']               = array( 'type' => 'st--select' , 'label'=> __( 'Auto generate next/prev buttons' , 'cosmotheme' ) , 'value' =>  array('true' =>'Yes' , 'false' => 'No' ) );
    options::$fields['slider']['slidespeed']            = array( 'type' => 'st--digit' , 'label' => __( 'Set the speed of the sliding animation in milliseconds.' , 'cosmotheme' ) );
    options::$fields['slider']['playspeed']             = array( 'type' => 'st--digit' , 'label'=> __( 'Time between slide animation in milliseconds' , 'cosmotheme' ) );
    options::$fields['slider']['effect']                = array( 'type' => 'st--select' , 'label'=> __( 'Set effect' , 'cosmotheme' ) , 'value' => array( 'slide, fade' => 'slide' , 'fade' => 'fade' ) );
    options::$fields['slider']['randomize']             = array( 'type' => 'st--select' , 'label'=> __( 'Randomize files' , 'cosmotheme' ) , 'value' => array( 'true' => 'Yes' , 'false' => 'No' ) );
    options::$fields['slider']['pause']                 = array( 'type' => 'st--select' , 'label'=> __( 'Pause slideshow on hovering' , 'cosmotheme' ) , 'value' => array( 'true' => 'Yes' , 'false' => 'No' ) );
    options::$fields['slider']['ribbon']                = array( 'type' => 'st--logic-radio' , 'label'=> __( 'Show ribbon on slideshow' , 'cosmotheme' ) );

    /* slider default values */
    options::$default['slider']['buttons']              = 'true';
    options::$default['slider']['slidespeed']           =  600 ;
    options::$default['slider']['playspeed']            =  5000 ;
    options::$default['slider']['effect']               = 'slide, fade';
    options::$default['slider']['randomize']            = 'false';
    options::$default['slider']['pause']                = 'true';
    options::$default['slider']['ribbon']               = 'yes';

    /* sidebar manager */
    $struct = array(
        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow[]',
            'type' => 'hidden'
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'title',
                'type' => 'text',
                'label' => 'Sidebar Title',
                'classes' => 'sidebar-title'
            )
        ),
        'select' => 'title'
    );

	/*Cosmothemes options*/

	options::$default['cosmothemes']['show_new_version']      = 'yes';
	options::$default['cosmothemes']['show_cosmo_news']      = 'yes';
	options::$fields['cosmothemes']['show_new_version'] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable notification about new theme version' , 'cosmotheme' ) );
	options::$fields['cosmothemes']['show_cosmo_news']  = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable Cosmothemes news notification' , 'cosmotheme' ) );
	
    /*delete_option( '_sidebar' );*/
    options::$fields['_sidebar']['idrow']               = array('type' => 'st--m-hidden' , 'value' => 1 , 'id' => 'sidebar_title_id' , 'single' => true );
    options::$fields['_sidebar']['title']               = array('type' => 'st--text' , 'label' => __( 'Set title for new Sidebar' , 'cosmotheme' ) , 'id' => 'sidebar_title' , 'single' => true );
    options::$fields['_sidebar']['save']                = array('type' => 'st--button' , 'value' => __( 'Add New Sidebar' , 'cosmotheme' ) , 'action' => "extra.add( '_sidebar' , { 'input' : [ 'sidebar_title_id' , 'sidebar_title'] })" );

    options::$fields['_sidebar']['struct']              = $struct;
    options::$fields['_sidebar']['hint']                = __( 'List of generic dinamic Sidebars' , 'cosmotheme' );


    options::$fields['_sidebar']['list']                = array( 'type' => 'ex--extra' , 'cid' => 'container__sidebar');
    
    
    /*checkout*/
    
    /*PayPal Settings*/
    $general_hint = "This implementation works in conjunction with <a href='https://www.paypal.com/us/mrb/pal=KMEJ5UCMUQVAW'>PayPal® Website Payments Standard</a>, for businesses. You do NOT need a PayPal® Pro account. 
    				You just need to <a href='http://pages.ebay.com/help/buy/questions/upgrade-paypal-account.html'>upgrade</a> your Personal PayPal® account to a Business status, which is free. A PayPal® account can be upgraded from a 
    				Personal account to a Business account, simply by going to the `Profile` button under the `My Account` tab, selecting the `Personal Business Information` 
    				button, and then clicking the `Upgrade Your Account` button.<br/><br/>

					*PayPal&reg; API Credentials* Once you have a PayPal&reg; Business account, you'll need access to your <a href='https://cms.paypal.com/us/cgi-bin/?&cmd=_render-content&content_ID=developer/e_howto_api_NVPAPIBasics#id084E30I30RO'>
					PayPal&reg; API Credentials</a>. Log into your PayPal&reg; account, 
					and navigate to Profile -> Request API Credentials. You'll choose ( PayPal&reg; API ), and then choose ( Create Your Own ). Once you've got your API Credentials, 
					come back and paste them into the fields below.";
    
    options::$fields['checkout']['post_title']          = array('type' => 'ni--title' , 'title' => __( 'PayPal&reg; Account Details ( required, if using PayPal&reg; )' , 'cosmotheme' ) );
    options::$fields['checkout']['general_hint']        = array('type' => 'st--hint' , 'value' => __( $general_hint , 'cosmotheme' ) );
    
    options::$fields['checkout']['paypal_email']        = array('type' => 'st--text' , 'label' => __( 'Your PayPal&reg; EMail Address' , 'cosmotheme' ) , 'hint' => __( 'Enter the email address you have associated with your PayPal&reg; Business account.' , 'cosmotheme' ) );
    options::$fields['checkout']['paypal_api_username'] = array('type' => 'st--text' , 'label' => __( 'Your PayPal&reg; API Username' , 'cosmotheme' ) , 'hint' => __( 'In your PayPal&reg; account, go to: Profile -> Request API Credentials.' , 'cosmotheme' ) );
    options::$fields['checkout']['paypal_api_password'] = array('type' => 'st--text' , 'label' => __( 'Your PayPal&reg; API Password' , 'cosmotheme' ) , 'hint' => __( 'In your PayPal&reg; account, go to: Profile -> Request API Credentials.' , 'cosmotheme' ) );
    options::$fields['checkout']['paypal_api_signature']= array('type' => 'st--text' , 'label' => __( 'Your PayPal&reg; API Signature' , 'cosmotheme' ) , 'hint' => __( 'In your PayPal&reg; account, go to: Profile -> Request API Credentials.' , 'cosmotheme' ) );
	options::$fields['checkout']['paypal_sandbox']      = array('type' => 'st--logic-radio' , 'label' => __( 'Enable Developer/Sandbox Testing?' , 'cosmotheme') , 'hint' => __( 'Only enable this if you have provided Sandbox credentials above. <br/> This puts the API, IPN, PDT and Form/Button Generators all into Sandbox mode.' , 'cosmotheme' ) );


	/*this must be placed at the end !!! Important!*/
	options::$register['cosmothemes']                   = options::$fields;  
?>
