
<?php
include_once 'web_builder.php';
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::pattern('slug', '[a-z0-9- _]+');

Route::group(array('prefix' => 'admin'), function () {
	Route::get('index', 'JoshController@getOrders');
	Route::get('new_provider_registration', 'JoshController@getnewproviders');
	Route::get('customer_below_four_star', 'JoshController@activecustomers');
	Route::get('worker_below_four_star', 'JoshController@activeworkers');
	Route::get('compnies', 'JoshController@companies');
	Route::get('transaction', 'JoshController@alltransactions'); 
	Route::get('accounts', 'JoshController@accounts');
	Route::get('worker', 'JoshController@allworkers');
    Route::get('gmaps', 'JoshController@gmaps');
	Route::get('provider', 'JoshController@provider');
	Route::get('payment', 'JoshController@payment');
	Route::get('changestatusworker', 'JoshController@changestatusworker');
	
	Route::get('transactions', 'JoshController@transactions');
    Route::get('app_users', 'JoshController@app_users');
    Route::get('all-tweets-csv', function(){

    //$table = User::all();
	 $id=Sentinel::getUser()->id;
		
		
		  $users = DB::table('worker')
                    ->where('user_id',$id)
                    ->get()->toArray();
					$count=count($users);
					$i=0;
					foreach($users as $key=>$val){
						$id=$val->id;
						$table[$i]['first_name']=$val->first_name;
						$table[$i]['email']=$val->email;
                        $table[$i]['password']=$val->password;
						$table[$i]['password']=$val->password;
						$table[$i]['status']=$val->status;
						
						$res = DB::select(DB::raw("select count(orders.worker_id) as jobs,AVG(orders.worker_rating) AS rating from orders where orders.worker_id=$id group by orders.worker_id"));
						
						foreach($res as $k=>$v){
							
							$table[$i]['rating']=$v->rating;
							$table[$i]['jobs']=$v->jobs;
						}
						$i++;
					}
					
    $filename = "app_userlist.csv";
	
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('first name', 'email', 'status', 'rating','jobs'));


    foreach($table as $row) {
		if(isset($row['rating'])){
			$rating=$row['rating'];
		}else{
			$rating='';
		}
		if(isset($row['rating'])){
			$jobs=$row['jobs'];
		}else{
			$jobs='';
		}
        fputcsv($handle, array($row['first_name'], $row['email'], $row['status'], $rating,$jobs));
    }

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

    return Response::download($filename, 'tweets.csv', $headers);
});

Route::get('all-transs-csv/{ids}', function($ids){

    //$table = User::all();
	  $id=$ids;
		
		
		 $result = DB::select( DB::raw("SELECT users.id,users.address,company_details.buisness_type,users.email,users.first_name,users.company_name,users.mobile,company_details.ein,company_details.bank_name,company_details.account_number,company_details.rounting_number,company_details.billing_address,company_details.city,company_details.state FROM users  join company_details on users.id=company_details.provider_id where users.id=$id ") );
	  
	  foreach($result as $ke=>$val){
		  
		  $provider=$val->company_name;
	  
	   //$res= DB::select( DB::raw("SELECT orders.id,users.first_name,orders.total_price,orders.service,location.city,location.state,company_details.ein,company_details.bank_name,company_details.account_number,company_details.rounting_number,company_details.billing_address FROM users  join company_details on users.id=company_details.provider_id where users.id=$id ") );
	   
	   $transaction= DB::select( DB::raw("SELECT worker.id,users.first_name,orders.total_price,orders.order_date,location.city,location.state,orders.service,worker.first_name as workername FROM users  join orders on users.id=orders.user_id join location on location.location_id=orders.location_id join worker on worker.id=orders.worker_id  where worker.user_id=$id and orders.is_completed=1 ") );
	   $i=0;
	 if(count($transaction)>0){
	   foreach($transaction as $key=>$value){
		   
		  $table[$i]['first_name']=$value->first_name;
		   $table[$i]['total_price']=$value->total_price;
		   $table[$i]['order_date']=$value->order_date;
		   $table[$i]['city']=$value->city;
		   $table[$i]['state']=$value->state;
			 $table[$i]['service']=$value->service;
			  $table[$i]['workername']=$value->workername;
			  $table[$i]['provider']=$provider;
			  $i++;
	   }
	   
	   }else{  $table=array();}
	  }			
    $filename = "transaction.csv";
	
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('first_name', 'total_price', 'order_date', 'city','state','service','workername','provider'));

    foreach($table as $row) {
		
        fputcsv($handle, array($row['first_name'], $row['total_price'], $row['order_date'], $row['city'],$row['state'],$row['service'],$row['workername'],$row['provider']));
    }

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

    return Response::download($filename, 'transaction.csv', $headers);
});

