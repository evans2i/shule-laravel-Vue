 <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @yield('navpart')
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
            </a>
            <ul class="dropdown-menu">
              <li>
                <ul class="menu">
                  <li><!-- Task item -->
                    <router-link to="/passport-clients">
                      Profile
                    </router-link>
                  </li>

                  <li><!-- Task item -->
                      <router-link to="/authorized-clients">
                          Profile
                      </router-link>
                  </li>

                  <li class="footer"><!-- Task item -->
                    <router-link to="/access-tokens">
                        Profile
                    </router-link>
                  </li>
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="profile/{{Auth::user()->img}}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{Auth::user()->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="profile/{{Auth::user()->img}}" class="img-circle" alt="User Image">

                  <p>
                    {{Auth::user()->name}}
                    @foreach (Auth::user()->roles as $role)
                      <small>{{$role->name}}</small>
                    @endforeach

                  </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <router-link to="/app-profile" class="btn btn-default btn-flat">Profile</router-link>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}"
                       class="btn btn-default btn-flat"
                       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">Sign out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              </ul>
            </li>
        </ul>
      </div>



