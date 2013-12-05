<div class="standard-generic-field generic-field-resource">
    <div class="generic-label"><label for="conference_resource"><?php _e('Select Conference Resource','cosmotheme') ?></label></div>
    <div class="generic-field generic-field-select">
        <select id="conference_resource" onchange="javascript:act.hide('.generic-field-add-shortcode-b');act.hide('.generic-field-add-shortcode-a');act.hide('.generic-field-presentation'); if( jQuery('#conference_resource option:selected').val() == 'conferences'){ act.show('.generic-field-conferances' ) ; act.hide('.generic-field-conferance'); }else{act.show('.generic-field-conferance' ) ; act.hide('.generic-field-conferances');}">
            <option><?php _e('Select Conference Resource','cosmotheme'); ?></option>
            <option value="conferences"><?php _e('Conferences','cosmotheme'); ?></option>
            <option value="presentations"><?php _e('Presentations','cosmotheme'); ?></option>
            <option value="speakers"><?php _e('Speakers','cosmotheme'); ?></option>
            <option value="exhibitors"><?php _e('Exhibitors','cosmotheme'); ?></option>
            <option value="sponsors"><?php _e('Sponsors','cosmotheme'); ?></option>
            <option value="program"><?php _e('Program','cosmotheme'); ?></option>
            <option value="guests"><?php _e('Guests','cosmotheme'); ?></option>
            <option value="testimonials"><?php _e('Testimonials','cosmotheme'); ?></option>
            <option value="pricing"><?php _e('Pricing','cosmotheme'); ?></option>
        </select>
    </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-conferance hidden">
    <div class="generic-label"><label for="conference_resource"><?php _e('Select Conference','cosmotheme'); ?></label></div>
    <div class="generic-field generic-field-select">
        <select id="conference" onchange="javascript:act.select( '#conference_resource' , {'conferences' : 'generic-field-conferances' , 'speakers' : '.generic-field-presentation' ,'pricing' : '.generic-field-add-shortcode-a', 'presentations' : '.generic-field-add-shortcode-a' , 'exhibitors' : '.generic-field-add-shortcode-a' , 'sponsors' : '.generic-field-add-shortcode-a' , 'program'  : '.generic-field-add-shortcode-a' , 'guests'  : '.generic-field-add-shortcode-a' , 'testimonials'  : '.generic-field-testimonial'   } , 'sh_'  );">
            <?php
                $posts = get__posts( array( 'post_type' => 'conference','numberposts' => -1 ) );
                foreach( $posts as $id => $title ){
                    echo '<option value="' . $id . '">' . __($title) . '</option>';
                }
            ?>
        </select>
    </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-conferances hidden">
    <div class="generic-label"><label for="conference_resource"><?php _e('Select Conference','cosmotheme'); ?></label></div>
    <div class="generic-field generic-field-select">
        <select id="conferences" onchange="javascript:act.select( '#conference' , { 'all_conferences':'.generic-field-add-shortcode-all-conferences' , 'else':'.generic-field-add-shortcode-a-conferences'  } , 'sh_' )">
            <?php
                $posts = get__posts( array( 'post_type' => 'conference','numberposts' => -1 ) );
                
                foreach( $posts as $id => $title ){
                    echo '<option value="' . $id . '">' . __($title) . '</option>';
                }
                echo '<option value="all_conferences">'.__('All Conferences (list)','cosmotheme').'</option>';
            ?>
        </select>
    </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-presentation hidden">
    <div class="generic-label"><label for="presentation"><?php _e('Select Presentation','cosmotheme'); ?> </label></div>
    <div class="generic-field generic-field-select">
        <select id="presentation" onchange="javascript:act.select( '#presentation' , { 'all_presentationa':'.generic-field-add-shortcode-a' , 'else':'.generic-field-add-shortcode-b'  } , 'sh_' )">
            <?php
                $posts = get__posts( array( 'post_type' => 'presentation','numberposts' => -1 ) );

                
                foreach( $posts as $id => $title ){
                    echo '<option value="' . $id . '">' . __($title) . '</option>';
                }
                echo '<option value="all_presentationa">'.__('All Presentations','cosmotheme').'</option>';
            ?>
        </select>
    </div>
    <div class="clear"></div>
</div>
<div class="standard-generic-field generic-field-testimonial hidden">
    <div class="generic-label"><label for="testimonial"><?php _e('Select Listing type','cosmotheme'); ?> </label></div>
    <div class="generic-field generic-field-select">
        <select id="testimonial" onchange="javascript:act.select( '#testimonial' , { 'list_all_testimonials':'.generic-field-add-shortcode-a' , 'else':'.generic-field-add-shortcode-animated-testimonials'  } , 'sh_' )">
            <option value=""><?php _e('Select option','cosmotheme')?></option>
            <option value="list_all_testimonials"><?php _e('List of all testimonials','cosmotheme')?></option>
            <option value="animate_testimonials"><?php  _e('Animated testimonials','cosmotheme') ?></option>
        </select>
    </div>
    <div class="clear"></div>
</div>
<div class="standard-generic-field generic-field-add-shortcode-a hidden">
    <div class="generic-label"></div>
    <div class="generic-field generic-field-button">
        <input type="button" value="<?php _e('Add Shortcode','cosmotheme'); ?>" class="generic-record-button  button-primary" onclick="javascript:Editor.AddText( 'content' , '['+ extra.val('#conference_resource') +' conf_id=' +  extra.val('select#conference') +''+'/]');showNotify();"/>
    </div>
    <div class="clear"></div>
</div>
<div class="standard-generic-field generic-field-add-shortcode-a-conferences hidden">
    <div class="generic-label"></div>
    <div class="generic-field generic-field-button">
        <input type="button" value="<?php _e('Add Shortcode','cosmotheme'); ?>" class="generic-record-button  button-primary" onclick="javascript:Editor.AddText( 'content' , '['+ extra.val('#conference_resource') +' conf_id=' +  extra.val('select#conferences') +''+'/]');showNotify();"/>
    </div>
    <div class="clear"></div>
</div>
<div class="standard-generic-field generic-field-add-shortcode-b hidden">
    <div class="generic-label"></div>
    <div class="generic-field generic-field-button">
        <input type="button" value="<?php _e('Add Shortcode','cosmotheme'); ?>" class="generic-record-button  button-primary" onclick="javascript:Editor.AddText( 'content' , '['+ extra.val('#conference_resource') +' presentation_id=' +  extra.val('select#presentation') +''+'/]');showNotify();"/>
    </div>
    <div class="clear"></div>
</div>

<div class="standard-generic-field generic-field-add-shortcode-animated-testimonials hidden">
    <div class="generic-label"></div>
    <div class="generic-field generic-field-button">
        <input type="button" value="<?php _e('Add Shortcode','cosmotheme'); ?>" class="generic-record-button  button-primary" onclick="javascript:Editor.AddText( 'content' , '['+ extra.val('#conference_resource') +' conf_id=' +  extra.val('select#conference') +' '+ ' display_mode=animated' +' /]');showNotify();"/>
    </div>
    <div class="clear"></div>
</div>


<div class="standard-generic-field generic-field-add-shortcode-all-conferences hidden">
    <div class="generic-label"></div>
    <div class="generic-field generic-field-button">
        <input type="button" value="<?php _e('Add Shortcode','cosmotheme'); ?>" class="generic-record-button  button-primary" onclick="javascript:Editor.AddText( 'content' , '['+ extra.val('#conference_resource') +' conf_id=all' +' /]');showNotify();"/>
    </div>
    <div class="clear"></div>
</div>