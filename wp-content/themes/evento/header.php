<?php
	$fb_id = options::get_value( 'social' , 'facebook' );
    if( strlen( trim( $fb_id ) ) ){
        $fb['likes'] = social::pbd_get_transient($name = 'facebook',$user_id=$fb_id,$cacheTime = 120); /*cache - in minutes*/
        $fb['link'] = 'http://facebook.com/people/@/'  . $fb_id ;
    } 
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="robots"  content="index, follow"/>
        <title><?php bloginfo('name'); ?> &raquo; <?php bloginfo('description'); ?><?php if ( is_single() ) { ?><?php } ?><?php wp_title(); ?></title>

        <?php
            if( strlen( options::get_value( 'general' , 'favicon' ) ) ){
                $path_parts = pathinfo( options::get_value( 'general' , 'favicon' ) );
                if( $path_parts['extension'] == 'ico' ){
        ?>
                    <link rel="shortcut icon" href="<?php echo options::get_value( 'general' , 'favicon' ); ?>" />
        <?php
                }else{
        ?>
                    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
        <?php
                }
            }else{
        ?>
                <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
        <?php
            }
        ?>
        
        <link rel="profile" href="http://gmpg.org/xfn/11" />

        <!-- ststylesheet -->
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
        <link href='http://fonts.googleapis.com/css?family=Oswald&v2' rel='stylesheet' type='text/css'>			

        <?php if( options::get_value( 'general' , 'logo_type' ) == 'text' ) { ?>
        	<link href='http://fonts.googleapis.com/css?family=<?php  echo str_replace(' ' , '+' , trim( options::get_value( 'general' , 'logo_font_family' ) ) );?>' rel='stylesheet' type='text/css' />
        <?php } ?>

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/lib/css/shortcode.css" />

        <!-- javascript -->
        <?php 
			 wp_enqueue_script( "jquery" );	
			 if ( is_singular() ){ wp_enqueue_script( "comment-reply" ); } 
		?>
        
        <?php wp_head(); ?>
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.hoverIntent.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.superfish.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.supersubs.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mosaic.1.0.1.min.js" type="text/javascript" ></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.lightbox.js" type="text/javascript" ></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/slides.min.jquery.js" type="text/javascript" ></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/settings.slider.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/mobilyblocks.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.tipsy.js" type="text/javascript"></script> <!--Tooltips-->
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/prettyPhoto.settings.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.tabs.pack.js" type="text/javascript"></script>



		<script src="<?php echo get_template_directory_uri(); ?>/js/functions.js" type="text/javascript"></script>
        
        <script src="<?php echo get_template_directory_uri(); ?>/lib/js/meta.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/lib/js/actions.js" type="text/javascript"></script>
		<!---Twitter --->
		<!--
		<script src="<?php //echo get_template_directory_uri(); ?>/js/jquery.jtweetsanywhere-1.2.1.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="<?php //echo get_template_directory_uri(); ?>/css/jquery.jtweetsanywhere-1.2.1.css" />
