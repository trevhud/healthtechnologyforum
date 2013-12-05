<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- Start content -->
    <div class="b_page clearfix">
        <div id="content">
            <!--left side-->
            <div <?php post_class( 'post' )?>>
                <?php
                    if( have_posts () ) {
                        /*the_post();*/
                ?>
                        <!-- social sharing -->
                        <?php get_template_part( 'social-sharing' ); ?>

                        <div class="b w_940">
                            <h2 class="entry-title page_title"><?php printf( __( 'Author Archives: %s', 'cosmotheme' ), "<span class='vcard'><a class='url fn n' href='' title='" . esc_attr( get_the_author_meta( 'display_name' , $post-> post_author ) ) . "' rel='me'>" . get_the_author_meta( 'display_name' , $post-> post_author ) . "</a></span>" ); ?> </h2>	
                        </div>

                        <!-- left sidebar -->
                        <?php layout::get_side( 'left' , 0 , 'author' ); ?>

                        <!-- content -->
                        <div class="b w_<?php echo layout::get_length( 0 , 'author' ); ?>">
                            <!-- post content -->
                            <div class="box-author clearfix">
								<a href="<?php echo get_author_posts_url( $post -> post_author) ?>"><?php echo get_avatar( $post -> post_author , $size = '60', $default = DEFAULT_AVATAR );  ?></a>
								<h3>
									<?php
										$author_bio = get_the_author_meta( 'description' , $post -> post_author );

										if( $author_bio != '' ){
											echo '<span class="author-page">' . $author_bio . '</span>';
										}
									?>
								</h3>
							</div>
								<?php
										
										while( have_posts()){
											the_post();
								?>
											
											<div <?php post_class('post'); ?>>
													<p class="delimiter">&nbsp;</p>
												 
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
							?>
							</div>			
							<?php 					    
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
                layout::get_side( 'right' , 0 , 'author' );
            }
        ?>
    </div>
</div>
<?php get_footer(); ?>