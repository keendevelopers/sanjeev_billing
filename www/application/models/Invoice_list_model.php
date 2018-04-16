<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice_list_model extends CI_Model {
	var $table = 'invoice';
	var $column_order = array(null,'inv_date','inv_id','cust_name','Tax_1','total'); //set column field database for datatable orderable
	var $column_search = array('inv_date','inv_id','cust_name','invoice.Tax_1','total'); //set column field database for datatable searchable
	var $order = array('inv_id' => 'desc'); // default order
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{	
	$this->db->select('invoice.*');
		/*$this->db->join('vehicle_info','vehicle_info.v_id = invoice.ref_v_id','left');
		$this->db->join('stock_vehicles','stock_vehicles.sv_id = invoice.ref_sv_id','left');*/
		$this->db->from($this->table);
		
		if(isset($_POST['inv_id']) && !$_POST['inv_id'] == ''){
			$this->db->where('inv_id',$_POST['inv_id']);
		}

		if(isset($_POST['start_date']) && !$_POST['start_date'] == ''){
			$this->db->where('inv_date >= ',$_POST['start_date']);
		}

		if(isset($_POST['end_date']) && !$_POST['end_date'] == ''){
			$this->db->where('inv_date <= ',$_POST['end_date']);
		}

		if(isset($_POST['tax_name']) && !$_POST['tax_name'] == ''){
			$where = '';
			foreach ($_POST['tax_name'] as $key => $value) {
				$where .= "OR Tax_1='".$value."' ";
			}

			foreach ($_POST['tax_name'] as $key => $value) {
				$where .= "OR Tax_2='".$value."' ";
			}

			$this->db->where('('.substr("$where",3,-1).')');
		}

		/*if(isset($_POST['v_id']) && !$_POST['v_id'] == ''){
			$where = '';
			foreach ($_POST['v_id'] as $key => $value) {
				$where .= "OR invoice.ref_v_id='".$value."' ";
			}
			$this->db->where('('.substr("$where",3,-1).')');
		}*/

		if(isset($_POST['cust_name']) && !$_POST['cust_name'] == ''){
			$custname = $_POST["cust_name"];
			$this->db->where("cust_name LIKE '%$custname%'");
			
		}

		$this->db->where('invoice.is_cancled','0');
		$this->db->where('invoice.is_deleted','0');
		$this->db->where('invoice.UserId',$_SESSION['admin_id']);

		$i = 0;
		foreach ($this->column_search as $item) // loop column
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		/*print_r($this->db->last_query());*/
		return $query->result();

	}
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function count_all()
	{
		$this->db->from($this->table);
		
		if(isset($_POST['inv_id']) && !$_POST['inv_id'] == ''){
			$this->db->where('inv_id',$_POST['inv_id']);
		}

		if(isset($_POST['start_date']) && !$_POST['start_date'] == ''){
			$this->db->where('inv_date >= ',$_POST['start_date']);
		}

		if(isset($_POST['end_date']) && !$_POST['end_date'] == ''){
			$this->db->where('inv_date <= ',$_POST['end_date']);
		}

		if(isset($_POST['cust_name']) && !$_POST['cust_name'] == ''){
			$custname = $_POST["cust_name"];
			$this->db->where("cust_name LIKE '%$custname%'");
		}

		if(isset($_POST['tax_name']) && !$_POST['tax_name'] == ''){
			$where = '';
			foreach ($_POST['tax_name'] as $key => $value) {
				$where .= "OR Tax_1='".$value."' ";
			}

			foreach ($_POST['tax_name'] as $key => $value) {
				$where .= "OR Tax_2='".$value."' ";
			}

			$this->db->where('('.substr("$where",3,-1).')');
		}

		if(isset($_POST['v_id']) && !$_POST['v_id'] == ''){
			$where = '';
			foreach ($_POST['v_id'] as $key => $value) {
				$where .= "OR invoice.ref_v_id='".$value."' ";
			}
			$this->db->where('('.substr("$where",3,-1).')');
		}

		$this->db->where('invoice.is_cancled','0');
		$this->db->where('invoice.is_deleted','0');
		$this->db->where('invoice.UserId',$_SESSION['admin_id']);
		return $this->db->count_all_results();
	}
}