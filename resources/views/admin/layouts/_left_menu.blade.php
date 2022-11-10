<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
			  <div class="adminis">
                <h3>Administrator</h3>
					<ul class="nav side-menu">
					  <li id="dash"><a href="{{ URL::to('admin/index') }}"><img src="{{ asset('/assets/images/dashboard.png') }}" alt="..." ><span>Dashboard</span></a></li> 
					  <li id="sett"><a href="{{ URL::to('admin/setting') }}"><img src="{{ asset('/assets/images/setting.png') }}" alt="..." ><span>Setting</span></a></li>
					</li>
					  
					</ul>
				</div>
				<div class="nav-part-cnt"> 
				<h3>Providers</h3>
                <ul class="nav side-menu">
                  <li id="comp"><a href="{{ URL::to('admin/compnies') }}"><img src="{{ asset('/assets/images/companies.png') }}" alt="..." ><span>Companies</span></a></li>
                  <li id="worker"><a href="{{ URL::to('admin/worker') }}"><img src="{{ asset('/assets/images/workers.png') }}" alt="..." ><span>Workers</span></a></li>
				   <li id="map"><a href="{{ URL::to('admin/gmaps') }}"><img src="{{ asset('/assets/images/Map.png') }}" alt="..." ><span>Map</span></a></li>
                   
               
                 
                    
                  </li>
                  
                </ul>
				</div>
				<div class="nav-part-cnt">
					<h3>Customers</h3>
                <ul class="nav side-menu">
                 
                  <li id="account"><a href="{{ URL::to('admin/accounts') }}"><img src="{{ asset('/assets/images/accounts.png') }}" alt="..." ><span>Accounts</span></a></li>
				   <li id="transac"><a href="{{ URL::to('admin/transaction') }}"><img src="{{ asset('/assets/images/transactions.png') }}" alt="..." ><span>Transactions</span></a></li>
				  
					</li>
				
					</li>
                  </ul>
				  </div>
				  <div class="nav-part-cnt" style="padding-top:0px;">
					
                <ul class="nav side-menu">
               
					<li id="log"> <a href="{{ URL::to('admin/logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></li>

                  </ul>
				  </div>
				</div>
				
				
<script src="{{ asset('assets/build/js/custom.min.js') }}"></script>


