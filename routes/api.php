<?php

use Illuminate\Http\Request;
//use Illuminate\Contracts\Mail\Mailer;
include_once 'api_builder.php';
//header("Access-Control-Allow-Origin: *");
//last change 21-6-2017

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('signup', function(Request $request)
// {
	// $data = $request->json()->all();
	// echo $name=$data['name']; exit;
	        // $config = DB::table('userss')
                    
                    // ->select('userss.FirstName','userss.Email', 'userss.Password')
                    // ->get();

                     // $encode = json_encode($config, JSON_UNESCAPED_SLASHES);
                     // $response = Response::make($encode, 200);
                     // $response->header('Content-Type', 'application/json');
                     // return $response;
       // // echo $name = $request->input('name');
	   // // print_r($request);
// //print_r($parameter_name); exit;
// //DB::insert('insert into userss (FirstName, LastName,Email,Password,Mobile,CreatedDate,IsEnabled,usertype) values ("shubhangi", "shukla","shubhangi@gmail.com","12345","9923232322","2017-07-23 12:12:12",1,1)');
// });

Route::post('signup', function(Request $request)
{ 
header("Access-Control-Allow-Origin: *");
 $headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
	               $data = $request->json()->all();
				   $name=$data['name'];
                   $email=$data['email']; 
	               // $mobile=$data['mobile']; $email=$data['email']; 
	                $mobile=$data['mobile'];
				   $password= Hash::make($data['password']); 
				  // $config = DB::table('users')->where('email', $email)->value('email');
				   //$results = DB::select( DB::raw("SELECT * FROM users WHERE email = '$email'") );
				   //$user = DB::table('users')->where('email', 'shubhangi@gmail.com')->first();
                    $users = DB::table('users')
                    ->where('email',$email)
                    ->orWhere('mobile', $mobile)
                    ->get()->toArray();
					if(empty($users)){
						
						DB::insert('insert into users (first_name,email, mobile,password,usertype) values ("'.$name.'","'.$email.'", "'.$mobile.'","'.$password.'","app_user")');
						return response()->json(['success' => '1','msg'=>'Registered successfully']);
					} else{
						
						if($users[0]->email==$email){
							return response()->json(['error' => 'email exist in database','msg'=>'This email id is already in use']);
						}
						elseif($users[0]->mobile==$mobile){
							return response()->json(['error' => 'mobile number exist in database','msg'=>'This mobile number is already in use']);
							 
						}
					}
				   // if($results[0]->email==$email){
					   
					   
									  // echo "email already exist"; 
									   // }
					   // $result = DB::select( DB::raw("SELECT * FROM users WHERE mobile = '$mobile'") );
					   
					   				// if($result[0]->mobile==$mobile){
										// echo "mobile exist"; 
									// }
	                // $config = DB::table('users')
                    // ->select('users.email','users.mobile')
                    // ->get();
                       
					   // foreach($config as $res=>$val){
						   
                       // $email=  $val->email;
						   
					   // }
					    // exit;
                     $encode = json_encode($config, JSON_UNESCAPED_SLASHES);
                     $response = Response::make($encode, 200);
                     $response->header('Content-Type', 'application/json');
                     return $response;
       // echo $name = $request->input('name');
	   // print_r($request);
//print_r($parameter_name); exit;
//DB::insert('insert into userss (FirstName, LastName,Email,Password,Mobile,CreatedDate,IsEnabled,usertype) values ("shubhangi", "shukla","shubhangi@gmail.com","12345","9923232322","2017-07-23 12:12:12",1,1)');
});

//api for payment
Route::post('paymentauth', function(Request $request) {
	header("Access-Control-Allow-Origin: *");
	 $headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
		
    $data = $request->json()->all();
	$user_id=$data['user_id'];
	$first_name=$data['first_name'];
	$last_name=$data['last_name'];
	$cardnumber=$data['cardnumber'];
	$cvv=$data['cvv'];
	$expmonth=$data['expmonth'];
	$expyear=$data['expyear'];
	$amount=$data['amount'];
	//$userHash=$data['userHash'];
	$userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$result = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($result)>0){
		
	
	$params = array(

'x_invoice_num' => 'test',
'x_amount' => $amount,
'x_exp_date' => $data['expmonth'].$data['expyear'],
'x_first_name' => $first_name,
'x_last_name' => $last_name,
'x_relay_response' => false,
'x_type' => 'AUTH_CAPTURE',
'x_method' => 'CC',
'x_login' => '68yaDwR2H',
'x_tran_key' => '46y6EC57e7tCMP4v',
'x_card_num' => $cardnumber,
'x_card_code' => $cvv,
'x_delim_data' => true,
'x_delim_char' => '|',
'x_relay_response' => false
 );

 $postString = '';
 foreach ($params as $key => $value)
 $postString .= $key.'='.urlencode($value).'&';
 $postString = trim($postString, '&');
 //$url = 'https://secure.authorize.net/gateway/transact.dll';
$url= "https://test.authorize.net/gateway/transact.dll";
 $request = curl_init($url);
 curl_setopt($request, CURLOPT_HEADER, 0);
 curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($request, CURLOPT_POSTFIELDS, $postString);
 curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($request, CURLOPT_SSL_VERIFYHOST, false);
 $postResponse = curl_exec($request);
 curl_close($request);
 //print_r($postResponse);

 $response = explode('|', $postResponse);
  $msg= $response[3];
 $transactionid= $response[37];
 if($msg=="This transaction has been approved."){
	 $success=1;
 }else{
	 $success=0;
 }
	 
 return response()->json(['msg' => $msg,'transactionid'=>$transactionid,'success'=>$success]);
	}else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}
});


Route::post('signin', function(Request $request) {
	header("Access-Control-Allow-Origin: *");
	 $headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
    $data = $request->json()->all();
	$email=$data['email'];
	$password=$data['password'];
     
	  $users = DB::table('users')
                    ->where('email',$email)
                    ->get()->toArray();
					if(!empty($users)){
	          //echo $users[0]->password;
     $checkpassword=Hash::check($password, $users[0]->password);
	   if($checkpassword==1){
		   $str=$users[0]->id.':'.$users[0]->email.':'.$users[0]->mobile;
		   $encrpt=Hash::make($str);
		   
     		   DB::update('update users set userHash="'.$encrpt.'" where id="'.$users[0]->id.'"');
			   
		   return response()->json(['success' => '1','msg'=>'Login successfully','user_id'=>$users[0]->id,'userHash'=>$encrpt]);
	   }else{
		   
		   return response()->json(['error' => 'password not correct','msg'=>'Password is not correct']);
	   }
	 
					}else{
						return response()->json(['error' => 'email not exist','msg'=>'This email id is not correct']);
						
					}
      
  

});

