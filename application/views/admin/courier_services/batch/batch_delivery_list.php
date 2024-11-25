  <?php $d_status = $tab; ?>
  <div class="table-responsive" id="printableDiv">


      <div class="table-responsive">

          <h4><?php echo $d_status; ?>Packages List</h4>
          <table class="table table-bordered table_medium deliveries_datatable" id="deliveries">
              <thead>
                  <th>#</th>
                  <th>Tracking No.</th>
                  <th>Recipient Name</th>
                  <th>Recipient Address</th>
                  <th>Recipient Contact</th>
                  <th>Verified</th>
                  <th>Rider</th>
                  <th>Delivery Status</th>
                  <th>Amount</th>
                  <?php if ($d_status == 'Pending' or $d_status == 'Cancelled') { ?>
                      <th>Action</th>
                  <?php } ?>
              </thead>
              <tbody>
                  <?php
                    $total_amount = 0;
                    $count = 1;
                    $query = "SELECT d.*, cs.courier_service_name, cs.short_name, b.batch_no   FROM deliveries as d 
                                INNER JOIN courier_services as cs ON(cs.courier_service_id = d.courier_service_id)
                                INNER JOIN batches as b ON(b.batch_id = d.batch_id)
                                WHERE d.delivery_status = '" . $d_status . "'
                                AND d.batch_id = '" . $batch->batch_id . "' ";
                    $rows = $this->db->query($query)->result();
                    foreach ($rows as $row) { ?>
                      <tr>
                          <td><?php echo $count++ ?></td>
                          <td><?php echo $row->tracking_number; ?></td>
                          <td><?php echo $row->recipient_name; ?></td>
                          <td><?php echo $row->recipient_address; ?></td>
                          <td><?php echo $row->recipient_contact; ?></td>
                          <td><?php echo $row->verified; ?></td>
                          <th>
                              <?php
                                if ($row->rider_id) {
                                    $query = "SELECT users.name, roles.role_title FROM users
                                                    INNER JOIN roles ON (roles.role_id = users.role_id)
                                                    WHERE user_id = $row->rider_id";
                                    $rider = $this->db->query($query)->row();
                                    echo  '<strong> ' . $rider->name . ' (' . $rider->role_title . ') </strong>';
                                }
                                ?>

                          </th>
                          <td><?php echo $row->delivery_status; ?></td>
                          <td><?php echo $row->amount;
                                $total_amount += $row->amount;
                                ?></td>
                          <?php if ($d_status == 'Pending') { ?>
                              <td><button onclick="get_delivery_form('<?php echo $row->delivery_id; ?>')">Edit<botton>
                              </td>
                          <?php } ?>
                          <?php if ($d_status == 'Cancelled') { ?>
                              <td>
                                  <form method="post" action="<?php echo site_url(ADMIN_DIR . "courier_services/return_item"); ?>"
                                      onsubmit="return confirm('Are you sure you want to return the item?');">
                                      <input type="hidden" value="<?php echo $row->delivery_id; ?>" name="delivery_id" />
                                      <input type="hidden" value="<?php echo $row->batch_id; ?>" name="batch_id" />
                                      <input type="hidden" value="<?php echo $row->courier_service_id; ?>" name="courier_service_id" />
                                      <button>Return</button>
                                  </form>
                              </td>
                          <?php } ?>
                      </tr>
                  <?php } ?>
              </tbody>
              <tfoot>
                  <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>Total Packages: </th>
                      <th><?php echo ($count - 1); ?></th>
                      <th style="text-align: right;">Total: </th>
                      <th><?php echo $total_amount; ?></th>
                      <?php if ($d_status == 'Pending' or $d_status == 'Cancelled') { ?>
                          <th></th>
                      <?php } ?>
                  </tr>
                  <?php if ($d_status == 'Completed') {
                        $query = "SELECT SUM(p.paid_amount) as total
                                        FROM payments AS p
                                        WHERE p.batch_id = '" . $batch->batch_id . "' 
                                        AND p.courier_service_id = '" . $courier_service->courier_service_id . "'";
                        $paid = $this->db->query($query)->row();
                    ?>
                      <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th style="text-align: right;">Paid: </th>
                          <th><?php echo $paid->total; ?></th>
                      </tr>
                      <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th style="text-align: right;">Remaining: </th>
                          <th><?php echo $total_amount - $paid->total; ?></th>
                      </tr>
                  <?php } ?>
              </tfoot>
          </table>
          <?php if ($d_status == 'Completed') { ?>
              <strong>Payments</strong>
              <table class="table table-bordered table_medium" id="payments">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Payee Name</th>
                          <th>Payment Date</th>
                          <th>Paid Amount</th>
                          <th>Payment Detail</th>
                          <th></th>
                          <?php if ($batch->payment_status == 'Unpaid') { ?>
                              <th>Action</th>
                          <?php } ?>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $count = 1;
                        $query = "SELECT p.*, 
                                        u.name AS created_by_user, 
                                        updated_by.name AS last_update_by 
                                        FROM payments AS p
                                        INNER JOIN users AS u ON (u.user_id = p.created_by)
                                        LEFT JOIN users AS updated_by ON (updated_by.user_id = p.updated_by)
                                        WHERE p.batch_id = '" . $batch->batch_id . "' 
                                        AND p.courier_service_id = '" . $courier_service->courier_service_id . "'";

                        $rows = $this->db->query($query)->result();
                        foreach ($rows as $row) { ?>
                          <tr>
                              <td><?php echo $count++ ?></td>
                              <td><?php echo $row->payee_name; ?></td>
                              <td><?php echo $row->payment_date; ?></td>
                              <td><?php echo $row->paid_amount; ?></td>
                              <td><?php echo $row->payment_detail; ?></td>
                              <td>
                                  <small>Created By: <?php echo $row->created_by_user ?> on date
                                      <?php echo date('Y-m-d', strtotime($row->created_date)); ?></small><br />
                                  <?php if ($row->last_updated) { ?>
                                      <small>last Updated : <?php echo date('Y-m-d', strtotime($row->last_updated)); ?>
                                          by <?php echo $row->last_update_by ?>
                                      </small>
                                  <?php } ?>

                              </td>
                              <?php if ($batch->payment_status == 'Unpaid') { ?>
                                  <td><button onclick="get_payment_form('<?php echo $row->payment_id; ?>')">Edit<botton>
                                          <?php } ?>
                                  </td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
              <?php if ($batch->payment_status == 'Unpaid') { ?>
                  <div style="text-align: center;">
                      <button onclick="get_payment_form('0')" class="btn btn-danger">Add Payment</button>
                  </div>
              <?php } ?>

              <script>
                  function get_payment_form(payment_id) {
                      $.ajax({
                              method: "POST",
                              url: "<?php echo site_url(ADMIN_DIR . 'courier_services/get_payment_form'); ?>",
                              data: {
                                  payment_id: payment_id,
                                  batch_id: <?php echo $batch->batch_id ?>,
                                  courier_service_id: <?php echo $courier_service->courier_service_id; ?>
                              },
                          })
                          .done(function(respose) {
                              $('#modal').modal('show');
                              $('#modal_title').html('Payments');
                              $('#modal_body').html(respose);
                          });
                  }
              </script>
          <?php } ?>


      </div>


  </div>
  <script>
      title = ' <?php echo $batch->courier_service_name; ?> - Batch No: <?php echo $batch->batch_no; ?> (<?php echo $batch->batch_date; ?>) -   <?php echo date('Y-m-d h:m:s') ?> ';

      $('.deliveries_datatable').DataTable({
          dom: 'Bfrtip', // Add 'f' for the search filter.
          paging: false,
          buttons: [{
                  extend: 'copy',
                  title: title
              },
              {
                  extend: 'csv',
                  title: title
              },
              {
                  extend: 'excel',
                  title: title
              },
              {
                  extend: 'pdf',
                  title: title
              },
              {
                  extend: 'print',
                  title: title
              }
          ],
          searching: true // Optional, enabled by default.
      });
  </script>