Route::get('all-tra-csv', function(){

    //$table = User::all();
	 $id=Sentinel::getUser()->id;
		
		
		   $table = DB::select(DB::raw("select orders.order_date,users.first_name ,l.city,l.state,orders.service, orders.total_price ,worker.first_name as workername,orders.customer_rate from orders join users on orders.user_id = users.id join worker on orders.worker_id=worker.id join location l on orders.location_id=l.location_id where worker.user_id=$id"));
					
    $filename = "trans.csv";
	
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('order date', 'customer name', 'city', 'state','service','total_price','workername','customer_rate'));

    foreach($table as $rows=>$row) {
		
        fputcsv($handle, array($row->order_date, $row->first_name, $row->city, $row->state,$row->service,$row->total_price,$row->workername,$row->customer_rate));
    }

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

	
    return Response::download($filename, 'trans.csv', $headers);
});
	Route::match('(GET|POST)', 'worker','JoshController@allworkers');
	Route::get('company_details/{id}', 'JoshController@companydetails');
		Route::get('service', 'JoshController@getservice');
		Route::get('insurance_upload', 'JoshController@insurance_upload');
		Route::match('(GET|POST)','insuranceupload1', 'JoshController@insuranceupload');
		
		Route::get('edit', 'JoshController@getservice');
	Route::get('ajaxCompanyDetail/{id}', 'JoshController@ajaxCompanyDetail');
	Route::get('changestatus', 'JoshController@changestatus');
	Route::get('ajaxCustomers', 'JoshController@ajaxCustomers');
	Route::get('addcompanies', 'JoshController@addcompanies');
		//Route::get('getname', 'JoshController@headerprovider');
	//Route::match('(GET|POST)', 'company_details/{id}','JoshController@companydetails');
	Route::get('transaction_detail/{id}', 'JoshController@transaction_details');
	Route::get('editworker/{id}', 'JoshController@edit_worker');
	Route::get('editprofile', 'JoshController@edit_profile');
	Route::get('editpayment', 'JoshController@edit_payment');
	 Route::get('editcompany', 'JoshController@editcompany');
	Route::get('customer_details/{id}', 'JoshController@account_detail');
	Route::get('worker_detail/{wid}', 'JoshController@worker_detail');
	Route::post('add_company',array('as' => 'add_company','uses' => 'JoshController@add_company'));
	Route::post('add_worker_provider',array('as' => 'add_worker_provider','uses' => 'JoshController@add_worker_provider'));
	Route::post('resetpasswordcustomer',array('as' => 'resetpasswordcustomer','uses' => 'JoshController@resetpasswordcustomer'));
	Route::post('insuranceadmin_upload',array('as' => 'insuranceadmin_upload','uses' => 'JoshController@insuranceadmin_upload'));
	Route::post('getOrders',array('as' => 'getOrders','uses' => 'JoshController@getOrders'));
	Route::post('alltransactions',array('as' => 'alltransactions','uses' => 'JoshController@alltransactions'));
	Route::post('companies',array('as' => 'companies','uses' => 'JoshController@companies'));
	Route::post('accounts',array('as' => 'accounts','uses' => 'JoshController@accounts'));
	Route::post('allworkers',array('as' => 'allworkers','uses' => 'JoshController@allworkers'));
	Route::post('resetpasswordworker',array('as' => 'resetpasswordworker','uses' => 'JoshController@resetpasswordworker'));
	Route::post('showHome',array('as' => 'showHome','uses' => 'JoshController@showHome'));
	
	Route::post('edit_workers',array('as' => 'edit_workers','uses' => 'JoshController@edit_workers'));
	Route::post('editprofile',array('as' => 'editprofile','uses' => 'JoshController@editprofile'));
	Route::post('editpayment',array('as' => 'editpayment','uses' => 'JoshController@editpayment'));
	Route::post('add_worker',array('as' => 'add_worker','uses' => 'JoshController@add_worker'));
	Route::post('serviceupdate',array('as' => 'serviceupdate','uses' => 'JoshController@serviceupdate'));
	Route::post('reset_password',array('as' => 'reset_password','uses' => 'JoshController@reset_password'));
	Route::post('service',array('as' => 'service','uses' => 'JoshController@service'));
	Route::post('password',array('as' => 'password','uses' => 'JoshController@password'));
	Route::post('datetransaction',array('as' => 'datetransaction','uses' => 'JoshController@datetransaction'));
	Route::post('company_details',array('as' => 'company_details','uses' => 'JoshController@companydetails'));
