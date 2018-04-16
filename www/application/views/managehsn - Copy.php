<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<!-- <script src="<?php// echo base_url();?>assets/Admin/js/jquery.min.js"></script> -->
<div class="content-page">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <!-- Start content -->
    <style type="text/css">
    .dataTables_paginate.paging_simple_numbers ,.dataTables_filter{
    float: right;
    }
    </style>
    <div class="content">
        <div class="container">
          
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Sale/Puchase Chart</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url();?>Welcome">Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>Welcome/sale_chart">Sale/Purchase Chart</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="tbl">
                        <div class="card-box table-responsive">
                           <div id="chartContainer" style="height: 300px; width: 100%;">
                             </div>
                        </div>
                    </div>
                    <div id="tb2" style="display:none">
                        <?php include('view_stock_vehicles.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END wrapper -->
    </div>
</div>
</div>



  </div>
</div>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script type="text/javascript">
window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer",
        {

            title:{
                text: "Site Traffic",
                fontSize: 30
            },
                        animationEnabled: true,
            axisX:{

                gridColor: "Silver",
                tickColor: "silver",
                /*valueFormatString: "DD/MMM"*/
                valueFormatString: "MMM/YYYY"
            },                        
                        toolTip:{
                          shared:true
                        },
            theme: "theme2",
            axisY: {
                gridColor: "Silver",
                tickColor: "silver"
            },
            legend:{
                verticalAlign: "center",
                horizontalAlign: "right"
            },
            data: [
            {        
                type: "line",
                showInLegend: true,
                lineThickness: 2,
                name: "Sale",
                markerType: "square",
                color: "#F08080",
                dataPoints: [
                { x: new Date(2010,2,3), y: 650 },
                { x: new Date(2010,2,5), y: 700 },
                { x: new Date(2010,2,7), y: 710 },
                { x: new Date(2010,2,9), y: 658 },
                { x: new Date(2010,2,11), y: 734 },
                { x: new Date(2010,2,13), y: 963 },
                { x: new Date(2010,2,15), y: 847 },
                { x: new Date(2010,2,17), y: 853 },
                { x: new Date(2010,2,19), y: 869 },
                { x: new Date(2010,2,21), y: 943 },
                { x: new Date(2010,2,23), y: 970 },
                { x: new Date(2010,2,25), y: 970 }
                ]
            },
            {        
                type: "line",
                showInLegend: true,
                name: "Purchase",
                color: "#20B2AA",
                lineThickness: 2,

                dataPoints: [
                { x: new Date(2010,2,3), y: 510 },
                { x: new Date(2010,2,5), y: 560 },
                { x: new Date(2010,2,7), y: 540 },
                { x: new Date(2010,2,9), y: 558 },
                { x: new Date(2010,2,11), y: 544 },
                { x: new Date(2010,2,13), y: 693 },
                { x: new Date(2010,2,15), y: 657 },
                { x: new Date(2010,2,17), y: 663 },
                { x: new Date(2010,2,19), y: 639 },
                { x: new Date(2010,2,21), y: 673 },
                { x: new Date(2010,2,23), y: 660 },
                { x: new Date(2010,2,25), y: 970 }
                ]
            }

            
            ],
          legend:{
            cursor:"pointer",
            itemclick:function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
              }
              else{
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
        });

//chart.render();
}
</script>