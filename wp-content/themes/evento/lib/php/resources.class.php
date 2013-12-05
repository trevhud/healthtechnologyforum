<?php
    class resources{
        static $type;
        static $labels;
        static $taxonomy;
		static $box;
        function register(){
            if( !empty( self::$type ) ){
                foreach( self::$type as $res => $args ){
                    if( empty( $args )  ){
                        self::box( $res );
                    }else{
                        $label = self::$labels[ $res ];
                        $args['labels'] = $label;
                        /*$args['rewrite'] = array( 'slug' => $res , 'with_front' => false );*/
                        unset( $args['__on_front_page'] );
						if( isset( $args['rewrite'] ) ){
							if( isset ( $args['rewrite']['slug'] ) && ( strlen( $args['rewrite']['slug'] ) > 1 ) ){
								$args['has_archive'] = $args['rewrite']['slug'];
							}else{
								$args['has_archive'] = $res;
							}
						}else{
							$args['has_archive'] = $res;
						}
                        register_post_type( $res , $args );
                        self::taxonomy( $res );
                        self::box( $res );
                    }
                }
            }
        }

        function taxonomy( $res ){
            if( isset( self::$taxonomy[ $res ] ) ){
                foreach( self::$taxonomy[ $res ] as $tax => $args ){
					if( isset( $args['rewrite'] ) ){
							if( isset ( $args['rewrite']['slug'] ) && ( strlen( $args['rewrite']['slug'] ) > 1 ) ){
								$slug = $args['rewrite']['slug'];
							}else{
								$slug = $res.'-'.$tax;
							}
						}else{
							$slug = $res.'-'.$tax;
						}
                    register_taxonomy( $slug , array( $res ) , $args );
                }
            }
        }
		//add_meta_box(	'gallery-type-div', __('Gallery Type','cosmotheme'),  'gallery_type_metabox', 'gallery', 'normal', 'low');
		function box( $res ){
			if( isset( self::$box[ $res ] ) ){
				foreach( self::$box[ $res ] as $box => $args ){
                    add_action('admin_init', array( get_class() , 'addbox_' . $res . '_' . $box ) , 1 );
				}
			}
		}

        /* replace callStatic  with Callbox */
        function conference_presentation(){
            self::CallBox( 'conference_presentation' );
        }

        function conference_program(){
            self::CallBox( 'conference_program' );
        }

        function conference_location(){
            self::CallBox( 'conference_location' );
        }

        function conference_exhibitor(){
            self::CallBox( 'conference_exhibitor' );
        }

        function conference_sponsor(){
            self::CallBox( 'conference_sponsor' );
        }

    	function conference_testimonial(){
            self::CallBox( 'conference_testimonial' );
        }
        
        function conference_shcode(){
            self::CallBox( 'conference_shcode' );
        }

        function conference_guests(){
            self::CallBox( 'conference_guests' );
        }
        
        function conference_layout(){
            self::CallBox( 'conference_layout' );
        }
		 
		function conference_registration(){
            self::CallBox( 'conference_registration' );
        }

        function conference_tickets(){
            self::CallBox( 'conference_tickets' );
        }

        function conference_settings(){
            self::CallBox( 'conference_settings' );
        }

        function exhibitor_shcode(){
            self::CallBox( 'exhibitor_shcode' );
        }

        function exhibitor_conference(){
            self::CallBox( 'exhibitor_conference' );
        }

        function exhibitor_layout(){
            self::CallBox( 'exhibitor_layout' );
        }

        function exhibitor_settings(){
            self::CallBox( 'exhibitor_settings' );
        }

        function sponsor_shcode(){
            self::CallBox( 'sponsor_shcode' );
        }

        function sponsor_info(){
            self::CallBox( 'sponsor_info' );
        }

        function sponsor_conference(){
            self::CallBox( 'sponsor_conference' );
        }

        function sponsor_layout(){
            self::CallBox( 'sponsor_layout' );
        }

        function sponsor_settings(){
            self::CallBox( 'sponsor_settings' );
        }

        function presentation_speaker(){
            self::CallBox( 'presentation_speaker' );
        }

        function presentation_shcode(){
            self::CallBox( 'presentation_shcode' );
        }

        function presentation_conference(){
            self::CallBox( 'presentation_conference' );
        }

        function presentation_layout(){
            self::CallBox( 'presentation_layout' );
        }

        function presentation_docs(){
            self::CallBox( 'presentation_docs' );
        }

        function presentation_settings(){
            self::CallBox( 'presentation_settings' );
        }

        /*testimonial*/	
    	function testimonial_info(){
            self::CallBox( 'testimonial_info' );
        }
    	function testimonial_conference(){
            self::CallBox( 'testimonial_conference' );
        }
        
    	function testimonial_layout(){
            self::CallBox( 'testimonial_layout' );
        }
        
        /*speaker*/
        function speaker_shcode(){
            self::CallBox( 'speaker_shcode' );
        }

        
        function speaker_info(){
            self::CallBox( 'speaker_info' );
        }

        function speaker_presentation(){
            self::CallBox( 'speaker_presentation' );
        }

        function speaker_layout(){
            self::CallBox( 'speaker_layout' );
        }

        function speaker_settings(){
            self::CallBox( 'speaker_settings' );
        }

        function slideshow_manager(){
            self::CallBox( 'slideshow_manager' );
        }

        function slideshow_box(){
            self::CallBox( 'slideshow_box' );
        }

        function post_shcode(){
            self::CallBox( 'post_shcode' );
        }

        function post_layout(){
            self::CallBox( 'post_layout' );
        }

        function post_settings(){
            self::CallBox( 'post_settings' );
        }

        function page_shcode(){
            self::CallBox( 'page_shcode' );
        }

        function page_layout(){
            self::CallBox( 'page_layout' );
        }

        function page_settings(){
            self::CallBox( 'page_settings' );
        }

        function addbox_conference_presentation(){
            self::CallBox( 'addbox_conference_presentation' );
        }

        function addbox_conference_program(){
            self::CallBox( 'addbox_conference_program' );
        }

        function addbox_conference_location(){
            self::CallBox( 'addbox_conference_location' );
        }

        function addbox_conference_exhibitor(){
            self::CallBox( 'addbox_conference_exhibitor' );
        }

        function addbox_conference_sponsor(){
            self::CallBox( 'addbox_conference_sponsor' );
        }
        
    	function addbox_conference_testimonial(){
            self::CallBox( 'addbox_conference_testimonial' );
        }
        
        function addbox_conference_shcode(){
            self::CallBox( 'addbox_conference_shcode' );
        }

        function addbox_conference_guests(){
            self::CallBox( 'addbox_conference_guests' );
        }

        function addbox_conference_layout(){
            self::CallBox( 'addbox_conference_layout' );
        }

		function addbox_conference_registration(){
            self::CallBox( 'addbox_conference_registration' );
        }

        function addbox_conference_tickets(){
            self::CallBox( 'addbox_conference_tickets' );
        }

        function addbox_conference_settings(){
            self::CallBox( 'addbox_conference_settings' );
        }

        function addbox_exhibitor_shcode(){
            self::CallBox( 'addbox_exhibitor_shcode' );
        }

        function addbox_exhibitor_conference(){
            self::CallBox( 'addbox_exhibitor_conference' );
        }

        function addbox_exhibitor_layout(){
            self::CallBox( 'addbox_exhibitor_layout' );
        }

        function addbox_exhibitor_settings(){
            self::CallBox( 'addbox_exhibitor_settings' );
        }

        function addbox_sponsor_shcode(){
            self::CallBox( 'addbox_sponsor_shcode' );
        }

        function addbox_sponsor_info(){
            self::CallBox( 'addbox_sponsor_info' );
        }
        function addbox_sponsor_conference(){
            self::CallBox( 'addbox_sponsor_conference' );
        }

        function addbox_sponsor_layout(){
            self::CallBox( 'addbox_sponsor_layout' );
        }

        function addbox_sponsor_settings(){
            self::CallBox( 'addbox_sponsor_settings' );
        }

        function addbox_presentation_speaker(){
            self::CallBox( 'addbox_presentation_speaker' );
        }

        function addbox_presentation_shcode(){
            self::CallBox( 'addbox_presentation_shcode' );
        }

        function addbox_presentation_conference(){
            self::CallBox( 'addbox_presentation_conference' );
        }

        function addbox_presentation_layout(){
            self::CallBox( 'addbox_presentation_layout' );
        }

        function addbox_presentation_docs(){
            self::CallBox( 'addbox_presentation_docs' );
        }

        function addbox_presentation_settings(){
            self::CallBox( 'addbox_presentation_settings' );
        }

        /*testtimonial*/
    	function addbox_testimonial_info(){
            self::CallBox( 'addbox_testimonial_info' );
        }
        	
    	function addbox_testimonial_conference(){
            self::CallBox( 'addbox_testimonial_conference' );
        }
        
    	function addbox_testimonial_layout(){
            self::CallBox( 'addbox_testimonial_layout' );
        }
        
        /*speaker*/
        function addbox_speaker_shcode(){
            self::CallBox( 'addbox_speaker_shcode' );
        }

        function addbox_speaker_info(){
            self::CallBox( 'addbox_speaker_info' );
        }

        function addbox_speaker_presentation(){
            self::CallBox( 'addbox_speaker_presentation' );
        }

        function addbox_speaker_layout(){
            self::CallBox( 'addbox_speaker_layout' );
        }

        function addbox_speaker_settings(){
            self::CallBox( 'addbox_speaker_settings' );
        }

        function addbox_slideshow_manager(){
            self::CallBox( 'addbox_slideshow_manager' );
        }

        function addbox_slideshow_box(){
            self::CallBox( 'addbox_slideshow_box' );
        }

        function addbox_post_shcode(){
            self::CallBox( 'addbox_post_shcode' );
        }

        function addbox_post_layout(){
            self::CallBox( 'addbox_post_layout' );
        }

        function addbox_post_settings(){
            self::CallBox( 'addbox_post_settings' );
        }

        function addbox_page_shcode(){
            self::CallBox( 'addbox_page_shcode' );
        }

        function addbox_page_layout(){
            self::CallBox( 'addbox_page_layout' );
        }

        function addbox_page_settings(){
            self::CallBox( 'addbox_page_settings' );
        }

        
        static function  CallBox( $name , $args = null ) {
			global $post;
            $items = explode( '_' , $name );

            if( $items[0] == 'addbox' ){

                foreach( self::$box[ $items[1] ] as $box => $args ){
                    add_meta_box( $items[1] . '_' . $box , $args[0] , array( get_class() , $items[1] . '_' . $box ) , $items[1] , $args[1] , $args[2] );

                    if( isset( $_POST[ $box ] ) ){
                        if( isset( $args[ 'update' ] ) && $args[ 'update' ] ){
                            $new_value = $_POST[ $box ];
                            if( is_array( $args['content'] ) ){
                                foreach( $args['content'] as $name => $fields ){
                                    $type = explode( '--' , $fields['type'] );
                                    if( isset( $type[1] ) && $type[1] == 'checkbox' ){
                                        if( !isset( $new_value[ $name ] ) ){
                                            $new_value[ $name ] = '';
                                        }
                                    }
                                }
                            }
                            if( isset( $_POST[ 'post_ID' ] ) ){
                                meta::set_meta( $_POST[ 'post_ID' ] , $box , $new_value );
                            }
                            
                        }
                    }
                }
            }else{
                if( isset( self::$box[ $items[0] ][ $items[1] ][ 'callback' ] ) ){
                    
                    if( self::$box[ $items[0] ][ $items[1] ][ 'callback' ][0] == 'get_meta_records' ){
                        $fn_result =  meta::get_meta_records( $post -> ID , $items );

                        if( !empty( $fn_result ) ){
                            $classes = "postbox";
                        }else{
                            $classes = '';
                        }

                        echo '<div id="box_' . $items[0] .'_'. $items[1] .'" class="' . $classes . '" >';
                        echo $fn_result;
                        echo '</div>';
                        
                    }else{                    
                        $fn = self::$box[ $items[0] ][ $items[1] ][ 'callback' ][0];
                        $fn_result = $fn( $post -> ID , self::$box[ $items[0] ][ $items[1] ][ 'callback' ][1] ) ;
                        
                        if( !empty( $fn_result ) ){
                            $classes = "postbox";
                        }else{
                            $classes = '';
                        }

                        echo '<div id="box_' . $items[0] .'_'. $items[1] .'" class="' . $classes. '" >';
                        echo $fn_result;
                        echo '</div>';
                        
                    }
                    
                }

                if( isset( self::$box[ $items[0] ][ $items[1] ][ 'includes' ] ) ){
                    include get_template_directory(). '/lib/php/' . self::$box[ $items[0] ][ $items[1] ][ 'includes' ];
                }

                if( isset( self::$box[ $items[0] ][ $items[1] ][ 'content' ] ) ){

                    if( isset( self::$box[ $items[0] ][ $items[1]][ 'box'  ] ) ){
                        $box = self::$box[ $items[0] ][ $items[1]][ 'box'  ];
                    }else{
                        $box = $items[1];
                    }

					echo '<div id="form' . $box . '">';


                    foreach( self::$box[ $items[0] ][ $items[1]][ 'content'  ] as $side => $field ){
                        $field['side'] 		= $side;
                        $field['box']  		= $box;
						$field['res']  		= $items[0];
						$field['post_id']  	= $post -> ID;
                        $field['pos']  		= self::$box[ $items[0] ][ $items[1]][1];
                        $meta  = meta::get_meta( $post -> ID , $box );
                        $value = isset( $meta[ $side ] ) ? $meta[ $side ] : '';
                        if( !isset( $field['value'] ) ){
                            $field['value'] = $value;
                        }

                        if( !isset( $field['ivalue'] ) ){
                            $field['ivalue'] = $value;
                        }

                        

                        /* special for upload-id*/
                        $type = explode( '--' , $field['type'] );
                        if( isset( $type[1] ) && $type[1] == 'upload-id' ){
                            $value_id = isset( $meta[ $side .'_id' ] ) ? $meta[ $side .'_id' ] : 0;
                            $field['value_id'] = $value_id;
                        }

                        $field['topic']  	= $side;
						$field['group']  	= $box;

                        echo fields::layout( $field );
                    }
					echo '</div>';
                }
            }
        }
    }
?>
