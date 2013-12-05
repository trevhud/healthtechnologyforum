<?php get_header(); ?>
<div class="b_content clearfix" id="main">

    <!-- start content -->
    <div class="b_page clearfix">
        <div id="content">
            <div class="b w_940">
                <h2 class="page-title search"><?php _e( 'Search results' , 'cosmotheme' ); ?></h2>
            </div>

            <!-- left sidebar -->
            <?php layout::get_side( 'left' , 0 , 'search' ); ?>
            
            <div class="b w_<?php echo layout::get_length( 0 , 'search' ); ?> category">
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
                ?>
                        <!-- search results not found post -->
                        <!-- title -->
                        <div class="b w_940">
                            <h3 class="entry-title">
                                <?php _e( 'Sorry, no results found.' , 'cosmotheme' ); ?>
                            </h3>
                        </div>

                        <!-- left sidebar -->
                        <?php layout::get_side( 'left' , 0 , 'search' ); ?>

                        <!-- content -->
                        <div class="b w_<?php echo layout::get_length( 0 , 'search' ); ?>">
                            <div class="b_text">
                                <?php
                                    _e( 'Unfortunately we did not find any results for your request.' , 'cosmotheme' );
                                ?>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>

        <!-- right sidebar -->
        <?php layout::get_side( 'right' , 0 , 'search' ); ?>
    </div>
</div>

<?php get_footer(); ?>