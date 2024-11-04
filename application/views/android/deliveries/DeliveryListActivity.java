
public class DeliveryListActivity extends AppCompatActivity {
	
	static String[][] Items;
    private GoogleApiClient client;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_list_delivery);
		
		RequestQueue request_queue = Volley.newRequestQueue(DeliveryListActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/delivery/view", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								 Items = new String[JsonArray.length()][19];
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									Items[i][0] = json_object.getString("tracking_number");
				Items[i][1] = json_object.getString("sender_name");
				Items[i][2] = json_object.getString("sender_address");
				Items[i][3] = json_object.getString("sender_contact");
				Items[i][4] = json_object.getString("recipient_name");
				Items[i][5] = json_object.getString("recipient_address");
				Items[i][6] = json_object.getString("recipient_contact");
				Items[i][7] = json_object.getString("courier_service_id");
				Items[i][8] = json_object.getString("shipment_date");
				Items[i][9] = json_object.getString("expected_delivery_date");
				Items[i][10] = json_object.getString("delivery_status");
				Items[i][11] = json_object.getString("delivery_type");
				Items[i][12] = json_object.getString("package_weight");
				Items[i][13] = json_object.getString("package_dimensions");
				Items[i][14] = json_object.getString("delivery_cost");
				Items[i][15] = json_object.getString("payment_status");
				Items[i][16] = json_object.getString("courier_notes");
				Items[i][17] = json_object.getString("created_at");
				Items[i][18] = json_object.getString("updated_at");
				
			
								}
								
								DeliveryAdapter deliveryAdapter;
                    			deliveryAdapter = new DeliveryAdapter(DeliveryListActivity.this,Items);
                    			delivery_listView.setAdapter(deliveryAdapter);
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							    Toast.makeText(DeliveryListActivity, "Error in Json", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(DeliveryListActivity, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);
		
		
		
 delivery_listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent i = new Intent(DeliveryListActivity.this, DeliveryView.class);
                i.putExtra("delivery_id", Items[position][0]);
                startActivity(i);
            }
        });
		
		

        
    }

}
