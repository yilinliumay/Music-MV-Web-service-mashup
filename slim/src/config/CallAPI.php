<?php

Class CallAPI{

   function CallLastAPI($url){
		   $curl=curl_init();
		   curl_setopt($curl, CURLOPT_URL,$url);
		   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($curl, CURLOPT_HEADER, 0);
           curl_setopt($curl,CURLOPT_TIMEOUT,10); 
		   $dataset=curl_exec($curl);
		   $errorCode = curl_errno($curl);
		   curl_close($curl);
		   if(0 !== $errorCode) {
                return false;
           }
		   else{
            return $dataset;
		   }
	}
	function parseData($dataset){
	$myArray = array();
	$php_content = json_decode($dataset);
	
	 foreach($php_content->toptracks->track as $track) { 
	     $track_name=$track->name;
		 $track_playcount=$track->playcount;
		 $track_artist=$track->artist->name;
		 $track_image=$track->image[0];
		 $myArray[]=array("name"=>$track_name,"playcount"=>$track_playcount,"artist"=>$track_artist,"image"=>$track_image);
		 
		 //$this->InsertDatabase($track_artist,$track_name,$track_playcount,$track_image);
		}
		
		return $myArray;
	 
	}
	
	
	function YouTubeAPI($keyword){
	$youArray = array();
	//$keyword=$this->GetDatabase();
	$count = count($keyword);
	
	for($i=0;$i<$count;$i++){
	  $artist=$keyword[$i]['artist'];
	  //$artist1 = preg_replace('/[^A-Za-z0-9\( )]/', '', $artist);
	  $name=$keyword[$i]['name'];
	  //$name1 = preg_replace('/[^A-Za-z0-9]/', '', $name);
	  $q=$artist."+".$name;
	  $q = preg_replace('/\s+/', '', $q);
	  $youUrl="https://www.googleapis.com/youtube/v3/search?part=snippet&q=".$q."&type=video&videoCaption=closedCaption&key=AIzaSyD4FIBlVti0z-1fpkrXWnf4jzQbsX02vpU";
      $data=$this->CallLastAPI($youUrl);
	  //print_r($data);
	  $php_content = json_decode($data);
	  if($php_content->pageInfo->totalResults!='0'){
		 // $ID=$php_content->items[0]->id;
	  $ID=$php_content->items[0]->id->videoId;
	  $youArray[]=array("artist"=>$artist,"name"=>$name,"ID"=>$ID);
	  }
	 }
	 $jsondata=json_encode($youArray);
	 return $jsondata;
	 
	}
	
	function parseDataUser($dataset){
	$myArray = array();
	$php_content = json_decode($dataset);
	
	 foreach($php_content->recenttracks->track as $track) { 
	     $track_name=$track->name;
		 $track_artist=$track->artist->{'#text'};
		
		 $myArray[]=array("name"=>$track_name,"artist"=>$track_artist);
		 
		 //$this->InsertDatabase($track_artist,$track_name,$track_playcount,$track_image);
		}
		
		return $myArray;
	 
	}
	function parseDataAlbum($dataset){
	$myArray = array();
	$php_content = json_decode($dataset);
	$album=$php_content->topalbums->album[0]->name;
	$artist=$php_content->topalbums->album[0]->artist->name;
	$urla= "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=5d7f95c768d842be902ada4e187c5088&artist=".$artist."&album=".$album."&format=json";
    $data=$this->CallLastAPI($urla);
	$content = json_decode($data);
	  foreach($content->album->tracks->track as $track) { 
	     $track_name=$track->name;
		 $track_artist=$track->artist->name;
		 $myArray[]=array("album"=>$album,"name"=>$track_name,"artist"=>$track_artist);
		 
		 //$this->InsertDatabase($track_artist,$track_name,$track_playcount,$track_image);
		}
		
		return $myArray;
	 
	}
	function parseDataSimilar($dataset){
	$myArray = array();
	$php_content = json_decode($dataset);
	foreach($php_content->similarartists->artist as $artist) { 
	     $artist_name=$artist->name;
		 $urla="http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&artist=".$artist_name."&api_key=5d7f95c768d842be902ada4e187c5088&page=1&limit=2&format=json";
		 $data=$this->CallLastAPI($urla);
		 $tracks=$this->parseData($data);
		 $tracks_name1=$tracks[0]['name'];
		 $tracks_name2=$tracks[1]['name'];
		 $myArray[]=array("artist"=>$artist_name,"name"=>$tracks_name1);
		 $myArray[]=array("artist"=>$artist_name,"name"=>$tracks_name2);
		}
		
		return $myArray;
	}

	
	
	
	
	
}

?>