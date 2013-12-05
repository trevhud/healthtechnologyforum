<?php
    class widget_program extends WP_Widget{
        function widget_program() {
            $options = array( 'classname' => 'program', 'description' => __('Display list of events from a Conference' , 'cosmotheme' ) );
            parent::WP_Widget( false , _TN_ . ' : ' . __( 'Conference Program' , 'cosmotheme' )  , $options );

        }

        function form($instance) {

            /* title widget */
            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = __( 'Conference program' , 'cosmotheme' );
            }

            /* conference */
            if( isset( $instance['conference'] ) ){
                $conf_id = $instance['conference'] ;
            }else{
                $conf_id = '';
            }

            /* limit list */
            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'] ;
            }else{
                $nr = 3;
            }

            /* read more page id */
            if( isset( $instance['page'] ) ){
                $page_id = $instance['page'] ;
            }else{
                $page_id = '';
            }
        ?>

        <!-- field for set widget title  -->
        <p>
          <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e( 'Title' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <!-- field for set conference  -->
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
          <label for="<?php echo $this -> get_field_id('nr'); ?>"><?php _e( 'Number of events to display' , 'cosmotheme' ); ?>:</label>
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

        function update( $new_instance , $old_instance ) {
            $instance = $old_instance;
            $instance['title']      = strip_tags( $new_instance['title'] );
            $instance['conference'] = strip_tags( $new_instance['conference'] );
            $instance['nr']         = strip_tags( $new_instance['nr'] );
            $instance['page']       = strip_tags( $new_instance['page'] );
            return $instance;
        }

        function widget( $args , $instance) {

            extract( $args );

            if( !empty( $instance['title'] ) ){
               $title = apply_filters('widget_title', $instance['title']);
            }else{
               $title = '';
            }

            if( isset( $instance['conference'] ) ){
                $conf_id = $instance['conference'];
            }

            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'];
            }else{
                $nr = 3;
            }

            if( isset( $instance['page'] ) ){
                $page_id = $instance['page'];
            }else{
                $page_id = 0;
            }
            

            echo $before_widget;

            if( strlen( $title ) ) {
                echo $before_title . $title . $after_title;
            }

            if( (int) $conf_id > 0 ){
                /* list with events */
				$description = false;	
				$class_ul = '';
                echo conference::program( $conf_id , $nr,$description, $class_ul );
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