<!-- tags -->
<?php
	
	$post_type = $post -> post_type;
	if( in_array( $post_type , array( 'conference' , 'exhibitor' , 'sponsor' , 'speaker' , 'presentation' ) ) ){
		$tag_taxonomy = options::get_taxonomy( $post_type , 'tag' );
		$cat_taxonomy = options::get_taxonomy( $post_type , 'category' );
	}else{
		$tag_taxonomy="post_tag";
		$cat_taxonomy="category";
	}

    $tags = wp_get_post_terms( $post -> ID , $tag_taxonomy );

    if( !empty( $tags ) ){
?>
        <div class="b_tag clearfix">
        <?php
            foreach ($tags as $tag ) {
                $t = get_tag( $tag );
                echo '<p class="tags"><a href="'.get_tag_link( $tag ).'" rel="tags">' . $t -> name . '</a></p>';
            }
        ?>
        </div>
<?php
    }
?>

<!-- categories -->
<?php
    $categories = wp_get_post_terms( $post -> ID , $cat_taxonomy );
    if( !empty( $categories ) ){
?>
        <div  class="blog-meta category">
            <ul class="terms">
<?php
                foreach ( $categories as $category ) {
                    $cat = get_category( $category );
                    echo '<li><a href="'.get_category_link( $category ).'">' . $cat -> name . '</a></li>';
                }
?>
            </ul>
        </div>
<?php
    }
?>