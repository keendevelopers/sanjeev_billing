<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_model extends CI_Model {
    var $table = 'product_info';
    var $column_order = array(null,'ProductTitle','ProductMake','Price','QuantityType','AvailQuantity','PerPack'); //set column field database for datatable orderable
    var $column_search = array('ProductTitle','ProductMake','Price','QuantityType','AvailQuantity'); //set column field database for datatable searchable
    var $order = array('P_Id' => 'desc'); // default order
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query()
    {       
        $this->db->select('product_info.*,(AvailQuantity / PerPack) as totla_quantity ');
        $this->db->from($this->table);
        $this->db->where(array('IsDeleted'=>'0','UserId'=>$_SESSION['admin_id']));
    
        

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

        if(!isset($_POST['quantity_type'])){
            $this->db->group_by('product_info.P_Id');
            $this->db->having('totla_quantity <= LeastQuantity',NULL,false);
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
     /*   print_r($this->db->last_query());*/
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
        $this->db->where('IsDeleted','0');
    
        return $this->db->count_all_results();
    }
}