<!-- PAGE HEADER-->
<div class="row">
	<div class="col-sm-12">
		<div class="page-header">
			<!-- STYLER -->
			
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
		</div>
        <div class="box-body">

            <?php
                $add_form_attr = array("class" => "form-horizontal");
                echo form_open_multipart(ADMIN_DIR."deliveries/save_data", $add_form_attr);
            ?>
            
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('tracking_number'), "tracking_number", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "tracking_number",
                        "id"            =>  "tracking_number",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('tracking_number'),
                        "value"         =>  set_value("tracking_number"),
                        "placeholder"   =>  $this->lang->line('tracking_number')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("tracking_number", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('sender_name'), "sender_name", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "sender_name",
                        "id"            =>  "sender_name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('sender_name'),
                        "value"         =>  set_value("sender_name"),
                        "placeholder"   =>  $this->lang->line('sender_name')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("sender_name", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('sender_address'), "sender_address", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "sender_address",
                        "id"            =>  "sender_address",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('sender_address'),
                        "value"         =>  set_value("sender_address"),
                        "placeholder"   =>  $this->lang->line('sender_address')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("sender_address", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('sender_contact'), "sender_contact", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "sender_contact",
                        "id"            =>  "sender_contact",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('sender_contact'),
                        "value"         =>  set_value("sender_contact"),
                        "placeholder"   =>  $this->lang->line('sender_contact')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("sender_contact", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('recipient_name'), "recipient_name", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "recipient_name",
                        "id"            =>  "recipient_name",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('recipient_name'),
                        "value"         =>  set_value("recipient_name"),
                        "placeholder"   =>  $this->lang->line('recipient_name')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("recipient_name", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('recipient_address'), "recipient_address", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "recipient_address",
                        "id"            =>  "recipient_address",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('recipient_address'),
                        "value"         =>  set_value("recipient_address"),
                        "placeholder"   =>  $this->lang->line('recipient_address')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("recipient_address", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('recipient_contact'), "recipient_contact", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "recipient_contact",
                        "id"            =>  "recipient_contact",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('recipient_contact'),
                        "value"         =>  set_value("recipient_contact"),
                        "placeholder"   =>  $this->lang->line('recipient_contact')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("recipient_contact", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('courier_service_name'), "Courier Service Id" , $label);
                ?>

                <div class="col-md-8">
                    <?php
                    echo form_dropdown("courier_service_id", $courier_services, "", "class=\"form-control\" required style=\"\"");
                    ?>
                </div>
                <?php echo form_error("courier_service_id", "<p class=\"text-danger\">", "</p>"); ?>
            </div>
            
            
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('shipment_date'), "shipment_date", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $date = array(
                        "type"          =>  "date",
                        "name"          =>  "shipment_date",
                        "id"            =>  "shipment_date",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('shipment_date'),
                        "value"         =>  set_value("shipment_date"),
                        "placeholder"   =>  $this->lang->line('shipment_date')
                    );
                    echo  form_input($date);
                ?>
                <?php echo form_error("shipment_date", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('expected_delivery_date'), "expected_delivery_date", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $date = array(
                        "type"          =>  "date",
                        "name"          =>  "expected_delivery_date",
                        "id"            =>  "expected_delivery_date",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('expected_delivery_date'),
                        "value"         =>  set_value("expected_delivery_date"),
                        "placeholder"   =>  $this->lang->line('expected_delivery_date')
                    );
                    echo  form_input($date);
                ?>
                <?php echo form_error("expected_delivery_date", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('delivery_status'), "delivery_status", $label);
                ?>

                <div class="col-md-8">
                    <?php 
					$options = array("Yes" => "Yes", "No" => "No");
                        foreach($options as $option_value => $options_name){
                            
                            $data = array(
                                "name"        => "delivery_status",
                                "id"          => "delivery_status",
                                "value"       => $option_value,
                                "style"       => "","required"	  => "required",
                                "class"       => "uniform"
                                );
                            echo form_radio($data)."<label for=\"delivery_status\" style=\"margin-left:10px;\">$options_name</label><br />";
                            
                        }
                    ?>
                    <?php echo form_error("delivery_status", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
            </div>
            
            
            <div class="form-group">
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                    echo form_label($this->lang->line('delivery_type'), "delivery_type", $label);
                ?>

                <div class="col-md-8">
                    <?php 
					$options = array("Yes" => "Yes", "No" => "No");
                        foreach($options as $option_value => $options_name){
                            
                            $data = array(
                                "name"        => "delivery_type",
                                "id"          => "delivery_type",
                                "value"       => $option_value,
                                "style"       => "","required"	  => "required",
                                "class"       => "uniform"
                                );
                            echo form_radio($data)."<label for=\"delivery_type\" style=\"margin-left:10px;\">$options_name</label><br />";
                            
                        }
                    ?>
                    <?php echo form_error("delivery_type", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
            </div>
            
            
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('package_weight'), "package_weight", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "package_weight",
                        "id"            =>  "package_weight",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('package_weight'),
                        "value"         =>  set_value("package_weight"),
                        "placeholder"   =>  $this->lang->line('package_weight')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("package_weight", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('package_dimensions'), "package_dimensions", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "package_dimensions",
                        "id"            =>  "package_dimensions",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('package_dimensions'),
                        "value"         =>  set_value("package_dimensions"),
                        "placeholder"   =>  $this->lang->line('package_dimensions')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("package_dimensions", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('delivery_cost'), "delivery_cost", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $number = array(
                        "type"          =>  "number",
                        "name"          =>  "delivery_cost",
                        "id"            =>  "delivery_cost",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('delivery_cost'),
                        "value"         =>  set_value("delivery_cost"),
                        "placeholder"   =>  $this->lang->line('delivery_cost')
                    );
                    echo  form_input($number);
                ?>
                <?php echo form_error("delivery_cost", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('payment_status'), "payment_status", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $number = array(
                        "type"          =>  "number",
                        "name"          =>  "payment_status",
                        "id"            =>  "payment_status",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('payment_status'),
                        "value"         =>  set_value("payment_status"),
                        "placeholder"   =>  $this->lang->line('payment_status')
                    );
                    echo  form_input($number);
                ?>
                <?php echo form_error("payment_status", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    );
                   echo form_label($this->lang->line('courier_notes'), "courier_notes", $label);
                ?>

                <div class="col-md-8">
                <?php
                    
                    $textarea = array(
                        "name"          =>  "courier_notes",
                        "id"            =>  "courier_notes",
                        "class"         =>  "form-control",
                        "style"         =>  "",
                        "title"         =>  $this->lang->line('courier_notes'),"required"	  => "required",
                        "rows"          =>  "",
                        "cols"          =>  "",
                        "value"         => set_value("courier_notes"),
                        "placeholder"   =>  $this->lang->line('courier_notes')
                    );
                    echo form_textarea($textarea);
                ?>
                <?php echo form_error("courier_notes", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('created_at'), "created_at", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "created_at",
                        "id"            =>  "created_at",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('created_at'),
                        "value"         =>  set_value("created_at"),
                        "placeholder"   =>  $this->lang->line('created_at')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("created_at", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="form-group">
            
                <?php
                    $label = array(
                        "class" => "col-md-2 control-label",
                        "style" => "",
                    ); echo form_label($this->lang->line('updated_at'), "updated_at", $label);      ?>

                <div class="col-md-8">
                <?php
                    
                    $text = array(
                        "type"          =>  "text",
                        "name"          =>  "updated_at",
                        "id"            =>  "updated_at",
                        "class"         =>  "form-control",
                        "style"         =>  "","required"	  => "required","title"         =>  $this->lang->line('updated_at'),
                        "value"         =>  set_value("updated_at"),
                        "placeholder"   =>  $this->lang->line('updated_at')
                    );
                    echo  form_input($text);
                ?>
                <?php echo form_error("updated_at", "<p class=\"text-danger\">", "</p>"); ?>
                </div>
                
                
                
            </div>
    
            <div class="col-md-offset-2 col-md-10">
            <?php
                $submit = array(
                    "type"  =>  "submit",
                    "name"  =>  "submit",
                    "value" =>  $this->lang->line('Save'),
					 "class" =>  "btn btn-primary",
                    "style" =>  ""
                );
                echo form_submit($submit); 
            ?>
            
            
            
            <?php
                $reset = array(
                    "type"  =>  "reset",
                    "name"  =>  "reset",
                    "value" =>  $this->lang->line('Reset'),
                    "class" =>  "btn btn-default",
                    "style" =>  ""
                );
                echo form_reset($reset); 
            ?>
            </div>
            <div style="clear:both;"></div>
            
            <?php echo form_close(); ?>
            
        </div>
		
	</div>
	</div>
	<!-- /MESSENGER -->
</div>
