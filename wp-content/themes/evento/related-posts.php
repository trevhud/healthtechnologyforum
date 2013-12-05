<?php
    /* related posts by herarchical taxonomy */
    /* get tax slugs and number of similar posts  */
    $is_guest           = false;
    $is_conference      = false;
    $is_presentation    = false;
    $is_speaker         = false;
    
    function similar_query( $post_id , $taxonomy , $nr ){
        if( $nr > 0 ){
            $topics = wp_get_post_terms( $post_id , $taxonomy );

            $terms = array();
            if( !empty( $topics ) ){
                foreach ( $topics as $topic ) {
                    $term = get_category( $topic );
                    array_push( $terms, $term -> slug );
                }
            }

            if( !empty( $terms ) ){
                $query = new WP_Query( array(
                    'post__not_in' => array( $post_id ) ,
                    'posts_per_page' => $nr,
                    'tax_query' => array(
                        array(
                        'taxonomy' => $taxonomy ,
                        'field' => 'slug',
                        'terms' => $terms ,
                        )
                    )
                ));
            }else{
                $query = array();
            }
        }else{
            $query = array();
        }

        return $query;
    }
   
    /* conference taxonomy */
    if( is_singular( 'conference' ) ){
        $tax    = options::get_taxonomy( 'conference' , 'category' );
        $nr     = (int)options::get_value( 'blog_post' , 'conf_similar' );
        $label  = __( 'Related Conferences' , 'cosmotheme' );
        $query  = similar_query( $post -> ID , $tax  , $nr );
        $length = layout::get_length( $post -> ID , 'conference' );

        $is_conference = true;

        if( !empty( $query ) ){
            if( $query -> found_posts < $nr ){
                $nr = $query -> found_posts;
            }

            $result = $query -> posts;
        }

    }

    /* presentation taxonomy */
    if( is_singular( 'presentation' ) ){
        $tax = options::get_taxonomy( 'presentation' , 'category' );
        $nr  = (int)options::get_value( 'blog_post' , 'present_similar' );
        $label  = __( 'Related Presentations' , 'cosmotheme' );
        $length = layout::get_length( $post -> ID , 'presentation' );

        $is_presentation = true;

        $query  = new WP_Query( array( 'pospost_status' => 'publish' , 'posts_per_page' => -1 , 'post_type' => 'conference' ) );

        $result = array();
        foreach( $query -> posts as $p  ){
            $meta_present = meta::get_meta( $p -> ID , 'presentation' );
            foreach( $meta_present as $presentation ){
                /* check if is this presentation in conference */
                if( $presentation['idrecord'] == $post -> ID ){
                    foreach( $meta_present as $presentation ){
                        if( count( $result ) <  $nr && !in_array( $presentation['idrecord'] , $result ) && $presentation['idrecord'] != $post -> ID ){
                            $post_presentation = get_post( $presentation['idrecord'] );
                            if( $post_presentation -> post_status == 'publish' ){
                                $result[ $post_presentation -> ID ] = $post_presentation;
                            }
                        }
                    }
                }
            }
        }

        if( count( $result ) < $nr ){
            $nr = count( $result );
        }
    }

    /* speaker */
    if( is_singular ( 'speaker' ) ){
        $nr  = (int)options::get_value( 'blog_post' , 'speaker_similar' );
        $label  = __( 'Similar Speakers' , 'cosmotheme' );
        $query  = new WP_Query( array( 'pospost_status' => 'publish' , 'posts_per_page' => -1 , 'post_type' => 'conference' ) );
        $length = layout::get_length( $post -> ID , 'speaker' );

        $is_speaker = true;

        $result = array();
        foreach( $query -> posts as $p  ){
            $meta_present = meta::get_meta( $p -> ID , 'presentation' );
            foreach( $meta_present as $presentation ){
                $meta_speaker = meta::get_meta( $presentation['idrecord'] , 'speaker' );
                foreach( $meta_speaker as $speaker ){
                    /* check if is this speaker in presentation */
                    if( $speaker['idrecord']  == $post -> ID ){
                        foreach( $meta_speaker as $speaker ){
                            if( count( $result ) <  $nr && !in_array( $speaker['idrecord'] , $result ) && $speaker['idrecord'] != $post -> ID ){
                                $post_speaker = get_post( $speaker['idrecord'] );
                                if( $post_speaker -> post_status == 'publish' ){
                                    $result[ $post_speaker -> ID ] = $post_speaker;
                                }
                            }
                        }
                    }
                }
            }
        }

        if( count( $result ) < $nr ){
            $nr = count( $result );
        }
    }

    if( is_author () ){
        $nr  = (int)options::get_value( 'blog_post' , 'author_similar' );
        $label  = __( 'Other guests' , 'cosmotheme' );
        $query  = new WP_Query( array( 'pospost_status' => 'publish' , 'posts_per_page' => -1 , 'post_type' => 'conference' ) );
        $length = layout::get_length( 0 , 'author' );
        
        $is_guest = true;

        $result = array();
        foreach( $query -> posts as $p  ){
            $meta_guests = meta::get_meta( $p -> ID , 'guests' );
            
            foreach( $meta_guests as $guest ){
                if( count( $result ) <  $nr && !in_array( $guest['idrecord'] , $result ) && $guest['idrecord'] != get_the_author_meta('ID') ){

                    if( get_the_author_meta( 'first_name' , $guest['idrecord'] ) != '' || get_the_author_meta( 'last_name' , $guest['idrecord'] ) != '' ){
                        $data['title'] = get_the_author_meta( 'first_name' , $guest['idrecord'] ) . ' ' . get_the_author_meta( 'last_name' , $guest['idrecord'] ) . ' (' . get_the_author_meta( 'nickname' , $guest['idrecord'] ) . ') ';
                    }else{
						$data['title'] = get_the_author_meta( 'nickname' , $guest['idrecord'] ) ;
					}

                    $data['id'] = $guest['idrecord'];
                    $data['description'] = get_the_author_meta( 'description' , $guest['idrecord'] ) ;
                    $data['link'] = get_author_posts_url( $guest['idrecord'] );

                    $result[] = $data;
                }
            }
        }

        if( count( $result ) < $nr ){
            $nr = count( $result );
        }
    }

    /* post taxonomy */
    if( !isset( $result ) ){
        $tax = 'category';
        $nr = (int)options::get_value( 'blog_post' , 'post_similar' );
        $label  = __( 'Related Posts' , 'cosmotheme' );
        $query  = similar_query( $post -> ID , $tax , $nr );
        $length = layout::get_length( $post -> ID , 'single' );

        if( !empty( $query ) ){
            if( $query -> found_posts < $nr ){
                $nr = $query -> found_posts;
            }

            $result = $query -> posts;
        }
        
    }

    

    if( !empty( $result) && meta::logic( $post , 'settings' , 'related' ) ){
?>
    <div class="related">
        <p class="delimiter">&nbsp;</p>
        <div class="box-related clearfix">
            <h3 class="related-title"><?php echo $label; ?></h3>
            <p class="delimiter">&nbsp;</p>
            <?php
                if( (int)$length == 940 ){
                    $div = 3;
                }else{
                    $div = 2;
                }

                $i = 1;
                $k = 1;

                
                
                foreach( $result as $similar ){
                    if( $i == 1 ){
                        if( ( $nr - $k ) < $div  ){
                            $classes = 'class="last"';
                        }else{
                            $classes = '';
                        }
                        echo '<div ' . $classes . '>';
                    }

                    /* guests */
                    if( $is_guest ){
                ?>
                        <div class="col">
                            <a href="<?php echo $similar['link']; ?>"><?php echo get_avatar($similar['id'] , $size = '60' );  ?></a>
                            <h4>
                                <a href="<?php echo $similar['link']; ?>"><?php echo $similar['title']; ?></a>
                                <span class="title"><?php echo $similar['description']; ?></span>
                            </h4>
                        </div>
                <?php
                        if( $i % $div == 0 ){
                            echo '</div>';
                            $i = 0;
                        }

                        $i++;
                        $k++;

                        continue;
                    }

                
                    /* featured image */
                    $text = '';
                    $image = '';
                    if( has_post_thumbnail( $similar -> ID ) ){

                        $image = wp_get_attachment_image( get_post_thumbnail_id( $similar -> ID ) , '62x62' );

                        $args = array(
                            'numberposts' => -1,
                            'post_type' => 'attachment',
                            'status' => 'publish',
                            'post_mime_type' => 'image',
                            'post_parent' => $similar -> ID
                        );

                        $images = &get_children( $args );

                        if( !empty( $images ) ){
                            $text = $images[ get_post_thumbnail_id( $similar -> ID ) ] -> post_excerpt;
                        }else{
                            $text = '';
                        }
                    }else{
                        $image = '<img src="' . get_template_directory_uri() . '/images/no_image.jpg" />';
                    }

                    /*  related presentation */
                    if( $is_conference ){
                ?>
                        <div class="col">
                            <a href="<?php echo get_permalink( $similar -> ID ) ?>"><?php echo $image ?></a>
                            <h4>
                                <a class="readmore" href="<?php echo get_permalink( $similar -> ID ) ?>"><?php echo $similar -> post_title; ?></a>
                                <span>
                                <?php
                                    echo mb_substr( strip_tags( $similar -> post_excerpt ) , 0 , 75 );
                                ?>
                                </span>
                            </h4>
                        </div>
                <?php
                        if( $i % $div == 0 ){
                            echo '</div>';
                            $i = 0;
                        }

                        $i++;
                        $k++;

                        continue;
                    }

                    /*  related presentation */
                    if( $is_presentation ){
                ?>
                        <div class="col">
                            <a href="<?php echo get_permalink( $similar -> ID ) ?>"><?php echo $image ?></a>
                            <h4>
                                <a class="readmore" href="<?php echo get_permalink( $similar -> ID ) ?>"><?php echo $similar -> post_title; ?></a>
                                <span>
                                <ul>
                                <?php
                                    /* get speakers from presentations */
                                    $speakers  = meta::get_meta( $similar -> ID , 'speaker' ) ;
                                    foreach( $speakers as $index => $speaker ){
                                        $sp = get_post( $speaker['idrecord'] );
                                        /* title speaker */
                                        echo '<li>' . $sp -> post_title . '</li>';
                                    }
                                ?>
                                </ul>
                                </span>
                            </h4>
                        </div>
                <?php
                        if( $i % $div == 0 ){
                            echo '</div>';
                            $i = 0;
                        }

                        $i++;
                        $k++;

                        continue;
                    }

                    /* related speakers */
                    if( $is_speaker ){
                ?>
                        <div class="col">
                            <a href="<?php echo get_permalink( $similar -> ID ) ?>"><?php echo $image ?></a>
                            <h4>
                                <a class="readmore" href="<?php echo get_permalink( $similar -> ID ) ?>"><?php echo $similar -> post_title; ?></a>
                                <span class="title">
                                <?php
                                    $meta_speaker = meta::get_meta( $similar -> ID , 'info' );
                                    echo isset( $meta_speaker['study'] ) && !empty( $meta_speaker['study'] ) ? $meta_speaker['study'] : '';
                                    echo isset( $meta_speaker['university'] ) && !empty( $meta_speaker['university'] ) ? ', ' . $meta_speaker['university'] : '';
                                ?>
                                </span>
                            </h4>
                        </div>
                <?php
                        if( $i % $div == 0 ){
                            echo '</div>';
                            $i = 0;
                        }

                        $i++;
                        $k++;

                        continue;
                    }

                ?>
                    <div class="col">
                        <?php
                            if( strlen( $image ) ){
                        ?>
                                <a href="<?php echo get_permalink( $similar -> ID ) ?>"><?php echo $image ?></a>
                        <?php
                            }
                        ?>
                        <h4>
                            <a class="readmore" href="<?php echo get_permalink( $similar -> ID ) ?>"><?php echo $similar -> post_title; ?></a>
                            <span><?php echo date(get_option( 'date_format' ) , (int)strtotime( $similar -> post_modified ) );  ?></span>
                            <?php
                                if('open' == $post-> comment_status ) {
                            ?>
                                    <span>
                                        <a href="<?php echo get_comments_link( $similar -> ID ) ?>">
                                            <?php
                                                echo get_comments_number( $similar -> ID );
                                                if( get_comments_number( $similar -> ID ) != 1 ) {
                                            ?>
                                                    comments
                                            <?php
                                                }else{
                                            ?>
                                                    comment
                                            <?php
                                                }
                                            ?>
                                        </a>
                                    </span>
                            <?php
                                }
                            ?>
                        </h4>
                    </div>
                    <?php
                        if( $i % $div == 0 ){
                            echo '</div>';
                            $i = 0;
                        }

                        $i++;
                        $k++;
                    ?>
            <?php
                }

            /* if div container is open */
            if( $i > 1 ){
                echo '</div>';
            }

            ?>
        </div> <!--  end container related posts -->
    </div>
<?php

        wp_reset_postdata();
    }
?>
    