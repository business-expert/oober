<!DOCTYPE html>
<html>

<head>
<link href="{{ asset('assets/build/css/custom.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <title>
        @section('title')
            | oober
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
    <!-- font Awesome -->

    <!-- end of global css -->
    <!--page level css-->
    @yield('header_styles')
            <!--end of page level css-->

<body class="skin-josh" style="min-height:auto !important;">
<header class="header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ asset('assets/img/Slice 1.png') }}" class="img-width" alt="logo">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
		
		
        <div class="navbar-right">
            
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas" style="min-height:auto !important; height:auto !important;">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                <div class="nav_icons">
               <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('images/User_man_male_profile_account_person_people.png') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info_provider">
                <span>Hello</span>
                
              </div>
            </div>
                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
                @include('admin.layouts._left_menu_provider')
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">

        <!-- Notifications -->
        @include('notifications')

                <!-- Content -->
        @yield('content')

    </aside>
    <!-- right-side -->
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top"
   data-toggle="tooltip" data-placement="left">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>
<!-- global js -->



<!-- end of global js -->
<!-- begin page level js -->
@yield('footer_scripts')
        <!-- end page level js -->
		
</body>
</html>


 
 
 <!--<div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('images/User_man_male_profile_account_person_people.png') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Hello,Terry</span>
                
              </div>
            </div>
			
			<script>
			$(function(){
				
				var rightwidth = $('.no-pad').width();
				alert(rightwidth)
				
			})
			
			</script>