<?php
    /* author box  */
    if( meta::logic( $post , 'settings' , 'author' ) ){
?>
        <p class="delimiter">&nbsp;</p>

        <div class="box-author clearfix">
            <a href="<?php echo get_author_posts_url( $post -> post_author) ?>"><?php echo get_avatar( $post -> post_author , $size = '60',$default = DEFAULT_AVATAR );  ?></a>
            <h3>
                <?php _e( 'About' , 'cosmotheme' ); ?>  <a href="<?php echo get_author_posts_url( $post -> post_author) ?>" ><?php echo get_the_author(); ?></a>
                <?php
                    $author_bio = get_the_author_meta( 'description' , $post -> post_author );

                    if( $author_bio != '' ){
                        echo '<span>' . $author_bio . '</span>';
                    }
                ?>
            </h3>
        </div>

        
<?php
    }
?>