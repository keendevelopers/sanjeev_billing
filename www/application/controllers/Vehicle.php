<?php 
error_reporting(0);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vehicle extends CI_Controller {
function __construct()
{
parent::__construct();
$this->load->model(array('admin_model','Vehicle_list'));
$this->load->model(array('Vehicle_model'));
}  

// Admin Login
public function index() 
{
   $auth = checkAdminLogin();
            if( $auth == 1)
            {
    $data = array();
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('manage_vehicle');
    $this->load->view('footer');
   }else{
    header('Location: '.base_url());
   }
}

 public function vehicle_info_list()
   {
      $list = $this->Vehicle_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $customers) {
         $no++;
         $row = array();
         $row[] = $no;
         $row[] = $customers->model;
         $row[] = $customers->make;
        /* $row[] = '<img class="img-responsive" style="width:50px" src="'.base_url().'assets/img/user_profile/'.$customers->pic.'">';*/
         $row[] = $customers->fuel;
         $row[] = $customers->horse_power;
        $row[] = $customers->in_stock.' Units';
         $action = '<a class="btn btn-primary btn-mini" onclick=view_modal("'.base_url().'Vehicle/modal/edit_vehicle_info/'.$customers->v_id.'") ><i class="fa fa-pencil-square-o"></i> Edit</a>
         <a class="btn btn-info btn-mini" onclick=view_modal("'.base_url().'Vehicle/modal/view_vehicle_info/'.$customers->v_id.'")><i class="fa fa-eye"></i> View</a>
         <button class="btn btn-default waves-light btn-mini" onclick="show_stock(this)" data-id="'.$customers->v_id.'"><i class="fa fa-share-square-o"></i> Stock Vehicles</button>';

         $action .= '<button class="btn btn-danger btn-mini" onclick=del_customer(this,"'.$customers->v_id.'")><i class="fa fa-trash-o"></i> Delete</button>';
         $row[] = $action;
            // $row[] = $customers->country;
         $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Vehicle_model->count_all(),
                        "recordsFiltered" => $this->Vehicle_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

public function add_product_info(){
    $auth = checkAdminLogin();
            if( $auth == 1)
            {
                $this->load->view('header');
                $this->load->view('sidebar');
                $this->load->view('add_product_info');
                $this->load->view('footer');
            }
            else
            {
                $this->load->view('login');
            }
}

public function add_vehicle_info_ajax(){
  $auth = checkAdminLogin();
            if( $auth == 1)
            {

              $PostData = $this->input->post();
        $this->form_validation->set_rules('model', 'Model', 'required|is_unique[vehicle_info.model]', array('is_unique' => 'This %s is already exists.'));
    
    if ($this->form_validation->run() == false)
        {
          $error = $this->form_validation->error_array();
            $data = array(
            'result' => 'danger',
            'message' => $error['model'],
            'title' => 'Error'
         );
           echo json_encode($data);
            exit;
        }
        else
        {

 $data = array(
      'model' => $_POST['model']? $_POST['model']:'',
      'make' => $_POST['make']? $_POST['make']:'',
      'horse_power' => $_POST['horse_power']? $_POST['horse_power']:'',
      'fuel' => $_POST['fuel']? $_POST['fuel']:'',
      'cylinder' => $_POST['cylinder']? $_POST['cylinder']:'',
      'seating_cap' => $_POST['seating']? $_POST['seating']:'',
      'weight' => $_POST['weight']? $_POST['weight']:'',
      'body_type' => $_POST['body']? $_POST['body']:'',
      /*'pic' => $file==''? '':$file,*/
      );

  if($this->db->insert('vehicle_info',$data)){
         $data = array(
            'result' => 'success',
            'message' => 'Details updated Successfully!',
            'title' => 'Successfull'
         );
   echo json_encode($data);
   exit;
      }else{
         $data = array(
            'result' => 'danger',
            'message' => 'Unable to updated Details!',
            'title' => 'Error'
         );
   echo json_encode($data);
   exit;
      }

    }
}else{
    header('location: '.base_url());
}
}


public function edit_vehicle_info_ajax(){
 $auth = checkAdminLogin();
            if( $auth == 1)
            {

$veh_id = $_POST['v_id'];

 $original_value = $this->db->query("SELECT model FROM vehicle_info WHERE v_id = ".$veh_id)->row()->model ;
    if($this->input->post('model') != $original_value) {
       $is_unique =  "|is_unique[vehicle_info.model], array('is_unique' => 'This %s already exists.')";
    } else {
       $is_unique =  '';
    }

   $PostData = $this->input->post(); 
   
   $this->form_validation->set_rules('model', 'Model', "required".$is_unique);
 if ($this->form_validation->run() == false)
        {
          $error = $this->form_validation->error_array();
          $data = array(
            'result' => 'danger',
            'message' => $error['model'],
            'title' => 'Error'
         );
           echo json_encode($data);
            exit;
        }
        else
        {
 $data = array(
      'model' => $_POST['model']? $_POST['model']:'',
      'make' => $_POST['make']? $_POST['make']:'',
      'horse_power' => $_POST['horse_power']? $_POST['horse_power']:'',
      'fuel' => $_POST['fuel']? $_POST['fuel']:'',
      'cylinder' => $_POST['cylinder']? $_POST['cylinder']:'',
      'seating_cap' => $_POST['seating']? $_POST['seating']:'',
      'weight' => $_POST['weight']? $_POST['weight']:'',
      'body_type' => $_POST['body']? $_POST['body']:'',
      /*'pic' => $file==''? '':$file,*/
      );
$this->db->where('v_id',$_POST['v_id']);
  if($this->db->update('vehicle_info',$data)){
         $data = array(
            'result' => 'success',
            'message' => 'Details updated Successfully!',
            'title' => 'Successfull'
         );
   echo json_encode($data);
   exit;
      }else{
         $data = array(
            'result' => 'danger',
            'message' => 'Unable to updated Details!',
            'title' => 'Error'
         );
   echo json_encode($data);
   exit;
      }

    }
}else{
    header('location: '.base_url());
}
}

public function del_vehicle(){
header('Content-Type: application/json');
    $da = array('is_deleted'=>1);
        if($this->db->where('v_id',$_POST['id'])->update('vehicle_info',$da)){
            $data = array(
               'result' => 'success',
               'message' => 'Successfully Deleted!',
               'title' => 'Successfull'
               );
        }else{
            $data = array(
               'result' => 'danger',
               'message' => 'Unable to Delete Vehicle!',
               'title' => 'Error'
               );
        }
        echo json_encode($data);
}

 //Modal Box data here
    public function modal($page,$parm="")
    {
       $data['parm'] = $parm;
       return  $this->load->view($page,$data);
    }

public function vehicle_list(){
    $auth = checkAdminLogin();
            if( $auth == 1)
            {
                $this->load->view('header');
                $this->load->view('sidebar');
                $this->load->view('manage_buy_vehicle');
                $this->load->view('footer');
            }
            else
            {
                $this->load->view('login');
            }
}

public function add_vehicle(){
   $data = array();
  $data['vehicles'] = $this->db->where('is_deleted', 0)->get('vehicle_info')->result_array();
    $auth = checkAdminLogin();
            if( $auth == 1)
            {
                $this->load->view('header');
                $this->load->view('sidebar');
                $this->load->view('add_vehicle',$data);
                $this->load->view('footer');
            }
            else
            {
                $this->load->view('login');
            }
}

public function get_vehicle_info($value){
 header('Content-Type: application/json');
   if($this->session->userdata('admin_id'))
   {
     $qry = $this->db->where('v_id',$value)->get('vehicle_info')->row_array();
     echo json_encode($qry);
   }
}

public function get_vehicle_fulldetails($value){
 header('Content-Type: application/json');
   if($this->session->userdata('admin_id'))
   {
     $qry = $this->db->where('sv_id',$value)
     ->join('vehicle_info','vehicle_info.v_id = stock_vehicles.ref_v_id')
     ->get('stock_vehicles')
     ->row_array();
     echo json_encode($qry);
   }
}


public function add_new_vehicle(){
  if($this->session->userdata('admin_id'))
   {
       $PostData = $this->input->post();
        $this->form_validation->set_rules('chassis', 'Chassis no', 'required|is_unique[stock_vehicles.chassis_no]', array('is_unique' => 'This %s is already exists.'));
    
     $this->form_validation->set_rules('engine_no', 'Engine no', 'required|is_unique[stock_vehicles.engine_no]', array('is_unique' => 'This %s is already exists.'));

    if ($this->form_validation->run() == false)
        {
          $error = $this->form_validation->error_array();
          $sError = '';
          foreach ($error as $key => $value) {
           $sError = $value;
          }
            $data = array(
            'result' => 'danger',
            'message' => $sError,
            'title' => 'Error'
         );
           echo json_encode($data);
            exit;
        }
        else
        {
$data = array(
      'ref_v_id'=>$_POST['vehicle'],
      'engine_no'=> $_POST['engine_no']? $_POST['engine_no']:'',
      'color'=> $_POST['color']? $_POST['color']:'',
      'chassis_no'=> $_POST['chassis']? $_POST['chassis']:'',
      'key_no'=> $_POST['key_no']? $_POST['key_no']:'',
      'battery_no'=> $_POST['battery_no']? $_POST['battery_no']:'',
      'sb_no'=> $_POST['sb_no']? $_POST['sb_no']:'',
      'manufacture'=> $_POST['manufacturer']? $_POST['manufacturer']:'',
      'date' => $_POST['date']? date('Y-m-d',strtotime($_POST['date'])):'0000-00-00 00:00:00',
);
      if($this->db->insert('stock_vehicles',$data))
      {
  $this->db->query("UPDATE vehicle_info SET in_stock= in_stock + 1 WHERE v_id= '".$_POST['vehicle']."'");
         $data = array(
               'result' => 'success',
               'message' => 'Successfully added Vehicle',
               'title' => 'Success'
            );
      }
      else
      {
         $data = array(
               'result' => 'danger',
               'message' => 'Unable to add Details!',
               'title' => 'Error'
            );
      }
      echo json_encode($data);
    }
   }else{
    header('location: '.base_url());
}
}

public function vehicle_list_ajax()
   {
      $list = $this->Vehicle_list->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $customers) {
         $no++;
         $row = array();
         $row[] = $no;
         $row[] = '<Strong>Model: </strong>'.$customers->model.'<br><Strong>Maker: </strong>'.$customers->make.'<br><Strong>Power: </strong>'.$customers->horse_power;

         $row[] = $customers->chassis_no;
         $row[] = $customers->engine_no;
         $row[] = $customers->manufacture;
         $row[] = $customers->color;
         $row[] = date('d-M-Y',strtotime($customers->date));
         $action = '';
        
         if($customers->is_sold == 0)
         {
            $action .= '<button class="btn btn-primary btn-mini" onclick=view_modal("'.base_url().'Vehicle/modal/edit_vehicle_popup/'.$customers->sv_id.'")><i class="fa fa-pencil-square-o"></i> Edit</button>';

             $action .= '
             <button class="btn btn-danger btn-mini" onclick=del_stock_vehicle(this,"'.$customers->sv_id.'")><i class="fa fa-trash-o"></i> Delete</button>';

         }else{
          $action .= '<button class="btn btn-primary btn-mini" onclick=view_modal("'.base_url().'Vehicle/modal/edit_vehicle_popup/'.$customers->sv_id.'")><i class="fa fa-pencil-square-o"></i> Edit</button>';
          $action .= '<button class="btn btn-success btn-mini")><i class="fa fa-shopping-cart"></i> Sold Out!</button>';
         }
        
         $row[] = $action;
            // $row[] = $customers->country;
         $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Vehicle_list->count_all(),
                        "recordsFiltered" => $this->Vehicle_list->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


public function vehicle_edit_ajax(){

  if($this->session->userdata('admin_id'))
   {

$sveh_id = $_POST['sv_id'];

 $original_engine = $this->db->query("SELECT engine_no FROM stock_vehicles WHERE sv_id = ".$sveh_id)->row()->engine_no ;
    if($this->input->post('engine_no') != $original_engine) {
       $is_unique_engine =  "|is_unique[stock_vehicles.engine_no], array('is_unique' => 'This %s already exists.')";
    } else {
       $is_unique_engine =  '';
    }

 $original_chassis = $this->db->query("SELECT chassis_no FROM stock_vehicles WHERE sv_id = ".$sveh_id)->row()->chassis_no ;
    if($this->input->post('chassis') != $original_chassis) {
       $is_unique_chassis =  "|is_unique[stock_vehicles.chassis_no], array('is_unique' => 'This %s already exists.')";
    } else {
       $is_unique_chassis =  '';
    }

   $PostData = $this->input->post(); 
   
    $this->form_validation->set_rules('chassis', 'Chassis no', "required".$is_unique_chassis);
    $this->form_validation->set_rules('engine_no', 'Engine no', "required".$is_unique_engine);
 if ($this->form_validation->run() == false)
        {
          $error = $this->form_validation->error_array();
          $sError = '';
          foreach ($error as $key => $value) {
           $sError = $value;
          }
            $data = array(
            'result' => 'danger',
            'message' => $sError,
            'title' => 'Error'
         );
           echo json_encode($data);
            exit;
        }
        else
        {

$data = array(
      'ref_v_id'=>$_POST['vehicle'],
      'engine_no'=> $_POST['engine_no']? $_POST['engine_no']:'',
      'color'=> $_POST['color']? $_POST['color']:'',
      'chassis_no'=> $_POST['chassis']? $_POST['chassis']:'',
      'key_no'=> $_POST['key_no']? $_POST['key_no']:'',
      'battery_no'=> $_POST['battery_no']? $_POST['battery_no']:'',
      'sb_no'=> $_POST['sb_no']? $_POST['sb_no']:'',
      'manufacture'=> $_POST['manufacturer']? $_POST['manufacturer']:'',
      'date' => $_POST['date']? date('Y-m-d',strtotime($_POST['date'])):'0000-00-00 00:00:00',
);
$this->db->where('sv_id',$_POST['sv_id']);
      if($this->db->update('stock_vehicles',$data))
      {
        if($_POST['ref_v_id'] !== $_POST['vehicle']){
$this->db->query("UPDATE vehicle_info SET in_stock= in_stock - 1 WHERE v_id= '".$_POST['ref_v_id']."'");
  $this->db->query("UPDATE vehicle_info SET in_stock= in_stock + 1 WHERE v_id= '".$_POST['vehicle']."'");
  }
         $data = array(
               'result' => 'success',
               'message' => 'Successfully Update Vehicle',
               'title' => 'Success'
            );
      }
      else
      {
         $data = array(
               'result' => 'danger',
               'message' => 'Unable to Update Details!',
               'title' => 'Error'
            );
      }
      echo json_encode($data);
   }
}
}

public function sell_vehicle_ajex(){
   header('Content-Type: application/json');
  if($this->session->userdata('admin_id'))
   {

       $this->form_validation->set_rules('sv_id', 'Chassis no', 'required'); 
          $this->form_validation->set_rules('v_id', 'Vehicle', 'required'); 
          $this->form_validation->set_rules('invoice_date', 'Invoice date', 'required'); 
          $this->form_validation->set_rules('hirer', 'Customer name', 'required');
          $this->form_validation->set_rules('hirer_address', 'Address', 'required');
          $this->form_validation->set_rules('amount', 'Amount', 'required');
          $this->form_validation->set_rules('total_amount', 'Total amount', 'required');
          $this->form_validation->set_rules('sb_no', 'service book', 'required');
          $this->form_validation->set_rules('battery_no', 'battery no', 'required');

         if ($this->form_validation->run() == FALSE) { 
 $error =  $this->form_validation->error_array();

         $data = array(
               'result' => 'validation',
               'message' => $error,
               'title' => 'Error'
            );
          echo json_encode($data);
          exit;
         } 

$data = array(
  'ref_v_id' => $_POST['v_id'],
  'ref_sv_id' => $_POST['sv_id'],
  'cust_name' => $_POST['hirer'],
  'care_type' => $_POST['type'],
  'f_name' => $_POST['f_name'],
  'address' => $_POST['hirer_address'],
  'StateCode' => $_POST['StateCode'],
  'mobile' => $_POST['mobile'],
  'hpa' => $_POST['hpa'],
  'inv_date' => date('y-m-d',strtotime($_POST['invoice_date'])),
  'sub_total' => $_POST['amount'],
  'tax' => $_POST['tax_amount'],
  'total' => $_POST['total_amount'],
  'tax_type' => $_POST['tax'],
  'surcharge_per' => $_POST['surcharge_per'],
  'surcharge_amt' => $_POST['surcharge_amt'],
  'OfferType' => $_POST['OfferType'],
  'OfferAmount' => $_POST['OfferAmount'],
  'OfferTitle' => $_POST['OfferTitle'],

);

$this->db->where('sv_id',$_POST['sv_id'])->update('stock_vehicles',array('sb_no'=>$_POST['sb_no'],'battery_no'=>$_POST['battery_no']));

      if($this->db->insert('invoice',$data))
      {
        $last = $this->db->insert_id();
  $this->db->query("UPDATE vehicle_info SET in_stock= in_stock - 1 WHERE v_id= '".$_POST['v_id']."'");
   $this->db->query("UPDATE stock_vehicles SET is_sold = 1 WHERE sv_id= '".$_POST['sv_id']."'");
         $data = array(
               'result' => 'success',
               'message' => 'Successfully added Invoice',
               'title' => 'Success',
               'inv_id' => $last
            );
      }
      else
      {
         $data = array(
               'result' => 'danger',
               'message' => 'Unable to add Invoice!',
               'title' => 'Error'
            );
      }
      echo json_encode($data);
   }
}

public function sell_vehicle_update_ajex(){
  if($this->session->userdata('admin_id'))
   {
      
          $this->form_validation->set_rules('sv_id', 'Chassis no', 'required'); 
          $this->form_validation->set_rules('v_id', 'Vehicle', 'required'); 
          $this->form_validation->set_rules('invoice_date', 'Invoice date', 'required'); 
          $this->form_validation->set_rules('hirer', 'Customer name', 'required');
          $this->form_validation->set_rules('hirer_address', 'Address', 'required');
          $this->form_validation->set_rules('amount', 'Amount', 'required');
          $this->form_validation->set_rules('total_amount', 'Total amount', 'required');
          $this->form_validation->set_rules('sb_no', 'service book', 'required');
          $this->form_validation->set_rules('battery_no', 'battery no', 'required');


         if ($this->form_validation->run() == FALSE) { 
 $error =  $this->form_validation->error_array();

         $data = array(
               'result' => 'validation',
               'message' => $error,
               'title' => 'Error'
            );
          echo json_encode($data);
          exit;
         } 

$data = array(
  'ref_v_id' => $_POST['v_id'],
  'ref_sv_id' => $_POST['sv_id'],
  'cust_name' => $_POST['hirer'],
  'care_type' => $_POST['type'],
  'f_name' => $_POST['f_name'],
  'address' => $_POST['hirer_address'],
  'StateCode' => $_POST['StateCode'],
  'mobile' => $_POST['mobile'],
  'hpa' => $_POST['hpa'],
  'inv_date' => date('y-m-d',strtotime($_POST['invoice_date'])),
  'sub_total' => $_POST['amount'],
  'tax' => $_POST['tax_amount'],
  'total' => $_POST['total_amount'],
  'tax_type' => $_POST['tax'],
   'surcharge_per' => $_POST['surcharge_per'],
  'surcharge_amt' => $_POST['surcharge_amt'],
   'OfferType' => $_POST['OfferType'],
  'OfferAmount' => $_POST['OfferAmount'],
  'OfferTitle' => $_POST['OfferTitle'],

);

$this->db->where('sv_id',$_POST['sv_id'])->update('stock_vehicles',array('sb_no'=>$_POST['sb_no'],'battery_no'=>$_POST['battery_no']));
      
      $this->db->where('inv_id',$_POST['invoice_id']);
      if($this->db->update('invoice',$data))
      {
       
        if($_POST['old_ref_sv_id'] !== $_POST['sv_id']){
    $this->db->query("UPDATE vehicle_info SET in_stock= in_stock + 1 WHERE v_id= '".$_POST['old_ref_v_id']."'");
    $this->db->query("UPDATE stock_vehicles SET is_sold = 0 WHERE sv_id= '".$_POST['old_ref_sv_id']."'");

    $this->db->query("UPDATE vehicle_info SET in_stock= in_stock - 1 WHERE v_id= '".$_POST['v_id']."'");
    $this->db->query("UPDATE stock_vehicles SET is_sold = 1 WHERE sv_id= '".$_POST['sv_id']."'");

        }

         $data = array(
               'result' => 'success',
               'message' => 'Successfully Update Invoice',
               'title' => 'Success',
               'inv_id' => $_POST['invoice_id']
            );
      }
      else
      {
         $data = array(
               'result' => 'danger',
               'message' => 'Unable to Update Invoice!',
               'title' => 'Error'
            );
      }
      echo json_encode($data);
   }
}

public function del_stock_vehicle(){
header('Content-Type: application/json');
  $da = array('is_deleted'=>1);
      if($this->db->where('sv_id',$_POST['id'])->update('stock_vehicles',$da)){
$v_id = $this->db->where('sv_id',$_POST['id'])->get('stock_vehicles')->row_array();

$this->db->query("UPDATE vehicle_info SET in_stock= in_stock - 1 WHERE v_id= '".$v_id['ref_v_id']."'");
        $data = array(
               'result' => 'success',
               'message' => 'Successfully Deleted!',
               'title' => 'Successfull'
               );
      }else{
        $data = array(
               'result' => 'danger',
               'message' => 'Unable to Delete Finance!',
               'title' => 'Error'
               );
      }
      echo json_encode($data);
}

public function get_chassis_no($v_id){
  header('Content-Type: application/json');
  $chassis = $this->db->select('sv_id,chassis_no')
  ->where('ref_v_id',$v_id)
  ->where('is_sold',0)
  ->where('is_deleted',0)
  ->get('stock_vehicles')
  ->result_array();
  echo json_encode($chassis);
}

}