<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Food Order Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li> <a href="index.html"><i class="bx bx-right-arrow-alt"></i>Default</a>
                </li>
                <li> <a href="dashboard-eCommerce.html"><i class="bx bx-right-arrow-alt"></i>eCommerce</a>
                </li>
                <li> <a href="dashboard-analytics.html"><i class="bx bx-right-arrow-alt"></i>Analytics</a>
                </li>
                <li> <a href="dashboard-digital-marketing.html"><i class="bx bx-right-arrow-alt"></i>Digital Marketing</a>
                </li>
                <li> <a href="dashboard-human-resources.html"><i class="bx bx-right-arrow-alt"></i>Human Resources</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Admin Section</li>
        <li>
            <a href="widgets.html">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Home</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
            <ul>
                <li> <a href="{{route('category.add')}}"><i class="bx bx-right-arrow-alt"></i>Add</a>
                </li>
                <li> <a href="{{route('category.all')}}"><i class="bx bx-right-arrow-alt"></i>View</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Menus</div>
            </a>
            <ul>
                <li> <a href="{{route('menu.add')}}"><i class="bx bx-right-arrow-alt"></i>Add</a>
                </li>
                <li> <a href="{{route('menu.all')}}"><i class="bx bx-right-arrow-alt"></i>View</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Banner</div>
            </a>
            <ul>
                <li> <a href="content-grid-system.html"><i class="bx bx-right-arrow-alt"></i>Add</a>
                </li>
                <li> <a href="content-typography.html"><i class="bx bx-right-arrow-alt"></i>View</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Orders</div>
            </a>
            <ul>
                <li> <a href="icons-line-icons.html"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bx bx-right-arrow-alt"></i>Confirmed Order</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Shipping Area</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
                </div>
                <div class="menu-title">Shipping Area</div>
            </a>
            <ul>
                <li> <a href="{{route('division.add')}}"><i class="bx bx-right-arrow-alt"></i>Division Area</a>
                </li>
                <li> <a href="{{route('district.add')}}"><i class="bx bx-right-arrow-alt"></i>District Area</a>
                </li>
                <li> <a href="{{route('state.add')}}"><i class="bx bx-right-arrow-alt"></i>State Area</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">User Section</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-lock"></i>
                </div>
                <div class="menu-title">Coupon</div>
            </a>
            <ul>
                <li> <a href="{{route('coupon.add')}}" target="_blank"><i class="bx bx-right-arrow-alt"></i>Add</a>
                </li>
                <li> <a href="{{route('coupon.all')}}" target="_blank"><i class="bx bx-right-arrow-alt"></i>View</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="user-profile.html">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>
        <li>
            <a href="timeline.html">
                <div class="parent-icon"> <i class="bx bx-video-recording"></i>
                </div>
                <div class="menu-title">Timeline</div>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-error"></i>
                </div>
                <div class="menu-title">Errors</div>
            </a>
            <ul>
                <li> <a href="errors-404-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>404 Error</a>
                </li>
                <li> <a href="errors-500-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>500 Error</a>
                </li>
                <li> <a href="errors-coming-soon.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Coming Soon</a>
                </li>
                <li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="faq.html">
                <div class="parent-icon"><i class="bx bx-help-circle"></i>
                </div>
                <div class="menu-title">FAQ</div>
            </a>
        </li>
        <li>
            <a href="pricing-table.html">
                <div class="parent-icon"><i class="bx bx-diamond"></i>
                </div>
                <div class="menu-title">Pricing</div>
            </a>
        </li>
        <li class="menu-label">Charts & Maps</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Charts</div>
            </a>
            <ul>
                <li> <a href="charts-apex-chart.html"><i class="bx bx-right-arrow-alt"></i>Apex</a>
                </li>
                <li> <a href="charts-chartjs.html"><i class="bx bx-right-arrow-alt"></i>Chartjs</a>
                </li>
                <li> <a href="charts-highcharts.html"><i class="bx bx-right-arrow-alt"></i>Highcharts</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-map-alt"></i>
                </div>
                <div class="menu-title">Maps</div>
            </a>
            <ul>
                <li> <a href="map-google-maps.html"><i class="bx bx-right-arrow-alt"></i>Google Maps</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bx bx-right-arrow-alt"></i>Vector Maps</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Others</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-menu"></i>
                </div>
                <div class="menu-title">Menu Levels</div>
            </a>
            <ul>
                <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level One</a>
                    <ul>
                        <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Two</a>
                            <ul>
                                <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Three</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="https://codervent.com/rukada/documentation/index.html" target="_blank">
                <div class="parent-icon"><i class="bx bx-folder"></i>
                </div>
                <div class="menu-title">Documentation</div>
            </a>
        </li>
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
