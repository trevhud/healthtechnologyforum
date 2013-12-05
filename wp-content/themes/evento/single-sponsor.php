<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- start content -->
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
                        <?php layout::get_side( 'left' , $post_id , 'sponsor' ); ?>

                        <!-- content -->
                        <div class="b w_<?php echo layout::get_length( $post_id , 'sponsor' ); ?>">
                            <!-- post content -->
                            <?php
                                if( strlen( $post -> post_content . $post -> post_excerpt ) ){
                            ?>
                                    <div class="b_text">
                                        <?php
                                            if( has_post_thumbnail ( $post -> ID ) ){
                                                $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
                                        ?>
                                              <ul class="sponsors images ul">
                                                <li>
                                                <div class="wp-caption alignleft circle">
                                                    <?php
                                                        ob_start();
                                                        ob_clean();
                                                        get_template_part( 'caption' );
                                                        $caption = ob_get_clean();
                                                    ?>
                                                    <a href="<?php echo $src[0]; ?>" title="<?php echo $caption; ?>" class="mosaic-overlay" rel="prettyPhoto-<?php echo $post -> ID; ?>">&nbsp;</a>
                                                    <?php the_post_thumbnail( '150xXXX' ); ?>
                                                    <?php
                                                        if( strlen( trim( $caption) ) ){
                                                    ?>
                                                            <p class="wp-caption-text"><?php echo $caption; ?></p>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                                </li>
                                            </ul>
                                        <?php
                                            }

										?>  
                                        <?php 
											the_content(); 
											$sponsor_info = meta::get_meta( $post_id, 'info' );
											if($sponsor_info['url'] != ''){
												echo '<p class="sponsor_link"><a href="'.$sponsor_info['url'].'">'.$sponsor_info['url'].'</a></p>';
											}
										?>
                                    </div>
                            <?php
                                }
                            ?>

							<!-- bottom meta category , tags -->
                            <?php
                                if( meta::logic( $post , 'settings' , 'meta' ) ){
                                    get_template_part( 'post-meta-bottom' );
                                }
                            ?>

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
                layout::get_side( 'right' , $post_id , 'sponsor' );
            }
        ?>
    </div>
</div>
<?php get_footer(); ?>