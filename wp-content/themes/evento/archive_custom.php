<?php
/*This template is used for testimonials, locations and Trainers archive*/
$result = '';
$result .= '<li>';
	                        if( has_post_thumbnail ( $post -> ID ) ){
	                            $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , '150xXXX' , true );
	                            $result .= '<div class="wp-caption alignleft circle">';
	                            $result .= '<a href="' . get_permalink( $post -> ID  ) . '">';
	                            $result .= '<img src="' . $src[0] . '" alt="' . $post -> post_title . '" />';
	                            $result .= '</a>';
	                            $caption = shcode::caption( $post );
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
	                    	
	                        if(is_post_type_archive('testimonial')){
		                        $testimonial_info = meta::get_meta( $post -> ID, 'info' );
		                    	$author_title = '';
								if($testimonial_info['title'] != ''){
									$author_title = '<span class="testimonial_author_title"> ' . $testimonial_info['title'] . '</span>';
								}
								$result .= '<span class="testimonial_author_name"> '.__($testimonial_info['name']).'</span>';
								$result .= $author_title;
							}
	                        $result .= '</h4>';
	                        
	                        /*$result .= '<span  class="exc">' . __($post -> post_content) . '</span>';*/
	                        if($post -> post_excerpt != '' ){
		        				$result .= '<span  class="exc">' . __(get_the_excerpt_here($post -> ID)) . '</span>';
		        			}else{
		        				$result .= '<span  class="exc">' . strip_tags(__(mb_substr($post -> post_content,0,EXCERPT_CHAR_LEN)) ). '</span>';  
		        			}
	                        
	                        $continue_reading_txt = __( 'Continue reading' , 'cosmotheme' );
	                        $result .= '<p class="button readmore hover margin15">';
	                        $result .= '<a href="' . get_permalink( $post -> ID ) . '">' . $continue_reading_txt . '<span>&nbsp;</span></a>';
	                        $result .= '</p>';
	
	                        $result .= '</li>';
	                        
	                        echo $result;

?>