Route::post('addlocation', function(Request $request) {
	header("Access-Control-Allow-Origin: *");
$headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
	$data = $request->json()->all();
	 $location_name=$data['location_name']; 
	$location_address=$data['location_address'];
	$city=$data['city'];
	$state=$data['state'];
	$zip=$data['zip'];
	$user_id=$data['user_id'];
	$address=$location_address.' '.$city.' '.$zip.' '.$state;
	$address = str_replace(" ", "+", $address);
	$datetime=date('Y-m-d h:i:s');
//$address = "India+Panchkula";
$userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$resultk = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($resultk)>0){
  $url = "https://maps.google.com/maps/api/geocode/json?address=$address&key=AIzaSyA02WLCd_YPGalluqfrbNJ2-yTAimRPPcc&sensor=false";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);


$response_a = json_decode($response);

if($response_a->status=="ZERO_RESULTS"){
	return response()->json(['error' => 'address not found','msg'=>'Please provide valid address']);
	
}else{
  $lat = $response_a->results[0]->geometry->location->lat;

 $long = $response_a->results[0]->geometry->location->lng;
 $result = DB::select( DB::raw("SELECT location_address FROM location WHERE user_id = $user_id and location_address='".$location_address."' " ) );
 $cou=count($result);
 
 if($cou>0){
	 return response()->json(['error' => 'location already exist','msg'=>'provide another location']); 
 }else{
$results= DB::insert('insert into location (user_id, location_name,lattitude,longitude,location_address,CreatedDate,city,state,country,zip) values ("'.$user_id.'", "'.$location_name.'","'.$lat.'","'.$long.'","'.$location_address.'","'.$datetime.'","'.$city.'","'.$state.'","India","'.$zip.'")');
//$lastid= DB::getPdo()->lastInsertId();  
 return response()->json(['success' => '1','msg'=>'Location has been added successfully']);
}
	 
 }
}else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}

});


// Route::post('editlocation', function(Request $request) {
	// header("Access-Control-Allow-Origin: *");
// $headers = [
            // 'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            // 'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        // ];
	// $data = $request->json()->all();
	// $location_id=$data['location_id']; 
	 // $location_name=$data['location_name']; 
	// $location_address=$data['location_address'];
	// $city=$data['city'];
	// $state=$data['state'];
	// $zip=$data['zip'];
	// $user_id=$data['user_id'];
	// $address=$location_address.'+'.$city.'+'.$zip.'+'.$state;
	// $service_type=$data['service_type'];
	// $car_fit=$data['car_fit'];
	// $city_sidewalk=$data['city_sidewalk'];
	// $drive_inclined=$data['drive_inclined'];
	// $driveway=$data['driveway'];
	// $information1=$data['information1'];
	// $mowing=$data['mowing'];
	// $cornor_lot=$data['cornor lot'];
	// $information2=$data['information2'];
	// $service_id=$data['service_id'];
	// $datetime=date('Y-m-d h:i:s');
// //$address = "India+Panchkula";

// $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// $response = curl_exec($ch);
// curl_close($ch);
// $response_a = json_decode($response);
// if($response_a->status=="ZERO_RESULTS"){
	// return response()->json(['error' => 'address not found','msg'=>'Please provide valid address']);
	
// }else{
 // $lat = $response_a->results[0]->geometry->location->lat;

 // $long = $response_a->results[0]->geometry->location->lng;
  // $result = DB::select( DB::raw("SELECT location_address,location_id FROM location WHERE user_id = $user_id and  location_address='$location_address'") );
// $countrows= count($result);
// if($countrows>0){
	
	// if($location_address==$result[0]->location_address && $result[0]->location_id!=$location_id ){
		
		// return response()->json(['error' => 'this address is already exist','msg'=>'Please provide another address']);
		
		
	// }if($location_address==$result[0]->location_address && $result[0]->location_id==$location_id){
		// DB::update('update location set location_name="'.$location_name.'",lattitude="'.$lat.'",longitude="'.$long.'",location_address="'.$location_address.'",CreatedDate="'.$datetime.'",city="'.$city.'",country="India",zip= "'.$zip.'" where location_id="'.$location_id.'"');
		
		// $results = DB::select( DB::raw("SELECT id FROM location WHERE location_id = $location_id") );
		// $countrowss= count($results);
		// if($countrowss>0){
		// DB::update('update services set service_type="'.$service_type.'",car_fit="'.$car_fit.'",city_sidewalk="'.$city_sidewalk.'",drive_inclined="'.$drive_inclined.'",information1="'.$information1.'",lot_size="'.$mowing.'",cornor_lot="'.$cornor_lot.'",information2= "'.$information2.'" where id="'.$service_id.'"');
		// }else{
			
			// DB::insert('insert into services (location_id, service_type,car_fit,city_sidewalk,drive_inclined,information1,lot_size,cornor_lot,information2) values ("'.$location_id.'", "'.$service_type.'","'.$car_fit.'","'.$city_sidewalk.'","'.$drive_inclined.'","'.$information1.'","'.$mowing.'","'.$cornor_lot.'","'.$information2.'")');
			
		// }
		// return response()->json(['success' => '1','msg'=>'Location has been edited successfully']);
		
	// }
	
		
// }else{
 // DB::update('update location set location_name="'.$location_name.'",lattitude="'.$lat.'",longitude="'.$long.'",location_address="'.$location_address.'",CreatedDate="'.$datetime.'",city="'.$city.'",country="India",zip= "'.$zip.'" where location_id="'.$location_id.'"');
 // return response()->json(['success' => '1','msg'=>'Location has been edited successfully']);
// }
// }


// });


