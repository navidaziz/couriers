
public class DeliveryAddActivity extends AppCompatActivity {
	
	private text tracking_number;
				private text sender_name;
				private text sender_address;
				private text sender_contact;
				private text recipient_name;
				private text recipient_address;
				private text recipient_contact;
				private EditText courier_service_id;
				private EditText shipment_date;
				private EditText expected_delivery_date;
				private EditText delivery_status;
				private EditText delivery_type;
				private text package_weight;
				private text package_dimensions;
				private EditText amount;
				private EditText payment_status;
				private text courier_notes;
				private text created_at;
				private text updated_at;
				private Button btn_add_deliveries;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_add_delivery);
		
		tracking_number = (text)findViewById(R.id.tracking_number);
				sender_name = (text)findViewById(R.id.sender_name);
				sender_address = (text)findViewById(R.id.sender_address);
				sender_contact = (text)findViewById(R.id.sender_contact);
				recipient_name = (text)findViewById(R.id.recipient_name);
				recipient_address = (text)findViewById(R.id.recipient_address);
				recipient_contact = (text)findViewById(R.id.recipient_contact);
				courier_service_id = (EditText)findViewById(R.id.courier_service_id);
				shipment_date = (EditText)findViewById(R.id.shipment_date);
				expected_delivery_date = (EditText)findViewById(R.id.expected_delivery_date);
				delivery_status = (EditText)findViewById(R.id.delivery_status);
				delivery_type = (EditText)findViewById(R.id.delivery_type);
				package_weight = (text)findViewById(R.id.package_weight);
				package_dimensions = (text)findViewById(R.id.package_dimensions);
				amount = (EditText)findViewById(R.id.amount);
				payment_status = (EditText)findViewById(R.id.payment_status);
				courier_notes = (text)findViewById(R.id.courier_notes);
				created_at = (text)findViewById(R.id.created_at);
				updated_at = (text)findViewById(R.id.updated_at);
				btn_add_deliveries = (Button)findViewById(R.id.btn_add_deliveries);
		
		
btn_add_deliveries.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //do your code here
				final String form_tracking_number = tracking_number.getText().toString();
				final String form_sender_name = sender_name.getText().toString();
				final String form_sender_address = sender_address.getText().toString();
				final String form_sender_contact = sender_contact.getText().toString();
				final String form_recipient_name = recipient_name.getText().toString();
				final String form_recipient_address = recipient_address.getText().toString();
				final String form_recipient_contact = recipient_contact.getText().toString();
				final String form_courier_service_id = courier_service_id.getText().toString();
				final String form_shipment_date = shipment_date.getText().toString();
				final String form_expected_delivery_date = expected_delivery_date.getText().toString();
				final String form_delivery_status = delivery_status.getText().toString();
				final String form_delivery_type = delivery_type.getText().toString();
				final String form_package_weight = package_weight.getText().toString();
				final String form_package_dimensions = package_dimensions.getText().toString();
				final String form_amount = amount.getText().toString();
				final String form_payment_status = payment_status.getText().toString();
				final String form_courier_notes = courier_notes.getText().toString();
				final String form_created_at = created_at.getText().toString();
				final String form_updated_at = updated_at.getText().toString();
				
				
				RequestQueue request_queue = Volley.newRequestQueue(DeliveryAddActivity.this); 
				 StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/delivery/save_data", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								Toast.makeText(DeliveryAddActivity.this, server_response, Toast.LENGTH_SHORT).show();
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(DeliveryAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									params.put("tracking_number", form_tracking_number);
				params.put("sender_name", form_sender_name);
				params.put("sender_address", form_sender_address);
				params.put("sender_contact", form_sender_contact);
				params.put("recipient_name", form_recipient_name);
				params.put("recipient_address", form_recipient_address);
				params.put("recipient_contact", form_recipient_contact);
				params.put("courier_service_id", form_courier_service_id);
				params.put("shipment_date", form_shipment_date);
				params.put("expected_delivery_date", form_expected_delivery_date);
				params.put("delivery_status", form_delivery_status);
				params.put("delivery_type", form_delivery_type);
				params.put("package_weight", form_package_weight);
				params.put("package_dimensions", form_package_dimensions);
				params.put("amount", form_amount);
				params.put("payment_status", form_payment_status);
				params.put("courier_notes", form_courier_notes);
				params.put("created_at", form_created_at);
				params.put("updated_at", form_updated_at);
				
									return params;
								}
							};
							
				 request_queue.add(request);
				
				
            }
        });
//end here .....
		
		

     }

}
