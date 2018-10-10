<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//get all customers
$app->get('/gettoptracksyoutube/{artist}',function(Request $request, Response $response){
	       $artist=$request->getAttribute('artist');
		   $url1="http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&artist=".$artist."&api_key=5d7f95c768d842be902ada4e187c5088&page=1&limit=10&format=json";
		   $callAPI=new CallAPI();
		   $data=$callAPI->CallLastAPI($url1);
		   $youkeyword=$callAPI->parseData($data);
		   $youdata=$callAPI->YouTubeAPI($youkeyword);
		   
		   echo $youdata;
		   
      });
$app->get('/gettoptrackslist/{artist}',function(Request $request, Response $response){
	       $artist=$request->getAttribute('artist');
		   $url1="http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&artist=".$artist."&api_key=5d7f95c768d842be902ada4e187c5088&page=1&limit=10&format=json";
		   $callAPI=new CallAPI();
		   $data=$callAPI->CallLastAPI($url1);
		   $youkeyword=$callAPI->parseData($data);
		   $jsondata=json_encode($youkeyword);
		   
		   echo $jsondata;
		   
      });
$app->get('/similarArtistTracksyoutube/{artist}',function(Request $request, Response $response){
	       $artist=$request->getAttribute('artist');
		   $url1="http://ws.audioscrobbler.com/2.0/?method=artist.getsimilar&artist=".$artist."&api_key=5d7f95c768d842be902ada4e187c5088&page=1&limit=10&format=json&limit=5";
		   $callAPI=new CallAPI();
		   $data=$callAPI->CallLastAPI($url1);
		   $youkeyword=$callAPI->parseDataSimilar($data);
		   $youdata=$callAPI->YouTubeAPI($youkeyword);
		   
		   echo $youdata;
		   
      });	
$app->get('/similarArtistTrackslist/{artist}',function(Request $request, Response $response){
	       $artist=$request->getAttribute('artist');
		   $url1="http://ws.audioscrobbler.com/2.0/?method=artist.getsimilar&artist=".$artist."&api_key=5d7f95c768d842be902ada4e187c5088&page=1&limit=10&format=json&limit=5";
		   $callAPI=new CallAPI();
		   $data=$callAPI->CallLastAPI($url1);
		   $youkeyword=$callAPI->parseDataSimilar($data);
		   $jsondata=json_encode($youkeyword);
		   
		   echo $jsondata;
		   
      });
$app->get('/topAlbumSongsyoutube/{artist}',function(Request $request, Response $response){
	       $artist=$request->getAttribute('artist');
		   $url1="http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=".$artist."&api_key=5d7f95c768d842be902ada4e187c5088&page=1&limit=1&format=json&limit=5&page=1";
		   $callAPI=new CallAPI();
		   $data=$callAPI->CallLastAPI($url1);
		   $youkeyword=$callAPI->parseDataAlbum($data);
		   $youdata=$callAPI->YouTubeAPI($youkeyword);
		   
		   echo $youdata;
		   
      });
$app->get('/topAlbumSongslist/{artist}',function(Request $request, Response $response){
	       $artist=$request->getAttribute('artist');
		   $url1="http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist=".$artist."&api_key=5d7f95c768d842be902ada4e187c5088&page=1&limit=1&format=json&limit=5&page=1";
		   $callAPI=new CallAPI();
		   $data=$callAPI->CallLastAPI($url1);
		   $youkeyword=$callAPI->parseDataAlbum($data);
		   $jsondata=json_encode($youkeyword);
		   echo $jsondata;
		   
      });	  
$app->get('/userRecentTracksyoutube/{username}',function(Request $request, Response $response){
	       $username=$request->getAttribute('username');
		   $url1="http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=".$username."&api_key=5d7f95c768d842be902ada4e187c5088&page=1&limit=10&format=json&limit=10";
		   $callAPI=new CallAPI();
		   $data=$callAPI->CallLastAPI($url1);
		   $youkeyword=$callAPI->parseDataUser($data);
		   $youdata=$callAPI->YouTubeAPI($youkeyword);
		   
		   echo $youdata;
		   
      });
$app->get('/userRecentTrackslist/{username}',function(Request $request, Response $response){
	       $username=$request->getAttribute('username');
		   $url1="http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=".$username."&api_key=5d7f95c768d842be902ada4e187c5088&page=1&limit=10&format=json&limit=10";
		   $callAPI=new CallAPI();
		   $data=$callAPI->CallLastAPI($url1);
		   $youkeyword=$callAPI->parseDataUser($data);
		   $jsondata=json_encode($youkeyword);
		   
		   echo $jsondata;
		   
      });


	  

?>