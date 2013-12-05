var act = new Object();

act.select = function( selector , args , type ){
    jQuery(document).ready(function( ){
        jQuery( 'option' , jQuery( 'select' + selector ) ).each(function(i){
            if( type == 'hs' ){
                if( jQuery(this).is(':selected') ){
                    for (var key in args) {
                        if ( args.hasOwnProperty( key ) ) {

                            if( jQuery( this ).val().trim()  == key ){
                                jQuery( args[ key ] ).hide();
                            }else{
                                jQuery( args[ key ] ).show();
                            }
                        }
                    }
                }
            }

            if( type == 'sh' ){
                if( jQuery(this).is(':selected') ){
                    for (var key in args) {
                        if ( args.hasOwnProperty( key ) ) {
                            if( jQuery( this ).val().trim()  == key ){
                                jQuery( args[ key ] ).show();
                            }else{
                                jQuery( args[ key ] ).hide();
                            }
                        }
                    }
                }
            }
			
			if( type == 'sh_' ){
				var show = '';
                var show_ = '';
                if( jQuery(this).is(':selected') ){
                    for (var key in args) {
                        if ( args.hasOwnProperty( key ) ) {

                            if( jQuery( this ).val().trim()  == key ){
                                show = args[ key ];
                            }else{
                                if( key == 'else' ){
                                    show_ = args[ key ];
                                }
                                jQuery( args[ key ] ).hide();
                            }
                        }
                    }

                    if( show == '' ){
                        jQuery( show_ ).show();
                    }else{
                        jQuery( show ).show();
                    }
                }
            }
			
			if( type == 'hs_' ){
				var hide = '';
                if( jQuery(this).is(':selected') ){
                    for (var key in args) {
                        if ( args.hasOwnProperty( key ) ) {

                            if( jQuery( this ).val().trim()  == key ){
                                hide = args[ key ];
                            }else{
                                jQuery( args[ key ] ).show();
                            }
                        }
                    }
					
					jQuery( hide ).hide();
                }
            }

            if( type == 's' ){
                if( jQuery(this).is(':selected') ){
                    for (var key in args) {
                        if ( args.hasOwnProperty( key ) ) {
                            if( jQuery( this ).val().trim()  == key ){
                                jQuery( args[ key ] ).show();
                            }
                        }
                    }
                }
            }

            if( type == 'h' ){
                if( jQuery(this).is(':selected') ){
                    for (var key in args) {
                        if ( args.hasOwnProperty( key ) ) {
                            if( jQuery( this ).val().trim()  == key ){
                                jQuery( args[ key ] ).hide();
                            }
                        }
                    }
                }
            }

            if( type == 'ns' ){
                if( jQuery(this).is(':selected') ){
                    for (var key in args) {
                        if ( args.hasOwnProperty( key ) ) {
                            if( jQuery( this ).val().trim()  == key ){
                            }else{
                                jQuery( args[ key ] ).show();
                            }
                        }
                    }
                }
            }

            if( type == 'nh' ){
                if( jQuery(this).is(':selected') ){
                    for (var key in args) {
                        if ( args.hasOwnProperty( key ) ) {
                            if( jQuery( this ).val().trim()  == key ){
                            }else{
                                jQuery( args[ key ] ).hide();
                            }
                        }
                    }
                }
            }
        });
    });
}

