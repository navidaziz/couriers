<!-- PAGE HEADER-->
<div class="breadcrumb-box">
  <div class="container">
			<!-- BREADCRUMBS -->
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url("Home"); ?>">Home</a>
					<span class="divider">/</span>
				</li><li>
				<i class="fa fa-table"></i>
				<a href="<?php echo site_url("deliveries/view/"); ?>">Deliveries</a>
				<span class="divider">/</span>
			</li><li ><?php echo $title; ?> </li>
				</ul>
			</div>
		</div>
		<!-- .breadcrumb-box --><section id="main">
			  <header class="page-header">
				<div class="container">
				  <h1 class="title"><?php echo $title; ?></h1>
				</div>
			  </header>
			  <div class="container">
			  <div class="row">
			  <?php $this->load->view(PUBLIC_DIR."components/nav"); ?><div class="content span9 pull-right">
            <div class="table-responsive">
                
                    <table class="table">
						<thead>
						  
						</thead>
						<tbody>
					  <?php foreach($deliveries as $delivery): ?>
                         
                         
            <tr>
                <th><?php echo $this->lang->line('tracking_number'); ?></th>
                <td>
                    <?php echo $delivery->tracking_number; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('sender_name'); ?></th>
                <td>
                    <?php echo $delivery->sender_name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('sender_address'); ?></th>
                <td>
                    <?php echo $delivery->sender_address; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('sender_contact'); ?></th>
                <td>
                    <?php echo $delivery->sender_contact; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('recipient_name'); ?></th>
                <td>
                    <?php echo $delivery->recipient_name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('recipient_address'); ?></th>
                <td>
                    <?php echo $delivery->recipient_address; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('recipient_contact'); ?></th>
                <td>
                    <?php echo $delivery->recipient_contact; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('courier_service_id'); ?></th>
                <td>
                    <?php echo $delivery->courier_service_id; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('shipment_date'); ?></th>
                <td>
                    <?php echo $delivery->shipment_date; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('expected_delivery_date'); ?></th>
                <td>
                    <?php echo $delivery->expected_delivery_date; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('delivery_status'); ?></th>
                <td>
                    <?php echo $delivery->delivery_status; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('delivery_type'); ?></th>
                <td>
                    <?php echo $delivery->delivery_type; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('package_weight'); ?></th>
                <td>
                    <?php echo $delivery->package_weight; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('package_dimensions'); ?></th>
                <td>
                    <?php echo $delivery->package_dimensions; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('delivery_cost'); ?></th>
                <td>
                    <?php echo $delivery->delivery_cost; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('payment_status'); ?></th>
                <td>
                    <?php echo $delivery->payment_status; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('courier_notes'); ?></th>
                <td>
                    <?php echo $delivery->courier_notes; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('created_at'); ?></th>
                <td>
                    <?php echo $delivery->created_at; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('updated_at'); ?></th>
                <td>
                    <?php echo $delivery->updated_at; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('courier_service_name'); ?></th>
                <td>
                    <?php echo $delivery->courier_service_name; ?>
                </td>
            </tr>
                         
                      <?php endforeach; ?>
						</tbody>
					  </table>
                      
                      
                      

            </div>
			
			</div>
		</div>
	 </div>
  <!-- .container --> 
</section>
<!-- #main -->
