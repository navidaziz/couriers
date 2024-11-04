
public class UserAddActivity extends AppCompatActivity {
	
	private EditText franchise_id;
				private EditText role_id;
				private text name;
				private text father_name;
				private text cnic;
				private text user_email;
				private text user_mobile_number;
				private text user_name;
				private text user_password;
				private text user_image;
				private Button btn_add_users;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.activity_add_user);
		
		franchise_id = (EditText)findViewById(R.id.franchise_id);
				role_id = (EditText)findViewById(R.id.role_id);
				name = (text)findViewById(R.id.name);
				father_name = (text)findViewById(R.id.father_name);
				cnic = (text)findViewById(R.id.cnic);
				user_email = (text)findViewById(R.id.user_email);
				user_mobile_number = (text)findViewById(R.id.user_mobile_number);
				user_name = (text)findViewById(R.id.user_name);
				user_password = (text)findViewById(R.id.user_password);
				user_image = (text)findViewById(R.id.user_image);
				btn_add_users = (Button)findViewById(R.id.btn_add_users);
		
		
btn_add_users.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //do your code here
				final String form_franchise_id = franchise_id.getText().toString();
				final String form_role_id = role_id.getText().toString();
				final String form_name = name.getText().toString();
				final String form_father_name = father_name.getText().toString();
				final String form_cnic = cnic.getText().toString();
				final String form_user_email = user_email.getText().toString();
				final String form_user_mobile_number = user_mobile_number.getText().toString();
				final String form_user_name = user_name.getText().toString();
				final String form_user_password = user_password.getText().toString();
				final String form_user_image = user_image.getText().toString();
				
				
				RequestQueue request_queue = Volley.newRequestQueue(UserAddActivity.this); 
				 StringRequest request = new StringRequest(Request.Method.POST, SERVER_URL+"/mobile/user/save_data", new Response.Listener<String>() {
								@Override
								public void onResponse(String server_response) {
								Toast.makeText(UserAddActivity.this, server_response, Toast.LENGTH_SHORT).show();
								}
							}, new Response.ErrorListener() {
								@Override
								public void onErrorResponse(VolleyError volleyError) {
								Toast.makeText(UserAddActivity.this, volleyError.toString(), Toast.LENGTH_SHORT).show();
								}
							}){
								@Override
								protected Map<String, String> getParams()  {
									HashMap<String,String> params = new HashMap<String,String>();
									params.put("franchise_id", form_franchise_id);
				params.put("role_id", form_role_id);
				params.put("name", form_name);
				params.put("father_name", form_father_name);
				params.put("cnic", form_cnic);
				params.put("user_email", form_user_email);
				params.put("user_mobile_number", form_user_mobile_number);
				params.put("user_name", form_user_name);
				params.put("user_password", form_user_password);
				params.put("user_image", form_user_image);
				
									return params;
								}
							};
							
				 request_queue.add(request);
				
				
            }
        });
//end here .....
		
		

     }

}
