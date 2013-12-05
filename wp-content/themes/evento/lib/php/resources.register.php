<?php
    /* post type conference */
    $res['conference']['labels'] = array(
        'name' => _x(__('Conferences','cosmotheme'), 'post type general name'),
        'singular_name' => _x(__('Conference','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Conference','cosmotheme')),
        'add_new_item' => __('Add New Conference','cosmotheme'),
        'edit_item' => __('Edit Conference','cosmotheme'),
        'new_item' => __('New Conference','cosmotheme'),
        'view_item' => __('View Conference','cosmotheme'),
        'search_items' => __('Search Conferences','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['conference']['args'] = array(
        'public' => true,
        'hierarchical' => false,
		'rewrite' => array( 'slug' => options::get_value( 'blog_post' , 'conf_slug' ), 'with_front' => true ),
        'menu_position' => 3,
        'supports' => array('title','editor','excerpt','comments','thumbnail'),
        '__on_front_page' => true
    );

    /* labels for taxonomy */
    $labels['conference']['category'] = array(
        'name' => _x( 'Category', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Categories','cosmotheme' ),
        'all_items' => __( 'All Categories','cosmotheme' ),
        'parent_item' => __( 'Parent Category','cosmotheme' ),
        'parent_item_colon' => __( 'Parent Category:','cosmotheme' ),
        'edit_item' => __( 'Edit Category','cosmotheme' ),
        'update_item' => __( 'Update Category','cosmotheme' ),
        'add_new_item' => __( 'Add New Category','cosmotheme' ),
        'new_item_name' => __( 'New Category Name','cosmotheme' ),
    );
    $labels['conference']['tag'] = array(
        'name' => _x( 'Tags', 'taxonomy general name' ),
        'singular_name' => _x( 'Tags', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Tags','cosmotheme' ),
        'popular_items' => __( 'Popular Tags','cosmotheme' ),
        'all_items' => __( 'All Tags','cosmotheme' ),
        'edit_item' => __( 'Edit Tag','cosmotheme' ),
        'update_item' => __( 'Update Tag','cosmotheme' ),
        'add_new_item' => __( 'Add New Tag','cosmotheme' ),
        'new_item_name' => __( 'New Tag','cosmotheme' ),
        'separate_items_with_commas' => __( 'Separate markers with commas','cosmotheme' ),
        'add_or_remove_items' => __( 'Add or remove Tags','cosmotheme' ),
        'choose_from_most_used' => __( 'Choose from the most used tags','cosmotheme' )
    );

	/* labels for exhibitors */
	$labels['exhibitor']['category']=$labels['conference']['category'];
	$labels['exhibitor']['tag']=$labels['conference']['tag'];

	/* labels for sponsors */
	$labels['sponsor']['category']=$labels['conference']['category'];
	$labels['sponsor']['tag']=$labels['conference']['tag'];

	/* labels for presentations */
	$labels['presentation']['category']=$labels['conference']['category'];
	$labels['presentation']['tag']=$labels['conference']['tag'];

	/* labels for speakers */
	$labels['speaker']['category']=$labels['conference']['category'];
	$labels['speaker']['tag']=$labels['conference']['tag'];

    /*  conference taxonomy */
    $tax['conference']['category'] = array(
        'hierarchical' => true,
        'rewrite' => array(
            'slug' => options::get_taxonomy( 'conference' , 'category' ),
            'hierarchical' => true,
            ),
        'labels' => $labels['conference']['category']
    );
    $tax['conference']['tag'] = array(
		'rewrite' => array(
			'slug' => options::get_taxonomy( 'conference' , 'tag' )
			),
		'labels' => $labels['conference']['tag']
	);

	/* exhibitors taxonomy */

	$tax['exhibitor']['category'] = array(
        'hierarchical' => true,
        'rewrite' => array(
            'slug' => options::get_taxonomy( 'exhibitor' , 'category' ),
            'hierarchical' => true,
            ),
        'labels' => $labels['exhibitor']['category']
    );
    $tax['exhibitor']['tag'] = array(
		'rewrite' => array(
			'slug' => options::get_taxonomy( 'exhibitor' , 'tag' )
			),
		'labels' => $labels['exhibitor']['tag']
	);

	/* sponsors taxonomy */
	
	$tax['sponsor']['category'] = array(
        'hierarchical' => true,
        'rewrite' => array(
            'slug' => options::get_taxonomy( 'sponsor' , 'category' ),
            'hierarchical' => true,
            ),
        'labels' => $labels['sponsor']['category']
    );
    $tax['sponsor']['tag'] = array(
		'rewrite' => array(
			'slug' => options::get_taxonomy( 'sponsor' , 'tag' ),
			),
		'labels' => $labels['sponsor']['tag']
	);

	/* presentation taxonomy */

	$tax['presentation']['category'] = array(
        'hierarchical' => true,
        'rewrite' => array(
            'slug' => options::get_taxonomy( 'presentation' , 'category' ),
            'hierarchical' => true,
            ),
        'labels' => $labels['presentation']['category']
    );
    $tax['presentation']['tag'] = array(
		'rewrite' => array(
			'slug' => options::get_taxonomy( 'presentation' , 'tag' ),
			),
		'labels' => $labels['presentation']['tag']
	);

	/* speaker taxonomy */

	$tax['speaker']['category'] = array(
        'hierarchical' => true,
        'rewrite' => array(
            'slug' => options::get_taxonomy( 'speaker' , 'category' ),
            'hierarchical' => true,
            ),
        'labels' => $labels['speaker']['category']
    );
    $tax['speaker']['tag'] = array(
		'rewrite' => array(
			'slug' => options::get_taxonomy( 'speaker' , 'tag' ),
			),
		'labels' => $labels['speaker']['tag']
	);



    $struct['conference']['presentation'] = array(

        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow[]',
            'type' => 'hidden'
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'idrecord',
                'type' => 'hidden',
                'evisible' => false,
                'lvisible' => false
            )
        ),
        'idrecord' => 'unic',
        'actions' => array(
            /*0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),
            1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),*/
            0 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#conference_presentation div.inside div#box_conference_presentation' ) )
        )
    );

    $struct['conference']['testimonial'] = array(

        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow[]',
            'type' => 'hidden'
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'idrecord',
                'type' => 'hidden',
                'evisible' => false,
                'lvisible' => false
            )
        ),
        'idrecord' => 'unic',
        'actions' => array(
            /*0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),
            1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),*/
            0 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#conference_testimonial div.inside div#box_conference_testimonial' ) )
        )
    );
    	
    $struct['conference']['exhibitor'] = array(

        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow[]',
            'type' => 'hidden'
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'idrecord',
                'type' => 'hidden',
                'evisible' => false,
                'lvisible' => false
            )
        ),
        'idrecord' => 'unic',
        'actions' => array(
            /*0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),
            1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),*/
            0 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#conference_exhibitor div.inside div#box_conference_exhibitor' ) )
        )
    );

    $struct['conference']['sponsor'] = array(

        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow[]',
            'type' => 'hidden'
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'idrecord',
                'type' => 'hidden',
                'evisible' => false,
                'lvisible' => false
            )
        ),
        'idrecord' => 'unic',
        'actions' => array(
            /*0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),
            1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),*/
            0 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#conference_sponsor div.inside div#box_conference_sponsor' ) )
        )
    );

    $struct['conference']['guests'] = array(

        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow[]',
            'type' => 'hidden'
        ),
        'idrecord' => 'unic',
        'actions' => array(
            /*0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),
            1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),*/
            0 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#conference_guests div.inside div#box_conference_guests' ) )
        )
    );

    $struct['conference']['program'] = array(
        'layout' => 'B',
        'field-style' => 'line',
        'check-column' => array(
            'name' => 'idrow',
            'type' => 'hidden',
            'fvisible' => true,
            'lvisible' => true,
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'start_d',
                'type' => 'day',
                'fafter' => '&nbsp;',
                'lvisible' => true,
            ),
            1 => array(
                'name' => 'start_m',
                'type' => 'months',
                'fafter' => '&nbsp;',
                'asoc' => fields::months_array(),
                'lvisible' => true,
            ),
            2 => array(
                'name' => 'start_y',
                'type' => 'year',
                'fafter' => '&nbsp;&nbsp;@&nbsp;&nbsp;',
                'lvisible' => true,
            ),
            3 => array(
                'name' => 'start_hour',
                'type' => 'hour',
                'fafter' => ':',
                'lvisible' => true,
            ),
            4 => array(
                'name' => 'start_min',
                'type' => 'min',
                'fafter' => '&nbsp;&nbsp;-&nbsp;&nbsp;',
                'lvisible' => true,
            ),
            5 => array(
                'name' => 'end_d',
                'type' => 'day',
                'fafter' => '&nbsp;',
                'classes' => 'end_day',
                'lvisible' => true,
            ),
            6 => array(
                'name' => 'end_m',
                'type' => 'months',
                'fafter' => '&nbsp;',
                'asoc' => fields::months_array(),
                'lvisible' => true,
            ),
            7 => array(
                'name' => 'end_y',
                'type' => 'year',
                'fafter' => '&nbsp;&nbsp;@&nbsp;&nbsp;',
                'lvisible' => true,
            ),
            8 => array(
                'name' => 'end_hour',
                'type' => 'hour',
                'fafter' => ':',
                'classes' => 'end_hour',
                'lvisible' => true,
            ),
            9 => array(
                'name' => 'end_min',
                'type' => 'min',
                'fafter' => '<br /><br />',
                'lvisible' => true,
            ),
            10 => array(
                'name' => 'title',
                'type' => 'text',
                'label' => 'Event Title',
                'before' => '<strong>',
                'after' => '</strong>',
                'fafter' => '<br /><br />',
                'lvisible' => true,
            ),
            11 => array(
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Event Description',
            )
        ),
        'actions' => array(
            0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => 'conference' , 'box' => 'program' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#conference_program div.inside div#box_conference_program' ) ),
            1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => 'conference' , 'box' => 'program' , 'post_id' => '' , 'index' => '' , 'data' => array( 'input' =>  "'conference-program-title'" , 'select' =>  "['conference-program-end_min' , 'conference-program-end_hour' , 'conference-program-end_y' , 'conference-program-end_m' , 'conference-program-end_d' , 'conference-program-start_min' , 'conference-program-start_hour' , 'conference-program-start_y' , 'conference-program-start_m' , 'conference-program-start_d']" , 'textarea' => "'conference-program-description'" ) , 'selector' => 'div#conference_program div.inside div#box_conference_program' ) ),
            2 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#conference_program div.inside div#box_conference_program' ) )
        )

    );

    $struct['conference']['tickets'] = array(
        'layout' => 'B',
        'check-column' => array(
            'name' => 'idrow',
            'type' => 'hidden',
            'fvisible' => true,
            'lvisible' => true,
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'ticket_title',
                'type' => 'text',
                'label' => 'Title',
                'after' => '<br />',
                'evisible' => false,
                'lvisible' => true,
            ),
            1 => array(
                'name' => 'ticket_price',
                'type' => 'text',
                'label' => 'Price',
                'after' => '<br />',
                'evisible' => false,
                'lvisible' => true,
            ),
            2 => array(
                'name' => 'ticket_qty_available',
                'type' => 'text',
                'label' => 'Quantity available',
                'after' => '<br />',
                'evisible' => false,
                'lvisible' => true,
            ),
        ),
        'actions' => array(
            0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => 'conference' , 'box' => 'tickets' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#conference_tickets div.inside div#box_conference_tickets' ) ),
            1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => 'conference' , 'box' => 'tickets' , 'post_id' => '' , 'index' => '' , 'data' => array( 'input' =>  "['conference-tickets-ticket_title' , 'conference-tickets-ticket_price','conference-tickets-ticket_qty_available']" ) , 'selector' => 'div#conference_tickets div.inside div#box_conference_tickets' ) ),
            2 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#conference_tickets div.inside div#box_conference_tickets' ) )
        )

    );
    
    /* box fields for presentation */
    $presentations = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'presentation', 'numberposts' => -1 ) );
    if( is_array( $presentations ) && count( $presentations ) > 1 ){
        $form['conference']['presentation']['idrecord']     = array( 'type' => 'sh--m-select' , 'label' => '<strong>' . __( 'Select Presentation for this Conference:' , 'cosmotheme') . '</strong>' , 'value' => $presentations  , 'iclasses' => 'box-large');
        $form['conference']['presentation']['submit']       = array( 'type' => 'sh--meta-save' ,  'value' => __( 'Add Presentation' , 'cosmotheme' ) , 'selector' => 'div#conference_presentation div.inside div#box_conference_presentation'  );
    }
    $form['conference']['presentation']['goto']         = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=presentation' , 'title' => __( 'Add New Presentation' , 'cosmotheme') );

    /* box fields for exhibitor  */
    $exhibitors = get__posts( array(  'post_status' => 'publish' , 'post_type' => 'exhibitor', 'numberposts' => -1 ) );
    if( is_array( $exhibitors ) && count( $exhibitors ) > 1 ){
        $form['conference']['exhibitor']['idrecord']        = array( 'type' => 'sh--m-select' , 'label' => '<strong>' . __( 'Select Exhibitor for this Conference:' , 'cosmotheme') . '</strong>' , 'value' => $exhibitors , 'iclasses' => 'box-large');
        $form['conference']['exhibitor']['submit']          = array( 'type' => 'sh--meta-save' ,  'value' => __( 'Add Exhibitor' , 'cosmotheme' ) , 'selector' => 'div#conference_exhibitor div.inside div#box_conference_exhibitor'  );
    }
    $form['conference']['exhibitor']['goto']            = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=exhibitor' , 'title' => __( 'Add New Exhibitor' , 'cosmotheme') );

    /* box fields for sponsor  */
    $sponsors = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'sponsor', 'numberposts' => -1 ) );
    if( is_array( $sponsors ) && count( $sponsors ) > 1 ){
        $form['conference']['sponsor']['idrecord']          = array( 'type' => 'sh--m-select' , 'label' => '<strong>' . __( 'Select Sponsor for this Conference:' , 'cosmotheme') . '</strong>' , 'value' => $sponsors , 'iclasses' => 'box-large');
        $form['conference']['sponsor']['submit']            = array( 'type' => 'sh--meta-save' ,  'value' => __( 'Add Sponsor' , 'cosmotheme' ) , 'selector' => 'div#conference_sponsor div.inside div#box_conference_sponsor'  );
    }
    $form['conference']['sponsor']['goto']              = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=sponsor' , 'title' => __( 'Add New Sponsor' , 'cosmotheme') );
    
    /* box fields for testimonials  */ 
    $testimonials = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'testimonial', 'numberposts' => -1 ) );
    if( is_array( $testimonials ) && count( $testimonials ) > 1 ){
        $form['conference']['testimonial']['idrecord']          = array( 'type' => 'sh--m-select' , 'label' => '<strong>' . __( 'Select Testimonial for this Conference:' , 'cosmotheme') . '</strong>' , 'value' => $testimonials , 'iclasses' => 'box-large');
        $form['conference']['testimonial']['submit']            = array( 'type' => 'sh--meta-save' ,  'value' => __( 'Add Testimonial' , 'cosmotheme' ) , 'selector' => 'div#conference_testimonial div.inside div#box_conference_testimonial'  );
    }
    $form['conference']['testimonial']['goto']              = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=testimonial' , 'title' => __( 'Add New Testimonial' , 'cosmotheme') );

    /* aditional info about conference */
    $form['conference']['location']['country']          = array( 'type' => 'st--text' , 'label' => __( 'Host country' , 'cosmotheme' ) );
    $form['conference']['location']['region']           = array( 'type' => 'st--text' , 'label' => __( 'Region' , 'cosmotheme' ) );
    $form['conference']['location']['institution']      = array( 'type' => 'st--text' , 'label' => __( 'Institution' , 'cosmotheme' ) );

    /* box fields for program */
    $form['conference']['program']['p_start']           = array( 'type' => 'cd--' , 'content' => '<p>' );
    $form['conference']['program']['start_m']           = array( 'type' => 'ln--m-select' , 'label' =>  __( 'Start event' , 'cosmotheme' )  , 'value' => fields::months_array(  ) , 'ivalue' => (string)date('m') , 'classes' => 'antet-event' );
    $form['conference']['program']['start_d']           = array( 'type' => 'ln--m-select' , 'value' => fields::digit_array( 31 , 1 )  , 'ivalue' => (string)date('d') );
    $form['conference']['program']['start_y']           = array( 'type' => 'ln--m-select' , 'value' => fields::digit_array( date('Y') + 10 , date('Y') ) );
    $form['conference']['program']['start_hour']        = array( 'type' => 'ln--m-select' , 'label' => __( ' @ ' , 'cosmotheme' ) , 'value' => options::get_digit_array( 23 , 0 , true )  );
    $form['conference']['program']['start_min']         = array( 'type' => 'ln--m-select' ,  'value' => options::get_digit_array( 59  , 0 , true  )  );
    $form['conference']['program']['p_start_']          = array( 'type' => 'cd--' , 'content' => '</p>' );

    $form['conference']['program']['p_end']             = array( 'type' => 'cd--' , 'content' => '<p>' );
    $form['conference']['program']['end_m']             = array( 'type' => 'ln--m-select' , 'label' =>  __( 'End event' , 'cosmotheme' )  , 'value' => fields::months_array(  ) , 'ivalue' => (string)date('m') , 'classes' => 'antet-event' );
    $form['conference']['program']['end_d']             = array( 'type' => 'ln--m-select' , 'value' => fields::digit_array( 31 , 1 )  , 'ivalue' => (string)date('d')  );
    $form['conference']['program']['end_y']             = array( 'type' => 'ln--m-select' , 'value' => fields::digit_array( date('Y') + 10 , date('Y') ) );
    $form['conference']['program']['end_hour']          = array( 'type' => 'ln--m-select' , 'label' => __( ' @ ' , 'cosmotheme' ) , 'value' => options::get_digit_array( 23  , 0 , true )  );
    $form['conference']['program']['end_min']           = array( 'type' => 'ln--m-select' ,  'value' => options::get_digit_array( 59 , 0 , true )  );
    $form['conference']['program']['p_end_']            = array( 'type' => 'cd--' , 'content' => '</p>' );
    
    $form['conference']['program']['title']             = array( 'type' => 'st--m-text' , 'label' => __( 'Event title' , 'cosmotheme' ) );
    $form['conference']['program']['description']       = array( 'type' => 'st--m-textarea' , 'label' => __( 'Event description' , 'cosmotheme' ) );
    $form['conference']['program']['submit']            = array( 'type' => 'st--meta-save' ,  'value' => __( 'Add Conference Event' ,'cosmotheme' ) , 'selector' => 'div#conference_program div.inside div#box_conference_program'  );

    $sidebar_value = extra::select_value( '_sidebar' );
    
    if(!( is_array( $sidebar_value ) || !empty( $sidebar_value ) ) ){
        $sidebar_value = array();
    }

    /* hide if is full width */
    $classes = 'sidebar_list';

    if( isset( $_GET['post'] ) ){
        $meta = meta::get_meta( (int) $_GET['post'] , 'layout' );

        if( isset( $meta['type'] ) && $meta['type'] == 'full' ){
            $classes = 'sidebar_list hidden';
        }
    }
    
    $form['conference']['layout']['type']               = array( 'type' => 'sh--select' , 'label' =>  __( 'Select layout type' , 'cosmotheme' ) , 'value' => array( 'right' => __( 'Right Sidebar'  , 'cosmotheme' ) , 'left' => __( 'Left Sidebar' , 'cosmotheme' ) , 'full' => __( 'Full Width' , 'cosmotheme' )  ) , 'action' => "act.select( '#post_layout' , { 'full' : '.sidebar_list' } , 'hs_');" , 'id' => 'post_layout' );
    $form['conference']['layout']['sidebar']            = array( 'type' => 'sh--select' , 'label' =>  __( 'Select sidebar' , 'cosmotheme' ) , 'value' => $sidebar_value , 'classes' => $classes );
    $form['conference']['layout']['link']               = array( 'type' => 'sh--link' , 'url' => 'admin.php?page=cosmothemes___sidebar' , 'title' => __( 'Add new Sidebar' , 'cosmotheme' ) );

	$form['conference']['registration']['enabled']		= array( 'type' => 'sh--select' , 'label'=> __('Enable/Disable registration','cosmotheme'), 'value' => array('enabled' => __('Enable','cosmotheme'), 'disabled' => __('Disable','cosmotheme')) );		
	/*commented registration*/
	/*$form['conference']['registration']['enabled']		= array( 'type' => 'sh--select' , 'label'=> __('Registration type:','cosmotheme'), 'value' => array('free_registration' => __('Free attending','cosmotheme'),'paid_registration' => __('Paid registration','cosmotheme') , 'disabled' => __('Disable registration','cosmotheme')) , 'action' => "act.select( '.en_registration' , { 'paid_registration' : '.currency_paid_registration' } , 'sh_' );" , 'iclasses' => 'en_registration' );
	$form['conference']['registration']['currency']     = array( 'type' => 'sh--select' , 'label' =>  __( 'Select currency' , 'cosmotheme' ) , 'value' => conference::get_currencies() );
	*/

    $form['conference']['tickets']['ticket_title']      = array( 'type' => 'st--m-text' , 'label' =>  __( 'Product Name' , 'cosmotheme' )  , 'classes' => 'ticket_title' );
    $form['conference']['tickets']['ticket_price']      = array( 'type' => 'st--m-text' , 'label' =>  __( 'Price' , 'cosmotheme' ), 'classes'=>'money'  );
    $form['conference']['tickets']['ticket_qty_available'] = array( 'type' => 'st--m-digit' , 'label' =>  __( 'Quantity available' , 'cosmotheme' ), 'classes'=>'digit' , 'hint'=>__("If Quantity is not set, you won't be able to sell this item","cosmotheme") );
    
    $form['conference']['tickets']['submit']            = array( 'type' => 'st--meta-save' ,  'value' => __( 'Add Product' ,'cosmotheme' ) , 'selector' => 'div#conference_tickets div.inside div#box_conference_tickets'  );

	/*commented registration*/
    /*if( isset( $_GET['post'] ) ){
        $meta = meta::get_meta( (int) $_GET['post'] , 'registration' );

        if( isset( $meta['enabled'] ) && $meta['enabled'] == 'paid_registration' ){
            $form['conference']['registration']['currency']['classes'] = 'currency_paid_registration';
        }else{
            $form['conference']['registration']['currency']['classes'] = 'currency_paid_registration  hidden';
        }
    }*/
	
    /* box - settings conference post */
    $sliders = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'slideshow', 'numberposts' => -1 ) , '' );
    if( count( $sliders ) > 0 ){
        $form['conference']['settings']['slideshow']        = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this conference' , 'cvalue' => 'no' );
        $form['conference']['settings']['slideshow_select'] = array( 'type' => 'st--select' , 'label' => __( 'Select Slideshow' , 'cosmotheme' ) , 'value' => get__posts( array( 'post_type' => 'slideshow','numberposts' => -1 ) ) );
        /* $form['conference']['settings']['select_slideshow'] = array( 'type' => 'st--select' , 'label' => __( 'Select slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this conference' , 'classes' => 'slideshow_list ' ); 'action' => "act.check( '.slideshow-status' , { 'yes' : '#slideshow_list' , 'no' : '--'  } , 'sh_' );" , 'classes' => 'slideshow-status'    */
    }else{
        $form['conference']['settings']['link']        = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=slideshow' , 'title' => __( 'Add New Slideshow' , 'cosmotheme') );
    }
    $form['conference']['settings']['related']          = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show related conferences' , 'cosmotheme' ) , 'hint' => 'Show related conferences on this conference' , 'cvalue' => options::get_value( 'blog_post' , 'conf_similar_' ) );
	$form['conference']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show meta' , 'cosmotheme' ) , 'hint' => 'Show meta on this post' , 'cvalue' => 'yes' );
    $form['conference']['settings']['sharing']          = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social sharing on this conference' , 'cvalue' => options::get_value( 'blog_post' , 'conf_sharing' ) );
	$form['conference']['settings']['archive']          = array( 'type' => 'st--logic-radio' , 'label' => __( 'Archive this event' , 'cosmotheme' ) , 'hint' => 'Set it to yes if you want to archive the event. For example <br/> if you have several events and one of them has passed. <br/>  If set to "yes" this event will dissapeare from "Event list" <br/>  widget and "Conferences" short code' , 'cvalue' => 'No' );

    /* array( 'conference' , 'presentation' , 'presentation' ) use 3 params, param 3 used for return data */
    $box['conference']['presentation']                  = array( __('Add Presentation' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['presentation'] , 'box' => 'presentation' , 'struct' => $struct['conference']['presentation'] , 'callback' => array( 'get_meta_records_' , array( 'conference' , 'presentation' , 'presentation' ) ) , 'records-title' => __('Conference Presentations' , 'cosmotheme' ) );
    $box['conference']['exhibitor']                     = array( __('Add Exhibitor' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['exhibitor'] , 'box' => 'exhibitor' , 'struct' => $struct['conference']['exhibitor'] , 'callback' => array( 'get_meta_records_' , array( 'conference' , 'exhibitor' , 'exhibitor' ) ) , 'records-title' => __('Conference Exhibitors' , 'cosmotheme' ) );
    $box['conference']['sponsor']                       = array( __('Add Sponsor' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['sponsor'] , 'box' => 'sponsor' , 'struct' => $struct['conference']['sponsor'] , 'callback' => array( 'get_meta_records_' , array( 'conference' , 'sponsor' , 'sponsor' ) ) , 'records-title' => __('Conference Sponsors' , 'cosmotheme' ) );
    $box['conference']['testimonial']                   = array( __('Add Testimonial' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['testimonial'] , 'box' => 'testimonial' , 'struct' => $struct['conference']['testimonial'] , 'callback' => array( 'get_meta_records_' , array( 'conference' , 'testimonial' , 'testimonial' ) ) , 'records-title' => __('Conference Testimonial' , 'cosmotheme' ) );
    $box['conference']['guests']                        = array( __('Registered Guests' , 'cosmotheme' ) , 'side' , 'low' , 'struct' => $struct['conference']['guests'] , 'res_type' => 'user' , 'box' => 'guests' , 'callback' => array( 'get_meta_records_' , array( 'conference' , 'guests' , 'guests' ) ) , 'records-title' => __('Conference Guests' , 'cosmotheme' ) );
    /*commented registration*/
	//$box['conference']['registration']                  = array( __('Registration' , 'cosmotheme' ) , 'normal' , 'low' , 'struct' => array() , 'box' => 'registration' , 'content' => $form['conference']['registration'], 'update' => true );
	$box['conference']['registration']                  = array( __('Registration' , 'cosmotheme' ) , 'side' , 'low' , 'struct' => array() , 'box' => 'registration' , 'content' => $form['conference']['registration'], 'update' => true );
    $box['conference']['tickets']                       = array( __('Conference Tickets' , 'cosmotheme' ) , 'normal' , 'low' , 'content' => $form['conference']['tickets'] , 'box' => 'tickets' , 'struct' => $struct['conference']['tickets'] , 'callback' => array( 'get_meta_records' , array( 'conference' , 'tickets' , 'tickets' ) )  );

    $box['conference']['location']                      = array( __('Conference Location' , 'cosmotheme' ) , 'normal' , 'low' , 'content' => $form['conference']['location'] , 'box' => 'location' , 'update' => true );
    $box['conference']['program']                       = array( __('Compose Conference Program' , 'cosmotheme' ) , 'normal' , 'low' , 'content' => $form['conference']['program'] , 'box' => 'program' , 'struct' => $struct['conference']['program'] , 'callback' => array( 'get_meta_records' , array( 'conference' , 'program' , 'program' ) ) , 'records-title' => __('Conference Presentations' , 'cosmotheme' ) );

    /* sidebar */
    $box['conference']['layout']                        = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['layout'] , 'box' => 'layout' , 'update' => true  );

    /* shortcodes */
    $box['conference']['shcode']                        = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['conference']['settings']                      = array( __('Conference Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['conference']['settings'] , 'box' => 'settings' , 'update' => true  );

    resources::$labels['conference']    = $res['conference']['labels'];
    resources::$type['conference']      = $res['conference']['args'];
    resources::$taxonomy['conference']  = $tax['conference'];
    resources::$box['conference']       = $box['conference'];

    
    /* post type exhibitor */
    $res['exhibitor']['labels'] = array(
        'name' => _x(__('Exhibitors','cosmotheme'), 'post type general name'),
        'singular_name' => _x(__('Exhibitor','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Exhibitor','cosmotheme')),
        'add_new_item' => __('Add New Exhibitor','cosmotheme'),
        'edit_item' => __('Edit Exhibitor','cosmotheme'),
        'new_item' => __('New Exhibitor','cosmotheme'),
        'view_item' => __('View Exhibitor','cosmotheme'),
        'search_items' => __('Search Exhibitors','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['exhibitor']['args'] = array(
        'public' => true,
        'hierarchical' => false,
		'rewrite' => array( 'slug' => options::get_value( 'blog_post' , 'exhib_slug' ), 'with_front' => true ), 
        'menu_position' => 3,
        'supports' => array('title', 'editor' , 'excerpt' , 'thumbnail'),
        '__on_front_page' => true
    );

    /* box - attach exhibitor to conference */
    $conferences = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'conference', 'numberposts' => -1 ) );
    if( is_array( $conferences ) && count( $conferences ) > 1 ){
        $form['exhibitor']['conference']['conference']  = array( 'type' => 'sh--select' , 'value' => $conferences , 'label' => '<strong>' . __( 'Select Conference' , 'cosmotheme' ) . '</strong>'  , 'action' => "act.post_relation( extra.val('#conferences') , 'presentation' , 'attach_presentation' );" , 'id' => 'conferences' );
        $form['exhibitor']['conference']['save']        = array( 'type' => 'sh--attach' , 'value' => 'Attach Exhibitor' , 'attach_selector' => 'select#conferences' );
    }
    $form['exhibitor']['conference']['add_new']     = array( 'type' => 'sh--link' ,  'url' => 'post-new.php?post_type=conference' , 'title' => __( 'Add New Conference' , 'cosmotheme') );

    /* box - settings exhibitor post */
    $sliders = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'slideshow', 'numberposts' => -1 ) , '' );
    if( count( $sliders ) > 0 ){
        $form['exhibitor']['settings']['slideshow'] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this exhibitor' , 'cvalue' => 'no' );
        $form['exhibitor']['settings']['slideshow_select'] = array( 'type' => 'st--select' , 'label' => __( 'Select Slideshow' , 'cosmotheme' ) , 'value' => get__posts( array( 'post_type' => 'slideshow','numberposts' => -1 ) ) );
        /* $form['exhibitor']['settings']['select_slideshow'] = array( 'type' => 'st--select' , 'label' => __( 'Select slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this conference' , 'classes' => 'slideshow_list ' ); 'action' => "act.check( '.slideshow-status' , { 'yes' : '#slideshow_list' , 'no' : '--'  } , 'sh_' );" , 'classes' => 'slideshow-status'    */
    }else{
        $form['exhibitor']['settings']['link']      = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=slideshow' , 'title' => __( 'Add New Slideshow' , 'cosmotheme') );
    }
	$form['exhibitor']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show meta' , 'cosmotheme' ) , 'hint' => 'Show meta on this post' , 'cvalue' => 'yes' );
    $form['exhibitor']['settings']['sharing']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social sharing on this exhibitor' , 'cvalue' => options::get_value( 'blog_post' , 'exhib_sharing' ) );

    /* init boxes */
    $box['exhibitor']['shcode']                     = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['exhibitor']['conference']                 = array( __('Attach this Exhibitor to Conference' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['exhibitor']['conference'] , 'callback' => array( 'search_relation' , array( 'conference' , 'exhibitor' ) ) , 'records-title' => __("Exhibitor's Conferences" , 'cosmotheme' )   );
    $box['exhibitor']['layout']                     = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['layout'] , 'box' => 'layout' , 'update' => true  );
    $box['exhibitor']['settings']                   = array( __('Exhibitor Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['exhibitor']['settings'] , 'box' => 'settings' , 'update' => true  );

    resources::$labels['exhibitor']                 = $res['exhibitor']['labels'];
    resources::$type['exhibitor']                   = $res['exhibitor']['args'];
    resources::$box['exhibitor']                    = $box['exhibitor'];
	resources::$taxonomy['exhibitor']				= $tax['exhibitor'];


    /* post type sponsor */
    $res['sponsor']['labels'] = array(
        'name' => _x(__('Sponsors','cosmotheme'), 'post type general name'),
        'singular_name' => _x('Sponsor', 'post type singular name'),
        'add_new' => _x('Add New', 'Sponsor'),
        'add_new_item' => __('Add New Sponsor','cosmotheme'),
        'edit_item' => __('Edit Sponsor','cosmotheme'),
        'new_item' => __('New Sponsor','cosmotheme'),
        'view_item' => __('View Sponsor','cosmotheme'),
        'search_items' => __('Search Sponsors','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['sponsor']['args'] = array(
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 3,
		'rewrite' => array( 'slug' => options::get_value( 'blog_post' , 'sponsor_slug' ), 'with_front' => true ), 
        'supports' => array( 'title' ,  'editor' , 'excerpt' , 'thumbnail'),
        '__on_front_page' => true
    );

    /* box - info about sponsor */
    $form['sponsor']['info']['url']     = array( 'type' => 'st--text' , 'label' => __( 'Sponsor URL' , 'cosmotheme' ) );
    $form['sponsor']['info']['hint']    = array( 'type' => 'st--hint', 'value' => '' . __( 'To add sponsor photo please ' , 'cosmotheme' ) . '<strong>' . __( 'set featured image' , 'cosmotheme' ) . '</strong>.' );

    /* box - settings sponsor post */
    $sliders = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'slideshow', 'numberposts' => -1 ) , '' );
    if( count( $sliders ) > 0 ){
        $form['sponsor']['settings']['slideshow']           = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this sponsor' , 'cvalue' => 'no' );
        $form['sponsor']['settings']['slideshow_select'] = array( 'type' => 'st--select' , 'label' => __( 'Select Slideshow' , 'cosmotheme' ) , 'value' => get__posts( array( 'post_type' => 'slideshow','numberposts' => -1 ) ) );
        /* $form['sponsor']['settings']['select_slideshow'] = array( 'type' => 'st--select' , 'label' => __( 'Select slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this conference' , 'classes' => 'slideshow_list ' ); 'action' => "act.check( '.slideshow-status' , { 'yes' : '#slideshow_list' , 'no' : '--'  } , 'sh_' );" , 'classes' => 'slideshow-status'    */
    }else{
        $form['sponsor']['settings']['link']        = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=slideshow' , 'title' => __( 'Add New Slideshow' , 'cosmotheme') );
    }
	$form['sponsor']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show meta' , 'cosmotheme' ) , 'hint' => 'Show meta on this post' , 'cvalue' => 'yes' );
    $form['sponsor']['settings']['sharing']             = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social sharing on this sponsor' , 'cvalue' => options::get_value( 'blog_post' , 'sponsor_sharing' ) );


    /* box - attach sponsor to conference */
    if( is_array( $conferences ) && count( $conferences ) > 1 ){
        $form['sponsor']['conference']['conference']        = array( 'type' => 'sh--select' , 'value' => $conferences , 'label' => '<strong>' . __( 'Select Conference' , 'cosmotheme' ) . '</strong>' , 'action' => "act.post_relation( extra.val('#conferences') , 'presentation' , 'attach_presentation' );" , 'id' => 'conferences' );
        $form['sponsor']['conference']['save']              = array( 'type' => 'sh--attach' , 'value' => 'Attach Sponsor' , 'attach_selector' => 'select#conferences' );
    }
    $form['sponsor']['conference']['add_new']           = array( 'type' => 'sh--link' ,  'url' => 'post-new.php?post_type=conference' , 'title' => __( 'Add New Conference' , 'cosmotheme') );

    /* init boxes */
    $box['sponsor']['shcode']                      = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['sponsor']['info']                             = array( __('Sponsor Info' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['sponsor']['info'] , 'box' => 'info' , 'update' => true );
    $box['sponsor']['conference']                       = array( __('Attach this Sponsor to Conference' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['sponsor']['conference'] , 'callback' => array( 'search_relation' , array( 'conference' , 'sponsor' ) ) , 'records-title' => __("Sponsor's Conferences" , 'cosmotheme' )   );
    $box['sponsor']['layout']                           = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['layout'] , 'box' => 'layout' , 'update' => true  );
    $box['sponsor']['settings']                         = array( __('Sponsor Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['sponsor']['settings'] , 'box' => 'settings' , 'update' => true  );

    resources::$labels['sponsor']                       = $res['sponsor']['labels'];
    resources::$type['sponsor']                         = $res['sponsor']['args'];
    resources::$box['sponsor']                          = $box['sponsor'];
	resources::$taxonomy['sponsor']						= $tax['sponsor'];



    /* post type presentations */
	$res['presentation']['labels'] = array(
        'name' => _x(__('Presentations','cosmotheme'), 'post type general name'),
        'singular_name' => _x('Presentation', 'post type singular name'),
        'add_new' => _x('Add New', 'Presentation'),
        'add_new_item' => __('Add New Presentation','cosmotheme'),
        'edit_item' => __('Edit Presentation','cosmotheme'),
        'new_item' => __('New Presentation','cosmotheme'),
        'view_item' => __('View Presentation','cosmotheme'),
        'search_items' => __('Search Presentations','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
		'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['presentation']['args'] = array(
        'public' => true,
        'hierarchical' => false, 
		'rewrite' => array( 'slug' => options::get_value( 'blog_post' , 'present_slug' ), 'with_front' => true ),
		'menu_position' => 4,
        'supports' => array('title','editor','excerpt','comments','thumbnail'),
        '__on_front_page' => true
    );

    $struct['presentation']['speaker'] = array(
				'check-column' => array(
					'name' => 'idrow[]',
					'type' => 'hidden'
				),
				'info-column-0' => array(
                    0 => array(
                        'name' => 'idrecord',
                        'type' => 'hidden',
                        'evisible' => false,
						'lvisible' => false
                    )
				),
                'idrecord' => 'unic',
				'actions' => array(
                    /*0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),
                    1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => '' ) ),*/
                    0 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#presentation_speaker div.inside div#box_presentation_speaker' ) )
				)
			);

     $struct['presentation']['docs'] = array(
        'layout' => 'B',
        'check-column' => array(
            'name' => 'idrow',
            'type' => 'hidden',
            'fvisible' => true,
            'lvisible' => true,
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'url',
                'type' => 'attachment',
                'attach_type' => '',
                'width' => 32,
                'height' => 32,
                'icon'  => get_template_directory_uri() . '/lib/images/attach.png',
                'evisible' => false,
                'lvisible' => true,
            ),
        ),
        'actions' => array(
            0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => 'presentation' , 'box' => 'docs' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#presentation_docs div.inside div#box_presentation_docs' ) ),
            1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => 'presentation' , 'box' => 'docs' , 'post_id' => '' , 'index' => '' , 'data' => array( 'input' =>  "'url_path'"  ) , 'selector' => 'div#presentation_docs div.inside div#box_presentation_docs' ) ),
            2 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#presentation_docs div.inside div#box_presentation_docs' ) )
        )
    );

    /* box for speakers */
    $speakers = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'speaker', 'numberposts' => -1 ) );
    if( is_array( $speakers ) && count( $speakers ) > 1 ){
        $form['presentation']['speaker']['idrecord']        = array( 'type' => 'sh--m-select' , 'label' =>'<strong>' . __( "Select presentation's speaker(s)" , 'cosmotheme') . '</strong>' , 'value' => $speakers , 'iclasses' => 'box-large');
        $form['presentation']['speaker']['submit']          = array( 'type' => 'sh--meta-save' ,  'value' => __( 'Add Speaker' , 'cosmotheme' ) , 'selector' => 'div#presentation_speaker div.inside div#box_presentation_speaker'  );
    }
    $form['presentation']['speaker']['goto']                = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=speaker' , 'title' => __( 'Add New Speaker' , 'cosmotheme') );

    /* box - attach presentation to conference */
    if( is_array( $conferences ) && count( $conferences ) > 1 ){
        $form['presentation']['conference']['conference']       = array( 'type' => 'sh--select' , 'value' => $conferences , 'label' => '<strong>' . __( 'Select Conference' , 'cosmotheme' ) . '</strong>'  , 'action' => "act.post_relation( extra.val('#conferences') , 'presentation' , 'attach_presentation' );" , 'id' => 'conferences' );
        $form['presentation']['conference']['save']             = array( 'type' => 'sh--attach' , 'value' => 'Attach Presentation' , 'attach_selector' => 'select#conferences' );
    }
    $form['presentation']['conference']['add_new']          = array( 'type' => 'sh--link' ,  'url' => 'post-new.php?post_type=conference' , 'title' => __( 'Add New Conference' , 'cosmotheme') );

    /* docs url */
    $form['presentation']['docs']['url']                     = array( 'type' => 'st--m-upload' , 'label' => __( 'Document location' , 'cosmotheme' ) , 'id' => 'upload_presentation_pdf' );
    $form['presentation']['docs']['submit']                  = array( 'type' => 'st--meta-save' ,  'value' => __( 'Attach document' , 'cosmotheme' ) , 'selector' => 'div#presentation_docs div.inside div#box_presentation_docs'  );

    /* box - settings presentation post */
    $sliders = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'slideshow', 'numberposts' => -1 ) , '' );
    if( count( $sliders ) > 0 ){
        $form['presentation']['settings']['slideshow']           = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this presentation' , 'cvalue' => 'no' );
        $form['presentation']['settings']['slideshow_select'] = array( 'type' => 'st--select' , 'label' => __( 'Select Slideshow' , 'cosmotheme' ) , 'value' => get__posts( array( 'post_type' => 'slideshow','numberposts' => -1 ) ) );
        /* $form['presentation']['settings']['select_slideshow'] = array( 'type' => 'st--select' , 'label' => __( 'Select slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this conference' , 'classes' => 'slideshow_list ' ); 'action' => "act.check( '.slideshow-status' , { 'yes' : '#slideshow_list' , 'no' : '--'  } , 'sh_' );" , 'classes' => 'slideshow-status'    */
    }else{
        $form['presentation']['settings']['link']        = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=slideshow' , 'title' => __( 'Add New Slideshow' , 'cosmotheme') );
    }
    $form['presentation']['settings']['related']             = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show related presentations' , 'cosmotheme' ) , 'hint' => 'Show related presentations on this presentation' , 'cvalue' => options::get_value( 'blog_post' , 'present_similar_' ) );
	$form['presentation']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show meta' , 'cosmotheme' ) , 'hint' => 'Show meta on this post' , 'cvalue' => 'yes' );
    $form['presentation']['settings']['sharing']             = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social sharing on this presentation' , 'cvalue' => options::get_value( 'blog_post' , 'present_sharing' ) );


    /* init boxes */
    $box['presentation']['speaker']                         = array( __('Add Speakers' ,'cosmotheme' ) , 'side' , 'low' , 'content' => $form['presentation']['speaker'] , 'box' => 'speaker' , 'struct' => $struct['presentation']['speaker'] , 'callback' => array( 'get_meta_records_' , array( 'presentation' , 'speaker' , 'speaker' ) ) , 'records-title' => __('Presentation Speakers' , 'cosmotheme' ) );
    $box['presentation']['shcode']                          = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['presentation']['conference']                      = array( __('Attach this Presentation to Conference' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['presentation']['conference'] , 'callback' => array( 'search_relation' , array( 'conference' , 'presentation' ) ) , 'records-title' => __("Presentation's Conferences" , 'cosmotheme' )  );
    $box['presentation']['layout']                          = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['layout'] , 'box' => 'layout' , 'update' => true  );
    $box['presentation']['docs']                            = array( __('Attach Presentation Documents:' , 'cosmotheme' ) , 'normal' , 'high' , 'struct' => $struct['presentation']['docs'] , 'content' => $form['presentation']['docs'] , 'box' => 'docs' , 'callback' => array( 'get_meta_records' , array( 'presentation' , 'docs' , 'docs' ) ) , 'records-title' => __("Presentation's Conferences" , 'cosmotheme' ) );
    $box['presentation']['settings']                        = array( __('Speaker Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['presentation']['settings'] , 'box' => 'settings' , 'update' => true  );

    resources::$labels['presentation']      = $res['presentation']['labels'];
    resources::$type['presentation']        = $res['presentation']['args'];
    resources::$box['presentation']         = $box['presentation'];
	resources::$taxonomy['presentation']	= $tax['presentation'];

    /* post type speaker */
    $res['speaker']['labels'] = array(
        'name' => _x(__('Speakers','cosmotheme'), 'post type general name'),
        'singular_name' => _x(__('Speaker','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Speaker','cosmotheme')),
        'add_new_item' => __('Add New Speaker','cosmotheme'),
        'edit_item' => __('Edit Speaker','cosmotheme'),
        'new_item' => __('New Speaker','cosmotheme'),
        'view_item' => __('View Speaker','cosmotheme'),
        'search_items' => __('Search Speakers','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['speaker']['args'] = array(
        'public' => true,
        'hierarchical' => false,
		'rewrite' => array( 'slug' => options::get_value( 'blog_post' , 'speaker_slug' ), 'with_front' => true ),
        'menu_position' => 3,
        'supports' => array('title','editor','excerpt','comments','thumbnail'),
        '__on_front_page' => true
    );

    /* box for speaker */
    $form['speaker']['info']['country']                 = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Country' , 'cosmotheme') . '</strong>' );
    $form['speaker']['info']['region']                  = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Region' , 'cosmotheme') . '</strong>' );
    $form['speaker']['info']['study']                   = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Title' , 'cosmotheme') . '</strong>' );
    $form['speaker']['info']['university']              = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Institution' , 'cosmotheme') . '</strong>' );
    $form['speaker']['info']['email']                   = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Email' , 'cosmotheme') . '</strong>' );
    $form['speaker']['info']['phone']                   = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Phone' , 'cosmotheme') . '</strong>' );
    $form['speaker']['info']['hint']                    = array( 'type' => 'st--hint', 'value' => '' . __( 'To add speaker photo please ' , 'cosmotheme' ) . '<strong>' . __( 'set featured image' , 'cosmotheme' ) . '</strong>.' );

    /* box - settings speakers post */
    $sliders = get__posts( array( 'post_status' => 'publishs' , 'post_type' => 'slideshow', 'numberposts' => -1 ) , '' );
    if( count( $sliders ) > 0 ){
        $form['speaker']['settings']['slideshow']           = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this speaker' , 'cvalue' => 'no' );
        $form['speaker']['settings']['slideshow_select'] = array( 'type' => 'st--select' , 'label' => __( 'Select Slideshow' , 'cosmotheme' ) , 'value' => get__posts( array( 'post_type' => 'slideshow','numberposts' => -1 ) ) );
        /* $form['speaker']['settings']['select_slideshow'] = array( 'type' => 'st--select' , 'label' => __( 'Select slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this conference' , 'classes' => 'slideshow_list ' ); 'action' => "act.check( '.slideshow-status' , { 'yes' : '#slideshow_list' , 'no' : '--'  } , 'sh_' );" , 'classes' => 'slideshow-status'    */
    }else{
        $form['speaker']['settings']['link']        = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=slideshow' , 'title' => __( 'Add New Slideshow' , 'cosmotheme') );
    }
    $form['speaker']['settings']['related']             = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show similar speakers' , 'cosmotheme' ) , 'hint' => 'Show similar speakers on this speaker' , 'cvalue' => options::get_value( 'blog_post' , 'speaker_similar_' ) );
	$form['speaker']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show meta' , 'cosmotheme' ) , 'hint' => 'Show meta on this post' , 'cvalue' => 'yes' );
    $form['speaker']['settings']['sharing']             = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social sharing on this speaker' , 'cvalue' => options::get_value( 'blog_post' , 'speaker_sharing' ) );

    /* box - attach speaker to presentation */
    if( is_array( $conferences ) && count( $conferences ) > 1 ){
        $form['speaker']['presentation']['conference']      = array( 'type' => 'sh--select' , 'value' => $conferences , 'label' => '<strong>' . __( 'Select Conference' , 'cosmotheme' ) . '</strong>'  , 'action' => "act.post_relation( extra.val('#conferences') , 'presentation' , 'attach_presentation' );" , 'id' => 'conferences' );
        $form['speaker']['presentation']['presentation']    = array( 'type' => 'sh--callback' , 'label' => '<strong>' . __( 'Select Presentation' , 'cosmotheme' ) . '</strong>' , 'id' => 'attach_presentation' , 'classes' => 'attach_presentation hidden');
        $form['speaker']['presentation']['save']            = array( 'type' => 'sh--attach' , 'value' => 'Attach Speaker' , 'attach_selector' => 'select#field_attach_presentation' );
    }
    $form['speaker']['presentation']['add_new']         = array( 'type' => 'sh--link' ,  'url' => 'post-new.php?post_type=conference' , 'title' => __( 'Add New Conference' , 'cosmotheme') );

    /* init boxes */
    $box['speaker']['shcode']                           = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['speaker']['info']                             = array( __('Add Speaker Aditional Info' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['speaker']['info'] , 'box' => 'info' , 'update' => true );
    $box['speaker']['presentation']                     = array( __('Attach Speaker to Presentation' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['speaker']['presentation']  , 'callback' => array( 'search_relation' , array( 'presentation' , 'speaker' ) ) , 'records-title' => __("Speaker's Presentations" , 'cosmotheme' )  );
    $box['speaker']['layout']                           = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['layout'] , 'box' => 'layout' , 'update' => true  );
    $box['speaker']['settings']                         = array( __('Speaker Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['speaker']['settings'] , 'box' => 'settings' , 'update' => true  );

    resources::$labels['speaker']                       = $res['speaker']['labels'];
    resources::$type['speaker']                         = $res['speaker']['args'];
    resources::$box['speaker']                          = $box['speaker'];
	resources::$taxonomy['speaker']						= $tax['speaker'];

    /* post type slideshow */
    $res['slideshow']['labels'] = array(
        'name' => _x(__('Slideshow','cosmotheme'), 'post type general name'),
        'singular_name' => _x(__('Slideshow','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Slideshow','cosmotheme')),
        'add_new_item' => __('Add New Slideshow','cosmotheme'),
        'edit_item' => __('Edit Slideshow','cosmotheme'),
        'new_item' => __('New Slideshow','cosmotheme'),
        'view_item' => __('View Slideshow','cosmotheme'),
        'search_items' => __('Search Slideshow','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['slideshow']['args'] = array(
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 3,
        'supports' => array('title'),
    	'exclude_from_search' => true,
        '__on_front_page' => true
    );

    $struct['slideshow']['box'] = array(
        'layout' => 'B',
        'field-style' => 'line',
        'check-column' => array(
            'name' => 'idrow',
            'type' => 'hidden',
            'evisible' => false,
            'lvisible' => false,
        ),
        'icon-column' => array(
            'name' => 'slide',
            'type' => 'attachment',
            'attach_type' => 'image',
            'width' => 100,
            'height' => 100,
            'evisible' => false,
            'lvisible' => false,
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'resources',
                'type' => 'hidden',
                'evisible' => true,
                'lvisible' => false,
                'post_link' => true,
            ),
            1 => array(
                'name' => 'type_res',
                'type' => 'hidden',
                'label' => 'Type Of Resource',
                'evisible' => false,
                'lvisible' => false,
            ),
            2 => array(
                'name' => 'title',
                'type' => 'text',
                'label' => 'Resource Title',
                'evisible' => false,
                'lvisible' => true,
            ),
            3 => array(
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Resource Description',
                'evisible' => false,
                'lvisible' => true,
            ),
            4 => array(
                'name' => 'url',
                'type' => 'text',
                'label' => 'Custom URL',
                'evisible' => false,
                'lvisible' => true,
            ),
            
        ),
        'actions' => array(
            0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => 'slideshow' , 'box' => 'box' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#slideshow_box div.inside div#box_slideshow_box' ) ),
            1 => array( 'slug' => 'update' , 'label' => 'update' , 'args' => array( 'res' => 'slideshow' , 'box' => 'box' , 'post_id' => '' , 'index' => '' , 'data' => array( 'input' =>  "['slideshow-box-slide_id' , 'slideshow-box-slide' , 'slideshow-box-description', 'slideshow-box-title ', 'slideshow-box-url ' ]" ) , 'selector' => 'div#slideshow_box div.inside div#box_slideshow_box' ) ),
            2 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#slideshow_box div.inside div#box_slideshow_box' ) )
        )

    );   

    $sl_res = array( 'none' => 'Simple image' , 'conference' => 'Conference' , 'program' => 'Program' , 'sponsor' => 'Sponsor' , 'exhibitor' => 'Exhibitor' , 'presentation' => 'Presentation' , 'speaker' => 'Speaker'  );

    $m_labels = array(
        'conference' => __( 'Select Conference' , 'cosmotheme' ),
        'program' => __( 'Select Conference' , 'cosmotheme' ),
        'sponsor' => __( 'Select Sponsor' , 'cosmotheme' ),
        'exhibitor' => __( 'Select Exhibitor' , 'cosmotheme' ),
        'presentation' => __( 'Select Presentation' , 'cosmotheme' ),
        'speaker' => __( 'Select Speaker' , 'cosmotheme' ),
    );

    $form['slideshow']['box']['type_res']   = array( 'type' => 'st--m-select' , 'label' => __( 'Select type of resource' , 'cosmotheme') , 'value' =>  $sl_res , 'action' => "act.slide_resources( extra.val('#type_resource') , 'slider_resources' , 'div.standard-generic-field.slider_resources div.generic-label label' );" , 'id' => 'type_resource' );
    $form['slideshow']['box']['resources']  = array( 'type' => 'st--callback' , 'multiple_label' => $m_labels , 'label' =>  __( 'Select Resource' , 'cosmotheme' )  , 'id' => 'slider_resources' , 'classes' => 'slider_resources hidden' );
    $form['slideshow']['box']['title']		= array( 'type' => 'st--m-text' , 'label' =>  __( 'Resource Title' , 'cosmotheme' ) , 'hint' => __( 'If title is not completed, post title will be used).' , 'cosmotheme'  ) );
    $form['slideshow']['box']['description']= array( 'type' => 'st--m-textarea' , 'label' =>  __( 'Resource Description' , 'cosmotheme' ) , 'hint' => __( 'If not completed description, will be used post excerpt <br />(<strong>first 180 chars</strong>), if not completed post excerpt, will be used <br />post content (<strong>first 180 chars</strong>).' , 'cosmotheme'  ) );
    $form['slideshow']['box']['slide']      = array( 'type' => 'st--m-upload-id' , 'label' => __( 'Set image path' , 'cosmotheme') , 'id' => 'box_slide' );
    $form['slideshow']['box']['url']		= array( 'type' => 'st--m-text' , 'label' =>  __( 'Custom URL' , 'cosmotheme' ) , 'hint' => __( 'If this field is not set then "Read More" link will link to the selected custom post(ignore the hint for simple images)).' , 'cosmotheme'  ) );
    $form['slideshow']['box']['submit']     = array( 'type' => 'st--meta-save' ,  'value' => __( 'Add to slideshow' ,'cosmotheme' ) , 'selector' => 'div#slideshow_box div.inside div#box_slideshow_box'  );
    

    $box['slideshow']['box']                = array( __('Compose slideshow (drag and drop items to rearange position)' , 'cosmotheme' ) , 'normal' , 'low' , 'content' => $form['slideshow']['box'] , 'box' => 'box' , 'struct' => $struct['slideshow']['box'] , 'callback' => array( 'get_meta_records' , array( 'slideshow' , 'box' , 'box' ) ) , 'records-title' => __('Slideshow items' , 'cosmotheme' ) );

    $form['slideshow']['manager']['link']   = array( 'type' => 'sh--post-upload' , 'title' => 'Manage Slideshow' );


    $box['slideshow']['manager']            = array( __('Manage Slideshow' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['slideshow']['manager'] , 'box' => 'manager' );



    resources::$labels['slideshow']         = $res['slideshow']['labels'];
    resources::$type['slideshow']           = $res['slideshow']['args'];
    resources::$box['slideshow']            = $box['slideshow'];

    /* standard post */
    $sliders = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'slideshow', 'numberposts' => -1 ) , '' );
    if( count( $sliders ) > 0 ){
        $form['post']['settings']['slideshow']  = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this post' , 'cvalue' => 'no' );
        $form['post']['settings']['slideshow_select'] = array( 'type' => 'st--select' , 'label' => __( 'Select Slideshow' , 'cosmotheme' ) , 'value' => get__posts( array( 'post_type' => 'slideshow','numberposts' => -1 ) ) );
        /* $form['post']['settings']['select_slideshow'] = array( 'type' => 'st--select' , 'label' => __( 'Select slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this conference' , 'classes' => 'slideshow_list ' ); 'action' => "act.check( '.slideshow-status' , { 'yes' : '#slideshow_list' , 'no' : '--'  } , 'sh_' );" , 'classes' => 'slideshow-status'    */
    }else{
        $form['post']['settings']['link']        = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=slideshow' , 'title' => __( 'Add New Slideshow' , 'cosmotheme') );
    }
    $form['post']['settings']['related']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show related posts' , 'cosmotheme' ) , 'hint' => 'Show related mosts on this post' , 'cvalue' => options::get_value( 'blog_post' , 'post_similar_' ) );
    $form['post']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show post meta' , 'cosmotheme' ) , 'hint' => 'Show post meta on this post' , 'cvalue' => 'yes' );
    $form['post']['settings']['sharing']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social mharing on this post' , 'cvalue' => options::get_value( 'blog_post' , 'post_sharing' ) );
    $form['post']['settings']['author']     = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show author box' , 'cosmotheme' ) , 'hint' => 'Show author box on this post' , 'cvalue' => options::get_value( 'blog_post' , 'post_author_box' ) );

    $box['post']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['post']['layout']                  = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['layout'] , 'box' => 'layout' , 'update' => true  );
    $box['post']['settings']                = array( __('Post Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['post']['settings'] , 'box' => 'settings' , 'update' => true  );

    resources::$type['post']                = array();
    resources::$box['post']                 = $box['post'];

    /* standard page */
    $sliders = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'slideshow', 'numberposts' => -1 ) , '' );
    if( count( $sliders ) > 0 ){
        $form['page']['settings']['slideshow']  = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this page' , 'cvalue' => 'no' );
        $form['page']['settings']['slideshow_select'] = array( 'type' => 'st--select' , 'label' => __( 'Select Slideshow' , 'cosmotheme' ) , 'value' => get__posts( array( 'post_type' => 'slideshow','numberposts' => -1 ) ) );
        /* $form['page']['settings']['select_slideshow'] = array( 'type' => 'st--select' , 'label' => __( 'Select slideshow' , 'cosmotheme' ) , 'hint' => 'Show slideshow on this conference' , 'classes' => 'slideshow_list ' ); 'action' => "act.check( '.slideshow-status' , { 'yes' : '#slideshow_list' , 'no' : '--'  } , 'sh_' );" , 'classes' => 'slideshow-status'    */
    }else{
        $form['page']['settings']['link']        = array( 'type' => 'sh--link' , 'url' => 'post-new.php?post_type=slideshow' , 'title' => __( 'Add New Slideshow' , 'cosmotheme') );
    }
    $form['page']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show page meta' , 'cosmotheme' ) , 'hint' => 'Show post meta on this page' , 'cvalue' => 'no' );
    $form['page']['settings']['sharing']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social sharing on this page' , 'cvalue' => options::get_value( 'blog_post' , 'page_sharing' ) );
    $form['page']['settings']['author']     = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show author box' , 'cosmotheme' ) , 'hint' => 'Show author box on this page' , 'cvalue' => options::get_value( 'blog_post' , 'page_author_box' ) );

    $box['page']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['page']['layout']                  = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['layout'] , 'box' => 'layout' , 'update' => true  );
    $box['page']['settings']                = array( __('Page Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['page']['settings'] , 'box' => 'settings' , 'update' => true  );

    resources::$type['page']                = array();
    resources::$box['page']                 = $box['page'];
    
    /* post type testimonials */
    $res['testimonial']['labels'] = array(
        'name' => _x(__('Testimonials','cosmotheme'), 'post type general name'),
        'singular_name' => _x(__('Testimonial','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Testimonial','cosmotheme')),
        'add_new_item' => __('Add New Testimonial','cosmotheme'),
        'edit_item' => __('Edit Testimonial','cosmotheme'),
        'new_item' => __('New Testimonial','cosmotheme'),
        'view_item' => __('View Testimonial','cosmotheme'),
        'search_items' => __('Search Testimonial','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['testimonial']['args'] = array(
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 7,
        'supports' => array('title','editor','thumbnail'),
        '__on_front_page' => true
    );

    /* box for speaker */
    $form['testimonial']['info']['name']                 = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Author name' , 'cosmotheme') . '</strong>' );
    $form['testimonial']['info']['title']                  = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Author title' , 'cosmotheme') . '</strong>' );
    

    /* box - attach presentation to conference */
    if( is_array( $conferences ) && count( $conferences ) > 1 ){
        $form['testimonial']['conference']['conference']       = array( 'type' => 'sh--select' , 'value' => $conferences , 'label' => '<strong>' . __( 'Select Conference' , 'cosmotheme' ) . '</strong>'  , 'action' => "act.post_relation( extra.val('#conferences') , 'presentation' , 'attach_testimonial' );" , 'id' => 'conferences' );
        
        $form['testimonial']['conference']['save']             = array( 'type' => 'sh--attach' , 'value' => 'Attach Testimonial' , 'attach_selector' => 'select#conferences' );
    }
    $form['testimonial']['conference']['add_new']          = array( 'type' => 'sh--link' ,  'url' => 'post-new.php?post_type=conference' , 'title' => __( 'Add New Conference' , 'cosmotheme') );
    
    /* init boxes */
    $box['testimonial']['info']                             = array( __('Add Testimonial Aditional Info' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['testimonial']['info'] , 'box' => 'info' , 'update' => true );
    $box['testimonial']['conference']                     = array( __('Attach Testimonial to Conference' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['testimonial']['conference']  , 'callback' => array( 'search_relation' , array( 'conference' , 'testimonial' ) ) , 'records-title' => __("Testimonial's Conferences" , 'cosmotheme' )  );
    
    $box['testimonial']['layout']                           = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['conference']['layout'] , 'box' => 'layout' , 'update' => true  );
    //$box['testimonial']['settings']                         = array( __('Speaker Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['speaker']['settings'] , 'box' => 'settings' , 'update' => true  );

    resources::$labels['testimonial']                       = $res['testimonial']['labels'];
    resources::$type['testimonial']                         = $res['testimonial']['args'];
    resources::$box['testimonial']                          = $box['testimonial'];
?>