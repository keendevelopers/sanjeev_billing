<?php
error_reporting(0);
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('admin_model', 'product_list'));
        $this->load->model(array('product_model'));
    }

// Admin Login
    public function index()
    {
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $data = array();
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('manage_products');
            $this->load->view('footer');
        } else {
            header('Location: ' . base_url());
        }
    }

    public function product_info_list()
    {
        $list = $this->product_model->get_datatables();

        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $products) {
            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = $products->ProductTitle;
            $row[] = $products->ProductMake;
            $row[] = '<i class="fa fa-inr"></i> '.$products->Price;
            /* $row[] = '<img class="img-responsive" style="width:50px" src="'.base_url().'assets/img/user_profile/'.$customers->pic.'">';*/
            if ($products->PackingType == 'Custom') {
                $quantity_perpack = '-';
                $quantity         = ($products->AvailQuantity + 0) . ' ' . $products->QuantityType;
            } else {
                $quantity_perpack = $products->PerPack . ' ' . $products->QuantityType;
                $quantity         = intval(($products->AvailQuantity + 0)/$products->PerPack) . ' ' . $products->PackingType;
                if(($products->AvailQuantity + 0)%$products->PerPack > 0){
                 $quantity .= '</br>'.intval(($products->AvailQuantity + 0)%$products->PerPack). ' ' . 'Loose';
                }

                if(intval(($products->AvailQuantity + 0)/$products->PerPack) <= $products->LeastQuantity){
                    $quantity = '<span style="color:red">'.$quantity.'</span>';
                }

            }

            $row[]  = $quantity_perpack;
            $row[]  = $quantity;
            $action = '<a class="btn btn-primary btn-mini" title="Edit Product" onclick=view_modal("' . base_url() . 'product/modal/edit_product_info/' . $products->P_Id . '") ><i class="fa fa-pencil-square-o"></i> </a>
         <a class="btn btn-info btn-mini" title="View Product" onclick=view_modal("' . base_url() . 'Vehicle/modal/view_product_info/' . $products->P_Id . '")><i class="fa fa-eye"></i> </a>

         <a class="btn btn-default btn-mini" title="Stock Adjustments" onclick=adjustment(this,"' . $products->P_Id . '")><i class="fa fa-wrench"></i></a>

         <a class="btn btn-danger btn-mini" title="Delete Product" onclick=del_product(this,"' . $products->P_Id . '")><i class="fa fa-trash-o"></i></a>


         ';

            $row[] = $action;
            // $row[] = $customers->country;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->product_model->count_all(),
            "recordsFiltered" => $this->product_model->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function add_product_info()
    {
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $data['hsn_codes'] = $this->db->where('UserId',$_SESSION['admin_id'])->get('hsn_codes')->result_array();
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('add_product_info',$data);
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }

    public function print_avail_stock(){

        $data['stock'] = $this->db->where('AvailQuantity >', 0)->get('product_info')->result_array();
        $this->load->view('stock_print',$data);
    }

    public function add_product_info_ajax()
    {
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $PostData = $this->input->post();
            $this->form_validation->set_rules('ProductTitle', 'Product Title', 'required|is_unique[product_info.ProductTitle]', array('is_unique' => 'This %s is already exists.'));
            $this->form_validation->set_rules('ProductCode', 'Product Code', 'is_unique[product_info.ProductCode]', array('is_unique' => 'This %s is already exists.'));

            if ($this->form_validation->run() == false) {
                $error = $this->form_validation->error_array();
                foreach ($error as $key => $value) {
                    $error = $value;
                }

                $data = array(
                    'result'  => 'danger',
                    'message' => $error,
                    'title'   => 'Error',
                );
                echo json_encode($data);
                exit;
            } else {
                $PostData['UserId'] = $_SESSION['admin_id'];
                $PostData['CreatedOn'] = date('Y-m-d H:i:s');
                if ($this->db->insert('product_info', $PostData)) {
                    $data = array(
                        'result'  => 'success',
                        'message' => 'Details added successfully!',
                        'title'   => 'Successfull',
                    );
                    echo json_encode($data);
                    exit;
                } else {
                    $data = array(
                        'result'  => 'danger',
                        'message' => 'Unable to add details!',
                        'title'   => 'Error',
                    );
                    echo json_encode($data);
                    exit;
                }

            }
        } else {
            header('location: ' . base_url());
        }
    }

    public function del_product()
    {
        header('Content-Type: application/json');
        $da = array('IsDeleted' => 1);
        if ($this->db->where('P_Id', $_POST['id'])->update('product_info', $da)) {
            $data = array(
                'result'  => 'success',
                'message' => 'Successfully Deleted!',
                'title'   => 'Successfull',
            );
        } else {
            $data = array(
                'result'  => 'danger',
                'message' => 'Unable to delete product!',
                'title'   => 'Error',
            );
        }
        echo json_encode($data);
    }

    //Modal Box data here
    public function modal($page, $parm = "")
    {
		
        $data['parm'] = $parm;
		
        return $this->load->view($page, $data);
    }

    public function edit_product_info_ajax()
    {
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $PostData = $this->input->post();
            $p_id     = $PostData['P_Id'];

            $product = $this->db->query("SELECT * FROM product_info WHERE P_Id = " . $p_id)->row_array();
            if ($this->input->post('ProductTitle') != $product['ProductTitle']) {
                $is_unique = "|is_unique[product_info.ProductTitle], array('is_unique' => 'This %s already exists.')";
            } else {
                $is_unique = '';
            }

            if ($this->input->post('ProductCode') != $product['ProductCode']) {
                $is_unique_code = "is_unique[product_info.ProductCode], array('is_unique' => 'This %s already exists.')";
            } else {
                $is_unique_code = '';
            }

            $this->form_validation->set_rules('ProductTitle', 'Product Title', "required" . $is_unique);
            $this->form_validation->set_rules('ProductCode', 'Product Code',  $is_unique_code);
            if ($this->form_validation->run() == false) {
                $error = $this->form_validation->error_array();

                foreach ($error as $key => $value) {
                    $error = $value;
                }
                $data = array(
                    'result'  => 'danger',
                    'message' => $error,
                    'title'   => 'Error',
                );
                echo json_encode($data);
                exit;
            } else {
                unset($PostData['P_Id']);
                $this->db->where('P_Id', $p_id);
                if ($this->db->update('product_info', $PostData)) {
                    $data = array(
                        'result'  => 'success',
                        'message' => 'Details updated Successfully!',
                        'title'   => 'Successfull',
                    );
                    echo json_encode($data);
                    exit;
                } else {
                    $data = array(
                        'result'  => 'danger',
                        'message' => 'Unable to updated Details!',
                        'title'   => 'Error',
                    );
                    echo json_encode($data);
                    exit;
                }
            }
        } else {
            header('location: ' . base_url());
        }
    }

    public function add_products()
    {
        $data = array();
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $data['products'] = $this->db->where(array('IsDeleted'=>'0','UserId'=>$_SESSION['admin_id']))->get('product_info')->result_array();
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('add_stock_products', $data);
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }

    public function add_stock_products()
    {
        if ($this->session->userdata('admin_id')) {
            $PostData = $this->input->post();
            $this->form_validation->set_rules('PurchasedOn', 'purchased date', 'required');
            $this->form_validation->set_rules('BillBy', 'billing by', 'required');
            $this->form_validation->set_rules('SubTotal', 'sub Total', 'required');
            $this->form_validation->set_rules('Total', 'net amount', 'required');
            $this->form_validation->set_rules('Tax_1_Amount', 'Centrel GST', 'required');
             $this->form_validation->set_rules('Tax_2_Amount', 'State GST', 'required');

            $this->form_validation->set_rules('book_0_P_Id', 'product', 'required');
            $this->form_validation->set_rules('book_0_BP_Price', 'product price', 'required');
            $this->form_validation->set_rules('Total', 'total', 'required');

            if (isset($PostData['BillId']) && !empty($PostData['BillId'])) {
                $original = $this->db->query("SELECT BillNo FROM buyed_product_bill WHERE BillId = " . $PostData['BillId'])->row()->BillNo;
                if ($PostData['BillNo'] != $original) {
                    $this->form_validation->set_rules('BillNo', 'bill no', 'required|is_unique[buyed_product_bill.BillNo]', array('is_unique' => 'This %s is already exists.'));
                } else {
                    $is_unique_engine = '';
                }
            } else {
                $this->form_validation->set_rules('BillNo', 'bill no', 'required|is_unique[buyed_product_bill.BillNo]', array('is_unique' => 'This %s is already exists.'));
            }

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
				
                $PostData['CreatedOn'] = date('Y-m-d H:i:s');
                $bill                  = array(
                    'BillNo'      => $PostData['BillNo'],
                    'BillBy'      => $PostData['BillBy'],
                    'PurchasedOn' => date('Y-m-d H:i:s', strtotime($PostData['PurchasedOn'])),
                    'SubTotal'    => $PostData['SubTotal'],
                    'Tax_1_Amount'    => $PostData['Tax_1_Amount'],
                    'Tax_2_Amount'    => $PostData['Tax_2_Amount'],
                    'Tax_1'       => $PostData['Tax_1'],
                    'Tax_2'       => $PostData['Tax_2'],
                    'Total'       => $PostData['Total'],
                    'CreatedOn'   => $PostData['CreatedOn'],
                    'UserId'      => $this->session->userdata('admin_id')
                );
				
                if (isset($PostData['BillId']) && !empty($PostData['BillId'])) {
                    if ($this->db->where('BillId', $PostData['BillId'])->update('buyed_product_bill', $bill)) {
                        $select_data = $this->db->where('BillId', $PostData['BillId'])->get('buyed_product')->result_array();
                        foreach ($select_data as $key => $value) {
                            $this->db->query("UPDATE product_info SET AvailQuantity = AvailQuantity - ('" . $value['BP_Qunatity_Total'] . "') WHERE P_Id = '" . $value['P_Id'] . "'");
                        }
                        $this->db->where('BillId', $PostData['BillId'])->delete('buyed_product');
                        $BillId = $PostData['BillId'];
                        for ($i = 0; $i <= $PostData['item_count']; $i++) {
                            if (isset($PostData['book_' . $i . '_P_Id'])) {
                                $bill_product = array(
                                    'BillId'      => $BillId,
                                    'P_Id'        => $PostData['book_' . $i . '_P_Id'],
                                    'BP_Price'    => $PostData['book_' . $i . '_BP_Price'],
                                    'BP_Qunatity' => $PostData['book_' . $i . '_BP_Qunatity'],
                                    'BP_Qunatity_Total' => $PostData['book_' . $i . '_BP_Qunatity_Total'],
                                    'BP_Per_Pack' => $PostData['book_' . $i . '_BP_Per_Pack'],
                                    'BP_Discount' => $PostData['book_' . $i . '_BP_Discount'],
                                    'BP_Total'    => $PostData['book_' . $i . '_BP_Total'],
                                );
                                $this->db->insert('buyed_product', $bill_product);
                                $this->db->query("UPDATE product_info SET AvailQuantity = AvailQuantity + ('" . $PostData['book_' . $i . '_BP_Qunatity_Total'] . "') WHERE P_Id = '" . $PostData['book_' . $i . '_P_Id'] . "'");
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
                    if ($this->db->insert('buyed_product_bill', $bill)) {
                        $BillId = $this->db->insert_id();
                        for ($i = 0; $i <= $PostData['item_count']; $i++) {
                            if (isset($PostData['book_' . $i . '_P_Id'])) {
                                $bill_product = array(
                                    'BillId'      => $BillId,
                                    'P_Id'        => $PostData['book_' . $i . '_P_Id'],
                                    'BP_Price'    => $PostData['book_' . $i . '_BP_Price'],
                                    'BP_Qunatity' => $PostData['book_' . $i . '_BP_Qunatity'],
                                    'BP_Qunatity_Total' => $PostData['book_' . $i . '_BP_Qunatity_Total'],
                                    'BP_Per_Pack' => $PostData['book_' . $i . '_BP_Per_Pack'],
                                    'BP_Discount' => $PostData['book_' . $i . '_BP_Discount'],
                                    'BP_Total'    => $PostData['book_' . $i . '_BP_Total'],
                                );
                                $this->db->insert('buyed_product', $bill_product);
                                $this->db->query("UPDATE product_info SET AvailQuantity = AvailQuantity + '" . $PostData['book_' . $i . '_BP_Qunatity_Total'] . "' WHERE P_Id = '" . $PostData['book_' . $i . '_P_Id'] . "'");
                            }
                        }
						$left_info = array(
							'ledger_type'   =>  $_POST['ledger_type'],
							'bill_id'       =>  $BillId,
							'total_amount'  =>  $_POST['Total'] ? $_POST['Total']: "",
							'amount_paid'   =>  $_POST['Amount_paid'] ? $_POST['Amount_paid'] : "",
							'balance_left'  =>  $_POST['Amount_left'] ? $_POST['Amount_left'] : "",
							'payment_type'  =>  $_POST['payment_type'] ? $_POST['payment_type'] : "",
							'cheque_number' =>  isset($_POST['payment_type']) ? $_POST['payment_type'] : "" ,
							'modified_on'   =>  date('Y-m-d H:i:s'),
							'created_on'    =>  date('Y-m-d H:i:s'),
							'userId'        =>  $_SESSION['admin_id'],
							);
							
							$this->db->insert('ledger', $left_info);
						
							$data = array(
                            'result'  => 'success',
                            'message' => 'Details added successfully!',
                            'title'   => 'Successfull',
                        );
                        echo json_encode($data);
                        exit;

                    } else {
                        $data = array(
                            'result'  => 'danger',
                            'message' => 'Unable to add details!',
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

    public function manage_stock()
    {
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('manage_buy_product');
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }

    public function product_list_ajax()
    {
        $list = $this->product_list->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $bill) {
            $no++;
            $row   = array();
            $row[] = $no;
            /* $row[] = '<Strong>Model: </strong>' . $customers->model . '<br><Strong>Maker: </strong>' . $customers->make . '<br><Strong>Power: </strong>' . $customers->horse_power;*/
            $row[]  = $bill->BillNo;
            $row[]  = $bill->BillBy;
            $row[]  = '(<i class="fa fa-inr"></i>) '.$bill->SubTotal;
            $row[]  = $bill->Tax_1 . ': (<i class="fa fa-inr"></i>) '.$bill->Tax_1_Amount.'<br>' . $bill->Tax_2.': (<i class="fa fa-inr"></i>) '.$bill->Tax_2_Amount;
            $row[]  = '(<i class="fa fa-inr"></i>) '.$bill->Total;
            $row[]  = date('d-M-Y', strtotime($bill->PurchasedOn));
            $action = '';

            $action .= '<a class="btn btn-info btn-mini" onclick=view_modal("' . base_url() . 'product/modal/view_purchased_bill/' . $bill->BillId . '")><i class="fa fa-eye"></i> </a>
            <a class="btn btn-primary btn-mini" href="' . base_url() . 'product/edit_products/' . $bill->BillId . '")><i class="fa fa-pencil-square-o"></i></a>';

            $action .= '
             <button class="btn btn-danger btn-mini" onclick=del_stock_product(this,"' . $bill->BillId . '")><i class="fa fa-trash-o"></i></button>';
			
			$action .= '<a class="btn btn-info btn-mini" onclick=view_modal("' . base_url() . 'product/modal/view_balance_details/' . $bill->BillId . '")><i class="fa fa-eye"></i> </a>';
            

            $row[] = $action;
            // $row[] = $customers->country;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->product_list->count_all(),
            "recordsFiltered" => $this->product_list->count_filtered(),
            "data"            => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function edit_products($billid)
    {
        $data = array();
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $data['bill']          = $this->db->where(array('IsDeleted' => '0', 'BillId' => $billid))->get('buyed_product_bill')->row_array();
            $data['bill_products'] = $this->db->where(array('BillId' => $billid))->get('buyed_product')->result_array();
            $data['products']      = $this->db->where(array('IsDeleted'=>'0','UserId'=>$_SESSION['admin_id']))->get('product_info')->result_array();
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('add_stock_products', $data);
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }

    public function view_products($billid)
    {die();
        $data = array();
        $auth = checkAdminLogin();
        if ($auth == 1) {
            $data['bill']          = $this->db->where(array('IsDeleted' => '0', 'BillId' => $billid))->get('buyed_product_bill')->row_array();
            $data['bill_products'] = $this->db->where(array('BillId' => $billid))->get('buyed_product')->result_array();
            $data['products']      = $this->db->get('product_info')->result_array();
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('view_purchased_bill', $data);
            $this->load->view('footer');
        } else {
            $this->load->view('login');
        }
    }
    public function del_stock_product()
    {
        header('Content-Type: application/json');
        $da = array('IsDeleted' => 1);
        if ($this->db->where('BillId', $_POST['id'])->update('buyed_product_bill', $da)) {
            $products = $this->db->where('BillId', $_POST['id'])->get('buyed_product')->result_array();

            foreach ($products as $key => $value) {
                $this->db->query("UPDATE product_info SET AvailQuantity = AvailQuantity - '" . $value['BP_Qunatity_Total'] . "' WHERE P_Id = '" . $value['P_Id'] . "'");
            }

            $data = array(
                'result'  => 'success',
                'message' => 'Successfully Deleted.',
                'title'   => 'Successfull',
            );
        } else {
            $data = array(
                'result'  => 'danger',
                'message' => 'Unable to delete this stock bill.',
                'title'   => 'Error',
            );
        }
        echo json_encode($data);
    }


     public function adjust_stock()
    {
        header('Content-Type: application/json');
        $da = array('IsDeleted' => 1);
        if ($_POST) {
            $product = $this->db->where('P_Id', $_POST['ProductId'])->get('product_info')->row_array();
            $qunt = ($_POST['AdjustmentPack']*$product['PerPack'])+$_POST['AdjustmentLoose'];
/*print_r($qunt);die();*/
                $this->db->query("UPDATE product_info SET AvailQuantity = AvailQuantity + '" . $qunt. "' WHERE P_Id = '" . $_POST['ProductId'] . "'");
           

            $data = array(
                'result'  => 'success',
                'message' => 'Stock successfully updated.',
                'title'   => 'Successfull',
            );
        } else {
            $data = array(
                'result'  => 'danger',
                'message' => 'Unable to do adjustments.',
                'title'   => 'Error',
            );
        }
        echo json_encode($data);
    }

}
