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
                        <?php layout::get_side( 'left' , $post_id , 'presentation' ); ?>

                        <!-- content -->
                        <div class="b w_<?php echo layout::get_length( $post_id , 'presentation' ); ?>">

                            <!-- presentation content -->
                            <ul class="xoxo">
                                <li class="widget">
                                    <div class="b_text">
                                        <!-- featured images and caption -->
                                        
                                              <ul class="presentations ul">
                                              	<?php
		                                            if( has_post_thumbnail ( $post -> ID ) ){
		                                                $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
		                                        ?>
                                                <li class="picture">
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
                                                <?php 
		                                        }  /*EOF if( has_post_thumbnail ( $post -> ID ) ) */
                                                ?>
                                                
		                                            <li class="pr_speaker">
		                                                <?php
	                                                    /* speakers */
	                                                    $speakers = meta::get_meta( $post -> ID , 'speaker' );
	
	                                                    if( is_array( $speakers ) && !empty( $speakers ) ){
															echo '<strong>' . __( 'Presentation speakers' , 'cosmotheme' ) . '</strong>';
	                                                        echo '<ul>';
	                                                        foreach( $speakers as $speaker ){
	                                                            
	                                                            $p      = get_post( $speaker['idrecord'] );
	                                                            $data   = meta::get_meta( $p -> ID , 'info');
	
	                                                            $study  = isset( $data['study'] ) && !empty( $data['study'] ) ? ', ' . $data['study'] : '';
	                                                            $univ   = isset( $data['university'] ) && !empty( $data['university'] ) ? ', ' . $data['university'] : '';
	
	                                                            echo '<li><a href="' . get_permalink( $p -> ID ) . '">'. $p -> post_title . '</a>' . $study . $univ . '</li>';
	                                                        }
	                                                        echo '</ul>';
	                                                    }
	                                                ?>
	
	                                            </li>
	                                            
	                                            <!-- Attached documents -->
	                                            <?php
	                                                $attch = meta::get_meta( $post -> ID , 'docs' );
	
	                                                if( is_array( $attch ) && !empty( $attch ) ){
	                                            ?>
	                                            <li class="download">
													<strong><?php _e( 'Download presentation' , 'cosmotheme' ); ?></strong>
	                                                <ul class="download">
	                                                    <?php
	                                                        foreach( $attch  as $a ){
	                                                    ?>
	                                                    <li><a href="<?php echo $a['url']; ?>"><?php echo basename( $a['url'] ); ?></a></li>
	                                                    <?php
	                                                        }
	                                                    ?>
	                                                </ul>
	                                            </li>
	                                            <?php
	                                                }
	                                            ?>
		                                        
                                            </ul>
                                        
                                        <!-- content -->
                                        <?php the_content(); ?>

                                        
                                    </div>
                                </li>
                            </ul>
             
							<!-- bottom meta category , tags -->
                            <?php
                                if( meta::logic( $post , 'settings' , 'meta' ) ){
                                    get_template_part( 'post-meta-bottom' );
                                }
                            ?>

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
                layout::get_side( 'right' , $post_id , 'presentation' );
            }
        ?>
    </div>
</div>
<?php get_footer(); ?>