<?php
    class widget_animated_sponsors extends WP_Widget{
        function widget_animated_sponsors() {
            $options = array( 'classname' => 'animated_sponsors  ', 'description' => __('Display animated list of Sponsors from a Conference' , 'cosmotheme' ) );
            parent::WP_Widget( false , _TN_ . ' : ' . __( 'Conference Sponsors Animated' , 'cosmotheme' )  , $options );

        }

        function form($instance) {
            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = __( 'Conference sponsors' , 'cosmotheme' );
            }

            if( isset( $instance['conference'] ) ){
                $conf_id = $instance['conference'] ;
            }else{
                $conf_id = '';
            }

            if( isset( $instance['nr'] ) ){
                $nr = $instance['nr'];
            }else{
                $nr = 2;
            }

        	if( isset( $instance['nr_visible'] ) ){
                $nr_visible = $instance['nr_visible'];
            }else{
                $nr_visible = 1;
            }	
            
        	if( isset( $instance['show_name'] ) ){
                $show_name = $instance['show_name'] ;
            }else{
                $show_name = 'true';
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

        <!-- field for setting total number of sponsors-->
        <p>
          <label for="<?php echo $this -> get_field_id('nr'); ?>"><?php _e( 'Total number of sponsors to display' , 'cosmotheme' ); ?>:</label>
          <input class="widefat digit" id="<?php echo $this -> get_field_id('nr'); ?>" name="<?php echo $this->get_field_name('nr'); ?>" type="text" value="<?php echo $nr; ?>" />
        </p>

        <!-- field for setting number of sponsors showed at a time -->
        <p>
          <label for="<?php echo $this -> get_field_id('nr_visible'); ?>"><?php _e( 'Number of visible sponsors' , 'cosmotheme' ); ?>:</label>
          <input class="widefat digit" id="<?php echo $this -> get_field_id('nr_visible'); ?>" name="<?php echo $this->get_field_name('nr_visible'); ?>" type="text" value="<?php echo $nr_visible; ?>" />
        </p>

        <!-- field for show / hide sponsor name  -->
        <p>
          <?php
            if( 'true' ==  $show_name ){
                $c = 'checked="checked"';
            }else{
                $c = '';
            }
        ?>
          <label for="<?php echo $this -> get_field_id('show_name'); ?>">
              <input type="checkbox"  id="<?php echo $this -> get_field_id( 'show_name' ); ?>" value="true" <?php echo $c; ?> name="<?php echo $this->get_field_name('show_name'); ?>" />
              <?php _e( 'show sponsor name' , 'cosmotheme' ); ?>
          </label>

        </p>
        <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']      = strip_tags( $new_instance['title'] );
            $instance['conference'] = strip_tags( $new_instance['conference'] );
            $instance['nr']         = strip_tags( $new_instance['nr'] );
            $instance['nr_visible']         = strip_tags( $new_instance['nr_visible'] );
            $instance['show_name']    = strip_tags( $new_instance['show_name'] );
            
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
                $nr = 2;
            }

            /*visible items*/	
            if( isset( $instance['nr_visible'] ) ){
                $nr_visible = $instance['nr_visible'];
            }else{
                $nr_visible = 1;
            }	
            
			/* if show sponsor name */
            if( isset( $instance['show_name'] ) ){
                $show_name = (bool)$instance['show_name'];
            }else{
                $show_name = true;
            }
            

            echo $before_widget;

            if ( strlen( $title ) ) {
                    echo $before_title . $title . $after_title;
            }

            if( (int) $conf_id > 0 ){
                
                echo conference::get_sponsors_animated($conf_id ,$nr , $nr_visible , $show_name);
            }else{
                echo '<p class="select">' . __( 'Please select Conference' , 'cosmotheme' ) . '</p>';
            }

            echo $after_widget;
        }
    }
?>