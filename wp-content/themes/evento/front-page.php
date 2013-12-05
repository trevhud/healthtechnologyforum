<?php get_header(); ?>
<!-- start main -->


<div class="b_content clearfix" id="main">
    <!-- content -->

<?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?>
    <?php
        if( options::get_value( 'front_page' , 'resources' ) == 'conference' ){
    ?>
            <!-- selected conference -->
            <div class="b_page clearfix">
                <div class="b w_620">
                    <?php
                    if(options::get_value( 'front_page' , 'event' ) == 0){
                        $args = array( 'post_type' => 'conference' , 'posts_per_page' => 1 );
                    }else{
                        $args = array( 'post_type' => 'conference' , 'posts_per_page' => 1 , 'p' => options::get_value( 'front_page' , 'event' ));
                    }
                    $query = new WP_Query( $args );

                    if( $query ->have_posts() ){
                        foreach( $query -> posts as $post ){
                            $query -> the_post();
                            $post_id = $post -> ID;
                            echo '<h3 class="entry-title"> '.$post -> post_title.'</h3>';
                            if( strlen( $post -> post_excerpt ) ){
                                the_excerpt();
                            }else{
                                ob_start();
                                ob_clean();
                                the_content();
                                echo '<p>' . mb_substr( strip_tags( ob_get_clean() ) , 0 , options::get_value( 'front_page' , 'conf_limit' ) ) . '</p>';
                            }



                            echo '<p class="button hover readmore margin15">';
                            echo '<a href="' . get_permalink( $post -> ID ) . '">' . __( 'continue reading' , 'cosmotheme') . '<span>&nbsp;</span></a>';
                            echo '</p>';
                        }

                    }else{
                        _e( 'Sorry, no conferences found' , 'cosmotheme' );
                    }

                    wp_reset_query();
                ?>

                </div>
                <div class="b w_300">
                    <ul class="xoxo">
                        <?php get_sidebar('register'); ?>
                    </ul>
                </div>
            </div>
    <?php
        }else{
            /* sidebar */
            ob_start();
            ob_clean();
            get_sidebar( 'register' );
            $sidebar_register = trim( ob_get_clean() );


    ?>
            <!--  selected page -->
            <div class="b_page clearfix">
                <div id="content">
                    <div class="b w_<?php if( !empty( $sidebar_register ) ){ echo '620'; }else{ echo '940'; } ?>">
                        <div <?php post_class( 'post' )?>>
                        <?php

                            $wp_query = new WP_Query(array( 'page_id' => options::get_value( 'front_page' , 'page' ) ) );

                            if( $wp_query -> post_count > 0 ){
                                foreach( $wp_query -> posts as $post ){
                                    $wp_query -> the_post();
                                    $post_id = $post -> ID;
                        ?>
                                    <!-- social sharing -->
                                    <?php get_template_part( 'social-sharing' ); ?>

                                    <h2 class="entry-title"><?php the_title(); ?></h2>

                                    <!-- post meta -->
                                    <?php
                                        if( meta::logic( $post , 'settings' , 'meta' ) ){
                                            get_template_part( 'post-meta-top' );
                                        }
                                    ?>

                                    <!-- post content-->
                                    <ul class="xoxo">
                                        <li class="widget">
                                            <div class="b_text">
                                                <?php the_content(); ?>
                                                <?php wp_link_pages(); ?>
                                            </div>
                                        </li>
                                    </ul>
                        <?php
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <?php 
                    if( !empty( $sidebar_register ) ){
                ?>
                        <div class="b w_300">
                            <ul class="xoxo">
                                <?php echo $sidebar_register ?>
                            </ul>
                        </div>
                <?php
                    }
                ?>
            </div>

    <?php
        }
    ?>
    <p class="delimiter">&nbsp;</p>

    <div class="b_page clearfix">
        <div class="b w_300">
            <ul class="xoxo">
                <?php get_sidebar( 'front-top-left' ); ?>
            </ul>
        </div>
        <div class="b w_300">
            <ul class="xoxo">
                <?php get_sidebar( 'front-top-middle' ); ?>
            </ul>
        </div>
        <div class="b w_300">
            <ul class="xoxo">
                <?php get_sidebar( 'front-top-right' ); ?>
            </ul>
        </div>
    </div>
    <?php
        ob_start();
        ob_clean();
		get_sidebar( 'front-bottom-left' );
        $bottom_left = ob_get_clean(); 

		ob_start();
        ob_clean();
        get_sidebar( 'front-bottom-middle' );
		$bottom_middle = ob_get_clean(); 

		ob_start();
        ob_clean();
        get_sidebar( 'front-bottom-right' );
		$bottom_right = ob_get_clean();

        if( strlen( $bottom_left ) || strlen( $bottom_middle ) || strlen( $bottom_right ) ){


    ?>
            <p class="delimiter">&nbsp;</p>

            <div class="b_page clearfix">
                <div class="b w_300">
                    <ul class="xoxo">
                        <?php echo $bottom_left; //get_sidebar( 'front-bottom-left' ); ?>
					</ul>
                </div>
                <div class="b w_300">
                    <ul class="xoxo">
                        <?php echo $bottom_middle; //get_sidebar( 'front-bottom-middle' ); ?>
                    </ul>
                </div>
                <div class="b w_300">
                    <ul class="xoxo">
                        <?php echo $bottom_right //get_sidebar( 'front-bottom-right' ); ?>
                    </ul>
                </div>
            </div>
    <?php
        }
    ?>
</div>

<?php get_footer(); ?>