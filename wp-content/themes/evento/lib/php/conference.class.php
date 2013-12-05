<?php
    class conference {
        function readmore( $id  ){
            $result  = '<p class="button readmore hover margin15">';
            $result .= '<a href="' . get_permalink( $id ) . '">' . __( 'continue reading' , 'cosmotheme' ) . '<span>&nbsp;</span></a>' ;
            $result .= '</p>';

            return $result;
        }
        /* speakers */
        /* get conference speakers */
        function speakers( $post_id , $limit = 10, $category=false ){
            /* get presentations */
            $presentations = meta::get_meta( $post_id , 'presentation' );
            foreach( $presentations as $presentation ){
                $post = get_post( $presentation['idrecord'] );
                /* get speakers from presentations */
                $presentations_speakers[]  = meta::get_meta( $post -> ID , 'speaker' ) ;
            }

            $speakers = array();
            $result   = '';
            /* filter speakers  */
            if( !empty( $presentations_speakers ) ){
                foreach( $presentations_speakers as $all_speakers ){
                    foreach( $all_speakers as $speaker ){
                        if( !in_array( $speaker['idrecord'] , $speakers ) ){
                            $speakers[] = $speaker['idrecord'];
                        }
                    }
                }

                /* get list with speakers */
                $result .= '<ul>';
                foreach( $speakers as $index => $speaker ){
                    
                    $post = get_post( $speaker );
					if( $category ){
						if( !has_term( $category , options::get_taxonomy( 'speaker' , 'category' ) , $post->ID ) ){
							continue;
						}
					}
                    $meta = meta::get_meta( $speaker , 'info' );

                    $result .= '<li>';
                    if( has_post_thumbnail( $speaker  ) ){

                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $speaker ) , array( 26 , 26 ) , true );
                        $img = '<a href="' . get_permalink( $post -> ID  ). '"><img src="' . $src[0] . '" alt="' . $post -> post_title . '" /></a>';
                    }else{
                        $img = '<a href="' . get_permalink( $post -> ID  ). '"><img src="' . get_template_directory_uri() . '/images/no_image.jpg" /></a>';
                    }
                    $result .= $img;
                    $result .= '<h4>';
                    $study   = isset( $meta['study'] ) && strlen( $meta['study'] ) ? $meta['study']  : '';
                    $univ    = isset( $meta[ 'university' ] ) && strlen( $meta[ 'university' ] ) ? $meta[ 'university' ] : '';

                    $result .= '<a href="' . get_permalink( $post -> ID  ). '" class="readmore">' . __($post -> post_title) . '<span class="mosaic-overlay">&nbsp;</span></a>';
                    $result .= '<span>' . $study . '</span>';
                    $result .= '<span>'. $univ .'</span>';
                    $result .= '</h4>';
                    $result .= '</li>';
                    if( $limit != 0 && $index == $limit - 1 ){
                        break;
                    }
                }
                $result .= '</ul>';
            }
            return $result;
        }

        function get_conferences( $type = 'latest' , $nr=2 , $show_images = true, $category=false ){
        	$result ='';	
        	
        		$numberposts = 1;
        		if( $type != "latest" ){
        			$numberposts = -1;
        		}
        		$args = array(
						    'numberposts'     => $numberposts,
						    'post_type'       => 'conference',
            				'order' 		  => 'DESC' 
						     );
				$posts = get_posts( $args ); 
				$result .= '<ul>';
				$conf_count = 0;
				foreach ($posts as $post) {
					if( $category ){
						if( !has_term( $category , options::get_taxonomy( 'conference' , 'category' ) , $post->ID ) ){
							continue;
						}
					}
					$conf_settings = meta::get_meta($post -> ID,'settings' ); 
					if( ($type == "latest") || ( (!isset($conf_settings['archive']) || (isset($conf_settings['archive']) && $conf_settings['archive'] == 'no')) && $conf_count<$nr) ){
						$result .= '<li>';
						$additional_class =' ';
						if($show_images){
							if( has_post_thumbnail( $post -> ID  ) ){
								$src = wp_get_attachment_image_src( get_post_thumbnail_id(  $post -> ID ) , '62x62' , true );
								$img = '<a href="' . get_permalink( $post -> ID  ). '"><img src="' . $src[0] . '" alt="' . $post -> post_title . '" /></a>';
								
							}else{
								$img = '<a href="' . get_permalink( $post -> ID  ). '"><img src="' . get_template_directory_uri() . '/images/no_image.jpg" /></a>';
							}
							$result .= $img;
				
							$additional_class =' img';	
						}
						
						$result .= '<a href="' . get_permalink( $post -> ID  ). '" class="readmore '.$additional_class.'">' . __($post -> post_title) . '<span class="mosaic-overlay">&nbsp;</span></a>';
						$events    = meta::get_meta( $post -> ID , 'program' );
						$location   = meta::get_meta( $post -> ID , 'location' );
						if(  is_array( $events ) ){
							$result .=  '<span class="date">';
							$mn = fields::months_array( );
							
							if( count( $events ) ){

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

								$result .= $date_result;
								
							}
							$result .=  '</span>';
						}
						$result .= '</li>';
						$conf_count ++;
					}	
				}
				$result .= '</ul>';
        	
        	
        	return $result;
        }
        
        function get_speakers( $post_id ){
            /* get presentations */
            $presentations = meta::get_meta( $post_id , 'presentation' );
            foreach( $presentations as $presentation ){
                $post = get_post( $presentation['idrecord'] );
                /* get speakers from presentations */
                $presentations_speakers[]  = meta::get_meta( $post -> ID , 'speaker' ) ;
            }

            $speakers = array();
            /* filter speakers  */
            if( !empty( $presentations_speakers ) ){
                foreach( $presentations_speakers as $all_speakers ){
                    foreach( $all_speakers as $speaker ){
                        if( !in_array( $speaker['idrecord'] , $speakers ) ){
                            $speakers[] = $speaker['idrecord'];
                        }
                    }
                }
            }
            return $speakers;
        }

        /* get presentation speakers */
        function presentation_speakers( $post_id , $limit = 10 ){
            $presentation = get_post( $post_id );
            /* get speakers from presentations */
            $speakers  = meta::get_meta( $presentation -> ID , 'speaker' ) ;

            $result   = '';
            foreach( $speakers as $index => $speaker ){

                $post = get_post( $speaker['idrecord'] );
                $meta = meta::get_meta( $speaker , 'info' );

                if( has_post_thumbnail( $speaker  ) ){
                    $src = wp_get_attachment_image_src( get_post_thumbnail_id( $speaker ) , '62x62' , true );
                    $img = '<img src="' . $src[0] . '" alt="' . $post -> post_title . '" />';
                }else{
                    $img = '<img src="' . get_template_directory_uri() . '/images/no_image.jpg" />';
                }
                $result .= '<p class="conference-item">';
                $study   = isset( $meta['study'] ) && strlen( $meta['study'] ) ? $meta['study'] . ',' : '';
                $university = isset( $meta[ 'university' ] ) && strlen( $meta[ 'university' ] ) ? $meta[ 'university' ] : '';

                $result .= '<a href="' . get_permalink( $post -> ID  ). '">' . $img . '<span class="info">' . __($post -> post_title) . ' <i>' . $study . ' '. $university .'</i></span></a>';
                $result .= '</p>';

                if( $limit != 0 && $index == $limit - 1 ){
                    break;
                }
            }

            if( $limit != 0 && count( $speakers ) >= $limit  ){

            }

            return $result;
        }

        /* presentations */
        /* get conference presentations */
        function presentations( $post_id , $limit = 0, $category=false){
            $presentations = meta::get_meta( $post_id , 'presentation' );
            $result = '';
            if( count( $presentations ) ){
                $result .= '<ul>';
				$counter = 1;
                foreach( $presentations as $index => $presentation ){
					$post = get_post( $presentation['idrecord'] );
					if( $category ){
						if( !has_term( $category , options::get_taxonomy( 'presentation' , 'category' ) , $post->ID ) ){
							continue;
						}
					}
                    /* title conference */
                    $result .= '<li><a href="' . get_permalink( $post -> ID ) . '" class="readmore">' . __($post -> post_title) . '<span class="mosaic-overlay">&nbsp;</span></a>';
                    /* list speakers */
                    $result .= '<ul>';
                    $presentation = get_post( $post -> ID );
                    /* get speakers from presentations */
                    $speakers  = meta::get_meta( $presentation -> ID , 'speaker' ) ;
                    foreach( $speakers as $sp_index => $speaker ){
                        $sp = get_post( $speaker['idrecord'] );
                        $result .= '<li>' . __($sp -> post_title) . '</li>';
                    }
                    $result .= '</ul>';
                    $result .= '</li>';
                    if( $limit != 0 && $counter ==  $limit){
						 break; 
					}

					$counter ++;
                }
                $result .= '</ul>';
            }
            return $result;
        }

        /*get conference testimonials*/
        function get_testimonials( $post_id , $limit = 0 ){
        	$testimonials = meta::get_meta( $post_id , 'testimonial' );  /*get testimonials related to given conference*/
            $result = '';
            
            /*if there are any testimonials ...*/
            if( count( $testimonials ) ){
            	$result .= '<div class="cosmo-testimonials " >
								<div class="slides_container">';
            	foreach( $testimonials as $index => $testimonial ){
            		$post = get_post( $testimonial['idrecord'] );  /*get testimonial info*/
            			
            		$result .= '<div>';
            		$result .= '	<ul>';
            		$result .= '		<li>';

            			
            		if( has_post_thumbnail( $post -> ID  ) ){
                        $result .= '<a href="' . get_permalink( $post -> ID  ). '" class="hover">'.wp_get_attachment_image( get_post_thumbnail_id( $post -> ID ), '62x62' ).'</a>';
                    }
            		$testimonial_info = meta::get_meta( $post->ID, 'info' ); 
					if($testimonial_info['name'] != ''  || $testimonial_info['title'] != ''){
						$result .= '<p class="author">';
						$result .= '<span class="name">'.__($testimonial_info['name']).'</span>'; /**author name*/
						$result .= '<span class="title">'.__($testimonial_info['title']).'</span>'; /*author title*/
						$result .= '</p>';
						
					}
					
					$result .= '<p class="cite">
									<cite>'.__($post -> post_content).'</cite>
								</p>';				
            		$result .= '		</li>';
            		$result .= '	</ul>';
            		$result .= '</div>';
            		
            	}
            	$result .= '	</div>';
            	if(count( $testimonials ) > 1){
            	$result .= '<span class="actions">
								<a class="prev"><i class="b-pager__arr">←</i> Previous</a>
								<a class="next">Next <i class="b-pager__arr">→</i></a>
							</span>';
            	}
            	$result .= '</div>';
            	
                
            }
            return $result;
        }
        
        /* exhibitors */
        /* get conference exhibitors */
        function exhibitors( $post_id , $limit = 0 , $excerpt = true , $category=false ){
            $exhibitors = meta::get_meta( $post_id , 'exhibitor' );
            $result = '';
            if( count( $exhibitors ) ){
                $result .= '<ul>';
                foreach( $exhibitors as $index => $exhibitor ){
					$post = get_post( $exhibitor['idrecord'] );
					if( $category ){
						if( !has_term( $category , options::get_taxonomy( 'exhibitor' , 'category' ) , $post->ID ) ){
							continue;
						}
					}
				
                    $result .= '<li>';
					
                    if( has_post_thumbnail( $post -> ID  ) ){
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , '62x62' , true );
                        $result .= '<a href="' . get_permalink( $post -> ID  ). '" class="readmore"><img src="' . $src[0] . '" alt="' . $post -> post_title . '" /></a>';
                    }else{
                        $result .= '<a href="' . get_permalink( $post -> ID  ). '"><img src="' . get_template_directory_uri() . '/images/no_image.jpg" /></a>';
                    }

                    $result .= '<h4>';
                    $result .= '<a href="' . get_permalink( $post -> ID  ). '" class="readmore">' . __($post -> post_title) . '<span class="mosaic-overlay">&nbsp;</span></a>';
                    if( $excerpt ){
                        $result .= '<span class="desc">' . mb_substr( __($post -> post_excerpt) , 0 , 250 ) . '</span>';
                    }
                    $result .= '</h4>';

                    $result .= '</li>';

                    if( $limit != 0 && $index == $limit - 1 ){
                        break;
                    }
                }
                $result .= '</ul>';
            }

            return $result;
        }

        /* sponsors */
        /* get conference sponsors */
        function sponsors( $post_id , $limit = 0 , $excerpt = true, $category=false ){
            $sponsors = meta::get_meta( $post_id , 'sponsor' );
            $result = '';
            if( count( $sponsors ) ){
                $result .= '<ul>';
                foreach( $sponsors as $index => $sponsor ){
					$post = get_post( $sponsor['idrecord'] );
					if( $category ){
						if( !has_term( $category , options::get_taxonomy( 'sponsor' , 'category' ) , $post->ID ) ){
							continue;
						}
					}
                    $result .= '<li>';
                    if( has_post_thumbnail( $post -> ID  ) ){
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , array( 26 , 26 ) , true );
                        $result .= '<a href="' . get_permalink( $post -> ID  ). '" ><img src="' . $src[0] . '" alt="' . $post -> post_title . '" /></a>';
                    }else{
                        $result .= '<a href="' . get_permalink( $post -> ID  ). '"><img src="' . get_template_directory_uri() . '/images/no_image.jpg" /></a>';
                    }

                    $result .= '<h4>';
                    $result .= '<a href="' . get_permalink( $post -> ID  ). '" class="readmore">' . __($post -> post_title) . '<span class="mosaic-overlay">&nbsp;</span></a>';
                    if( $excerpt ){
                        $result .= '<span class="desc">' . __($post -> post_excerpt) . '</span>';
                    }
                    $result .= '</h4>';
                    $result .= '</li>';
                    if( $limit != 0 && $index == $limit - 1 ){
                        break;
                    }
                }
                $result .= '</ul>';
            }

            return $result;
        }

        /* get conference sponsors for animated widget*/
        function get_sponsors_animated($post_id , $total_limit = 0 , $visible_limit = 1, $show_name = false ){
        	$sponsors = meta::get_meta( $post_id , 'sponsor' ); /*array containing sponsors IDs*/
            $result = '';
            
            if( count( $sponsors ) ){
            	if($visible_limit > $total_limit) { 
            		$visible_limit = $total_limit; 
            	}
            	$result .= '<div class="cosmo-sponsor">
								<div class="slides_container">';
            	$counter = 1;
            	$is_opened_item_container = false;
            	foreach( $sponsors as $index => $sponsor ){
            		$post = get_post( $sponsor['idrecord'] );	
            		if( ($counter % $visible_limit) == 1 && $visible_limit != 1){
            			$result .= '<div>';
            			$result .= '	<ul>';
            			$is_opened_item_container = true; /*flag that we have oppened the item container*/
            		}
            		
            		/*if showing just one sponsor, we need to open/close the container during each iteration*/
            		if($visible_limit == 1){
            			$result .= '<div>';
            			$result .= '	<ul>';
            		}
            		
            		$result .= '<li>';
            		if($show_name){
            			$result .= '<h4>';
            			$result .= '<a href="'.get_permalink( $post -> ID  ).'" class="readmore">'.__($post -> post_title).'<span class="mosaic-overlay">&nbsp;</span></a>';
            			$result .= '</h4>';
            		}
            		if( has_post_thumbnail( $post -> ID  ) ){
                        $result .= '<a href="' . get_permalink( $post -> ID  ). '" >'.wp_get_attachment_image( get_post_thumbnail_id( $post -> ID ), '300xXXX' ).'</a>';
                    }	
						
					$result .= '</li>';	
            		
            		if( ($counter % $visible_limit) == 0 && $visible_limit != 1){
            			$result .= '	</ul>';
            			$result .= '</div>';
            			
            			$is_opened_item_container = false; /*flag that we have closed the item container*/
            		}
            		/*if showing just one sponsor, we need to open/close the container during each iteration*/
            		if($visible_limit == 1){
            			$result .= '	</ul>';
            			$result .= '</div>';
            		}
            		$counter ++;
            	}
            	
            	/*if container was not closed during the iteration, we close it*/
            	if($is_opened_item_container){
            		$result .= '	</ul>';
            		$result .= '</div>';
            		
            	}
            	$result .= '	</div>
            				</div>';
                
            }

            return $result;	
        }	
        
        /* program */
        /* get conference program */
        function program ( $post_id , $limit = 0 , $description = false, $class_ul = 'ul' ){
            $events = meta::get_meta( $post_id , 'program' );
            $result = '';
            $show_more = false;

            $mn = fields::months_array( );
            if( count( $events ) ){ 
				$index = 0;
                foreach( $events as $index => $event ){ 
                    $mktm1 = mktime( 0 , 0 , 0 , (int)$event['start_m'] , (int)$event['start_d'], (int)$event['start_y'] );
                    $mktm2 = mktime( (int)$event['start_hour'] , (int)$event['start_min'] , $index , (int)$event['start_m'] , (int)$event['start_d'], (int)$event['start_y'] );
                    $new_event[ $mktm1 ][ $mktm2 ] = $event; 
					$index ++;
                }
                /* asc sort by d/m/y */
                ksort( $new_event ); 
                $result .= '<ul class="program ' . $class_ul . '">';
                $i = 0;
                foreach( $new_event as $date => $events ){
					
                    $day = date( get_option('date_format' ) , $date );
                    $result .= '<li>' . $day ;
                    $result .= '<ul>';
                    /* asc sort by h:m on this day */
                    ksort( $events );
					$prev_iteration_time = ''; /*will be used to make posible to group events that are holding on the same time */
                    foreach( $events as $index => $event ){
                        $i++;
                        $result .= '<li>';
                        $start_time = $event['start_hour'] . ':' . $event['start_min']; 
						$end_time = $event['end_hour'] . ':' . $event['end_min'];
						/*check if current event time is the same as the previous one*/
						/*if ($prev_iteration_time != date(get_option( time_format ),strtotime($start_time) ).' - '. date(get_option( time_format ),strtotime($end_time) )){*/
							$result .= '<span class="time">';
							$result .= date(get_option( 'time_format' ),strtotime($start_time) ).' - '. date(get_option( 'time_format' ),strtotime($end_time) );
							$prev_iteration_time = date(get_option( 'time_format' ),strtotime($start_time) ).' - '. date(get_option( 'time_format' ),strtotime($end_time) );
							$result .= '</span>';
						/*}*/	
                        $result .= '<span class="event">' . __($event['title']) . '</span>';

                        if( $description ){
                            $result .= '<span class="event">' . __($event['description']) . '</span>';
                        }
                        
                        $result .= '</li>';
                        
                        if( $limit != 0 && $i == $limit ){
                            break;
                        }
					}
                    $result .= '</ul>';
                    $result .= '</li>';
                    if( $limit != 0 && $i == $limit ){
                        break;
                    }
                }
                $result .= '</ul>';
            }
 
            return $result;
        }

        /* guests */
        /* get conference guests */
        function guests( $post_id , $limit = 0 , $class_ul = 'ul'){
            $guests = meta::get_meta( $post_id , 'guests' );
            $result = '';

            if( count( $guests ) ){
                $result .= '<ul class="guests ' . $class_ul . '">';
                foreach( $guests as $index => $guest ){
                    $result .= '<li>' . __(get_the_author_meta( 'first_name' , $guest['idrecord'] ) ) . ' ' . __(get_the_author_meta( 'last_name' , $guest['idrecord'] ) ) . ' ( ' . get_the_author_meta( 'nickname' , $guest['idrecord'] ) . ' )</li>';
                    
                    if( $limit != 0 && $index == $limit - 1 ){
                        break;
                    }
                }
                $result .= '</ul>';
            }

            return $result;
        }
        
        /*returns an Associative array with currencies supported by PayPal (for now)*/
        function get_currencies(){
        	$currencies = array('AUD' => 'Australian Dollar (A $)',
        						'CAD' => 'Canadian Dollar (C $)',
        						'EUR' => 'Euro (€)',
        						'GBP' => 'British Pound (£)',
        						'JPY' => 'Japanese Yen (¥)',
        						'USD' => 'U.S. Dollar ($)',
        						'NZD' => 'New Zealand Dollar ($)',
        						'CHF' => 'Swiss Franc',
        						'HKD' => 'Hong Kong Dollar ($)',
        						'SGD' => 'Singapore Dollar ($)',
        						'SEK' => 'Swedish Krona',
        						'DKK' => 'Danish Krone',
        						'PLN' => 'Polish Zloty',
        						'NOK' => 'Norwegian Krone',
        						'HUF' => 'Hungarian Forint',
        						'CZK' => 'Czech Koruna',
        						'ILS' => 'Israeli New Shekel',
        						'MXN' => 'Mexican Peso',
        						'BRL' => 'Brazilian Real (only for Brazilian members)',
        						'MYR' => 'Malaysian Ringgit (only for Malaysian members)',
        						'PHP' => 'Philippine Peso',
        						'TWD' => 'New Taiwan Dollar',
        						'THB' => 'Thai Baht',
        						'TRY' => 'Turkish Lira (only for Turkish members)'		);
        		
			return $currencies;
        }
        
        function get_pricing($post_id = 0){ 
        	$result = '';	
        	if(is_numeric($post_id) && $post_id > 0 ){
        		
        		
        		
        		
        		$registration = meta::get_meta( $post_id , 'registration' );
        		
        		if(isset($registration['enabled']) && $registration['enabled'] == 'paid_registration'){
        			$tickets = meta::get_meta( $post_id , 'tickets' ); 
        			
        			$result .= '<table class="ticket_prices">';
        			$result .= '<tr>';
        			$result .= '	<th>'.__('Category','cosmotheme').'</th>';
        			$result .= '	<th>'.__('Number','cosmotheme').'</th>';
        			$result .= '	<th>'.__('Still available','cosmotheme').'</th>';
        			$result .= '	<th>'.__('Price','cosmotheme').'</th>';
        			$result .= '	<th></th>';
        			$result .= '</tr>';
        			foreach ($tickets as $index => $ticket) {
        				
	        			$result .= '<tr id="row_'.$index.'_'.$post_id.'">';
	        			$result .= '	<td>'.$ticket['ticket_title'].'</td>';
	        			$result .= '	<td><input type="text" class="digit ticket_qty" id="qty_'.$index.'_'.$post_id.'" value="0"></td>';
	        			$result .= '	<td><span id="qty_available_'.$index.'_'.$post_id.'">'.$ticket['ticket_qty_available'].'</span></td>';
	        			$result .= '	<td>'.$registration['currency'].' ' .$ticket['ticket_price'].'</td>';
	        			$result .= '	<td><a href="javascript:void(0)" onclick="AddToCart(\''.$ticket['ticket_title'].'\',jQuery(\'#qty_'.$index.'_'.$post_id.'\').val(),'.$ticket['ticket_price'].','.$post_id.',\'add_to_cart\')">Add to cart</td>';
	        			$result .= '</tr>';
        			
        			}
        			$result .= '</table>';
        		}
        		

				//$result = number_format($number,2);        		
        	} 
        	//delete_post_meta($post_id, 'tickets' );
        	
        	return $result;
        }
    }
?>
