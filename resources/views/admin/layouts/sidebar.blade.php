<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
			  <div class="adminis">
                <h3>Administrator</h3>
					<ul class="nav side-menu">
					  <li class="active"><a href="{{ URL::to('admin/index') }}"><img src="{{ asset('/assets/images/dashboard.png') }}" alt="..." ><span>Dashboard</span></a></li>
					  <li><a><img src="{{ asset('/assets/images/setting.png') }}" alt="..." ><span>Setting</span></a></li>
					</li>
					  
					</ul>
				</div>
				<div class="nav-part-cnt"> 
				<h3>Providers</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ URL::to('admin/compnies') }}"><img src="{{ asset('/assets/images/companies.png') }}" alt="..." ><span>Companies</span></a></li>
                  <li><a href="{{ URL::to('admin/worker') }}"><img src="{{ asset('/assets/images/workers.png') }}" alt="..." ><span>Workers</span></a></li>
				   <li><a href="{{ URL::to('admin/map') }}"><img src="{{ asset('/assets/images/Map.png') }}" alt="..." ><span>Map</span></a></li>
                   
               
                 
                    
                  </li>
                  
                </ul>
				</div>
				<div class="nav-part-cnt">
					<h3>Customers</h3>
                <ul class="nav side-menu">
                 
                  <li><a href="{{ URL::to('admin/accounts') }}"><img src="{{ asset('/assets/images/accounts.png') }}" alt="..." ><span>Accounts</span></a></li>
				   <li><a href="{{ URL::to('admin/transaction') }}"><img src="{{ asset('/assets/images/transactions.png') }}" alt="..." ><span>Transactions</span></a></li>
				   <li><a href="{{ URL::to('admin/comments') }}"><i class="fa fa-comment" aria-hidden="true"></i><span>Comments</span></a></li>
					</li>
                  </ul>
				  </div>
				</div>
				
				
<script src="{{ asset('assets/build/js/custom.min.js') }}"></script>
