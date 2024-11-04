
public class UserListActivity extends AppCompatActivity {
	
	static String[][] Items;
    private GoogleApiClient client;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_list_user);
		
		RequestQueue request_queue = Volley.newRequestQueue(UserListActivity.this);
		StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/user/view", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								try {
                    			JSONArray JsonArray = new JSONArray(server_response);
								 Items = new String[JsonArray.length()][10];
								for(int i=0; i<=JsonArray.length(); i++){
									JSONObject json_object = JsonArray.getJSONObject(i);
									Items[i][0] = json_object.getString("franchise_id");
				Items[i][1] = json_object.getString("role_id");
				Items[i][2] = json_object.getString("name");
				Items[i][3] = json_object.getString("father_name");
				Items[i][4] = json_object.getString("cnic");
				Items[i][5] = json_object.getString("user_email");
				Items[i][6] = json_object.getString("user_mobile_number");
				Items[i][7] = json_object.getString("user_name");
				Items[i][8] = json_object.getString("user_password");
				Items[i][9] = json_object.getString("user_image");
				
			
								}
								
								UserAdapter userAdapter;
                    			userAdapter = new UserAdapter(UserListActivity.this,Items);
                    			user_listView.setAdapter(userAdapter);
			
			
							} catch (JSONException e) {
								e.printStackTrace();
							    Toast.makeText(UserListActivity, "Error in Json", Toast.LENGTH_SHORT).show();
							}
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(UserListActivity, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									return params;
								}
							};
							
				 request_queue.add(request);
		
		
		
 user_listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent i = new Intent(UserListActivity.this, UserView.class);
                i.putExtra("user_id", Items[position][0]);
                startActivity(i);
            }
        });
		
		

        
    }

}