act.check = function( selector , args , type ){
    jQuery(document).ready(function( ){
        if( type == 'hs' ){
            if( jQuery( selector ).is(':checked') ){
                for (var key in args) {
                    if ( args.hasOwnProperty( key ) ) {
                        if( jQuery( selector ).val().trim()  == key ){
                            jQuery( args[ key ] ).hide();
                        }else{
                            jQuery( args[ key ] ).show();
                        }
                    }
                }
            }
        }

        if( type == 'sh' ){
            if( jQuery( selector ).is(':checked') ){
                for (var key in args) {
                    if ( args.hasOwnProperty( key ) ) {
                        if( jQuery( selector ).val().trim()  == key ){
                            jQuery( args[ key ] ).show();
                        }else{
                            jQuery( args[ key ] ).hide();
                        }
                    }
                }
            }
        }

        if( type == 's' ){
            if( jQuery( selector ).is(':checked') ){
                for (var key in args) {
                    if ( args.hasOwnProperty( key ) ) {
                        if( jQuery( selector ).val().trim()  == key ){
                            jQuery( args[ key ] ).show();
                        }
                    }
                }
            }
        }

        if( type == 'h' ){
            if( jQuery( selector ).is(':checked') ){
                for (var key in args) {
                    if ( args.hasOwnProperty( key ) ) {
                        if( jQuery( selector ).val().trim()  == key ){
                            jQuery( args[ key ] ).hide();
                        }
                    }
                }
            }
        }

        if( type == 'ns' ){
            if( jQuery( selector ).is(':checked') ){
                for (var key in args) {
                    if ( args.hasOwnProperty( key ) ) {
                        if( jQuery( selector ).val().trim()  == key ){
                        }else{
                            jQuery( args[ key ] ).show();
                        }
                    }
                }
            }
        }

        if( type == 'nh' ){
            if( jQuery( selector ).is(':checked') ){
                for (var key in args) {
                    if ( args.hasOwnProperty( key ) ) {
                        if( jQuery( selector ).val().trim()  == key ){
                        }else{
                            jQuery( args[ key ] ).hide();
                        }
                    }
                }
            }
        }
    });
}

act.show = function( selector ){
    jQuery(document).ready(function( ){
        jQuery( selector ).show();
    });
}

act.hide = function( selector ){
    jQuery(document).ready(function( ){
        jQuery( selector ).hide();
    });
}

act.link = function( selector , args , type ){
    jQuery(document).ready(function( ){
		var id = jQuery( selector ).attr('id');
        if( type == 'hs' ){
			for (var key in args) {
				if ( args.hasOwnProperty( key ) ) {
					if( id.trim()  == key ){
						jQuery( args[ key ] ).hide();
					}else{
						jQuery( args[ key ] ).show();
					}
				}
			}            
        }

        if( type == 'sh' ){
			for (var key in args) {
				if ( args.hasOwnProperty( key ) ) {
					if( id.trim()  == key ){
						jQuery( args[ key ] ).show();
					}else{
						jQuery( args[ key ] ).hide();
					}
				}
			}            
        }

        if( type == 's' ){
			for (var key in args) {
				if ( args.hasOwnProperty( key ) ) {
					if( id.trim()  == key ){
						jQuery( args[ key ] ).show();
					}
				}
			}
        }

        if( type == 'h' ){
			for (var key in args) {
				if ( args.hasOwnProperty( key ) ) {
					if( id.trim()  == key ){
						jQuery( args[ key ] ).hide();
					}
				}
			}
        }

        if( type == 'ns' ){
			for (var key in args) {
				if ( args.hasOwnProperty( key ) ) {
					if( id.val().trim()  == key ){
					}else{
						jQuery( args[ key ] ).show();
					}
				}
			}
        }

        if( type == 'nh' ){
			for (var key in args) {
				if ( args.hasOwnProperty( key ) ) {
					if( id.val().trim()  == key ){
					}else{
						jQuery( args[ key ] ).hide();
					}
				}
			}
        }
    });
}

