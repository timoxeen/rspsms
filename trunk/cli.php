<?php
if (isset($_SERVER['REMOTE_ADDR'])) {
	die('Command Line Only!');
}

set_time_limit(0);

$arguments = $argv[1];

define(BASEPATH,1);
include "system/application/config/database.php";

$dbcong = $db['default'];
$con = mysql_connect($dbcong['hostname'],$dbcong['username'],$dbcong['password']);
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db($dbcong['database'], $con);
$arguments();
function sentsms()
{
	$sql = "select * from sms_send_sms where status IS NULL limit 10";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs))
	  {
	  	print_r($row);
		if($row['to_numbers']!='')
		{
			$responce = sendViaApi($row['to_numbers'],$row['message']);
			if(!$responce)
			{
				
			}
			else
			{
				$update = "UPDATE `sms_send_sms` SET `responce` = '$responce' , status = 1 ,sentdate = '".date ('Y-m-d H:i:s')."' WHERE id = ".$row['id'];
				mysql_query($update);
			}
		}
		elseif($row['to_list']!='')
		{
			$mobilenos = explode(';',$row['to_list']);
			$mobilenos_final = implode(',',$mobilenos);
			$responce = sendViaApi($mobilenos_final,$row['message']);
			
			if(!$responce)
			{
				
			}
			else
			{
				$update = "UPDATE `sms_send_sms` SET `responce` = '$responce' , status = 1 ,sentdate = '".date ('Y-m-d H:i:s')."' WHERE id = ".$row['id'];
				mysql_query($update);
			}
		}
	  }
}

function deliveryreport()
{
	$sql = "select * from sms_send_sms where status = 1 limit 10";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs))
	  {
	  		$delivery_responce_arra = array();
	  		$responceArray = explode(',',$row['responce']);
	  		$status = array();
	  		foreach($responceArray as $responce)
	  		{
				$responce = deliveryStatus($responce);
				$delivery_responce_arra[] = $responce;
				switch($responce)
				{
					case 'Dlr Status: Delivered' : 
													$status[] = 2;
													break;
					case 'Dlr Status: Error Code : 259' : 
													$status[] = 3;
													break;				
					case 'Dlr Status: DND Number' : 				$status[] = 4;	
													break;
					case 'Dlr Status: Sent' : 					$status[] = 2;	
													break;
					default : $status[] = 3;
								break;
				}
	  		}
	  			$delivery_responce_str = implode(',',$delivery_responce_arra);
	  			$statusString = implode(',',$status);
				$update = "UPDATE `sms_send_sms` SET status = '$statusString' , delivery_res = '$delivery_responce_str' WHERE id = ".$row['id'];
				mysql_query($update);
	  }
	
}
function sendViaApi($mobile,$message)
	{
		$username="ysharath";
		$api_password="c4465qslu1ni25mb6";
		$sender="sendsms";
		$domain="www.justsmsvisa.com";
		$priority="1";// 1-Normal,2-Priority,3-Marketing
		$method="GET";
		//---------------------------------
		if(isset($message) && $message!='')
		{
			$username=urlencode($username);
			$password=urlencode($api_password);
			$sender=urlencode($sender);
			$message=urlencode($message);
			
			$parameters="username=$username&api_password=$api_password&sender=$sender&to=$mobile&message=$message&priority=$priority";
		
			$url="http://$domain/pushsms.php";

			$ch = curl_init($url);
		
			if($method=="POST")
			{
				curl_setopt($ch, CURLOPT_POST,1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
			}
			else
			{
				$get_url=$url."?".$parameters;
		
				curl_setopt($ch, CURLOPT_POST,0);
				curl_setopt($ch, CURLOPT_URL, $get_url);
			}
		
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
			curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
			$return_val = curl_exec($ch);
		
			if($return_val=="")
			return false;
			else
			return $return_val;
		}
		return false;
		
	}


function deliveryStatus($responcemessage)
{
//	http://www.justsmsvisa.com/fetchdlr.php?username=ysharath&msgid=alert_5924721483
		$username="ysharath";
		$api_password="c4465qslu1ni25mb6";
		$sender="sendsms";
		$domain="www.justsmsvisa.com";
		$priority="1";// 1-Normal,2-Priority,3-Marketing
		$method="GET";
		//---------------------------------
		if(isset($responcemessage) && $responcemessage!='')
		{
			$username=urlencode($username);
			$responcemessage=urlencode($responcemessage);
			
			$parameters="username=$username&msgid=$responcemessage";
		
			$url="http://$domain/fetchdlr.php";

			$ch = curl_init($url);
		
			if($method=="POST")
			{
				curl_setopt($ch, CURLOPT_POST,1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
			}
			else
			{
				 $get_url=$url."?".$parameters;
		
				curl_setopt($ch, CURLOPT_POST,0);
				curl_setopt($ch, CURLOPT_URL, $get_url);
			}
		
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
			curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
			$return_val = curl_exec($ch);
		
			if($return_val=="")
			return false;
			else
			return $return_val;
		}
		return false;
}

mysql_close($con);

?>