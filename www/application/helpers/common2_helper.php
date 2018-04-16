<?php
	function dump($ob){
		echo "<pre style=\"text-align: left;\">";
		print_r($ob);
		echo "</pre>";
	}
	
	function checkAdminLogin() {
		$CI = & get_instance();
		$id = $CI->session->userdata('admin_id');
		if (!empty($id)) {
			return 1;
		} else {
			return 0;
		}
	} 
	
	
	
	


?>