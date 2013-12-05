<?php
    class widget_conferences extends WP_Widget{
        function widget_conferences() {
            $options = array( 'classname' => 'conferences  images', 'description' => __('Display list of Events' , 'cosmotheme' ) );
            parent::WP_Widget( false , _TN_ . ' : ' . __( 'Events list' , 'cosmotheme' )  , $options );

        }

        function form($instance) {
            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = __( 'Events' , 'cosmotheme' );
            }

            if( isset( $instance['conference'] ) ){
                $type = $instance['conference'] ;
            }else{
                $type = '';
            }

			if( isset( $instance['category'] ) ){
				$category=$instance['category'];
			}else{
				$category="";
			}

            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'];
            }else{
                $nr = 2;
            }
            
        	if( isset( $instance['show_images'] ) ){
                $show_images = $instance['show_images'] ;
            }else{
                $show_images = 'true';
            }
        ?>
         <p>
          <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e( 'Title' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this -> get_field_id('conference'); ?>"><?php _e( 'Select Conference' , 'cosmotheme' ); ?>:</label>
          <select class="widefat " id="<?php echo $this -> get_field_id( 'conference' ); ?>" name="<?php echo $this->get_field_name('conference'); ?>" onchange="if(jQuery(this).find('option:selected').val() == 'latest'){jQuery('.nr_events').addClass('hidden')}else{jQuery('.nr_events').removeClass('hidden')}">
              <option value="">Please select event</option>
              <option value="latest" <?php if( $type == 'latest' ) {echo 'selected="selected"';} ?> >Latest event</option>
              <option value="all" <?php if($type == 'all' ) {echo 'selected="selected"';} ?>>As list</option>
              
          </select>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('category');?>"><?php _e( 'Select category', 'cosmotheme' );?>:</label>
			<select class="widefat" id="<?php echo $this->get_field_id('category');?>" name="<?php echo $this->get_field_name('category');?>">
				<option value="">select category</option>
				<?php
					$terms=get_terms(options::get_taxonomy( 'conference' , 'category' ) );
					if( is_array($terms) && count( $terms )>0 ){
						foreach( $terms as $term ){
							if( $category == $term->term_id ){
								echo '<option value="'.$term->term_id.'" selected="selected">'.$term->name.'</option>';
							}else{
								echo '<option value="'.$term->term_id.'">'.$term->name.'</option>';
							}
						}
					}
				?>
			</select>
		</p>
        <!-- field for set limit  -->
        <p class="nr_events <?php if(isset($instance['conference']) && $instance['conference'] == 'latest') {echo 'hidden';} ?> ">
          <label for="<?php echo $this -> get_field_id('nr'); ?>"><?php _e( 'Number of events to display' , 'cosmotheme' ); ?>:</label>
          <input class="widefat digit" id="<?php echo $this -> get_field_id('nr'); ?>" name="<?php echo $this->get_field_name('nr'); ?>" type="text" value="<?php echo $nr; ?>" />
        </p>

		<!-- field for show / hide excerpt  -->
        <p>
          <?php
            if( 'true' ==  $show_images ){
                $c = 'checked="checked"';
            }else{
                $c = '';
            }
        ?>
          <label for="<?php echo $this -> get_field_id('show_images'); ?>">
              <input type="checkbox"  id="<?php echo $this -> get_field_id( 'show_images' ); ?>" value="true" <?php echo $c; ?> name="<?php echo $this->get_field_name('show_images'); ?>" />
              <?php _e( 'Show images' , 'cosmotheme' ); ?>
          </label>

        </p>
        <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']      = strip_tags( $new_instance['title'] );
            $instance['conference'] = strip_tags( $new_instance['conference'] );
			$instance['category'] = strip_tags( $new_instance['category'] );
            $instance['nr']         = strip_tags( $new_instance['nr'] );
            $instance['show_images']         = strip_tags( $new_instance['show_images'] );
            
            return $instance;
        }

        function widget($args, $instance) {

            extract( $args );

            /* widget title */
            if( !empty( $instance['title'] ) ){
               $title = apply_filters('widget_title', $instance['title']);
            }else{
               $title = '';
            }

            /* id of conference */
            if( isset( $instance['conference'] ) ){
                $type = $instance['conference'];
            }

			if( isset( $instance['category'] ) ){
				$category = $instance['category'];
			}else{
				$category=false;
			}

            /* limit number */
            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'];
            }else{
                $nr = 2;
            }

            

            /* if show excerpt */
            if( isset( $instance['show_images'] ) ){
                $show_images = (bool)$instance['show_images'];
            }else{
                $show_images = true;
            }

            echo $before_widget;

            if ( strlen( $title ) ) {
                    echo $before_title . $title . $after_title;
            }

            if(  $type != '' ){
                echo conference::get_conferences( $type , $nr , $show_images, $category );
                
            }else{
                echo '<p class="select">' . __( 'Please select listing type' , 'cosmotheme' ) . '</p>';
            }

            echo $after_widget;
        }
    }
?>