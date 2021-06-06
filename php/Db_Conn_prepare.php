<?php
//include 'Config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class DB_CONN{
    public $conn;
    function DB_CONN(){
        $servername = "localhost";
        $username = "u845810931_bhuvanes114";
        $password = "Bhuvanes@7829";
        $db = "u845810931_shop";
        // Create connection
        $this->conn = mysqli_connect($servername, $username, $password,$db);
        
                //return $this->connection;
                if(!($this->conn)){
                    echo "fail";
                }  
               // echo 'sucessfull';  
    }   
     

    
   //product details ADD
   function prod_details($id,$name,$price,$path_img1,$path_img2,$path_img3){
    $sql =  $this->conn->query("INSERT INTO  product_details   (`store_id`,`image1`, `image2`, `image3`, `price`,`product_name`, `available`) VALUES ($id,'$path_img1','$path_img2','$path_img3',$price,'$name',true)");
    if($this->conn->affected_rows >0)
    {
       echo "sucess";
       
    }
    else {
        echo 'fail';
        
        
    }
}
  


 //product details ADD
 function prod_update_details($id,$product_id,$name,$price,$path_img1,$path_img2,$path_img3){
    $select =  $this->conn->query("select image1,image2,image3 from product_details where product_id= $product_id"); 
    $array = array(); 
    $img1='';  
    $img3='';  
    $img2=''; 
    $fimg1='';  
    $fimg3='';  
    $fimg2=''; 
    foreach  ($select as $row) { 
        $img1=$row['image1'];
        $img2=$row['image2'];
        $img3=$row['image3'];
      }
   if($path_img1==''){
    $fimg1=$img1;
   }else{
    $fimg1=$path_img1;   
   }
   if($path_img2==''){
    $fimg2=$img2;
   }else{
    $fimg2=$path_img2;
   }
   if($path_img3==''){
    $fimg3=$img3;
   }else{
    $fimg3=$path_img3;
   }


    $sql =  $this->conn->query("UPDATE `product_details` SET `image1`='$fimg1',`image2`='$fimg2',`image3`='$fimg3',`product_name`='$name',`price`=$price,store_id=$id  WHERE product_id=$product_id");
    if($this->conn->affected_rows >0)
    {
       echo "sucess";
       

       if (file_exists($img1) && $path_img1!= '') {
        unlink($img1);
        
      } 
       
      if (file_exists($img2) && $path_img2 != '') {
        unlink($img2);
        
      } 
      if (file_exists($img3) && $path_img3 != '') {
        unlink($img3);
        
      } 


    }
    else {
        echo 'fail';
        
        
    }
}


 //get product details
 function get_store_product($query){
     
     $sql =  $this->conn->query($query); 
     $array = array();   
     foreach  ($sql as $row) { 
        array_push($array,array("product_id"=>$row['product_id'],"product_name"=>$row['product_name'],"product_name_with"=>str_replace(" ","~",$row['product_name']),"price"=>$row["price"],"image1"=>$row["image1"],"image2"=>$row["image2"],"image3"=>$row["image3"],"store_id"=>$row["store_id"],"status"=>$row["available"]));   // store the data in $array
      
      }
      echo json_encode($array);

}
    

//user register
    function reg_user($query,$query2){
        $sql =  $this->conn->query($query);
        $array = array(); 
         if($this->conn->affected_rows >0)
         {
           
         }
         $sql2 =  $this->conn->query($query2);   
         foreach  ($sql2 as $row) { 
            array_push($array,array("user_id"=>$row['user_id'],"name"=>$row['name'],"phone"=>$row["phone"],"address"=>$row["user_address"] ));   // store the data in $array
          
          }
          echo json_encode($array);
    
    }
    //store register
    function reg_store($query,$query2){
        $sql =  $this->conn->query($query);
        $array = array(); 
         if($this->conn->affected_rows >0)
         {
           
         }
         $sql2 =  $this->conn->query($query2);   
         foreach  ($sql2 as $row) { 
            array_push($array,array("store_id"=>$row['store_id'],"store_name"=>$row['store_name'],"store_phone"=>$row["store_phone"],"store_address"=>$row["store_address"]));   // store the data in $array
          
          }
          echo json_encode($array);
    
    }
 
    function store_home_status($query){
        $sql =  $this->conn->query($query);
        $array = array(); 
        foreach  ($sql as $row) { 
            array_push($array,array("store_status"=>$row['store_status']));    
          }
          echo json_encode($array);
    }



    function delete_store_product($query,$product_id){
        $select =  $this->conn->query("select image1,image2,image3 from product_details where product_id= $product_id"); 
        $array = array(); 
        $img1='';  
        $img3='';  
        $img2='';  
        foreach  ($select as $row) { 
            $img1=$row['image1'];
            $img2=$row['image2'];
            $img3=$row['image3'];
          }


        $sql =  $this->conn->query($query);
        if($this->conn->affected_rows >0)
        {
           echo "sucess";
           
            if (file_exists($img1) ) {
                unlink($img1);
                
            } 
            
            if (file_exists($img2) ) {
                unlink($img2);
                
            } 
            if (file_exists($img3) ) {
                unlink($img3);
        
             } 
        }
        else {
            echo 'fail';
            
            
        }
    }


    //get product details
 function get_edit_product($query){
     
    $sql =  $this->conn->query($query); 
    $array = array();   
    foreach  ($sql as $row) { 
       array_push($array,array("product_id"=>$row['product_id'],"product_name"=>$row['product_name'],"price"=>$row["price"],"image1"=>$row["image1"],"image2"=>$row["image2"],"image3"=>$row["image3"],"store_id"=>$row["store_id"]));   // store the data in $array
     
     }
     echo json_encode($array);

}

