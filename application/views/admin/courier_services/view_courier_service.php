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
					<div class="description"><?php echo $title; ?></div>
                </div>
                
                <div class="col-md-6">
                    <div class="pull-right">
                <button onclick="get_batch_form('0')" class="btn btn-primary">Add New Batch</button>    
				<script>
            function get_batch_form(batch_id) {
                $.ajax({
                        method: "POST",
                        url: "<?php echo site_url(ADMIN_DIR . 'courier_services/get_batch_form'); ?>",
                        data: {
                            batch_id: batch_id,
							courier_service_id: <?php echo $courier_service->courier_service_id; ?>
                        },
                    })
                    .done(function(respose) {
                        $('#modal').modal('show');
                        $('#modal_title').html('Batches');
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
	<div class="box border blue" id="messenger">
		<div class="box-title">
			<h4><i class="fa fa-bell"></i> Batches List</h4>
		</div><div class="box-body">
			
            <div class="table-responsive">
                
                 <table id="datatable" class="table  table _small table-bordered">
        <thead>
            <tr>
            <th>#</th>
            <th>Courier Service</th>
                    <th>Batch No</th>
					<th>Batch date</th>
                    <th>Batch Detail</th>
                    
        <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>

        <script type="text/javascript">
            $(document).ready(function() {
                document.title = "batches (Date:<?php echo date('d-m-Y h:m:s') ?>)";
                $("#datatable").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "<?php echo base_url(ADMIN_DIR . "courier_services/batches"); ?>",
                        "type": "POST",
						"data": {
							courier_service_id : '<?php echo $courier_service->courier_service_id; ?>'
						}
                    },
                    "columns": [
                        {
                            "data": null,
                            "render": function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; // Start index from 1
                            }
                        },
                        
                { "data": "courier_service_name" },
                
                { "data": "batch_no" },
				{ "data": "batch_date" },
                
                { "data": "batch_detail" },
                

        {
            "data": null,
            "render": function(data, type, row) {
                return '<a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "batches/trash/"); ?>' + row.batch_id + '/' + '" onclick="return confirm(\'Are you sure? you want to delete the record.\')"><i class="fa fa-trash-o"></i></a><span style="margin-left: 20px;"></span>' +
                    '<a class="llink llink-view" href="<?php echo site_url(ADMIN_DIR . "courier_services/courier_service_batche/"); ?>' + row.courier_service_id + '/' + row.batch_id + '/' + '"><i class="fa fa-eye"></i></a><span style="margin-left: 20px;"></span>' +
                    '<a class="llink llink-edit" href="<?php echo site_url(ADMIN_DIR . "batches/edit/"); ?>' + row.batch_id + '/' + '"><i class="fa fa-pencil-square-o"></i></a>';
            }
        }

                    ],
                    "lengthMenu": [
                        [15, 25, 50, -1],
                        [15, 25, 50, "All"]
                    ],
                    "order": [
                        [0, "asc"]
                    ],
                    "searching": true,
                    "paging": true,
                    "info": true,
                    dom: "Bfrtip",

                    buttons: ["excel", "pageLength"]
                });
            });
        </script>
         
		</div>
			
			
		</div>
		
	</div>
	</div>
	<!-- /MESSENGER -->
</div>
