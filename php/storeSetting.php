
<?php
include 'Db_Conn_prepare.php';
$db = new DB_CONN();
 //variable
 $path_img1='';
 

   $img1 = $_FILES['img1']['name']; 
  
$id=$_POST['id'];

$name=$_POST['name'];

$store_phone=$_POST['phone'];

$store_range=$_POST['range'];

$minimum_order=$_POST['minimum_order'];

//echo $id;
$target_dir = "img//";  
if (($img1!="")){
// Where the file is going to be stored
 
 $img1_name = $_FILES['img1']['name'];
 
 

 $img1path = pathinfo($img1);
 $img1ext = $img1path['extension'];
 
 
    $path_img1= compress($_FILES['img1']['tmp_name'], $target_dir.$id.time()."img1.".$img1ext, quality($_FILES['img1']['size']),0);
    if($path_img1==0){ // process fail  
        
    }else{
      
    }
    //process db data 
    $db->update_store_setting($id,$name,$store_phone,$path_img1,$store_range,$minimum_order); 
   
} 
 
 
 

function quality($file_size){
    if($file_size >5000000){
        $quality=10;       
    }else  $quality=20;
    if($file_size <1000000){
        $quality=60;
    }
    return $quality;
}
function compress($source, $destination, $quality,$degree) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);


    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromjpg($source);

        elseif ($info['mime'] == 'image/jpg') 
        $image = imagecreatefromgif($source);


    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

        else  return 0;
 
/* echo "**source".$source;

echo "**destin".$destination;

echo "**img".$image; */
$rotate = imagerotate($image,$degree,0);
 
    imagejpeg($rotate, $destination, $quality);
     
  //  echo "<img src="$image."alt="Italian Trulli>";
    return $destination;
}
?>