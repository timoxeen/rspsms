<?php
class smsmodel extends Model 
{
	private $_table;
	private $_table2;
	function smsmodel()
	{
		 parent::Model();
        
        //FreakAuth_light table prefix
        $this->_prefix = $this->config->item('SMS_table_prefix');
        $this->_table=$this->_prefix.'send_sms';
        $this->_table2=$this->_prefix.'contacts';
	}
	
	function getSmsListById($uid)
	{
		$this->db->select('* , DATE_FORMAT('.$this->_table.'.createddate,\'%W,%M %D,%Y\') as ondate, DATE_FORMAT('.$this->_table.'.createddate,\'%h:%i %p\') AS attime',FALSE);
		$this->db->where($this->_table.'.user_id', $uid);
		$this->db->order_by("$this->_table.createddate", "desc"); 
		$this->db->from($this->_table);
		$this->db->join($this->_table2, $this->_table2.'.user_id = '.$this->_table.'.user_id AND '.$this->_table2.'.mobileno = '.$this->_table.'.to_numbers','left');
		$result = $this->db->get();
		return $result->result();
	}
	
	function insert($data) 
	{
		 $this->db->insert($this->_table, $data);
	}
}