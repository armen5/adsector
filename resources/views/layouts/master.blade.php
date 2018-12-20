<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AdSector') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script type="text/javascript" src = "/js/script.js"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.min.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

</head>
<body>
	<div id = "wrapper">
		<!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo.png" alt="">
                </a>
            </div>
            <div class="sidebar-content">
            	<form action="" method="" class="search_filters" id = "sidebar-form">
            		<div class="header">
						<i class="fa fa-search icons"></i> Search Mode
					</div>
					<fieldset>
						<div class="form-control">
							<select name="mode">
								<option value="" selected="selected">Ad seen between</option>
								<option value="">Ad post created between (NF only)</option>
							</select>
							<i class="fa fa-calendar-o"></i>
						</div>
						<div class="form-control">
							<select name="mode">
								<option value="" selected="selected">Dec 18, 2018</option>
								<option value="">Today</option>
								<option value="">Yesterday</option>
								<option value="">Last Month</option>
							</select>
							<i class="fa fa-calendar-o"></i>
						</div>
						<div class="form-control">
							<select name="mode">
								<option value="" selected="selected">Search Mode</option>
								<option value="">Keyword</option>
								<option value="">Advertiser</option>
								<option value="">Publisher</option>
							</select>
							<i class="fa fa-calendar-o"></i>
						</div>
						<div class="form-control">
							<select name="mode">
								<option value="" selected="selected">Sort by</option>
								<option value="">Newest</option>
								<option value="">Running longest</option>
								<option value="">Reach</option>
								<option value="">Likes</option>
								<option value="">Shares</option>
							</select>
							<i class="fa fa-calendar-o"></i>
						</div>
						<div class="form-control">
							<select name="country" id="country" multiple="multiple" class="">
								<option value="image">Armenia</option>
								<option value="video">Russia</option>
								<option value="video">New York</option>
							</select>
							<i class="fa fa-globe"></i>
						</div>
					</fieldset>
					<div class="sidebar--action">
						<button type="submit" class="btn btn-lg btn-primary">
							FILTER NOW
						</button>
					</div>
            	</form>
            </div>
        </nav>
        <div id = "content">
        	<div class = "page-header">
        		<ul class = "header_nav">
					<li class="dropdown">
						<a href="#" class="profile dropdown-toggle" id="profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="name">
								<b>{{ Auth::user()->name }}</b>
							</span>
							<div class="icon"><i class="fa fa-chevron-down"></i></div>
						</a>
						<ul class="dropdown-menu" aria-labelledby="profile-dropdown">
							<li>
								<a href="/search/bookmarks">
									<i class="fa fa-fw fa-star" aria-hidden="true"></i> Bookmarks
								</a>
							</li>
							<li>
								<a href="/account/member" target="_self">
									<i class="fa fa-fw fa-user" aria-hidden="true"></i> Account
								</a>
							</li>
							<li>
								<a class="" href="{{ route('logout') }}"
	                               onclick="event.preventDefault();
	                                             document.getElementById('logout-form').submit();">
	                                <i class="fa fa-fw fa-sign-out" aria-hidden="true"></i>
	                                {{ __('Logout') }}
	                            </a>

	                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                @csrf
	                            </form>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#modal-support">
									<i class="fa fa-fw fa-question-circle" aria-hidden="true"></i> Contact Us
								</a>
							</li>
						</ul>
					</li>
				</ul>
        	</div>
        	@yield('content')
        </div>
	</div>

</body>
</html>