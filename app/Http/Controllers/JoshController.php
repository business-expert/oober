<?php 

//last change 22-6-2017
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Securimage;
use Sentinel;
use View;
use Excel;
use Session;
use Carbon\Carbon;
use App\User;
use App\Worker;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
class JoshController extends Controller {

	protected $countries = array(
			""   => "Select Country",
			"AF" => "Afghanistan",
			"AL" => "Albania",
			"DZ" => "Algeria",
			"AS" => "American Samoa",
			"AD" => "Andorra",
			"AO" => "Angola",
			"AI" => "Anguilla",
			"AR" => "Argentina",
			"AM" => "Armenia",
			"AW" => "Aruba",
			"AU" => "Australia",
			"AT" => "Austria",
			"AZ" => "Azerbaijan",
			"BS" => "Bahamas",
			"BH" => "Bahrain",
			"BD" => "Bangladesh",
			"BB" => "Barbados",
			"BY" => "Belarus",
			"BE" => "Belgium",
			"BZ" => "Belize",
			"BJ" => "Benin",
			"BM" => "Bermuda",
			"BT" => "Bhutan",
			"BO" => "Bolivia",
			"BA" => "Bosnia and Herzegowina",
			"BW" => "Botswana",
			"BV" => "Bouvet Island",
			"BR" => "Brazil",
			"IO" => "British Indian Ocean Territory",
			"BN" => "Brunei Darussalam",
			"BG" => "Bulgaria",
			"BF" => "Burkina Faso",
			"BI" => "Burundi",
			"KH" => "Cambodia",
			"CM" => "Cameroon",
			"CA" => "Canada",
			"CV" => "Cape Verde",
			"KY" => "Cayman Islands",
			"CF" => "Central African Republic",
			"TD" => "Chad",
			"CL" => "Chile",
			"CN" => "China",
			"CX" => "Christmas Island",
			"CC" => "Cocos (Keeling) Islands",
			"CO" => "Colombia",
			"KM" => "Comoros",
			"CG" => "Congo",
			"CD" => "Congo, the Democratic Republic of the",
			"CK" => "Cook Islands",
			"CR" => "Costa Rica",
			"CI" => "Cote d'Ivoire",
			"HR" => "Croatia (Hrvatska)",
			"CU" => "Cuba",
			"CY" => "Cyprus",
			"CZ" => "Czech Republic",
			"DK" => "Denmark",
			"DJ" => "Djibouti",
			"DM" => "Dominica",
			"DO" => "Dominican Republic",
			"EC" => "Ecuador",
			"EG" => "Egypt",
			"SV" => "El Salvador",
			"GQ" => "Equatorial Guinea",
			"ER" => "Eritrea",
			"EE" => "Estonia",
			"ET" => "Ethiopia",
			"FK" => "Falkland Islands (Malvinas)",
			"FO" => "Faroe Islands",
			"FJ" => "Fiji",
			"FI" => "Finland",
			"FR" => "France",
			"GF" => "French Guiana",
			"PF" => "French Polynesia",
			"TF" => "French Southern Territories",
			"GA" => "Gabon",
			"GM" => "Gambia",
			"GE" => "Georgia",
			"DE" => "Germany",
			"GH" => "Ghana",
			"GI" => "Gibraltar",
			"GR" => "Greece",
			"GL" => "Greenland",
			"GD" => "Grenada",
			"GP" => "Guadeloupe",
			"GU" => "Guam",
			"GT" => "Guatemala",
			"GN" => "Guinea",
			"GW" => "Guinea-Bissau",
			"GY" => "Guyana",
			"HT" => "Haiti",
			"HM" => "Heard and Mc Donald Islands",
			"VA" => "Holy See (Vatican City State)",
			"HN" => "Honduras",
			"HK" => "Hong Kong",
			"HU" => "Hungary",
			"IS" => "Iceland",
			"IN" => "India",
			"ID" => "Indonesia",
			"IR" => "Iran (Islamic Republic of)",
			"IQ" => "Iraq",
			"IE" => "Ireland",
			"IL" => "Israel",
			"IT" => "Italy",
			"JM" => "Jamaica",
			"JP" => "Japan",
			"JO" => "Jordan",
			"KZ" => "Kazakhstan",
			"KE" => "Kenya",
			"KI" => "Kiribati",
			"KP" => "Korea, Democratic People's Republic of",
			"KR" => "Korea, Republic of",
			"KW" => "Kuwait",
			"KG" => "Kyrgyzstan",
			"LA" => "Lao People's Democratic Republic",
			"LV" => "Latvia",
			"LB" => "Lebanon",
			"LS" => "Lesotho",
			"LR" => "Liberia",
			"LY" => "Libyan Arab Jamahiriya",
			"LI" => "Liechtenstein",
			"LT" => "Lithuania",
			"LU" => "Luxembourg",
			"MO" => "Macau",
			"MK" => "Macedonia, The Former Yugoslav Republic of",
			"MG" => "Madagascar",
			"MW" => "Malawi",
			"MY" => "Malaysia",
			"MV" => "Maldives",
			"ML" => "Mali",
			"MT" => "Malta",
			"MH" => "Marshall Islands",
			"MQ" => "Martinique",
			"MR" => "Mauritania",
			"MU" => "Mauritius",
			"YT" => "Mayotte",
			"MX" => "Mexico",
			"FM" => "Micronesia, Federated States of",
			"MD" => "Moldova, Republic of",
			"MC" => "Monaco",
			"MN" => "Mongolia",
			"MS" => "Montserrat",
			"MA" => "Morocco",
			"MZ" => "Mozambique",
			"MM" => "Myanmar",
			"NA" => "Namibia",
			"NR" => "Nauru",
			"NP" => "Nepal",
			"NL" => "Netherlands",
			"AN" => "Netherlands Antilles",
			"NC" => "New Caledonia",
			"NZ" => "New Zealand",
			"NI" => "Nicaragua",
			"NE" => "Niger",
			"NG" => "Nigeria",
			"NU" => "Niue",
			"NF" => "Norfolk Island",
			"MP" => "Northern Mariana Islands",
			"NO" => "Norway",
			"OM" => "Oman",
			"PK" => "Pakistan",
			"PW" => "Palau",
			"PA" => "Panama",
			"PG" => "Papua New Guinea",
			"PY" => "Paraguay",
			"PE" => "Peru",
			"PH" => "Philippines",
			"PN" => "Pitcairn",
			"PL" => "Poland",
			"PT" => "Portugal",
			"PR" => "Puerto Rico",
			"QA" => "Qatar",
			"RE" => "Reunion",
			"RO" => "Romania",
			"RU" => "Russian Federation",
			"RW" => "Rwanda",
			"KN" => "Saint Kitts and Nevis",
			"LC" => "Saint LUCIA",
			"VC" => "Saint Vincent and the Grenadines",
			"WS" => "Samoa",
			"SM" => "San Marino",
			"ST" => "Sao Tome and Principe",
			"SA" => "Saudi Arabia",
			"SN" => "Senegal",
			"SC" => "Seychelles",
			"SL" => "Sierra Leone",
			"SG" => "Singapore",
			"SK" => "Slovakia (Slovak Republic)",
			"SI" => "Slovenia",
			"SB" => "Solomon Islands",
			"SO" => "Somalia",
			"ZA" => "South Africa",
			"GS" => "South Georgia and the South Sandwich Islands",
			"ES" => "Spain",
			"LK" => "Sri Lanka",
			"SH" => "St. Helena",
			"PM" => "St. Pierre and Miquelon",
			"SD" => "Sudan",
			"SR" => "Suriname",
			"SJ" => "Svalbard and Jan Mayen Islands",
			"SZ" => "Swaziland",
			"SE" => "Sweden",
			"CH" => "Switzerland",
			"SY" => "Syrian Arab Republic",
			"TW" => "Taiwan, Province of China",
			"TJ" => "Tajikistan",
			"TZ" => "Tanzania, United Republic of",
			"TH" => "Thailand",
			"TG" => "Togo",
			"TK" => "Tokelau",
			"TO" => "Tonga",
			"TT" => "Trinidad and Tobago",
			"TN" => "Tunisia",
			"TR" => "Turkey",
			"TM" => "Turkmenistan",
			"TC" => "Turks and Caicos Islands",
			"TV" => "Tuvalu",
			"UG" => "Uganda",
			"UA" => "Ukraine",
			"AE" => "United Arab Emirates",
			"GB" => "United Kingdom",
			"US" => "United States",
			"UM" => "United States Minor Outlying Islands",
			"UY" => "Uruguay",
			"UZ" => "Uzbekistan",
			"VU" => "Vanuatu",
			"VE" => "Venezuela",
			"VN" => "Viet Nam",
			"VG" => "Virgin Islands (British)",
			"VI" => "Virgin Islands (U.S.)",
			"WF" => "Wallis and Futuna Islands",
			"EH" => "Western Sahara",
			"YE" => "Yemen",
			"ZM" => "Zambia",
			"ZW" => "Zimbabwe"
	);
	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;

    /**
     * Initializer.
     *
     */
	public function __construct()
	{
		$this->messageBag = new MessageBag;

	}

	/**
	* Crop Demo
	*/
	public function crop_demo()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$targ_w = $targ_h = 150;
			$jpeg_quality = 99;

			$src = base_path().'/public/assets/img/cropping-image.jpg';
		//dd($src);
			$img_r = imagecreatefromjpeg($src);

			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

			imagecopyresampled($dst_r,$img_r,0,0,intval($_POST['x']),intval($_POST['y']), $targ_w,$targ_h, intval($_POST['w']),intval($_POST['h']));

			header('Content-type: image/jpeg');
			imagejpeg($dst_r,null,$jpeg_quality);

