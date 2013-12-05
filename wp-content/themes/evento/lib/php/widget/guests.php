<?php
    class widget_guests extends WP_Widget{
        function widget_guests() {
            $options = array( 'classname' => 'guests', 'description' => __('Display list whit guests from a Conference' , 'cosmotheme' ) );
            parent::WP_Widget( false , _TN_ . ' : ' . __( 'Conference Guests' , 'cosmotheme' )  , $options );

        }

        function form($instance) {
            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = __( 'Conference guests' , 'cosmotheme' );
            }

            if( isset( $instance['conference'] ) ){
                $conf_id = $instance['conference'] ;
            }else{
                $conf_id = '';
            }

            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'];
            }else{
                $nr = 5;
            }

            if( isset( $instance['page'] ) ){
                $page_id = $instance['page'] ;
            }else{
                $page_id = '';
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
                $conferences = get__posts( array( 'post_type' => 'conference','numberposts' => -1 ) , '' );

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
          <label for="<?php echo $this -> get_field_id('nr'); ?>"><?php _e( 'Number of guests to display' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this -> get_field_id('nr'); ?>" name="<?php echo $this->get_field_name('nr'); ?>" type="text" value="<?php echo $nr; ?>" />
        </p>

        <!-- field for sed read more page -->
        <p>
          <label for="<?php echo $this -> get_field_id('page'); ?>"><?php _e( "Select Page for 'Read more' link" , 'cosmotheme' ); ?>:</label>
          <select class="widefat" id="<?php echo $this -> get_field_id( 'page' ); ?>" name="<?php echo $this->get_field_name('page'); ?>" >
              <option value="">select page</option>
              <?php
                $pages = get__pages();

                foreach( $pages as $index => $page ){
                    if( $index ==  $page_id ){
                        echo '<option value="' . $index . '" selected="selected">' . $page . '</option>';
                    }else{
                        echo '<option value="' . $index . '">' . $page . '</option>';
                    }
                }
              ?>
          </select>
        </p>
        <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']          = strip_tags($new_instance['title']);
            $instance['conference']   = strip_tags($new_instance['conference']);
            $instance['nr']         = strip_tags( $new_instance['nr'] );
            $instance['page']       = strip_tags( $new_instance['page'] );
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

            /* id of page for readmore */
            if( isset( $instance['page'] ) ){
                $page_id = $instance['page'];
            }else{
                $page_id = 0;
            }

            echo $before_widget;

            if ( $title ) {
                    echo $before_title . $title . $after_title;
            }

            if( (int) $conf_id > 0 ){
                /* list with guests */
                echo conference::guests( $conf_id , $nr );
                /* read more link */
                if( (int) $page_id > 0 ){
                    echo conference::readmore( $page_id );
                }
            }else{
                echo '<p class="select">' . __( 'Please select Conference' , 'cosmotheme' ) . '</p>';
            }

            echo $after_widget;
        }
    }
?>