<?php 
        
        
    $title="test";
    $message="everone";
        
        
        define( 'API_ACCESS_KEY', 'AAAAPYcLpY0:APA91bEDbf_sUxUFvDH0Yerf_eoF5p2bqH-ZkkoPYuGka0vrkHlB-_HWcrElnDQJTgNoY2e7LCj7owqvrjVkIM4T_c7GkFsqFaNW9xKnb4K0PKU7hqJ2nL4P2bSg3GcAgRUK_ok_M24X');
$msg = array
(
    'body'   =>$message,
    'title'     => $title,
    'key1'  => 'val1'
);
$fields = array
(
    'to'            => "focHjC7DRZqFNJsDOWxJ3D:APA91bHj1aaLIqMRdoc0HCZIzkZKvEWCE4I-T58zboIAwcUcdKYc0Ctdmmf_g56wTvnDNsccaWSwAuDrCYAFt_X-yltMY3Fz0qxfAvdCw4_elK_r3hTLmh4J84ykIy2VIGGfd3Anqd8g",
    'notification'          => $msg


);

$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;


   
?>  