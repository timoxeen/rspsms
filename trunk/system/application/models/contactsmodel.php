<?php
class contactsmodel extends Model 
{
	function contactsmodel()
	{
		 parent::Model();
        
        //FreakAuth_light table prefix
        $this->_prefix = $this->config->item('SMS_table_prefix');
        $this->_table=$this->_prefix.'contacts';
	}
	
	function getListById($uid)
	{
		$this->db->select('* , DATE_FORMAT(createdon,\'%W,%M %D,%Y\') as ondate, DATE_FORMAT(createdon,\'%h:%i %p\') AS attime',FALSE);
		$this->db->where('user_id', $uid);
		$this->db->order_by("name", "asc"); 
		$this->db->from($this->_table);
		$result = $this->db->get();
		return $result->result();
	}
	
	function getListByIds($ids)
	{
		$this->db->select('* ');
		$this->db->where_in('id', $ids);
		$this->db->order_by("name", "asc"); 
		$this->db->from($this->_table);
		$result = $this->db->get();
		return $result->result();
	}
	function insert($data) 
	{
		 $this->db->insert($this->_table, $data);
	}
}