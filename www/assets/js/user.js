$(document).ready(function() {
    var  table;
 function tabledata(){
     
 table = $('#example').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 		 "initComplete": function () {
 		 },
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url+"User_list_datatable/ajax_list",
            "type": "POST",
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0,5], //first column / numbering column
            "orderable": false, //set not orderable
        },
        { "sClass": "center", "aTargets": [ 0 ] },
        ],
 
    });
}   
tabledata();
$('#example').on( 'draw.dt', actions);

function actions(){
  $('.documents').click(function(c){
      c.preventDefault();
             var selector = $(this).attr('id');
             var id = $(this).attr('data-id');
             
                $.post(base_url+"User/view_doc?documentId=" + id, function(e) {
                        console.log(e);
                    if (e.result && e.result == "unauth") {
                      	window.location.replace(base_url+"Welcome");
                    }else if(e.result && e.result == 'danger'){
                        $.toaster({ priority : data.result, title : data.title, message : data.message});
                    }else {
                        $('#doc_title').text(e.title);
                        $('#doc_description').text(e.description);
                        if(e[0]['file_type'] && e[0]['file_type']== 'image'){
                            $('#doc_image').show();
                            $('#show_file').hide();
                        $('#doc_image').attr('src',base_url+'assets/img/userdocs/'+e.picture);
                        }else{
                           $('#doc_image').hide(); 
                           $('#show_file').show();
                           $('#show_file>i').text(e.picture);
                        }
                        $('#d_link').attr('href',base_url+'User/download/'+e.picture);
                    $('#show_doc').click();
                    }

                })
            });
 
            
}

$('#upload_docs_form').submit(function(e){
    e.preventDefault();
    $('#up_sub').text('Uploading....');
    var formData = new FormData($('#upload_docs_form')[0]);
$.ajax({
type:'POST',
dataType:'json',
url: base_url+"User/upload_docs", 
data: formData,
contentType: false,
processData: false,
success:function(data){  
$('.close').click();
$('#upload_docs_form')[0].reset();
$('#up_sub').text('Upload');
if(data.result == 'unauth') {
	window.location.replace(base_url+"Welcome");
}else{
   table.ajax.reload( null, false );
	$.toaster({ priority : data.result, title : data.title, message : data.message});
}
},
error: function(){
$.toaster({ priority : 'danger', title : 'Error', message : 'Not Done!'});
	return true;
}
});
    
})





$('#change_pass_form').submit(function(e){
    e.preventDefault();
    $('.message_div').hide();
    $('.message_div span').text('');
    if($('#new_pass').val() == $('#c_pass').val()){
$.ajax({
type:'POST',
dataType:'json',
url: base_url+"User/update_password", 
data: $('#change_pass_form').serialize(),
/*contentType: false,
processData: false,*/
success:function(data){  
$('#change_pass_form')[0].reset();

if(data.result == 'unauth') {
	window.location.replace(base_url+"Welcome");
}else{
    $('.message_div').show().addClass('alert-'+data.result+'');
    $('.message_div span').text(data.message);
	$.toaster({ priority : data.result, title : data.title, message : data.message});
}
},
error: function(){
$.toaster({ priority : 'danger', title : 'Error', message : 'Not Done!'});
	return true;
}
});    
}else{
     $('.message_div').show().addClass('alert-danger');
     $('.message_div span').text('Password and Re-Password field should be same');
}
})



$('#edit_detail_form').submit(function(e){
    e.preventDefault();
    $('#edit_detail_form button[type="submit"]').text('Uploading....').prop('disabled',true);
    var formData = new FormData($('#edit_detail_form')[0]);
$.ajax({
type:'POST',
dataType:'json',
url: base_url+"User/edit_details", 
data: formData,
contentType: false,
processData: false,
success:function(data){  
    $('#edit_detail_form button[type="submit"]').text('Submit').prop('disabled',false);
if(data.result == 'unauth') {
	window.location.replace(base_url+"Welcome");
}else if(data.result == 'success'){
    $.toaster({ priority : data.result, title : data.title, message : data.message});
    	setInterval(function(){window.location.replace(base_url+"user");},3000);
}
else{
	$.toaster({ priority : data.result, title : data.title, message : data.message});
}
},
error: function(){
$.toaster({ priority : 'danger', title : 'Error', message : 'Not Done!'});
	return true;
}
});
    
})



 });  
    