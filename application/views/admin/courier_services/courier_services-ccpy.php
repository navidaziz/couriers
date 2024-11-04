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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR."courier_services/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR."courier_services/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
            
		</div>
        <div class="box-body">
		
        <div class="header-tabs">

                    <ul class="nav nav-tabs">
                        <?php foreach($courier_services as $courier_service){ ?>
                         <li  >
                            <a href="<?php echo site_url(ADMIN_DIR) ?>" contenteditable="false">
                                <img width="16" height="16" class="img-circle" src="<?php echo base_url("assets/uploads/".$courier_service->logo); ?>">
                            
                            <?php echo $courier_service->short_name; ?></a>
                        </li>
                        <?php } ?>
                       
                    </ul>
                    <div class="tab-content" style="margin-top: -35px;">
                        <?php if($tab=='Shipped' and 1==2){ ?>
                            <?php $this->load->view(ADMIN_DIR."deliveries/rider_assigned"); ?>
                        <?php } ?>
                        
                    </div>
                </div>
                

            </div>



            <div class="table-responsive">
                
                    <table class="table table-bordered">
						<thead>
						  <tr>
                          
							<th><?php echo $this->lang->line('courier_service_name'); ?></th>
<th><?php echo $this->lang->line('short_name'); ?></th>
<th><?php echo $this->lang->line('logo'); ?></th><th><?php echo $this->lang->line('Status'); ?></th><th><?php echo $this->lang->line('Action'); ?></th>
                        </tr>
						</thead>
						<tbody>
					  <?php foreach($courier_services as $courier_service): ?>
                         
                         <tr>
                         
                             
            <td>
                <?php echo $courier_service->courier_service_name; ?>
            </td>
            <td>
                <?php echo $courier_service->short_name; ?>
            </td>
            <td>
            <?php
                echo file_type(base_url("assets/uploads/".$courier_service->logo));
            ?>
            </td>
                                <td>
                                    <?php echo status($courier_service->status,  $this->lang); ?>
                                    <?php
                                        
                                        //set uri segment
                                        if(!$this->uri->segment(4)){
                                            $page = 0;
                                        }else{
                                            $page = $this->uri->segment(4);
                                        }
                                        
                                        if($courier_service->status == 0){
                                            echo "<a href='".site_url(ADMIN_DIR."courier_services/publish/".$courier_service->courier_service_id."/".$page)."'> &nbsp;".$this->lang->line('Publish')."</a>";
                                        }elseif($courier_service->status == 1){
                                            echo "<a href='".site_url(ADMIN_DIR."courier_services/draft/".$courier_service->courier_service_id."/".$page)."'> &nbsp;".$this->lang->line('Draft')."</a>";
                                        }
                                    ?>
                                </td>
                                <td>
                                <a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR."courier_services/view_courier_service/".$courier_service->courier_service_id."/".$this->uri->segment(4)); ?>"><i class="fa fa-eye"></i> </a>
                                <a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR."courier_services/edit/".$courier_service->courier_service_id."/".$this->uri->segment(4)); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                <a class="llink llink-trash" href="<?php echo site_url(ADMIN_DIR."courier_services/trash/".$courier_service->courier_service_id."/".$this->uri->segment(4)); ?>"><i class="fa fa-trash-o"></i></a>
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
