<?php
    /* get front page slider */
	
    if( !isset( $post ) ){
        $post = null;
    }else{
    	$slider_selected = meta::get_meta($post -> ID,'settings' ); 
    	if(is_array($slider_selected) && isset($slider_selected['slideshow_select'])){
    		
    		$slider_id = $slider_selected['slideshow_select'];
    	}		
    } 
    
    
    if( is_front_page () || ( !empty( $post ) && ( is_single() || is_page() ) && meta::logic( $post , 'settings' , 'slideshow' ) ) ){
    	
    	if(isset($slider_id) && is_numeric($slider_id) && $slider_id > 0){
    		$sl_id = $slider_id; 
    	}else{
        	$sl_id = options::get_value( 'front_page' , 'slideshow' );
    	}	 
        
    }
    if( isset( $sl_id ) && !empty( $sl_id ) ){
        $meta   = meta::get_meta( $sl_id , 'box' );

        $result = '';
        if( !empty ( $meta ) && is_array( $meta ) ){
            foreach( $meta as $slider ){
                $description = '';
                $title = '';
                $link = '';
                $sl_item = '';
                $classes = '';
                /* */
                if( isset( $slider['resources'] )  && (int) $slider['resources'] > 0 ){
                    $sl_item = get_post( $slider['resources'] );
                    if( trim( $slider['type_res'] ) == 'program' ){

                        /* period */
                        $events    = meta::get_meta( $slider['resources'] , 'program' );
                        $mn = fields::months_array( );

                        if( count( $events ) ){
                            foreach( $events as $index => $event ){
                                $mktm1 = mktime( 0 , 0 , 0 , (int)$event['start_m'] , (int)$event['start_d'], (int)$event['start_y'] );
                                $mktm2 = mktime( (int)$event['start_hour'] , (int)$event['start_min'] , 0 , (int)$event['start_m'] , (int)$event['start_d'], (int)$event['start_y'] );
                                $new_event[ $mktm1 ][ $mktm2 ] = $event;
                            }

                            ksort( $new_event );
                            foreach( $new_event as $date => $events ){
                                if( !isset( $day1 ) ){
                                    $day1   = date_i18n( 'd F' , $date );
                                    $day    = date_i18n( 'd F Y' , $date );
                                    $d1     = date_i18n( 'd' , $date );
                                    $m1     = date_i18n( 'F' , $date );
                                    $y1     = date_i18n( 'Y' , $date );
                                }else{
                                    $day2   = date_i18n( 'd F Y' , $date );
                                    $d2     = date_i18n( 'd' , $date );
                                    $m2     = date_i18n( 'F' , $date );
                                    $y2     = date_i18n( 'Y' , $date );
                                }


                            }

                            if( isset( $day2  ) ){
                                if( $d2 == $d1 && $m2 == $m1 && $y2 == $y1){
                                    $period = $day2;
                                }elseif( $d2 != $d1 && $m2 == $m1 && $y2 == $y1 ){
                                    $period = $d1 . ' - ' . $day2;
                                }elseif( $m2 != $m1 && $y2 == $y1 ){
                                    $period = $d1 . ' ' . $m1 . ' - ' . $day2;
                                }else{
                                    $period = $day . ' - ' . $day2;
                                }
                            }else{
                                $period = $day;
                            }
                        }else{
                            $period ='';
                        }

                        /* location */
                        $m_location = meta::get_meta( $slider['resources'] , 'location' );

                        $location = '';
                        if( !empty( $m_location[ 'country' ] ) ){
                            $location .= $m_location[ 'country' ];
                        }
                        if( !empty( $m_location[ 'region' ] ) ){
                            if( strlen( $location ) > 0 ){
                                $location .= ', ';
                            }
                            $location .= $m_location[ 'region' ];
                        }
                        if( !empty( $m_location[ 'institution' ] ) ){
                            if( strlen( $location ) > 0 ){
                                $location .= ', ';
                            }
                            $location .= $m_location[ 'institution' ];
                        }

                        /* info */
                        $info  = '';
                        $presentations = meta::get_meta( $slider['resources'] , 'presentation' );
                        if( count( $presentations ) == 1 ){
                            $info .=  __( 'presentation' , 'cosmotheme' );
                        }else{
                            $info .=  __( 'presentations' , 'cosmotheme' );
                        }
                        $info .=  ' : <strong>' . count( $presentations ) . '</strong>';

                        $nr_speakers = array();
                        foreach( $presentations as $p ){
                            $speakers = meta::get_meta( $p['idrecord'] , 'speaker' );
                            foreach( $speakers as $s ){
                                $nr_speakers[ $s['idrecord'] ] = $s['idrecord'];
                            }
                        }
                        
                        $info .= ', ';
                        if( count( $nr_speakers ) == 1 ){
                            $info .= __( 'speaker' , 'cosmotheme' );
                        }else{
                            $info .= __( 'speakers' , 'cosmotheme' );
                        }
                        $info .= ' : <strong>' . count( $nr_speakers ) . '</strong>';

                        $guests  = meta::get_meta( $slider['resources'] , 'guests' );
                        $info .= ', ';
                        if( count( $guests ) == 1 ){
                            $info .= __( 'guest' , 'cosmotheme' );
                        }else{
                            $info .= __( 'guests' , 'cosmotheme' );
                        }
                        $info .= ' : <strong>' . count( $guests ) . '</strong>';


                        if( !empty( $location ) ){
                            $description .= '<strong>' .__( 'Location' , 'cosmotheme' ) .'</strong> : ' . $location . '<br />';
                        }
                        if( !empty( $period ) ){
                            $description .=  $period . '<br /p>';
                        }
                        if( !empty( $info ) ){
                            $description .= $info . '<br /p>';
                        }
                        
                        /* classes */
                        $classes = 'program';
                    }else{
                        /* classes */
                        $classes = $sl_item -> post_type;
                    }
                }

                
                /* description */
                if( !empty( $slider['description'] ) ){
                    $description = __(trim( ( $slider['description'] ) ));
                }else{
                    if( isset( $sl_item ) && !empty( $sl_item ) ){
                        if( $slider['type_res'] != 'program' ){
                            if( !empty( $sl_item -> post_excerpt ) ){
                                $description = trim( mb_substr( strip_tags( __($sl_item -> post_excerpt)  ) , 0 , 170 ) );
                                if( strlen( $sl_item -> post_excerpt ) > strlen( $description ) ){
                                    $description .= ' [...]';
                                }
                            }else{
                                $description = trim( mb_substr(  strip_tags( strip_shortcodes( __($sl_item -> post_content) ) ) , 0 , 170 ) );
                                if( strlen( $sl_item -> post_content ) > strlen( $description ) ){
                                    $description .= ' [...]';
                                }
                            }
                        }
                    }
                }
                
                /* title */
                if(isset($slider['title']) && trim($slider['title']) != ''){
                	$title = __(trim($slider['title']));
                	if(!empty( $sl_item )){
                		$link  = get_permalink( $sl_item -> ID );
                	}	
                }elseif ( !empty( $sl_item ) ){
                    $title = __($sl_item -> post_title);
                    $link  = get_permalink( $sl_item -> ID );
                }else{
                    $title = '';
                    $link  = '';
                }

				/*overwright the URL if it is defined by user*/
                if(isset($slider['url']) && trim($slider['url']) != ''){
                    $link = $slider['url']; 
                }	
                
                /* slider image */
                if( (int) $slider['slide_id'] > 0 ){
                    if( wp_attachment_is_image( $slider['slide_id'] ) ){
                        $src = wp_get_attachment_image_src( $slider['slide_id'] , 'slideshow' );
                    }
                }else{
                    if( isset( $sl_item ) ){
                        if( has_post_thumbnail( $sl_item -> ID ) ){
                            $src = wp_get_attachment_image_src( $post -> ID ,  'slideshow' );
                        }else{
                            $src[0] = get_template_directory_uri() . '/images/no_image940x480.jpg';
                        }
                    }
                }

                /* check if is image */
                if( wp_attachment_is_image( $slider['slide_id'] ) ){
                    $src = wp_get_attachment_image_src( $slider['slide_id'] , 'slideshow' );

                    /* get image data */
                    $image = get_post( $slider['slide_id'] );

                    $result .= '<div>';
                    $result .= '<img src="' . $src[0] . '" alt="' . $image -> post_excerpt . '"/>';

                    /* caption */
                    if( strlen( $title . $description ) ){ 
                        $result .= '<div class="caption ' . $classes . '">';

                        /* ribbon */
                        if( options::logic( 'slider' , 'ribbon' ) && trim( $slider['type_res'] ) != 'none' ){
                            $result .= '<span class="ribbon">&nbsp;</span>';
                        }

                        if( !empty( $title  ) ){
                            $result .= '<h2>' . $title . '</h2>';
                        }

                        if( !empty( $description  ) ){
                            $result .= '<p>'. str_replace( "\n" , "<br />" , $description ) . '</p>';
                        }

                        if( !empty( $link  ) ){
                            $result .= '<a href="' . $link . '" class="readmore hover">';
							$result .= __('Read more','cosmotheme');
							$result .=  '</a>';
                        }

                        $result .= '<span class="shadow">&nbsp;</span>';
                        $result .= '</div>';
                    }

                    $result .= '</div>';
                }
                
            }
        }
    }

    if( isset( $result) && strlen( $result ) ){
?>

        <div class="b_page clearfix">
            <div class="b w_940">
            	<div class="slides_control" id="slides_control" style="position: absolute; width: 120%; left: -10%; height: 480px;"></div>
                <div class="cosmo-slider">
                    <div class="slide slides_container"  >
                        <?php echo $result; ?>
                    </div>
                    <div class="end">&nbsp;</div><!--ads the end background-->
                </div>

            </div>
        </div>

<?php
    }else{
?>
        <p class="delimiter nmg">&nbsp;</p>
<?php
    }
?>