//Route::get('password', 'JoshController@password');
     Route::get('insurance', 'JoshController@getinsurance');
	  //Route::get('company_details/{id}', 'JoshController@getinsuranceadmin');
		Route::post('insurance',array('as' => 'insurance','uses' => 'JoshController@insurance_upload'));
		Route::post('uploadlogo',array('as' => 'uploadlogo','uses' => 'JoshController@uploadlogo'));
	Route::post('setting',array('as' => 'setting','uses' => 'JoshController@settings'));
		//Route::post('changestatus',array('as' => 'changestatus','uses' => 'JoshController@changestatus'));
		
    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return View('admin/404');
    });

	
	
     Route::get('500', function () {
        return View::make('admin/500');
    });
	

	
    //Route::post('index', array('as' => 'index', 'uses' => 'JoshController@getOrders'));
    Route::post('secureImage', array('as' => 'secureImage','uses' => 'JoshController@secureImage'));

    # Lock screen
    Route::get('{id}/lockscreen', array('as' => 'lockscreen', 'uses' =>'UsersController@lockscreen'));
    Route::post('{id}/lockscreen', array('as' => 'lockscreen', 'uses' =>'UsersController@postLockscreen'));

    # All basic routes defined here
    Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
    Route::post('signin', 'AuthController@postSignin');
    Route::post('signup', array('as' => 'signup', 'uses' => 'AuthController@postSignup'));
    Route::post('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@postForgotPassword'));
    Route::get('login2', function () {
        return View::make('admin/login2');
    });

    # Register2
    Route::get('register2', function () {
        return View::make('admin/register2');
    });
    Route::post('register2', array('as' => 'register2', 'uses' => 'AuthController@postRegister2'));

    # Forgot Password Confirmation
    Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

    # Logout
    Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

    # Account Activation
    Route::get('activate/{userId}/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    # Dashboard / Index
    Route::get('/', array('as' => 'dashboard','uses' => 'JoshController@showHome'));

    // GUI Crud Generator
    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');

    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', array('as' => 'users', 'uses' => 'UsersController@index'));
        Route::get('data',['as' => 'users.data', 'uses' =>'UsersController@data']);
        Route::get('create', 'UsersController@create');
        Route::post('create', 'UsersController@store');
        Route::get('{user}/delete', array('as' => 'users.delete', 'uses' => 'UsersController@destroy'));
        Route::get('{user}/confirm-delete', array('as' => 'users.confirm-delete', 'uses' => 'UsersController@getModalDelete'));
        Route::get('{user}/restore', array('as' => 'restore/user', 'uses' => 'UsersController@getRestore'));
        Route::get('{user}', array('as' => 'users.show', 'uses' => 'UsersController@show'));
        Route::post('{user}/passwordreset', array('as' => 'passwordreset', 'uses' => 'UsersController@passwordreset'));
    });
    Route::resource('users', 'UsersController');

    Route::get('deleted_users',array('as' => 'deleted_users','before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'));

    # Group Management
    Route::group(array('prefix' => 'groups'), function () {
        Route::get('/', array('as' => 'groups', 'uses' => 'GroupsController@index'));
        Route::get('create', array('as' => 'groups.create', 'uses' => 'GroupsController@create'));
        Route::post('create', 'GroupsController@store');
        Route::get('{group}/edit', array('as' => 'groups.edit', 'uses' => 'GroupsController@edit'));
        Route::post('{group}/edit', 'GroupsController@update');
        Route::get('{group}/delete', array('as' => 'groups.delete', 'uses' => 'GroupsController@destroy'));
        Route::get('{group}/confirm-delete', array('as' => 'groups.confirm-delete', 'uses' => 'GroupsController@getModalDelete'));
        Route::get('{group}/restore', array('as' => 'groups.restore', 'uses' => 'GroupsController@getRestore'));
    });
    /*routes for blog*/
    Route::group(array('prefix' => 'blog'), function () {
        Route::get('/', array('as' => 'blogs', 'uses' => 'BlogController@index'));
        Route::get('create', array('as' => 'blog.create', 'uses' => 'BlogController@create'));
        Route::post('create', 'BlogController@store');
        Route::get('{blog}/edit', array('as' => 'blog.edit', 'uses' => 'BlogController@edit'));
        Route::post('{blog}/edit', 'BlogController@update');
        Route::get('{blog}/delete', array('as' => 'blog.delete', 'uses' => 'BlogController@destroy'));
        Route::get('{blog}/confirm-delete', array('as' => 'blog.confirm-delete', 'uses' => 'BlogController@getModalDelete'));
        Route::get('{blog}/restore', array('as' => 'blog.restore', 'uses' => 'BlogController@restore'));
        Route::get('{blog}/show', array('as' => 'blog.show', 'uses' => 'BlogController@show'));
        Route::post('{blog}/storecomment', 'BlogController@storeComment');
    });

    /*routes for blog category*/
    Route::group(array('prefix' => 'blogcategory'), function () {
        Route::get('/', array('as' => 'blogcategories', 'uses' => 'BlogCategoryController@index'));
        Route::get('create', array('as' => 'blogcategory.create', 'uses' => 'BlogCategoryController@create'));
        Route::post('create', 'BlogCategoryController@store');
        Route::get('{blogCategory}/edit', array('as' => 'blogcategory.edit', 'uses' => 'BlogCategoryController@edit'));
        Route::post('{blogCategory}/edit', 'BlogCategoryController@update');
        Route::get('{blogCategory}/delete', array('as' => 'blogcategory.delete', 'uses' => 'BlogCategoryController@destroy'));
        Route::get('{blogCategory}/confirm-delete', array('as' => 'blogcategory.confirm-delete', 'uses' => 'BlogCategoryController@getModalDelete'));
        Route::get('{blogCategory}/restore', array('as' => 'blogcategory.restore', 'uses' => 'BlogCategoryController@getRestore'));
    });

    /*routes for file*/
    Route::group(array('prefix' => 'file'), function () {
        Route::post('create', 'FileController@store');
        Route::post('createmulti', 'FileController@postFilesCreate');
        Route::delete('delete', 'FileController@delete');
    });

    Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });
    Route::post('crop_demo','JoshController@crop_demo');

    /* laravel example routes */
    # datatables
    Route::get('datatables', 'DataTablesController@index');
    Route::get('datatables/data', array('as' => 'datatables.data', 'uses' => 'DataTablesController@data'));

    # editable datatables
    Route::get('editable_datatables', 'EditableDataTablesController@index');
    Route::get('editable_datatables/data', array('as' => 'editable_datatables.data', 'uses' => 'EditableDataTablesController@data'));
    Route::post('editable_datatables/create','EditableDataTablesController@store');
    Route::post('editable_datatables/{id}/update', 'EditableDataTablesController@update');
    Route::get('editable_datatables/{id}/delete', array('as' => 'admin.editable_datatables.delete', 'uses' => 'EditableDataTablesController@destroy'));

    # custom datatables
    Route::get('custom_datatables', 'CustomDataTablesController@index');
    Route::get('custom_datatables/sliderData', array('as' => 'admin.custom_datatables.sliderData', 'uses' => 'CustomDataTablesController@sliderData'));
    Route::get('custom_datatables/radioData', array('as' => 'admin.custom_datatables.radioData', 'uses' => 'CustomDataTablesController@radioData'));
    Route::get('custom_datatables/selectData', array('as' => 'admin.custom_datatables.selectData', 'uses' => 'CustomDataTablesController@selectData'));
    Route::get('custom_datatables/buttonData', array('as' => 'admin.custom_datatables.buttonData', 'uses' => 'CustomDataTablesController@buttonData'));
    Route::get('custom_datatables/totalData', array('as' => 'admin.custom_datatables.totalData', 'uses' => 'CustomDataTablesController@totalData'));

    //tasks section
    Route::post('task/create', 'TaskController@store');
    Route::get('task/data', 'TaskController@data');
    Route::post('task/{task}/edit', 'TaskController@update');
    Route::post('task/{task}/delete', 'TaskController@delete');


    # Remaining pages will be called from below controller method
    # in real world scenario, you may be required to define all routes manually

    Route::get('{name?}', 'JoshController@showView');

});

