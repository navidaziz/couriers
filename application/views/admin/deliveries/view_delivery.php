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
				<a href="<?php echo site_url(ADMIN_DIR."deliveries/view/"); ?>"><?php echo $this->lang->line('Deliveries'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR."deliveries/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR."deliveries/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
	<div class="col-md-12">






    
	<div class="box border blue" id="messenger">
		<div class="box-title">
			<h4><i class="fa fa-bell"></i> <?php echo $title; ?></h4>
			<!--<div class="tools">
            
				<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
				</a>
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
				</a>
				

			</div>-->
		</div><div class="box-body">
			
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
                            <tr>
                                <th><?php echo $this->lang->line('Status'); ?></th>
                                <td>
                                    <?php echo status($delivery->status); ?>
                                </td>
                            </tr>
                         
                      <?php endforeach; ?>
						</tbody>
					  </table>
                      
                      
                      

            </div>
			
			
		</div>
		
	</div>
	</div>
	<!-- /MESSENGER -->
</div>
