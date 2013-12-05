<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- Start content -->
    <div class="b_page clearfix">
        <div id="content">
            <!--left side-->
            <div <?php post_class( 'post' )?>>
            <?php
                if( have_posts() ){
                    while( have_posts()){
                        the_post();
                        $post_id = $post -> ID;
						if( $post -> post_title == 'Shopping cart' ){
							get_template_part( 'shopping_cart' );
						
                        }elseif( $post -> post_title == 'Registration' ){
            ?>
                            <div class="b w_940">
                                <h2 class="entry-title"><?php the_title(); ?></h2>
                            </div>

                            <?php layout::get_side( 'left' , $post -> ID , 'page' ); ?>

                            <div class="b w_<?php echo layout::get_length( $post -> ID , 'page' ); ?>">
								<p class="conference_info"><?php _e('This is the list of the upcoming events. Please register as guest for the desired conference.','cosmotheme') ?></p>
                                <?php my_account::conference(); ?>
                            </div>
            <?php
                        }else{
            ?>
                            <!-- basic wordpress page -->
                            <!-- title -->

                            <!-- social sharing -->
                            <?php get_template_part( 'social-sharing' ); ?>

                            <div class="b w_940">
                                <h2 class="entry-title"><?php the_title(); ?></h2>
                            </div>

                            <!-- left sidebar  -->
                            <?php layout::get_side( 'left' , $post -> ID , 'page' ); ?>

                            <!-- content  -->
                            <div class="b w_<?php echo layout::get_length( $post -> ID , 'page' ); ?>">

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

                                <!-- author box -->
                                <?php get_template_part( 'author-box' ); ?>

                                <!-- comments -->
                                <?php
                                    if( comments_open() ){
                                        comments_template( '', true );
                                    }
                                ?>
                            </div>
            <?php       }
                    }
                }else{
                    /* not found page */
                    $p404 = true;
                    get_template_part( 'loop' , '404' );
                }
            ?>
            </div>
        </div>

        <!-- right sidebar -->
        <?php
            if( isset( $p404 ) && $p404 ){
                /* if is load 404 page */
                layout::get_side( 'right' , 0 , '404' );
            }else{
                /* if is load requested page */
                layout::get_side( 'right' , $post_id , 'page' );
            }
        ?>
    </div>
</div>
<?php get_footer(); ?>