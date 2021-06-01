
<?php
include 'Db_Conn_prepare.php';
$db = new DB_CONN();
 //variable
 $path_img1='';
 $path_img2='';
 $path_img3='';

   $img1 = $_FILES['img1']['name'];
   $img2 = $_FILES['img2']['name'];
   $img3 = $_FILES['img3']['name'];
  
$id=$_POST['id'];

$name=$_POST['name'];

$price=$_POST['price'];
//echo $id;
$target_dir = "img//";  
if (($img1!="")){
// Where the file is going to be stored
 
 $img1_name = $_FILES['img1']['name'];
 
 

 $img1path = pathinfo($img1);
 $img1ext = $img1path['extension'];
 
 
    $path_img1= compress($_FILES['img1']['tmp_name'], $target_dir.$id.time()."img1.".$img1ext, quality($_FILES['img1']['size']),0);
    if($path_img1==0){ // process fail  
        
    }
    
   
   
} 
if (($img2!="")){
    $img2_name = $_FILES['img2']['name'];
    $img2path = pathinfo($img2);
    $img2ext = $img2path['extension'];
    $path_img2= compress($_FILES['img2']['tmp_name'], $target_dir.$id.time()."img2.".$img2ext, quality($_FILES['img2']['size']),0);
    if($path_img2==0){ // process fail  
    }
}
if (($img3!="")){
    $img3_name = $_FILES['img3']['name'];
    
 $img3path = pathinfo($img3);
 $img3ext = $img3path['extension'];
 $path_img3= compress($_FILES['img3']['tmp_name'], $target_dir.$id.time()."img3.".$img1ext, quality($_FILES['img3']['size']),0);
 if($path_img3==0){ // process fail  
    
 }
}

if($_POST['type']=='add'){
   $db->prod_details($id,$name,$price,$path_img1,$path_img2,$path_img3);
}elseif($_POST['type']=='update'){

    $db->prod_update_details($id,$_POST['product_id'],$name,$price,$path_img1,$path_img2,$path_img3);
}

function quality($file_size){
    if($file_size >5000000){
        $quality=10;       
    }else  $quality=20;
    if($file_size <1000000){
        $quality=40;
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