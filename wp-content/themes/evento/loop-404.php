<!-- if not found post or is 404 error -->
<!-- error title -->
<div class="b w_940">
    <h2 class="entry-title page-title notfound">
        <?php 
            if( is_404() ){
                _e( 'Error 404, page, post or resource can not be found' , 'cosmotheme' );
            }else{
                _e( 'Sorry, no post found' , 'cosmotheme' );
            }
        ?>
    </h2>
</div>

<!-- left sidebar -->
<?php layout::get_side( 'left' , 0 , '404' ); ?>

<!-- content -->
<div class="b w_<?php echo layout::get_length( 0 , '404' ); ?>">
    <div class="b_text">
        <?php 
            _e( 'We apologize but this page, post or resource does not exist or can not be found. Perhaps it is necessary to change the call method to this page, post or resource.' , 'cosmotheme' );
        ?>
    </div>
</div>