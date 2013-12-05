<?php
    class widget_registration extends WP_Widget{
        function widget_registration() {
            $options = array( 'classname' => 'registration', 'description' => __('Display registration box' , 'cosmotheme' ) );
            parent::WP_Widget( '' , _TN_ . ' : ' . __( 'Conference registration' , 'cosmotheme' )  , $options );
        }

        function form($instance) {
            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = '';
            }

            if( isset( $instance['conference'] ) ){
                $conf_id = $instance['conference'] ;
            }else{
                $conf_id = '';
            }

            if( isset( $instance['description'] ) ){
                $description = $instance['description'];
            }else{
                $description = '';
            }
            
        	if( isset( $instance['external_registration'] ) ){
                $external_registration = $instance['external_registration'];
            }else{
                $external_registration = '';
            }
        ?>
        <p>
          <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e( 'Title' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
          <label for="<?php echo $this -> get_field_id('conference'); ?>"><?php _e( 'Select Conference' , 'cosmotheme' ); ?>:</label>
          <select class="widefat" id="<?php echo $this -> get_field_id( 'conference' ); ?>" name="<?php echo $this->get_field_name('conference'); ?>" >
              <option value=""><?php _e('select conference','cosmotheme') ?></option>
              <?php if( 0 ==  $conf_id ){ ?>
              <option value="0" selected="selected"><?php _e('Latest conference','cosmotheme') ?></option>
              <?php }else{ ?>
              <option value="0"><?php _e('Latest conference','cosmotheme') ?></option>
              <?php } ?>
              <?php
                $conferences = get__posts( array( 'post_type' => 'conference','numberposts' => -1 ) , '' );
                foreach( $conferences as $index => $conference ){
                    if( $index ==  $conf_id ){
                        echo '<option value="' . $index . '" selected="selected">' .__($conference). '</option>';
                    }else{
                        echo '<option value="' . $index . '">' .__($conference). '</option>';
                    }
                }
              ?>
          </select>
        </p>

		<p>
          <label for="<?php echo $this -> get_field_id('external_registration'); ?>"><?php _e( 'External registration link' , 'cosmotheme' ); ?>:</label><br />
          <input class="widefat" id="<?php echo $this -> get_field_id('external_registration'); ?>" name="<?php echo $this->get_field_name('external_registration'); ?>" type="text" value="<?php echo $external_registration; ?>" />
          <label ><?php _e( 'If the ablove field is set then registration will link to it' , 'cosmotheme' ); ?></label><br />
        </p>
        
        <p>
          <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e( 'Description' , 'cosmotheme' ); ?>:</label><br />
          <textarea rows="5" class="widefat" id="<?php echo $this -> get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description; ?></textarea>
        </p>

        
        <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']      = strip_tags( $new_instance['title'] );
            $instance['conference'] = strip_tags( $new_instance['conference'] );
            $instance['description'] = strip_tags( $new_instance['description'] );
            $instance['external_registration'] = strip_tags( $new_instance['external_registration'] );
            
            return $instance;
        }

        function widget( $args , $instance ) {

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
            }else{
                $conf_id = 0;
            }

            if( isset( $instance['description'] ) ){
                $description = $instance['description'];
            }

        	if( isset( $instance['external_registration'] ) ){
                $external_registration = $instance['external_registration'];
            }else{
            	$external_registration = '';
            }
            
            echo $before_widget;

            if ( strlen( $title ) ) {
                    echo $before_title . $title . $after_title;
            }

            if( (int) $conf_id >= 0 ){
            	if($conf_id == 0){ 
            		$args = array(
						    'numberposts'     => 1,
						    'post_type'       => 'conference',
            				'order' 		  => 'DESC' 
						     );
					$posts = get_posts( $args ); 
					foreach ($posts as $post) {
						$conf = get_post( $post -> ID );
						$conf_id = $post -> ID;	
					}		     
            	}else{ 
            		$conf = get_post( $conf_id );	
            	}
                
                $events    = meta::get_meta( $conf_id , 'program' );
                $location   = meta::get_meta( $conf_id , 'location' );
				
				if( isset( $conf -> post_title ) ) {
                    echo '<p>' . __( $conf -> post_title ) . '</p>';
                }

                if( isset( $location['country'] ) || isset( $location['region'] ) || is_array( $events ) ){

                    echo '<p class="desc">';

                    if( isset( $location['country'] ) && strlen( $location['country'] ) ){
                        echo  $location['country'];

                        if( isset( $location['region'] ) && strlen( $location['region'] ) ){
                            echo ' , ' . $location['region'];
                        }

                        echo '<span>&middot;</span>';
                    }
                    
                    $mn = fields::months_array( );
                    
                    if( count( $events ) && !empty( $events ) ){
                        foreach( $events as $index => $event ){
                            $mktm1 = mktime( 0 , 0 , 0 , (int)$event['start_m'] , (int)$event['start_d'], (int)$event['start_y'] );
                            $mktm2 = mktime( (int)$event['start_hour'] , (int)$event['start_min'] , 0 , (int)$event['start_m'] , (int)$event['start_d'], (int)$event['start_y'] );
                            $new_event[ $mktm1 ][ $mktm2 ] = $event;
                        }
                        
                        ksort( $new_event );
                        if( isset( $day1 ) ){ unset( $day1 ); }
                        if( isset( $day ) ){ unset( $day ); }
                        if( isset( $day2 ) ){ unset( $day2 ); }
                        if( isset( $d2 ) ){ unset( $d2 ); }
                        if( isset( $m2 ) ){ unset( $m2 ); }
                        if( isset( $y2 ) ){ unset( $y2 ); }
                        if( isset( $f2 ) ){ unset( $f2 ); }
                        if( isset( $j2 ) ){ unset( $j2 ); }


                        foreach( $new_event as $date => $events ){

                            if( !isset( $day1 ) ){
                                switch( get_option( 'date_format' ) ){
                                    case 'j F, Y' : {
                                        $day1   = date_i18n( 'j F, ' , $date );
                                        $format = get_option( 'date_format' );
                                        break;
                                    }
                                    case 'Y/m/d' : {
                                        $day1   = date_i18n( '/m/d' , $date );
                                        $format = get_option( 'date_format' );
                                        break;
                                    }
                                    case 'm/d/Y' : {
                                        $day1   = date_i18n( 'm/d/' , $date );
                                        $format = get_option( 'date_format' );
                                        break;
                                    }
                                    case 'd/m/Y' : {
                                        $day1   = date_i18n( 'd/m/' , $date );
                                        $format = get_option( 'date_format' );
                                        break;
                                    }
                                    default : {
                                        $day1   = date_i18n( 'F j, ' , $date );
                                        $format = 'F j, Y';
                                        break;
                                    }
                                }

                                $day    = date_i18n( $format , $date );
                                $j1     = date_i18n( 'j' , $date );
                                $d1     = date_i18n( 'd' , $date );
                                $m1     = date_i18n( 'm' , $date );
                                $f1     = date_i18n( 'F' , $date );
                                $y1     = date_i18n( 'Y' , $date );
                            }else{
                                $day2   = date_i18n( $format , $date );
                                $j2     = date_i18n( 'j' , $date );
                                $d2     = date_i18n( 'd' , $date );
                                $m2     = date_i18n( 'm' , $date );
                                $f2     = date_i18n( 'F' , $date );
                                $y2     = date_i18n( 'Y' , $date );
                            }
                        }

                        if( isset( $day2  ) ){
                            if( $d2 == $d1 && $m2 == $m1 && $y2 == $y1){
                                $date_result = $day2;
                            }elseif( $d2 != $d1 && $m2 == $m1 && $y2 == $y1 ){
                                if( $format == 'j F, Y' ){
                                    $date_result =  $j1 . ' -' . $j2 . ' ' . $f1 . ', ' . $y1;
                                }
                                if( $format == 'F j, Y' ){
                                    $date_result =  $f1 . ' ' . $j1 . ' - ' . $j2 . ', ' . $y1;
                                }
                                if( $format == 'd/m/Y' ){
                                    $date_result =  $d1 . ' - ' . $d2 . ' /' . $m1 . '/' . $y1;
                                }
                                if( $format == 'm/d/Y' ){
                                    $date_result =  $m1 . '/ ' . $d1 . ' - ' . $d2 . ' /' . $y1;
                                }
                                if( $format == 'Y/m/d' ){
                                    $date_result = $y1 . '/' . $m1 . '/ ' . $d1 . '-' . $d2;
                                }

                            }elseif( $m2 != $m1 && $y2 == $y1 ){
                                if( $format == 'j F, Y' ){
                                    $date_result =  $j1 . ' ' . $f1 . ' - ' . $j2 . ' ' . $f2 . ', ' . $y1;
                                }
                                if( $format == 'F j, Y' ){
                                    $date_result =  $f1 . ' ' . $j1 . ' - ' . $f2 . ' ' . $j2 . ', ' . $y1;
                                }
                                if( $format == 'd/m/Y' ){
                                    $date_result =  $d1 . '/' . $m1 . ' - ' . $d2 . '/' . $m2 . ' /' . $y1;
                                }
                                if( $format == 'm/d/Y' ){
                                    $date_result =  $m1 . '/' . $d1 . ' - ' . $m2 . '/' . $d2 . ' /' . $y1;
                                }
                                if( $format == 'Y/m/d' ){
                                    $date_result = $y1 . '/ ' . $m1 . '/' . $d1 . ' - ' . $m2 . '/' . $d2;
                                }

                            }else{
                                $date_result =  $day . ' - ' .  $day2;
                            }
                        }else{
                            $date_result =  $day;
                        }

                        echo $date_result;
                    }

                    echo '</p>';
                }

                if( isset( $description ) ){
                    echo '<p class="exc">' . __($description) . '</p>';
                }

                 $is_attending = false;
                if($external_registration == ''){
	                $myacc = get_page_by_title( 'Registration' );
	                $link = get_permalink( $myacc -> ID );
	
	                /*check if widget is displayed on conference post page and user is registered for current shown conference*/
	                
	               
		            if(is_user_logged_in()){
						
					    /*load all guests for current conference*/
						$guests = meta::get_meta( $conf_id, 'guests' );
						
						foreach( $guests as $index => $guest ){
							
							if(get_current_user_id( ) == $guest['idrecord']){
								$is_attending = true;
							}
						}
					    	
					}
                }else{
                	$link = $external_registration;
                }
                	

				if($is_attending){
					echo '<p class="registered"><span>'; _e('Registered','cosmotheme'); echo '</span></p>';
				}else{
					echo '<p class="button hover blue register no_float">';
	                echo '<a href="' . $link . '">';  _e( 'register for the event' , 'cosmotheme' ); echo '<span>&nbsp;</span></a>';
	                echo '</p>';	
				}	
                

                echo '<div class="end">&nbsp;</div><!--ads the end background-->';
            }else{
                echo '<p class="select">';  _e( 'Please select Conference' , 'cosmotheme' ); echo '</p>';
            }
            
            echo $after_widget;
        }
    }
?>