<?php
class Admin_Model extends CI_Model
{
function __construct()
{
parent::__construct();
}
public function login($email,$password)
{
$dbpassword = $this->db_password($email);
if($dbpassword==$password)
{
$query = $this->db->query("SELECT * FROM admin WHERE admin_email = '".$email."' AND admin_password = '".$password."' ");
$row = $query->row();
if ($query->num_rows() > 0)
{
$array = array(
'admin_id' 		=> $row->admin_id,
); 
$this->session->set_userdata($array);
return $row;
} 
else 
{
return false;
}
}
else
{
return false;
}		
}

public function db_password($email)
{
$query = $this->db->query("SELECT admin_password FROM admin WHERE admin_email = '".$email."' ");
$row = $query->row('admin_password');
return $row;
}

public function admin_profile()
{
$query = $this->db->query("SELECT * FROM admin where admin_id = ".$_SESSION['admin_id']);		
return $query->row_array();
}

public function rec_list()
{
$query =$this->db->query("SELECT * from records");
return $query->result_array();
}

// Add Record  
public function addrecord($LINENO,$SERIALNUMBER1,$SERIALNUMBER2,$MANUFACTURER,$MODEL,$CALIBRE,$SIGNEDOUT,$IDNUMBER,$LICENSENUMBER,$SOLDTO,$COMMENTS,$DATESIGNEDOUT,$PURCHASEPRICE,$SELLINGPRICE,$SELLER,$SELLERID,$PINUMBER,$ASSIGNEDTO,$ASSIGNEDTOTEL,$ASSIGNEDTOEMAIL,$INVOICENUMBER,$ITEMTYPE,$ENTRY)
{
$data= array(
'LINENUMBER'	=> $LINENO,
'SERIALNUMBER1' => $SERIALNUMBER1,
'SERIALNUMBER2'	=> $SERIALNUMBER2,
'MANUFACTURER'	=> $MANUFACTURER,
'MODEL' => $MODEL,
'CALIBRE'	=> $CALIBRE,
'SIGNEDOUT'	=> $SIGNEDOUT,
'IDNUMBER'	=> $IDNUMBER,
'LICENSENUMBER' => $LICENSENUMBER,
'SOLDTO'	=> $SOLDTO,
'COMMENTS'	=> $COMMENTS,
'DATESIGNEDOUT' => $DATESIGNEDOUT,
'PURCHASEPRICE'	=> $PURCHASEPRICE,
'SELLINGPRICE'	=> $SELLINGPRICE,
'SELLER'	=> $SELLER,
'SELLERIDLICNO'	=> $SELLERID,
'PIPENUMBER'	=> $PINUMBER,
'ASSIGNEDTO' => $ASSIGNEDTO,
'ASSIGNEDTOTEL'	=> $ASSIGNEDTOTEL,
'ASSIGNEDTOEMAIL'	=> $ASSIGNEDTOEMAIL,
'INVOICENUMBER' => $INVOICENUMBER,
'ITEMTYPE'	=> $ITEMTYPE,
'EMPTY1'	=> $ENTRY,
);
$this->db->insert('records', $data);
if ($this->db->affected_rows() == '1')
{
return true;
}
else
{
return FALSE;
}
}

// Delete Record
public function rec_del($id,$tablename)
{
$this->db->where('ID', $id);
if($this->db->delete($tablename))
{
return true;
}
else
{
return false;
}
}

// Edit Record
public function editrecord($id)
{
$data['inv'] = $this->db->where(array('inv_id'=>$id,'is_cancled'=>'0'))->get('invoice')->row_array();
$data['inv_products'] = $this->db->where(array('inv_id'=>$id))->get('invoice_products')->result_array();
$data['products'] = $this->db->select('pi.*,hsn.*')
                            ->where('pi.IsDeleted', '0')
                            ->join('hsn_codes as hsn','hsn.HSN_No = pi.HSNCode','left')
                            ->get('product_info as pi')->result_array();
return $data;
}

public function editrecord_manual($id)
{
$query = $this->db->query("SELECT * FROM invoice where inv_id='".$id."'");		
return $query->row_array();
}

public function get_items($id)
{
$query = $this->db->query("SELECT * FROM invoice_products where p_inv_id='".$id."'");		
return $query->result_array();
}

public function get_items_manual($id)
{
$query = $this->db->query("SELECT * FROM invoice_products where p_inv_id='".$id."'");		
return $query->result_array();
}

// Update Record
public function updaterecord($LINENO,$SERIALNUMBER1,$SERIALNUMBER2,$MANUFACTURER,$MODEL,$CALIBRE,$SIGNEDOUT,$IDNUMBER,$LICENSENUMBER,$SOLDTO,$COMMENTS,$DATESIGNEDOUT,$PURCHASEPRICE,$SELLINGPRICE,$SELLER,$SELLERID,$PINUMBER,$ASSIGNEDTO,$ASSIGNEDTOTEL,$ASSIGNEDTOEMAIL,$INVOICENUMBER,$ITEMTYPE,$ENTRY,$obid)	
{
$data= array(
'LINENUMBER'	=> $LINENO,
'SERIALNUMBER1' => $SERIALNUMBER1,
'SERIALNUMBER2'	=> $SERIALNUMBER2,
'MANUFACTURER'	=> $MANUFACTURER,
'MODEL' => $MODEL,
'CALIBRE'	=> $CALIBRE,
'SIGNEDOUT'	=> $SIGNEDOUT,
'IDNUMBER'	=> $IDNUMBER,
'LICENSENUMBER' => $LICENSENUMBER,
'SOLDTO'	=> $SOLDTO,
'COMMENTS'	=> $COMMENTS,
'DATESIGNEDOUT' => $DATESIGNEDOUT,
'PURCHASEPRICE'	=> $PURCHASEPRICE,
'SELLINGPRICE'	=> $SELLINGPRICE,
'SELLER'	=> $SELLER,
'SELLERIDLICNO'	=> $SELLERID,
'PIPENUMBER'	=> $PINUMBER,
'ASSIGNEDTO' => $ASSIGNEDTO,
'ASSIGNEDTOTEL'	=> $ASSIGNEDTOTEL,
'ASSIGNEDTOEMAIL'	=> $ASSIGNEDTOEMAIL,
'INVOICENUMBER' => $INVOICENUMBER,
'ITEMTYPE'	=> $ITEMTYPE,
'EMPTY1'	=> $ENTRY,
);
$this->db->where('ID', $obid);
if($this->db->update('records', $data))
{
return true;
}
else
{
return false;
}	
}


// Fetch Search Results
public function fetchresults()
{
$input = $this->input->post();
$this->db->select('*');
$this->db->from('records');
if(isset($input['lineno']))
{
	$this->db->where('LINENUMBER LIKE "%'.$input["lineno"].'%"');
}
if(isset($input['serailno']))
{
	$this->db->where('SERIALNUMBER1 LIKE "%'.$input["serailno"].'%"');
}
if(isset($input['manufacturer']))
{
	$this->db->where('MANUFACTURER LIKE "%'.$input["manufacturer"].'%"');
}
if(isset($input['model']))
{
$this->db->where('MODEL LIKE "%'.$input["model"].'%"');
}

$query = $this->db->get();
//return $this->output->enable_profiler(TRUE);
return $query->result_array();
}

public function insertCSV($data)
{
$this->db->insert('records', $data);
return TRUE;
}

// For Dashboard Counters
public function total_invoices()
{
$query = $this->db->query("SELECT * FROM invoice WHERE is_cancled = 0 and UserId =".$_SESSION['admin_id']);
return $query->num_rows();
}


// For Dashboard Counters
public function current_month_invoices()
{
$query = $this->db->query("SELECT * FROM invoice WHERE is_cancled = 0 AND inv_date > DATE_SUB(NOW(), INTERVAL 1 MONTH);");
return $query->num_rows();
}

// For Dashboard Counters
public function today_invoices()
{
$query = $this->db->query("SELECT * FROM invoice WHERE  is_cancled = 0 AND DATE(inv_date) = CURDATE()");
return $query->num_rows();
}

// For Dashboard Counters
public function cancelled_invoices()
{
$query = $this->db->query("SELECT * FROM invoice where is_cancled='1' and UserId =".$_SESSION['admin_id']);
return $query->num_rows();
}

public function moved_invoices()
{
$query = $this->db->query("SELECT * FROM manual_invoice where is_moved='1'");
return $query->num_rows();
}





public function validate_password($field_value)

{

$adminId = $this->session->userdata('admin_id');

//echo "SELECT * FROM admin where admin_id='".$adminId."' and admin_password='".$field_value."'";

$query = $this->db->query("SELECT * FROM admin where admin_id='".$adminId."' and admin_password='".$field_value."'");		

if($query->num_rows()>0)

{

return true;

}

else

{

return false;

}

}



// Update Admin Personal Details

public function updatePersonalDetails($id,$name,$email)

{

$data= array(



'admin_uname'	=> $name,

'admin_email'	=> $email

);

$this->db->where('admin_id', $id);

if($this->db->update('admin', $data)){

return true;

}

else

{



return false;

}			

}

// Update Password

public function update_password()

{

$adminId = $this->session->userdata('admin_id');

$input = $this->input->post();

$data = array(

'admin_password' 	=> $input['new_password']

);

$sql = $this->db->where('admin_id', $adminId)->update('admin', $data);

if($sql)

{

return TRUE;

}

else

{



return FALSE;

}



}

//Update Profile Pic

public function update_book($pic)

{

$adminId = $this->session->userdata('admin_id');



$data= array(

'admin_pic'	=> $pic,

);

//$sql="UPDATE admin SET admin_pic='".$pic."' where admin_id='".$adminId."'";

$sql = $this->db->where('admin_id', $adminId)->update('admin', $data);

if($sql)

{

return true;

}

else

{

return false;

}

}



}
?>