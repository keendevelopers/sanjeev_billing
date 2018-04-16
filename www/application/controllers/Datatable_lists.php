<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datatable_lists extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('admin_model'));
        $this->load->model(array('Invoice_list_model'));
    }

    public function invoice_list()
    {
        $list = $this->Invoice_list_model->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($list as $invoice) {
            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = date('d-M-Y', strtotime($invoice->inv_date));
            $row[] = $invoice->invoice_no;
            $gst   = $invoice->Biller_GST == '' ? '' : '<br><b>GSTIN: </b>' . $invoice->Biller_GST . '';
            $row[] = '<b>Name: </b>' . $invoice->cust_name . '<br><b>Address: </b>' . $invoice->address . '<br><b>Mobile: </b>+91-' . $invoice->mobile . '<br><b>State Code: </b>' . $invoice->StateCode . $gst;

            $offer = '';
            $offer1 = '';
            if($invoice->OfferType != ''){
            if ($invoice->OfferType == 'NetAmount') {
                $offer = '<br><b>Offer Amount:</b> - <i class="fa fa-inr"></i> ' . $invoice->OfferAmount . '/-';
            }
            else{
               $offer1 = '<br><b>Offer Amount:</b> - <i class="fa fa-inr"></i> ' . $invoice->OfferAmount . '/-';
            }
            }

            $row[] = '<b>Amount(<i class="fa fa-inr" aria-hidden="true"></i>): </b>' . $invoice->sub_total . '/-' .$offer. '<br><b>' . $invoice->Tax_1 . '%(<i class="fa fa-inr" aria-hidden="true"></i>): </b>' . $invoice->Tax_1_Amount . '/-' . '<br><b>' . $invoice->Tax_2 . '%(<i class="fa fa-inr" aria-hidden="true"></i>): </b>' . $invoice->Tax_2_Amount .'/-' .$offer1 . '<br><b>Total(<i class="fa fa-inr" aria-hidden="true"></i>): </b>' . $invoice->total . '/-';

            if ($invoice->is_cancled == 0) {

                $buttons = '<a class="btn btn-primary btn-mini mr-l-5 kd-margin-bottom" href="' . base_url() . 'invoice/editrecord/' . $invoice->inv_id . '" title="Edit Invoice"><i class="fa fa-pencil-square-o"></i> </a>

            <a class="btn btn-info btn-mini mr-l-5 kd-margin-bottom" onclick=view_modal("' . base_url() . 'product/modal/view_invoice/' . $invoice->inv_id . '")><i class="fa fa-eye"></i> </a>

            <button class="btn btn-danger ladda-button btn-mini mr-l-5 kd-margin-bottom" data-style="expand-left" data-id="' . $invoice->inv_id . '" id="cancel_inv_' . $invoice->inv_id . '" onclick=cancle_status("' . $invoice->inv_id . '")><span class="ladda-label"><i class="fa fa-times" title="Ca Invoice"></i></spaan></button>
            <a class="btn btn-default btn-mini mr-l-5" target="_blank" href="' . base_url() . 'invoice/print_invoice/' . $invoice->inv_id . '" title="Print Invoice"><i class="fa fa-print"></i></a>';
            } else {
                $cancle  = '<button class="btn btn-info btn-mini mr-l-5 kd-margin-bottom" data-id="1"><i class="fa fa-ban""></i> Canceled</button>';
                $buttons = $cancle;
            }

            /*$cancle = '';*///remove this cancle to enable invoice cancle opration

            $row[] = $buttons;

            $data[] = $row;
        }
        /*   $data['total_bills_amount'] = $full_total;*/

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Invoice_list_model->count_all(),
            "recordsFiltered" => $this->Invoice_list_model->count_filtered(),
            "data"            => $data,

        );
        //output to json format
        echo json_encode($output);
    }

    public function get_total_bills_amount()
    {
        $this->db->select('sum(total) as totalamount');
        $this->db->from('invoice');
        $this->db->where('is_cancled', '0');
        $this->db->where('is_deleted', '0');
        /*$this->db->where('is_moved',0);*/
        if (isset($_POST['inv_id']) && !$_POST['inv_id'] == '') {
            $this->db->where('inv_id', $_POST['inv_id']);
        }

        if (isset($_POST['start_date']) && !$_POST['start_date'] == '') {
            $this->db->where('inv_date >= ', $_POST['start_date']);
        }

        if (isset($_POST['end_date']) && !$_POST['end_date'] == '') {
            $this->db->where('inv_date <= ', $_POST['end_date']);
        }

        if (isset($_POST['tax_name']) && !$_POST['tax_name'] == '') {
            $where = '';
            foreach ($_POST['tax_name'] as $key => $value) {
                $where .= "OR tax_type='" . $value . "' ";
            }
            $this->db->where('(' . substr("$where", 3, -1) . ')');
        }

        /* if(isset($_POST['v_id']) && !$_POST['v_id'] == ''){
        $where = '';
        foreach ($_POST['v_id'] as $key => $value) {
        $where .= "OR ref_v_id='".$value."' ";
        }
        $this->db->where('('.substr("$where",3,-1).')');
        }*/

        $inv_data = $this->db->get()->row_array();

        $full_total = $inv_data['totalamount'];

        echo json_encode($full_total);
    }

}
