<!-- PAGE HEADER-->
<div class="row">
	<div class="col-sm-12">
		<div class="page-header">
			<!-- STYLER -->
			
			<!-- /STYLER -->
			<!-- BREADCRUMBS -->
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url(ADMIN_DIR.$this->session->userdata("role_homepage_uri")); ?>"><?php echo $this->lang->line('Home'); ?></a>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url(ADMIN_DIR."courier_services/view/"); ?>"><?php echo $this->lang->line('Courier Services'); ?></a>
			</li><li><?php echo $title; ?></li>
			</ul>
			<!-- /BREADCRUMBS -->
            <div class="row">
                        
                <div class="col-md-6">
                    <div class="clearfix">
					  <h3 class="content-title pull-left"><?php echo $title; ?></h3>
					</div>
					<div class="description"><?php echo $description; ?></div>
                </div>
                
                <div class="col-md-6">
                    <div class="pull-right">
               <button onclick="get_delivery_form('0')" class="btn btn-primary">Add Delivery Package</button>
                   
        <script>
            function get_delivery_form(delivery_id) {
                $.ajax({
                        method: "POST",
                        url: "<?php echo site_url(ADMIN_DIR . 'courier_services/get_delivery_form'); ?>",
                        data: {
                            delivery_id: delivery_id,
                            courier_service_id: <?php echo $courier_service->courier_service_id; ?>,
                            batch_id: <?php echo $batch->batch_id; ?>
                        },
                    })
                    .done(function(respose) {
                        $('#modal').modal('show');
                        $('.modal-dialog').css({
                             'width': '80%'
                            });
                            if(delivery_id>0){
                        $('#modal_title').html('Update Delivery');
                        }else{
                        $('#modal_title').html('Add New Delivery');  
                        }
                        $('#modal_body').html(respose);

                    });
            }
        </script>     
				</div>
                </div>
                
            </div>
            
			
		</div>
	</div>
</div>
<!-- /PAGE HEADER -->

<!-- PAGE MAIN CONTENT -->
<div class="row">
		<!-- MESSENGER -->
	<div class="col-md-3">
	<div class="box border blue" id="messenger">
		<div class="box-title">
			<h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
		</div><div class="box-body">
			
            <div class="table-responsive">
                
                    <table class="table">
						<thead>
						  
						</thead>
						<tbody>
					     
                      <tr>
                
                <td>
					 <img style="width:100%"  src="<?php echo base_url("assets/uploads/".$courier_service->logo) ?>" />
               
                </td>
						</tr>   
						<tr>
							<td>
								<?php echo $courier_service->courier_service_name; ?> 
								(<?php echo $courier_service->short_name; ?>)
							</td>
						</tr>
           
            
                            <tr>
                               <td>
                                    <?php echo status($courier_service->status); ?>
                                </td>
                            </tr>
                         
						</tbody>
					  </table>
                      
                      
                      

            </div>
			
			
		</div>
		
	</div>
	</div>

	<div class="col-md-9">
	<div class="box border blue" id="messenger"><div class="box-body">
			
            <div class="table-responsive">
        <table class="table table-bordered" id="batches">
            <thead>
                <tr>
                <th>Courier Service</th>
                    <th>Batch No</th>
                    <th>Batch Date</th>
                    <th>Batch Detail</th>
                    <th>Action</th>
        </tr>
            </thead>
            <tbody>
                    <tr><td><?php echo $batch->courier_service_name; ?></td>
                        <td><?php echo $batch->batch_no; ?></td>
                        <td><?php echo $batch->batch_date; ?></td>
                        <td><?php echo $batch->batch_detail; ?></td>
                        <td><button onclick="get_batch_form('<?php echo $batch->batch_id; ?>')" >Edit<botton></td>
        </tr>
      
        </tbody>
                    </table>

                    
<div class="table-responsive">
<table class="table table-bordered table_sm all" id="deliveries">
                            <thead>
                                <th>#</th>
                                <th>Batch No</th>
                                <th>Tracking Number</th>
                                <th>Recipient Name</th>
                                <th>Recipient Address</th>
                                <th>Recipient Contact</th>
                                <th>Courier Service</th>
                                <th>Delivery Cost</th>
                                <th>Payment Status</th>
                                <th>Courier Notes</th>
                                <th>Delivery Status</th>
                            </thead>
                            <tbody>
                                <?php
                                $total_amount=0;
                                $count=1;
                                $query = "SELECT d.*, cs.courier_service_name, cs.short_name, b.batch_no   FROM deliveries as d 
                                INNER JOIN courier_services as cs ON(cs.courier_service_id = d.courier_service_id)
                                INNER JOIN batches as b ON(b.batch_id = d.batch_id)";
                                $rows = $this->db->query($query)->result();
                                foreach ($rows as $row) { ?>
                                   <tr>
                                        <td><?php echo $count++ ?></td>
                                        <td><?php echo $row->batch_no; ?></td>
                                        <td><?php echo $row->tracking_number; ?></td>
                                        <td><?php echo $row->recipient_name; ?></td>
                                        <td><?php echo $row->recipient_address; ?></td>
                                        <td><?php echo $row->recipient_contact; ?></td>
                                        <td><?php echo $row->short_name; ?></td>
                                        <td><?php echo $row->delivery_cost; 
                                        $total_amount+=$row->delivery_cost;
                                        ?></td>
                                        <td><?php echo $row->payment_status; ?></td>
                                        <td><?php echo $row->courier_notes; ?></td>
                                        <td><?php echo $row->status; ?></td>
                                    </tr>
                            <?php } ?>
                         </tbody>
                         <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total:</th>
                            <th><?php echo $total_amount; ?></th>
                            <th></th>
<th></th>
                         </tfoot>
                    </table>

</div>
<script>
    title = "<?php echo 'Rider ' . $rider->name . ' List ' . date('Y-m-d H:i:s'); ?>";
    $('#deliveries').DataTable({
        paging: false,
        title: title,
        order: [],
        searching: true,
        dom: 'Bfrtip', // This enables the button options
        buttons: [
            { extend: 'copy', title: title, footer: true, },
            { extend: 'csv', title: title, footer: true, },
            { extend: 'excel', title: title, footer: true, },
            {
    extend: 'pdf', 
    footer: true,
    title: title,
    orientation: 'landscape', // Landscape orientation
    pageSize: 'legal', // Standard A4 size
    customize: function(doc) {
        doc.pageMargins = [1, 1, 1, 1];
        // Customize table header styles
        doc.styles.tableHeader = {
            alignment: 'left',
            bold: true,
            fontSize: 8,
            fillColor: '#f2f2f2', // Light gray background for headers
            margin: [0, 5, 0, 5] // Top and bottom padding
        };
        doc.styles.tableFooter = {
            alignment: 'left',
            bold: true,
            fontSize: 15,
            fillColor: '#f2f2f2', // Light gray background for headers
            margin: [0, 5, 0, 5] // Top and bottom padding
        };

        // Customize table body cell styles
        doc.styles.tableBodyEven = {
            alignment: 'left',
            fontSize: 7,
            margin: [0, 3, 0, 3]
        };
        doc.styles.tableBodyOdd = {
            alignment: 'left',
            fontSize: 7,
            margin: [0, 3, 0, 3]
        };

        // Set table width to fit the page width
        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('*');

        // Optional: Center the entire table
        doc.content[1].alignment = 'center';
    }
},

            { extend: 'print', title: title, footer: true, }
        ]
    });
</script>

			
			
		</div>
		
	</div>
	</div>
	<!-- /MESSENGER -->
</div>
