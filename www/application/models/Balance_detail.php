<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Balance_detail extends CI_Model {
    var $table = 'ledger';
    var $column_order = array(null,'added_date','amount_paid','balance'); //set column field database for datatable orderable
    var $column_search = array('added_date','amount_paid','balance'); //set column field database for datatable searchable
    var $order = array('ledger_id' => 'desc'); // default order
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query()
    {   $this->db->select('*');
        $this->db->from($this->table);
        
       /* $this->db->join('product_info','product_info.P_Id = bpb.P_Id','left');*/
      


        // if(isset($_POST['start_date']) && !$_POST['start_date'] == ''){
        //     $this->db->where('date >= ',$_POST['start_date']);
        // }

        // if(isset($_POST['end_date']) && !$_POST['end_date'] == ''){
        //     $this->db->where('date <= ',$_POST['end_date']);
        // }

        // if(isset($_POST['bill_no']) && !$_POST['bill_no'] == ''){
        //     $this->db->where('BillNo',$_POST['bill_no']);
        // }

        /*if(isset($_POST['QuantityType']) && !$_POST['QuantityType'] == ''){
            $this->db->where('QuantityType',$_POST['QuantityType']);
        }*/
       /* if(isset($_POST['tax_name']) && !$_POST['tax_name'] == ''){
            $where = '';
            foreach ($_POST['tax_name'] as $key => $value) {
                $where .= "OR Tax_1='".$value."' ";
            }

            foreach ($_POST['tax_name'] as $key => $value) {
                $where .= "OR Tax_2='".$value."' ";
            }

            $this->db->where('('.substr("$where",3,-1).')');
        }*/

        $this->db->where(array('ledger_type'=>'buy','UserId'=>$_SESSION['admin_id']));


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
        $this->db->where(array('UserId'=>$_SESSION['admin_id']));

        // if(isset($_POST['start_date']) && !$_POST['start_date'] == ''){
        //     $this->db->where('date >= ',$_POST['start_date']);
        // }

        // if(isset($_POST['end_date']) && !$_POST['end_date'] == ''){
        //     $this->db->where('date <= ',$_POST['end_date']);
        // }

        //  if(isset($_POST['bill_no']) && !$_POST['bill_no'] == ''){
        //     $this->db->where('BillNo',$_POST['bill_no']);
        // }

       /* if(isset($_POST['tax_name']) && !$_POST['tax_name'] == ''){
            $where = '';
            foreach ($_POST['tax_name'] as $key => $value) {
                $where .= "OR Tax_1='".$value."' ";
            }

            foreach ($_POST['tax_name'] as $key => $value) {
                $where .= "OR Tax_2='".$value."' ";
            }

            $this->db->where('('.substr("$where",3,-1).')');
        }*/

        return $this->db->count_all_results();
    }
}