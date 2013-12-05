<?php
	class layout{
        function get_side( $side = 'right' , $post_id = 0 , $template = null ){
            if( strlen( $side ) ){
                if( $post_id > 0 ){
                    $layout = meta::get_meta( $post_id , 'layout' );

                    if( isset( $layout['type'] ) && !empty( $layout['type'] ) ){
                        $result = $layout['type'];
                    }else{
                        
                        if( strlen( $template ) ){
                            $result = options::get_value( 'layout' , $template );
                        }else{
                            $result = $side;
                        }
                    }
                }else{
                    if( strlen( $template ) ){
                        $result = options::get_value( 'layout' , $template );
                    }else{
                        $result = $side;
                    }
                }

                if( $result == $side ){
                    echo '<div id="primary"><!--right side-->';
                    echo '<div class="b w_300">';
                    echo '<ul class="xoxo">';
                    if( isset( $layout['sidebar'] ) && !empty( $layout['sidebar'] ) ){
                        if(dynamic_sidebar ( $layout['sidebar'] ) ){

                        }
                    }else{
                        get_sidebar( );
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }

        function get_length( $post_id = 0 , $template = null ){
            $layout = meta::get_meta( $post_id , 'layout' );
            if( isset( $layout['type'] ) && !empty( $layout['type'] ) && $layout['type'] == 'full' ) {
                $length = 940;
            }else{
                if( strlen( $template ) ){
                    $result = options::get_value( 'layout' , $template );
                    if( $result == 'full' ){
                        if( isset( $layout['type'] ) && $layout['type'] != 'full' ){
                            $length = 620;
                        }else{
                            $length = 940;
                        }
                    }else{
                        $length = 620;
                    }
                }
            }

            return $length;
        }

	}
?>