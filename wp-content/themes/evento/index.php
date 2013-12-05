<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- start content -->
    <div class="b_page clearfix">
        <div id="content">
            <div class="b w_940">
                <h2 class="page-title category"><?php _e( 'Health Technology Forum Blog' , 'cosmotheme' ); ?></h2>
            </div>

            <!-- left sidebar -->

            <?php layout::get_side( 'left' , get_option('page_for_posts') , 'blog_page' );  ?>
            
            <div class="b w_<?php echo layout::get_length( 0 , 'blog_page' ); ?> category">
                <?php
                    if( have_posts() ){
						$k = 0;  
                        while( have_posts()){
                            the_post();
                ?>
                            <div <?php post_class('post'); ?>>
								<?php
									if( $k > 0 ){
								?>
										<p class="delimiter">&nbsp;</p>
								<?php
									}

									$k++;
								?>
                                <!-- featured images -->
                                <?php
                                    if( has_post_thumbnail ( $post -> ID ) ){
                                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
                                ?>
                                        <div class="featimg circle">
                                            <div class="img">
                                                <?php
                                                    ob_start();
                                                    ob_clean();
                                                    get_template_part( 'caption' );
                                                    $caption = ob_get_clean();
                                                ?>
                                                <a href="<?php echo $src[0]; ?>" title="<?php echo $caption;  ?>" class="mosaic-overlay" rel="prettyPhoto-<?php echo $post -> ID; ?>">&nbsp;</a>
                                                <?php the_post_thumbnail( '600x200' ); ?>
                                                <?php
                                                    if( strlen( trim( $caption) ) ){
                                                ?>
                                                        <p class="wp-caption-text"><?php echo $caption; ?></p>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="end">&nbsp;</div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title()?>"><?php the_title()?></a></h3>
                                <!-- post meta -->
                                <?php get_template_part( 'post-meta-top' ); ?>

                                <!-- excerpt content -->
                                <?php the_excerpt(); ?>

                                <!-- read more button -->
                                <p class="button readmore hover "><a href="<?php the_permalink(); ?>"><?php _e( 'Continue reading' , 'cosmotheme' ); ?><span>&nbsp;</span></a></p>
                            </div>
                <?php
                        }
                        get_template_part( 'pagination' );
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
                layout::get_side( 'right' , get_option('page_for_posts') , 'blog_page' );
            }
        ?>

    </div>
</div>

<?php get_footer(); ?>