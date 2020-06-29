<?php

$percentage_show = 0;
$current_process = "";

/*DATE AND TIME*/
$a_time = date("y-m-d", time());  
$b_time = date("G:i:s", time());   
$c_time = date("G-i-s", time()); //folder friendly time
$timeDate = $a_time." ".$b_time; 
$dateOnly = $a_time;
$timeOnly = $b_time;
$folder_friendly_date_time = $a_time.'_'.$c_time; 


$jql_start_date = '2017-01-01';
$jql_end_date = '2017-11-01';


function fQuery($query){
//get the show ID to connect the show and the episodes
  $link = mysql_connect("localhost","root","root");
  if (!$link) {
	  echo 'Could not connect: ' . mysql_error();
  }
  if (!mysql_select_db('yes_reports')) {
	  echo 'Could not select database: ' . mysql_error();
  }
  $result = mysql_query($query);
  if (!$result) {
	  echo 'Could not query:' . mysql_error();
  }
  //echo mysql_result($result, 0); // outputs third employee's name
  $theResult = mysql_result($result, 0);

  mysql_close($link); 

return $theResult;
}

function eQuery($query){
//get the show ID to connect the show and the episodes
  $link = mysql_connect("localhost","root","root");
  if (!$link) {
	  die('Could not connect: ' . mysql_error());
  }
  if (!mysql_select_db('yes_reports')) {
	  die('Could not select database: ' . mysql_error());
  }
  $result = mysql_query($query);
  if (!$result) {
	  die('Could not query:' . mysql_error());
  }
  //echo mysql_result($result, 0); // outputs third employee's name
 // $getShowID = mysql_result($result, 0);

  mysql_close($link); 

//return $getShowID;
}

function rQuery($query){
   //get the show ID to connect the show and the episodes
  $link = mysql_connect("localhost","root","root");
  if (!$link) {
	  die('Could not connect: ' . mysql_error());
  }
  if (!mysql_select_db('yes_reports')) {
	  die('Could not select database: ' . mysql_error());
  }
  $result = mysql_query($query);
  if (!$result) {
	  die('Could not query:' . mysql_error());
  }
  mysql_close($link); 

return $result;
}
  

