<?php
class smsregistermodel extends Model 
{
	function smsregistermodel()
	{
		 parent::Model();
        
        //FreakAuth_light table prefix
        $this->_prefix = $this->config->item('SMS_table_prefix');
        $this->_table=$this->_prefix.'register';
	}
	
	function getSmsListById($uid)
	{
		$this->db->select('* , DATE_FORMAT(createddate,\'%W,%M %D,%Y\') as ondate, DATE_FORMAT(createddate,\'%h:%i %p\') AS attime',FALSE);
		$this->db->where('user_id', $uid);
		$this->db->order_by("createddate", "desc"); 
		$this->db->from($this->_table);
		$result = $this->db->get();
		return $result->result();
	}
	
	function insert($data) 
	{
		 $this->db->insert($this->_table, $data);
	}
}