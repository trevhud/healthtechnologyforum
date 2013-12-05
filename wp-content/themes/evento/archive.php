<?php get_header(); ?>
<div class="b_content clearfix" id="main">
<?php 
	$qwe = array('speaker',/*'battlecamps',*/ 'presentation','testimonial','exhibitor','sponsor','slideshow','exhibitor');
	if(is_post_type_archive($qwe)){
		$show_featured_image = false;
	}else{
		$show_featured_image = true;	
	} 
?>
    <!-- Start content -->
    <div class="b_page clearfix">
        <div id="content">
            <div class="b w_940">
                
				<?php if ( is_day() ) : ?>
				<?php printf( __( '<h2 class="entry-title page-title archive">Daily Archives: <span>%s</span></h2>', 'cosmotheme' ), get_the_date() ); ?>
				<?php elseif ( is_month() ) : ?>
							<?php printf( __( '<h2 class="entry-title page-title archive">Monthly Archives: <span>%s</span></h2>', 'cosmotheme' ), get_the_date( 'F Y' ) ); ?>
				<?php elseif ( is_year() ) : ?>
							<?php printf( __( '<h2 class="entry-title page-title archive">Yearly Archives: <span>%s</span></h2>', 'cosmotheme' ), get_the_date( 'Y' ) ); ?>
				<?php elseif ( is_post_type_archive('speaker') ) : ?>
							<?php _e( '<h2 class="entry-title ">Speakers</h2>', 'cosmotheme' ); ?>
				<?php elseif ( is_post_type_archive('presentation') ) : ?>
							<?php _e( '<h2 class="entry-title ">Presentations</h2>', 'cosmotheme' ); ?>
				<?php elseif ( is_post_type_archive('conference') ) : ?>
							<?php _e( '<h2 class="entry-title ">Conferences</h2>', 'cosmotheme' ); ?>				
				<?php elseif ( is_post_type_archive('testimonial') ) : ?>
							<?php _e( '<h2 class="entry-title ">Testimonials</h2>', 'cosmotheme' ); ?>	
				<?php else : ?>
							<?php //_e( '<h2 class="entry-title page-title archive">Blog Archives</h2>', 'cosmotheme' ); ?>
				<?php endif; ?>
            </div>
            <!-- left sidebar -->
            <?php layout::get_side( 'left' , 0 , 'archive' ); ?>

            <div class="b w_<?php echo layout::get_length( 0 , 'archive' ); ?> category">
                <?php
                	$custom_archive = array('speaker',  'presentation','testimonial','exhibitor','sponsor'); 
                	
                    if( have_posts() ){
                        $k = 0;
	                    if(is_post_type_archive($custom_archive)){
	                    	echo '<ul class="xoxo">';
                            echo '<li class="widget">';
                            echo '<div class="b_text">';
	                    	
	                		echo '<ul class="sponsors images ul shortcodes">';
	                	}				
                        while( have_posts() ){
                            the_post();
                ?>
                	<?php if(!is_post_type_archive($custom_archive)){ ?>
                			
                            <div <?php post_class('post'); ?>>
                    <?php } ?>         
								<?php
									if( $k > 0 && !is_post_type_archive($custom_archive)){
								?>
										<p class="delimiter">&nbsp;</p>
								<?php
									}

									$k++;
								?>
                                <!-- featured images -->
                                <?php
                                if(is_post_type_archive($custom_archive)){
                                	get_template_part( 'archive_custom' );
                                }else{	
                                    if( has_post_thumbnail ( $post -> ID ) && $show_featured_image){
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
                                <?php if(!is_post_type_archive('battlecamps') || $post->post_content != ''){ ?>
                                	<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title()?>"><?php the_title()?></a></h3>
                                <?php }else{ ?>
                                	<h3 class="entry-title"><?php the_title()?></h3>
                                <?php } ?>	
                                <!-- post meta -->
                                <?php get_template_part( 'post-meta-top' ); ?>

                                <!-- excerpt content -->
                                <?php the_excerpt(); ?>

                                <!-- read more button -->
                                <?php 
                                	$continue_reading_txt = __( 'Continue reading' , 'cosmotheme' );
                                ?>
                                
                                <p class="button readmore hover "><a href="<?php the_permalink(); ?>"><?php echo $continue_reading_txt; ?><span>&nbsp;</span></a></p>
                                <?php  
                        		} /*EOF is_post_type_archive($custom_archive)*/
                                ?>	
                        <?php if(!is_post_type_archive($custom_archive)){ ?>        
                            </div>
                        <?php } ?>    
                <?php
						
                        }
	                    if(is_post_type_archive($custom_archive)){
	                		echo '</ul >'; /*EOF class="sponsors images ul shortcodes"*/
	                		echo '</div>';
                            echo '</li>';
                            echo '</ul>';
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
                layout::get_side( 'right' , 0 , 'archive' );
            }
        ?>

    </div>
</div>

<?php get_footer(); ?>