<?php
	/* =============================== Latest Posts widget ======================================*/
class widget_latest_posts extends WP_Widget {

	function widget_latest_posts() {
	/*Constructor*/
		$widget_ops = array('classname' => 'widget_Latest_Posts ', 'description' => __( 'Latest Posts' , 'cosmotheme' ) );
		$this->WP_Widget('widget_cosmo_latestPosts', _TN_ . ' : ' . __( 'Latest Posts' , 'cosmotheme' ), $widget_ops);
	}
	
	function widget($args, $instance) {
        /* prints the widget*/
		extract($args, EXTR_SKIP);
        
		echo $before_widget;

		$title = empty($instance['title']) ? __('Latest Posts','cosmotheme') : apply_filters('widget_title', $instance['title']);
		$number = empty($instance['number']) ? 3 : apply_filters('widget_number', $instance['number']);

		echo $before_title . $title . $after_title;
?>
		
        <?php

            $recent = get_posts(array('orderby' => 'created', 'numberposts' =>$number ));  /*NOTE use settings*/
            if( is_array( $recent ) && !empty( $recent ) ){
                ?><ul class="latest-posts images"><?php
                foreach( $recent as $post )  {
                    if(get_post_thumbnail_id($post -> ID) ){
                        $post_img = wp_get_attachment_image(get_post_thumbnail_id($post -> ID),'62x62','' );
                    }else{
                        $post_img = "<img src=".get_template_directory_uri()."/images/no_image.jpg />";
                    }
        ?>
                    <li>
                        <a href="<?php  echo get_permalink($post -> ID); echo '#more'; ?>"><?php echo $post_img; ?></a>
                        <h6>
                            <a class="readmore" href="<?php echo get_permalink($post -> ID); echo '#more';?>">
                                <?php 
                                    echo mb_substr($post -> post_title , 0 , 50 );
                                    if( strlen($post->post_title) > 50 ) {
                                        echo ' ...';
                                    }
                                ?>
								<span class="mosaic-overlay">&nbsp;</span>
                            </a>
                            <span><?php echo get_the_time( 'F j, Y' , $post -> ID ); ?></span>
                            <span>
                                <?php 
                                    if ('open' == $post->comment_status) {
                                ?>
                                        <a href="<?php echo get_permalink( $post -> ID ) . '#comments' ; ?>" >
                                            <?php
                                                echo $post -> comment_count . ' ';
                                                if( $post->comment_count == 1 ) {
                                                    echo ' ' . __( 'Comment' , 'cosmotheme' );
                                                }else{
                                                    echo ' ' . __( 'Comments' , 'cosmotheme' );
                                                }
                                            ?>
                                        </a>
                                <?php
                                    }else{
                                ?>
                                        <span><?php _e( 'Comments Off' , 'cosmotheme' ); ?></span>
                                <?php 
                                    } 
                                ?>
                            </span>
                        </h6>
                    </li>
        <?php

                }
                ?></ul><?php
            }
            
            wp_reset_query();

            echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {

	/*save the widget*/
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		
		return $instance;
	}
	
	function form($instance) {
	/*widgetform in backend*/

		$instance = wp_parse_args( (array) $instance, array('title' => '',  'number' => '') );
		$title = strip_tags($instance['title']);
		$number = strip_tags($instance['number']);
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','cosmotheme') ?>: 
			    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts','cosmotheme') ?>:
		        <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
		    </label>
		</p>
<?php 		
		
		$title = strip_tags($instance['title']);
		$number = strip_tags($instance['number']);
	}	
}
?>