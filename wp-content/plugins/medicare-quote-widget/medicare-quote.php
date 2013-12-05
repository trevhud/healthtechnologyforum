<?php 
/*
Plugin Name: Medicare Quote Widget
Plugin URI: http://blog.ehealthmedicare.com/medicare-quote-widget
Description: Sends entered zip code to the eHealth Medicare census page for a Medicare quote
Author: Trevor Hudson - eHealth Medicare	
Version: 1.4
Author URI: http://www.ehealthmedicare.com
*/

define('MedicareQuote_Path', plugin_dir_url( __FILE__ ));

class MedicareQuote extends WP_Widget {
          function MedicareQuote() {
                    $widget_ops = array(
                    'classname' => 'MedicareQuote',
                    'description' => 'Sends entered zip code to the eHealth Medicare census page for a Medicare quote'
          );

          $this->WP_Widget(
                    'MedicareQuote',
                    'Medicare Quote Widget',
                    $widget_ops
          );
}

          function widget($args, $instance) { // widget sidebar output
                    extract($args, EXTR_SKIP);
                    echo $before_widget; // pre-widget code from theme
print<<<EOM

<div style="border:2px solid; background: #fff; width: 190px; padding:10px; border-radius:25px; box-shadow: 8px 8px 5px #888888;">
       <h2 style="font-size:32px; padding: 15px; color:#092f5c; line-height: 35px; text-align:center">Get a Free Medicare Quote!</h2>
   <form action="http://www.ehealthmedicare.com/find-coverage?allid=Med35993" method="post" target="blank" _lpchecked="1">
<p style="font-size:16px; text-align:center">Zip Code:  <input type="text" name="zip" style="width:60px; height: 25px;"></p>
<p style="text-align:center"><input type="image" src="/wp-content/plugins/medicare-quote-widget/ehealth-medicare-go.png" title="Find Medicare Insurance Options" alt="Find Medicare Insurance Options" class="go-btn"></p>
</form>
<p style="text-align:center"><a href="http://www.ehealthmedicare.com" target="blank"><img src="/wp-content/plugins/medicare-quote-widget/ehealth-medicare-logo.gif"></a></p>

      </div>


EOM;

                    echo $after_widget; // post-widget code from theme
          
    }
}

add_action(
          'widgets_init',
          create_function('','return
      register_widget("MedicareQuote");')
);
    ?>