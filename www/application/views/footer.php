<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<!--commented by pawan-->
        <!--- <h4 class="modal-title"><?php echo $PROFILE['FIRMNAME']; ?></h4> --->
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>

  </div>
</div>



<footer class="footer text-right">
Designed and Developed By <a style="color: #797979 !important;" href="http://keendevelopers.com/">Keen Developers</a>
</footer>
</div>
</div>
<script>
var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.toaster.js"></script>
<script src="<?php echo base_url();?>assets/js/detect.js"></script>
<script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url();?>assets/js/waves.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/peity/jquery.peity.min.js"></script>
<!-- jQuery  -->

<script src="<?php echo base_url();?>assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?php echo base_url();?>assets/plugins/counterup/jquery.counterup.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/raphael/raphael-min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-knob/jquery.knob.js"></script>
<script src="<?php echo base_url();?>assets/pages/jquery.dashboard.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/alert/lib/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/forms.js">
</script>


<script src="<?php echo base_url();?>assets/flatpickr.js"></script>

<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

<script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/calender/js/calendario.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/calender/js/data.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.toaster.js"></script>
<script src="<?php echo base_url();?>assets/select2.min.js"></script>
<!-- <script src="<?php //echo base_url();?>assets/js/calender_record.js"></script> -->
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>



<script src="<?php echo base_url();?>assets/plugins/ladda/dist/spin.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/ladda/dist/ladda.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.formvalidation/0.6.1/js/formValidation.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.formvalidation/0.6.1/js/framework/bootstrap.min.js"></script>
<!--=================================================--> 

<!--===============================================-->
<script type="text/javascript"> 
$(function() {
var opened_url = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';
$('#sidebar_list li a').each(function(){
  if($(this).attr('href') == opened_url){
    $(this).addClass('active');
  }
})

function updateMonthYear() {
$( '#custom-month' ).html( $( '#calendar' ).calendario('getMonthName') );
$( '#custom-year' ).html( $( '#calendar' ).calendario('getYear'));
}

$(document).on('finish.calendar.calendario', function(e){
$( '#custom-month' ).html( $( '#calendar' ).calendario('getMonthName') );
$( '#custom-year' ).html( $( '#calendar' ).calendario('getYear'));
$( '#custom-next' ).on( 'click', function() {
$( '#calendar' ).calendario('gotoNextMonth', updateMonthYear);
} );
$( '#custom-prev' ).on( 'click', function() {
$( '#calendar' ).calendario('gotoPreviousMonth', updateMonthYear);
} );
$( '#custom-current' ).on( 'click', function() {
$( '#calendar' ).calendario('gotoNow', updateMonthYear);
} );
});

$('#calendar').on('shown.calendar.calendario', function(){
$('div.fc-row > div').on('onDayClick.calendario', function(e, dateprop) {
console.log(dateprop);
if(dateprop.data) {
showEvents(dateprop.data.html, dateprop);
}
});
});

var transEndEventNames = {
'WebkitTransition' : 'webkitTransitionEnd',
'MozTransition' : 'transitionend',
'OTransition' : 'oTransitionEnd',
'msTransition' : 'MSTransitionEnd',
'transition' : 'transitionend'
},
transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
$wrapper = $( '#custom-inner' );

function showEvents( contentEl, dateprop ) {
hideEvents();
var $events = $( '<div id="custom-content-reveal" class="custom-content-reveal"><h4>Events for ' + dateprop.monthname + ' '
+ dateprop.day + ', ' + dateprop.year + '</h4></div>' ),
$close = $( '<span class="custom-content-close"></span>' ).on( 'click', hideEvents);
$events.append( contentEl.join('') , $close ).insertAfter( $wrapper );
setTimeout( function() {
$events.css( 'top', '0%' );
}, 25);

}

function hideEvents() {
var $events = $( '#custom-content-reveal' );
if( $events.length > 0 ) {   
$events.css( 'top', '100%' );
Modernizr.csstransitions ? $events.on( transEndEventName, function() { $( this ).remove(); } ) : $events.remove();
}
}

$( '#calendar' ).calendario({
caldata : events,
displayWeekAbbr : true,
events: ['click', 'focus']
});

});
</script>
<script type="text/javascript">
  $(".flatpickr").flatpickr({dateFormat: "d-m-Y",});
  $('.show_form').click(function(){
    $('#main_div').hide('1000');
    $('#add_inst').show('1000');
  });
  $('.close_toggle').click(function(){
    $('#main_div').show('1000');
    $('#add_inst').hide('1000');
  });
jQuery(document).ready(function($)
{
$('.counter').counterUp({
delay: 100,
time: 1200
});
$(".knob").knob();
});

var clicks_count = 0;

</script>


<!-- Ajax and other page function -->
<script type="text/javascript">
	
	 function view_modal(url)
  {
  	$.ajax({
  			url: url,
  			type: 'post',
  			success: function (data) {
  				$('#myModal').find('.modal-body').html(data);
  			}
  		});
  	$('#myModal').modal('show');
  }

 

</script>



</body>
</html>
