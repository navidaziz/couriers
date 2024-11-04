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
				<a href="<?php echo site_url("courier_services/view/"); ?>">Courier Services</a>
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
					  <?php foreach($courier_services as $courier_service): ?>
                         
                         
            <tr>
                <th><?php echo $this->lang->line('courier_service_name'); ?></th>
                <td>
                    <?php echo $courier_service->courier_service_name; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $this->lang->line('short_name'); ?></th>
                <td>
                    <?php echo $courier_service->short_name; ?>
                </td>
            </tr>
            <tr>
                <th>Logo</th>
                <td>
                <?php
                    echo file_type(base_url("assets/uploads/".$courier_service->logo));
                ?>
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