			exit;
		}
	}

    public function showHome(Request $request)
    {
    	if(Sentinel::check())
			 if(Sentinel::getUser()->usertype=='admin'){
		   $company= User::where('usertype', 'provider');
   
			$users= User::where('usertype', 'provider')->where('created_at', '>=', Carbon::now()->subMonth())->count();
		$result = DB::select( DB::raw("select avg(orders.customer_rate) as rating from orders join users on orders.user_id = users.id where users.usertype = 'app_user' group by orders.user_id having rating < 4" ) ); 
		$cou=count($result);
		$results = DB::select( DB::raw("select avg(orders.worker_rating) as rating from orders join worker on orders.worker_id = worker.id group by orders.worker_id having rating < 4" )); 
		 $count=count($results);
		 
		 $incomegraphrecord = $this->incomegraphrecord();
		  $customergraphrecord = $this->customergraphrecord();
		  $date1="";
		  $date2="";
		  $date3="";
		  $date4="";
		//return View::make('admin.index', compact('users'));
		if(!empty($request->input('fromdate') && $request->input('todate'))){
			
			 // if(!empty($_GET['fromdate']) && !empty($_GET['todate'])) {
				  $Record = DB::select(DB::raw("SELECT count(*) as total,DATE(created_at) as createdat FROM `users` WHERE usertype='provider' and YEAR(created_at) = YEAR(CURRENT_DATE()) and DATE(created_at) between '$fromdate' and '$todate' group by DATE(created_at)"));
				  $dateArray = array();
				  $scoreArray = array();
				  foreach($Record as $datas1=>$datas){
					  
					  $dateArray[]= '"'.$datas->createdat.'"';
					  $scoreArray[] ='['.$datas->total.']';
					  
				  }
				 // print_r($dateArray); exit;
				  $xaxisdata= implode(',',$dateArray); echo "<br>";
				  $yaxisdate=implode(',',$scoreArray);
		}else{
			$xaxisdata='';
			 $dates = array('"Jan"', '"Feb"', '"March"','"April"','"May"','"June"','"July"','"Aug"','"Sep"','"Oct"','"Nov"','"Dec"');
			 $xaxisdata= implode(',',$dates);
			 
			 $values = array($incomegraphrecord['jan'],$incomegraphrecord['feb'],$incomegraphrecord['mar'],$incomegraphrecord['april'],$incomegraphrecord['may'],$incomegraphrecord['june'],$incomegraphrecord['july'],$incomegraphrecord['aug'],$incomegraphrecord['sep'],$incomegraphrecord['oct'],$incomegraphrecord['nov'],$incomegraphrecord['dec']);
			 
			 $yaxisdate=implode(',',$values);
			 
			 //customer data
			 $dates1 = array('"Jan"', '"Feb"', '"March"','"April"','"May"','"June"','"July"','"Aug"','"Sep"','"Oct"','"Nov"','"Dec"');
			 $customerxaxisdata= implode(',',$dates1);
			 $jan=$customergraphrecord['jan'];
			 $feb=$customergraphrecord['jan']+$customergraphrecord['feb'];
			 $mar=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar'];
			 $apr=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april'];
			 
			 $may=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may'];
			 $jun=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june'];
			 $july=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july'];
			 $aug=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug'];
			 $sep=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug']+$customergraphrecord['sep'];
			 
			 $oct=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug']+$customergraphrecord['sep']+$customergraphrecord['oct'];
			 $nov=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug']+$customergraphrecord['sep']+$customergraphrecord['oct']+$customergraphrecord['nov'];
			 
			 $dec=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug']+$customergraphrecord['sep']+$customergraphrecord['oct']+$customergraphrecord['nov']+$customergraphrecord['dec'];
			 
			 $values1 = array($jan,$feb,$mar,$apr,$may,$jun,$july,$aug,$sep,$oct,$nov,$dec);
			 
			 $cutsomeryaxisdate=implode(',',$values1);
			 
			 
		}
		return View::make('admin.index')->with('users', $users)->with('cou', $cou)->with('count', $count)->with('company', $company)->with('graphRecords',$incomegraphrecord)->with('graphRecord',$customergraphrecord)->with('xaxisdata',$xaxisdata)->with('yaxisdate',$yaxisdate)->with('customerxaxisdata',$customerxaxisdata)->with('cutsomeryaxisdate',$cutsomeryaxisdate)->with('date1',$date1)->with('date2',$date2)->with('date3',$date3)->with('date4',$date4);
			 }if(Sentinel::getUser()->usertype=='provider'){
				 $id=Sentinel::getUser()->id;
				 
				 $result = DB::select( DB::raw("SELECT users.address,users.state,users.cityuser,users.company_name,users.email,users.mobile,company_details.ein FROM users left join company_details on users.id=company_details.provider_id where users.id=$id ") );
		 
		    return View::make('admin.provider',['provider' => $result]);
				//return View::make('admin.provider');

				 
			 }
    }
   
   
   
    public function showView($name=null)
    {

    	if(View::exists('admin/'.$name))
		{
			if(Sentinel::check())
				return view('admin.'.$name);
			else
				return redirect('admin/signin')->with('error', 'You must be logged in!');
		}
		else
		{
			return view('admin.404');
		}
    }

    public function showFrontEndView($name=null)
    {

        if(View::exists($name))
        {
            return view($name);
        }
        else
        {
            return view('admin.404');
        }
    }

	public function add_company(Request $request){
		      $date=date('Y-m-d h:i:s');
               $user = new User;
               $user->company_name = $request->input('name');
			   $user->first_name = $request->input('firstname');
               $user->email = $request->input('email');
			   $user->mobile = $request->input('mobile');
               $user->password = Hash::make($request->input('password'));
			    $user->address=$request->input('address');
			   $user->cityuser=$request->input('city');
	           $user->state=$request->input('state');
			   $user->postal=$request->input('zip');
			   $user->usertype='provider';
			    $user->status='status';
			   $user->created_at=date('Y-m-d h:i:s');
			   $zip= $request->input('postal');
			   $address=$user->address.' '.$user->cityuser.' '.$user->postal.' '.$user->state;
			   $address = str_replace(" ", "+", $address);
			   
			    $url = "https://maps.google.com/maps/api/geocode/json?address=$address&key=AIzaSyA02WLCd_YPGalluqfrbNJ2-yTAimRPPcc&sensor=false";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);


            $response_a = json_decode($response);
			if($response_a->status!="ZERO_RESULTS"){
	$lat = $response_a->results[0]->geometry->location->lat;

 $long = $response_a->results[0]->geometry->location->lng;
	
}else{
	$lat = "";

 $long = "";
}
  
				$user->save();
				$pid=$user->id; 
				$ein= $request->input('ein');
				$bank= $request->input('bank');
				$acno= $request->input('acno');
				$rount= $request->input('rount');
				$billadd= $request->input('billadd');
				 $snow=$request->input('snow');
					if($snow=='Snow'){
						$sno=1;
						
					}else{
						$sno=0;
					}				 
						 $lawn=$request->input('lawn');
					if($lawn=='Lawn'){
							$lan=1;
						
					}else{
						$lan=0;
}	
				 $btype=$request->input('btype');
				$insurance= Input::file('insurance');
				if($insurance!=''){
					$publicpath=public_path();
		   
			$destinationPath = $publicpath.'/images/'; // upload path
				  //$destinationPath = '/home/developer/public_html/ober/public/images/'; // upload path
      $extension = Input::file('insurance')->getClientOriginalExtension(); // getting image extension
      $fileName = rand(11111,99999).'.'.$extension; // renameing image
      if(Input::file('insurance')->move($destinationPath, $fileName)){
		   $host = $request->getSchemeAndHttpHost();
		  $folder=$host.'/ober/public/images/';
		   $path = $folder.$fileName; 
	  } else{
		  $path='';
	  }	  
				}else{
                 $path='';
				}
	 	 //end image upload
 
			  DB::insert('insert into company_details (provider_id, ein,bank_name,account_number,rounting_number,billing_address,insurance,lawn_service,snow_service,buisness_type,lat,lng) values ("'.$pid.'","'.$ein.'","'.$bank.'","'.$acno.'","'.$rount.'","'.$billadd.'","'.$path.'","'.$lan.'","'.$sno.'","'.$btype.'","'.$lat.'","'.$long.'")');
			   DB::insert('insert into role_users (user_id, role_id,created_at,updated_at) values ("'.$pid.'",1,"'.$date.'","'.$date.'")');
			   
			   DB::insert('insert into activations (user_id, code,completed,completed_at,created_at,updated_at) values ("'.$pid.'","7zY8f3fEjxLuVnow6WNF2hWFaT1w9erF",1,"'.$date.'","'.$date.'","'.$date.'")');
  
		  return Redirect::back(); 
	}
   public function getservice(){
		 $id=Sentinel::getUser()->id;
		 $result = DB::select( DB::raw("SELECT lawn_service,snow_service FROM company_details where provider_id=$id ") );
		 	  return View::make('admin.service',['result' => $result]);
	}
	public function getinsurance(){
		 $id=Sentinel::getUser()->id;
		 $result = DB::select( DB::raw("SELECT insurance FROM company_details where provider_id=$id ") );
		 	  return View::make('admin.insurance',['result' => $result]);
	}
	public function getlogo(){
		 $id=Sentinel::getUser()->id;
		 $result = DB::select( DB::raw("SELECT logo FROM company_details where provider_id=$id ") );
		 	  return View::make('admin.provider',['result' => $result]);
	}
	
	// public function getname(){
		 // $id=Sentinel::getUser()->id;
		 // $results = DB::select( DB::raw("SELECT first_name FROM users where id=99 ") );
		 	  // return View::make('admin.layouts.headerprovider',['results' => $results]);
	// }
	 public function changestatus(Request $request){		 
		    $status = $_GET['status']; 
		   $id = $_GET['ids']; 
		 $result = DB::select( DB::raw("update `users` set status='".$status."' where id= ".$id."  ") );
		 	   return Redirect::back(); 
	}
	 public function changestatusworker(Request $request){		 
		    $status = $_GET['status']; 
		   $id = $_GET['ids']; 
		 $result = DB::select( DB::raw("update `worker` set status='".$status."' where id= ".$id."  ") );
		 	   return Redirect::back(); 
	} 
	
	 public function addcompanies(Request $request){		 
		   
		$date=date('Y-m-d h:i:s');
               $user = new User;
			    
               $user->company_name = $_GET['name'];
			   $user->first_name = $_GET['firstname'];
               $user->email = $_GET['email'];
			   $user->mobile = $_GET['mobile'];
               $user->password = Hash::make($_GET['password']);
			    $user->address=$_GET['address'];
			   $user->cityuser=$_GET['city'];
	           $user->state=$_GET['state'];
			   $user->postal=$_GET['zip'];
			   $user->usertype='provider';
			   $user->status='pending';
			   $user->created_at=date('Y-m-d h:i:s');
			   //$zip= $request->input('postal');
			   $user->save();
				$pid=$user->id; 
				
			   $address=$user->address.' '.$user->cityuser.' '.$user->postal.' '.$user->state;
			   $address = str_replace(" ", "+", $address);
			   
			    $url = "https://maps.google.com/maps/api/geocode/json?address=$address&key=AIzaSyA02WLCd_YPGalluqfrbNJ2-yTAimRPPcc&sensor=false";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);


            $response_a = json_decode($response);
			if($response_a->status!="ZERO_RESULTS"){
	$lat = $response_a->results[0]->geometry->location->lat;

 $long = $response_a->results[0]->geometry->location->lng;
	
}else{
	$lat = "";

 $long = "";
}
  
				
				$ein= $_GET['ein'];
				$bank= $_GET['bank'];
				$acno= $_GET['acno'];
				$rount= $_GET['rount'];
				$billadd=$_GET['billadd'];
				 //$snow=$_GET['service');
					if($_GET['service']=='Snow'){
						$sno=1;
						
					}else{
						$sno=0;
					}				 
						 $lawn=$request->input('lawn');
					if($_GET['service']=='Lawn'){
							$lan=1;
						
					}else{
						$lan=0;
}	  
				 $btype=$_GET['btype'];
				$insurance= $request->file('insurance');
				if($insurance!=''){
					$publicpath=public_path();
		   
			$destinationPath = $publicpath.'/images/'; // upload path
				  //$destinationPath = '/home/developer/public_html/ober/public/images/'; // upload path
      $extension = Input::file('insurance')->getClientOriginalExtension(); // getting image extension
      $fileName = rand(11111,99999).'.'.$extension; // renameing image
      if(Input::file('insurance')->move($destinationPath, $fileName)){
		   $host = $request->getSchemeAndHttpHost();
		  $folder=$host.'/ober/public/images/';
		   $path = $folder.$fileName; 
	  } else{
		  $path='';
	  }	  
				}else{
                 $path='';
				}
	 	 //end image upload
 
			  DB::insert('insert into company_details (provider_id, ein,bank_name,account_number,rounting_number,billing_address,insurance,lawn_service,snow_service,buisness_type,lat,lng) values ("'.$pid.'","'.$ein.'","'.$bank.'","'.$acno.'","'.$rount.'","'.$billadd.'","'.$path.'","'.$lan.'","'.$sno.'","'.$btype.'","'.$lat.'","'.$long.'")');
			   DB::insert('insert into role_users (user_id, role_id,created_at,updated_at) values ("'.$pid.'",1,"'.$date.'","'.$date.'")');
			   
			   DB::insert('insert into activations (user_id, code,completed,completed_at,created_at,updated_at) values ("'.$pid.'","7zY8f3fEjxLuVnow6WNF2hWFaT1w9erF",1,"'.$date.'","'.$date.'","'.$date.'")');
  
		 
	}
	
	public function insuranceadmin_upload(Request $request){
				  $id = $request->input('id');
		 $insurance= Input::file('upload_insurance'); 
		
		 //$result = DB::select( DB::raw("SELECT insurance FROM company_details where provider_id=$id ") );
	       $publicpath=public_path();
		   
			$destinationPath = $publicpath.'/images/'; // upload path
      $extension = Input::file('upload_insurance')->getClientOriginalExtension(); // getting image extension
      $fileName = rand(11111,99999).'.'.$extension; // renameing image
      if(Input::file('upload_insurance')->move($destinationPath, $fileName)){
		  $host = $request->getSchemeAndHttpHost();
		  $folder=$host.'/ober/public/images/';
		   $path = $folder.$fileName;	  
	  } else{
		  $path='';
	  }
	  
	   DB::update('update company_details set insurance="'.$path.'" where provider_id= "'.$id.'" '); 
       return Redirect::back(); 
	
	}
	public function insuranceupload(Request $request) {
		print_r($_REQUEST);
	}
	public function insurance_upload(Request $request){
				 $id=Sentinel::getUser()->id;
		 
		 $insurance= Input::file('upload_insurance'); 
		
		 $result = DB::select( DB::raw("SELECT insurance FROM company_details where provider_id=$id ") );
	   $publicpath=public_path();
		   
			$destinationPath = $publicpath.'/images/'; // upload path
				  //$destinationPath = '/home/developer/public_html/ober/public/images/'; // upload path
      $extension = Input::file('upload_insurance')->getClientOriginalExtension(); // getting image extension
      $fileName = rand(11111,99999).'.'.$extension; // renameing image
      if(Input::file('upload_insurance')->move($destinationPath, $fileName)){
		   
			$host = $request->getSchemeAndHttpHost();
		  $folder=$host.'/ober/public/images/';
		   $path = $folder.$fileName;	  
	  } else{
		  $path='';
	  }
	  
	   DB::update('update company_details set insurance="'.$path.'" where provider_id= "'.$id.'" '); 
       return Redirect::back(); 
	
	}
	
		public function uploadlogo(Request $request){
				 $id=Sentinel::getUser()->id;
		 
		$upload_logo= Input::file('upload_logo'); 
		
		 $result = DB::select( DB::raw("SELECT logo FROM company_details where provider_id=$id ") );
	$publicpath=public_path();
		   
			$destinationPath = $publicpath.'/images/'; // upload path
				  //$destinationPath = '/home/developer/public_html/ober/public/images/'; // upload path
      $extension = Input::file('upload_logo')->getClientOriginalExtension(); // getting image extension
      $fileName = rand(11111,99999).'.'.$extension; // renameing image
      if(Input::file('upload_logo')->move($destinationPath, $fileName)){
$host = $request->getSchemeAndHttpHost();
		  $folder=$host.'/ober/public/images/';
		   $path = $folder.$fileName;	  
	  } else{
		  $path='';
	  }
	  
	   DB::update('update company_details set logo="'.$path.'" where provider_id= "'.$id.'" '); 
       return Redirect::back(); 
	
	}
	
	
	public function secureImage(Request $request)
	{
        session_start();
		include_once public_path()."/assets/vendors/secureimage/securimage.php";
		$securimage = new Securimage();
		if ($securimage->check($request->captcha_code) == false) {
			echo "The security code entered was incorrect.<br /><br />";
			echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
			exit;
		}
		else{
			echo "The security code entered was correct. <a href='javascript:history.go(-1)'>back</a><br /><br />";
			exit;
		}

	}
	public function editprofile(Request $request){
		   $id=Sentinel::getUser()->id;
		   $company_name = $request->input('company_name');
               $address = $request->input('address');
               $email = $request->input('email');
			   $phone=$request->input('phone');
			   $city=$request->input('city');
	           $state=$request->input('state');
			   $postal=$request->input('zip');
		       $ein=$request->input('ein');
			   DB::update('update users set company_name="'.$company_name.'", address="'.$address.'",email="'.$email.'",cityuser="'.$city.'",mobile="'.$phone.'",state="'.$state.'",postal="'.$postal.'" where id="'.$id.'"');
			   DB::update('update company_details set ein="'.$ein.'" where provider_id="'.$id.'"');
			   return Redirect::back(); 
	}
	
	public function editpayment(Request $request){
		      $id=Sentinel::getUser()->id; 

               $bankname = $request->input('bankname');
               $account_number = $request->input('account_number');
			   $rounting_number=$request->input('rounting_number');
			   $billing_address=$request->input('billing_address');
	           
			   DB::update('update company_details set bank_name="'.$bankname.'",account_number="'.$account_number.'",rounting_number="'.$rounting_number.'",billing_address="'.$billing_address.'" where provider_id="'.$id.'"');
			   return Redirect::back(); 
	}
	 public function gmaps()
    {
    	$locations = DB::table('company_details')->get();
    	//return view('admin.gmaps',compact('locations'));
		return View::make('admin.gmaps',['locations' => $locations]);
    }
	public function getOrders(Request $request)
	{

   // $fromdate = $request->input('fromdate');
  // $todate = $request->input('todate'); 
  
		//$users=  DB::table('users')->where('usertype','provider')->where('created_at', '>=', Carbon::now()->subMonth())->count();
		// $users= User::where('usertype', 'provider')->where('created_at', '>=', Carbon::now()->subMonth())->count();
		// $result = DB::select( DB::raw("select avg(customer_rate) as rating from orders where customer_rate<4 group by user_id" ) ); 
		// $cou=count($result);
		// $results = DB::select( DB::raw("select worker_id,avg(worker_rating) as rating from orders where worker_rating<4 group by worker_id" ) ); 
		// $count=count($results);
		// //return View::make('admin.index', compact('users'));
		// return View::make('admin.index')->with('users', $users)->with('cou', $cou)->with('count', $count);
		
		 $company= User::where('usertype', 'provider');
		 //$query = "SELECT order_date as date, month, SUM(total_amount) as total from order_list WHERE delivery = 1 and app_id = '".$app_id."' and branch_id = '".$branch_id."' GROUP BY month ORDER BY display_order";
						//$result = mysql_query($query);
						//code for graph
						// $resuls = DB::select( DB::raw("select EXTRACT(MONTH FROM created_at) as month,count(id) as coun, DATE_FORMAT(created_at, '%Y-%m-01') from users where usertype='app_user' group by DATE_FORMAT(created_at, '%Y-%m-01')" ) ); 
						
						// foreach($resuls as $f=>$dd){
							// print_r($dd->coun); 
							// print_r($dd->month); 
						// }
						// exit;
						//code for graph
						//select count(*), DATE_FORMAT(created_at, "%Y-%m-01") from users group by DATE_FORMAT(created_at, "%Y-%m-01")
		$users= User::where('usertype', 'provider')->where('created_at', '>=', Carbon::now()->subMonth())->count();
		$result = DB::select( DB::raw("select avg(orders.customer_rate) as rating from orders join users on orders.user_id = users.id where users.usertype = 'app_user' group by orders.user_id having rating < 4" ) ); 
		$cou=count($result);
		$results = DB::select( DB::raw("select avg(orders.worker_rating) as rating from orders join worker on orders.worker_id = worker.id group by orders.worker_id having rating < 4" )); 
		 $count=count($results);
		  $incomegraphrecord = $this->incomegraphrecord();
		   $customergraphrecord = $this->customergraphrecord();
		//return View::make('admin.index', compact('users'));
		if(!empty($request->input('fromdate') && $request->input('todate'))){
			
			$fromdate=$request->input('fromdate');
			$todate=$request->input('todate');
			 // if(!empty($_GET['fromdate']) && !empty($_GET['todate'])) {
				 
				  //SELECT sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and MONTH(order_date) = '$month'
				  
				  $Record =DB::select(DB::raw("SELECT order_date, sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and order_date between '$fromdate' and '$todate' group by order_date"));
				  $dateArray = array();
				  $scoreArray = array();
				  foreach($Record as $datas1=>$datas){
					  
					  $dateArray[]= $datas->order_date;
					  $scoreArray[] =$datas->total;
					  
				  }
				  //print_r($dateArray); exit;
				  //$xaxisdata= $dateArray;
				  //print_r($xaxisdata);
				  //echo implode(',',$xaxisdata);
				  $xaxisdata = '"'.implode('","', $dateArray).'"';
				  $yaxisdate=implode(',',$scoreArray);
				  $date1=$fromdate;
				  $date2=$todate;
				  //$yaxisdate=$scoreArray;
				  //print_r($yaxisdate); exit;
		}else{
			$date1="";
				  $date2="";
			 $dates = array('"Jan"', '"Feb"', '"March"','"April"','"May"','"June"','"July"','"Aug"','"Sep"','"Oct"','"Nov"','"Dec"');
			 $xaxisdata= implode(',',$dates);
			 
			 $values = array($incomegraphrecord['jan'],$incomegraphrecord['feb'],$incomegraphrecord['mar'],$incomegraphrecord['april'],$incomegraphrecord['may'],$incomegraphrecord['june'],$incomegraphrecord['july'],$incomegraphrecord['aug'],$incomegraphrecord['sep'],$incomegraphrecord['oct'],$incomegraphrecord['nov'],$incomegraphrecord['dec']);
			 
			 $yaxisdate=implode(',',$values);
		}
		//customer data//22-06 final
		if(!empty($request->input('customerfromdate') && $request->input('customertodate'))){
			
			$customerfromdate=$request->input('customerfromdate');
			$customertodate=$request->input('customertodate');
			 // if(!empty($_GET['fromdate']) && !empty($_GET['todate'])) {
				  $customerRecord = DB::select(DB::raw("SELECT count(*) as total,DATE(created_at) as createdat FROM `users` WHERE usertype='app_user' and YEAR(created_at) = YEAR(CURRENT_DATE()) and DATE(created_at) between '$customerfromdate' and '$customertodate' group by DATE(created_at)"));
				  $customerdateArray = array();
				  $customerscoreArray = array();
				  foreach($customerRecord as $datas2=>$datas1){
					  
					  $customerdateArray[]= $datas1->createdat;
					  $customerscoreArray[] =$datas1->total;
					  
				  }
				  //print_r($dateArray); exit;
				  //$xaxisdata= $dateArray;
				  //print_r($xaxisdata);
				  //echo implode(',',$xaxisdata);
				  $customerxaxisdata = '"'.implode('","', $customerdateArray).'"';
				  $cutsomeryaxisdate=implode(',',$customerscoreArray);
				  $date3=$customerfromdate;
				  $date4=$customertodate;
				  //$yaxisdate=$scoreArray;
				  //print_r($yaxisdate); exit;
		}else{
			
			
			$dates1 = array('"Jan"', '"Feb"', '"March"','"April"','"May"','"June"','"July"','"Aug"','"Sep"','"Oct"','"Nov"','"Dec"');
			 $customerxaxisdata= implode(',',$dates1);
			 $jan=$customergraphrecord['jan'];
			 $feb=$customergraphrecord['jan']+$customergraphrecord['feb'];
			 $mar=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar'];
			 $apr=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april'];
			 
			 $may=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may'];
			 
			 $jun=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june'];
			 $july=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july'];
			 $aug=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug'];
			 $sep=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug']+$customergraphrecord['sep'];
			 
			 $oct=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug']+$customergraphrecord['sep']+$customergraphrecord['oct'];
			 $nov=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug']+$customergraphrecord['sep']+$customergraphrecord['oct']+$customergraphrecord['nov'];
			 
			 $dec=$customergraphrecord['jan']+$customergraphrecord['feb']+$customergraphrecord['mar']+$customergraphrecord['april']+$customergraphrecord['may']+$customergraphrecord['june']+$customergraphrecord['july']+$customergraphrecord['aug']+$customergraphrecord['sep']+$customergraphrecord['oct']+$customergraphrecord['nov']+$customergraphrecord['dec'];
			 
			 $values1 = array($jan,$feb,$mar,$apr,$may,$jun,$july,$aug,$sep,$oct,$nov,$dec);
			 //$values1 = array($customergraphrecord['jan'],$customergraphrecord['feb'],$customergraphrecord['mar'],$customergraphrecord['april'],$customergraphrecord['may'],$customergraphrecord['june'],$customergraphrecord['july'],$customergraphrecord['aug'],$customergraphrecord['sep'],$customergraphrecord['oct'],$customergraphrecord['nov'],$customergraphrecord['dec']);
			 
			 $cutsomeryaxisdate=implode(',',$values1);
							  $date3="";
				  $date4="";
		} 
		
		//
		
		
		
		return View::make('admin.index')->with('users', $users)->with('cou', $cou)->with('count', $count)->with('company', $company)->with('graphRecords',$incomegraphrecord)->with('graphRecord',$customergraphrecord)->with('xaxisdata',$xaxisdata)->with('yaxisdate',$yaxisdate)->with('customerxaxisdata',$customerxaxisdata)->with('cutsomeryaxisdate',$cutsomeryaxisdate)->with('date1',$date1)->with('date2',$date2)->with('date3',$date3)->with('date4',$date4);
		
		
	}
	public function getnewproviders(){
		
		$use= User::where('usertype', 'provider')->where('created_at', '>=', Carbon::now()->subMonth())->get();
		//$totalUserCount = User::where('usertype', 'provider')->where('created_at', '>=', Carbon::now()->subMonth())->count();
		//$user=$use->toArray(); 
		/*echo "<pre>";
		print_r($use);
		exit;*/
		//10return View::make('admin.new_provider_registration', compact('user'));
		$resultCount = count($use);
		return View::make('admin.new_provider_registration', ['user' => $use,'resultCount'=>$resultCount]);
	
	}
		public function settings(Request $request){
		 $msg='Successfully Updated.';
		 $miles = $request->input('miles');
		 $commision = $request->input('commision');
		 DB::update('update settings set radius="'.$miles.'",commision="'.$commision.'" ');
		return View::make('admin.setting',['msg' => $msg]);
	
	}
	public function activeworkers(){
		
		$result = DB::table('orders')
		->select(array('worker.*',DB::raw('avg(orders.worker_rating) as rating'),DB::raw('count(orders.id) as jobs'), 'users.company_name'))
			->join('worker', 'orders.worker_id', '=', 'worker.id')
            ->join('users', 'worker.user_id', '=', 'users.id')
			->groupBy('orders.worker_id')
			->havingRaw('AVG(orders.worker_rating) < 4')
			->get();
			$resultCount = count($result);
		return View::make('admin.worker_below_four_star', ['results' => $result,'countResult' => $resultCount]);
		
	}
	// public function alltransactions(){
		
		// $result = DB::table('orders')
		// ->select(array('worker.first_name', 'users.first_name','users.cityuser','users.state','orders.service','orders.total_price'))
			// ->join('worker', 'orders.worker_id', '=', 'worker.id')
            // ->join('users', 'worker.user_id', '=', 'users.id')
			// ->groupBy('orders.worker_id')
			// ->havingRaw('AVG(orders.worker_rating) < 4')
			// ->paginate(20);
			// $resultCount = $result->total();
		// return View::make('admin.transaction', ['results' => $result,'countResult' => $resultCount]);
		
	// }
	public function transactions(){
		 $id=Sentinel::getUser()->id; 

		  $basicQuery = DB::select(DB::raw("select orders.order_date,users.first_name ,l.city,l.state,orders.service, orders.total_price ,worker.first_name as workername,orders.customer_rate from orders join users on orders.user_id = users.id join worker on orders.worker_id=worker.id join location l on orders.location_id=l.location_id where worker.user_id=$id"));
		  $count=count($basicQuery);
		  return View::make('admin.transactions', ['result' =>$basicQuery,'count'=>$count]);
	}
	
	public function alltransactions(Request $request){

		$showall = $request->input('showall');
			if(!empty($showall) && is_numeric($showall)) {
				$paginateNumber = 999999999;
			} else {
				$paginateNumber = 20000000;
			}
		//select orders.order_date,users.first_name,location.city,location.state,orders.service,worker.user_id,orders.total_price,(select usr.company_name from users usr where usr.id=worker.user_id),worker.first_name from orders left join users on orders.user_id=users.id left join worker on orders.worker_id=worker.id left join location on orders.location_id=location.location_id where orders.is_completed=1
		// DB::raw( 'SELECT comments.post_id, COUNT(*) FROM comments GROUP BY comments.post_id' )
		
		 $result = DB::table('orders')
		    ->select(array('worker.first_name as workername','orders.id', 'users.first_name as customer','location.city','location.state as customer_state','orders.service','orders.customer_rate','worker.user_id','orders.total_price','orders.order_date'))
			->leftjoin('users', 'orders.user_id', '=', 'users.id')
            ->leftjoin('worker', 'orders.worker_id', '=', 'worker.id')
			->leftjoin('location', 'orders.location_id', '=', 'location.location_id')
			->where('is_completed',1)
			->paginate($paginateNumber);
			
			//print_r($result); exit;
			$resultCount = $result->total();
			$transactiongraphrecord = $this->transactiongraphrecord();
			if(!empty($request->input('fromdate') && $request->input('todate'))){
			
			$fromdate=$request->input('fromdate');
			$todate=$request->input('todate');
			 // if(!empty($_GET['fromdate']) && !empty($_GET['todate'])) {
				 
				  //SELECT sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and MONTH(order_date) = '$month'
				  $Record = DB::select(DB::raw("SELECT count(*) as total,order_date FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and order_date between '$fromdate' and '$todate' group by order_date"));
				  //$Record =DB::select(DB::raw("SELECT order_date, sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and order_date between '$fromdate' and '$todate' group by order_date"));
				  $dateArray = array();
				  $scoreArray = array();
				  foreach($Record as $datas1=>$datas){
					  
					  $dateArray[]= $datas->order_date;
					  $scoreArray[] =$datas->total;
					  
				  }
				  //print_r($dateArray); exit;
				  //$xaxisdata= $dateArray;
				  //print_r($xaxisdata);
				  //echo implode(',',$xaxisdata);
				  $xaxisdata = '"'.implode('","', $dateArray).'"';
				  $yaxisdate=implode(',',$scoreArray);
				  $date1=$fromdate;
				  $date2=$todate;
				  //$yaxisdate=$scoreArray;
				  //print_r($yaxisdate); exit;
		}else{
			
			 $dates = array('"Jan"', '"Feb"', '"March"','"April"','"May"','"June"','"July"','"Aug"','"Sep"','"Oct"','"Nov"','"Dec"');
			 $xaxisdata= implode(',',$dates);
			 
			 $values = array($transactiongraphrecord['jan'],$transactiongraphrecord['feb'],$transactiongraphrecord['mar'],$transactiongraphrecord['april'],$transactiongraphrecord['may'],$transactiongraphrecord['june'],$transactiongraphrecord['july'],$transactiongraphrecord['aug'],$transactiongraphrecord['sep'],$transactiongraphrecord['oct'],$transactiongraphrecord['nov'],$transactiongraphrecord['dec']);
			 
			 $yaxisdate=implode(',',$values);
			 $date1="";
				  $date2="";
		}
			
			
			
		return View::make('admin.transaction', ['result' =>$result,'graphRecord' => $transactiongraphrecord,'yaxisdate' => $yaxisdate,'xaxisdata' => $xaxisdata,'date1' => $date1,'date2' => $date2]);
		
	}
	
	public function accounts(Request $request){
		$showall = $request->input('showall');
			if(!empty($showall) && is_numeric($showall)) {
				$paginateNumber = 999999999;
			} else {
				$paginateNumber = 20;
			}
			
			$result = DB::select( DB::raw("SELECT id,email,first_name,cityuser,mobile,state from users where usertype='app_user' ") );
$i=0;
foreach($result as $key=>$val)
{
$row[$i]['id']=$val->id;
$row[$i]['first_name']=$val->first_name;
$row[$i]['city']=$val->cityuser;
$row[$i]['state']=$val->state;
$row[$i]['email']=$val->email;
$row[$i]['mobile']=$val->mobile;
$res=DB::select( DB::raw("SELECT avg(customer_rate) as rating,count(id) as request,sum(total_price) as total from orders where user_id=$val->id and is_completed=1 group by user_id ") );
foreach($res as $k=>$v){
$row[$i]['money']=$v->total;
$row[$i]['rating']=$v->rating;
$row[$i]['request']=$v->request;
}

$i++;

}
			
			// $result = DB::table('users')
		    // ->select(array('users.first_name','users.id as userid','users.email','users.mobile','users.cityuser','users.state',DB::raw('count(orders.id) as request'),DB::raw('SUM( orders.total_price ) AS money'),DB::raw('AVG(orders.customer_rate) AS rating')))
			// ->leftjoin('orders', 'users.id', '=', 'orders.user_id')
			// ->where('users.usertype','app_user')
            // ->groupBy('orders.user_id')
			// ->paginate($paginateNumber);
			// $resultCount = $result->total();
			$accountsgraphrecord = $this->accountsgraphrecord();
			
			if(!empty($request->input('fromdate') && $request->input('todate'))){
			
			$fromdate=$request->input('fromdate');
			$todate=$request->input('todate');
			 // if(!empty($_GET['fromdate']) && !empty($_GET['todate'])) {
				 
				  //SELECT sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and MONTH(order_date) = '$month'
				  //$Record = DB::select(DB::raw("SELECT count(*) as total,order_date FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and order_date between '$fromdate' and '$todate' group by order_date"));
				  //$Record =DB::select(DB::raw("SELECT order_date, sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and order_date between '$fromdate' and '$todate' group by order_date"));
				   $Record = DB::select(DB::raw("SELECT count(*) as total,DATE(created_at) as createdat FROM `users` WHERE usertype='app_user' and YEAR(created_at) = YEAR(CURRENT_DATE()) and DATE(created_at) between '$fromdate' and '$todate' group by DATE(created_at)"));
				  $dateArray = array();
				  $scoreArray = array();
				  foreach($Record as $datas1=>$datas){
					  
					  $dateArray[]= $datas->createdat;
					  $scoreArray[] =$datas->total;
					  
				  }
				  //print_r($dateArray); exit;
				  //$xaxisdata= $dateArray;
				  //print_r($xaxisdata);
				  //echo implode(',',$xaxisdata);
				  $xaxisdata = '"'.implode('","', $dateArray).'"';
				  $yaxisdate=implode(',',$scoreArray);
				  $date1=$fromdate;
				  $date2=$todate;
				  //$yaxisdate=$scoreArray;
				  //print_r($xaxisdata); exit;
		}else{
			
			 $dates = array('"Jan"', '"Feb"', '"March"','"April"','"May"','"June"','"July"','"Aug"','"Sep"','"Oct"','"Nov"','"Dec"');
			 $xaxisdata= implode(',',$dates);
			 $jan=$accountsgraphrecord['jan'];
			 $feb=$accountsgraphrecord['jan']+$accountsgraphrecord['feb'];
			 $mar=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar'];
			 $apr=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar']+$accountsgraphrecord['april'];
			 $may=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar']+$accountsgraphrecord['april']+$accountsgraphrecord['may'];
			 $june=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar']+$accountsgraphrecord['april']+$accountsgraphrecord['may']+$accountsgraphrecord['june'];
			 $july=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar']+$accountsgraphrecord['april']+$accountsgraphrecord['may']+$accountsgraphrecord['june']+$accountsgraphrecord['july'];
			 $aug=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar']+$accountsgraphrecord['april']+$accountsgraphrecord['may']+$accountsgraphrecord['june']+$accountsgraphrecord['july']+$accountsgraphrecord['aug'];
			 $sep=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar']+$accountsgraphrecord['april']+$accountsgraphrecord['may']+$accountsgraphrecord['june']+$accountsgraphrecord['july']+$accountsgraphrecord['aug']+$accountsgraphrecord['sep'];
			 $oct=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar']+$accountsgraphrecord['april']+$accountsgraphrecord['may']+$accountsgraphrecord['june']+$accountsgraphrecord['july']+$accountsgraphrecord['aug']+$accountsgraphrecord['sep']+$accountsgraphrecord['oct'];
			 
			 $nov=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar']+$accountsgraphrecord['april']+$accountsgraphrecord['may']+$accountsgraphrecord['june']+$accountsgraphrecord['july']+$accountsgraphrecord['aug']+$accountsgraphrecord['sep']+$accountsgraphrecord['oct']+$accountsgraphrecord['nov'];
			 
			 $dec=$accountsgraphrecord['jan']+$accountsgraphrecord['feb']+$accountsgraphrecord['mar']+$accountsgraphrecord['april']+$accountsgraphrecord['may']+$accountsgraphrecord['june']+$accountsgraphrecord['july']+$accountsgraphrecord['aug']+$accountsgraphrecord['sep']+$accountsgraphrecord['oct']+$accountsgraphrecord['nov']+$accountsgraphrecord['dec'];
			 
			 $values = array($jan,$feb,$mar,$apr,$may,$june,$july,$aug,$sep,$oct,$nov,$dec);
			 
			 $yaxisdate=implode(',',$values);
			 $date1="";
				  $date2="";
		}
			
			
		return View::make('admin.accounts', ['result' =>$row,'graphRecord' => $accountsgraphrecord,'yaxisdate' => $yaxisdate,'xaxisdata' => $xaxisdata,'date1' => $date1,'date2' => $date2]);
		
	}
	public function activecustomers(){
		$result = DB::table('orders')
		->select(array('users.*',DB::raw('avg(orders.customer_rate) as rating'),DB::raw('count(orders.id) as request')))
			->join('users', 'orders.user_id', '=', 'users.id')
			->where('users.usertype','app_user')
			->groupBy('orders.user_id')
			->havingRaw('AVG(orders.customer_rate) < 4')
			->get();
			$resultCount = count($result);
		return View::make('admin.customer_below_four_star', ['activecustomer' => $result,'countResult' => $resultCount]);
	}
	
	public function companies(Request $request){
		//Exact Query
		
		$showall = $request->input('showall');
			if(!empty($showall) && is_numeric($showall)) {
				$paginateNumber = 999999999;
			} else {
				$paginateNumber = 10000;
			}
		
		
		
		//$basicQuery = DB::select(DB::raw("select users.*,orders.id as orderid , worker.id as workerid,AVG(orders.worker_rating) AS rating,COUNT( DISTINCT orders.worker_id ) AS workers, SUM( orders.total_price ) AS money, IFNULL(orders.worker_id,UUID()) as unq_ancestor from `users` left join `worker` on `users`.`id` = `worker`.`user_id` left join `orders` on `orders`.`worker_id` = `worker`.`id` where usertype='provider' group by unq_ancestor,users.id limit 20"));
		//$basicQuery = DB::select(DB::raw("select users.*,  worker.id as workerid from users left join `worker` on `users`.`id` = `worker`.`user_id` where users.usertype='provider' "));
		$basicQuery = DB::select(DB::raw("select users.*, count(worker.user_id) as workerid,AVG(orders.worker_rating) AS rating, SUM( orders.total_price ) AS money,COUNT( DISTINCT orders.worker_id ) AS workers from users left join `worker` on `users`.`id` = `worker`.`user_id` left join `orders` on `orders`.`worker_id` = `worker`.`id` where users.usertype='provider' group by users.id"));
		//echo "<pre>";
		$resultArray = json_decode(json_encode($basicQuery), true);
		
		 $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($resultArray);

        //Define how many items we want to be visible in each page
        $perPage = $paginateNumber;

        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        //Create our paginator and pass it to the view
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
		$comgrpRecord = $this->companiesgraphrecord();
		
		
					if(!empty($request->input('fromdate') && $request->input('todate'))){
			
			$fromdate=$request->input('fromdate');
			$todate=$request->input('todate');
			 // if(!empty($_GET['fromdate']) && !empty($_GET['todate'])) {
				 
				  //SELECT sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and MONTH(order_date) = '$month'
				 // $Record = DB::select(DB::raw("SELECT count(*) as total,order_date FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and order_date between '$fromdate' and '$todate' group by order_date"));
				 $Record = DB::select(DB::raw("SELECT count(*) as total,DATE(created_at) as createdat FROM `users` WHERE usertype='provider' and YEAR(created_at) = YEAR(CURRENT_DATE()) and DATE(created_at) between '$fromdate' and '$todate' group by DATE(created_at)"));
				 //$Record = DB::select(DB::raw("SELECT count(*) as total FROM `users` WHERE usertype='provider' and YEAR(created_at) = YEAR(CURRENT_DATE()) and MONTH(created_at) = '$month'"));
				  //$Record =DB::select(DB::raw("SELECT order_date, sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and order_date between '$fromdate' and '$todate' group by order_date"));
				  $dateArray = array();
				  $scoreArray = array();

				  foreach($Record as $datas1=>$datas){
					  
					  $dateArray[]= $datas->createdat;
					  $scoreArray[] =$datas->total;
					  
				  }
				  //print_r($dateArray); exit;
				  //$xaxisdata= $dateArray;
				  //print_r($xaxisdata);
				  //echo implode(',',$xaxisdata);
				  $xaxisdata = '"'.implode('","', $dateArray).'"';
				  $yaxisdate=implode(',',$scoreArray);
				  $date1=$fromdate;
			      $date2=$todate;
				  //$yaxisdate=$scoreArray;
				  
		}else{
			
			 $dates = array('"Jan"', '"Feb"', '"March"','"April"','"May"','"June"','"July"','"Aug"','"Sep"','"Oct"','"Nov"','"Dec"');
			 $xaxisdata= implode(',',$dates);
			 
			 $jan=$comgrpRecord['jan'];
			 $feb=$comgrpRecord['feb']+$comgrpRecord['jan'];
			 $mar=$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan'];
			 $apr=$comgrpRecord['april']+$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan'];
			 $may=$comgrpRecord['may']+$comgrpRecord['april']+$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan'];
			 $june=$comgrpRecord['june']+$comgrpRecord['may']+$comgrpRecord['april']+$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan'];
			 $july=$comgrpRecord['july']+$comgrpRecord['june']+$comgrpRecord['may']+$comgrpRecord['april']+$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan'];
			 $aug=$comgrpRecord['aug']+$comgrpRecord['july']+$comgrpRecord['june']+$comgrpRecord['may']+$comgrpRecord['april']+$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan'];
			 $sep=$comgrpRecord['aug']+$comgrpRecord['july']+$comgrpRecord['june']+$comgrpRecord['may']+$comgrpRecord['april']+$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan']+$comgrpRecord['sep'];
			 $oct=$comgrpRecord['aug']+$comgrpRecord['july']+$comgrpRecord['june']+$comgrpRecord['may']+$comgrpRecord['april']+$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan']+$comgrpRecord['sep']+$comgrpRecord['oct'];
			 $nov=$comgrpRecord['aug']+$comgrpRecord['july']+$comgrpRecord['june']+$comgrpRecord['may']+$comgrpRecord['april']+$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan']+$comgrpRecord['sep']+$comgrpRecord['oct']+$comgrpRecord['nov'];
			 $dec=$comgrpRecord['aug']+$comgrpRecord['july']+$comgrpRecord['june']+$comgrpRecord['may']+$comgrpRecord['april']+$comgrpRecord['mar']+$comgrpRecord['feb']+$comgrpRecord['jan']+$comgrpRecord['sep']+$comgrpRecord['oct']+$comgrpRecord['nov']+$comgrpRecord['dec'];
			 
			 
			 $values = array($jan,$feb,$mar,$apr,$may,$june,$july,$aug,$sep,$oct,$nov,$dec);
			 
			 $yaxisdate=implode(',',$values);
			 $date1="";
			 $date2="";
		}
		
		
		return View::make('admin.compnies', ['companies' =>$paginatedSearchResults,'graphRecord' => $comgrpRecord,'yaxisdate' => $yaxisdate,'xaxisdata' => $xaxisdata,'date1' => $date1,'date2' => $date2]);
	}
	function companiesgraphrecord() {
		$graphRecord = array();
		$graphRecord['jan'] = $this->getMonthWiseRecord(1);
		$graphRecord['feb'] = $this->getMonthWiseRecord(2);
		$graphRecord['mar'] = $this->getMonthWiseRecord(3);
		$graphRecord['april'] = $this->getMonthWiseRecord(4);
		$graphRecord['may'] = $this->getMonthWiseRecord(5);
		$graphRecord['june'] = $this->getMonthWiseRecord(6);
		$graphRecord['july'] = $this->getMonthWiseRecord(7);
		$graphRecord['aug'] = $this->getMonthWiseRecord(8);
		$graphRecord['sep'] = $this->getMonthWiseRecord(9);
		$graphRecord['oct'] = $this->getMonthWiseRecord(10);
		$graphRecord['nov'] = $this->getMonthWiseRecord(11);
		$graphRecord['dec'] = $this->getMonthWiseRecord(12);
		return $graphRecord;
	}
	
	function workergraphrecord() {
		$graphRecord = array();
		$graphRecord['jan'] = $this->getWorkerMonthWiseRecord(1);
		$graphRecord['feb'] = $this->getWorkerMonthWiseRecord(2);
		$graphRecord['mar'] = $this->getWorkerMonthWiseRecord(3);
		$graphRecord['april'] = $this->getWorkerMonthWiseRecord(4);
		$graphRecord['may'] = $this->getWorkerMonthWiseRecord(5);
		$graphRecord['june'] = $this->getWorkerMonthWiseRecord(6);
		$graphRecord['july'] = $this->getWorkerMonthWiseRecord(7);
		$graphRecord['aug'] = $this->getWorkerMonthWiseRecord(8);
		$graphRecord['sep'] = $this->getWorkerMonthWiseRecord(9);
		$graphRecord['oct'] = $this->getWorkerMonthWiseRecord(10);
		$graphRecord['nov'] = $this->getWorkerMonthWiseRecord(11);
		$graphRecord['dec'] = $this->getWorkerMonthWiseRecord(12);
		return $graphRecord;
	}
	
	function accountsgraphrecord() {
		$graphRecord = array();
		$graphRecord['jan'] = $this->getMonthWiseaccountsRecord(1);
		$graphRecord['feb'] = $this->getMonthWiseaccountsRecord(2);
		$graphRecord['mar'] = $this->getMonthWiseaccountsRecord(3);
		$graphRecord['april'] = $this->getMonthWiseaccountsRecord(4);
		$graphRecord['may'] = $this->getMonthWiseaccountsRecord(5);
		$graphRecord['june'] = $this->getMonthWiseaccountsRecord(6);
		$graphRecord['july'] = $this->getMonthWiseaccountsRecord(7);
		$graphRecord['aug'] = $this->getMonthWiseaccountsRecord(8);
		$graphRecord['sep'] = $this->getMonthWiseaccountsRecord(9);
		$graphRecord['oct'] = $this->getMonthWiseaccountsRecord(10);
		$graphRecord['nov'] = $this->getMonthWiseaccountsRecord(11);
		$graphRecord['dec'] = $this->getMonthWiseaccountsRecord(12);
		return $graphRecord;
	}
	function transactiongraphrecord() {
		$graphRecord = array();
		$graphRecord['jan'] = $this->getMonthWisetransactionsRecord(1);
		$graphRecord['feb'] = $this->getMonthWisetransactionsRecord(2);
		$graphRecord['mar'] = $this->getMonthWisetransactionsRecord(3);
		$graphRecord['april'] = $this->getMonthWisetransactionsRecord(4);
		$graphRecord['may'] = $this->getMonthWisetransactionsRecord(5);
		$graphRecord['june'] = $this->getMonthWisetransactionsRecord(6);
		$graphRecord['july'] = $this->getMonthWisetransactionsRecord(7);
		$graphRecord['aug'] = $this->getMonthWisetransactionsRecord(8);
		$graphRecord['sep'] = $this->getMonthWisetransactionsRecord(9);
		$graphRecord['oct'] = $this->getMonthWisetransactionsRecord(10);
		$graphRecord['nov'] = $this->getMonthWisetransactionsRecord(11);
		$graphRecord['dec'] = $this->getMonthWisetransactionsRecord(12);
		return $graphRecord;
	}

	
	function incomegraphrecord() {
		$graphRecord = array();
		$graphRecord['jan'] = $this->getMonthWiseincomeRecord(1);
		$graphRecord['feb'] = $this->getMonthWiseincomeRecord(2);
		$graphRecord['mar'] = $this->getMonthWiseincomeRecord(3);
		$graphRecord['april'] = $this->getMonthWiseincomeRecord(4);
		$graphRecord['may'] = $this->getMonthWiseincomeRecord(5);
		$graphRecord['june'] = $this->getMonthWiseincomeRecord(6);
		$graphRecord['july'] = $this->getMonthWiseincomeRecord(7);
		$graphRecord['aug'] = $this->getMonthWiseincomeRecord(8);
		$graphRecord['sep'] = $this->getMonthWiseincomeRecord(9);
		$graphRecord['oct'] = $this->getMonthWiseincomeRecord(10);
		$graphRecord['nov'] = $this->getMonthWiseincomeRecord(11);
		$graphRecord['dec'] = $this->getMonthWiseincomeRecord(12);
		return $graphRecord;
	}
	function customergraphrecord() {
		$graphRecord = array();
		$graphRecord['jan'] = $this->getMonthWisecustomersRecord(1);
		$graphRecord['feb'] = $this->getMonthWisecustomersRecord(2);
		$graphRecord['mar'] = $this->getMonthWisecustomersRecord(3);
		$graphRecord['april'] = $this->getMonthWisecustomersRecord(4);
		$graphRecord['may'] = $this->getMonthWisecustomersRecord(5);
		$graphRecord['june'] = $this->getMonthWisecustomersRecord(6);
		$graphRecord['july'] = $this->getMonthWisecustomersRecord(7);
		$graphRecord['aug'] = $this->getMonthWisecustomersRecord(8);
		$graphRecord['sep'] = $this->getMonthWisecustomersRecord(9);
		$graphRecord['oct'] = $this->getMonthWisecustomersRecord(10);
		$graphRecord['nov'] = $this->getMonthWisecustomersRecord(11);
		$graphRecord['dec'] = $this->getMonthWisecustomersRecord(12);
		return $graphRecord;
	}
	private function getMonthWisecustomersRecord($month) {
			$Record = DB::select(DB::raw("SELECT count(*) as total FROM `users` WHERE usertype='app_user' and YEAR(created_at) = YEAR(CURRENT_DATE()) and MONTH(created_at) = '$month'"));
		return $Record[0]->total;
		}
		
		
		private function getMonthWiseincomeRecord($month) {
			$Record = DB::select(DB::raw("SELECT  IFNULL( SUM( total_price ) , 0 ) AS total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and MONTH(order_date) = '$month'"));
		return $Record[0]->total;
		}
	
	private function getMonthWiseaccountsRecord($month) {
			$Record = DB::select(DB::raw("SELECT count(*) as total FROM `users` WHERE usertype='app_user' and YEAR(created_at) = YEAR(CURRENT_DATE()) and MONTH(created_at) = '$month'"));
		return $Record[0]->total;
		}
	   
	   private function getMonthWisetransactionsRecord($month) {
			$Record = DB::select(DB::raw("SELECT count(*) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and MONTH(order_date) = '$month'"));
		return $Record[0]->total;
		}
		private function getMonthWiseRecord($month) {
			$Record = DB::select(DB::raw("SELECT count(*) as total FROM `users` WHERE usertype='provider' and YEAR(created_at) = YEAR(CURRENT_DATE()) and MONTH(created_at) = '$month'"));
		return $Record[0]->total;
		}

	private function getWorkerMonthWiseRecord($month) {
			$Record = DB::select(DB::raw("SELECT count(*) as total FROM `worker` WHERE YEAR(created_date) = YEAR(CURRENT_DATE()) and MONTH(created_date) = '$month'"));
		return $Record[0]->total;
		}
		public function allworkers(Request $request){
			
			$showall = $request->input('showall');
			if(!empty($showall) && is_numeric($showall)) {
				$paginateNumber = 999999999;
			} else {
				$paginateNumber = 20;
			}
			
		// $worker = DB::table('worker')
		// ->select(array('users.company_name','worker.*',DB::raw('AVG(orders.worker_rating) AS rating'),DB::raw('SUM( orders.total_price ) AS money')))
			// ->leftjoin('orders', 'orders.worker_id', '=', 'worker.id')
			// ->leftjoin('users', 'users.id', '=', 'worker.user_id')
			// ->groupBy('orders.worker_id')
			// ->paginate($paginateNumber);
			
			$result = DB::select( DB::raw("SELECT worker.id, worker.first_name,worker.email,worker.city,worker.state ,worker.mobile,users.company_name from worker join users on worker.user_id=users.id ") );
$i=0;
foreach($result as $key=>$val)
{
$row[$i]['id']=$val->id;
$row[$i]['first_name']=$val->first_name;
$row[$i]['city']=$val->city;
$row[$i]['state']=$val->state;
$row[$i]['email']=$val->email;
$row[$i]['mobile']=$val->mobile;
$row[$i]['company_name']=$val->company_name;
$res=DB::select( DB::raw("SELECT avg(worker_rating) as rating,sum(total_price) as money  from orders where worker_id=$val->id and is_completed=1 group by worker_id ") );
foreach($res as $k=>$v){

$row[$i]['rating']=$v->rating;
$row[$i]['money']=$v->money;
}

$i++;

}
		$workerGraphRecord = $this->workergraphrecord();
		if(!empty($request->input('fromdate') && $request->input('todate'))){
			
			$fromdate=$request->input('fromdate');
			$todate=$request->input('todate');
			 // if(!empty($_GET['fromdate']) && !empty($_GET['todate'])) {
				 
				  //SELECT sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and MONTH(order_date) = '$month'
				  //$Record = DB::select(DB::raw("SELECT count(*) as total FROM `worker` WHERE YEAR(created_date) = YEAR(CURRENT_DATE()) and MONTH(created_date) = '$month'"));
				  
				  $Record = DB::select(DB::raw("SELECT count(*) as total,DATE(created_date) as createdat FROM `worker` WHERE YEAR(created_date) = YEAR(CURRENT_DATE()) and created_date between '$fromdate' and '$todate' group by DATE(created_date)"));
				  //$Record =DB::select(DB::raw("SELECT order_date, sum(total_price) as total FROM `orders` WHERE is_completed='1' and YEAR(order_date) = YEAR(CURRENT_DATE()) and order_date between '$fromdate' and '$todate' group by order_date"));
				  $dateArray = array();
				  $scoreArray = array();
				  foreach($Record as $datas1=>$datas){
					  
					  $dateArray[]= $datas->createdat;
					  $scoreArray[] =$datas->total;
					  
				  }
				  //print_r($dateArray); exit;
				  //$xaxisdata= $dateArray;
				  //print_r($xaxisdata);
				  //echo implode(',',$xaxisdata);
				  $xaxisdata = '"'.implode('","', $dateArray).'"';
				  $yaxisdate=implode(',',$scoreArray);
				  $date1=$fromdate;
				  $date2=$todate;
				  //$yaxisdate=$scoreArray;
				  //print_r($yaxisdate); exit;
		}else{
			
			 $dates = array('"Jan"', '"Feb"', '"March"','"April"','"May"','"June"','"July"','"Aug"','"Sep"','"Oct"','"Nov"','"Dec"');
			 $xaxisdata= implode(',',$dates);
			 
			 $jan=$workerGraphRecord['jan'];
			 $feb=$workerGraphRecord['feb']+$workerGraphRecord['jan'];
			 $mar=$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan'];
			 $apr=$workerGraphRecord['april']+$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan'];
			 
			 $may=$workerGraphRecord['april']+$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan']+$workerGraphRecord['may'];
			 $june=$workerGraphRecord['april']+$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan']+$workerGraphRecord['may']+$workerGraphRecord['june'];
			 $july=$workerGraphRecord['july']+$workerGraphRecord['april']+$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan']+$workerGraphRecord['may']+$workerGraphRecord['june'];
			 $aug=$workerGraphRecord['july']+$workerGraphRecord['april']+$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan']+$workerGraphRecord['may']+$workerGraphRecord['june']+$workerGraphRecord['aug'];
			 $sep=$workerGraphRecord['july']+$workerGraphRecord['april']+$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan']+$workerGraphRecord['may']+$workerGraphRecord['june']+$workerGraphRecord['aug']+$workerGraphRecord['sep'];
			 $oct=$workerGraphRecord['july']+$workerGraphRecord['april']+$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan']+$workerGraphRecord['may']+$workerGraphRecord['june']+$workerGraphRecord['aug']+$workerGraphRecord['sep']+$workerGraphRecord['oct'];
			 $nov=$workerGraphRecord['july']+$workerGraphRecord['april']+$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan']+$workerGraphRecord['may']+$workerGraphRecord['june']+$workerGraphRecord['aug']+$workerGraphRecord['sep']+$workerGraphRecord['oct']+$workerGraphRecord['nov'];
			 $dec=$workerGraphRecord['july']+$workerGraphRecord['april']+$workerGraphRecord['mar']+$workerGraphRecord['feb']+$workerGraphRecord['jan']+$workerGraphRecord['may']+$workerGraphRecord['june']+$workerGraphRecord['aug']+$workerGraphRecord['sep']+$workerGraphRecord['oct']+$workerGraphRecord['nov']+$workerGraphRecord['dec'];
			 
			 $values = array($jan,$feb,$mar,$apr,$may,$june,$july,$aug,$sep,$oct,$nov,$dec);
			 
			 $yaxisdate=implode(',',$values);
			 $date1="";
			 $date2="";
		}
		/*echo "<pre>";
		print_r($workerGraphRecord);
		exit;*/
		//$activecustomer=$result->toArray(); 
		return View::make('admin.worker', ['worker' =>$row,'graphRecord' => $workerGraphRecord,'yaxisdate' => $yaxisdate,'xaxisdata' => $xaxisdata,'date1'=>$date1,'date2'=>$date2 ]);
	}
	public function reset_password(Request $request){
		$id=$request->input('id');
		$password=$request->input('password');
		$newpass=$request->input('newpassword');
		$new_password=Hash::make($newpass); 
		  $users = DB::table('users')
                    ->where('id',$id)
                    ->get()->toArray();
					if(!empty($users)){
	          //echo $users[0]->password;
	
		   DB::update('update users set password="'.$new_password.'" where id="'.$id.'"');
		 //return response()->json(['success' => '1','msg'=>'Password changed successfully']);
		    return Redirect::back(); 
	 
	 
					}
	}
	
	public function password(Request $request){
		 $id=Sentinel::getUser()->id;
		 $oldpassword=$request->input('oldpassword');
		$password=$request->input('password');
		$newpass=$request->input('newpassword');
		if($oldpassword==''){
			
            $msg='Please enter old password.';
			 return View::make('admin.password',['msg' =>$msg]);
		}
		elseif($password==''){
  $msg='Please enter new password.';
   return View::make('admin.password',['msg' =>$msg]);
		}
		elseif($newpass==''){
 $msg='Please enter confirm password.';
  return View::make('admin.password',['msg' =>$msg]);
		}
         elseif(strlen($password)<6){
 $msg='Password should be atleast 6 characters.';
  return View::make('admin.password',['msg' =>$msg]);
		}
		 elseif(strlen($password)<6){
 $msg='Password should be upto 30 characters.';
  return View::make('admin.password',['msg' =>$msg]);
		}
		// elseif(!preg_match('/[^a-z_\-0-9]/i', $password))
// {
   // $msg='Password should be alphanumric.';
// }

  else{	


		 $users = DB::table('users')
                    ->where('id',$id)
                    ->get()->toArray();
					
					if(!empty($users)){
	          //echo $users[0]->password;
     $checkpassword=Hash::check($oldpassword, $users[0]->password);
	   if($checkpassword==1){
		   if($newpass!==$password){
				   
				   $msg='Password should be same.';
				   return View::make('admin.password',['msg' =>$msg]);
			   }else{
				   $new_password=Hash::make($newpass);
            $msg="Password updatd successfully";
			
		    DB::update('update users set password="'.$new_password.'" where id="'.$id.'"');
          			   return View::make('admin.password',['msg' =>$msg]);
					   
			   } 
		   
			   
		   //return response()->json(['success' => '1','msg'=>'Login successfully','user_id'=>$users[0]->id]);
	   }else{
		   $msgg='';
		  $msg='Old password is not correct';
		    return View::make('admin.password',['msg' =>$msg]);
	   }
	 
					}
}
	}
	public function resetpasswordcustomer(Request $request){
      $id=$request->input('id'); 
		$password=$request->input('password');
		$newpass=$request->input('newpassword');

            $new_password=Hash::make($newpass);
            $msgg="Password updatd successfully";
		    DB::update('update users set password="'.$new_password.'" where id="'.$id.'"');
          			    return Redirect::back(); 
			   
		   
			   
		   //return response()->json(['success' => '1','msg'=>'Login successfully','user_id'=>$users[0]->id]);
	 
		 
	}
	public function resetpasswordworker(Request $request){
		$id=$request->input('id'); 
		$password=$request->input('password');
		$newpass=$request->input('newpassword');

            $new_password=Hash::make($newpass);
            $msgg="Password updatd successfully";
		    DB::update('update worker set password="'.$new_password.'" where id="'.$id.'"');
          			    return Redirect::back(); 
			   
		
	}
	
	public function edit_worker ($id){
		
		$Record = DB::select(DB::raw("SELECT * FROM `worker` WHERE id=$id"));
		return View::make('admin.editworker',['Record' =>$Record,'id'=>$id]);
		
		
	}
	public function edit_profile (){
		 $id=Sentinel::getUser()->id;
		$Record = DB::select(DB::raw("SELECT users.*,company_details.ein FROM `users` left join company_details on users.id=company_details.provider_id WHERE users.id=$id"));
		return View::make('admin.editprofile',['Record' =>$Record,'id'=>$id]);
		
		
	}
	public function edit_payment(){
		 $id=Sentinel::getUser()->id;
		$Record = DB::select(DB::raw("SELECT * FROM `company_details` WHERE provider_id=$id"));
		return View::make('admin.editpayment',['Record' =>$Record,'id'=>$id]);
		
		
	}

	public function app_users(Request $request){
		 $id=Sentinel::getUser()->id;
		
		
		  $users = DB::table('worker')
                    ->where('user_id',$id)
                    ->get()->toArray();
					$count=count($users);
					$i=0;
					if($count>0){
					foreach($users as $key=>$val){
						//$id=$val->id;
						$rows[$i]['id']=$val->id;
						$rows[$i]['first_name']=$val->first_name;
						$rows[$i]['email']=$val->email;
                        $rows[$i]['password']=$val->password;
						
						$rows[$i]['status']=$val->status;
						
						$res = DB::select(DB::raw("select count(orders.worker_id) as jobs,AVG(orders.worker_rating) AS rating from orders where orders.worker_id=$val->id group by orders.worker_id"));
						
						foreach($res as $k=>$v){
							
							$rows[$i]['rating']=$v->rating;
							$rows[$i]['jobs']=$v->jobs;
						}
						$i++;
					}
					
					
		    return View::make('admin.app_users',['result' =>$rows,'count'=>$count]);
	 
					}else{
						$rows=array();
						return View::make('admin.app_users',['result' =>$rows,'count'=>$count]);
					}
	 
	}
	public function export(){
		$id=Sentinel::getUser()->id;
		//$data = States::get(['city_name','state'])->toArray();
		 $users = DB::table('worker')
                    ->where('user_id',$id)
                    ->get()->toArray();
					$count=count($users);
					$i=0;
					foreach($users as $key=>$val){
						$id=$val->id;
						$data[$i]['first_name']=$val->first_name;
						$data[$i]['email']=$val->email;
                        $data[$i]['password']=$val->password;
						$data[$i]['password']=$val->password;
						$data[$i]['status']=$val->status;
						
						$res = DB::select(DB::raw("select count(orders.worker_id) as jobs,AVG(orders.worker_rating) AS rating from orders where orders.worker_id=$id group by orders.worker_id"));
						
						foreach($res as $k=>$v){
							
							$data[$i]['rating']=$v->rating;
							$data[$i]['jobs']=$v->jobs;
						}
						$i++;
					}
		return Excel::create('export_to_excel_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
		
	}
	public function datetransaction(Request $request){
		
		       $id = $request->input('ids');
		       $datepicker1 = $request->input('datepicker1');
			   $datepicker = $request->input('datepicker');

		$result = DB::select( DB::raw("SELECT users.id,users.address,company_details.buisness_type,users.email,users.first_name,users.company_name,users.mobile,company_details.ein,company_details.bank_name,company_details.account_number,company_details.rounting_number,company_details.billing_address,company_details.city,company_details.state FROM users  join company_details on users.id=company_details.provider_id where users.id=$id ") );
	  
	  foreach($result as $ke=>$val){
		  
		  $provider=$val->company_name;
	  
	   //$res= DB::select( DB::raw("SELECT orders.id,users.first_name,orders.total_price,orders.service,location.city,location.state,company_details.ein,company_details.bank_name,company_details.account_number,company_details.rounting_number,company_details.billing_address FROM users  join company_details on users.id=company_details.provider_id where users.id=$id ") );
	   
	   $transaction= DB::select( DB::raw("SELECT worker.id,users.first_name,orders.total_price,orders.order_date,location.city,location.state,orders.service,worker.first_name as workername FROM users  join orders on users.id=orders.user_id join location on location.location_id=orders.location_id join worker on worker.id=orders.worker_id  where worker.user_id=$id and orders.is_completed=1 ") );
	   $i=0;
	  
	   foreach($transaction as $key=>$value){
		   
		  $row[$i]['first_name']=$value->first_name;
		   $row[$i]['total_price']=$value->total_price;
		   $row[$i]['order_date']=$value->order_date;
		   $row[$i]['city']=$value->city;
		   $row[$i]['state']=$value->state;
			 $row[$i]['service']=$value->service;
			  $row[$i]['workername']=$value->workername;
			  $row[$i]['provider']=$provider;
			  $i++;
	   }
	   
	   }
	}
	
	public function companydetails($id,Request $request){
		 $row = array();
		$rows = array();
       	
		//echo "SELECT users.id,users.address,company_details.buisness_type,users.email,users.first_name,users.company_name,users.mobile,company_details.ein,company_details.bank_name,company_details.account_number,company_details.rounting_number,company_details.insurance,company_details.billing_address,company_details.city,company_details.state FROM users  join company_details on users.id=company_details.provider_id where users.id=$id";
		
	  $result = DB::select( DB::raw("SELECT users.id,users.address,company_details.buisness_type,users.email,users.first_name,users.company_name,users.mobile,users.cityuser,users.state,users.postal,company_details.ein,company_details.bank_name,company_details.lawn_service,company_details.snow_service,company_details.account_number,company_details.rounting_number,company_details.insurance,company_details.billing_address,company_details.city,company_details.state FROM users left join company_details on users.id=company_details.provider_id where users.id=$id ") );
	  
	  foreach($result as $ke=>$val){
		  
		  $provider=$val->company_name;
	  
	   //$res= DB::select( DB::raw("SELECT orders.id,users.first_name,orders.total_price,orders.service,location.city,location.state,company_details.ein,company_details.bank_name,company_details.account_number,company_details.rounting_number,company_details.billing_address FROM users  join company_details on users.id=company_details.provider_id where users.id=$id ") );
	   
	   $transaction= DB::select( DB::raw("SELECT worker.id,users.first_name,orders.total_price,orders.order_date,orders.id,location.city,location.state,orders.service,worker.first_name as workername FROM users  join orders on users.id=orders.user_id join location on location.location_id=orders.location_id join worker on worker.id=orders.worker_id  where worker.user_id=$id and orders.is_completed=1 ") );
	   $i=0;
	  
	   foreach($transaction as $key=>$value){
		   		  $row[$i]['id']=$value->id;
				  
		  $row[$i]['first_name']=$value->first_name;
		   $row[$i]['total_price']=$value->total_price;
		   $row[$i]['order_date']=$value->order_date;
		   $row[$i]['city']=$value->city;
		   $row[$i]['state']=$value->state;
			 $row[$i]['service']=$value->service;
			  $row[$i]['workername']=$value->workername;
			  $row[$i]['provider']=$provider;
			  $i++;
	   }
	   
	   }
	   $i=0;
	     $workers= DB::select( DB::raw("SELECT worker.id, worker.first_name,worker.email,worker.city,worker.state,worker.status FROM worker where worker.user_id=$id  ") );
		  $workercount=count($workers); 
		 foreach($workers as $wor=>$valu){
			 $rows[$i]['id']=$valu->id;
		 $rows[$i]['first_name']=$valu->first_name;
		 $rows[$i]['email']=$valu->email;
		 $rows[$i]['city']=$valu->city;
		 $rows[$i]['state']=$valu->state;
		  $rows[$i]['status']=$valu->status;
		   $orderworker= DB::select( DB::raw("SELECT AVG(worker_rating) AS rating ,count(id) as jobs FROM orders where worker_id=$valu->id  ") );
		   foreach($orderworker as $k=>$v){
			   
			   $rows[$i]['rating']=$v->rating;
			   $rows[$i]['jobs']=$v->jobs;
		   }
		   $i++;
		}
		//echo "<pre>";
		//print_r($result);
		//print_r($workercount);
		//print_r($rows);
		//print_r($row);
		//exit;
		//*/
		return View::make('admin.company_details',['result' =>$result,'row'=>$row,'workercount'=>$workercount,'rows'=>$rows,'ids'=>$id,'companyname'=>$provider]);


	}
	public function ajaxCustomers(Request $request){
		
	
			 $date = $_GET['fromdate'];
			 $date = str_replace('/', '-', $date);
			 $fromdate = date('Y-m-d', strtotime($date));
			 $todate = $_GET['todate'];
			 $todate = str_replace('/', '-', $todate);
			 $todate = date('Y-m-d', strtotime($todate));
			 //date string
			 // Set timezone
 date_default_timezone_set('UTC');

 // Start date
  $date = $fromdate;
 // End date
  $end_date = $todate; 
 $dateArray = array();
 while (strtotime($date) <= strtotime($end_date)) {
                //echo "$date\n";
                $dateArray[] = '"'.$date.'"'; 
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
 }
 
 // echo '<pre>';
 // print_r($dateArray);
 
 $xaxisdata= implode(',',$dateArray);
			 
			 //end
			 
			  if(!empty($_GET['fromdate']) && !empty($_GET['todate'])) {
				  $Record = DB::select(DB::raw("SELECT count(*) as total,DATE(created_at) as createdat FROM `users` WHERE usertype='provider' and YEAR(created_at) = YEAR(CURRENT_DATE()) and DATE(created_at) between '$fromdate' and '$todate' group by DATE(created_at)"));
				  $dateArray = array();
				  $scoreArray = array();
				  foreach($Record as $datas1=>$datas){
					  
					  $dateArray[]= '"'.$datas->createdat.'"';
					  $scoreArray[] ='['.$datas->total.']';
					  
				  }
				 // print_r($dateArray); exit;
				  $xaxisdata= implode(',',$dateArray); echo "<br>";
				  $yaxisdate=implode(',',$scoreArray);
				return View::make('admin.index',['xaxisdata' =>$xaxisdata,'yaxisdate' =>$yaxisdate]);
				 
			 }
			
	}
	
	public function ajaxCompanyDetail($id,Request $request) {
		 $row = array();
		$rows = array();
       	//echo "<pre>";   //$users= User::where('id', $proid);
		//print_r($id);
		//exit;
		$query = '';
		if(!empty($_GET['fromdate']) && !empty($_GET['todate'])) {
			$date = $_GET['fromdate'];
			//$date = str_replace('/', '-', $date);
			$fromdate = date('Y-m-d', strtotime($date));
			$todate = $_GET['todate'];
			//$todate = str_replace('/', '-', $todate);
			 $todate = date('Y-m-d', strtotime($todate));
			$query = "and (orders.order_date between '".$fromdate."' and '".$todate."')" ;
			
		}else {
			if(!empty($_GET['fromdate'])) {
				$date = $_GET['fromdate'];
			$fromdate = date('Y-m-d', strtotime($date));
			$query = "and orders.order_date >= '".$fromdate."'";
			}
			if(!empty($_GET['todate'])) {
				$todate = $_GET['todate'];
			$frmdate = date('Y-m-d', strtotime($todate));
			$query = "and orders.order_date <= '".$frmdate."'";
			}
		}
		
	  $result = DB::select( DB::raw("SELECT users.id,users.address,company_details.buisness_type,users.email,users.first_name,users.company_name,users.mobile,company_details.ein,company_details.bank_name,company_details.account_number,company_details.rounting_number,company_details.billing_address,company_details.city,company_details.state FROM users  join company_details on users.id=company_details.provider_id where users.id=$id ") );
	  
	  foreach($result as $ke=>$val){
		  
		  $provider=$val->company_name;
	  
	   //$res= DB::select( DB::raw("SELECT orders.id,users.first_name,orders.total_price,orders.service,location.city,location.state,company_details.ein,company_details.bank_name,company_details.account_number,company_details.rounting_number,company_details.billing_address FROM users  join company_details on users.id=company_details.provider_id where users.id=$id ") );
	  
	  /* echo "SELECT worker.id,users.first_name,orders.total_price,orders.order_date,location.city,location.state,orders.service,worker.first_name as workername FROM users  join orders on users.id=orders.user_id join location on location.location_id=orders.location_id join worker on worker.id=orders.worker_id  where worker.user_id=$id and orders.is_completed=1 $query ";
		exit;*/
	  $transaction= DB::select( DB::raw("SELECT worker.id,users.first_name,orders.total_price,orders.order_date,location.city,location.state,orders.service,worker.first_name as workername FROM users  join orders on users.id=orders.user_id join location on location.location_id=orders.location_id join worker on worker.id=orders.worker_id  where worker.user_id=$id and orders.is_completed=1 $query ") );
	   $i=0;
		 
	   foreach($transaction as $key=>$value){
		   
		  $row[$i]['first_name']=$value->first_name;
		   $row[$i]['total_price']=$value->total_price;
		   $row[$i]['order_date']=$value->order_date;
		   $row[$i]['city']=$value->city;
		   $row[$i]['state']=$value->state;
			 $row[$i]['service']=$value->service;
			  $row[$i]['workername']=$value->workername;
			  $row[$i]['provider']=$provider;
			  $i++;
	   }
	   
	   }
	  // echo "<pre>";
	   //print_r($row);
	   //exit;
	   $html = '';
	   if(!empty($row)) {
		 //$html = "<tbody id='fill'>";
					foreach($row as $worke) {
					$html .= "<tr>";
						$html .= "<td>".$worke['order_date']."</td>";
						$html .= "<td>".$worke['first_name']."</td>";
						$html .= "<td>".$worke['total_price']."</td>";
						$html .= "<td>".$worke['city']."</td>";
						$html .= "<td>".$worke['state']."</td>";
						$html .= "<td>".$worke['service']."</td>";
						$html .= "<td>".$worke['provider']."</td>";
					   $html .= "<td>".$worke['workername']."</td>";
					$html .= "</tr>";
					}
				//$html .= "</tbody>";
	   }
	  // print_r($html);
	echo $html;
	exit;
	}

		public function worker_detail($id){
		
      // $worker = DB::table('worker')
		// ->select(array('users.company_name','worker.first_name as name',DB::raw('AVG(orders.worker_rating) AS rating'),DB::raw('SUM( orders.total_price ) AS money')))
			// ->join('orders', 'orders.worker_id', '=', 'worker.id')
			// ->join('users', 'users.id', '=', 'worker.user_id')
			// ->where('worker.id',$id)
			// ->groupBy('orders.worker_id');
		$result = DB::select( DB::raw("SELECT users.company_name,worker.first_name as name,worker.email, AVG(orders.worker_rating) AS rating, IFNULL(orders.worker_id,UUID()) as unq_ancestor FROM worker left join orders on worker.id=orders.worker_id left join users on users.id=worker.user_id where worker.id=$id or orders.worker_id=$id group by unq_ancestor  ") );			
			
     //$results = DB::select( DB::raw("SELECT users.*,orders.customer_rate AS rating ,orders.service ,orders.total_price,orders.order_date,l.city,l.location_address,l.state as location_state FROM users join orders on users.id=orders.user_id join location l on orders.location_id=l.location_id where orders.worker_id=$id") );
	 
	          $results = DB::table('users')
			->select(array('users.*','orders.service','orders.customer_rate AS rating','orders.total_price','orders.order_date','location.city','location.location_address','location.state as location_state'))
			->join('orders', 'orders.user_id', '=', 'users.id')
			->join('worker', 'worker.id', '=', 'orders.worker_id')
			->join('location', 'location.location_id', '=', 'orders.location_id')
			
			->where('orders.worker_id',$id)
			->get();
					
		return View::make('admin.worker_detail',['result' =>$result,'results' =>$results,'id'=>$id]);

		
	}
	
	public function account_detail($id){
		$yes='yes'; 
		$no='no';
		$results = DB::select( DB::raw("SELECT users.id,users.first_name,users.email,users.mobile,AVG(orders.customer_rate) as rating,IFNULL(orders.user_id,UUID()) as unq_ancestor FROM users left join orders on users.id=orders.user_id  where users.id=$id and orders.user_id=$id group by unq_ancestor") );
      //$users= User::where('id', $proid);
	    $result = DB::select( DB::raw("SELECT location_name,location.location_address,location.city,snow.city_sidewalk,snow.drive_inclined,lawn.cornor_lot,lawn.lot_size,location.state,location.zip FROM location left join snow on location.location_id=snow.location_id left join lawn on lawn.location_id=location.location_id  where location.user_id=$id ") );
		
	     $res = DB::table('orders')
			->select(array('orders.order_date','users.company_name','worker.first_name','orders.worker_rating AS rating','location.location_address','location.city','location.state','orders.service','orders.total_price'))
			->leftjoin('worker', 'orders.worker_id', '=', 'worker.id')
			->leftjoin('users', 'worker.user_id', '=', 'users.id')
			->leftjoin('location', 'orders.location_id', '=', 'location.location_id')
			
			->where('orders.user_id',$id)
			->where('location.user_id',$id)
			->where('orders.is_completed',1)
			->get();
			
		return View::make('admin.customer_details',['results' =>$results,'result'=>$result,'res'=>$res,'no'=>$no,'yes'=>$yes]);
		
		
	}
	
	public function serviceupdate(Request $request){
		
		       $pid = $request->input('ids');
		       $snow = $request->input('snow');
			   $lawn = $request->input('lawn'); 
               if($snow!=1){
				   $snow=0;
			   }
			   if($lawn!=1){
				   
				   $lawn=0;
			   }
          
			 DB::update('update company_details set lawn_service="'.$lawn.'",snow_service="'.$snow.'" where provider_id="'.$pid.'"');
               
		  return Redirect::back(); 
	}
	

	public function provider(){
		 $id=Sentinel::getUser()->id;
         $result = DB::select( DB::raw("SELECT users.address,users.state,users.cityuser,users.company_name,users.email,users.mobile,company_details.ein,company_details.logo FROM users left join company_details on users.id=company_details.provider_id where users.id=$id ") );
		 
		return View::make('admin.provider',['provider' => $result]);
	
		
	}
	
	public function payment(){
		 $id=Sentinel::getUser()->id;
         $result = DB::select( DB::raw("SELECT company_details.rounting_number,company_details.bank_name,company_details.account_number,company_details.billing_address FROM company_details where company_details.provider_id=$id ") );
		 
		return View::make('admin.payment', ['provider' => $result]);
	
		
	}
	
	public function service(Request $request){
		 $id=Sentinel::getUser()->id;
         $snow = $request->input('snow');
			   $lawn = $request->input('lawn'); 
               if($snow!=1){
				   $snow=0;
			   }
			   if($lawn!=1){
				   
				   $lawn=0;
			   }
          
			 DB::update('update company_details set lawn_service="'.$lawn.'",snow_service="'.$snow.'" where provider_id="'.$id.'"');
           $msg="Service updated successfully.";
		return View::make('admin.service',['msg' =>$msg]);
	
		
	}
	public function edit_workers(Request $request){

	
		       //$id=Sentinel::getUser()->id;
			    $wid=$request->input('id'); 
		       $first_name = $request->input('first_name');
			   $last_name = $request->input('last_name');
               $email = $request->input('email');
			   $mobile = $request->input('mobile');
               //$password = Hash::make($request->input('password'));
			    $city=$request->input('city');
			   $state=$request->input('state');
	           $country=$request->input('country');
			   $status=$request->input('status');

			  //DB::insert('insert into worker (user_id, first_name,last_name,email,password,mobile,city,state,country,status) values ("'.$id.'","'.$first_name.'","'.$last_name.'","'.$email.'","'.$mobile.'","'.$password.'","'.$city.'","'.$state.'","'.$country.'","'.$status.'")');
			  	 DB::update('update worker set first_name="'.$first_name.'",last_name="'.$last_name.'",email="'.$email.'" ,mobile="'.$mobile.'",city="'.$city.'"  ,state="'.$state.'" ,country="'.$country.'" ,status="'.$status.'"where id="'.$wid.'"');
		      return Redirect::back();    
	}
    public function add_worker_provider(Request $request){
		        $id=Sentinel::getUser()->id;
		       $first_name = $request->input('first_name');
			   $last_name = $request->input('last_name');
               $email = $request->input('email');
			   $mobile = $request->input('mobile');
               $password = Hash::make($request->input('pass'));
			    $city=$request->input('city');
			   $state=$request->input('state');
	           $country=$request->input('country');
			   $status=$request->input('status');

			  DB::insert('insert into worker (user_id, first_name,last_name,email,password,mobile,city,state,country,status) values ("'.$id.'","'.$first_name.'","'.$last_name.'","'.$email.'","'.$password.'","'.$mobile.'","'.$city.'","'.$state.'","'.$country.'","'.$status.'")');
               
		  return Redirect::back(); 
	}
	
	
	public function add_worker(Request $request){
		        $pid = $request->input('ids');
		       $first_name = $request->input('first_name');
			   $last_name = $request->input('last_name');
               $email = $request->input('email');
			   $mobile = $request->input('mobile');
               $password = Hash::make($request->input('pass'));
			    $city=$request->input('city');
			   $state=$request->input('state');
	           $country=$request->input('country');
			   $status=$request->input('status');

			  DB::insert('insert into worker (user_id, first_name,last_name,email,password,mobile,city,state,country,status) values ("'.$pid.'","'.$first_name.'","'.$last_name.'","'.$email.'","'.$password.'","'.$mobile.'","'.$city.'","'.$state.'","'.$country.'","'.$status.'")');
               
		  return Redirect::back(); 
	}
	public function transaction_details($id){
		  $yes='yes'; 
		$no='no';
		  $results = DB::select( DB::raw("SELECT users.first_name,users.email,users.mobile,orders.total_price,orders.worker_rating,location.location_address,location.city,location.state,location.zip,orders.order_date,orders.lotsize,orders.corner,orders.side_walk,orders.car_fit,orders.inclined FROM orders left join users on orders.user_id=users.id left join location on orders.location_id=location.location_id where orders.id=$id") );
		 
		 
		  $res = DB::select( DB::raw("SELECT worker.id, worker.first_name,worker.email,orders.start_time,orders.end_time,orders.before_image,orders.after_image,orders.customer_rate FROM orders left join worker on orders.worker_id=worker.id where orders.id=$id") );
		  foreach($res as $key=>$val){
			  $wid=$val->id;
			   
		  $ress = DB::select( DB::raw("SELECT count(worker_id) as jobs from orders where orders.worker_id=$id")
		  );
			  
		  }
		  // print_r($results); exit;
	
		
		   $rest = DB::select( DB::raw("select users.company_name,users.address,users.cityuser,users.state,users.postal,users.mobile,orders.total_price from orders inner join worker on orders.worker_id= worker.id inner join users on users.id=worker.user_id where orders.id=$id") );
			return View::make('admin.transaction_detail',['results' =>$results,'no'=>$no,'yes'=>$yes,'res'=>$res,'rest'=>$rest,'ress'=>$ress]);
		
	}
	//change on 27june
	public function editcompany(Request $request){		 
				$id = $_GET['ids']; 
				$name = $_GET['name']; 
				$firstname = $_GET['firstname']; 
				$address1 = $_GET['address'];
				$city = $_GET['city'];
				$state = $_GET['state'];
				$zip = $_GET['zip'];
				$ein = $_GET['ein'];
				$mobile = $_GET['mobile'];
				//$ein = $_GET['ein'];
				$bank = $_GET['bank'];
				$acno = $_GET['acno'];
				$rount = $_GET['rount'];
				$billadd = $_GET['billadd'];
				$btype = $_GET['btype'];
				$email = $_GET['email'];
				
				$address=$address1.' '.$city.' '.$zip.' '.$state;
			   $address = str_replace(" ", "+", $address);
			   
			    $url = "https://maps.google.com/maps/api/geocode/json?address=$address&key=AIzaSyA02WLCd_YPGalluqfrbNJ2-yTAimRPPcc&sensor=false";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);


            $response_a = json_decode($response);
			if($response_a->status!="ZERO_RESULTS"){
	$lat = $response_a->results[0]->geometry->location->lat;

 $long = $response_a->results[0]->geometry->location->lng;
	
}else{
	$lat = "";

 $long = "";
}
				
				
		     $result = DB::select( DB::raw("update `users` set email='".$email."', company_name='".$name."',first_name='".$firstname."',address='".$address1."',mobile='".$mobile."',state='".$state."',cityuser='".$city."' ,postal='".$zip."'where id= ".$id."  ") );
			 
			// $results = DB::select( DB::raw("update `company_details` set ein='".$ein."', bank_name='".$bank."',account_number='".$acno."',rounting_number='".$rount."',billing_address='".$billadd."',buisness_type='".$btype."',lat='".$lat."',lng='".$long."' where provider_id= ".$id."  ") );
			 
		 	 return Redirect::back(); 
  
		 
	}
	
	
	
}

