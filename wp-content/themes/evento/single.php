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
            ?>
						<!-- social sharing -->
                        <?php get_template_part( 'social-sharing' ); ?>

						<div class="b w_940">
                            <h2 class="entry-title"><?php the_title(); ?></h2>
                        </div>

                        <!-- left sidebar -->
                        <?php layout::get_side( 'left' , $post_id , 'single' ); ?>

                        <!-- content -->
                        <div class="b w_<?php echo layout::get_length( $post_id , 'single' ); ?>">

                            <?php 
                                if( meta::logic( $post , 'settings' , 'meta' ) ){
                                    get_template_part( 'post-meta-top' );
                                }
                            ?>

                            <!-- post content -->
                            <?php
                                if( strlen( $post -> post_content . $post -> post_excerpt ) ){
                            ?>
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
                            ?>
                            <!-- bottom meta category , tags -->
                            <?php
                                if( meta::logic( $post , 'settings' , 'meta' ) ){
                                    get_template_part( 'post-meta-bottom' );
                                }
                            ?>

                            <!-- author box -->
                            <?php get_template_part( 'author-box' ); ?>

                            <!-- related posts -->
                            <?php get_template_part( 'related-posts' ); ?>

                            <!-- comments -->
                            <?php
                                if( comments_open() ){
                                    comments_template( '', true );
                                }
                            ?>
                        </div>
            <?php
                    }
                }else{
                    /* not found post */
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
                /* if is load requested post */
                layout::get_side( 'right' , $post_id , 'single' );
            }
        ?>
    </div>
</div>
<?php get_footer(); ?>