<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('dashboard')}}" class="site_title">  <i class='fa fa-institution'></i><span>CCS Assets</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('images/Loginlogo.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth()->user()->first_name ?? ''}} {{ Auth()->user()->last_name ?? ''}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3></h3>
                <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                      <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                    </ul>
                  <li><a><i class="fa fa-edit"></i> Assets <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('item.index')}}">Assets</a></li>
                      <li><a href="{{route('inventory.index')}}">Inventory (beta)</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i> User Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('user.index')}}">User Records</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Setup <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="{{route('department.index')}}">Departments</a></li>
                      <li><a href="{{route('location.index')}}">Locations</a></li>
                      <li><a href="{{route('inventory_type.index')}}">Inventory Types</a></li>
                      <li><a href="{{route('item_category.index')}}">Item Categories</a></li>
                      <li><a href="{{route('unit_type.index')}}">Unit Types</a></li>
                      
                    </ul>
                  </li>
                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href=""onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
              
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>