#FrontEndController
Route::get('login', array('as' => 'login','uses' => 'FrontEndController@getLogin'));
Route::post('login','FrontEndController@postLogin');
Route::get('register', array('as' => 'register','uses' => 'FrontEndController@getRegister'));
Route::post('register','FrontEndController@postRegister');
Route::get('activate/{userId}/{activationCode}',array('as' =>'activate','uses'=>'FrontEndController@getActivate'));
Route::get('forgot-password',array('as' => 'forgot-password','uses' => 'FrontEndController@getForgotPassword'));
Route::post('forgot-password','FrontEndController@postForgotPassword');
# Forgot Password Confirmation
Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'FrontEndController@getForgotPasswordConfirm'));
Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
# My account display and update details
Route::group(array('middleware' => 'user'), function () {
    Route::get('my-account', array('as' => 'my-account', 'uses' => 'FrontEndController@myAccount'));
    Route::put('my-account', 'FrontEndController@update');
});
Route::get('logout', array('as' => 'logout','uses' => 'FrontEndController@getLogout'));
	# contact form
Route::post('contact',array('as' => 'contact','uses' => 'FrontEndController@postContact'));
	//Route::get('admin/index', array('as' => 'index', 'uses' => 'JoshController@getOrders'));
	#frontend views

Route::get('/', array('as' => 'home', function () {
		return View::make('index');
}));


Route::get('blog', array('as' => 'blog', 'uses' => 'FrontendBlogController@index'));
Route::get('blog/{slug}/tag', 'FrontendBlogController@getBlogTag');
Route::get('blogitem/{slug?}', 'FrontendBlogController@getBlog');
Route::post('blogitem/{blog}/comment', 'FrontendBlogController@storeComment');

Route::get('{name?}', 'JoshController@showFrontEndView');
//Route::get('testview', 'JoshController@getOrders');
# End of frontend views
//Route::post('testview', array('as' => 'testview', 'uses' => 'JoshController@getOrders'));
