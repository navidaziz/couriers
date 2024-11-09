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
				<a href="<?php echo site_url(ADMIN_DIR."deliveries/view/riders"); ?>"><?php echo $this->lang->line('Deliveries'); ?></a>
			</li><li><?php echo $title; ?></li>
			</ul>
			<!-- /BREADCRUMBS -->
            <div class="row">
                        
                <div class="col-md-6">
                    <div class="clearfix">
					  <h3 class="content-title pull-left"><?php echo $title; ?></h3>
					</div>
					<div class="description"><?php echo $title; ?></div>
                </div>
                
                <div class="col-md-6">
                    <div class="pull-right">
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
	<div class="col-md-6">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-bell"></i> Deliveries</h4>
            </div>
            <div class="box-body">
			
                <div class="table-responsive">
                        <table class="table table-bordered table_small" id="deliveries">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Tracking No.</th>
                                    <th>Recipient Address</th>
                                    <th>Shipment Date</th>
                                    <th>Expected Delivery Date</th>
                                    <th>Delivery Type</th>
                                    <th>Amount</th>
                                    <th>Courier Notes</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count=1;
                                $query = "SELECT * FROM deliveries WHERE rider_id IS NULL";
                                $rows = $this->db->query($query)->result();
                                foreach ($rows as $row) { ?>
                                    <tr>
                                    <td><?php echo $count++ ?></td>
                                    <td><?php echo $row->tracking_number; ?></td>
                                        <td><?php echo $row->recipient_address; ?></td>
                                        <td><?php echo $row->shipment_date; ?></td>
                                        <td><?php echo $row->expected_delivery_date; ?></td>
                                        <td><?php echo $row->delivery_type; ?></td>
                                        <td><?php echo $row->amount; ?></td>
                                        <td><?php echo $row->courier_notes; ?></td>
                                        <td>
                                        <form action="<?php echo site_url(ADMIN_DIR.'deliveries/assign_to_rider'); ?>" method="POST" >
                                            <input type="hidden" name="rider_id" value="<?php echo $rider->user_id; ?>" />
                                            <input type="hidden" name="delivery_id" value="<?php echo $row->delivery_id; ?>" />
                                            <button>>></button>
                                        </form>
                                        </td>
                                    </tr>
                        <?php } ?>
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
	</div>
    <div class="col-md-6">
        <div class="box border blue" id="messenger">
            <div class="box-title">
                <h4><i class="fa fa-motorcycle"></i> Deliveries Assigned To Rider </h4>
            </div>
            <div class="box-body">
			
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Please enter Tracking No to assign package to rider: <br />
                            <input class="form-control" type="text" id="tracking_no" placeholder="Scan barcode here" autofocus>
                        <div id="tracking_no_response"></div>    
                        </td>
                            
                        </tr>
                    </table>
                    
                    

                            <script>
                                // Function to handle the barcode data
                                function handleBarcode(barcode) {
                                    alert("Barcode Scanned: " + barcode);
                                    // Additional processing can be added here
                                }

                                // Add event listener for the input field
                                const barcodeInput = document.getElementById('tracking_no');
                                barcodeInput.addEventListener('keyup', function(event) {
                                    $('#tracking_no_response').html('');
                                    if (event.key === 'Enter') {
                                            var tracking_no = $('#tracking_no').val();
                                            $.ajax({
                                                type: 'POST',
                                                url: '<?php echo site_url(ADMIN_DIR . "deliveries/seacrch_by_tracking_no"); ?>', // URL to submit form data
                                                data: {
                                                    tracking_no:tracking_no,
                                                    rider_id: '<?php echo $rider->user_id; ?>'
                                                },
                                                success: function(response) {
                                                    
                                                    if(response=='success'){
                                                        get_rider_assigned_packages();
                                                    }else{
                                                        $('#tracking_no_response').fadeOut(200, function() {
                                                        $(this).html(response).fadeIn(200);
                                                        });
                                                    }
                                                        

                                                }
                                            });
                                        }
                                });

                            function get_rider_assigned_packages(){
                                    $.ajax({
                                            type: 'POST',
                                            url: '<?php echo site_url(ADMIN_DIR . "deliveries/get_rider_assigned_packages"); ?>', // URL to submit form data
                                            data: {
                                                rider_id: '<?php echo $rider->user_id; ?>'
                                            },
                                            success: function(response) {
                                                    $('#rider_assigned_packages').fadeOut(200, function() {
                                                    $(this).html(response).fadeIn(200);
                                                    });
                                                    

                                            }
                                        });
                            }
                            get_rider_assigned_packages();
                            </script>

<div id="rider_assigned_packages"></div>
                    
                </div>

            </div>
        </div>
	</div>
	<!-- /MESSENGER -->
</div>
