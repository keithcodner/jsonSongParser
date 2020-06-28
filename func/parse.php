<?php
error_reporting(0);
include 'sh.php';

//Global Vars
$mySubject = $_POST["mySubject"];
$myTextArea = $_POST["myTextArea"];

mkdir('song_list/'.$folder_friendly_date_time);
mkdir('song_list/'.$folder_friendly_date_time."/".$get_product_title);

//loop through and save each image link
$obj = hopToNextAll($getLink, '//*[@id="ProductThumbs"]/*/a/@href');
$ic = 0;
$link_list = "";

for ($i = 0, $j = count( $imageListSplitted ); $i < $j; $i++) 
{ 

	$my_save_dir = $folder_friendly_date_time."/".$get_product_title;
    $filename = basename($clean_link);
    $complete_save_loc = $my_save_dir.'/'.$filename;
	
	$fp = fopen($complete_save_loc,'wb');
	
	fclose($fp);
	$ic++;
	
	
	usleep(1000);
}

echo 
$getLink.'<br />'
.'<br />'.$get_product_title 
.'<br />'.'Get your '.$get_last_word.' Here!'
.'<br />';

$bitlink = shortenU($getLink);
//echo 'http://bit.ly/2J4WsL3'; //uncomment to test

echo '<br /><br />'.$hashtags.'<br /><br /><br />';
//.'<br />'.$link_list;

?>


?>