function store_order_details($query){
     
    $sql =  $this->conn->query($query); 
    $array = array();   
    foreach  ($sql as $row) { 
       array_push($array,array("order_id"=>$row['order_id'],"user_id"=>$row['user_id'],"order_details"=>$row['order_details'],"store_pickup_status"=>$row["store_pickup_status"],"delivery_pickup_status"=>$row["delivery_pickup_status"],"tracking_location"=>$row["tracking_location"],"order_time"=>$row["order_time"],"store_id"=>$row["store_id"],"store_devliery_request"=>$row["store_devliery_request"] ,"order_cancel_by_devliery_status"=>$row["order_cancel_by_devliery_status"],"order_cancel_by_store_status"=>$row["order_cancel_by_store_status"],"deliveryed_status"=>$row["deliveryed_status"],"delivery_type"=>$row["delivery_type"],"delivery_charge"=>$row["delivery_charge"],"user_address"=> str_replace(" ","~","Name : ".$row['name']."  Address:  ".$row['user_address']),"order_phone"=>$row["order_phone"],"log"=>$row["log"],"lag"=>$row["lag"]));   // store the data in $array
     
     }
     echo json_encode($array);

}

function store_home_order($query){
     
    $sql =  $this->conn->query($query); 
    $array = array();   
    foreach  ($sql as $row) { 
       array_push($array,array("order_id"=>$row['order_id'],"user_id"=>$row['user_id'],"order_details"=>$row['order_details'],"store_pickup_status"=>$row["store_pickup_status"],"delivery_pickup_status"=>$row["delivery_pickup_status"],"tracking_location"=>$row["tracking_location"],"order_time"=>$row["order_time"],"store_id"=>$row["store_id"],"store_devliery_request"=>$row["store_devliery_request"] ,"order_cancel_by_devliery_status"=>$row["order_cancel_by_devliery_status"],"order_cancel_by_store_status"=>$row["order_cancel_by_store_status"],"deliveryed_status"=>$row["deliveryed_status"],"delivery_charge"=>$row["delivery_charge"]));   // store the data in $array
     
     }
     echo json_encode($array);

}

   function execute_query(){
        $query="select * from user_detail";
        echo $query;
        $sql =  $this->conn->query($query);
        
        $array = array();
        foreach  ($sql as $row) { 
            array_push($array,$row);   // store the data in $array
            PRINT_R($row);
        }
        
    }    

    function update_store_status($query){
        $sql =  $this->conn->query($query);
        if($this->conn->affected_rows >0)
        {
           echo "sucess";
           
        }
        else {
            echo 'fail';
            
            
        }
    }

    function update_product_status($query){
        $sql =  $this->conn->query($query);
        if($this->conn->affected_rows >0)
        {
           echo "sucess";
           
        }
        else {
            echo 'fail';
            
            
        }
    }

    function get_store($query){
     
        $sql =  $this->conn->query($query); 
        $array = array();   
        foreach  ($sql as $row) { 
           array_push($array,array("store_id"=>$row['store_id'],"store_image"=>$row['store_image'],"store_address"=>$row["store_address"],"store_name"=>$row["store_name"],"distance"=>$row["distance"],"minimum_order"=>$row["minimum_order"] ));   // store the data in $array
         
         }
         echo json_encode($array);
    
    }

    function place_order($query,$query2){
        $sql =  $this->conn->query($query);       
        if($this->conn->affected_rows >0)
        {
            $sql2 =  $this->conn->query($query2);
            if($this->conn->affected_rows >0){
                
            }
            echo 'succes';
          
        }
        else {
            echo 'fail';
            
            
        }
    }

function update_store_setting($id,$name,$store_phone,$path_img1,$store_range,$minimum_order){
        $query= "UPDATE store_details SET  store_name ='$name' , current_phone='$store_phone', store_image='$path_img1', store_range= $store_range,minimum_order =$minimum_order  where store_id = $id";
        echo $query;
        $sql =  $this->conn->query($query);       
        if($this->conn->affected_rows >0)
        {
            echo 'succes';
        }
        else {
            echo 'fail';
            
            
        }
}


 /*
    function prepare_Statement(){ 
        $prepare_array =array(':s1'=>$search,':s2'=>$search,':s3'=>$search,':start'=>$start,":length"=>$length);
        $start=0;
        $length=10;
        $search ="k%";
        $stmt = $this->connection -> prepare("select staff_id,address,name,dob from Staff_Master where address like  :s1 or name like :s2 or  dob like  :s3  order by staff_id OFFSET  :start   ROWS FETCH NEXT :length  ROWS ONLY");
      //directly apply the start ,length value is work in below line 
        //$stmt = $this->connection -> prepare("select staff_id,address,name,dob from Staff_Master where address like  :s1 or name like :s2 or  dob like  :s3  order by staff_id OFFSET  $start   ROWS FETCH NEXT $length  ROWS ONLY");
        $stmt->bindValue(':s1',$search);
        $stmt->bindValue(':s2',$search);
        $stmt->bindValue(':s3',$search);
        $stmt->bindValue(':start',$start,PDO::PARAM_INT);
        $stmt->bindValue(':length',$length,PDO::PARAM_INT);
       
        $stmt->execute();
        $stmt;
        $array = array();
        foreach  ($stmt as $row) { 
            array_push($array,array("Staff_id"=>$row['staff_id'],"staff_Name"=>$row['name'],"address"=>$row['address'],"dob"=>$row['dob']));   // store the data in $array
        }
         PRINT_R($array);
    }  */
}
 /*  $db = new DB_CONN();
  $db->execute_query(); */
 
?>