-->

        <!-- init ajaxurl -->
        <script type="text/javascript">
            var SL_BUTTONS      = <?php echo options::get_value('slider' , 'buttons'); ?>;
            var SL_PAGINATION   = false;
            var SL_SLIDESPEED   = <?php echo options::get_value('slider' , 'slidespeed'); ?>;
            var SL_PLAYSPEED    = <?php echo options::get_value('slider' , 'playspeed'); ?>;
            var SL_EFFECT       = '<?php echo options::get_value('slider' , 'effect'); ?>';
            var SL_RANDOMIZE    = <?php echo options::get_value('slider' , 'randomize'); ?>;
            var SL_PAUSE        = <?php echo options::get_value('slider' , 'pause'); ?>;
            <?php
                $siteurl = get_option('siteurl');
                if( !empty($siteurl) ){
                    $siteurl = rtrim( $siteurl , '/') . '/wp-admin/admin-ajax.php' ;
                }else{
                    $siteurl = home_url('/wp-admin/admin-ajax.php');
                }
            ?>

            var ajaxurl = "<?php echo $siteurl; ?>";
        </script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36621891-1']);
  _gaq.push(['_setDomainName', 'healthtechnologyforum.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

		<?php if( options::get_value( 'general' , 'logo_type' ) == 'text' ) { 
			$logo_font_family = explode('&',options::get_value('general' , 'logo_font_family'));
			$logo_font_family = $logo_font_family[0];
			$logo_font_family = str_replace( '+',' ',$logo_font_family ); 
		?>	
			<style type="text/css">
				div.logo h1 a {
					font-family: '<?php  echo $logo_font_family ?>', arial, serif !important;
					font-size: <?php  echo options::get_value('general' , 'logo_font_size')?>px;
                    font-weight: <?php  echo options::get_value('general' , 'logo_font_weight')?>;
				}
			</style>
		 <?php } ?>
    </head>
    <?php
        if( options::logic( 'styling' , 'boxed' ) ){
            $classes = 'larger';
        }else{
            $classes = '';
        }

		$pattern = explode( '.' , options::get_value( 'styling' , 'background' ) ) ; 
        
		if(count( $pattern  ) > 1){
			if( (isset( $pattern[ count( $pattern ) - 1 ] ) && $pattern[ count( $pattern ) - 2 ] == 'none') || get_background_image() != '' ){
				$background_img = '';
			}else{
				$background_img = "; background-image: url(" . str_replace( 's.pattern.' , 'pattern.' , options::get_value( 'styling' , 'background' ) ) . ")";

			}	
        }else{
            $background_img = ''; 

        }
    ?>
<body <?php body_class( $classes ); ?> style="background-color:<?php echo options::get_value( 'styling' , 'background_color' ); ?> <?php echo $background_img; ?>;">
    
	<div class="b_body" id="wrapper" >
		<div class="b_body_c">
			<!--start header -->
			<div class="b_head clearfix" id="header">
				<div class="b_page clearfix">
					<div class="branding">
						<!-- logo -->
						<div class="logo b w_960">
							<?php if( options::get_value( 'general' , 'logo_type' ) == 'text' ) { ?>
								<h1><a href="<?php echo home_url(); ?>" class="hover"><?php bloginfo('name'); ?> <span><?php bloginfo('description'); ?></span></a></h1>
							<?php }elseif(options::get_value( 'general' , 'logo_type' ) == 'image' && options::get_value( 'general' , 'logo_url' ) == '' ){ ?>
								<h1>
									<a href="<?php echo home_url(); ?>" class="hover"> 
										<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" /> 
									</a>
								</h1>
							<?php }else{?>
								<h1>
									<a href="<?php echo home_url(); ?>" class="hover"> 
										<img src="<?php echo options::get_value( 'general' , 'logo_url' ) ?>" > 
									</a>
								</h1>
							<?php } ?>
						</div>
						<!-- social links -->
						<div class="cosmo-social cosmo-icons b w_620">
							<div class="fr">
                                <?php
                                    if( isset( $fb ) && is_array( $fb ) && !empty( $fb ) && isset( $fb['link'] ) ){
                                ?>
                                        <a href="<?php echo $fb['link']; ?>" target="_blank" class="fb hover-menu"><span id="facebook"><?php echo $fb['likes']; ?></span></a>
                                <?php
                                    }

                                    if( strlen( options::get_value( 'social' , 'twitter' ) ) ){
                                        $nr_tweets = tweets::followers_count(options::get_value( 'social' , 'twitter' ))
                                ?>
                                        <a href="http://twitter.com/<?php echo options::get_value( 'social' , 'twitter' ) ?>" target="_blank" class="twitter hover-menu"><span><?php echo $nr_tweets; ?></span></a>
                                <?php
                                    }
                                    $query = new WP_Query('status=public');
                                    wp_reset_query();
                                ?>
                                <a href="<?php bloginfo('rss2_url'); ?>" class="rss hover-menu"><span><?php echo $query -> found_posts ; ?></span></a>
							</div>
						</div>
                        <!--  search form -->
						<div class="searchform b w_300">
							<?php get_template_part( 'searchform' ); ?>
						</div>
						<div class="headarea">
							<?php get_sidebar( 'headarea' ); ?>
						</div>
					</div>
				</div>
				<div class="b_page z-index clearfix">
					<div class="<?php if(options::logic( 'general' , 'site_registration' ) || options::logic( 'general' , 'site_login_frontend' )) {echo 'b w_700';} else{echo 'b w_940'; } ?>">
						<?php
							$shopping_cart_page = get_page_by_title( 'Shopping cart' );
							$registration_page = get_page_by_title( 'Registration' ); 
							echo menu( 'header_menu' , array( 'class' => 'cosmo-menu sf-menu' ,'exclude' => array($shopping_cart_page->ID,$registration_page->ID), 'number-items' => options::get_value( 'menu' , 'header' )  , 'current-class' => 'active' ) ); 
						?>
					</div>
					<?php if(options::logic( 'general' , 'site_registration' ) || options::logic( 'general' , 'site_login_frontend' )) { ?>
					<div class="b w_220 fr">
						<ul class="cosmo-menu cosmo-icons fr">
                            <?php
                                if( is_user_logged_in () ){
                                    $myacc = get_page_by_title( 'Registration' );
                            ?>
								<?php if(options::logic( 'general' , 'site_registration' ) ){ ?>   	
									<li><a href="<?php echo get_permalink( $myacc -> ID ); ?>" class="login hover-menu"><span><?php _e( 'Register' , 'cosmotheme' ); ?></span></a></li>
								<?php } ?>
								<?php if(options::logic( 'general' , 'site_login_frontend' ) ){ ?>   
									<li><a href="<?php echo wp_logout_url( home_url() ); ?>" class="hover-menu"><?php _e( 'Logout' , 'cosmotheme' ); ?></a></li>
								<?php } ?>
                            <?php 
                                }else{
                            ?>
								<?php if(options::logic( 'general' , 'site_login_frontend' ) ){ ?>   
									<li><a href="#" id="login" class="simplemodal-login login hover-menu"><span><?php _e( 'Log in' , 'cosmotheme' ); ?></span></a></li>
								<?php } ?>
								
                            <?php 
                                }
                            ?>
						</ul>
					</div>
					<?php } /*EOF if ...*/ ?>

					<!--signup form-->
					<?php
                        /*if( !is_user_logged_in () ){
                            get_template_part( 'signup' );
                        }*/
                    ?>
				</div>
                <!-- slideshow -->
                <?php get_template_part( 'slideshow' ); ?>
			</div><!-- end header-->
			
			<?php if(!is_front_page() ) get_template_part( 'breadcrumbs' ); ?>