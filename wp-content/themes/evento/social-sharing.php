<?php
    /* social sharing  */
    if( is_attachment () ){
        $sharing = options::logic( 'blog_post' , 'attachment_sharing' );
    }else{
        $sharing = meta::logic( $post , 'settings' , 'sharing' );
    }

    if( $sharing ){
?>
        <div id="share_buttons_wrapper"><!--Share this post-->
            <div id="share_buttons_single_page" class="share_buttons_single_page">
                <div class="cosmo-sharing" >
                    <ul class="reset">
                        <li><a target="_blank" href="http://twitter.com/home?status=Currently reading <?php the_permalink(); ?>" class="tooltip" title="<?php _e( 'Tweet this!' , 'cosmotheme' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt="<?php _e( 'Tweet this!' , 'cosmotheme' ); ?>" /></a></li>
                        <li><a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&t=<?php echo urlencode(the_title('','', false)) ?>" class="tooltip" title="<?php _e('Share on Facebook','cosmotheme') ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt="<?php _e('Share on Facebook','cosmotheme') ?>" /></a></li>
                        <li><a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php echo urlencode(the_title('','', false)); ?>" class="tooltip" title="<?php _e('Stumble it','cosmotheme') ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/stumbleupon.png" alt="<?php _e('Stumble it','cosmotheme') ?>" /></a></li>
                        <li><a target="_blank" href="http://reddit.com/submit?url=<?php the_permalink() ?>&title=<?php echo urlencode(the_title('','', false)) ?>" class="tooltip" title="<?php _e('Share on Reddit','cosmotheme') ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/reddit.png" alt="<?php _e('Share on Reddit','cosmotheme') ?>" /></a></li>
                        <li><a target="_blank" href="http://digg.com/submit?phase=2&url=<?php the_permalink(); ?>&title=<?php echo urlencode(the_title('','', false)) ?>" class="tooltip" title="<?php _e('Digg it','cosmotheme') ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/digg.png" alt="<?php _e('Digg it','cosmotheme') ?>" /></a></li>
                        <li><a target="_blank" href="http://del.icio.us/post?url=<?php the_permalink(); ?>&title=<?php echo urlencode(the_title('','', false)) ?>" class="tooltip" title="<?php _e('Add to Delicious!','cosmotheme') ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/delicious.png" alt="<?php _e('Add to Delicious!','cosmotheme') ?>" /></a></li>
                        <li><a target="_blank" href="http://technorati.com/faves?add=<?php the_permalink(); ?>" class="tooltip technorati" title="<?php _e('Add to Technorati','cosmotheme') ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/technorati.png" alt="<?php _e('Add to Technorati','cosmotheme') ?>" /></a></li>
                        <li><a target="_blank" href="http://www.google.com/bookmarks/mark?op=add&bkmk=<?php the_permalink(); ?>&title=<?php echo urlencode(the_title('','', false)) ?>" class="tooltip" title="<?php _e('Add to Google','cosmotheme') ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/google.png" alt="<?php _e('Add to Google','cosmotheme') ?>" /></a></li>
                        <li><a target="_blank" href="http://www.myspace.com/Modules/PostTo/Pages/?c=<?php the_permalink(); ?>&t=<?php echo urlencode(the_title('','', false)) ?>" class="tooltip" title="<?php _e('Add to Myspace','cosmotheme') ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/myspace.png" alt="<?php _e('Add to Myspace','cosmotheme') ?>" /></a></li>
                        <li><a target="_blank" href="<?php bloginfo('rss2_url'); ?>" class="tooltip" title="<?php _e('Subscribe to RSS','cosmotheme') ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/social/rss.png" alt="<?php _e('Subscribe to RSS','cosmotheme') ?>" /></a></li>
                    </ul>
                </div>
			</div>
		</div>
<?php
    }
?>