act.upload_id = function( group , name , id ){
    jQuery(document).ready(function() {
        (function(){
            var tb_show_temp = window.tb_show;
            window.tb_show = function(){
                tb_show_temp.apply(null, arguments);
                jQuery('#TB_iframeContent').load(function(){
                    jQuery( this ).contents().find('p.upload-html-bypass.hide-if-no-js').html('');
                    jQuery( this ).contents().find('div#html-upload-ui').show();
                    jQuery( this ).contents().find('div#flash-upload-ui').html('');
                    $container = jQuery( this ).contents().find('tr.submit td.savesend');
                    var sid = '';
                    $container.find('div.del-attachment').each(function(){
                        var $div = jQuery(this);
                        sid = $div.attr('id').toString();
                        if( typeof sid != "undefined" ){
                            sid = sid.replace(/del_attachment_/gi , "" );
                            jQuery(this).parent('td.savesend').html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                        }else{
                            var $submit = $container.find('input[type="submit"]');
                            sid = $submit.attr('name');
                            if( typeof sid != "undefined" ){
                                sid = sid.replace(/send\[/gi , "" );
                                sid = sid.replace(/\]/gi , "" );
                                $container.html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                            }
                        }
                    });

                    $container.find('input[type="submit"]').click(function(){
                        $my_submit = jQuery( this );
                        sid = $my_submit.attr('name');
                        if( typeof sid != "undefined" ){
                                sid = sid.replace(/send\[/gi , "" );
                                sid = sid.replace(/\]/gi , "" );
                        }else{
                            sid = 0;
                        }
                        var html = $my_submit.parent('td').parent('tr').parent('tbody').parent('table').html();
                        window.send_to_editor = function() {
                            var attach_url = jQuery('input[name="attachments['+sid+'][url]"]',html).val();
                            jQuery( 'input#' + group + '_' + name + id ).val(  attach_url  );
                            jQuery( 'input#' + group + '_' + name + '_id' + id ).val( sid );

                            if( id.length > 0 ){
                                jQuery( 'img#attach_' + group + '_' + name  + id).attr( "src" ,  attach_url  );
                            }

                            tb_remove();
                        }
                    });
                });

            }})()

        formfield = jQuery( 'input#' + group + '_' + name + id ).attr('name');
        tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true&amp;flash=0');
        return false;
    });
}

act.upload = function( selector ){
    jQuery(document).ready(function() {
        (function(){
            var tb_show_temp = window.tb_show;
            window.tb_show = function(){
                tb_show_temp.apply( null , arguments);
                jQuery('#TB_iframeContent').load(function(){
                    jQuery( this ).contents().find('p.upload-html-bypass.hide-if-no-js').html('');
                    jQuery( this ).contents().find('div#html-upload-ui').show();
                    jQuery( this ).contents().find('div#flash-upload-ui').html('');
                    $container = jQuery( this ).contents().find('tr.submit td.savesend');
                    var sid = '';
                    $container.find('div.del-attachment').each(function(){
                        var $div = jQuery(this);
                        sid = $div.attr('id').toString();
                        if( typeof sid != "undefined" ){
                            sid = sid.replace(/del_attachment_/gi , "" );
                            jQuery(this).parent('td.savesend').html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                        }else{
                            var $submit = $container.find('input[type="submit"]');
                            sid = $submit.attr('name');
                            if( typeof sid != "undefined" ){
                                sid = sid.replace(/send\[/gi , "" );
                                sid = sid.replace(/\]/gi , "" );
                                $container.html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                            }
                        }
                    });

                    $container.find('input[type="submit"]').click(function(){
                        $my_submit = jQuery( this );
                        sid = $my_submit.attr('name');
                        if( typeof sid != "undefined" ){
                            sid = sid.replace(/send\[/gi , "" );
                            sid = sid.replace(/\]/gi , "" );
                        }else{
                            sid = 0;
                        }
                        var html = $my_submit.parent('td').parent('tr').parent('tbody').parent('table').html();
                        
                        window.send_to_editor = function() {
                            var attach_url = jQuery('input[name="attachments['+sid+'][url]"]',html).val();
                            jQuery( selector ).val( attach_url );
                            tb_remove();
                        }
                    });
                });

            }})()

            formfield = jQuery( selector ).attr('name');
            tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
            return false;
        
    });
}

act.post_relation = function( post_id , meta_label , field_id ){
    jQuery( document ).ready(function(){
        jQuery.post( ajaxurl , { "action" : 'post_relation' , "post_id" : post_id , "meta_label": meta_label , "field_id" : field_id } , function( result ){ jQuery( 'span#' + field_id  ).html( result ); jQuery('div.' + field_id ).show();  } );
    });
}

act.slide_resources = function( res_type , field_id , label_selector ){
    jQuery( document ).ready(function(){
        jQuery.post( ajaxurl , { "action" : 'get_slide_resources' , "res_type": res_type , "field_id" : field_id } , function( result ){
            jQuery( 'span#' + field_id  ).html( result ); jQuery('div.' + field_id ).show();
            jQuery.post( ajaxurl , { "action" : 'get_slide_resources_label' , "res_type": res_type  } , function( result ){
                jQuery( label_selector ).html( result );
            });

        });
    });
}

