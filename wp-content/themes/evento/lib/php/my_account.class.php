<?php
    class my_account{
        function conference(){
            $posts = get_posts( array( 'post_type' => 'conference' , 'posts_per_page' => -1 ) );

            if( count( $posts ) ){
                foreach( $posts as $id => $post ){
                    $post_id = $post -> ID;
                    $events = meta::get_meta( $post -> ID , 'program' );
                    $mn = fields::months_array( );

                    if( count( $events ) && !empty( $events ) ){
                        $new_event = array();
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
                                        $day1   = date( 'j F, ' , $date );
                                        $format = get_option( 'date_format' );
                                        break;
                                    }
                                    case 'Y/m/d' : {
                                        $day1   = date( '/m/d' , $date );
                                        $format = get_option( 'date_format' );
                                        break;
                                    }
                                    case 'm/d/Y' : {
                                        $day1   = date( 'm/d/' , $date );
                                        $format = get_option( 'date_format' );
                                        break;
                                    }
                                    case 'd/m/Y' : {
                                        $day1   = date( 'd/m/' , $date );
                                        $format = get_option( 'date_format' );
                                        break;
                                    }
                                    default : {
                                        $day1   = date( 'F j, ' , $date );
                                        $format = 'F j, Y';
                                        break;
                                    }
                                }

                                $day    = date( $format , $date );
                                $j1     = date( 'j' , $date );
                                $d1     = date( 'd' , $date );
                                $m1     = date( 'm' , $date );
                                $f1     = date( 'F' , $date );
                                $y1     = date( 'Y' , $date );
                            }else{
                                $day2   = date( $format , $date );
                                $j2     = date( 'j' , $date );
                                $d2     = date( 'd' , $date );
                                $m2     = date( 'm' , $date );
                                $f2     = date( 'F' , $date );
                                $y2     = date( 'Y' , $date );
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
                    }

                    
                    $guests = meta::get_meta( $post -> ID , 'guests' );
                      
					$registration_settings = meta::get_meta($post -> ID, 'registration'); 
                    if( count( $guests ) ){
                        foreach( $guests as $index => $guest ){
							
							if(isset($registration_settings['enabled']) &&  $registration_settings['enabled'] == 'enabled'){
								$action  = '<p class="button blue hover">'
                                            . '<input id="conference-register-'
                                            . $post -> ID
                                            . '" type="button" value="'
                                            . __( 'Register' , 'cosmotheme' )
                                            . '" onclick="javascript:'
                                            . self::get_action( $post -> ID , get_current_user_id()  , $index , 'register' )
                                            . '"/></p> <p class="button hidden hover"><input id="conference-unregister-' . $post -> ID
                                            . '" class="hidden" type="button" value="'
                                            . __( 'Unregister' , 'cosmotheme' )
                                            . '" onclick="javascript:'
                                            . self::get_action( $post -> ID , get_current_user_id()  , $index ,  'unregister' ) . '"/></p>';
							}else{
								$action = __('Registration is disabled','cosmotheme');
							}
                            if( $guest['idrecord'] == get_current_user_id() ){
                                $action = '<p class="button hover"><input id="conference-unregister-'
                                            . $post -> ID . '" type="button" value="'
                                            . __( 'Unregister' , 'cosmotheme' )
                                            . '" style="float:right;" onclick="javascript:'
                                            . self::get_action( $post -> ID , get_current_user_id() , $index ,   'unregister' )
                                            . '"/></p> <p class="button blue hover hidden"><input id="conference-register-'
                                            . $post -> ID . '" class="hidden" type="button" value="'
                                            . __( 'Register' , 'cosmotheme' )
                                            . '" onclick="javascript:'
                                            . self::get_action(  $post -> ID , get_current_user_id()  , $index , 'register' ) . '"/></p>';
                                break;
                            }
                        }
                    }else{
						if(isset($registration_settings['enabled']) &&  $registration_settings['enabled'] == 'enabled'){
							$action = '<p class="button blue hover"><input id="conference-register-'
                                        . $post -> ID . '" type="button" value="'
                                        . __( 'Register' , 'cosmotheme' )
                                        . '" onclick="javascript:'
                                        . self::get_action( $post -> ID , get_current_user_id() , $id , 'register' )
                                        . '"/></p> <p class="button hover hidden"><input id="conference-unregister-'
                                        . $post -> ID . '" class="hidden" type="button" value="'
                                        . __( 'Unregister' , 'cosmotheme' )
                                        . '" onclick="javascript:'
                                        . self::get_action(  $post -> ID , get_current_user_id() ,  $id, 'unregister' ) . '"/></p>';
						}else{
							$action = __( 'Registration is disabled' , 'cosmotheme' ) ;
						}
                    }
                    
                    echo '<div class="user-conference">';
                    echo '<div class="conferences">';
                    echo '<h3><a href="'. get_permalink( $post -> ID ) .'">'. $post -> post_title . '</a></h3>';
                    if( !empty( $events ) ){
                        echo '<span><i class="time">' . $date_result . '</i></span>';
                    }
                    echo '</div>';

                    if( is_user_logged_in () ) {
                        echo '<div class="buttons">';
                        echo $action;
                        echo '</div>';
                    }
                    
                    echo '</div>';
                    
                }

                $registration_settings = meta::get_meta( $post_id , 'registration' );
                
                if( !( is_user_logged_in ())  && options::logic( 'general' , 'site_registration' )  ) {
                    if( !(isset( $registration_settings['enabled'] ) &&  $registration_settings['enabled'] != 'enabled' && count( $posts ) == 1 ) ) {
                        echo '<div class="user-conference">';
                        echo '<p class="signup">' . __( 'To be able to register for the event please sign up.' , 'cosmotheme' ) . '</p><p class="button hover blue no_float"><input type="button" value="' . __( 'Sign up' , 'cosmotheme' ) . '" onclick="javascript:document.location.href=\'' . home_url('/wp-login.php?action=register') .'\'"></p>';
                        echo '</div>';
                    }else{
                        echo '<div class="user-conference">';
                        echo __( 'Registration is disabled' , 'cosmotheme' ) ;
                        echo '</div>';
                    }
                }
            }else{
                _e( 'Sorry, no conferences found' , 'cosmotheme' );
            }
        }

        function get_action( $conference_id , $guest_id , $index , $type ){
            if( $type == 'register' ){
                return "meta.save_data('conference' , 'guests' , " . $conference_id . " , [ { 'name' : 'guests[idrecord][]' , 'value' : " . $guest_id . " }] , '.--' );act.hide( '#conference-register-" . $conference_id  . "');act.show( '#conference-unregister-" . $conference_id  . "'); ";
            }else{
                return "meta.del_data( 'conference' , 'guests' , " . $conference_id . " , " . $index . " , " . $guest_id . "  , '.--' );act.show( '#conference-register-" . $conference_id  . "');act.hide( '#conference-unregister-" . $conference_id  . "'); ";
            }
        }
    }
?>