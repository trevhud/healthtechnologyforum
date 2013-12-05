<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- Start content -->
    <div class="b_page clearfix">
        <div id="content">
        <?php
            if( have_posts() ){
                while( have_posts()){
                    the_post();
        ?>

                    <div class="b w_940">
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                    </div>

                    <!-- left sidebar -->
                    <?php layout::get_side( 'left' , 0 , 'category' ); ?>

                    <div class="b w_<?php echo layout::get_length( 0 , 'attachment' ); ?> attachment">
                
                        <div <?php post_class('post'); ?>>
                            <!-- post meta -->
                            <?php get_template_part( 'post-meta-top' ); ?>

                            <!-- social sharing -->
                            <?php get_template_part( 'social-sharing' ); ?>
                            
                            <!-- featured images -->
                            <?php
                                $src = wp_get_attachment_image_src(  $post -> ID , 'full' );
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
                                    <?php echo wp_get_attachment_image( $post -> ID , 'full' ); ?>
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

                            <!-- excerpt content -->
                            <?php the_excerpt(); ?>
                            <?php
                                if( options::logic( 'blog_post' , 'attachment_comments' ) ){
                                    comments_template( '' , true );
                                }
                            ?>
                        </div>
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
        
        <!-- right sidebar -->
        <?php
            if( isset( $p404 ) && $p404 ){
                /* if is load 404 page */
                layout::get_side( 'right' , 0 , '404' );
            }else{
                /* if is load requested post */
                layout::get_side( 'right' , 0 , 'attachment' );
            }
        ?>

    </div>
</div>
<?php get_footer(); ?>