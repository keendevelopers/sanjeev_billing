<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('admin_model'));
        $this->load->model(array('Record_datatable'));
    }

// Add Record
    public function recordadd()
    {
        $data             = array();
        $data['products'] = $this->db->select('pi.*,hsn.*')
            ->where('pi.IsDeleted', '0')
            ->join('hsn_codes as hsn', 'hsn.HSN_No = pi.HSNCode', 'left')
            ->get('product_info as pi')->result_array();
        $adminId = $this->session->userdata('admin_id');
        $auth    = checkAdminLogin();
        if ($auth == 1) {
            $this->load->view('header');
            $this->load->view('sidebar', $data);
            $this->load->view('addrecord', $data);
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }

    public function add_invoice()
    {
		// echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';die();
        if ($this->session->userdata('admin_id')) {
            $PostData = $this->input->post();
            $this->form_validation->set_rules('inv_date', 'invoice date', 'required');
            $this->form_validation->set_rules('cust_name', 'customer name', 'required');
            $this->form_validation->set_rules('sub_total', 'sub total', 'required');
            $this->form_validation->set_rules('total', 'net amount', 'required');

            $this->form_validation->set_rules('book_0_P_Id', 'product', 'required');
            $this->form_validation->set_rules('book_0_IP_Price', 'product price', 'required');
			$this->form_validation->set_rules('Amount_paid', 'Amount Paid', 'required');

            if ($this->form_validation->run() == false) {
                $error  = $this->form_validation->error_array();
                $sError = '';
                foreach ($error as $key => $value) {
                    $sError = $value;
                }
                $data = array(
                    'result'  => 'danger',
                    'message' => $sError,
                    'title'   => 'Error',
                );
                echo json_encode($data);
                exit;
            } else {

                $PostData['created_on'] = date('Y-m-d H:i:s');
                $bill                   = array(
                    'cust_name'       => $PostData['cust_name'],
                    'address'         => $PostData['address'],
                    'mobile'          => $PostData['mobile'],
                    'StateCode'       => $PostData['StateCode'],
                    //'vehicle_details' => $PostData['vehicle_details'],
                    'OfferType'       => $PostData['OfferType'],
                    'OfferTitle'      => $PostData['OfferTitle'],
                    'OfferAmount'     => $PostData['OfferAmount'],
                    'inv_date'        => date('y-m-d', strtotime($_POST['inv_date'])),
                    'sub_total'       => $PostData['sub_total'],
                    'Tax_1'           => $PostData['Tax_1'],
                    'Tax_2'           => $PostData['Tax_2'],
                    'Tax_1_Amount'    => $PostData['Tax_1_Amount'],
                    'Tax_2_Amount'    => $PostData['Tax_2_Amount'],
                    'total'           => $PostData['total'],
                   /* 'labour'          => $PostData['labour'],*/
                    'created_on'      => $PostData['created_on'],
                    'Biller_GST'      => $PostData['Biller_GST'],
                    'UserId'          => $_SESSION['admin_id'],
                );

                if (isset($PostData['inv_id']) && !empty($PostData['inv_id'])) {
                    if ($this->db->where('inv_id', $PostData['inv_id'])->update('invoice', $bill)) {
                        $select_data = $this->db->where('inv_id', $PostData['inv_id'])->get('invoice_products')->result_array();
                        foreach ($select_data as $key => $value) {
                            $this->db->query("UPDATE product_info SET AvailQuantity = AvailQuantity + '" . $value['IP_Qunatity_Total'] . "' WHERE P_Id = '" . $value['P_Id'] . "'");
                        }
                        $this->db->where('inv_id', $PostData['inv_id'])->delete('invoice_products');
                        $inv_id = $PostData['inv_id'];
                        for ($i = 0; $i <= $PostData['item_count']; $i++) {
                            if (isset($PostData['book_' . $i . '_P_Id'])) {
                                $bill_product = array(
                                    'inv_id'      => $inv_id,
                                    'P_Id'        => $PostData['book_' . $i . '_P_Id'],
                                    'IP_Price'    => $PostData['book_' . $i . '_IP_Price'],
                                    'IP_Tax_1'    => $PostData['book_' . $i . '_IP_Tax_1'],
                                    'IP_Tax_2'    => $PostData['book_' . $i . '_IP_Tax_2'],
                                    'IP_Qunatity' => $PostData['book_' . $i . '_IP_Qunatity'],
                                    'IP_Qunatity_Loose' => $PostData['book_' . $i . '_IP_Qunatity_Loose'],
                                    'IP_Qunatity_Total' => $PostData['book_' . $i . '_IP_Qunatity_Total'],
                                    'IP_Per_Pack' => $PostData['book_' . $i . '_IP_Per_Pack'],
                                    'IP_Discount' => $PostData['book_' . $i . '_IP_Discount'],
                                    'IP_Total'    => $PostData['book_' . $i . '_IP_Total'],
                                );
                                $this->db->insert('invoice_products', $bill_product);
                                $this->db->query("UPDATE product_info SET AvailQuantity = AvailQuantity - '" . $PostData['book_' . $i . '_IP_Qunatity_Total'] . "' WHERE P_Id = '" . $PostData['book_' . $i . '_P_Id'] . "'");
                            }
                        }

                        $data = array(
                            'result'  => 'success',
                            'message' => 'Details updated successfully!',
                            'title'   => 'Successfull',
                        );
                        echo json_encode($data);
                        exit;

                    } else {
                        $data = array(
                            'result'  => 'danger',
                            'message' => 'Unable to update details!',
                            'title'   => 'Error',
                        );
                        echo json_encode($data);
                        exit;
                    }
                } else {
                    $bill['invoice_no'] = $PostData['invoice_no'];
                    if ($this->db->insert('invoice', $bill)) {
                        $inv_id = $this->db->insert_id();
                        for ($i = 0; $i <= $PostData['item_count']; $i++) {
                            if (isset($PostData['book_' . $i . '_P_Id'])) {
                                $bill_product = array(
                                    'inv_id'      => $inv_id,
                                    'P_Id'        => $PostData['book_' . $i . '_P_Id'],
                                    'IP_Price'    => $PostData['book_' . $i . '_IP_Price'],
                                    'IP_Tax_1'    => $PostData['book_' . $i . '_IP_Tax_1'],
                                    'IP_Tax_2'    => $PostData['book_' . $i . '_IP_Tax_2'],
                                    'IP_Qunatity' => $PostData['book_' . $i . '_IP_Qunatity'],
                                    'IP_Qunatity_Loose' => $PostData['book_' . $i . '_IP_Qunatity_Loose'],
                                    'IP_Qunatity_Total' => $PostData['book_' . $i . '_IP_Qunatity_Total'],
                                    'IP_Per_Pack' => $PostData['book_' . $i . '_IP_Per_Pack'],
                                    'IP_Discount' => $PostData['book_' . $i . '_IP_Discount'],
                                    'IP_Total'    => $PostData['book_' . $i . '_IP_Total'],
                                );
                                $this->db->insert('invoice_products', $bill_product);
                                $this->db->query("UPDATE product_info SET AvailQuantity = AvailQuantity - ('" . $PostData['book_' . $i . '_IP_Qunatity_Total'] . "') WHERE P_Id = '" . $PostData['book_' . $i . '_P_Id'] . "'");
                            }
                        }
						// To Insert Value in ledger table for information of left amount
						$left_info = array(
							'ledger_type'   =>  $_POST['ledger_type'],
							'bill_id'       =>  $inv_id,
							'total_amount'  =>  $_POST['total'] ? $_POST['total']: "",
							'amount_paid'   =>  $_POST['Amount_paid'] ? $_POST['Amount_paid'] : "",
							'balance'       =>  $_POST['Amount_left'] ? $_POST['Amount_left'] : "",
							'payment_type'  =>  $_POST['payment_type'] ? $_POST['payment_type'] : "",
							'cheque_number' =>  isset($_POST['cheque_number']) ? $_POST['cheque_number'] : "" ,
							'modified_on'   =>  date('Y-m-d H:i:s'),
							'created_on'    =>  date('Y-m-d H:i:s'),
							'userId'        =>  $_SESSION['admin_id'],
						);
							
						$this->db->insert('ledger', $left_info);

                        $data = array(
                            'result'  => 'success',
                            'message' => 'Invoice added successfully!',
                            'title'   => 'Successfull',
                        );
                        echo json_encode($data);
                        exit;

                    } else {
                        $data = array(
                            'result'  => 'danger',
                            'message' => 'Unable to add invoice!',
                            'title'   => 'Error',
                        );
                        echo json_encode($data);
                        exit;
                    }
                }

            }
        } else {
            header('location: ' . base_url());
        }
    }

    public function manageinvoice()
    {
        $bills_total = '';
        if (isset($_POST['tax_name']) || isset($_POST['cust_name']) || isset($_POST['start']) || isset($_POST['end']) || isset($_POST['inv_no'])) {
            $bills_total = $this->get_total_bills_amount('invoice');
        }

        $data = array(
            'inv_id'      => isset($_POST['inv_no']) ? $_POST['inv_no'] : '',
            'start_date'  => isset($_POST['start']) && !empty($_POST['start']) ? date('Y-m-d', strtotime($_POST['start'])) : '',
            'end_date'    => isset($_POST['end']) && !empty($_POST['end']) ? date('Y-m-d', strtotime($_POST['end'])) : '',
            'cust_name'   => isset($_POST['cust_name']) ? $_POST['cust_name'] : '',
            'tax_name'    => isset($_POST['tax_name']) ? json_encode($_POST['tax_name']) : '',
            'bills_total' => $bills_total,
        );

        $auth = checkAdminLogin();
        if ($auth == 1) {
            /*$data['records'] = $this->admin_model->rec_list();*/
            $this->load->view('header');
            $this->load->view('sidebar', $data);
            $this->load->view('viewrecords');
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }

    public function cancle_invoice()
    {
        header('Content-Type: application/json');

        $table = 'invoice';

        $detail = $this->db->where('inv_id', $_POST['inv_id'])->get($table)->row_array();

        if ($this->db->where('inv_id', $_POST['inv_id'])->update($table, array('is_cancled' => 1))) {
            $select_data = $this->db->where('inv_id', $_POST['inv_id'])->get('invoice_products')->result_array();
            foreach ($select_data as $key => $value) {
                $this->db->query("UPDATE product_info SET AvailQuantity = AvailQuantity + '" . $value['IP_Qunatity_Total'] . "' WHERE P_Id = '" . $value['P_Id'] . "'");
            }
            echo json_encode('success');

        } else {
            echo json_encode('danger');
        }
    }

    // Edit Record
    public function editrecord()
    {

        $data    = array();
        $adminId = $this->session->userdata('admin_id');
        $auth    = checkAdminLogin();
        if ($auth == 1) {
            $id = $this->uri->segment(3);

            $data = $this->admin_model->editrecord($id);
            $this->load->view('header');
            $this->load->view('sidebar', $data);
            $this->load->view('editrecord', $data);
            $this->load->view('footer');

        } else {
            $this->load->view('login');
        }
    }

    public function print_invoice($inv_id = '')
    {
        $data    = array();
        $adminId = $this->session->userdata('admin_id');
        $auth    = checkAdminLogin();
        if ($auth == 1) {
            $data            = array();
            $id              = $this->uri->segment(3);
            $data['details'] = $this->db->select('i.*')
                ->where('inv_id', $id)
                ->where('is_cancled', '0')
                ->get('invoice as i')->row_array();
            if ($data['details']) {
                $data['products'] = $this->db->select('pi.ProductTitle,pi.ProductMake,pi.ProductCode,pi.QuantityType,pi.PerPack,pi.Description,pi.Price,pi.HSNCode,pi.PackingType,ip.*')
                    ->join('product_info as pi', 'pi.P_Id = ip.P_Id', 'left')
                /*->join('hsn_codes as hsn', 'hsn.HSN_No = ip.HSNCode', 'left')*/
                    ->where('ip.inv_id', $id)
                    ->get('invoice_products as ip')->result_array();
                $number         = $data['details']['total'];
                $data['number'] = $this->changeCurrencytowords($number);

                $this->load->view('invoice_print', $data);
            } else {
                $this->load->view('404');
            }
        } else {
            $this->load->view('login');
        }
    }

//convert currency into words
    public function changeCurrencytowords($number)
    {
        /*$number = 190908100.25;*/
        $no = round($number);
        /* if($number < $no){
        $point = round($no - $number , 2) * 100;
        }else{
        $point = round($number - $no, 2) * 100;
        }*/

        $hundred  = null;
        $digits_1 = strlen($no);
        $i        = 0;
        $str      = array();
        $words    = array('0' => '', '1'          => 'One', '2'       => 'Two',
            '3'                   => 'Three', '4'     => 'Four', '5'      => 'Five', '6' => 'Six',
            '7'                   => 'Seven', '8'     => 'Eight', '9'     => 'Nine',
            '10'                  => 'Ten', '11'      => 'Eleven', '12'   => 'Twelve',
            '13'                  => 'Thirteen', '14' => 'Fourteen',
            '15'                  => 'Fifteen', '16'  => 'Sixteen', '17'  => 'Seventeen',
            '18'                  => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
            '30'                  => 'Thirty', '40'   => 'Forty', '50'    => 'Fifty',
            '60'                  => 'Sixty', '70'    => 'Seventy',
            '80'                  => 'Eighty', '90'   => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');

        while ($i < $digits_1) {

            $divider = ($i == 2) ? 10 : 100;
            $number  = floor($no % $divider);
            $no      = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural  = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[]   = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else {
                $str[] = null;
            }

        }

        $str    = array_reverse($str);
        $result = implode('', $str);

        /*$points = ($point) ?
        "." . $words[$point / 10] . " " .
        $words[$point = $point % 10]. " Paise" : '';*/

        return $result . "Rupees  "; //. $points
    }
}
