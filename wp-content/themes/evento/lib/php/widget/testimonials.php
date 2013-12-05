<?php
    class widget_testimonials extends WP_Widget{
        function widget_testimonials() {
            $options = array( 'classname' => 'testimonials', 'description' => __('Display Testimonials from a Conference' , 'cosmotheme' ) );
            parent::WP_Widget( false , _TN_ . ' : ' . __( 'Conference testimonials' , 'cosmotheme' )  , $options );

        }

        function form($instance) {

            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = __( 'Conference testimonials' , 'cosmotheme' );
            }

            if( isset( $instance['conference'] ) ){
                $conf_id = $instance['conference'] ;
            }else{
                $conf_id = '';
            }

            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'];
            }else{
                $nr = 3;
            }
            
        ?>
        <p>
          <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e( 'Title' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
          <label for="<?php echo $this -> get_field_id('conference'); ?>"><?php _e( 'Select Conference' , 'cosmotheme' ); ?>:</label>
          <select class="widefat" id="<?php echo $this -> get_field_id( 'conference' ); ?>" name="<?php echo $this->get_field_name('conference'); ?>" >
              <option value="">select conference</option>
              <?php
                $conferences = get__posts( array( 'post_type' => 'conference','numberposts' => -1 )  , '' );

                foreach( $conferences as $index => $conference ){
                    if( $index ==  $conf_id ){
                        echo '<option value="' . $index . '" selected="selected">' . $conference . '</option>';
                    }else{
                        echo '<option value="' . $index . '">' . $conference . '</option>';
                    }
                }
              ?>
          </select>
        </p>

        <!-- field for set limit  -->
        <p>
          <label for="<?php echo $this -> get_field_id('nr'); ?>"><?php _e( 'Number of testimonials to display' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this -> get_field_id('nr'); ?>" name="<?php echo $this->get_field_name('nr'); ?>" type="text" value="<?php echo $nr; ?>" />
        </p>
       
        <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']      = strip_tags($new_instance['title']);
            $instance['conference'] = strip_tags($new_instance['conference']);
            $instance['nr']         = strip_tags( $new_instance['nr'] );
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
                $conf_id = $instance['conference'];
            }

            /* limit number */
            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'];
            }else{
                $nr = 3;
            }

            echo $before_widget;

            if ( strlen( $title ) ) {
                    echo $before_title . $title . $after_title;
            }

            if( (int) $conf_id > 0 ){
                /* list with presentations */
                echo conference::get_testimonials( $conf_id , $nr );
                
            }else{
                echo '<p class="select">' . __( 'Please select Conference' , 'cosmotheme' ) . '</p>';
            }

            echo $after_widget;
        }
    }
?>