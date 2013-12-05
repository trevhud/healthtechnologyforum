<div id="sign_up">
    <h4><?php _e('Please sign in using the form below' , 'cosmotheme' ) ; ?></h4>
    <div id="sign_up_form">
        <?php
            $page = get_page_by_title( 'Registration');
            $link = get_permalink( $page -> ID );
        ?>
        <form action="<?php echo wp_login_url( $link ); ?>" method="post">
			<fieldset>
				<label><?php _e( 'Username' , 'cosmotheme' ); ?>:</label>
				<p class="input"><input type="text" class="" name="log" tabindex="10" /></p>
				<label><?php _e( 'Password' , 'cosmotheme' ); ?>:</label>
				<p class="input"><input type="password" class="" name="pwd" tabindex="10" /></p>
				<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90"> <?php _e( 'Remember Me' , 'cosmotheme' ); ?></label>
				<div id="actions">
					<p class="button blue hover">
						<input type="submit" name="wp-submit" value="<?php _e( 'Sign in' , 'cosmotheme'); ?>" class="form_button" id="log_in" tabindex="100" />
						<input type="hidden" name="redirect_to" value="<?php echo $link; ?>">
						<input type="hidden" name="testcookie" value="1">
					</p>
				</div>
			</fieldset>
        </form>
    </div>
    <span><a href="<?php echo wp_lostpassword_url(); ?>"><?php _e( 'Lost your password?' , 'cosmotheme' ); ?></a></span> | <span><a href="<?php echo wp_login_url( ); ?>?action=register"><?php _e( 'Register' , 'cosmotheme' ); ?></a></span>
    <a id="close_x" class="close sprited" href="#"><?php _e( 'close' , 'cosmotheme' ); ?></a>
</div>