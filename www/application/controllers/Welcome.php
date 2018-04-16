<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('admin_model'));
        $this->load->model(array('Record_datatable'));
    }

// Admin Login
    public function index()
    {
        $data = array();

//print_r($this->input->post());
        if ($this->input->post()) {
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $login    = $this->admin_model->login($email, $password);
            if (!empty($login)) {
                $this->load->view('header', $data);
                $this->load->view('sidebar', $data);
                $this->load->view('index', $data);
                $this->load->view('footer');
            } else {
                $this->session->set_flashdata('message', 'Incorrect Email Password');
                $this->load->view('login');
            }
        } else {
            $auth = checkAdminLogin();
            if ($auth == 1) {
                $this->load->view('header');
                $this->load->view('sidebar');
                $this->load->view('index');
                $this->load->view('footer');
            } else {
                $this->load->view('login');
            }
        }
    }

// Logout
    public function logout()
    {
        $this->session->unset_userdata('admin_id');
        $this->session->sess_destroy();
        $this->load->view('login');
    }

// Manage Records
    public function managerecords()
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

// Manage Records
    public function managerecords_manual()
    {
        $bills_total = '';
        if (isset($_POST['tax_name']) || isset($_POST['cust_name']) || isset($_POST['start']) || isset($_POST['end']) || isset($_POST['inv_no'])) {
            $bills_total = $this->get_total_bills_amount('manual_invoice');
        }

        $data = array(
            'inv_id'      => isset($_POST['inv_no']) ? $_POST['inv_no'] : '',
            'start_date'  => isset($_POST['start']) ? $_POST['start'] : '',
            'end_date'    => isset($_POST['end']) ? $_POST['end'] : '',
            'cust_name'   => isset($_POST['cust_name']) ? $_POST['cust_name'] : '',
            'tax_name'    => isset($_POST['tax_name']) ? json_encode($_POST['tax_name']) : '',
            'bills_total' => $bills_total,
        );

        $auth = checkAdminLogin();
        if ($auth == 1) {
            /*$data['records'] = $this->admin_model->rec_list();*/
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('viewrecords_manual');
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }

    public function get_total_bills_amount($table)
    {
        $this->db->select('sum(total) as totalamount');
        $this->db->from($table);
        $this->db->where('is_cancled', '0');
        $this->db->where('is_deleted', '0');
        /*$this->db->where('is_moved',0);*/
        if (isset($_POST['inv_id']) && !$_POST['inv_id'] == '') {
            $this->db->where('inv_id', $_POST['inv_id']);
        }

        if (isset($_POST['start']) && !$_POST['start'] == '') {
            $this->db->where('inv_date >= ', $_POST['start']);
        }

        if (isset($_POST['end']) && !$_POST['end'] == '') {
            $this->db->where('inv_date <= ', $_POST['end']);
        }

        if (isset($_POST['cust_name']) && !$_POST['cust_name'] == '') {
            $custname = $_POST["cust_name"];
            $this->db->where("cust_name LIKE '%$custname%'");
        }

        if (isset($_POST['tax_name']) && !$_POST['tax_name'] == '') {
            $where = '';
            foreach ($_POST['tax_name'] as $key => $value) {
                $where .= "OR tax_type='" . $value . "' ";
            }
            $this->db->where(substr("$where", 3, -1));
        }
        $inv_data = $this->db->get()->row_array();

        $full_total = $inv_data['totalamount'];

        return $full_total;
    }

    public function recorddel()
    {
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $tablename       = "records";
            $id              = $this->uri->segment(3);
            $data['records'] = $this->admin_model->rec_del($id, $tablename);
            $this->session->set_flashdata('message', 'Record Deleted Successfully');
            redirect('Welcome/managerecords');
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('viewrecords');
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }

    // Manage Offers
    public function managehsn()
    {
        $data    = array();
        $adminId = $this->session->userdata('admin_id');
        $auth    = checkAdminLogin();
        if ($auth == 1) {
            if ($this->input->post()) {
                $PostData = $this->input->post();
                if (isset($PostData['HSN_Id']) && !empty($PostData['HSN_Id'])) {
                    $id = $PostData['HSN_Id'];
                    unset($PostData['HSN_Id']);
                    $this->db->where('HSN_Id', $id)->update('hsn_codes', $PostData);
                    echo json_encode(array('result' => 'success', 'title' => 'Successfull', 'message' => 'HSN Successfully Updated.'));
                    exit;
                } else {
                    unset($PostData['HSN_Id']);
                    $PostData['UserId'] = $_SESSION['admin_id'];
                    $this->db->insert('hsn_codes', $PostData);
                    echo json_encode(array('result' => 'success', 'title' => 'Successfull', 'message' => 'HSN Successfully Added.'));
                    exit;
                }

            } else {
                $data['offers'] = $this->db->where('UserId',$_SESSION['admin_id'])->get('hsn_codes')->result_array();
                $this->load->view('header');
                $this->load->view('sidebar', $data);
                $this->load->view('managehsn', $data);
                $this->load->view('footer');
            }
        } else {
            redirect('login');
        }
    }

/*public function del_hsn(){
header('Content-Type: application/json');
$da = array('IsDeleted'=>1);
if($this->db->where('HSN_Id',$_POST['id'])->update('hsn_codes',$da)){
$data = array(
'result' => 'success',
'message' => 'Status Successfully Changed!',
'title' => 'Successfull'
);
}else{
$data = array(
'result' => 'danger',
'message' => 'Unable to change status offer!',
'title' => 'Error'
);
}
echo json_encode($data);
}*/

    public function del_hsn()
    {
        header('Content-Type: application/json');
        $offer = $this->db->where('HSN_Id', $_POST['id'])->get('hsn_codes')->row_array();
        if ($offer['IsDeleted'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $da = array('IsDeleted' => $status);
        if ($this->db->where('HSN_Id', $_POST['id'])->update('hsn_codes', $da)) {
            $data = array(
                'result'  => 'success',
                'message' => 'Status Successfully Changed!',
                'title'   => 'Successfull',
            );
        } else {
            $data = array(
                'result'  => 'danger',
                'message' => 'Unable to change status!',
                'title'   => 'Error',
            );
        }

        echo json_encode($data);
    }

    public function edit_hsn()
    {
        header('Content-Type: application/json');
        echo json_encode($this->db->where('HSN_Id', $_POST['id'])->get('hsn_codes')->row_array());
    }

    public function editrecord_manual()
    {
        extract($_POST);
        $data    = array();
        $adminId = $this->session->userdata('admin_id');
        $auth    = checkAdminLogin();
        if ($auth == 1) {
            $id                 = $this->uri->segment(3);
            $data['editrecord'] = $this->admin_model->editrecord_manual($id);
            $data['items']      = $this->admin_model->get_items_manual($id);
            $this->load->view('header');
            $this->load->view('sidebar', $data);
            $this->load->view('editrecord_manual', $data);
            $this->load->view('footer');

        } else {
            $this->load->view('login');
        }
    }

// Import Record
    public function importrecord()
    {
        $data = array();
//$data['results'] = $this->admin_model->fetchresults();
        $this->load->view('header');
        $this->load->view('sidebar', $data);
        $this->load->view('import', $data);
        $this->load->view('footer');
    }

// Serch Record
    public function searchrecord()
    {
        $data['results'] = $this->admin_model->fetchresults();
        $this->load->view('header');
        $this->load->view('sidebar', $data);
        $this->load->view('searchrecord', $data);
        $this->load->view('footer');
    }

    public function get_results()
    {
        if (!empty($_POST['lineno']) || !empty($_POST['serailno']) || !empty($_POST['manufacturer']) || !empty($_POST['model'])) {
            $data['results'] = array('line_no' => $_POST['lineno'], 'sr_no' => $_POST['serailno'], 'manufact' => $_POST['manufacturer'], 'model' => $_POST['model']);
            $this->load->view('header');
            $this->load->view('sidebar', $data);
            $this->load->view('results', $data);
            $this->load->view('footer');
        } else {
            redirect('Welcome/searchrecord');
        }
    }

    public function import()
    {
        if (isset($_POST["import"])) {
            $filename = $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0) {
                $firstline = true;
                $file      = fopen($filename, "r");
                while (($importdata = fgetcsv($file, 10000, ",")) !== false) {
                    $data = array(
                        'LINENUMBER'      => $importdata[0],
                        'SERIALNUMBER1'   => $importdata[1],
                        'SERIALNUMBER2'   => $importdata[2],
                        'MANUFACTURER'    => $importdata[3],
                        'MODEL'           => $importdata[4],
                        'CALIBRE'         => $importdata[5],
                        'SIGNEDOUT'       => $importdata[6],
                        'IDNUMBER'        => $importdata[7],
                        'LICENSENUMBER'   => $importdata[8],
                        'SOLDTO'          => $importdata[9],
                        'COMMENTS'        => $importdata[10],
                        'DATESIGNEDOUT'   => $importdata[11],
                        'PURCHASEPRICE'   => $importdata[12],
                        'SELLINGPRICE'    => $importdata[13],
                        'SELLER'          => $importdata[14],
                        'SELLERIDLICNO'   => $importdata[15],
                        'PIPENUMBER'      => $importdata[16],
                        'ASSIGNEDTO'      => $importdata[17],
                        'ASSIGNEDTOTEL'   => $importdata[18],
                        'ASSIGNEDTOEMAIL' => $importdata[19],
                        'INVOICENUMBER'   => $importdata[20],
                        'ITEMTYPE'        => $importdata[21],
                        'EMPTY1'          => $importdata[22],
                    );
                    if (!$firstline) {
                        $insert = $this->admin_model->insertCSV($data);
                    }
                    $firstline = false;
                }
                fclose($file);
                $this->session->set_flashdata('message', 'Data are imported successfully..');
                redirect('Welcome/importrecord');
            } else {
                $this->session->set_flashdata('error', 'Select CSV File');
                redirect('Welcome/importrecord');
            }
        }
    }

// Searching Records
    public function ajax_list1()
    {
        $hostname    = "localhost";
        $username    = "root";
        $password    = "";
        $dbname      = "labsvism_nagpal";
        $conn        = mysqli_connect($hostname, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
        $requestData = $_REQUEST;
        $columns     = array(
            0 => 'LINENUMBER',
            1 => 'SERIALNUMBER1',
            2 => 'MODEL',
            3 => 'MANUFACTURER',
            4 => 'CALIBRE',
            5 => 'SIGNEDOUT',
            6 => 'SOLDTO',
        );
        $sql           = "SELECT LINENUMBER, SERIALNUMBER1, ID, MODEL, MANUFACTURER, CALIBRE ,SIGNEDOUT,SOLDTO FROM records";
        $query         = mysqli_query($conn, $sql);
        $totalData     = mysqli_num_rows($query);
        $totalFiltered = $totalData;
        $sql           = "SELECT LINENUMBER, ID, SERIALNUMBER1, MODEL, MANUFACTURER, CALIBRE ,SIGNEDOUT,SOLDTO FROM records ";
        if (!empty($_POST['lineno'])) {
            $sql .= " WHERE ( LINENUMBER LIKE '" . $this->input->post('lineno') . "%')";
        }
        if (!empty($_POST['serailno'])) {
            $sql .= " WHERE ( SERIALNUMBER1 LIKE '" . $this->input->post('serailno') . "%')";
        }
        if (!empty($_POST['manufacturer'])) {
            $sql .= " WHERE ( MANUFACTURER LIKE '" . $this->input->post('manufacturer') . "%')";
        }
        if (!empty($_POST['model'])) {
            $sql .= " WHERE ( MODEL LIKE '" . $this->input->post('model') . "%')";
        }
        $query         = mysqli_query($conn, $sql);
        $totalFiltered = mysqli_num_rows($query);
        $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
        $query = mysqli_query($conn, $sql);
        $data  = array();
        while ($row = mysqli_fetch_array($query)) {
            // preparing an array
            $nestedData   = array();
            $nestedData[] = $row["LINENUMBER"];
            $nestedData[] = $row["SERIALNUMBER1"];
            $nestedData[] = $row["MANUFACTURER"];
            $nestedData[] = $row["MODEL"];
            $nestedData[] = $row["CALIBRE"];
            $nestedData[] = $row["SIGNEDOUT"];
            $nestedData[] = $row["SOLDTO"];
            $nestedData[] = '<a title="Edit" class="btn btn-icon waves-effect waves-light btn-default" data-id="' . $row["ID"] . '" href="' . base_url() . 'Welcome/editrecord/' . $row["ID"] . '">Edit</a><a title="Delete" class="btn btn-icon waves-effect waves-light btn-danger" data-id="' . $row["ID"] . '" href="' . base_url() . 'Welcome/recorddel/' . $row["ID"] . '">Delete</a>';
            $data[]       = $nestedData;
        }
        $json_data = array(
            "draw"            => intval($requestData['draw']),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
        );
        echo json_encode($json_data);
    }

    public function add_invoice()
    {
        header('Content-Type: application/json');

        if ($_POST['invoice_id'] == '') {
            $data = array(
                'cust_name' => $_POST['customer_name'],
                'vrn'       => $_POST['vrn_no'],
                'inv_date'  => date('y-m-d', strtotime($_POST['invoice_date'])),
                'sub_total' => $_POST['sub_total'],
                'tax'       => $_POST['tax'],
                'total'     => $_POST['total'],
                'tax_type'  => $_POST['tax_name'],
            );
            if ($this->db->insert('invoice', $data)) {

                $insert_id = $this->db->insert_id();

                for ($x = 1; $x < $_POST['records']; $x++) {
                    if (!$_POST['itemDesc_' . $x . ''] == '') {
                        $data2 = array(
                            'p_name'   => $_POST['itemDesc_' . $x . ''],
                            'p_qnt'    => $_POST['itemQty_' . $x . ''],
                            'p_type'   => $_POST['itemTyp_' . $x . ''],
                            'p_rate'   => $_POST['itemRate_' . $x . ''],
                            'p_amount' => $_POST['itemTotal_' . $x . ''],
                            'p_inv_id' => $insert_id,
                        );
                        $this->db->insert('invoice_products', $data2);
                    }

                }
                echo json_encode(array('result' => 'success', 'inv_id' => $insert_id));
            } else {
                echo json_encode(array('result' => 'danger', 'inv_id' => ''));
            }
        } else {
            $this->edit_invoice();
        }
    }

    public function add_invoice_manual()
    {
        header('Content-Type: application/json');

        if ($_POST['invoice_id'] == '') {
            if ($this->db->where('inv_id', $_POST['invoice_number'])->get('manual_invoice')->num_rows() == 0) {
                $data = array(
                    'cust_name' => $_POST['customer_name'],
                    'vrn'       => $_POST['vrn_no'],
                    'inv_date'  => date('y-m-d', strtotime($_POST['invoice_date'])),
                    'sub_total' => $_POST['sub_total'],
                    'tax'       => $_POST['tax'],
                    'total'     => $_POST['total'],
                    'tax_type'  => $_POST['tax_name'],
                    'inv_id'    => $_POST['invoice_number'],
                );
                if ($this->db->insert('manual_invoice', $data)) {

                    $insert_id = $_POST['invoice_number'];

                    for ($x = 1; $x < $_POST['records']; $x++) {
                        if (!$_POST['itemDesc_' . $x . ''] == '') {
                            $data2 = array(
                                'p_name'   => $_POST['itemDesc_' . $x . ''],
                                'p_qnt'    => $_POST['itemQty_' . $x . ''],
                                'p_type'   => $_POST['itemTyp_' . $x . ''],
                                'p_rate'   => $_POST['itemRate_' . $x . ''],
                                'p_amount' => $_POST['itemTotal_' . $x . ''],
                                'p_inv_id' => $insert_id,
                            );
                            $this->db->insert('manual_invoice_products', $data2);
                        }

                    }
                    echo json_encode('success');
                } else {

                    echo json_encode('danger');
                }
            } else {
                echo json_encode('duplicate');
            }
        } else {
            $this->edit_invoice_manual();
        }

    }

    public function edit_invoice()
    {

        $data = array(
            'cust_name' => $_POST['customer_name'],
            'vrn'       => $_POST['vrn_no'],
            'inv_date'  => date('y-m-d', strtotime($_POST['invoice_date'])),
            'sub_total' => $_POST['sub_total'],
            'tax'       => $_POST['tax'],
            'total'     => $_POST['total'],
            'tax_type'  => $_POST['tax_name'],
        );
        $this->db->where('inv_id', $_POST['invoice_id']);

        if ($this->db->update('invoice', $data)) {
            $insert_id = $_POST['invoice_id'];

            if ($this->db->where('p_inv_id', $_POST['invoice_id'])->delete('invoice_products')) {

                for ($x = 1; $x < $_POST['records']; $x++) {
                    if (!$_POST['itemDesc_' . $x . ''] == '') {
                        $data2 = array(
                            'p_name'   => $_POST['itemDesc_' . $x . ''],
                            'p_qnt'    => $_POST['itemQty_' . $x . ''],
                            'p_type'   => $_POST['itemTyp_' . $x . ''],
                            'p_rate'   => $_POST['itemRate_' . $x . ''],
                            'p_amount' => $_POST['itemTotal_' . $x . ''],
                            'p_inv_id' => $insert_id,
                        );
                        $this->db->insert('invoice_products', $data2);
                    }
                }
            }
            echo json_encode('success');
        } else {
            echo json_encode('danger');
        }
    }

    public function edit_invoice_manual()
    {

        $data = array(
            'cust_name' => $_POST['customer_name'],
            'vrn'       => $_POST['vrn_no'],
            'inv_date'  => date('y-m-d', strtotime($_POST['invoice_date'])),
            'sub_total' => $_POST['sub_total'],
            'tax'       => $_POST['tax'],
            'total'     => $_POST['total'],
            'tax_type'  => $_POST['tax_name'],
        );
        $this->db->where('inv_id', $_POST['invoice_id']);

        if ($this->db->update('manual_invoice', $data)) {
            $insert_id = $_POST['invoice_id'];

            if ($this->db->where('p_inv_id', $_POST['invoice_id'])->delete('manual_invoice_products')) {

                for ($x = 1; $x < $_POST['records']; $x++) {
                    if (!$_POST['itemDesc_' . $x . ''] == '') {
                        $data2 = array(
                            'p_name'   => $_POST['itemDesc_' . $x . ''],
                            'p_qnt'    => $_POST['itemQty_' . $x . ''],
                            'p_rate'   => $_POST['itemRate_' . $x . ''],
                            'p_amount' => $_POST['itemTotal_' . $x . ''],
                            'p_inv_id' => $insert_id,
                        );
                        $this->db->insert('manual_invoice_products', $data2);
                    }
                }
            }
            echo json_encode('success');
        } else {
            echo json_encode('danger');
        }
    }

     public function get_inv_no()
    {
        header('Content-Type: application/json');
        $inv = $this->db->select('invoice_no')->where('UserId',$_SESSION['admin_id'])->order_by('inv_id', 'desc')->get('invoice')->row_array();
        if($inv){
            if($inv['invoice_no']!=''){
                $last_invoice = $inv['invoice_no'];
                $last_invoice = explode("-",$last_invoice);
                $invoice = $last_invoice[0].'-'.(intval($last_invoice[1]) + 1);
            }else{
                $invoice = date('Y').'-'.'1';
            }
        }else{
             $invoice = date('Y').'-'.'1';
        }
        echo json_encode($invoice);
    }

    public function move_to_valid()
    {

        $inv = $this->db->select('cust_name,vrn,inv_date,sub_total,tax,tax_type,total,product_detail_id')
            ->where('inv_id', $_POST['inv_id'])->get('manual_invoice')->row_array();

        if ($this->db->insert('invoice', $inv)) {
            $insert_id = $this->db->insert_id(); //p_inv_id
            $products  = $this->db->select('p_name,p_qnt,p_type,p_rate,p_amount')
                ->where('p_inv_id', $_POST['inv_id'])->get('manual_invoice_products')->result_array();
            foreach ($products as $row) {
                $row['p_inv_id'] = $insert_id;
                $this->db->insert('invoice_products', $row);
            }

            $this->db->where('inv_id', $_POST['inv_id'])->update('manual_invoice', array('is_moved' => 1));
            echo 'success';
        } else {
            echo 'danger';
        }

    }

    public function print_invoice_manual($inv_id)
    {
        $data    = array();
        $adminId = $this->session->userdata('admin_id');
        $auth    = checkAdminLogin();
        if ($auth == 1) {

            $id = $this->uri->segment(3);
            /*$data['editrecord'] = $this->admin_model->editrecord_manual($id);
            $data['items'] = $this->admin_model->get_items_manual($id);*/
            $this->load->view('invoice_printout', $data);
        } else {
            $this->load->view('login');
        }
    }

// Update Personal Details
    public function editProfile()
    {
        $data    = array();
        $adminId = $this->session->userdata('admin_id');
        $auth    = checkAdminLogin();
        if ($auth == 1) {
            if (isset($_POST['submit'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Username', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $data['profile'] = $this->admin_model->admin_profile();
                    $this->load->view('header');
                    $this->load->view('sidebar', $data);
                    $this->load->view('profileedit', $data);
                    $this->load->view('footer');
                } else {
                    $name   = $this->input->post('name');
                    $email  = $this->input->post('email');
                    $result = $this->admin_model->updatePersonalDetails($adminId, $name, $email);
                    if ($result) {
                        $this->session->set_flashdata('message', 'Personal Details Updated Successfully');
                        redirect('Welcome/editProfile');
                    }

                }

            } else {
                $data['PROFILE'] = $this->admin_model->admin_profile();
                $this->load->view('header');
                $this->load->view('sidebar', $data);
                $this->load->view('profileedit', $data);
                $this->load->view('footer');
            }
        } else {
            $this->load->view('login');
        }
    }

// Change Password
    public function changePassword()
    {
        $data = array();
        $auth = checkAdminLogin();
        if ($auth == 1) {
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_message('validate_password', 'Old Password Not Matched!');
                $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|callback_validate_password');
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
                $this->form_validation->set_rules('confirm_new_pssword', 'Confirm Password', 'trim|required|matches[new_password]');
                if ($this->form_validation->run() == false) {
                    $this->load->view('header');
                    $this->load->view('sidebar');
                    $this->load->view('change-password');
                    $this->load->view('footer');
                } else {
                    $adminId        = $this->session->userdata('admin_id');
                    $updatepassword = $this->admin_model->update_password();
                    if ($updatepassword) {
                        $this->session->set_flashdata('message', 'Password Updated Successfully');
                        redirect('Welcome/changePassword');
                    }
                }

            } else {
                $this->load->view('header');
                $this->load->view('sidebar');
                $this->load->view('change-password');
                $this->load->view('footer');
            }
        } else {
            $this->load->view('login');
        }
    }

// Change Profile Picture
    public function changephoto()
    {
        $auth = checkAdminLogin();

        if ($auth == 1) {
            if ($this->input->post()) {
                $inputval = $this->input->post();
                $files    = $_FILES['book_image']['name'];
                if ($files != '') {
                    $randomString                   = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6) . '_';
                    $_FILES['userFile']['name']     = $randomString . $_FILES['book_image']['name'];
                    $_FILES['userFile']['type']     = $_FILES['book_image']['type'];
                    $_FILES['userFile']['tmp_name'] = $_FILES['book_image']['tmp_name'];
                    $_FILES['userFile']['error']    = $_FILES['book_image']['error'];
                    $_FILES['userFile']['size']     = $_FILES['book_image']['size'];
                    $uploadPath                     = 'assets/images/users/';
                    $config['upload_path']          = $uploadPath;
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                //print_r('expression');die();
                    if ($this->upload->do_upload('userFile')) {
                        $fileData                = $this->upload->data();
                        $uploadData['file_name'] = $fileData['file_name'];
                        $uploadData['created']   = date("Y-m-d H:i:s");
                        $uploadData['modified']  = date("Y-m-d H:i:s");
                    } else {
                        $this->session->set_flashdata('error', 'Upload Images of Jpg/Jpeg/Png/Gif Formats');
                        redirect('Welcome/changephoto');
                    }
                    $book_image = $_FILES['userFile']['name'];
                } else {
                    $book_image = $this->input->post('book_hidden_image');
                }

                $editbook = $this->admin_model->update_book($book_image);
                if ($editbook) {
                    $this->session->set_flashdata('message', 'Profile Picture Updated Successfully');
                    redirect('Welcome/changephoto');
                }

            } else {
                $data['PROFILE'] = $this->admin_model->admin_profile();
                $this->load->view('header');
                $this->load->view('sidebar', $data);
                $this->load->view('change-photo', $data);
                $this->load->view('footer');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function validate_password($str)
    {
        $field_value = $str; //this is redundant, but it's to show you how
        //the content of the fields gets automatically passed to the method

        if ($this->admin_model->validate_password($field_value)) {
            return true;
        } else {
            return false;
        }
    }

    public function calender_records()
    {
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $data['profile'] = $this->admin_model->admin_profile();
            $this->load->view('header');
            $this->load->view('sidebar', $data);
            $this->load->view('calender_record', $data);
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }

    public function sale_chart()
    {
        $data['profile'] = $this->admin_model->admin_profile();
        $this->load->view('header');
        $this->load->view('sidebar', $data);
        $this->load->view('sale_chart');
        $this->load->view('footer');
    }

    public function get_sale_purchase(){
    	$start = date('Y-m-d', strtotime($_POST['startdate']));
$end = date("Y-m-d", strtotime("+1 month", strtotime($_POST['startdate'])));

    $this->db->select_sum('total', 'daily_total')
              ->from('invoice')
              /*->where('sale_rep_id', $rep_id)*/
              ->where('inv_date >=', $start)
              ->where('inv_date <=', $end)
              ->group_by('DAY(inv_date)')
              ->order_by('daily_total', 'DESC')
              ->limit(1);
    $query = $this->db->get();
    print_r($query->result());die();
    return $query->row('weekly_total');
    }
}
