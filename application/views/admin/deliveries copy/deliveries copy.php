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
                
                    <table class="table table-bordered">
						<thead>
						  <tr>
                          
							<th><?php echo $this->lang->line('tracking_number'); ?></th>
<th><?php echo $this->lang->line('sender_name'); ?></th>
<th><?php echo $this->lang->line('sender_address'); ?></th>
<th><?php echo $this->lang->line('sender_contact'); ?></th>
<th><?php echo $this->lang->line('recipient_name'); ?></th>
<th><?php echo $this->lang->line('recipient_address'); ?></th>
<th><?php echo $this->lang->line('recipient_contact'); ?></th>
<th><?php echo $this->lang->line('courier_service_id'); ?></th>
<th><?php echo $this->lang->line('shipment_date'); ?></th>
<th><?php echo $this->lang->line('expected_delivery_date'); ?></th>
<th><?php echo $this->lang->line('delivery_status'); ?></th>
<th><?php echo $this->lang->line('delivery_type'); ?></th>
<th><?php echo $this->lang->line('package_weight'); ?></th>
<th><?php echo $this->lang->line('package_dimensions'); ?></th>
<th><?php echo $this->lang->line('amount'); ?></th>
<th><?php echo $this->lang->line('payment_status'); ?></th>
<th><?php echo $this->lang->line('courier_notes'); ?></th>
<th><?php echo $this->lang->line('created_at'); ?></th>
<th><?php echo $this->lang->line('updated_at'); ?></th>
<th><?php echo $this->lang->line('courier_service_name'); ?></th><th><?php echo $this->lang->line('Status'); ?></th><th><?php echo $this->lang->line('Action'); ?></th>
                        </tr>
						</thead>
						<tbody>
					  <?php foreach($deliveries as $delivery): ?>
                         
                         <tr>
                         
                             
            <td>
                <?php echo $delivery->tracking_number; ?>
            </td>
            <td>
                <?php echo $delivery->sender_name; ?>
            </td>
            <td>
                <?php echo $delivery->sender_address; ?>
            </td>
            <td>
                <?php echo $delivery->sender_contact; ?>
            </td>
            <td>
                <?php echo $delivery->recipient_name; ?>
            </td>
            <td>
                <?php echo $delivery->recipient_address; ?>
            </td>
            <td>
                <?php echo $delivery->recipient_contact; ?>
            </td>
            <td>
                <?php echo $delivery->courier_service_id; ?>
            </td>
            <td>
                <?php echo $delivery->shipment_date; ?>
            </td>
            <td>
                <?php echo $delivery->expected_delivery_date; ?>
            </td>
            <td>
                <?php echo $delivery->delivery_status; ?>
            </td>
            <td>
                <?php echo $delivery->delivery_type; ?>
            </td>
            <td>
                <?php echo $delivery->package_weight; ?>
            </td>
            <td>
                <?php echo $delivery->package_dimensions; ?>
            </td>
            <td>
                <?php echo $delivery->amount; ?>
            </td>
            <td>
                <?php echo $delivery->payment_status; ?>
            </td>
            <td>
                <?php echo $delivery->courier_notes; ?>
            </td>
            <td>
                <?php echo $delivery->created_at; ?>
            </td>
            <td>
                <?php echo $delivery->updated_at; ?>
            </td>
            <td>
                <?php echo $delivery->courier_service_name; ?>
            </td>
                                <td>
                                    <?php echo status($delivery->status,  $this->lang); ?>
                                    <?php
                                        
                                        //set uri segment
                                        if(!$this->uri->segment(4)){
                                            $page = 0;
                                        }else{
                                            $page = $this->uri->segment(4);
                                        }
                                        
                                        if($delivery->status == 0){
                                            echo "<a href='".site_url(ADMIN_DIR."deliveries/publish/".$delivery->delivery_id."/".$page)."'> &nbsp;".$this->lang->line('Publish')."</a>";
                                        }elseif($delivery->status == 1){
                                            echo "<a href='".site_url(ADMIN_DIR."deliveries/draft/".$delivery->delivery_id."/".$page)."'> &nbsp;".$this->lang->line('Draft')."</a>";
                                        }
                                    ?>
                                </td>
                                <td>
                                <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR."deliveries/view_delivery/".$delivery->delivery_id."/".$this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR."deliveries/edit/".$delivery->delivery_id."/".$this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR."deliveries/trash/".$delivery->delivery_id."/".$this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
                            </td>
                         </tr>
                      <?php endforeach; ?>
						</tbody>
					  </table>
                      
                      <?php echo $pagination; ?>
                      

            </div>
			
			
		</div>
		
	</div>
	</div>
	<!-- /MESSENGER -->
</div>