act.preview = function( family , size , weight , text , selector ){
	jQuery( document ).ready(function(){
		jQuery.post( ajaxurl , { "action" : "text_preview" , "family" : family , "size" : size , "weight" : weight , "text" : text } , function( result ) { jQuery( selector ).html( result ); } );
	});
}

act.is_array = function (obj) {
    if (obj.constructor.toString().indexOf("Array") == -1)
        return false;
    else
        return true;
}

act.send_mail = function( action , form , container ){
    jQuery( document ).ready(function(){

        var name  = jQuery('input[name="name"]').val();
        var email = jQuery("input[name=\"email\"]").val();
		var contact_email = jQuery( form ).find("input[name=\"contact_email\"]").val();  
        var phone  = jQuery("input[name=\"phone\"]").val();
        var mssg  = jQuery("textarea[name=\"message\"]").val();


        jQuery.post( ajaxurl ,
                {
                    "action" : action ,
                    "name" : name,
                    "email" : email,
					"contact_email" : contact_email,   
                    "phone" : phone,
                    "message" : mssg,
                    "btn_send" : "btn_send"
                } ,
                function( data ){
                    var result = '';
                    var array  = data.split( '","' );
                    if( act.is_array( array ) ){
                        for(var i = 0; i < array.length; i++ ){
                            if( jQuery.trim(array[i]) == 'Error, fill all required fields ( email )' ){
                                result = result + array[i] + '<br />';
                                jQuery( form ).find("input[name=\"email\"]").addClass('send-error');
                            }

                            if( jQuery.trim(array[i]) == 'Error, fill all required fields ( name )' ){
                                result = result + array[i] + '<br />';
                                jQuery( form ).find("input[name=\"name\"]").addClass('send-error');
                            }

                            if( jQuery.trim(array[i]) == 'Error, fill all required fields ( message )' ){
                                result = result + array[i] + '<br />';
                                jQuery( form ).find("textarea[name=\"message\"]").addClass('send-error');
                            }
                        }
                        if( result.toString().length > 0 ){
                            jQuery( container ).html( result );
                        }else{
                            jQuery( container ).html( data );

                                jQuery('#name').val('');
                                jQuery('#email').val('');
                                jQuery('#comment').val('');
                                jQuery('#contact_name').val('');
                                jQuery('#contact_email').val('');
                                jQuery('#contact_phone').val('');
                                jQuery('#contact_message').val('');
                        }
                    }else{
                        jQuery( container ).html( data );
                    }
        });
    });
}

act.radio_icon = function( group , index ){

	jQuery(function(){
        jQuery('.generic-field-' + group + ' .generic-input-radio-icon input').removeAttr("checked");
        jQuery('.generic-field-' + group + ' img.pattern-texture').removeClass( 'selected' );

        jQuery('.generic-field-' + group + ' .generic-input-radio-icon.' + index + ' input').attr('checked' , 'checked');
        jQuery('.generic-field-' + group + ' img.pattern-texture.' + index).addClass( 'selected' );
    });
}

act.accept_digits = function( objtextbox ){
    var exp = /[^\d]/g;
    objtextbox.value = objtextbox.value.replace(exp,'');
}


