<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class ItemModel extends CI_Model 
{
   /*View*/
	function showAll()
	{
	$query=$this->db->query("select * from items");
	return $query->result();
	}
	
} 