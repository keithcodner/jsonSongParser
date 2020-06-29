<?php
//error_reporting(0);
include 'sh.php';

//Global Vars
$mySubject = $_POST["mySubject"];
$myTextArea = $_POST["myTextArea"];

$songFileOne = 'Big_Song_Collection_cleaned.json';
$songFileTwo = 'EasySlides_English_cleaned.json';
$songFileThree = 'EasyWorship_BCOG_cleaned.json';

//$songFileToProcess = 'Big_Song_Collection_cleaned.json';
//$songFileToProcess = 'EasySlides_English_cleaned.json';
$songFileToProcess = 'EasyWorship_BCOG_cleaned.json';

$SongFilePath = 'song_list/'.$folder_friendly_date_time.'_'.$songFileToProcess;

mkdir('song_list/'.$folder_friendly_date_time.'_'.$songFileToProcess);
//mkdir('song_list/'.$folder_friendly_date_time."/".$get_product_title);

$songData = json_decode(file_get_contents("data/cleaned/".$songFileToProcess), true);
$songContents = $songData['Songs'];

//print_r($songData);
//echo var_export($songData, true); 

function clean($string) {
   //$string = str_replace(' ', ' ', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

$ic = 0;
$link_list = "";

for ($i = 0, $j = count( $songContents ); $i < $j; $i++) 
{ 

	$songTitle = $songContents[$i]['Text'];
	$songAuthor = $songContents[$i]['Author'];
	$songGUID = $songContents[$i]['Guid'];
	$songCopyright = $songContents[$i]['Copyright'];
	$fullVerses = '';
	$fullVersesText = '';
	$fullStart = '';
	
	//$songVerse = $songContents[$i]['Verses'][0]['Text'];
	$songVerse = $songContents[$i]['Verses'];
	for ($k = 0, $l = count( $songVerse ); $k < $l; $k++) {
		$verseCount = $k + 1;
		$fullVerses = $fullVerses. '<br /> [Verse '.$verseCount.'] <br />'.$songContents[$i]['Verses'][$k]['Text'].'<br /><br />';
		$fullVersesText = $fullVersesText. PHP_EOL. '[Verse '.$verseCount.'] '. PHP_EOL .$songContents[$i]['Verses'][$k]['Text'].PHP_EOL . PHP_EOL ;
	}
	
	//web view
	echo '<b>Title:</b> '.$songTitle.'<br /><br />';
	echo '<b>Author:</b> '.$songAuthor.'<br />';
	echo '<b>SongID:</b> '.$songGUID.'<br />';
	echo '<b>Copyright:</b> '.$songCopyright.'<br /><br />';
	
	//text view
	$fullStart = 'Title: '.$songTitle. PHP_EOL .
	 'Author: '.$songAuthor. PHP_EOL .
	 'SongID: '.$songGUID. PHP_EOL .
	 'Copyright: '.$songCopyright. PHP_EOL .
	 $fullVersesText. PHP_EOL ;
	
	echo $fullVerses. PHP_EOL ;
	
	
	echo '--------------------------------------------------------------------<br />';
	
	//Create files in directory
	$myfile = fopen($SongFilePath.'/'.clean($songTitle).'.txt', "w") or die("Unable to open file!");
	fwrite($myfile, $fullStart);
	fclose($myfile);
}


?>

