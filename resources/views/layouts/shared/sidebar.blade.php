<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('dashboard')}}" class="site_title">  <i class='fa fa-desktop'></i><span>CCS Assets</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            <div class="profile_pic">
            <img src="{{ asset('uploads/profilepic/' . (auth()->user()->profilepic ?? 'userprof.png')) }}"  class="rounded mx-auto d-block" style="width: 60px; height: 60px;">

            </div>
            <div class="profile_info">
              <span>Welcome, {{ Auth()->user()->first_name ?? 'Guest'}} </span>
            </div>
          </div>
          <style>.profile {
  display: flex;
  align-items: center;
}

.profile_info {
  margin-left: -10px;
  margin-bottom: 10px;
}
</style>

            
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
                      <li><a href="{{route('item.index')}}">Assets Records</a></li>
                      <li><a href="{{route('item.deletedAssets')}}">Deleted Assets</a></li>
                      <li><a href="{{route('inventory.index')}}">Arrange Assets</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-users"></i> User Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('user.index')}}">User Records</a></li>
                      <li><a href="{{route('logs.index')}}">User Logs</a></li>
                      <li><a href="{{ route('user.deletedUsers') }}">Deleted Users</a></li>

                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cogs"></i> Setup <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="{{route('department.index')}}">Departments</a></li>
                      <li><a href="{{route('location.index')}}">Locations</a></li>
                      <li><a href="{{route('inventory_type.index')}}">Inventory Types</a></li>
                      <li><a href="{{route('item_category.index')}}">Asset Categories</a></li>
                      <li><a href="{{route('unit_type.index')}}">Unit Types</a></li>
                      
                      
                    </ul>
                  </li>
                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            
            <!-- /menu footer buttons -->
          </div>
        </div>