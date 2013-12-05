<?php get_header(); ?>
<div class="b_content clearfix" id="main">
    <!-- Start content -->
    <div class="b_page clearfix">
        <div id="content">
            <?php
                if( have_posts() ){
                    while( have_posts()){
                        the_post();
                        $post_id = $post -> ID;
            ?>
                        <div <?php post_class( 'post' )?>>
                            <!-- social sharing -->
							<?php 
								get_template_part( 'social-sharing' ); 
								
							?>
                            

                            <div class="b w_940">
                                <h2 class="entry-title"><?php the_title(); ?></h2>
                            </div>

                            <!-- left sidebar -->
                            <?php layout::get_side( 'left' , $post_id , 'speaker' ); ?>

                            <!-- content -->
                            <div class="b w_<?php echo layout::get_length( $post_id , 'speaker' ); ?>">

                                <!-- presentation content -->
                                <ul class="xoxo">
                                    <li class="widget">
                                        <div class="b_text">

                                            <!-- featured images and caption -->
                                            <?php
                                                if( strlen( $post -> post_content . $post -> post_excerpt ) || has_post_thumbnail( $post -> ID )  ){
                                                   
                                                ?>
                                                    <ul class="presentations speakers images ul">
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
                                                    	} /*EOF if( has_post_thumbnail ( $post -> ID ) ) */
                                                    	
	                                                    $info = meta::get_meta( $post -> ID , 'info' );
	                                                
			                                                if( !empty( $info ) && is_array( $info ) ){
			                                            ?>
			                                                    <li class="info">
			                                                        <strong><?php the_title(); _e("'s details","cosmotheme") ?></strong>
			                                                        <ul class="details">
			                                                            <?php
			                                                                echo isset( $info['country'] ) && !empty( $info['country'] ) ? '<li><span>' . __( 'Country' , 'cosmotheme' ) . ': </span>'  . $info['country'] . '</li>' : '';
			                                                                echo isset( $info['region'] ) && !empty( $info['region'] ) ? '<li><span>' . __( 'Region' , 'cosmotheme' ) . ': </span>' . $info['region'] . '</li>' : '';
			                                                                echo isset( $info['study'] ) && !empty( $info['study'] ) ? '<li><span>' . __( 'Title' , 'cosmotheme' ) . ': </span>' . $info['study'] . '</li>' : '';
			                                                                echo isset( $info['university'] ) && !empty( $info['university'] ) ? '<li><span>' . __( 'Company' , 'cosmotheme' ) . ': </span>' . $info['university'] . '</li>' : '';
			                                                                echo isset( $info['email'] ) && !empty( $info['email'] ) ? '<li><span>' . __( 'Email' , 'cosmotheme' ) . ': </span>' . $info['email'] . '</li>' : '';
			                                                            ?>
			                                                        </ul>
			                                                    </li>
			                                            <?php
			
			                                                }
			
			                                                $query = new WP_Query( 'post_type=presentation&post_status=publish&posts_per_page=-1' );
			
			                                                $presentations = array();
			
			                                                foreach( $query -> posts as $p ){
			                                                    $meta = meta::get_meta( $p -> ID , 'speaker' );
			                                                    foreach( $meta as $m ){
			                                                        if( (int)$m['idrecord'] == $post -> ID ){
			                                                            $presentations[] = $p -> ID;
			                                                        }
			                                                    }
			                                                }
			
			                                                if( !empty( $presentations ) ){
			                                            ?>
			                                                    <li class="speaker_pr">
			                                                        <strong><?php the_title();  _e("'s presentations","cosmotheme") ?> </strong>
			                                                        <ul>
			                                                            <?php
			                                                                foreach( $presentations as $key => $present ){
			                                                                    $presentation = get_post( $present );
			                                                            ?>
			                                                                    <li><a href="<?php echo get_permalink( $presentation -> ID ); ?>"><?php echo $presentation -> post_title ?></a></li>
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
                                                <div class="b_txt_content">
                                                    <?php the_content(); ?>
                                                </div>
                                              <!--   <ul class="presentations speakers images ul"> -->
                                            <?php

                                                }/* end content */

                                                
                                            ?>
                                       <!--  </ul> -->
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
                            <?php get_template_part( 'related-posts' );  ?>

                            <!-- comments -->
                            <?php
                                if( comments_open() ){
                                    comments_template( '', true );
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
                    layout::get_side( 'right' , $post_id , 'speaker' );
                }
            ?>
    </div>
</div>
<?php get_footer(); ?>