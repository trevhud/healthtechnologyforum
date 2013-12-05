<?php 
	class cart {
		
		/*The addtocart function makes sure that the session variable is initialzed and then 
		 * stores the received productid and quantiy to next available index. And note that 
		 * there is no need to increment the $max variable*/
		function addtocart(){    
			$q = 0;
			if(isset($_POST['item_id']) && isset($_POST['qty']) && isset($_POST['price']) && isset($_POST['post_id'])){
				$q = $_POST['qty'];
				$pid = $_POST['item_id'];
				$price = $_POST['price'];
				$post_id = $_POST['post_id'];
			}
			/*$pid is the product id (may be name of the ticket for example),
			 * $q is he qty added,
			 * $post_id is the post (event) for which the tickets are sold */
			
			$responce = array('error_msg'=>'');
			
			if($pid == '' or (int)$q<1){
				$responce['error_msg'] =  	__("Please specify quantity","cosmotheme");
				echo json_encode($responce);
				exit;
			} 
		 	
			/*check if this item is already in cart session, and add summ up the qty added now with the qty fron session*/
			$session_qty = 0;
			if(is_array($_SESSION['cart'])){
				if(self::product_exists($pid) >= 0){
					if(isset($_POST['cart_action']) && $_POST['cart_action'] == 'update_cart'){
						$session_qty = $q;
					}else{
						$session_qty = $_SESSION['cart'][self::product_exists($pid)]['qty'] + $q;
					}	
					
				}
				
			}
			
			/*if qty available is less than requesten qty + qty from session, we don't allow to add the item to the cart*/
			if(self::get_available_qty($pid, $post_id) < $session_qty){
				$responce['error_msg'] =  	__("Unfortunately we do not have enough tickets, please try adding smaller quantity","cosmotheme");
				echo json_encode($responce);
				
				exit;
			}
			
			if(is_array($_SESSION['cart'])){
				
				/*If product exist we will increment the qty*/
				if(self::product_exists($pid) >= 0){
					if(isset($_POST['cart_action']) && $_POST['cart_action'] == 'update_cart'){
						
						$_SESSION['cart'][self::product_exists($pid)]['qty'] = $q;
					}else{
						$_SESSION['cart'][self::product_exists($pid)]['qty'] += $q;
					}	
					echo json_encode($_SESSION['cart']);
					exit;
				}
				
				$max=count($_SESSION['cart']);
				$_SESSION['cart'][$max]['productid']=$pid;
				$_SESSION['cart'][$max]['qty']=$q;
				$_SESSION['cart'][$max]['price']=$price;
				$_SESSION['cart'][$max]['event_id']=$post_id;	
			}
			else{
				$_SESSION['cart']=array();
				$_SESSION['cart'][0]['productid']=$pid;
				$_SESSION['cart'][0]['qty']=$q;
				$_SESSION['cart'][0]['price']=$price;
				$_SESSION['cart'][0]['event_id']=$post_id;
			} 
			
			echo json_encode($_SESSION['cart']);
			
			exit;
		}
		
		/*The function goes through all the elements of shopping cart and checks if a products exists in the shopping cart*/
		function product_exists($pid){
			$pid=$pid;
			$max=count($_SESSION['cart']);
			$flag=-1;
			
			for($i = 0;$i < $max; $i++){
				
				if($pid==$_SESSION['cart'][$i]['productid']){
					$flag = $i; /*return the index of the product in the cart*/
					break;
				}
			}
			return $flag;
		}
		
		
		/*The remove_product function first finds the product and then removes the corresponding index from 
		 * the session array. The last statement { $_SESSION['cart']=array_values($_SESSION['cart']) } resets the array indexes.*/
		function remove_product(){
			$pid = $_POST['item_id'];
			$pid=intval($pid);
			$max=count($_SESSION['cart']);
			for($i=0;$i<$max;$i++){
				if($pid==$_SESSION['cart'][$i]['productid']){
					unset($_SESSION['cart'][$i]);
					break;
				}
			}
			$_SESSION['cart']=array_values($_SESSION['cart']);

			return $_SESSION['cart'];
		}
		
		function get_available_qty($pid, $post_id){
			$available_qty = 0;
			$tickets = meta::get_meta( $post_id , 'tickets' );
			
			foreach ($tickets as $ticket) {
				if($ticket['ticket_title'] == $pid){
					$available_qty = $ticket['ticket_qty_available'];
				}
			}
			
			return $available_qty;
		}
		
		function update_qty($pid, $post_id , $changed_qty, $action = 'add'){ /*$action can be add OR remove*/
			$tickets = meta::get_meta( $post_id , 'tickets' );
			
			$tickets_new = $tickets;
			$index = 0;
			foreach ($tickets as $ticket) {
				if($ticket['ticket_title'] == $pid){
					$available_qty = $ticket['ticket_qty_available'];
					
					if($action == 'add'){
						$available_qty_updated = $available_qty + $changed_qty;
					}else{
						$available_qty_updated = $available_qty - $changed_qty;
					}
					$tickets_new[$index]['ticket_qty_available'] = $available_qty_updated;
					
				}
				$index ++;
			}
			
			//delete_post_meta($post_id, 'tickets' );
			meta::set_meta( $post_id , 'tickets' , $tickets_new );
		}
		
		function get_shopping_cart_totals(){
			
			if(is_array($_SESSION['cart']) && sizeof($_SESSION['cart'])){
				$qty = 0;
				$sum = 0;
				
				foreach ($_SESSION['cart'] as $ticket) {
					$qty += $ticket['qty'];
					$sum += $ticket['qty']*$ticket['price'];
				}
				
				$result = '<div>'.sprintf(__('%d (%d items)','cosmotheme'),$sum, $qty).'</div>';
			}else{
				$result = '<div>'.__("Shpping cart is empty","cosmotheme").'</div>';
			}
			
				return $result;
			
		}
		
		function show_cart_total(){
			echo self::get_shopping_cart_totals();
			exit;
		}
		
		function get_shopping_cart_details(){
			$cart_details = __('Your cart is currently empty','cosmotheme');
			if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
				//var_dump($_SESSION['cart']);
				$cart_details = '<table class="cart_datails">';
				$cart_details .='	<tr>';
				$cart_details .='		<th>'.__('Ticket Category','cosmotheme').'</th>';
				$cart_details .='		<th>'.__('Price','cosmotheme').'</th>';
				$cart_details .='		<th>'.__('Qty Available','cosmotheme').'</th>';
				$cart_details .='		<th>'.__('Qty','cosmotheme').'</th>';
				$cart_details .='		<th>'.__('Total','cosmotheme').'</th>';
				$cart_details .='		<th></th>';
				$cart_details .='	</tr>';
				$subtotal = 0;
				foreach ($_SESSION['cart'] as $cart_item) {
					$cart_details .='<tr>';
					$cart_details .='	<td>'.$cart_item['productid'].'</td>';
					$cart_details .='	<td>'.$cart_item['price'].'</td>';
					$cart_details .='	<td>'.cart::get_available_qty($cart_item['productid'], $cart_item['event_id']).'</td>';
					$cart_details .='	<td><input type="text" id="qty_'.$cart_item['productid'].'_'.$cart_item['event_id'].'" onkeyup="update_shopping_cart(\''.$cart_item['productid'].'\',jQuery(this),'.$cart_item['price'].','.$cart_item['event_id'].');" class="digit" value="'.$cart_item['qty'].'"></td>';
					$cart_details .='	<td>'.$cart_item['qty']*$cart_item['price'].'</td>';
					$confirm_msg = __('Are you sure ?','cosnotheme');
					$cart_details .='	<td><a href="javascript:void(0)" onclick="remove_cart_item(\''.$cart_item['productid'].'\',\''.$confirm_msg.'\')">remove</a></td>';
					$cart_details .='</tr>';
					$subtotal += $cart_item['qty']*$cart_item['price'];
				}
				$cart_details .='	<tr>';
				$cart_details .='		<td colspan=4></td>';
				$cart_details .='		<td colspan=2>'.__('Subtotal:','cosmotheme').' '.$subtotal.'</td>';
				$cart_details .='	</tr>';
				$cart_details .='</table>';
				
			}
			
			return $cart_details;
		}
		
		function get_cart_details_updated(){
			echo cart::get_shopping_cart_details();
			exit();
		}
	}
?>