Route::post('editlocation', function(Request $request) {
	header("Access-Control-Allow-Origin: *");
$headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
	$data = $request->json()->all();
	$location_id=$data['location_id']; 
	$edit_service=$data['edit_service'];
	 $location_name=$data['location_name']; 
	$location_address=$data['location_address'];
	$city=$data['city'];
	$state=$data['state'];
	$zip=$data['zip'];
	$user_id=$data['user_id'];
	$userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$resultk = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($resultk)>0){
	$address=$location_address.' '.$city.' '.$zip.' '.$state;
	$address = str_replace(" ", "+", $address);
	//$service_type=$data['service_type'];
	$car_fit=$data['car_fit'];
	$city_sidewalk=$data['city_sidewalk'];
	$drive_inclined=$data['drive_inclined'];
	//$driveway=$data['driveway'];
	$information1=$data['information1'];
	$mowing=$data['lot_size'];
	$cornor_lot=$data['cornor_lot'];
	$information2=$data['information2'];
	//$service_id=$data['service_id'];
	$datetime=date('Y-m-d h:i:s');
//$address = "India+Panchkula";

$url = "https://maps.google.com/maps/api/geocode/json?address=$address&key=AIzaSyA02WLCd_YPGalluqfrbNJ2-yTAimRPPcc&sensor=false";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);
$response_a = json_decode($response);
if($response_a->status=="ZERO_RESULTS"){
	return response()->json(['error' => 'address not found','msg'=>'Please provide valid address']);
	
}else{
 $lat = $response_a->results[0]->geometry->location->lat;

 $long = $response_a->results[0]->geometry->location->lng;
  $result = DB::select( DB::raw("SELECT location_id FROM location WHERE user_id = $user_id and  location_address='$location_address' and city='$city'") );
 $countrows= count($result); 
  if($countrows>0){
	if($result[0]->location_id!=$location_id ){
		
		return response()->json(['error' => 'this address is already exist','msg'=>'Please provide another address']);
		
		
  }else
	{
		
		DB::update('update location set location_name="'.$location_name.'",lattitude="'.$lat.'",longitude="'.$long.'",location_address="'.$location_address.'",CreatedDate="'.$datetime.'",city="'.$city.'",state="'.$state.'",country="India",zip= "'.$zip.'" where location_id="'.$location_id.'"');
		
		$results = DB::select( DB::raw("SELECT id FROM snow WHERE location_id = $location_id") );
		$countrowss= count($results);
		if($countrowss>0){
			if($edit_service==0 || $edit_service==2 ){
		DB::update('update snow set car_fit="'.$car_fit.'",city_sidewalk="'.$city_sidewalk.'",drive_inclined="'.$drive_inclined.'",information="'.$information1.'" where location_id="'.$location_id.'"');
		} }else{
			if($edit_service==0 || $edit_service==2){
			DB::insert('insert into snow (location_id, service_type,car_fit,city_sidewalk,drive_inclined,information) values ("'.$location_id.'", 0,"'.$car_fit.'","'.$city_sidewalk.'","'.$drive_inclined.'","'.$information1.'")');
			}
		}
		$resultss = DB::select( DB::raw("SELECT id FROM lawn WHERE location_id = $location_id") );
		$countrowsss= count($resultss);
		if($countrowsss>0){
			if($edit_service==1 || $edit_service==2){
		DB::update('update lawn set cornor_lot="'.$cornor_lot.'",lot_size="'.$mowing.'",information="'.$information2.'" where location_id="'.$location_id.'"');
			}}else{
				if($edit_service==1 || $edit_service==2){
			DB::insert('insert into lawn (location_id, service_type,cornor_lot,lot_size,information) values ("'.$location_id.'", 1,"'.$cornor_lot.'","'.$mowing.'","'.$information2.'")');
			}}
		return response()->json(['success' => '1','msg'=>'Location has been edited successfully']);
	}
	}else{
		DB::update('update location set location_name="'.$location_name.'",lattitude="'.$lat.'",longitude="'.$long.'",location_address="'.$location_address.'",CreatedDate="'.$datetime.'",city="'.$city.'",state="'.$state.'",country="India",zip= "'.$zip.'" where location_id="'.$location_id.'"');
		
		$results = DB::select( DB::raw("SELECT id FROM snow WHERE location_id = $location_id") );
		$countrowss= count($results);
		if($countrowss>0){
			if($edit_service==0 || $edit_service==2 ){
		DB::update('update snow set car_fit="'.$car_fit.'",city_sidewalk="'.$city_sidewalk.'",drive_inclined="'.$drive_inclined.'",information="'.$information1.'" where location_id="'.$location_id.'"');
		} }else{
			if($edit_service==0 || $edit_service==2){
			DB::insert('insert into snow (location_id, service_type,car_fit,city_sidewalk,drive_inclined,information) values ("'.$location_id.'", 0,"'.$car_fit.'","'.$city_sidewalk.'","'.$drive_inclined.'","'.$information1.'")');
			}
		}
		$resultss = DB::select( DB::raw("SELECT id FROM lawn WHERE location_id = $location_id") );
		$countrowsss= count($resultss);
		if($countrowsss>0){
			if($edit_service==1 || $edit_service==2){
		DB::update('update lawn set cornor_lot="'.$cornor_lot.'",lot_size="'.$mowing.'",information="'.$information2.'" where location_id="'.$location_id.'"');
			}}else{
				if($edit_service==1 || $edit_service==2){
			DB::insert('insert into lawn (location_id, service_type,cornor_lot,lot_size,information) values ("'.$location_id.'", 1,"'.$cornor_lot.'","'.$mowing.'","'.$information2.'")');
			}}
		return response()->json(['success' => '1','msg'=>'Location has been edited successfully']);
		
		
		
		
		
		
	}
	
		
// }else{
	
 // DB::update('update location set location_name="'.$location_name.'",lattitude="'.$lat.'",longitude="'.$long.'",location_address="'.$location_address.'",CreatedDate="'.$datetime.'",city="'.$city.'",country="India",zip= "'.$zip.'" where location_id="'.$location_id.'"');
 // return response()->json(['success' => '1','msg'=>'Location has been edited successfully']);
// }

}
}else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}

});


Route::post('dashboard', function(Request $request) {
	header("Access-Control-Allow-Origin: *");
$headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
		$rows=array(); 
		$data = $request->json()->all();
		$user_id=$data['user_id'];
       $i=0;
	   $j=0;
	 
	 $userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$resultk = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($resultk)>0){
	    $results = DB::select( DB::raw("SELECT o.*,l.* FROM orders o join location l on o.location_id=l.location_id WHERE o.user_id = $user_id and  o.order_date=CURDATE() order by o.id desc" ) );
		if(!empty($results)){
		foreach($results as $keys=>$val){
				 $id=$val->id; 
				$rows[$j]['id']=$id;
				$rows[$j]['user_id']=$val->user_id;
				 $rows[$j]['service_type']=$val->service_type; 
				$rows[$j]['service']=$val->service;
				$rows[$j]['location_id']=$val->location_id;
				$rows[$j]['total_price']=$val->total_price;
				$rows[$j]['pay_with']=$val->pay_with;
				$rows[$j]['status']=$val->status;
				$rows[$j]['is_accept']=$val->is_accept;
				$rows[$j]['worker_id']=$val->worker_id;
			    $rows[$j]['start_time']=$val->start_time;
			   	$rows[$j]['end_time']=$val->end_time;
			    $rows[$j]['before_image']=$val->before_image;
			    $rows[$j]['after_image']=$val->after_image;
				$rows[$j]['customer_rate']=$val->customer_rate;
				$rows[$j]['is_cancel']=$val->is_cancel;
				$rows[$j]['lotsize']=$val->lotsize;
				$rows[$j]['corner']=$val->corner;
				$rows[$j]['side_walk']=$val->side_walk;
				$rows[$j]['car_fit']=$val->car_fit;
				$rows[$j]['inclined']=$val->inclined; 
				$rows[$j]['worker_rating']=$val->worker_rating;
				$rows[$j]['comment']=$val->comment;   
				$rows[$j]['order_date']=$val->order_date;
				$rows[$j]['is_completed']=$val->is_completed;
				$rows[$j]['location_name']=$val->location_name;
				$rows[$j]['lattitude']=$val->lattitude;
				$rows[$j]['longitude']=$val->longitude;
				$rows[$j]['location_address']=$val->location_address;
				$rows[$j]['CreatedDate']=$val->CreatedDate;
				$rows[$j]['city']=$val->city;
				$rows[$j]['state']=$val->state;
				$rows[$j]['country']=$val->country;
				$rows[$j]['zip']=$val->zip;
				$rows[$j]['state']=$val->state;
			if($val->is_accept==1){
				 $resul = DB::select( DB::raw("SELECT w.first_name,w.mobile FROM worker w join orders o on w.id=o.worker_id WHERE o.id = $id" ) );
				 foreach($resul as $k=>$v){
				 $rows[$j]['first_name']=$v->first_name;
				 $rows[$j]['mobile']=$v->mobile; 
				 }
			}else{
				$rows[$j]['first_name']='';
				 $rows[$j]['mobile']=''; 
			}
			
			
			$j++;
		}
		}
      //$result = DB::select( DB::raw("SELECT *  FROM location WHERE user_id = $user_id ") );
	  // change to below code 25-4-2017 $result = DB::select( DB::raw("SELECT l.*, lawn.service_type as lawn_service,lawn.car_fit,lawn.city_sidewalk,lawn.drive_inclined,lawn.information as lawn_information,s.service_type as snow_service,s.lot_size,s.cornor_lot,s.information as snow_info FROM location l left join lawn on l.location_id=lawn.location_id left join snow s on lawn.location_id=s.location_id  WHERE l.user_id = $user_id ") );
	  $result = DB::select( DB::raw("SELECT l.location_id as locationid,l.location_name,l.location_address,l.state,l.city,l.zip,l.user_id,l.lattitude,l.longitude,l.CreatedDate, l.country,l.city,l.zip,snow.service_type as snow_service,snow.car_fit,snow.city_sidewalk,snow.drive_inclined,snow.information as snow_information,lawn.service_type as lawn_service,lawn.lot_size,lawn.cornor_lot,lawn.information as lawn_info FROM location l left join snow on l.location_id=snow.location_id left join lawn on snow.location_id=lawn.location_id  WHERE l.user_id = $user_id and l.is_deleted=0") );
	 if(!empty($result)){
	   foreach($result as $key=>$value){
		   
		   $row[$i]['location_id']=$value->locationid;
		    $row[$i]['user_id']=$value->user_id;
		   $row[$i]['location_name']=$value->location_name;
		   $row[$i]['lattitude']=$value->lattitude;
		   $row[$i]['longitude']=$value->longitude;
		   $row[$i]['CreatedDate']=$value->CreatedDate;
		   $row[$i]['city']=$value->city ;
		   $row[$i]['state']=$value->state ;
		   $row[$i]['country']=$value->country ;
		   $row[$i]['zip']=$value->zip ;
		   $row[$i]['location_address']=$value->location_address;
		   $row[$i]['snow']['car_fit']=$value->car_fit;
		    $row[$i]['snow']['snow_service']=$value->snow_service;
		   $row[$i]['snow']['city_sidewalk']=$value->city_sidewalk;
		    $row[$i]['snow']['drive_inclined']=$value->drive_inclined;
			 $row[$i]['snow']['snow_information']=$value->snow_information;
		    $row[$i]['lawn']['lot_size']=$value->lot_size;
			 $row[$i]['lawn']['cornor_lot']=$value->cornor_lot;
			 $row[$i]['lawn']['lawn_info']=$value->lawn_info;
		 
$i++;
	   }
	  //print_r($result); exit;
//$array    = array("val"=>$result);
//$json_str = json_encode($array);
        //return response()->json(['locations' => $row]);
	  
	  //print_r($result); exit;
//$array    = array("val"=>$result);
//$json_str = json_encode($array);
// if(empty($results)){
		  // return response()->json(['locations' => $row,'current_orders' => 'No orders found']);
	 // }
     return response()->json(['locations' => $row,'current_orders' => $rows]);
	 
	 
		//return response()->json(['success' => 'location added','msg'=>'Location has been added successfully']);
	 }else{
		 return response()->json(['error' => 1,'msg' => 'No Locations found, Please add at least one location to continue']); 
	 }
	 }else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}
		});

		Route::post('delete', function(Request $request) {
	 header("Access-Control-Allow-Origin: *");
$headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
		$data = $request->json()->all();
		$user_id=$data['user_id'];
		
		$location_id=$data['location_id'];
		$userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$resultk = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($resultk)>0){
	
		$result = DB::select( DB::raw("SELECT location_address FROM location WHERE location_id = $location_id") );
       $cou=count($result);
	   if($cou>0){
		//DB::table('location')->where('location_id', $location_id)->delete();
		DB::update('update location set is_deleted=1 where location_id="'.$location_id.'"');
 // return response()->json(['success' => '1','msg'=>'Location has been edited successfully']);
		return response()->json(['success' => '1']);
      //$result = DB::delete( DB::raw("delete * FROM location WHERE user_id = $user_id and location_id= $location_id") );
	  }else{
		  
		  return response()->json(['success' => '0','msg'=>'location does not exist']);
	  }
	  }else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}
	  //print_r($result); exit;