jQuery(document).ready(function() {
	/* ready actions */
    /* flickr settings */
    jQuery('.flickr_badge_image').each(function(index){
		var x = index % 3;
		if(index !=1 && x == 2){
			jQuery(this).addClass('last');
		}
	});

	/* digit input */
	jQuery('input[type="text"].digit').bind('keyup', function(){
		act.accept_digits( this );
	});
	
	jQuery('input[type="text"].conference-tickets-ticket_qty_available').bind('keyup', function(){
		act.accept_digits( this );
	});
	
	/* money input */
	jQuery('input[type="text"].tickets-ticket_price ').bind('keyup', function(){
		jQuery(this).toNumber();
	});
	jQuery('input[type="text"].conference-tickets-ticket_price').bind('keyup', function(){
		jQuery(this).toNumber();
	});
	
    /* color piker */
    jQuery('input[id^="pick_"]').each(function(index) {

        var farbtastic;
        var $obj = this;
        (function(jQuery){
            var pickColor = function(a) {
                farbtastic.setColor(a);
                jQuery('#pick_' + jQuery($obj).attr('op_name') ).val(a);
                jQuery('#link_pick_' + jQuery($obj).attr('op_name') ).css('background-color', a);
            };

            jQuery(document).ready( function() {

                farbtastic = jQuery.farbtastic('#colorPickerDiv_'  + jQuery($obj).attr('op_name') , pickColor);

                pickColor( jQuery('#pick_' + jQuery($obj).attr('op_name') ).val() );

                jQuery('#link_pick_' + jQuery($obj).attr('op_name') ).click( function(e) {
                    jQuery('#colorPickerDiv_'  + jQuery($obj).attr('op_name') ).show();
                    e.preventDefault();
                });

                jQuery('#pick_' + jQuery($obj).attr('op_name') ).keyup( function() {
                    var a = jQuery('#pick_' + jQuery($obj).attr('op_name') ).val(),
                        b = a;

                    a = a.replace(/[^a-fA-F0-9]/, '');
                    if ( '#' + a !== b )
                        jQuery('#pick_' + jQuery($obj).attr('op_name') ).val(a);
                    if ( a.length === 3 || a.length === 6 )
                        pickColor( '#' + a );
                });

                jQuery(document).mousedown( function() {
                    jQuery('#colorPickerDiv_'  + jQuery($obj).attr('op_name')).hide();
                });
            });
        })(jQuery);

    });


    var sh = true;

    jQuery('.en_registration option').each(function(){
        if( jQuery( this ).is(':selected') ){
            if( jQuery( this ).val().trim() == 'paid_registration' ){
                sh = false;
            }
        }
    });

    if( sh ){
        jQuery('#conference_tickets').hide();
    }

    jQuery('.en_registration').change(function(){
        sh = false;
        jQuery('.en_registration option').each(function(){
            if( jQuery( this ).is(':selected') ){
                if( jQuery( this ).val().trim() == 'paid_registration' ){
                    sh = true;
                }
            }
        });

        if( sh ){
            jQuery('#conference_tickets').show();
        }else{
            jQuery('#conference_tickets').hide();
        }
    });
    
});


function AddToCart(item_id,qty,price,post_id,cart_action){
	
	jQuery.post( ajaxurl ,
            {
                "action" : 'add_to_cart' ,
                "item_id" : item_id,
                "qty" : qty,
                "price" : price,
                "post_id" : post_id,
                "cart_action" : cart_action	
            } ,
            function( data ){ 
            	json = eval("(" + data + ")");
        		if(json['error_msg'] && json['error_msg'] != ''){
        			alert(json['error_msg']);
        		}else{
        			jQuery.post( ajaxurl ,
        		            {
        		                "action" : 'get_cart_total' 
        		            } ,
        		            function( data ){ 
        		            	jQuery('.shopping_cart').html(data);
        		                
        		    });
        		}
            		
            	
                
    });
}

/*this fnction is triggered when user changes the qty value from the input, on ht e shopping cart page*/
function update_shopping_cart(item_id, obj, price, post_id){
	
	if(obj.val() == ''){
		
		obj.val('1');
	}
	
	AddToCart(item_id,obj.val(),price,post_id,'update_cart');
	//we want to run get_shopping_cart_details() function after AddToCart()     
	window.setTimeout("get_shopping_cart_details();", 1); 
}

function get_shopping_cart_details(){
	jQuery.post( ajaxurl ,
            {
                "action" : 'get_cart_details_updated' 
            } ,
            function( data ){ 
            	jQuery('#shopping_cart_details').html(data);
                
    });
	
}

function remove_cart_item(item_id,confirm_msg){
	if(confirm(confirm_msg)) {
		jQuery.post( ajaxurl ,
	            {
	                "action" : 'remove_cart_item' ,
	                "item_id" : item_id	
	            } ,
	            function( ){ 
	            	get_shopping_cart_details();
	                
	    });
	}	
}

function closeCosmoMsg(msg_id){
	
	jQuery.ajax({
		url: ajaxurl,
		data: '&action=set_cosmo_news&msg_id='+msg_id,
		type: 'POST',
		cache: false,
		success: function (data) { 
			//json = eval("(" + data + ")");
    		jQuery('#cosmo_news').hide();
			
		},
		error: function (xhr) {
			
			
		}
	});
  
}