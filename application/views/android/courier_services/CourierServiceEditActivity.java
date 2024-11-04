
public class CourierServiceEditActivity extends AppCompatActivity {
	
	private text courier_service_name;
				private text short_name;
				private EditText logo;
				private Button btn_update_courier_services;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_edit_courier_service);
		
		courier_service_name = (text)findViewById(R.id.courier_service_name);
				short_name = (text)findViewById(R.id.short_name);
				logo = (EditText)findViewById(R.id.logo);
				btn_edit_courier_services = (Button)findViewById(R.id.btn_update_courier_services);
		
		
		
		Intent intent = getIntent();
		String id = intent.getStringExtra("id");
		
		RequestQueue request_queue = Volley.newRequestQueue(CourierServiceEditActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/courier_service/view_courier_service/"+id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									courier_service_name.setText(json_object.getString("courier_service_name"));
				short_name.setText(json_object.getString("short_name"));
				logo.setText(json_object.getString("logo"));
				
			
								}
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							 //   Toast.makeText(MainActivity.this, "error", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(CourierServiceAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);



	
btn_update_courier_services.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
              final String form_courier_service_name = courier_service_name.getText().toString();
				final String form_short_name = short_name.getText().toString();
				final String form_logo = logo.getText().toString();
				
				
				RequestQueue request_queue = Volley.newRequestQueue(CourierServiceAddActivity.this); 
				 StringRequest request = new StringRequest(Request.Method.POST, url+"/mobile/courier_service/save_data/"+form_courier_service_id, new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								Toast.makeText(CourierServiceAddActivity.this, server_response, Toast.LENGTH_SHORT).show();
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(CourierServiceAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									params.put("courier_service_name", form_courier_service_name);
				params.put("short_name", form_short_name);
				params.put("logo", form_logo);
				
									return params;
								}
							};
							
				 request_queue.add(request);
				
				
            }
        });
//end here .....
		
		
        
    }

}