//$array    = array("val"=>$result);
//$json_str = json_encode($array);
 
		//return response()->json(['success' => 'location added','msg'=>'Location has been added successfully']);
		
		});
		
		
		// Route::post('addservice', function(Request $request) {
	// header("Access-Control-Allow-Origin: *");
// $headers = [
            // 'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            // 'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        // ];
		// $data = $request->json()->all();
		// //$user_id=$data['user_id'];
		// $location_id=$data['location_id'];
		

		// DB::table('location')->where('location_id', $location_id)->delete();
      // //$result = DB::delete( DB::raw("delete * FROM location WHERE user_id = $user_id and location_id= $location_id") ); 
	  
	  // //print_r($result); exit;
// //$array    = array("val"=>$result);
// //$json_str = json_encode($array);
 // return response()->json(['success' => '1']);
		// //return response()->json(['success' => 'location added','msg'=>'Location has been added successfully']);
		
		// });
		
		 Route::post('contactus', function(Request $request) {
	 header("Access-Control-Allow-Origin: *");
 $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ];
		 $data = $request->json()->all();
		
		 $user_id=$data['user_id'];
		 $message=$data['message'];
          $date =date('Y-m-d h:i:s');
		  $userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$resultk = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($resultk)>0){
		 DB::insert('insert into contactus (user_id, description,created_date) values ("'.$user_id.'", "'.$message.'","'.$date.'")');
      // //$result = DB::delete( DB::raw("delete * FROM location WHERE user_id = $user_id and location_id= $location_id") ); 
	  
	  // //print_r($result); exit;
// //$array    = array("val"=>$result);
// //$json_str = json_encode($array);
     return response()->json(['success' => '1']);
		// //return response()->json(['success' => 'location added','msg'=>'Location has been added successfully']);
		}else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}
		 });
		
		  Route::post('mail', function(Request $request) {
			 
			 

$message = [
            'title'     => 'Verification code',
            'intro'     => "Please verify your email address with ",
            'link'      => '',
            'confirmation_code' => '',
            'to_email'  => 'shubhangishukla47@gmail',
            'to_name'   => 'shubhangi',
        ];

        Mail::send('mailsend', $message, function($m) use($message) {
            $m->to($message['to_email'], $message['to_name'])
                    ->subject('Email verification');
        });
		  // $data = array('name'=>"Virat Gandhi");
          // Mail::send('mail', $data, function($message) {
          // $message->to('shubhangishukla47@gmail.com', 'Tutorials Point')->subject
             // ('Laravel HTML Testing Mail');
          // $message->from('shubhangishukla47@gmail.com','Virat Gandhi');
		  // });
		 // });
		
		
		 // public function html_email(){
      // $data = array('name'=>"Virat Gandhi");
      // Mail::send('mail', $data, function($message) {
         // $message->to('abc@gmail.com', 'Tutorials Point')->subject
            // ('Laravel HTML Testing Mail');
         // $message->from('xyz@gmail.com','Virat Gandhi');
       });
      // echo "HTML Email Sent. Check your inbox.";
   // }
   
    Route::post('resetpassword', function(Request $request) {
		 header("Access-Control-Allow-Origin: *");
 $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ];
		 $data = $request->json()->all();
		
		 $user_id=$data['user_id'];
		 $password=$data['new_password'];
		 
		 $new_password=Hash::make($data['new_password']); 
		 $userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$result = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($result)>0){
		  $users = DB::table('users')
                    ->where('id',$user_id)
                    ->get()->toArray();
					if(!empty($users)){
	          //echo $users[0]->password;
     $checkpassword=Hash::check($password, $users[0]->password);
	 
	   if($checkpassword==1){
		   
		   return response()->json(['error' => '1','msg'=>'Your new password cannot be same as old password.','user_id'=>$users[0]->id]);
	   }else{
		   DB::update('update users set password="'.$new_password.'" where id="'.$user_id.'"');
		 return response()->json(['success' => '1','msg'=>'Password changed successfully']);
		   
	   }
	 
					}
					}else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}
		
	});
   
   Route::post('place_order', function(Request $request) {
		 header("Access-Control-Allow-Origin: *");
 $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ];
		 
		  $data = $request->json()->all();
		  $user_id=$data['user_id'];
		  $userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$resultk = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($resultk)>0){
		  if($data['service_type']=='snow'){
          
		  $location_id=$data['location_id'];
		  $total_price=$data['total_price'];
		  $car_fit=$data['car_fit'];
		  $city_sidewalk=$data['city_sidewalk'];
		  $drive_inclined=$data['drive_inclined'];
		  $information=$data['information'];
		  $transactionid=$data['transactionid'];
		  $transactionmessage=$data['transactionmessage'];
		  $date=date('Y-m-d');
		  

		  $results= DB::insert('insert into orders (user_id, service_type,service,location_id,total_price,pay_with,status,start_time,end_time,before_image,after_image,customer_rate,is_cancel,lotsize,corner,side_walk,car_fit,inclined,worker_rating,comment,order_date,transactionid,transactionresponse) values ("'.$user_id.'", 1,"snow","'.$location_id.'","'.$total_price.'","0","In process","'.$date.'","'.$date.'"," "," ",0,0,0,0,"'.$city_sidewalk.'","'.$car_fit.'","'.$drive_inclined.'",0,"'.$information.'","'.$date.'","'.$transactionid.'","'.$transactionmessage.'")');
		   return response()->json(['success' => '1','msg'=>'Order has been placed']);
		  }
		  
		  if($data['service_type']=='lawn'){
			  $user_id=$data['user_id'];
			 $location_id=$data['location_id'];
			 $total_price=$data['total_price'];
			 $lot_size=$data['lot_size'];
			 $cornor_lot=$data['cornor_lot'];
			 $information=$data['information'];
			 $date=date('Y-m-d');
			 
			  $results= DB::insert('insert into orders (user_id, service_type,service,location_id,total_price,pay_with,status,start_time,end_time,before_image,after_image,customer_rate,is_cancel,lotsize,corner,side_walk,car_fit,inclined,worker_rating,comment,order_date) values ("'.$user_id.'", 0,"lawn","'.$location_id.'","'.$total_price.'","0","In Process","'.$date.'","'.$date.'"," "," ",0,0,"'.$lot_size.'","'.$cornor_lot.'",0,0,0,0,"'.$information.'","'.$date.'")');
			  return response()->json(['success' => '1','msg'=>'Order has been placed']);
			 
		  }
}else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}
		  
   });
   
    Route::post('past_orders', function(Request $request) {
	   header("Access-Control-Allow-Origin: *");
       $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ]; 
		$data = $request->json()->all();
		
		 $user_id=$data['user_id'];
		 $userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$resultk = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($resultk)>0){
	    $result = DB::select( DB::raw("SELECT o.*,l.* FROM orders o join location l on o.location_id=l.location_id WHERE o.user_id = $user_id and o.is_completed=1 and order_date<CURDATE() order by o.id desc" ) );
		if(count($result)>0){
         return response()->json(['pastorders' => $result]);
		}else{
			
			 return response()->json(['msg' => 'No record found.']);
		}
		}else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}
	   });
	   
	   
	   Route::post('current_orders', function(Request $request) {
	    header("Access-Control-Allow-Origin: *");
       $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ]; 
		$data = $request->json()->all();
		 $user_id=$data['user_id'];
		$userHash=base64_decode($data['userHash']);
	//echo $userHash; exit;
	$resultk = DB::select( DB::raw("SELECT userHash FROM users WHERE id = '$user_id' and userHash='$userHash'") );
	if(count($resultk)>0){
	    $result = DB::select( DB::raw("SELECT o.*,l.* FROM orders o join location l on o.location_id=l.location_id WHERE o.user_id = $user_id and  o.order_date=CURDATE()" ) );
		if(count($result)>0){
         return response()->json(['current_orders' => $result]);
		}else{
			
			 return response()->json(['msg' => 'No record found.']);
		}
		}else{
		$msg='Invalid token';
		return response()->json(['msg' => $msg,'success'=>0]);
	}
	   });
	   
	       Route::post('rating', function(Request $request) {
	    header("Access-Control-Allow-Origin: *");
       $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ]; 
		 $data = $request->json()->all();
		
		 $order_id=$data['order_id'];
         $customer_rating=$data['customer_rating'];
		 $worker_rating=$data['worker_rating'];
        if($customer_rating!='') {
			
	   DB::update('update orders set customer_rate="'.$customer_rating.'" where id="'.$order_id.'"');
	    }elseif($worker_rating!=''){
			DB::update('update orders set worker_rating="'.$worker_rating.'" where id="'.$order_id.'"');
		}
         return response()->json(['success' => 1]);
		
	   });
	   
	   // Route::post('opportunities', function(Request $request) {
		 
		 // header("Access-Control-Allow-Origin: *");
       // $headers = [
             // 'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             // 'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         // ]; 
		// $data = $request->json()->all();
		 // //$user_id=$data['user_id'];
		// $lat1=$data['lattitude'];
		// $lon1=$data['longitude'];
		 // $unit = "K";
        // $row=array();
		// function distance($lat1, $lon1, $lat2, $lon2, $unit) {

		  // $theta = $lon1 - $lon2;
		  // $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  // $dist = acos($dist);
		  // $dist = rad2deg($dist);
		  // $miles = $dist * 60 * 1.1515;
		  // $unit = strtoupper($unit);

		  // if ($unit == "K") {
			// return ($miles * 1.609344);
		  // } else if ($unit == "N") {
			  // return ($miles * 0.8684);
			// } else {
				// return $miles;
			  // }
		// }
          
		 // $result = DB::select( DB::raw("SELECT o.*,l.*,u.* FROM orders o join location l on o.location_id=l.location_id join users u on l.user_id=u.id " ) );
		

		// foreach($result as $key=>$value){
			
			 // $lat2=$value->lattitude; 
			 // $lon2=$value->longitude; 
			// $ran=distance($lat1, $lon1, $lat2, $lon2, $unit);
              // $location_address=$value->location_address;
			
			// if($ran<=20)
			// {
				
				 // // $row[]['latitude']=$lat2;
				 // // $row[]['longitude']=$lon2;
				 // // $row[]['user_id']=$r['user_id'];
				
				// $row[$value->location_id]['latitude']=$lat2;
				// $row[$value->location_id]['longitude']=$lon2;
				// $row[$value->location_id]['name']=$value->email;
				 // $row[$value->location_id]['location_name']=$value->location_name;
				 // $row[$value->location_id]['location_address']=$value->location_address;
				  // $row[$value->location_id]['city']=$value->city;
				   // $row[$value->location_id]['zip']=$value->zip;
				   // $row[$value->location_id]['total_amount']=$value->total_price;
				    // $row[$value->location_id]['distance']=$ran;
			    // // $row[$value->location_id]['location_address']=$location_address;
			
			// //print_r($row);
				// //print_R($r);
				
			// }
		// }
		// $use["location_id"][]=$row;
		
		// return response()->json(['opportunities' => $use]);
