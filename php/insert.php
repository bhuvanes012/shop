<?php
include 'Db_Conn_prepare.php';
class insert{

    private $connection;
    function insert(){
        $this->connection = new DB_CONN();     
    }
function signup($phone){
    
    $query = " INSERT INTO user_details(phone) VALUES ('$phone')";
    $query2 = "SELECT `user_id`, `phone`, `name`, `user_address`  FROM `user_details` WHERE phone='$phone'";
    $sql = $this->connection->reg_user($query,$query2);
}

// 
function store_signup($phone){
    
    $query = " INSERT INTO store_details(store_phone) VALUES ('$phone')";
    $query2 = "SELECT `store_id`, `store_phone` ,store_address,store_name  FROM `store_details` WHERE store_phone='$phone'";
    $sql = $this->connection->reg_store($query,$query2);
}

//get stora product detail 
function get_store_product($store_id){
    
    $query = "select * from product_details where store_id=$store_id";
     $sql = $this->connection->get_store_product($query);
}



function delete_store_product( $store_id,$product_id){
    
    $query = "DELETE FROM `product_details` WHERE store_id =$store_id and product_id = $product_id";
     $sql = $this->connection->delete_store_product($query,$product_id);
}

function get_edit_product( $store_id,$product_id){
    
    $query = "select `store_id`, `product_id`, `image1`, `image2`, `image3`, `product_name`, `price`  FROM `product_details` WHERE store_id =$store_id and product_id = $product_id";
     $sql = $this->connection->get_edit_product($query);
}

function update_store_status( $store_id,$status){
    
    $query = "UPDATE `store_details` SET `store_status`=$status where store_id =$store_id";
     $sql = $this->connection->update_store_status($query);
}
function update_product_status( $store_id,$product_id,$status){
    
    $query = "UPDATE `product_details` SET `available`=$status where store_id =$store_id and product_id =$product_id";
    $sql = $this->connection->update_product_status($query);
}


function get_store($user_id){
    $query = " 
    SELECT sd.*,ud.user_id,ud.lag,ud.log ,( 3959 * acos( cos( radians(ud.lag) ) * cos( radians(sd.lag) ) * cos( radians( sd.log ) - radians(ud.log) ) + sin( radians(ud.lag) ) * sin( radians( sd.lag ) ) ) ) as distance FROM store_details sd left outer join user_details ud  On ud.user_id=$user_id
    where ( 3959 * acos( cos( radians(ud.lag) ) * cos( radians(sd.lag) ) * cos( radians( sd.log ) - radians(ud.log) ) + sin( radians(ud.lag) ) * sin( radians( sd.lag ) ) ) ) < sd.store_range";
    $sql = $this->connection->get_store($query);
}
function place_order( $store_id,$user_id,$phone,$name, $address,$zip,$order_details,$delivery_charge){
    
    $order = json_encode($order_details);
  
    $query = " INSERT INTO `order_details` ( `user_id`, `store_id`, `order_details`,delivery_charge ) VALUES ($user_id,$store_id,'$order', $delivery_charge )";
    $query2 = " UPDATE `user_details` SET  `order_phone`='$phone',`name`='$name',`user_address`='$address',`pincode`='$zip'WHERE user_id = $user_id";
    $sql = $this->connection->place_order($query,$query2);
}
function store_home_order($store_id){
    $query = " select * from order_details WHERE store_id= $store_id and store_pickup_status <> 1 and order_cancel_by_store_status <>1 ";
    $sql = $this->connection->store_home_order($query);
}
function store_order_details($store_id){
    $query = "select sd.delivery_type,ud.order_phone,ud.lag,ud.log,ud.user_address,od.* from order_details as od
    left OUTER join user_details as ud on ud.user_id=od.user_id 
    left outer join store_details AS sd on od.store_id =sd.store_id
    WHERE od.store_id= $store_id and od.store_pickup_status = 1  and od.order_cancel_by_store_status <>1 and  od.deliveryed_status	 <>1";
    $sql = $this->connection->store_order_details($query);
}
function store_order_history($store_id){
    $query = " select sd.delivery_type,ud.order_phone,ud.lag,ud.log,ud.user_address,od.* from order_details as od
    left OUTER join user_details as ud on ud.user_id=od.user_id 
    left outer join store_details AS sd on od.store_id =sd.store_id
    WHERE od.store_id= $store_id  ";
    $sql = $this->connection->store_order_details($query);
}
function update_store_order_confirm($order_id){
    $query = " update order_details set store_pickup_status=1,store_pickup_time=CURRENT_TIMESTAMP where order_id= $order_id  ";
    $sql = $this->connection->update_store_status($query);
}
function update_store_order_cancel($order_id,$reason ){
    $query = " update order_details set  order_cancel_by_store_status=1,order_cancel_reason='$reason' where order_id=$order_id ";
    $sql = $this->connection->update_store_status($query);
}
function store_devliery_request($order_id){
    $query = " update order_details set store_devliery_request=1,delivery_request_time=CURRENT_TIMESTAMP where order_id= $order_id  ";
    $sql = $this->connection->update_store_status($query);
}

function user_update_location($user_id,$token,$pincode,$log,$lag,$address){
    $query = " UPDATE `user_details` SET  `sys_address`='$address',`pincode`='$pincode',`lag`='$lag',`log`='$log',`token`='$token' WHERE user_id=$user_id ";
    $sql = $this->connection->update_store_status($query);
}
function store_update_location($store_id,$token,$pincode,$log,$lag,$address){
    $query = " UPDATE `store_details` SET  `store_sys_address`='$address',`pincode`='$pincode',`lag`='$lag',`log`='$log',`store_token`='$token' WHERE store_id =$store_id ";
    $sql = $this->connection->update_store_status($query);
}
//user home history 
function user_history($user_id){
    $query = " select * from order_details WHERE user_id= $user_id ";
    $sql = $this->connection->store_home_order($query);
}
function self_delivery_completed($order_id){
    $query = " update order_details set deliveryed_status=1,delivery_completed_time=CURRENT_TIMESTAMP where order_id= $order_id  ";
    $sql = $this->connection->update_store_status($query);
}

}

