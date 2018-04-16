<footer class="footer text-right">
Designed and Developed By VismaadLabs
</footer>
</div>
</div>
<script>
var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
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
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/calender/js/calendario.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/calender/js/data.js"></script> 
<script type="text/javascript"> 
$(function() {
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
jQuery(document).ready(function($)
{
$('.counter').counterUp({
delay: 100,
time: 1200
});
$(".knob").knob();
});
</script>
</body>
</html>