//----------------BITYLE API CALL----------------------
/*
function shortenU($url){
	$login = 'o_6tvhnjr0u0';
	$api_key = 'R_ac811b4262e94d4292a420814d1e27bc';
	$ch = curl_init('http://api.bitly.com/v3/shorten?login='.$login.'&apiKey='.$api_key.'&longUrl='.$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$res = json_decode($result, true);
	echo $res['data']['url'];
	
}

//Helper Functions
function hopToNext($hopLink, $xPath)
{
	$ch  = curl_init($hopLink);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	$ws = curl_exec($ch);

	$dom = new DOMDocument();
	@$dom->loadHTML($ws);

	$xpath = new DOMXPath($dom);
	$values = $xpath->query($xPath);
	return $values->item(0)->nodeValue;
}

//instead of returning one string, return the array
function hopToNextAll($hopLink, $xPath)
{
	$ch  = curl_init($hopLink);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	$ws = curl_exec($ch);

	$dom = new DOMDocument();
	@$dom->loadHTML($ws);

	$xpath = new DOMXPath($dom);
	$values = $xpath->query($xPath);
	return $values;
}


  
  

function jql_data_bit($start, $max, $client ){
	global $jql_start_date;
	global $jql_end_date;

	//$username = base64_decode('a2VpdGguY29kbmVy'); 
	//$password = base64_decode('M01lZ2FtYW4=');
	
	$username = ''; 
	$password = '';

	$url = 'http://jira:8080/rest/api/2/search?jql=created%20%3E%3D%20'.$jql_start_date.'%20AND%20created%20%3C%3D%20'.$jql_end_date.'%20AND%20project%20in%20(CAMIS%2C%20HCA%2C%20DS)%20AND%20type%20in%20(%22camis%20software%22%2C%20hardware%2C%20network%2C%20maintenance)%20AND%20(participants%20in%20membersof(%22help%20desk%22)%20OR%20participants%20in%20(hovhannes.zoubrigian%2C%20nick.balbiani%2C%20ethan.reno%2C%20aaron.atkinson%2C%20joel.bryant%2C%20serge.fabre%2C%20chris.smith%2C%20tom.oldershaw%2C%20fitsum.mengesha))%20AND%20(%22System%20Environment%22%20!%3D%20build%20OR%20%22System%20Environment%22%20is%20EMPTY)%20AND%20client%20%3D%20'.$client.'%20and%20level%20is%20EMPTY&startAt='.$start.'&maxResults='.$max.'&fields="assignee,status,resolution,updated,components,creator,reporter,issuetype,project,customfield_11410,customfield_11412,resolutiondate,created,priority"';
	
	$ch = curl_init();
	$headers = array(
	"X-Atlassian-Token: no-check",
	'Content-Type: application/json'
	);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	$issue_list = (curl_exec($curl));

	return $issue_list;

}

function get_total($client){
	$jql_json = jql_data_bit("0", "1", $client);
	$jql_array = json_decode( $jql_json, true );
	$jql_get_total = $jql_array['total'];
	
	return $jql_get_total;
}

function jql_data_all($client){

	$start = 0;
	$increment = 1000;
	$total_data = "";

	$jql_get_total= get_total($client);

	//if($jql_get_total > $increment){
	
		for($i = 0, $j = $jql_get_total; $i <= $j; $i++){
		
			if($i == 0){
				$jql_json = jql_data_bit("0", "1", $client);
				$all_data = json_decode( $jql_json, true );
				$total_data = $all_data['issues'];
				
				usleep(100);
			}
			else if($i > 1){
				$jql_json = jql_data_bit($i, "1", $client);
				$all_data = json_decode( $jql_json, true );
				array_merge($total_data, $all_data['issues']);
				
				usleep(100);
			}
		}
		
	// } else if($jql_get_total <= $increment){

		// $jql_json = jql_data_bit($start, $increment, $client);
		
		// $all_data = json_decode( $jql_json, true );
		// $total_data = $all_data['issues'];
	// }

	//returns array
	return $total_data;
}

function jql_data_import($client, $recreate = 0){
	
	global $percentage_show;
	$percentage_show = 0;

	 $array_data = jql_data_all($client);
	 
	 $main_table_temp = "CREATE TABLE `jira_".$client."`( `tckt_id` INT(11) NOT NULL AUTO_INCREMENT, `tckt_proj` VARCHAR(25) NULL DEFAULT '0', `tckt_num` VARCHAR(25) NULL DEFAULT '0', `tckt_issue_type` VARCHAR(25) NULL DEFAULT '0', `tckt_components` VARCHAR(1000) NULL DEFAULT '0', `tckt_client` VARCHAR(10) NULL DEFAULT '0', `tckt_client_contact` VARCHAR(2000) NULL DEFAULT '0', `tckt_status` VARCHAR(20) NULL DEFAULT '0', `tckt_creator` VARCHAR(60) NULL DEFAULT '0', `tckt_reporter` VARCHAR(60) NULL DEFAULT '0', `tckt_created` DATETIME NULL DEFAULT '0000-00-00 00:00:00', `tckt_updated` DATETIME NULL DEFAULT '0000-00-00 00:00:00', `tckt_resolved` DATETIME NULL DEFAULT '0000-00-00 00:00:00', PRIMARY KEY (`tckt_id`)) COLLATE='latin1_swedish_ci' ENGINE=InnoDB ROW_FORMAT=COMPACT ; ";
	 
	 $foreign_table_temp = "CREATE TABLE `jira_comp_".$client."`( `tpc_proj_id` INT(11) NOT NULL AUTO_INCREMENT, `tpc_proj_tpc` VARCHAR(50) NULL DEFAULT NULL, `tpc_client` VARCHAR(10) NULL DEFAULT '0', `tpc_client_contact` VARCHAR(255) NULL DEFAULT '0',`tpc_component` VARCHAR(5000) NULL DEFAULT NULL, PRIMARY KEY (`tpc_proj_id`)) COLLATE='latin1_swedish_ci' ENGINE=InnoDB ROW_FORMAT=COMPACT ; ";
	 
	 $test = fQuery("SELECT count(*) FROM jira_".$client.""); // see if client exists by getting specfic string
	 
	 
	 if (strlen($test) < 1) {
		//create the table because it does not exist
		eQuery($main_table_temp); // create main table
		eQuery($foreign_table_temp); // create create foreign table
	}else{
		//truncate table because it exists
		 eQuery('TRUNCATE TABLE jira_'.$client.''); 
		 eQuery('TRUNCATE TABLE jira_comp_'.$client.''); 
		 
	}
	
	if($recreate == 1){
	
		//drop table
		 eQuery('DROP TABLE IF EXISTS jira_'.$client.''); 
		 eQuery('DROP TABLE IF EXISTS jira_comp_'.$client.''); 
	
		//create the table because it does not exist
		eQuery($main_table_temp); // create main table
		eQuery($foreign_table_temp); // create create foreign table
	}
	
	 
	 for($i = 0, $j = count($array_data); $i <= $j; $i++ ){
	 
		
			$tckt_proj = $array_data[$i]['fields']['project']['key']; 
			$tckt_num = $array_data[$i]['key']; 
			$tckt_issue_type = $array_data[$i]['fields']['issuetype']['name']; 
			$tckt_components = $array_data[$i]['fields']['components'][0]['name']; 
			$tckt_client_contact = $array_data[$i]['fields']['customfield_11412']['child']['value'];
			$tckt_status = $array_data[$i]['fields']['status']['name']; 
			$tckt_creator = $array_data[$i]['fields']['creator']['name']; 
			$tckt_reporter = $array_data[$i]['fields']['reporter']['name']; 
			$tckt_created = $array_data[$i]['fields']['created']; 
			$tckt_updated = $array_data[$i]['fields']['updated']; 
			$tckt_resolved = $array_data[$i]['fields']['resolutiondate']; 
			$tckt_client = $array_data[$i]['fields']['customfield_11412']['value'];
			
			$tpc_proj_tpc = $tckt_num;
			$tpc_client = $array_data[$i]['fields']['customfield_11412']['value'];
			$tpc_client_contact = $tckt_client_contact;
			$tpc_component = $tckt_components;
			
			eQuery('INSERT INTO jira_'.$client.'(tckt_proj, tckt_num, tckt_issue_type, tckt_components, tckt_client_contact, tckt_status, tckt_creator, tckt_reporter, tckt_created, tckt_updated, tckt_resolved, tckt_client) VALUES("'.$tckt_proj.'", "'.$tckt_num.'", "'.$tckt_issue_type.'", "'.$tckt_components.'", "'.$tckt_client_contact.'", "'.$tckt_status.'", "'.$tckt_creator.'", "'.$tckt_reporter.'", "'.$tckt_created.'", "'.$tckt_updated.'", "'.$tckt_resolved.'", "'.$tckt_client.'");');
			
			if(strpos($tckt_components, ',') !== false){
			
				$tckt_components_arr  = explode(",", $tckt_components);
			
				for($k = 0, $l = count($tckt_components_arr); $k <= $l; $k++ ){
					
					$tpc_component_split = $tckt_components_arr[$k];
				
					eQuery('INSERT INTO jira_comp_'.$client.'(tpc_proj_tpc, tpc_client, tpc_client_contact, tpc_component) VALUES("'.$tpc_proj_tpc.'", "'.$tpc_client.'", "'.$tpc_client_contact.'", "'.$tpc_component_split.'");');
				}
				
			}else{
				eQuery('INSERT INTO jira_comp_'.$client.'(tpc_proj_tpc, tpc_client, tpc_client_contact, tpc_component) VALUES("'.$tpc_proj_tpc.'", "'.$tpc_client.'", "'.$tpc_client_contact.'", "'.$tpc_component.'");');
			}
		
	}
	
	$percentage_show = 100;
}

function client_calc($client){
	
}
*/


?>