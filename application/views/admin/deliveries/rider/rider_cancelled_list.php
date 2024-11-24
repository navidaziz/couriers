  <div class="table-responsive">
      <h4>Cancelled packages list</h4>
      <?php
        $query = "SELECT COUNT(*) as total_packages, SUM(amount) as total_amount   
                    FROM deliveries WHERE rider_id = ? and delivery_status='Cancelled'";
        $rider_delivery = $this->db->query($query, [$rider_id])->row();
        ?>
      <strong>Packages: <?php echo $rider_delivery->total_packages  ?></strong> -
      <strong>Amount: <?php echo $rider_delivery->total_amount  ?> </strong> Rs.
      <table class="table table-bordered table_small" id="Cancelled">
          <thead>
              <th>#</th>
              <th>Tracking No.</th>
              <th>Recipient Detail</th>
              <th>Amount</th>
          </thead>
          <tbody>
              <?php
                $total_amount = 0;
                $count = 1;
                $delivery_ids = array();
                $query = "SELECT d.*, cs.courier_service_name, cs.short_name, b.batch_no   FROM deliveries as d 
                                        INNER JOIN courier_services as cs ON(cs.courier_service_id = d.courier_service_id)
                                        INNER JOIN batches as b ON(b.batch_id = d.batch_id)
                                        WHERE d.rider_id = ? and delivery_status = 'Cancelled'
                                         ORDER BY last_updated DESC
                                        ";
                $rows = $this->db->query($query, [$rider_id])->result();
                foreach ($rows as $row) {
                    $delivery_ids[] = $row->delivery_id;
                ?>
                  <tr>
                      <td><?php echo $count++ ?></td>
                      <td><?php echo $row->tracking_number; ?>
                          <?php if ($row->delivery_status == 'Cancelled') { ?>
                              <form method="post" action="<?php echo site_url(ADMIN_DIR . "deliveries/remove_from_rider"); ?>"
                                  onsubmit="return confirm('Are you sure you want to remove this assigned package?');">
                                  <input type="hidden" value="<?php echo $row->rider_id ?>" name="rider_id" />
                                  <input type="hidden" value="<?php echo $row->delivery_id ?>" name="delivery_id" />
                                  <button>Remove</button>
                              </form>
                          <?php } ?>
                      </td>
                      <td><?php echo $row->recipient_name; ?><br />
                          <?php echo $row->recipient_address; ?><br />
                          <?php echo $row->recipient_contact; ?>
                          <?php if ($row->delivery_status == 'Cancelled') { ?>
                              <br />
                              <strong>sdfsdfs
                                  Note: <?php echo $row->cancelled_reason; ?>
                              </strong>
                          <?php } ?>
                      </td>
                      <td><?php echo $row->amount;
                            $total_amount += $row->amount;
                            ?></td>

                  </tr>
              <?php } ?>
          </tbody>
          <tfoot>
              <th></th>
              <th></th>
              <th>Total:</th>
              <th><?php echo $total_amount; ?></th>


          </tfoot>
      </table>

  </div>