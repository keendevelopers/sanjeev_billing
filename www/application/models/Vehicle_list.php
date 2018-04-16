<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vehicle_list extends CI_Model {
    var $table = 'stock_vehicles';
    var $column_order = array(null,'model','chassis_no','engine_no','manufacture','color','created_on'); //set column field database for datatable orderable
    var $column_search = array('model','chassis_no','engine_no','manufacture','color','stock_vehicles.created_on'); //set column field database for datatable searchable
    var $order = array('sv_id' => 'desc'); // default order
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query()
    {   $this->db->select('stock_vehicles.*,vehicle_info.model,vehicle_info.make,vehicle_info.horse_power');
        $this->db->from($this->table);
        
        $this->db->join('vehicle_info','vehicle_info.v_id = stock_vehicles.ref_v_id','left');
      
         if(isset($_POST['v_id']) && !$_POST['v_id'] == ''){
            $where = '';
            foreach ($_POST['v_id'] as $key => $value) {
                $where .= "OR stock_vehicles.ref_v_id='".$value."' ";
            }
            $this->db->where('('.substr("$where",3,-1).')');
        }

         if(isset($_POST['is_sold']) && $_POST['is_sold'] !== ''){
            $this->db->where('stock_vehicles.is_sold',$_POST['is_sold']);
        }

          if(isset($_POST['vv_id']) && !$_POST['vv_id'] == ''){
            $this->db->where('stock_vehicles.ref_v_id',$_POST['vv_id']);
        }

        if(isset($_POST['start_date']) && !$_POST['start_date'] == ''){
            $this->db->where('date >= ',$_POST['start_date']);
        }

        if(isset($_POST['end_date']) && !$_POST['end_date'] == ''){
            $this->db->where('date <= ',$_POST['end_date']);
        }

        if(isset($_POST['manufacture']) && !$_POST['manufacture'] == ''){
            $where = '(';
            foreach ($_POST['manufacture'] as $key => $value) {
                $where .= "OR manufacture='".$value."' ";
            }
            $this->db->where('('.substr("$where",3,-1).')');
        }

        $this->db->where('stock_vehicles.is_deleted','0');


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
       /* print_r($this->db->last_query());*/
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
        $this->db->where('stock_vehicles.is_deleted','0');
       
       if(isset($_POST['v_id']) && !$_POST['v_id'] == ''){
            $where = '';
            foreach ($_POST['v_id'] as $key => $value) {
                $where .= "OR ref_v_id='".$value."' ";
            }
           $this->db->where('('.substr("$where",3,-1).')');
        }


        if(isset($_POST['start_date']) && !$_POST['start_date'] == ''){
            $this->db->where('date >= ',$_POST['start_date']);
        }

        if(isset($_POST['end_date']) && !$_POST['end_date'] == ''){
            $this->db->where('date <= ',$_POST['end_date']);
        }

        if(isset($_POST['manufacture']) && !$_POST['manufacture'] == ''){
            $where = '';
            foreach ($_POST['manufacture'] as $key => $value) {
                $where .= "OR manufacture='".$value."' ";
            }
           $this->db->where('('.substr("$where",3,-1).')');
        }

        $this->db->where('stock_vehicles.is_deleted','0');

        return $this->db->count_all_results();
    }
}