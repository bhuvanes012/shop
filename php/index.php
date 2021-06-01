<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
  
 include 'insert.php';
 $insert = new insert(); // create object for selection

$reqest=$_POST['request'];
/* $start = $_POST['start'];
$length = $_POST['length'];
$search = $_POST['search']['value']."%"; */
        
switch ($reqest) {
        case "signup":
            $phone = $_POST['phone']; // alax request
            $insert->signup($phone); // Using Object to Call The function
            break;
        case "store_signup":
            $phone = $_POST['phone']; // alax request
            $insert->store_signup($phone); // Using Object to Call The function
            break;
        case "getproduct":
            $store_id =$_POST['store_id'];
            $insert->get_store_product( $store_id); // Using Object to Call The function
            break;
        case "delect_store_product_id":
            $store_id =$_POST['store_id'];
            $product_id =$_POST['product_id'];
            $insert->delete_store_product( $store_id,$product_id); // Using Object to Call The function
            break;
        case "get_edit_product":
            $store_id =$_POST['store_id'];
            $product_id =$_POST['product_id'];
            $insert->get_edit_product( $store_id,$product_id); // Using Object to Call The function
            break;
        case "update_store_status":
            $store_id =$_POST['store_id'];
            $status =$_POST['status'];
            $insert->update_store_status( $store_id,$status); // Using Object to Call The function
            break;   
        case "update_product_status":
            $store_id =$_POST['store_id'];
            $product_id =$_POST['product_id'];
            $status =$_POST['status'];
            $insert->update_product_status( $store_id,$product_id,$status); // Using Object to Call The function
            break;  
        case "get_store":
            $user_id =$_POST['user_id'];
            $insert->get_store($user_id); // Using Object to Call The function
            break; 
        case "place_order":
            $store_id =$_POST['store_id'];
            $user_id =$_POST['user_id'];
            $phone =$_POST['phone'];
            $name =$_POST['name'];
            $address =$_POST['address'];
            $zip =$_POST['zip'];
            $order_details =$_POST['order_details'];
            $delivery_charge =$_POST['delivery_charge'];
            
            $insert->place_order( $store_id,$user_id,$phone,$name, $address,$zip,$order_details,$delivery_charge ); // Using Object to Call The function
            break;  
        case "store_home_order":
            $store_id =$_POST['store_id'];           
            $insert->store_home_order( $store_id ); // Using Object to Call The function
            break; 
        case "store_order_details":
            $store_id =$_POST['store_id'];           
            $insert->store_order_details( $store_id ); // Using Object to Call The function
            break; 
        case "update_store_order_confirm":
            $order_id =$_POST['order_id'];           
            $insert->update_store_order_confirm($order_id ); // Using Object to Call The function
            break;  
        case "update_store_order_cancel":
            $order_id =$_POST['order_id'];  
            $reason =$_POST['reason'];          
            $insert->update_store_order_cancel($order_id,$reason ); // Using Object to Call The function
            break; 
        case "store_devliery_request":
            $order_id =$_POST['order_id'];                       
            $insert->store_devliery_request($order_id); // Using Object to Call The function
            break; 
        case "store_order_history":
            $store_id =$_POST['store_id'];                        
            $insert->store_order_history($store_id); // Using Object to Call The function
            break;  
        case "user_update_location":
            $user_id =$_POST['user_id']; 
            $token =$_POST['token']; 
            $pincode = $_POST['pincode']; 
            $log = $_POST['log'];
            $lag =$_POST['lag'];  
            $address =$_POST['address']; 
            $insert->user_update_location($user_id,$token,$pincode,$log,$lag,$address); // Using Object to Call The function
            break; 
        case "store_update_location":
            $store_id =$_POST['store_id']; 
            $token =$_POST['token']; 
            $pincode = $_POST['pincode']; 
            $log = $_POST['log'];
            $lag =$_POST['lag'];  
            $address =$_POST['address']; 
            $insert->store_update_location($store_id,$token,$pincode,$log,$lag,$address); // Using Object to Call The function
            break;  
        case "user_history":
            $user_id =$_POST['user_id']; 
            $insert->user_history($user_id); // Using Object to Call The function
            break;
        case "self_delivery_completed":
            $order_id =$_POST['order_id'];                       
            $insert->self_delivery_completed($order_id); // Using Object to Call The function
            break;      
            
             
 }


?>