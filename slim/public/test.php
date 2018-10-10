<?php
//$file_contents = file_get_content('http://localhost/operate.php?act=get_user_list&type=json') 
$url="https://www.googleapis.com/youtube/v3/search?part=snippet&q=adele&type=video&videoCaption=closedCaption&key=AIzaSyD4FIBlVti0z-1fpkrXWnf4jzQbsX02vpU";
  $curl=curl_init();
  curl_setopt($curl, CURLOPT_URL,$url);
  //curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          // curl_setopt($curl, CURLOPT_HEADER, 0);
           //curl_setopt($curl,CURLOPT_TIMEOUT,10); 
		   $dataset=curl_exec($curl);
		   $errorCode = curl_errno($curl);
		   echo $errorCode;
		   curl_close($curl);
		   if(0 !== $errorCode) {
			   echo false;
                return false;
           }
		   else{
            return $dataset;
		   }
   
   
  
   
	   
?>