    <div class="sidebar" data-background-color="white" data-active-color="custom">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ asset('dashboard') }}" class="simple-text">
                    Zalora Scraper
                </a>
            </div>

            <ul class="nav">
                <li @if(request()->route()->getName() == 'dashboard.index') class="active" @endif>
                    <a href="{{ asset('dashboard') }}">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li @if(request()->route()->getName() == 'dashboard.user') class="active" @endif>
                    <a href="{{ asset('dashboard/user') }}">
                        <i class="ti-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li @if(request()->route()->getName() == 'dashboard.scrape') class="active" @endif>
                    <a href="{{ asset('dashboard/scrape') }}">
                        <i class="ti-view-list-alt"></i>
                        <p>Scrape</p>
                    </a>
                </li>
                <li @if(request()->route()->getName() == 'dashboard.items') class="active" @endif>
                    <a href="{{ asset('dashboard/items') }}">
                        <i class="ti-tag"></i>
                        <p>Items</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a href="{{ asset('logout') }}">
                        <i class="ti-power-off"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>