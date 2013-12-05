<?php
	if(options::logic( 'general' , 'enable_breadcrumbs' )){ 
?>
<div class="b_page">
	<div class="breadcrumbs">
		<p><?php _e('You are here','cosmotheme') ?>:</p>
		<ul>
			<?php  if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		
		</ul>
	</div>
</div>	
<?php
	}
?>