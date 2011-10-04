<?php
if (!defined('BASEPATH')) exit ('No direct script access allowed');
/*
 * Created on Sep 30, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

include "GmailContacts/GmailConnect.php";
include "GmailContacts/Contacts.php";
function getGoogleConnectLink($consumer_key, $consumer_secret, $callback) {
	$argarray = array ();
	$oauth = new GmailOath($consumer_key, $consumer_secret, $argarray, FALSE, $callback);
	$getcontact = new GmailGetContacts();
	$access_token = $getcontact->get_request_token($oauth, false, true, true);
	$_SESSION['oauth_token'] = $access_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
	return $link = '<a href="https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=' . $oauth->rfc3986_decode($access_token["oauth_token"]) . '"> connect </a>';
}

function getContacts($tokens, $consumer_key, $consumer_secret, $callback) {
	$emails_count = 500;
	$argarray = array ();
	$oauth = new GmailOath($consumer_key, $consumer_secret, $argarray, false, $callback);
	$getcontact_access = new GmailGetContacts();

	$request_token = $oauth->rfc3986_decode($tokens['oauth_token']);
	$request_token_secret = $oauth->rfc3986_decode($_SESSION['oauth_token_secret']);
	$oauth_verifier = $oauth->rfc3986_decode($tokens['oauth_verifier']);

	$contact_access = $getcontact_access->get_access_token($oauth, $request_token, $request_token_secret, $oauth_verifier, false, true, true);
	$access_token = $oauth->rfc3986_decode($contact_access['oauth_token']);
	$access_token_secret = $oauth->rfc3986_decode($contact_access['oauth_token_secret']);
	$contacts = $getcontact_access->GetContacts($oauth, $access_token, $access_token_secret, false, true, $emails_count);
	$gContacts = array ();

	foreach ($contacts as $k => $a) {
		$name = '';
		if (isset ($a['title'])) {
			$name = (isset ($a['title']['$t']) ? $a['title']['$t'] : '');

		}
		$mobileno = '0';

		if (isset ($a['gd$phoneNumber'])) {
			if (is_array($a['gd$phoneNumber'])) {
				foreach ($a['gd$phoneNumber'] as $mobDetails) {
					if (isset ($mobDetails['primary'])) {
						$mobileno = $mobDetails['$t'];
						break;
					} else {
						$mobileno = $mobDetails['$t'];
					}
				}
			}
			//$mobileno = (isset($a['gd$phoneNumber']['$t']) ? $a['gd$phoneNumber']['$t'] : '');
		} else {
			$mobileno = 0;
		}

		$gContacts[] = array (
			'name' => $name,
			'mobile' => $mobileno
		);
		/*foreach($final as $email)
		{
			print_r($email);
			if(isset($email["address"]))
			echo $email["address"] ."<br />";
		}*/
	}

	return $gContacts;
}
?>
