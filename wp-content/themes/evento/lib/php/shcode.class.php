<?php
	class shcode{
        function contact( $attr , $content ){
            $title          = isset( $attr['title'] ) && strlen( $attr['title'] )? '<h3>' . $attr['title'] . '</h3>' : '';
            $description    = isset( $attr['description'] ) && strlen( $attr['description'] )? '<p>' . $attr['description'] . '</p>' : '';
            if( isset( $attr['phone1'] ) && strlen( $attr['phone1'] ) && isset( $attr['phone2'] ) && strlen( $attr['phone2'] ) ){
                $phone1 = '<small>' . '<strong>'. __('Phone 1' , 'cosmotheme') . '</strong> : ' . $attr['phone1'] . '</small><br />';
            }elseif( isset( $attr['phone1'] ) && strlen( $attr['phone1'] ) ){
                $phone1 = '<small>' . '<strong>'. __('Phone' , 'cosmotheme') . '</strong> : ' . $attr['phone1'] . '</small><br />';
            }else{
                $phone1 = '';
            }
            $phone2         = isset( $attr['phone2'] ) && strlen( $attr['phone2'] )? '<small>' . '<strong>'. __('Phone 2' , 'cosmotheme') . '</strong> : ' . $attr['phone2'] . '</small><br />' : '';
            $fax            = isset( $attr['fax'] ) && strlen( $attr['fax'] )? '<small>' . '<strong>'. __('Fax' , 'cosmotheme') . '</strong> : ' . $attr['fax'] . '</small><br />' : '';
            $show_contact  = isset( $attr['hidde_contact'] ) &&  $attr['hidde_contact'] == 'yes' ? false : true;

            if( is_email( $attr['email'] ) ){
                update_option( 'contact_mail' , $attr['email'] );
                $email = '<small>' . '<strong>'. __('Email' , 'cosmotheme') . '</strong> : ' . $attr['email'] . '</small><br />';
                $mail = true;
            }else{
                $mail = false;
                update_option( 'contact_mail' , get_the_author_meta( 'user_email' , get_current_user_id()) );
                $email = '<strong>'. __('Email' , 'cosmotheme') . '</strong> : ' . get_the_author_meta( 'user_email' , get_current_user_id()) . '</strong><br />';
            }

            $lat        = isset( $attr['lat'] )  ? (float)$attr['lat'] : MAP_LAT;
            $lng        = isset( $attr['lng'] )  ? (float)$attr['lng'] : MAP_LNG;
            $clat       = isset( $attr['clat'] )  ? (float)$attr['clat'] : MAP_CLAT;
            $clng      = isset( $attr['clng'] )   ? (float)$attr['clng'] : MAP_CLNG;

            if( isset( $mail ) && $mail ){
                $info       = $title . $description . $phone1 . $phone2 . $fax . $email ;
            }else{
                $info       = $title . $description . $phone1 . $phone2 . $fax ;
            }

            $zoom       = isset( $attr['zoom'] ) && $attr['zoom'] > 0 ? $attr['zoom']  : MAP_ZOOM ;

            $result = '';

            if( strlen( options::get_value( 'social' , 'google_map' ) ) ){
                $result .= "
                            <script>
                                var lat = ".$lat.";
                                var lng = ".$lng.";
                                var clat = ".$clat.";
                                var clng = ".$clng.";
                                var info = '".$info."';
                                var zoom = ".$zoom.";
                            </script>
                ";
                $result .= '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=' . options::get_value( 'social' , 'google_map' ) . '" type="text/javascript"></script>';
                $result .= '<script src="' . get_template_directory_uri() . '/js/google.map.js" type="text/javascript"></script>';
                $result .= '<script src="' . get_template_directory_uri() . '/lib/js/action.js" type="text/javascript"></script>';

                $result .= '<div id="map_canvas"></div>';
            }else{
                $result .= $info . '<br />';
            }

            if( strlen( $content ) ){
                $result .= '<p>' . $content . '</p>';
            }

            if( $show_contact ){
                $time_id = mktime();

                $result .= '<div id="#contact_form_' . $time_id . '" class="contact-form">';
                $result .= '<form class="contactform" method="post" action="' . home_url() . '" >';
                $result .= '<fieldset>';
                
                $result .= '<div id="contact_response" class="send-error">';
                $result .= '</div>';

                $result .= '<p class="content_name input">';
                $result .= '<input type="text" tabindex="1" size="22" value="" id="contact_name" name="name">';
                $result .= '</p>';
                $result .= '<label for="contact_name">';
                $result .= __('Name (required)' , 'cosmotheme') ;
                $result .= '</label>';
                

                $result .= '<p class="content_email input">';
                $result .= '<input type="text" tabindex="2" size="22" value="" id="contact_email" name="email">';
                $result .= '</p>';
                $result .= '<label for="contact_email">';
                $result .=  __('Email (required)' , 'cosmotheme');
                $result .= '</label>';
                


                $result .= '<p class="content_phone input">';
                $result .= '<input type="text" tabindex="3" size="22" value="" id="contact_phone" name="phone">';
                $result .= '</p>';
                $result .= '<label for="contact_phone">';
                $result .=  __('Phone' , 'cosmotheme' );
                $result .= '</label>';

                $result .= '<p class="content_message comment-form-comment textarea">';
                $result .= '<textarea tabindex="4" rows="10" cols="100%" id="contact_message" name="message"></textarea>';
                $result .= '</p>';

                $result .= '<p class="form-submit">';
                $result .= '<input type="button" value="' . __( 'Send Message' , 'cosmotheme' ) . '" tabindex="5" id="submit" name="btn_submit" onclick="javascript:act.send_mail(\'contact\' , \'#contact_form_' . $time_id . '\' , \'div#contact_response\' );">';
                $result .= '</p>';
                $result .= '</fieldset>';
                $result .= '</form>';
                $result .= '</div>';
            }

            return $result;

        }


        static function caption( $post ){
            $description = '';

            $args = array(
                'numberposts' => -1,
                'post_type' => 'attachment',
                'status' => 'publish',
                'post_mime_type' => 'image',
                'post_parent' => $post -> ID
            );

            $images = &get_children( $args );

            if( isset( $images[ get_post_thumbnail_id( $post -> ID ) ] ) ){
                $description = $images[ get_post_thumbnail_id( $post -> ID ) ] -> post_excerpt;
            }else{
                $args = array(
                    'numberposts' => -1,
                    'post_type' => 'attachment',
                    'status' => 'publish',
                    'post_mime_type' => 'image',
                    'post_parent' => 0
                );

                $images = &get_children($args);

                if( isset( $images[  get_post_thumbnail_id( $post -> ID ) ] ) ){
                    $description = $images[ get_post_thumbnail_id( $post -> ID ) ] -> post_excerpt;
                }else{
                    $description = '';
                }
            }

            return $description;

        }
		
        static function add_conferences($attr) {
        	$result = ''; 
        	if( isset( $attr[ 'conf_id' ] )  ){ 
        		$conf_id = $attr[ 'conf_id' ]; 
        		if($attr[ 'conf_id' ] != 'all_conferences' && is_numeric($conf_id) ){
        			$post = get_post( $conf_id );
        			if( has_post_thumbnail ($post -> ID  ) ){
        				$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
        				
        				$result .= '<div class="featimg circle">';
        				$result .= '<div class="img">';
        				$result .= '<a href="'.$src[0].'" title="" class="mosaic-overlay" rel="prettyPhoto-'.$post -> ID.'">&nbsp;</a>';
        				$result .= get_the_post_thumbnail($post -> ID,'600x200');
        				$result .= '</div>';
        				$result .= '<div class="end">&nbsp;</div>';
        				$result .= '</div>';
        				
        			}
        			$result .= __($post -> post_content);
        		}elseif ( $conf_id == 'all_conferences'){ 
        			/*list all conf*/
        			$args = array(
							    'numberposts'     => -1,
							    'post_type'       => 'conference'
							     );
        			$posts = get_posts( $args ); 
        			
        			if(count($posts) > 0){
        				$result .= '<div class="category">';
        			}
        			$k = 0;
        			foreach ($posts as $post) {
        				$conf_settings = meta::get_meta($post -> ID,'settings' ); 
						if(!isset($conf_settings['archive']) || (isset($conf_settings['archive']) && $conf_settings['archive'] == 'no')){
						
							$result .= '<div class="post ">';
							if( $k > 0 ){
								$result .= '<p class="delimiter">&nbsp;</p>';
							}	
							if( has_post_thumbnail ($post -> ID  ) ){
								$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
								
								$result .= '<div class="featimg circle">';
								$result .= '<div class="img">';
								$result .= '<a href="'.$src[0].'" title="" class="mosaic-overlay" rel="prettyPhoto-'.$post -> ID.'">&nbsp;</a>';
								$result .= get_the_post_thumbnail($post -> ID,'600x200');
								$result .= '</div>';
								$result .= '<div class="end">&nbsp;</div>';
								$result .= '</div>';
								
							}
							$result .= '<h3 class="entry-title"><a href="'. get_permalink($post -> ID ) .'" title="'.get_the_title($post -> ID).'">'.__(get_the_title($post -> ID)).'</a></h3>';
							if($post -> post_excerpt != '' ){
								$result .= '<p>'.__(get_the_excerpt_here($post -> ID)).'</p>';
							}else{
								$result .= '<p>'.strip_tags(__(mb_substr($post -> post_content,0,EXCERPT_CHAR_LEN)) ).'</p>';
							}	
							/* read more button */
							$result .= '<p class="button readmore hover "><a href="'. get_permalink($post -> ID ) .'">'.__( 'Continue reading' , 'cosmotheme' ) .'<span>&nbsp;</span></a></p>';
							$result .= '</div>';
							$k ++;	
						}	
        			}
        			if(count($posts) > 0){
        				$result .= '</div>';
        			}
        		}
        	}
        	
        	return  $result;
        }
        
        static function add_pricing( $attr ){
        	$result = '';
        	
        	if( isset( $attr[ 'conf_id' ] ) && is_numeric($attr[ 'conf_id' ]) && $attr[ 'conf_id' ] > 0  ){
        		$result = my_account::conference($attr[ 'conf_id' ]);
        	}
        	return $result;
        
        }
        static function add_exhibitors( $attr ){
            $result = '';

            if( isset( $attr[ 'conf_id' ] ) ){
                $exhibitors = meta::get_meta( (int) $attr[ 'conf_id' ] , 'exhibitor' );
                if( is_array( $exhibitors ) && count( $exhibitors ) ){
                    $result .= '<ul class="exhibitors images ul shortcodes">';
                    foreach( $exhibitors as $exhibitor ){
                        $post = get_post( $exhibitor['idrecord'] );

                        
                        $result .= '<li>';
                        if( has_post_thumbnail ( $post -> ID ) ){
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , '150xXXX' , true );
                            $result .= '<div class="wp-caption alignleft circle">';
                            $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
                            $result .= '<img src="' . $src[0] . '" alt="' . $post -> post_title . '" />';
                            $result .= '</a>';
                            $caption = self::caption( $post );
                            if( strlen( $caption ) ){
                                $result .= '<p class="wp-caption-text">' . $caption . '</p>';
                            }
                            $result .= '</div>';
                        }else{
                            $result .= '<div class="wp-caption alignleft circle">';
                            $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
                            $result .= '<img src="' . get_template_directory_uri() . '/images/no_image150x200.jpg" alt="'  . __( 'exhibitor' ,'cosmotheme' ) . ' - ' . $post -> post_title . '" />';
                            $result .= '</a>';
                            $result .= '</div>';
                        }
                        $result .= '<h4>';
                        $result .= '<a class="readmore" href="' . get_permalink( $post -> ID ) . '">' . get_the_title($post -> ID) . '<span class="mosaic-overlay">&nbsp;</span></a>';
                        $result .= '</h4>';
                        if($post -> post_excerpt != '' ){
	        				$result .= '<span  class="exc">' . __(get_the_excerpt_here($post -> ID)) . '</span>';
	        			}else{
	        				$result .= '<span  class="exc">' . strip_tags(__(mb_substr($post -> post_content,0,EXCERPT_CHAR_LEN)) ). '</span>';  
	        			}
                        $result .= '<p class="button readmore hover margin15">';
                        $result .= '<a href="' . get_permalink( $post -> ID ) . '">' . __( 'Continue reading' , 'cosmotheme' ) . '<span>&nbsp;</span></a>';
                        $result .= '</p>';
                        $result .= '</li>';

                    }
                    $result .= '</ul>';
                }
            }

            return $result;
        }

        static function add_sponsors( $attr ){
            $result = '';

            if( isset( $attr[ 'conf_id' ] ) ){
                $sponsors = meta::get_meta( (int) $attr[ 'conf_id' ] , 'sponsor' );
                if( is_array( $sponsors ) && count( $sponsors ) ){
                    $result .= '<ul class="sponsors images ul shortcodes">';
                    foreach( $sponsors as $sponsor ){
                        $post = get_post( $sponsor['idrecord'] );
                        $meta = meta::get_meta( $post -> ID  , 'info' );

                        $result .= '<li>';
                        if( has_post_thumbnail ( $post -> ID ) ){
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , '150xXXX' , true );
                            $result .= '<div class="wp-caption alignleft circle">';
                            $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
                            $result .= '<img src="' . $src[0] . '" alt="' . $post -> post_title . '" />';
                            $result .= '</a>';
                            $caption = self::caption( $post );
                            if( strlen( $caption ) ){
                                $result .= '<p class="wp-caption-text">' . $caption . '</p>';
                            }
                            $result .= '</div>';
                        }else{
                            $result .= '<div class="wp-caption alignleft circle">';
                            $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
                            $result .= '<img src="' . get_template_directory_uri() . '/images/no_image150x200.jpg" alt="'  . __( 'exhibitor' ,'cosmotheme' ) . ' - ' . $post -> post_title . '" />';
                            $result .= '</a>';
                            $result .= '</div>';
                        }
                        $result .= '<h4>';
                        $result .= '<a class="readmore" href="' . get_permalink( $post -> ID ) . '">' . get_the_title($post -> ID) . '<span class="mosaic-overlay">&nbsp;</span></a>';
                        $result .= '</h4>';
                        if($post -> post_excerpt != '' ){
	        				$result .= '<span  class="exc">' . __(get_the_excerpt_here($post -> ID)) . '</span>';
	        			}else{
	        				$result .= '<span  class="exc">' . strip_tags(__(mb_substr($post -> post_content,0,EXCERPT_CHAR_LEN)) ) . '</span>';  
	        			}
                        $result .= '<p class="button readmore hover margin15">';
                        $result .= '<a href="' . get_permalink( $post -> ID ) . '">' . __( 'Continue reading' , 'cosmotheme' ) . '<span>&nbsp;</span></a>';
                        $result .= '</p>';

                        $result .= '</li>';
                    }
                    $result .= '</ul>';
                }
            }

            return $result;
        }

        static function add_testimonials( $attr ){
        	$result = '';	
        	
        	
        	if( isset( $attr[ 'conf_id' ] ) ){
        		if(isset( $attr[ 'display_mode' ] ) && $attr[ 'display_mode' ] == 'animated'){
        			$result .= '<ul class="testimonials">
									<li>
										<div class="testimonials">';
        			$result .= conference::get_testimonials( $attr[ 'conf_id' ] , 0 );
        			$result .= '		</div>
        							</li>
        						</ul>';		
        		}else{
        			
        		
	                $testimonials = meta::get_meta( (int) $attr[ 'conf_id' ] , 'testimonial' ); 
	                
	        		if( is_array( $testimonials ) && count( $testimonials ) ){
	                    $result .= '<ul class="sponsors images ul shortcodes">';
	                    foreach( $testimonials as $testimonial ){
	                        $post = get_post( $testimonial['idrecord'] );
	                        $meta = meta::get_meta( $post -> ID  , 'info' );
	
	                        $result .= '<li>';
	                        if( has_post_thumbnail ( $post -> ID ) ){
	                            $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , '150xXXX' , true );
	                            $result .= '<div class="wp-caption alignleft circle">';
	                            $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
	                            $result .= '<img src="' . $src[0] . '" alt="' . $post -> post_title . '" />';
	                            $result .= '</a>';
	                            $caption = self::caption( $post );
	                            if( strlen( $caption ) ){
	                                $result .= '<p class="wp-caption-text">' . $caption . '</p>';
	                            }
	                            $result .= '</div>';
	                        }else{
	                            $result .= '<div class="wp-caption alignleft circle">';
	                            $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
	                            $result .= '<img src="' . get_template_directory_uri() . '/images/no_image150x200.jpg" alt="'  . __( 'testimonial' ,'cosmotheme' ) . ' - ' . $post -> post_title . '" />';
	                            $result .= '</a>';
	                            $result .= '</div>';
	                        }
	                        $result .= '<h4>';
	                        $result .= '<a class="readmore" href="' . get_permalink( $post -> ID ) . '">' . get_the_title($post -> ID) . '<span class="mosaic-overlay">&nbsp;</span></a>';
	                    	$testimonial_info = meta::get_meta( $post -> ID, 'info' );
	                    	$author_title = '';
							if($testimonial_info['title'] != ''){
								$author_title = '<span class="testimonial_author_title"> ' . $testimonial_info['title'] . '</span>';
							}
							$result .= '<span class="testimonial_author_name"> '.__($testimonial_info['name']).'</span>';
							$result .= $author_title;
	                        $result .= '</h4>';
	                        
	                        $result .= '<span  class="exc">' . __($post -> post_content) . '</span>';
	                        
	                        $result .= '<p class="button readmore hover margin15">';
	                        $result .= '<a href="' . get_permalink( $post -> ID ) . '">' . __( 'Continue reading' , 'cosmotheme' ) . '<span>&nbsp;</span></a>';
	                        $result .= '</p>';
	
	                        $result .= '</li>';
	                    }
	                    $result .= '</ul>';
	                }
                
        		}
            }
             return $result;
        }
        
        static function add_speakers( $attr ){
            $result = '';

            if( isset( $attr[ 'conf_id' ] ) ){
                $speakers = conference::get_speakers( $attr[ 'conf_id' ] ); 
            }

            if( isset( $attr[ 'presentation_id' ] ) ){
                $presentation = get_post( $attr[ 'presentation_id' ] );
                $speakers  = meta::get_meta( $presentation -> ID , 'speaker' ) ;
				
				$temp_speakers = array();
				foreach( $speakers as $speaker ){ 
					$temp_speakers[] = $speaker['idrecord'];
				}
				$speakers = $temp_speakers; 
			}

			
            if( is_array( $speakers ) && count( $speakers ) ){ 
				/*Alpha sort*/	
				if( isset( $attr[ 'order_by' ] ) && $attr[ 'order_by' ] == 'alpha'){
					/*BOF Sort soeakers in alphabetical order*/  
					$temp_speakers_info = array();
					foreach( $speakers as $speaker ){ 
						$post = get_post( $speaker );   
						$temp_speakers_info[$speaker] = $post -> post_title;  
					} 
					/*var_dump($temp_speakers_info)*/
					asort($temp_speakers_info); /*sort speakers*/
					
					
					foreach( $temp_speakers_info as $speaker ){ 
						$speakers_temp[] = array_search($speaker, $temp_speakers_info); 
					}
					$speakers = $speakers_temp;
					/*EOF Sort soeakers in alphabetical order*/
				}

				$result .= '<ul class="speakers images ul shortcodes">';
                foreach( $speakers as $speaker ){ 
                    $post = get_post( $speaker );
                    $info = meta::get_meta( $speaker , 'info' );

                    $result .= '<li>';

                    if( has_post_thumbnail ( $post -> ID ) ){
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , '150xXXX' , true );
                        $result .= '<div class="wp-caption alignleft circle">';
                        $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
                        $result .= '<img src="' . $src[0] . '" alt="' . $post -> post_title . '" />';
                        $result .= '</a>';
                        $caption = self::caption( $post );
                        if( strlen( $caption ) ){
                            $result .= '<p class="wp-caption-text">' . $caption . '</p>';
                        }
                        $result .= '</div>';
                    }else{
                        $result .= '<div class="wp-caption alignleft circle">';
                        $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
                        $result .= '<img src="' . get_template_directory_uri() . '/images/no_image150x200.jpg" alt="'  . __( 'exhibitor' ,'cosmotheme' ) . ' - ' . $post -> post_title . '" />';
                        $result .= '</a>';
                        $result .= '</div>';
                    }
                    $study  = isset(  $info['study'] ) && strlen( $info['study'] ) ? '<span class="title">' . $info['study'] . '</span>' : '';
                    $univ   = isset(  $info['university'] ) && strlen( $info['university'] ) ? '<span class="title">' . $info['university'] . '</span>' : '';
                    $result .= '<h4>';
                    $result .= '<a class="readmore" href="' . get_permalink( $post -> ID ) . '">' . get_the_title($post -> ID) . '<span class="mosaic-overlay">&nbsp;</span></a>';
                    $result .= $study;
                    $result .= $univ;
                    $result .= '</h4>';
						/*$result .= '<span  class="exc">' . __(get_the_excerpt_here($post -> ID)) . '</span>';*/
					if($post -> post_excerpt != '' ){
						$result .= '<span  class="exc">' . __(get_the_excerpt_here($post -> ID)) . '</span>';
					}else{
						if(strlen($post -> post_content) > EXCERPT_CHAR_LEN){
							$continue = '...';
						}else{
							$continue = '';
						}
						$result .= '<span  class="exc">' . strip_tags(__(mb_substr(strip_shortcodes($post -> post_content),0,EXCERPT_CHAR_LEN)) ). $continue . '</span>';  
					}
                    $result .= '<p class="button readmore hover margin15">';
                    $result .= '<a href="' . get_permalink( $post -> ID ) . '">' . __( 'Continue reading' , 'cosmotheme' ) . '<span>&nbsp;</span></a>';
                    $result .= '</p>';
                    $result .= '</li>';
                }

                $result .= '</ul>';
            }

            return $result;
        }
        
        static function add_presentations( $attr ){
            $result = '';

            if( isset( $attr[ 'conf_id' ] ) ){

				if(isset( $attr[ 'presentation_ids' ] ) ){ /*if we don't need all the presentations   [presentations conf_id=402 presentation_ids = '1,12,42,21' /]*/
					$presentations = explode(',',$attr[ 'presentation_ids' ]);  
				}else{
					$presentations = meta::get_meta( (int) $attr[ 'conf_id' ] , 'presentation' );
				}
                if( is_array( $presentations ) && count( $presentations ) ){
                    $result .= '<ul  class="presentations ul shortcodes">';
                    foreach( $presentations as $presentation ){

						if(isset( $attr[ 'presentation_ids' ] ) ){
							$post = get_post( $presentation );  
						}else{  
							$post = get_post( $presentation['idrecord'] );
						}

                        $result .= '<li>';

                        if( has_post_thumbnail ( $post -> ID ) ){
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , '150xXXX' , true );
                            $result .= '<div class="wp-caption alignleft circle">';
                            $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
                            $result .= '<img src="' . $src[0] . '" alt="' . $post -> post_title . '" />';
                            $result .= '</a>';
                            $caption = self::caption( $post );
                            if( strlen( $caption ) ){
                                $result .= '<p class="wp-caption-text">' . $caption . '</p>';
                            }
                            $result .= '</div>';
                        }else{
                            $result .= '<div class="wp-caption alignleft circle">';
                            $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
                            $result .= '<img src="' . get_template_directory_uri() . '/images/no_image150x200.jpg" alt="'  . __( 'exhibitor' ,'cosmotheme' ) . ' - ' . $post -> post_title . '" />';
                            $result .= '</a>';
                            $result .= '</div>';
                        }

                        $result .= '<a href="' . get_permalink( $post -> ID ) . '" class="readmore">' . get_the_title($post -> ID) . '<span class="mosaic-overlay">&nbsp;</span></a>';

                        /*$result .= '<span class="exc">';
                        $result .= __(get_the_excerpt_here($post -> ID));
                        $result .= '</span>';*/
						if($post -> post_excerpt != '' ){
	        				$result .= '<span  class="exc">' . __(get_the_excerpt_here($post -> ID)) . '</span>';
	        			}else{
	        				$result .= '<span  class="exc">' . strip_tags(__(mb_substr($post -> post_content,0,EXCERPT_CHAR_LEN)) ). '</span>';  
	        			}  

                        $result .= '<p class="button readmore hover margin15">';
                        $result .= '<a href="' . get_permalink( $post -> ID ) . '">' . __( 'Continue reading' , 'cosmotheme' ) . '<span>&nbsp;</span></a>';
                        $result .= '</p>';
                        $result .= '</li>';
                    }
                    $result .= '</ul>';
                }
            }

            return $result;
        }

        static function add_program( $attr ){
            $result = '';

            if( isset( $attr[ 'conf_id' ] ) ){
                $events = meta::get_meta( $attr[ 'conf_id' ] , 'program' );
                $result = '';
                $show_more = false;

                $mn = fields::months_array( );
                if( count( $events ) ){
					$index = 0;
                    foreach( $events as $index => $event ){
                        $mktm1 = mktime( 0 , 0 , 0 , (int)$event['start_m'] , (int)$event['start_d'], (int)$event['start_y'] );
                        $mktm2 = mktime( (int)$event['start_hour'] , (int)$event['start_min'] , $index , (int)$event['start_m'] , (int)$event['start_d'], (int)$event['start_y'] );
                        $new_event[ $mktm1 ][ $mktm2 ] = $event;
						$index++;
                    }
                    /* asc sort by d/m/y */
                    ksort( $new_event );
                    $result .= '<ul class="program ul shortcodes">';
                    $i = 0;
                    foreach( $new_event as $date => $events ){
                        $day = __(date_i18n( get_option('date_format') , $date ));
                        $result .= '<li><span class="date">' . $day . '</span>' ;
                        $result .= '<ul>';
                        /* asc sort by h:m on this day */
                        ksort( $events );
                        $li_class = 'odd';
						$prev_iteration_time = ''; /*will be used to make posible to group events that are holding on the same time */
                        foreach( $events as $index => $event ){
                        	$i++;
                            $result .= '<li class="'.$li_class.'">';
							$start_time = $event['start_hour'] . ':' . $event['start_min']; 
							$end_time = $event['end_hour'] . ':' . $event['end_min'];
							/*if ($prev_iteration_time != date(get_option( time_format ),strtotime($start_time) ).' - '. date(get_option( time_format ),strtotime($end_time) )){*/
								$result .= '<span class="time">';
								$result .= date(get_option( 'time_format' ),strtotime($start_time) ).' - '. date(get_option( 'time_format' ),strtotime($end_time) );
								$prev_iteration_time = date(get_option( 'time_format' ),strtotime($start_time) ).' - '. date(get_option( 'time_format' ),strtotime($end_time) );
								$result .= '</span>';
							/*}*/	
                            $result .= '<span class="event">' . $event['title'] . '</span>';
                            $result .= '<span class="event-desc">' . $event['description'] . '</span>';
                            $result .= '</li>';
                            if($li_class == 'odd'){
                            	$li_class = 'even';
                            }else{
                            	$li_class = 'odd';
                            }
                        }
                        $result .= '</ul>';
                        $result .= '</li>';
                    }
                    $result .= '</ul>';
                }
            }

            return $result;
        }

        static function add_guests( $attr ){
            $result = '';

            if( isset( $attr[ 'conf_id' ] ) ){
                $result = conference::guests(  $attr[ 'conf_id' ] , 0 , 'ul shortcodesclas' );
            }

            return $result;
        }

        /*
         * <div>
           [price_table cols="4"]
         *      [price_table_col type="highlight" class="radius-left" title="Standard Package" price="$54.98" href="http://cosmothemes.com/themes/" ]
                    <ul>
                        <li class="even"><strong class="single">Single Domain Use</strong></li>
                        <li class="odd"><strong class="yes">1 Free Bonus Theme</strong></li>
                        <li class="even"><strong class="no">Access to New Themes</strong></li>
                        <li class="odd"><strong class="no">Photoshop Layered Files</strong></li>
                        <li class="even"><strong class="yes">Free Theme Updates</strong></li>
                        <li class="odd"><strong class="yes">Free Support Access</strong></li>
                    </ul>
         *      [/price_table_col]
         * [/price_table]
        */
        static function price_table( $attr , $content ){
            $result = '';
            if( isset( $attr['cols'] )  ){
                $result .= '<div class="cols-' . $attr['cols'] . '">';
                $result .= do_shortcode( $content );
                $result .= '</div>';
            }

            return $result;
        }

        static function price_table_col( $attr , $content ){
            $classes = 'pricing_box ';
            $result = '';
            $title = '';
            $price = '';
            if( isset( $attr['type'] ) && $attr['type'] == 'highlight' ){
                $classes .= "large ";
            }

            if( isset( $attr['class'] ) ){
                $classes .= $attr['class'];
            }

            if( isset( $attr['title'] ) ){
                $title = $attr['title'];
            }

            if( isset( $attr['price'] ) ){
                $price = $attr['price'];
            }

            $classes = strlen( $classes ) ? 'class="' . $classes . '"' : '';

            $result .= '<div ' . $classes . '>';
            $result .= '<div class="header">';
            $result .= '<span>' . $title . '</span>';
            //$result .= '<span class="info">Perfect for web agencies</span>';
            $result .= '</div>';
            $result .= $content;

            if( isset( $attr['price'] ) ){
                $price = $attr['price'];
            }

            $result .= '<h3>' . $price . '</h3>';

            if( isset( $attr['href'] ) && !empty( $attr['href'] ) ){

                if( isset( $attr['button_label'] ) && !empty( $attr['button_label'] ) ){
                    $label = $attr['button_label'];
                }else{
                    $label = _e( 'Sign up' , 'cosmotheme' );
                }
                $result .= '<p class="button signup">';
                $result .= '<a href="' . $attr['href'] . '">' . $label . '</a>';
                $result .= '</p>';
            }

            $result .= '</div>';
            return $result;

        }

       	static function add_button( $atts , $content ){
        	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/template/shcode/button.php */
        	$sizes      = array( 'small' , 'medium' , 'large');
            $colors      = array( 'blue' , 'gray' , 'green', 'orange' , 'black', 'brown', 'pink', 'red');
            $style		= array('comment','download','print','delete','tick','info','demo','warning');
            
        	/*Set default values*/
        	$btn_size = '';
        	$btn_color = '';
        	$btn_link = '#';
        	$btn_title = 'Button';
        	$target="";
        	
        	
        	if(isset($atts[ 'style' ]) && in_array($atts[ 'style' ], $style) ){
        		$btn_style = $atts[ 'style' ];
	        }
        	
        	if(isset($atts[ 'size' ]) && in_array($atts[ 'size' ], $sizes) ){
        		$btn_size = $atts[ 'size' ];
	        	
        	}
        	
        	if(isset($atts[ 'color' ])  && in_array($atts[ 'color' ], $colors)  ){
	        	$btn_color = $atts[ 'color' ];
        	}
        	
            if(isset($atts[ 'link' ]) ){
            	$btn_link = $atts[ 'link' ];
            }

            if(isset($content) && trim($content) != ''){
            	$btn_title = $content;
            }

        	if(isset($atts[ 'new_window' ]) && $atts[ 'new_window' ] == 'true'){
            	$target='_blanck';
            }
            
            if($target == '_blanck'){
            	$onClick = 'onClick="window.open(\''.$btn_link.'\', \'_blank\')"';
            	$btn_link = 'javascript:void(0)';
            }
            else{
            	$onClick = '';
            } 
            
            if(isset($btn_style)){
            	$result = '<a href="'.$btn_link.'" '.$onClick.' class="cosmolink"><span class="cosmobutton gray '.$btn_style.'" type="button" ><span><span><span class="cosmo-ico">&nbsp;</span>'.$btn_title.'</span></span></span></a>';
            }
            else{
            	$result = '<a class="cosmolink" href="'.$btn_link.'" '.$onClick.' ><span type="button" class="cosmobutton '.$btn_color.' ' .$btn_size.'"><span><span>'.$btn_title.'</span></span></span></a>';
            }	
            
            return $result;
        }

        static function add_box( $atts , $content ){
        	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/template/shcode/box.php */
        	$box_type = array('default','info','warning','download','error','tick','demo','comment');
			$box_sizes = array('medium','large');
	
        	/*set the defaults:*/
        	
        	$box_size = '';
        	$box_style= 'default';
        	
        	if(isset($atts[ 'type' ]) && in_array($atts[ 'type' ], $box_type)  ){
        		$box_style = $atts[ 'type' ];
        	}
        	
        	if(isset($atts[ 'size' ]) && in_array($atts[ 'size' ], $box_sizes)  ){
        		$box_size = $atts[ 'size' ];
        	}
        	if($box_style == 'default'){
        		$ico = '';	
        	}
        	else{
        		$ico = '<span class="cosmo-ico"></span>';
        	}
            return '<div class="cosmo-box '.$box_style.' '.$box_size.' ">'.$ico. (de_remove_wpautop($content)).'</div>';
        }

    	static function add_unordered_list( $atts , $content ){
        	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/template/shcode/list.php */
        	$ul_styles = array('bullet','arrow','star','cancel','tick');
			
	
        	if(isset($atts[ 'style' ]) && in_array($atts[ 'style' ], $ul_styles) ){
        	
            	return '<div class="cosmo-unorderedlist '.$atts[ 'style' ].'">'.de_remove_wpautop($content).'</div>';
        	}	
        }
        
    	static function add_ordered_list( $atts , $content ){
        	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/template/shcode/list.php */
        	$ol_styles = array(	'decimal', 'armenian',	'decimal-leading-zero',	'georgian','lower-alpha',	'lower-greek',	'lower-latin',	'lower-roman',	'upper-alpha',	'upper-latin',	'upper-roman');
			
	
        	if(isset($atts[ 'style' ]) && in_array($atts[ 'style' ], $ol_styles) ){
        	
            	return '<div class="cosmo-orderedlist '.$atts[ 'style' ].'">'.de_remove_wpautop($content).'</div>';
        	}	
        }

        
    	static function add_highlight( $atts , $content ){
        	if(trim($content) != '')
        	{
        		return '<span class="cosmo-highlight">'.do_shortcode(de_remove_wpautop($content)).'</span>';	
        	}
        		
        }
        
   		static function add_dropcap( $atts , $content ){
        	if(trim($content) != '')
        	{
        		if(strlen($content)>1){
        			$content_left = mb_substr($content,1,strlen($content));
        		}
        		else{
        			$content_left = '';
        		} 
        		
        		return '<span class="dropcap">'.mb_substr($content,0,1).'</span>'.$content_left;	
        	}
        		
        }
        
        static function de_demo( $atts , $content ){
            $result = '<div class="shortcode_demo">';
            $result .= '<span class="demo_btn">+ Code Snippet</span>';
            $result .= '<div class="demo_code">';
            $result .= $content;
            $result .= '</div>';
            $result .= '</div>';

            return $result;
        }
		
        static function add_tabs( $atts , $content ){  
        	
        	$tabs_header_title = '';
        	if(isset($atts['title']) && $atts['title'] != '') $tabs_header_title = '<h4 class="tabs_title">'.$atts['title'].'</h4>';
        	
        	$style ='';
        	if(isset($atts['style']) && $atts['style'] != '') {$style = $atts['style'];}
        	if($tabs_header_title != '') {$style .= ' has_title';}
        	
			$tabs_ = explode('[/tab]',trim( trim( $content ) , '<br />'));  /*get an array of tabs*/
			
			/*count tabs that have content*/
			$nr_tabs_content = 0;
			foreach ($tabs_ as $tab_content) {
				if(trim( trim( $tab_content ) , '<br />') !='')  $nr_tabs_content ++;
				
			}
			if(count($tabs_)){
				$tabs_title = '<ul class="tabs-nav"> ';
				$tabs_content = '';
				
				$i=1;
				foreach ($tabs_ as $tab_content) {
					if(trim( trim( $tab_content ) , '<br />') !=''){
					
					preg_match_all( '/tab title="([^\"]+)"/i', $tab_content , $title_matches, PREG_OFFSET_CAPTURE );	
					$tab_title = '';
					if ( isset( $title_matches[1][0][0] ) ) { $tab_title = $title_matches[1][0][0]; } // End IF Statement
					
					
					$content = preg_replace('/\[tab title=.*?]/i','',$tab_content);
					
					if($i == 1) $title_class = 'first'; 
					else if($i == $nr_tabs_content) $title_class = 'last'; 
					else $title_class = '';
					
					$tab_id = mt_rand(1, 10000);
					$tabs_title .= '<li class="'.$title_class.'"><a href="#t'.$tab_id.'"><span>'.$tab_title.'</span></a></li>'; 
					$tabs_content .= '<div class="tabs-container" id="t'.$tab_id.'"><p>'.do_shortcode(trim(trim(de_remove_wpautop($content)))).'</p></div>';
						
					}
					
					$i++;
				}
				$tabs_title .= '</ul>';
			}	
			
			return $tabs_header_title.'<div class="cosmo-tabs '.$style.'" id="'.mt_rand(1, 100).'">'.$tabs_title.$tabs_content.'</div>';
			
		}
        
    	static function add_accordion( $atts , $content ){ 
        	
    		$tabs_ = explode('[/acc]',$content);  /*get an array of tabs*/
    		
    		if(count($tabs_)){
				
				$acc_content = '<div class="cosmo-accordion"> ';
				
				foreach ($tabs_ as $tab_content) {
					if(trim( trim( $tab_content ) , '<br />') !=''){
					
					preg_match_all( '/acc title="([^\"]+)"/i', $tab_content , $title_matches, PREG_OFFSET_CAPTURE );	
					$tab_title = '';
					if ( isset( $title_matches[1][0][0] ) ) { $tab_title = $title_matches[1][0][0]; } // End IF Statement
					
					
					$content = preg_replace('/\[acc title=.*?]/i','',$tab_content);
					
					$acc_content .= '<h2 class="cosmo-acc-trigger"><a href="#">'.$tab_title.'</a></h2>';
					$acc_content .= '<div class="cosmo-acc-container">'.do_shortcode(trim(trim(de_remove_wpautop($content)),'<br />')).'</div>';
					
					}
					
					
				}
				$acc_content .= '</div>';
				
				return $acc_content;
			}	
        }
		
    	static function add_hr( $atts , $content ){ 
        	return '<div class="cosmo-hr">&nbsp;</div>';
        }
    	
        static function add_divider( $atts , $content ){
        	return '<div class="cosmo-divider">&nbsp;</div>';
        }
        
     	static function add_toggle( $atts , $content ){
        	$defaults = array( 'title_open' => 'Hide the Content', 'title_closed' => 'Show the Content', 'hide' => 'true', 'border' => 'yes' );
        	extract( shortcode_atts( $defaults, $atts ) );

        	if($hide == 'true'){
        		$ico_class = 'show';
        		$title_closed_class = 'visible';
        		$title_open_class = 'hidden';
        		$div_class = 'open_title';
        	}
        	else{
        		$ico_class = 'hide';
        		$title_closed_class = 'hidden';
        		$title_open_class = 'visible';
        		$div_class = 'close_title';
        	}
     		return '<div class="cosmo-toggle"><div class="'.$div_class.'"><h2><a class="'.$ico_class.'"><span class="title_closed '.$title_closed_class.'">'.__($title_open).'</span><span class="title_open '.$title_open_class.'" >'.__($title_closed).'</span></a></h2></div><div class="cosmo-toggle-container '.$title_open_class.'">'.do_shortcode(de_remove_wpautop($content)).'</div></div>';
        }
        
    	static function add_quote( $atts , $content ){
        	if(isset($atts['style']) ) {$style = $atts['style']; } else {$style = '';}
     		if(isset($atts['float']) ) {$float = $atts['float']; } else {$float = '';} 
        	return '<div class="cosmo-blockquote '.$style.' '.$float.' "><p>'.de_remove_wpautop($content).'</p></div>';
        }
        
        
        /*Functions for columns shorcodes*/
    	static function de_twocol_one( $atts , $content ){ 
        	return  '<div class="twocol_one">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
        
    	static function de_twocol_one_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="twocol_one first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_twocol_one_last( $atts , $content ){ 
        	return  '<div class="twocol_one last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
        
    	static function de_threecol_one( $atts , $content ){ 
        	return  '<div class="threecol_one">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_threecol_one_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="threecol_one first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_threecol_one_last( $atts , $content ){ 
        	return  '<div class="threecol_one last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
        
 	   	static function de_threecol_two( $atts , $content ){ 
        	return  '<div class="threecol_two">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
        
    	static function de_threecol_two_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="threecol_two first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_threecol_two_last( $atts , $content ){ 
        	return  '<div class="threecol_two last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fourcol_one( $atts , $content ){ 
        	return  '<div class="fourcol_one">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fourcol_one_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fourcol_one first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fourcol_one_last( $atts , $content ){ 
        	return  '<div class="fourcol_one last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fourcol_two( $atts , $content ){ 
        	return  '<div class="fourcol_two">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fourcol_two_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fourcol_two first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
        static function de_fourcol_two_last( $atts , $content ){ 
        	return  '<div class="fourcol_two last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fourcol_three( $atts , $content ){ 
        	return  '<div class="fourcol_three">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fourcol_three_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fourcol_three first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fourcol_three_last( $atts , $content ){ 
        	return  '<div class="fourcol_three last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
        
   		static function de_fivecol_one( $atts , $content ){ 
        	return  '<div class="fivecol_one">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fivecol_one_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fivecol_one first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fivecol_one_last( $atts , $content ){ 
        	return  '<div class="fivecol_one last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fivecol_two( $atts , $content ){ 
        	return  '<div class="fivecol_two">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fivecol_two_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fivecol_two first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fivecol_two_last( $atts , $content ){ 
        	return  '<div class="fivecol_two last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fivecol_three( $atts , $content ){ 
        	return  '<div class="fivecol_three">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fivecol_three_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fivecol_three first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
        static function de_fivecol_three_last( $atts , $content ){ 
        	return  '<div class="fivecol_three last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fivecol_four( $atts , $content ){ 
        	return  '<div class="fivecol_four">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fivecol_four_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fivecol_four first">'.do_shortcode(de_remove_wpautop($content)).'</div>';
        }
    	static function de_fivecol_four_last( $atts , $content ){ 
        	return  '<div class="fivecol_four last">'.do_shortcode(de_remove_wpautop($content)).'</div><p class="clearfix"></p>';
        }
    }
?>
