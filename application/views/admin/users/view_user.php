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
				<a href="<?php echo site_url(ADMIN_DIR."users/view/"); ?>"><?php echo $this->lang->line('Users'); ?></a>
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
                        <a class="btn btn-primary btn-sm" href="<?php echo site_url(ADMIN_DIR."users/add"); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('New'); ?></a>
                        <a class="btn btn-danger btn-sm" href="<?php echo site_url(ADMIN_DIR."users/trashed"); ?>"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('Trash'); ?></a>
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
					  <?php foreach($users as $user): ?>
                         
                         
            <tr>
                <th><?php echo $this->lang->line('name'); ?></th>
                <td>
                    <?php echo $user->name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('father_name'); ?></th>
                <td>
                    <?php echo $user->father_name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('cnic'); ?></th>
                <td>
                    <?php echo $user->cnic; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('user_email'); ?></th>
                <td>
                    <?php echo $user->user_email; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('user_mobile_number'); ?></th>
                <td>
                    <?php echo $user->user_mobile_number; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('user_name'); ?></th>
                <td>
                    <?php echo $user->user_name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('user_password'); ?></th>
                <td>
                    <?php echo $user->user_password; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('user_image'); ?></th>
                <td>
                    <?php echo $user->user_image; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('franchise_name'); ?></th>
                <td>
                    <?php echo $user->franchise_name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('role_title'); ?></th>
                <td>
                    <?php echo $user->role_title; ?>
                </td>
            </tr>
                            <tr>
                                <th><?php echo $this->lang->line('Status'); ?></th>
                                <td>
                                    <?php echo status($user->status); ?>
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