// // $json = str_replace('\/','/',json_encode($use));
		// // return $json;
	 // });
	 // Route::post('opportunities', function(Request $request) {
		 
		 // header("Access-Control-Allow-Origin: *");
       // $headers = [
             // 'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             // 'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         // ]; 
		// $data = $request->json()->all();
		 // //$user_id=$data['user_id'];
		// $lat1=$data['lattitude'];
		// $lon1=$data['longitude'];
		// $filter_type=$data['filter_type'];
		
		 // $unit = "N";
        // $row=array();
		// $arr=array();
		// function distance($lat1, $lon1, $lat2, $lon2, $unit) {

		  // $theta = $lon1 - $lon2;
		  // $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  // $dist = acos($dist);
		  // $dist = rad2deg($dist);
		  // $miles = $dist * 60 * 1.1515;
		  // $unit = strtoupper($unit);

		  // if ($unit == "K") {
			// return ($miles * 1.609344);
		  // } else if ($unit == "N") {
			  // return ($miles * 0.8684);
			// } else {
				// return $miles;
			  // }
		// }
          
		 // $result = DB::select( DB::raw("SELECT o.id as order_id,o.service,o.service_type,o.total_price,o.comment,l.location_id,l.location_name,l.location_address,l.city,l.state,l.zip,l.lattitude,l.longitude,u.email,u.first_name FROM orders o left join location l on o.location_id=l.location_id left join users u on l.user_id=u.id where o.is_accept=0 and o.is_completed=0 " ) );
		

		// foreach($result as $key=>$value){
			
			 // $lat2=$value->lattitude; 
			 // $lon2=$value->longitude; 
			// $ran=distance($lat1, $lon1, $lat2, $lon2, $unit);
              // $location_address=$value->location_address;
			
			// if($ran<=20)
			// {
				
				 // // $row[]['latitude']=$lat2;
				 // // $row[]['longitude']=$lon2;
				 // // $row[]['user_id']=$r['user_id'];
				// $row['order_id']=$value->order_id;
				// $row['lattitude']=$lat2;
				// $row['longitude']=$lon2;
				// $row['first_name']=$value->first_name;
				// $row['email']=$value->email;
				 // $row['locationname']=$value->location_name;
				 // $row['address']=$value->location_address;
				 // $row['state']=$value->state;
				 // $row['service']=$value->service;
				 // $row['service_type']=$value->service_type;
				  // $row['city']=$value->city;
				   // $row['zip']=$value->zip;
				   // $row['price']=$value->total_price;
				   // $row['comment']=$value->comment;
				    // $row['distance']=round($ran, 2);
					
			    // // $row[$value->location_id]['location_address']=$location_address;
			 // $arr[]=$row;
			 
			// //print_r($row);
				// //print_R($r);
				
			// }else{
			  // $count=1;
			// }
			
		
		// }
