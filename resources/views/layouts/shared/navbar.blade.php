<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>
    <nav class="nav navbar-nav">
      <ul class=" navbar-right">
        <li class="nav-item dropdown open" style="padding-left: 15px;">
          <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
            <img src="{{asset('images/Loginlogo.png')}}" alt="">{{ Auth()->user()->first_name ?? ''}} {{ Auth()->user()->last_name ?? ''}}
          </a>
          <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
          
           
          
          <a class="dropdown-item" id="messagesButton">
          
  <i class="fa fa-envelope"></i> Messages
</a>

<button id="refreshButton">
    <i class="fa fa-refresh"></i>
  </button><button id="closeButton" class="fa fa-close"></button>
<div id="messagesDropdown" class="dropdown-menu">

  

  <ul id="messagesList" class="list-unstyled">
    
    <!-- Generated dropdown list items will be inserted here -->
  </ul>

  
</div>




            
            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right" ></i> Log Out</a>
            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</div>
<style>
#messagesDropdown {
  position: relative;
}

#closeButton {
  position: absolute;
  right: 10px;
  border: none;
  background: none;
  color: #000;
  font-size: 12px;
  cursor: pointer;
  
}
</style>
@include('layouts.scripts.messages-script')



 
