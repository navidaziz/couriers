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
				<a href="<?php echo site_url("users/view/"); ?>">Users</a>
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
