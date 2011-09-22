<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CONFIGURATION ARRAY FOR THE FreakAuth_light library
 *
 * @package     Sms India
 * @subpackage  Config
 * @category    Authentication
 * @author      rampelli pradeep kumar
 * @copyright   Copyright (c) 2011, sendsms2india.com
 * @version     1.0
 */

$config['SMS_table_prefix'] = 'sms_';

// SMS SEND
$config['SMS_mobileno_field_validation_smssend'] = 'trim|required|xss_clean';
$config['SMS_message_field_validation_smssend'] = 'trim|required|xss_clean';
$config['SMS_fullname_field_validation_smssend'] = 'trim|xss_clean';
$config['SMS_template_dir'] = 'FreakAuth_light/';
$config['SMS_send_view'] = $config['SMS_template_dir'].'template/sms/send';
$config['SMS_sent_list_view'] = $config['SMS_template_dir'].'template/sms/sent';
$config['SMS_contacts_list_view'] = $config['SMS_template_dir'].'template/contacts/list';
$config['SMS_contacts_form_view'] = $config['SMS_template_dir'].'template/contacts/form';
$config['SMS_contacts_menu_view'] = $config['SMS_template_dir'].'content/topmenu';
$config['SMS_fb_logout_uri'] = 'auth/fblogout';


?>