// if(!empty($arr)){
		// if($filter_type=='distance'){
		// $sort = array();
// foreach($arr as $k=>$v) {
    // $sort['distance'][$k] = $v['distance'];
// }

// array_multisort($sort['distance'], SORT_ASC, $arr);

		// }
		// if($filter_type=='price'){
			
			// $sort = array();
// foreach($arr as $k=>$v) {
    // $sort['price'][$k] = $v['price'];
// }

// array_multisort($sort['price'], SORT_ASC, $arr);
		// }

		// //$use["orders"][]=$row;
		
		// return response()->json(['orders' => $arr]);
// }else{
	// return response()->json(['error' => 1,'msg'=>'you are out of range']);
// }
// // $json = str_replace('\/','/',json_encode($use));
	// if($count==1){
		// return response()->json(['error' => 1]);
		
	// }
		// // return $json;
	 // });
	 Route::post('opportunities', function(Request $request) {
		 
		 header("Access-Control-Allow-Origin: *");
       $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ]; 
		$data = $request->json()->all();
		 //$user_id=$data['user_id'];
		$lat1=$data['lattitude'];
		$lon1=$data['longitude'];
		$filter_type=$data['filter_type'];
		$worker_id=$data['worker_id'];
		 $unit = "N";
        $row=array();
		$arr=array();
		function distance($lat1, $lon1, $lat2, $lon2, $unit) {

		  $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);

		  if ($unit == "K") {
			return ($miles * 1.609344);
		  } else if ($unit == "N") {
			  return ($miles * 0.8684);
			} else {
				return $miles;
			  }
		}
          $servicheck = DB::select( DB::raw("SELECT lawn_service,snow_service from company_details c join worker on worker.user_id=c.provider_id where worker.id=".$worker_id." " ) );
		  if(count($servicheck)>0){
			  foreach($servicheck as $key=>$value){
				  $lawn=$value->lawn_service;
				  $snow=$value->snow_service;
				  
			  }
			  if($lawn==1){
			  $result = DB::select( DB::raw("SELECT o.id as order_id,o.service,o.service_type,o.total_price,o.comment,l.location_id,l.location_name,l.location_address,l.city,l.state,l.zip,l.lattitude,l.longitude,u.email,u.first_name FROM orders o left join location l on o.location_id=l.location_id left join users u on l.user_id=u.id where o.is_accept=0 and o.is_completed=0 and o.service='lawn'" ) );
			  }
			  if($snow==1){
				 $result = DB::select( DB::raw("SELECT o.id as order_id,o.service,o.service_type,o.total_price,o.comment,l.location_id,l.location_name,l.location_address,l.city,l.state,l.zip,l.lattitude,l.longitude,u.email,u.first_name FROM orders o left join location l on o.location_id=l.location_id left join users u on l.user_id=u.id where o.is_accept=0 and o.is_completed=0 and o.service='snow'" ) ); 
				  
			  }
			  if($lawn==1 && $snow==1){
				  
				  $result = DB::select( DB::raw("SELECT o.id as order_id,o.service,o.service_type,o.total_price,o.comment,l.location_id,l.location_name,l.location_address,l.city,l.state,l.zip,l.lattitude,l.longitude,u.email,u.first_name FROM orders o left join location l on o.location_id=l.location_id left join users u on l.user_id=u.id where o.is_accept=0 and o.is_completed=0" ) ); 
			  }
			  if($lawn==0 && $snow==0){
			  return response()->json(['error' => 1,'msg'=>'No service found']);
			  }
			  
		  
		 
		

		foreach($result as $key=>$value){
			
			 $lat2=$value->lattitude; 
			 $lon2=$value->longitude; 
			$ran=distance($lat1, $lon1, $lat2, $lon2, $unit);
              $location_address=$value->location_address;
			
			if($ran<=20)
			{
				
				 // $row[]['latitude']=$lat2;
				 // $row[]['longitude']=$lon2;
				 // $row[]['user_id']=$r['user_id'];
				$row['order_id']=$value->order_id;
				$row['lattitude']=$lat2;
				$row['longitude']=$lon2;
				$row['first_name']=$value->first_name;
				$row['email']=$value->email;
				 $row['locationname']=$value->location_name;
				 $row['address']=$value->location_address;
				 $row['state']=$value->state;
				 $row['service']=$value->service;
				 $row['service_type']=$value->service_type;
				  $row['city']=$value->city;
				   $row['zip']=$value->zip;
				   $row['price']=$value->total_price;
				   $row['comment']=$value->comment;
				    $row['distance']=round($ran, 2);
					
			    // $row[$value->location_id]['location_address']=$location_address;
			 $arr[]=$row;
			 
			//print_r($row);
				//print_R($r);
				
			}else{
			  $count=1;
			}
			
		
		}
		
if(!empty($arr)){
		if($filter_type=='distance'){
		$sort = array();
foreach($arr as $k=>$v) {
    $sort['distance'][$k] = $v['distance'];
}

array_multisort($sort['distance'], SORT_ASC, $arr);

		}
		if($filter_type=='price'){
			
			$sort = array();
foreach($arr as $k=>$v) {
    $sort['price'][$k] = $v['price'];
}

array_multisort($sort['price'], SORT_ASC, $arr);
		}

		//$use["orders"][]=$row;
		
		return response()->json(['orders' => $arr]);
}else{
	return response()->json(['error' => 1,'msg'=>'you are out of range']);
}
// $json = str_replace('\/','/',json_encode($use));
	if($count==1){
		return response()->json(['error' => 1]);
		
	}
	}else{
		
				return response()->json(['error' => 1,'msg'=>'no service found']);
	}
		// return $json;
	 });
	 Route::post('accept_order', function(Request $request) {
		 
		 header("Access-Control-Allow-Origin: *");
       $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ]; 
		 $data = $request->json()->all();
		 //$user_id=$data['user_id'];
		  $order_id=$data['order_id'];
		  $is_accept=$data['is_accept'];
		  $worker_id=$data['worker_id'];
          $lat1=	$data['lat'];
          $lon1= $data['long']; 
           $unit = "N";
		   function distance($lat1, $lon1, $lat2, $lon2, $unit) {

		  $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);

		  if ($unit == "K") {
			return ($miles * 1.609344);
		  } else if ($unit == "N") {
			  return ($miles * 0.8684);
			} else {
				return $miles;
			  }
		}
		 
		 
		  	 $results = DB::select( DB::raw("SELECT l.lattitude,l.longitude FROM location l left join orders o on l.location_id=o.location_id  where o.id=$order_id " ) );
		

		foreach($results as $key=>$value){
			
			 $lat2=$value->lattitude; 
			 $lon2=$value->longitude;
			 $ran=distance($lat1, $lon1, $lat2, $lon2, $unit);
			 $dis=round($ran, 2);
		}
		
		  
		  if($is_accept==1){
			DB::update('update orders set is_accept=1,worker_id="'.$worker_id.'" ,status=" '.$dis.' Miles Away",distance="'.$dis.'" where id="'.$order_id.'" and is_completed=0');
		   $result = DB::select( DB::raw("SELECT o.*,l.* ,u.first_name,u.mobile FROM orders o join location l on o.location_id=l.location_id join users u on l.user_id=u.id WHERE o.id = $order_id") );
		   
         return response()->json(['current_location' => $result,'success' => 1]);
			  //return response()->json(['success' => 1]);
		}else{
			  return response()->json(['error' => 0]);
		}
		});
		Route::get('clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
      });
	  Route::post('worker_task_status', function(Request $request) {
			
			header("Access-Control-Allow-Origin: *");
       $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ];   
		   $data = $request->json()->all();
			//$start_time=date('Y-m-d h:i:s');
			$worker_id= $data['worker_id'];
		    //$is_start= $data['is_start'];
//$newfilename =  $data['uploaded_file'];
			//$newfilename= time().str_replace(' ', '_', $_FILES['uploaded_file']['name']);
	        // $target_dir = "/home/developer/public_html/ober/public/images/";
			// $target_file = $target_dir .'/'. $newfilename;
			
			// $data = base64_decode($newfilename);
			// $file = $target_dir . uniqid() . '.png';
			// $success = file_put_contents($file, $data);
			  // //substr_replace($file,'/home/developer/public_html/ober/public/images/',);	//$img = $_POST['img'];
			// $img= substr($file, 47);
           // $path = 'http://88.198.133.25/ober/public/images/'.$img;
				$i=0;
			// DB::update('update orders set start_time="'.$start_time.'",before_image="'.$path.'" ,status="Started" where id="'.$order_id.'"');
		   //$result = DB::select( DB::raw("SELECT o.*,l.* FROM orders o join location l on o.location_id=l.location_id WHERE o.id = $order_id" ) );
		   $result = DB::select( DB::raw("SELECT o.*,l.* ,u.first_name,u.mobile FROM orders o join location l on o.location_id=l.location_id join users u on l.user_id=u.id WHERE o.worker_id = $worker_id and o.customer_rate<1") );
		   if(count($result)>0){
		   foreach($result as $key=>$val){
			   
			   
			   
			   $is_accept=$val->is_accept;
			   $is_started=$val->status;
			   $is_rated=$val->customer_rate;
			   $is_finished=$val->is_completed;
              if($is_started=='Started'){
				  $is_started="1";
 
			  }elseif($is_started=='In Process'){
				  
				  $is_started="0";
			  }
			  elseif($is_started=='Completed'){
				  $is_started="1";
			  }
			  else{
				  $is_started="0";
				  
			 }
			  if($is_rated>0){
				  
				  $is_rated="1";
			  }else{
				  $is_rated="0";
			  }
			  $row[$i]['id']=$val->id;
			  $row[$i]['user_id']=$val->user_id;
			  $row[$i]['service_type']=$val->service_type;
			  $row[$i]['location_id']=$val->location_id;
			  $row[$i]['location_id']=$val->location_id;
			  $row[$i]['pay_with']=$val->pay_with;
			  $row[$i]['worker_id']=$val->worker_id;
			  $row[$i]['start_time']=$val->start_time;
			  $row[$i]['before_image']=$val->before_image;
			  $row[$i]['after_image']=$val->after_image;
			  $row[$i]['is_cancel']=$val->is_cancel;
			  $row[$i]['lotsize']=$val->lotsize;
			  $row[$i]['corner']=$val->corner;
			  $row[$i]['side_walk']=$val->side_walk;
			  $row[$i]['car_fit']=$val->car_fit;
			  $row[$i]['worker_rating']=$val->worker_rating;
			  $row[$i]['comment']=$val->comment;
			  $row[$i]['total_price']=$val->total_price;
			  $row[$i]['order_date']=$val->order_date;
			 $row[$i]['distance']=$val->distance;
			  $row[$i]['transactionid']=$val->transactionid;
			  $row[$i]['transactionresponse']=$val->transactionresponse;
			  $row[$i]['location_name']=$val->location_name;
			   $row[$i]['lattitude']=$val->lattitude;
			    $row[$i]['longitude']=$val->longitude;
				 $row[$i]['location_address']=$val->location_address;
				  $row[$i]['CreatedDate']=$val->CreatedDate;
				   $row[$i]['city']=$val->city;
				    $row[$i]['state']=$val->state;
					 $row[$i]['country']=$val->country;
					  $row[$i]['is_deleted']=$val->is_deleted;
					   $row[$i]['first_name']=$val->first_name;
					   $row[$i]['mobile']=$val->mobile;
					   $row[$i]['is_rated']=$is_rated;
					   $row[$i]['is_started']=$is_started;
					   $row[$i]['is_accept']=$val->is_accept;
					    $row[$i]['is_completed']=$val->is_completed;
			     $row[$i]['distance']=$val->distance;
			  $i++;
		   }
          return response()->json(['success' => 1,'task_detail'=>$row]);
			  //return response()->json(['success' => 1]);
		   }else{
			   return response()->json(['success' => 0,'msg'=>'No records']);
		   }
			
			});	
	 Route::post('task_start', function(Request $request) {
			
			header("Access-Control-Allow-Origin: *");
       $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ]; 
		   $data = $request->json()->all();
			$start_time=date('Y-m-d h:i:s');
			$order_id= $data['order_id'];
		    $is_start= $data['is_start'];
			$newfilename =  $data['uploaded_file'];
			//$newfilename= time().str_replace(' ', '_', $_FILES['uploaded_file']['name']);
			$publicpath=public_path();
		   
			$target_dir = $publicpath.'/images/'; // upload path
	        //$target_dir = "/home/developer/public_html/ober/public/images/";
			$target_file = $target_dir .'/'. $newfilename;
			
			$data = base64_decode($newfilename);
			$file = $target_dir . uniqid() . '.png';
			$success = file_put_contents($file, $data);
			  //substr_replace($file,'/home/developer/public_html/ober/public/images/',);	//$img = $_POST['img'];
			$img= substr($file, 47);
			$host = $request->getSchemeAndHttpHost();
		  $folder=$host.'/images/';
		   $path = $folder.$img;
           //$path = 'http://88.198.133.25/ober/public/images/'.$img;
				
			DB::update('update orders set start_time="'.$start_time.'",before_image="'.$path.'" ,status="Started" where id="'.$order_id.'"');
		   //$result = DB::select( DB::raw("SELECT o.*,l.* FROM orders o join location l on o.location_id=l.location_id WHERE o.id = $order_id" ) );
		   $result = DB::select( DB::raw("SELECT o.*,l.* ,u.first_name,u.mobile FROM orders o join location l on o.location_id=l.location_id join users u on l.user_id=u.id WHERE o.id = $order_id") );
          return response()->json(['success' => 1,'task_detail'=>$result]);
			  //return response()->json(['success' => 1]);
		
			
			});	
			
			Route::post('task_completed', function(Request $request) {
					header("Access-Control-Allow-Origin: *");
       $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ]; 
		   $data = $request->json()->all();
			$end_time=date('Y-m-d h:i:s');
			$order_id= $data['order_id'];
		    $is_completed= $data['is_completed'];
			$rating= $data['rating'];
            $newfilename = $data['uploaded_file'];
			//$newfilename= time().str_replace(' ', '_', $_FILES['uploaded_file']['name']);
	        //$target_dir = "/home/developer/public_html/ober/public/images/";
			$publicpath=public_path();
		   
			$target_dir = $publicpath.'/images/'; // upload path
			$target_file = $target_dir .'/'. $newfilename;
			
			
			$data = base64_decode($newfilename);
			$file = $target_dir . uniqid() . '.png';
			$success = file_put_contents($file, $data);
			  //substr_replace($file,'/home/developer/public_html/ober/public/images/',);	//$img = $_POST['img']; 
			$img= substr($file, 47);
			$host = $request->getSchemeAndHttpHost();
		  $folder=$host.'/images/';
		   $path = $folder.$img;
          // $path = 'http://88.198.133.25/ober/public/images/'.$img;
		
			DB::update('update orders set end_time="'.$end_time.'",after_image="'.$path.'" ,status="Completed" ,worker_rating= "'.$rating.'",is_completed=1 where id="'.$order_id.'"');
		   //$result = DB::select( DB::raw("SELECT o.*,l.* FROM orders o join location l on o.location_id=l.location_id WHERE o.id = $order_id" ) );
		    $result = DB::select( DB::raw("SELECT o.*,l.* ,u.first_name,u.mobile FROM orders o join location l on o.location_id=l.location_id join users u on l.user_id=u.id WHERE o.id = $order_id") );
         return response()->json(['success' => 1,'task_detail'=>$result]);
			  //return response()->json(['success' => 1]);

				
			});
			
			Route::post('worker_signin', function(Request $request) {
				header("Access-Control-Allow-Origin: *");
	 $headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
    $data = $request->json()->all();
	$email=$data['email'];
	$password=$data['password'];
     
	  $users = DB::table('worker')
                    ->where('email',$email)
                    ->get()->toArray();
					if(!empty($users)){
	          //echo $users[0]->password;
     $checkpassword=Hash::check($password, $users[0]->password);
	   if($checkpassword==1){
		   
		 $result = DB::select( DB::raw("SELECT u.status as company_status,w.status as worker_status FROM worker w join users u on u.id=w.user_id WHERE w.id = ".$users[0]->id."") );
		 if(count($result)>0){
     foreach($result as $key=>$val){
		 
		 $company_status=$val->company_status;
		 $worker_status=$val->worker_status;
		 
       		 
	 }
             if($company_status!='pending' && $worker_status!='Denied' ){
				 return response()->json(['success' => '1','msg'=>'Login successfully','worker_id'=>$users[0]->id]);
               
			 }
			 else{
				 
           return response()->json(['success' => '0','msg'=>'Worker is not active','worker_id'=>$users[0]->id]);
			 }
		   //return response()->json(['success' => '1','msg'=>'Login successfully','worker_id'=>$users[0]->id]);
		 }else{
			 return response()->json(['success' => '0','msg'=>'Status not found ']);
		 }   
	   }else{
		   
		   return response()->json(['error' => 'password not correct','msg'=>'Password is not correct']);
	   }
	 
					}else{
						return response()->json(['error' => 'email not exist','msg'=>'This email id is not correct']);
						
					}
				
				});
				
			Route::post('worker_resetpassword', function(Request $request) {
		 header("Access-Control-Allow-Origin: *");
 $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ];
		 $data = $request->json()->all();
		
		 $worker_id=$data['worker_id'];
		 $password=$data['new_password'];
		 $new_password=Hash::make($data['new_password']); 
		  $users = DB::table('worker')
                    ->where('id',$worker_id)
                    ->get()->toArray();
					if(!empty($users)){
	          //echo $users[0]->password;
     $checkpassword=Hash::check($password, $users[0]->password);
	   if($checkpassword==1){
		   
		   return response()->json(['error' => '1','msg'=>'Your new password cannot be same as old password','worker_id'=>$users[0]->id]);
	   }else{
		   DB::update('update worker set password="'.$new_password.'" where id="'.$worker_id.'"');
		 return response()->json(['success' => '1','msg'=>'Password changed successfully']);
		   
	   }
	 
					}
		
	});	
			 	Route::post('prices', function(Request $request) {
		 header("Access-Control-Allow-Origin: *");
 $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ];
		 $data = $request->json()->all();
		
		 $mowing=$data['mowing'];
		
		 $result = DB::select( DB::raw("SELECT * from settings") );
		 //$result[0]->price_mowing1; 
	   if($mowing==1){
		   $price=$result[0]->price_mowing1;
		   return response()->json(['price'=>$price]);
	   }
	  if($mowing==2){
		   $price=$result[0]->price_mowing2;
		   return response()->json(['price'=>$price]);
	   }
			 if($mowing==3){
		   $price=$result[0]->price_mowing3;
		   return response()->json(['price'=>$price]);
	   }	
	 if($mowing==4){
		   $price=$result[0]->price_mowing4;
		   return response()->json(['price'=>$price]);
	   }
	 if($mowing==5){
		   $price=$result[0]->price_mowing5;
		   return response()->json(['price'=>$price]);
	   }	   
		
	});	
	
	
			Route::post('forgotpassword', function(Request $request) {
			header("Access-Control-Allow-Origin: *");
       $headers = [
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
         ]; 
		   $data = $request->json()->all();
			
			$email= $data['email'];
		     $result = DB::select( DB::raw("SELECT id FROM worker WHERE email= '$email'") );
             if(count($result)>0){
				 //send email code here 
           return response()->json(['success' => 1,'msg'=>'New password has been sent to the registered email']);
			 }else{
				 
				  return response()->json(['success' => 0,'msg'=>'email does not exist.']);
			 }
			  //return response()->json(['success' => 1]);
		
			
			});
				
				