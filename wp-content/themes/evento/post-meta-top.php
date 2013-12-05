<div class="blog-meta">
    <ul>
        <li class="user" title="Author">Written by <a href="<?php echo get_author_posts_url( $post-> post_author ) ?>"><?php echo get_the_author_meta( 'display_name' , $post-> post_author ) ?></a></li>
        <li class="time"><?php the_time(get_option( 'date_format' )); echo ' '.__('at','cosmotheme').' '; the_time(get_option( 'time_format' ));?></li>
        <?php edit_post_link( __( 'Edit', 'cosmotheme' ), '<li class="edit_post" title="' . __( 'Edit' , 'cosmotheme' ) . '">', '</li>' ); ?>
        <?php
            if ( comments_open() ){
        ?>
        <li class="cosmo-comments" title="<?php echo get_comments_number( $post -> ID ) ?> Comments"><a href="<?php echo get_comments_link( $post -> ID ) ?>"> <?php echo get_comments_number( $post -> ID ) ?> </a></li>
        <?php
            }
        ?>
    </ul>
</div>