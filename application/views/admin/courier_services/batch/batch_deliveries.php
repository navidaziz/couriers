  <?php if ($tab == 'Cancelled') { ?>
      <style>
          @keyframes buzz {

              0%,
              100% {
                  transform: translateX(0);
              }

              10%,
              30%,
              50%,
              70%,
              90% {
                  transform: translateX(-5px);
              }

              20%,
              40%,
              60%,
              80% {
                  transform: translateX(5px);
              }
          }

          .buzz {
              animation: buzz 0.2s ease-in-out;
              background-color: red;
              border: 1px solid red;

          }
      </style>
      <div id="errorDiv" class="box border blue" id="messenger" style="background-color:white; padding:4px; ">
          Return by Tracking No: <br />
          <input class="form-control" type="text" id="r_tracking_no" placeholder="Scan barcode here" autofocus>
          <div style="margin-top: 5px;" id="r_tracking_no_response"></div>
          <hr />

      </div>

      <script>
          // Add event listener for the input field
          const barcodeInput = document.getElementById('r_tracking_no');
          barcodeInput.addEventListener('keyup', function(event) {
              $('#r_tracking_no_response').html('');
              if (event.key === 'Enter') {
                  var tracking_no = $('#r_tracking_no').val();
                  $.ajax({
                      type: 'POST',
                      url: '<?php echo site_url(ADMIN_DIR . "courier_services/return_by_tracking_no"); ?>', // URL to submit form data
                      data: {
                          tracking_no: tracking_no,
                          batch_id: '<?php echo $batch->batch_id; ?>',
                          courier_service_id: '<?php echo $courier_service->courier_service_id; ?>',
                          tab: '<?php echo $tab; ?>'
                      },
                      success: function(response) {

                          if (response == 'success') {
                              $('#r_tracking_no').val('');
                              $('#r_tracking_no_response').fadeOut(200, function() {
                                  $(this).html('<div class="alert alert-success">Tracking ID: <strong>' + tracking_no + '</strong> <br />Returend Successfully.</div>').fadeIn(200);
                              });
                              batch_packages_list();
                              //location.reload();
                          } else {

                              $('#r_tracking_no_response').fadeOut(200, function() {
                                  $(this).html('<div class="alert alert-danger">' + response + '</div>').fadeIn(200);
                              });
                              triggerBuzz('errorDiv');
                          }


                      }
                  });
              }
          });

          function triggerBuzz(divId) {
              const div = document.getElementById(divId);
              // Add the buzz class
              div.classList.add('buzz');

              // Remove the class after the animation completes
              setTimeout(() => {
                  div.classList.remove('buzz');
              }, 200); // Matches the duration of the animation
          }
      </script>
  <?php } ?>
  <div id="batch_packages_list"></div>
  <script>
      function batch_packages_list() {

          $.ajax({
              type: 'POST',
              url: '<?php echo site_url(ADMIN_DIR . "courier_services/batch_packages_list"); ?>', // URL to submit form data
              data: {
                  batch_id: '<?php echo $batch->batch_id; ?>',
                  courier_service_id: '<?php echo $courier_service->courier_service_id; ?>',
                  tab: '<?php echo $tab; ?>'
              },
              success: function(response) {
                  //alert(response);
                  $('#batch_packages_list').html(response);
                  // $('#rider_assigned_list').fadeOut(200, function() {
                  //     $(this).html(response).fadeIn(200);

                  // });
              }
          });
      }
      batch_packages_list();
  </script>